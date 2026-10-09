<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Portal Karyawan — PLN Nusantara Power" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal Karyawan — PLN Nusantara Power')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-pln1.png') }}" />

    {{-- Font Awesome 6 — pola sama dengan layout publik/admin --}}
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="stylesheet" media="print" onload="this.media='all'"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    </noscript>

    {{-- Typography: Plus Jakarta Sans (brand PLN NP), fallback Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/karyawan.css') }}" />
    @push('styles')
    <style>
        /* ============================================
           TOPBAR / NAVBAR - Konsisten & Rapi
           ============================================ */
        .kry-topbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--kry-topbar-bg, #0056a3);
            color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        }

        .kry-topbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            height: 64px;
            gap: 1.5rem;
        }

        /* ---- LOGO (KIRI) ---- */
        .kry-brand {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
            color: #fff;
            flex-shrink: 0;
        }

        .kry-brand img {
            height: 34px;
            width: auto;
            object-fit: contain;
        }

        .kry-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .kry-brand-text strong {
            font-size: 1.05rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.01em;
        }

        .kry-brand-text small {
            font-size: 0.7rem;
            font-weight: 500;
            color: rgba(255,255,255,0.75);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ---- NAV MENU (TENGAH) ---- */
        .kry-nav {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            flex: 1;
            justify-content: center;
        }

        .kry-nav-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0.85rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
            white-space: nowrap;
            position: relative;
        }

        .kry-nav-link i {
            font-size: 1rem;
            color: rgba(255,255,255,0.85);
            transition: color 0.2s ease;
        }

        .kry-nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.12);
        }

        .kry-nav-link:hover i {
            color: #fff;
        }

        /* Active state: underline subtle, bukan pill */
        .kry-nav-link.active {
            color: #fff;
        }

        .kry-nav-link.active i {
            color: #fff;
        }

        .kry-nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 2px;
            background: #FFE600;
            border-radius: 2px;
        }

        /* ---- DROPDOWN AKSES ADMIN ---- */
        .kry-dropdown-wrap {
            position: relative;
        }

        .kry-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 210px;
            padding: 0.5rem 0;
            background: var(--kry-card-bg, #fff);
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.18);
            z-index: 1000;
            display: none;
            animation: kryDropdownFade 0.2s ease;
            margin-top: 0.35rem;
        }

        .kry-dropdown.open {
            display: block;
        }

        @keyframes kryDropdownFade {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .kry-dropdown-header {
            padding: 0.65rem 1rem;
            background: var(--kry-primary, #0056a3);
            color: #fff;
            border-radius: 12px 12px 0 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .kry-dropdown-divider {
            height: 1px;
            background: rgba(0,0,0,0.06);
            margin: 0.2rem 0.5rem;
        }

        .kry-dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.55rem 1rem;
            color: var(--ink-heading, #1f2937);
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s ease;
        }

        .kry-dropdown-item i {
            width: 1.25rem;
            font-size: 0.95rem;
            color: var(--ink-muted, #6b7280);
            transition: color 0.15s ease;
        }

        .kry-dropdown-item:hover {
            background: var(--panel-hover, #f0f7ff);
            color: var(--kry-primary, #0056a3);
        }

        .kry-dropdown-item:hover i {
            color: var(--kry-primary, #0056a3);
        }

        .kry-dropdown-item.as-danger {
            color: #dc2626;
        }

        .kry-dropdown-item.as-danger i {
            color: #dc2626;
        }

        .kry-dropdown-item.as-danger:hover {
            background: #fef2f2;
            color: #b91c1c;
        }

        /* Tombol trigger */
        .kry-nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 0.85rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: rgba(255,255,255,0.85);
            background: transparent;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .kry-nav-btn:hover {
            color: #fff;
            background: rgba(255,255,255,0.12);
        }

        .kry-nav-btn i:first-child {
            font-size: 1rem;
            color: rgba(255,255,255,0.85);
        }

        .kry-nav-btn:hover i:first-child {
            color: #fff;
        }

        .kry-nav-btn .fa-chevron-down {
            font-size: 0.65rem;
            margin-left: 0.15rem;
            transition: transform 0.2s ease;
            color: rgba(255,255,255,0.6);
        }

        .kry-dropdown-wrap.open .kry-nav-btn .fa-chevron-down {
            transform: rotate(180deg);
        }

        /* ---- PROFIL PENGGUNA (KANAN) ---- */
        .kry-topbar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        .kry-user-chip {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.35rem 0.75rem 0.35rem 0.35rem;
            background: rgba(255,255,255,0.12);
            border-radius: 100px;
            text-decoration: none;
            transition: background 0.2s ease;
        }

        .kry-user-chip:hover {
            background: rgba(255,255,255,0.2);
        }

        .kry-avatar {
            width: 32px;
            height: 32px;
            min-width: 32px;
            border-radius: 50%;
            background: #FFE600;
            color: var(--pln-blue-dark, #003d6b);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .kry-user-meta {
            display: flex;
            flex-direction: column;
            line-height: 1.3;
        }

        .kry-user-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: #fff;
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .kry-user-role {
            font-size: 0.7rem;
            font-weight: 400;
            color: rgba(255,255,255,0.65);
            max-width: 140px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .kry-avatar-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            padding: 0;
            background: transparent;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            color: rgba(255,255,255,0.7);
            transition: all 0.2s ease;
        }

        .kry-avatar-btn:hover {
            color: #fff;
            background: rgba(255,255,255,0.15);
        }

        .kry-avatar-btn .fa-chevron-down {
            font-size: 0.6rem;
            transition: transform 0.2s ease;
        }

        .kry-dropdown-wrap.open .kry-avatar-btn .fa-chevron-down {
            transform: rotate(180deg);
        }

        /* ============================================
           DARK MODE
           ============================================ */
        html.theme-dark .kry-topbar {
            background: #1a3a5c;
        }

        html.theme-dark .kry-brand-text strong {
            color: #f0f4f8;
        }

        html.theme-dark .kry-brand-text small {
            color: rgba(240,244,248,0.6);
        }

        html.theme-dark .kry-nav-link {
            color: rgba(255,255,255,0.7);
        }

        html.theme-dark .kry-nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.08);
        }

        html.theme-dark .kry-nav-link.active::after {
            background: #FFE600;
        }

        html.theme-dark .kry-user-chip {
            background: rgba(255,255,255,0.08);
        }

        html.theme-dark .kry-user-chip:hover {
            background: rgba(255,255,255,0.14);
        }

        html.theme-dark .kry-user-name {
            color: #f0f4f8;
        }

        html.theme-dark .kry-user-role {
            color: rgba(240,244,248,0.55);
        }
    </style>
    @endpush
    @stack('styles')
</head>
<body class="kry-body">

    {{-- ================= TOPBAR ================= --}}
    <header class="kry-topbar">
        <div class="kry-container kry-topbar-inner">

            <a href="{{ route('karyawan.dashboard') }}" class="kry-brand">
                {{-- Emblem persegi logo-pln1.png — sama dengan logo hero
                     landing page publik (home.blade.php) & favicon --}}
                <img src="{{ asset('assets/images/logo-pln1.png') }}" alt="Logo PLN Nusantara Power"
                     onerror="this.style.display='none';" />
                <span class="kry-brand-text">
                    <strong>PLN Nusantara Power</strong>
                    <small>Portal Karyawan</small>
                </span>
            </a>

            <nav class="kry-nav" aria-label="Menu utama portal">
                <a href="{{ route('karyawan.dashboard') }}"
                   class="kry-nav-link {{ request()->routeIs('karyawan.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-house"></i> Dashboard
                </a>
                <a href="{{ route('karyawan.informasi') }}"
                   class="kry-nav-link {{ request()->routeIs('karyawan.informasi*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn"></i> Informasi
                </a>
                <a href="{{ route('karyawan.layanan') }}"
                   class="kry-nav-link {{ request()->routeIs('karyawan.layanan*') ? 'active' : '' }}">
                    <i class="fas fa-hand-holding-heart"></i> Layanan
                </a>
                <a href="{{ route('karyawan.link') }}"
                   class="kry-nav-link {{ request()->routeIs('karyawan.link') ? 'active' : '' }}">
                    <i class="fas fa-link"></i> Link Kerja
                </a>

                {{-- DROPDOWN AKSES ADMIN — muncul hanya jika karyawan punya
                     minimal 1 permission admin. Berisi semua fitur admin
                     yang diberikan ke karyawan ini. --}}
                @canany(['news.view', 'announcements.view', 'galleries.view', 'tamu.view'])
                <div class="kry-dropdown-wrap">
                    <button type="button" class="kry-nav-btn" id="adminAccessBtn"
                            aria-haspopup="true" aria-expanded="false" aria-label="Akses Admin">
                        <i class="fas fa-gauge-high"></i>
                        <span class="kry-nav-label">Akses Admin</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="kry-dropdown kry-dropdown-admin" id="adminAccessDropdown" role="menu">
                        <div class="kry-dropdown-header">
                            <i class="fas fa-lock-open"></i>
                            <span>Hak Akses Admin Anda</span>
                        </div>
                        <div class="kry-dropdown-divider"></div>
                        @can('news.view')
                            <a href="{{ route('admin.news.index') }}" target="_blank" rel="noopener"
                               class="kry-dropdown-item" role="menuitem">
                                <i class="fas fa-newspaper"></i> Kelola Berita
                            </a>
                        @endcan
                        @can('announcements.view')
                            <a href="{{ route('admin.announcements.index') }}" target="_blank" rel="noopener"
                               class="kry-dropdown-item" role="menuitem">
                                <i class="fas fa-bullhorn"></i> Kelola Pengumuman
                            </a>
                        @endcan
                        @can('galleries.view')
                            <a href="{{ route('admin.galeri.index') }}" target="_blank" rel="noopener"
                               class="kry-dropdown-item" role="menuitem">
                                <i class="fas fa-images"></i> Kelola Galeri
                            </a>
                        @endcan
                        @can('tamu.view')
                            <a href="{{ route('admin.tamu.index') }}" target="_blank" rel="noopener"
                               class="kry-dropdown-item" role="menuitem">
                                <i class="fas fa-id-card"></i> Data Tamu
                            </a>
                        @endcan
                        <div class="kry-dropdown-divider"></div>
                        @if (auth()->user()?->hasExtraKaryawanPermission())
                            <a href="{{ route('admin.dashboard') }}" target="_blank" rel="noopener"
                               class="kry-dropdown-item kry-dropdown-admin-full" role="menuitem">
                                <i class="fas fa-gauge-high"></i> Panel Admin (Lengkap)
                            </a>
                        @endif
                    </div>
                </div>
                @endcanany
            </nav>

            <div class="kry-topbar-user">
                <a href="{{ route('karyawan.profil') }}" class="kry-user-chip"
                   title="Edit Profil Saya">
                    <span class="kry-avatar">{{ $karyawanUser['initials'] }}</span>
                    <span class="kry-user-meta">
                        <span class="kry-user-name">{{ $karyawanUser['name'] }}</span>
                        <span class="kry-user-role">{{ $karyawanUser['jabatan'] }}</span>
                    </span>
                </a>

                <div class="kry-dropdown-wrap">
                    <button type="button" class="kry-avatar-btn" id="kryUserMenuBtn"
                            aria-haspopup="true" aria-expanded="false" aria-label="Menu akun">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="kry-dropdown" id="kryUserDropdown" role="menu">
                        <a href="{{ route('karyawan.profil') }}" class="kry-dropdown-item" role="menuitem">
                            <i class="fas fa-user-pen"></i> Edit Profil Saya
                        </a>
                        <form method="POST" action="{{ route('logout') }}" role="menuitem">
                            @csrf
                            <button type="submit" class="kry-dropdown-item as-danger">
                                <i class="fas fa-right-from-bracket"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- ================= KONTEN ================= --}}
    <main class="kry-main">
        <div class="kry-container">

            @if (session('success'))
                <div class="kry-alert kry-alert-success" role="status">
                    <i class="fas fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            @if (session('warning'))
                <div class="kry-alert kry-alert-warning" role="status">
                    <i class="fas fa-circle-info"></i> {{ session('warning') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    {{-- ================= FOOTER ================= --}}
    <footer class="kry-footer">
        <div class="kry-container kry-footer-inner">
            <span>&copy; {{ date('Y') }} PLN Nusantara Power — UP PLTU Indramayu</span>
            <span>Portal Karyawan &middot; akses internal</span>
        </div>
    </footer>            <script>
        (function () {
            var userBtn = document.getElementById('kryUserMenuBtn');
            var userDD  = document.getElementById('kryUserDropdown');
            var adminBtn = document.getElementById('adminAccessBtn');
            var adminDD  = document.getElementById('adminAccessDropdown');

            function closeUserDD() {
                if (userDD) {
                    userDD.classList.remove('open');
                    if (userBtn) userBtn.setAttribute('aria-expanded', 'false');
                }
            }

            function closeAdminDD() {
                if (adminDD) {
                    adminDD.classList.remove('open');
                    if (adminBtn) adminBtn.setAttribute('aria-expanded', 'false');
                }
            }

            function closeAllDD() {
                closeUserDD();
                closeAdminDD();
            }

            // Toggle user menu
            if (userBtn && userDD) {
                userBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    var willOpen = !userDD.classList.contains('open');
                    userDD.classList.toggle('open', willOpen);
                    userBtn.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
                    if (willOpen) closeAdminDD();
                });
            }

            // Toggle admin access dropdown
            if (adminBtn && adminDD) {
                adminBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    var willOpen = !adminDD.classList.contains('open');
                    adminDD.classList.toggle('open', willOpen);
                    adminBtn.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
                    if (willOpen) closeUserDD();
                });
            }

            // Close all dropdowns on outside click
            document.addEventListener('click', function (e) {
                if (adminDD && !adminDD.contains(e.target) && e.target !== adminBtn) closeAdminDD();
                if (userDD && !userDD.contains(e.target) && e.target !== userBtn) closeUserDD();
            });

            // Close on Escape
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeAllDD();
            });

            // Close on window resize (mobile -> desktop transition)
            window.addEventListener('resize', function () {
                closeAllDD();
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>
