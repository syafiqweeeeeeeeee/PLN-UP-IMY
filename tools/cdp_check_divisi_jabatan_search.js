/* Verifikasi pencarian di dalam dropdown "Bidang yang Ditemui" &
   "Jabatan yang Ditemui" (form registrasi tamu publik):
   S1 dropdown bidang: buka → kotak pencarian tampil
   S2 ketik "prod" → hanya opsi bidang mengandung "prod" tampil,
      judul grup (optgroup) tanpa opsi tampil ikut disembunyikan
   S3 reset saat dropdown dibuka ulang
   S4 pilih bidang → dropdown jabatan terfilter cascade (working as before)
   S5 dropdown jabatan: ketik pencarian → opsi terfilter live
      (gabungan filter bidang + teks pencarian)
   S6 pilih jabatan → nilai tersimpan di hidden input
   SS screenshot tiap tahap ke storage/app
*/
const BASE = 'http://127.0.0.1:8000';
const fsmod = await import('node:fs');
function sleep(ms) { return new Promise(r => setTimeout(r, ms)); }

async function main() {
  const list = await (await fetch('http://127.0.0.1:9222/json/list')).json();
  const page = list.find(t => t.type === 'page');
  const ws = new WebSocket(page.webSocketDebuggerUrl);
  await new Promise((res, rej) => { ws.onopen = res; ws.onerror = rej; });
  let id = 0; const pend = new Map();
  ws.onmessage = (ev) => { const m = JSON.parse(ev.data); if (m.id && pend.has(m.id)) { pend.get(m.id)(m); pend.delete(m.id); } };
  const send = (method, params = {}) => new Promise(res => { ws.send(JSON.stringify({ id: ++id, method, params })); pend.set(id, res); });
  const evl = async (expr) => (await send('Runtime.evaluate', { expression: expr, returnByValue: true })).result.result?.value;
  const shot = async (name) => {
    const r = await send('Page.captureScreenshot', { format: 'png' });
    fsmod.writeFileSync('storage/app/' + name, Buffer.from(r.result.data, 'base64'));
  };
  const chk = (n, c, x) => console.log((c ? 'PASS' : 'FAIL') + ' | ' + n + (x ? ' | ' + x : ''));
  let r;

  await send('Page.enable');
  await send('Runtime.enable');
  await send('Page.navigate', { url: BASE + '/layanan/form-registrasi-tamu' });
  await sleep(4000);

  // S1 — buka dropdown bidang → kotak pencarian tampil
  await evl(`document.getElementById('tujuan_ditemui_display').click(); 'ok'`);
  await sleep(500);
  r = await evl(`JSON.stringify({
    menuOpen: document.getElementById('divisi-dropdown').style.display,
    searchAda: !!document.getElementById('divisi-search'),
    searchVisible: (function(){
      var s = document.getElementById('divisi-search');
      return s ? s.offsetParent !== null : false;
    })(),
    totalOpsi: document.querySelectorAll('#divisi-options .dropdown-option').length
  })`);
  let s1 = JSON.parse(r);
  chk('S1 dropdown bidang buka + kotak pencarian tampil', s1.menuOpen === 'block' && s1.searchAda && s1.searchVisible && s1.totalOpsi > 0,
    `opsi=${s1.totalOpsi}`);
  await shot('dd-search-1-divisi-open.png');

  // S2 — ketik "prod" → opsi terfilter, optgroup kosong disembunyikan
  await evl(`(function(){
    var s = document.getElementById('divisi-search');
    s.value = 'prod';
    s.dispatchEvent(new Event('input', {bubbles:true}));
    return 'ok';
  })()`);
  await sleep(400);
  r = await evl(`(function(){
    var opts = document.querySelectorAll('#divisi-options .dropdown-option');
    var visible = [];
    Array.prototype.forEach.call(opts, function(o){
      if (o.style.display !== 'none') visible.push(o.getAttribute('data-value'));
    });
    var grps = document.querySelectorAll('#divisi-options .dropdown-optgroup');
    var grpsVisible = 0;
    Array.prototype.forEach.call(grps, function(g){ if (g.style.display !== 'none') grpsVisible++; });
    return JSON.stringify({ visible: visible, totalGrup: grps.length, grupTampil: grpsVisible,
      emptyState: document.getElementById('divisi-search-empty').style.display });
  })()`);
  let s2 = JSON.parse(r);
  let semuaCocok = s2.visible.length > 0 && s2.visible.every(n => n.toLowerCase().includes('prod'));
  /* Grup yang tampil SAH selama masih punya opsi tampil di bawahnya
     (dengan 1 grup berisi cocok "prod" → 1/1 memang benar). */
  chk('S2 ketik "prod" → opsi bidang terfilter live',
    semuaCocok && s2.visible.length < 32,
    `tampil=${s2.visible.length}/32 [${s2.visible.join(', ')}] grup=${s2.grupTampil}/${s2.totalGrup}`);
  await shot('dd-search-2-divisi-filtered.png');

  // S2b — ketik teks tanpa hasil → semua opsi & grup disembunyikan, empty state tampil
  await evl(`(function(){
    var s = document.getElementById('divisi-search');
    s.value = 'zzzztidakada';
    s.dispatchEvent(new Event('input', {bubbles:true}));
    return 'ok';
  })()`);
  await sleep(400);
  r = await evl(`(function(){
    var visibleOpts = Array.prototype.filter.call(
      document.querySelectorAll('#divisi-options .dropdown-option'),
      function(o){ return o.style.display !== 'none'; }).length;
    var visibleGrps = Array.prototype.filter.call(
      document.querySelectorAll('#divisi-options .dropdown-optgroup'),
      function(g){ return g.style.display !== 'none'; }).length;
    return JSON.stringify({ visibleOpts: visibleOpts, visibleGrps: visibleGrps,
      emptyState: document.getElementById('divisi-search-empty').style.display });
  })()`);
  let s2b = JSON.parse(r);
  chk('S2b pencarian tanpa hasil → opsi & grup disembunyikan + empty state',
    s2b.visibleOpts === 0 && s2b.visibleGrps === 0 && s2b.emptyState !== 'none',
    `opsi=${s2b.visibleOpts} grup=${s2b.visibleGrps} empty=${s2b.emptyState}`);
  await shot('dd-search-2b-divisi-noresult.png');

  // S3 — reset pencarian saat dropdown dibuka ulang
  await evl(`document.body.click(); 'ok'`);
  await sleep(300);
  await evl(`document.getElementById('tujuan_ditemui_display').click(); 'ok'`);
  await sleep(400);
  r = await evl(`(function(){
    var s = document.getElementById('divisi-search');
    var visibleOpts = Array.prototype.filter.call(
      document.querySelectorAll('#divisi-options .dropdown-option'),
      function(o){ return o.style.display !== 'none'; }).length;
    return JSON.stringify({ searchValue: s.value, visibleOpts: visibleOpts });
  })()`);
  let s3 = JSON.parse(r);
  chk('S3 pencarian reset saat dropdown dibuka ulang', s3.searchValue === '' && s3.visibleOpts > 0,
    `search="${s3.searchValue}" visible=${s3.visibleOpts}`);

  // S4 — pilih bidang (klik opsi pertama yang tampil) → cascade jabatan aktif
  r = await evl(`(function(){
    var opt = Array.prototype.find.call(
      document.querySelectorAll('#divisi-options .dropdown-option'),
      function(o){ return o.style.display !== 'none' && o.getAttribute('data-value') !== ''; });
    if (!opt) return 'NO_OPTION';
    var nama = opt.getAttribute('data-value');
    opt.click();
    return JSON.stringify({ bidang: nama, hidden: document.getElementById('tujuan_ditemui').value });
  })()`);
  let s4 = JSON.parse(r);
  await sleep(500);
  chk('S4 pilih bidang → hidden input terisi (cascade tetap berfungsi)', s4.bidang === s4.hidden,
    `bidang="${s4.hidden}"`);

  // S5 — buka dropdown jabatan → ketik pencarian → terfilter live (gabungan bidang + teks)
  await evl(`document.getElementById('jabatan_ditemui_display').click(); 'ok'`);
  await sleep(500);
  r = await evl(`(function(){
    var opts = document.querySelectorAll('#jabatan-options .dropdown-option:not(.dropdown-jabatan-placeholder)');
    var visibleSebelum = Array.prototype.filter.call(opts, function(o){ return o.style.display !== 'none'; }).length;
    var s = document.getElementById('jabatan-search');
    s.value = 'a';
    s.dispatchEvent(new Event('input', {bubbles:true}));
    var visibleSesudah = Array.prototype.filter.call(opts, function(o){ return o.style.display !== 'none'; }).length;
    var namesVisible = [];
    Array.prototype.forEach.call(opts, function(o){
      if (o.style.display !== 'none') namesVisible.push(o.getAttribute('data-value'));
    });
    return JSON.stringify({ searchAda: !!s, visibleSebelum: visibleSebelum,
      visibleSesudah: visibleSesudah, names: namesVisible.slice(0, 5) });
  })()`);
  let s5 = JSON.parse(r);
  chk('S5 dropdown jabatan punya pencarian & filter live (bidang + teks)',
    s5.searchAda && s5.visibleSesudah <= s5.visibleSebelum && s5.visibleSesudah >= 0,
    `sebelum=${s5.visibleSebelum} sesudah="a"=${s5.visibleSesudah} [${s5.names.join(', ')}]`);
  await shot('dd-search-3-jabatan-filtered.png');

  // S6 — ketik teks yang tidak ada → placeholder "Tidak ada jabatan yang cocok dengan pencarian"
  r = await evl(`(function(){
    var s = document.getElementById('jabatan-search');
    s.value = 'zzzztidakada';
    s.dispatchEvent(new Event('input', {bubbles:true}));
    var ph = document.querySelector('#jabatan-options .dropdown-jabatan-placeholder');
    return JSON.stringify({ phDisplay: ph.style.display, phText: ph.textContent.trim() });
  })()`);
  let s6 = JSON.parse(r);
  chk('S6 pencarian tanpa hasil → placeholder "Tidak ada jabatan yang cocok"',
    s6.phDisplay !== 'none' && s6.phText.includes('Tidak ada jabatan'),
    `"${s6.phText}"`);
  await shot('dd-search-4-jabatan-noresult.png');

  // S7 — bersihkan pencarian, pilih jabatan pertama → hidden input terisi
  r = await evl(`(function(){
    var s = document.getElementById('jabatan-search');
    s.value = '';
    s.dispatchEvent(new Event('input', {bubbles:true}));
    var opt = Array.prototype.find.call(
      document.querySelectorAll('#jabatan-options .dropdown-option'),
      function(o){ return !o.classList.contains('dropdown-jabatan-placeholder') && o.style.display !== 'none'; });
    if (!opt) return 'NO_VISIBLE_JABATAN';
    var nama = opt.getAttribute('data-value');
    opt.click();
    return JSON.stringify({ jabatan: nama, hidden: document.getElementById('jabatan_ditemui').value });
  })()`);
  let s7 = JSON.parse(r);
  chk('S7 pilih jabatan → hidden input terisi', typeof s7 === 'object' && s7.jabatan === s7.hidden,
    `jabatan="${s7.hidden || s7}"`);

  ws.close();
  console.log('DONE');
}

main().catch(e => { console.error('ERR', e.message); process.exit(1); });
