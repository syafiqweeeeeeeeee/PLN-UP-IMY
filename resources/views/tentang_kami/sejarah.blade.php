@extends('layouts.app')

@section('title', 'Sejarah - E-PPID PLN')

@section('content')
<style>
    /* =============================================
       PALETTE (spesifikasi halaman)
       Primary   : #00A3E0 (Cyan Blue)
       Secondary : #0A2540 / #102A43 (Deep Navy)
       Background: #F8FAFC / #FFFFFF
       Text      : #1E293B / #64748B
       Border    : #E2E8F0
       ============================================= */
    :root {
        --sj-accent: #00A3E0;
        --sj-navy: #0A2540;
        --sj-navy-2: #102A43;
        --sj-bg: #F8FAFC;
        --sj-white: #FFFFFF;
        --sj-text: #1E293B;
        --sj-muted: #64748B;
        --sj-border: #E2E8F0;
        /* Tinggi navbar utama (fixed-top) - acuan sticky pill nav */
        --sj-mainnav-h: 70px;
        /* Tinggi pill nav - untuk kalkulasi scroll-margin-top */
        --sj-pillnav-h: 62px;
    }

    /* =============================================
       BREADCRUMB
       ============================================= */
    .sj-breadcrumb {
        padding: 7.5rem 0 0;
        background: var(--sj-bg);
    }

    .sj-breadcrumb .crumb {
        font-size: 0.85rem;
        color: var(--sj-muted);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .sj-breadcrumb .crumb a {
        color: var(--sj-muted);
        transition: color 0.2s ease;
    }

    .sj-breadcrumb .crumb a:hover {
        color: var(--sj-accent);
    }

    .sj-breadcrumb .crumb .separator {
        color: var(--sj-border);
    }

    .sj-breadcrumb .crumb .current {
        color: var(--sj-accent);
        font-weight: 600;
    }

    /* =============================================
       HEADER SEJARAH
       ============================================= */
    .sj-header {
        background: var(--sj-bg);
        padding: 2.5rem 0 3.5rem;
        text-align: center;
    }

    .sj-header .eyebrow {
        display: inline-block;
        background: rgba(0, 163, 224, 0.1);
        color: var(--sj-accent);
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.4rem 1.2rem;
        border-radius: 30px;
        margin-bottom: 1.2rem;
    }

    .sj-header h1 {
        color: var(--sj-text);
        font-weight: 800;
        font-size: 2.5rem;
        line-height: 1.2;
        margin-bottom: 0.9rem;
    }

    .sj-header h1 span {
        color: var(--sj-accent);
    }

    .sj-header .subtitle {
        color: var(--sj-muted);
        font-size: 1.05rem;
        line-height: 1.75;
        max-width: 640px;
        margin: 0 auto;
    }

    /* =============================================
       NAVIGASI TIMELINE (PILL / TAB)
       Sticky diterapkan pada .sj-nav-wrap (pembungkus),
       BUKAN pada pill-nya: sticky hanya bisa "menempel"
       selama parent-nya masih terlihat. Karena pembungkus
       adalah anak langsung <body>, pill tetap tertahan
       di bawah navbar utama selama halaman di-scroll.
       ============================================= */
    .timeline.fixed {
        display: flex;
        pointer-events: auto; /* pill tetap bisa diklik */
        align-items: center;
        gap: 0.25rem;
        width: fit-content;
        max-width: 100%;
        margin: 0 auto 1.5rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid var(--sj-border);
        border-radius: 50px;
        padding: 0.35rem;
        box-shadow: 0 4px 20px rgba(10, 42, 67, 0.08);
    }

    .timeline.fixed .timeline-item {
        position: relative;
        white-space: nowrap;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--sj-muted);
        padding: 0.5rem 1.1rem;
        border-radius: 50px;
        cursor: pointer;
        user-select: none;
        transition: color 0.2s ease, background 0.2s ease;
    }

    .timeline.fixed .timeline-item:hover {
        color: var(--sj-navy);
        background: rgba(0, 163, 224, 0.08);
    }

    .timeline.fixed .timeline-item.active {
        color: #fff;
        background: var(--sj-accent);
        box-shadow: 0 2px 10px rgba(0, 163, 224, 0.35);
    }

    /* =============================================
       LAYOUT TIMELINE
       ============================================= */
    .sj-timeline-section {
        background: var(--sj-white);
        padding: 1rem 0 5rem;
    }

    .sj-timeline {
        position: relative;
        max-width: 860px;
        margin: 0 auto;
        padding: 2rem 0 0;
    }

    /* Garis vertikal tipis */
    .sj-timeline::before {
        content: '';
        position: absolute;
        left: 11px;
        top: 18px;
        bottom: 0;
        width: 2px;
        background: var(--sj-border);
    }

    .sj-entry {
        position: relative;
        padding: 0 0 3.5rem 3.25rem;
    }

    .sj-entry:last-child {
        padding-bottom: 0.5rem;
    }

    /* Titik timeline */
    .sj-entry::before {
        content: '';
        position: absolute;
        left: 3px;
        top: 6px;
        width: 18px;
        height: 18px;
        background: var(--sj-white);
        border: 3px solid var(--sj-accent);
        border-radius: 50%;
        box-shadow: 0 0 0 4px rgba(0, 163, 224, 0.15);
        z-index: 2;
    }

    .sj-entry.is-active::before {
        background: var(--sj-accent);
        box-shadow: 0 0 0 6px rgba(0, 163, 224, 0.18);
    }

    .sj-badge {
        display: inline-block;
        background: var(--sj-navy);
        color: #fff;
        font-weight: 700;
        font-size: 0.78rem;
        letter-spacing: 0.5px;
        padding: 0.3rem 0.9rem;
        border-radius: 20px;
        margin-bottom: 0.9rem;
    }

    .sj-entry.is-active .sj-badge {
        background: var(--sj-accent);
    }

    .sj-card {
        background: var(--sj-white);
        border: 1px solid var(--sj-border);
        border-radius: 14px;
        padding: 1.8rem 2rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
    }

    .sj-entry.is-active .sj-card {
        border-color: rgba(0, 163, 224, 0.45);
        box-shadow: 0 10px 30px rgba(10, 42, 67, 0.07);
    }

    .sj-card h3 {
        color: var(--sj-text);
        font-weight: 700;
        font-size: 1.2rem;
        line-height: 1.45;
        margin-bottom: 0.9rem;
    }

    .sj-card h3 small {
        display: block;
        color: var(--sj-muted);
        font-weight: 500;
        font-size: 0.82rem;
        letter-spacing: 0.3px;
        margin-top: 0.2rem;
    }

    .sj-card p {
        color: var(--sj-muted);
        font-size: 0.93rem;
        line-height: 1.8;
        margin-bottom: 0;
    }

    .sj-card p strong {
        color: var(--sj-text);
        font-weight: 600;
    }

    /* scroll-margin-top agar judul tidak tertutup
       navbar utama + pill nav saat di-scroll */
    .sj-entry {
        scroll-margin-top: calc(var(--sj-mainnav-h) + var(--sj-pillnav-h));
    }

    /* =============================================
       FADE INDIKATOR SCROLL (MOBILE)
       ============================================= */
    .sj-nav-wrap {
        position: sticky;
        top: var(--sj-mainnav-h);
        z-index: 1020;
        pointer-events: none;
    }

    .sj-nav-wrap::before,
    .sj-nav-wrap::after {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 42px;
        z-index: 2;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.25s ease;
    }

    .sj-nav-wrap::before {
        left: 0;
        background: linear-gradient(to right, rgba(255, 255, 255, 0.95) 20%, transparent);
    }

    .sj-nav-wrap::after {
        right: 0;
        background: linear-gradient(to left, rgba(255, 255, 255, 0.95) 20%, transparent);
    }

    .sj-nav-wrap.scroll-left::before { opacity: 1; }
    .sj-nav-wrap.scroll-right::after { opacity: 1; }

    /* =============================================
       RESPONSIVE
       ============================================= */
    @media (max-width: 991.98px) {
        :root {
            --sj-mainnav-h: 62px;
        }

        .timeline.fixed {
            width: auto;
            max-width: 100%;
            margin: 0;
            border-radius: 0;
            border-left: none;
            border-right: none;
            gap: 0.375rem;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
            white-space: nowrap;
            padding: 0.5rem 1rem;
        }

        .timeline.fixed::-webkit-scrollbar {
            display: none;
        }

        .timeline.fixed .timeline-item {
            flex: 0 0 auto;
            scroll-snap-align: center;
        }
    }

    @media (max-width: 767.98px) {
        .sj-breadcrumb {
            padding: 5.5rem 0 0.75rem;
        }

        .sj-breadcrumb .crumb {
            font-size: 0.78rem;
        }

        .sj-header {
            padding: 1rem 0 2rem;
        }

        .sj-header h1 {
            font-size: 1.5rem;
            line-height: 1.35;
        }

        .sj-header .subtitle {
            font-size: 0.88rem;
        }

        .timeline.fixed {
            margin-bottom: 1.75rem;
        }

        .timeline.fixed .timeline-item {
            font-size: 0.78rem;
            padding: 0.4rem 0.9rem;
        }

        .sj-card {
            padding: 1.4rem 1.2rem;
        }

        .sj-card h3 {
            font-size: 1.05rem;
        }
    }

    /* =============================================
       SHARED TK CLASSES (inline dari tentang-kami.css)
       ============================================= */
    .tk-breadcrumb {
        padding-top: 6.25rem;
        padding-bottom: 0;
        background: #F8FAFC;
    }
    .tk-breadcrumb .crumb {
        font-size: 0.85rem;
        color: #94A3B8;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .tk-breadcrumb .crumb a { color: #94A3B8; transition: color 0.2s ease; }
    .tk-breadcrumb .crumb a:hover { color: #00A3E0; }
    .tk-breadcrumb .crumb .separator { color: #CBD5E1; }
    .tk-breadcrumb .crumb .current { color: #00A3E0; font-weight: 600; }

    .tk-section-header {
        background: #F8FAFC;
        padding: 2.5rem 0 3rem;
        text-align: center;
    }
    .tk-eyebrow {
        display: inline-block;
        background: rgba(0, 163, 224, 0.1);
        color: #00A3E0;
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.4rem 1.2rem;
        border-radius: 30px;
        margin-bottom: 1.2rem;
    }
    .tk-header-title {
        color: #1E293B;
        font-weight: 800;
        font-size: 2.4rem;
        line-height: 1.2;
        margin-bottom: 0.9rem;
    }
    .tk-header-title .highlight { color: #00A3E0; }
    .tk-header-desc {
        color: #64748B;
        font-size: 1.05rem;
        line-height: 1.75;
        max-width: 640px;
        margin: 0 auto;
    }

    .tk-timeline-pills-wrap {
        position: sticky;
        top: 70px;
        z-index: 1020;
        pointer-events: none;
    }
    .tk-timeline-pills {
        display: flex;
        pointer-events: auto;
        align-items: center;
        gap: 0.25rem;
        width: fit-content;
        max-width: 100%;
        margin: 0 auto 1.5rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid #E2E8F0;
        border-radius: 50px;
        padding: 0.35rem;
        box-shadow: 0 4px 20px rgba(10, 42, 67, 0.08);
    }
    .tk-timeline-pills .tk-pill {
        position: relative;
        white-space: nowrap;
        font-size: 0.82rem;
        font-weight: 600;
        color: #64748B;
        padding: 0.5rem 1.1rem;
        border-radius: 50px;
        cursor: pointer;
        user-select: none;
        transition: color 0.2s ease, background 0.2s ease;
        text-decoration: none;
    }
    .tk-timeline-pills .tk-pill:hover { color: #0A2540; background: rgba(0, 163, 224, 0.08); }
    .tk-timeline-pills .tk-pill.active {
        color: #fff;
        background: #00A3E0;
        box-shadow: 0 2px 10px rgba(0, 163, 224, 0.35);
    }

    .tk-timeline-section {
        background: #FFFFFF;
        padding: 1rem 0 5rem;
    }
    .tk-timeline {
        position: relative;
        max-width: 860px;
        margin: 0 auto;
        padding: 2rem 0 0;
    }
    .tk-timeline::before {
        content: '';
        position: absolute;
        left: 11px;
        top: 18px;
        bottom: 0;
        width: 2px;
        background: #E2E8F0;
    }
    .tk-entry {
        position: relative;
        padding: 0 0 3.5rem 3.25rem;
        scroll-margin-top: 130px;
    }
    .tk-entry:last-child { padding-bottom: 0.5rem; }
    .tk-entry::before {
        content: '';
        position: absolute;
        left: 3px;
        top: 6px;
        width: 18px;
        height: 18px;
        background: #FFFFFF;
        border: 3px solid #00A3E0;
        border-radius: 50%;
        box-shadow: 0 0 0 4px rgba(0, 163, 224, 0.15);
        z-index: 2;
    }
    .tk-entry.is-active::before {
        background: #00A3E0;
        box-shadow: 0 0 0 6px rgba(0, 163, 224, 0.18);
    }
    .tk-badge {
        display: inline-block;
        background: #0A2540;
        color: #fff;
        font-weight: 700;
        font-size: 0.78rem;
        letter-spacing: 0.5px;
        padding: 0.3rem 0.9rem;
        border-radius: 20px;
        margin-bottom: 0.9rem;
    }
    .tk-entry.is-active .tk-badge { background: #00A3E0; }
    .tk-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 1.8rem 2rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
    }
    .tk-entry.is-active .tk-card {
        border-color: rgba(0, 163, 224, 0.45);
        box-shadow: 0 10px 30px rgba(10, 42, 67, 0.07);
    }
    .tk-card h3 { color: #1E293B; font-weight: 700; font-size: 1.2rem; line-height: 1.45; margin-bottom: 0.9rem; }
    .tk-card h3 small { display: block; color: #64748B; font-weight: 500; font-size: 0.82rem; letter-spacing: 0.3px; margin-top: 0.2rem; }
    .tk-card p { color: #64748B; font-size: 0.93rem; line-height: 1.8; margin-bottom: 0; }
    .tk-card p strong { color: #1E293B; font-weight: 600; }

    @media (max-width: 991.98px) {
        .tk-header-title { font-size: 1.9rem; }
        .tk-timeline-pills {
            width: auto;
            max-width: 100%;
            margin: 0;
            border-radius: 0;
            border-left: none;
            border-right: none;
            gap: 0.375rem;
            overflow-x: auto;
            scrollbar-width: none;
            white-space: nowrap;
            padding: 0.5rem 1rem;
        }
        .tk-timeline-pills .tk-pill { flex: 0 0 auto; font-size: 0.78rem; padding: 0.4rem 0.9rem; }
    }
    @media (max-width: 767.98px) {
        .tk-breadcrumb { padding-top: 5.5rem; }
        .tk-section-header { padding: 1.5rem 0 2rem; }
        .tk-header-title { font-size: 1.5rem; line-height: 1.35; }
        .tk-header-desc { font-size: 0.88rem; }
        .tk-timeline-pills-wrap { top: 62px; }
        .tk-timeline { padding: 1.5rem 0 0; }
        .tk-card { padding: 1.4rem 1.2rem; }
        .tk-card h3 { font-size: 1.05rem; }
        .tk-entry { padding: 0 0 2.5rem 2.6rem; scroll-margin-top: 120px; }
        .tk-entry::before { left: 3px; top: 6px; width: 16px; height: 16px; }
        .tk-timeline::before { left: 10px; top: 16px; }
    }
</style>

    

    

    

    

    

{{-- =============================================
     BREADCRUMB
     ============================================= --}}
<div class="sj-breadcrumb tk-breadcrumb">
    <div class="container">
        <nav class="crumb" aria-label="breadcrumb">
            <a href="{{ route('home') }}" data-i18n="sejarah.breadcrumb_about">Tentang Kami</a>
            <span class="separator">/</span>
            <span class="current" data-i18n="sejarah.breadcrumb_current">Sejarah Perusahaan</span>
        </nav>
    </div>
</div>

{{-- =============================================
     HEADER SEJARAH
     ============================================= --}}
<header class="sj-header tk-section-header">
    <div class="container">
        <span class="eyebrow tk-eyebrow" data-i18n="sejarah.eyebrow">Tentang Kami</span>
        <h1 class="tk-header-title" data-i18n="sejarah.title">Sejarah &amp; <span class="highlight">Jejak Langkah</span> Perusahaan</h1>
        <p class="subtitle tk-header-desc" data-i18n="sejarah.subtitle">
            Perjalanan Transformasi PT PLN Nusantara Power dalam Membangun Negeri dari Masa ke Masa.
        </p>
    </div>
</header>

{{-- =============================================
     NAVIGASI TIMELINE STICKY (PILL)
     ============================================= --}}
<div class="sj-nav-wrap tk-timeline-pills-wrap">
    <div class="timeline fixed tk-timeline-pills" id="timeline-navbar">
        <div class="timeline-item tk-pill" data-target="section1995">1995</div>
        <div class="timeline-item tk-pill" data-target="section2000">2000-2010</div>
        <div class="timeline-item tk-pill" data-target="section2011">2011-2015</div>
        <div class="timeline-item tk-pill" data-target="section2016">2016-2024</div>
        <div class="timeline-item tk-pill" data-target="section2024">2024-2028</div>
    </div>
</div>

{{-- =============================================
     KONTEN TIMELINE
     ============================================= --}}
<section class="sj-timeline-section tk-timeline-section">
    <div class="container">
        <div class="sj-timeline tk-timeline">

            {{-- 1995 --}}
            <article class="sj-entry tk-entry" id="section1995">
                <span class="sj-badge tk-badge">1995</span>
                <div class="sj-card tk-card">
                    <h3 data-i18n="sejarah.s1_title">
                        Pendirian Perusahaan &amp; Fondasi Awal
                        <small data-i18n="sejarah.s1_sub">Company Establishment</small>
                    </h3>
                    <p data-i18n="sejarah.s1_desc">
                        Perjalanan resmi perusahaan dimulai pada tahun 1995 ketika PT PLN (Persero)
                        mendirikan anak perusahaan ini untuk mengelola aset-aset pembangkitan listrik
                        di wilayah Indonesia. Pada awal berdirinya, perusahaan langsung dipercayakan
                        mengoperasikan <strong>5 Unit Pembangkitan (UP) utama</strong> dengan total
                        kapasitas terpasang sebesar <strong>5.068 MW</strong>. Sebagai bagian dari
                        komitmen tata kelola pembangkit modern sejak hari pertama, perusahaan
                        mengadopsi sistem <strong>Computerized Maintenance Management Systems (CMMS)</strong>.
                        Penerapan teknologi CMMS ini menjadi fondasi digital pertama perusahaan dalam
                        memantau, merencanakan, dan mengeksekusi pemeliharaan aset secara terstruktur
                        demi menjaga tingkat keandalan suplai listrik nasional.
                    </p>
                </div>
            </article>

            {{-- 2000 – 2010 --}}
            <article class="sj-entry tk-entry" id="section2000">
                <span class="sj-badge tk-badge">2000 – 2010</span>
                <div class="sj-card tk-card">
                    <h3 data-i18n="sejarah.s2_title">
                        Dekade Pertumbuhan dan Ekspansi Bisnis
                        <small data-i18n="sejarah.s2_sub">Stable Growth</small>
                    </h3>
                    <p data-i18n="sejarah.s2_desc">
                        Memasuki rentang tahun 2000 hingga 2010, perusahaan mengalami pertumbuhan yang
                        stabil dan ekspansif. Kapasitas total meningkat secara signifikan dari
                        <strong>5.068 MW menjadi 6.469 MW</strong> seiring dengan pelimpahan aset
                        strategis berupa <strong>PLTA Cirata Unit 5–8</strong> dan
                        <strong>PLTGU Muara Tawar</strong>. Pada periode ini, perusahaan memperluas
                        jangkauan bisnis dengan membentuk anak perusahaan dan perusahaan afiliasi,
                        melakukan penyertaan saham pada <strong>Independent Power Producer (IPP)</strong>
                        seperti S2P dan BDSN, serta mengukuhkan posisi sebagai penyedia standar terbaik
                        <strong>(best practice)</strong> dalam layanan Jasa Operasi dan Pemeliharaan (O&amp;M)
                        bagi industri ketenagalistrikan.
                    </p>
                </div>
            </article>

            {{-- 2011 – 2015 --}}
            <article class="sj-entry tk-entry" id="section2011">
                <span class="sj-badge tk-badge">2011 – 2015</span>
                <div class="sj-card tk-card">
                    <h3 data-i18n="sejarah.s3_title">
                        Pencapaian Standar Internasional &amp; Keunggulan Operasional
                        <small data-i18n="sejarah.s3_sub">Operational Excellence</small>
                    </h3>
                    <p data-i18n="sejarah.s3_desc">
                        Pada kurun waktu 2011 hingga 2015, perusahaan mencatatkan sejarah sebagai
                        <strong>entitas pertama di Asia Pasifik</strong> yang meraih sertifikasi
                        <strong>ISO 55001 Sistem Manajemen Aset</strong>. Keunggulan operasional ini
                        mengantarkan perusahaan meraih predikat <strong>Emerging Industry Leader Band</strong>
                        pada kriteria Malcolm Baldrige, serta menempatkan unit-unit utamanya—seperti
                        UP Gresik, UP Paiton, UP Muara Karang, dan UP Cirata—masuk ke dalam jajaran
                        <strong>Top 10% keandalan internasional versi NERC</strong> (North American
                        Electric Reliability Corporation). Selain itu, perusahaan berhasil mengoperasikan
                        fasilitas <strong>Compressed Natural Gas (CNG) Pembangkit terbesar di dunia</strong>
                        serta dianugerahi <strong>Platinum Award</strong> atas komitmen Tanggung Jawab
                        Sosial dan Lingkungan (CSR) di Indonesia.
                    </p>
                </div>
            </article>

            {{-- 2016 – 2024 --}}
            <article class="sj-entry tk-entry" id="section2016">
                <span class="sj-badge tk-badge">2016 – 2024</span>
                <div class="sj-card tk-card">
                    <h3 data-i18n="sejarah.s4_title">
                        Transformasi Korporasi Berkelanjutan &amp; Era Sub-Holding
                        <small data-i18n="sejarah.s4_sub">Corporate Transformation I &amp; II</small>
                    </h3>
                    <p data-i18n="sejarah.s4_desc">
                        Dalam rentang tahun 2016 hingga 2024, perusahaan melewati dua gelombang
                        transformasi besar. Pada fase <strong>Corporate Transformation I</strong>,
                        perusahaan mengonsolidasikan PJB Group berbasis aset <strong>(Asset Based)</strong>
                        dengan memadukan keunggulan operasional dan bisnis, hingga meraih predikat
                        <strong>Malcolm Baldrige Industry Leader Band</strong>. Memasuki fase
                        <strong>Corporate Transformation II</strong> dan restrukturisasi Holding
                        Sub-Holding PLN Group, PT PJB secara resmi bertransformasi menjadi
                        <strong>PT PLN Nusantara Power</strong>. Perusahaan mengubah pola bisnisnya
                        menjadi berbasis investasi <strong>(Investment Based)</strong> untuk kesiapan
                        masa depan <strong>(Future Proof)</strong> sekaligus mengekspansi kapasitas
                        portofolio pembangkitan secara masif di seluruh Indonesia.
                    </p>
                </div>
            </article>

            {{-- 2024 – 2028 --}}
            <article class="sj-entry tk-entry" id="section2024">
                <span class="sj-badge tk-badge">2024 – 2028</span>
                <div class="sj-card tk-card">
                    <h3 data-i18n="sejarah.s5_title">
                        Penguatan Basis, Ekspansi Pasar, dan Keberlanjutan
                        <small data-i18n="sejarah.s5_sub">Strengthening The Base, Expanding The Business</small>
                    </h3>
                    <p data-i18n="sejarah.s5_desc">
                        Untuk periode tahun 2024 hingga 2028, perusahaan memfokuskan strategi pada
                        penguatan basis operasional sekaligus ekspansi bisnis secara berkelanjutan.
                        Langkah ini dijalankan melalui <strong>akselerasi transformasi digital</strong>
                        yang terintegrasi penuh dengan keunggulan operasional demi mendorong pertumbuhan
                        <strong>(growth)</strong> bisnis dan ekspansi portofolio <strong>EBT</strong>.
                        Seluruh pilar kebijakan pada rentang tahun ini dikomitmenkan untuk mendukung
                        target <strong>emisi nol bersih (Net Zero Emission)</strong> serta menjaga
                        keberlanjutan bisnis dan lingkungan <strong>(Sustainability)</strong> jangka
                        panjang melalui penerapan prinsip <strong>ESG</strong>.
                    </p>
                </div>
            </article>

        </div>
    </div>
</section>

<script>
    (function () {
        'use strict';

        var navItems = document.querySelectorAll('#timeline-navbar .timeline-item');
        var sections = Array.prototype.map.call(navItems, function (item) {
            return document.getElementById(item.getAttribute('data-target'));
        }).filter(Boolean);

        if (!sections.length) return;

        /* ---------------------------------------------
           Smooth Scroll saat pill diklik
           --------------------------------------------- */
        navItems.forEach(function (item) {
            item.addEventListener('click', function () {
                var target = document.getElementById(item.getAttribute('data-target'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        /* ---------------------------------------------
           Indikator fade + auto-center pill aktif
           --------------------------------------------- */
        var navEl = navItems.length ? navItems[0].parentElement : null;
        var navWrap = document.querySelector('.sj-nav-wrap');

        var updateFades = function () {
            if (!navEl || !navWrap) return;
            navWrap.classList.toggle('scroll-left', navEl.scrollLeft > 4);
            navWrap.classList.toggle('scroll-right',
                navEl.scrollLeft + navEl.clientWidth < navEl.scrollWidth - 4);
        };

        var centerPill = function (item) {
            if (!navEl || navEl.scrollWidth <= navEl.clientWidth) return;
            var target = item.offsetLeft - (navEl.clientWidth - item.offsetWidth) / 2;
            navEl.scrollTo({ left: target, behavior: 'smooth' });
        };

        if (navEl) {
            navEl.addEventListener('scroll', updateFades, { passive: true });
            window.addEventListener('resize', updateFades);
            updateFades();
        }

        /* ---------------------------------------------
           ScrollSpy: tandai pill + entry yang aktif
           --------------------------------------------- */
        var currentId = null;

        var setActive = function (id) {
            if (id === currentId) return;
            currentId = id;

            navItems.forEach(function (item) {
                item.classList.toggle('active', item.getAttribute('data-target') === id);
            });
            document.querySelectorAll('.sj-entry').forEach(function (entry) {
                entry.classList.toggle('is-active', entry.id === id);
            });

            var activeItem = document.querySelector('#timeline-navbar .timeline-item.active');
            if (activeItem) centerPill(activeItem);
        };

        var spyOnScroll = function () {
            var offset = 140; /* navbar utama + pill nav sticky */
            var current = sections[0].id;

            sections.forEach(function (section) {
                if (section.getBoundingClientRect().top <= offset) {
                    current = section.id;
                }
            });

            /* Di dasar halaman, aktifkan section terakhir */
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 4) {
                current = sections[sections.length - 1].id;
            }

            setActive(current);
        };

        window.addEventListener('scroll', spyOnScroll, { passive: true });
        window.addEventListener('resize', spyOnScroll);
        spyOnScroll();
    })();
</script>
@endsection
