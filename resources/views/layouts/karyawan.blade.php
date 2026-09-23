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
    </footer>

    <script>
        (function () {
            var btn = document.getElementById('kryUserMenuBtn');
            var dd  = document.getElementById('kryUserDropdown');
            if (!btn || !dd) return;

            function close() {
                dd.classList.remove('open');
                btn.setAttribute('aria-expanded', 'false');
            }

            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                var willOpen = !dd.classList.contains('open');
                dd.classList.toggle('open', willOpen);
                btn.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
            });

            document.addEventListener('click', function (e) {
                if (!dd.contains(e.target) && e.target !== btn) close();
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') close();
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>
