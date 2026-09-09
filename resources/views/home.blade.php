@extends('layouts.app')

@section('title', 'E-PPID PLN — Beranda')

@section('content')
<style>
    /* =============================================
       KARTU STATISTIK — BERANDA
       ============================================= */

    /* ---------- Kartu Statistik ---------- */
    .unit-stats-section {
        padding: 4rem 0;
        background: #fff;
        position: relative;
        z-index: 1;
        overflow: hidden; /* cegah card meluber/terpotong keluar seksi */
    }

    .stat-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 2rem 1.5rem;
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
        width: 52px;
        height: 52px;
        background: rgba(0, 163, 224, 0.1);
        color: var(--pln-cyan);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 1.1rem;
    }

    .stat-value {
        color: var(--pln-blue);
        font-weight: 800;
        font-size: 1.65rem;
        line-height: 1.2;
        margin-bottom: 0.3rem;
    }

    .stat-value small {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--pln-cyan);
    }

    .stat-label {
        color: #1E293B;
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 0.25rem;
    }

    .stat-desc {
        color: #64748B;
        font-size: 0.83rem;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* ---------- Judul Hero (teks panjang) ---------- */
    .hero-section h1.hero-title {
        font-size: 2.6rem;
    }

    @media (max-width: 991.98px) {
        .hero-section h1.hero-title {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 767.98px) {
        .hero-section h1.hero-title {
            font-size: 1.8rem;
        }
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 767.98px) {
        .unit-stats-section {
            padding: 3rem 0;
        }

        .stat-card {
            padding: 1.5rem 1.1rem;
        }

        .stat-value {
            font-size: 1.35rem;
        }
    }
</style>

    {{-- ============================================
         1. HERO BANNER (seksi pertama
            tepat di bawah navbar fixed-top)
         ============================================ --}}
    <section class="hero-section" id="home">
        <div class="container px-4 px-lg-5">
            <div class="row align-items-center">
                <div class="col-lg-7 hero-content">
                    <h1 class="hero-title" data-i18n="hero.title_plain">
                        PLN Nusantara Power <span>Indramayu</span>
                    </h1>
                    <p class="hero-subtitle" data-i18n="hero.subtitle">
                        Unit Pembangkitan Tenaga Uap (PLTU) Indramayu berkapasitas 3 x 330 MW yang beroperasi 24 jam nonstop untuk mendukung ketahanan energi nasional dan penyediaan layanan informasi publik yang transparan.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#layanan" class="btn btn-hero-primary" data-i18n="hero.btn_request">
                            <i class="fas fa-file-alt me-2"></i> Permohonan Informasi
                        </a>
                        <a href="#mekanisme" class="btn btn-hero-outline" data-i18n="hero.btn_learn">
                            <i class="fas fa-info-circle me-2"></i> Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 text-center mt-5 mt-lg-0">
                    {{-- Logo tanpa anchor: tidak mengarah ke halaman mana pun
                        dan tidak bisa di-drag/di-select --}}
                    <div class="d-inline-block">
                        <img
                            src="{{ asset('assets/images/logo-pln.png') }}"
                            alt="Logo PLN Nusantara Power"
                            class="logo-hero"
                            draggable="false"
                            ondragstart="return false;"
                            onselectstart="return false;"
                            style="pointer-events: none; user-select: none; -webkit-user-drag: none;"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                        />
                        <span class="d-none text-white fw-bold" style="font-size: 1.5rem;">
                            <i class="fas fa-bolt" style="color: var(--pln-yellow)"></i> PLN
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         2. STATISTIK & KINERJA TEKNIS
         ============================================ --}}
    <section class="unit-stats-section" id="statistik">
        <div class="container px-4 px-lg-5">
            <div class="text-center mb-5">
                <h2 class="section-title" data-i18n="stats.title">Statistik &amp; Kinerja Teknis</h2>
                <p class="section-subtitle" data-i18n="stats.subtitle">Ringkasan kapasitas dan kontribusi unit pembangkitan</p>
            </div>

            <div class="row g-4">
                {{-- Stat 1: Kapasitas Terpasang --}}
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-bolt"></i></div>
                        <div class="stat-value" data-i18n="stats.value_capacity">3 &times; 330 <small>MW</small></div>
                        <div class="stat-label" data-i18n="stats.label_capacity">Kapasitas Terpasang</div>
                        <p class="stat-desc" data-i18n="stats.desc_capacity">Total 990 MW kapasitas pembangkitan terpasang.</p>
                    </div>
                </div>

                {{-- Stat 2: Cakupan Suplai --}}
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-network-wired"></i></div>
                        <div class="stat-value" data-i18n="stats.value_coverage">Jamali</div>
                        <div class="stat-label" data-i18n="stats.label_coverage">Cakupan Suplai</div>
                        <p class="stat-desc" data-i18n="stats.desc_coverage">Sistem Interkoneksi Jawa–Madura–Bali (Jamali).</p>
                    </div>
                </div>

                {{-- Stat 3: Total Kapasitas PLN NP --}}
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-industry"></i></div>
                        <div class="stat-value" data-i18n="stats.value_total">23.000+ <small>MW</small></div>
                        <div class="stat-label" data-i18n="stats.label_total">Total Kapasitas PLN NP</div>
                        <p class="stat-desc" data-i18n="stats.desc_total">Kapasitas pembangkitan PT PLN Nusantara Power.</p>
                    </div>
                </div>

                {{-- Stat 4: Proyek EBT --}}
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-leaf"></i></div>
                        <div class="stat-value" data-i18n="stats.value_ebt">6,3+ <small>GW</small></div>
                        <div class="stat-label" data-i18n="stats.label_ebt">Proyek Energi Terbarukan (EBT)</div>
                        <p class="stat-desc" data-i18n="stats.desc_ebt">Portofolio energi terbarukan yang terus berkembang.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         3. MEKANISME PELAYANAN INFORMASI PUBLIK (ALUR)
         ============================================ --}}
    <section class="mekanisme-section" id="mekanisme">
        <div class="container px-4 px-lg-5">
            <div class="text-center mb-5">
                <h2 class="section-title" data-i18n="flow.title">Mekanisme Pelayanan Informasi Publik</h2>
                <p class="section-subtitle" data-i18n="flow.subtitle">
                    Berikut adalah alur langkah pelayanan informasi publik di lingkungan PT PLN (Persero)
                </p>
            </div>

            <div class="row g-4">
                {{-- Step 1 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <div class="step-icon">
                            <i class="fas fa-pen-to-square"></i>
                        </div>
                        <h5 data-i18n="flow.step1_title">Pengajuan Permohonan</h5>
                        <p data-i18n="flow.step1_desc">Pemohon mengajukan permohonan informasi publik secara tertulis melalui formulir yang telah disediakan.</p>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h5 data-i18n="flow.step2_title">Penerimaan &amp; Pencatatan</h5>
                        <p data-i18n="flow.step2_desc">PPID menerima permohonan, mencatat dalam register, dan memberikan tanda terima kepada pemohon.</p>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <div class="step-icon">
                            <i class="fas fa-magnifying-glass-chart"></i>
                        </div>
                        <h5 data-i18n="flow.step3_title">Proses Verifikasi</h5>
                        <p data-i18n="flow.step3_desc">PPID melakukan verifikasi dan inventarisasi informasi yang dimohonkan berdasarkan kriteria keterbukaan.</p>
                    </div>
                </div>

                {{-- Step 4 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <div class="step-icon">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <h5 data-i18n="flow.step4_title">Penyampaian Informasi</h5>
                        <p data-i18n="flow.step4_desc">Informasi publik disampaikan kepada pemohon paling lambat 10 hari kerja sejak permohonan diterima.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         4. QUICK MENU / LAYANAN KAMI
         ============================================ --}}
    <section class="quick-menu-section" id="layanan">
        <div class="container px-4 px-lg-5">
            <div class="text-center mb-5">
                <h2 class="section-title" data-i18n="services.title">Layanan Kami</h2>
                <p class="section-subtitle" data-i18n="services.subtitle">
                    Akses berbagai layanan informasi publik yang tersedia
                </p>
            </div>

            <div class="row g-4">
                {{-- Menu 1 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="menu-card">
                        <div class="icon-circle" style="background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan))">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h5 data-i18n="services.menu1_title">Informasi Publik</h5>
                        <p data-i18n="services.menu1_desc">Akses dokumen dan data informasi publik yang tersedia secara terbuka.</p>
                    </div>
                </div>

                {{-- Menu 2 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="menu-card">
                        <div class="icon-circle" style="background: linear-gradient(135deg, var(--pln-cyan), #00d4ff)">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <h5 data-i18n="services.menu2_title">Permohonan Informasi</h5>
                        <p data-i18n="services.menu2_desc">Ajukan permohonan informasi publik secara online dengan mudah dan cepat.</p>
                    </div>
                </div>

                {{-- Menu 3 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="menu-card">
                        <div class="icon-circle" style="background: linear-gradient(135deg, var(--pln-yellow), #ffcc00)">
                            <i class="fas fa-exclamation-triangle" style="color: var(--pln-blue)"></i>
                        </div>
                        <h5 data-i18n="services.menu3_title">Keberatan Informasi</h5>
                        <p data-i18n="services.menu3_desc">Sampaikan keberatan apabila informasi yang dimohonkan ditolak atau tidak sesuai.</p>
                    </div>
                </div>

                {{-- Menu 4 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="menu-card">
                        <div class="icon-circle" style="background: linear-gradient(135deg, var(--pln-red), #ff5555)">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h5 data-i18n="services.menu4_title">Informasi Serta Merta</h5>
                        <p data-i18n="services.menu4_desc">Akses informasi yang harus segera diumumkan demi keselamatan masyarakat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
