<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="E-PPID PLN — Dashboard Admin" />
        <title>@yield('title', 'Admin — E-PPID PLN')</title>

        {{-- Favicon --}}
        <link rel="icon" type="image/x-icon" href="{{ asset('startbootstrap-grayscale-gh-pages/assets/favicon.ico') }}" />

        {{-- Font Awesome --}}
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        {{-- Google Fonts: Inter --}}
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

        {{-- Bootstrap 5 CSS --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />

        {{-- Admin Panel CSS --}}
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet" />

        @stack('styles')
    </head>
    <body>

        {{-- ============================================
             SIDEBAR OVERLAY (mobile)
             ============================================ --}}
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

        {{-- ============================================
             SIDEBAR
             ============================================ --}}
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-brand">
                <img
                    src="{{ asset('assets/images/logo-pln.png') }}"
                    alt="Logo PLN"
                    class="sidebar-brand-img"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                />
                <div class="sidebar-brand-text d-none">
                    E-PPID PLN
                    <small>Admin Panel</small>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="sidebar-section-label">Menu Utama</div>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link active">
                    <span class="link-icon"><i class="fas fa-th-large"></i></span>
                    Dashboard
                </a>
                <a href="#" class="sidebar-link">
                    <span class="link-icon"><i class="fas fa-newspaper"></i></span>
                    Berita
                </a>
                <a href="#" class="sidebar-link">
                    <span class="link-icon"><i class="fas fa-bullhorn"></i></span>
                    Pengumuman
                </a>
                <a href="#" class="sidebar-link">
                    <span class="link-icon"><i class="fas fa-file-lines"></i></span>
                    Halaman
                </a>

                <div class="sidebar-section-label">Manajemen</div>
                <a href="#" class="sidebar-link">
                    <span class="link-icon"><i class="fas fa-users"></i></span>
                    Pengguna
                </a>
                <a href="#" class="sidebar-link">
                    <span class="link-icon"><i class="fas fa-images"></i></span>
                    Galeri
                </a>
                <a href="#" class="sidebar-link">
                    <span class="link-icon"><i class="fas fa-file-invoice"></i></span>
                    Dokumen
                </a>

                <div class="sidebar-section-label">Lainnya</div>
                <a href="#" class="sidebar-link">
                    <span class="link-icon"><i class="fas fa-paper-plane"></i></span>
                    Permohonan
                    <span class="badge">5</span>
                </a>
                <a href="#" class="sidebar-link">
                    <span class="link-icon"><i class="fas fa-cog"></i></span>
                    Pengaturan
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="{{ route('home') }}">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Situs
                </a>
            </div>
        </aside>

        {{-- ============================================
             MAIN CONTENT
             ============================================ --}}
        <div class="admin-main">

            {{-- TOPBAR --}}
            <header class="admin-topbar">
                <div class="topbar-left">
                    <button class="sidebar-toggle" onclick="toggleSidebar()" aria-label="Toggle sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="topbar-breadcrumb">
                        Admin / <strong>@yield('page-title', 'Dashboard')</strong>
                    </div>
                </div>

                <div class="topbar-right">
                    <button class="topbar-icon-btn" title="Cari">
                        <i class="fas fa-search"></i>
                    </button>
                    <button class="topbar-icon-btn" title="Notifikasi">
                        <i class="fas fa-bell"></i>
                        <span class="notification-dot"></span>
                    </button>
                    <div class="topbar-divider"></div>
                    <div class="topbar-user">
                        <div class="topbar-avatar">AD</div>
                        <div class="topbar-user-info">
                            <div class="topbar-user-name">Admin PLN</div>
                            <div class="topbar-user-role">Super Admin</div>
                        </div>
                        <i class="fas fa-chevron-down" style="font-size:0.6rem; color:#9ca3af; margin-left:0.25rem;"></i>
                    </div>
                </div>
            </header>

            {{-- PAGE CONTENT --}}
            <main class="admin-content">
                @yield('content')
            </main>

        </div>

        {{-- Bootstrap JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('adminSidebar');
                const overlay = document.getElementById('sidebarOverlay');
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            }
        </script>

        @stack('scripts')
    </body>
</html>
