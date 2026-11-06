/* CDP VERIFY — DATEPICKER GLOBAL (komponen <x-date-picker />)

   Memverifikasi hasil migrasi di browser sungguhan (app :8000):

   1. Login admin (CDP_EMAIL / CDP_PASSWORD, default akun seeder).
   2. /admin/tamu:
      - tidak ada input type="date" tersisa,
      - filter "dari"/"sampai" memakai komponen .pln-dp.is-sm,
      - kalender terbuka saat input diklik (bukan picker native),
      - panel di <body> (portal) + fixed + z-index 9999 → tidak
        terpotong/tertutup modal (overlay memakai backdrop-filter),
      - header bulan/tahun Bahasa Indonesia, hari MIN..SAB,
      - Sabtu/Minggu berwarna merah,
      - footer "Hari ini" mengisi nilai YYYY-MM-DD & menutup popup,
      - tombol "Bersihkan" mengosongkan nilai,
      - popup selalu di dalam viewport.
   3. Modal Tambah Tamu (field tanggal_kunjungan di dalam modal):
      - tanggal lampau disabled (min = hari ini),
      - memilih tanggal mengisi value + memicu event change.
   4. /admin/data-karyawan/create:
      - field tanpa batas (tanggal_lahir) TIDAK memblokir tanggal lampau,
        tetapi tetap menandai weekend merah.
   5. Tidak ada error konsol.

   Jalankan: node tools/cdp_datepicker_verify.js                       */

