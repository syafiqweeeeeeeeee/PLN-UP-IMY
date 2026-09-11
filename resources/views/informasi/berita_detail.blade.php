@extends('layouts.app')

@section('title', $news->title . ' — E-PPID PLN')

@section('content')
<style>
    /* =============================================
       BERITA DETAIL — reuse visual dari halaman berita
       ============================================= */

    .berita-detail-page {
        background: #fff;
        min-height: 100vh;
        color: #1e293b;
        padding-top: 76px;
    }

    .berita-detail-hero {
        padding: 1.5rem 0 2.5rem;
        background: linear-gradient(135deg, var(--pln-blue) 0%, #003d6b 50%, var(--pln-dark) 100%);
        position: relative;
        overflow: hidden;
    }

    .berita-detail-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .breadcrumb-detail {
        padding: 0 0 1.25rem;
        position: relative;
        z-index: 2;
    }

    .breadcrumb-detail .breadcrumb {
        background: transparent;
        margin: 0;
        padding: 0;
    }

    .breadcrumb-detail .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .breadcrumb-detail .breadcrumb-item a:hover {
        color: var(--pln-yellow);
    }

    .breadcrumb-detail .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.82rem;
        font-weight: 600;
    }

    .breadcrumb-detail .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.4);
        content: "/";
        font-size: 0.75rem;
    }

    .berita-detail-hero h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.25;
        margin-bottom: 0.75rem;
        position: relative;
        z-index: 2;
    }

    .berita-detail-hero h1 .accent {
        color: var(--pln-yellow);
    }

    .berita-detail-subtitle {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.8);
        max-width: 720px;
        line-height: 1.7;
        position: relative;
        z-index: 2;
    }

    /* Container utama */
    .berita-detail-container {
        background: var(--pln-gray);
    }

    .berita-detail-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.05);
        overflow: hidden;
    }

    .berita-detail-header {
        padding: 2.5rem 2.5rem 1.5rem;
    }

    .berita-detail-category {
        display: inline-block;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.3rem 0.8rem;
        border-radius: 6px;
        margin-bottom: 1rem;
    }

    .berita-detail-category.umum {
        background: rgba(0,91,156,0.88);
        color: #fff;
    }
    .berita-detail-category.teknis {
        background: rgba(0,163,224,0.88);
        color: #fff;
    }
    .berita-detail-category.kegiatan {
        background: rgba(255,230,0,0.92);
        color: var(--pln-blue);
    }
    .berita-detail-category.kepegawaian {
        background: rgba(139,92,246,0.88);
        color: #fff;
    }

    .berita-detail-title {
        font-size: 1.85rem;
        font-weight: 800;
        color: #1e293b;
        line-height: 1.3;
        margin-bottom: 1.25rem;
    }

    .berita-detail-meta {
        display: flex;
        align-items: center;
        gap: 1.2rem;
        flex-wrap: wrap;
        font-size: 0.82rem;
        color: #64748b;
        padding-bottom: 1.25rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .berita-detail-meta span {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .berita-detail-meta i {
        font-size: 0.78rem;
        color: var(--pln-cyan);
    }

    .berita-detail-meta .author-meta {
        font-weight: 600;
        color: var(--pln-blue);
    }

    .berita-detail-gambar {
        width: 100%;
        aspect-ratio: 16 / 9;
        background: #f1f5f9;
        overflow: hidden;
    }

    .berita-detail-gambar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .berita-detail-body {
        padding: 2rem 2.5rem 2.5rem;
        font-size: 1rem;
        line-height: 1.8;
        color: #334155;
    }

    .berita-detail-body p {
        margin-bottom: 1.25rem;
    }

    .berita-detail-body p:last-child {
        margin-bottom: 0;
    }

    .berita-detail-body h2 {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--pln-blue);
        margin: 2rem 0 0.75rem;
    }

    .berita-detail-body ul, .berita-detail-body ol {
        margin: 0 0 1.25rem 1.5rem;
    }

    .berita-detail-body li {
        margin-bottom: 0.4rem;
    }

    /* Back link */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        color: var(--pln-blue);
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.2s ease;
        margin-bottom: 1.5rem;
        padding: 0.4rem 0;
    }

    .back-link:hover {
        color: #003d6b;
        gap: 0.6rem;
    }

    /* Related */
    .berita-detail-related {
        padding: 2.5rem 0 4rem;
        background: var(--pln-gray);
    }

    .berita-detail-related h3 {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--pln-blue);
        margin-bottom: 0.4rem;
    }

    .berita-detail-related .divider {
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--pln-yellow), var(--pln-cyan));
        border-radius: 2px;
        margin-bottom: 2rem;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .related-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(15,23,42,0.04);
        display: flex;
        flex-direction: column;
    }

    .related-card:hover {
        transform: translateY(-4px);
        border-color: var(--pln-cyan);
        box-shadow: 0 10px 24px rgba(0,163,224,0.12);
    }

    .related-card .related-img {
        aspect-ratio: 16 / 9;
        background: #f1f5f9;
        overflow: hidden;
    }

    .related-card .related-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .related-card:hover .related-img img {
        transform: scale(1.04);
    }

    .related-card .related-body {
        padding: 1rem 1.2rem 1.25rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .related-card .related-title {
        font-size: 0.92rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.4;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s ease;
    }

    .related-card:hover .related-title {
        color: var(--pln-blue);
    }

    .related-card .related-meta {
        font-size: 0.78rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 0.6rem;
    }

    .related-card .related-meta i {
        color: var(--pln-cyan);
        font-size: 0.72rem;
    }

    .related-card .related-link {
        margin-top: auto;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--pln-blue);
        text-decoration: none;
        transition: gap 0.2s ease;
    }

    .related-card:hover .related-link {
        gap: 0.6rem;
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .berita-detail-hero h1 { font-size: 1.8rem; }
        .berita-detail-title { font-size: 1.55rem; }
    }

    @media (max-width: 767.98px) {
        .berita-detail-hero { padding: 1.5rem 0 2rem; }
        .berita-detail-hero h1 { font-size: 1.5rem; }
        .berita-detail-header, .berita-detail-body { padding-left: 1.25rem; padding-right: 1.25rem; }
        .berita-detail-body { font-size: 0.95rem; }
        .berita-detail-meta { gap: 0.8rem; }
    }
