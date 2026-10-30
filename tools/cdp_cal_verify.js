/* CDP VERIFY — Kalender kustom tanggal kunjungan (form registrasi publik).

   Menggantikan datepicker native browser, satu-satunya cara memberi warna
   per-hari. Diverifikasi di browser sungguhan (app :8000):

   1. Klik input tanggal → widget kalender terbuka (bukan picker native).
   2. Oktober 2026:
      - 31 Okt (Sabtu, tipe libur)   → MERAH (is-red) & disabled.
   3. November 2026 (data uji: 04 Nov libur, 07 Nov masuk_kerja,
      01 Nov masuk_kerja, sisanya default):
      - 01 Nov (Minggu, masuk_kerja) → HITAM (is-masuk) & BISA dipilih.
      - 04 Nov (Rabu, tipe libur)    → MERAH (is-red) & disabled.
      - 07 Nov (Sabtu, masuk_kerja)  → HITAM (is-masuk) & BISA dipilih.
      - 08 Nov (Minggu, tanpa baris) → MERAH (is-red) & disabled.
      - 05 Nov (Kamis, biasa)        → normal & bisa dipilih.
   4. Klik 07 Nov → value input terisi, kalender tertutup, valid.
   5. Klik 08 Nov (disabled) → value tidak berubah.
   6. Tidak ada error konsol. */

const BASE = 'http://127.0.0.1:8000';

function sleep(ms) { return new Promise(r => setTimeout(r, ms)); }
let gagal = 0;
function check(name, ok, extra) {
  console.log((ok ? 'PASS' : 'FAIL') + ' | ' + name + (extra ? ' | ' + extra : ''));
  if (!ok) gagal++;
}

