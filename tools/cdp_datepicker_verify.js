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
      - header HANYA punya satu chevron per dropdown (panah native &
        panah global layout dihapus; dulu tampil dua panah),
      - daftar BULAN & TAHUN terbuka DI DALAM popup (bukan popup
        native OS): max-height 200px, scroll internal, tidak mengubah
        tinggi popup, memilih opsi mengisi nilai & menutup daftar,
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

    check('header memakai dropdown BULAN & TAHUN Bahasa Indonesia (tebal, tengah)', await evl(`(() => {
        const panel = window.__dpPanel('input[name="dari"]');
        const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli',
                       'Agustus','September','Oktober','November','Desember'];
        const m = panel.querySelector('[data-dp-month]');
        const y = panel.querySelector('[data-dp-year]');
        if (!m || !y) return false;
        const nama = [...m.options].map(o => o.textContent);
        const cs = getComputedStyle(m);
        return JSON.stringify(nama) === JSON.stringify(bulan) &&
            m.selectedIndex === new Date().getMonth() &&
            /^\\d{4}$/.test(y.value) &&
            cs.fontWeight === '700' &&
            (cs.appearance === 'none' || cs.webkitAppearance === 'none') &&
            parseFloat(cs.borderRadius) >= 6;
    })()`));

    check('dropdown TAHUN mencakup tahun lampau (navigasi cepat tanggal lahir)', await evl(`(() => {
        const y = window.__dpPanel('input[name="dari"]').querySelector('[data-dp-year]');
        return y.options.length >= 50 && Number(y.options[0].value) <= new Date().getFullYear() - 50;
    })()`));

    /* ---------- SATU PANAH SAJA (bukan panah ganda) ---------- */
    const arrowInfo = await evl(`(() => {
        const panel = window.__dpPanel('input[name="dari"]');
        const grab = (el) => {
            const cs = getComputedStyle(el);
            const r = el.getBoundingClientRect();
            const caret = el.parentNode.querySelector('.pln-cal-picker-caret');
            const cr = caret ? caret.getBoundingClientRect() : null;
            return {
                bgImage: cs.backgroundImage,
                appearance: cs.appearance,
                caretCount: el.parentNode.querySelectorAll('.pln-cal-picker-caret').length,
                caretInside: !!cr && cr.left >= r.left && cr.right <= r.right && cr.top >= r.top && cr.bottom <= r.bottom
            };
        };
        return {
            month: grab(panel.querySelector('[data-dp-month]')),
            year: grab(panel.querySelector('[data-dp-year]'))
        };
    })()`);

    check('header bulan/tahun: panah native & panah global layout dihapus',
        arrowInfo.month.appearance === 'none' && arrowInfo.year.appearance === 'none' &&
        arrowInfo.month.bgImage === 'none' && arrowInfo.year.bgImage === 'none',
        `month=${arrowInfo.month.bgImage} year=${arrowInfo.year.bgImage}`);

    check('header bulan/tahun: tepat SATU chevron kustom di dalam tiap chip',
        arrowInfo.month.caretCount === 1 && arrowInfo.year.caretCount === 1 &&
        arrowInfo.month.caretInside && arrowInfo.year.caretInside,
        `month=${arrowInfo.month.caretCount} year=${arrowInfo.year.caretCount}`);

    /* ---------- DAFTAR TAHUN DI DALAM POPUP (max-height + scroll) ---------- */
    const yearMenu = await evl(`(async () => {
        const panel = window.__dpPanel('input[name="dari"]');
        const sel = panel.querySelector('[data-dp-year]');
        const before = panel.getBoundingClientRect();
        sel.dispatchEvent(new MouseEvent('mousedown', { bubbles: true, cancelable: true }));
        await new Promise(r => setTimeout(r, 120));
        const menu = panel.querySelector('[data-dp-year-menu]');
        const ms = getComputedStyle(menu);
        const mr = menu.getBoundingClientRect();
        const pr = panel.getBoundingClientRect();
        return {
            open: !!menu && !menu.hidden,
            maxHeight: ms.maxHeight,
            overflowY: ms.overflowY,
            height: Math.round(mr.height),
            clipped: menu.scrollHeight > menu.clientHeight,
            insidePanel: mr.top >= pr.top && mr.bottom <= pr.bottom &&
                         mr.left >= pr.left && mr.right <= pr.right,
            panelHeightUnchanged: Math.round(pr.height) === Math.round(before.height),
            activeYear: (menu.querySelector('.pln-cal-year-option.is-selected') || {}).textContent,
            ariaExpanded: sel.getAttribute('aria-expanded')
        };
    })()`);

    check('daftar tahun terbuka DI DALAM popup (tidak menutupi form di bawahnya)',
        yearMenu.open && yearMenu.insidePanel && yearMenu.panelHeightUnchanged,
        `h=${yearMenu.height} max=${yearMenu.maxHeight}`);
    check('daftar tahun dibatasi max-height 200px + scroll internal',
        yearMenu.maxHeight === '200px' && yearMenu.overflowY === 'auto' &&
        yearMenu.height <= 200 && yearMenu.clipped,
        `max=${yearMenu.maxHeight} height=${yearMenu.height}`);
    check('tahun aktif ditandai + aria-expanded=true',
        yearMenu.ariaExpanded === 'true' && String(yearMenu.activeYear).trim() ===
            await evl(`window.__dpPanel('input[name="dari"]').querySelector('[data-dp-year]').value`),
        `active=${yearMenu.activeYear}`);

    const yearPicked = await evl(`(async () => {
        const panel = window.__dpPanel('input[name="dari"]');
        const sel = panel.querySelector('[data-dp-year]');
        const menu = panel.querySelector('[data-dp-year-menu]');
        const current = sel.value;
        const next = [...menu.querySelectorAll('[data-dp-year-option]')]
            .find(o => o.getAttribute('data-dp-year-option') !== current);
        const wanted = next.getAttribute('data-dp-year-option');
        next.click();
        await new Promise(r => setTimeout(r, 120));
        const result = {
            wanted: wanted,
            value: sel.value,
            menuClosed: menu.hidden,
            panelOpen: !panel.hidden
        };
        // Kembalikan ke tahun semula agar langkah berikutnya tidak terpengaruh.
        sel.dispatchEvent(new MouseEvent('mousedown', { bubbles: true, cancelable: true }));
        await new Promise(r => setTimeout(r, 80));
        const back = menu.querySelector('[data-dp-year-option="' + current + '"]');
        if (back) { back.click(); }
        await new Promise(r => setTimeout(r, 120));
        result.restored = sel.value === current;
        return result;
    })()`);

    check('memilih tahun dari daftar mengisi nilai & menutup daftar',
        yearPicked.value === yearPicked.wanted && yearPicked.menuClosed && yearPicked.panelOpen,
        `value=${yearPicked.value}`);
    check('daftar tahun bisa dikembalikan ke tahun semula', yearPicked.restored);

    /* ---------- DAFTAR BULAN DI DALAM POPUP (seragam dengan tahun) ---------- */
    const monthMenu = await evl(`(async () => {
        const panel = window.__dpPanel('input[name="dari"]');
        const sel = panel.querySelector('[data-dp-month]');
        const before = panel.getBoundingClientRect();
        sel.dispatchEvent(new MouseEvent('mousedown', { bubbles: true, cancelable: true }));
        await new Promise(r => setTimeout(r, 120));
        const menu = panel.querySelector('[data-dp-month-menu]');
        const ms = getComputedStyle(menu);
        const mr = menu.getBoundingClientRect();
        const pr = panel.getBoundingClientRect();
        const active = menu.querySelector('.pln-cal-month-option.is-selected');
        return {
            open: !!menu && !menu.hidden,
            maxHeight: ms.maxHeight,
            overflowY: ms.overflowY,
            height: Math.round(mr.height),
            clipped: menu.scrollHeight > menu.clientHeight,
            insidePanel: mr.top >= pr.top && mr.bottom <= pr.bottom &&
                         mr.left >= pr.left && mr.right <= pr.right,
            panelHeightUnchanged: Math.round(pr.height) === Math.round(before.height),
            options: menu.querySelectorAll('[data-dp-month-option]').length,
            active: active ? active.textContent.trim() : null,
            selectedName: [...sel.options][sel.selectedIndex].textContent,
            ariaExpanded: sel.getAttribute('aria-expanded'),
            style: ms.backgroundColor + '/' + ms.borderTopColor
        };
    })()`);

    check('daftar BULAN terbuka DI DALAM popup (12 bulan, bukan popup native)',
        monthMenu.open && monthMenu.insidePanel && monthMenu.panelHeightUnchanged && monthMenu.options === 12,
        `h=${monthMenu.height} opsi=${monthMenu.options}`);
    check('daftar bulan memakai batas tinggi & scroll yang sama (200px)',
        monthMenu.maxHeight === '200px' && monthMenu.overflowY === 'auto' &&
        monthMenu.height <= 200 && monthMenu.clipped,
        `max=${monthMenu.maxHeight} height=${monthMenu.height}`);
    check('bulan aktif ditandai + aria-expanded=true',
        monthMenu.ariaExpanded === 'true' && monthMenu.active === monthMenu.selectedName,
        `active=${monthMenu.active}`);

    const monthPicked = await evl(`(async () => {
        const panel = window.__dpPanel('input[name="dari"]');
        const sel = panel.querySelector('[data-dp-month]');
        const menu = panel.querySelector('[data-dp-month-menu]');
        const current = sel.value;
        const next = [...menu.querySelectorAll('[data-dp-month-option]')]
            .find(o => o.getAttribute('data-dp-month-option') !== current);
        const wanted = next.getAttribute('data-dp-month-option');
        const wantedName = next.textContent.trim();
        next.click();
        await new Promise(r => setTimeout(r, 150));
        const result = {
            wanted: wanted,
            value: sel.value,
            menuClosed: menu.hidden,
            panelOpen: !panel.hidden,
            header: panel.querySelector('[data-dp-title]').getAttribute('aria-label')
        };
        // Kembalikan ke bulan semula agar langkah berikutnya tidak terpengaruh.
        sel.dispatchEvent(new MouseEvent('mousedown', { bubbles: true, cancelable: true }));
        await new Promise(r => setTimeout(r, 80));
        const back = menu.querySelector('[data-dp-month-option="' + current + '"]');
        if (back) { back.click(); }
        await new Promise(r => setTimeout(r, 120));
        result.restored = sel.value === current;
        result.wantedName = wantedName;
        return result;
    })()`);

    check('memilih bulan dari daftar mengisi nilai, menutup daftar & render ulang',
        monthPicked.value === monthPicked.wanted && monthPicked.menuClosed &&
        monthPicked.panelOpen && monthPicked.header.indexOf(monthPicked.wantedName) === 0,
        `value=${monthPicked.value} header=${monthPicked.header}`);
    check('daftar bulan bisa dikembalikan ke bulan semula', monthPicked.restored);

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
            header: panel.querySelector('[data-dp-title]').getAttribute('aria-label')
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
