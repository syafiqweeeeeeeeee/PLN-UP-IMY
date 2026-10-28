/* Verifikasi UI: penghapusan Data Karyawan kini ikut menghapus akun
   pengguna terkait — diperiksa dari sisi yang dilihat user: teks dialog
   konfirmasi tombol Hapus di halaman daftar.

   TANPA mengirim form (tidak ada data yang dihapus). Yang diperiksa:
   C1 baris dengan akun terhubung → confirm menyebut akun & emailnya
   C2 baris tanpa akun terhubung → confirm tanpa kalimat akun
   C3 tidak ada error konsol
*/
const BASE = 'http://127.0.0.1:8000';
const LINKED_NID = process.env.LINKED_NID || '';
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
  await send('Network.enable');
  await send('Network.setCacheDisabled', { cacheDisabled: true });

  /* LOGIN */
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

  /* C1: baris dengan akun terhubung (NID dicari lewat filter pencarian). */
  await send('Page.navigate', { url: BASE + '/admin/data-karyawan?q=' + encodeURIComponent(LINKED_NID) });
  await sleep(3500);
  const c1 = await evl(`(function(){
    var baris = Array.prototype.filter.call(document.querySelectorAll('tbody tr'), function (tr) {
      return (tr.textContent || '').indexOf(${JSON.stringify(LINKED_NID)}) !== -1;
    });
    var f = baris.length ? baris[0].querySelector('form[onsubmit*="Hapus data karyawan"]') : null;
    return JSON.stringify({
      url: location.pathname + location.search,
      baris: baris.length,
      konfirmasi: f ? f.getAttribute('onsubmit') : ''
    });
  })()`);
  const c1j = JSON.parse(c1);
  chk('C1 baris dengan akun terhubung → dialog konfirmasi menyebut akun & email',
    c1j.baris >= 1 && c1j.konfirmasi.indexOf('juga ikut dihapus') !== -1 && c1j.konfirmasi.indexOf('@') !== -1, c1);
  console.log('    konfirmasi: ' + c1j.konfirmasi);

  /* C2: halaman daftar penuh — minimal satu baris tanpa akun (tanpa kalimat akun). */
  await send('Page.navigate', { url: BASE + '/admin/data-karyawan' });
  await sleep(3500);
  const c2 = await evl(`(function(){
    var all = Array.prototype.map.call(document.querySelectorAll('form'), function (f) {
      var a = f.getAttribute('action') || '';
      var o = f.getAttribute('onsubmit') || '';
      return (a.indexOf('/admin/data-karyawan/') !== -1 && o.indexOf('Hapus data karyawan') !== -1) ? o : null;
    }).filter(Boolean);
    return JSON.stringify({
      jumlah: all.length,
      denganAkun: all.filter(function (s) { return s.indexOf('juga ikut dihapus') !== -1; }).length,
      tanpaAkun: all.filter(function (s) { return s.indexOf('juga ikut dihapus') === -1; }).length,
      contoh: all[0] || ''
    });
  })()`);
  const c2j = JSON.parse(c2);
  chk('C2 ada dialog tanpa kalimat akun (karyawan tanpa akun terhubung) & form tidak dikirim',
    c2j.jumlah > 0 && c2j.tanpaAkun > 0, c2);
  console.log('    ringkasan dialog: ' + c2);

  /* C3: nol error konsol */
  chk('C3 nol error konsol/exception sepanjang alur', errors.length === 0, errors.slice(0, 5).join(' || '));

  console.log('DONE');
  ws.close();
  process.exit(0);
}

main().catch(e => { console.error('FATAL', e); process.exit(1); });
