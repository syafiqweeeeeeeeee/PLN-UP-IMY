/* ============================================================
   PLN DATEPICKER — GLOBAL SCRIPT
   ------------------------------------------------------------
   Mesin tunggal untuk SEMUA input tanggal di portal. Ini adalah
   port langsung dari kalender Form Registrasi Tamu (kalender
   kustom `#tanggal-calendar` di
   resources/views/layanan/form-registrasi-tamu.blade.php) agar
   tampilan & perilakunya identik di seluruh halaman:

     - Bahasa Indonesia (bulan & hari sendiri, tanpa dependency).
     - Nilai selalu YYYY-MM-DD (contoh: 2026-11-05).
     - Minggu sebagai kolom pertama (offset getDay(), 0 = Minggu).
     - Akhir pekan (Sabtu/Minggu) selalu ditandai MERAH; bisa
       diblokir dengan data-block-weekends="1".
     - Hari libur / tanggal merah bisa diblokir lewat data-blocked
       (map Y-m-d => keterangan), override weekend lewat data-work-dates.
     - Footer "Hari ini" (dan opsional "Bersihkan").
     - Popup fixed, z-index 9999, dijepit ke viewport agar tidak
       terpotong modal/card.
     - Header bulan/tahun: HANYA satu chevron (panah global layout
       dihapus lewat date-picker.css). Daftar BULAN & TAHUN dibuka
       sebagai menu kustom setinggi maksimal 200px di dalam popup,
       karena popup <select> native tidak bisa dibatasi tingginya dan
       gayanya mengikuti OS (tidak seragam dengan kalender).

   Pemakaian:
     1. Komponen Blade: <x-date-picker name="tanggal" ... />
     2. Input biasa:     <input type="date" class="datepicker" ...>
        (otomatis diubah ke text readonly + kalender global)
     3. Manual:          PLNDatePicker.init() / PLNDatePicker.attach(el)

   Auto-init: DOMContentLoaded, event `pt:after-swap` (router.js),
   dan MutationObserver untuk konten/modal yang dirender belakangan.
   ============================================================ */
