/* Verifikasi UI fitur "Petakan ke Master" di halaman Data Karyawan.
   TANPA menekan tombol Terapkan — data tidak ditulis. Yang diperiksa:
   B1 tombol ada (permission edit)
   B2 klik → modal terbuka
   B3 pratinjau JSON termuat & angkanya masuk akal
   B4 form POST punya CSRF & action benar
   B5 putaran SPA (pindah halaman → kembali) → script tetap hidup,
      modal & pratinjau tetap berfungsi (regresi router.js)
   B6 tidak ada error konsol */
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

  /* ---------- B1: halaman daftar + tombol ---------- */
  await send('Page.navigate', { url: BASE + '/admin/data-karyawan' });
  await sleep(3500);
  const b1 = await j(`JSON.stringify({
    url: location.pathname,
    tombol: !!document.getElementById('dkMapMasterBtn'),
    modal: !!document.getElementById('mapMasterModal'),
    ringkasan: !!document.querySelector('h6') && document.body.innerHTML.indexOf('Ringkasan Pemetaan ke Master') !== -1
  })`);
  chk('B1 tombol + modal tersedia di halaman Data Karyawan',
    b1.url === '/admin/data-karyawan' && b1.tombol && b1.modal, JSON.stringify(b1));

  /* ---------- B2 + B3: klik → modal + pratinjau ---------- */
  await evl(`document.getElementById('dkMapMasterBtn').click(); 'ok'`);
  await sleep(2500);
  const b2 = await j(`JSON.stringify({
    terbuka: document.getElementById('mapMasterModal').classList.contains('show'),
    masihMemuat: document.getElementById('dkMapMasterPreview').textContent.indexOf('Memuat pratinjau') !== -1,
    items: Array.prototype.map.call(document.querySelectorAll('#dkMapMasterPreview .dk-summary-item'), function (el) {
      return (el.querySelector('b') ? el.querySelector('b').textContent : '?') + '=' +
             (el.querySelector('small') ? el.querySelector('small').textContent : '');
    }),
    catatan: document.getElementById('dkMapMasterNotes').textContent.trim().slice(0, 160)
  })`);
  const total = (b2.items.find(s => s.indexOf('Total Karyawan') !== -1) || '').split('=')[0];
  chk('B2 modal terbuka', b2.terbuka, JSON.stringify(b2.terbuka));
  chk('B3 pratinjau termuat (bukan placeholder) + angka masuk akal',
    !b2.masihMemuat && b2.items.length >= 5 && Number(total) > 0,
    b2.items.join(' | '));
  console.log('    catatan pratinjau: ' + b2.catatan);

  /* ---------- B4: form POST + CSRF (TANPA submit) ---------- */
  const b4 = await j(`(function(){
    var f = document.querySelector('#mapMasterModal form');
    if (!f) return JSON.stringify({ ada:false });
    var t = f.querySelector('input[name=_token]');
    return JSON.stringify({ ada:true, action: f.getAttribute('action'),
                            method: f.getAttribute('method'),
                            token: t ? t.value.length : 0,
                            tombol: !!f.querySelector('button[type=submit]') });
  })()`);
  const f4 = b4; // j() sudah JSON.parse
  chk('B4 form POST + token CSRF siap (TIDAK disubmit)',
    f4.ada && f4.method === 'POST' && String(f4.action).endsWith('/admin/data-karyawan/map-master') && f4.token > 0 && f4.tombol,
    JSON.stringify(f4));

  // Tutup modal tanpa submit.
  await evl(`document.getElementById('mapMasterModal').classList.remove('show'); 'ok'`);

  /* ---------- B5: putaran SPA — pindah halaman lalu kembali ---------- */
  await evl(`(function(){
    var a = Array.prototype.find.call(document.querySelectorAll('.sidebar-nav a[href]'), function (x) {
      return /\\/admin\\/master-bidang$/.test(new URL(x.href).pathname); });
    if (a) a.click(); return 'ok';
  })()`);
  await sleep(3000);
  const url1 = await evl('location.pathname');
  await evl(`(function(){
    var a = Array.prototype.find.call(document.querySelectorAll('.sidebar-nav a[href]'), function (x) {
      return /\\/admin\\/data-karyawan$/.test(new URL(x.href).pathname); });
    if (a) a.click(); return 'ok';
  })()`);
  await sleep(3000);
  await evl(`(function(){ var b = document.getElementById('dkMapMasterBtn'); if (b) b.click(); return 'ok'; })()`);
  await sleep(2500);
  const b5 = await j(`JSON.stringify({
    url: location.pathname,
    pindah: ${JSON.stringify(url1)},
    terbuka: document.getElementById('mapMasterModal') ? document.getElementById('mapMasterModal').classList.contains('show') : false,
    items: document.querySelectorAll('#dkMapMasterPreview .dk-summary-item').length,
    memuat: document.getElementById('dkMapMasterPreview').textContent.indexOf('Memuat pratinjau') !== -1
  })`);
  chk('B5 tetap berfungsi setelah putaran SPA (router.js)',
    b5.pindah === '/admin/master-bidang' && b5.url === '/admin/data-karyawan' && b5.terbuka && b5.items >= 5 && !b5.memuat,
    JSON.stringify(b5));

  await evl(`document.getElementById('mapMasterModal').classList.remove('show'); 'ok'`);

  /* ---------- B6: tidak ada error ---------- */
  chk('B6 tidak ada error konsol/exception', errors.length === 0, errors.slice(0, 5).join(' ~ '));

  const after = await evl(`JSON.stringify({ dipetakan: document.querySelectorAll('.dk-summary-grid').length })`);
  console.log('state akhir (tanpa submit): ' + after);

  ws.close();
  process.exit(0);
}

main().catch(e => { console.error('FATAL', e); process.exit(1); });