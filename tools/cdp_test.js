/* CDP test driver — no external deps (Node 22 global WebSocket). */
const BASE = 'http://127.0.0.1:8089';
const EMAIL = 'cdp-test-admin@codebuff.local';
const PASSWORD = 'CodebuffTest#2026';

function sleep(ms) { return new Promise(r => setTimeout(r, ms)); }

async function getWsUrl() {
  const list = await (await fetch('http://127.0.0.1:9222/json/list')).json();
  let page = list.find(t => t.type === 'page');
  if (!page) {
    const ver = await (await fetch('http://127.0.0.1:9222/json/version')).json();
    // create a target via browser ws
    throw new Error('no page target — start chrome with an initial page or use /json/new');
  }
  return page.webSocketDebuggerUrl;
}

class CdpConn {
  constructor(ws) { this.ws = ws; this.id = 0; this.pending = new Map(); this.events = []; }
  static async connect(url) {
    const ws = new WebSocket(url);
    await new Promise((res, rej) => { ws.onopen = res; ws.onerror = rej; });
    const conn = new CdpConn(ws);
    ws.onmessage = (ev) => {
      const msg = JSON.parse(ev.data);
      if (msg.id && conn.pending.has(msg.id)) {
        const { res, rej } = conn.pending.get(msg.id);
        conn.pending.delete(msg.id);
        msg.error ? rej(new Error(JSON.stringify(msg.error))) : res(msg.result);
      } else if (msg.method) {
        conn.events.push(msg);
      }
    };
    return conn;
  }
  send(method, params = {}, sessionId) {
    const id = ++this.id;
    const payload = { id, method, params };
    if (sessionId) payload.sessionId = sessionId;
    this.ws.send(JSON.stringify(payload));
    return new Promise((res, rej) => this.pending.set(id, { res, rej }));
  }
  sendSession(sessionId, method, params) { return this.send(method, params, sessionId); }
  waitForEvent(method, pred = () => true, timeoutMs = 15000) {
    const found = this.events.find(e => e.method === method && pred(e));
    if (found) return found;
    return new Promise((res, rej) => {
      const t0 = Date.now();
      const iv = setInterval(() => {
        const hit = this.events.find(e => e.method === method && pred(e));
        if (hit) { clearInterval(iv); res(hit); }
        else if (Date.now() - t0 > timeoutMs) { clearInterval(iv); rej(new Error('timeout waiting ' + method)); }
      }, 100);
    });
  }
}

