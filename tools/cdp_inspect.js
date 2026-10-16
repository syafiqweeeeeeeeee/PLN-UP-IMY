const BASE = 'http://127.0.0.1:9222';
async function main() {
  const list = await (await fetch(BASE + '/json/list')).json();
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
  const r1 = await send('Runtime.evaluate', {
    expression: `JSON.stringify({url: location.href, title: document.title, h1: document.querySelector('h1,h2,h4,h5')?.textContent, bodyText: document.body.innerText.slice(0, 400)})`,
    returnByValue: true,
  });
  console.log(JSON.parse(r1.result.result.value));
  await send('Runtime.disable');
  await send('Log.enable');
  process.exit(0);
}
main().catch(e => { console.error('FAIL:', e.message); process.exit(1); });
