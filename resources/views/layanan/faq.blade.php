@extends('layouts.app')

@section('title', 'E-PPID PLN — FAQ')

@section('content')
<style>
    /* =============================================
       FAQ — PERTANYAAN YANG SERING DIAJUKAN
       ============================================= */

    .faq-page {
        --faq-navy:   #0A2540;
        --faq-blue:   #004B87;
        --faq-yellow: #FFD100;
        --faq-cyan:   #00A3E0;
        --faq-bg:     #F8FAFC;
        --faq-border: #E2E8F0;
        --faq-text:   #1E293B;
        --faq-muted:  #64748B;

        background: var(--faq-bg);
        min-height: 100vh;
        color: var(--faq-text);
        padding-top: 76px;
    }

    /* ---------- Hero Header ---------- */
    .faq-hero {
        padding: 1.5rem 0 4.5rem;
        background: linear-gradient(135deg, var(--faq-navy) 0%, var(--faq-blue) 55%, #061C33 100%);
        position: relative;
        overflow: hidden;
    }

    .faq-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(255, 209, 0, 0.10) 0%, transparent 70%);
        border-radius: 50%;
    }

    .faq-hero::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.12) 0%, transparent 70%);
        border-radius: 50%;
    }

    .faq-breadcrumb {
        padding: 0 0 1.5rem;
        position: relative;
        z-index: 2;
    }

    .faq-breadcrumb .breadcrumb { background: transparent; margin: 0; padding: 0; }

    .faq-breadcrumb .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .faq-breadcrumb .breadcrumb-item a:hover { color: var(--faq-yellow); }

    .faq-breadcrumb .breadcrumb-item span {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.82rem;
        font-weight: 500;
    }

    .faq-breadcrumb .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.82rem;
        font-weight: 600;
    }

    .faq-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.35);
        content: "/";
        font-size: 0.75rem;
    }

    .faq-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #ffdd33 0%, var(--faq-yellow) 100%);
        color: var(--faq-navy);
        font-weight: 800;
        font-size: 0.68rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.45rem 1.2rem;
        border-radius: 4px;
        margin-bottom: 1.2rem;
        position: relative;
        z-index: 2;
        box-shadow: 0 4px 15px rgba(255, 209, 0, 0.25);
        border: 1px solid rgba(255, 209, 0, 0.6);
    }

    .faq-badge::before {
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

    .faq-badge i { font-size: 0.75rem; }

    .faq-hero h1 {
        font-size: 2.4rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 0.75rem;
        position: relative;
        z-index: 2;
    }

    .faq-hero h1 .accent { color: var(--faq-yellow); }

    .faq-hero .subtitle {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.75);
        max-width: 620px;
        line-height: 1.7;
        margin-bottom: 1.75rem;
        position: relative;
        z-index: 2;
    }

    /* ---------- Search Bar ---------- */
    .faq-search {
        position: relative;
        z-index: 2;
        max-width: 640px;
    }

    .faq-search input {
        width: 100%;
        background: rgba(255, 255, 255, 0.10);
        border: 1px solid rgba(255, 255, 255, 0.28);
        border-radius: 999px;
        padding: 0.95rem 3.4rem 0.95rem 3.2rem;
        color: #fff;
        font-size: 0.95rem;
        font-family: inherit;
        outline: none;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        transition: background 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease, color 0.25s ease;
    }

    .faq-search input::placeholder { color: rgba(255, 255, 255, 0.55); }

    .faq-search input:focus {
        background: rgba(255, 255, 255, 0.97);
        border-color: #fff;
        color: var(--faq-text);
        box-shadow: 0 0 0 4px rgba(255, 209, 0, 0.28);
    }

    .faq-search input:focus::placeholder { color: rgba(30, 41, 59, 0.45); }

    .faq-search .search-icon {
        position: absolute;
        left: 1.15rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.65);
        pointer-events: none;
        transition: color 0.25s ease;
    }

    .faq-search input:focus ~ .search-icon { color: var(--faq-blue); }

    .faq-search .search-clear {
        position: absolute;
        right: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        width: 26px;
        height: 26px;
        border-radius: 50%;
        display: none;
        align-items: center;
        justify-content: center;
        border: none;
        background: rgba(255, 255, 255, 0.18);
        color: #fff;
        font-size: 0.75rem;
        cursor: pointer;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .faq-search.has-value .search-clear { display: inline-flex; }

    .faq-search input:focus ~ .search-clear {
        background: rgba(10, 37, 64, 0.08);
        color: var(--faq-navy);
    }

    /* ---------- Main Card (below hero, no overlap) ---------- */
    .faq-section {
        padding: 3rem 0 4.5rem;
        background: var(--faq-bg);
    }

    .faq-card {
        background: #fff;
        border: 1px solid var(--faq-border);
        border-radius: 18px;
        padding: 2.75rem 2.5rem;
        box-shadow: 0 2px 16px rgba(15, 23, 42, 0.06);
    }

    .faq-card-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1.75rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .faq-card-header h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--faq-text);
        margin-bottom: 0.4rem;
    }

    .faq-card-header p {
        font-size: 0.9rem;
        color: var(--faq-muted);
        margin: 0;
    }

    /* ---------- Filter Kategori (Pill Buttons) ---------- */
    .faq-filters {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.6rem;
        margin-bottom: 1.25rem;
    }

    .faq-filter {
        border: 1px solid var(--faq-border);
        background: #fff;
        color: var(--faq-muted);
        font-weight: 600;
        font-size: 0.82rem;
        font-family: inherit;
        padding: 0.5rem 1.15rem;
        border-radius: 999px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .faq-filter:hover {
        border-color: var(--faq-cyan);
        color: var(--faq-cyan);
        background: rgba(0, 163, 224, 0.06);
    }

    .faq-filter.active {
        background: var(--faq-navy);
        border-color: var(--faq-navy);
        color: #fff;
        box-shadow: 0 4px 14px rgba(10, 37, 64, 0.30);
    }

    .faq-count {
        text-align: center;
        font-size: 0.78rem;
        color: var(--faq-muted);
        margin-bottom: 1.5rem;
    }

    /* ---------- Accordion ---------- */
    .faq-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .faq-item {
        background: #fff;
        border: 1px solid var(--faq-border);
        border-radius: 12px;
        overflow: hidden;
        transition: border-color 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
    }

    .faq-item:hover { border-color: var(--faq-cyan); }

    .faq-item.open {
        border-color: var(--faq-cyan);
        background: #fbfdff;
        box-shadow: 0 6px 18px rgba(0, 163, 224, 0.10);
    }

    .faq-question {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        width: 100%;
        text-align: left;
        background: transparent;
        border: none;
        padding: 1.1rem 1.35rem;
        cursor: pointer;
        font-family: inherit;
    }

    .faq-q-text {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--faq-text);
        line-height: 1.5;
    }

    .faq-q-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #F1F5F9;
        color: var(--faq-blue);
        font-size: 0.8rem;
        transition: transform 0.3s ease, background 0.3s ease, color 0.3s ease;
    }

    .faq-item.open .faq-q-icon {
        transform: rotate(180deg);
        background: var(--faq-yellow);
        color: var(--faq-navy);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transition: max-height 0.4s ease, opacity 0.35s ease;
    }

    .faq-item.open .faq-answer { opacity: 1; }

    .faq-answer-inner { padding: 0 1.35rem 1.25rem; }

    .faq-answer-inner p {
        margin: 0;
        font-size: 0.88rem;
        color: var(--faq-muted);
        line-height: 1.75;
    }

    /* ---------- Empty State ---------- */
    .faq-empty {
        display: none;
        text-align: center;
        padding: 2.75rem 1rem 2rem;
    }

    .faq-empty.show { display: block; }

    .faq-empty-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 1rem;
        border-radius: 50%;
        background: #F1F5F9;
        color: var(--faq-cyan);
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .faq-empty h4 {
        font-size: 1.05rem;
        font-weight: 800;
        color: var(--faq-text);
        margin-bottom: 0.35rem;
    }

    .faq-empty p {
        font-size: 0.85rem;
        color: var(--faq-muted);
        margin-bottom: 1.25rem;
    }

    .faq-empty-reset {
        border: 1px solid var(--faq-cyan);
        background: transparent;
        color: var(--faq-cyan);
        font-weight: 700;
        font-size: 0.82rem;
        font-family: inherit;
        padding: 0.5rem 1.4rem;
        border-radius: 999px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .faq-empty-reset:hover {
        background: var(--faq-cyan);
        color: #fff;
        box-shadow: 0 4px 14px rgba(0, 163, 224, 0.30);
    }

    /* ---------- Footer Banner (Bantuan Tambahan) ---------- */
    .faq-contact {
        margin-top: 2.5rem;
        background: linear-gradient(135deg, var(--faq-navy) 0%, var(--faq-blue) 100%);
        border-radius: 16px;
        padding: 2.25rem 2rem;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1.25rem;
        position: relative;
        overflow: hidden;
    }

    .faq-contact::before {
        content: '';
        position: absolute;
        top: -70px;
        right: -70px;
        width: 230px;
        height: 230px;
        background: radial-gradient(circle, rgba(255, 209, 0, 0.18) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .faq-contact-text { position: relative; z-index: 2; }

    .faq-contact-text h3 {
        color: #fff;
        font-weight: 800;
        font-size: 1.15rem;
        margin-bottom: 0.35rem;
    }

    .faq-contact-text p {
        color: rgba(255, 255, 255, 0.75);
        font-size: 0.88rem;
        margin: 0;
    }

    .btn-faq-contact {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--faq-yellow);
        color: var(--faq-navy);
        font-weight: 700;
        font-size: 0.9rem;
        font-family: inherit;
        padding: 0.7rem 1.8rem;
        border-radius: 999px;
        border: none;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .btn-faq-contact:hover {
        background: #fff;
        color: var(--faq-navy);
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(255, 209, 0, 0.35);
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 767.98px) {
        .faq-hero { padding: 1.5rem 0 3.25rem; }
        .faq-hero h1 { font-size: 1.65rem; }
        .faq-search input { font-size: 0.88rem; padding-left: 2.9rem; }
        .faq-section { padding: 2rem 0 3.25rem; }
        .faq-card { padding: 1.75rem 1.25rem; border-radius: 14px; }
        .faq-contact { padding: 1.75rem 1.4rem; }
    }

    /* ---------- Animation ---------- */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .faq-item {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }

    .faq-item:nth-child(1) { animation-delay: 0.05s; }
    .faq-item:nth-child(2) { animation-delay: 0.10s; }
    .faq-item:nth-child(3) { animation-delay: 0.15s; }
    .faq-item:nth-child(4) { animation-delay: 0.20s; }
    .faq-item:nth-child(5) { animation-delay: 0.25s; }
    .faq-item:nth-child(6) { animation-delay: 0.30s; }
</style>

<div class="faq-page">

    {{-- ============================================
         1. HERO / HEADER
         ============================================ --}}
    <section class="faq-hero">
        <div class="container px-4 px-lg-5">

            <div class="faq-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><span>Informasi</span></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                    </ol>
                </nav>
            </div>

            <div class="faq-badge">
                <i class="fas fa-bolt"></i> PLN NUSANTARA POWER
            </div>

            <h1>Pertanyaan yang <span class="accent">Sering Diajukan</span> (FAQ)</h1>

            <p class="subtitle">
                Temukan informasi dan jawaban cepat terkait operasional, layanan kelistrikan,
                serta program keberlanjutan PT PLN Nusantara Power UP PLTU Indramayu.
            </p>

            <div class="faq-search" id="faqSearchWrap">
                <input type="text" id="faqSearch" autocomplete="off"
                       placeholder="Cari pertanyaan&hellip; (mis. kunjungan industri, FABA)"
                       aria-label="Cari pertanyaan">
                <i class="fas fa-search search-icon"></i>
                <button type="button" class="search-clear" id="faqSearchClear" aria-label="Hapus pencarian">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

        </div>
    </section>

    {{-- ============================================
         2. MAIN CONTENT CARD
         ============================================ --}}
    <section class="faq-section">
        <div class="container px-4 px-lg-5">

            <div class="faq-card">

                <div class="faq-card-header">
                    <h2>Jelajahi Berdasarkan Kategori</h2>
                    <p>Pilih kategori atau ketik kata kunci untuk menemukan jawaban dengan cepat</p>
                </div>

                {{-- A. Filter Kategori --}}
                <div class="faq-filters" role="group" aria-label="Filter kategori FAQ">
                    <button type="button" class="faq-filter active" data-category="semua">Semua</button>
                    <button type="button" class="faq-filter" data-category="operasional">Operasional &amp; Pembangkit</button>
                    <button type="button" class="faq-filter" data-category="layanan">Layanan &amp; Kemitraan</button>
                    <button type="button" class="faq-filter" data-category="k3l">Keselamatan &amp; Lingkungan (K3L)</button>
                    <button type="button" class="faq-filter" data-category="karir">Karir &amp; Umum</button>
                </div>

                <p class="faq-count" id="faqCount" aria-live="polite"></p>

                {{-- B. Daftar Accordion FAQ --}}
                <div class="faq-list" id="faqList">

                    {{-- 1. Operasional --}}
                    <div class="faq-item" data-category="operasional">
                        <button class="faq-question" type="button" id="faq-q-1"
                                aria-expanded="false" aria-controls="faq-a-1">
                            <span class="faq-q-text">Apa peran utama PLTU Indramayu dalam sistem kelistrikan nasional?</span>
                            <span class="faq-q-icon"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer" id="faq-a-1" role="region" aria-labelledby="faq-q-1">
                            <div class="faq-answer-inner">
                                <p>PLTU UP Indramayu mengoperasikan 3 unit pembangkitan dengan total kapasitas
                                3&nbsp;x&nbsp;330&nbsp;MW (990&nbsp;MW) yang menjadi penopang beban dasar (baseload)
                                penting dalam sistem interkoneksi listrik Jawa-Madura-Bali (Jamali).</p>
                            </div>
                        </div>
                    </div>

                    {{-- 2. K3L --}}
                    <div class="faq-item" data-category="k3l">
                        <button class="faq-question" type="button" id="faq-q-2"
                                aria-expanded="false" aria-controls="faq-a-2">
                            <span class="faq-q-text">Bagaimana komitmen PLN Nusantara Power UP PLTU Indramayu terhadap lingkungan?</span>
                            <span class="faq-q-icon"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer" id="faq-a-2" role="region" aria-labelledby="faq-q-2">
                            <div class="faq-answer-inner">
                                <p>Kami menerapkan teknologi pengelolaan emisi modern, pemanfaatan FABA
                                (Fly Ash &amp; Bottom Ash) secara berkelanjutan, program co-firing biomassa,
                                serta pemantauan kualitas udara dan lingkungan sekitar secara berkala.</p>
                            </div>
                        </div>
                    </div>

                    {{-- 3. Layanan & Kemitraan --}}
                    <div class="faq-item" data-category="layanan">
                        <button class="faq-question" type="button" id="faq-q-3"
                                aria-expanded="false" aria-controls="faq-a-3">
                            <span class="faq-q-text">Apakah masyarakat dapat mengajukan permohonan kunjungan atau edukasi ke PLTU Indramayu?</span>
                            <span class="faq-q-icon"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer" id="faq-a-3" role="region" aria-labelledby="faq-q-3">
                            <div class="faq-answer-inner">
                                <p>Ya, permohonan kunjungan industri atau edukasi dapat diajukan secara resmi
                                melalui menu Kontak atau Humas PT PLN Nusantara Power UP Indramayu dengan
                                melampirkan surat permohonan instansi/kampus.</p>
                            </div>
                        </div>
                    </div>

                    {{-- 4. Layanan & Kemitraan --}}
                    <div class="faq-item" data-category="layanan">
                        <button class="faq-question" type="button" id="faq-q-4"
                                aria-expanded="false" aria-controls="faq-a-4">
                            <span class="faq-q-text">Di mana saya bisa melihat daftar layanan publik resmi dari PLTU Indramayu?</span>
                            <span class="faq-q-icon"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer" id="faq-a-4" role="region" aria-labelledby="faq-q-4">
                            <div class="faq-answer-inner">
                                <p>Daftar layanan publik dapat diakses langsung melalui menu
                                <a href="{{ route('layanan.daftar') }}">&ldquo;Layanan&rdquo;</a> pada bilah
                                navigasi utama website ini.</p>
                            </div>
                        </div>
                    </div>

                    {{-- 5. Karir & Umum --}}
                    <div class="faq-item" data-category="karir">
                        <button class="faq-question" type="button" id="faq-q-5"
                                aria-expanded="false" aria-controls="faq-a-5">
                            <span class="faq-q-text">Bagaimana cara mengajukan magang atau kerja praktik di PLTU Indramayu?</span>
                            <span class="faq-q-icon"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer" id="faq-a-5" role="region" aria-labelledby="faq-q-5">
                            <div class="faq-answer-inner">
                                <p>Permohonan magang/kerja praktik diajukan melalui surat resmi dari kampus
                                atau instansi yang ditujukan kepada PT PLN Nusantara Power UP PLTU Indramayu,
                                dengan mencantumkan data peserta, durasi, dan bidang pembimbingan yang diinginkan.</p>
                            </div>
                        </div>
                    </div>

                    {{-- 6. Karir & Umum --}}
                    <div class="faq-item" data-category="karir">
                        <button class="faq-question" type="button" id="faq-q-6"
                                aria-expanded="false" aria-controls="faq-a-6">
                            <span class="faq-q-text">Bagaimana cara mendapatkan informasi resmi tentang kegiatan dan program UP PLTU Indramayu?</span>
                            <span class="faq-q-icon"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer" id="faq-a-6" role="region" aria-labelledby="faq-q-6">
                            <div class="faq-answer-inner">
                                <p>Informasi resmi dapat diakses melalui menu Berita dan Pengumuman pada website
                                ini, serta kanal sosial media resmi PT PLN Nusantara Power.</p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Empty State --}}
                <div class="faq-empty" id="faqEmpty">
                    <div class="faq-empty-icon"><i class="fas fa-search"></i></div>
                    <h4>Tidak Ada Hasil Ditemukan</h4>
                    <p>Coba gunakan kata kunci lain atau lihat semua pertanyaan.</p>
                    <button type="button" class="faq-empty-reset" id="faqReset">
                        <i class="fas fa-rotate-left"></i> Reset Pencarian
                    </button>
                </div>

                {{-- Footer Banner: Bantuan Tambahan --}}
                <div class="faq-contact">
                    <div class="faq-contact-text">
                        <h3>Belum menemukan jawaban yang Anda cari?</h3>
                        <p>Silakan ajukan pertanyaan melalui saluran resmi PPID PT PLN Nusantara Power.</p>
                    </div>
                </div>
                </div>

            </div>

        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
    (function () {
        var searchWrap   = document.getElementById('faqSearchWrap');
        var searchInput  = document.getElementById('faqSearch');
        var searchClear  = document.getElementById('faqSearchClear');
        var items        = Array.prototype.slice.call(document.querySelectorAll('.faq-item'));
        var filterBtns   = Array.prototype.slice.call(document.querySelectorAll('.faq-filter'));
        var countEl      = document.getElementById('faqCount');
        var emptyEl      = document.getElementById('faqEmpty');
        var resetBtn     = document.getElementById('faqReset');

        var state = { category: 'semua', query: '' };

        /* ---------- Accordion (smooth drop-down, single open) ---------- */
        function setOpen(item, open) {
            var body = item.querySelector('.faq-answer');
            var btn  = item.querySelector('.faq-question');
            item.classList.toggle('open', open);
            body.style.maxHeight = open ? body.scrollHeight + 'px' : '0px';
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        }

        items.forEach(function (item) {
            item.querySelector('.faq-question').addEventListener('click', function () {
                var willOpen = !item.classList.contains('open');
                items.forEach(function (other) { if (other !== item) setOpen(other, false); });
                setOpen(item, willOpen);
            });
        });

        /* ---------- Filter + Search ---------- */
        function applyFilter() {
            var q = state.query.trim().toLowerCase();
            var visible = 0;

            items.forEach(function (item) {
                var matchCat   = state.category === 'semua' || item.getAttribute('data-category') === state.category;
                var matchQuery = !q || item.textContent.toLowerCase().indexOf(q) !== -1;
                var show       = matchCat && matchQuery;
                item.style.display = show ? '' : 'none';
                if (show) visible++;
            });

            countEl.textContent = 'Menampilkan ' + visible + ' dari ' + items.length + ' pertanyaan';
            emptyEl.classList.toggle('show', visible === 0);
        }

        filterBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                filterBtns.forEach(function (b) { b.classList.remove('active'); });
                btn.classList.add('active');
                state.category = btn.getAttribute('data-category');
                applyFilter();
            });
        });

        function clearSearch() {
            searchInput.value = '';
            searchWrap.classList.remove('has-value');
            state.query = '';
            applyFilter();
            searchInput.focus();
        }

        var debounceTimer;
        searchInput.addEventListener('input', function () {
            searchWrap.classList.toggle('has-value', searchInput.value.length > 0);
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function () {
                state.query = searchInput.value;
                applyFilter();
            }, 120);
        });

        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') clearSearch();
        });

        searchClear.addEventListener('click', clearSearch);

        resetBtn.addEventListener('click', function () {
            searchInput.value = '';
            searchWrap.classList.remove('has-value');
            state.query = '';
            state.category = 'semua';
            filterBtns.forEach(function (b) {
                b.classList.toggle('active', b.getAttribute('data-category') === 'semua');
            });
            applyFilter();
        });

        /* ---------- Keep open answers sized correctly on resize ---------- */
        window.addEventListener('resize', function () {
            items.forEach(function (item) {
                if (item.classList.contains('open')) {
                    var body = item.querySelector('.faq-answer');
                    body.style.maxHeight = body.scrollHeight + 'px';
                }
            });
        });

        applyFilter();
    })();
</script>
@endpush
