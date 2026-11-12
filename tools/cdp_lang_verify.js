/* CDP VERIFY — Alih bahasa ID <-> EN di halaman publik.
   Memverifikasi lewat UI yang dipakai pengunjung (Chrome DevTools Protocol):

   1. Setiap halaman publik yang dipilih English benar-benar berubah bahasanya
      (tidak ada sisa kalimat Indonesia pada teks yang terlihat).
   2. Badge globe jadi "EN", pilihan tersimpan di localStorage, dan
      <html lang="en">.
   3. Ikon (Font Awesome) tidak hilang setelah teks diganti innerHTML —
      penanda struktur tombol/kartu tetap utuh.
   4. Teks yang dirakit JavaScript ikut berubah: hitungan FAQ, hitungan
      galeri, dan label kalender (nama bulan, "Today", placeholder).
   5. Tidak ada error JavaScript di konsol.

   Prasyarat: aplikasi jalan di :8000 dan Chrome debug terbuka di :9222
   (chrome --headless=new --remote-debugging-port=9222 about:blank).
   Jalankan: node tools/cdp_lang_verify.js
*/

const BASE = process.env.BASE || 'http://localhost:8000';

const PAGES = [
    '/',
    '/informasi/layanan',
    '/layanan/faq',
    '/informasi/berita',
    '/informasi/pengumuman',
    '/informasi/galeri',
    '/tentang-kami/visi-misi',
    '/tentang-kami/sejarah',
    '/tentang-kami/profil-perusahaan',
    '/tentang-kami/struktur-organisasi',
    '/layanan/form-registrasi-tamu',
];

/* Kata yang hampir pasti menandakan teks belum diterjemahkan. */
const KATA_INDONESIA = /\b(dan|yang|untuk|dengan|adalah|tidak|pada|dari|atau|akan|dapat|layanan|informasi|berita|pengumuman|unduh|biaya|daftar|lihat|selengkapnya|belum|semua|hari|kerja|kembali|beranda|tentang|kami|anda|bulan|tanggal|minggu)\b/i;

function sleep(ms) { return new Promise(r => setTimeout(r, ms)); }

const results = [];
function check(name, ok, extra) {
    results.push({ name, ok: !!ok });
    console.log((ok ? 'PASS' : 'FAIL') + ' | ' + name + (extra ? ' | ' + extra : ''));
}

/* Kumpulkan teks daun yang terlihat + jumlah ikon + status bahasa. */
const COLLECT = `(function () {
    var texts = [];
    document.querySelectorAll('h1,h2,h3,h4,h5,h6,p,li,td,th,button,a,label,small,span,option').forEach(function (el) {
        if (el.children.length) { return; }
        if (el.closest('script,style')) { return; }
        if (!el.offsetParent) { return; }
        var t = (el.textContent || '').trim();
        if (t.length >= 3) { texts.push(t); }
    });
    return JSON.stringify({
        path: location.pathname,
        icons: document.querySelectorAll('i.fas, i.far, i.fab').length,
        keys: document.querySelectorAll('[data-i18n]').length,
        badge: (document.getElementById('lang-current') || {}).textContent,
        stored: localStorage.getItem('pln_lang'),
        htmlLang: document.documentElement.getAttribute('lang'),
        texts: texts
    });
})()`;

