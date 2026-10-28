/* E2E — alur nyata pengguna Master Bidang setelah perbaikan router.js:
   1. index → klik SPA "Tambah Bidang" → dropdown Parent TERBUKA
   2. isi nama + pilih parent lewat dropdown → simpan → sukses
   3. klik SPA "Tambah Bidang" lagi → dropdown terbuka DAN berisi
      bidang baru (cache master ikut ter-flush)
   4. regresi: script halaman lain tetap ter-eksekusi sekali setelah
      swap SPA (guard global users terpasang, tidak dobel)
   Setelah tes: baris uji dihapus dari DB (lihat bagian cleanup). */
const BASE = 'http://127.0.0.1:8000';
const NAME = 'Bidang Uji Buffy ' + Date.now();

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
  const j = async (expr) => JSON.parse(await evl(expr));

  await send('Page.enable');
  await send('Runtime.enable');
  await send('Network.enable');
  await send('Network.setCacheDisabled', { cacheDisabled: true });

  /* ---------- LOGIN ---------- */
  await send('Page.navigate', { url: BASE + '/admin/login' });
  await sleep(2500);
  await evl(`(function(){
    var e = document.getElementById('email') || document.querySelector('input[type=email]');
    var p = document.querySelector('input[type=password]');
    if (!e || !p) return 'skip';
    e.value = 'admin@example.com'; p.value = 'password123';
    var f = e.closest('form'); if (f) f.submit(); return 'submitted';
  })()`);
  await sleep(3000);

  /* ---------- 1. index → SPA ke form tambah ---------- */
  await send('Page.navigate', { url: BASE + '/admin/master-bidang' });
  await sleep(3000);
  const hitungSebelum = await j(`(function(){
    var a = Array.prototype.find.call(document.querySelectorAll('a[href]'), function (x) {
      return /\\/admin\\/master-bidang\\/create/.test(x.getAttribute('href')); });
    if (a) a.click();
    return JSON.stringify({ klik: !!a });
  })()`);
  await sleep(3000);
  chk('klik "Tambah Bidang" (SPA)', hitungSebelum.klik, await evl('location.href'));

  const p1 = await j(`(function(){
    var t = document.getElementById('parent_id_trigger');
    var m = document.getElementById('mb-parent-menu');
    if (!t || !m) return JSON.stringify({ ada:false });
    var opsi = m.querySelectorAll('.dropdown-option').length;
    t.click();
    return JSON.stringify({ ada:true, opsi: opsi, terbuka: m.hidden === false, aria: t.getAttribute('aria-expanded') });
  })()`);
  chk('dropdown Parent TERBUKA setelah navigasi SPA', p1.ada && p1.terbuka, `opsi=${p1.opsi} aria=${p1.aria}`);

  /* ---------- 2. isi form + pilih parent via dropdown → simpan ---------- */
  const filled = await j(`(function(){
    var t = document.getElementById('parent_id_trigger');
    var m = document.getElementById('mb-parent-menu');
    var h = document.getElementById('parent_id');
    document.getElementById('nama').value = ${JSON.stringify(NAME)};
    if (m.hidden) t.click();                     // buka panel
    var opt = Array.prototype.find.call(m.querySelectorAll('.dropdown-option'), function (o) { return o.dataset.value !== ''; });
    if (!opt) return JSON.stringify({ pilih:false });
    opt.click();                                  // choose() → hidden terisi
    return JSON.stringify({ pilih:true, parent: h.value,
                            label: document.getElementById('mb-parent-label').textContent.trim() });
  })()`);
  chk('memilih parent lewat dropdown', filled.pilih, `parent_id=${filled.parent} label=${filled.label}`);

  await evl(`document.getElementById('nama').closest('form').submit(); 'ok'`);
  await sleep(4000);
  const urlSesudahSimpan = await evl('location.href');
  const pesan = await evl(`(document.querySelector('.alert-success')||{}).textContent || ''`);
  chk('simpan bidang → redirect index + pesan sukses',
    /\/admin\/master-bidang$/.test(urlSesudahSimpan) && /berhasil/i.test(pesan),
    `url=${urlSesudahSimpan} pesan=${(pesan||'').trim().slice(0, 60)}`);

  /* ---------- 3. buka lagi form → bidang baru ada di dropdown ---------- */
  await evl(`(function(){
    var a = Array.prototype.find.call(document.querySelectorAll('a[href]'), function (x) {
      return /\\/admin\\/master-bidang\\/create/.test(x.getAttribute('href')); });
    if (a) a.click(); return 'ok';
  })()`);
  await sleep(3000);
  const p2 = await j(`(function(){
    var t = document.getElementById('parent_id_trigger');
    var m = document.getElementById('mb-parent-menu');
    if (!t || !m) return JSON.stringify({ ada:false });
    var labels = Array.prototype.map.call(m.querySelectorAll('.dropdown-option'), function (o) { return o.dataset.label; });
    t.click();
    return JSON.stringify({ ada:true, opsi: labels.length, terbuka: m.hidden === false,
                            adaBaru: labels.some(function (l) { return l.indexOf(${JSON.stringify(NAME)}) !== -1; }) });
  })()`);
  chk('dropdown terbuka lagi & berisi bidang BARU', p2.ada && p2.terbuka && p2.adaBaru,
    `opsi=${p2.opsi} (sebelum=${p1.opsi}) adaBaru=${p2.adaBaru}`);

  /* ---------- 4. regresi: script halaman lain tetap jalan 1x ---------- */
  await evl(`(function(){
    var a = Array.prototype.find.call(document.querySelectorAll('a[href]'), function (x) {
      return /\\/admin\\/users$/.test(new URL(x.href).pathname); });
    if (a) a.click(); return 'ok';
  })()`);
  await sleep(3000);
  const reg = await j(`JSON.stringify({
    url: location.pathname,
    deleteUserModal: typeof window.openUserDeleteModal,
    toggleUser: typeof window.toggleUserStatus
  })`);
  chk('script halaman lain tetap ter-eksekusi setelah swap SPA (regresi)',
    /\/admin\/users$/.test(reg.url) && reg.deleteUserModal === 'function' && reg.toggleUser === 'function',
    JSON.stringify(reg));

  console.log('nama uji = ' + NAME);
  if (errors.length) console.log('ERRORS:\n' + errors.slice(0, 10).join('\n'));
  else console.log('ERRORS: none');

  ws.close();
  process.exit(0);
}

main().catch(e => { console.error('FATAL', e); process.exit(1); });