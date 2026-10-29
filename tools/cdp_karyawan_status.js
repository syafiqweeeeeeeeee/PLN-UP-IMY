/* Verifikasi UI fitur STATUS KARYAWAN AKTIF / NONAKTIF di halaman
   Data Karyawan (browser sungguhan lewat CDP, BASE :8000).

   B1  tampilan default: hanya baris aktif, tombol "Karyawan Nonaktif",
       aksi baris "Nonaktifkan", tanpa tombol kembali.
   B2  klik "Karyawan Nonaktif" → URL ?status=nonaktif, filter form ikut
       membawa status, tombol "Kembali ke Karyawan Aktif" muncul.
   B3  klik kembali → tampilan default pulih.
   B4  Nonaktifkan baris pertama (confirm diterima CDP) → sukses, baris
       hilang dari daftar aktif, jumlah data berkurang 1.
   B5  daftar nonaktif memuat baris tersebut + aksi "Aktifkan Kembali".
   B6  Aktifkan Kembali → daftar tetap pada filter nonaktif (baris hilang
       dari daftar nonaktif), sukses.
   B7  kembali ke aktif → baris tampil lagi & jumlah pulih (data tidak
       pernah terhapus).
   B8  tidak ada error konsol. */
const BASE = 'http://127.0.0.1:8000';

function sleep(ms) { return new Promise(r => setTimeout(r, ms)); }
let fail = 0;
function chk(name, ok, extra) {
  console.log((ok ? 'PASS' : 'FAIL') + ' | ' + name + (extra ? ' | ' + extra : ''));
  if (!ok) fail++;
}