</style>

<div class="berita-detail-page">

    {{-- Hero --}}
    <section class="berita-detail-hero">
        <div class="container px-4 px-lg-5">
            <nav class="breadcrumb-detail" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('berita') }}">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($news->title, 35) }}</li>
                </ol>
            </nav>

            <h1>{{ $news->title }}</h1>
            <p class="berita-detail-subtitle">{{ $news->excerpt }}</p>
        </div>
    </section>

    {{-- Konten --}}
    <section class="berita-detail-container">
        <div class="container px-4 px-lg-5">
            <div class="berita-detail-card">

                <div class="berita-detail-header">
                    <span class="berita-detail-category {{ $news->category }}">{{ ucfirst($news->category) }}</span>
                    <h1 class="berita-detail-title">{{ $news->title }}</h1>

                    <div class="berita-detail-meta">
                        <span><i class="far fa-calendar-alt"></i> {{ $news->published_at?->format('d F Y') ?? $news->created_at->format('d F Y') }}</span>
                        @if ($news->author)
                        <span><i class="fas fa-user-pen"></i> <span class="author-meta">{{ $news->author }}</span></span>
                        @endif
                        <span><i class="far fa-clock"></i> {{ $news->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                @if ($news->image)
                <div class="berita-detail-gambar">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" loading="lazy">
                </div>
                @endif

                <div class="berita-detail-body">
                    @if ($news->content)
                        {!! nl2br(e($news->content)) !!}
                    @else
                        <p>{{ $news->excerpt }}</p>
                    @endif
                </div>

            </div>
        </div>
    </section>

    {{-- Related --}}
    @if ($related->isNotEmpty())
    <section class="berita-detail-related">
        <div class="container px-4 px-lg-5">
            <h3>Berita Terkait</h3>
            <div class="divider"></div>

            <div class="related-grid">
                @foreach ($related as $item)
                <a href="{{ route('berita.detail', $item->slug) }}" class="related-card">
                    <div class="related-img">
                        @if ($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" loading="lazy">
                        @else
                        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:#94a3b8;">
                            <i class="fas fa-newspaper" style="font-size: 1.6rem;"></i>
                        </div>
                        @endif
                    </div>
                    <div class="related-body">
                        <div class="related-meta">
                            <span><i class="far fa-calendar-alt"></i> {{ $item->published_at?->format('d M Y') ?? $item->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="related-title">{{ $item->title }}</div>
                        <span class="related-link">Selengkapnya <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</div>
@endsection
