@extends('layouts.app')

@section('title', 'E-PPID PLN — ' . $layanan['judul'])

@section('content')
<style>
    .detail-page {
        background: #f4f6f9;
        min-height: 100vh;
        color: #1e293b;
        padding-top: 76px;
    }

    /* Hero */
    .detail-hero {
        padding: 1.5rem 0 3.5rem;
        background: linear-gradient(135deg, #032b56 0%, #005b9c 50%, #1a1a2e 100%);
        position: relative;
        overflow: hidden;
    }

    .detail-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(255, 230, 0, 0.10) 0%, transparent 70%);
        border-radius: 50%;
    }

    .detail-hero::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.10) 0%, transparent 70%);
        border-radius: 50%;
    }

    .detail-hero .breadcrumb-wrap {
        padding: 0 0 1.5rem;
        position: relative;
        z-index: 2;
    }

    .detail-hero .breadcrumb { background: transparent; margin: 0; padding: 0; }

    .detail-hero .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .detail-hero .breadcrumb-item a:hover { color: #ffe600; }

    .detail-hero .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.82rem;
        font-weight: 600;
    }

    .detail-hero .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.35);
        content: "/";
        font-size: 0.75rem;
    }

    .detail-badge {
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

    .detail-badge::before {
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

    .detail-badge i { font-size: 0.75rem; }

    .detail-hero h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 0.75rem;
        position: relative;
        z-index: 2;
    }

    .detail-hero h1 .accent { color: #ffe600; }

    .detail-hero .subtitle {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.75);
        max-width: 620px;
        line-height: 1.7;
        position: relative;
        z-index: 2;
    }

    /* Content Card */
    .detail-section {
        padding: 3rem 0 4.5rem;
        background: #f4f6f9;
    }

    .detail-card {
        background: #fff;
        border-radius: 18px;
        padding: 2.75rem 2.5rem;
        box-shadow: 0 2px 16px rgba(15, 23, 42, 0.05);
        border: 1px solid #e9ecef;
    }

    .detail-card-header {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        margin-bottom: 2rem;
        padding-bottom: 1.75rem;
        border-bottom: 1px solid #f1f3f5;
    }

    .detail-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        color: #fff;
        flex-shrink: 0;
    }

    .detail-card-header h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }

    .detail-card-header p {
        font-size: 0.88rem;
        color: #64748b;
        margin: 0;
    }

    /* Sections */
    .detail-content h3 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-content h3 i {
        color: #00a3e0;
        font-size: 0.9rem;
    }

    .detail-content p {
        font-size: 0.92rem;
        color: #475569;
        line-height: 1.75;
        margin-bottom: 1.25rem;
    }

    .detail-content ul {
        list-style: none;
        padding: 0;
        margin: 0 0 1.5rem;
    }

    .detail-content ul li {
        font-size: 0.9rem;
        color: #475569;
        line-height: 1.7;
        padding: 0.45rem 0 0.45rem 1.5rem;
        position: relative;
    }

    .detail-content ul li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.85rem;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #00a3e0;
    }

    .detail-content .step-list {
        counter-reset: step;
    }

    .detail-content .step-list li {
        counter-increment: step;
        padding-left: 2.5rem;
    }

    .detail-content .step-list li::before {
        content: counter(step);
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: linear-gradient(135deg, #005b9c, #00a3e0);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        top: 0.5rem;
        left: 0;
    }

    /* Back button */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.6rem 1.4rem;
        border-radius: 50px;
        border: 1.5px solid #005b9c;
        background: transparent;
        color: #005b9c;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
        margin-top: 2rem;
    }

    .btn-back:hover {
        background: #005b9c;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(0, 91, 156, 0.3);
    }

    /* Info Box */
    .info-box {
        background: #f0f7ff;
        border: 1px solid #d0e3f7;
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
    }

    .info-box h4 {
        font-size: 0.9rem;
        font-weight: 700;
        color: #005b9c;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .info-box p,
    .info-box li {
        font-size: 0.85rem;
        color: #475569;
        line-height: 1.7;
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .detail-hero h1 { font-size: 1.85rem; }
    }

    @media (max-width: 767.98px) {
        .detail-hero { padding: 1.5rem 0 2.5rem; }
        .detail-hero h1 { font-size: 1.55rem; }
        .detail-card { padding: 1.75rem 1.25rem; border-radius: 14px; }
        .detail-card-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .detail-icon { width: 52px; height: 52px; font-size: 1.3rem; border-radius: 13px; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .detail-card {
        animation: fadeInUp 0.5s ease forwards;
    }
</style>

<div class="detail-page">

    {{-- HERO --}}
    <section class="detail-hero">
        <div class="container px-4 px-lg-5">
            <div class="breadcrumb-wrap">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('layanan.daftar') }}">Layanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $layanan['judul'] }}</li>
                    </ol>
                </nav>
            </div>

            <div class="detail-badge">
                <i class="fas fa-bolt"></i> PLN NUSANTARA POWER
            </div>

            <h1>{{ $layanan['judul'] }}</h1>
            <p class="subtitle">{{ $layanan['deskripsi'] }}</p>
        </div>
    </section>

    {{-- CONTENT --}}
    <section class="detail-section">
        <div class="container px-4 px-lg-5">
            <div class="detail-card">

                <div class="detail-card-header">
                    <div class="detail-icon" style="background: {{ $layanan['icon_bg'] }}">
                        <i class="fas {{ $layanan['icon'] }}"></i>
                    </div>
                    <div>
                        <h2>{{ $layanan['judul'] }}</h2>
                        <p>{{ $layanan['subjudul'] }}</p>
                    </div>
                </div>

                <div class="detail-content">
                    {!! $layanan['konten'] !!}
                </div>

                <a href="{{ route('layanan.daftar') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Layanan
                </a>

            </div>
        </div>
    </section>

</div>
@endsection