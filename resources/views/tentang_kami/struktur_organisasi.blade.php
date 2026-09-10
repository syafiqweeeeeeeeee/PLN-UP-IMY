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
        padding: 2.5rem 0 2rem;
        position: relative;
        z-index: 2;
    }

    .org-header-inner {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .org-title {
        text-align: center;
    }

    .org-title h1 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--org-white);
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .org-title h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--org-accent);
        letter-spacing: 1px;
        margin-bottom: 0;
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
        -webkit-user-drag: none;
        user-select: none;
        -moz-user-select: none;
        -webkit-user-select: none;
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
        .org-title h1 {
            font-size: 1.4rem;
            letter-spacing: 1px;
        }

        .org-title h2 {
            font-size: 1.1rem;
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
                <div class="org-title">
                    <h1>Bagan Struktur Organisasi</h1>
                    <h2>UP Indramayu</h2>
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
                    draggable="false"
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