const BASE = process.env.CDP_BASE || 'http://127.0.0.1:8000';
// Akun uji: default akun hasil AdminUserSeeder; override lewat env bila beda.
const LOGIN_EMAIL = process.env.CDP_EMAIL || 'admin@example.com';
const LOGIN_PASSWORD = process.env.CDP_PASSWORD || 'password123';

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
        if (m.id && pend.has(m.id)) { pend.get(m.id)(m); pend.delete(m.id); return; }
        if (m.method === 'Runtime.exceptionThrown') {
            consoleErrors.push(m.params.exceptionDetails.text + ' ' +
                (m.params.exceptionDetails.exception?.description || ''));
        }
        if (m.method === 'Runtime.consoleAPICalled' && m.params.type === 'error') {
            consoleErrors.push(m.params.args.map(a => a.value || a.description || '').join(' '));
        }
    };

    const send = (method, params = {}) => new Promise((res) => {
        ws.send(JSON.stringify({ id: ++id, method, params }));
        pend.set(id, res);
    });
    const evl = async (expr) => (await send('Runtime.evaluate', {
        expression: expr, returnByValue: true, awaitPromise: true
    })).result.result?.value;

    await send('Page.enable');
    await send('Runtime.enable');

    /* Helper di halaman: panel dicari lewat aria-controls (panel di <body>). */
    const installHelpers = () => evl(`window.__dpPanel = (sel) => {
        const i = document.querySelector(sel);
        return i ? document.getElementById(i.getAttribute('aria-controls')) : null;
    }; true`);

    /* ---------- LOGIN ---------- */
    await send('Page.navigate', { url: BASE + '/admin/login' });
    await sleep(2200);
    await evl(`document.getElementById('email').value=${JSON.stringify(LOGIN_EMAIL)};
        document.querySelector('input[type=password]').value=${JSON.stringify(LOGIN_PASSWORD)};
        document.querySelector('form').submit();`);
    await sleep(3000);

    if (!await evl('!document.getElementById("email")')) {
        console.error('GAGAL LOGIN — periksa CDP_EMAIL / CDP_PASSWORD');
        process.exit(2);
    }

    /* ---------- HALAMAN ADMIN TAMU ---------- */
    await send('Page.navigate', { url: BASE + '/admin/tamu' });
    await sleep(2500);
    await installHelpers();

    check('tidak ada input type="date" tersisa (admin tamu)',
        await evl(`document.querySelectorAll('input[type="date"]').length === 0`));

    check('komponen datepicker ter-render di filter & modal',
        await evl(`document.querySelectorAll('[data-pln-datepicker]').length >= 4`),
        await evl(`document.querySelectorAll('[data-pln-datepicker]').length + ' komponen'`));

    check('filter memakai ukuran ringkas (.is-sm) + ikon & chevron',
        await evl(`!!document.querySelector('.pln-dp.is-sm input[name="dari"]') &&
                   !!document.querySelector('.pln-dp.is-sm .pln-dp-icon') &&
                   !!document.querySelector('.pln-dp.is-sm .pln-dp-chevron')`));

    /* ---------- BUKA KALENDER FILTER ---------- */
    await evl(`document.querySelector('input[name="dari"]').click()`);
    await sleep(300);

    check('kalender terbuka saat input diklik',
        await evl(`!!window.__dpPanel('input[name="dari"]') && !window.__dpPanel('input[name="dari"]').hidden`));

    check('panel dipindah ke <body> (portal) agar tidak terpotong modal',
        await evl(`window.__dpPanel('input[name="dari"]').parentNode === document.body`));

    const styleInfo = await evl(`(() => {
        const panel = window.__dpPanel('input[name="dari"]');
        const cs = getComputedStyle(panel);
        const r = panel.getBoundingClientRect();
        return { z: cs.zIndex, pos: cs.position, top: r.top, bottom: r.bottom,
                 left: r.left, right: r.right, vh: innerHeight, vw: innerWidth };
    })()`);

    check('popup z-index 9999 & position fixed', styleInfo.z === '9999' && styleInfo.pos === 'fixed',
        `z=${styleInfo.z} pos=${styleInfo.pos}`);
    check('popup tidak keluar viewport',
        styleInfo.top >= 0 && styleInfo.left >= 0 &&
        styleInfo.bottom <= styleInfo.vh && styleInfo.right <= styleInfo.vw,
        `top=${Math.round(styleInfo.top)} bottom=${Math.round(styleInfo.bottom)}/${styleInfo.vh}`);

    check('nama hari 3 huruf kapital Indonesia (MIN..SAB)',
        await evl(`(() => {
            const t = [...window.__dpPanel('input[name="dari"]').querySelectorAll('.pln-cal-dow span')]
                .map(s => s.textContent.trim());
            return JSON.stringify(t) === JSON.stringify(['MIN','SEN','SEL','RAB','KAM','JUM','SAB']);
        })()`));

    check('judul bulan + tahun Bahasa Indonesia (tebal, tengah)', await evl(`(() => {
        const panel = window.__dpPanel('input[name="dari"]');
        const title = panel.querySelector('[data-dp-title]');
        const cs = getComputedStyle(title);
        const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli',
                       'Agustus','September','Oktober','November','Desember'];
        const ok = /^[A-Za-z]+ \\d{4}$/.test(title.textContent.trim()) &&
            bulan.some(b => title.textContent.startsWith(b));
        return ok && cs.fontWeight === '700' && cs.textAlign === 'center';
    })()`));

    // Merah tema terang #DC2626 (rgb 220,38,38) / tema gelap #EF4444 (239,68,68)
    check('Sabtu & Minggu berwarna MERAH', await evl(`(() => {
        const wk = [...window.__dpPanel('input[name="dari"]').querySelectorAll('.pln-cal-day.is-weekend')];
        if (!wk.length) return false;
        return wk.every(b => ['rgb(220, 38, 38)', 'rgb(239, 68, 68)']
            .includes(getComputedStyle(b).color));
    })()`));

    check('footer "Hari ini" tersedia di pojok kanan bawah', await evl(`(() => {
        const panel = window.__dpPanel('input[name="dari"]');
        const btn = panel.querySelector('[data-dp-today]');
        if (!btn || btn.textContent.trim() !== 'Hari ini') return false;
        const foot = panel.querySelector('.pln-cal-foot');
        return getComputedStyle(foot).justifyContent === 'flex-end';
    })()`));

    /* ---------- PILIH "HARI INI" ---------- */
    const today = await evl(`PLNDatePicker.today()`);
    await evl(`window.__dpPanel('input[name="dari"]').querySelector('[data-dp-today]').click()`);
    await sleep(200);

    check('klik "Hari ini" mengisi nilai YYYY-MM-DD & menutup popup',
        await evl(`document.querySelector('input[name="dari"]').value === '${today}' &&
            window.__dpPanel('input[name="dari"]').hidden`),
        `value=${await evl(`document.querySelector('input[name="dari"]').value`)}`);

    /* ---------- BERSIHKAN ---------- */
    await evl(`document.querySelector('input[name="dari"]').click()`);
    await sleep(250);
    await evl(`window.__dpPanel('input[name="dari"]').querySelector('[data-dp-clear]').click()`);
    await sleep(200);
    check('tombol "Bersihkan" mengosongkan nilai filter',
        await evl(`document.querySelector('input[name="dari"]').value === ''`));

    /* ---------- MODAL TAMBAH TAMU ---------- */
    await evl(`openAddModal()`);
    await sleep(600);

    await evl(`document.getElementById('add-tanggal_kunjungan').click()`);
    await sleep(400);

    const modalInfo = await evl(`(() => {
        const input = document.getElementById('add-tanggal_kunjungan');
        const panel = window.__dpPanel('#add-tanggal_kunjungan');
        const cs = getComputedStyle(panel);
        const r = panel.getBoundingClientRect();
        return {
            open: !!panel && !panel.hidden,
            z: cs.zIndex,
            pos: cs.position,
            parent: panel.parentNode.tagName,
            inViewport: r.top >= 0 && r.bottom <= innerHeight && r.left >= 0 && r.right <= innerWidth,
            selected: panel.querySelectorAll('.pln-cal-day.is-selected').length,
            selectedText: (panel.querySelector('.pln-cal-day.is-selected') || {}).textContent,
            pastDisabled: [...panel.querySelectorAll('.pln-cal-day.is-past')].every(b => b.disabled),
            header: panel.querySelector('[data-dp-title]').textContent
        };
    })()`);

    check('kalender modal terbuka, portal ke <body>, tetap di atas modal (z-index 9999)',
        modalInfo.open && modalInfo.z === '9999' && modalInfo.pos === 'fixed' && modalInfo.parent === 'BODY',
        `z=${modalInfo.z} pos=${modalInfo.pos} parent=${modalInfo.parent}`);
    check('popup modal tidak keluar viewport (modal scroll ikut dijepit)',
        modalInfo.inViewport, modalInfo.header);
    check('tanggal lampau disabled di field booking (min = hari ini)',
        modalInfo.pastDisabled, modalInfo.header);
    check('nilai awal hari ini ditandai terpilih',
        modalInfo.selected === 1 && modalInfo.selectedText.trim() === String(Number(today.slice(8, 10))),
        `selected=${modalInfo.selected} text=${modalInfo.selectedText}`);

    const picked = await evl(`(() => {
        const input = document.getElementById('add-tanggal_kunjungan');
        const panel = window.__dpPanel('#add-tanggal_kunjungan');
        const day = [...panel.querySelectorAll('.pln-cal-day')]
            .find(b => !b.disabled && b.dataset.tanggal && b.dataset.tanggal !== input.value);
        if (!day) return null;
        const ymd = day.dataset.tanggal;
        day.click();
        return { ymd: ymd, value: input.value,
                 closed: panel.hidden, touched: input.dataset.touched === '1' };
    })()`);

    check('memilih tanggal mengisi value + memicu change (handler halaman jalan)',
        !!picked && picked.value === picked.ymd && picked.closed && picked.touched,
        picked ? `value=${picked.value}` : 'tidak ada tanggal yang bisa dipilih');

    const selStyle = await evl(`(() => {
        const input = document.getElementById('add-tanggal_kunjungan');
        input.click();
        const sel = window.__dpPanel('#add-tanggal_kunjungan').querySelector('.pln-cal-day.is-selected');
        const cs = sel ? getComputedStyle(sel) : null;
        return cs ? { color: cs.color, bgImage: cs.backgroundImage, radius: cs.borderRadius } : null;
    })()`);

    check('tanggal terpilih: background cyan→biru PLN, teks putih, rounded',
        !!selStyle && selStyle.color === 'rgb(255, 255, 255)' &&
        selStyle.bgImage.includes('linear-gradient') && parseFloat(selStyle.radius) >= 6,
        selStyle ? `color=${selStyle.color} radius=${selStyle.radius}` : 'tidak ada');

    await send('Page.captureScreenshot', { format: 'png' }).then(async (s) => {
        (await import('node:fs')).writeFileSync('C:/tmp/datepicker-modal.png',
            Buffer.from(s.result.data, 'base64'));
    });

    await evl(`document.dispatchEvent(new KeyboardEvent('keydown', { key: 'Escape', bubbles: true }))`);
    await sleep(200);
    check('Escape menutup kalender',
        await evl(`window.__dpPanel('#add-tanggal_kunjungan').hidden`));

    /* ---------- FIELD TANPA BATAS (tanggal lahir) ---------- */
    await send('Page.navigate', { url: BASE + '/admin/data-karyawan/create' });
    await sleep(2500);
    await installHelpers();

    check('form data karyawan memakai komponen datepicker',
        await evl(`document.querySelectorAll('[data-pln-datepicker]').length >= 6`),
        await evl(`document.querySelectorAll('[data-pln-datepicker]').length + ' komponen'`));

    await evl(`document.querySelector('input[name="tanggal_lahir"]').click()`);
    await sleep(300);

    check('field tanggal lahir: tanggal lampau tetap bisa dipilih (tanpa min)',
        await evl(`[...window.__dpPanel('input[name="tanggal_lahir"]')
            .querySelectorAll('.pln-cal-day.is-past')].length === 0`));

    check('weekend tetap ditandai merah pada field tanpa batas',
        await evl(`window.__dpPanel('input[name="tanggal_lahir"]')
            .querySelectorAll('.pln-cal-day.is-weekend').length > 0`));

    /* ---------- JALUR LEGACY: input class=".datepicker" ---------- */
    const legacy = await evl(`(async () => {
        const host = document.createElement('div');
        host.id = 'legacy-uji';
        host.innerHTML = '<input type="date" class="datepicker" name="legacy_uji" value="2026-11-10">';
        document.body.appendChild(host);
        // Tunggu MutationObserver (debounce 60 ms) menginisialisasi otomatis.
        await new Promise(r => setTimeout(r, 400));
        const input = document.querySelector('#legacy-uji input[name="legacy_uji"]');
        const root = input && input.closest('[data-pln-datepicker]');
        input.click();
        await new Promise(r => setTimeout(r, 250));
        const panel = document.getElementById(input.getAttribute('aria-controls'));
        return {
            type: input.type,
            readonly: input.readOnly,
            wrapped: !!root && root.classList.contains('pln-dp'),
            icon: !!root && !!root.querySelector('.pln-dp-icon'),
            panelInBody: !!panel && panel.parentNode === document.body,
            open: !!panel && !panel.hidden,
            value: input.value
        };
    })()`);

    check('input lama class="datepicker" otomatis naik kelas jadi kalender global',
        !!legacy && legacy.type === 'text' && legacy.readonly && legacy.wrapped && legacy.icon,
        legacy ? `type=${legacy.type} wrapper=${legacy.wrapped}` : 'gagal');
    check('kalender jalur legacy terbuka (panel di <body>) & nilai tetap YYYY-MM-DD',
        !!legacy && legacy.open && legacy.panelInBody && legacy.value === '2026-11-10',
        legacy ? `value=${legacy.value}` : 'gagal');

    await evl(`(() => {
        const input = document.querySelector('#legacy-uji input[name="legacy_uji"]');
        const panel = document.getElementById(input.getAttribute('aria-controls'));
        document.dispatchEvent(new KeyboardEvent('keydown', { key: 'Escape', bubbles: true }));
        if (panel && panel.parentNode) { panel.parentNode.removeChild(panel); }
        document.getElementById('legacy-uji').remove();
        return true;
    })()`);

    check('tidak ada error konsol', consoleErrors.length === 0, consoleErrors.slice(0, 3).join(' | '));

    console.log('\n' + (gagal === 0 ? 'SEMUA PASS' : gagal + ' CHECK GAGAL'));
    process.exit(gagal === 0 ? 0 : 1);
}

main().catch(e => { console.error('SCRIPT ERROR', e); process.exit(2); });
