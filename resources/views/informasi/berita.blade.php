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
        background: #fff;
    }

    .berita-section-header h2 {
        font-size: 1.75rem;
        font-weight: 800;
        color: #fff;
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
        background: #fff;
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
        background: #fff;
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
         3. NEWS GRID — 3 Columns
         ============================================ --}}
    <section class="berita-grid" style="background: var(--pln-gray);">
        <div class="container px-4 px-lg-5">
            <div class="row g-4">

                {{-- Card 1 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="news-card">
                        <div class="news-img-wrapper">
                            <span class="news-badge badge-umum">Umum</span>
                            <img src="https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=600&h=340&fit=crop&fm=auto&q=75" alt="PLTU Indramayu" loading="lazy" width="600" height="340">
                        </div>
                        <div class="news-body">
                            <div class="news-meta">
                                <span><i class="fas fa-calendar-alt"></i> 8 September 2026</span>
                                <span><i class="fas fa-user-pen"></i> Humas PLN NP</span>
                            </div>
                            <h3 class="news-title">PLTU Indramayu Catat Produksi Tertinggi Q3 2026</h3>
                            <p class="news-excerpt">Unit Pembangkitan Tenaga Uap Indramayu berhasil mencatatkan angka produksi energi tertinggi sepanjang kuartal ketiga tahun 2026 dengan capaian 2.100 GWh.</p>
                            <a href="#" class="news-btn">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="news-card">
                        <div class="news-img-wrapper">
                            <span class="news-badge badge-teknis">Teknis</span>
                            <img src="https://images.unsplash.com/photo-1581094288338-2314dddb7ece?w=600&h=340&fit=crop&fm=auto&q=75" alt="Pemeliharaan" loading="lazy" width="600" height="340">
                        </div>
                        <div class="news-body">
                            <div class="news-meta">
                                <span><i class="fas fa-calendar-alt"></i> 5 September 2026</span>
                                <span><i class="fas fa-user-pen"></i> Dept. Teknik</span>
                            </div>
                            <h3 class="news-title">Pemeliharaan Berkala Unit 2 Berjalan Lancar</h3>
                            <p class="news-excerpt">Tim teknis berhasil menyelesaikan pemeliharaan berkala Unit 2 lebih cepat dari jadwal yang ditetapkan dengan zero accident.</p>
                            <a href="#" class="news-btn">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="news-card">
                        <div class="news-img-wrapper">
                            <span class="news-badge badge-kegiatan">Kegiatan</span>
                            <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=600&h=340&fit=crop&fm=auto&q=75" alt="Bakti Sosial" loading="lazy" width="600" height="340">
                        </div>
                        <div class="news-body">
                            <div class="news-meta">
                                <span><i class="fas fa-calendar-alt"></i> 1 September 2026</span>
                                <span><i class="fas fa-user-pen"></i> Bagian CSR</span>
                            </div>
                            <h3 class="news-title">PLN NP Indramayu Salurkan Bantuan ke Desa Binaan</h3>
                            <p class="news-excerpt">Program Corporate Social Responsibility berupa bantuan infrastruktur dan pendidikan disalurkan ke tiga desa binaan di sekitar wilayah operasional.</p>
                            <a href="#" class="news-btn">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                {{-- Card 4 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="news-card">
                        <div class="news-img-wrapper">
                            <span class="news-badge badge-teknis">Teknis</span>
                            <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?w=600&h=340&fit=crop&fm=auto&q=75" alt="K3" loading="lazy" width="600" height="340">
                        </div>
                        <div class="news-body">
                            <div class="news-meta">
                                <span><i class="fas fa-calendar-alt"></i> 28 Agustus 2026</span>
                                <span><i class="fas fa-user-pen"></i> Dept. K3</span>
                            </div>
                            <h3 class="news-title">Simulasi Tanggap Darurat Berhasil Dilaksanakan</h3>
                            <p class="news-excerpt">Seluruh personel mengikuti simulasi tanggap darurat kebakaran dan evakuasi massal guna meningkatkan kesiapsiagaan operasional.</p>
                            <a href="#" class="news-btn">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                {{-- Card 5 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="news-card">
                        <div class="news-img-wrapper">
                            <span class="news-badge badge-kepegawaian">Kepegawaian</span>
                            <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=600&h=340&fit=crop&fm=auto&q=75" alt="Rekrutmen" loading="lazy" width="600" height="340">
                        </div>
                        <div class="news-body">
                            <div class="news-meta">
                                <span><i class="fas fa-calendar-alt"></i> 22 Agustus 2026</span>
                                <span><i class="fas fa-user-pen"></i> Dept. SDM</span>
                            </div>
                            <h3 class="news-title">Penerimaan Calon Pegawai PLN NP Periode 2026 Dibuka</h3>
                            <p class="news-excerpt">PT PLN Nusantara Power membuka kesempatan bagi lulusan terbaik untuk bergabung di berbagai posisi teknis dan non-teknis.</p>
                            <a href="#" class="news-btn">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                {{-- Card 6 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="news-card">
                        <div class="news-img-wrapper">
                            <span class="news-badge badge-umum">Umum</span>
                            <img src="https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=600&h=340&fit=crop&fm=auto&q=75" alt="Energi" loading="lazy" width="600" height="340">
                        </div>
                        <div class="news-body">
                            <div class="news-meta">
                                <span><i class="fas fa-calendar-alt"></i> 18 Agustus 2026</span>
                                <span><i class="fas fa-user-pen"></i> Humas PLN NP</span>
                            </div>
                            <h3 class="news-title">Kontribusi PLN NP terhadap Kelistrikan Nasional Terus Meningkat</h3>
                            <p class="news-excerpt">PT PLN Nusantara Power mencatat peningkatan kontribusi pasokan listrik nasional sebesar 4,2% dibandingkan periode yang sama tahun lalu.</p>
                            <a href="#" class="news-btn">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================
         4. PAGINATION
         ============================================ --}}
    <section class="berita-pagination" style="background: var(--pln-gray);">
        <div class="container px-4 px-lg-5">
            <nav aria-label="Navigasi berita">
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
@endsection
