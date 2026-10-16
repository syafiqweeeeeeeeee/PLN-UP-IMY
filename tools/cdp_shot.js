/* Screenshot visual: form Tambah dengan panel Khusus + dropdown terbuka */
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
  const shot = async (file) => {
    const s = await send('Page.captureScreenshot', { format: 'png' });
    (await import('node:fs')).writeFileSync(file, Buffer.from(s.result.data, 'base64'));
    console.log('saved', file);
  };

  await send('Page.enable');
  await send('Page.navigate', { url: BASE + '/admin/login' });
  await sleep(2200);
  await evl(`document.getElementById('email').value='cdp-test-admin@codebuff.local';
    document.querySelector('input[type=password]').value='CodebuffTest#2026';
    document.querySelector('form').submit();`);
  await sleep(2600);

  await send('Page.navigate', { url: BASE + '/admin/work-links/create' });
  await sleep(2000);
  await evl(`document.getElementById('cat-khusus')?.click()`);
  await sleep(400);
  await shot('C:/tmp/wl_form_khusus.png');

  // buka dropdown Bidang Utama
  await evl(`document.getElementById('department')?.dispatchEvent(new MouseEvent('mousedown', { bubbles: true }))`);
  await sleep(400);
  await shot('C:/tmp/wl_form_dropdown.png');

  // tutup, pilih opsi, lalu screenshot hasil terisi
  await evl(`[...document.querySelectorAll('.pln-dd-item')].find(b => b.textContent.includes('Operasi'))?.click()`);
  await sleep(400);
  await shot('C:/tmp/wl_form_filled.png');
  process.exit(0);
}
main().catch(e => { console.error('FAIL:', e.message); process.exit(1); });
