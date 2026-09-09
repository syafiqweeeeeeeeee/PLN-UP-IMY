@extends('layouts.app')

@section('title', 'E-PPID PLN — Struktur Organisasi')

@section('content')
<style>
    /* =============================================
       STRUKTUR ORGANISASI — DARK NAVY THEME
       ============================================= */

    :root {
        --org-deep-navy: #032B56;
        --org-dark-navy: #021D3B;
        --org-accent: #FFEB00;
        --org-white: #FFFFFF;
        --org-glass: rgba(255, 255, 255, 0.08);
        --org-glass-border: rgba(255, 255, 255, 0.12);
        --org-text-light: rgba(255, 255, 255, 0.85);
    }

    /* ---------- Page Wrapper ---------- */
    .org-page {
        background: linear-gradient(180deg, var(--org-deep-navy) 0%, var(--org-dark-navy) 100%);
        min-height: 100vh;
        color: var(--org-white);
        padding-top: 76px;
        padding-bottom: 4rem;
        position: relative;
        overflow-x: hidden;
    }

    .org-page::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -15%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    /* ---------- Breadcrumb ---------- */
    .org-breadcrumb {
        padding: 1.5rem 0 0;
    }

    .org-breadcrumb .breadcrumb {
        background: transparent;
        margin: 0;
        padding: 0;
    }

    .org-breadcrumb .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .org-breadcrumb .breadcrumb-item a:hover {
        color: var(--org-accent);
    }

    .org-breadcrumb .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.82rem;
        font-weight: 600;
    }

    .org-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.35);
        content: "/";
        font-size: 0.75rem;
    }

    /* ---------- Header Section ---------- */
    .org-header {
        padding: 2rem 0 2.5rem;
        position: relative;
        z-index: 2;
    }

    .org-header-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .org-header-left {
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }

    .org-logo-danantara {
        width: 56px;
        height: 56px;
        background: var(--org-glass);
        border: 1px solid var(--org-glass-border);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .org-logo-danantara img {
        width: 36px;
        height: 36px;
        object-fit: contain;
    }

    .org-logo-danantara .fallback-text {
        font-size: 0.65rem;
        font-weight: 700;
        color: var(--org-accent);
        text-align: center;
        line-height: 1.2;
    }

    .org-title h1 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--org-text-light);
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 0.15rem;
    }

    .org-title h2 {
        font-size: 1.65rem;
        font-weight: 800;
        color: var(--org-accent);
        letter-spacing: 1px;
        margin-bottom: 0;
    }

    .org-header-right {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .org-logo-pln {
        width: 48px;
        height: 48px;
        background: var(--org-accent);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .org-logo-pln img {
        width: 32px;
        height: 32px;
        object-fit: contain;
    }

    .org-logo-pln .fallback-text {
        font-size: 0.6rem;
        font-weight: 800;
        color: var(--org-deep-navy);
    }

    .org-logo-pln-text {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--org-text-light);
        line-height: 1.3;
    }

    .org-logo-pln-text span {
        color: var(--org-accent);
        font-weight: 700;
    }

    /* ---------- Org Chart Image ---------- */
    .org-chart-image {
        padding: 0 0 3rem;
        position: relative;
        z-index: 2;
    }

    .org-chart-image .image-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 40px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.08);
        background: var(--org-glass);
    }

    .org-chart-image .image-wrapper img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: contain;
    }

    .org-chart-image .image-wrapper .fallback-box {
        display: none;
        padding: 4rem 2rem;
        text-align: center;
    }

    .org-chart-image .image-wrapper .fallback-box i {
        font-size: 3rem;
        color: var(--org-accent);
        margin-bottom: 1rem;
        display: block;
    }

    .org-chart-image .image-wrapper .fallback-box p {
        color: var(--org-text-light);
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 767.98px) {
        .org-header-inner {
            flex-direction: column;
            align-items: flex-start;
        }

        .org-title h1 {
            font-size: 0.9rem;
        }

        .org-title h2 {
            font-size: 1.3rem;
        }

        .org-chart-image .image-wrapper {
            border-radius: 10px;
        }
    }
</style>

<div class="org-page">

    {{-- ============================================
         BREADCRUMB
         ============================================ --}}
    <div class="container px-4 px-lg-5 org-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#">Tentang Kami</a></li>
                <li class="breadcrumb-item active" aria-current="page">Struktur Organisasi</li>
            </ol>
        </nav>
    </div>

    {{-- ============================================
         HEADER SECTION
         ============================================ --}}
    <section class="org-header">
        <div class="container px-4 px-lg-5">
            <div class="org-header-inner">
                <div class="org-header-left">
                    <div class="org-logo-danantara">
                        <img
                            src="{{ asset('assets/images/logo-danantara.png') }}"
                            alt="Logo Danantara"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        />
                        <span class="fallback-text d-none">DNI</span>
                    </div>
                    <div class="org-title">
                        <h1>Bagan Struktur Organisasi</h1>
                        <h2>UP Indramayu</h2>
                    </div>
                </div>
                <div class="org-header-right">
                    <div class="org-logo-pln">
                        <img
                            src="{{ asset('assets/images/logo-pln.png') }}"
                            alt="Logo PLN"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        />
                        <span class="fallback-text d-none">PLN</span>
                    </div>
                    <div class="org-logo-pln-text">
                        PT PLN Nusantara<br><span>Power</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         ORG CHART — GAMBAR
         ============================================ --}}
    <section class="org-chart-image">
        <div class="container px-4 px-lg-5">
            <div class="image-wrapper">
                <img
                    src="{{ asset('assets/images/struktur/struktural_organisasi.png') }}"
                    alt="Bagan Struktur Organisasi UP Indramayu"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                />
                <div class="fallback-box">
                    <i class="fas fa-sitemap"></i>
                    <p>Bagan Struktur Organisasi UP Indramayu</p>
                    <p style="font-size: 0.8rem; color: rgba(255,255,255,0.4); margin-top: 0.5rem;">
                        Letakkan gambar di: <code>public/assets/images/struktur/struktural_organisasi.png</code>
                    </p>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection
