@extends('layouts.app')

@section('title', 'Visi & Misi - E-PPID PLN')

@section('content')
<style>
    /* =============================================
       PAGE HEADER
       ============================================= */
    .vm-header {
        background: linear-gradient(135deg, var(--pln-blue) 0%, #003d6b 50%, var(--pln-dark) 100%);
        padding: 8rem 0 4rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .vm-header::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -15%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.12) 0%, transparent 70%);
        border-radius: 50%;
    }

    .vm-header h1 {
        color: #fff;
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .vm-header h1 span {
        color: var(--pln-yellow);
    }

    .vm-header .subtitle {
        color: rgba(255, 255, 255, 0.75);
        font-size: 1rem;
        line-height: 1.7;
        max-width: 640px;
        margin: 0.8rem auto 0;
        position: relative;
        z-index: 2;
    }

    /* =============================================
       VISI SECTION
       ============================================= */
    .visi-section {
        padding: 5rem 0;
        background: #fff;
    }

    .visi-badge {
        display: inline-block;
        background: var(--pln-cyan);
        color: #fff;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 0.45rem 1.4rem;
        border-radius: 30px;
        margin-bottom: 1.5rem;
    }

    .visi-card {
        background: linear-gradient(135deg, #0A2540 0%, #102A43 40%, #003d6b 100%);
        border-radius: 20px;
        padding: 3.5rem 3rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(10, 37, 64, 0.2);
    }

    .visi-card::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .visi-card::after {
        content: '';
        position: absolute;
        bottom: -40px;
        left: -40px;
        width: 180px;
        height: 180px;
        background: radial-gradient(circle, rgba(255, 230, 0, 0.06) 0%, transparent 70%);
        border-radius: 50%;
    }

    .visi-card .visi-icon {
        width: 64px;
        height: 64px;
        background: rgba(0, 163, 224, 0.15);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--pln-cyan);
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 2;
    }

    .visi-card .visi-label {
        display: inline-block;
        background: var(--pln-cyan);
        color: #fff;
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 0.35rem 1rem;
        border-radius: 20px;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 2;
    }

    .visi-card .visi-text {
        color: #fff;
        font-size: 1.55rem;
        font-weight: 700;
        line-height: 1.65;
        position: relative;
        z-index: 2;
        max-width: 700px;
    }

    .visi-card .visi-text::before {
        content: '\201C';
        font-size: 4rem;
        color: var(--pln-cyan);
        opacity: 0.3;
        position: absolute;
        top: -1.5rem;
        left: -0.5rem;
        font-family: Georgia, serif;
        line-height: 1;
    }

    /* =============================================
       MISI SECTION
       ============================================= */
    .misi-section {
        padding: 5rem 0;
        background: var(--pln-gray);
    }

    .misi-badge {
        display: inline-block;
        background: var(--pln-blue);
        color: #fff;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 0.45rem 1.4rem;
        border-radius: 30px;
        margin-bottom: 1.5rem;
    }

    .misi-section .section-heading {
        color: var(--pln-blue);
        font-weight: 800;
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .misi-section .section-sub {
        color: #64748b;
        font-size: 0.95rem;
        margin-bottom: 3rem;
        max-width: 520px;
    }

    .misi-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 2.2rem 1.8rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .misi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 0;
        background: var(--pln-cyan);
        transition: height 0.3s ease;
        border-radius: 0 0 4px 0;
    }

    .misi-card:hover {
        transform: translateY(-6px);
        border-color: var(--pln-cyan);
        box-shadow: 0 12px 36px rgba(0, 163, 224, 0.12);
    }

    .misi-card:hover::before {
        height: 100%;
    }

    .misi-number {
        width: 52px;
        height: 52px;
        background: var(--pln-cyan);
        color: #fff;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        font-weight: 800;
        margin-bottom: 1.2rem;
    }

    .misi-card h5 {
        color: #1e293b;
        font-weight: 700;
        font-size: 1.05rem;
        margin-bottom: 0.7rem;
    }

    .misi-card p {
        color: #64748b;
        font-size: 0.92rem;
        line-height: 1.75;
        margin-bottom: 0;
    }

    /* =============================================
       BACK BUTTON
       ============================================= */
    .btn-back-vm {
        background: var(--pln-blue);
        color: #fff;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0.7rem 2rem;
        border-radius: 30px;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back-vm:hover {
        background: var(--pln-cyan);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 163, 224, 0.3);
    }

    /* =============================================
       RESPONSIVE
       ============================================= */
    @media (max-width: 767.98px) {
        .vm-header {
            padding: 7rem 0 3rem;
        }

        .vm-header h1 {
            font-size: 1.8rem;
        }

        .vm-header .subtitle {
            font-size: 0.9rem;
        }

        .visi-card {
            padding: 2.5rem 1.8rem;
        }

        .visi-card .visi-text {
            font-size: 1.2rem;
        }

        .misi-section .section-heading {
            font-size: 1.5rem;
        }
    }
</style>

{{-- =============================================
     HEADER
     ============================================= --}}
<section class="vm-header">
    <div class="container">
        <h1><span>Visi & Misi</span> Perusahaan</h1>
        <p class="subtitle">
            Landasan utama dan komitmen PT PLN Nusantara Power dalam menerangi Indonesia
            dan mendorong transisi energi global.
        </p>
    </div>
</section>

{{-- =============================================
     VISI SECTION
     ============================================= --}}
<section class="visi-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-4">
                    <span class="visi-badge">Visi</span>
                </div>
                <div class="visi-card">
                    <div class="visi-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <span class="visi-label">VISI PERUSAHAAN</span>
                    <p class="visi-text">
                        Menjadi Perusahaan Pembangkitan yang Terdepan dan Terpercaya
                        untuk Energi Berkelanjutan di Indonesia dan Pasar Global.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =============================================
     MISI SECTION
     ============================================= --}}
