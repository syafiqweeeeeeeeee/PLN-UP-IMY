/* Standalone edit page check: semua link khusus milik test → /edit */
const BASE = 'http://127.0.0.1:8089';
function sleep(ms) { return new Promise(r => setTimeout(r, ms)); }

async function main() {
  const list = await (await fetch('http://127.0.0.1:9222/json/list')).json();
  const page = list.find(t => t.type === 'page');
  const ws = new WebSocket(page.webSocketDebuggerUrl);
  await new Promise((res, rej) => { ws.onopen = res; ws.onerror = rej; });
  let id = 0; const pend = new Map();
  ws.onmessage = (ev) => {
    const m = JSON.parse(ev.data);
    if (m.id && pend.has(m.id)) { pend.get(m.id)(m); pend.delete(m.id); }
  };
  const send = (method, params = {}) => new Promise((res) => {
    ws.send(JSON.stringify({ id: ++id, method, params }));
    pend.set(id, res);
  });
  const evl = async (expr) => (await send('Runtime.evaluate', { expression: expr, returnByValue: true })).result.result?.value;

  await send('Page.enable');

  // SPA path: index → klik edit */
  // login fresh
  await send('Page.navigate', { url: BASE + '/admin/login' });
  await sleep(2200);
  await evl(`document.getElementById('email').value='cdp-test-admin@codebuff.local';
    document.querySelector('input[type=password]').value='CodebuffTest#2026';
    document.querySelector('form').submit();`);
  await sleep(2600);

  // FULL LOAD edit page
  await send('Page.navigate', { url: BASE + '/admin/work-links' });
  await sleep(1800);
  const linkId = await evl(`(() => {
    const row = [...document.querySelectorAll('tr[data-category="khusus"]')].find(r => r.dataset.canEdit === 'true');
    window.__persisted = row ? JSON.parse(row.dataset.link) : null;   // nilai tersimpan di DB (dari server)
    return row?.dataset.id;
  })()`);
  console.log('khusus link id =', linkId);
  const persisted = await evl('window.__persisted');   // {department, sub_department, ...} dari server
  if (!linkId) { console.log('FAIL | no khusus link'); process.exit(1); }

  // full-load /edit
  await send('Page.navigate', { url: BASE + '/admin/work-links/' + linkId + '/edit' });
  await sleep(2000);
  let s = await evl(`JSON.stringify({
    bound: document.getElementById('workLinkForm')?.dataset.wlDdBound,
    khususChecked: document.getElementById('cat-khusus')?.checked,
    panelVisible: !document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel'),
    deptVal: document.getElementById('department')?.value,
    deptEmpty: document.getElementById('department')?.classList.contains('is-empty'),
    subVal: document.getElementById('sub_department')?.value,
  })`);
  let o = JSON.parse(s);
  const chk = (n, c, x) => console.log((c ? 'PASS' : 'FAIL') + ' | ' + n + (x ? ' | ' + x : ''));
  chk('D1 edit(full-load): script bound', o.bound === '1', JSON.stringify(o));
  chk('D2 edit(full-load): panel Khusus transparan', o.khususChecked === true && o.panelVisible === true, 'dept=' + o.deptVal);
  chk('D3 edit(full-load): float label menghilang untk nilai terisi', o.deptEmpty === false);
  chk('D4 edit(full-load): sub-bidang ter-restore = nilai PERSISTED di DB',
    !!o.subVal && o.subVal === persisted?.sub_department && o.deptVal === persisted?.department,
    'form=' + o.subVal + ' db=' + persisted?.sub_department);

  // SPA path: index → klik a edit (row di index link ke /edit? gunakan direct nav SPA via history push)
  const linkHref = BASE + '/admin/work-links/' + linkId + '/edit';
  await send('Page.navigate', { url: BASE + '/admin/work-links' });
  await sleep(1800);
  await evl(`history.pushState({}, '', '${linkHref}');`);
  await evl(`const a=[...document.querySelectorAll('a')].find(x=>x.getAttribute('href')==='${linkHref}');
    if(a){a.click()} else { location.href='${linkHref}'; }`);
  await sleep(2200);
  s = await evl(`JSON.stringify({ url: location.href, bound: document.getElementById('workLinkForm')?.dataset.wlDdBound,
    panelVisible: !document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel') })`);
  o = JSON.parse(s);
  chk('D5 edit(SPA): script re-bind setelah swap', o.bound === '1', JSON.stringify(o));
  chk('D6 edit(SPA): panel Khusus tetap tampil', o.panelVisible === true, 'url=' + o.url);

  // siklus toggle di halaman edit
  await evl(`document.getElementById('cat-umum')?.click()`); await sleep(250);
  const hid1 = await evl(`document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel')`);
  await evl(`document.getElementById('cat-khusus')?.click()`); await sleep(250);
  const hid2 = await evl(`document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel')`);
  chk('D7 edit: siklus All→Khusus panel hilang→muncul', hid1 === true && hid2 === false, 'd1=' + hid1 + ',d2=' + hid2);

  const shot = await send('Page.captureScreenshot', { format: 'png' });
  (await import('node:fs')).writeFileSync('C:/tmp/wl_edit_page.png', Buffer.from(shot.result.data, 'base64'));
  console.log('screenshot: C:/tmp/wl_edit_page.png');
  process.exit(0);
}
main().catch(e => { console.error('FAIL:', e.message); process.exit(1); });
