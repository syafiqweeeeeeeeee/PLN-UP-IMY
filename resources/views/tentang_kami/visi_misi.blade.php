@extends('layouts.app')

@section('title', 'Visi & Misi - E-PPID PLN')

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
        --vm-accent: #00A3E0;
        --vm-navy: #0A2540;
        --vm-navy-2: #102A43;
        --vm-bg: #F8FAFC;
        --vm-white: #FFFFFF;
        --vm-text: #1E293B;
        --vm-muted: #64748B;
        --vm-border: #E2E8F0;

        /* Gradasi bersama: dipakai Card Visi & Card Misi agar 100% identik */
        --vm-card-gradient: linear-gradient(135deg, #00A3E0 0%, #0A2540 100%);
    }

    /* =============================================
       BREADCRUMB
       ============================================= */
    .vm-breadcrumb {
        padding: 7.5rem 0 0;
        background: var(--vm-bg);
    }

    .vm-breadcrumb .crumb {
        font-size: 0.85rem;
        color: var(--vm-muted);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .vm-breadcrumb .crumb a {
        color: var(--vm-muted);
        transition: color 0.2s ease;
    }

    .vm-breadcrumb .crumb a:hover {
        color: var(--vm-accent);
    }

    .vm-breadcrumb .crumb .separator {
        color: var(--vm-border);
    }

    .vm-breadcrumb .crumb .current {
        color: var(--vm-accent);
        font-weight: 600;
    }

    /* =============================================
       HEADER SEKSI
       ============================================= */
    .vm-header {
        background: var(--vm-bg);
        padding: 2.5rem 0 3.5rem;
        text-align: center;
    }

    .vm-header .eyebrow {
        display: inline-block;
        background: rgba(0, 163, 224, 0.1);
        color: var(--vm-accent);
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.4rem 1.2rem;
        border-radius: 30px;
        margin-bottom: 1.2rem;
    }

    .vm-header h1 {
        color: var(--vm-text);
        font-weight: 800;
        font-size: 2.5rem;
        line-height: 1.2;
        margin-bottom: 0.9rem;
    }

    .vm-header .desc {
        color: var(--vm-muted);
        font-size: 1.05rem;
        line-height: 1.75;
        max-width: 640px;
        margin: 0 auto;
    }

    /* =============================================
       SEKSI VISI (HERO CARD)
       ============================================= */
    .vm-banners-section {
        background: var(--vm-bg);
        padding: 0 0 4rem;
    }

    .vm-visi-card {
        background: var(--vm-card-gradient);
        border-radius: 20px;
        padding: 3.5rem 3rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(10, 42, 67, 0.25);
    }

    .vm-visi-label {
        display: inline-block;
        background: rgba(255, 255, 255, 0.16);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.4rem 1.2rem;
        border-radius: 30px;
        margin-bottom: 1.5rem;
    }

    .vm-visi-text {
        color: #fff;
        font-size: 1.9rem;
        font-weight: 700;
        line-height: 1.5;
        margin: 0;
        max-width: 760px;
    }

    /* =============================================
       CARD MISI (satu banner, seragam dengan Card Visi)
       ============================================= */
    .vm-misi-card {
        background: var(--vm-card-gradient);
        border-radius: 20px;
        padding: 3.5rem 3rem;
        margin-top: 2.5rem;
        box-shadow: 0 20px 50px rgba(10, 42, 67, 0.25);
    }

    .vm-misi-label {
        display: inline-block;
        background: rgba(255, 255, 255, 0.16);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.4rem 1.2rem;
        border-radius: 30px;
        margin-bottom: 1.5rem;
    }

    /* Daftar misi: penomoran minimalis, teks putih tebal */
    .vm-misi-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .vm-misi-item {
        display: flex;
        align-items: baseline;
        gap: 1rem;
        padding: 1.1rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    }

    .vm-misi-item:first-child {
        padding-top: 0;
    }

    .vm-misi-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .vm-misi-num {
        color: #FFFFFF;
        font-weight: 800;
        font-size: 0.95rem;
        letter-spacing: 1px;
        flex: 0 0 auto;
    }

    .vm-misi-point {
        color: #FFFFFF;
        font-weight: 700;
        font-size: 1.15rem;
        line-height: 1.6;
        margin: 0;
    }

    /* =============================================
       BACK BUTTON
       ============================================= */
    .vm-back-wrap {
        text-align: center;
        margin-top: 3rem;
    }

    .vm-btn-back {
        background: var(--vm-navy);
        color: #fff;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0.7rem 2rem;
        border-radius: 30px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }

    .vm-btn-back:hover {
        background: var(--vm-accent);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 163, 224, 0.3);
    }

    /* =============================================
       RESPONSIVE
       (kontainer Bootstrap .container sudah memberi
       padding sisi >= 16px di layar kecil)
       ============================================= */
    @media (max-width: 991.98px) {
        .vm-visi-text {
            font-size: 1.5rem;
        }

        .vm-misi-point {
            font-size: 1.08rem;
        }
    }

    @media (max-width: 767.98px) {
        .vm-breadcrumb {
            padding-top: 6.5rem;
        }

        .vm-header {
            padding: 1.5rem 0 2.5rem;
        }

        .vm-header h1 {
            font-size: 1.5rem;
            line-height: 1.35;
        }

        .vm-header .desc {
            font-size: 0.88rem;
        }

        .vm-visi-card {
            padding: 2.2rem 1.5rem;
            border-radius: 16px;
        }

        .vm-visi-text {
            font-size: 1.25rem;
            line-height: 1.55;
        }

        .vm-misi-card {
            padding: 2.2rem 1.5rem;
            border-radius: 16px;
            margin-top: 1.75rem;
        }

        .vm-misi-label {
            margin-bottom: 1.2rem;
        }

        .vm-misi-item {
            gap: 0.75rem;
            padding: 0.9rem 0;
        }

        .vm-misi-point {
            font-size: 1rem;
        }

        .vm-misi-num {
            font-size: 0.85rem;
        }
    }
