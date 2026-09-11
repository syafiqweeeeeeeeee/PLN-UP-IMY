@extends('layouts.app')

@section('title', 'E-PPID PLN — Pengumuman Resmi')

@section('content')
<style>
    /* =============================================
       PENGUMUMAN — CORPORATE ANNOUNCEMENTS PAGE
       ============================================= */

    .pengumuman-page {
        background: #f4f6f9;
        min-height: 100vh;
        color: #1e293b;
        padding-top: 76px;
    }

    /* ---------- Hero Header ---------- */
    .pengumuman-hero {
        padding: 1.5rem 0 3.5rem;
        background: linear-gradient(135deg, #032b56 0%, #005b9c 50%, #1a1a2e 100%);
        position: relative;
        overflow: hidden;
    }

    .pengumuman-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(255, 230, 0, 0.10) 0%, transparent 70%);
        border-radius: 50%;
    }

    .pengumuman-hero::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.10) 0%, transparent 70%);
        border-radius: 50%;
    }

    /* Badge */
    .pengumuman-badge {
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
        backdrop-filter: blur(4px);
    }

    .pengumuman-badge::before {
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

    .pengumuman-badge i {
        font-size: 0.75rem;
    }

    /* Hero Title */
    .pengumuman-hero h1 {
        font-size: 2.4rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 0.75rem;
        position: relative;
        z-index: 2;
    }

    .pengumuman-hero h1 .accent {
        color: #ffe600;
    }

    .pengumuman-hero .subtitle {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.75);
        max-width: 620px;
        line-height: 1.7;
        position: relative;
        z-index: 2;
    }

    /* Breadcrumb */
    .pengumuman-breadcrumb {
        padding: 0 0 1.5rem;
        position: relative;
        z-index: 2;
    }

    .pengumuman-breadcrumb .breadcrumb {
        background: transparent;
        margin: 0;
        padding: 0;
    }

    .pengumuman-breadcrumb .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .pengumuman-breadcrumb .breadcrumb-item a:hover {
        color: #ffe600;
    }

    .pengumuman-breadcrumb .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.82rem;
        font-weight: 600;
    }

    .pengumuman-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.35);
        content: "/";
        font-size: 0.75rem;
    }

    /* ---------- Section Filter ---------- */
    .pengumuman-filter {
        padding: 2rem 0 0;
        background: #f4f6f9;
    }

    .filter-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .filter-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1.15rem;
        border-radius: 50px;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #64748b;
        font-size: 0.84rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.25s ease;
        white-space: nowrap;
        user-select: none;
    }

    .filter-pill:hover {
        border-color: rgba(0, 91, 156, 0.3);
        color: #005b9c;
        background: #f0f4f8;
    }

    .filter-pill.active {
        background: #005b9c;
        color: #fff;
        border-color: #005b9c;
        font-weight: 600;
        box-shadow: 0 2px 12px rgba(0, 91, 156, 0.25);
    }

    .filter-pill i {
        font-size: 0.78rem;
    }

    /* ---------- Announcement List ---------- */
    .pengumuman-list {
        padding: 2rem 0 4.5rem;
        background: #f4f6f9;
    }

    .pengumuman-card {
        display: flex;
        align-items: stretch;
        gap: 1.5rem;
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 14px;
        padding: 1.6rem 1.75rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 1px 4px rgba(15, 23, 42, 0.03);
    }

    .pengumuman-card:hover {
        border-color: rgba(0, 163, 224, 0.35);
        box-shadow: 0 8px 28px rgba(0, 91, 156, 0.09);
        transform: translateY(-2px);
    }

    /* Date Box */
    .date-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-width: 72px;
        height: 72px;
        border-radius: 12px;
        background: linear-gradient(135deg, #005b9c, #00a3e0);
        color: #fff;
        flex-shrink: 0;
        box-shadow: 0 4px 14px rgba(0, 91, 156, 0.2);
        position: relative;
        overflow: hidden;
    }

    .date-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: #ffe600;
    }

    .date-box .date-day {
        font-size: 1.5rem;
        font-weight: 800;
        line-height: 1;
        margin-top: 0.25rem;
    }

    .date-box .date-month {
        font-size: 0.6rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.85;
        margin-top: 0.15rem;
    }

    .date-box .date-year {
        font-size: 0.55rem;
        font-weight: 500;
        opacity: 0.65;
        margin-top: 0.1rem;
    }

    /* Card Content */
    .pengumuman-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-width: 0;
    }

    .pengumuman-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 0.2rem 0.6rem;
        border-radius: 4px;
        margin-bottom: 0.5rem;
        width: fit-content;
    }

    .tag-umum {
        background: rgba(0, 91, 156, 0.08);
        color: #005b9c;
    }

    .tag-teknis {
        background: rgba(0, 163, 224, 0.1);
        color: #0088c4;
    }

    .tag-kepegawaian {
        background: rgba(139, 92, 246, 0.1);
        color: #7c3aed;
    }

    .tag-keuangan {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
    }

    .tag-layanan {
        background: rgba(245, 158, 11, 0.1);
        color: #b45309;
    }

    .pengumuman-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.4;
        margin-bottom: 0.4rem;
        transition: color 0.2s ease;
    }

    .pengumuman-card:hover .pengumuman-title {
        color: #005b9c;
    }

    .pengumuman-excerpt {
        font-size: 0.88rem;
        color: #64748b;
        line-height: 1.65;
        margin-bottom: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Card Action */
    .pengumuman-action {
        display: flex;
        align-items: center;
        flex-shrink: 0;
    }

    .btn-detail {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.55rem 1.3rem;
        border-radius: 50px;
        border: 1.5px solid #005b9c;
        background: transparent;
        color: #005b9c;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
        white-space: nowrap;
        cursor: pointer;
    }

    .btn-detail:hover {
        background: #005b9c;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(0, 91, 156, 0.3);
    }

    .btn-detail i {
        font-size: 0.7rem;
        transition: transform 0.25s ease;
    }

    .btn-detail:hover i {
        transform: translateX(3px);
    }

    /* ---------- Pagination ---------- */
    .pengumuman-pagination {
        padding: 0 0 3rem;
        background: #f4f6f9;
    }

    .pengumuman-pagination .pagination {
        gap: 0.4rem;
    }

    .pengumuman-pagination .page-link {
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

    .pengumuman-pagination .page-link:hover {
        background: #f1f5f9;
        border-color: #005b9c;
        color: #005b9c;
    }

    .pengumuman-pagination .page-item.active .page-link {
        background: #005b9c;
        border-color: #005b9c;
        color: #fff;
        font-weight: 700;
        box-shadow: 0 2px 10px rgba(0, 91, 156, 0.3);
    }

    .pengumuman-pagination .page-item.disabled .page-link {
        background: transparent;
        border-color: #e2e8f0;
        color: #cbd5e1;
    }

    /* ---------- Empty State ---------- */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #94a3b8;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.4;
    }

    .empty-state h5 {
        font-weight: 600;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        font-size: 0.9rem;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 991.98px) {
        .pengumuman-hero h1 { font-size: 2rem; }
    }

    @media (max-width: 767.98px) {
        .pengumuman-hero { padding: 1.5rem 0 2.5rem; }
        .pengumuman-hero h1 { font-size: 1.65rem; }

        .pengumuman-card {
            flex-direction: column;
            gap: 1rem;
            padding: 1.25rem;
        }

        .date-box {
            flex-direction: row;
            gap: 0.5rem;
            min-width: unset;
            height: unset;
            padding: 0.5rem 1rem;
            align-self: flex-start;
        }

        .date-box .date-day {
            font-size: 1.15rem;
            margin-top: 0;
        }

        .pengumuman-action {
            justify-content: flex-start;
        }
    }

    /* ---------- Animation ---------- */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .pengumuman-card {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }

    .pengumuman-card:nth-child(1) { animation-delay: 0.05s; }
    .pengumuman-card:nth-child(2) { animation-delay: 0.10s; }
    .pengumuman-card:nth-child(3) { animation-delay: 0.15s; }
    .pengumuman-card:nth-child(4) { animation-delay: 0.20s; }
    .pengumuman-card:nth-child(5) { animation-delay: 0.25s; }
    .pengumuman-card:nth-child(6) { animation-delay: 0.30s; }
    .pengumuman-card:nth-child(7) { animation-delay: 0.35s; }
    .pengumuman-card:nth-child(8) { animation-delay: 0.40s; }
</style>

<div class="pengumuman-page">

    {{-- ============================================
         1. HERO / HEADER
         ============================================ --}}
    <section class="pengumuman-hero">
        <div class="container px-4 px-lg-5">
            <div class="pengumuman-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="#">Informasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
                    </ol>
                </nav>
            </div>

            <div class="pengumuman-badge">
                <i class="fas fa-bolt"></i> PLN NUSANTARA POWER
            </div>

            <h1>Pemberitahuan & <span class="accent">Pengumuman</span> Resmi</h1>
            <p class="subtitle">
                Informasi resmi terkait operasional, kebijakan, rekrutmen, dan layanan publik
                PT PLN Nusantara Power UP PLTU Indramayu.
            </p>
        </div>
    </section>

    {{-- ============================================
         2. FILTER BAR
         ============================================ --}}
    <section class="pengumuman-filter">
        <div class="container px-4 px-lg-5">
            <div class="filter-bar" id="filterBar">
                <button class="filter-pill active" data-filter="semua">
                    <i class="fas fa-layer-group"></i> Semua
                </button>
                <button class="filter-pill" data-filter="umum">
                    <i class="fas fa-building"></i> Umum
                </button>
                <button class="filter-pill" data-filter="teknis">
                    <i class="fas fa-cogs"></i> Teknis
                </button>
                <button class="filter-pill" data-filter="kepegawaian">
                    <i class="fas fa-users"></i> Kepegawaian
                </button>
                <button class="filter-pill" data-filter="keuangan">
                    <i class="fas fa-chart-line"></i> Keuangan
                </button>
                <button class="filter-pill" data-filter="layanan">
                    <i class="fas fa-concierge-bell"></i> Layanan
                </button>
            </div>
        </div>
    </section>

    {{-- ============================================
         3. ANNOUNCEMENT LIST
         ============================================ --}}
    <section class="pengumuman-list">
        <div class="container px-4 px-lg-5">

            {{-- Card 1 --}}
            <div class="pengumuman-card" data-kategori="umum">
                <div class="date-box">
                    <span class="date-day">08</span>
                    <span class="date-month">Sep</span>
                    <span class="date-year">2026</span>
                </div>
                <div class="pengumuman-content">
                    <span class="pengumuman-tag tag-umum"><i class="fas fa-circle" style="font-size:0.35rem;"></i> Umum</span>
                    <h4 class="pengumuman-title">Jadwal Operasional Libur Nasional Hari Raya 2026</h4>
                    <p class="pengumuman-excerpt">Diberitahukan kepada seluruh masyarakat bahwa jadwal pelayanan informasi publik mengalami penyesuaian selama masa libur nasional Hari Raya...</p>
                </div>
                <div class="pengumuman-action">
                    <a href="#" class="btn-detail">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="pengumuman-card" data-kategori="kepegawaian">
                <div class="date-box">
                    <span class="date-day">02</span>
                    <span class="date-month">Sep</span>
                    <span class="date-year">2026</span>
                </div>
                <div class="pengumuman-content">
                    <span class="pengumuman-tag tag-kepegawaian"><i class="fas fa-circle" style="font-size:0.35rem;"></i> Kepegawaian</span>
                    <h4 class="pengumuman-title">Pengumuman Penerimaan Calon Pegawai PLN NP Periode September 2026</h4>
                    <p class="pengumuman-excerpt">PT PLN Nusantara Power membuka kesempatan bagi putra-putri terbaik bangsa untuk bergabung menjadi bagian dari keluarga besar PLN NP...</p>
                </div>
                <div class="pengumuman-action">
                    <a href="#" class="btn-detail">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="pengumuman-card" data-kategori="teknis">
                <div class="date-box">
                    <span class="date-day">28</span>
                    <span class="date-month">Agu</span>
                    <span class="date-year">2026</span>
                </div>
                <div class="pengumuman-content">
                    <span class="pengumuman-tag tag-teknis"><i class="fas fa-circle" style="font-size:0.35rem;"></i> Teknis</span>
                    <h4 class="pengumuman-title">Pemeliharaan Berkala Unit 2 — Gangguan Sementara Suplai Listrik</h4>
                    <p class="pengumuman-excerpt">Akan dilaksanakan pemeliharaan berkala pada Unit 2 PLTU Indramayu yang berlangsung selama 14 hari. Potensi penurunan suplai sementara...</p>
                </div>
                <div class="pengumuman-action">
                    <a href="#" class="btn-detail">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            {{-- Card 4 --}}
            <div class="pengumuman-card" data-kategori="keuangan">
                <div class="date-box">
                    <span class="date-day">20</span>
                    <span class="date-month">Agu</span>
                    <span class="date-year">2026</span>
                </div>
                <div class="pengumuman-content">
                    <span class="pengumuman-tag tag-keuangan"><i class="fas fa-circle" style="font-size:0.35rem;"></i> Keuangan</span>
                    <h4 class="pengumuman-title">Penyesuaian Tarif Layanan Informasi Publik Tahun Anggaran 2026/2027</h4>
                    <p class="pengumuman-excerpt">Berdasarkan Peraturan Menteri Badan Usaha Milik Negara dan kebijakan internal perusahaan, dilakukan penyesuaian tarif pelayanan informasi...</p>
                </div>
                <div class="pengumuman-action">
                    <a href="#" class="btn-detail">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            {{-- Card 5 --}}
            <div class="pengumuman-card" data-kategori="layanan">
                <div class="date-box">
                    <span class="date-day">15</span>
                    <span class="date-month">Agu</span>
                    <span class="date-year">2026</span>
                </div>
                <div class="pengumuman-content">
                    <span class="pengumuman-tag tag-layanan"><i class="fas fa-circle" style="font-size:0.35rem;"></i> Layanan</span>
                    <h4 class="pengumuman-title">Perubahan Jam Layanan PPID Mulai 1 September 2026</h4>
                    <p class="pengumuman-excerpt">Pejabat Pengelola Informasi dan Dokumentasi (PPID) mengumumkan penyesuaian jam pelayanan permohonan informasi publik yang berlaku efektif...</p>
                </div>
                <div class="pengumuman-action">
                    <a href="#" class="btn-detail">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            {{-- Card 6 --}}
            <div class="pengumuman-card" data-kategori="umum">
                <div class="date-box">
                    <span class="date-day">10</span>
                    <span class="date-month">Agu</span>
                    <span class="date-year">2026</span>
                </div>
                <div class="pengumuman-content">
                    <span class="pengumuman-tag tag-umum"><i class="fas fa-circle" style="font-size:0.35rem;"></i> Umum</span>
                    <h4 class="pengumuman-title">Sosialisasi Implementasi Sistem Manajemen Aset ISO 55001:2024</h4>
                    <p class="pengumuman-excerpt">PT PLN Nusantara Power UP PLTU Indramayu melaksanakan sosialisasi pembaruan standar sistem manajemen aset internasional kepada seluruh unit...</p>
                </div>
                <div class="pengumuman-action">
                    <a href="#" class="btn-detail">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            {{-- Card 7 --}}
            <div class="pengumuman-card" data-kategori="teknis">
                <div class="date-box">
                    <span class="date-day">01</span>
                    <span class="date-month">Agu</span>
                    <span class="date-year">2026</span>
                </div>
                <div class="pengumuman-content">
                    <span class="pengumuman-tag tag-teknis"><i class="fas fa-circle" style="font-size:0.35rem;"></i> Teknis</span>
                    <h4 class="pengumuman-title">Hasil Uji Emisi Gas Buang PLTU Indramayu Semester I Tahun 2026</h4>
                    <p class="pengumuman-excerpt">Berdasarkan hasil pengukuran emisi gas buang yang dilakukan oleh lembaga surveyor independen, seluruh parameter emisi PLTU Indramayu...</p>
                </div>
                <div class="pengumuman-action">
                    <a href="#" class="btn-detail">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            {{-- Card 8 --}}
            <div class="pengumuman-card" data-kategori="kepegawaian">
                <div class="date-box">
                    <span class="date-day">25</span>
                    <span class="date-month">Jul</span>
                    <span class="date-year">2026</span>
                </div>
                <div class="pengumuman-content">
                    <span class="pengumuman-tag tag-kepegawaian"><i class="fas fa-circle" style="font-size:0.35rem;"></i> Kepegawaian</span>
                    <h4 class="pengumuman-title">Pengumuman Hasil Seleksi Kompetensi Calon Pegawai PLN NP T.A. 2026</h4>
                    <p class="pengumuman-excerpt">Berdasarkan hasil seleksi kompetensi yang telah dilaksanakan pada tanggal 15–20 Juli 2026, bersama ini diumumkan daftar nama peserta yang dinyatakan...</p>
                </div>
                <div class="pengumuman-action">
                    <a href="#" class="btn-detail">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

        </div>
    </section>

    {{-- ============================================
         4. PAGINATION
         ============================================ --}}
    <section class="pengumuman-pagination">
        <div class="container px-4 px-lg-5">
            <nav aria-label="Navigasi pengumuman">
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

@push('scripts')
<script>
(function() {
    'use strict';

    var filterBar = document.getElementById('filterBar');
    if (!filterBar) return;

    var pills = filterBar.querySelectorAll('.filter-pill');
    var cards = document.querySelectorAll('.pengumuman-card');

    pills.forEach(function(pill) {
        pill.addEventListener('click', function() {
            pills.forEach(function(p) { p.classList.remove('active'); });
            pill.classList.add('active');

            var filter = pill.getAttribute('data-filter');
            var visibleIndex = 0;

            cards.forEach(function(card) {
                var kategori = card.getAttribute('data-kategori');
                if (filter === 'semua' || kategori === filter) {
                    card.style.display = '';
                    card.style.opacity = '0';
                    card.style.animation = 'none';
                    void card.offsetHeight;
                    card.style.animation = 'fadeInUp 0.4s ease forwards';
                    card.style.animationDelay = (visibleIndex * 60) + 'ms';
                    visibleIndex++;
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
})();
</script>
@endpush
@endsection