@extends('layouts.app')

@section('title', 'E-PPID PLN — Daftar Layanan')

@section('content')
<style>
    /* =============================================
       DAFTAR LAYANAN — CORPORATE SERVICES PAGE
       ============================================= */

    .layanan-page {
        background: #f4f6f9;
        min-height: 100vh;
        color: #1e293b;
        padding-top: 76px;
    }

    /* ---------- Hero Header ---------- */
    .layanan-hero {
        padding: 1.5rem 0 3.5rem;
        background: linear-gradient(135deg, #032b56 0%, #005b9c 50%, #1a1a2e 100%);
        position: relative;
        overflow: hidden;
    }

    .layanan-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(255, 230, 0, 0.10) 0%, transparent 70%);
        border-radius: 50%;
    }

    .layanan-hero::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.10) 0%, transparent 70%);
        border-radius: 50%;
    }

    .layanan-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #ffe600 0%, #ffd000 100%);
        color: #032b56;
        font-weight: 800;
        font-size: 0.68rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.45rem 1.2rem;
        border-radius: 4px;
        margin-bottom: 1.2rem;
        position: relative;
        z-index: 2;
        box-shadow: 0 4px 15px rgba(255, 230, 0, 0.25);
        border: 1px solid rgba(255, 230, 0, 0.6);
    }

    .layanan-badge::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 4px;
        background: repeating-linear-gradient(
            135deg,
            transparent,
            transparent 4px,
            rgba(255, 255, 255, 0.12) 4px,
            rgba(255, 255, 255, 0.12) 8px
        );
        pointer-events: none;
    }

    .layanan-badge i { font-size: 0.75rem; }

    .layanan-hero h1 {
        font-size: 2.4rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 0.75rem;
        position: relative;
        z-index: 2;
    }

    .layanan-hero h1 .accent { color: #ffe600; }

    .layanan-hero .subtitle {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.75);
        max-width: 620px;
        line-height: 1.7;
        position: relative;
        z-index: 2;
    }

    .layanan-breadcrumb {
        padding: 0 0 1.5rem;
        position: relative;
        z-index: 2;
    }

    .layanan-breadcrumb .breadcrumb { background: transparent; margin: 0; padding: 0; }

    .layanan-breadcrumb .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .layanan-breadcrumb .breadcrumb-item a:hover { color: #ffe600; }

    .layanan-breadcrumb .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.82rem;
        font-weight: 600;
    }

    .layanan-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.35);
        content: "/";
        font-size: 0.75rem;
    }

    /* ---------- Main Card ---------- */
    .layanan-section {
        padding: 3rem 0 4.5rem;
        background: #f4f6f9;
    }

    .layanan-card {
        background: #fff;
        border-radius: 18px;
        padding: 2.75rem 2.5rem;
        box-shadow: 0 2px 16px rgba(15, 23, 42, 0.05);
        border: 1px solid #e9ecef;
    }

    .layanan-card-header {
        text-align: center;
        margin-bottom: 2.5rem;
        padding-bottom: 1.75rem;
        border-bottom: 1px solid #f1f3f5;
    }

    .layanan-card-header h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.4rem;
    }

    .layanan-card-header p {
        font-size: 0.9rem;
        color: #64748b;
        margin: 0;
    }

    /* ---------- Service Grid ---------- */
    .service-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
    }

    .service-item {
        display: flex;
        align-items: flex-start;
        gap: 1.15rem;
        padding: 1.5rem;
        border-radius: 14px;
        border: 1px solid transparent;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
    }

    .service-item:hover {
        background: #f8fafc;
        border-color: #e2e8f0;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.06);
    }

    /* Icon Wrapper — illustration style */
    .service-icon-wrap {
        position: relative;
        width: 64px;
        height: 64px;
        flex-shrink: 0;
    }

    .service-icon-bg {
        position: absolute;
        inset: 0;
        border-radius: 16px;
        opacity: 0.12;
    }

    .service-icon {
        position: relative;
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        transition: transform 0.3s ease;
    }

    .service-item:hover .service-icon {
        transform: scale(1.08);
    }

    /* Color themes matching the image */
    .theme-red {
        --svc-color: #e74c3c;
        --svc-bg: #fdecea;
        --svc-light: #fdd;
    }
    .theme-red .service-icon { color: #c0392b; background: var(--svc-bg); }

    .theme-blue {
        --svc-color: #2980b9;
        --svc-bg: #eaf2fb;
        --svc-light: #d6e9f8;
    }
    .theme-blue .service-icon { color: #1a6fa3; background: var(--svc-bg); }

    .theme-yellow {
        --svc-color: #d4a017;
        --svc-bg: #fdf6e3;
        --svc-light: #fcefc7;
    }
    .theme-yellow .service-icon { color: #b8860b; background: var(--svc-bg); }

    .theme-lightred {
        --svc-color: #e8836b;
        --svc-bg: #fef2ef;
        --svc-light: #fde0da;
    }
    .theme-lightred .service-icon { color: #d36a52; background: var(--svc-bg); }

    .theme-lightblue {
        --svc-color: #6ba3d6;
        --svc-bg: #eef5fc;
        --svc-light: #d9eaf7;
    }
    .theme-lightblue .service-icon { color: #4d8abf; background: var(--svc-bg); }

    .theme-lightyellow {
        --svc-color: #d4b84a;
        --svc-bg: #fefae8;
        --svc-light: #fdf0c8;
    }
    .theme-lightyellow .service-icon { color: #b99a2e; background: var(--svc-bg); }

    /* Text */
    .service-text { flex: 1; min-width: 0; padding-top: 0.15rem; }

    .service-text h4 {
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.3rem;
        line-height: 1.35;
        transition: color 0.2s ease;
    }

    .service-item:hover .service-text h4 { color: #005b9c; }

    .service-text p {
        font-size: 0.84rem;
        color: #64748b;
        line-height: 1.6;
        margin: 0;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 991.98px) {
        .layanan-hero h1 { font-size: 2rem; }
        .service-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
    }

    @media (max-width: 767.98px) {
        .layanan-hero { padding: 1.5rem 0 2.5rem; }
        .layanan-hero h1 { font-size: 1.65rem; }
        .layanan-card { padding: 1.75rem 1.25rem; border-radius: 14px; }
        .service-grid { grid-template-columns: 1fr; gap: 0.5rem; }
        .service-item { padding: 1.15rem; }
        .service-icon-wrap,
        .service-icon { width: 52px; height: 52px; }
        .service-icon { font-size: 1.35rem; border-radius: 13px; }
    }

    /* ---------- Animation ---------- */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .service-item {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }

    .service-item:nth-child(1) { animation-delay: 0.05s; }
    .service-item:nth-child(2) { animation-delay: 0.10s; }
    .service-item:nth-child(3) { animation-delay: 0.15s; }
    .service-item:nth-child(4) { animation-delay: 0.20s; }
    .service-item:nth-child(5) { animation-delay: 0.25s; }
    .service-item:nth-child(6) { animation-delay: 0.30s; }
</style>

<div class="layanan-page">

    {{-- ============================================
         1. HERO / HEADER
         ============================================ --}}
    <section class="layanan-hero">
        <div class="container px-4 px-lg-5">
            <div class="layanan-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Layanan</li>
                    </ol>
                </nav>
            </div>

            <div class="layanan-badge">
                <i class="fas fa-bolt"></i> PLN NUSANTARA POWER
            </div>

            <h1>Daftar <span class="accent">Layanan</span> Publik</h1>
            <p class="subtitle">
                Akses berbagai layanan kelistrikan yang disediakan oleh
                PT PLN Nusantara Power UP PLTU Indramayu secara transparan dan akuntabel.
            </p>
        </div>
    </section>

    {{-- ============================================
         2. MAIN CONTENT CARD
         ============================================ --}}
    <section class="layanan-section">
        <div class="container px-4 px-lg-5">

            <div class="layanan-card">

                <div class="layanan-card-header">
                    <h2>Layanan Kelistrikan</h2>
                    <p>Pilih layanan yang Anda butuhkan untuk memulai proses permohonan</p>
                </div>

                <div class="service-grid">

                    {{-- 1. Pasang Baru --}}
                    <a href="{{ route('layanan.detail', 'pasang-baru') }}" class="service-item">
                        <div class="service-icon-wrap">
                            <div class="service-icon theme-red">
                                <i class="fas fa-bolt"></i>
                            </div>
                        </div>
                        <div class="service-text">
                            <h4>Pasang Baru</h4>
                            <p>Layanan permohonan penyambungan baru listrik</p>
                        </div>
                    </a>

                    {{-- 2. Sambung Sementara --}}
                    <a href="{{ route('layanan.detail', 'sambung-sementara') }}" class="service-item">
                        <div class="service-icon-wrap">
                            <div class="service-icon theme-blue">
                                <i class="fas fa-plug"></i>
                            </div>
                        </div>
                        <div class="service-text">
                            <h4>Sambung Sementara</h4>
                            <p>Layanan permohonan penyambungan listrik sementara</p>
                        </div>
                    </a>

                    {{-- 3. Ubah Daya --}}
                    <a href="{{ route('layanan.detail', 'ubah-daya') }}" class="service-item">
                        <div class="service-icon-wrap">
                            <div class="service-icon theme-yellow">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                        </div>
                        <div class="service-text">
                            <h4>Ubah Daya</h4>
                            <p>Layanan permohonan perubahan daya listrik</p>
                        </div>
                    </a>

                    {{-- 4. Simulasi Pasang Baru --}}
                    <a href="{{ route('layanan.detail', 'simulasi-pasang-baru') }}" class="service-item">
                        <div class="service-icon-wrap">
                            <div class="service-icon theme-lightred">
                                <i class="fas fa-calculator"></i>
                            </div>
                        </div>
                        <div class="service-text">
                            <h4>Simulasi Pasang Baru</h4>
                            <p>Simulasi biaya permohonan penyambungan baru listrik</p>
                        </div>
                    </a>

                    {{-- 5. Simulasi Sambung Sementara --}}
                    <a href="{{ route('layanan.detail', 'simulasi-sambung-sementara') }}" class="service-item">
                        <div class="service-icon-wrap">
                            <div class="service-icon theme-lightblue">
                                <i class="fas fa-calculator"></i>
                            </div>
                        </div>
                        <div class="service-text">
                            <h4>Simulasi Sambung Sementara</h4>
                            <p>Simulasi biaya permohonan penyambungan listrik sementara</p>
                        </div>
                    </a>

                    {{-- 6. Simulasi Ubah Daya --}}
                    <a href="{{ route('layanan.detail', 'simulasi-ubah-daya') }}" class="service-item">
                        <div class="service-icon-wrap">
                            <div class="service-icon theme-lightyellow">
                                <i class="fas fa-calculator"></i>
                            </div>
                        </div>
                        <div class="service-text">
                            <h4>Simulasi Ubah Daya</h4>
                            <p>Simulasi biaya permohonan perubahan daya listrik</p>
                        </div>
                    </a>

                </div>

            </div>

        </div>
    </section>

</div>
@endsection