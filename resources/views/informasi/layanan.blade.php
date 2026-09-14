@extends('layouts.app')

@section('title', 'E-PPID PLN — Informasi Standar Pelayanan')

@section('content')
<style>
    /* =============================================
       INFORMASI LAYANAN — PORTAL STANDAR PELAYANAN
       (Pusat Panduan, SOP & Transparansi)
       ============================================= */

    .spl-page {
        --spl-navy:   #0A2540;
        --spl-blue:   #004B87;
        --spl-yellow: #FFD100;
        --spl-cyan:   #00A3E0;
        --spl-bg:     #F8FAFC;
        --spl-border: #E2E8F0;
        --spl-text:   #1E293B;
        --spl-muted:  #64748B;

        background: var(--spl-bg);
        min-height: 100vh;
        color: var(--spl-text);
        padding-top: 76px;
    }

    /* ---------- Hero Header ---------- */
    .spl-hero {
        padding: 1.5rem 0 4.5rem;
        background: linear-gradient(135deg, var(--spl-navy) 0%, var(--spl-blue) 55%, #061C33 100%);
        position: relative;
        overflow: hidden;
    }

    .spl-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(255, 209, 0, 0.10) 0%, transparent 70%);
        border-radius: 50%;
    }

    .spl-hero::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.12) 0%, transparent 70%);
        border-radius: 50%;
    }

    .spl-breadcrumb {
        padding: 0 0 1.5rem;
        position: relative;
        z-index: 2;
    }

    .spl-breadcrumb .breadcrumb { background: transparent; margin: 0; padding: 0; }

    .spl-breadcrumb .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .spl-breadcrumb .breadcrumb-item a:hover { color: var(--spl-yellow); }

    .spl-breadcrumb .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.82rem;
        font-weight: 600;
    }

    .spl-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.35);
        content: "/";
        font-size: 0.75rem;
    }

    .spl-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #ffdd33 0%, var(--spl-yellow) 100%);
        color: var(--spl-navy);
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

    .spl-badge::before {
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

    .spl-badge i { font-size: 0.75rem; }

    .spl-hero h1 {
        font-size: 2.4rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 0.75rem;
        position: relative;
        z-index: 2;
    }

    .spl-hero h1 .accent { color: var(--spl-yellow); }

    .spl-hero .subtitle {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.75);
        max-width: 640px;
        line-height: 1.7;
        margin-bottom: 0;
        position: relative;
        z-index: 2;
    }

    /* ---------- Main Body (below hero, no overlap) ---------- */
    .spl-section {
        padding: 3rem 0 4.5rem;
        background: var(--spl-bg);
    }

    .spl-card {
        background: #fff;
        border: 1px solid var(--spl-border);
        border-radius: 18px;
        padding: 2.75rem 2.5rem;
        box-shadow: 0 2px 16px rgba(15, 23, 42, 0.06);
    }

    .spl-card-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1.75rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .spl-card-header h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--spl-text);
        margin-bottom: 0.4rem;
    }

    .spl-card-header p {
        font-size: 0.9rem;
        color: var(--spl-muted);
        margin: 0;
    }

    /* ---------- Filter Tabs ---------- */
    .spl-tabs {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.6rem;
        margin-bottom: 2rem;
    }

    .spl-tab {
        border: 1px solid var(--spl-border);
        background: #fff;
        color: var(--spl-muted);
        font-weight: 600;
        font-size: 0.82rem;
        font-family: inherit;
        padding: 0.55rem 1.2rem;
        border-radius: 999px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .spl-tab:hover {
        border-color: var(--spl-cyan);
        color: var(--spl-cyan);
        background: rgba(0, 163, 224, 0.06);
    }

    .spl-tab.active {
        background: var(--spl-navy);
        border-color: var(--spl-navy);
        color: #fff;
        box-shadow: 0 4px 14px rgba(10, 37, 64, 0.30);
    }

    .spl-tab i { margin-right: 0.4rem; font-size: 0.78rem; }

    /* =============================================
       TAB 1 — MAKLUMAT PELAYANAN
       ============================================= */
    .spl-pane { display: none; }
    .spl-pane.active { display: block; animation: splFade 0.35s ease; }

    @keyframes splFade {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .spl-maklumat {
        position: relative;
        background: linear-gradient(160deg, #fbfdff 0%, #f4f9fd 100%);
        border: 1px solid var(--spl-border);
        border-left: 5px solid var(--spl-yellow);
        border-radius: 14px;
        padding: 2.25rem 2.25rem 2rem;
        max-width: 820px;
        margin: 0 auto;
    }

    .spl-maklumat-head {
        display: flex;
        align-items: flex-start;
        gap: 1.1rem;
        margin-bottom: 1.25rem;
    }

    .spl-maklumat-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--spl-navy);
        color: var(--spl-yellow);
        font-size: 1.25rem;
    }

    .spl-maklumat-head h3 {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--spl-text);
        margin-bottom: 0.2rem;
    }

    .spl-maklumat-head span {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--spl-blue);
        background: rgba(0, 75, 135, 0.08);
        border: 1px solid rgba(0, 75, 135, 0.15);
        padding: 0.15rem 0.7rem;
        border-radius: 999px;
    }

    .spl-maklumat blockquote {
        position: relative;
        margin: 0 0 1.25rem;
        padding: 0 0 0 1.1rem;
        border-left: 3px solid rgba(255, 209, 0, 0.55);
        font-size: 0.94rem;
        color: var(--spl-muted);
        line-height: 1.85;
        font-style: italic;
    }

    .spl-commitments {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.6rem 1.25rem;
        list-style: none;
        padding: 0;
        margin: 0 0 1.5rem;
    }

    .spl-commitments li {
        display: flex;
        align-items: flex-start;
        gap: 0.55rem;
        font-size: 0.87rem;
        color: var(--spl-text);
        line-height: 1.6;
    }

    .spl-commitments li i {
        color: #1e8e5a;
        margin-top: 0.2rem;
        font-size: 0.82rem;
    }

    .spl-signature {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        border-top: 1px dashed var(--spl-border);
        padding-top: 1.25rem;
    }

    .spl-signature p {
        margin: 0;
        font-size: 0.8rem;
        color: var(--spl-muted);
        line-height: 1.6;
    }

    .spl-signature strong { color: var(--spl-text); }

    .spl-signature-note {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--spl-blue);
        background: rgba(0, 163, 224, 0.08);
        border: 1px solid rgba(0, 163, 224, 0.18);
        padding: 0.35rem 0.9rem;
        border-radius: 999px;
    }

    /* =============================================
       TAB 2 — SYARAT & PROSEDUR (ACCORDION)
       ============================================= */
    .spl-accordion { display: flex; flex-direction: column; gap: 0.75rem; }

    .spl-acc-item {
        background: #fff;
        border: 1px solid var(--spl-border);
        border-radius: 12px;
        overflow: hidden;
        transition: border-color 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
    }

    .spl-acc-item:hover { border-color: var(--spl-cyan); }

    .spl-acc-item.open {
        border-color: var(--spl-cyan);
        background: #fbfdff;
        box-shadow: 0 6px 18px rgba(0, 163, 224, 0.10);
    }

    .spl-acc-head {
        display: flex;
        align-items: center;
        gap: 1rem;
        width: 100%;
        text-align: left;
        background: transparent;
        border: none;
        padding: 1.1rem 1.35rem;
        cursor: pointer;
        font-family: inherit;
    }

    .spl-acc-num {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 75, 135, 0.08);
        color: var(--spl-blue);
        font-weight: 800;
        font-size: 0.85rem;
        transition: background 0.3s ease, color 0.3s ease;
    }

    .spl-acc-item.open .spl-acc-num {
        background: var(--spl-yellow);
        color: var(--spl-navy);
    }

    .spl-acc-title {
        flex: 1;
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--spl-text);
        line-height: 1.5;
    }

    .spl-acc-icon {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        color: var(--spl-blue);
        font-size: 0.72rem;
        transition: transform 0.3s ease, background 0.3s ease, color 0.3s ease;
    }

    .spl-acc-item.open .spl-acc-icon {
        transform: rotate(180deg);
        background: var(--spl-yellow);
        color: var(--spl-navy);
    }

    .spl-acc-body {
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transition: max-height 0.4s ease, opacity 0.35s ease;
    }

    .spl-acc-item.open .spl-acc-body { opacity: 1; }

    .spl-acc-body-inner { padding: 0 1.35rem 1.4rem; }

    .spl-req,
    .spl-flow-wrap { margin-bottom: 1.15rem; }

    .spl-req:last-child,
    .spl-flow-wrap:last-child { margin-bottom: 0; }

    .spl-req h5 {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: var(--spl-blue);
        margin-bottom: 0.6rem;
    }

    .spl-req ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
    }

    .spl-req li {
        position: relative;
        padding-left: 1.35rem;
        font-size: 0.87rem;
        color: var(--spl-muted);
        line-height: 1.65;
    }

    .spl-req li::before {
        content: '\f058';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        left: 0;
        top: 0.15rem;
        color: var(--spl-cyan);
        font-size: 0.8rem;
    }

    /* Flow steps */
    .spl-flow {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.4rem 0.5rem;
    }

    .spl-step {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: #f8fafc;
        border: 1px solid var(--spl-border);
        border-radius: 999px;
        padding: 0.4rem 0.9rem;
        font-size: 0.79rem;
        font-weight: 600;
        color: var(--spl-text);
        white-space: nowrap;
    }

    .spl-step i { color: var(--spl-blue); font-size: 0.72rem; }

    .spl-step-arrow {
        color: var(--spl-cyan);
        font-size: 0.72rem;
    }

    /* =============================================
       TAB 3 — ESTIMASI WAKTU & BIAYA (TABEL)
       ============================================= */
    .spl-table-wrap {
        border: 1px solid var(--spl-border);
        border-radius: 12px;
        overflow: hidden;
    }

    .spl-table-scroll { overflow-x: auto; }

    .spl-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 720px;
    }

    .spl-table thead th {
        background: var(--spl-navy);
        color: #fff;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.4px;
        text-transform: uppercase;
        text-align: left;
        padding: 0.9rem 1.25rem;
        white-space: nowrap;
    }

    .spl-table tbody td {
        padding: 0.95rem 1.25rem;
        font-size: 0.87rem;
        color: var(--spl-muted);
        border-top: 1px solid var(--spl-border);
        vertical-align: middle;
    }

    .spl-table tbody tr:nth-child(even) { background: #f8fafc; }

    .spl-table tbody tr:hover { background: rgba(0, 163, 224, 0.05); }

    .spl-table td strong {
        display: flex;
        align-items: center;
        gap: 0.55rem;
        color: var(--spl-text);
        font-size: 0.89rem;
        font-weight: 700;
    }

    .spl-table td strong i {
        color: var(--spl-blue);
        font-size: 0.85rem;
    }

    .spl-badge-free {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: rgba(30, 142, 90, 0.10);
        border: 1px solid rgba(30, 142, 90, 0.22);
        color: #1e8e5a;
        font-weight: 700;
        font-size: 0.78rem;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        white-space: nowrap;
    }

    .spl-table-note {
        display: flex;
        align-items: flex-start;
        gap: 0.55rem;
        margin-top: 1rem;
        font-size: 0.8rem;
        color: var(--spl-muted);
        line-height: 1.65;
    }

    .spl-table-note i { color: var(--spl-yellow); margin-top: 0.15rem; }

    /* =============================================
       TAB 4 — UNDUH DOKUMEN & SOP
       ============================================= */
    .spl-downloads {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .spl-dl {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: #fff;
        border: 1px solid var(--spl-border);
        border-radius: 12px;
        padding: 1.1rem 1.25rem;
        text-decoration: none;
        transition: border-color 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
    }

    .spl-dl:hover {
        border-color: var(--spl-cyan);
        box-shadow: 0 8px 20px rgba(0, 163, 224, 0.12);
        transform: translateY(-2px);
    }

    .spl-dl-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 75, 135, 0.08);
        color: var(--spl-blue);
        font-size: 1.1rem;
    }

    .spl-dl-text { flex: 1; min-width: 0; }

    .spl-dl-text h5 {
        font-size: 0.89rem;
        font-weight: 700;
        color: var(--spl-text);
        margin-bottom: 0.15rem;
        line-height: 1.4;
    }

    .spl-dl-text span {
        font-size: 0.75rem;
        color: var(--spl-muted);
    }

    .spl-dl-btn {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: var(--spl-navy);
        color: #fff;
        font-weight: 700;
        font-size: 0.78rem;
        padding: 0.5rem 1.05rem;
        border-radius: 999px;
        text-decoration: none;
        transition: background 0.2s ease, box-shadow 0.2s ease;
    }

    .spl-dl:hover .spl-dl-btn {
        background: var(--spl-cyan);
        box-shadow: 0 4px 12px rgba(0, 163, 224, 0.30);
    }

    /* ---------- Footer Banner ---------- */
    .spl-contact {
        margin-top: 2.5rem;
        background: linear-gradient(135deg, var(--spl-navy) 0%, var(--spl-blue) 100%);
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

    .spl-contact::before {
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

    .spl-contact-text { position: relative; z-index: 2; }

    .spl-contact-text h3 {
        color: #fff;
        font-weight: 800;
        font-size: 1.15rem;
        margin-bottom: 0.35rem;
    }

    .spl-contact-text p {
        color: rgba(255, 255, 255, 0.75);
        font-size: 0.88rem;
        margin: 0;
    }

    .btn-spl-contact {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--spl-yellow);
        color: var(--spl-navy);
        font-weight: 700;
        font-size: 0.9rem;
        font-family: inherit;
        padding: 0.7rem 1.8rem;
        border-radius: 999px;
        border: none;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .btn-spl-contact:hover {
        background: #fff;
        color: var(--spl-navy);
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(255, 209, 0, 0.35);
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 991.98px) {
        .spl-hero h1 { font-size: 2rem; }
        .spl-downloads { grid-template-columns: 1fr; }
    }

    @media (max-width: 767.98px) {
        .spl-hero { padding: 1.5rem 0 3.25rem; }
        .spl-hero h1 { font-size: 1.65rem; }
        .spl-section { padding: 2rem 0 3.25rem; }
        .spl-card { padding: 1.75rem 1.25rem; border-radius: 14px; }
        .spl-tabs { gap: 0.45rem; }
        .spl-tab { font-size: 0.76rem; padding: 0.5rem 0.95rem; }
        .spl-maklumat { padding: 1.6rem 1.25rem 1.4rem; }
        .spl-commitments { grid-template-columns: 1fr; }
        .spl-contact { padding: 1.75rem 1.4rem; }
    }

    /* ---------- Animation ---------- */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .spl-page > .spl-section > .container > .spl-card {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }
</style>

<div class="spl-page">

    {{-- ============================================
         1. HERO / HEADER
         ============================================ --}}
    <section class="spl-hero">
        <div class="container px-4 px-lg-5">

            <div class="spl-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="#" onclick="history.back(); return false;">Informasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Informasi Layanan</li>
                    </ol>
                </nav>
            </div>

            <div class="spl-badge">
                <i class="fas fa-bolt"></i> PLN NUSANTARA POWER
            </div>

            <h1>Informasi <span class="accent">Standar Pelayanan</span></h1>

            <p class="subtitle">
                Panduan resmi, persyaratan dokumen, standar waktu, dan prosedur pelayanan publik
                PT PLN Nusantara Power UP PLTU Indramayu.
            </p>

        </div>
    </section>

    {{-- ============================================
         2. MAIN CONTENT CARD
         ============================================ --}}
    <section class="spl-section">
        <div class="container px-4 px-lg-5">

            <div class="spl-card">

                <div class="spl-card-header">
                    <h2>Standar &amp; Prosedur Pelayanan</h2>
                    <p>Pusat panduan, SOP, dan transparansi standar pelayanan publik</p>
                </div>

                {{-- A. Filter Tab Kategori --}}
                <div class="spl-tabs" role="tablist" aria-label="Kategori informasi layanan">
                    <button type="button" class="spl-tab active" role="tab" aria-selected="true"
                            data-tab="maklumat">
                        <i class="fas fa-file-signature"></i> Maklumat Pelayanan
                    </button>
                    <button type="button" class="spl-tab" role="tab" aria-selected="false"
                            data-tab="prosedur">
                        <i class="fas fa-list-check"></i> Syarat &amp; Prosedur Layanan
                    </button>
                    <button type="button" class="spl-tab" role="tab" aria-selected="false"
                            data-tab="estimasi">
                        <i class="fas fa-table-list"></i> Estimasi Waktu &amp; Biaya
                    </button>
                    <button type="button" class="spl-tab" role="tab" aria-selected="false"
                            data-tab="dokumen">
                        <i class="fas fa-file-arrow-down"></i> Unduh Dokumen &amp; SOP
                    </button>
                </div>

                {{-- B. Area Konten Utama --}}

                {{-- ===== TAB 1: MAKLUMAT PELAYANAN ===== --}}
                <div class="spl-pane active" id="pane-maklumat" role="tabpanel">
                    <div class="spl-maklumat">
                        <div class="spl-maklumat-head">
                            <div class="spl-maklumat-icon"><i class="fas fa-file-signature"></i></div>
                            <div>
                                <h3>Maklumat Pelayanan Publik</h3>
                                <span>Ditetapkan &amp; Ditandatangani Manajemen</span>
                            </div>
                        </div>

                        <blockquote>
                            &ldquo;Kami berkomitmen memberikan pelayanan publik yang transparan, akuntabel,
                            cepat, dan berorientasi pada kepuasan masyarakat, sesuai dengan peraturan
                            perundang-undangan tentang Pelayanan Publik.&rdquo;
                        </blockquote>

                        <ul class="spl-commitments">
                            <li><i class="fas fa-circle-check"></i> Pelayanan dilakukan secara tertib, tepat waktu, dan sesuai standar.</li>
                            <li><i class="fas fa-circle-check"></i> Biaya pelayanan sesuai ketentuan — tidak ada pungutan di luar ketentuan.</li>
                            <li><i class="fas fa-circle-check"></i> Informasi pelayanan disediakan secara terbuka dan mudah diakses.</li>
                            <li><i class="fas fa-circle-check"></i> Setiap pengaduan ditindaklanjuti secara cepat dan proporsional.</li>
                        </ul>

                        <div class="spl-signature">
                            <p>
                                <strong>Manajemen PT PLN Nusantara Power UP PLTU Indramayu</strong><br>
                                General Manager &mdash; UP PLTU Indramayu
                            </p>
                            <span class="spl-signature-note">
                                <i class="fas fa-shield-halved"></i> Terverifikasi &mdash; Transparansi Publik
                            </span>
                        </div>
                    </div>
                </div>

                {{-- ===== TAB 2: SYARAT & PROSEDUR ===== --}}
                <div class="spl-pane" id="pane-prosedur" role="tabpanel">
                    <div class="spl-accordion" id="splAccordion">

                        {{-- 1. FABA --}}
                        <div class="spl-acc-item">
                            <button class="spl-acc-head" type="button" id="spl-acc-h-1"
                                    aria-expanded="false" aria-controls="spl-acc-b-1">
                                <span class="spl-acc-num">01</span>
                                <span class="spl-acc-title">Standar Pelayanan Pemanfaatan FABA (Fly Ash &amp; Bottom Ash)</span>
                                <span class="spl-acc-icon"><i class="fas fa-chevron-down"></i></span>
                            </button>
                            <div class="spl-acc-body" id="spl-acc-b-1" role="region" aria-labelledby="spl-acc-h-1">
                                <div class="spl-acc-body-inner">
                                    <div class="spl-req">
                                        <h5><i class="fas fa-clipboard-check"></i> Persyaratan</h5>
                                        <ul>
                                            <li>Surat permohonan resmi dari instansi/perusahaan</li>
                                            <li>Dokumen legalitas usaha (NIB, akta, atau setara)</li>
                                            <li>Profil rencana penggunaan material FABA</li>
                                        </ul>
                                    </div>
                                    <div class="spl-flow-wrap">
                                        <h5 style="display:flex;align-items:center;gap:0.5rem;font-size:0.8rem;font-weight:800;letter-spacing:0.5px;text-transform:uppercase;color:var(--spl-blue);margin-bottom:0.6rem;">
                                            <i class="fas fa-diagram-project"></i> Alur Prosedur
                                        </h5>
                                        <div class="spl-flow">
                                            <span class="spl-step"><i class="fas fa-envelope-open-text"></i> Pengajuan Proposal</span>
                                            <i class="fas fa-arrow-right spl-step-arrow"></i>
                                            <span class="spl-step"><i class="fas fa-magnifying-gear"></i> Verifikasi Teknis</span>
                                            <i class="fas fa-arrow-right spl-step-arrow"></i>
                                            <span class="spl-step"><i class="fas fa-file-signature"></i> Penandatanganan MoU</span>
                                            <i class="fas fa-arrow-right spl-step-arrow"></i>
                                            <span class="spl-step"><i class="fas fa-truck-fast"></i> Pengambilan Material</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 2. Kunjungan Industri --}}
                        <div class="spl-acc-item">
                            <button class="spl-acc-head" type="button" id="spl-acc-h-2"
                                    aria-expanded="false" aria-controls="spl-acc-b-2">
                                <span class="spl-acc-num">02</span>
                                <span class="spl-acc-title">Standar Pelayanan Kunjungan Industri / Edukasi</span>
                                <span class="spl-acc-icon"><i class="fas fa-chevron-down"></i></span>
                            </button>
                            <div class="spl-acc-body" id="spl-acc-b-2" role="region" aria-labelledby="spl-acc-h-2">
                                <div class="spl-acc-body-inner">
                                    <div class="spl-req">
                                        <h5><i class="fas fa-clipboard-check"></i> Persyaratan</h5>
                                        <ul>
                                            <li>Surat resmi dari Kampus/Sekolah (minimal H-14 sebelum kunjungan)</li>
                                            <li>Daftar peserta kunjungan</li>
                                            <li>Sertifikat vaksin / dokumen K3 yang dipersyaratkan</li>
                                        </ul>
                                    </div>
                                    <div class="spl-flow-wrap">
                                        <h5 style="display:flex;align-items:center;gap:0.5rem;font-size:0.8rem;font-weight:800;letter-spacing:0.5px;text-transform:uppercase;color:var(--spl-blue);margin-bottom:0.6rem;">
                                            <i class="fas fa-diagram-project"></i> Alur Prosedur
                                        </h5>
                                        <div class="spl-flow">
                                            <span class="spl-step"><i class="fas fa-envelope-open-text"></i> Pengajuan Surat</span>
                                            <i class="fas fa-arrow-right spl-step-arrow"></i>
                                            <span class="spl-step"><i class="fas fa-calendar-check"></i> Konfirmasi Jadwal dari Humas</span>
                                            <i class="fas fa-arrow-right spl-step-arrow"></i>
                                            <span class="spl-step"><i class="fas fa-helmet-safety"></i> Safety Indoktrinasi</span>
                                            <i class="fas fa-arrow-right spl-step-arrow"></i>
                                            <span class="spl-step"><i class="fas fa-person-walking"></i> Kunjungan Field</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 3. CSR / TJSL --}}
                        <div class="spl-acc-item">
                            <button class="spl-acc-head" type="button" id="spl-acc-h-3"
                                    aria-expanded="false" aria-controls="spl-acc-b-3">
                                <span class="spl-acc-num">03</span>
                                <span class="spl-acc-title">Standar Pelayanan Pengajuan CSR / TJSL</span>
                                <span class="spl-acc-icon"><i class="fas fa-chevron-down"></i></span>
                            </button>
                            <div class="spl-acc-body" id="spl-acc-b-3" role="region" aria-labelledby="spl-acc-h-3">
                                <div class="spl-acc-body-inner">
                                    <div class="spl-req">
                                        <h5><i class="fas fa-clipboard-check"></i> Persyaratan</h5>
                                        <ul>
                                            <li>Proposal program pemberdayaan masyarakat</li>
                                            <li>Profil instansi/komunitas pengusul</li>
                                            <li>Rencana lokasi &amp; target penerima manfaat</li>
                                        </ul>
                                    </div>
                                    <div class="spl-flow-wrap">
                                        <h5 style="display:flex;align-items:center;gap:0.5rem;font-size:0.8rem;font-weight:800;letter-spacing:0.5px;text-transform:uppercase;color:var(--spl-blue);margin-bottom:0.6rem;">
                                            <i class="fas fa-diagram-project"></i> Alur Prosedur
                                        </h5>
                                        <div class="spl-flow">
                                            <span class="spl-step"><i class="fas fa-file-lines"></i> Pengajuan Proposal</span>
                                            <i class="fas fa-arrow-right spl-step-arrow"></i>
                                            <span class="spl-step"><i class="fas fa-users-viewfinder"></i> Kajian &amp; Seleksi Program</span>
                                            <i class="fas fa-arrow-right spl-step-arrow"></i>
                                            <span class="spl-step"><i class="fas fa-file-signature"></i> Keputusan Manajemen</span>
                                            <i class="fas fa-arrow-right spl-step-arrow"></i>
                                            <span class="spl-step"><i class="fas fa-handshake-angle"></i> Pelaksanaan Program</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ===== TAB 3: ESTIMASI WAKTU & BIAYA ===== --}}
                <div class="spl-pane" id="pane-estimasi" role="tabpanel">
                    <div class="spl-table-wrap">
                        <div class="spl-table-scroll">
                            <table class="spl-table">
                                <thead>
                                    <tr>
                                        <th>Jenis Layanan</th>
                                        <th>Estimasi Waktu Proses</th>
                                        <th>Biaya / Tarif</th>
                                        <th>Output Layanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong><i class="fas fa-recycle"></i> Permohonan FABA</strong></td>
                                        <td>3 &ndash; 5 Hari Kerja</td>
                                        <td><span class="spl-badge-free"><i class="fas fa-check"></i> Rp 0 (Gratis)</span></td>
                                        <td>Surat Izin Pemanfaatan</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="fas fa-people-group"></i> Permohonan Kunjungan</strong></td>
                                        <td>2 &ndash; 4 Hari Kerja</td>
                                        <td><span class="spl-badge-free"><i class="fas fa-check"></i> Rp 0 (Gratis)</span></td>
                                        <td>Surat Konfirmasi &amp; Jadwal</td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="fas fa-hand-holding-heart"></i> Pengajuan CSR/TJSL</strong></td>
                                        <td>7 &ndash; 14 Hari Kerja</td>
                                        <td><span class="spl-badge-free"><i class="fas fa-check"></i> Rp 0 (Gratis)</span></td>
                                        <td>Lembar Disposisi &amp; Realisasi</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <p class="spl-table-note">
                        <i class="fas fa-circle-info"></i>
                        Estimasi waktu dihitung sejak berkas permohonan dinyatakan lengkap secara administratif.
                        Seluruh layanan di atas <strong>tidak dipungut biaya</strong> sesuai standar pelayanan publik.
                    </p>
                </div>

                {{-- ===== TAB 4: UNDUH DOKUMEN & SOP ===== --}}
                <div class="spl-pane" id="pane-dokumen" role="tabpanel">
                    <div class="spl-downloads">

                        <a href="#" class="spl-dl">
                            <span class="spl-dl-icon"><i class="fas fa-file-pdf"></i></span>
                            <span class="spl-dl-text">
                                <h5>Buku Standar Pelayanan Publik UP Indramayu</h5>
                                <span><i class="fas fa-file-lines"></i> PDF &middot; Dokumen resmi standar pelayanan</span>
                            </span>
                            <span class="spl-dl-btn"><i class="fas fa-download"></i> Download</span>
                        </a>

                        <a href="#" class="spl-dl">
                            <span class="spl-dl-icon"><i class="fas fa-file-pdf"></i></span>
                            <span class="spl-dl-text">
                                <h5>Formulir Permohonan Kunjungan Industri</h5>
                                <span><i class="fas fa-file-lines"></i> PDF &middot; Formulir pengajuan kunjungan</span>
                            </span>
                            <span class="spl-dl-btn"><i class="fas fa-download"></i> Download</span>
                        </a>

                        <a href="#" class="spl-dl">
                            <span class="spl-dl-icon"><i class="fas fa-file-pdf"></i></span>
                            <span class="spl-dl-text">
                                <h5>SOP Kemitraan Pemanfaatan FABA</h5>
                                <span><i class="fas fa-file-lines"></i> PDF &middot; Prosedur operasional kemitraan</span>
                            </span>
                            <span class="spl-dl-btn"><i class="fas fa-download"></i> Download</span>
                        </a>

                    </div>
                </div>

                {{-- Footer Banner --}}
                <div class="spl-contact">
                    <div class="spl-contact-text">
                        <h3>Butuh bantuan lebih lanjut?</h3>
                        <p>Hubungi tim layanan informasi kami untuk panduan prosedur dan berkas permohonan.</p>
                    </div>
                    <a href="{{ route('hubungi-kami') }}" class="btn-spl-contact">
                        <i class="fas fa-headset"></i> Hubungi Kami
                    </a>
                </div>

            </div>

        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
    (function () {
        /* ---------- Tab Switching ---------- */
        var tabs = Array.prototype.slice.call(document.querySelectorAll('.spl-tab'));
        var panes = Array.prototype.slice.call(document.querySelectorAll('.spl-pane'));

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (t) {
                    t.classList.remove('active');
                    t.setAttribute('aria-selected', 'false');
                });
                tab.classList.add('active');
                tab.setAttribute('aria-selected', 'true');

                var target = tab.getAttribute('data-tab');
                panes.forEach(function (pane) {
                    pane.classList.toggle('active', pane.id === 'pane-' + target);
                });
            });
        });

        /* ---------- Accordion (smooth drop-down) ---------- */
        var accItems = Array.prototype.slice.call(document.querySelectorAll('.spl-acc-item'));

        function setAccOpen(item, open) {
            var body = item.querySelector('.spl-acc-body');
            var btn  = item.querySelector('.spl-acc-head');
            item.classList.toggle('open', open);
            body.style.maxHeight = open ? body.scrollHeight + 'px' : '0px';
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        }

        accItems.forEach(function (item) {
            item.querySelector('.spl-acc-head').addEventListener('click', function () {
                setAccOpen(item, !item.classList.contains('open'));
            });
        });

        /* Keep open answers sized correctly on resize */
        window.addEventListener('resize', function () {
            accItems.forEach(function (item) {
                if (item.classList.contains('open')) {
                    var body = item.querySelector('.spl-acc-body');
                    body.style.maxHeight = body.scrollHeight + 'px';
                }
            });
        });
    })();
</script>
@endpush
