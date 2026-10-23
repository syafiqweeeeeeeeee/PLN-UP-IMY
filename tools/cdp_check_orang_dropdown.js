/* Verifikasi dropdown "Orang yang Ditemui" (form registrasi tamu publik):
   D1 field terdefinisi & TIDAK readonly (search via ketik tetap hidup)
   D1b filter role: HANYA staf & karyawan (role "Karyawan") yang tampil —
      akun Admin Bidang (JUAN DINO) & Super Admin (syafiqwldn0) TIDAK ada
   D2 klik field → dropdown custom terbuka (bukan datalist bawaan browser)
   D3 ketik "pro" → opsi terfilter live (h nama mengandung "pro")
   D4 klik opsi → input terisi nama, dropdown tertutup
   D5 teks bebas di luar daftar tetap diperbolehkan (field opsional)
   SS screenshot tiap tahap disimpan ke storage/app
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

  // Buka form registrasi tamu
  await send('Page.navigate', { url: BASE + '/layanan/form-registrasi-tamu' });
  await sleep(4000);

  // D1 — field ada, editable, punya dropdown custom & opsi dari tabel users
  r = await evl(`JSON.stringify({
    ada: !!document.getElementById('orang_ditemui'),
    readonly: document.getElementById('orang_ditemui')?.readOnly,
    punyaMenu: !!document.getElementById('orang-dropdown'),
    jumlahOpsi: document.querySelectorAll('#orang-options .dropdown-option').length,
    pakaiDatalistLama: !!document.getElementById('orang-datalist')
  })`);
  const d1 = JSON.parse(r);
  chk('D1 field editable + dropdown custom terpasang', d1.ada && d1.readonly === false && d1.punyaMenu && d1.jumlahOpsi > 0 && d1.pakaiDatalistLama === false,
    `opsi=${d1.jumlahOpsi} datalistLama=${d1.pakaiDatalistLama}`);

  // D1b — hanya staf & karyawan: buang akun admin, buang akun tak terverifikasi
  r = await evl(`(function(){
    var emails = Array.prototype.map.call(
      document.querySelectorAll('#orang-options .dropdown-option'),
      function(o){
        var s = o.getAttribute('data-search') || '';
        return s.substring(s.lastIndexOf(' ') + 1);
      });
    return JSON.stringify(emails);
  })()`);
  const d1b = JSON.parse(r);
  const HARUS_ADA = ['karyawan@gmail.com', 'syafiq.wildan.ti.23@cic.ac.id'];
  const HARUS_HILANG = ['Juanbks1@gmail.com', 'syafiqwldn0@gmail.com'];
  const adaSemua = HARUS_ADA.every(e => d1b.includes(e));
  const adminHilang = HARUS_HILANG.every(e => !d1b.includes(e));
  chk('D1b hanya staf & karyawan tampil (admin dibuang)', d1b.length > 0 && adaSemua && adminHilang,
    `total=${d1b.length} adaKaryawan=${adaSemua} adminHilang=${adminHilang}`);

  // D2 — klik field → dropdown terbuka
  await evl(`document.getElementById('orang_ditemui').click(); 'ok'`);
  await sleep(500);
  r = await evl(`(function(){
    var m = document.getElementById('orang-dropdown');
    var opts = m.querySelectorAll('.dropdown-option');
    var visible = Array.prototype.filter.call(opts, function(o){ return o.style.display !== 'none'; }).length;
    return JSON.stringify({ display: m.style.display, visible: visible });
  })()`);
  const d2 = JSON.parse(r);
  chk('D2 klik → dropdown terbuka', d2.display === 'block' && d2.visible > 0, `visible=${d2.visible}`);
  await shot('orang-dropdown-1-open.png');

  // D3 — ketik "pro" → filter live
  await evl(`(function(){
    var i = document.getElementById('orang_ditemui');
    i.value = 'pro';
    i.dispatchEvent(new Event('input', {bubbles:true}));
    return 'ok';
  })()`);
  await sleep(500);
  r = await evl(`(function(){
    var m = document.getElementById('orang-dropdown');
    var opts = m.querySelectorAll('.dropdown-option');
    var visible = [];
    Array.prototype.forEach.call(opts, function(o){
      if (o.style.display !== 'none') visible.push(o.getAttribute('data-value'));
    });
    var semua = [];
    Array.prototype.forEach.call(opts, function(o){ semua.push(o.getAttribute('data-value')); });
    return JSON.stringify({ display: m.style.display, visible: visible, totalSebelum: semua.length });
  })()`);
  const d3 = JSON.parse(r);
  const semuaCocok = d3.visible.length > 0 && d3.visible.length < d3.totalSebelum
    && d3.visible.every(n => n.toLowerCase().includes('pro'));
  chk('D3 ketik "pro" → opsi terfilter live', d3.display === 'block' && semuaCocok,
    `tampil=${d3.visible.length}/${d3.totalSebelum} [${d3.visible.join(', ')}]`);
  await shot('orang-dropdown-2-search.png');

  // D4 — klik opsi tampil pertama → input terisi nama, dropdown tertutup
  r = await evl(`(function(){
    var m = document.getElementById('orang-dropdown');
    var opt = Array.prototype.find.call(m.querySelectorAll('.dropdown-option'), function(o){ return o.style.display !== 'none'; });
    if (!opt) return 'NO_VISIBLE';
    var nama = opt.getAttribute('data-value');
    opt.click();
    var i = document.getElementById('orang_ditemui');
    return JSON.stringify({ expect: nama, inputValue: i.value, display: m.style.display });
  })()`);
  const d4 = JSON.parse(r);
  chk('D4 klik opsi → input terisi & dropdown tertutup', d4.expect === d4.inputValue && d4.display === 'none',
    `input="${d4.inputValue}"`);
  await shot('orang-dropdown-3-selected.png');

  // D5 — teks bebas di luar daftar tetap diperbolehkan + empty state tampil
  r = await evl(`(function(){
    var i = document.getElementById('orang_ditemui');
    i.value = 'Nama Di Luar Daftar';
    i.dispatchEvent(new Event('input', {bubbles:true}));
    var m = document.getElementById('orang-dropdown');
    var empty = m.querySelector('.orang-empty');
    var visibleOpts = Array.prototype.filter.call(m.querySelectorAll('.dropdown-option'), function(o){ return o.style.display !== 'none'; }).length;
    return JSON.stringify({
      readOnly: i.readOnly,
      nameAttr: i.getAttribute('name'),
      dropdownTetapBuka: m.style.display,
      visibleOpts: visibleOpts,
      emptyStateTampil: empty ? (empty.style.display !== 'none') : null
    });
  })()`);
  const d5 = JSON.parse(r);
  chk('D5 teks bebas di luar daftar diperbolehkan + empty state',
    d5.readOnly === false && d5.nameAttr === 'orang_ditemui' && d5.visibleOpts === 0 && d5.emptyStateTampil === true,
    `name=${d5.nameAttr} empty=${d5.emptyStateTampil}`);
  await shot('orang-dropdown-4-freetext.png');

  ws.close();
  console.log('DONE');
}

main().catch(e => { console.error('ERR', e.message); process.exit(1); });
