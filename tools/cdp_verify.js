/* CDP VERIFY — fix Link Kerja (Tambah/Edit):
   1. Toggle Khusus memunculkan panel target — full-load & SPA nav.
   2. Label kategori "Umum" → "All" (form + modal edit).
   3. Dropdown clean (pln-select-wrap): floating label, panel selalu
      ke bawah, tanpa kotak pencarian, tanpa opsi placeholder. */
const BASE = 'http://127.0.0.1:8089';

function sleep(ms) { return new Promise(r => setTimeout(r, ms)); }
const results = [];
function check(name, ok, extra) {
  results.push({ name, ok: !!ok, extra });
  console.log((ok ? 'PASS' : 'FAIL') + ' | ' + name + (extra ? ' | ' + extra : ''));
}

async function main() {
  const list = await (await fetch('http://127.0.0.1:9222/json/list')).json();
  const page = list.find(t => t.type === 'page');
  const ws = new WebSocket(page.webSocketDebuggerUrl);
  await new Promise((res, rej) => { ws.onopen = res; ws.onerror = rej; });
  let id = 0; const pend = new Map();
  ws.onmessage = (ev) => {
    const m = JSON.parse(ev.data);
    if (m.id && pend.has(m.id)) { const r = pend.get(m.id); pend.delete(m.id); r(m); }
  };
  const send = (method, params = {}) => new Promise((res) => {
    const mid = ++id;
    ws.send(JSON.stringify({ id: mid, method, params }));
    pend.set(mid, res);
  });
  const evl = async (expr) => {
    const r = await send('Runtime.evaluate', { expression: expr, returnByValue: true });
    return r.result.result?.value;
  };

  await send('Page.enable');

  // ---- login
  await send('Page.navigate', { url: BASE + '/admin/login' });
  await sleep(2500);
  await evl(`document.getElementById('email').value='cdp-test-admin@codebuff.local';
    document.querySelector('input[type=password]').value='CodebuffTest#2026';
    document.querySelector('form').submit();`);
  await sleep(3000);

  // ===========================================================
  // A. CREATE PAGE — full load
  // ===========================================================
  await send('Page.navigate', { url: BASE + '/admin/work-links/create' });
  await sleep(2200);

  let s = await evl(`JSON.stringify({
    url: location.href,
    umumLabel: document.querySelector('label[for="cat-umum"]')?.textContent.trim(),
    hintUmum: !!document.querySelector('.form-hint strong')?.textContent.includes('All'),
    panelHidden: document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel'),
    deptWrap: !!document.querySelector('#department')?.closest('.pln-select-wrap'),
    deptFloat: document.querySelector('#department')?.closest('.pln-select-wrap')?.querySelector('.pln-field-float')?.textContent.trim(),
    subWrap: !!document.querySelector('#sub_department')?.closest('.pln-select-wrap'),
    subFloat: document.querySelector('#sub_department')?.closest('.pln-select-wrap')?.querySelector('.pln-field-float')?.textContent.trim(),
    deptOpts: Array.from(document.querySelectorAll('#department option')).map(o => o.value + '|' + o.textContent.trim()).slice(0, 3),
    scriptBound: document.getElementById('workLinkForm')?.dataset.wlDdBound,
  })`);
  let o = JSON.parse(s);
  check('A1 label pill = "All"', o.umumLabel === 'All', o.umumLabel);
  check('A2 hint memakai istilah All', o.hintUmum);
  check('A3 panel target tersembunyi saat All', o.panelHidden);
  check('A4 dept dropdown di-wrap pln-select-wrap', o.deptWrap);
  check('A5 float label Bidang Utama', /Bidang Utama/.test(o.deptFloat || ''), o.deptFloat);
  check('A6 sub dropdown di-wrap', o.subWrap);
  check('A7 float label Sub-Bidang', /Sub-Bidang/.test(o.subFloat || ''), o.subFloat);
  check('A8 tanpa opsi placeholder "-- Pilih...--" di dept', (o.deptOpts || []).every(x => !x.includes('Pilih')), JSON.stringify(o.deptOpts));
  check('A9 dropdown engine bound', o.scriptBound === '1');

  // click Khusus → panel muncul
  await evl(`document.getElementById('cat-khusus')?.click()`);
  await sleep(300);
  s = await evl(`JSON.stringify({ hidden: document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel'), display: getComputedStyle(document.getElementById('targetKhususPanel')).display })`);
  o = JSON.parse(s);
  check('A10 klik Khusus → panel target MUNCUL', !o.hidden && o.display !== 'none', JSON.stringify(o));
  await evl(`document.getElementById('cat-umum')?.click()`);
  await sleep(200);
  s = await evl(`document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel')`);
  check('A11 klik All → panel hilang lagi', s === true, s);
  await evl(`document.getElementById('cat-khusus')?.click()`);
  await sleep(250);

  // ---- open dept dropdown (engine) → panel di bawah, tanpa search
  await evl(`document.getElementById('department')?.dispatchEvent(new MouseEvent('mousedown', { bubbles: true }))`);
  await sleep(350);
  s = await evl(`JSON.stringify((() => {
    const sel = document.getElementById('department');
    const panel = document.querySelector('.pln-dd-panel');
    if (!panel) return { panel: false };
    const r1 = sel.getBoundingClientRect(), r2 = panel.getBoundingClientRect();
    return {
      panel: true,
      below: r2.top >= r1.bottom - 2,
      searchBox: !!panel.querySelector('input'),
      items: Array.from(panel.querySelectorAll('.pln-dd-item')).slice(0, 4).map(b => b.textContent.trim()),
    };
  })())`);
  o = JSON.parse(s);
  check('A12 panel dropdown terbuka', o.panel === true);
  check('A13 panel terbuka DI BAWAH kontrol', o.below === true);
  check('A14 tanpa kotak pencarian', o.searchBox === false);
  check('A15 item opsi = nama bidang asli', (o.items || []).some(t => /Operasi/.test(t)), JSON.stringify(o.items));

  // pilih satu opsi → nilai select terisi + sub options terisi
  await evl(`[...document.querySelectorAll('.pln-dd-item')].find(b => b.textContent.includes('Operasi'))?.click()`);
  await sleep(350);
  s = await evl(`JSON.stringify((() => {
    const sel = document.getElementById('department');
    const sub = document.getElementById('sub_department');
    return {
      dept: sel.value,
      deptEmpty: sel.classList.contains('is-empty'),
      subs: Array.from(sub.options).filter(x => x.value).map(x => x.textContent).slice(0, 4),
    };
  })())`);
  o = JSON.parse(s);
  check('A16 pilih item → nilai dept = operasi', o.dept === 'operasi', o.dept);
  check('A17 floating label menghilang saat terisi', o.deptEmpty === false);
  check('A18 sub-bidang terisi dependent (Prod A dsb.)', (o.subs || []).includes('Prod A'), JSON.stringify(o.subs));

  // ===========================================================
  // B. SPA NAVIGASI ke create (bug utama sebelumnya)
  // ===========================================================
  await send('Page.navigate', { url: BASE + '/admin/work-links' });
  await sleep(2000);
  await evl(`const a = document.querySelector('a[href="${BASE}/admin/work-links/create"]') || document.querySelector('a[href="/admin/work-links/create"]'); a?.click();`);
  await sleep(2500);
  s = await evl(`JSON.stringify({
    url: location.href,
    bound: document.getElementById('workLinkForm')?.dataset.wlDdBound,
    deptWrap: !!document.querySelector('#department')?.closest('.pln-select-wrap'),
  })`);
  o = JSON.parse(s);
  check('B1 SPA create: script form re-bind', o.bound === '1', JSON.stringify(o));
  check('B2 SPA create: dropdown ter-wrap (styles ikut)', o.deptWrap === true);

  await evl(`document.getElementById('cat-khusus')?.click()`);
  await sleep(300);
  s = await evl(`document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel')`);
  check('B3 SPA create: klik Khusus → panel MUNCUL (fix utama)', s === false, 'hidden=' + s);
  await evl(`document.getElementById('cat-umum')?.click()`);
  await sleep(200);
  await evl(`document.getElementById('cat-khusus')?.click()`);
  await sleep(250);
  s = await evl(`document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel')`);
  check('B4 SPA create: siklus All→Khusus tetap bekerja', s === false, 'hidden=' + s);

  // ===========================================================
  // C. EDIT MODAL di index — label All + dropdown clean + toggle
  // ===========================================================
  await send('Page.navigate', { url: BASE + '/admin/work-links' });
  await sleep(2000);
  s = await evl(`JSON.stringify({
    pill: document.querySelector('label[for="wlEditCatUmum"]')?.textContent.trim(),
    subDataOk: (() => { try { JSON.parse(document.getElementById('workLinkSubDepartmentsData').textContent); return true; } catch (e) { return false; } })(),
    deptWrap: !!document.getElementById('wlEditDepartment')?.closest('.pln-select-wrap'),
    jsBroken: window.__workLinkEditModalBound !== true,
  })`);
  o = JSON.parse(s);
  check('C1 modal pill label = "All"', o.pill === 'All', o.pill);
  check('C2 data referensi JSON utuh setelah swap', o.subDataOk === true);
  check('C3 modal dropdown ter-wrap', o.deptWrap === true);
  check('C4 modal script bound (tidak dibunuh SyntaxError)', o.jsBroken === false);

  // buka modal dari baris pertama yang boleh diedit
  await evl(`const row = [...document.querySelectorAll('tr[data-id]')].find(r => r.dataset.canEdit === 'true');
    const btn = row?.querySelector('button[onclick*="openWorkLinkEditModal"], a[onclick*="openWorkLinkEditModal"], [onclick*="openWorkLinkEditModal"]');
    btn ? btn.click() : (row && (window.openWorkLinkEditModal ? window.openWorkLinkEditModal(row.querySelector('[onclick], button')) : null));`);
  await sleep(700);
  s = await evl(`JSON.stringify({ show: document.getElementById('workLinkEditModal')?.classList.contains('show'), bound: document.getElementById('workLinkEditForm')?.dataset.wlEditDdBound })`);
  o = JSON.parse(s);
  check('C5 modal edit terbuka', o.show === true, JSON.stringify(o));

  // klik khusus → panel modal muncul
  await evl(`document.getElementById('wlEditCatKhusus')?.click()`);
  await sleep(300);
  s = await evl(`document.getElementById('wlEditTargetPanel')?.classList.contains('hidden-panel')`);
  check('C6 modal: edit Khusus → panel MUNCUL', s === false, 'hidden=' + s);

  // dropdown modal: open + tanpa search + pilih opsi
  await evl(`document.getElementById('wlEditDepartment')?.dispatchEvent(new MouseEvent('mousedown', { bubbles: true }))`);
  await sleep(350);
  s = await evl(`JSON.stringify((() => {
    const panel = document.querySelector('.pln-dd-panel');
    if (!panel) return { panel: false };
    const sel = document.getElementById('wlEditDepartment');
    const below = panel.getBoundingClientRect().top >= sel.getBoundingClientRect().bottom - 2;
    return { panel: true, below, noSearch: !panel.querySelector('input') };
  })())`);
  o = JSON.parse(s);
  check('C7 modal: panel dropdown terbuka ke bawah', o.panel === true && o.below === true, JSON.stringify(o));
  check('C8 modal: tanpa kotak pencarian', o.noSearch === true);

  await evl(`[...document.querySelectorAll('.pln-dd-item')].find(b => b.textContent.includes('Pemeliharaan'))?.click()`);
  await sleep(400);
  s = await evl(`JSON.stringify((() => {
    const sel = document.getElementById('wlEditDepartment');
    const sub = document.getElementById('wlEditSubDepartment');
    return { dept: sel.value, subs: Array.from(sub.options).filter(x => x.value).map(x => x.textContent).slice(0, 3) };
  })())`);
  o = JSON.parse(s);
  check('C9 modal: dept terpilih + sub dependent (Rendal Har)', o.dept === 'pemeliharaan' && (o.subs || []).includes('Rendal Har'), JSON.stringify(o));

  // ===========================================================
  // D. EDIT PAGE standalone (full load, link khusus milik bidang)
  // ===========================================================
  // ambil id link khusus pertama dari data tabelle / API? gunakan route edit dari baris
  await send('Page.navigate', { url: BASE + '/admin/work-links' });
  await sleep(1800);
  const editUrl = await evl(`(() => {
    const row = [...document.querySelectorAll('tr[data-category="khusus"]')].find(r => r.dataset.canEdit === 'true');
    const btn = row?.querySelector('[onclick*="openWorkLinkEditModal"]');
    return btn ? 'MODAL_ONLY' : (document.querySelector('a[href*="/edit"]')?.getAttribute('href') || '');
  })()`);
  if (editUrl && editUrl !== 'MODAL_ONLY') {
    await send('Page.navigate', { url: editUrl.startsWith('http') ? editUrl : BASE + editUrl });
    await sleep(2000);
    s = await evl(`JSON.stringify({
      bound: document.getElementById('workLinkForm')?.dataset.wlDdBound,
      khususChecked: document.getElementById('cat-khusus')?.checked,
      panelVisible: !document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel'),
      deptVal: document.getElementById('department')?.value,
      deptEmpty: document.getElementById('department')?.classList.contains('is-empty'),
    })`);
    o = JSON.parse(s);
    check('D1 edit page: script bound', o.bound === '1', JSON.stringify(o));
    check('D2 edit page (khusus): panel langsung transparan', o.khususChecked === true && o.panelVisible === true);
    check('D3 edit page: dept terisi + float label aktif', o.deptVal !== '' && o.deptEmpty === false);
  } else {
    console.log('INFO | D: tidak ada link khusus yang bisa diedit → skip (modal test sudah mencakup)');
  }

  // ===========================================================
  // E. END-TO-END: simpan link Khusus lewat form create (SPA path)
  // ===========================================================
  await send('Page.navigate', { url: BASE + '/admin/work-links' });
  await sleep(1800);
  await evl(`document.querySelector('a[href="${BASE}/admin/work-links/create"]')?.click()`);
  await sleep(2200);
  await evl(`
    document.getElementById('cat-khusus')?.click();
    document.getElementById('title').value = 'CDP Verified Link Khusus';
    document.getElementById('title').dispatchEvent(new Event('input', { bubbles: true }));
    document.getElementById('url').value = 'https://contoh.co.id/cdp-verify';
    document.getElementById('url').dispatchEvent(new Event('input', { bubbles: true }));
  `);
  await sleep(200);
  await evl(`document.getElementById('department')?.dispatchEvent(new MouseEvent('mousedown', { bubbles: true }))`);
  await sleep(300);
  await evl(`[...document.querySelectorAll('.pln-dd-item')].find(b => b.textContent.includes('Engineering'))?.click()`);
  await sleep(250);
  await evl(`document.getElementById('sub_department')?.dispatchEvent(new MouseEvent('mousedown', { bubbles: true }))`);
  await sleep(300);
  await evl(`[...document.querySelectorAll('.pln-dd-item')].find(b => b.textContent.includes('CBM'))?.click()`);
  await sleep(250);
  await evl(`document.querySelector('button[type="submit"], .form-btn-save')?.click()`);
  await sleep(2800);
  s = await evl(`JSON.stringify({ url: location.href, toast: document.body.innerText.includes('berhasil') || location.href.includes('work-links') })`);
  o = JSON.parse(s);
  check('E1 submit form Khusus (via clean dropdown) tersimpan', o.url.includes('/admin/work-links') && !o.url.includes('create'), o.url);

  const shot = await send('Page.captureScreenshot', { format: 'png' });
  const { writeFileSync } = await import('node:fs');
  writeFileSync('C:/tmp/wl_verify.png', Buffer.from(shot.result.data, 'base64'));
  console.log('screenshot: C:/tmp/wl_verify.png');

  const failed = results.filter(r => !r.ok);
  console.log('======================================');
  console.log('TOTAL: ' + results.length + ' | PASS: ' + (results.length - failed.length) + ' | FAIL: ' + failed.length);
  process.exit(failed.length ? 1 : 0);
}
main().catch(e => { console.error('FAIL:', e.message); process.exit(1); });
