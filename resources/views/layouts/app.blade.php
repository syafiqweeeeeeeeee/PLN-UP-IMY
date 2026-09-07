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
                overflow-x: hidden;
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

            .search-form {
                display: flex;
                align-items: center;
                background: rgba(255, 255, 255, 0.15);
                border-radius: 25px;
                padding: 0.2rem 0.25rem 0.2rem 0.75rem;
                border: 1px solid rgba(255, 255, 255, 0.25);
                transition: all 0.3s ease;
            }

            .search-form:focus-within {
                background: rgba(255, 255, 255, 0.25);
                border-color: var(--pln-yellow);
            }

            .search-form input {
                background: transparent;
                border: none;
                color: #fff;
                font-size: 0.85rem;
                outline: none;
                width: 150px;
                padding: 0.25rem 0;
            }

            .search-form input::placeholder {
                color: rgba(255, 255, 255, 0.6);
            }

            .search-form .btn-search {
                background: var(--pln-yellow);
                color: var(--pln-blue);
                border: none;
                border-radius: 50%;
                width: 32px;
                height: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.8rem;
                cursor: pointer;
                transition: transform 0.2s ease;
            }

            .search-form .btn-search:hover {
                transform: scale(1.08);
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

            .footer-pln .footer-bottom {
                border-top: 1px solid rgba(255, 255, 255, 0.15);
                padding-top: 1.5rem;
                margin-top: 2rem;
                text-align: center;
                font-size: 0.82rem;
            }

            .footer-pln .social-links a {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.1);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                margin-right: 0.5rem;
                transition: all 0.2s ease;
            }

            .footer-pln .social-links a:hover {
                background: var(--pln-yellow);
                color: var(--pln-blue);
            }

            /* =============================================
               RESPONSIVE
               ============================================= */
            @media (max-width: 991.98px) {
                .hero-section h1 {
                    font-size: 2.2rem;
                }

                .search-form {
                    margin-top: 0.5rem;
                }

                .search-form input {
                    width: 100%;
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

        {{-- Bootstrap core JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        {{-- Navbar scroll effect --}}
        <script>
            window.addEventListener('scroll', function () {
                const navbar = document.querySelector('.navbar-pln');
                if (navbar) {
                    navbar.classList.toggle('scrolled', window.scrollY > 50);
                }
            });
        </script>

        @stack('scripts')
    </body>
</html>