async function main() {
  const wsUrl = await getWsUrl();
  const conn = await CdpConn.connect(wsUrl);

  // Use the existing page target directly (single page).
  const sessionId = undefined; // direct target connection: no sessionId needed for page commands

  const ev = (name) => conn.waitForEvent(name);

  const waitLoad = () => conn.waitForEvent('Page.loadEventFired').catch(() => null);
  const nav1 = waitLoad();
  await conn.send('Page.navigate', { url: BASE + '/admin/login' });
  await Promise.race([nav1, sleep(8000)]);
  await sleep(1500);

  let r = await conn.send('Runtime.evaluate', { expression: `document.getElementById('email')?1:0`, returnByValue: true });
  console.log('login form present =', r.result.value);

  if (r.result.value) {
    await conn.send('Runtime.evaluate', {
      expression: `document.getElementById('email').value='${EMAIL}';
document.getElementById('email').dispatchEvent(new Event('input',{bubbles:true}));
const pw=document.querySelector('input[type=password]'); pw.value='${PASSWORD}'; pw.dispatchEvent(new Event('input',{bubbles:true})); document.querySelector('form').submit();`,
    });
    await sleep(4000);
  }

  // ---- navigate to work-links create page
  const nav2 = waitLoad();
  await conn.send('Page.navigate', { url: BASE + '/admin/work-links/create' });
  await Promise.race([nav2, sleep(8000)]);
  await sleep(2000);

  r = await conn.send('Runtime.evaluate', {
    expression: `JSON.stringify({
      url: location.href,
      form: !!document.getElementById('workLinkForm'),
      panel: !!document.getElementById('targetKhususPanel'),
      panelHidden: document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel'),
      catUmumLabel: document.querySelector('label[for="cat-umum"]')?.textContent.trim(),
      catKhusus: !!document.getElementById('cat-khusus'),
      scriptBound: document.getElementById('workLinkForm')?.dataset.workLinkBound,
    })`,
    returnByValue: true,
  });
  console.log('CREATE PAGE initial state:', r.result.value);

  // ---- click Khusus pill
  await conn.send('Runtime.evaluate', { expression: `__res = (function(){
  const k = document.getElementById('cat-khusus');
  if (!k) return 'no cat-khusus';
  k.click();
  const p = document.getElementById('targetKhususPanel');
  const cs = p ? getComputedStyle(p) : null;
  return JSON.stringify({ panelDisplay: cs ? cs.display : null, hiddenClass: p?.classList.contains('hidden-panel'), checked: k.checked });
})()
` , returnByValue: true}).catch(()=>{});

  await sleep(500);
  r = await conn.send('Runtime.evaluate', { expression: `__res`, returnByValue: true }).catch(e => null);
  console.log('AFTER CLICK KHUSUS:', r?.result?.value);

  // ---- toggle back to Umum then again to Khusus
  await conn.send('Runtime.evaluate', { expression: `document.getElementById('cat-umum')?.click()` });
  await sleep(300);
  await conn.send('Runtime.evaluate', { expression: `document.getElementById('cat-khusus')?.click()` });
  await sleep(300);
  r = await conn.send('Runtime.evaluate', {
    expression: `JSON.stringify({ hiddenClass: document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel'), checked: document.getElementById('cat-khusus')?.checked })`,
    returnByValue: true,
  });
  console.log('AFTER Umum->Khusus cycle:', r.result.value);

  // ---- dropdown enhancement check (dept select)
  r = await conn.send('Runtime.evaluate', {
    expression: `JSON.stringify({ deptWrap: !!document.querySelector('.pln-select-wrap'), dd: document.querySelectorAll('.pln-dd-panel').length })`,
    returnByValue: true,
  }).catch(e => null);
  console.log('dropdown check:', r?.result?.value);

  // ==========================================================
  // TES SPA: load index (full), klik "Tambah" via router SPA,
  // lalu klik pill Khusus di halaman Tambah hasil SPA-swap.
  // ==========================================================
  const nav3 = waitLoad();
  await conn.send('Page.navigate', { url: BASE + '/admin/work-links' });
  await Promise.race([nav3, sleep(8000)]);
  await sleep(1500);

  r = await conn.send('Runtime.evaluate', { expression: `JSON.stringify({ addHref: document.querySelector('a[href="${BASE}/admin/work-links/create"]')?.getAttribute('href') || document.querySelector('a[href="/admin/work-links/create"]')?.outerHTML?.slice(0, 120) })`, returnByValue: true });
  console.log('index page add-link:', r.result.value);

  await conn.send('Runtime.evaluate', { expression: `const a = document.querySelector('a[href="/admin/work-links/create"]') || [...document.querySelectorAll("a")].find(x => x.textContent.includes('Tambah')); a?.click()` });
  await sleep(2500);

  r = await conn.send('Runtime.evaluate', {
    expression: `JSON.stringify({
      url: location.href,
      form: !!document.getElementById('workLinkForm'),
      panel: !!document.getElementById('targetKhususPanel'),
      panelHidden: document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel'),
      scriptBound: document.getElementById('workLinkForm')?.dataset.workLinkBound,
    })`,
    returnByValue: true,
  });
  console.log('AFTER SPA NAV to create:', r.result.value);

  await conn.send('Runtime.evaluate', { expression: `document.getElementById('cat-khusus')?.click()` });
  await sleep(400);
  r = await conn.send('Runtime.evaluate', {
    expression: `JSON.stringify({ hiddenClass: document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel'), panelDisplay: getComputedStyle(document.getElementById('targetKhususPanel') || document.body).display })`,
    returnByValue: true,
  });
  console.log('AFTER SPA NAV + click Khusus:', r.result.value);

  // cycle again: Umum lalu Khusus
  await conn.send('Runtime.evaluate', { expression: `document.getElementById('cat-umum')?.click()` });
  await sleep(250);
  await conn.send('Runtime.evaluate', { expression: `document.getElementById('cat-khusus')?.click()` });
  await sleep(250);
  r = await conn.send('Runtime.evaluate', {
    expression: `JSON.stringify({ hiddenClass: document.getElementById('targetKhususPanel')?.classList.contains('hidden-panel') })`,
    returnByValue: true,
  });
  console.log('AFTER SPA NAV + Umum->Khusus cycle:', r.result.value);

  // screenshot
  const { writeFileSync } = await import('node:fs');
  const shot = await conn.send('Page.captureScreenshot', { format: 'png' });
  writeFileSync(process.argv[2] || 'C:/tmp/wl_create.png', Buffer.from(shot.data, 'base64'));
  console.log('screenshot saved', process.argv[2]);
}

main().catch(e => { console.error('FAIL:', e.message); process.exit(1); });
