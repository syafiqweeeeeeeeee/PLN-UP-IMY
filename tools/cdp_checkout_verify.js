/* CDP VERIFY — Alur Check-Out Tamu (metode rekomendasi, tanpa foto).
   Memverifikasi lewat UI yang dipakai satpam, di container app :8000:

   1. Halaman Detail: kartu check-in/out tampil, tombol Check-Out aktif
      hanya saat tamu sedang berkunjung.
   2. Klik [Check-In Tamu]  -> jam Check-In terisi TANPA reload halaman.
   3. Klik [Check-Out Tamu] -> jam Check-Out terisi real-time, badge
      berubah "Selesai", tombol disembunyikan, chip "Kunjungan selesai" tampil.
   4. Guard: check-out kedua kali ditolak (HTTP 422).
   5. Modal Detail di halaman daftar memakai kartu yang sama. */

const BASE = 'http://127.0.0.1:8000';
const TAMU_ID = process.env.TAMU_ID || '43';

function sleep(ms) { return new Promise(r => setTimeout(r, ms)); }
const results = [];
function check(name, ok, extra) {
  results.push({ name, ok: !!ok });
  console.log((ok ? 'PASS' : 'FAIL') + ' | ' + name + (extra ? ' | ' + extra : ''));
}

async function main() {
  const list = await (await fetch('http://127.0.0.1:9222/json/list')).json();
  const page = list.find(t => t.type === 'page');
  const ws = new WebSocket(page.webSocketDebuggerUrl);
  await new Promise((res, rej) => { ws.onopen = res; ws.onerror = rej; });

  let id = 0;
  const pend = new Map();
  const consoleErrors = [];
  ws.onmessage = (ev) => {
    const m = JSON.parse(ev.data);
    if (m.id && pend.has(m.id)) { const r = pend.get(m.id); pend.delete(m.id); r(m); }
    else if (m.method === 'Runtime.consoleAPICalled' && m.params.type === 'error') {
      consoleErrors.push(m.params.args.map(a => a.value ?? a.description ?? '').join(' '));
    } else if (m.method === 'Runtime.exceptionThrown') {
      consoleErrors.push('EXC: ' + (m.params.exceptionDetails.exception?.description || m.params.exceptionDetails.text));
    }
  };
  const send = (method, params = {}) => new Promise((res) => {
    const mid = ++id;
    ws.send(JSON.stringify({ id: mid, method, params }));
    pend.set(mid, res);
  });
  const evl = async (expr) => {
    const r = await send('Runtime.evaluate', { expression: expr, returnByValue: true, awaitPromise: true });
    return r.result?.result?.value;
  };

  await send('Page.enable');
  await send('Runtime.enable');

  // ---------- LOGIN ----------
  await send('Page.navigate', { url: BASE + '/admin/login' });
  await sleep(2500);
  await evl(`document.getElementById('email').value='admin@example.com';
    document.querySelector('input[type=password]').value='password123';
    document.querySelector('form').submit();`);
  await sleep(3500);

  // ---------- HALAMAN DETAIL ----------
  await send('Page.navigate', { url: BASE + '/admin/tamu/' + TAMU_ID + '/detail' });
  await sleep(3000);

  let st = JSON.parse(await evl(`JSON.stringify({
    url: location.href,
    card: !!document.querySelector('[data-co-card]'),
    status: document.querySelector('[data-role="status"]')?.textContent.trim(),
    badge: document.querySelector('[data-role="badge"]')?.textContent.trim(),
    checkin: document.querySelector('[data-role="checkin"]')?.textContent.trim(),
    checkout: document.querySelector('[data-role="checkout"]')?.textContent.trim(),
    btnInVisible: (() => { const b = document.querySelector('[data-action="checkin"]'); return !!b && !b.hidden; })(),
    btnOutVisible: (() => { const b = document.querySelector('[data-action="checkout"]'); return !!b && !b.hidden; })(),
    doneVisible: (() => { const b = document.querySelector('[data-role="done"]'); return !!b && !b.hidden; })(),
  })`));

  check('Detail: kartu check-in/out tampil', st.card);
  check('Detail: status awal "Belum Check-In"', st.status === 'Belum Check-In', st.status);
  check('Detail: tombol Check-In tampil, Check-Out menunggu sampai tamu tiba', st.btnInVisible && !st.btnOutVisible, 'in=' + st.btnInVisible + ' out=' + st.btnOutVisible);
  check('Detail: jam check-in & check-out masih kosong', st.checkin === '—' && st.checkout === '—');

  // ---------- KLIK CHECK-IN (tanpa reload) ----------
  await evl(`window.__noReload = 1;
    document.querySelector('[data-action="checkin"]').click();`);
  await sleep(2000);

  st = JSON.parse(await evl(`JSON.stringify({
    noReload: window.__noReload === 1,
    path: location.pathname,
    status: document.querySelector('[data-role="status"]')?.textContent.trim(),
    checkin: document.querySelector('[data-role="checkin"]')?.textContent.trim(),
    checkout: document.querySelector('[data-role="checkout"]')?.textContent.trim(),
    btnOutVisible: (() => { const b = document.querySelector('[data-action="checkout"]'); return !!b && !b.hidden; })(),
    msg: document.querySelector('[data-role="msg"]')?.textContent.trim(),
    msgHidden: document.querySelector('[data-role="msg"]')?.hidden,
  })`));

  check('Check-In: halaman TIDAK reload', st.noReload && st.path === '/admin/tamu/' + TAMU_ID + '/detail', st.path);
  check('Check-In: jam Check-In terisi real-time', st.checkin !== '—' && /\d{2}/.test(st.checkin || ''), st.checkin);
  check('Check-In: status menjadi "Berkunjung"', st.status === 'Berkunjung', st.status);
  check('Check-In: tombol Check-Out aktif', st.btnOutVisible);
  check('Check-In: pesan sukses tampil', !st.msgHidden && !!st.msg, st.msg);

  // ---------- KLIK CHECK-OUT (satu tombol, real-time) ----------
  await evl(`document.querySelector('[data-action="checkout"]').click();`);
  await sleep(2000);

  st = JSON.parse(await evl(`JSON.stringify({
    noReload: window.__noReload === 1,
    path: location.pathname,
    status: document.querySelector('[data-role="status"]')?.textContent.trim(),
    badge: document.querySelector('[data-role="badge"]')?.textContent.trim(),
    badgeClass: document.querySelector('[data-role="badge"]')?.className,
    checkin: document.querySelector('[data-role="checkin"]')?.textContent.trim(),
    checkout: document.querySelector('[data-role="checkout"]')?.textContent.trim(),
    durasi: document.querySelector('[data-role="durasi"]')?.textContent.trim(),
    btnInVisible: (() => { const b = document.querySelector('[data-action="checkin"]'); return !!b && !b.hidden; })(),
    btnOutVisible: (() => { const b = document.querySelector('[data-action="checkout"]'); return !!b && !b.hidden; })(),
    doneVisible: (() => { const b = document.querySelector('[data-role="done"]'); return !!b && !b.hidden; })(),
    headBadge: document.getElementById('detailBadge')?.textContent.trim(),
    msg: document.querySelector('[data-role="msg"]')?.textContent.trim(),
  })`));

  check('Check-Out: halaman TIDAK reload', st.noReload && st.path === '/admin/tamu/' + TAMU_ID + '/detail');
  check('Check-Out: jam Check-Out terisi real-time', st.checkout !== '—' && /\d{2}/.test(st.checkout || ''), st.checkout);
  check('Check-Out: status & badge menjadi "Selesai"', st.status === 'Selesai' && st.badge === 'Selesai', st.status + ' / ' + st.badge);
  check('Check-Out: tombol disembunyikan, chip selesai tampil', !st.btnOutVisible && !st.btnInVisible && st.doneVisible);
  check('Check-Out: badge halaman detail ikut diperbarui', st.headBadge === 'Selesai', st.headBadge);
  check('Check-Out: durasi terhitung', !!st.durasi && st.durasi !== '—', st.durasi);
  check('Check-Out: pesan sukses tampil', !!st.msg, st.msg);

  // ---------- GUARD: check-out kedua kali harus ditolak ----------
  const guard = await evl(`(async () => {
    const res = await fetch(document.querySelector('[data-co-card]').dataset.checkoutUrl, {
      method: 'PATCH',
      headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest',
                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
    });
    const body = await res.json();
    return JSON.stringify({ status: res.status, ok: body.ok, message: body.message });
  })()`);
  const g = JSON.parse(guard);
  check('Guard: check-out ulang ditolak HTTP 422', g.status === 422 && g.ok === false, g.message);

  // ---------- MODAL DETAIL DI HALAMAN DAFTAR ----------
  await send('Page.navigate', { url: BASE + '/admin/tamu' });
  await sleep(3000);
  await evl(`openDetailModal(${TAMU_ID})`);
  await sleep(800);

  const modal = JSON.parse(await evl(`JSON.stringify({
    card: !!document.querySelector('#detailModalBody [data-co-card]'),
    status: document.querySelector('#detailModalBody [data-role="status"]')?.textContent.trim(),
    checkin: document.querySelector('#detailModalBody [data-role="checkin"]')?.textContent.trim(),
    checkout: document.querySelector('#detailModalBody [data-role="checkout"]')?.textContent.trim(),
    doneVisible: (() => { const b = document.querySelector('#detailModalBody [data-role="done"]'); return !!b && !b.hidden; })(),
    btnOut: (() => { const b = document.querySelector('#detailModalBody [data-action="checkout"]'); return !!b && !b.hidden; })(),
    rowBadge: document.querySelector('tr[data-tamu-id="${TAMU_ID}"] .tamu-badge')?.textContent.trim(),
  })`));

  check('Modal Detail: kartu check-in/out ikut tampil', modal.card);
  check('Modal Detail: menampilkan state "Selesai" terbaru', modal.status === 'Selesai', modal.status);
  check('Modal Detail: jam check-in & check-out ikut terisi', modal.checkin !== '—' && modal.checkout !== '—', modal.checkout);
  check('Modal Detail: tombol check-out disembunyikan, chip selesai tampil', !modal.btnOut && modal.doneVisible);
  check('Daftar: badge baris tabel ikut berubah jadi Selesai', modal.rowBadge === 'Selesai', modal.rowBadge);

  // ---------- SCREENSHOT ----------
  const shot = await send('Page.captureScreenshot', { format: 'png' });
  const fs = await import('node:fs');
  fs.writeFileSync('storage/cdp-checkout-verify.png', Buffer.from(shot.result.data, 'base64'));
  console.log('Screenshot -> storage/cdp-checkout-verify.png');

  check('Tidak ada error JavaScript di console', consoleErrors.length === 0, consoleErrors.join(' | ').slice(0, 400));

  const failed = results.filter(r => !r.ok).length;
  console.log(`\nRingkasan: ${results.length - failed} PASS, ${failed} FAIL`);
  process.exit(failed ? 1 : 0);
}

main().catch((e) => { console.error('ERROR:', e); process.exit(1); });