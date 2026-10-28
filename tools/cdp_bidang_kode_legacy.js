/* Verifikasi UI dua perubahan terkait Master Bidang:
   (1) Form Link Kerja — panel kategori "Khusus" menampilkan SEMUA baris
       Master Bidang (sebelum fix: 0 opsi karena filter kode legacy).
   (2) Master Bidang — field Kode Legacy di form + tombol "Petakan Kode
       Legacy" (pratinjau GET JSON, TANPA menekan Terapkan).

   Yang diperiksa:
   A1 radio Khusus → panel terbuka & opsi bidang > 0 ( == jumlah baris
      `bidangs` di DB, dikirim lewat env EXPECTED_BIDANGS)
   A2 memilih opsi → value select terisi
   B1 tombol + modal Petakan Kode Legacy ada (permission master_bidang.edit)
   B2 klik → modal terbuka + pratinjau JSON termuat
   B3 form POST punya CSRF & action benar (TIDAK disubmit)
   B4 putaran SPA → script tetap hidup (regresi router.js)
   B5 form Master Bidang punya field department_code / sub_department_code
   X  tidak ada error konsol/exception sepanjang alur
*/
const BASE = 'http://127.0.0.1:8000';
const EXPECTED = Number(process.env.EXPECTED_BIDANGS || '0');
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

  /* ========== A: FORM LINK KERJA — DROPDOWN BIDANG ========== */
  await send('Page.navigate', { url: BASE + '/admin/work-links/create' });
  await sleep(3500);

  const a0 = await j(`JSON.stringify({
    url: location.pathname,
    form: !!document.getElementById('workLinkForm'),
    khusus: !!document.getElementById('cat-khusus')
  })`);
  chk('A0 halaman Tambah Link Kerja termuat', a0.url === '/admin/work-links/create' && a0.form && a0.khusus, JSON.stringify(a0));

  await evl(`(function(){ var r = document.getElementById('cat-khusus'); r.checked = true;
    r.dispatchEvent(new Event('change', { bubbles: true })); return 'ok'; })()`);
  await sleep(600);

  const a1 = await evl(`(function(){
    var panel = document.getElementById('targetKhususPanel');
    var sel = document.getElementById('bidang_id');
    var opts = sel ? Array.prototype.filter.call(sel.options, function (o) { return o.value !== ''; }) : [];
    return JSON.stringify({
      panelTerbuka: !!panel && !panel.classList.contains('hidden-panel'),
      jumlahOpsi: opts.length,
      contoh: opts.slice(0, 4).map(function (o) { return o.textContent.trim(); })
    });
  })()`);
  const a1j = JSON.parse(a1);
  chk('A1 panel Khusus terbuka & opsi bidang tampil == jumlah baris DB (' + EXPECTED + ')',
    a1j.panelTerbuka && a1j.jumlahOpsi === EXPECTED && a1j.jumlahOpsi > 0, a1);

  const a2 = await evl(`(function(){
    var sel = document.getElementById('bidang_id');
    var opt = Array.prototype.find.call(sel.options, function (o) { return o.value !== ''; });
    if (!opt) return 'NO-OPTION';
    sel.value = opt.value;
    sel.dispatchEvent(new Event('change', { bubbles: true }));
    return sel.value;
  })()`);
  chk('A2 memilih opsi mengisi value select', a2 !== 'NO-OPTION' && a2 !== '' && a2 !== undefined, String(a2));

  // Tutup panel custom dropdown (kalau terbuka) sebelum pindah halaman.
  await evl(`document.dispatchEvent(new KeyboardEvent('keydown', { key: 'Escape', bubbles: true })); 'ok'`);

  /* ========== B: MASTER BIDANG — FIELD KODE + TOMBOL PETAKAN ========== */
  await send('Page.navigate', { url: BASE + '/admin/master-bidang' });
  await sleep(3500);

  const b1 = await j(`JSON.stringify({
    url: location.pathname,
    tombol: !!document.getElementById('mbMapLegacyBtn'),
    modal: !!document.getElementById('mbMapLegacyModal')
  })`);
  chk('B1 tombol + modal "Petakan Kode Legacy" tersedia', b1.url === '/admin/master-bidang' && b1.tombol && b1.modal, JSON.stringify(b1));

  await evl(`document.getElementById('mbMapLegacyBtn').click(); 'ok'`);
  await sleep(2500);

  const b2 = await evl(`JSON.stringify({
    terbuka: document.getElementById('mbMapLegacyModal').classList.contains('show'),
    masihMemuat: document.getElementById('mbMapLegacyPreview').textContent.indexOf('Memuat pratinjau') !== -1,
    items: Array.prototype.map.call(document.querySelectorAll('#mbMapLegacyPreview .mb-summary-item'), function (el) {
      return (el.querySelector('b') ? el.querySelector('b').textContent : '?') + '=' +
             (el.querySelector('small') ? el.querySelector('small').textContent : '');
    }),
    daftar: document.getElementById('mbMapLegacyLists').textContent.trim().slice(0, 200),
    catatan: document.getElementById('mbMapLegacyNote').textContent.trim().slice(0, 220)
  })`);
  const b2j = JSON.parse(b2);
  const ambil = (k) => {
    const row = (b2j.items.find(s => s.indexOf(k) !== -1) || '');
    return Number(row.split('=')[0]);
  };
  chk('B2 modal terbuka + pratinjau JSON termuat (bukan placeholder)',
    b2j.terbuka && !b2j.masihMemuat && b2j.items.length >= 4 && ambil('Baris Akan Diperbarui') > 0, b2);
  console.log('    pratinjau: ' + b2j.items.join(' | '));
  console.log('    daftar: ' + b2j.daftar);
  console.log('    catatan: ' + b2j.catatan);

  const b3 = await evl(`(function(){
    var f = document.querySelector('#mbMapLegacyModal form');
    if (!f) return JSON.stringify({ ada: false });
    var t = f.querySelector('input[name=_token]');
    return JSON.stringify({ ada: true, action: f.getAttribute('action'), method: f.getAttribute('method'),
                            token: t ? t.value.length : 0, tombol: !!f.querySelector('button[type=submit]') });
  })()`);
  const b3j = JSON.parse(b3);
  chk('B3 form POST + CSRF siap (TIDAK disubmit)',
    b3j.ada && b3j.method === 'POST' && String(b3j.action).endsWith('/admin/master-bidang/map-legacy-codes') && b3j.token > 0 && b3j.tombol, b3);

  await evl(`document.getElementById('mbMapLegacyModal').classList.remove('show'); 'ok'`);

  /* ---------- B4: putaran SPA — pindah halaman lalu kembali ---------- */
  await evl(`(function(){
    var a = Array.prototype.find.call(document.querySelectorAll('.sidebar-nav a[href]'), function (x) {
      return (x.getAttribute('href') || '').indexOf('/admin/data-karyawan') !== -1;
    });
    if (a) { a.click(); return 'nav'; }
    location.href = '/admin/data-karyawan'; return 'goto';
  })()`);
  await sleep(3000);
  const spa1 = await evl(`location.pathname`);
  await evl(`(function(){
    var a = Array.prototype.find.call(document.querySelectorAll('.sidebar-nav a[href]'), function (x) {
      return (x.getAttribute('href') || '').indexOf('/admin/master-bidang') !== -1;
    });
    if (a) { a.click(); return 'nav'; }
    location.href = '/admin/master-bidang'; return 'goto';
  })()`);
  await sleep(3000);
  await evl(`document.getElementById('mbMapLegacyBtn').click(); 'ok'`);
  await sleep(2500);
  const b4 = await evl(`JSON.stringify({
    url: location.pathname,
    terbuka: document.getElementById('mbMapLegacyModal')?.classList.contains('show'),
    belumMemuat: document.getElementById('mbMapLegacyPreview')?.textContent.indexOf('Memuat pratinjau') !== -1,
    angka: (document.querySelector('#mbMapLegacyPreview .mb-summary-item b') || {}).textContent || ''
  })`);
  const b4j = JSON.parse(b4);
  chk('B4 setelah putaran SPA tombol+modal+pratinjau tetap berfungsi',
    spa1 === '/admin/data-karyawan' && b4j.url === '/admin/master-bidang' && b4j.terbuka && !b4j.belumMemuat && Number(b4j.angka) > 0, b4);
  await evl(`document.getElementById('mbMapLegacyModal').classList.remove('show'); 'ok'`);

  /* ---------- B5: form Master Bidang punya field kode legacy ---------- */
  await send('Page.navigate', { url: BASE + '/admin/master-bidang/create' });
  await sleep(3500);
  const b5 = await evl(`(function(){
    var sel = document.getElementById('department_code');
    var inp = document.getElementById('sub_department_code');
    var dl  = document.getElementById('mb-sub-code-options');
    return JSON.stringify({
      url: location.pathname,
      select: !!sel,
      opsiSelect: sel ? sel.options.length : 0,
      adaKosong: sel ? sel.options[0].value === '' : false,
      input: !!inp,
      opsiDatalist: dl ? dl.options.length : 0,
      judul: document.body.innerHTML.indexOf('Kode Legacy (Pemetaan Scoping)') !== -1
    });
  })()`);
  const b5j = JSON.parse(b5);
  chk('B5 form Master Bidang menampilkan field kode legacy (select + datalist)',
    b5j.url === '/admin/master-bidang/create' && b5j.select && b5j.opsiSelect > 1 && b5j.adaKosong &&
    b5j.input && b5j.opsiDatalist > 0 && b5j.judul, b5);

  /* ---------- X: tidak ada error konsol ---------- */
  chk('X nol error konsol/exception sepanjang alur', errors.length === 0, errors.slice(0, 5).join(' || '));

  console.log('DONE');
  ws.close();
  process.exit(0);
}

main().catch(e => { console.error('FATAL', e); process.exit(1); });
