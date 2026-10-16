/* Verifikasi label "UMUM" → "ALL" pada daftar Link Kerja:
   - badge kolom Kategori (server render)
   - opsi filter kategori
   - badge setelah simpan modal edit (jalur JS updateRow)  */
const BASE = 'http://127.0.0.1:8089';
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
  const chk = (n, c, x) => console.log((c ? 'PASS' : 'FAIL') + ' | ' + n + (x ? ' | ' + x : ''));

  await send('Page.enable');
  await send('Page.navigate', { url: BASE + '/admin/login' });
  await sleep(2200);
  await evl(`document.getElementById('email').value='cdp-test-admin@codebuff.local';
    document.querySelector('input[type=password]').value='CodebuffTest#2026';
    document.querySelector('form').submit();`);
  await sleep(2600);

  // full-load index
  await send('Page.navigate', { url: BASE + '/admin/work-links' });
  await sleep(2000);
  let r = await evl(`JSON.stringify({
    optionLabel: document.querySelector('#filterCategory option[value="umum"]')?.textContent.trim(),
    badges: [...document.querySelectorAll('.worklink-badge')].map(b => b.textContent.trim() + ':' + b.className.replace('worklink-badge', '').trim()),
    anyUmumText: /\\bUmum\\b|\\bUMUM\\b/.test(document.body.innerText),
  })`);
  let o = JSON.parse(r);
  chk('T1 opsi filter kategori = "All"', o.optionLabel === 'All', o.optionLabel);
  chk('T2 badge kategori memuat "All" (bukan Umum/UMUM)',
    o.badges.some(b => b.startsWith('All:umum')) && !o.badges.some(b => /umum[:]/.test(b) && !b.startsWith('All')),
    JSON.stringify(o.badges.slice(0, 4)));

  // SPA path: index → index (swap) → badge tetap benar
  await evl(`const a=[...document.querySelectorAll('.sidebar-nav a, .admin-sidebar a')].find(x => x.getAttribute('href')?.includes('work-links')); a?.click();`);
  await sleep(2200);
  r = await evl(`JSON.stringify({
    url: location.href,
    badgesAll: [...document.querySelectorAll('.worklink-badge')].filter(b => b.textContent.trim() === 'All').length,
    badgesKhusus: [...document.querySelectorAll('.worklink-badge')].filter(b => b.textContent.trim() === 'Khusus').length,
    rowsUmum: [...document.querySelectorAll('tr[data-category="umum"]')].length,
    rowsKhusus: [...document.querySelectorAll('tr[data-category="khusus"]')].length,
    noUmumText: !/\\bUmum\\b|\\bUMUM\\b/.test(document.body.innerText),
    opt: document.querySelector('#filterCategory option[value="umum"]')?.textContent.trim(),
  })`);
  o = JSON.parse(r);
  chk('T3 SPA swap: badge sesuai jumlah baris (9 All + 5 Khusus + tanpa teks Umum)',
    o.badgesAll === o.rowsUmum && o.badgesKhusus === o.rowsKhusus && o.noUmumText === true,
    JSON.stringify(o));
  chk('T4 SPA swap: teks "Umum/UMUM" hilang dari halaman', o.noUmumText === true);
  chk('T5 SPA swap: opsi filter = "All"', o.opt === 'All', o.opt);

  // ---- updateRow (JS) setelah simpan modal edit (data identik → aman)
  r = await evl(`(() => {
    const row = [...document.querySelectorAll('tr[data-id]')].find(x => x.dataset.canEdit === 'true' && x.dataset.category === 'umum');
    if (!row) return 'no umum row';
    window.openWorkLinkEditModal(row.querySelector('[onclick*="openWorkLinkEditModal"]'));
    return 'opened';
  })()`);
  chk('T6 modal edit dibuka untuk link All', r === 'opened', r);
  await sleep(600);
  r = await evl(`(() => {
    const f = document.getElementById('workLinkEditForm');
    const cat = f.querySelector('input[name="category"]:checked')?.value;
    // pastikan kategori tetap 'umum' lalu simpan (data identik)
    f.querySelector('input[name="category"][value="umum"]').checked = true;
    f.querySelector('button[type="submit"], #workLinkEditSubmit')?.click();
    return 'submitted cat=' + cat;
  })()`);
  await sleep(2500);
  r = await evl(`JSON.stringify({
    modalClosed: !document.getElementById('workLinkEditModal')?.classList.contains('show'),
    toast: document.body.innerText.includes('berhasil'),
    firstBadge: document.querySelector('.worklink-badge')?.textContent.trim(),
  })`);
  o = JSON.parse(r);
  chk('T7 simpan modal sukses (toast + modal tutup)', o.modalClosed && o.toast, JSON.stringify({ modalClosed: o.modalClosed }));
  chk('T8 badge setelah updateRow JS = "All"', o.firstBadge === 'All', o.firstBadge);

  const shot = await send('Page.captureScreenshot', { format: 'png' });
  (await import('node:fs')).writeFileSync('C:/tmp/wl_badge_all.png', Buffer.from(shot.result.data, 'base64'));
  console.log('screenshot: C:/tmp/wl_badge_all.png');
  process.exit(0);
}
main().catch(e => { console.error('FAIL:', e.message); process.exit(1); });