async function main() {
  const list = await (await fetch('http://127.0.0.1:9222/json/list')).json();
  const page = list.find(t => t.type === 'page');
  const ws = new WebSocket(page.webSocketDebuggerUrl);
  await new Promise((res, rej) => { ws.onopen = res; ws.onerror = rej; });

  let id = 0; const pend = new Map(); const errors = []; const dialogs = [];
  ws.onmessage = (ev) => {
    const m = JSON.parse(ev.data);
    if (m.id && pend.has(m.id)) { const r = pend.get(m.id); pend.delete(m.id); r(m); }
    else if (m.method === 'Runtime.consoleAPICalled' && m.params.type === 'error') {
      errors.push('CONSOLE: ' + m.params.args.map(a => a.value ?? a.description ?? '').join(' '));
    } else if (m.method === 'Runtime.exceptionThrown') {
      errors.push('EXC: ' + (m.params.exceptionDetails.exception?.description || m.params.exceptionDetails.text));
    } else if (m.method === 'Page.javascriptDialogOpening') {
      dialogs.push(m.params.message || '');
      send('Page.handleJavaScriptDialog', { accept: true });
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
  await sleep(3500);

  const snapshot = () => j(`JSON.stringify({
    url: location.pathname + location.search,
    totalAktif: document.querySelector('.dk-stat-card .stat-value') ? document.querySelector('.dk-stat-card .stat-value').textContent.trim() : null,
    statLabel: document.querySelector('.dk-stat-card .stat-label') ? document.querySelector('.dk-stat-card .stat-label').textContent.trim() : null,
    nids: Array.prototype.map.call(document.querySelectorAll('.dk-table tbody .dk-nid'), function (e) { return e.textContent.trim(); }),
    nonaktifBtn: !!document.querySelector('.dk-status-btn.nonaktif'),
    nonaktifText: (document.querySelector('.dk-status-btn.nonaktif') || {}).textContent || '',
    backBtn: !!document.querySelector('.dk-status-btn.back'),
    hiddenStatus: (document.querySelector('form.dk-filter-bar input[name=status]') || {}).value || null,
    deaktiv: document.querySelectorAll('.dk-action-btn[title="Nonaktifkan"]').length,
    aktiv: document.querySelectorAll('.dk-action-btn[title="Aktifkan Kembali"]').length,
    filterCount: (document.querySelector('.filter-count') || {}).textContent.trim().replace(/\\s+/g, ' '),
    alert: (document.querySelector('.alert-success') || {}).textContent || '',
    kosong: (document.querySelector('.dk-empty-state h6') || {}).textContent || ''
  })`);

  /* ---------- B1: tampilan default ---------- */
  await send('Page.navigate', { url: BASE + '/admin/data-karyawan' });
  await sleep(3500);
  const b1 = await snapshot();
  chk('B1 tampilan default: tombol "Karyawan Nonaktif" + tanpa tombol kembali',
    b1.nonaktifBtn && b1.nonaktifText.indexOf('Karyawan Nonaktif') !== -1 && !b1.backBtn && b1.hiddenStatus === null,
    JSON.stringify({ url: b1.url, hiddenStatus: b1.hiddenStatus }));
  chk('B1 baris aktif tampil + aksi Nonaktifkan tiap baris',
    b1.nids.length > 0 && b1.deaktiv === b1.nids.length && b1.aktiv === 0,
    'baris=' + b1.nids.length + ' nonaktifkan=' + b1.deaktiv);
  chk('B1 jumlah data mengikuti status aktif (' + b1.filterCount + ')',
    b1.statLabel === 'Total Karyawan Aktif' && b1.filterCount.indexOf('aktif') !== -1,
    b1.statLabel + ' / ' + b1.filterCount);

  /* ---------- B2: pindah ke daftar nonaktif ---------- */
  await evl(`document.querySelector('.dk-status-btn.nonaktif').click(); 'ok'`);
  await sleep(3000);
  const b2 = await snapshot();
  chk('B2 tabel beralih ke status nonaktif (URL + filter form)',
    b2.url.indexOf('status=nonaktif') !== -1 && b2.hiddenStatus === 'nonaktif',
    JSON.stringify({ url: b2.url, hiddenStatus: b2.hiddenStatus }));
  chk('B2 tombol "Kembali ke Karyawan Aktif" tersedia',
    b2.backBtn && b2.statLabel === 'Total Karyawan Nonaktif',
    b2.statLabel);

  /* ---------- B3: kembali ke default ---------- */
  await evl(`document.querySelector('.dk-status-btn.back').click(); 'ok'`);
  await sleep(3000);
  const b3 = await snapshot();
  chk('B3 kembali ke tampilan default (aktif)',
    b3.url.indexOf('status=') === -1 && b3.hiddenStatus === null && b3.nonaktifBtn && !b3.backBtn && b3.nids.length === b1.nids.length,
    JSON.stringify({ url: b3.url, baris: b3.nids.length, harap: b1.nids.length }));

  /* ---------- B4: Nonaktifkan baris pertama ---------- */
  const target = b1.nids[0];
  await evl(`(function(){
    var row = Array.prototype.find.call(document.querySelectorAll('.dk-table tbody tr'), function (tr) {
      var n = tr.querySelector('.dk-nid'); return n && n.textContent.trim() === ${JSON.stringify(target)};
    });
    var btn = row && row.querySelector('.dk-action-btn[title="Nonaktifkan"]');
    if (btn) btn.click();
    return btn ? 'clicked' : 'not-found';
  })()`);
  await sleep(3500);
  const b4 = await snapshot();
  chk('B4 konfirmasi Nonaktifkan diterima & sukses ditampilkan',
    dialogs.length === 1 && b4.alert.indexOf('berhasil dinonaktifkan') !== -1,
    JSON.stringify({ dialog: dialogs.slice(0, 1), alert: b4.alert.trim().slice(0, 90) }));
  chk('B4 baris ' + target + ' hilang dari daftar aktif & jumlah data berkurang 1',
    b4.nids.indexOf(target) === -1 && b4.nids.length > 0 &&
    Number(b4.totalAktif) === Number(b1.totalAktif) - 1,
    JSON.stringify({ sebelum: b1.nids.length, sesudah: b4.nids.length, total: b4.totalAktif + ' (harap ' + (Number(b1.totalAktif) - 1) + ')' }));

  /* ---------- B5: daftar nonaktif memuat baris tersebut ---------- */
  await evl(`document.querySelector('.dk-status-btn.nonaktif').click(); 'ok'`);
  await sleep(3000);
  const b5 = await snapshot();
  chk('B5 baris nonaktif tampil di daftar Nonaktif + aksi Aktifkan Kembali',
    b5.nids.indexOf(target) !== -1 && b5.aktiv >= 1 && b5.deaktiv === 0 && b5.hiddenStatus === 'nonaktif',
    JSON.stringify({ nids: b5.nids, aktiv: b5.aktiv }));

  /* ---------- B6: Aktifkan Kembali ---------- */
  await evl(`(function(){
    var row = Array.prototype.find.call(document.querySelectorAll('.dk-table tbody tr'), function (tr) {
      var n = tr.querySelector('.dk-nid'); return n && n.textContent.trim() === ${JSON.stringify(target)};
    });
    var btn = row && row.querySelector('.dk-action-btn[title="Aktifkan Kembali"]');
    if (btn) btn.click();
    return btn ? 'clicked' : 'not-found';
  })()`);
  await sleep(3500);
  const b6 = await snapshot();
  chk('B6 konfirmasi Aktifkan Kembali diterima & sukses ditampilkan',
    dialogs.length === 2 && b6.alert.indexOf('berhasil diaktifkan kembali') !== -1,
    JSON.stringify({ dialogs: dialogs.length, alert: b6.alert.trim().slice(0, 90) }));
  chk('B6 daftar tetap pada filter nonaktif (baris pindah, filter dipertahankan)',
    b6.url.indexOf('status=nonaktif') !== -1 && b6.hiddenStatus === 'nonaktif' && b6.nids.indexOf(target) === -1,
    JSON.stringify({ url: b6.url, nids: b6.nids }));

  /* ---------- B7: baris kembali ke daftar aktif ---------- */
  await evl(`document.querySelector('.dk-status-btn.back').click(); 'ok'`);
  await sleep(3000);
  const b7 = await snapshot();
  chk('B7 baris ' + target + ' kembali tampil & jumlah pulih (data tidak terhapus)',
    b7.nids.indexOf(target) !== -1 && b7.nids.length === b1.nids.length &&
    b7.totalAktif === b1.totalAktif && b7.deaktiv === b7.nids.length,
    JSON.stringify({ baris: b7.nids.length, total: b7.totalAktif, harap: b1.totalAktif }));

  /* ---------- B8: tidak ada error ---------- */
  chk('B8 tidak ada error konsol/exception', errors.length === 0, errors.slice(0, 5).join(' ~ '));

  console.log('\nRingkasan dialog konfirmasi: ' + JSON.stringify(dialogs));
  console.log(fail === 0 ? '\nSEMUA PEMERIKSAAN LULUS' : '\n' + fail + ' PEMERIKSAAN GAGAL');
  ws.close();
  process.exit(fail === 0 ? 0 : 1);
}

main().catch(e => { console.error('FATAL', e); process.exit(1); });
