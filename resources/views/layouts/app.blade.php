<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title', 'PLN Nusantara Power')</title>

        <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-pln1.png') }}" />

        {{-- Font Awesome 6.3.0 — webfont CSS via cdnjs (pengganti Kit JS all.js:
             lebih ringan, tanpa JS icon-replacement, font di-download on-demand).
             media="print" + onload akan mengubah media ke 'all' sehingga
             load-nya non-blocking; <noscript> sebagai fallback. --}}
        <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
        <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
        <link rel="stylesheet" media="print" onload="this.media='all'"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
        <noscript>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        </noscript>

        {{-- Google fonts: Inter --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="dns-prefetch" href="https://fonts.googleapis.com">
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet" />

        {{-- Bootstrap 5 CSS --}}
        <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
        <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />

        {{-- Custom PLN Styles --}}
        <style>
            :root {
                /* Disamakan dengan biru teal pada section "Mulai Pengalaman
                   Baru di PLN Mobile" (gradient #00c2d1 → #008fa8); dipakai
                   navbar, footer, hero, dan elemen brand lainnya */
                --pln-blue:    #008fa8;
                --pln-yellow:  #FFE600;
                --pln-red:     #ED1C24;
                /* Aksen teal muda — selaras dengan gradasi biru teal baru
                   (dipakai hover, highlight, dan elemen aksen) */
                --pln-cyan:    #00c2d1;
                --pln-dark:    #1a1a2e;
                --pln-gray:    #F8F9FA;
                --pln-text:    #333333;
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                color: var(--pln-text);
                overflow-x: clip;
            }

            a { text-decoration: none; transition: color 0.2s ease; }

            i[class^='fa-'], i[class*=' fa-'] {
                display: inline-block;
                width: 1em;
                text-align: center;
            }

            /* NAVBAR */
            .navbar-pln {
                background: var(--pln-blue);
                padding: 0.6rem 0;
                box-shadow: 0 2px 12px rgba(0, 143, 168, 0.25);
                transition: background 0.3s ease, padding 0.3s ease;
            }

            .navbar-pln.scrolled {
                padding: 0.35rem 0;
                box-shadow: 0 4px 20px rgba(0, 143, 168, 0.35);
            }

            .navbar-pln .navbar-brand {
                color: #fff;
                font-weight: 700;
                font-size: 1.15rem;
                letter-spacing: 0.5px;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .navbar-pln .navbar-brand .brand-icon {
                width: 36px;
                height: 36px;
                background: var(--pln-yellow);
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--pln-blue);
                font-weight: 800;
                font-size: 1rem;
            }

            /* ============================================
               BRAND NAVBAR — emblem + teks (satu sumber teks)
               Struktur: <a.navbar-brand> = flex row:
               <img.emblem kuning> + <span.brand-text>.
               Tidak ada teks duplikat: span ini adalah
               SATU-SATUNYA teks branding.
               ============================================ */
            .navbar-pln .navbar-brand .brand-text {
                color: #fff;
                font-weight: 700;
                letter-spacing: 0.5px;
                white-space: nowrap;
            }
            .navbar-pln .navbar-brand .logo-nav {
                height: 52px;                /* diperbesar dari 42px */
                width: auto;
                max-width: 200px;
                object-fit: contain;
                flex-shrink: 0;
            }

            /* ============================================
               MOBILE (<640px / sm): persist Tailwind
               flex flex-col items-start gap-1
               Baris 1: emblem kuning saja (h-10 = 2.5rem)
               Baris 2: teks "PLN Nusantara Power"
               Navbar height: auto + overflow: visible agar
               konten di bawah tidak tertimpa. Desktop (≥640px)
               tetap sejajar horizontal seperti semula.
               ============================================ */
            @media (max-width: 639.98px) {
                .navbar-pln {
                    height: auto;
                    overflow: visible;
                }
                .navbar-pln .navbar-brand {
                    flex-direction: column;      /* flex-col */
                    align-items: flex-start;     /* items-start */
                    gap: 0.25rem;                /* gap-1 */
                    margin-right: 0;
                }
                /* Baris 1: emblem — diperbesar dari 2.5rem (40px) ke 3.25rem (52px) */
                .navbar-pln .navbar-brand .logo-nav {
                    height: 3.25rem;
                    width: auto;
                    margin-bottom: 0.25rem;      /* mb-1 */
                }
                /* Baris 2: teks di BAWAH logo — span asli, sudah
                   tampil karena bukan lagi d-none */
                .navbar-pln .navbar-brand .brand-text {
                    font-size: 0.8rem;
                }
                /* Hamburger TIDAK disentuh: posisi & fungsinya tetap. */
            }

            .navbar-pln .nav-link {
                color: rgba(255, 255, 255, 0.85);
                font-weight: 500;
                font-size: 0.88rem;
                padding: 0.5rem 0.85rem !important;
                border-radius: 6px;
                transition: all 0.2s ease;
            }

            .navbar-pln .nav-link:hover,
            .navbar-pln .nav-link.active {
                color: #fff;
                background: rgba(255, 255, 255, 0.12);
            }

            /* Menu aktif — tanda kuning khas PLN: teks kuning + underline.
               Parent dropdown juga menyala jika salah satu submenu-nya aktif. */
            .navbar-pln .nav-link.active:not(.dropdown-toggle) {
                color: var(--pln-yellow);
                background: rgba(255, 230, 0, 0.10);
                box-shadow: inset 0 -2px 0 var(--pln-yellow);
            }

            .navbar-pln .nav-link.dropdown-toggle.active {
                color: var(--pln-yellow);
            }

            .navbar-pln .nav-link.dropdown-toggle.active::after {
                border-top-color: var(--pln-yellow);
            }

            .navbar-pln .dropdown-menu .dropdown-item.active {
                color: var(--pln-yellow);
                background: rgba(255, 230, 0, 0.10);
            }

            .navbar-pln .navbar-toggler {
                border: 2px solid rgba(255, 255, 255, 0.5);
                padding: 0.3rem 0.6rem;
            }

            .navbar-pln .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }

            .navbar-pln .dropdown-menu {
                background: var(--pln-dark);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 10px;
                padding: 0.5rem 0;
                margin-top: 0.5rem;
                min-width: 200px;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
                animation: dropdownFade 0.2s ease;
                z-index: 1055;
            }

            @keyframes dropdownFade {
                from { opacity: 0; transform: translateY(-8px); }
                to   { opacity: 1; transform: translateY(0); }
            }

            .navbar-pln .dropdown-menu .dropdown-item {
                color: rgba(255, 255, 255, 0.75);
                font-size: 0.85rem;
                padding: 0.45rem 1.25rem;
                transition: all 0.2s ease;
            }

            .navbar-pln .dropdown-menu .dropdown-item:hover {
                color: #fff;
                background: rgba(255, 230, 0, 0.1);
                padding-left: 1.5rem;
            }

            .btn-login {
                background: var(--pln-yellow);
                color: var(--pln-blue) !important;
                font-weight: 700;
                font-size: 0.85rem;
                padding: 0.4rem 1.2rem;
                border-radius: 25px;
                border: none;
                transition: all 0.2s ease;
            }

            .btn-login:hover {
                background: #fff;
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(255, 230, 0, 0.4);
            }

            /* LANGUAGE SWITCHER */
            .lang-switcher { position: relative; z-index: 1060; }

            .lang-switcher .lang-toggle {
                display: inline-flex;
                align-items: center;
                gap: 0.35rem;
                color: rgba(255, 255, 255, 0.85);
                font-weight: 500;
                font-size: 0.88rem;
                padding: 0.5rem 0.85rem;
                border-radius: 6px;
                border: none;
                background: transparent;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .lang-switcher .lang-toggle:hover {
                color: #fff;
                background: rgba(255, 255, 255, 0.12);
            }

            .lang-switcher .caret {
                display: inline-block;
                width: 0;
                height: 0;
                margin-left: 0.25rem;
                vertical-align: middle;
                border-top: 4px dashed;
                border-right: 4px solid transparent;
                border-left: 4px solid transparent;
                transition: transform 0.2s ease;
            }

            .lang-switcher.open .caret { transform: rotate(180deg); }

            .lang-switcher .lang-menu {
                display: none;
                position: absolute;
                right: 0;
                top: 100%;
                margin-top: 0.5rem;
                list-style: none;
                background: var(--pln-dark);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 10px;
                padding: 0.5rem 0;
                min-width: 200px;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
                animation: dropdownFade 0.2s ease;
                z-index: 1070;
            }

            .lang-switcher.open .lang-menu { display: block !important; }

            .lang-switcher .lang-menu li { list-style: none; }

            .lang-switcher .lang-option {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                width: 100%;
                text-align: left;
                color: rgba(255, 255, 255, 0.75);
                font-size: 0.85rem;
                padding: 0.45rem 1.25rem;
                background: transparent;
                border: none;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .lang-switcher .lang-option:hover {
                color: #fff;
                background: rgba(0, 194, 209, 0.12);
            }

            .lang-switcher .lang-option.active {
                color: #fff;
                background: rgba(0, 194, 209, 0.18);
                font-weight: 700;
            }

            .lang-switcher .lang-option.active::after {
                content: '\2713';
                margin-left: auto;
                color: var(--pln-cyan);
            }

            /* Ikon globe pada language switcher — ukuran & perataan
               konsisten dengan teks menu navbar lainnya. */
            .lang-switcher .lang-globe {
                font-size: 0.95rem;
                line-height: 1;
            }

            /* Desktop: semua item navbar (menu + language + login)
               sejajar horizontal di tengah secara vertikal. */
            .navbar-pln .navbar-nav {
                align-items: center;
            }

            /* Pembungkus tombol Login desktop — sejajar dengan nav-link,
               tanpa margin-top yang bikin turun tidak sejajar. */
            .navbar-pln .nav-login-wrap {
                margin-top: 0;
            }

            /* Mobile (<992px): language switcher jadi baris penuh,
               dropdown bahasa mengalir dalam daftar menu (bukan melayang). */
            @media (max-width: 991.98px) {
                .navbar-pln .navbar-nav {
                    align-items: stretch;
                    padding-bottom: 0.5rem;
                }
                .navbar-pln .lang-switcher {
                    width: 100%;
                }
                .navbar-pln .lang-switcher .lang-toggle {
                    display: flex;
                    width: 100%;
                    justify-content: flex-start;
                }
                .navbar-pln .lang-switcher .lang-menu {
                    position: static;
                    display: none;
                    width: 100%;
                    margin-top: 0.25rem;
                    box-shadow: none;
                }
                .navbar-pln .lang-switcher.open .lang-menu {
                    display: block;
                }
            }

            /* HERO */
            .hero-section {
                background: linear-gradient(135deg, var(--pln-blue) 0%, #00566b 50%, var(--pln-dark) 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                position: relative;
                overflow: hidden;
                padding-top: 76px;
            }

            .hero-section .hero-content { position: relative; z-index: 2; }

            .hero-section h1 {
                font-size: 3.2rem;
                font-weight: 800;
                color: #fff;
                line-height: 1.15;
                margin-bottom: 1rem;
            }

            .hero-section h1 span { color: var(--pln-yellow); }

            .hero-section .hero-subtitle {
                font-size: 1.05rem;
                color: rgba(255, 255, 255, 0.8);
                line-height: 1.7;
                max-width: 640px;
                margin-bottom: 2rem;
            }

            .btn-hero-primary {
                background: var(--pln-yellow);
                color: var(--pln-blue);
                font-weight: 700;
                font-size: 1rem;
                padding: 0.75rem 2rem;
                border-radius: 30px;
                border: none;
                transition: all 0.3s ease;
            }

            .btn-hero-primary:hover {
                background: #fff;
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(255, 230, 0, 0.35);
                color: var(--pln-blue);
            }

            .btn-hero-outline {
                border: 2px solid rgba(255, 255, 255, 0.5);
                color: #fff;
                font-weight: 600;
                font-size: 1rem;
                padding: 0.7rem 2rem;
                border-radius: 30px;
                background: transparent;
                transition: all 0.3s ease;
            }

            .btn-hero-outline:hover {
                border-color: var(--pln-cyan);
                color: var(--pln-cyan);
                background: rgba(0, 194, 209, 0.08);
            }

            /* GENERAL */
            .section-title {
                color: var(--pln-blue);
                font-weight: 700;
                font-size: 1.75rem;
                margin-bottom: 0.5rem;
            }

            .section-subtitle {
                color: #666;
                font-size: 0.95rem;
                margin-bottom: 3rem;
            }

            .stat-card {
                background: #fff;
                border: 1px solid #e9ecef;
                border-radius: 12px;
                padding: 1.8rem 1.5rem;
                transition: all 0.3s ease;
            }

            .stat-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 30px rgba(0, 143, 168, 0.12);
                border-color: var(--pln-cyan);
            }

            .menu-card {
                background: #fff;
                border: none;
                border-radius: 12px;
                padding: 2rem 1.5rem;
                text-align: center;
                box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
                transition: all 0.3s ease;
            }

            .menu-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 8px 24px rgba(0, 143, 168, 0.15);
            }

            .footer-pln {
                background: var(--pln-blue);
                color: rgba(255, 255, 255, 0.8);
                padding: 3rem 0 1.5rem;
            }

            .footer-pln h6 { color: #fff; font-weight: 600; margin-bottom: 1rem; font-size: 0.95rem; }
            .footer-pln p, .footer-pln a { color: rgba(255, 255, 255, 0.7); font-size: 0.88rem; line-height: 1.8; }
            .footer-pln a:hover { color: var(--pln-yellow); }

            .footer-pln .footer-bottom {
                border-top: 1px solid rgba(255, 255, 255, 0.15);
                padding-top: 1.5rem;
                margin-top: 2rem;
                text-align: center;
                font-size: 0.82rem;
            }

            .footer-pln .social-links { display: flex; flex-wrap: wrap; gap: 0.6rem; }

            /* Ikon X (Twitter) — logo SVG inline (FA 6.3.0 belum punya fa-x-twitter).
               Logo X full-bleed di viewBox-nya, jadi diperkecil ke 0.9em agar
               ukuran optiknya sejajar dengan ikon Font Awesome di sebelahnya.
               display:block menghindari gap baseline inline-SVG supaya
               ter-center sempurna di dalam tombol flex. */
            .x-logo {
                width: 0.9em;
                height: 0.9em;
                display: block;
                fill: currentColor;
            }

            .footer-pln .social-links a {
                width: 40px;
                height: 40px;
                border-radius: 10px;
                background: rgba(255, 255, 255, 0.1);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 1rem;
                transition: all 0.3s ease;
            }

            .footer-pln .social-links a:hover {
                transform: translateY(-3px) scale(1.08);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            }

            .footer-pln .social-links a[href*="instagram"]:hover {
                background: linear-gradient(135deg, #833ab4, #fd1d1d, #fcb045);
                color: #fff;
            }

            .footer-pln .social-links a[href*="youtube"]:hover {
                background: #FF0000;
                color: #fff;
            }

            .logo-nav {
                height: 52px;
                width: auto;
                max-width: 200px;
                object-fit: contain;
            }

            .logo-hero {
                height: 80px;
                width: auto;
                max-width: 240px;
                object-fit: contain;
            }

            .flag-img {
                width: 20px;
                height: 14px;
                object-fit: cover;
                border-radius: 2px;
                flex-shrink: 0;
            }

            body .skiptranslate,
            .goog-te-banner-frame,
            .goog-te-menu-frame {
                display: none !important;
                height: 0 !important;
            }

            .pt-main { min-height: 70vh; }

            @media (max-width: 991.98px) {
                .hero-section h1 { font-size: 2.2rem; }
            }

            @media (max-width: 767.98px) {
                .hero-section {
                    min-height: auto;
                    padding: 6rem 0 3rem;
                }
                .hero-section h1 { font-size: 1.8rem; }
            }
        </style>

        @stack('styles')
    </head>
    <body>
        @include('layouts.navbar')

        <div class="pt-main">
            @yield('content')
        </div>

        @include('layouts.footer')

        {{-- Bootstrap JS: non-kritis (hanya untuk dropdown/toggler) — diberi defer
             agar tidak blocking parse; tetap di bagian bawah. --}}
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            (function () {
                var navbar = document.querySelector('.navbar-pln');
                if (!navbar) return;
                var ticking = false;
                window.addEventListener('scroll', function () {
                    if (ticking) return;
                    ticking = true;
                    requestAnimationFrame(function () {
                        navbar.classList.toggle('scrolled', window.scrollY > 50);
                        ticking = false;
                    });
                }, { passive: true });
            })();
        </script>

        <script src="{{ asset('js/i18n.js') }}"></script>

        @stack('scripts')
    </body>
</html>
