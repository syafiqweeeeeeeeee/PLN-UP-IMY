<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="E-PPID PLN - Layanan Informasi Publik" />
        <meta name="author" content="PLN" />
        <title>@yield('title', 'E-PPID PLN')</title>

        {{-- Favicon --}}
        <link rel="icon" type="image/x-icon" href="{{ asset('startbootstrap-grayscale-gh-pages/assets/favicon.ico') }}" />

        {{-- Font Awesome icons --}}
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        {{-- Feather Icons --}}
        <script src="https://unpkg.com/feather-icons"></script>

        {{-- Google fonts: Inter --}}
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

        {{-- Bootstrap 5 CSS --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />

        {{-- Custom PLN Styles --}}
        <style>
            /* =============================================
               PALET WARNA PLN
               ============================================= */
            :root {
                --pln-blue:    #005B9C;
                --pln-yellow:  #FFE600;
                --pln-red:     #ED1C24;
                --pln-cyan:    #00A3E0;
                --pln-dark:    #1a1a2e;
                --pln-gray:    #F8F9FA;
                --pln-text:    #333333;
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                color: var(--pln-text);
                /* clip (bukan hidden): overflow hidden membuat body menjadi
                   scroll container dan merusak position: sticky anak-anaknya */
                overflow-x: clip;
            }

            a {
                text-decoration: none;
                transition: color 0.2s ease;
            }

            /* =============================================
               NAVBAR
               ============================================= */
            .navbar-pln {
                background: var(--pln-blue);
                padding: 0.6rem 0;
                box-shadow: 0 2px 12px rgba(0, 91, 156, 0.25);
                transition: background 0.3s ease, padding 0.3s ease;
            }

            .navbar-pln.scrolled {
                background: var(--pln-blue);
                padding: 0.35rem 0;
                box-shadow: 0 4px 20px rgba(0, 91, 156, 0.35);
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

            .navbar-pln .navbar-toggler {
                border: 2px solid rgba(255, 255, 255, 0.5);
                padding: 0.3rem 0.6rem;
            }

            .navbar-pln .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }

            /* =============================================
               DROPDOWN
               ============================================= */
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

            .navbar-pln .dropdown {
                position: relative;
            }

            @keyframes dropdownFade {
                from { opacity: 0; transform: translateY(-8px); }
                to   { opacity: 1; transform: translateY(0); }
            }

            .navbar-pln .dropdown-menu .dropdown-item {
                color: rgba(255, 255, 255, 0.75);
                font-size: 0.85rem;
                font-weight: 400;
                padding: 0.45rem 1.25rem;
                transition: all 0.2s ease;
            }

            .navbar-pln .dropdown-menu .dropdown-item:hover {
                color: #fff;
                background: rgba(255, 230, 0, 0.1);
                padding-left: 1.5rem;
            }

            .navbar-pln .dropdown-toggle::after {
                font-size: 0.65rem;
                margin-left: 0.35rem;
                vertical-align: middle;
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

            /* =============================================
               LANGUAGE SWITCHER (GLOBE DROPDOWN)
               ============================================= */
            .lang-switcher {
                position: relative;
                z-index: 1060;
            }

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
                border-top: 4px solid \\9;
                border-right: 4px solid transparent;
                border-left: 4px solid transparent;
                transition: transform 0.2s ease;
            }

            .lang-switcher.open .caret {
                transform: rotate(180deg);
            }

            /* Dropdown menu */
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

            .lang-switcher.open .lang-menu {
                display: block !important;
            }

            .lang-switcher .lang-menu li {
                list-style: none;
            }

            .lang-switcher .lang-option {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                width: 100%;
                text-align: left;
                color: rgba(255, 255, 255, 0.75);
                font-size: 0.85rem;
                font-weight: 500;
                padding: 0.45rem 1.25rem;
                background: transparent;
                border: none;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .lang-switcher .lang-option:hover {
                color: #fff;
                background: rgba(0, 163, 224, 0.12);
            }

            .lang-switcher .lang-option.active {
                color: #fff;
                background: rgba(0, 163, 224, 0.18);
                font-weight: 700;
            }

            .lang-switcher .lang-option.active::after {
                content: '\2713';
                margin-left: auto;
                color: var(--pln-cyan);
            }

            /* =============================================
               HERO SECTION
               ============================================= */
            .hero-section {
                background: linear-gradient(135deg, var(--pln-blue) 0%, #003d6b 50%, var(--pln-dark) 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                position: relative;
                overflow: hidden;
                padding-top: 76px;
            }

            .hero-section::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -20%;
                width: 700px;
                height: 700px;
                background: radial-gradient(circle, rgba(0, 163, 224, 0.15) 0%, transparent 70%);
                border-radius: 50%;
            }

            .hero-section::after {
                content: '';
                position: absolute;
                bottom: -30%;
                left: -10%;
                width: 500px;
                height: 500px;
                background: radial-gradient(circle, rgba(255, 230, 0, 0.08) 0%, transparent 70%);
                border-radius: 50%;
            }

            .hero-content {
                position: relative;
                z-index: 2;
            }

            .hero-section h1 {
                font-size: 3.2rem;
                font-weight: 800;
                color: #fff;
                line-height: 1.15;
                margin-bottom: 1rem;
            }

            .hero-section h1 span {
                color: var(--pln-yellow);
            }

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
                background: rgba(0, 163, 224, 0.08);
            }

            /* =============================================
               MEKANISME SECTION
               ============================================= */
            .mekanisme-section {
                padding: 5rem 0;
                background: #fff;
            }

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

            .step-card {
                background: #fff;
                border: 1px solid #e9ecef;
                border-radius: 12px;
                padding: 2rem 1.5rem;
                text-align: center;
                transition: all 0.3s ease;
                height: 100%;
                position: relative;
            }

            .step-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 12px 30px rgba(0, 91, 156, 0.12);
                border-color: var(--pln-cyan);
            }

            .step-number {
                width: 52px;
                height: 52px;
                background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan));
                color: #fff;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                font-weight: 700;
                margin: 0 auto 1rem;
            }

            .step-card h5 {
                color: var(--pln-blue);
                font-weight: 600;
                font-size: 1rem;
                margin-bottom: 0.75rem;
            }

            .step-card p {
                color: #666;
                font-size: 0.88rem;
                line-height: 1.6;
                margin-bottom: 0;
            }

            .step-icon {
                font-size: 2rem;
                color: var(--pln-cyan);
                margin-bottom: 0.75rem;
            }

            /* =============================================
               QUICK MENU SECTION
               ============================================= */
            .quick-menu-section {
                padding: 4rem 0;
                background: var(--pln-gray);
            }

            .menu-card {
                background: #fff;
                border: none;
                border-radius: 12px;
                padding: 2rem 1.5rem;
                text-align: center;
                box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
                transition: all 0.3s ease;
                height: 100%;
            }

            .menu-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 8px 24px rgba(0, 91, 156, 0.15);
            }

            .menu-card .icon-circle {
                width: 64px;
                height: 64px;
                border-radius: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                margin: 0 auto 1rem;
                color: #fff;
            }

            .menu-card h5 {
                font-weight: 600;
                font-size: 0.95rem;
                color: var(--pln-blue);
                margin-bottom: 0.5rem;
            }

            .menu-card p {
                color: #888;
                font-size: 0.82rem;
                margin-bottom: 0;
            }

            /* =============================================
               FOOTER
               ============================================= */
            .footer-pln {
                background: var(--pln-blue);
                color: rgba(255, 255, 255, 0.8);
                padding: 3rem 0 1.5rem;
            }

            .footer-pln h6 {
                color: #fff;
                font-weight: 600;
                margin-bottom: 1rem;
                font-size: 0.95rem;
            }

            .footer-pln p,
            .footer-pln a {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.88rem;
                line-height: 1.8;
            }

            .footer-pln a:hover {
                color: var(--pln-yellow);
            }

            .footer-pln .footer-links li {
                margin-bottom: 0.4rem;
            }

            .footer-pln .footer-links li a {
                display: inline-block;
                position: relative;
                transition: all 0.25s ease;
            }

            .footer-pln .footer-links li a:hover {
                color: #fff;
                padding-left: 4px;
            }

            .footer-pln .footer-links li a::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 0;
                height: 1px;
                background: var(--pln-yellow);
                transition: width 0.3s ease;
            }

            .footer-pln .footer-links li a:hover::after {
                width: 100%;
            }

            .footer-pln .address-link {
                display: inline-flex;
                align-items: flex-start;
                transition: all 0.25s ease;
                text-decoration: none;
            }

            .footer-pln .address-link:hover {
                color: var(--pln-yellow);
            }

            .footer-pln .address-link:hover span {
                text-decoration: underline;
                text-underline-offset: 3px;
            }

            .footer-pln .footer-bottom {
                border-top: 1px solid rgba(255, 255, 255, 0.15);
                padding-top: 1.5rem;
                margin-top: 2rem;
                text-align: center;
                font-size: 0.82rem;
            }

            .footer-pln .social-links {
                display: flex;
                gap: 0.6rem;
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

            /* =============================================
               LOGO IMAGE HANDLING
               ============================================= */
            .logo-nav {
                height: 42px;
                width: auto;
                max-width: 180px;
                object-fit: contain;
                transition: opacity 0.3s ease;
            }

            .logo-nav:hover {
                opacity: 0.85;
            }

            .logo-hero {
                height: 80px;
                width: auto;
                max-width: 240px;
                object-fit: contain;
            }

            /* =============================================
               FLAG IMAGES — LANGUAGE SWITCHER
               ============================================= */
            .flag-img {
                width: 20px;
                height: 14px;
                object-fit: cover;
                border-radius: 2px;
                flex-shrink: 0;
            }

            /* =============================================
               GOOGLE TRANSLATE — HIDE TOOLBAR
               ============================================= */
            body .skiptranslate,
            .goog-te-banner-frame,
            .goog-te-menu-frame {
                display: none !important;
                height: 0 !important;
            }

            body {
                top: 0 !important;
            }

            /* =============================================
               RESPONSIVE
               ============================================= */
            @media (max-width: 991.98px) {
                .hero-section h1 {
                    font-size: 2.2rem;
                }

                .navbar-pln .dropdown-menu {
                    background: rgba(26, 26, 46, 0.95);
                    border: 1px solid rgba(255, 255, 255, 0.08);
                }
            }

            @media (max-width: 767.98px) {
                .hero-section {
                    min-height: auto;
                    padding: 6rem 0 3rem;
                }

                .hero-section h1 {
                    font-size: 1.8rem;
                }

                .footer-pln .social-links {
                    justify-content: flex-start;
                }

                .footer-pln .address-link {
                    font-size: 0.85rem;
                }
            }

            @media (min-width: 768px) and (max-width: 991.98px) {
                .footer-pln .col-lg-2,
                .footer-pln .col-lg-3 {
                    flex: 0 0 auto;
                    width: 50%;
                }
            }
        </style>

        @stack('styles')
    </head>
    <body id="page-top">
        {{-- Navbar --}}
        @include('layouts.navbar')

        {{-- Main Content --}}
        @yield('content')

        {{-- Footer --}}
        @include('layouts.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            window.addEventListener('scroll', function () {
                const navbar = document.querySelector('.navbar-pln');
                if (navbar) {
                    navbar.classList.toggle('scrolled', window.scrollY > 50);
                }
            });
        </script>

        {{-- i18n: Alih Bahasa OTOMATIS (ID <-> EN) --}}
        <script src="{{ asset('js/i18n.js') }}"></script>

        {{-- Google Translate Widget (hidden) --}}
        <div id="google_translate_element" style="display:none;"></div>
        <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'en,id',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }
        </script>
        <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

        @stack('scripts')
    </body>
</html>
