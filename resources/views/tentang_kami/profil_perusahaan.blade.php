@extends('layouts.app')

@section('title', 'Profil Perusahaan — PLN Nusantara Power Unit Pembangkitan Indramayu')

@section('content')
<link rel="stylesheet" href="{{ asset('css/tentang-kami.css') }}">

<style>
    /* =============================================
       PROFIL PERUSAHAAN — PLN UP INDRAMAYU
       ============================================= */

    /* --- Hero --- */
    .profile-hero {
        background: linear-gradient(135deg, var(--pln-blue) 0%, #003d6b 50%, var(--pln-dark) 100%);
        min-height: 480px;
        position: relative;
        overflow: hidden;
    }

    .profile-hero::before {
        content: '';
        position: absolute;
        top: -60%;
        right: -30%;
        width: 700px;
        height: 700px;
        background: radial-gradient(circle, rgba(255, 230, 0, 0.12) 0%, transparent 65%);
        border-radius: 50%;
        animation: heroGlow 8s ease-in-out infinite alternate;
    }

    .profile-hero::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: -20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.1) 0%, transparent 65%);
        border-radius: 50%;
        animation: heroGlow2 10s ease-in-out infinite alternate;
    }

    @keyframes heroGlow {
        0%   { transform: translate(0, 0) scale(1); }
        100% { transform: translate(-40px, 30px) scale(1.1); }
    }

    @keyframes heroGlow2 {
        0%   { transform: translate(0, 0) scale(1); }
        100% { transform: translate(30px, -40px) scale(1.15); }
    }

    .hero-content { position: relative; z-index: 2; }

    .company-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.45rem 1.2rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--pln-blue);
        background: var(--pln-yellow);
        box-shadow: 0 4px 15px rgba(255, 230, 0, 0.3);
        animation: fadeInDown 0.6s ease;
    }

    .company-logo-ring {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: var(--pln-yellow);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 900;
        color: var(--pln-blue);
        box-shadow: 0 15px 50px rgba(0, 91, 156, 0.35);
        border: 5px solid rgba(255, 255, 255, 0.25);
        animation: logoPulse 3s ease-in-out infinite;
        flex-shrink: 0;
    }

    @keyframes logoPulse {
        0%, 100% { box-shadow: 0 15px 50px rgba(0, 91, 156, 0.35); }
        50%      { box-shadow: 0 15px 60px rgba(0, 91, 156, 0.55); }
    }

    .hero-title {
        font-size: 2.8rem;
        font-weight: 900;
        color: #fff;
        line-height: 1.15;
        margin-bottom: 0.75rem;
    }

    .hero-title span { color: var(--pln-yellow); }

    .hero-subtitle {
        font-size: 1.05rem;
        color: rgba(255, 255, 255, 0.75);
        line-height: 1.7;
        max-width: 550px;
    }

    .hero-stats {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        margin-top: 2rem;
    }

    .hero-stat {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 14px;
        padding: 1rem 1.25rem;
        text-align: center;
        min-width: 100px;
        transition: all 0.3s ease;
    }

    .hero-stat:hover {
        background: rgba(255, 255, 255, 0.14);
        transform: translateY(-2px);
        border-color: var(--pln-yellow);
    }

    .hero-stat .number {
        font-size: 1.6rem;
        font-weight: 900;
        color: var(--pln-yellow);
        line-height: 1.2;
    }

    .hero-stat .label {
        font-size: 0.7rem;
        color: rgba(255, 255, 255, 0.6);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 0.25rem;
    }

    /* --- Info Cards --- */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .info-card {
        background: #fff;
        border-radius: 16px;
        padding: 1.75rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #f3f4f6;
        transition: all 0.35s ease;
        cursor: default;
        position: relative;
        overflow: hidden;
    }

    .info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--pln-cyan), var(--pln-blue));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .info-card:hover::before { transform: scaleX(1); }

    .info-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 48px rgba(0, 91, 156, 0.15);
        border-color: rgba(0, 163, 224, 0.2);
    }

    .info-card .card-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: #fff;
        margin-bottom: 1.25rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .info-card:hover .card-icon {
        transform: scale(1.08) rotate(-3deg);
        box-shadow: 0 8px 20px rgba(0, 91, 156, 0.3);
    }

    .info-card h3 {
        color: var(--pln-blue);
        font-weight: 800;
        font-size: 1.15rem;
        margin: 0 0 0.75rem;
    }

    .info-card p {
        color: #555;
        font-size: 0.92rem;
        line-height: 1.8;
        margin: 0;
    }

    .info-card .highlight { color: var(--pln-blue); font-weight: 700; }

    /* --- Section Titles --- */
    .section-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--pln-blue);
        text-align: center;
        margin-bottom: 0.5rem;
    }

    .section-subtitle {
        color: #777;
        font-size: 1rem;
        text-align: center;
        margin-bottom: 2.5rem;
        max-width: 650px;
        margin-left: auto;
        margin-right: auto;
    }

    /* --- Capacity / Stats Bar --- */
    .capacity-section {
        background: linear-gradient(135deg, var(--pln-blue) 0%, #003d6b 100%);
        border-radius: 20px;
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
    }

    .capacity-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255, 230, 0, 0.08) 0%, transparent 70%);
        border-radius: 50%;
    }

    .capacity-item {
        text-align: center;
        padding: 1.5rem 1rem;
        position: relative;
        z-index: 2;
    }

    .capacity-item:not(:last-child)::after {
        content: '';
        position: absolute;
        right: 0;
        top: 10%;
        bottom: 10%;
        width: 1px;
        background: rgba(255, 255, 255, 0.12);
    }

    .capacity-number {
        font-size: 2.8rem;
        font-weight: 900;
        color: var(--pln-yellow);
        line-height: 1.1;
        display: block;
    }

    .capacity-label {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 0.4rem;
        display: block;
    }

    /* --- Location Info Box --- */
    .location-box {
        background: linear-gradient(135deg, var(--pln-blue) 0%, #003d6b 100%);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 16px;
        padding: 1.5rem;
        margin-top: 2rem;
        transition: border-color 0.3s ease;
    }

    .location-box:hover {
        border-color: rgba(255, 230, 0, 0.4);
    }

    .loc-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 0.6rem 0;
    }

    .loc-item:not(:last-child) { border-bottom: 1px solid rgba(255, 255, 255, 0.08); }

    .loc-item .loc-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--pln-yellow);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--pln-blue);
        font-size: 1rem;
        flex-shrink: 0;
    }

    .loc-item .loc-label {
        font-size: 0.7rem;
        color: rgba(255, 255, 255, 0.5);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.15rem;
    }

    .loc-item .loc-value {
        color: #fff;
        font-weight: 600;
        font-size: 0.95rem;
    }

    /* --- Business / Role Cards --- */
    .role-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.25rem;
    }

    .role-card {
        background: var(--pln-gray);
        border-radius: 14px;
        padding: 1.5rem;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        cursor: default;
    }

    .role-card:hover {
        border-color: var(--pln-cyan);
        background: #fff;
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0, 163, 224, 0.12);
    }

    .role-card .unit-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 1rem;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        color: #fff;
        transition: transform 0.3s ease;
    }

    .role-card:hover .unit-icon { transform: scale(1.1); }

    .role-card .unit-icon.primary  { background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan)); }
    .role-card .unit-icon.green    { background: linear-gradient(135deg, #10b981, #059669); }
    .role-card .unit-icon.orange    { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .role-card .unit-icon.purple    { background: linear-gradient(135deg, #8b5cf6, #6d28d9); }

    .role-card h4 {
        color: var(--pln-blue);
        font-weight: 700;
        font-size: 1.05rem;
        margin: 0 0 0.5rem;
        text-align: center;
    }

    .role-card p {
        color: #666;
        font-size: 0.85rem;
        line-height: 1.6;
        margin: 0;
    }

    /* --- Timeline --- */
    .timeline-wrapper { position: relative; padding: 2.5rem 0; }

    .timeline-track {
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, var(--pln-cyan), var(--pln-blue), var(--pln-dark));
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .timeline-dot {
        position: absolute;
        left: 50%;
        width: 22px;
        height: 22px;
        background: var(--pln-yellow);
        border: 4px solid var(--pln-blue);
        border-radius: 50%;
        transform: translateX(-50%);
        z-index: 3;
        box-shadow: 0 0 0 8px rgba(255, 230, 0, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .timeline-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 3rem;
        position: relative;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.6s ease forwards;
    }

    .timeline-item:nth-child(1) { animation-delay: 0.1s; }
    .timeline-item:nth-child(2) { animation-delay: 0.2s; }
    .timeline-item:nth-child(3) { animation-delay: 0.3s; }
    .timeline-item:nth-child(4) { animation-delay: 0.4s; }
    .timeline-item:nth-child(5) { animation-delay: 0.5s; }

    .timeline-item:nth-child(odd) {
        flex-direction: row;
        padding-right: calc(50% + 50px);
        text-align: right;
    }

    .timeline-item:nth-child(even) {
        flex-direction: row-reverse;
        padding-left: calc(50% + 50px);
        text-align: left;
    }

    .timeline-item:hover .timeline-dot {
        transform: translateX(-50%) scale(1.25);
        box-shadow: 0 0 0 10px rgba(255, 230, 0, 0.25);
    }

    .timeline-card {
        background: #fff;
        padding: 1.5rem;
        border-radius: 14px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        border-left: 4px solid var(--pln-cyan);
        transition: all 0.3s ease;
    }

    .timeline-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 91, 156, 0.12);
    }

    .timeline-year {
        display: inline-block;
        padding: 0.2rem 0.7rem;
        background: var(--pln-yellow);
        color: var(--pln-blue);
        border-radius: 20px;
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.3px;
        margin-bottom: 0.5rem;
    }

    .timeline-card h4 {
        color: var(--pln-blue);
        font-weight: 700;
        margin: 0 0 0.4rem;
        font-size: 0.98rem;
    }

    .timeline-card p {
        color: #666;
        font-size: 0.85rem;
        line-height: 1.7;
        margin: 0;
    }

    /* --- CTA --- */
    .cta-section {
        background: linear-gradient(135deg, var(--pln-blue), #003d6b);
        border-radius: 20px;
        padding: 3rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '⚡';
        position: absolute;
        font-size: 12rem;
        opacity: 0.05;
        top: -20px;
        right: -20px;
        transform: rotate(15deg);
    }

    .cta-section .cta-icon {
        font-size: 3rem;
        color: var(--pln-yellow);
        margin-bottom: 1rem;
        display: block;
    }

    .cta-section h3 {
        color: #fff;
        font-weight: 800;
        font-size: 1.6rem;
        margin-bottom: 0.5rem;
    }

    .cta-section p {
        color: rgba(255, 255, 255, 0.75);
        font-size: 0.95rem;
        margin-bottom: 2rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-cta {
        display: inline-block;
        background: var(--pln-yellow);
        color: var(--pln-blue);
        font-weight: 800;
        padding: 0.85rem 2.2rem;
        border-radius: 30px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        font-size: 0.95rem;
    }

    .btn-cta:hover {
        background: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(255, 230, 0, 0.4);
        color: var(--pln-blue);
    }

    /* --- Animations --- */
    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-15px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* --- Responsive --- */
    @media (max-width: 991.98px) {
        .hero-title { font-size: 2.2rem; }
        .timeline-track { left: 24px; }
        .timeline-item {
            padding-left: 60px !important;
            padding-right: 0 !important;
            text-align: left !important;
        }
        .timeline-dot { left: 24px; }
        .capacity-item:not(:last-child)::after { display: none; }
    }

    @media (max-width: 767.98px) {
        .profile-hero { min-height: 400px; }
        .hero-title { font-size: 1.8rem; }
        .company-logo-ring { width: 110px; height: 110px; font-size: 2.2rem; }
        .hero-stats { gap: 0.75rem; }
        .hero-stat { padding: 0.75rem 0.9rem; min-width: 70px; }
        .hero-stat .number { font-size: 1.2rem; }
        .section-title { font-size: 1.5rem; }
        .capacity-number { font-size: 2rem; }
    }
</style>

<!-- ============================================
     HERO SECTION
     ============================================ -->
<section class="profile-hero tk-section-header">
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-7 hero-content">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <span class="company-badge tk-eyebrow">
                        <i class="fas fa-bolt"></i>Unit Pembangkitan
                    </span>
                </div>

                <div class="d-flex align-items-center gap-4 mb-4">
                    <div class="company-logo-ring">UP</div>
                    <div>
                        <h1 class="hero-title tk-header-title">
                            PLN Nusantara Power<br>
                            <span>Unit Pembangkitan Indramayu</span>
                        </h1>
                        <p class="hero-subtitle tk-header-desc">
                            Satu dari unit pembangkitan PT PLN Nusantara Power, 
                            mengoperasikan <strong>PLTU di Sumuradem, Indramayu</strong> 
                            untuk mendukung penyediaan energi listrik di Indonesia.
                        </p>
                        <div class="hero-stats">
                            <div class="hero-stat">
                                <span class="number">990</span>
                                <span class="label">MW Kapasitas Terpasang</span>
                            </div>
                            <div class="hero-stat">
                                <span class="number">3</span>
                                <span class="label">Unit Pembangkit (330 MW)</span>
                            </div>
                            <div class="hero-stat">
                                <span class="number">83 ha</span>
                                <span class="label">Luas Area Pembangkit</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 mt-5 mt-lg-0">
                <div class="info-grid">
                    <div class="info-card reveal">
                        <div class="card-icon">
                            <i class="fas fa-industry"></i>
                        </div>
                        <h3>Unit Pembangkitan</h3>
                        <p>
                            <strong class="highlight">PLN Nusantara Power Unit Pembangkitan Indramayu (UP Indramayu)</strong> 
                            merupakan unit pembangkitan di bawah PT PLN Nusantara Power, bergerak dalam bidang 
                            penyediaan tenaga listrik melalui pengoperasian <strong>Pembangkit Listrik Tenaga Uap (PLTU)</strong>.
                        </p>
                    </div>

                    <div class="info-card reveal">
                        <div class="card-icon">
                            <i class="fas fa-fire"></i>
                        </div>
                        <h3>PLTU Batubara</h3>
                        <p>
                            Pembangkit ini menggunakan <strong>batubara</strong> sebagai bahan bakar utama, 
                            dengan kapasitas terpasang sebesar <strong>990 MW</strong> yang terdiri dari 
                            <strong>tiga unit pembangkit</strong> masing-masing berkapasitas 330 MW.
                        </p>
                    </div>

                    <div class="info-card reveal">
                        <div class="card-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h3>Komitmen Keberlanjutan</h3>
                        <p>
                            UP Indramayu terus berkomitmen menjaga keandalan dan efisiensi pembangkitan melalui 
                            pengelolaan operasional &amp; pemeliharaan optimal, dengan tetap memperhatikan 
                            <strong>keselamatan, lingkungan, dan keberlanjutan</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Spacer --}}
<div class="container my-5"></div>

<!-- ============================================
     TENTANG UNIT PEMBANGKITAN
     ============================================ -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="section-title tk-header-title">Tentang UP Indramayu</h2>
                <p class="section-subtitle tk-header-desc">
                    Kenali lebih dekat Unit Pembangkitan Indramayu — peran strategisnya dalam 
                    sistem kelistrikan Jawa-Bali dan komitmen terhadap operasional yang andal, aman, dan berkelanjutan.
                </p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="info-card reveal" style="border-top: 4px solid var(--pln-cyan);">
                    <div class="card-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Peran Strategis di Sistem Jawa-Bali</h3>
                    <p>
                        Sebagai salah satu unit pembangkitan <strong class="highlight">PLN Nusantara Power</strong>, 
                        UP Indramayu memiliki peran strategis dalam mendukung <strong>keandalan pasokan listrik</strong>, 
                        khususnya dalam sistem kelistrikan <strong>Jawa-Bali</strong>.
                    </p>
                    <p style="margin-top: 0.75rem;">
                        Dengan kapasitas pembangkitan yang besar, UP Indramayu berkontribusi dalam memenuhi 
                        <strong>kebutuhan energi listrik masyarakat</strong> sekaligus mendukung berbagai aktivitas 
                        ekonomi dan pembangunan nasional.
                    </p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="info-card reveal" style="border-top: 4px solid var(--pln-yellow);">
                    <div class="card-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Komitmen Operasional &amp; Lingkungan</h3>
                    <p>
                        Selain menjalankan fungsi pembangkitan, UP Indramayu berupaya memberikan dampak positif 
                        bagi lingkungan dan masyarakat sekitar melalui:
                    </p>
                    <ul style="margin: 0.75rem 0 0 0; padding-left: 1.25rem; color: #666; font-size: 0.9rem; line-height: 2;">
                        <li><strong class="highlight">Pengelolaan lingkungan</strong> yang bertanggung jawab</li>
                        <li>Peningkatan <strong>efisiensi operasional</strong> pembangkit</li>
                        <li>Komitmen <strong>Keselamatan &amp; Kesehatan Kerja (K3)</strong></li>
                        <li>Program <strong>tanggung jawab sosial &amp; pemberdayaan masyarakat</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Spacer --}}
<div class="container my-5"></div>

<!-- ============================================
     KAPASITAS & LOKASI
     ============================================ -->
<section class="py-5 tk-section-header">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center">
                <h2 class="section-title tk-header-title">Kapasitas &amp; Lokasi</h2>
                <p class="section-subtitle tk-header-desc">
                    Detail teknis dan lokasi PLTU Unit Pembangkitan Indramayu.
                </p>
            </div>
        </div>

        <div class="row g-4">
            {{-- Kapasitas --}}
            <div class="col-lg-6">
                <div class="capacity-section reveal">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="capacity-item">
                                <span class="capacity-number">990 MW</span>
                                <span class="capacity-label">Kapasitas Terpasang Total</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="capacity-item">
                                <span class="capacity-number">330 MW</span>
                                <span class="capacity-label">Kapasitas per Unit (x3)</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="capacity-item">
                                <span class="capacity-number">3</span>
                                <span class="capacity-label">Unit Pembangkit</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="capacity-item">
                                <span class="capacity-number">83 ha</span>
                                <span class="capacity-label">Luas Area Pembangkit</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Lokasi --}}
            <div class="col-lg-6">
                <div class="location-box reveal">
                    <div class="loc-item">
                        <div class="loc-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <div class="loc-label">Lokasi Pembangkit</div>
                            <div class="loc-value">Desa Sumuradem, Kec. Sukra, Kab. Indramayu, Jawa Barat</div>
                        </div>
                    </div>
                    <div class="loc-item">
                        <div class="loc-icon">
                            <i class="fas fa-road"></i>
                        </div>
                        <div>
                            <div class="loc-label">Sistem Distribusi</div>
                            <div class="loc-value">Sistem transmisi untuk mendukung kebutuhan kelistrikan Jawa-Bali</div>
                        </div>
                    </div>
                    <div class="loc-item">
                        <div class="loc-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div>
                            <div class="loc-label">Bahan Bakar Utama</div>
                            <div class="loc-value">Batubara (PLTU)</div>
                        </div>
                    </div>
                    <div class="loc-item">
                        <div class="loc-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div>
                            <div class="loc-label">Induk Perusahaan</div>
                            <div class="loc-value">PT PLN Nusantara Power</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Spacer --}}
