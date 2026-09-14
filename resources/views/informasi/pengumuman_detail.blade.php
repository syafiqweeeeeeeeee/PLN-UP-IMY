@extends('layouts.app')

@section('title', $pengumuman->title . ' — E-PPID PLN')

@section('content')
<style>
    /* =============================================
       PENGUMUMAN DETAIL — reuse visual dari halaman pengumuman
       ============================================= */

    .pengumuman-detail-page {
        background: #f4f6f9;
        min-height: 100vh;
        color: #1e293b;
        padding-top: 76px;
    }

    .pengumuman-detail-hero {
        padding: 1.5rem 0 2.5rem;
        background: linear-gradient(135deg, #032b56 0%, #005b9c 50%, #1a1a2e 100%);
        position: relative;
        overflow: hidden;
    }

    .pengumuman-detail-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255, 230, 0, 0.10) 0%, transparent 70%);
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
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .breadcrumb-detail .breadcrumb-item a:hover {
        color: #ffe600;
    }

    .breadcrumb-detail .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.82rem;
        font-weight: 600;
    }

    .breadcrumb-detail .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.35);
        content: "/";
        font-size: 0.75rem;
    }

    .pengumuman-detail-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: linear-gradient(135deg, #ffe600 0%, #ffd000 100%);
        color: #032b56;
        font-weight: 800;
        font-size: 0.62rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 0.35rem 1rem;
        border-radius: 4px;
        margin-bottom: 1rem;
        position: relative;
        z-index: 2;
    }

    .pengumuman-detail-hero h1 {
        font-size: 2rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.3;
        margin-bottom: 0.75rem;
        max-width: 800px;
        position: relative;
        z-index: 2;
    }

    .pengumuman-detail-subtitle {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.8);
        max-width: 720px;
        line-height: 1.7;
        position: relative;
        z-index: 2;
    }

    /* Container utama */
    .pengumuman-detail-container {
        padding: 2.5rem 0 4rem;
        background: #f4f6f9;
    }

    .pengumuman-detail-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.05);
        overflow: hidden;
    }

    .pengumuman-detail-header {
        padding: 2.5rem 2.5rem 1.5rem;
    }

    .pengumuman-detail-category {
        display: inline-block;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.3rem 0.8rem;
        border-radius: 6px;
        margin-bottom: 1rem;
    }

    .pengumuman-detail-category.umum        { background: rgba(0,91,156,0.88); color: #fff; }
    .pengumuman-detail-category.teknis      { background: rgba(0,163,224,0.88); color: #fff; }
    .pengumuman-detail-category.kepegawaian { background: rgba(139,92,246,0.88); color: #fff; }
    .pengumuman-detail-category.keuangan    { background: rgba(16,185,129,0.88); color: #fff; }
    .pengumuman-detail-category.layanan     { background: rgba(245,158,11,0.92); color: #fff; }

    .pengumuman-detail-title {
        font-size: 1.85rem;
        font-weight: 800;
        color: #1e293b;
        line-height: 1.3;
        margin-bottom: 1.25rem;
    }

    .pengumuman-detail-meta {
        display: flex;
        align-items: center;
        gap: 1.2rem;
        flex-wrap: wrap;
        font-size: 0.82rem;
        color: #64748b;
        padding-bottom: 1.25rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .pengumuman-detail-meta span {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .pengumuman-detail-meta i {
        font-size: 0.78rem;
        color: #00a3e0;
    }

    /* Nomor pengumuman box */
    .pengumuman-nomor {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: #f0f4f8;
        border: 1px solid #e2e8f0;
        color: #005b9c;
        font-weight: 600;
        font-size: 0.78rem;
        padding: 0.3rem 0.8rem;
        border-radius: 6px;
    }

    .pengumuman-detail-body {
        padding: 2rem 2.5rem 2.5rem;
        font-size: 1rem;
        line-height: 1.8;
        color: #334155;
    }

    .pengumuman-detail-body p {
        margin-bottom: 1.25rem;
    }

    .pengumuman-detail-body p:last-child {
        margin-bottom: 0;
    }

    .pengumuman-detail-body h2 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #005b9c;
        margin: 2rem 0 0.75rem;
    }

    .pengumuman-detail-body ul, .pengumuman-detail-body ol {
        margin: 0 0 1.25rem 1.5rem;
    }

    .pengumuman-detail-body li {
        margin-bottom: 0.4rem;
    }

    /* Info box */
    .pengumuman-info-box {
        background: #f0f7ff;
        border: 1px solid rgba(0, 163, 224, 0.25);
        border-left: 4px solid #00a3e0;
        border-radius: 10px;
        padding: 1.25rem 1.5rem;
        margin-top: 1.5rem;
    }

    .pengumuman-info-box h4 {
        font-size: 0.85rem;
        font-weight: 700;
        color: #005b9c;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .pengumuman-info-box p {
        font-size: 0.88rem;
        margin-bottom: 0;
        color: #475569;
    }

    /* Back link */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        color: #005b9c;
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
    .pengumuman-detail-related {
        padding: 2.5rem 0 4rem;
        background: #f4f6f9;
    }

    .pengumuman-detail-related h3 {
        font-size: 1.35rem;
        font-weight: 800;
        color: #032b56;
        margin-bottom: 0.4rem;
    }

    .pengumuman-detail-related .divider {
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #ffe600, #00a3e0);
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
        padding: 1.4rem 1.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(15,23,42,0.04);
        display: flex;
        flex-direction: column;
        text-decoration: none;
    }

    .related-card:hover {
        transform: translateY(-4px);
        border-color: rgba(0, 163, 224, 0.4);
        box-shadow: 0 10px 24px rgba(0,91,156,0.10);
    }

    .related-card .related-category {
        display: inline-block;
        font-size: 0.62rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.2rem 0.55rem;
        border-radius: 4px;
        width: fit-content;
        margin-bottom: 0.6rem;
    }

    .related-card .related-category.umum        { background: rgba(0,91,156,0.08); color: #005b9c; }
    .related-card .related-category.teknis      { background: rgba(0,163,224,0.1); color: #0088c4; }
    .related-card .related-category.kepegawaian { background: rgba(139,92,246,0.1); color: #7c3aed; }
    .related-card .related-category.keuangan    { background: rgba(16,185,129,0.1); color: #059669; }
    .related-card .related-category.layanan     { background: rgba(245,158,11,0.1); color: #b45309; }

    .related-card .related-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.45;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s ease;
    }

    .related-card:hover .related-title {
        color: #005b9c;
    }

    .related-card .related-excerpt {
        font-size: 0.82rem;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 0.8rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .related-card .related-meta {
        font-size: 0.75rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .related-card .related-meta i {
        color: #00a3e0;
        font-size: 0.7rem;
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .pengumuman-detail-hero h1 { font-size: 1.7rem; }
        .pengumuman-detail-title { font-size: 1.55rem; }
    }

    @media (max-width: 767.98px) {
        .pengumuman-detail-hero { padding: 1.5rem 0 2rem; }
        .pengumuman-detail-hero h1 { font-size: 1.45rem; }
        .pengumuman-detail-header, .pengumuman-detail-body { padding-left: 1.25rem; padding-right: 1.25rem; }
        .pengumuman-detail-body { font-size: 0.95rem; }
        .pengumuman-detail-meta { gap: 0.8rem; }
    }
</style>

<div class="pengumuman-detail-page">

    {{-- Hero --}}
    <section class="pengumuman-detail-hero">
        <div class="container px-4 px-lg-5">
            <nav class="breadcrumb-detail" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pengumuman') }}">Pengumuman</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($pengumuman->title, 35) }}</li>
                </ol>
            </nav>

            <div class="pengumuman-detail-badge">
                <i class="fas fa-bolt"></i> Pengumuman Resmi
            </div>

            <h1>{{ $pengumuman->title }}</h1>
            <p class="pengumuman-detail-subtitle">{{ $pengumuman->excerpt }}</p>
        </div>
    </section>

    {{-- Konten --}}
    <section class="pengumuman-detail-container">
        <div class="container px-4 px-lg-5">
            <a href="{{ route('pengumuman') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pengumuman
            </a>

            <div class="pengumuman-detail-card">

                <div class="pengumuman-detail-header">
                    <span class="pengumuman-detail-category {{ $pengumuman->category }}">{{ ucfirst($pengumuman->category) }}</span>
                    <h1 class="pengumuman-detail-title">{{ $pengumuman->title }}</h1>

                    <div class="pengumuman-detail-meta">
                        <span><i class="far fa-calendar-alt"></i> {{ ($pengumuman->published_at ?? $pengumuman->created_at)->translatedFormat('d F Y') }}</span>
                        <span><i class="far fa-clock"></i> {{ $pengumuman->created_at->diffForHumans() }}</span>
                        @if ($pengumuman->authorUser)
                        <span><i class="fas fa-user-pen"></i> {{ $pengumuman->authorUser->name }}</span>
                        @endif
                    </div>
                </div>

                <div class="pengumuman-detail-body">
                    @if ($pengumuman->content)
                        {!! nl2br(e($pengumuman->content)) !!}
                    @else
                        <p>{{ $pengumuman->excerpt }}</p>
                    @endif

                    <div class="pengumuman-info-box">
                        <h4><i class="fas fa-circle-info me-1"></i> Informasi</h4>
                        <p>
                            Pengumuman ini diterbitkan oleh PT PLN Nusantara Power UP PLTU Indramayu
                            pada {{ ($pengumuman->published_at ?? $pengumuman->created_at)->translatedFormat('d F Y') }}.
                            Untuk pertanyaan lebih lanjut, silakan hubungi kantor PPID.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Related --}}
    @if ($related->isNotEmpty())
    <section class="pengumuman-detail-related">
        <div class="container px-4 px-lg-5">
            <h3>Pengumuman Terkait</h3>
            <div class="divider"></div>

            <div class="related-grid">
                @foreach ($related as $item)
                <a href="{{ route('pengumuman.detail', $item->slug) }}" class="related-card">
                    <span class="related-category {{ $item->category }}">{{ ucfirst($item->category) }}</span>
                    <div class="related-title">{{ $item->title }}</div>
                    <div class="related-excerpt">{{ $item->excerpt }}</div>
                    <div class="related-meta">
                        <span><i class="far fa-calendar-alt"></i> {{ ($item->published_at ?? $item->created_at)->translatedFormat('d M Y') }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</div>
@endsection
