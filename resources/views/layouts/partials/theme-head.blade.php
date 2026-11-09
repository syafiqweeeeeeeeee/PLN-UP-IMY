{{--
    ============================================================
    THEME HEAD — anti-FOUC + preferensi awal
    ------------------------------------------------------------
    Diletakkan di <head> SEBELUM stylesheet apa pun agar tema yang
    benar sudah terpasang pada paint pertama (tidak ada kedipan
    terang → gelap).
    - Preferensi awal dibaca server (cookie `pln_theme`, lihat
      App\Support\Theme) sehingga tetap benar walau JavaScript
      belum/tidak berjalan.
    - Skrip kecil di bawah menyempurnakan dua hal yang hanya bisa
      diketahui browser: preferensi `system` (matchMedia) dan nilai
      localStorage yang lebih baru dari cookie (mis. tab lain).
    - Migrasi otomatis kunci lama `admin-theme` → `pln-theme`.
    ============================================================
--}}
@php
    $plnThemePreference = \App\Support\Theme::preference(request());
    $plnThemeUserId = auth()->id();
@endphp
<meta name="color-scheme" content="light dark">
<meta name="theme-color" content="#005B9C" id="plnThemeColor">
<script>
    (function () {
        var KEY = 'pln-theme';
        var userId = @json($plnThemeUserId);
        var pref = @json($plnThemePreference);

        function valid(value) {
            return value === 'light' || value === 'dark' || value === 'system';
        }

        try {
            var stored = localStorage.getItem(userId ? KEY + ':u' + userId : KEY);

            if (!valid(stored)) {
                stored = localStorage.getItem(KEY);
            }

            // Migrasi preferensi lama panel admin.
            if (!valid(stored)) {
                var legacy = localStorage.getItem('admin-theme');
                if (valid(legacy)) {
                    stored = legacy;
                    localStorage.setItem(KEY, legacy);
                }
            }

            if (valid(stored)) {
                pref = stored;
            }
        } catch (e) { /* localStorage diblokir → pakai cookie/server */ }

        var dark = pref === 'dark' ||
            (pref === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);

        var root = document.documentElement;
        root.classList.toggle('theme-dark', dark);
        root.setAttribute('data-theme', dark ? 'dark' : 'light');
        root.setAttribute('data-theme-pref', pref);
    })();
</script>