<div class="container my-5"></div>

<!-- ============================================
     PERAN & KONTRIBUSI
     ============================================ -->
<section class="py-5 tk-section-header" style="background: var(--pln-gray);">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center">
                <h2 class="section-title tk-header-title">Peran &amp; Kontribusi</h2>
                <p class="section-subtitle tk-header-desc">
                    UP Indramayu tidak hanya berperan sebagai pembangkit listrik, tetapi juga 
                    berkomitmen memberikan dampak positif bagi lingkungan dan masyarakat.
                </p>
            </div>
        </div>

        <div class="role-grid">
            <div class="role-card reveal">
                <div class="unit-icon primary">
                    <i class="fas fa-bolt"></i>
                </div>
                <h4>Pembangkitan Listrik</h4>
                <p>
                    Mengoperasikan PLTU batubara dengan kapasitas 990 MW (3 unit x 330 MW) 
                    untuk memenuhi kebutuhan energi listrik sistem Jawa-Bali.
                </p>
            </div>

            <div class="role-card reveal">
                <div class="unit-icon green">
                    <i class="fas fa-leaf"></i>
                </div>
                <h4>Pengelolaan Lingkungan</h4>
                <p>
                    Penerapan pengelolaan lingkungan yang bertanggung jawab 
                    sebagai bagian dari komitmen keberlanjutan operasional.
                </p>
            </div>

            <div class="role-card reveal">
                <div class="unit-icon orange">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4>Keselamatan &amp; K3</h4>
                <p>
                    Prioritas utama dalam pengoperasian pembangkit — menjaga keselamatan, 
                    kesehatan kerja, dan efisiensi operasional secara optimal.
                </p>
            </div>

            <div class="role-card reveal">
                <div class="unit-icon purple">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <h4>CSR &amp; Pemberdayaan Masyarakat</h4>
                <p>
                    Berbagai program tanggung jawab sosial dan pemberdayaan masyarakat 
                    sekitar untuk memberikan dampak positif bagi komunitas setempat.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Spacer --}}