async function main() {
  const list = await (await fetch('http://127.0.0.1:9222/json/list')).json();
  const page = list.find(t => t.type === 'page');
  const ws = new WebSocket(page.webSocketDebuggerUrl);
  await new Promise((res, rej) => { ws.onopen = res; ws.onerror = rej; });

  let id = 0;
  const pend = new Map();
  const consoleErrors = [];
  ws.onmessage = (ev) => {
    const m = JSON.parse(ev.data);
    if (m.id && pend.has(m.id)) { const r = pend.get(m.id); pend.delete(m.id); r(m); }
    else if (m.method === 'Runtime.consoleAPICalled' && m.params.type === 'error') {
      consoleErrors.push(m.params.args.map(a => a.value ?? a.description ?? '').join(' '));
    } else if (m.method === 'Runtime.exceptionThrown') {
      consoleErrors.push('EXC: ' + (m.params.exceptionDetails.exception?.description || m.params.exceptionDetails.text));
    }
  };
  const send = (method, params = {}) => new Promise((res) => {
    const mid = ++id;
    ws.send(JSON.stringify({ id: mid, method, params }));
    pend.set(mid, res);
  });
  const evl = async (expr) => {
    const r = await send('Runtime.evaluate', { expression: expr, returnByValue: true, awaitPromise: true });
    if (r.result?.exceptionDetails) throw new Error(JSON.stringify(r.result.exceptionDetails));
    return r.result?.result?.value;
  };

  await send('Page.enable');
  await send('Runtime.enable');

  await send('Page.navigate', { url: BASE + '/layanan/form-registrasi-tamu' });
  await sleep(3000);

  // 1. Tidak ada datepicker native; input berupa teks readonly + widget kalender.
  check('input tanggal type=text readonly',
    await evl(`document.getElementById('tanggal_kunjungan').type === 'text'
      && document.getElementById('tanggal_kunjungan').readOnly`));
  check('tidak ada <input type=date> di halaman',
    await evl(`document.querySelectorAll('input[type=date]').length === 0`));

  // 2. Klik input → kalender terbuka di Oktober 2026.
  await evl(`document.getElementById('tanggal_kunjungan').click()`);
  await sleep(400);
  check('kalender terbuka saat klik input',
    await evl(`!document.getElementById('tanggal-calendar').hidden`));
  check('judul bulan = Oktober 2026',
    await evl(`document.getElementById('cal-title').textContent`) === 'Oktober 2026',
    await evl(`document.getElementById('cal-title').textContent`));

  // Sabtu 31 Okt bertipe libur → tetap merah (bukan hitam).
  const okt = JSON.parse(await evl(`JSON.stringify((() => {
    const b = document.querySelector('#cal-days [data-tanggal="2026-10-31"]');
    if (!b) return { ada: false };
    return { ada: true, kelas: b.className, disabled: b.disabled,
             warna: getComputedStyle(b).backgroundColor };
  })())`));
  check('31 Okt (Sabtu, tipe libur) MERAH & disabled',
    okt.ada && /is-red/.test(okt.kelas) && okt.disabled === true && okt.warna === 'rgb(254, 226, 226)',
    JSON.stringify(okt));

  // 3. Pindah ke November 2026.
  await evl(`document.getElementById('cal-next').click()`);
  await sleep(300);
  check('judul bulan = November 2026',
    await evl(`document.getElementById('cal-title').textContent`) === 'November 2026');

  const hari = JSON.parse(await evl(`JSON.stringify((() => {
    const ambil = (d) => {
      const b = document.querySelector('#cal-days [data-tanggal="' + d + '"]');
      if (!b) return { ada: false };
      return { ada: true, kelas: b.className, disabled: b.disabled,
               warna: getComputedStyle(b).backgroundColor };
    };
    return {
      mingguMasuk: ambil('2026-11-01'), // Minggu, masuk_kerja (override)
      merah: ambil('2026-11-04'),       // Rabu, tipe libur
      masuk: ambil('2026-11-07'),       // Sabtu, tipe masuk_kerja
      minggu: ambil('2026-11-08'),      // Minggu, tanpa baris
      biasa: ambil('2026-11-05'),       // Kamu, hari kerja biasa
    };
  })())`));

  check('01 Nov (override weekend) HITAM & aktif',
    hari.mingguMasuk.ada && /is-masuk/.test(hari.mingguMasuk.kelas) && hari.mingguMasuk.disabled === false
      && hari.mingguMasuk.warna === 'rgb(17, 24, 39)', JSON.stringify(hari.mingguMasuk));
  check('04 Nov (libur) MERAH & disabled',
    hari.merah.ada && /is-red/.test(hari.merah.kelas) && hari.merah.disabled === true
      && hari.merah.warna === 'rgb(254, 226, 226)', JSON.stringify(hari.merah));
  check('07 Nov (override weekend) HITAM & aktif',
    hari.masuk.ada && /is-masuk/.test(hari.masuk.kelas) && hari.masuk.disabled === false
      && hari.masuk.warna === 'rgb(17, 24, 39)', JSON.stringify(hari.masuk));
  check('08 Nov (Minggu tanpa override) MERAH & disabled',
    hari.minggu.ada && /is-red/.test(hari.minggu.kelas) && hari.minggu.disabled === true
      && hari.minggu.warna === 'rgb(254, 226, 226)', JSON.stringify(hari.minggu));
  check('05 Nov (hari kerja biasa) normal & aktif',
    hari.biasa.ada && !/is-red|is-masuk|is-past/.test(hari.biasa.kelas)
      && hari.biasa.disabled === false, JSON.stringify(hari.biasa));

  // 4. Klik hari terizinkan (07 Nov) → value terisi, kalender tutup, valid.
  await evl(`document.querySelector('#cal-days [data-tanggal="2026-11-07"]').click()`);
  await sleep(400);
  const setelah = JSON.parse(await evl(`JSON.stringify({
    value: document.getElementById('tanggal_kunjungan').value,
    tertutup: document.getElementById('tanggal-calendar').hidden,
    valid: document.getElementById('tanggal_kunjungan').checkValidity()
  })`));
  check('klik 07 Nov → value terisi & kalender tertutup',
    setelah.value === '2026-11-07' && setelah.tertutup === true && setelah.valid === true,
    JSON.stringify(setelah));

  // 5. Klik hari disabled (08 Nov) → value tidak berubah.
  await evl(`document.getElementById('tanggal_kunjungan').click()`);
  await sleep(300);
  await evl(`document.getElementById('cal-next').click()`);
  await sleep(200);
  await evl(`const b = document.querySelector('#cal-days [data-tanggal="2026-11-08"]');
    if (b) b.click();`);
  await sleep(300);
  const tolak = JSON.parse(await evl(`JSON.stringify({
    value: document.getElementById('tanggal_kunjungan').value,
    masihBuka: !document.getElementById('tanggal-calendar').hidden
  })`));
  check('klik 08 Nov (disabled) → value TIDAK berubah',
    tolak.value === '2026-11-07', JSON.stringify(tolak));

  // 6. Hari ini (30 Okt, libur) tampil merah; tombol Hari ini tidak memilihnya.
  check('tanpa error konsol', consoleErrors.length === 0, consoleErrors.join(' | ').slice(0, 300));

  console.log(gagal === 0 ? '\nSEMUA VERIFIKASI LULUS' : `\nGAGAL: ${gagal}`);
  ws.close();
  process.exit(gagal === 0 ? 0 : 1);
}

main().catch(e => { console.error('ERROR', e); process.exit(1); });