</style>

{{-- =============================================
     BREADCRUMB
     ============================================= --}}
<div class="vm-breadcrumb">
    <div class="container">
        <nav class="crumb" aria-label="breadcrumb">
            <a href="{{ route('home') }}">Tentang Kami</a>
            <span class="separator">/</span>
            <span class="current">Visi &amp; Misi</span>
        </nav>
    </div>
</div>

{{-- =============================================
     HEADER SEKSI
     ============================================= --}}
<header class="vm-header">
    <div class="container">
        <span class="eyebrow">Tentang Kami</span>
        <h1>Visi &amp; Misi Perusahaan</h1>
        <p class="desc">
            Landasan utama dan komitmen PT PLN Nusantara Power dalam menerangi Indonesia
            serta mendorong transisi energi global.
        </p>
    </div>
</header>

{{-- =============================================
     SEKSI VISI (HERO CARD)
     ============================================= --}}
<section class="vm-banners-section">
    <div class="container">
        <div class="vm-visi-card">
            <span class="vm-visi-label">Visi Perusahaan</span>
            <p class="vm-visi-text">
                Menjadi Perusahaan Pembangkitan yang Terdepan dan Terpercaya
                untuk Energi Berkelanjutan di Indonesia dan Pasar Global.
            </p>
        </div>

        {{-- =============================================
             CARD MISI — satu banner seragam dengan Card Visi
             ============================================= --}}
        <div class="vm-misi-card">
            <span class="vm-misi-label">Misi Perusahaan</span>
            <ol class="vm-misi-list">
                <li class="vm-misi-item">
                    <span class="vm-misi-num">01</span>
                    <p class="vm-misi-point">Menjaga Kinerja Pembangkit Listrik yang Unggul Sebagai Kompetensi Inti.</p>
                </li>
                <li class="vm-misi-item">
                    <span class="vm-misi-num">02</span>
                    <p class="vm-misi-point">Membangun Bisnis Inovatif yang terdepan untuk melakukan Diversifikasi dan Pertumbuhan yang Berkelanjutan.</p>
                </li>
                <li class="vm-misi-item">
                    <span class="vm-misi-num">03</span>
                    <p class="vm-misi-point">Mengakselerasi Portofolio Bisnis EBT Untuk Mendukung Tercapainya Nol Emisi Karbon.</p>
                </li>
                <li class="vm-misi-item">
                    <span class="vm-misi-num">04</span>
                    <p class="vm-misi-point">Mengakuisisi dan Membangun Talenta Terbaik Untuk Menjalankan Organisasi yang Responsif dan Adaptif.</p>
                </li>
            </ol>
        </div>

        {{-- Back Button --}}
        <div class="vm-back-wrap">
            <a href="{{ route('home') }}" class="vm-btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Tentang Kami
            </a>
        </div>
    </div>
</section>
@endsection