<section class="misi-section">
    <div class="container">
        <div class="text-center mb-2">
            <span class="misi-badge">Misi Perusahaan</span>
        </div>
        <h2 class="section-heading text-center">Langkah Strategis Kami</h2>
        <p class="section-sub text-center mx-auto">
            Empat pilar utama yang menjadi fondasi operasional dan pertumbuhan perusahaan.
        </p>

        <div class="row g-4">
            {{-- Card Misi 01 --}}
            <div class="col-lg-6">
                <div class="misi-card">
                    <div class="misi-number">01</div>
                    <h5>Keunggulan Operasional</h5>
                    <p>
                        Menjaga Kinerja Pembangkit Listrik yang Unggul Sebagai Kompetensi Inti.
                    </p>
                </div>
            </div>

            {{-- Card Misi 02 --}}
            <div class="col-lg-6">
                <div class="misi-card">
                    <div class="misi-number">02</div>
                    <h5>Diversifikasi & Inovasi</h5>
                    <p>
                        Membangun Bisnis Inovatif yang terdepan untuk melakukan Diversifikasi
                        dan Pertumbuhan yang Berkelanjutan.
                    </p>
                </div>
            </div>

            {{-- Card Misi 03 --}}
            <div class="col-lg-6">
                <div class="misi-card">
                    <div class="misi-number">03</div>
                    <h5>Transisi Energi & EBT</h5>
                    <p>
                        Mengakselerasi Portofolio Bisnis EBT Untuk Mendukung Tercapainya
                        Nol Emisi Karbon.
                    </p>
                </div>
            </div>

            {{-- Card Misi 04 --}}
            <div class="col-lg-6">
                <div class="misi-card">
                    <div class="misi-number">04</div>
                    <h5>Pengembangan SDM</h5>
                    <p>
                        Mengakuisisi dan Membangun Talenta Terbaik Untuk Menjalankan
                        Organisasi yang Responsif dan Adaptif.
                    </p>
                </div>
            </div>
        </div>

        {{-- Back Button --}}
        <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="btn btn-back-vm">
                <i class="fas fa-arrow-left"></i> Kembali ke Tentang Kami
            </a>
        </div>
    </div>
</section>
@endsection
