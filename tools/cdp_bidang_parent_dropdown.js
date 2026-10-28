/* DIAGNOSIS: dropdown "Parent (Induk Bidang)" di form Master Bidang.
   - FULL load  → klik trigger: apakah panel terbuka? berapa listener click?
   - SPA nav    → klik "Tambah Bidang" dari index (router.js): hal yang sama?
   Tujuan: membuktikan apakah script halaman dieksekusi 0 / 1 / 2 kali
   oleh reexecuteScripts() di public/js/router.js. */
const BASE = 'http://127.0.0.1:8000';

function sleep(ms) { return new Promise(r => setTimeout(r, ms)); }

async function main() {
  const list = await (await fetch('http://127.0.0.1:9222/json/list')).json();
  const page = list.find(t => t.type === 'page');
  const ws = new WebSocket(page.webSocketDebuggerUrl);
  await new Promise((res, rej) => { ws.onopen = res; ws.onerror = rej; });
  let id = 0; const pend = new Map(); const errors = [];
  ws.onmessage = (ev) => {
    const m = JSON.parse(ev.data);
    if (m.id && pend.has(m.id)) { const r = pend.get(m.id); pend.delete(m.id); r(m); }
    else if (m.method === 'Runtime.exceptionThrown') {
      errors.push('EXC: ' + (m.params.exceptionDetails.exception?.description || m.params.exceptionDetails.text));
    } else if (m.method === 'Runtime.consoleAPICalled' && m.params.type === 'error') {
      errors.push('CONSOLE: ' + m.params.args.map(a => a.value ?? a.description ?? '').join(' '));
    }
  };
  const send = (method, params = {}) => new Promise(res => {
    const mid = ++id;
    ws.send(JSON.stringify({ id: mid, method, params }));
    pend.set(mid, res);
  });
  const evl = async (expr) => {
    const r = await send('Runtime.evaluate', { expression: expr, returnByValue: true });
    if (r.result?.exceptionDetails) return 'THROWS: ' + (r.result.exceptionDetails.exception?.description || r.result.exceptionDetails.text);
    return r.result.result?.value;
  };
  const chk = (n, ok, extra) => console.log((ok ? 'PASS' : 'FAIL') + ' | ' + n + (extra ? ' | ' + extra : ''));

  await send('Page.enable');
  await send('Runtime.enable');
  try { await send('DOMDebugger.enable'); } catch (e) { /* opsional */ }
  // Pastikan router.js versi TERBARU dipakai (buang cache browser).
  await send('Network.enable');
  await send('Network.setCacheDisabled', { cacheDisabled: true });

  async function clickListenerCount() {
    const r = await send('Runtime.evaluate', { expression: `document.getElementById('parent_id_trigger')` });
    const obj = r.result?.result?.objectId;
    if (!obj) return -1;
    const l = await send('DOMDebugger.getEventListeners', { objectId: obj });
    const arr = l.result?.result || [];
    return arr.filter(x => x.type === 'click').length;
  }

  async function openProbe(label) {
    const before = await evl(`document.getElementById('mb-parent-menu') ? document.getElementById('mb-parent-menu').hidden : 'NO_MENU'`);
    await evl(`document.getElementById('parent_id_trigger').click(); 'ok'`);
    await sleep(400);
    const after = await evl(`document.getElementById('mb-parent-menu') ? document.getElementById('mb-parent-menu').hidden : 'NO_MENU'`);
    const n = await clickListenerCount();
    console.log(`[${label}] menu.hidden sebelum=${before} sesudah klik=${after} | listener click pada trigger=${n}`);
    chk(`${label}: panel terbuka setelah 1 klik`, after === false, `hidden=${after}, listeners=${n}`);
    // tutup lagi bila terbuka
    if (after === false) { await evl(`document.getElementById('mb-parent-menu').hidden = true; 'ok'`); }
  }

  /* ---------- LOGIN ---------- */
  await send('Page.navigate', { url: BASE + '/admin/login' });
  await sleep(2500);
  await evl(`(function(){
    var e = document.getElementById('email') || document.querySelector('input[type=email]');
    var p = document.querySelector('input[type=password]');
    if (!e || !p) return 'no-form';
    e.value = 'admin@example.com'; p.value = 'password123';
    var f = e.closest('form'); if (f) f.submit(); return 'submitted';
  })()`);
  await sleep(3000);
  console.log('url sesudah login =', await evl('location.href'));

  /* ---------- A) FULL LOAD: form tambah bidang ---------- */
  await send('Page.navigate', { url: BASE + '/admin/master-bidang/create' });
  await sleep(3000);
  console.log('A url =', await evl('location.href'));
  await openProbe('A. FULL load');

  /* ---------- B) dari index → klik SPA "Tambah Bidang" ---------- */
  await send('Page.navigate', { url: BASE + '/admin/master-bidang' });
  await sleep(3000);
  console.log('B url (index) =', await evl('location.href'));
  const clicked = await evl(`(function(){
    var a = Array.prototype.find.call(document.querySelectorAll('a[href]'), function (x) {
      return /\\/admin\\/master-bidang\\/create/.test(x.getAttribute('href'));
    });
    if (!a) return 'no-link';
    a.click(); return 'clicked';
  })()`);
  console.log('klik link create =', clicked);
  await sleep(3000);
  console.log('B url (sesudah klik) =', await evl('location.href'));
  console.log('B ada menu? =', await evl(`!!document.getElementById('mb-parent-menu')`));
  await openProbe('B. SPA nav');

  /* ---------- C) reload halaman create (perilaku "refresh") ---------- */
  await send('Page.navigate', { url: BASE + '/admin/master-bidang/create' });
  await sleep(3000);
  await openProbe('C. reload lagi');

  if (errors.length) console.log('ERRORS:\n' + errors.slice(0, 10).join('\n'));
  else console.log('ERRORS: none');

  ws.close();
  process.exit(0);
}

main().catch(e => { console.error('FATAL', e); process.exit(1); });
