@extends('layouts.app')

@section('title', 'E-PPID PLN — Berita & Informasi')

@section('content')
<style>
    /* =============================================
       BERITA — CORPORATE NEWS PAGE
       ============================================= */

    .berita-page {
        background: #fff;
        min-height: 100vh;
        color: #1e293b;
        padding-top: 76px;
    }

    /* ---------- Hero Header ---------- */
    .berita-hero {
        padding: 1.5rem 0 3.5rem;
        background: linear-gradient(135deg, var(--pln-blue) 0%, #003d6b 50%, var(--pln-dark) 100%);
        position: relative;
        overflow: hidden;
    }

    .berita-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .berita-hero h1 {
        font-size: 2.4rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 0.75rem;
        position: relative;
        z-index: 2;
    }

    .berita-hero h1 .accent {
        color: var(--pln-yellow);
    }

    .berita-hero .subtitle {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.8);
        max-width: 600px;
        line-height: 1.7;
        position: relative;
        z-index: 2;
    }

    /* Breadcrumb */
    .berita-breadcrumb {
        padding: 0 0 1.5rem;
        position: relative;
        z-index: 2;
    }

    .berita-breadcrumb .breadcrumb {
        background: transparent;
        margin: 0;
        padding: 0;
    }

    .berita-breadcrumb .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .berita-breadcrumb .breadcrumb-item a:hover {
        color: var(--pln-yellow);
    }

    .berita-breadcrumb .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.82rem;
        font-weight: 600;
    }

    .berita-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.4);
        content: "/";
        font-size: 0.75rem;
    }

    /* ---------- Section Title ---------- */
    .berita-section-header {
        padding: 3.5rem 0 2.5rem;
    }

    .berita-section-header h2 {
        font-size: 1.75rem;
        font-weight: 800;
        margin-bottom: 0.4rem;
    }

    .berita-section-header .divider {
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--pln-yellow), var(--pln-cyan));
        border-radius: 2px;
        margin-top: 0.75rem;
    }

    /* ---------- News Grid ---------- */
    .berita-grid {
        padding: 0 0 4.5rem;
    }

    .news-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.35s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.05);
    }

    .news-card:hover {
        transform: translateY(-6px);
        border-color: var(--pln-cyan);
        box-shadow: 0 14px 34px rgba(0, 163, 224, 0.16);
    }

    /* Image Wrapper */
    .news-card .news-img-wrapper {
        position: relative;
        overflow: hidden;
        aspect-ratio: 16 / 9;
        background: #f1f5f9;
    }

    .news-card .news-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.45s ease;
    }

    .news-card:hover .news-img-wrapper img {
        transform: scale(1.05);
    }

    /* Placeholder when no image */
    .news-card .news-img-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e2e8f0, #f1f5f9);
        color: #94a3b8;
    }

    .news-card .news-img-placeholder i {
        font-size: 2rem;
    }

    /* Badge Kategori */
    .news-card .news-badge {
        position: absolute;
        top: 0.75rem;
        left: 0.75rem;
        padding: 0.3rem 0.75rem;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 2;
        backdrop-filter: blur(8px);
    }

    .news-badge.badge-umum {
        background: rgba(0, 91, 156, 0.88);
        color: #fff;
    }

    .news-badge.badge-teknis {
        background: rgba(0, 163, 224, 0.88);
        color: #fff;
    }

    .news-badge.badge-kegiatan {
        background: rgba(255, 230, 0, 0.92);
        color: var(--pln-blue);
    }

    .news-badge.badge-kepegawaian {
        background: rgba(139, 92, 246, 0.88);
        color: #fff;
    }

    /* Card Body */
    .news-card .news-body {
        padding: 1.25rem 1.35rem 1.5rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .news-meta {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        margin-bottom: 0.65rem;
        font-size: 0.78rem;
        color: #94a3b8;
    }

    .news-meta span {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .news-meta i {
        font-size: 0.72rem;
        color: var(--pln-cyan);
    }

    .news-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.4;
        margin-bottom: 0.6rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s ease;
    }

    .news-card:hover .news-title {
        color: var(--pln-blue);
    }

    .news-excerpt {
        font-size: 0.88rem;
        color: #64748b;
        line-height: 1.65;
        margin-bottom: 1.15rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }

    .news-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        background: var(--pln-blue);
        color: #fff;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
        align-self: flex-start;
        border: none;
        cursor: pointer;
    }

    .news-btn:hover {
        background: #003d6b;
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(0, 91, 156, 0.35);
        color: #fff;
    }

    .news-btn i {
        font-size: 0.7rem;
        transition: transform 0.25s ease;
    }

    .news-btn:hover i {
        transform: translateX(3px);
    }

    /* ---------- Pagination ---------- */
    .berita-pagination {
        padding: 2rem 0 4rem;
    }

    .berita-pagination .pagination {
        gap: 0.4rem;
    }

    .berita-pagination .page-link {
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

    .berita-pagination .page-link:hover {
        background: #f1f5f9;
        border-color: var(--pln-blue);
        color: var(--pln-blue);
    }

    .berita-pagination .page-item.active .page-link {
        background: var(--pln-blue);
        border-color: var(--pln-blue);
        color: #fff;
        font-weight: 700;
        box-shadow: 0 2px 10px rgba(0, 91, 156, 0.3);
    }

    .berita-pagination .page-item.disabled .page-link {
        background: transparent;
        border-color: #e2e8f0;
        color: #cbd5e1;
    }

    /* Empty State */
    .berita-empty {
        text-align: center;
        padding: 4rem 1rem;
        color: #94a3b8;
    }
    .berita-empty i { font-size: 3rem; display: block; margin-bottom: 1rem; }
    .berita-empty h5 { font-weight: 700; color: #64748b; margin-bottom: 0.25rem; }

    /* ---------- Responsive ---------- */
    @media (max-width: 991.98px) {
        .berita-hero h1 { font-size: 2rem; }
    }

    @media (max-width: 767.98px) {
        .berita-hero { padding: 1.5rem 0 2rem; }
        .berita-hero h1 { font-size: 1.65rem; }
        .berita-section-header h2 { font-size: 1.4rem; }
        .news-title { font-size: 0.95rem; }
    }

    /* ---------- Animation ---------- */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .news-card {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }

    .news-card:nth-child(1) { animation-delay: 0.05s; }
    .news-card:nth-child(2) { animation-delay: 0.10s; }
    .news-card:nth-child(3) { animation-delay: 0.15s; }
    .news-card:nth-child(4) { animation-delay: 0.20s; }
    .news-card:nth-child(5) { animation-delay: 0.25s; }
    .news-card:nth-child(6) { animation-delay: 0.30s; }
</style>

<div class="berita-page">

    {{-- ============================================
         1. HERO / HEADER
         ============================================ --}}
    <section class="berita-hero">
        <div class="container px-4 px-lg-5">
            <div class="berita-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="#">Informasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Berita</li>
                    </ol>
                </nav>
            </div>

            <h1>Berita & <span class="accent">Informasi</span> Terkini</h1>
            <p class="subtitle">
                Ikuti perkembangan terbaru seputar operasional, program kerja, dan kegiatan PT PLN Nusantara Power UP PLTU Indramayu.
            </p>
        </div>
    </section>

    {{-- ============================================
         2. SECTION TITLE
         ============================================ --}}
    <section class="berita-section-header" style="background: var(--pln-gray);">
        <div class="container px-4 px-lg-5">
            <h2 style="color: var(--pln-blue);">Berita & Informasi Terkini</h2>
            <div class="divider"></div>
        </div>
    </section>

    {{-- ============================================
         3. NEWS GRID — Dynamic from DB
         ============================================ --}}
    <section class="berita-grid" style="background: var(--pln-gray);">
        <div class="container px-4 px-lg-5">
            @if ($news->count())
            <div class="row g-4">
                @foreach ($news as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="news-card">
                        <div class="news-img-wrapper">
                            <span class="news-badge badge-{{ $item->category }}">{{ ucfirst($item->category) }}</span>
                            @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" loading="lazy">
                            @else
                            <div class="news-img-placeholder">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            @endif
                        </div>
                        <div class="news-body">
                            <div class="news-meta">
                                <span><i class="fas fa-calendar-alt"></i> {{ $item->published_at?->format('d M Y') ?? $item->created_at->format('d M Y') }}</span>
                                @if ($item->author)
                                <span><i class="fas fa-user-pen"></i> {{ $item->author }}</span>
                                @endif
                            </div>
                            <h3 class="news-title">{{ $item->title }}</h3>
                            <p class="news-excerpt">{{ $item->excerpt }}</p>
                            <a href="{{ route('berita.detail', $item->slug) }}" class="news-btn">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="berita-empty">
                <i class="fas fa-newspaper"></i>
                <h5>Belum ada berita</h5>
                <p>Berita akan segera tersedia. Silakan kunjungi kembali nanti.</p>
            </div>
            @endif
        </div>
    </section>

    {{-- ============================================
         4. PAGINATION
         ============================================ --}}
    @if ($news->hasPages())
    <section class="berita-pagination" style="background: var(--pln-gray);">
        <div class="container px-4 px-lg-5">
            <nav aria-label="Navigasi berita">
                {{ $news->links() }}
            </nav>
        </div>
    </section>
    @endif

</div>
@endsection
