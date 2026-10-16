/* Probe: why does the Khusus toggle fail on the SPA-navigated create page? */
const BASE = 'http://127.0.0.1:8089';

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
    else if (m.method === 'Runtime.consoleAPICalled' && (m.params.type === 'error' || m.params.type === 'warning')) {
      errors.push(m.params.args.map(a => a.value ?? a.description ?? '').join(' '));
    }
    else if (m.method === 'Runtime.exceptionThrown') {
      errors.push('EXC: ' + (m.params.exceptionDetails.exception?.description || m.params.exceptionDetails.text));
    }
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

  // login
  await send('Page.enable');
  await send('Runtime.enable');
  let nav = send('Page.navigate', { url: BASE + '/admin/login' });
  await nav; await sleep(2000);
  await evl(`document.getElementById('email').value='cdp-test-admin@codebuff.local';
    document.querySelector('input[type=password]').value='CodebuffTest#2026';
    document.querySelector('form').submit();`);
  await sleep(3000);

  // go to index, then SPA-click into create
  nav = send('Page.navigate', { url: BASE + '/admin/work-links' });
  await nav; await sleep(2000);
  await evl(`const a = document.querySelector('a[href="${BASE}/admin/work-links/create"]') || document.querySelector('a[href=\"/admin/work-links/create\"]'); a.click();`);
  await sleep(2500);

  console.log('url =', await evl('location.href'));

  // 1) try JSON.parse of the data script exactly like the form script does
  console.log('json-parse =', await evl(`(function(){
    try { JSON.parse(document.getElementById('subDepartmentsData').textContent); return 'OK'; }
    catch (e) { return 'THROWS: ' + e.message; }
  })()`));

  // 2) does the JSON script even exist / have content?
  console.log('data-script =', await evl(`JSON.stringify({
    exists: !!document.getElementById('subDepartmentsData'),
    len: document.getElementById('subDepartmentsData')?.textContent.length,
    head: document.getElementById('subDepartmentsData')?.textContent.slice(0, 40),
  })`));

  // 3) re-run main script manually, capture the real exception
  console.log('manual-run =', await evl(`(function(){
    const scs = document.querySelectorAll('script');
    let main = null;
    for (const s of scs) { if ((s.textContent || '').includes('workLinkBound')) main = s.textContent; }
    if (!main) return 'main script NOT FOUND in DOM';
    const form = document.getElementById('workLinkForm');
    if (form) delete form.dataset.workLinkBound; // allow re-run
    try { (0, eval)(main); return 'RAN OK'; }
    catch (e) { return 'THROWS: ' + e.message + ' @ ' + (e.stack || '').split('\\n')[1]; }
  })()`));

  // 4) click khusus now — does panel open?
  await evl(`document.getElementById('cat-khusus')?.click()`);
  await sleep(300);
  console.log('panel after manual-run + click =', await evl(`document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel')`));

  // 5) is the change event firing at all (listeners bound)?
  await evl(`window.__chg = 0; document.getElementById('cat-khusus').addEventListener('change', () => window.__chg++);
    document.getElementById('cat-khusus').click();`);
  await sleep(200);
  console.log('change fired count =', await evl('window.__chg'));

  console.log('console errors:', errors.length ? errors : '(none)');
  process.exit(0);
}
main().catch(e => { console.error('FAIL:', e.message); process.exit(1); });