(function (window, document) {
    'use strict';

    if (window.PLNDatePicker) { return; }

    /* Label mengikuti bahasa aktif (kamus public/js/i18n.js). Fungsi dipakai
       — bukan konstanta — supaya pemilihan English langsung terpakai. */
    var BULAN_ID = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    var BULAN_EN = ['January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'];
    var HARI_ID = ['MIN', 'SEN', 'SEL', 'RAB', 'KAM', 'JUM', 'SAB'];
    var HARI_EN = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];

    function isEnglish() {
        return !!(window.PLNI18N && window.PLNI18N.getLanguage && window.PLNI18N.getLanguage() === 'en');
    }

    function t(key, fallback) {
        return (window.PLNI18N && window.PLNI18N.t) ? window.PLNI18N.t(key, fallback) : fallback;
    }

    function BULAN(month) {
        return (isEnglish() ? BULAN_EN : BULAN_ID)[month];
    }

    function HARI(index) {
        return (isEnglish() ? HARI_EN : HARI_ID)[index];
    }

    var openInstance = null;
    var uid = 0;
    var scanTimer = null;

    /* ================= UTIL ================= */
    function pad2(n) { return (n < 10 ? '0' : '') + n; }

    function todayYmd() {
        var d = new Date();
        return d.getFullYear() + '-' + pad2(d.getMonth() + 1) + '-' + pad2(d.getDate());
    }

    function parseYmd(str) {
        if (!str || !/^\d{4}-\d{2}-\d{2}$/.test(String(str))) { return null; }
        var p = String(str).split('-');
        var d = new Date(Number(p[0]), Number(p[1]) - 1, Number(p[2]));
        if (isNaN(d.getTime())) { return null; }
        // Tolak tanggal "normalisasi" (mis. 2026-02-31)
        if (d.getFullYear() !== Number(p[0]) || d.getMonth() !== Number(p[1]) - 1 || d.getDate() !== Number(p[2])) {
            return null;
        }
        return d;
    }

    function toYmd(d) {
        return d.getFullYear() + '-' + pad2(d.getMonth() + 1) + '-' + pad2(d.getDate());
    }

    /** Nilai batas: '' | 'today' | 'YYYY-MM-DD' → 'YYYY-MM-DD' | null */
    function resolveBound(value) {
        if (!value) { return null; }
        if (value === 'today') { return todayYmd(); }
        return parseYmd(value) ? String(value).slice(0, 10) : null;
    }

    function readMap(root, attr) {
        var raw = root.getAttribute(attr);
        if (!raw) { return {}; }
        try {
            var parsed = JSON.parse(raw);

            // Array sederhana ['2026-11-05', ...] → map tanpa keterangan
            if (Array.isArray(parsed)) {
                var map = {};
                parsed.forEach(function (item) { if (item) { map[String(item).slice(0, 10)] = ''; } });
                return map;
            }

            if (!parsed || typeof parsed !== 'object') { return {}; }

            var out = {};
            Object.keys(parsed).forEach(function (key) {
                out[String(key).slice(0, 10)] = parsed[key];
            });
            return out;
        } catch (e) {
            return {};
        }
    }

    /* ================= INSTANCE ================= */
    function DatePicker(root, panel) {
        this.root = root;
        this.input = root.querySelector('[data-dp-input]') || root.querySelector('input');
        // Panel bisa berada di dalam root (markup komponen) atau sudah
        // dipindah/dibuat di <body> (jalur input legacy class .datepicker).
        this.panel = panel || root.querySelector('[data-dp-panel]');
        this.id = root.getAttribute('data-dp-id') || ('pln-dp-' + (++uid));
        this.viewYear = 0;
        this.viewMonth = 0;

        this._onInputClick = this.onInputClick.bind(this);
        this._onInputKeydown = this.onInputKeydown.bind(this);
        this._onPanelClick = this.onPanelClick.bind(this);
        this._onPanelMouseDown = this.onPanelMouseDown.bind(this);
        this._onPanelKeydown = this.onPanelKeydown.bind(this);
        this._onNavChange = this.onNavChange.bind(this);
        this._onReposition = this.position.bind(this);

        this.buildPanel();
        this.bind();
    }

    DatePicker.prototype.isOn = function (name) {
        var value = this.root.getAttribute('data-' + name);
        return value === '1' || value === 'true' || value === 'yes';
    };

    DatePicker.prototype.bounds = function () {
        return {
            min: resolveBound(this.root.getAttribute('data-min')),
            max: resolveBound(this.root.getAttribute('data-max'))
        };
    };

    DatePicker.prototype.blockedMap = function () { return readMap(this.root, 'data-blocked'); };
    DatePicker.prototype.workMap = function () { return readMap(this.root, 'data-work-dates'); };

    DatePicker.prototype.buildPanel = function () {
        var panel = this.panel;
        if (!panel) { return; }
        if (this.panelReady) { return; }

        panel.setAttribute('data-dp-panel', '');
        panel.setAttribute('role', 'dialog');
        panel.setAttribute('aria-modal', 'false');
        panel.setAttribute('aria-label', 'Kalender ' + (this.input.getAttribute('name') || 'tanggal'));
        if (!panel.id) { panel.id = this.id + '-panel'; }
        panel.hidden = true;

        var clearable = this.isOn('clearable');
        var monthNames = BULAN_ID.map(function (nama, index) { return BULAN(index); });
        var monthOptions = monthNames.map(function (nama, index) {
            return '<option value="' + index + '">' + nama + '</option>';
        }).join('');
        var monthMenuOptions = monthNames.map(function (nama, index) {
            return '<button type="button" class="pln-cal-month-option pln-cal-nav-option" role="option"'
                + ' data-dp-month-option="' + index + '" aria-selected="false">' + nama + '</button>';
        }).join('');
        var html = ''
            + '<div class="pln-cal-head">'
            + '  <button type="button" class="pln-cal-nav" data-dp-prev aria-label="' + t('cal.prev_month', 'Bulan sebelumnya') + '">'
            + '    <i class="fas fa-chevron-left" aria-hidden="true"></i></button>'
            + '  <div class="pln-cal-title" data-dp-title aria-live="polite">'
            + '    <span class="pln-cal-picker pln-cal-month">'
            + '      <select class="pln-cal-select" data-dp-month aria-label="' + t('cal.pick_month', 'Pilih bulan') + '"'
            + '              aria-haspopup="listbox" aria-expanded="false">' + monthOptions + '</select>'
            + '      <i class="fas fa-chevron-down pln-cal-picker-caret" aria-hidden="true"></i>'
            + '      <div class="pln-cal-nav-menu pln-cal-month-menu" data-dp-month-menu role="listbox"'
            + '           aria-label="' + t('cal.month_list', 'Daftar bulan') + '" hidden>' + monthMenuOptions + '</div>'
            + '    </span>'
            + '    <span class="pln-cal-picker pln-cal-year">'
            + '      <select class="pln-cal-select pln-cal-select-year" data-dp-year aria-label="' + t('cal.pick_year', 'Pilih tahun') + '"'
            + '              aria-haspopup="listbox" aria-expanded="false"></select>'
            + '      <i class="fas fa-chevron-down pln-cal-picker-caret" aria-hidden="true"></i>'
            + '      <div class="pln-cal-nav-menu pln-cal-year-menu" data-dp-year-menu role="listbox"'
            + '           aria-label="' + t('cal.year_list', 'Daftar tahun') + '" hidden></div>'
            + '    </span>'
            + '  </div>'
            + '  <button type="button" class="pln-cal-nav" data-dp-next aria-label="' + t('cal.next_month', 'Bulan berikutnya') + '">'
            + '    <i class="fas fa-chevron-right" aria-hidden="true"></i></button>'
            + '</div>'
            + '<div class="pln-cal-grid pln-cal-dow" aria-hidden="true">'
            + HARI_ID.map(function (h, i) { return '<span>' + HARI(i) + '</span>'; }).join('')
            + '</div>'
            + '<div class="pln-cal-grid" data-dp-days></div>'
            + '<div class="pln-cal-foot">'
            + (clearable ? '<button type="button" class="pln-cal-clear" data-dp-clear>' + t('cal.clear', 'Bersihkan') + '</button>' : '')
            + '  <button type="button" class="pln-cal-today" data-dp-today>' + t('cal.today', 'Hari ini') + '</button>'
            + '</div>';

        panel.innerHTML = html;

        // Panel dipindah ke <body>: posisi `fixed` tidak boleh terjebak
        // containing block ancestor (modal dengan backdrop-filter/transform)
        // dan z-index 9999 selalu menang atas modal.
        panel.__dpRoot = this.root;
        if (panel.parentNode !== document.body) {
            document.body.appendChild(panel);
        }

        this.titleEl = panel.querySelector('[data-dp-title]');
        this.monthSel = panel.querySelector('[data-dp-month]');
        this.monthPicker = panel.querySelector('.pln-cal-month');
        this.monthMenu = panel.querySelector('[data-dp-month-menu]');
        this.yearSel = panel.querySelector('[data-dp-year]');
        this.yearPicker = panel.querySelector('.pln-cal-year');
        this.yearMenu = panel.querySelector('[data-dp-year-menu]');
        this.daysEl = panel.querySelector('[data-dp-days]');
        this.prevBtn = panel.querySelector('[data-dp-prev]');
        this.nextBtn = panel.querySelector('[data-dp-next]');
        this.panelReady = true;

        if (this.monthMenu && this.monthSel) {
            if (!this.monthMenu.id) { this.monthMenu.id = this.id + '-month-menu'; }
            this.monthSel.setAttribute('aria-controls', this.monthMenu.id);
        }

        if (this.yearMenu && this.yearSel) {
            if (!this.yearMenu.id) { this.yearMenu.id = this.id + '-year-menu'; }
            this.yearSel.setAttribute('aria-controls', this.yearMenu.id);
        }

        this.input.setAttribute('aria-controls', panel.id);
        this.input.setAttribute('aria-haspopup', 'dialog');
        if (!this.input.hasAttribute('aria-expanded')) { this.input.setAttribute('aria-expanded', 'false'); }
    };

    DatePicker.prototype.bind = function () {
        if (this.input.dataset.dpBound !== '1') {
            this.input.dataset.dpBound = '1';
            this.input.setAttribute('autocomplete', 'off');
            this.input.setAttribute('inputmode', 'none');
            if (!this.input.hasAttribute('placeholder')) {
                this.input.setAttribute('placeholder', t('cal.pick_date', 'Pilih tanggal'));
            }
            this.input.addEventListener('click', this._onInputClick);
            this.input.addEventListener('keydown', this._onInputKeydown);
        }

        if (this.panel && this.panel.dataset.dpBound !== '1') {
            this.panel.dataset.dpBound = '1';
            this.panel.addEventListener('click', this._onPanelClick);
            this.panel.addEventListener('mousedown', this._onPanelMouseDown);
            this.panel.addEventListener('change', this._onNavChange);
            this.panel.addEventListener('keydown', this._onPanelKeydown);
        }

        // Reset form → nilai ikut dikosongkan (native date melakukan ini).
        var form = this.input.form;
        if (form && form.dataset.dpResetBound !== '1') {
            form.dataset.dpResetBound = '1';
            form.addEventListener('reset', function () {
                window.setTimeout(function () {
                    Array.prototype.forEach.call(form.querySelectorAll('[data-pln-datepicker] input, input.datepicker'), function (el) {
                        if (el.form === form && !el.defaultValue) { el.value = ''; }
                    });
                }, 0);
            });
        }
    };

    /* ---------- STATUS SATU TANGGAL ---------- */
    DatePicker.prototype.statusOf = function (ymd, dow) {
        var b = this.bounds();
        if (b.min && ymd < b.min) { return 'past'; }
        if (b.max && ymd > b.max) { return 'out'; }
        if (Object.prototype.hasOwnProperty.call(this._work, ymd)) { return 'work'; }
        if (Object.prototype.hasOwnProperty.call(this._blocked, ymd)) { return 'blocked'; }
        var weekend = (dow === 0 || dow === 6);
        if (weekend) { return this.isOn('block-weekends') ? 'locked' : 'weekend'; }
        return 'normal';
    };

    /* ---------- DROPDOWN BULAN & TAHUN ---------- */

    /** Rentang tahun yang masuk akal: dari data-year-start/data-year-end,
     *  atau diturunkan dari min/max, atau 50 tahun ke belakang s.d. 10
     *  tahun ke depan (mis. tanggal lahir / service date tetap relevan,
     *  tanggal libur tahun depan tetap bisa dipilih). */
    DatePicker.prototype.yearRange = function () {
        var b = this.bounds();
        var nowYear = new Date().getFullYear();
        var start = parseInt(this.root.getAttribute('data-year-start'), 10);
        var end = parseInt(this.root.getAttribute('data-year-end'), 10);

        if (!start || isNaN(start)) {
            start = b.min ? Number(b.min.slice(0, 4)) : nowYear - 50;
        }
        if (!end || isNaN(end)) {
            end = b.max ? Number(b.max.slice(0, 4)) : nowYear + 10;
        }

        // Tahun yang sedang dilihat selalu bisa dicapai (mis. nilai lama
        // di luar rentang default).
        if (this.viewYear < start) { start = this.viewYear; }
        if (this.viewYear > end) { end = this.viewYear; }

        return { start: start, end: end };
    };

    /** Isi opsi dropdown Tahun hanya saat rentangnya berubah. */
    DatePicker.prototype.syncNav = function () {
        if (this.monthSel) {
            this.monthSel.value = String(this.viewMonth);
        }

        var range = this.yearRange();
        var key = range.start + ':' + range.end;

        if (this.yearSel && this._yearKey !== key) {
            var optionsHtml = '';
            var menuHtml = '';
            for (var year = range.start; year <= range.end; year++) {
                optionsHtml += '<option value="' + year + '">' + year + '</option>';
                menuHtml += '<button type="button" class="pln-cal-year-option pln-cal-nav-option" role="option"'
                    + ' data-dp-year-option="' + year + '" aria-selected="false">' + year + '</button>';
            }
            this.yearSel.innerHTML = optionsHtml;
            if (this.yearMenu) { this.yearMenu.innerHTML = menuHtml; }
            this._yearKey = key;
        }

        if (this.yearSel) {
            this.yearSel.value = String(this.viewYear);
        }

        this.syncNavMenuSelection('month');
        this.syncNavMenuSelection('year');
    };

    /* ---------- DROPDOWN BULAN & TAHUN KUSTOM (di dalam popup) ----------
       Keduanya memakai satu mesin yang sama: klik pada <select> diarahkan
       ke daftar kustom (nilai tetap disimpan di <select>). Popup native
       tidak bisa dibatasi tingginya dan gayanya mengikuti OS. */

    /** Deskriptor dropdown header yang dipakai (`kind` = 'month'|'year'). */
    DatePicker.prototype.navPicker = function (kind) {
        if (kind === 'month') {
            return {
                sel: this.monthSel,
                menu: this.monthMenu,
                wrap: this.monthPicker,
                option: '[data-dp-month-option]',
                selected: '.pln-cal-month-option.is-selected',
                attr: 'data-dp-month-option',
                value: String(this.viewMonth)
            };
        }

        return {
            sel: this.yearSel,
            menu: this.yearMenu,
            wrap: this.yearPicker,
            option: '[data-dp-year-option]',
            selected: '.pln-cal-year-option.is-selected',
            attr: 'data-dp-year-option',
            value: String(this.viewYear)
        };
    };

    /** Tandai nilai aktif (bulan/tahun) di daftar kustom. */
    DatePicker.prototype.syncNavMenuSelection = function (kind) {
        var p = this.navPicker(kind);
        if (!p.menu) { return; }

        Array.prototype.forEach.call(p.menu.querySelectorAll(p.option), function (option) {
            var active = option.getAttribute(p.attr) === p.value;
            option.classList.toggle('is-selected', active);
            option.setAttribute('aria-selected', active ? 'true' : 'false');
        });
    };

    DatePicker.prototype.navMenuOpen = function (kind) {
        var p = this.navPicker(kind);
        return !!p.menu && !p.menu.hidden;
    };

    /** Bawa satu opsi ke area pandang daftar (max-height 200px). */
    function scrollNavOptionIntoView(menu, option, center) {
        var menuRect = menu.getBoundingClientRect();
        var optRect = option.getBoundingClientRect();

        if (center) {
            menu.scrollTop += (optRect.top - menuRect.top)
                - Math.round((menu.clientHeight - option.offsetHeight) / 2);
            return;
        }

        if (optRect.top < menuRect.top) {
            menu.scrollTop -= (menuRect.top - optRect.top) + 2;
        } else if (optRect.bottom > menuRect.bottom) {
            menu.scrollTop += (optRect.bottom - menuRect.bottom) + 2;
        }
    }

    DatePicker.prototype.openNavMenu = function (kind) {
        var p = this.navPicker(kind);
        if (!p.sel || !p.menu) { return; }

        // Hanya satu daftar terbuka pada satu waktu.
        this.closeNavMenu(kind === 'month' ? 'year' : 'month', false);

        this.syncNavMenuSelection(kind);
        p.menu.hidden = false;
        if (p.wrap) { p.wrap.classList.add('is-open'); }
        p.sel.setAttribute('aria-expanded', 'true');

        var active = p.menu.querySelector(p.selected) || p.menu.querySelector(p.option);
        if (!active) { return; }

        try { active.focus({ preventScroll: true }); } catch (e) { active.focus(); }
        scrollNavOptionIntoView(p.menu, active, true);
    };

    DatePicker.prototype.closeNavMenu = function (kind, refocus) {
        var p = this.navPicker(kind);
        if (!p.menu || p.menu.hidden) { return; }

        p.menu.hidden = true;
        if (p.wrap) { p.wrap.classList.remove('is-open'); }
        p.sel.setAttribute('aria-expanded', 'false');

        if (refocus) {
            try { p.sel.focus({ preventScroll: true }); } catch (e) { p.sel.focus(); }
        }
    };

    DatePicker.prototype.toggleNavMenu = function (kind) {
        // Saat ditutup, fokus dikembalikan ke select agar navigasi keyboard
        // tidak hilang bersama opsi yang disembunyikan.
        if (this.navMenuOpen(kind)) { this.closeNavMenu(kind, true); } else { this.openNavMenu(kind); }
    };

    DatePicker.prototype.pickNavValue = function (kind, value) {
        var num = Number(value);
        if (isNaN(num)) { return; }

        if (kind === 'month') {
            this.viewMonth = num;
            if (this.monthSel) { this.monthSel.value = String(num); }
        } else {
            this.viewYear = num;
            if (this.yearSel) { this.yearSel.value = String(num); }
        }

        this.closeNavMenu(kind, true);
        this.render();
        this.position();
    };

    /** Jenis daftar yang sedang terbuka ('month'|'year'|null). */
    DatePicker.prototype.openNavKind = function () {
        if (this.navMenuOpen('month')) { return 'month'; }
        if (this.navMenuOpen('year')) { return 'year'; }
        return null;
    };

    /** Tutup daftar bulan/tahun yang terbuka. true bila ada yang ditutup. */
    DatePicker.prototype.closeOpenNavMenu = function (refocus) {
        var kind = this.openNavKind();
        if (!kind) { return false; }

        this.closeNavMenu(kind, refocus);
        return true;
    };

    /* ---------- RENDER ---------- */
    DatePicker.prototype.render = function () {
        if (!this.daysEl) { return; }

        this._blocked = this.blockedMap();
        this._work = this.workMap();

        var year = this.viewYear;
        var month = this.viewMonth;
        var total = new Date(year, month + 1, 0).getDate();
        var firstDow = new Date(year, month, 1).getDay(); // 0 = Minggu
        var selected = String(this.input.value || '').slice(0, 10);
        var today = todayYmd();

        this.syncNav();
        if (this.titleEl) {
            this.titleEl.setAttribute('aria-label', BULAN(month) + ' ' + year);
        }

        var frag = document.createDocumentFragment();

        for (var i = 0; i < firstDow; i++) {
            var blank = document.createElement('button');
            blank.type = 'button';
            blank.className = 'pln-cal-day is-empty';
            blank.tabIndex = -1;
            blank.setAttribute('aria-hidden', 'true');
            frag.appendChild(blank);
        }

        for (var day = 1; day <= total; day++) {
            var ymd = year + '-' + pad2(month + 1) + '-' + pad2(day);
            var dow = new Date(year, month, day).getDay();
            var status = this.statusOf(ymd, dow);
            var btn = document.createElement('button');
            var classes = ['pln-cal-day'];

            if (status === 'weekend') { classes.push('is-weekend'); }
            if (status === 'locked') { classes.push('is-weekend', 'is-locked'); }
            if (status === 'blocked') { classes.push('is-blocked'); }
            if (status === 'past') { classes.push('is-past'); }
            if (status === 'out') { classes.push('is-out'); }
            if (status === 'work') { classes.push('is-work'); }
            if (ymd === today) { classes.push('is-today'); }
            if (ymd === selected) { classes.push('is-selected'); }

            btn.type = 'button';
            btn.className = classes.join(' ');
            btn.dataset.tanggal = ymd;
            btn.textContent = day;

            var label = day + ' ' + BULAN(month) + ' ' + year;
            if (status === 'blocked') {
                btn.disabled = true;
                var ket = this._blocked[ymd];
                btn.title = ket
                    ? t('cal.holiday_note', 'Hari libur') + ' — ' + ket
                    : t('cal.holiday', 'Hari libur / tanggal merah');
                btn.setAttribute('aria-disabled', 'true');
                label += ' — ' + btn.title;
            } else if (status === 'locked') {
                btn.disabled = true;
                btn.title = t('cal.weekend', 'Akhir pekan — kunjungan hanya pada hari kerja.');
                btn.setAttribute('aria-disabled', 'true');
                label += ' — akhir pekan';
            } else if (status === 'past') {
                btn.disabled = true;
                btn.title = t('cal.past', 'Tanggal sudah lewat.');
                btn.setAttribute('aria-disabled', 'true');
                label += ' — tanggal sudah lewat';
            } else if (status === 'out') {
                btn.disabled = true;
                btn.title = t('cal.out_of_range', 'Di luar rentang tanggal yang diizinkan.');
                btn.setAttribute('aria-disabled', 'true');
                label += ' — di luar rentang';
            } else if (status === 'work') {
                btn.title = t('cal.special_workday', 'Hari kerja khusus (override akhir pekan) — bisa dipilih.');
                label += ' — hari kerja khusus';
            }

            btn.setAttribute('aria-label', label);
            if (ymd === selected) { btn.setAttribute('aria-current', 'date'); }

            frag.appendChild(btn);
        }

        this.daysEl.innerHTML = '';
        this.daysEl.appendChild(frag);

        // Nonaktifkan panah bila bulan tujuan seluruhnya di luar rentang.
        var b = this.bounds();
        if (this.prevBtn) {
            this.prevBtn.disabled = !!(b.min && toYmd(new Date(year, month, 0)) < b.min);
        }
        if (this.nextBtn) {
            this.nextBtn.disabled = !!(b.max && toYmd(new Date(year, month + 1, 1)) > b.max);
        }
    };

    /* ---------- POSISI (fixed, dijepit viewport) ---------- */
    DatePicker.prototype.position = function () {
        var panel = this.panel;
        if (!panel || panel.hidden) { return; }

        var edge = 8;
        var gap = 6;
        var rect = this.input.getBoundingClientRect();
        var width = panel.offsetWidth;
        var height = panel.offsetHeight;
        var left = Math.min(Math.max(edge, rect.left), Math.max(edge, window.innerWidth - width - edge));
        var top = rect.bottom + gap;
        var placement = (this.root.getAttribute('data-placement') || 'auto').toLowerCase();

        if (placement === 'bottom') {
            // SELALU di bawah input — tidak pernah membalik ke atas.
            // open() sudah menggulung field bila ruang bawah kurang.
            top = Math.max(edge, top);
        } else {
            if (top + height > window.innerHeight - edge) {
                var above = rect.top - height - gap;
                top = above >= edge ? above : Math.max(edge, window.innerHeight - height - edge);
            }

            // Jepit terakhir: input bisa berada di luar viewport (modal scroll).
            top = Math.min(Math.max(edge, top), Math.max(edge, window.innerHeight - height - edge));
        }

        panel.style.left = Math.round(left) + 'px';
        panel.style.top = Math.round(top) + 'px';
    };

    /* ---------- BUKA / TUTUP ---------- */
    DatePicker.prototype.open = function () {
        if (!this.panel || this.input.disabled) { return; }
        if (openInstance && openInstance !== this) { openInstance.close(); }

        var base = parseYmd(String(this.input.value || '').slice(0, 10));
        if (!base) {
            var b = this.bounds();
            base = parseYmd(b.min) || new Date();
        }

        this.viewYear = base.getFullYear();
        this.viewMonth = base.getMonth();
        this.render();

        this.panel.hidden = false;

        // Modal bisa di-scroll: bawa field ke area pandang dulu supaya
        // popup (fixed) selalu muncul dekat input yang terlihat.
        var rect = this.input.getBoundingClientRect();
        if (rect.top < 0 || rect.bottom > window.innerHeight) {
            try { this.input.scrollIntoView({ block: 'nearest', inline: 'nearest' }); } catch (e) { /* noop */ }
        }

        // placement="bottom" tetapi ruang di bawah kurang → gulung field
        // naik (block:'start') agar popup tetap muat terbuka ke bawah.
        var placement = (this.root.getAttribute('data-placement') || 'auto').toLowerCase();
        if (placement === 'bottom') {
            rect = this.input.getBoundingClientRect();
            var gap = 6;
            var edge = 8;
            var height = this.panel.offsetHeight;
            if (rect.bottom + gap + height > window.innerHeight - edge) {
                try { this.input.scrollIntoView({ block: 'start', inline: 'nearest' }); } catch (e) { /* noop */ }
            }
        }

        this.position();

        this.root.classList.add('dp-open');
        this.input.setAttribute('aria-expanded', 'true');
        openInstance = this;

        window.addEventListener('resize', this._onReposition);
        window.addEventListener('scroll', this._onReposition, true);
    };

    DatePicker.prototype.close = function (focusInput) {
        if (!this.panel || this.panel.hidden) { return; }

        this.closeNavMenu('month', false);
        this.closeNavMenu('year', false);
        this.panel.hidden = true;
        this.root.classList.remove('dp-open');
        this.input.setAttribute('aria-expanded', 'false');

        window.removeEventListener('resize', this._onReposition);
        window.removeEventListener('scroll', this._onReposition, true);

        if (openInstance === this) { openInstance = null; }
        if (focusInput) { try { this.input.focus({ preventScroll: true }); } catch (e) { this.input.focus(); } }
    };

    DatePicker.prototype.toggle = function () {
        if (this.panel && !this.panel.hidden) { this.close(); } else { this.open(); }
    };

    /* ---------- PILIH TANGGAL ---------- */
    DatePicker.prototype.select = function (ymd) {
        var value = ymd || '';
        this.input.value = value;
        this.close();
        this.input.dispatchEvent(new Event('input', { bubbles: true }));
        this.input.dispatchEvent(new Event('change', { bubbles: true }));
        try {
            this.root.dispatchEvent(new CustomEvent('dp:change', {
                bubbles: true,
                detail: { value: value, input: this.input }
            }));
        } catch (e) { /* browser lama tanpa CustomEvent */ }
    };

    DatePicker.prototype.goToToday = function () {
        var today = todayYmd();
        var b = this.bounds();
        var blocked = this._blocked || this.blockedMap();
        var allowed = (!b.min || today >= b.min) && (!b.max || today <= b.max)
            && !Object.prototype.hasOwnProperty.call(blocked, today);

        var dow = new Date().getDay();
        if (this.isOn('block-weekends') && (dow === 0 || dow === 6)) { allowed = false; }

        if (allowed) {
            this.select(today);
            return;
        }

        // Hari ini tidak boleh dipilih → tampilkan bulan berjalan saja.
        var d = parseYmd(today) || new Date();
        this.viewYear = d.getFullYear();
        this.viewMonth = d.getMonth();
        this.render();
        this.position();
    };

    /* ---------- EVENT ---------- */
    DatePicker.prototype.onInputClick = function (e) {
        e.preventDefault();
        e.stopPropagation();
        this.toggle();
    };

    DatePicker.prototype.onInputKeydown = function (e) {
        if (e.key === 'Enter' || e.key === ' ' || e.key === 'ArrowDown') {
            e.preventDefault();
            this.open();
        } else if (e.key === 'Escape') {
            this.close();
        } else if (e.key === 'Tab') {
            this.close();
        }
    };

    DatePicker.prototype.onPanelClick = function (e) {
        var target = e.target;
        if (!target || !target.closest) { return; }

        var navPrev = target.closest('[data-dp-prev]');
        var navNext = target.closest('[data-dp-next]');
        var todayBtn = target.closest('[data-dp-today]');
        var clearBtn = target.closest('[data-dp-clear]');
        var dayBtn = target.closest('[data-dp-day], .pln-cal-day');
        var navOption = target.closest('[data-dp-month-option], [data-dp-year-option]');

        if (navOption) {
            var isMonth = navOption.hasAttribute('data-dp-month-option');
            this.pickNavValue(
                isMonth ? 'month' : 'year',
                navOption.getAttribute(isMonth ? 'data-dp-month-option' : 'data-dp-year-option')
            );
            return;
        }

        // Dropdown bulan/tahun: klik pada <select> tidak boleh dianggap
        // klik di luar panel (panel sudah punya listener stopPropagation).
        if (target.closest('[data-dp-month], [data-dp-year]')) { return; }

        // Klik di bagian lain kalender menutup daftar bulan/tahun lebih dulu.
        if (this.openNavKind() && !target.closest('.pln-cal-month, .pln-cal-year')) {
            this.closeOpenNavMenu(false);
        }

        if (navPrev) {
            this.viewMonth--;
            if (this.viewMonth < 0) { this.viewMonth = 11; this.viewYear--; }
            this.render();
            this.position();
            return;
        }

        if (navNext) {
            this.viewMonth++;
            if (this.viewMonth > 11) { this.viewMonth = 0; this.viewYear++; }
            this.render();
            this.position();
            return;
        }

        if (todayBtn) { this.goToToday(); return; }

        if (clearBtn) { this.select(''); return; }

        if (dayBtn) {
            if (dayBtn.disabled) { return; }
            var ymd = dayBtn.getAttribute('data-tanggal');
            if (ymd) { this.select(ymd); }
        }
    };

    /* Select bulan/tahun dibuka sebagai daftar kustom, BUKAN popup native:
       popup native digambar OS sehingga tingginya tidak bisa dibatasi,
       gayanya tidak seragam, dan bisa menutupi form di bawah kalender. */
    DatePicker.prototype.onPanelMouseDown = function (e) {
        var target = e.target;
        if (!target || !target.closest) { return; }

        if (target.closest('[data-dp-month]')) {
            e.preventDefault();
            this.toggleNavMenu('month');
            return;
        }

        if (target.closest('[data-dp-year]')) {
            e.preventDefault();
            this.toggleNavMenu('year');
            return;
        }

        var openKind = this.openNavKind();
        if (openKind && !target.closest(openKind === 'month' ? '.pln-cal-month' : '.pln-cal-year')) {
            this.closeNavMenu(openKind, false);
        }
    };

    DatePicker.prototype.onPanelKeydown = function (e) {
        var target = e.target;

        if (e.key === 'Escape') {
            e.preventDefault();
            if (this.closeOpenNavMenu(true)) {
                // Hentikan propagasi: handler document juga menutup panel.
                e.stopPropagation();
                return;
            }
            this.close(true);
            return;
        }

        // Select bulan/tahun: Enter/Space/panah membuka daftar kustom.
        var selectKind = null;
        if (target && target.closest) {
            if (target.closest('[data-dp-month]')) { selectKind = 'month'; }
            else if (target.closest('[data-dp-year]')) { selectKind = 'year'; }
        }
        if (selectKind && (e.key === 'Enter' || e.key === ' ' || e.key === 'ArrowDown' || e.key === 'ArrowUp')) {
            e.preventDefault();
            this.openNavMenu(selectKind);
            return;
        }

        var kind = this.openNavKind();
        if (!kind) { return; }

        var p = this.navPicker(kind);
        var options = Array.prototype.slice.call(p.menu.querySelectorAll(p.option));
        if (!options.length) { return; }

        var index = options.indexOf(document.activeElement);
        var next = null;

        if (e.key === 'ArrowDown') {
            next = options[Math.min(options.length - 1, index + 1)];
        } else if (e.key === 'ArrowUp') {
            next = options[Math.max(0, index < 0 ? options.length - 1 : index - 1)];
        } else if (e.key === 'Home') {
            next = options[0];
        } else if (e.key === 'End') {
            next = options[options.length - 1];
        }

        if (!next) { return; }

        e.preventDefault();
        try { next.focus({ preventScroll: true }); } catch (err) { next.focus(); }
        scrollNavOptionIntoView(p.menu, next, false);
    };

    /* Perubahan dropdown bulan/tahun (event `change`, bukan `click`). */
    DatePicker.prototype.onNavChange = function (e) {
        var target = e.target;
        if (!target) { return; }

        if (target.matches('[data-dp-month]')) {
            this.viewMonth = Number(target.value);
        } else if (target.matches('[data-dp-year]')) {
            this.viewYear = Number(target.value);
        } else {
            return;
        }

        this.closeOpenNavMenu(false);
        this.render();
        this.position();
    };

    /* ================= AUTO-INIT ================= */

    /** Ubah <input type="date"> biasa menjadi input teks + kalender global. */
    function normalizeLegacyInput(input) {
        if (!input || input.type !== 'date') { return; }

        var root = input.closest('[data-pln-datepicker]');
        if (root) {
            if (!root.hasAttribute('data-min') && input.getAttribute('min')) {
                root.setAttribute('data-min', input.getAttribute('min'));
            }
            if (!root.hasAttribute('data-max') && input.getAttribute('max')) {
                root.setAttribute('data-max', input.getAttribute('max'));
            }
        }

        input.type = 'text';
        input.readOnly = true;
    }

    /** Bungkus input class=".datepicker" agar punya wrapper + panel. */
    function ensureMarkup(input) {
        var root = input.closest('[data-pln-datepicker]');
        if (root) { return root; }

        root = document.createElement('div');
        root.className = 'pln-dp';
        root.setAttribute('data-pln-datepicker', '');

        var min = input.getAttribute('min');
        var max = input.getAttribute('max');
        if (min) { root.setAttribute('data-min', min); }
        if (max) { root.setAttribute('data-max', max); }
        if (input.classList.contains('datepicker-sm')) { root.classList.add('is-sm'); }

        input.parentNode.insertBefore(root, input);
        root.appendChild(input);

        input.setAttribute('data-dp-input', '');

        var icon = document.createElement('i');
        icon.className = 'fas fa-calendar-days pln-dp-icon';
        icon.setAttribute('aria-hidden', 'true');
        root.appendChild(icon);

        var chevron = document.createElement('i');
        chevron.className = 'fas fa-chevron-down pln-dp-chevron';
        chevron.setAttribute('aria-hidden', 'true');
        root.appendChild(chevron);

        return root;
    }

    function attach(element) {
        if (!element) { return null; }

        var root = element.matches && element.matches('input')
            ? (element.closest('[data-pln-datepicker]') || ensureMarkup(element))
            : element;

        if (!root || root.dataset.dpReady === '1') {
            return root && root._dpInstance ? root._dpInstance : null;
        }

        var input = root.querySelector('[data-dp-input]') || root.querySelector('input');
        if (!input) { return null; }

        // Root tanpa panel (markup kustom / input legacy) → lengkapi agar
        // tetap berfungsi. Panel langsung ditempel ke <body> (fixed).
        var panel = root.querySelector('[data-dp-panel]');
        if (!panel) {
            panel = document.createElement('div');
            panel.className = 'pln-cal';
            panel.setAttribute('data-dp-panel', '');
            panel.hidden = true;
            document.body.appendChild(panel);
        }

        if (!input.hasAttribute('data-dp-input')) { input.setAttribute('data-dp-input', ''); }

        normalizeLegacyInput(input);

        // Input kalender global selalu readonly (nilai dipilih dari popup).
        if (input.type === 'text') { input.readOnly = true; }

        var instance = new DatePicker(root, panel);
        root.dataset.dpReady = '1';
        root._dpInstance = instance;
        return instance;
    }

    function scan(scope) {
        var host = (scope && scope.querySelectorAll) ? scope : document;

        // Bersihkan panel yatim (panel dipindah ke <body>) setelah konten
        // halaman diganti router.js atau modal dihapus dari DOM.
        Array.prototype.forEach.call(document.querySelectorAll('.pln-cal[data-dp-panel]'), function (panel) {
            var root = panel.__dpRoot;
            if (root && !root.isConnected) {
                if (openInstance && openInstance.panel === panel) { openInstance = null; }
                panel.parentNode.removeChild(panel);
            }
        });

        Array.prototype.forEach.call(host.querySelectorAll('[data-pln-datepicker]'), function (root) {
            attach(root);
        });

        Array.prototype.forEach.call(host.querySelectorAll('input.datepicker, input[data-datepicker]'), function (input) {
            attach(input);
        });
    }

    function scheduleScan() {
        if (scanTimer) { return; }
        scanTimer = window.setTimeout(function () {
            scanTimer = null;
            scan();
        }, 60);
    }

    /* Tutup saat klik di luar / Escape. Dipasang sekali saja. */
    document.addEventListener('click', function (e) {
        if (!openInstance) { return; }
        if (openInstance.panel.contains(e.target) || openInstance.input === e.target) { return; }
        openInstance.close();
    }, true);

    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape' || !openInstance) { return; }

        // Escape menutup daftar bulan/tahun lebih dulu, baru popup kalender.
        if (openInstance.closeOpenNavMenu(true)) { return; }

        openInstance.close(true);
    });

    /* Router internal (public/js/router.js) menukar konten tanpa reload. */
    document.addEventListener('pt:after-swap', function () {
        if (openInstance) { openInstance.close(); }
        scheduleScan();
    });

    /* Ganti bahasa (ID <-> EN): tutup kalender yang terbuka agar label
       (nama bulan/hari, "Hari ini", tooltip) dibangun ulang dengan bahasa baru. */
    document.addEventListener('pln:languagechange', function () {
        if (openInstance) { openInstance.close(); }
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () { scan(); });
    } else {
        scan();
    }

    if (window.MutationObserver) {
        new MutationObserver(scheduleScan).observe(document.documentElement, {
            childList: true,
            subtree: true
        });
    }

    window.PLNDatePicker = {
        init: scan,
        attach: attach,
        open: function (el) { var i = attach(el); if (i) { i.open(); } },
        close: function () { if (openInstance) { openInstance.close(); } },
        today: todayYmd
    };
})(window, document);
