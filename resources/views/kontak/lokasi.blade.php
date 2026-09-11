@extends('layouts.app')

@section('title', 'Lokasi & Unit Pembangkitan - PT PLN Nusantara Power')

@push('styles')
<style>
    /* ============================================
       PAGE CANVAS
       ============================================ */

    /* Seam fix: hilangkan border/shadow navbar di sambungan navbar-hero
       (hanya berlaku pada halaman yang punya hero banner ini) */
    body:has(.hero-header-banner) .navbar-pln:not(.scrolled) {
        border-bottom: none;
        margin-bottom: 0;
        box-shadow: none;
    }

    /* ============================================
       1. HERO HEADER BANNER (Full Width)
       Gradient horizontal: Ocean Blue -> Deep Navy
       ============================================ */
    .hero-header-banner {
        /* Lapisan 1 (atas): fade dari warna dasar navbar (--pln-blue = #005B9C)
           agar titik temu navbar-hero identik & menyatu.
           Lapisan 2 (bawah): gradasi horizontal Ocean Blue -> Deep Navy. */
        background:
            linear-gradient(180deg, var(--pln-blue) 0%, rgba(0, 91, 156, 0) 55%),
            linear-gradient(90deg, #004B87 0%, #0A192F 100%);
        margin-top: 0;
        border-top: none;
        /* 76px = offset navbar fixed-top, digabung ke padding banner
           (bukan padding pada wrapper) supaya background banner naik
           hingga ke bawah navbar tanpa sela. */
        padding: calc(76px + 3.5rem) 0 3.5rem;
        color: #FFFFFF;
        position: relative;
        overflow: hidden;
    }

    /* Aksen dekoratif radial halus di kanan atas */
    .hero-header-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-header-banner .container { position: relative; z-index: 2; }

    /* ---------- Breadcrumb ---------- */
    .breadcrumb-nav {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.45rem;
        margin-bottom: 1rem;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .breadcrumb-nav a {
        color: rgba(255, 255, 255, 0.7);
        transition: color 0.2s ease;
    }

    .breadcrumb-nav a:hover { color: #FFD100; }

    .breadcrumb-nav .sep { color: rgba(255, 255, 255, 0.4); }

    .breadcrumb-nav .current {
        color: #FFFFFF;
        font-weight: 700;
    }

    /* ---------- Judul & Sub-judul ---------- */
    .hero-header-banner h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #FFFFFF;
        line-height: 1.2;
        margin-bottom: 0.75rem;
    }

    .hero-header-banner h1 .accent { color: #FFD100; }

    .hero-header-banner .subtitle {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.85);
        max-width: 650px;
        line-height: 1.6;
        margin: 0;
    }

    /* ============================================
       2. KONTEN KANVAS (Di bawah banner)
       ============================================ */
    .lokasi-content {
        background: #F8FAFC;
        padding: 4rem 0 5rem;
    }

    /* ============================================
       3. PETA UTAMA (Terunci ke UP Indramayu)
       ============================================ */
    .map-wrapper {
        height: 420px;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #E2E8F0;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        background: #E2E8F0;
        position: relative;
        z-index: 1; /* di bawah dropdown navbar */
    }

    .map-wrapper iframe {
        width: 100%;
        height: 100%;
        border: 0;
        display: block;
    }

    /* ============================================
       4. CARD DETAIL LOKASI UTAMA
       ============================================ */
    .lokasi-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        padding: 2.25rem;
        margin-top: 2rem;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.05);
        transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .lokasi-card:hover {
        border-color: rgba(0, 163, 224, 0.35);
        box-shadow: 0 16px 40px rgba(0, 163, 224, 0.12);
    }

    .lokasi-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.85rem;
        border-radius: 6px;
        background: rgba(0, 163, 224, 0.1);
        color: #00A3E0;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 1rem;
    }

    .lokasi-title {
        color: #0A2540;
        font-size: 1.35rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 1.25rem;
    }

    .lokasi-detail {
        display: flex;
        align-items: flex-start;
        gap: 0.9rem;
        padding: 0.95rem 0;
    }

    .lokasi-detail + .lokasi-detail { border-top: 1px solid #E2E8F0; }

    .lokasi-detail-icon {
        flex-shrink: 0;
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: rgba(0, 163, 224, 0.1);
        color: #00A3E0;
        transition: background 0.3s ease, color 0.3s ease;
    }

    .lokasi-detail:hover .lokasi-detail-icon {
        background: #00A3E0;
        color: #FFFFFF;
    }

    .lokasi-detail-label {
        color: #64748B;
        font-size: 0.78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 0.2rem;
    }

    .lokasi-detail-value {
        color: #1E293B;
        font-size: 0.95rem;
        font-weight: 500;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .btn-direction {
        margin-top: 1.75rem;
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.55rem;
        padding: 0.85rem 1.5rem;
        border-radius: 10px;
        background: #00A3E0;
        border: 1.5px solid #00A3E0;
        color: #FFFFFF;
        font-size: 0.95rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .btn-direction:hover {
        background: #0089BE;
        border-color: #0089BE;
        color: #FFFFFF;
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(0, 163, 224, 0.3);
    }

    .btn-direction i { transition: transform 0.25s ease; }
    .btn-direction:hover i { transform: translateX(3px); }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 991.98px) {
        .hero-header-banner { padding: calc(76px + 3rem) 0 3rem; }
        .hero-header-banner h1 { font-size: 2.1rem; }
        .lokasi-content { padding: 3rem 0 4rem; }
        .lokasi-card { padding: 1.75rem; }
    }

    @media (max-width: 575.98px) {
        .hero-header-banner { padding: calc(76px + 2.5rem) 0 2.5rem; }
        .hero-header-banner h1 { font-size: 1.7rem; }
        .hero-header-banner .subtitle { font-size: 0.92rem; }
        .breadcrumb-nav { font-size: 0.82rem; }
        .lokasi-content { padding: 2.5rem 0 3.5rem; }
        .map-wrapper { height: 300px; border-radius: 12px; }
        .lokasi-card { padding: 1.4rem; border-radius: 14px; margin-top: 1.5rem; }
        .lokasi-title { font-size: 1.15rem; }
    }
</style>
@endpush

@section('content')
<div class="lokasi-page">

    {{-- ============================================
         1. HERO HEADER BANNER (Full Width, Seamless)
         ============================================ --}}
    <section class="hero-header-banner">
        <div class="container px-4 px-lg-5">
            {{-- Breadcrumb --}}
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Kontak</a>
                <span class="sep">&rsaquo;</span>
                <span class="current">Lokasi</span>
            </nav>

            {{-- Judul dengan Highlight Kuning --}}
            <h1>
                Lokasi <span class="accent">PLTU UP Indramayu</span>
            </h1>

            {{-- Sub-judul --}}
            <p class="subtitle">
                Alamat dan peta petunjuk arah operasional Unit Pembangkitan Indramayu
                (PT PLN Nusantara Power).
            </p>
        </div>
    </section>

    {{-- ============================================
         2. KONTEN KANVAS
         ============================================ --}}
    <section class="lokasi-content">
        <div class="container px-4 px-lg-5">

            {{-- ---------- PETA UTAMA (Terunci UP Indramayu) ---------- --}}
            <div class="map-wrapper">
                <iframe
                    src="https://maps.google.com/maps?q=-6.2741755,107.9706483&z=16&output=embed"
                    title="Peta Lokasi UP PLTU Indramayu — PT PLN Nusantara Power"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            {{-- ---------- CARD DETAIL LOKASI UTAMA ---------- --}}
            <div class="lokasi-card">
                <span class="lokasi-badge"><i class="fas fa-industry"></i> Unit Pembangkitan</span>

                <h2 class="lokasi-title">PT PLN Nusantara Power — UP PLTU Indramayu</h2>

                <div class="lokasi-detail">
                    <div class="lokasi-detail-icon">
                        <i class="fas fa-location-dot" style="font-size: 1.05rem;"></i>
                    </div>
                    <div>
                        <div class="lokasi-detail-label">Alamat Lengkap</div>
                        <p class="lokasi-detail-value">
                            Desa Sumuradem, Kec. Sukra, Kabupaten Indramayu,<br>
                            Jawa Barat 45257
                        </p>
                    </div>
                </div>

                <div class="lokasi-detail">
                    <div class="lokasi-detail-icon">
                        <i class="fas fa-crosshairs" style="font-size: 1.05rem;"></i>
                    </div>
                    <div>
                        <div class="lokasi-detail-label">Koordinat</div>
                        <p class="lokasi-detail-value">6°16'27.0"S 107°58'14.3"E</p>
                    </div>
                </div>

                <a class="btn-direction" target="_blank" rel="noopener"
                   href="https://www.google.com/maps/place/6%C2%B016'27.0%22S+107%C2%B058'14.3%22E/@-6.2741755,107.9706483,17z">
                    <i class="fas fa-diamond-turn-right"></i> Buka Petunjuk Arah di Google Maps
                </a>
            </div>

        </div>
    </section>

</div>
@endsection
