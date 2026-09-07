@extends('layouts.app')

@section('title', 'E-PPID PLN — Beranda')

@section('content')
    {{-- ============================================
         HERO SECTION
         ============================================ --}}
    <section class="hero-section" id="home">
        <div class="container px-4 px-lg-5">
            <div class="row align-items-center">
                <div class="col-lg-7 hero-content">
                    <h1>
                        <span>E-PPID</span> PLN
                    </h1>
                    <p class="hero-subtitle">
                        Layanan ini merupakan sarana layanan online bagi pemohon informasi publik sebagai salah satu wujud pelaksanaan keterbukaan informasi publik di PLN.
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
                    <div style="position: relative; z-index: 2;">
                        <div style="
                            width: 280px; height: 280px;
                            background: linear-gradient(135deg, rgba(255,230,0,0.15), rgba(0,163,224,0.15));
                            border-radius: 50%;
                            display: flex; align-items: center; justify-content: center;
                            margin: 0 auto;
                            border: 2px solid rgba(255,255,255,0.1);
                        ">
                            <div style="
                                width: 200px; height: 200px;
                                background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan));
                                border-radius: 50%;
                                display: flex; align-items: center; justify-content: center;
                                box-shadow: 0 20px 50px rgba(0,91,156,0.3);
                            ">
                                <i class="fas fa-bolt" style="font-size: 4rem; color: var(--pln-yellow)"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         MEKANISME PELAYANAN INFORMASI PUBLIK
         ============================================ --}}
    <section class="mekanisme-section" id="mekanisme">
        <div class="container px-4 px-lg-5">
            <div class="text-center mb-5">
                <h2 class="section-title">Mekanisme Pelayanan Informasi Publik</h2>
                <p class="section-subtitle">
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
                        <h5>Pengajuan Permohonan</h5>
                        <p>Pemohon mengajukan permohonan informasi publik secara tertulis melalui formulir yang telah disediakan.</p>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h5>Penerimaan & Pencatatan</h5>
                        <p>PPID menerima permohonan, mencatat dalam register, dan memberikan tanda terima kepada pemohon.</p>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <div class="step-icon">
                            <i class="fas fa-magnifying-glass-chart"></i>
                        </div>
                        <h5>Proses Verifikasi</h5>
                        <p>PPID melakukan verifikasi dan inventarisasi informasi yang dimohonkan berdasarkan kriteria keterbukaan.</p>
                    </div>
                </div>

                {{-- Step 4 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <div class="step-icon">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <h5>Penyampaian Informasi</h5>
                        <p>Informasi publik disampaikan kepada pemohon paling lambat 10 hari kerja sejak permohonan diterima.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         QUICK MENU / LAYANAN
         ============================================ --}}
    <section class="quick-menu-section" id="layanan">
        <div class="container px-4 px-lg-5">
            <div class="text-center mb-5">
                <h2 class="section-title">Layanan Kami</h2>
                <p class="section-subtitle">
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
                        <h5>Informasi Publik</h5>
                        <p>Akses dokumen dan data informasi publik yang tersedia secara terbuka.</p>
                    </div>
                </div>

                {{-- Menu 2 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="menu-card">
                        <div class="icon-circle" style="background: linear-gradient(135deg, var(--pln-cyan), #00d4ff)">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <h5>Permohonan Informasi</h5>
                        <p>Ajukan permohonan informasi publik secara online dengan mudah dan cepat.</p>
                    </div>
                </div>

                {{-- Menu 3 --}}
                <div class="col-lg-3 col-md-6">
                    <div class="menu-card">
                        <div class="icon-circle" style="background: linear-gradient(135deg, var(--pln-yellow), #ffcc00)">
                            <i class="fas fa-exclamation-triangle" style="color: var(--pln-blue)"></i>
                        </div>
                        <h5>Keberatan Informasi</h5>
                        <p>Sampaikan keberatan apabila informasi yang dimohonkan ditolak atau tidak sesuai.</p>
                    </div>
                </div>

                {{-- Menu 4 --}}
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

    {{-- ============================================
         STATISTIK / INFO RINGKAS
         ============================================ --}}
    <section style="padding: 4rem 0; background: var(--pln-blue);">
        <div class="container px-4 px-lg-5 text-center">
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="text-white">
                        <h2 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.25rem;">1.250+</h2>
                        <p style="opacity: 0.8; font-size: 0.9rem; margin-bottom: 0;">Dokumen Tersedia</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="text-white">
                        <h2 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.25rem;">5.000+</h2>
                        <p style="opacity: 0.8; font-size: 0.9rem; margin-bottom: 0;">Permohonan Diproses</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="text-white">
                        <h2 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.25rem;">98%</h2>
                        <p style="opacity: 0.8; font-size: 0.9rem; margin-bottom: 0;">Tingkat Kepuasan</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="text-white">
                        <h2 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.25rem;">10</h2>
                        <p style="opacity: 0.8; font-size: 0.9rem; margin-bottom: 0;">Hari Kerja Maks.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