async function main() {
    const list = await (await fetch('http://127.0.0.1:9222/json/list')).json();
    const page = list.find(t => t.type === 'page');
    if (!page) { throw new Error('Tidak ada tab Chrome di :9222'); }

    const ws = new WebSocket(page.webSocketDebuggerUrl);
    await new Promise((res, rej) => { ws.onopen = res; ws.onerror = rej; });

    let id = 0;
    const pend = new Map();
    const consoleErrors = [];

    ws.onmessage = (ev) => {
        const m = JSON.parse(ev.data);
        if (m.id && pend.has(m.id)) { const r = pend.get(m.id); pend.delete(m.id); r(m); }
        else if (m.method === 'Runtime.exceptionThrown') {
            consoleErrors.push('EXC: ' + (m.params.exceptionDetails.exception?.description || m.params.exceptionDetails.text).split('\n')[0]);
        } else if (m.method === 'Runtime.consoleAPICalled' && m.params.type === 'error') {
            consoleErrors.push('CONSOLE: ' + m.params.args.map(a => a.value ?? a.description ?? '').join(' '));
        }
    };

    const send = (method, params = {}) => new Promise((res) => {
        const mid = ++id;
        ws.send(JSON.stringify({ id: mid, method, params }));
        pend.set(mid, res);
    });

    const evl = async (expr) => {
        const r = await send('Runtime.evaluate', { expression: expr, returnByValue: true, awaitPromise: true });
        return r.result?.result?.value;
    };

    await send('Page.enable');
    await send('Runtime.enable');
    await send('Emulation.setDeviceMetricsOverride', { width: 1440, height: 1000, deviceScaleFactor: 1, mobile: false });

    const pilihBahasa = async (lang) => {
        await evl(`document.getElementById('langToggle').click()`);
        await sleep(200);
        await evl(`document.querySelector('.lang-option[data-lang="${lang}"]').click()`);
        await sleep(700);
    };

    /* ---------- 1. SEMUA HALAMAN PUBLIK ---------- */
    for (const url of PAGES) {
        await send('Page.navigate', { url: BASE + url });
        await sleep(600);
        await evl(`localStorage.setItem('pln_lang', 'id')`);
        await send('Page.navigate', { url: BASE + url });
        await sleep(2600);

        const sebelum = JSON.parse(await evl(COLLECT));
        await pilihBahasa('en');
        const sesudah = JSON.parse(await evl(COLLECT));

        const sisa = sesudah.texts.filter(t => KATA_INDONESIA.test(t));

        check(`${url} — teks berubah ke Inggris`, sisa.length === 0, sisa.slice(0, 3).join(' || ').slice(0, 160));
        check(`${url} — ikon & struktur utuh`, sebelum.icons === sesudah.icons, `${sebelum.icons} -> ${sesudah.icons}`);
        check(`${url} — badge EN + tersimpan`, sesudah.badge === 'EN' && sesudah.stored === 'en' && sesudah.htmlLang === 'en');
    }

    /* ---------- 2. TEKS YANG DIRAKIT JAVASCRIPT ---------- */
    await send('Page.navigate', { url: BASE + '/layanan/faq' });
    await sleep(2500);
    await pilihBahasa('en');

    const faqCount = await evl(`document.getElementById('faqCount').textContent`);
    check('FAQ — hitungan berbahasa Inggris', /Showing \d+ of \d+ questions/.test(faqCount || ''), faqCount);

    await evl(`document.querySelector('.faq-question').click()`);
    await sleep(600);
    const faqJawaban = await evl(`document.querySelector('.faq-answer p').textContent.trim()`);
    check('FAQ — jawaban ikut diterjemahkan', !KATA_INDONESIA.test(faqJawaban || ''), (faqJawaban || '').slice(0, 80));

    const galeri = await (async () => {
        await send('Page.navigate', { url: BASE + '/informasi/galeri' });
        await sleep(2400);
        await pilihBahasa('en');
        return evl(`(document.getElementById('galleryCount') || {}).textContent`);
    })();
    check('Galeri — hitungan foto berbahasa Inggris', /photos shown/i.test(galeri || ''), galeri);

    /* ---------- 3. KALENDER (nama bulan + label) ---------- */
    await send('Page.navigate', { url: BASE + '/layanan/form-registrasi-tamu' });
    await sleep(2600);
    await pilihBahasa('id');
    await evl(`document.getElementById('tanggal_kunjungan').click()`);
    await sleep(600);
    for (let i = 0; i < 6; i++) { await evl(`document.getElementById('cal-prev').click()`); await sleep(120); }
    const kalId = await evl(`document.getElementById('cal-title').textContent`);

    await pilihBahasa('en');
    const kalEn = await evl(`document.getElementById('cal-title').textContent`);
    const kalToday = await evl(`document.getElementById('cal-today').textContent.trim()`);
    const kalDow = await evl(`Array.from(document.querySelectorAll('.pln-cal-dow span')).map(function(s){return s.textContent.trim();}).join(',')`);

    check('Kalender — nama bulan ikut bahasa', /Mei/.test(kalId || '') && /May/.test(kalEn || ''), `${kalId} -> ${kalEn}`);
    check('Kalender — tombol "Today"', kalToday === 'Today', kalToday);
    check('Kalender — header hari Inggris', kalDow === 'Sun,Mon,Tue,Wed,Thu,Fri,Sat', kalDow);

    /* ---------- 4. KONSOL ---------- */
    check('Tidak ada error JavaScript di konsol', consoleErrors.length === 0, consoleErrors.slice(0, 3).join(' | ').slice(0, 240));

    const failed = results.filter(r => !r.ok).length;
    console.log(`\nRingkasan: ${results.length - failed} PASS, ${failed} FAIL`);
    ws.close();
    process.exit(failed ? 1 : 0);
}

main().catch((e) => { console.error('ERROR:', e); process.exit(1); });
