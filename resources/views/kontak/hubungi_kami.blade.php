@extends('layouts.app')

@section('title', 'Hubungi Kami — E-PPID PLN Nusantara Power')

@push('styles')
<style>
    /* ============================================
       PAGE CANVAS
       (offset navbar fixed-top dipindah ke dalam hero banner
        agar banner menempel mulus di bawah navbar — tanpa strip putih)
       ============================================ */

    /* Seam fix: hilangkan border/shadow navbar di sambungan navbar-hero
       (hanya berlaku pada halaman yang punya hero banner ini) */
    body:has(.hero-header-banner) .navbar-pln:not(.scrolled) {
        border-bottom: none;
        margin-bottom: 0;
        box-shadow: none;
    }

    /* ============================================
       1. HERO HEADER BANNER
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
           (bukan padding pada wrapper) supaya background banner naik
           hingga ke bawah navbar tanpa sela. */
        padding: calc(76px + 3.5rem) 0 3.5rem;
        color: #FFFFFF;
        position: relative;
        overflow: hidden;
    }

    /* Aksen dekoratif radial halus di kanan atas (gaya Berita) */
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
    .contact-content {
        background: #F8FAFC;
        padding: 4rem 0 5rem;
    }

    .contact-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.05);
    }

    .contact-card-form {
        padding: 2.25rem;
        height: 100%;
        transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .contact-card-form:hover {
        border-color: rgba(0, 163, 224, 0.35);
        box-shadow: 0 16px 40px rgba(0, 163, 224, 0.12);
    }

    /* ---------- Item Informasi Kontak ---------- */
    .contact-info-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1.1rem 0;
    }

    .contact-info-item + .contact-info-item { border-top: 1px solid #E2E8F0; }

    .contact-info-icon {
        flex-shrink: 0;
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(0, 163, 224, 0.1);
        color: #00A3E0;
        transition: background 0.3s ease, color 0.3s ease, transform 0.3s ease;
    }

    .contact-info-item:hover .contact-info-icon {
        background: #00A3E0;
        color: #FFFFFF;
        transform: translateY(-2px);
    }

    .contact-info-label {
        color: #64748B;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 0.25rem;
    }

    .contact-info-value {
        color: #1E293B;
        font-size: 0.95rem;
        font-weight: 500;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .contact-info-value a { color: #1E293B; transition: color 0.2s ease; }
    .contact-info-value a:hover { color: #00A3E0; }

    /* ---------- CTA CARD KECIL ---------- */
    .contact-cta {
        display: flex;
        align-items: flex-start;
        gap: 0.9rem;
        margin-top: 1.75rem;
        padding: 1.15rem 1.25rem;
        border-radius: 14px;
        background: linear-gradient(135deg, #0A2540, #102A43);
        color: #FFFFFF;
    }

    .contact-cta-icon {
        flex-shrink: 0;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: rgba(0, 163, 224, 0.18);
        color: #00A3E0;
    }

    .contact-cta-title {
        color: #FFFFFF;
        font-size: 0.92rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .contact-cta p {
        color: rgba(255, 255, 255, 0.75);
        font-size: 0.83rem;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* ============================================
       3. FORMULIR
       ============================================ */
    .form-heading {
        color: #0A2540;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.35rem;
    }

    .form-heading-sub {
        color: #64748B;
        font-size: 0.88rem;
        margin-bottom: 1.75rem;
    }

    .form-label-custom {
        color: #1E293B;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.4rem;
    }

    .form-label-custom .req { color: #00A3E0; }

    .form-control-custom {
        width: 100%;
        padding: 0.7rem 0.95rem;
        font-size: 0.92rem;
        color: #1E293B;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    }

    .form-control-custom::placeholder { color: #94A3B8; }

    .form-control-custom:focus {
        background: #FFFFFF;
        border-color: #00A3E0;
        box-shadow: 0 0 0 3px rgba(0, 163, 224, 0.18);
    }

    textarea.form-control-custom { resize: vertical; min-height: 120px; }

    select.form-control-custom {
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748B' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpath d='m6 9 6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.9rem center;
        padding-right: 2.5rem;
        cursor: pointer;
    }

    .btn-submit {
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.55rem;
        background: #00A3E0;
        color: #FFFFFF;
        font-weight: 700;
        font-size: 0.95rem;
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 10px;
        transition: background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
    }

    .btn-submit:hover {
        background: #0089BE;
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(0, 163, 224, 0.3);
        color: #FFFFFF;
    }

    .btn-submit:focus-visible {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 163, 224, 0.35);
    }

    .btn-submit:disabled { opacity: 0.7; transform: none; cursor: not-allowed; }

    .form-note {
        color: #64748B;
        font-size: 0.8rem;
        text-align: center;
        margin: 1rem 0 0;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 991.98px) {
        .hero-header-banner { padding: calc(76px + 3rem) 0 3rem; }
        .hero-header-banner h1 { font-size: 2.1rem; }
        .contact-content { padding: 3rem 0 4rem; }
        .contact-card-form { padding: 1.75rem; }
    }

    @media (max-width: 575.98px) {
        .hero-header-banner { padding: calc(76px + 2.5rem) 0 2.5rem; }
        .hero-header-banner h1 { font-size: 1.7rem; }
        .hero-header-banner .subtitle { font-size: 0.92rem; }
        .breadcrumb-nav { font-size: 0.82rem; }
        .contact-content { padding: 2.5rem 0 3.5rem; }
        .contact-card-form { padding: 1.4rem; border-radius: 14px; }
    }
</style>
@endpush

@section('content')
<div class="contact-page">

    {{-- ============================================
         1. HERO HEADER BANNER (Full Width)
         ============================================ --}}
    <section class="hero-header-banner">
        <div class="container px-4 px-lg-5">
            {{-- Breadcrumb --}}
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Kontak</a>
                <span class="sep">&rsaquo;</span>
                <span class="current">Hubungi Kami</span>
            </nav>

            {{-- Judul dengan Highlight Kuning --}}
            <h1>
                Hubungi <span class="accent">Kami</span>
            </h1>

            {{-- Sub-judul --}}
            <p class="subtitle">
                Kami siap mendengarkan dan membantu Anda. Silakan hubungi tim kami melalui saluran
                kontak di bawah atau kirimkan pesan langsung melalui formulir.
            </p>
        </div>
    </section>

    {{-- ============================================
         2. KONTEN KANVAS — Informasi Kontak & Form
         ============================================ --}}
    <section class="contact-content">
        <div class="container px-4 px-lg-5">
            <div class="row g-4 g-lg-5">

                {{-- ---------- KOLOM KIRI: INFORMASI KONTAK ---------- --}}
                <div class="col-lg-6">
                    <div class="contact-card p-4 p-md-4 h-100 d-flex flex-column">
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-location-dot" style="font-size: 1.1rem;"></i>
                            </div>
                            <div>
                                <div class="contact-info-label">Kantor Pusat</div>
                                <p class="contact-info-value">
                                    PT PLN Nusantara Power<br>
                                    Jl. Ketintang Baru No. 11, Surabaya, Jawa Timur
                                </p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-phone" style="font-size: 1.1rem;"></i>
                            </div>
                            <div>
                                <div class="contact-info-label">Telepon</div>
                                <p class="contact-info-value">
                                    <a href="tel:+62318283180">(031) 8283180</a>
                                </p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-envelope" style="font-size: 1.1rem;"></i>
                            </div>
                            <div>
                                <div class="contact-info-label">Email Resmi</div>
                                <p class="contact-info-value">
                                    <a href="mailto:info@plnnusantarapower.co.id">info@plnnusantarapower.co.id</a>
                                </p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-clock" style="font-size: 1.1rem;"></i>
                            </div>
                            <div>
                                <div class="contact-info-label">Jam Operasional</div>
                                <p class="contact-info-value">Senin – Jumat | 08.00 – 17.00 WIB</p>
                            </div>
                        </div>

                        {{-- CTA CARD KECIL --}}
                        <div class="contact-cta mt-auto">
                            <div class="contact-cta-icon">
                                <i class="fas fa-headset" style="font-size: 1rem;"></i>
                            </div>
                            <div>
                                <div class="contact-cta-title">Butuh respon cepat?</div>
                                <p>Layanan Pelanggan kami beroperasi pada jam kerja resmi.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ---------- KOLOM KANAN: FORMULIR PESAN ---------- --}}
                <div class="col-lg-6">
                    <div class="contact-card contact-card-form">
                        <h2 class="form-heading">Kirim Pesan</h2>
                        <p class="form-heading-sub">Isi formulir di bawah dan tim kami akan merespons secepatnya.</p>

                        <form id="contactForm" action="#" method="POST" novalidate>
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label-custom">Nama Lengkap <span class="req">*</span></label>
                                    <input type="text" class="form-control-custom" id="nama" name="nama"
                                           placeholder="Masukkan nama lengkap" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label-custom">Alamat Email <span class="req">*</span></label>
                                    <input type="email" class="form-control-custom" id="email" name="email"
                                           placeholder="nama@email.com" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="telepon" class="form-label-custom">Nomor Telepon / WhatsApp <span class="req">*</span></label>
                                    <input type="tel" class="form-control-custom" id="telepon" name="telepon"
                                           placeholder="08xx xxxx xxxx" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="kategori" class="form-label-custom">Kategori Keperluan <span class="req">*</span></label>
                                    <select class="form-control-custom" id="kategori" name="kategori" required>
                                        <option value="" selected disabled>Pilih kategori</option>
                                        <option value="pertanyaan_umum">Pertanyaan Umum</option>
                                        <option value="kerjasama_bisnis">Kerjasama Bisnis</option>
                                        <option value="layanan_om">Layanan Pembangkitan/O&amp;M</option>
                                        <option value="media_pers">Media &amp; Pers</option>
                                        <option value="karir">Karir</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="subjek" class="form-label-custom">Subjek Pesan <span class="req">*</span></label>
                                    <input type="text" class="form-control-custom" id="subjek" name="subjek"
                                           placeholder="Tuliskan subjek pesan" required>
                                </div>

                                <div class="col-12">
                                    <label for="pesan" class="form-label-custom">Pesan Anda <span class="req">*</span></label>
                                    <textarea class="form-control-custom" id="pesan" name="pesan" rows="5"
                                              placeholder="Tuliskan pesan Anda secara rinci..." required></textarea>
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn-submit" id="btnSubmit">
                                        <i class="fas fa-paper-plane"></i> Kirim Pesan
                                    </button>
                                    <p class="form-note">Tim kami akan merespons pesan Anda pada jam kerja resmi.</p>
                                </div>
                            </div>
                        </form>
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
        var form = document.getElementById('contactForm');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            var btn = document.getElementById('btnSubmit');
            var original = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Mengirim...';

            // Simulasi pengiriman — ganti dengan fetch/AJAX ke endpoint backend sesungguhnya.
            setTimeout(function () {
                btn.disabled = false;
                btn.innerHTML = original;
                form.reset();
                alert('Terima kasih! Pesan Anda telah berhasil dikirim.');
            }, 900);
        });
    })();
</script>
@endpush
