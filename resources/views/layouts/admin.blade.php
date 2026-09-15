<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="E-PPID PLN — Dashboard Admin" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Admin — E-PPID PLN')</title>

        <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-pln1.png') }}" />

        {{-- Font Awesome 6.3.0 — webfont CSS via cdnjs (pengganti Kit JS all.js,
             tanpa JS icon-replacement); non-blocking via media=print trick. --}}
        <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
        <link rel="stylesheet" media="print" onload="this.media='all'"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
        <noscript>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        </noscript>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />

        <link href="{{ asset('css/admin.css') }}" rel="stylesheet" />

        <style>
            @keyframes pt-fade-slide-in {
                from { opacity: 0; transform: translateX(4px); }
                to   { opacity: 1; transform: translateX(0); }
            }
            
            .admin-content.pt-animating {
                animation: pt-fade-slide-in 0.06s ease-out both;
            }

            @media (prefers-reduced-motion: reduce) {
                .admin-content.pt-animating {
                    animation: none;
                }
            }
        </style>

        @stack('styles')
    </head>
    <body data-partial-content=".admin-content">

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
                    width="158" height="42"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                />
                <div class="sidebar-brand-text d-none">
                    E-PPID PLN
                    <small>Admin Panel</small>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="sidebar-section-label">Menu Utama</div>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" data-no-router>
                    <span class="link-icon"><i class="fas fa-th-large"></i></span>
                    Dashboard
                </a>
                <a href="{{ route('admin.news.index') }}" class="sidebar-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                    <span class="link-icon"><i class="fas fa-newspaper"></i></span>
                    Berita
                </a>
                <a href="{{ route('admin.announcements.index') }}" class="sidebar-link {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                    <span class="link-icon"><i class="fas fa-bullhorn"></i></span>
                    Pengumuman
                </a>
                <a href="#" class="sidebar-link">
                    <span class="link-icon"><i class="fas fa-file-lines"></i></span>
                    Halaman
                </a>

                <div class="sidebar-section-label">Manajemen</div>
                <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <span class="link-icon"><i class="fas fa-users"></i></span>
                    Pengguna
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="sidebar-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                    <span class="link-icon"><i class="fas fa-images"></i></span>
                    Galeri
                </a>
                <a href="#" class="sidebar-link">
                    <span class="link-icon"><i class="fas fa-file-invoice"></i></span>
                    Dokumen
                </a>

                <div class="sidebar-section-label">Lainnya</div>
                <a href="{{ route('admin.contact-messages.index') }}" class="sidebar-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
                    <span class="link-icon"><i class="fas fa-paper-plane"></i></span>
                    Permohonan
                    @php
                        $unreadPermohonan = \App\Models\ContactMessage::unreadCount();
                    @endphp
                    @if ($unreadPermohonan > 0)
                        <span class="badge" title="{{ $unreadPermohonan }} pesan belum dibaca">{{ $unreadPermohonan > 99 ? '99+' : $unreadPermohonan }}</span>
                    @endif
                </a>
                <a href="#" class="sidebar-link">
                    <span class="link-icon"><i class="fas fa-cog"></i></span>
                    Pengaturan
                </a>
                @can('activity_logs.view')
                <a href="{{ route('admin.activity-logs.index') }}" class="sidebar-link {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
                    <span class="link-icon"><i class="fas fa-clipboard-list"></i></span>
                    Log Aktivitas
                </a>
                @endcan

                {{-- Role & Permission --}}
                @can('roles.view')
                <div class="sidebar-section-label">Role & Hak Akses</div>
                <a href="{{ route('admin.roles.index') }}" class="sidebar-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <span class="link-icon"><i class="fas fa-user-tag"></i></span>
                    Role
                </a>
                @endcan

                <form id="permissionRoleForm" action="" method="GET" style="display:none;">
                    @csrf
                    <input type="hidden" id="permissionRoleId" name="role">
                </form>
            </nav>

            <div class="sidebar-footer">
                <button type="button" class="btn btn-sidebar-logout" onclick="document.getElementById('logoutConfirmModal').classList.add('show')">
                    <i class="fas fa-right-from-bracket"></i> Logout
                </button>
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

            {{-- PAGE CONTENT (container transisi) --}}
            <main class="admin-content" data-pt-animate>
                @yield('content')
            </main>

        </div>

        {{-- Bootstrap JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        {{-- Client-side router: pindah halaman tanpa reload layout,
             cache memori per halaman, micro-transition 60ms --}}
        <script src="{{ asset('js/router.js') }}" defer></script>

        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('adminSidebar');
                const overlay = document.getElementById('sidebarOverlay');
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            }

            function showLogoutModal() {
                document.getElementById('logoutConfirmModal').classList.add('show');
            }
            function hideLogoutModal() {
                document.getElementById('logoutConfirmModal').classList.remove('show');
            }
        </script>

        {{-- ============================================
             LOGOUT CONFIRMATION MODAL
             ============================================ --}}
        <div id="logoutConfirmModal" class="modal-pln-overlay" onclick="if(event.target===this) hideLogoutModal()">
            <div class="modal-pln-dialog">
                <div class="modal-pln-icon">
                    <i class="fas fa-right-from-bracket"></i>
                </div>
                <h6 class="modal-pln-title">Konfirmasi Logout</h6>
                <p class="modal-pln-text">Apakah Anda yakin mau keluar dari halaman admin?</p>
                <div class="modal-pln-actions">
                    <button type="button" class="btn-corp btn-corp-cancel" onclick="hideLogoutModal()">
                        <i class="fas fa-xmark"></i> Batal
                    </button>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-corp btn-corp-logout">
                            <i class="fas fa-right-from-bracket"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
