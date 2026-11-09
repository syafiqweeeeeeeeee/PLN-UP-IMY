/**
 * ============================================================
 * PLN THEME ENGINE — terang / gelap / ikuti sistem
 * ------------------------------------------------------------
 * Satu mesin tema untuk SELURUH portal (publik, karyawan, admin,
 * login). Menggantikan skrip tema lokal yang dulu hanya ada di
 * layout admin.
 *
 * Sumber kebenaran preferensi:
 *   1. localStorage `pln-theme` (+ `pln-theme:u{id}` per pengguna)
 *   2. cookie `pln_theme` agar server dapat merender tema yang benar
 *      pada paint pertama (cookie non-terenkripsi, lihat bootstrap/app.php)
 *   3. preferensi sistem operasi saat pilihan = `system`
 *
 * API:
 *   PlnTheme.get()      → 'light' | 'dark' | 'system'
 *   PlnTheme.set(p)     → simpan + terapkan
 *   PlnTheme.toggle()   → tukar terang ↔ gelap
 *   PlnTheme.isDark()   → tema efektif saat ini
 *   PlnTheme.sync()     → sinkronkan ikon/label tombol
 *
 * Kompatibilitas: `window.AdminTheme` tetap tersedia (dipakai
 * halaman Pengaturan) dengan perilaku yang sama.
 * ============================================================
 */
(function () {
    'use strict';

    var KEY = 'pln-theme';
    // Nama cookie HARUS sama dengan App\Support\Theme::COOKIE agar server
    // bisa merender kelas tema pada paint pertama.
    var COOKIE = 'pln_theme';
    var root = document.documentElement;
    var userId = root.getAttribute('data-user-id') || '';
    var COOKIE_AGE = 31536000; // 1 tahun

    function valid(value) {
        return value === 'light' || value === 'dark' || value === 'system';
    }

    function storageKey() {
        return userId ? KEY + ':u' + userId : KEY;
    }

    function readStored() {
        try {
            var value = localStorage.getItem(storageKey());

            if (!valid(value)) {
                value = localStorage.getItem(KEY);
            }

            return valid(value) ? value : null;
        } catch (e) {
            return null;
        }
    }

    function cookiePreference() {
        var pref = root.getAttribute('data-theme-pref');

        return valid(pref) ? pref : null;
    }

    function get() {
        return readStored() || cookiePreference() || 'system';
    }

    function systemDark() {
        return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    }

    function isDark() {
        return root.classList.contains('theme-dark');
    }

    /** Tulis cookie supaya server merender kelas tema yang sama. */
    function writeCookie(name, value) {
        var cookie = name + '=' + value + ';path=/;max-age=' + COOKIE_AGE + ';SameSite=Lax';

        if (window.location.protocol === 'https:') {
            cookie += ';Secure';
        }

        document.cookie = cookie;
    }

    /** Terapkan preferensi ke <html> tanpa menulis apa pun. */
    function apply(pref) {
        var dark = pref === 'dark' || (pref === 'system' && systemDark());

        root.classList.toggle('theme-dark', dark);
        root.setAttribute('data-theme', dark ? 'dark' : 'light');
        root.setAttribute('data-theme-pref', pref);

        var meta = document.getElementById('plnThemeColor');
        if (meta) {
            meta.setAttribute('content', dark ? '#0E1626' : '#005B9C');
        }

        sync();
    }

    /** Simpan preferensi (localStorage + cookie) lalu terapkan. */
    function set(pref) {
        if (!valid(pref)) {
            return;
        }

        try {
            localStorage.setItem(storageKey(), pref);

            // Simpan juga di kunci umum: halaman login/anonim memakai
            // preferensi terakhir yang dipilih pengguna di peramban ini.
            localStorage.setItem(KEY, pref);
            localStorage.removeItem('admin-theme');
        } catch (e) { /* mode privat → cookie tetap menyimpan */ }

        writeCookie(COOKIE, pref);

        apply(pref);

        document.dispatchEvent(new CustomEvent('pln:theme-changed', {
            detail: { theme: pref, dark: isDark() }
        }));

        // Event lama — halaman Pengaturan admin mendengarkan ini.
        document.dispatchEvent(new CustomEvent('admin:theme-changed', {
            detail: { theme: pref, dark: isDark() }
        }));
    }

    function toggle() {
        set(isDark() ? 'light' : 'dark');
    }

    /** Sinkronkan ikon, label, dan status aksesibilitas semua tombol. */
    function sync() {
        var dark = isDark();

        document.querySelectorAll('[data-theme-toggle]').forEach(function (btn) {
            btn.setAttribute('aria-pressed', dark ? 'true' : 'false');
            btn.setAttribute('aria-label', dark ? 'Aktifkan mode terang' : 'Aktifkan mode gelap');
            btn.title = dark ? 'Mode gelap aktif — klik untuk mode terang' : 'Mode terang aktif — klik untuk mode gelap';
        });

        document.querySelectorAll('[data-theme-icon]').forEach(function (icon) {
            icon.classList.toggle('fa-moon', !dark);
            icon.classList.toggle('fa-sun', dark);
        });

        // Tombol lama (#themeToggle) yang belum memakai data-theme-icon.
        var legacy = document.getElementById('themeToggle');
        if (legacy && !legacy.querySelector('[data-theme-icon]')) {
            legacy.innerHTML = dark ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            legacy.title = dark ? 'Ganti ke mode terang' : 'Ganti ke mode gelap';
        }

        document.querySelectorAll('[data-theme-label]').forEach(function (el) {
            el.textContent = dark ? 'Gelap' : 'Terang';
        });
    }

    /* ---- Klik tombol tema (delegasi: tetap jalan setelah swap konten) ---- */
    document.addEventListener('click', function (event) {
        var btn = event.target.closest ? event.target.closest('[data-theme-toggle]') : null;

        if (!btn) {
            return;
        }

        event.preventDefault();
        toggle();
    });

    /* ---- Ikuti perubahan preferensi OS saat mode "system" ---- */
    var media = window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)') : null;
    if (media) {
        var onChange = function () {
            if (get() === 'system') {
                apply('system');
                document.dispatchEvent(new CustomEvent('pln:theme-changed', {
                    detail: { theme: 'system', dark: isDark() }
                }));
            }
        };

        if (media.addEventListener) {
            media.addEventListener('change', onChange);
        } else if (media.addListener) {
            media.addListener(onChange);
        }
    }

    /* ---- Sinkron antar-tab / jendela ---- */
    window.addEventListener('storage', function (event) {
        if (event.key === null || event.key === KEY || event.key === storageKey()) {
            apply(get());
        }
    });

    /* ---- Konten hasil client-side router ikut disinkronkan ---- */
    document.addEventListener('pt:after-swap', sync);

    /* ---- State awal: koreksi per-pengguna bila perlu ---- */
    function boot() {
        apply(get());
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }

    window.PlnTheme = {
        get: get,
        set: set,
        toggle: toggle,
        isDark: isDark,
        apply: apply,
        sync: sync
    };

    // Kompatibilitas halaman Pengaturan panel admin.
    window.AdminTheme = window.PlnTheme;
})();
