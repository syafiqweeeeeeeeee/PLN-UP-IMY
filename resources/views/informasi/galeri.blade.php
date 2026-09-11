@extends('layouts.app')

@section('title', 'E-PPID PLN — Galeri & Dokumentasi')

@section('content')
<link rel="preconnect" href="https://images.unsplash.com" crossorigin>
<link rel="dns-prefetch" href="https://images.unsplash.com">
<style>
    /* =============================================
       GALERI — DARK MINIMALIST THEME
       ============================================= */

    :root {
        --gallery-primary: #032B56;
        --gallery-accent: #FFEB00;
        --gallery-card: #fff;
        --gallery-card-hover: #f8f9fa;
        --gallery-border: #e2e8f0;
        --gallery-text: #1e293b;
        --gallery-text-muted: #64748b;
    }

    /* ---------- Page Wrapper ---------- */
    .galeri-page {
        background: #fff;
        min-height: 100vh;
        color: var(--gallery-text);
        padding-top: 76px;
    }

    /* ---------- Breadcrumb ---------- */
    .galeri-breadcrumb {
        padding: 0 0 1.5rem;
        position: relative;
        z-index: 2;
    }

    .galeri-breadcrumb .breadcrumb {
        background: transparent;
        margin: 0;
        padding: 0;
    }

    .galeri-breadcrumb .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .galeri-breadcrumb .breadcrumb-item a:hover {
        color: var(--pln-yellow);
    }

    .galeri-breadcrumb .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.82rem;
        font-weight: 600;
    }

    .galeri-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.4);
        content: "/";
        font-size: 0.75rem;
    }

    /* ---------- Hero Header ---------- */
    .galeri-hero {
        padding: 1.5rem 0 3.5rem;
        background: linear-gradient(135deg, var(--pln-blue) 0%, #003d6b 50%, var(--pln-dark) 100%);
        position: relative;
        overflow: hidden;
    }

    .galeri-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .galeri-hero h1 {
        font-size: 2.4rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 0.75rem;
        position: relative;
        z-index: 2;
    }

    .galeri-hero h1 .accent {
        color: var(--pln-yellow);
    }

    .galeri-hero .subtitle {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.8);
        max-width: 600px;
        line-height: 1.7;
        position: relative;
        z-index: 2;
    }

    /* ---------- Filter Bar ---------- */
    .filter-section {
        padding: 0 0 2.5rem;
        background: #fff;
    }

    .filter-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
    }

    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1.15rem;
        border-radius: 50px;
        border: 1px solid #e2e8f0;
        background: #f8f9fa;
        color: #64748b;
        font-size: 0.84rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.25s ease;
        white-space: nowrap;
        user-select: none;
    }

    .filter-chip:hover {
        border-color: rgba(0, 91, 156, 0.3);
        color: var(--pln-blue);
        background: #e9ecef;
    }

    .filter-chip.active {
        background: var(--pln-blue);
        color: #fff;
        border-color: var(--pln-blue);
        font-weight: 700;
        box-shadow: 0 2px 12px rgba(0, 91, 156, 0.25);
    }

    .filter-chip i {
        font-size: 0.78rem;
    }

    /* ---------- Gallery Grid ---------- */
    .gallery-grid {
        padding: 3rem 0 4rem;
        background: var(--pln-gray);
    }

    .gallery-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.35s ease;
        cursor: pointer;
        position: relative;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.05);
    }

    .gallery-card:hover {
        transform: translateY(-6px);
        border-color: var(--pln-cyan);
        box-shadow: 0 14px 34px rgba(0, 163, 224, 0.16);
    }

    .gallery-card .img-wrapper {
        position: relative;
        overflow: hidden;
        aspect-ratio: 4 / 3;
        background: #f1f5f9;
    }

    .gallery-card .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.45s ease;
    }

    .gallery-card:hover .img-wrapper img {
        transform: scale(1.05);
    }

    /* --- Stagger animasi filter: CSS murni, GPU (opacity+transform),
       delay di-drive via JS var --stagger-i (tanpa setTimeout) --- */
    .gallery-item.filter-anim {
        animation: galleryIn 0.4s ease both;
        animation-delay: calc(var(--stagger-i, 0) * 60ms);
    }

    @keyframes galleryIn {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* --- Crossfade gambar lightbox: CSS transition di compositor
       (opacity saja) — tanpa setTimeout, terasa instan (<100ms) --- */
    #lightboxImage {
        opacity: 1;
        transition: opacity 0.25s ease;
        will-change: opacity;
    }

    #lightboxImage:not(.is-loaded) {
        opacity: 0;
    }

    .gallery-card .img-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 40%, rgba(0, 0, 0, 0.5) 100%);
        opacity: 0;
        transition: opacity 0.35s ease;
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
        padding: 1rem;
    }

    .gallery-card:hover .img-overlay {
        opacity: 1;
    }

    .gallery-card .img-overlay .zoom-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: rgba(255, 230, 0, 0.95);
        color: var(--pln-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        transform: scale(0.7);
        transition: transform 0.3s ease;
    }

    .gallery-card:hover .img-overlay .zoom-icon {
        transform: scale(1);
    }

    /* Badge Kategori */
    .gallery-card .badge-kategori {
        position: absolute;
        top: 0.75rem;
        left: 0.75rem;
        padding: 0.3rem 0.7rem;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 2;
        backdrop-filter: blur(8px);
    }

    .badge-kategori.badge-operasional {
        background: rgba(255, 235, 0, 0.85);
        color: var(--gallery-primary);
    }

    .badge-kategori.badge-pemeliharaan {
        background: rgba(0, 163, 224, 0.85);
        color: #fff;
    }

    .badge-kategori.badge-k3 {
        background: rgba(0, 180, 60, 0.85);
        color: #fff;
    }

    .badge-kategori.badge-sosial {
        background: rgba(139, 92, 246, 0.85);
        color: #fff;
    }

    /* Card Body */
    .gallery-card .card-body-custom {
        padding: 1rem 1.15rem 1.25rem;
    }

    .gallery-card .card-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.35rem;
        line-height: 1.35;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .gallery-card .card-date {
        font-size: 0.76rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .gallery-card .card-date i {
        font-size: 0.7rem;
        color: var(--pln-yellow);
    }

    /* ---------- Lightbox Modal ---------- */
    .lightbox-modal .modal-content {
        background: #fff;
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }

    .lightbox-modal .modal-header {
        border-bottom: 1px solid #e2e8f0;
        padding: 1rem 1.5rem;
    }

    .lightbox-modal .modal-title {
        color: #1e293b;
        font-size: 0.95rem;
        font-weight: 600;
    }

    .lightbox-modal .btn-close {
        opacity: 0.5;
        transition: opacity 0.2s ease;
    }

    .lightbox-modal .btn-close:hover {
        opacity: 1;
    }

    .lightbox-modal .modal-body {
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 60vh;
        background: #f8f9fa;
    }

    .lightbox-modal .modal-body img {
        max-width: 100%;
        max-height: 80vh;
        object-fit: contain;
        border-radius: 8px;
    }

    .lightbox-modal .lightbox-caption {
        padding: 1rem 1.5rem;
        border-top: 1px solid #e2e8f0;
    }

    .lightbox-modal .lightbox-caption h6 {
        color: #1e293b;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    .lightbox-modal .lightbox-caption p {
        color: #64748b;
        font-size: 0.8rem;
        margin: 0;
    }

    /* Nav Arrows */
    .lightbox-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid #e2e8f0;
        color: #1e293b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.25s ease;
        z-index: 10;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .lightbox-nav:hover {
        background: var(--pln-blue);
        border-color: var(--pln-blue);
        color: #fff;
    }

    .lightbox-nav.prev {
        left: 1rem;
    }

    .lightbox-nav.next {
        right: 1rem;
    }

    /* ---------- Pagination ---------- */
    .galeri-pagination {
        padding: 2rem 0 4rem;
        background: #fff;
    }

    .galeri-pagination .pagination {
        gap: 0.4rem;
    }

    .galeri-pagination .page-link {
        background: #fff;
        border: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 500;
        padding: 0.55rem 0.9rem;
        border-radius: 8px;
        transition: all 0.25s ease;
        min-width: 40px;
        text-align: center;
    }

    .galeri-pagination .page-link:hover {
        background: #f1f5f9;
        border-color: var(--pln-blue);
        color: var(--pln-blue);
    }

    .galeri-pagination .page-item.active .page-link {
        background: var(--pln-blue);
        border-color: var(--pln-blue);
        color: #fff;
        font-weight: 700;
        box-shadow: 0 2px 10px rgba(0, 91, 156, 0.3);
    }

    .galeri-pagination .page-item.disabled .page-link {
        background: transparent;
        border-color: #e2e8f0;
        color: #cbd5e1;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 991.98px) {
        .galeri-hero h1 {
            font-size: 2rem;
        }
    }

    @media (max-width: 767.98px) {
        .galeri-hero {
            padding: 1.5rem 0 2rem;
        }

        .galeri-hero h1 {
            font-size: 1.65rem;
        }

        .filter-chips {
            overflow-x: auto;
            flex-wrap: nowrap;
            padding-bottom: 0.5rem;
            -webkit-overflow-scrolling: touch;
        }

        .filter-chip {
            flex-shrink: 0;
        }

        .lightbox-nav {
            width: 40px;
            height: 40px;
            font-size: 0.9rem;
        }

        .lightbox-nav.prev {
            left: 0.5rem;
        }

        .lightbox-nav.next {
            right: 0.5rem;
        }
    }

    /* ---------- Animation ---------- */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .gallery-card {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }

    .gallery-card:nth-child(1) { animation-delay: 0.05s; }
    .gallery-card:nth-child(2) { animation-delay: 0.1s; }
    .gallery-card:nth-child(3) { animation-delay: 0.15s; }
    .gallery-card:nth-child(4) { animation-delay: 0.2s; }
    .gallery-card:nth-child(5) { animation-delay: 0.25s; }
    .gallery-card:nth-child(6) { animation-delay: 0.3s; }
    .gallery-card:nth-child(7) { animation-delay: 0.35s; }
    .gallery-card:nth-child(8) { animation-delay: 0.4s; }
    .gallery-card:nth-child(9) { animation-delay: 0.45s; }
</style>

<div class="galeri-page">

    {{-- ============================================
         1. HERO / HEADER SECTION (with Breadcrumb)
         ============================================ --}}
    <section class="galeri-hero">
        <div class="container px-4 px-lg-5">
            {{-- Breadcrumb inside hero --}}
            <div class="galeri-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" data-i18n="galeri.bc_home">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="#" data-i18n="galeri.bc_info">Informasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page" data-i18n="galeri.bc_current">Galeri</li>
                    </ol>
                </nav>
            </div>

            <h1 data-i18n="galeri.title">
                Galeri & <span class="accent">Dokumentasi</span> Operasional
            </h1>
            <p class="subtitle" data-i18n="galeri.subtitle">
                Kumpulan foto dan dokumentasi kegiatan operasional, pemeliharaan, serta program K3 &amp; lingkungan di PT PLN Nusantara Power UP PLTU Indramayu.
            </p>
        </div>
    </section>

    {{-- ============================================
         3. INTERACTIVE FILTER BAR
         ============================================ --}}
    <section class="filter-section">
        <div class="container px-4 px-lg-5">
            <div class="filter-chips" id="filterChips">
                <button class="filter-chip active" data-filter="semua">
                    <i class="fas fa-images"></i> <span data-i18n="galeri.filter_all">Semua</span>
                </button>
                <button class="filter-chip" data-filter="operasional">
                    <i class="fas fa-bolt"></i> <span data-i18n="galeri.filter_operational">Operasional PLTU</span>
                </button>
                <button class="filter-chip" data-filter="pemeliharaan">
                    <i class="fas fa-wrench"></i> <span data-i18n="galeri.filter_maintenance">Pemeliharaan</span>
                </button>
                <button class="filter-chip" data-filter="k3">
                    <i class="fas fa-shield-halved"></i> <span data-i18n="galeri.filter_k3">K3 &amp; Lingkungan</span>
                </button>
                <button class="filter-chip" data-filter="sosial">
                    <i class="fas fa-hand-holding-heart"></i> <span data-i18n="galeri.filter_social">Kegiatan Sosial</span>
                </button>
            </div>
        </div>
    </section>

    {{-- ============================================
         4. RESPONSIVE PHOTO GRID
         ============================================ --}}
    <section class="gallery-grid">
        <div class="container px-4 px-lg-5">
            <div class="row g-4" id="galleryGrid">

                {{-- Card 1 --}}
                <div class="col-lg-4 col-md-6 gallery-item" data-kategori="operasional">
                    <div class="gallery-card" data-index="0">
                        <div class="img-wrapper">
                            <span class="badge-kategori badge-operasional">Operasional</span>
                            <img src="https://images.unsplash.com/photo-1581094288338-2314dddb7ece?w=600&h=450&fit=crop&fm=auto&q=75" alt="Operasional PLTU Indramayu" loading="lazy" width="600" height="450" decoding="async">
                            <div class="img-overlay">
                                <div class="zoom-icon"><i class="fas fa-expand"></i></div>
                            </div>
                        </div>
                        <div class="card-body-custom">
                            <h6 class="card-title">Operasional Unit Pembangkitan Unit 1</h6>
                            <div class="card-date">
                                <i class="fas fa-calendar-alt"></i> 5 September 2026
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="col-lg-4 col-md-6 gallery-item" data-kategori="pemeliharaan">
                    <div class="gallery-card" data-index="1">
                        <div class="img-wrapper">
                            <span class="badge-kategori badge-pemeliharaan">Pemeliharaan</span>
                            <img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=600&h=450&fit=crop&fm=auto&q=75" alt="Pemeliharaan Turbin" loading="lazy" width="600" height="450" decoding="async">
                            <div class="img-overlay">
                                <div class="zoom-icon"><i class="fas fa-expand"></i></div>
                            </div>
                        </div>
                        <div class="card-body-custom">
                            <h6 class="card-title">Pemeliharaan Berkala Turbin Uap</h6>
                            <div class="card-date">
                                <i class="fas fa-calendar-alt"></i> 3 September 2026
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="col-lg-4 col-md-6 gallery-item" data-kategori="k3">
                    <div class="gallery-card" data-index="2">
                        <div class="img-wrapper">
                            <span class="badge-kategori badge-k3">K3 & Lingkungan</span>
                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=600&h=450&fit=crop&fm=auto&q=75" alt="Sosialisasi K3" loading="lazy" width="600" height="450" decoding="async">
                            <div class="img-overlay">
                                <div class="zoom-icon"><i class="fas fa-expand"></i></div>
                            </div>
                        </div>
                        <div class="card-body-custom">
                            <h6 class="card-title">Sosialisasi Keselamatan Kerja Lingkungan</h6>
                            <div class="card-date">
                                <i class="fas fa-calendar-alt"></i> 1 September 2026
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 4 --}}
                <div class="col-lg-4 col-md-6 gallery-item" data-kategori="sosial">
                    <div class="gallery-card" data-index="3">
                        <div class="img-wrapper">
                            <span class="badge-kategori badge-sosial">Kegiatan Sosial</span>
                            <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=600&h=450&fit=crop&fm=auto&q=75" alt="Bakti Sosial" loading="lazy" width="600" height="450" decoding="async">
                            <div class="img-overlay">
                                <div class="zoom-icon"><i class="fas fa-expand"></i></div>
                            </div>
                        </div>
                        <div class="card-body-custom">
                            <h6 class="card-title">Bakti Sosial ke Masyarakat Desa Sumur Adem</h6>
                            <div class="card-date">
                                <i class="fas fa-calendar-alt"></i> 28 Agustus 2026
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 5 --}}
                <div class="col-lg-4 col-md-6 gallery-item" data-kategori="operasional">
                    <div class="gallery-card" data-index="4">
                        <div class="img-wrapper">
                            <span class="badge-kategori badge-operasional">Operasional</span>
                            <img src="https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=600&h=450&fit=crop&fm=auto&q=75" alt="Control Room" loading="lazy" width="600" height="450" decoding="async">
                            <div class="img-overlay">
                                <div class="zoom-icon"><i class="fas fa-expand"></i></div>
                            </div>
                        </div>
                        <div class="card-body-custom">
                            <h6 class="card-title">Monitoring Control Room PLTU Indramayu</h6>
                            <div class="card-date">
                                <i class="fas fa-calendar-alt"></i> 25 Agustus 2026
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 6 --}}
                <div class="col-lg-4 col-md-6 gallery-item" data-kategori="pemeliharaan">
                    <div class="gallery-card" data-index="5">
                        <div class="img-wrapper">
                            <span class="badge-kategori badge-pemeliharaan">Pemeliharaan</span>
                            <img src="https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=600&h=450&fit=crop&fm=auto&q=75" alt="Inspeksi Boiler" loading="lazy" width="600" height="450" decoding="async">
                            <div class="img-overlay">
                                <div class="zoom-icon"><i class="fas fa-expand"></i></div>
                            </div>
                        </div>
                        <div class="card-body-custom">
                            <h6 class="card-title">Inspeksi & Pembersihan Boiler</h6>
                            <div class="card-date">
                                <i class="fas fa-calendar-alt"></i> 22 Agustus 2026
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 7 --}}
                <div class="col-lg-4 col-md-6 gallery-item" data-kategori="k3">
                    <div class="gallery-card" data-index="6">
                        <div class="img-wrapper">
                            <span class="badge-kategori badge-k3">K3 & Lingkungan</span>
                            <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?w=600&h=450&fit=crop&fm=auto&q=75" alt="Simulasi Darurat" loading="lazy" width="600" height="450" decoding="async">
                            <div class="img-overlay">
                                <div class="zoom-icon"><i class="fas fa-expand"></i></div>
                            </div>
                        </div>
                        <div class="card-body-custom">
                            <h6 class="card-title">Simulasi Tanggap Darurat & Evakuasi</h6>
                            <div class="card-date">
                                <i class="fas fa-calendar-alt"></i> 18 Agustus 2026
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 8 --}}
                <div class="col-lg-4 col-md-6 gallery-item" data-kategori="sosial">
                    <div class="gallery-card" data-index="7">
                        <div class="img-wrapper">
                            <span class="badge-kategori badge-sosial">Kegiatan Sosial</span>
                            <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=600&h=450&fit=crop&fm=auto&q=75" alt="Donasi Pendidikan" loading="lazy" width="600" height="450" decoding="async">
                            <div class="img-overlay">
                                <div class="zoom-icon"><i class="fas fa-expand"></i></div>
                            </div>
                        </div>
                        <div class="card-body-custom">
                            <h6 class="card-title">Program Bantuan Pendidikan Anak</h6>
                            <div class="card-date">
                                <i class="fas fa-calendar-alt"></i> 15 Agustus 2026
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 9 --}}
                <div class="col-lg-4 col-md-6 gallery-item" data-kategori="operasional">
                    <div class="gallery-card" data-index="8">
                        <div class="img-wrapper">
                            <span class="badge-kategori badge-operasional">Operasional</span>
                            <img src="https://images.unsplash.com/photo-1513828583688-c52646db42da?w=600&h=450&fit=crop&fm=auto&q=75" alt="Pencemaran Udara" loading="lazy" width="600" height="450" decoding="async">
                            <div class="img-overlay">
                                <div class="zoom-icon"><i class="fas fa-expand"></i></div>
                            </div>
                        </div>
                        <div class="card-body-custom">
                            <h6 class="card-title">Pengoperasian Unit Pembangkitan 24 Jam</h6>
                            <div class="card-date">
                                <i class="fas fa-calendar-alt"></i> 12 Agustus 2026
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================
         5. PAGINATION
         ============================================ --}}
    <section class="galeri-pagination">
        <div class="container px-4 px-lg-5">
            <nav aria-label="Navigasi galeri">
                <ul class="pagination justify-content-center mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

