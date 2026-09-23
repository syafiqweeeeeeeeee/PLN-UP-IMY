@extends('layouts.app')

@section('title', 'PLN Nusantara Power')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, var(--pln-blue) 0%, #00566b 50%, var(--pln-dark) 100%);
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
        background: radial-gradient(circle, rgba(0, 194, 209, 0.18) 0%, transparent 70%);
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
        background: rgba(0, 194, 209, 0.08);
    }

    .logo-hero {
        height: 300px;
        width: auto;
        max-width: 440px;
        object-fit: contain;
        border-radius: 95px;
        filter: drop-shadow(0 14px 30px rgba(0, 0, 0, 0.35));
        -webkit-user-drag: none;
        user-select: none;
        -webkit-user-select: none;
    }

    /* --- 3. PROMO PLN MOBILE (pengganti mekanisme pelayanan) --- */
    .pln-mobile-section {
        padding: 5rem 0;
        background:
            radial-gradient(circle at 85% 15%, rgba(255, 255, 255, 0.14) 0, transparent 42%),
            radial-gradient(circle at 10% 90%, rgba(255, 255, 255, 0.10) 0, transparent 40%),
            linear-gradient(135deg, #00c2d1 0%, #00a6bd 55%, #008fa8 100%);
        position: relative;
        overflow: hidden;
    }

    .section-title { margin-bottom: 0.4rem; }

    .section-subtitle { margin-bottom: 2.5rem; }

    .mobile-title {
        color: #fff;
        font-weight: 800;
        font-size: 2.4rem;
        line-height: 1.2;
    }

    .mobile-subtitle {
        color: rgba(255, 255, 255, 0.92);
        font-size: 1.05rem;
        max-width: 34rem;
        margin-top: 0.9rem;
        margin-bottom: 0;
    }

    .qr-box {
        background: #fff;
        padding: 0.7rem;
        border-radius: 10px;
        box-shadow: 0 14px 30px rgba(0, 40, 60, 0.25);
        line-height: 0;
        flex-shrink: 0;
    }

    .badge-store {
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        background: #000;
        color: #fff;
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, 0.55);
        border-radius: 9px;
        padding: 0.5rem 1.15rem;
        min-width: 200px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .badge-store:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.3);
        color: #fff;
    }

    .badge-store .store-icon { font-size: 1.7rem; }

    .badge-store small {
        display: block;
        font-size: 0.62rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        opacity: 0.85;
    }

    .badge-store strong {
        display: block;
        font-size: 1.22rem;
        font-weight: 600;
        line-height: 1.15;
    }

    .hashtag-pill {
        display: inline-block;
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.35);
        color: #fff;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.55rem 1.4rem;
        border-radius: 10px;
    }

    /* Mockup HP — gambar asli aplikasi */
    .phone-img {
        width: 100%;
        max-width: 420px;
        height: auto;
        display: block;
        margin: 0 auto;
        filter: drop-shadow(0 30px 60px rgba(0, 40, 60, 0.35));
        -webkit-user-drag: none;
        user-select: none;
    }

    .services-section {
        padding: 4.5rem 0;
        /* Selaras dengan section PLN Mobile: gradient biru-cyan var(--pln-blue) */
        background:
            radial-gradient(circle at 85% 15%, rgba(255, 255, 255, 0.14) 0, transparent 42%),
            radial-gradient(circle at 10% 90%, rgba(255, 255, 255, 0.10) 0, transparent 40%),
            linear-gradient(135deg, #00c2d1 0%, #00a6bd 55%, #008fa8 100%);
    }

    .services-section .section-title { color: #fff; }

    .services-section .section-subtitle { color: rgba(255, 255, 255, 0.9); }

    .wilayah-section {
        padding: 4.5rem 0;
        /* Selaras dengan section PLN Mobile: gradient biru-cyan var(--pln-blue) */
        background:
            radial-gradient(circle at 85% 15%, rgba(255, 255, 255, 0.14) 0, transparent 42%),
            radial-gradient(circle at 10% 90%, rgba(255, 255, 255, 0.10) 0, transparent 40%),
            linear-gradient(135deg, #00c2d1 0%, #00a6bd 55%, #008fa8 100%);
    }

    .wilayah-section .section-title { color: #fff; }

    .wilayah-section .section-subtitle { color: rgba(255, 255, 255, 0.9); }

    /* --- Banner slider (Wilayah Operasional + Sistem Interkoneksi) ---
       Gaya banner seperti slider PLN Mobile: gambar penuh dalam frame
       membulat, kaption tebal dengan sorotan kuning, dan dot indikator. */
    .banner-slider {
        position: relative;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid #E2E8F0;
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.12);
        background: #fff;
    }

    .banner-slide img {
        width: 100%;
        height: auto;
        display: block;
        -webkit-user-drag: none;
        user-select: none;
        -webkit-user-select: none;
    }

    /* Kaption overlay: turun menjadi bar di bawah gambar pada layar kecil */
    .banner-caption {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 2.6rem 2.4rem 1.9rem;
        background: linear-gradient(180deg, rgba(4, 35, 52, 0) 0%, rgba(4, 35, 52, 0.72) 60%);
        text-align: left;
        pointer-events: none;
    }

    .banner-caption .banner-line {
        display: block;
        color: #fff;
        font-weight: 800;
        font-size: clamp(1.05rem, 2.6vw, 1.9rem);
        line-height: 1.25;
        text-shadow: 0 2px 10px rgba(0, 30, 45, 0.55);
        max-width: 80%;
    }

    .banner-caption .banner-highlight {
        display: inline-block;
        margin-top: 0.35rem;
        background: var(--pln-yellow);
        color: var(--pln-blue);
        font-weight: 800;
        font-size: clamp(1.1rem, 2.8vw, 2rem);
        line-height: 1.3;
        padding: 0.15em 0.55em;
        border-radius: 8px;
        text-shadow: none;
    }

    /* Dot indikator ala slider PLN Mobile */
    .banner-dots {
        position: absolute;
        left: 50%;
        bottom: 0.7rem;
        transform: translateX(-50%);
        display: flex;
        align-items: center;
        gap: 0.35rem;
        z-index: 3;
    }

    .banner-dots [data-bs-target] {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        border: none;
        background: rgba(255, 255, 255, 0.55);
        /* Area sentuh lebih besar (17px) tanpa mengubah ukuran visual:
           padding transparan + background hanya di area konten */
        background-clip: padding-box;
        box-sizing: content-box;
        padding: 5px;
        opacity: 1;
        margin: 0;
        transition: all 0.25s ease;
    }

    .banner-dots [data-bs-target].active {
        background: var(--pln-yellow);
        transform: scale(1.15);
    }

    /* Tombol panah prev/next */
    .banner-slider .carousel-control-prev,
    .banner-slider .carousel-control-next {
        width: 44px;
        height: 44px;
        top: 50%;
        bottom: auto;
        transform: translateY(-50%);
        border-radius: 50%;
        background: rgba(4, 35, 52, 0.45);
        opacity: 0;
        transition: opacity 0.25s ease;
    }

    .banner-slider .carousel-control-prev { left: 0.9rem; }
    .banner-slider .carousel-control-next { right: 0.9rem; }

    .banner-slider:hover .carousel-control-prev,
    .banner-slider:hover .carousel-control-next,
    .banner-slider .carousel-control-prev:focus-visible,
    .banner-slider .carousel-control-next:focus-visible { opacity: 1; }

    .banner-slider .carousel-control-prev-icon,
    .banner-slider .carousel-control-next-icon {
        width: 1.1rem;
        height: 1.1rem;
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

    /* Kartu layanan kini berupa link <a> — netralkan warna teks link
       agar tampilan sama persis dengan kartu biasa. */
    a.menu-card,
    a.menu-card:hover {
        color: inherit;
    }

    @media (max-width: 991.98px) {
        /* Navbar tablet/mobile lebih tinggi (brand 2 baris + hamburger):
           ruang atas hero ditambah agar emblem tidak tertimpa navbar */
        .hero-section { padding: 6.5rem 0 4rem; }
        .hero-title { font-size: 2.1rem; }
        .logo-hero { height: 220px; max-width: 320px; }
        /* Tablet/mobile: logo tampil di ATAS konten (stack kolom),
           jadi teks & tombol hero ikut rata tengah agar seimbang */
        .hero-content { text-align: center; }
        .hero-content .hero-subtitle { margin-left: auto; margin-right: auto; }
        .hero-content .d-flex { justify-content: center; }
    }

    @media (max-width: 767.98px) {
        /* Ruang atas lega (7rem) — aman meski tinggi navbar berubah-ubah
           (teks brand bisa sedikit membesar di sebagian perangkat) */
        .hero-section { padding: 7rem 0 3rem; }
        .hero-title { font-size: 1.7rem; }
        .hero-subtitle { font-size: 0.95rem; }
        /* Logo di atas judul — diperkecil agar proporsional dan tidak
           mendorong konten terlalu jauh ke bawah */
        .logo-hero { height: 120px; max-width: 180px; border-radius: 40px; }

        .pln-mobile-section, .services-section, .wilayah-section { padding: 3rem 0; }

        /* Judul section lebih kecil agar tidak mendominasi layar HP
           (judul "Wilayah Operasional..." cukup panjang) */
        .section-title { font-size: 1.4rem; }
        .section-subtitle { font-size: 0.9rem; margin-bottom: 1.75rem; }

        /* Banner slider di HP: kaption pindah ke bawah gambar (bukan
           overlay) agar tidak menutupi isi peta/diagram.
           Padding bawah 2rem memberi ruang untuk dot indikator. */
        .banner-caption {
            position: static;
            padding: 0.9rem 1.1rem 2rem;
            background: linear-gradient(180deg, #06263a 0%, #042338 100%);
            text-align: center;
        }

        .banner-caption .banner-line { max-width: 100%; font-size: 1rem; }
        .banner-caption .banner-highlight { font-size: 1.05rem; }

        .banner-slider .carousel-control-prev,
        .banner-slider .carousel-control-next { display: none; }
        .banner-dots { bottom: 0.55rem; }

        /* Promo PLN Mobile: QR + tombol store rata tengah agar rapi
           saat flex-wrap di layar sempit */
        .mobile-title { font-size: 1.65rem; }
        .mobile-subtitle { font-size: 0.95rem; }
        .pln-mobile-section .col-lg-7 { text-align: center; }
        .promo-actions { justify-content: center; }
        .store-badges { align-items: center; }

        .menu-card { padding: 1.5rem 1.25rem; }
    }

    @media (max-width: 575.98px) {
        /* HP kecil: tombol hero melebar penuh berurutan ke bawah,
           tidak berdesakan berdampingan */
        .hero-content .btn-hero-primary,
        .hero-content .btn-hero-outline { width: 100%; }
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
            {{-- Logo emblem: DI ATAS judul saat mobile/tablet (source order
                 pertama = urutan stack kolom), lalu di desktop (lg+)
                 dikembalikan ke kanan via order-lg-2 agar tampilan
                 desktop TIDAK berubah. --}}
            <div class="col-lg-5 text-center order-lg-2 mb-4 mb-lg-0">
                <img
                    src="{{ asset('assets/images/logo-pln1.png') }}"
                    alt="Logo PLN Nusantara Power"
                    class="logo-hero"
                    draggable="false"
                    ondragstart="return false;"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';"
                />
                <span class="d-none text-white fw-bold" style="font-size: 1.4rem;">
                    <i class="fas fa-bolt" style="color: var(--pln-yellow)"></i> PLN
                </span>
            </div>
            <div class="col-lg-7 hero-content order-lg-1">
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
        </div>
    </div>
</section>

<!-- ============================================
     2. BANNER SLIDER — Wilayah Operasional + Sistem Interkoneksi
     ============================================ -->
<section class="wilayah-section" id="wilayah">
    <div class="container px-4 px-lg-5">
        <div class="text-center mb-5">
            <h2 class="section-title" data-i18n="region.title">Wilayah Operasional PT PLN Nusantara Power</h2>
            <p class="section-subtitle" data-i18n="region.subtitle">Cakupan area kerja dan pembangkitan di berbagai wilayah Indonesia</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div id="bannerSlider" class="carousel slide banner-slider" data-bs-ride="carousel" data-bs-touch="true">

                    {{-- Dot indikator ala slider PLN Mobile --}}
                    <div class="banner-dots">
                        <button type="button" data-bs-target="#bannerSlider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1: Wilayah Operasional 1"></button>
                        <button type="button" data-bs-target="#bannerSlider" data-bs-slide-to="1" aria-label="Slide 2: Wilayah Operasional 2"></button>
                        <button type="button" data-bs-target="#bannerSlider" data-bs-slide-to="2" aria-label="Slide 3: Sistem Interkoneksi"></button>
                    </div>

                    <div class="carousel-inner">

                        {{-- Slide 1: Wilayah Operasional 1 --}}
                        <div class="carousel-item banner-slide active" data-bs-interval="5000">
                            <img src="{{ asset('assets/halaman_utama/wilayah operasional1.png') }}" alt="Wilayah Operasional 1" decoding="async" draggable="false" ondragstart="return false;">
                            <div class="banner-caption">
                                <span class="banner-line" data-i18n="banner.line_scope">Cakupan Area Pembangkitan</span>
                                <span class="banner-highlight" data-i18n="banner.wilayah1">Wilayah Operasional 1</span>
                            </div>
                        </div>

                        {{-- Slide 2: Wilayah Operasional 2 --}}
                        <div class="carousel-item banner-slide" data-bs-interval="5000">
                            <img src="{{ asset('assets/halaman_utama/wilayah operasional2.png') }}" alt="Wilayah Operasional 2" loading="lazy" decoding="async" draggable="false" ondragstart="return false;">
                            <div class="banner-caption">
                                <span class="banner-line" data-i18n="banner.line_scope">Cakupan Area Pembangkitan</span>
                                <span class="banner-highlight" data-i18n="banner.wilayah2">Wilayah Operasional 2</span>
                            </div>
                        </div>

                        {{-- Slide 3: Sistem Interkoneksi --}}
                        <div class="carousel-item banner-slide" data-bs-interval="5000">
                            <img src="{{ asset('assets/halaman_utama/sistem interkoneksi.png') }}" alt="Sistem Interkoneksi" loading="lazy" decoding="async" draggable="false" ondragstart="return false;">
                            <div class="banner-caption">
                                <span class="banner-line" data-i18n="banner.line_network">Diagram Jaringan Kelistrikan</span>
                                <span class="banner-highlight" data-i18n="banner.interkoneksi">Sistem Interkoneksi</span>
                            </div>
                        </div>

                    </div>

                    {{-- Panah prev/next (muncul saat hover) --}}
                    <button class="carousel-control-prev" type="button" data-bs-target="#bannerSlider" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden" data-i18n="banner.prev">Sebelumnya</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#bannerSlider" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden" data-i18n="banner.next">Berikutnya</span>
                    </button>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     4. LAYANAN KAMI
     ============================================ -->
<section class="services-section" id="layanan">
    <div class="container px-4 px-lg-5">
        <div class="text-center mb-5">
            <h2 class="section-title" data-i18n="services.title">Layanan Kami</h2>
            <p class="section-subtitle" data-i18n="services.subtitle">
                Akses berbagai layanan informasi publik yang tersedia
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('informasi.layanan') }}" class="menu-card d-block text-decoration-none">
                    <div class="icon-circle" style="background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan))">
                        <i class="fas fa-circle-info"></i>
                    </div>
                    <h5 data-i18n="services.menu1_title">Informasi Layanan</h5>
                    <p data-i18n="services.menu1_desc">Informasi mengenai layanan informasi publik yang tersedia di PPID.</p>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="{{ route('berita') }}" class="menu-card d-block text-decoration-none">
                    <div class="icon-circle" style="background: linear-gradient(135deg, var(--pln-cyan), var(--pln-blue))">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h5 data-i18n="services.menu2_title">Berita</h5>
                    <p data-i18n="services.menu2_desc">Baca kabar dan informasi terbaru seputar kegiatan PLTU Indramayu.</p>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="{{ route('layanan.faq') }}" class="menu-card d-block text-decoration-none">
                    <div class="icon-circle" style="background: linear-gradient(135deg, var(--pln-red), #ff5555)">
                        <i class="fas fa-circle-question"></i>
                    </div>
                    <h5 data-i18n="services.menu4_title">FAQ</h5>
                    <p data-i18n="services.menu4_desc">Temukan jawaban atas pertanyaan yang sering diajukan seputar layanan.</p>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     5. PROMO PLN MOBILE
     ============================================ -->
<section class="pln-mobile-section" id="mekanisme">
    <div class="container px-4 px-lg-5">
        <div class="row align-items-center g-5">
            {{-- Kolom kiri: teks + QR + tombol store --}}
            <div class="col-lg-7">
                <h2 class="mobile-title" data-i18n="mobile.title">Mulai Pengalaman Baru<br>di PLN Mobile</h2>
                <p class="mobile-subtitle" data-i18n="mobile.subtitle">
                    Semua keperluan listrik dan rumah dalam 1 aplikasi PLN Mobile, semua semakin mudah!
                </p>

                <div class="promo-actions d-flex flex-wrap align-items-center gap-4 mt-5">
                    <div class="qr-box">
                        <img src="{{ asset('assets/images/qr-mobile-pln.png') }}"
                            alt="QR Code Unduh PLN Mobile" width="150" height="150"
                            loading="lazy" decoding="async" draggable="false" ondragstart="return false;"
                            onerror="this.parentElement.style.display='none';">
                    </div>

                    <div class="store-badges d-flex flex-column gap-3">
                        <a href="https://play.google.com/store/apps/details?id=com.icon.pln123"
                            target="_blank" rel="noopener" class="badge-store">
                            <i class="fab fa-google-play store-icon"></i>
                            <span>
                                <small data-i18n="store.google_small">Get it on</small>
                                <strong>Google Play</strong>
                            </span>
                        </a>
                        <a href="https://apps.apple.com/nz/app/pln-mobile/id1299581030"
                            target="_blank" rel="noopener" class="badge-store">
                            <i class="fab fa-apple store-icon"></i>
                            <span>
                                <small data-i18n="store.apple_small">Download on the</small>
                                <strong>App Store</strong>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="mt-5">
                    <span class="hashtag-pill" data-i18n="mobile.hashtag">#SemuaMakinMudah</span>
                </div>
            </div>

            {{-- Kolom kanan: mockup HP (gambar aplikasi) — tampil di SEMUA
                 ukuran layar, bukan hanya desktop (d-none d-lg-block) --}}
            <div class="col-lg-5">
                <img
                    src="{{ asset('assets/images/mobile-pln.png') }}"
                    alt="Tampilan aplikasi PLN Mobile"
                    class="phone-img"
                    loading="lazy"
                    decoding="async"
                    draggable="false"
                    ondragstart="return false;"
                    onerror="this.style.display='none';"
                >
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
(function() {
    /* Hormati preferensi "reduced motion": matikan auto-play slider
       jika pengguna memilih mengurangi animasi di sistemnya. */
    var slider = document.getElementById('bannerSlider');
    if (!slider) return;
    var prefersReducedMotion = window.matchMedia &&
        window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion && window.bootstrap && window.bootstrap.Carousel) {
        window.bootstrap.Carousel.getOrCreateInstance(slider, { interval: false }).pause();
    }

    /* Sinkronisasi dot indikator kustom (.banner-dots): Bootstrap hanya
       memindahkan class .active untuk elemen di dalam .carousel-indicators,
       jadi titik kuning kita sinkronkan manual mengikuti slide aktif. */
    var dots = slider.querySelectorAll('.banner-dots [data-bs-slide-to]');
    var syncDots = function (index) {
        dots.forEach(function (dot, i) {
            dot.classList.toggle('active', i === index);
            if (i === index) {
                dot.setAttribute('aria-current', 'true');
            } else {
                dot.removeAttribute('aria-current');
            }
        });
    };
    slider.addEventListener('slide.bs.carousel', function (event) {
        syncDots(event.to);
    });
})();
</script>
@endpush