<div class="container my-5"></div>

<!-- ============================================
     FILOSOFI / KUTIPAN
     ============================================ -->
<section class="py-5 tk-section-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="info-card reveal" style="text-align: center; border-top: 4px solid var(--pln-yellow); padding: 2.5rem;">
                    <i class="fas fa-quote-left" style="font-size: 3rem; color: var(--pln-cyan); opacity: 0.3; margin-bottom: 1rem;"></i>
                    <p style="font-size: 1.15rem; color: var(--pln-blue); font-weight: 600; line-height: 1.8; margin: 0 auto;">
                        "UP Indramayu terus berkomitmen menjadi unit pembangkitan yang 
                        <strong>andal, profesional, dan bertanggung jawab</strong> 
                        dalam mendukung kebutuhan energi nasional."
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Spacer --}}
<div class="container my-5"></div>

<!-- ============================================
     TIMELINE PERJALANAN
     ============================================ -->
<section class="py-5 tk-section-header" style="background: var(--pln-gray);">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center">
                <h2 class="section-title tk-header-title">Perjalanan Unit Pembangkitan</h2>
                <p class="section-subtitle tk-header-desc">
                    Jejak kontribusi UP Indramayu dalam penyediaan energi listrik dan 
                    komitmen terhadap operasional yang dan lingkungan yang berkelanjutan.
                </p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="timeline-wrapper">
                    <div class="timeline-track"></div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-card">
                            <span class="timeline-year">Pendirian Unit</span>
                            <h4>Berdirinya PLN UP Indramayu</h4>
                            <p>
                                Unit pembangkitan didirikan sebagai bagian dari PT PLN Nusantara Power, 
                                bergerak dalam bidang penyediaan tenaga listrik melalui pengoperasian PLTU.
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-card">
                            <span class="timeline-year">Operasi Awal</span>
                            <h4>Pengoperasian PLTU Batubara</h4>
                            <p>
                                Pembangkit mulai beroperasi dengan menggunakan batubara sebagai bahan bakar utama, 
                                memiliki kapasitas terpasang 990 MW (3 unit x 330 MW) di Sumuradem, Indramayu.
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-card">
                            <span class="timeline-year">Pengembangan</span>
                            <h4>Dukungan keandalan sistem Jawa-Bali</h4>
                            <p>
                                UP Indramayu berkontribusi dalam memenuhi kebutuhan energi listrik masyarakat 
                                sekaligus mendukung aktivitas ekonomi dan pembangunan melalui pasokan listrik yang andal.
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-card">
                            <span class="timeline-year">Fokus Keberlanjutan</span>
                            <h4>Pengelolaan Lingkungan &amp; CSR</h4>
                            <p>
                                Unit terus berupaya memberikan dampak positif bagi lingkungan dan masyarakat melalui 
                                pengelolaan lingkungan, efisiensi operasional, K3, serta program tanggung jawab sosial.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Spacer --}}
<div class="container my-5"></div>

<!-- ============================================
     CTA
     ============================================ -->
<section class="py-5 pb-5">
    <div class="container">
        <div class="cta-section reveal">
            <span class="cta-icon"><i class="fas fa-bolt"></i></span>
            <h3>Menyediakan Energi untuk Indonesia</h3>
            <p>
                PLN Nusantara Power Unit Pembangkitan Indramayu berkomitmen menjadi unit pembangkitan 
                yang andal, profesional, dan bertanggung jawab — mendukung kebutuhan listrik 
                sistem Jawa-Bali dengan tetap mengedepankan keselamatan, lingkungan, dan keberlanjutan.
            </p>
            <a href="{{ route('sejarah') }}" class="btn-cta">
                <i class="fas fa-book me-2"></i>Lihat Sejarah Kami
            </a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var reveals = document.querySelectorAll('.reveal');
        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15 });
            reveals.forEach(function (el) { observer.observe(el); });
        } else {
            reveals.forEach(function (el) { el.classList.add('visible'); });
        }
    });
</script>
@endsection
