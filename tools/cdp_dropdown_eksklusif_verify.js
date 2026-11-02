/* CDP VERIFY — Eksekusivitas dropdown Form Registrasi Tamu (bertingkat).
   Makin dipastikan tampilan rapi: hanya SATU dropdown terbuka bersamaan.

   Diverifikasi di browser sungguhan (app :8000):
   1. Klik "— Pilih Bidang —"   → menu BIDANG tampil, menu JABATAN tertutup.
   2. Klik "Pilih Jabatan" (masih bidang terbuka) → menu JABATAN tampil,
      menu BIDANG otomatis tertutup (tidak bertumpuk).
   3. Klik "— Pilih Bidang —" lagi → BIDANG tampil, JABATAN tertutup. */

const BASE = 'http://127.0.0.1:8000/layanan/form-registrasi-tamu';

const results = [];
function check(name, ok, extra) {
  results.push({ name, ok: !!ok });
  console.log((ok ? 'PASS' : 'FAIL') + ' | ' + name + (extra ? ' | ' + extra : ''));
}

function sleep(ms) { return new Promise(r => setTimeout(r, ms)); }

async function main() {
  const list = await (await fetch('http://127.0.0.1:9222/json/list')).json();
  const page = list.find(t => t.type === 'page');
  const ws = new WebSocket(page.webSocketDebuggerUrl);
  await new Promise((res, rej) => { ws.onopen = res; ws.onerror = rej; });

  let id = 0;
  const pend = new Map(); // id -> resolver
  ws.onmessage = (ev) => {
    const m = JSON.parse(ev.data);
    if (m.id && pend.has(m.id)) { const r = pend.get(m.id); pend.delete(m.id); r(m); }
  };
  function send(method, params) {
    return new Promise((res) => { const i = ++id; pend.set(i, res); ws.send(JSON.stringify({ id: i, method, params })); });
  }
  async function evaluate(expr) {
    const r = await send('Runtime.evaluate', { expression: expr, returnByValue: true });
    return r.result?.result?.value;
  }

  await send('Page.enable', {});
  await send('Page.navigate', { url: BASE });
  await sleep(2500);

  const visible = (sel) => evaluate(`
    (function () {
      var el = document.querySelector(${JSON.stringify(sel)});
      if (!el) return false;
      return getComputedStyle(el).display !== 'none';
    })()`);

  const click = (sel) => evaluate(`document.querySelector(${JSON.stringify(sel)})?.click()`);

  // 1. Buka Bidang
  await click('#tujuan_ditemui_display');
  await sleep(400);
  let bidang = await visible('#divisi-dropdown');
  let jabatan = await visible('#jabatan-dropdown');
  check('Buka Bidang: menu Bidang tampil', bidang === true, 'display=' + bidang);
  check('Buka Bidang: menu Jabatan tetap tertutup', jabatan === false, 'display=' + jabatan);

  // 2. Buka Jabatan saat Bidang sedang terbuka
  await click('#jabatan_ditemui_display');
  await sleep(400);
  bidang = await visible('#divisi-dropdown');
  jabatan = await visible('#jabatan-dropdown');
  check('Buka Jabatan: menu Jabatan tampil', jabatan === true, 'display=' + jabatan);
  check('Buka Jabatan: menu Bidang otomatis tertutup (tidak bertumpuk)', bidang === false, 'display=' + bidang);

  // 3. Balik lagi ke Bidang
  await click('#tujuan_ditemui_display');
  await sleep(400);
  bidang = await visible('#divisi-dropdown');
  jabatan = await visible('#jabatan-dropdown');
  check('Buka Bidang lagi: menu Bidang tampil', bidang === true, 'display=' + bidang);
  check('Buka Bidang lagi: menu Jabatan otomatis tertutup', jabatan === false, 'display=' + jabatan);

  ws.close();
  const fail = results.filter(r => !r.ok).length;
  console.log(fail === 0 ? 'ALL PASS (' + results.length + ' checks)' : 'FAILED: ' + fail + '/' + results.length);
  process.exit(fail === 0 ? 0 : 1);
}

main().catch(e => { console.error('FATAL: ' + e.message); process.exit(2); });
