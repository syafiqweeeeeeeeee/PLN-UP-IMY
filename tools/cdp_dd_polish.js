/* Verifikasi polish pop-up dropdown (.pln-dd-panel):
   W1 lebar panel = 100% lebar input box
   S1 gap antara input & panel = 6px
   S2 soft shadow ter-pasang (computed)
   C1 custom scrollbar (thin) aktif saat daftar panjang
   A1 teks opsi rata presisi dengan padding teks select box (0.95rem) */
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
  let r, o, s;

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
  await sleep(300);

  // ---- buka dropdown Bidang Utama
  await evl(`document.getElementById('department')?.dispatchEvent(new MouseEvent('mousedown', { bubbles: true }))`);
  await sleep(350);

  r = await evl(`(() => {
    const sel = document.getElementById('department');
    const panel = document.querySelector('.pln-dd-panel');
    if (!panel) return JSON.stringify({ panel: false });
    const r1 = sel.getBoundingClientRect(), r2 = panel.getBoundingClientRect();
    const cs = getComputedStyle(panel);
    // offset teks item pertama dari tepi KIRI panel (via Range)
    const item = panel.querySelector('.pln-dd-item span');
    let textLeft = null;
    if (item && item.firstChild) {
      const range = document.createRange();
      range.selectNodeContents(item);
      textLeft = range.getBoundingClientRect().left - panel.getBoundingClientRect().left;
    }
    return JSON.stringify({
      panelW: r2.width.toFixed(1), selectW: r1.width.toFixed(1),
      gap: (r2.top - r1.bottom).toFixed(1),
      shadow: cs.boxShadow,
      pad: cs.padding,
      itemTextLeftFromPanel: textLeft === null ? null : textLeft.toFixed(1),
      selectPadLeft: parseFloat(getComputedStyle(sel).paddingLeft),
    });
  })()`);
  o = JSON.parse(r);
  chk('W1 lebar panel = 100% lebar input box', Math.abs(o.panelW - o.selectW) <= 1.5, o.panelW + ' vs ' + o.selectW);
  chk('S1 jarak input → panel = 6px', Math.abs(o.gap - 6) <= 1.5, o.gap);
  chk('S2 soft shadow rgba(0,0,0,0.08)', o.shadow.includes('0, 0, 0, 0.08'), o.shadow);
  const padL = o.selectPadLeft;                 // padding-left select (px)
  chk('S3a padding internal panel 0.45rem', Math.abs(o.pad.split(' ')[0].replace(/[^0-9.]/g, '') - 7.2) <= 1, o.pad);
  chk('A1 teks opsi rata presisi dengan teks select box (' + padL + 'px)',
    o.itemTextLeftFromPanel !== null && Math.abs(o.itemTextLeftFromPanel - padL) <= 1.5,
    o.itemTextLeftFromPanel);

  // sauskan visual: screenshot dropdown terbuka
  s = await send('Page.captureScreenshot', { format: 'png' });
  (await import('node:fs')).writeFileSync('C:/tmp/wl_dd_polish.png', Buffer.from(s.result.data, 'base64'));

  // ---- pilih Operasi → sub dropdown 11 item (trigger scrollbar)
  await evl(`[...document.querySelectorAll('.pln-dd-item')].find(b => b.textContent.includes('Operasi'))?.click()`);
  await sleep(350);
  await evl(`document.getElementById('sub_department')?.dispatchEvent(new MouseEvent('mousedown', { bubbles: true }))`);
  await sleep(400);
  r = await evl(`(() => {
    const sel = document.getElementById('sub_department');
    const panel = document.querySelector('.pln-dd-panel');
    if (!panel) return JSON.stringify({ panel: false });
    const results = panel.querySelector('.pln-dd-results');
    const r1 = sel.getBoundingClientRect(), r2 = panel.getBoundingClientRect();
    return JSON.stringify({
      panelW: r2.width.toFixed(1), selectW: r1.width.toFixed(1),
      scrolling: results.scrollHeight > results.clientHeight,
      scrollbarWidth: getComputedStyle(results).scrollbarWidth,
      gap: (r2.top - r1.bottom).toFixed(1),
    });
  })()`);
  o = JSON.parse(r);
  chk('W1b lebar panel sub-dropdown = 100% selebar input', Math.abs(o.panelW - o.selectW) <= 1.5, o.panelW + ' vs ' + o.selectW);
  chk('C1 scrollbar custom aktif (scrollable + thin)', o.scrolling && o.scrollbarWidth === 'thin', 'scrolling=' + o.scrolling + ', scrollbar-width=' + o.scrollbarWidth);
  chk('S1b jarak sub-dropdown = 6px', Math.abs(o.gap - 6) <= 1.5, o.gap);
  s = await send('Page.captureScreenshot', { format: 'png' });
  (await import('node:fs')).writeFileSync('C:/tmp/wl_dd_scrollbar.png', Buffer.from(s.result.data, 'base64'));

  // ---- mode gelap: beralih tema lalu lihat panel
  await evl(`document.documentElement.classList.add('theme-dark')`);
  await sleep(250);
  s = await send('Page.captureScreenshot', { format: 'png' });
  (await import('node:fs')).writeFileSync('C:/tmp/wl_dd_dark.png', Buffer.from(s.result.data, 'base64'));
  await evl(`document.documentElement.classList.remove('theme-dark')`);

  // ---- regression: dropdown engine di form Pengguna (shared component)
  await send('Page.navigate', { url: BASE + '/admin/users/create' });
  await sleep(2200);
  r = await evl(`(() => {
    const sel = document.getElementById('role_id');
    if (!sel) return 'no select';
    sel.dispatchEvent(new MouseEvent('mousedown', { bubbles: true }));
    return 'opened';
  })()`);
  await sleep(350);
  r = await evl(`(() => {
    const sel = document.getElementById('role_id');
    const panel = document.querySelector('.pln-dd-panel');
    if (!panel) return JSON.stringify({ panel: false });
    const r2 = panel.getBoundingClientRect();
    return JSON.stringify({ panelW: r2.width.toFixed(1), selectW: sel.getBoundingClientRect().width.toFixed(1) });
  })()`);
  o = JSON.parse(r);
  chk('W2 form Pengguna (shared): lebar panel = 100% kontrol', Math.abs(o.panelW - o.selectW) <= 1.5, o.panelW + ' vs ' + o.selectW);
  console.log('screenshots: C:/tmp/wl_dd_polish.png, wl_dd_scrollbar.png, wl_dd_dark.png');
  process.exit(0);
}
main().catch(e => { console.error('FAIL:', e.message); process.exit(1); });
