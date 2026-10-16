/* Modal edit populate check (setelah perbaikan data-link escaping). */
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

  await send('Page.enable');
  await send('Page.navigate', { url: BASE + '/admin/login' });
  await sleep(2200);
  await evl(`document.getElementById('email').value='cdp-test-admin@codebuff.local';
    document.querySelector('input[type=password]').value='CodebuffTest#2026';
    document.querySelector('form').submit();`);
  await sleep(2600);
  await send('Page.navigate', { url: BASE + '/admin/work-links' });
  await sleep(2000);

  const r = await evl(`(() => {
    const row = [...document.querySelectorAll('tr[data-id]')].find(x => x.dataset.canEdit === 'true');
    const persisted = JSON.parse(row.dataset.link);
    window.openWorkLinkEditModal(row.querySelector('[onclick*="openWorkLinkEditModal"]'));
    const f = document.getElementById('workLinkEditForm');
    return JSON.stringify({
      dbTitle: persisted.title,
      formTitle: f.querySelector('[name="title"]').value,
      formUrl: f.querySelector('[name="url"]').value,
      formDept: document.getElementById('wlEditDepartment').value,
      formSub: document.getElementById('wlEditSubDepartment').value,
      catChecked: f.querySelector('input[name="category"]:checked')?.value,
      panelVisible: !document.getElementById('wlEditTargetPanel')?.classList.contains('hidden-panel'),
    });
  })()`);
  const o = JSON.parse(r);
  console.log(JSON.stringify(o));
  const chk = (n, c, x) => console.log((c ? 'PASS' : 'FAIL') + ' | ' + n + (x ? ' | ' + x : ''));
  chk('M1 modal populate title dari DB', o.formTitle === o.dbTitle, o.dbTitle);
  chk('M2 modal populate url', !!o.formUrl, o.formUrl);
  chk('M3 modal populate category', ['umum', 'khusus'].includes(o.catChecked), o.catChecked);
  const needDept = o.catChecked === 'khusus';
  chk('M4 modal populate department sesuai kategori', needDept ? !!o.formDept : true, o.formDept);
  process.exit(o.formTitle === o.dbTitle && o.formUrl && o.catChecked ? 0 : 1);
}
main().catch(e => { console.error('FAIL:', e.message); process.exit(1); });
