@extends('layouts.app')

@section('title', 'E-PPID PLN — Beranda')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, var(--pln-blue) 0%, #003d6b 50%, var(--pln-dark) 100%);
        padding: 6rem 0 5rem;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -15%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.18) 0%, transparent 70%);
        border-radius: 50%;
    }

    .hero-content { position: relative; z-index: 2; }

    .hero-title {
        font-size: 2.6rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.15;
        margin-bottom: 1rem;
    }

    .hero-title span { color: var(--pln-yellow); }

    .hero-subtitle {
        font-size: 1.05rem;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.7;
        max-width: 640px;
        margin-bottom: 2rem;
    }

    .btn-hero-primary {
        background: var(--pln-yellow);
        color: var(--pln-blue);
        font-weight: 700;
        font-size: 0.95rem;
        padding: 0.7rem 1.6rem;
        border-radius: 30px;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-hero-primary:hover {
        background: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 230, 0, 0.35);
        color: var(--pln-blue);
    }

    .btn-hero-outline {
        border: 2px solid rgba(255, 255, 255, 0.6);
        color: #fff;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0.65rem 1.6rem;
        border-radius: 30px;
        background: transparent;
        transition: all 0.3s ease;
    }

    .btn-hero-outline:hover {
        border-color: var(--pln-cyan);
        color: var(--pln-cyan);
        background: rgba(0, 163, 224, 0.08);
    }

    .logo-hero {
        height: 74px;
        width: auto;
        max-width: 220px;
        object-fit: contain;
    }

    .stats-section { padding: 4.5rem 0; background: var(--pln-gray); }

    .stat-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 1.8rem 1.5rem;
        height: 100%;
        position: relative;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--pln-cyan), var(--pln-blue));
    }

    .stat-card:hover {
        transform: translateY(-5px);
        border-color: var(--pln-cyan);
        box-shadow: 0 14px 34px rgba(0, 163, 224, 0.16);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        background: rgba(0, 163, 224, 0.1);
        color: var(--pln-cyan);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    .stat-value {
        color: var(--pln-blue);
        font-weight: 800;
        font-size: 1.6rem;
        line-height: 1.2;
        margin-bottom: 0.3rem;
    }

    .stat-value small { font-size: 0.9rem; font-weight: 700; color: var(--pln-cyan); }

    .stat-label { color: #1E293B; font-weight: 600; font-size: 0.95rem; margin-bottom: 0.25rem; }

    .stat-desc { color: #64748B; font-size: 0.83rem; line-height: 1.6; margin-bottom: 0; }

    .mekanisme-section { padding: 4.5rem 0; background: #fff; }

    .section-title { margin-bottom: 0.4rem; }

    .section-subtitle { margin-bottom: 2.5rem; }

    .step-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 1.8rem 1.3rem;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .step-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 163, 224, 0.12);
        border-color: var(--pln-cyan);
    }

    .step-number {
        width: 46px;
        height: 46px;
        background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan));
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        font-weight: 700;
        margin: 0 auto 1rem;
    }

    .step-card h5 { color: var(--pln-blue); font-weight: 600; font-size: 1rem; margin-bottom: 0.6rem; }

    .step-card p { color: #64748B; font-size: 0.88rem; line-height: 1.6; margin-bottom: 0; }

    .step-icon { font-size: 2rem; color: var(--pln-cyan); margin-bottom: 0.75rem; }

    .services-section { padding: 4.5rem 0; background: #fff; }

    .wilayah-section { padding: 4.5rem 0; background: var(--pln-gray); }

    .wilayah-section img {
        width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
        border-radius: 10px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.06);
        -webkit-user-drag: none;
        user-select: none;
        -webkit-user-select: none;
    }

    .icon-circle {
        width: 58px;
        height: 58px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        margin: 0 auto 1rem;
        color: #fff;
    }

    .menu-card h5 { font-weight: 600; font-size: 0.95rem; color: var(--pln-blue); margin-bottom: 0.4rem; }

    .menu-card p { color: #64748B; font-size: 0.82rem; line-height: 1.6; margin-bottom: 0; }

    @media (max-width: 991.98px) { .hero-title { font-size: 2.1rem; } }

    @media (max-width: 767.98px) {
        .hero-section { padding: 4rem 0 3rem; }
        .hero-title { font-size: 1.7rem; }
        .hero-subtitle { font-size: 0.95rem; }
        .stats-section, .mekanisme-section, .services-section, .wilayah-section { padding: 3rem 0; }
        .stat-value { font-size: 1.3rem; }
    }
</style>
@endpush

@section('content')
<!-- ============================================
     1. HERO BANNER
     ============================================ -->
<section class="hero-section" id="home">
    <div class="container px-4 px-lg-5">
        <div class="row align-items-center">
            <div class="col-lg-7 hero-content">
                <h1 class="hero-title">
                    PLN Nusantara Power <span>Indramayu</span>
                </h1>
                <p class="hero-subtitle">
                    Unit Pembangkitan Tenaga Uap (PLTU) Indramayu berkapasitas 3 x 330 MW yang beroperasi 24 jam nonstop untuk mendukung ketahanan energi nasional dan penyediaan layanan informasi publik yang transparan.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#layanan" class="btn btn-hero-primary">
                        <i class="fas fa-file-alt me-2"></i> Permohonan Informasi
                    </a>
                    <a href="#mekanisme" class="btn btn-hero-outline">
                        <i class="fas fa-info-circle me-2"></i> Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            <div class="col-lg-5 text-center mt-5 mt-lg-0">
                <img
                    src="{{ asset('assets/images/logo-pln.png') }}"
                    alt="Logo PLN Nusantara Power"
                    class="logo-hero"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';"
                />
                <span class="d-none text-white fw-bold" style="font-size: 1.4rem;">
                    <i class="fas fa-bolt" style="color: var(--pln-yellow)"></i> PLN
                </span>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     2. STATISTIK & KINERJA
     ============================================ -->
<section class="stats-section" id="statistik">
    <div class="container px-4 px-lg-5">
        <div class="text-center mb-5">
            <h2 class="section-title">Statistik & Kinerja Teknis</h2>
            <p class="section-subtitle">Ringkasan kapasitas dan kontribusi unit pembangkitan</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-bolt"></i></div>
                    <div class="stat-value">3 &times; 330 <small>MW</small></div>
                    <div class="stat-label">Kapasitas Terpasang</div>
                    <p class="stat-desc">Total 990 MW kapasitas pembangkitan terpasang.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-network-wired"></i></div>
                    <div class="stat-value">Jamali</div>
                    <div class="stat-label">Cakupan Suplai</div>
                    <p class="stat-desc">Sistem Interkoneksi Jawa–Madura–Bali (Jamali).</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-industry"></i></div>
                    <div class="stat-value">23.000+ <small>MW</small></div>
                    <div class="stat-label">Total Kapasitas PLN NP</div>
                    <p class="stat-desc">Kapasitas pembangkitan PT PLN Nusantara Power.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-leaf"></i></div>
                    <div class="stat-value">6,3+ <small>GW</small></div>
                    <div class="stat-label">Proyek Energi Terbarukan</div>
                    <p class="stat-desc">Portofolio energi terbarukan yang terus berkembang.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     3. MEKANISME PELAYANAN
     ============================================ -->
<section class="mekanisme-section" id="mekanisme">
    <div class="container px-4 px-lg-5">
        <div class="text-center mb-5">
            <h2 class="section-title">Mekanisme Pelayanan Informasi Publik</h2>
            <p class="section-subtitle">
                Berikut adalah alur langkah pelayanan informasi publik di lingkungan PT PLN (Persero)
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <div class="step-icon"><i class="fas fa-pen-to-square"></i></div>
                    <h5>Pengajuan Permohonan</h5>
                    <p>Pemohon mengajukan permohonan informasi publik secara tertulis melalui formulir yang telah disediakan.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <div class="step-icon"><i class="fas fa-clipboard-check"></i></div>
                    <h5>Penerimaan & Pencatatan</h5>
                    <p>PPID menerima permohonan, mencatat dalam register, dan memberikan tanda terima kepada pemohon.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <div class="step-icon"><i class="fas fa-magnifying-glass-chart"></i></div>
                    <h5>Proses Verifikasi</h5>
                    <p>PPID melakukan verifikasi dan inventarisasi informasi yang dimohonkan berdasarkan kriteria keterbukaan.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">4</div>
                    <div class="step-icon"><i class="fas fa-paper-plane"></i></div>
                    <h5>Penyampaian Informasi</h5>
                    <p>Informasi publik disampaikan kepada pemohon paling lambat 10 hari kerja sejak permohonan diterima.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     4. WILAYAH OPERASIONAL
     ============================================ -->
<section class="wilayah-section" id="wilayah">
    <div class="container px-4 px-lg-5">
        <div class="text-center mb-5">
            <h2 class="section-title">Wilayah Operasional PT PLN Nusantara Power</h2>
            <p class="section-subtitle">Cakupan area kerja dan pembangkitan di berbagai wilayah Indonesia</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10 text-center mb-4">
                <img src="{{ asset('assets/halaman_utama/wilayah operasional1.png') }}" alt="Wilayah Operasional 1" draggable="false" ondragstart="return false;">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <img src="{{ asset('assets/halaman_utama/wilayah operasional2.png') }}" alt="Wilayah Operasional 2" draggable="false" ondragstart="return false;">
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     5. LAYANAN KAMI
     ============================================ -->
<section class="services-section" id="layanan">
    <div class="container px-4 px-lg-5">
        <div class="text-center mb-5">
            <h2 class="section-title">Layanan Kami</h2>
            <p class="section-subtitle">
                Akses berbagai layanan informasi publik yang tersedia
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="menu-card">
                    <div class="icon-circle" style="background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan))">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h5>Informasi Publik</h5>
                    <p>Akses dokumen dan data informasi publik yang tersedia secara terbuka.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="menu-card">
                    <div class="icon-circle" style="background: linear-gradient(135deg, var(--pln-cyan), #00d4ff)">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <h5>Permohonan Informasi</h5>
                    <p>Ajukan permohonan informasi publik secara online dengan mudah dan cepat.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="menu-card">
                    <div class="icon-circle" style="background: linear-gradient(135deg, var(--pln-yellow), #ffcc00); color: #1a1a2e;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h5>Keberatan Informasi</h5>
                    <p>Sampaikan keberatan apabila informasi yang dimohonkan ditolak atau tidak sesuai.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="menu-card">
                    <div class="icon-circle" style="background: linear-gradient(135deg, var(--pln-red), #ff5555)">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h5>Informasi Serta Merta</h5>
                    <p>Akses informasi yang harus segera diumumkan demi keselamatan masyarakat.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
