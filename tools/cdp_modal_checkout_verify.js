/* CDP VERIFY — Regresi bug ":id" pada kartu check-in/out modal Detail.

   Bug asli: kartu template di-clone ke modal Detail, tetapi URL pada
   TOMBOL (data-url) masih memuat placeholder ':id' -> server melempar
   "No query results for model [App\Models\Tamu] :id".

   Diverifikasi di browser sungguhan (app :8000):
   1. Clone modal memakai URL ID asli (tanpa ':id').
   2. Klik Check-In & Check-Out di modal -> sukses, real-time, tanpa
      request yang mengandung ':id'.
   3. Kartu template tanpa ID -> ditahan di client dengan pesan ramah,
      TANPA request sama sekali.
   4. Request server langsung ke '/admin/tamu/:id/checkout' (JSON)
      -> 404 { ok:false } yang ramah, bukan exception 500/404 HTML. */

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

  // ---------- LOGIN ----------
  await send('Page.navigate', { url: BASE + '/admin/login' });
  await sleep(2500);
  await evl(`document.getElementById('email').value='admin@example.com';
    document.querySelector('input[type=password]').value='password123';
    document.querySelector('form').submit();`);
  await sleep(3500);

  // ---------- HALAMAN DAFTAR + MODAL DETAIL ----------
  await send('Page.navigate', { url: BASE + '/admin/tamu' });
  await sleep(3000);

  // Rekam semua URL fetch sebelum modal dibuka.
  await evl(`window.__urls = [];
    if (!window.__fetchWrapped) {
      window.__fetchWrapped = true;
      const orig = window.fetch;
      window.fetch = function (u, o) { window.__urls.push(String(u)); return orig.apply(this, arguments); };
    }
    'ok'`);

  await evl(`openDetailModal(${TAMU_ID})`);
  await sleep(1000);

  const st0 = JSON.parse(await evl(`JSON.stringify((() => {
    const c = document.querySelector('#detailModalBody [data-co-card]');
    const bi = c && c.querySelector('[data-action="checkin"]');
    const bo = c && c.querySelector('[data-action="checkout"]');
    return {
      card: !!c,
      urlIn: bi ? bi.dataset.url : null,
      urlOut: bo ? bo.dataset.url : null,
      status: c && c.querySelector('[data-role="status"]')?.textContent.trim(),
      checkin: c && c.querySelector('[data-role="checkin"]')?.textContent.trim(),
    };
  })())`));

  check('Modal: kartu check-in/out ikut ter-clone', st0.card);
  check('Modal: URL tombol TIDAK memuat placeholder :id',
    !!st0.urlOut && st0.urlOut.indexOf(':id') === -1, st0.urlOut);
  check('Modal: URL tombol memakai ID asli tamu',
    !!st0.urlOut && st0.urlOut.indexOf('/' + TAMU_ID + '/') !== -1, st0.urlOut);

  // ---------- KLIK CHECK-IN di modal ----------
  await evl(`document.querySelector('#detailModalBody [data-action="checkin"]').click();`);
  await sleep(2000);

  const st1 = JSON.parse(await evl(`JSON.stringify((() => {
    const c = document.querySelector('#detailModalBody [data-co-card]');
    return {
      status: c.querySelector('[data-role="status"]')?.textContent.trim(),
      checkin: c.querySelector('[data-role="checkin"]')?.textContent.trim(),
      msg: c.querySelector('[data-role="msg"]')?.textContent.trim(),
      msgHidden: c.querySelector('[data-role="msg"]')?.hidden,
      urls: window.__urls.slice(),
    };
  })())`));

  check('Modal Check-In: status menjadi Berkunjung', st1.status === 'Berkunjung', st1.status);
  check('Modal Check-In: jam terisi real-time', st1.checkin !== '—' && /\d{2}/.test(st1.checkin || ''), st1.checkin);
  check('Modal Check-In: pesan sukses tampil', !st1.msgHidden && !!st1.msg, st1.msg);
  check('Modal Check-In: TIDAK ada request mengandung :id',
    st1.urls.every(u => u.indexOf(':id') === -1), JSON.stringify(st1.urls));

  // ---------- KLIK CHECK-OUT di modal ----------
  await evl(`document.querySelector('#detailModalBody [data-action="checkout"]').click();`);
  await sleep(2000);

  const st2 = JSON.parse(await evl(`JSON.stringify((() => {
    const c = document.querySelector('#detailModalBody [data-co-card]');
    const bo = c.querySelector('[data-action="checkout"]');
    return {
      status: c.querySelector('[data-role="status"]')?.textContent.trim(),
      checkout: c.querySelector('[data-role="checkout"]')?.textContent.trim(),
      doneVisible: !!c.querySelector('[data-role="done"]') && !c.querySelector('[data-role="done"]').hidden,
      btnOutVisible: !!bo && !bo.hidden,
      msg: c.querySelector('[data-role="msg"]')?.textContent.trim(),
      urls: window.__urls.slice(),
    };
  })())`));

  check('Modal Check-Out: status menjadi Selesai', st2.status === 'Selesai', st2.status);
  check('Modal Check-Out: jam check-out terisi real-time', st2.checkout !== '—' && /\d{2}/.test(st2.checkout || ''), st2.checkout);
  check('Modal Check-Out: tombol hilang, chip selesai tampil', !st2.btnOutVisible && st2.doneVisible);
  check('Modal Check-Out: pesan sukses tampil', !!st2.msg, st2.msg);
  check('Modal Check-Out: TIDAK ada request mengandung :id',
    st2.urls.every(u => u.indexOf(':id') === -1), JSON.stringify(st2.urls));

  // ---------- GARIS PERTAHANAN 1: kartu template TANPA id ----------
  const guard1 = JSON.parse(await evl(`(async () => {
    const before = window.__urls.length;
    const tpl = document.getElementById('coTemplate').querySelector('[data-co-card]');
    const c = tpl.cloneNode(true);
    c.hidden = false;               // sengaja TANPA data-id (ID hilang)
    document.body.appendChild(c);
    c.querySelector('[data-action="checkout"]').click();
    await new Promise(r => setTimeout(r, 600));
    const msg = c.querySelector('[data-role="msg"]');
    const out = { msg: msg ? msg.textContent : '', hidden: msg ? msg.hidden : null,
                  urls: window.__urls.length - before };
    c.remove();
    return JSON.stringify(out);
  })()`));

  check('Guard client: pesan ramah "Data tamu tidak ditemukan..."',
    guard1.msg === 'Data tamu tidak ditemukan atau ID tidak valid.' && guard1.hidden === false, guard1.msg);
  check('Guard client: TIDAK ada request dikirim sama sekali', guard1.urls === 0, 'requests=' + guard1.urls);

  // ---------- GARIS PERTAHANAN 2: server menerima literal ':id' ----------
  const guard2 = JSON.parse(await evl(`(async () => {
    const res = await fetch('/admin/tamu/:id/checkout', {
      method: 'PATCH',
      headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest',
                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
    });
    const body = await res.json().catch(() => ({}));
    return JSON.stringify({ status: res.status, ok: body.ok, message: body.message });
  })()`));

  check('Guard server: literal :id dibalas 404 JSON ramah (bukan 500)',
    guard2.status === 404 && guard2.ok === false && !!guard2.message, guard2.message);

  // ---------- SCREENSHOT ----------
  const shot = await send('Page.captureScreenshot', { format: 'png' });
  const fs = await import('node:fs');
  fs.writeFileSync('storage/cdp-modal-checkout-verify.png', Buffer.from(shot.result.data, 'base64'));
  console.log('Screenshot -> storage/cdp-modal-checkout-verify.png');

  check('Tidak ada error JavaScript di console', consoleErrors.length === 0, consoleErrors.join(' | ').slice(0, 400));

  const failed = results.filter(r => !r.ok).length;
  console.log(`\nRingkasan: ${results.length - failed} PASS, ${failed} FAIL`);
  process.exit(failed ? 1 : 0);
}

main().catch((e) => { console.error('ERROR:', e); process.exit(1); });
