@extends('layouts.app')

@section('title', 'Sosial Media Resmi - PT PLN Nusantara Power')

@push('styles')
    {{-- Resource hints: percepat koneksi DNS/TLS ke domain eksternal yang
         dipakai halaman ini (thumbnail YouTube saat facade, player
         youtube-nocookie setelah diklik). Di-render di atas <style> utama. --}}
    <link rel="preconnect" href="https://i.ytimg.com" crossorigin>
    <link rel="dns-prefetch" href="https://i.ytimg.com">
    <link rel="preconnect" href="https://www.youtube-nocookie.com" crossorigin>
    <link rel="dns-prefetch" href="https://www.youtube-nocookie.com">

    <style>
    /* ============================================
       PAGE CANVAS
       ============================================ */

    /* Seam fix: hilangkan border/shadow navbar di sambungan navbar-hero
       (hanya berlaku pada halaman yang punya hero banner ini) */
    body:has(.hero-header-banner) .navbar-pln:not(.scrolled) {
        border-bottom: none;
        margin-bottom: 0;
        box-shadow: none;
    }

    /* ============================================
       1. HERO HEADER BANNER (Full Width)
       Gradient horizontal: Ocean Blue -> Deep Navy
       ============================================ */
    .hero-header-banner {
        /* Lapisan 1 (atas): fade dari warna dasar navbar (--pln-blue = #005B9C)
           agar titik temu navbar-hero identik & menyatu.
           Lapisan 2 (bawah): gradasi horizontal Ocean Blue -> Deep Navy. */
        background:
            linear-gradient(180deg, var(--pln-blue) 0%, rgba(0, 91, 156, 0) 55%),
            linear-gradient(90deg, #004B87 0%, #0A192F 100%);
        margin-top: 0;
        border-top: none;
        /* 76px = offset navbar fixed-top, digabung ke padding banner
           supaya background banner naik hingga ke bawah navbar tanpa sela. */
        padding: calc(76px + 3.5rem) 0 3.5rem;
        color: #FFFFFF;
        position: relative;
        overflow: hidden;
    }

    /* Aksen dekoratif radial halus di kanan atas */
    .hero-header-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(0, 163, 224, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-header-banner .container { position: relative; z-index: 2; }

    /* ---------- Breadcrumb ---------- */
    .breadcrumb-nav {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.45rem;
        margin-bottom: 1rem;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .breadcrumb-nav a {
        color: rgba(255, 255, 255, 0.7);
        transition: color 0.2s ease;
    }

    .breadcrumb-nav a:hover { color: #FFD100; }

    .breadcrumb-nav .sep { color: rgba(255, 255, 255, 0.4); }

    .breadcrumb-nav .current {
        color: #FFFFFF;
        font-weight: 700;
    }

    /* ---------- Judul & Sub-judul ---------- */
    .hero-header-banner h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #FFFFFF;
        line-height: 1.2;
        margin-bottom: 0.75rem;
    }

    .hero-header-banner h1 .accent { color: #FFD100; }

    .hero-header-banner .subtitle {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.85);
        max-width: 650px;
        line-height: 1.6;
        margin: 0;
    }

    /* ============================================
       2. KONTEN KANVAS (Di bawah banner)
       ============================================ */
    .sosmed-content {
        background: #F8FAFC;
        padding: 4rem 0 5rem;
    }

    .section-label {
        color: #00A3E0;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 0.35rem;
    }

    .section-heading {
        color: #0A2540;
        font-size: 1.55rem;
        font-weight: 700;
        margin-bottom: 0.35rem;
    }

    .section-desc {
        color: #64748B;
        font-size: 0.92rem;
        max-width: 640px;
        margin-bottom: 0;
    }

    /* ============================================
       3. GRID KANAL SOSIAL MEDIA
       ============================================ */
    .sosmed-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 1.75rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .sosmed-card:hover {
        transform: translateY(-6px);
        border-color: rgba(0, 163, 224, 0.45);
        box-shadow: 0 14px 34px rgba(0, 163, 224, 0.14);
    }

    .sosmed-icon {
        width: 54px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 1.4rem;
        margin-bottom: 1.1rem;
        transition: transform 0.3s ease;
    }

    .sosmed-card:hover .sosmed-icon { transform: scale(1.08) rotate(-4deg); }

    /* Warna per platform (ikon tetap putih di atas tile brand) */
    .sosmed-icon.instagram { background: linear-gradient(135deg, #F58529, #DD2A7B 55%, #8134AF); color: #fff; }
    .sosmed-icon.youtube   { background: #FF0000; color: #fff; }
    .sosmed-icon.linkedin  { background: #0A66C2; color: #fff; }
    .sosmed-icon.x         { background: #0A192F; color: #fff; }
    .sosmed-icon.facebook  { background: #1877F2; color: #fff; }

    .sosmed-name {
        color: #0A2540;
        font-size: 1.02rem;
        font-weight: 700;
        line-height: 1.35;
        margin-bottom: 0.2rem;
    }

    .sosmed-username {
        color: #00A3E0;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.7rem;
        word-break: break-all;
    }

    .sosmed-desc {
        color: #64748B;
        font-size: 0.87rem;
        line-height: 1.65;
        margin-bottom: 1.25rem;
        flex: 1;
    }

    .btn-visit {
        margin-top: auto; /* sejajarkan tombol di dasar card */
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.45rem;
        padding: 0.6rem 1.2rem;
        border-radius: 10px;
        border: 1.5px solid #E2E8F0;
        color: #0A2540;
        background: #FFFFFF;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .btn-visit i { font-size: 0.75rem; transition: transform 0.25s ease; }

    .btn-visit:hover {
        background: #00A3E0;
        border-color: #00A3E0;
        color: #FFFFFF;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 163, 224, 0.28);
    }

    .btn-visit:hover i { transform: translateX(3px); }

    /* Ikon X (Twitter) — FA 6.3.0 belum punya fa-x-twitter,
       jadi pakai logo SVG inline (brand mark resmi X).
       0.9em + display:block agar ukuran optik & centering-nya
       sejajar dengan ikon Font Awesome di card lain. */
    .x-logo {
        width: 0.9em;
        height: 0.9em;
        display: block;
        fill: currentColor;
    }

    /* ============================================
       4. EMBED YOUTUBE — CLICK-TO-LOAD FACADE
       Halaman TIDAK memuat player YouTube (~1.5MB JS + media)
       saat load awal. Yang dirender hanya <img> thumbnail ringan;
       iframe player baru disuntikkan saat thumbnail diklik.
       ============================================ */
    .video-facade {
        position: relative;
        aspect-ratio: 16 / 9;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        background: #0A192F center / cover no-repeat;
        z-index: 1; /* di bawah dropdown navbar */
        cursor: pointer;
        border: 0;
        padding: 0;
        width: 100%;
        display: block;
        text-align: inherit;
    }

    .video-facade img.yt-thumb {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease, opacity 0.3s ease;
    }

    .video-facade:hover img.yt-thumb { transform: scale(1.04); }

    /* Overlay gradient tipis agar tombol play & label terbaca */
    .video-facade::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(10, 25, 47, 0) 55%, rgba(10, 25, 47, 0.55) 100%);
        pointer-events: none;
    }

    .video-facade .yt-play {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 68px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(0, 163, 224, 0.92);
        color: #FFFFFF;
        font-size: 1.15rem;
        z-index: 2;
        transition: background 0.25s ease, transform 0.25s ease;
        box-shadow: 0 8px 24px rgba(0, 163, 224, 0.4);
    }

    .video-facade:hover .yt-play {
        background: #00A3E0;
        transform: translate(-50%, -50%) scale(1.08);
    }

    .video-facade .yt-label {
        position: absolute;
        left: 1rem;
        bottom: 0.9rem;
        right: 1rem;
        color: #FFFFFF;
        font-size: 0.85rem;
        font-weight: 600;
        z-index: 2;
        text-shadow: 0 1px 8px rgba(10, 25, 47, 0.8);
    }

    /* Player muncul mengisi facade setelah iframe disuntikkan */
    .video-facade iframe {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* ============================================
       5. CATATAN KEAMANAN
       ============================================ */
    .security-note {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-left: 4px solid #FFD100;
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.05);
    }

    .security-note-icon {
        flex-shrink: 0;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(255, 209, 0, 0.15);
        color: #B7791F;
        font-size: 1.15rem;
    }

    .security-note p {
        color: #1E293B;
        font-size: 0.9rem;
        line-height: 1.7;
        margin: 0;
    }

    .security-note p strong { color: #0A2540; }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 991.98px) {
        .hero-header-banner { padding: calc(76px + 3rem) 0 3rem; }
        .hero-header-banner h1 { font-size: 2.1rem; }
        .sosmed-content { padding: 3rem 0 4rem; }
    }

    @media (max-width: 575.98px) {
        .hero-header-banner { padding: calc(76px + 2.5rem) 0 2.5rem; }
        .hero-header-banner h1 { font-size: 1.7rem; }
        .hero-header-banner .subtitle { font-size: 0.92rem; }
        .breadcrumb-nav { font-size: 0.82rem; }
        .sosmed-content { padding: 2.5rem 0 3.5rem; }
        .sosmed-card { padding: 1.4rem; border-radius: 14px; }
    }
</style>
@endpush

@section('content')
<div class="sosmed-page">

    {{-- ============================================
         1. HERO HEADER BANNER (Full Width, Seamless)
         ============================================ --}}
    <section class="hero-header-banner">
        <div class="container px-4 px-lg-5">
            {{-- Breadcrumb --}}
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Kontak</a>
                <span class="sep">&rsaquo;</span>
                <span class="current">Sosial Media</span>
            </nav>

            {{-- Judul dengan Highlight Kuning --}}
            <h1>
                Sosial Media <span class="accent">Resmi</span>
            </h1>

            {{-- Sub-judul --}}
            <p class="subtitle">
                Ikuti perkembangan terbaru, program kerja, dan edukasi ketenagalistrikan
                melalui saluran media sosial resmi PT PLN Nusantara Power.
            </p>
        </div>
    </section>

    {{-- ============================================
         2. KONTEN KANVAS
         ============================================ --}}
    <section class="sosmed-content">
        <div class="container px-4 px-lg-5">

            {{-- ---------- GRID KANAL RESMI ---------- --}}
            <div class="mb-5">
                <div class="section-label">Kanal Resmi</div>
                <h2 class="section-heading">Ikuti Kami di Media Sosial</h2>
                <p class="section-desc">
                    Saluran resmi PT PLN Nusantara Power untuk informasi, edukasi,
                    dan dokumentasi kegiatan perusahaan.
                </p>
            </div>

            <div class="row g-4">
                {{-- Instagram --}}
                <div class="col-lg-4 col-md-6">
                    <div class="sosmed-card">
                        <div class="sosmed-icon instagram">
                            <i class="fab fa-instagram"></i>
                        </div>
                        <h3 class="sosmed-name">Instagram</h3>
                        <div class="sosmed-username">@plnnusantarapower</div>
                        <p class="sosmed-desc">
                            Berita harian, info edukasi, dan dokumentasi visual kegiatan.
                        </p>
                        <a class="btn-visit" href="https://www.instagram.com/plnnusantarapower" target="_blank" rel="noopener">
                            Kunjungi Akun <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                {{-- YouTube --}}
                <div class="col-lg-4 col-md-6">
                    <div class="sosmed-card">
                        <div class="sosmed-icon youtube">
                            <i class="fab fa-youtube"></i>
                        </div>
                        <h3 class="sosmed-name">YouTube</h3>
                        <div class="sosmed-username">PLN Nusantara Power</div>
                        <p class="sosmed-desc">
                            Video profil, dokumentasi proyek pembangkit, dan liputan khusus.
                        </p>
                        <a class="btn-visit" href="https://www.youtube.com/@plnnusantarapower" target="_blank" rel="noopener">
                            Kunjungi Akun <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                {{-- LinkedIn --}}
                <div class="col-lg-4 col-md-6">
                    <div class="sosmed-card">
                        <div class="sosmed-icon linkedin">
                            <i class="fab fa-linkedin-in"></i>
                        </div>
                        <h3 class="sosmed-name">LinkedIn</h3>
                        <div class="sosmed-username">PT PLN Nusantara Power</div>
                        <p class="sosmed-desc">
                            Informasi karir, pembaruan korporasi, dan jaringan profesional.
                        </p>
                        <a class="btn-visit" href="https://www.linkedin.com/company/pt-pln-nusantara-power" target="_blank" rel="noopener">
                            Kunjungi Akun <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                {{-- X / Twitter --}}
                <div class="col-lg-4 col-md-6">
                    <div class="sosmed-card">
                        <div class="sosmed-icon x">
                            <span class="x-logo" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                                </svg>
                            </span>
                        </div>
                        <h3 class="sosmed-name">X / Twitter</h3>
                        <div class="sosmed-username">@plnnusantarapw</div>
                        <p class="sosmed-desc">
                            Pengumuman singkat dan update info cepat.
                        </p>
                        <a class="btn-visit" href="https://x.com/plnnusantarapw" target="_blank" rel="noopener">
                            Kunjungi Akun <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                {{-- Facebook --}}
                <div class="col-lg-4 col-md-6">
                    <div class="sosmed-card">
                        <div class="sosmed-icon facebook">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                        <h3 class="sosmed-name">Facebook</h3>
                        <div class="sosmed-username">PLN Nusantara Power</div>
                        <p class="sosmed-desc">
                            Komunitas resmi dan info publik.
                        </p>
                        <a class="btn-visit" href="https://www.facebook.com/plnnusantarapower" target="_blank" rel="noopener">
                            Kunjungi Akun <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- ---------- EMBED YOUTUBE UTAMA ---------- --}}
            <div class="row g-4 g-lg-5 mt-4">
                <div class="col-lg-7">
                    <div class="mb-4">
                        <div class="section-label">Video Profil</div>
                        <h2 class="section-heading">Kenali Kami Lebih Dekat</h2>
                        <p class="section-desc">
                            Tonton video profil korporat PT PLN Nusantara Power —
                            mengenal jaringan pembangkitan dan kontribusi kami bagi
                            ketahanan energi nasional.
                        </p>
                    </div>

                    {{-- CLICK-TO-LOAD FACADE — player YouTube hanya diunduh
                         saat tombol diklik. Thumbnail WebP ringan dari i.ytimg.com
                         dengan loading=lazy + decoding=async + fallback jpg. --}}
                    <button type="button" class="video-facade video-facade-yt"
                            data-videoid="ScMzIvxBSi4"
                            aria-label="Putar video profil PT PLN Nusantara Power">
                        <img class="yt-thumb"
                             src="https://i.ytimg.com/vi_webp/ScMzIvxBSi4/maxresdefault.webp"
                             onerror="this.onerror=null;this.src='https://i.ytimg.com/vi/ScMzIvxBSi4/hqdefault.jpg';"
                             alt="Thumbnail video profil PT PLN Nusantara Power"
                             width="1280" height="720"
                             loading="lazy" decoding="async">
                        <span class="yt-play" aria-hidden="true"><i class="fas fa-play"></i></span>
                        <span class="yt-label">Video Profil — PT PLN Nusantara Power</span>
                    </button>
                </div>

                {{-- ---------- CATATAN KEAMANAN ---------- --}}
                <div class="col-lg-5">
                    <div class="mb-4">
                        <div class="section-label">Info Keamanan</div>
                        <h2 class="section-heading">Waspada Akun Palsu</h2>
                        <p class="section-desc">
                            Verifikasi selalu sebelum mengikuti, membalas pesan,
                            atau memberikan data pribadi.
                        </p>
                    </div>

                    <div class="security-note">
                        <div class="security-note-icon">
                            <i class="fas fa-shield-halved"></i>
                        </div>
                        <p>
                            <strong>Pastikan Anda hanya mengikuti dan menerima informasi
                            dari akun media sosial resmi bercentang biru/terverifikasi
                            milik PT PLN Nusantara Power</strong> untuk menghindari penipuan.
                        </p>
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
        var facades = document.querySelectorAll('.video-facade-yt');
        if (!facades.length) return;

        /* CLICK-TO-LOAD: iframe player YouTube (youtube-nocookie, privacy-enhanced)
           baru dibuat saat facade diklik — bukan saat halaman dimuat.
           Autoplay=1 agar pengguna tidak perlu klik dua kali. */
        facades.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var id = btn.getAttribute('data-videoid');
                if (!id) return;

                var iframe = document.createElement('iframe');
                iframe.setAttribute('src', 'https://www.youtube-nocookie.com/embed/' + id + '?autoplay=1&rel=0');
                iframe.setAttribute('title', 'Video Profil PT PLN Nusantara Power');
                iframe.setAttribute('loading', 'lazy');
                iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
                iframe.setAttribute('allowfullscreen', '');
                iframe.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');

                btn.appendChild(iframe);
                btn.classList.add('is-playing');

                /* Lepaskan peran tombol: player yang kini aktif */
                btn.removeAttribute('aria-label');
                var label = btn.querySelector('.yt-label');
                if (label) label.style.display = 'none';
                var play = btn.querySelector('.yt-play');
                if (play) play.style.display = 'none';
            });
        });
    })();
</script>
@endpush
