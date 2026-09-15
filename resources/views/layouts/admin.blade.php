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

        {{-- ============================================================
             THEME BOOTSTRAP (anti-FOUC) — jalan SEBELUM render.
             Membaca localStorage 'admin-theme' (light|dark|system),
             fallback: preferensi sistem. Dipakai halaman Pengaturan.
             ============================================================ --}}
        <script>
            (function () {
                try {
                    var pref = localStorage.getItem('admin-theme') || 'system';
                    var dark = pref === 'dark' ||
                        (pref === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
                    document.documentElement.classList.toggle('theme-dark', dark);
                } catch (e) { /* localStorage diblokir → default light */ }
            })();
        </script>

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

        {{-- ============================================================
             SIDEBAR ACTIVE STATE OVERRIDE (Kuning PLN #FFE600)
             ------------------------------------------------------------
             - .active          : bg kuning transparan, teks+ikon kuning,
                                  penanda border-left 4px kuning.
             - Non-aktif & link dummy (#) : background transparan bersih.
             - Diletakkan SETELAH admin.css → menang override spesifisitas.
             ============================================================ --}}
        <style>
            /* ---- Menu non-aktif: bersih / transparan ---- */
            .sidebar-nav .sidebar-link:not(.active) {
                background: transparent;
                border-left: 4px solid transparent;
            }

            /* ---- Menu dummy (href="#"): jangan pernah menyala ---- */
            .sidebar-nav .sidebar-link[href="#"] {
                background: transparent !important;
                border-left: 4px solid transparent !important;
                color: rgba(255,255,255,0.75);
            }
            .sidebar-nav .sidebar-link[href="#"] .link-icon {
                color: rgba(255,255,255,0.55);
            }
            .sidebar-nav .sidebar-link[href="#"]:hover {
                background: rgba(255,255,255,0.06) !important;
                color: var(--pln-yellow, #FFE600);
                border-left-color: rgba(255,230,0,0.4) !important;
            }

            /* ---- Menu aktif: Kuning PLN #FFE600 (hanya 1 menu) ---- */
            .sidebar-nav .sidebar-link.active {
                background: rgba(255, 230, 0, 0.15);
                color: #FFE600;
                border-left: 4px solid #FFE600;
                font-weight: 600;
            }
            .sidebar-nav .sidebar-link.active .link-icon {
                color: #FFE600;
            }
            .sidebar-nav .sidebar-link.active .link-text {
                color: #FFE600;
            }
            .sidebar-nav .sidebar-link.active:hover {
                background: rgba(255, 230, 0, 0.15);
                border-left-color: #FFE600;
            }

            /* ---- Dark-mode emisi inline: petakan abu Tailwind umum ----
               Halaman admin memakai banyak warna abu inline (#1f2937,
               #374151, #6b7280, #9ca3af, #f9fafb, #f3f4f6, #f8fafc,
               #f1f5f9, #e5e7eb) di dalam @push('styles') miliknya.
               Override di sini agar mode gelap akurat tanpa menyentuh
               setiap file. Khusus atribut style="..." perlu !important
               karena inline style menang atas specificity biasa. */
            html.theme-dark [style*="#1f2937"] { color: var(--ink-heading) !important; }
            html.theme-dark [style*="#374151"] { color: var(--ink-body) !important; }
            html.theme-dark [style*="#6b7280"] { color: var(--ink-muted) !important; }
            html.theme-dark [style*="#9ca3af"] { color: var(--ink-faint) !important; }
            html.theme-dark [style*="#f9fafb"] { background: var(--panel) !important; }
            html.theme-dark [style*="#f3f4f6"] { background: var(--panel) !important; }
            html.theme-dark [style*="#f8fafc"] { background: var(--panel) !important; }
            html.theme-dark [style*="#f1f5f9"] { background: var(--panel-2) !important; }
            html.theme-dark [style*="#e5e7eb"] { border-color: var(--line) !important; }

            /* Page-scoped dark tuning */
            html.theme-dark .settings-toast { background: var(--panel-2); color: var(--ink-heading); }
            html.theme-dark .news-empty-state h6,
            html.theme-dark .empty-state h6 { color: var(--ink-heading); }
            html.theme-dark .news-empty-state p,
            html.theme-dark .empty-state p { color: var(--ink-muted); }
            html.theme-dark .news-empty-state,
            html.theme-dark .empty-state { color: var(--ink-faint); }
            html.theme-dark .user-delete-dialog,
            html.theme-dark .announcement-delete-dialog,
            html.theme-dark .galeri-delete-dialog,
            html.theme-dark .role-delete-dialog,
            html.theme-dark .news-delete-dialog { background: var(--bg-card); }
            html.theme-dark .user-delete-name,
            html.theme-dark .announcement-delete-name,
            html.theme-dark .galeri-delete-name,
            html.theme-dark .role-delete-name,
            html.theme-dark .news-delete-title-preview { background: var(--panel); border-color: var(--line); color: var(--ink-heading); }
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

            <nav class="sidebar-nav" id="sidebarNav">
                {{-- ===== MENU UTAMA ===== --}}
                <div class="sidebar-section-label">Menu Utama</div>

                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-link @if(request()->routeIs('admin.dashboard')) active @endif"
                   data-no-router>
                    <span class="link-icon"><i class="fas fa-th-large"></i></span>
                    <span class="link-text">Dashboard</span>
                </a>

                <a href="{{ route('admin.news.index') }}"
                   class="sidebar-link @if(request()->routeIs('admin.news.*')) active @endif"
                   data-no-router>
                    <span class="link-icon"><i class="fas fa-newspaper"></i></span>
                    <span class="link-text">Berita</span>
                </a>

                <a href="{{ route('admin.announcements.index') }}"
                   class="sidebar-link @if(request()->routeIs('admin.announcements.*')) active @endif"
                   data-no-router>
                    <span class="link-icon"><i class="fas fa-bullhorn"></i></span>
                    <span class="link-text">Pengumuman</span>
                </a>
                @can('pages.view')
                <a href="{{ route('admin.pages.index') }}" class="sidebar-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                    <span class="link-icon"><i class="fas fa-file-lines"></i></span>
                    <span class="link-text">Halaman</span>
                </a>
                @endcan

                @can('menus.view')
                <a href="{{ route('admin.menus.index') }}" class="sidebar-link {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
                    <span class="link-icon"><i class="fas fa-bars"></i></span>
                    Menu
                </a>
                @endcan

                {{-- ===== MANAJEMEN ===== --}}
                <div class="sidebar-section-label">Manajemen</div>

                <a href="{{ route('admin.users.index') }}"
                   class="sidebar-link @if(request()->routeIs('admin.users.*')) active @endif"
                   data-no-router>
                    <span class="link-icon"><i class="fas fa-users"></i></span>
                    <span class="link-text">Pengguna</span>
                </a>

                <a href="{{ route('admin.galeri.index') }}"
                   class="sidebar-link @if(request()->routeIs('admin.galeri.*')) active @endif"
                   data-no-router>
                    <span class="link-icon"><i class="fas fa-images"></i></span>
                    <span class="link-text">Galeri</span>
                </a>

                <a href="#" class="sidebar-link" tabindex="-1" aria-disabled="true">
                    <span class="link-icon"><i class="fas fa-file-invoice"></i></span>
                    <span class="link-text">Dokumen</span>
                </a>

                {{-- ===== LAINNYA ===== --}}
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

                <a href="{{ route('admin.settings') }}"
                   class="sidebar-link @if(request()->routeIs('admin.settings')) active @endif"
                   data-no-router>
                    <span class="link-icon"><i class="fas fa-cog"></i></span>
                    <span class="link-text">Pengaturan</span>
                </a>

                @can('activity_logs.view')
                <a href="{{ route('admin.activity-logs.index') }}"
                   class="sidebar-link @if(request()->routeIs('admin.activity-logs.*')) active @endif"
                   data-no-router>
                    <span class="link-icon"><i class="fas fa-clipboard-list"></i></span>
                    <span class="link-text">Log Aktivitas</span>
                </a>
                @endcan

                {{-- ===== ROLE & HAK AKSES ===== --}}
                @can('roles.view')
                <div class="sidebar-section-label">Role & Hak Akses</div>

                <a href="{{ route('admin.roles.index') }}"
                   class="sidebar-link @if(request()->routeIs('admin.roles.*')) active @endif"
                   data-no-router>
                    <span class="link-icon"><i class="fas fa-user-tag"></i></span>
                    <span class="link-text">Role</span>
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
                    <button class="topbar-icon-btn" id="themeToggle" title="Ganti tema terang/gelap" aria-label="Ganti tema">
                        <i class="fas fa-moon"></i>
                    </button>
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

        {{-- ============================================================
             SIDEBAR ACTIVE HANDLER — 1x KLIK LANGSUNG AKTIF
             ------------------------------------------------------------
             Dipasang SEBELUM </body>. Tiga tanggung jawab:
             1. Klik 1x  → cabut .active dari menu lama, tempel ke menu
                yang diklik (instan, sebelum router selesai swap konten).
             2. Refresh  → tandai menu yang href-nya cocok dengan
                window.location.href saat halaman dimuat.
             3. Hanya 1 menu yang aktif dalam satu waktu; menu dummy
                (href="#") tidak pernah ikut menyala.
             ============================================================ --}}
        <script>
            (function () {
                'use strict';

                var PLN_YELLOW = '#FFE600';
                var nav = document.getElementById('sidebarNav');
                if (!nav) return;

                /* ---- Normalisasi path: buang trailing "/" kecuali root ---- */
                function normalizePath(url) {
                    try {
                        var u = new URL(url, window.location.origin);
                        var p = u.pathname;
                        if (p.length > 1 && p.charAt(p.length - 1) === '/') {
                            p = p.slice(0, -1);
                        }
                        return { path: p, search: u.search };
                    } catch (e) {
                        return { path: null, search: '' };
                    }
                }

                /* ---- Cabut .active dari SEMUA menu lalu tempel ke 1 link ---- */
                function setActiveLink(targetLink) {
                    var links = nav.querySelectorAll('a.sidebar-link');
                    for (var i = 0; i < links.length; i++) {
                        links[i].classList.remove('active');
                    }
                    if (targetLink) {
                        targetLink.classList.add('active');
                    }
                }

                /* ---- (2) REFRESH / LOAD PERTAMA: cocokkan dengan URL Laravel ---- */
                function syncWithCurrentUrl() {
                    var current = normalizePath(window.location.href);
                    if (!current.path) return;

                    var links = nav.querySelectorAll('a.sidebar-link[href]');
                    var best = null;
                    var bestLen = -1;

                    for (var i = 0; i < links.length; i++) {
                        var a = links[i];
                        var hrefAttr = a.getAttribute('href');
                        if (!hrefAttr || hrefAttr === '#') {   // menu dummy → selalu non-aktif
                            a.classList.remove('active');
                            continue;
                        }

                        var link = normalizePath(a.href);
                        if (!link.path) continue;

                        var isExact  = link.path === current.path && link.search === current.search;
                        var isParent = link.search === '' &&
                                       current.path !== link.path &&
                                       current.path.indexOf(link.path + '/') === 0;

                        if (isExact || isParent) {
                            if (link.path.length > bestLen) {  // prefix paling spesifik menang
                                best = a;
                                bestLen = link.path.length;
                            }
                        } else {
                            a.classList.remove('active');
                        }
                    }

                    setActiveLink(best);
                }

                /* ---- (1) KLIK 1x: pindahkan .active secara instan ---- */
                nav.addEventListener('click', function (event) {
                    var link = event.target.closest ? event.target.closest('a.sidebar-link') : null;
                    if (!link || !nav.contains(link)) return;

                    var hrefAttr = link.getAttribute('href');

                    // Menu dummy (#) → jangan menyala, biarkan default browser
                    if (!hrefAttr || hrefAttr === '#') {
                        event.preventDefault();
                        return;
                    }

                    // Jangan reorder saat klik modifier (buka tab baru dsb.)
                    if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;

                    // Pindahkan highlight SEKARANG (1x klik, tanpa menunggu router)
                    setActiveLink(link);
                    // Router (router.js) melanjutkan navigasi konten secara normal.
                });

                /* ---- Jalankan saat load pertama & setelah refresh ---- */
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', syncWithCurrentUrl);
                } else {
                    syncWithCurrentUrl();
                }

                /* ---- Jaga konsistensi saat router selesai pindah halaman ---- */
                document.addEventListener('pt:after-swap', syncWithCurrentUrl);
            })();
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

        {{-- ============================================================
             THEME MANAGER — terang / gelap / sistem
             - Toggle topbar: light ↔ dark (disimpan eksplisit).
             - Halaman Pengaturan bisa set light/dark/system via
               window.AdminTheme.set('light'|'dark'|'system').
             - Ikon topbar di-sync otomatis (moon = sedang terang).
             - Ikuti perubahan preferensi OS saat mode "system".
             ============================================================ --}}
        <script>
            (function () {
                'use strict';

                var KEY = 'admin-theme';

                function pref() {
                    try { return localStorage.getItem(KEY) || 'system'; }
                    catch (e) { return 'system'; }
                }

                function systemDark() {
                    return window.matchMedia('(prefers-color-scheme: dark)').matches;
                }

                function apply(prefName) {
                    var dark = prefName === 'dark' ||
                        (prefName === 'system' && systemDark());
                    document.documentElement.classList.toggle('theme-dark', dark);
                    syncIcons();
                }

                function syncIcons() {
                    var dark = document.documentElement.classList.contains('theme-dark');
                    var btn = document.getElementById('themeToggle');
                    if (btn) {
                        btn.innerHTML = dark
                            ? '<i class="fas fa-sun"></i>'
                            : '<i class="fas fa-moon"></i>';
                        btn.title = dark ? 'Ganti ke mode terang' : 'Ganti ke mode gelap';
                    }
                    document.querySelectorAll('[data-theme-label]')
                        .forEach(function (el) { el.textContent = dark ? 'Gelap' : 'Terang'; });
                }

                function set(next) {
                    try { localStorage.setItem(KEY, next); } catch (e) {}
                    apply(next);
                    document.dispatchEvent(new CustomEvent('admin:theme-changed', {
                        detail: { theme: next, dark: document.documentElement.classList.contains('theme-dark') }
                    }));
                }

                /* ---- Toggle topbar: light ↔ dark ---- */
                document.addEventListener('click', function (e) {
                    var btn = e.target.closest ? e.target.closest('#themeToggle') : null;
                    if (!btn) return;
                    var dark = document.documentElement.classList.contains('theme-dark');
                    set(dark ? 'light' : 'dark');
                });

                /* ---- Ikuti perubahan OS saat mode "system" ---- */
                var mq = window.matchMedia('(prefers-color-scheme: dark)');
                if (mq.addEventListener) {
                    mq.addEventListener('change', function () { if (pref() === 'system') apply('system'); });
                }

                /* ---- State awal + sync ikon ---- */
                apply(pref());

                /* ---- API publik untuk halaman Pengaturan ---- */
                window.AdminTheme = {
                    get: pref,
                    set: set,
                    isDark: function () { return document.documentElement.classList.contains('theme-dark'); }
                };
            })();
        </script>

        @stack('scripts')
    </body>
</html>