</div>

{{-- ============================================
     6. LIGHTBOX MODAL
     ============================================ --}}

{{-- ============================================================
     LIGHTBOX — ON-DEMAND RENDER (lazy)
     Modal TIDAK dirender ke DOM saat halaman dimuat. Struktur
     disimpan di <template> (inert, tidak di-parse sebagai node
     aktif) dan baru di-clone sekali saat pengguna pertama kali
     klik kartu galeri. Inline onclick dihapus total → interaksi
     ditangani SATU event delegation di #galleryGrid.
     ============================================================ --}}
<template id="lightboxTemplate">
    <div class="modal fade lightbox-modal" id="lightboxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lightboxTitle">Preview Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body position-relative">
                    <button class="lightbox-nav prev" data-lightbox-nav="-1" aria-label="Foto Sebelumnya">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <img id="lightboxImage" alt="Preview" class="d-block mx-auto" width="1200" height="900" decoding="async">
                    <button class="lightbox-nav next" data-lightbox-nav="1" aria-label="Foto Berikutnya">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                <div class="lightbox-caption">
                    <h6 id="lightboxCaptionTitle"></h6>
      
              <p id="lightboxCaptionDate"></p>
                </div>
            </div>
        </div>
    </div>
</template>

@endsection

@push('scripts')
<script>
(function() {
    'use strict';

    /* =============================================
       GALLERY DATA (for lightbox navigation)
       ============================================= */
    const galleryData = [
        {
            src: 'https://images.unsplash.com/photo-1581094288338-2314dddb7ece?w=1200&h=900&fit=crop&fm=auto&q=80',
            title: 'Operasional Unit Pembangkitan Unit 1',
            date: '5 September 2026'
        },
        {
            src: 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1200&h=900&fit=crop&fm=auto&q=80',
            title: 'Pemeliharaan Berkala Turbin Uap',
            date: '3 September 2026'
        },
        {
            src: 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=1200&h=900&fit=crop&fm=auto&q=80',
            title: 'Sosialisasi Keselamatan Kerja Lingkungan',
            date: '1 September 2026'
        },
        {
            src: 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=1200&h=900&fit=crop&fm=auto&q=80',
            title: 'Bakti Sosial ke Masyarakat Desa Sumur Adem',
            date: '28 Agustus 2026'
        },
        {
            src: 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=1200&h=900&fit=crop&fm=auto&q=80',
            title: 'Monitoring Control Room PLTU Indramayu',
            date: '25 Agustus 2026'
        },
        {
            src: 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=1200&h=900&fit=crop&fm=auto&q=80',
            title: 'Inspeksi & Pembersihan Boiler',
            date: '22 Agustus 2026'
        },
        {
            src: 'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?w=1200&h=900&fit=crop&fm=auto&q=80',
            title: 'Simulasi Tanggap Darurat & Evakuasi',
            date: '18 Agustus 2026'
        },
        {
            src: 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1200&h=900&fit=crop&fm=auto&q=80',
            title: 'Program Bantuan Pendidikan Anak',
            date: '15 Agustus 2026'
        },
        {
            src: 'https://images.unsplash.com/photo-1513828583688-c52646db42da?w=1200&h=900&fit=crop&fm=auto&q=80',
            title: 'Pengoperasian Unit Pembangkitan 24 Jam',
            date: '12 Agustus 2026'
        }
    ];

    let currentIndex = 0;
    let filteredIndices = [];

    /* =============================================
       EVENT DELEGATION — satu listener untuk semua interaksi
       (Klik kartu → buka lightbox, klik chip → filter).
       Tidak ada onclick inline per kartu (main-thread friendly).
       ============================================= */
    const grid = document.getElementById('galleryGrid');

    /* --- Filter chips --- */
    const filterChips = document.querySelectorAll('.filter-chip');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterChips.forEach(function(chip) {
        chip.addEventListener('click', function() {
            filterChips.forEach(function(c) { c.classList.remove('active'); });
            chip.classList.add('active');

            const filter = chip.getAttribute('data-filter');
            filteredIndices = [];

            let shownIdx = 0;
            galleryItems.forEach(function(item, index) {
                const kategori = item.getAttribute('data-kategori');
                if (filter === 'semua' || kategori === filter) {
                    item.style.display = '';
                    /* Stagger murni CSS: delay via --stagger-i, tanpa setTimeout */
                    item.style.setProperty('--stagger-i', shownIdx);
                    item.classList.remove('filter-anim');
                    void item.offsetWidth; /* reflow sekali utk restart animasi */
                    item.classList.add('filter-anim');
                    shownIdx++;
                    filteredIndices.push(index);
                } else {
                    item.style.display = 'none';
                }
            });

            if (filter === 'semua') {
                filteredIndices = galleryData.map(function(_, i) { return i; });
            }
        });
    });

    filteredIndices = galleryData.map(function(_, i) { return i; });

    /* --- Kartu galeri + tombol nav lightbox (delegated) --- */
    if (grid) {
        grid.addEventListener('click', function(e) {
            const card = e.target.closest('.gallery-card');
            if (card) {
                const idx = parseInt(card.getAttribute('data-index'), 10);
                if (!isNaN(idx)) openLightbox(idx);
            }
        });
    }

    document.addEventListener('click', function(e) {
        const navBtn = e.target.closest('[data-lightbox-nav]');
        if (navBtn) navigateLightbox(parseInt(navBtn.getAttribute('data-lightbox-nav'), 10));
    });

    /* =============================================
       LIGHTBOX — lazy render (sekali, on-demand)
       ============================================= */
    var lightboxModal = null;
    var lightboxImage = null;
    var lightboxTitle = null;
    var lightboxCapTitle = null;
    var lightboxCapDate = null;

    function ensureLightbox() {
        if (lightboxModal) return;
        var tpl = document.getElementById('lightboxTemplate');
        if (tpl && tpl.content) {
            document.body.appendChild(tpl.content.firstElementChild);
        }
        lightboxModal    = document.getElementById('lightboxModal');
        lightboxImage    = document.getElementById('lightboxImage');
        lightboxTitle    = document.getElementById('lightboxTitle');
        lightboxCapTitle = document.getElementById('lightboxCaptionTitle');
        lightboxCapDate  = document.getElementById('lightboxCaptionDate');
    }

    function fillLightbox(data) {
        lightboxImage.src = data.src;
        lightboxImage.alt = data.title;
        lightboxTitle.textContent = data.title;
        lightboxCapTitle.textContent = data.title;
        lightboxCapDate.textContent = data.date;
    }

    window.openLightbox = function(index) {
        ensureLightbox();
        currentIndex = index;
        fillLightbox(galleryData[index]);
        /* Instance di-CACHE — jangan new bootstrap.Modal() tiap klik */
        bootstrap.Modal.getOrCreateInstance(lightboxModal).show();
    };

    window.navigateLightbox = function(direction) {
        var posInFiltered = filteredIndices.indexOf(currentIndex);
        if (posInFiltered === -1) posInFiltered = 0;

        var newPos = posInFiltered + direction;
        if (newPos < 0) newPos = filteredIndices.length - 1;
        if (newPos >= filteredIndices.length) newPos = 0;

        currentIndex = filteredIndices[newPos];
        var data = galleryData[currentIndex];

        /* Crossfade CSS-murni via class (GPU: opacity saja).
           Jika gambar belum selesai dimuat, tampilkan begitu ready —
           tidak ada setTimeout yang menggeser waktu respons. */
        lightboxImage.classList.remove('is-loaded');
        var pre = new Image();
        pre.onload = function () {
            fillLightbox(data);
            requestAnimationFrame(function () {
                lightboxImage.classList.add('is-loaded');
            });
        };
        pre.src = data.src;
    };

    /* Keyboard navigation */
    document.addEventListener('keydown', function(e) {
        if (!lightboxModal || !lightboxModal.classList.contains('show')) return;

        if (e.key === 'ArrowLeft') {
            navigateLightbox(-1);
        } else if (e.key === 'ArrowRight') {
            navigateLightbox(1);
        } else if (e.key === 'Escape') {
            bootstrap.Modal.getInstance(lightboxModal).hide();
        }
    });

})();
</script>
@endpush
