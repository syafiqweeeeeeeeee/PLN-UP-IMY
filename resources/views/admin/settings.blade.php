@extends('layouts.admin')

@section('title', 'Pengaturan — E-PPID PLN')
@section('page-title', 'Pengaturan')

@push('styles')
<style>
    /* ============================================
       SETTINGS PAGE — pola visual /admin/news
       ============================================ */

    /* --- Settings Card --- */
    .settings-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        margin-bottom: 1.25rem;
        overflow: hidden;
    }
    .settings-card .settings-card-head {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        padding: 1.15rem 1.5rem;
        border-bottom: 1px solid var(--line-soft);
    }
    .settings-card .settings-card-head .head-icon {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        flex-shrink: 0;
    }
    .settings-card .settings-card-head .head-icon.blue   { background: rgba(0,91,156,0.1);  color: var(--pln-blue); }
    .settings-card .settings-card-head .head-icon.green  { background: rgba(34,197,94,0.12); color: #16a34a; }
    .settings-card .settings-card-head .head-icon.amber  { background: rgba(245,158,11,0.12); color: #d97706; }
    .settings-card .settings-card-head .head-icon.violet { background: rgba(139,92,246,0.12); color: #7c3aed; }
    html.theme-dark .settings-card .settings-card-head .head-icon.blue   { background: rgba(0,163,224,0.16); color: var(--pln-cyan); }
    .settings-card .settings-card-head h6 {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--ink-heading);
        margin: 0;
    }
    .settings-card .settings-card-head p {
        font-size: 0.78rem;
        color: var(--ink-faint);
        margin: 0;
    }
    .settings-card .settings-card-body { padding: 1.25rem 1.5rem 1.5rem; }

    /* --- Theme Selector --- */
    .theme-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 0.85rem;
    }
    .theme-option { position: relative; }
    .theme-option input { position: absolute; opacity: 0; pointer-events: none; }
    .theme-option .theme-tile {
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
        padding: 1rem;
        background: var(--panel);
        border: 2px solid var(--line);
        border-radius: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
        height: 100%;
    }
    .theme-option .theme-tile:hover { border-color: var(--pln-blue); transform: translateY(-2px); }
    .theme-option input:checked + .theme-tile {
        border-color: var(--pln-blue);
        background: var(--panel-hover);
        box-shadow: 0 0 0 3px var(--focus-ring);
    }
    .theme-option input:focus-visible + .theme-tile {
        outline: 2px solid var(--pln-cyan);
        outline-offset: 2px;
    }
    .theme-preview {
        border-radius: 9px;
        height: 62px;
        border: 1px solid var(--line);
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
    }
    .theme-preview .tp-bar {
        height: 12px;
        display: flex;
        align-items: center;
        gap: 3px;
        padding: 0 6px;
    }
    .theme-preview .tp-bar i { width: 4px; height: 4px; border-radius: 50%; display: block; }
    .theme-preview .tp-body { display: flex; gap: 6px; padding: 7px 6px; height: calc(100% - 12px); }
    .theme-preview .tp-side { width: 16px; border-radius: 4px; flex-shrink: 0; }
    .theme-preview .tp-main { flex: 1; border-radius: 4px; }
    .theme-preview .tp-main::before {
        content: '';
        display: block;
        height: 7px;
        width: 55%;
        border-radius: 3px;
        margin-bottom: 5px;
    }
    .theme-preview .tp-main::after {
        content: '';
        display: block;
        height: 7px;
        width: 80%;
        border-radius: 3px;
    }
    .theme-preview.light .tp-bar  { background: #ffffff; }
    .theme-preview.light .tp-bar i { background: #cbd5e1; }
    .theme-preview.light .tp-side { background: #003d6b; }
    .theme-preview.light .tp-main { background: #f1f5f9; }
    .theme-preview.light .tp-main::before,
    .theme-preview.light .tp-main::after { background: #cbd5e1; }
    .theme-preview.dark .tp-bar   { background: #1b2537; }
    .theme-preview.dark .tp-bar i  { background: #475569; }
    .theme-preview.dark .tp-side  { background: #0c1320; }
    .theme-preview.dark .tp-main  { background: #223049; }
    .theme-preview.dark .tp-main::before,
    .theme-preview.dark .tp-main::after { background: #3b4a66; }
    .theme-preview.system .tp-bar { background: linear-gradient(90deg, #ffffff 50%, #1b2537 50%); }
    .theme-preview.system .tp-bar i { background: #94a3b8; }
    .theme-preview.system .tp-side { background: linear-gradient(180deg, #003d6b 50%, #0c1320 50%); }
    .theme-preview.system .tp-main { background: linear-gradient(90deg, #f1f5f9 50%, #223049 50%); }
    .theme-preview.system .tp-main::before,
    .theme-preview.system .tp-main::after { background: #94a3b8; }
    .theme-option .theme-tile .tile-label {
        display: flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--ink-heading);
    }
    .theme-option .theme-tile .tile-label i { font-size: 0.8rem; color: var(--ink-muted); }
    .theme-option input:checked + .theme-tile .tile-label i { color: var(--pln-blue); }
    html.theme-dark .theme-option input:checked + .theme-tile .tile-label i { color: var(--pln-cyan); }
    .theme-option .theme-tile .tile-desc {
        font-size: 0.72rem;
        color: var(--ink-muted);
        line-height: 1.45;
    }
    .theme-active-note {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        margin-top: 0.9rem;
        padding: 0.4rem 0.85rem;
        background: var(--panel);
        border: 1px solid var(--line);
        border-radius: 8px;
        font-size: 0.75rem;
        color: var(--ink-muted);
    }
    .theme-active-note strong { color: var(--ink-heading); }

    /* --- Setting Row (toggle generik) --- */
    .setting-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 0.9rem 0;
        border-bottom: 1px dashed var(--line-soft);
    }
    .setting-row:last-child { border-bottom: none; }
    .setting-row .row-info h6 {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--ink-heading);
        margin: 0 0 0.15rem;
    }
    .setting-row .row-info p {
        font-size: 0.75rem;
        color: var(--ink-muted);
        margin: 0;
        line-height: 1.5;
    }

    /* --- Toggle Switch --- */
    .switch { position: relative; display: inline-block; width: 44px; height: 24px; flex-shrink: 0; }
    .switch input { opacity: 0; width: 0; height: 0; }
    .switch .slider {
        position: absolute;
        inset: 0;
        background: var(--line);
        border-radius: 24px;
        transition: background 0.25s ease;
        cursor: pointer;
    }
    .switch .slider::before {
        content: '';
        position: absolute;
        width: 18px;
        height: 18px;
        left: 3px;
        top: 3px;
        background: #fff;
        border-radius: 50%;
        transition: transform 0.25s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.25);
    }
    .switch input:checked + .slider { background: var(--pln-blue); }
    .switch input:checked + .slider::before { transform: translateX(20px); }
    .switch input:focus-visible + .slider {
        outline: 2px solid var(--pln-cyan);
        outline-offset: 2px;
    }

    /* --- Profile / Account --- */
    .account-box {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: var(--panel);
        border: 1px solid var(--line);
        border-radius: 12px;
        flex-wrap: wrap;
    }
    .account-avatar {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.05rem;
        flex-shrink: 0;
    }
    .account-name { font-size: 0.95rem; font-weight: 700; color: var(--ink-heading); }
    .account-mail { font-size: 0.78rem; color: var(--ink-muted); }
    .account-role {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
        background: rgba(0,91,156,0.1);
        color: var(--pln-blue);
    }
    html.theme-dark .account-role { background: rgba(0,163,224,0.16); color: var(--pln-cyan); }

    .settings-input {
        width: 100%;
        border: 1px solid var(--line);
        border-radius: 10px;
        padding: 0.55rem 1rem;
        font-size: 0.85rem;
        background: var(--panel);
        color: var(--ink-body);
        transition: all 0.2s ease;
    }
    .settings-input:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px var(--focus-ring);
        background: var(--bg-card);
        outline: none;
    }

    /* --- About / System Info --- */
    .sys-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.45rem 0.9rem;
        background: var(--panel);
        border: 1px solid var(--line);
        border-radius: 10px;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--ink-body);
    }
    .sys-badge i { color: #22c55e; font-size: 0.75rem; }
    .sys-version {
        font-size: 0.78rem;
        color: var(--ink-muted);
        line-height: 1.7;
    }
    .sys-version strong { color: var(--ink-heading); }

    /* --- Saved Toast --- */
    .settings-toast {
        position: fixed;
        bottom: 1.5rem;
        right: 1.5rem;
        z-index: 2100;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        background: #1f2937;
        color: #fff;
        padding: 0.7rem 1.15rem;
        border-radius: 12px;
        font-size: 0.82rem;
        font-weight: 600;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        opacity: 0;
        transform: translateY(12px);
        pointer-events: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .settings-toast.show { opacity: 1; transform: translateY(0); }
    .settings-toast i { color: #4ade80; }

    @media (max-width: 575.98px) {
        .settings-card .settings-card-body { padding: 1rem; }
        .settings-card .settings-card-head { padding: 1rem; }
    }
</style>
@endpush

@section('content')
{{-- ============================================
     PAGE HEADER (pola /admin/news)
     ============================================ --}}
<div class="page-header-card">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-gear header-icon"></i>Pengaturan</h5>
            <p>Sesuaikan tampilan dan preferensi panel admin</p>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- ============================================
         TEMA TAMPILAN (TERANG / GELAP / SISTEM)
         ============================================ --}}
    <div class="col-12">
        <div class="settings-card">
            <div class="settings-card-head">
                <div class="head-icon blue"><i class="fas fa-circle-half-stroke"></i></div>
                <div>
                    <h6>Tema Tampilan</h6>
                    <p>Pilih mode terang, gelap, atau ikuti preferensi sistem Anda</p>
                </div>
            </div>
            <div class="settings-card-body">
                <div class="theme-options" id="themeOptions">
                    <div class="theme-option">
                        <input type="radio" name="theme" id="themeLight" value="light">
                        <label class="theme-tile" for="themeLight">
                            <div class="theme-preview light">
                                <div class="tp-bar"><i></i><i></i><i></i></div>
                                <div class="tp-body">
                                    <div class="tp-side"></div>
                                    <div class="tp-main"></div>
                                </div>
                            </div>
                            <div class="tile-label"><i class="fas fa-sun"></i> Terang</div>
                            <div class="tile-desc">Cocok untuk ruang kerja terang. Tampilan default panel admin.</div>
                        </label>
                    </div>

                    <div class="theme-option">
                        <input type="radio" name="theme" id="themeDark" value="dark">
                        <label class="theme-tile" for="themeDark">
                            <div class="theme-preview dark">
                                <div class="tp-bar"><i></i><i></i><i></i></div>
                                <div class="tp-body">
                                    <div class="tp-side"></div>
                                    <div class="tp-main"></div>
                                </div>
                            </div>
                            <div class="tile-label"><i class="fas fa-moon"></i> Gelap</div>
                            <div class="tile-desc">Nyaman di lingkungan redup dan lebih hemat energi layar.</div>
                        </label>
                    </div>

                    <div class="theme-option">
                        <input type="radio" name="theme" id="themeSystem" value="system">
                        <label class="theme-tile" for="themeSystem">
                            <div class="theme-preview system">
                                <div class="tp-bar"><i></i><i></i><i></i></div>
                                <div class="tp-body">
                                    <div class="tp-side"></div>
                                    <div class="tp-main"></div>
                                </div>
                            </div>
                            <div class="tile-label"><i class="fas fa-desktop"></i> Sistem</div>
                            <div class="tile-desc">Otomatis mengikuti tema perangkat Anda (terang/gelap).</div>
                        </label>
                    </div>
                </div>

                <div class="theme-active-note">
                    <i class="fas fa-circle-info"></i>
                    Tema aktif saat ini: <strong data-theme-label>Terang</strong>
                    <span style="opacity: 0.5;">·</span>
                    <span>Perubahan tersimpan otomatis di browser ini</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         NOTIFIKASI
         ============================================ --}}
    <div class="col-12 col-lg-6">
        <div class="settings-card">
            <div class="settings-card-head">
                <div class="head-icon green"><i class="fas fa-bell"></i></div>
                <div>
                    <h6>Notifikasi</h6>
                    <p>Kendali pemberitahuan yang muncul di panel admin</p>
                </div>
            </div>
            <div class="settings-card-body">
                <div class="setting-row">
                    <div class="row-info">
                        <h6>Notifikasi Desktop</h6>
                        <p>Tampilkan pemberitahuan dari browser saat ada aktivitas baru.</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" id="setNotifDesktop" checked>
                        <span class="slider"></span>
                    </label>
                </div>
                <div class="setting-row">
                    <div class="row-info">
                        <h6>Ringkasan Mingguan</h6>
                        <p>Kirim ringkasan aktivitas konten setiap Senin pagi.</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" id="setNotifWeekly" checked>
                        <span class="slider"></span>
                    </label>
                </div>
                <div class="setting-row">
                    <div class="row-info">
                        <h6>Alert Konten Menunggu</h6>
                        <p>Tandai berita/pengumuman draft yang belum dipublikasi.</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" id="setNotifPending">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         AKUN
         ============================================ --}}
    <div class="col-12 col-lg-6">
        <div class="settings-card">
            <div class="settings-card-head">
                <div class="head-icon amber"><i class="fas fa-user-gear"></i></div>
                <div>
                    <h6>Akun</h6>
                    <p>Informasi profil dan keamanan akun Anda</p>
                </div>
            </div>
            <div class="settings-card-body">
                <div class="account-box mb-3">
                    <div class="account-avatar">AD</div>
                    <div class="flex-grow-1">
                        <div class="account-name">Admin PLN</div>
                        <div class="account-mail">admin@pltuindramayu.co.id</div>
                    </div>
                    <span class="account-role"><i class="fas fa-shield-halved"></i> Super Admin</span>
                </div>

                <div class="setting-row">
                    <div class="row-info" style="flex: 1;">
                        <h6>Nama Tampilan</h6>
                        <input type="text" class="settings-input mt-1" value="Admin PLN" id="setDisplayName">
                    </div>
                </div>
                <div class="setting-row">
                    <div class="row-info">
                        <h6>Autentikasi Dua Faktor</h6>
                        <p>Lapisan keamanan tambahan saat login.</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" id="setTwoFactor">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         TENTANG SISTEM
         ============================================ --}}
    <div class="col-12">
        <div class="settings-card">
            <div class="settings-card-head">
                <div class="head-icon violet"><i class="fas fa-circle-info"></i></div>
                <div>
                    <h6>Tentang Sistem</h6>
                    <p>Status dan informasi versi E-PPID PLN</p>
                </div>
            </div>
            <div class="settings-card-body">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="sys-badge"><i class="fas fa-circle"></i> Database: Normal</span>
                    <span class="sys-badge"><i class="fas fa-circle"></i> Aplikasi: Normal</span>
                    <span class="sys-badge"><i class="fas fa-triangle-exclamation" style="color:#f59e0b;"></i> Storage: Perhatian</span>
                </div>
                <div class="sys-version">
                    <strong>E-PPID PLN — Panel Admin</strong> · Versi 2.4.1<br>
                    Dikembangkan untuk UP PLTU Indramayu · © {{ date('Y') }} PT PLN (Persero)
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Saved Toast --}}
<div class="settings-toast" id="settingsToast">
    <i class="fas fa-circle-check"></i> <span id="settingsToastText">Pengaturan disimpan</span>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        'use strict';

        /* ============================================================
           TEMA — integrasi dengan window.AdminTheme (layouts/admin)
           ============================================================ */
        var radios = document.querySelectorAll('#themeOptions input[name="theme"]');
        var hasAdminTheme = typeof window.AdminTheme !== 'undefined';

        function showToast(text) {
            var toast = document.getElementById('settingsToast');
            if (!toast) return;
            document.getElementById('settingsToastText').textContent = text;
            toast.classList.add('show');
            clearTimeout(showToast._t);
            showToast._t = setTimeout(function () { toast.classList.remove('show'); }, 2200);
        }

        if (hasAdminTheme) {
            // Tandai pilihan tersimpan
            var current = window.AdminTheme.get();
            radios.forEach(function (r) { r.checked = r.value === current; });

            radios.forEach(function (r) {
                r.addEventListener('change', function () {
                    if (!r.checked) return;
                    window.AdminTheme.set(r.value);
                    showToast('Tema diubah ke mode ' + r.value);
                });
            });

            // Perbarui label "tema aktif" saat tema berubah dari mana pun
            document.addEventListener('admin:theme-changed', function (e) {
                radios.forEach(function (r) { r.checked = r.value === e.detail.theme; });
            });
        }

        /* ============================================================
           TOGGLE & INPUT LAIN — persist ke localStorage (demo lokal)
           ============================================================ */
        var toggles = ['setNotifDesktop', 'setNotifWeekly', 'setNotifPending', 'setTwoFactor'];

        toggles.forEach(function (id) {
            var el = document.getElementById(id);
            if (!el) return;

            var stored = null;
            try { stored = localStorage.getItem('settings-' + id); } catch (e) {}
            if (stored !== null) el.checked = stored === '1';

            el.addEventListener('change', function () {
                try { localStorage.setItem('settings-' + id, el.checked ? '1' : '0'); } catch (e) {}
                showToast('Pengaturan disimpan');
            });
        });

        var displayName = document.getElementById('setDisplayName');
        if (displayName) {
            var stored = null;
            try { stored = localStorage.getItem('settings-setDisplayName'); } catch (e) {}
            if (stored) displayName.value = stored;

            displayName.addEventListener('change', function () {
                try { localStorage.setItem('settings-setDisplayName', displayName.value); } catch (e) {}
                showToast('Pengaturan disimpan');
            });
        }
    })();
</script>
@endpush
