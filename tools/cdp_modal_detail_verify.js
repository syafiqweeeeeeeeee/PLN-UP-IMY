/* CDP VERIFY — Modal Detail Tamu (desain minimalis, parsial baru).

   Diverifikasi di browser sungguhan (app :8000):

   ADMIN
   1. Modal dibuka dari parsial detail-tamu-modal (shell) & terisi JS.
   2. Bagian atas HANYA berisi identitas + jadwal — baris Check-In /
      Check-Out / Status sudah tidak ada; Jumlah Tamu, Tanggal Kunjungan,
      Waktu Pendaftaran tetap ada.
   3. Card dinamis di slot bawah: kondisi "Belum Check-In" + tombol
      Check-In. Klik -> real-time "Berkunjung" + jam check-in.
   4. Buka ulang modal -> hanya ADA SATU kartu (slot tidak menumpuk).
   5. Klik Check-Out -> kondisi "Selesai" (jam in/out + durasi + chip).

   PORTAL KARYAWAN
   6. Halaman karyawan memakai parsial yang sama: baris redundan hilang,
      kartu log aktivitas tampil di modal, kartu kondisi "Selesai" tampil. */

const BASE = 'http://127.0.0.1:8000';
const TAMU_ID = process.env.TAMU_ID || '44';

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

  // ================= LOGIN ADMIN =================
  await send('Page.navigate', { url: BASE + '/admin/login' });
  await sleep(2500);
  await evl(`document.getElementById('email').value='admin@example.com';
    document.querySelector('input[type=password]').value='password123';
    document.querySelector('form').submit();`);
  await sleep(3500);

  await send('Page.navigate', { url: BASE + '/admin/tamu' });
  await sleep(3000);

  await evl(`window.__urls = [];
    if (!window.__fetchWrapped) {
      window.__fetchWrapped = true;
      const orig = window.fetch;
      window.fetch = function (u, o) { window.__urls.push(String(u)); return orig.apply(this, arguments); };
    }
    openDetailModal(${TAMU_ID});`);
  await sleep(900);

  const s0 = JSON.parse(await evl(`JSON.stringify((() => {
    const body = document.getElementById('detailModalBody');
    const dts = Array.prototype.map.call(body.querySelectorAll('[data-role="info"] .detail-row dt'),
      function (el) { return el.textContent.trim(); });
    const card = body.querySelector('[data-role="co-slot"] [data-co-card]');
    const logCard = body.querySelector('[data-role="log"]');
    return {
      modalOpen: !!document.getElementById('detailModal') &&
                 document.getElementById('detailModal').classList.contains('show'),
      dts: dts,
      cardInSlot: !!card,
      cardsInSlot: body.querySelectorAll('[data-role="co-slot"] [data-co-card]').length,
      status: card && card.querySelector('[data-role="status"]')?.textContent.trim(),
      btnInVisible: (function () { var b = card && card.querySelector('[data-action="checkin"]'); return !!b && !b.hidden; })(),
      logShown: !!logCard && !logCard.hidden,
      logText: (logCard && logCard.querySelector('[data-role="log-text"]') || {}).textContent || '',
      fetches: window.__urls.slice(),
    };
  })())`));

  const forbidden = ['Check-In', 'Check-Out', 'Status'];
  const missing = ['Jumlah Tamu', 'Tanggal Kunjungan', 'Waktu Pendaftaran'].filter(function (l) {
    return s0.dts.indexOf(l) === -1;
  });
  const leaked = forbidden.filter(function (l) { return s0.dts.indexOf(l) !== -1; });

  check('Admin: modal terbuka dari parsial bersama', s0.modalOpen);
  check('Admin: bagian atas TANPA baris Check-In/Check-Out/Status', leaked.length === 0, JSON.stringify(s0.dts));
  check('Admin: Jumlah Tamu, Tanggal Kunjungan, Waktu Pendaftaran ada', missing.length === 0, JSON.stringify(missing));
  check('Admin: kartu dinamis ada di slot bawah (tepat 1)', s0.cardInSlot && s0.cardsInSlot === 1, 'cards=' + s0.cardsInSlot);
  check('Admin: kondisi awal "Belum Check-In" + tombol Check-In', s0.status === 'Belum Check-In' && s0.btnInVisible, s0.status);
  check('Admin: kartu log aktivitas tampil di modal', s0.logShown && !!s0.logText.trim(), s0.logText);

  // ================= KLIK CHECK-IN (real-time) =================
  await evl(`document.querySelector('#detailModalBody [data-role="co-slot"] [data-action="checkin"]').click();`);
  await sleep(2000);

  const s1 = JSON.parse(await evl(`JSON.stringify((() => {
    const body = document.getElementById('detailModalBody');
    const card = body.querySelector('[data-role="co-slot"] [data-co-card]');
    return {
      status: card.querySelector('[data-role="status"]')?.textContent.trim(),
      checkin: card.querySelector('[data-role="checkin"]')?.textContent.trim(),
      msg: card.querySelector('[data-role="msg"]')?.textContent.trim(),
      dts: Array.prototype.map.call(body.querySelectorAll('[data-role="info"] .detail-row dt'),
        function (el) { return el.textContent.trim(); }),
      fetches: window.__urls.slice(),
    };
  })())`));

  check('Admin Check-In: status "Berkunjung" + jam terisi real-time',
    s1.status === 'Berkunjung' && s1.checkin !== '—' && /\d{2}/.test(s1.checkin || ''), s1.status + ' / ' + s1.checkin);
  check('Admin Check-In: pesan sukses tampil', !!s1.msg, s1.msg);
  check('Admin Check-In: daftar atas tidak berubah (tetap tanpa 3 baris)',
    s1.dts.length === s0.dts.length && s1.dts.indexOf('Check-In') === -1, s1.dts.length + ' baris');
  check('Admin Check-In: semua fetch menuju URL ID asli',
    s1.fetches.length > 0 && s1.fetches.every(function (u) { return u.indexOf(':id') === -1; }), JSON.stringify(s1.fetches));

  // ===== BUKA ULANG MODAL — slot tidak boleh menumpuk =====
  await evl(`openDetailModal(${TAMU_ID})`);
  await sleep(700);
  const s2 = await evl(`document.querySelectorAll('#detailModalBody [data-role="co-slot"] [data-co-card]').length`);
  check('Admin: buka ulang modal -> kartu tidak menumpuk (tepat 1)', s2 === 1, 'cards=' + s2);

  // ================= KLIK CHECK-OUT =================
  await evl(`document.querySelector('#detailModalBody [data-role="co-slot"] [data-action="checkout"]').click();`);
  await sleep(2000);

  const s3 = JSON.parse(await evl(`JSON.stringify((() => {
    const card = document.querySelector('#detailModalBody [data-role="co-slot"] [data-co-card]');
    const bo = card.querySelector('[data-action="checkout"]');
    return {
      status: card.querySelector('[data-role="status"]')?.textContent.trim(),
      checkout: card.querySelector('[data-role="checkout"]')?.textContent.trim(),
      durasi: card.querySelector('[data-role="durasi"]')?.textContent.trim(),
      btnOutVisible: !!bo && !bo.hidden,
      doneVisible: !!card.querySelector('[data-role="done"]') && !card.querySelector('[data-role="done"]').hidden,
      msg: card.querySelector('[data-role="msg"]')?.textContent.trim(),
    };
  })())`));

  check('Admin Check-Out: kondisi "Selesai" (jam out + durasi + chip)',
    s3.status === 'Selesai' && s3.checkout !== '—' && !!s3.durasi && s3.durasi !== '—' && !s3.btnOutVisible && s3.doneVisible,
    s3.status + ' / ' + s3.checkout + ' / ' + s3.durasi);
  check('Admin Check-Out: pesan sukses tampil', !!s3.msg, s3.msg);

  const shot1 = await send('Page.captureScreenshot', { format: 'png' });
  const fs = await import('node:fs');
  fs.writeFileSync('storage/cdp-modal-detail-admin.png', Buffer.from(shot1.result.data, 'base64'));

  // ================= PORTAL KARYAWAN =================
  await send('Page.navigate', { url: BASE + '/admin/login' });
  await sleep(2500);
  await evl(`document.getElementById('email').value='opaladzmii@gmail.com';
    document.querySelector('input[type=password]').value='karyawan123';
    document.querySelector('form').submit();`);
  await sleep(3500);

  await send('Page.navigate', { url: BASE + '/karyawan/data-tamu' });
  await sleep(3000);

  const k0 = JSON.parse(await evl(`JSON.stringify((() => {
    if (typeof openDetailModal !== 'function') { return { ready: false, url: location.href }; }
    openDetailModal(${TAMU_ID});
    return { ready: true };
  })())`));
  await sleep(900);

  const k1 = JSON.parse(await evl(`JSON.stringify((() => {
    const body = document.getElementById('detailModalBody');
    if (!body) { return { ready: false }; }
    const dts = Array.prototype.map.call(body.querySelectorAll('[data-role="info"] .detail-row dt'),
      function (el) { return el.textContent.trim(); });
    const card = body.querySelector('[data-role="co-slot"] [data-co-card]');
    return {
      ready: true,
      dts: dts,
      cards: body.querySelectorAll('[data-role="co-slot"] [data-co-card]').length,
      status: card && card.querySelector('[data-role="status"]')?.textContent.trim(),
      logShown: !!(body.querySelector('[data-role="log"]') && !body.querySelector('[data-role="log"]').hidden),
      checkinUrl: card && card.querySelector('[data-action="checkin"]')?.dataset.url,
    };
  })())`));

  const kLeaked = ['Check-In', 'Check-Out', 'Status'].filter(function (l) { return (k1.dts || []).indexOf(l) !== -1; });
  check('Karyawan: halaman portal siap (openDetailModal ada)', k0.ready === true, JSON.stringify(k0));
  check('Karyawan: bagian atas TANPA baris Check-In/Check-Out/Status', k1.ready && kLeaked.length === 0, JSON.stringify(k1.dts));
  check('Karyawan: kartu kondisi "Selesai" tampil (tepat 1)', k1.cards === 1 && k1.status === 'Selesai', 'cards=' + k1.cards + ' status=' + k1.status);
  check('Karyawan: kartu log aktivitas tampil di modal', k1.logShown === true);
  check('Karyawan: URL aksi memakai route karyawan + ID asli',
    !!k1.checkinUrl && k1.checkinUrl.indexOf('/data-tamu/') !== -1 && k1.checkinUrl.indexOf(':id') === -1, k1.checkinUrl);

  const shot2 = await send('Page.captureScreenshot', { format: 'png' });
  fs.writeFileSync('storage/cdp-modal-detail-karyawan.png', Buffer.from(shot2.result.data, 'base64'));

  check('Tidak ada error JavaScript di console', consoleErrors.length === 0, consoleErrors.join(' | ').slice(0, 500));

  const failed = results.filter(r => !r.ok).length;
  console.log(`\nRingkasan: ${results.length - failed} PASS, ${failed} FAIL`);
  process.exit(failed ? 1 : 0);
}

main().catch((e) => { console.error('ERROR:', e); process.exit(1); });
