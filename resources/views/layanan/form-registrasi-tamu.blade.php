@extends('layouts.app')

@section('title', 'Form Registrasi Tamu — PLN Nusantara Power')

@push('styles')
<style>
    /* ============================================================
        FORM REGISTRASI TAMU — TEMA MINIMALIS WARNA PLN
        Background: gradient teal selaras halaman utama.
        Semua rule di-scope ke .pln-page agar tidak mengganggu
        navbar & footer milik layout. Variabel warna lokal
        didefinisikan pada .pln-page (bukan :root global).
        ============================================================ */
    .pln-page {
        /* ---- Variabel lokal halaman ---- */
        --pg-text:   #334155;
        --pg-muted:  #64748B;
        --pg-soft:   #94A3B8;
        --pg-line:   #E4EBF0;
        --pg-panel:  #F8FAFB;
        --pg-blue:   var(--pln-blue,   #008fa8);
        --pg-cyan:   var(--pln-cyan,   #00c2d1);
        --pg-yellow: var(--pln-yellow, #FFE600);
        --pg-red:    var(--pln-red,    #ED1C24);
        --pg-ring:   rgba(0, 143, 168, 0.14);
        --pg-gradient: linear-gradient(135deg, #00c2d1 0%, #00a6bd 55%, #008fa8 100%);

        background:
            radial-gradient(circle at 85% 15%, rgba(255, 255, 255, 0.14) 0, transparent 42%),
            radial-gradient(circle at 10% 90%, rgba(255, 255, 255, 0.10) 0, transparent 40%),
            var(--pg-gradient);
        color: var(--pg-text);
        font-size: 15px;
        line-height: 1.5;
        -webkit-font-smoothing: antialiased;
        /* Kompensasi navbar fixed-top: navbar setinggi ±71px
           (logo 52px + padding), beri ruang lega di atasnya */
        padding: 7rem 1rem 2rem;
    }

    .pln-container { max-width: 1060px; margin: 0 auto; }

    /* ---------- HEADER (bertumpuk: logo → judul → subjudul,
       selaras dengan hero halaman FAQ) ---------- */
    .pln-header { margin-bottom: 1.1rem; text-align: center; }
    .pln-header-row {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.55rem;
    }
    /* Logo tampil langsung di atas gradient (PNG transparan),
       TANPA background supaya tidak memotong logo */
    .pln-logo {
        height: 42px;
        width: auto;
        max-width: 150px;
        object-fit: contain;
        margin: 0;
        display: block;
        filter: drop-shadow(0 2px 6px rgba(2, 32, 48, 0.25));
    }
    .pln-brand-icon {
        display: none;
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.16);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
    }
    .pln-title    { color: #fff; font-weight: 700; font-size: 1.25rem; letter-spacing: -0.01em; margin: 0; }
    .pln-subtitle { color: rgba(255, 255, 255, 0.85); font-size: 0.82rem; margin: 0; }

    /* ---------- KARTU FORM ---------- */
    .pln-card {
        background: #fff;
        border-radius: 18px;
        border: none;
        box-shadow: 0 12px 40px rgba(2, 32, 48, 0.14);
        overflow: hidden;
        animation: pln-fade-up 0.4s ease both;
    }
    @keyframes pln-fade-up {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    /* Aksen strip gradient di tepi atas kartu */
    .pln-card::before {
        content: '';
        display: block;
        height: 4px;
        background: var(--pg-gradient);
    }
    .pln-card-body { padding: 1.2rem 1.15rem 1.35rem; }

    /* Jarak antar seksi pada mode satu kolom */
    .pln-card-body > .pln-section + .pln-section { margin-top: 1.1rem; }

    /* Jarak antar blok field dalam satu seksi (label+input berikutnya) */
    .pln-section > * + * { margin-top: 0.85rem; }

    /* ---------- PANEL SEKSI ---------- */
    .pln-section {
        background: var(--pg-panel);
        border: 1px solid var(--pg-line);
        border-radius: 16px;
        padding: 1.1rem 1.15rem 1.25rem;
    }
    .pln-section-head {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin: 0 0 0.9rem;
    }
    /* Sub-pembatas antar dokumen dalam satu panel (KTP / surat) */
    .pln-doc-divider {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 1.2rem 0 0.85rem;
        padding-top: 1rem;
        border-top: 1px dashed var(--pg-line);
    }
    .pln-doc-divider i { color: var(--pg-soft); font-size: 0.78rem; }
    .pln-doc-divider span {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: var(--pg-muted);
    }
    .pln-section-icon {
        width: 30px;
        height: 30px;
        border-radius: 9px;
        background: linear-gradient(135deg, var(--pg-cyan), var(--pg-blue));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        flex-shrink: 0;
    }
    .pln-section-title {
        margin: 0;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        color: #475569;
    }
    /* Jarak vertikal konsisten antar field di dalam seksi */
    .pln-section > * + * { margin-top: 0.85rem; }

    /* ---------- GRID FIELD ---------- */
    .grid-2    { display: grid; gap: 0.85rem; grid-template-columns: 1fr; }
    .grid-meet { display: grid; gap: 0.85rem; grid-template-columns: 1fr; }

    /* Desktop ≥1024px: dua kolom landscape — Data Diri + Dokumen di kiri,
       Detail Kunjungan di kanan — agar form muat tanpa scroll. */
    @media (min-width: 1024px) {
        .pln-card-body {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 1.25rem;
            row-gap: 1.25rem;
            align-items: start;
        }
        .pln-card-body > .pln-section + .pln-section { margin-top: 0; }
        .pln-section--data   { grid-column: 1; grid-row: 1; }
        .pln-section--doc    { grid-column: 1; grid-row: 2; }
        .pln-section--detail { grid-column: 2; grid-row: 1 / span 2; }
    }

    /* Layar pendek (laptop ±768px tinggi): pangkas header & footnote */
    @media (min-width: 1024px) and (max-height: 860px) {
        .pln-page   { padding-top: 6.25rem; }
        .pln-header { margin-bottom: 0.6rem; }
        .pln-logo   { height: 36px; }
        .pln-footnote { display: none; }
    }

    /* Mobile: navbar bisa lebih tinggi saat menu collapse */
    @media (max-width: 991.98px) {
        .pln-page { padding-top: 6rem; }
    }

    /* Grid field menjadi 2 kolom di layar ≥640px */
    @media (min-width: 640px) {
        .grid-2    { grid-template-columns: 1fr 1fr; }
        .grid-meet { grid-template-columns: 3fr 2fr; }
        .sm\:text-left { text-align: left; }
    }

    /* ---------- LABEL ---------- */
    .pln-label {
        display: block;
        color: #475569;
        font-weight: 600;
        font-size: 0.78rem;
        margin-bottom: 0.3rem;
    }
    .pln-label .required { color: var(--pg-red); }
    .pln-hint { color: var(--pg-soft); font-weight: 400; font-size: 0.72rem; }

    /* Baris label + elemen kanan (mis. penghitung karakter) */
    .pln-label-row {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        gap: 0.5rem;
    }
    .pln-label-row .pln-label { margin-bottom: 0; }
    .pln-counter { font-size: 0.7rem; color: var(--pg-soft); white-space: nowrap; }

    /* ---------- INPUT & TEXTAREA ---------- */
    .pln-input,
    .pln-textarea {
        width: 100%;
        border: 1.5px solid var(--pg-line);
        border-radius: 10px;
        background: #fff;
        padding: 0.58rem 0.9rem 0.58rem 2.4rem;
        font: inherit;
        font-size: 0.86rem;
        color: var(--pg-text);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .pln-textarea {
        padding-left: 0.9rem;
        resize: vertical;
        min-height: 96px;
    }
    .pln-input::placeholder,
    .pln-textarea::placeholder { color: #AEBAC4; }

    .pln-input:hover:not(:focus),
    .pln-textarea:hover:not(:focus) { border-color: #D5DFE6; }

    .pln-input:focus,
    .pln-textarea:focus {
        outline: none;
        border-color: var(--pg-cyan);
        box-shadow: 0 0 0 3px var(--pg-ring);
    }
    .pln-input.has-error,
    .pln-textarea.has-error { border-color: var(--pg-red); }
    .pln-input.has-error:focus,
    .pln-textarea.has-error:focus { box-shadow: 0 0 0 3px rgba(237, 28, 36, 0.1); }

    /* Ikon di dalam input */
    .pln-input-icon { position: relative; }
    .pln-input-icon > i {
        position: absolute;
        left: 0.95rem;
        top: 50%;
        transform: translateY(-50%);
        color: #B6C2CC;
        font-size: 0.85rem;
        pointer-events: none;
        transition: color 0.2s ease;
    }
    .pln-input-icon:focus-within > i { color: var(--pg-blue); }

    /* Sembunyikan spinner input number agar bersih */
    .pln-input::-webkit-outer-spin-button,
    .pln-input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    .pln-input[type="number"] { -moz-appearance: textfield; appearance: textfield; }

    /* Beri ruang untuk ikon kalender bawaan browser */
    .pln-input[type="datetime-local"] { padding-right: 0.5rem; }
    .pln-input[type="datetime-local"]::-webkit-calendar-picker-indicator { opacity: 0.55; cursor: pointer; }

    .pln-field-error {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        color: var(--pg-red);
        font-size: 0.75rem;
        font-weight: 500;
        margin: 0.4rem 0 0;
    }

    /* ---------- UTILITAS LOKAL (dipakai markup & JS) ---------- */
    .hidden      { display: none !important; }
    .flex        { display: flex; }
    .flex-wrap   { flex-wrap: wrap; }
    .flex-1      { flex: 1 1 0%; }
    .gap-2       { gap: 0.5rem; }
    .justify-center { justify-content: center; }
    .text-center { text-align: center; }
    .mt-3        { margin-top: 0.75rem; }

    /* ---------- ALERT ---------- */
    .pln-alert {
        display: flex;
        align-items: flex-start;
        gap: 0.7rem;
        border-radius: 14px;
        padding: 0.75rem 0.95rem;
        margin: 0 0 1rem;
        border: 1px solid transparent;
        font-size: 0.85rem;
        background: #fff;
        box-shadow: 0 4px 16px rgba(2, 32, 48, 0.08);
    }
    .pln-alert > i { margin-top: 0.15rem; }
    .pln-alert p { margin: 0; }
    .pln-alert ul { margin: 0.3rem 0 0; padding-left: 1.1rem; }
    .pln-alert-success { border-color: #BBF7D0; color: #15803D; background: #F0FDF4; }
    .pln-alert-error   { border-color: #FECACA; color: #B91C1C; background: #FEF2F2; }
    .pln-alert-close {
        margin-left: auto;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.1rem 0.3rem;
        opacity: 0.5;
        color: inherit;
        transition: opacity 0.2s ease;
    }
    .pln-alert-close:hover { opacity: 1; }

    /* ---------- DROPZONE ---------- */
    /* Dropzone horizontal (ikon + teks sebaris) agar hemat tinggi.
       Input file diletakkan di LUAR dropzone agar klik tidak
       memicu dialog ganda lewat event bubbling. */
    .pln-dropzone {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.85rem;
        border: 1.5px dashed #CDD9E0;
        border-radius: 14px;
        background: #fff;
        padding: 0.95rem 1.25rem;
        text-align: left;
        cursor: pointer;
        transition: border-color 0.2s ease, background 0.2s ease;
    }
    .pln-dropzone .dz-icon { font-size: 1.45rem; color: #B6C2CC; transition: color 0.2s ease; }
    .pln-dropzone:hover,
    .pln-dropzone:focus-visible,
    .pln-dropzone.is-dragover {
        border-color: var(--pg-cyan);
        background: rgba(0, 194, 209, 0.05);
        outline: none;
    }
    .pln-dropzone.has-error { border-color: var(--pg-red); }
    .pln-dropzone:hover > .dz-icon,
    .pln-dropzone:focus-visible > .dz-icon,
    .pln-dropzone.is-dragover > .dz-icon { color: var(--pg-cyan); }
    .pln-dropzone p { margin: 0; }
    .pln-dropzone-title { font-size: 0.84rem; font-weight: 500; color: var(--pg-text); }
    .pln-dropzone-hint  { font-size: 0.73rem; color: var(--pg-soft); margin-top: 0.1rem !important; }

    /* ---------- KARTU FILE TERPILIH (PDF) ---------- */
    .pln-file-card {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        border: 1px solid var(--pg-line);
        border-radius: 14px;
        background: #fff;
        padding: 0.85rem 1rem;
    }
    .pln-file-card .file-badge {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #FEF2F2;
        color: #DC2626;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .pln-file-card .file-name { font-size: 0.8rem; font-weight: 600; color: var(--pg-text); margin: 0; word-break: break-all; }
    .pln-file-card .file-size { font-size: 0.72rem; color: var(--pg-soft); margin: 0.1rem 0 0; }

    /* ---------- PREVIEW KTP ---------- */
    .pln-preview {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: center;
        border: 1px solid var(--pg-line);
        border-radius: 14px;
        background: #fff;
        padding: 1rem;
    }
    @media (min-width: 640px) {
        .pln-preview { flex-direction: row; }
    }
    .pln-preview img {
        width: 100%;
        max-width: 200px;
        height: 110px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid var(--pg-line);
    }
    .pln-preview-name { font-size: 0.8rem; font-weight: 600; color: var(--pg-text); margin: 0; word-break: break-all; }
    .pln-preview-size { font-size: 0.72rem; color: var(--pg-soft); margin: 0.1rem 0 0; }

    .btn-mini {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 0.4rem 0.85rem;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: background 0.2s ease, color 0.2s ease;
    }
    .btn-mini-danger  { background: #FEF2F2; color: #B91C1C; }
    .btn-mini-danger:hover  { background: #FEE2E2; }
    .btn-mini-neutral { background: #F1F5F9; color: var(--pg-muted); }
    .btn-mini-neutral:hover { color: var(--pg-blue); background: #E2E8F0; }

    /* ---------- TOMBOL AKSI ---------- */
    .pln-actions {
        border-top: 1px solid var(--pg-line);
        background: #FBFDFE;
        padding: 0.9rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.6rem;
    }
    @media (max-width: 639.98px) {
        .pln-actions { flex-direction: column-reverse; align-items: stretch; }
        .pln-required-note { text-align: center; }
    }
    .pln-required-note {
        margin: 0;
        font-size: 0.74rem;
        color: var(--pg-soft);
    }
    .pln-required-note .required { color: var(--pg-red); font-weight: 700; }

    .btn-pln-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.86rem;
        font-weight: 700;
        padding: 0.6rem 1.6rem;
        border-radius: 25px;
        border: none;
        cursor: pointer;
        /* Primary: kuning PLN — identik tombol Login di navbar */
        background: var(--pg-yellow);
        color: var(--pg-blue);
        transition: all 0.2s ease;
    }
    .btn-pln-primary:hover:not(:disabled) {
        background: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(255, 230, 0, 0.45);
    }
    .btn-pln-primary:disabled { opacity: 0.75; cursor: not-allowed; transform: none; }
    @media (max-width: 639.98px) {
        .btn-pln-primary { width: 100%; }
    }

    /* ---------- MODAL SUKSES (pop-up centang hijau) ---------- */
    @keyframes pln-fade-in { from { opacity: 0; } to { opacity: 1; } }
    @keyframes pln-pop {
        from { opacity: 0; transform: scale(0.82) translateY(10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    @keyframes pln-ring {
        from { transform: scale(0.75); opacity: 0.9; }
        to   { transform: scale(1.18); opacity: 0; }
    }
    .pln-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(2, 32, 48, 0.55);
        backdrop-filter: blur(2px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1200;
        padding: 1.25rem;
        animation: pln-fade-in 0.2s ease both;
    }
    .pln-modal-success {
        background: #fff;
        border-radius: 20px;
        padding: 2.25rem 1.75rem 1.75rem;
        max-width: 380px;
        width: 100%;
        text-align: center;
        box-shadow: 0 24px 70px rgba(2, 32, 48, 0.35);
        animation: pln-pop 0.28s ease both;
    }
    .pln-success-icon {
        position: relative;
        width: 76px;
        height: 76px;
        border-radius: 50%;
        background: #DCFCE7;
        color: #16A34A;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.1rem;
        margin: 0 auto 1.1rem;
        animation: pln-pop 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.4) both;
    }
    /* Cincin pulse sekali saat modal muncul */
    .pln-success-icon::before {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: 50%;
        border: 3px solid rgba(22, 163, 74, 0.3);
        animation: pln-ring 1.4s ease-out 0.25s 1 both;
    }
    .pln-success-title {
        font-size: 1.05rem;
        font-weight: 800;
        color: #14532D;
        margin: 0 0 0.4rem;
    }
    .pln-success-text {
        font-size: 0.86rem;
        color: var(--pg-muted);
        margin: 0 0 1.4rem;
        line-height: 1.6;
    }
    .pln-success-close {
        width: 100%;
        border: none;
        cursor: pointer;
    }

    /* ---------- FOOTNOTE ---------- */
    .pln-footnote {
        text-align: center;
        font-size: 0.72rem;
        color: rgba(255, 255, 255, 0.85);
        margin: 1rem 0 0;
    }
    .pln-footnote i { color: var(--pg-yellow); margin-right: 0.25rem; }

    /* Hormati preferensi reduced motion (scoped ke halaman ini) */
    @media (prefers-reduced-motion: reduce) {
        .pln-page *,
        .pln-card { animation: none !important; transition: none !important; }
    }
</style>
@endpush

@section('content')
<div class="pln-page">
    <div class="pln-container">

        {{-- ================= HEADER (kompak, logo + judul sebaris) ================= --}}
        <div class="pln-header">
            <div class="pln-header-row">
                <img src="{{ asset('assets/images/logo-pln.png') }}" alt="PLN Nusantara Power"
                     class="pln-logo"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                <div class="pln-brand-icon">
                    <i class="fas fa-id-card"></i>
                </div>
                <h1 class="pln-title" data-i18n="form.title">Form Registrasi Tamu</h1>
                <p class="pln-subtitle" data-i18n="form.subtitle">Silakan lengkapi data diri Anda untuk pendaftaran kunjungan.</p>
            </div>
        </div>

        {{-- ================= POP-UP SUKSES ================= --}}
        @if(session('success'))
        <div class="pln-modal-overlay" id="successModal">
            <div class="pln-modal-success" role="dialog" aria-modal="true" aria-labelledby="successTitle">
                <div class="pln-success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="pln-success-title" id="successTitle" data-i18n="form.success_title">Data Anda Berhasil Dikirim!</h2>
                <p class="pln-success-text" data-i18n="form.success_text">Menunggu konfirmasi admin.<br>Silakan cek email / WhatsApp Anda untuk informasi selanjutnya.</p>
                <button type="button" class="btn-pln-primary pln-success-close" onclick="closeSuccessModal()" data-i18n="form.btn_done">
                    <i class="fas fa-check"></i> Selesai
                </button>
            </div>
        </div>
        @endif

        {{-- ================= ERROR VALIDASI ================= --}}
        @if($errors->any())
            <div class="pln-alert pln-alert-error" id="alert-error" role="alert">
                <i class="fas fa-circle-exclamation"></i>
                <div class="flex-1">
                    <p style="font-weight:600;" data-i18n="form.error_heading">Periksa kembali isian berikut:</p>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="pln-alert-close" onclick="this.closest('#alert-error').remove()" aria-label="Tutup">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>
        @endif

        {{-- ================= FORM ================= --}}
        <form id="form-registrasi" action="{{ route('layanan.registrasi-tamu.store') }}" method="POST" enctype="multipart/form-data" class="pln-card">

            @csrf

            <div class="pln-card-body">

                {{-- ========== SEKSI 1: DATA DIRI ========== --}}
                <div class="pln-section pln-section--data">
                    <div class="pln-section-head">
                        <span class="pln-section-icon"><i class="fas fa-user"></i></span>
                        <h2 class="pln-section-title" data-i18n="form.section_identity">Data Diri</h2>
                    </div>

                    {{-- NIK / No. KTP --}}
                    <div>
                        <label for="nik" class="pln-label" data-i18n="form.label_nik">
                            NIK / No. KTP <span class="required">*</span>
                        </label>
                        <div class="pln-input-icon">
                            <i class="fas fa-fingerprint"></i>
                            <input type="text" id="nik" name="nik" inputmode="numeric" maxlength="16"
                                   value="{{ old('nik') }}"
                                   placeholder="Masukkan 16 digit NIK"
                                   data-i18n-placeholder="form.ph_nik"
                                   required autocomplete="off"
                                   class="pln-input @error('nik') has-error @enderror" />
                        </div>
                        @error('nik')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama Lengkap + Instansi --}}
                    <div class="grid-2">
                        <div>
                            <label for="nama" class="pln-label" data-i18n="form.label_nama">
                                Nama Lengkap <span class="required">*</span>
                            </label>
                            <div class="pln-input-icon">
                                <i class="fas fa-user"></i>
                                <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                       placeholder="Nama sesuai KTP" required autocomplete="name"
                                       data-i18n-placeholder="form.ph_nama"
                                       class="pln-input @error('nama') has-error @enderror" />
                            </div>
                            @error('nama')
                                <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="instansi" class="pln-label" data-i18n="form.label_instansi">
                                Perusahaan / Instansi <span class="required">*</span>
                            </label>
                            <div class="pln-input-icon">
                                <i class="fas fa-building"></i>
                                <input type="text" id="instansi" name="instansi" value="{{ old('instansi') }}"
                                       placeholder="Nama instansi asal" autocomplete="organization" required
                                       data-i18n-placeholder="form.ph_instansi"
                                       class="pln-input @error('instansi') has-error @enderror" />
                            </div>
                            @error('instansi')
                                <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- No. HP + Email --}}
                    <div class="grid-2">
                        <div>
                            <label for="no_hp" class="pln-label" data-i18n="form.label_nohp">
                                No. WhatsApp / HP <span class="required">*</span>
                            </label>
                            <div class="pln-input-icon">
                                <i class="fab fa-whatsapp"></i>
                                <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                       placeholder="08xxxxxxxxxx" required autocomplete="tel"
                                       data-i18n-placeholder="form.ph_nohp"
                                       class="pln-input @error('no_hp') has-error @enderror" />
                            </div>
                            @error('no_hp')
                                <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="pln-label" data-i18n="form.label_email">
                                Email <span class="required">*</span>
                            </label>
                            <div class="pln-input-icon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                       placeholder="nama@email.com" autocomplete="email" required
                                       data-i18n-placeholder="form.ph_email"
                                       class="pln-input @error('email') has-error @enderror" />
                            </div>
                            @error('email')
                                <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ========== SEKSI 2: DOKUMEN (KTP + SURAT) ========== --}}
                <div class="pln-section pln-section--doc">
                    <div class="pln-section-head">
                        <span class="pln-section-icon"><i class="fas fa-id-card"></i></span>
                        <h2 class="pln-section-title" data-i18n="form.section_documents">Dokumen</h2>
                    </div>

                    <div>
                        <label class="pln-label">
                            <span data-i18n="form.doc_ktp">Foto KTP</span> <span class="required">*</span>
                            <span class="pln-hint" data-i18n="form.doc_ktp_hint">JPG / PNG, maks 2MB</span>
                        </label>

                        {{-- Input file DI LUAR dropzone (hindari dialog ganda) --}}
                        <input type="file" id="foto_ktp" name="foto_ktp" accept="image/jpeg,image/png" class="hidden"
                               onchange="previewKtp(this)" />

                        {{-- Dropzone (tersembunyi setelah ada preview) --}}
                        <div id="ktp-upload-area" class="pln-dropzone @error('foto_ktp') has-error @enderror"
                             role="button" tabindex="0" aria-label="Pilih foto KTP"
                             onclick="document.getElementById('foto_ktp').click()">
                            <i class="fas fa-cloud-arrow-up dz-icon"></i>
                            <div>
                                <p class="pln-dropzone-title" data-i18n="form.dz_ktp_title">Klik untuk memilih foto KTP</p>
                                <p class="pln-dropzone-hint" data-i18n="form.dz_ktp_hint">atau seret &amp; letakkan di sini</p>
                            </div>
                        </div>

                        {{-- Preview gambar + tombol hapus/ganti --}}
                        <div id="ktp-preview-area" class="hidden">
                            <div class="pln-preview">
                                <img id="ktp-preview" src="" alt="Preview KTP" />
                                <div class="flex-1 text-center sm:text-left">
                                    <p id="ktp-file-name" class="pln-preview-name"></p>
                                    <p id="ktp-file-size" class="pln-preview-size"></p>
                                    <div class="flex flex-wrap gap-2 justify-center mt-3 sm:text-left">
                                        <button type="button" class="btn-mini btn-mini-danger" onclick="removeKtp()">
                                            <i class="fas fa-trash-can"></i> Hapus
                                        </button>
                                        <button type="button" class="btn-mini btn-mini-neutral" onclick="document.getElementById('foto_ktp').click()">
                                            <i class="fas fa-rotate"></i> Ganti
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @error('foto_ktp')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Sub-seksi: surat permohonan (opsional) --}}
                    <div class="pln-doc-divider">
                        <i class="fas fa-file-pdf"></i>
                        <span data-i18n="form.doc_surat_divider">Surat Permohonan / Undangan (Opsional)</span>
                    </div>

                    <div>
                        <label class="pln-label">
                            <span data-i18n="form.doc_surat_label">Upload Surat dari Perusahaan</span>
                            <span class="pln-hint" data-i18n="form.doc_surat_hint">PDF, maks 5MB</span>
                        </label>

                        {{-- Input file di luar dropzone (hindari dialog ganda) --}}
                        <input type="file" id="surat_jalan" name="surat_jalan" accept="application/pdf" class="hidden"
                               onchange="previewSurat(this)" />

                        {{-- Dropzone (tersembunyi setelah ada file terpilih) --}}
                        <div id="surat-upload-area" class="pln-dropzone @error('surat_jalan') has-error @enderror"
                             role="button" tabindex="0" aria-label="Pilih file surat PDF"
                             onclick="document.getElementById('surat_jalan').click()">
                            <i class="fas fa-file-pdf dz-icon"></i>
                            <div>
                                <p class="pln-dropzone-title" data-i18n="form.dz_surat_title">Klik untuk memilih file surat (PDF)</p>
                                <p class="pln-dropzone-hint" data-i18n="form.dz_surat_hint">Opsional — surat permohonan/undangan resmi dari perusahaan Anda</p>
                            </div>
                        </div>

                        {{-- Kartu file terpilih --}}
                        <div id="surat-preview-area" class="hidden">
                            <div class="pln-file-card">
                                <div class="file-badge"><i class="fas fa-file-pdf"></i></div>
                                <div class="flex-1">
                                    <p id="surat-file-name" class="file-name"></p>
                                    <p id="surat-file-size" class="file-size"></p>
                                </div>
                                <div class="flex gap-2">
                                    <button type="button" class="btn-mini btn-mini-danger" onclick="removeSurat()">
                                        <i class="fas fa-trash-can"></i> Hapus
                                    </button>
                                    <button type="button" class="btn-mini btn-mini-neutral" onclick="document.getElementById('surat_jalan').click()">
                                        <i class="fas fa-rotate"></i> Ganti
                                    </button>
                                </div>
                            </div>
                        </div>

                        @error('surat_jalan')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- ========== SEKSI 3: DETAIL KUNJUNGAN ========== --}}
                <div class="pln-section pln-section--detail">
                    <div class="pln-section-head">
                        <span class="pln-section-icon"><i class="fas fa-calendar-check"></i></span>
                        <h2 class="pln-section-title" data-i18n="form.section_visit">Detail Kunjungan</h2>
                    </div>

                    {{-- Orang/Divisi yang Ditemui --}}
                    <div>
                        <label for="tujuan_ditemui" class="pln-label" data-i18n="form.label_tujuan">
                            Orang / Divisi yang Ditemui <span class="required">*</span>
                        </label>
                        <div class="pln-input-icon">
                            <i class="fas fa-user-tie"></i>
                            <input type="text" id="tujuan_ditemui" name="tujuan_ditemui" value="{{ old('tujuan_ditemui') }}"
                                   placeholder="Nama orang / divisi tujuan" required
                                   data-i18n-placeholder="form.ph_tujuan"
                                   class="pln-input @error('tujuan_ditemui') has-error @enderror" />
                        </div>
                        @error('tujuan_ditemui')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal & Jam Kunjungan + Jumlah Tamu --}}
                    <div class="grid-meet">
                        <div>
                            <label for="tanggal_kunjungan" class="pln-label" data-i18n="form.label_tanggal">
                                Tanggal &amp; Jam Kunjungan <span class="required">*</span>
                            </label>
                            <div class="pln-input-icon">
                                <i class="fas fa-calendar-day"></i>
                                <input type="datetime-local" id="tanggal_kunjungan" name="tanggal_kunjungan"
                                       value="{{ old('tanggal_kunjungan') }}" required
                                       min="{{ now()->format('Y-m-d\\TH:i') }}"
                                       class="pln-input @error('tanggal_kunjungan') has-error @enderror" />
                            </div>
                            @error('tanggal_kunjungan')
                                <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="jumlah_tamu" class="pln-label" data-i18n="form.label_jumlah">
                                Jumlah Tamu <span class="required">*</span>
                            </label>
                            <div class="pln-input-icon">
                                <i class="fas fa-users"></i>
                                <input type="number" id="jumlah_tamu" name="jumlah_tamu" min="1" max="100"
                                       value="{{ old('jumlah_tamu', 1) }}" required
                                       class="pln-input @error('jumlah_tamu') has-error @enderror" />
                            </div>
                            @error('jumlah_tamu')
                                <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Maksud & Keperluan --}}
                    <div>
                        <div class="pln-label-row">
                            <label for="keperluan" class="pln-label" data-i18n="form.label_keperluan">
                                Maksud &amp; Keperluan Kunjungan <span class="required">*</span>
                            </label>
                            <span class="pln-counter"><span id="keperluan-count">0</span>/2000</span>
                        </div>
                        <textarea id="keperluan" name="keperluan" rows="4" maxlength="2000" required
                                  placeholder="Jelaskan singkat maksud dan keperluan kunjungan Anda..."
                                  data-i18n-placeholder="form.ph_keperluan"
                                  class="pln-textarea @error('keperluan') has-error @enderror">{{ old('keperluan') }}</textarea>
                        @error('keperluan')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- ================= TOMBOL AKSI ================= --}}
            <div class="pln-actions">
                <p class="pln-required-note" data-i18n="form.btn_note"><span class="required">*</span> Wajib diisi. Data Anda aman &amp; hanya untuk keperluan registrasi.</p>
                <button type="submit" class="btn-pln-primary" id="btn-submit" data-i18n="form.btn_submit">
                    <i class="fas fa-paper-plane"></i> Daftar Sekarang
                </button>
            </div>
        </form>

        <p class="pln-footnote">
            <i class="fas fa-shield-halved"></i> <span data-i18n="form.footnote">Data Anda disimpan aman dan hanya digunakan untuk keperluan registrasi kunjungan.</span>
        </p>
    </div>
</div>
@endsection

@push('scripts')
{{-- ================= JAVASCRIPT: PREVIEW KTP + POLISH INPUT ================= --}}
<script>
    const inputKtp    = document.getElementById('foto_ktp');
    const uploadArea  = document.getElementById('ktp-upload-area');
    const previewArea = document.getElementById('ktp-preview-area');
    const previewImg  = document.getElementById('ktp-preview');
    const fileNameEl  = document.getElementById('ktp-file-name');
    const fileSizeEl  = document.getElementById('ktp-file-size');
    const nikInput    = document.getElementById('nik');

    const MAX_SIZE = 2 * 1024 * 1024; // 2MB

    /* NIK: terima digit saja, maksimal 16 karakter */
    if (nikInput) {
        nikInput.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 16);
        });
    }

    /* ===== Pop-up sukses setelah submit ===== */
    const successModal = document.getElementById('successModal');

    if (successModal) {
        /* Kunci scroll halaman selama modal tampil */
        document.body.style.overflow = 'hidden';

        /* Tutup lewat tombol Escape */
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && document.getElementById('successModal')) {
                closeSuccessModal();
            }
        });
    }

    function closeSuccessModal() {
        const modal = document.getElementById('successModal');
        if (!modal) return;
        document.body.style.overflow = '';
        modal.remove();
    }

    /* Tampilkan preview gambar segera setelah file dipilih */
    function previewKtp(input) {
        if (!input.files || !input.files[0]) return;

        const file = input.files[0];

        /* Validasi tipe & ukuran di sisi klien (pengalaman lebih cepat;
           validasi server tetap sumber kebenaran) */
        if (!['image/jpeg', 'image/png'].includes(file.type)) {
            alert('Format file harus JPG atau PNG.');
            removeKtp();
            return;
        }
        if (file.size > MAX_SIZE) {
            alert('Ukuran foto maksimal 2MB.');
            removeKtp();
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
            fileNameEl.textContent = file.name;
            fileSizeEl.textContent = (file.size / 1024).toFixed(1) + ' KB';

            uploadArea.classList.add('hidden');
            previewArea.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    /* Hapus/batal: kosongkan input, sembunyikan preview, kembalikan dropzone */
    function removeKtp() {
        inputKtp.value = '';
        previewImg.src = '';
        fileNameEl.textContent = '';
        fileSizeEl.textContent = '';

        previewArea.classList.add('hidden');
        uploadArea.classList.remove('hidden');
    }

    /* Drag & drop — highlight pakai class .is-dragover (custom CSS) */
    ['dragover', 'dragenter'].forEach(evt =>
        uploadArea.addEventListener(evt, e => { e.preventDefault(); uploadArea.classList.add('is-dragover'); })
    );
    ['dragleave', 'drop'].forEach(evt =>
        uploadArea.addEventListener(evt, e => { e.preventDefault(); uploadArea.classList.remove('is-dragover'); })
    );
    uploadArea.addEventListener('drop', e => {
        const files = e.dataTransfer.files;
        if (files.length) {
            inputKtp.files = files;
            previewKtp(inputKtp);
        }
    });

    /* ===== Surat permohonan (PDF) ===== */
    const inputSurat     = document.getElementById('surat_jalan');
    const suratArea      = document.getElementById('surat-upload-area');
    const suratPrevArea  = document.getElementById('surat-preview-area');
    const suratNameEl    = document.getElementById('surat-file-name');
    const suratSizeEl    = document.getElementById('surat-file-size');

    const MAX_SURAT = 5 * 1024 * 1024; // 5MB

    function previewSurat(input) {
        if (!input.files || !input.files[0]) return;

        const file = input.files[0];

        /* Validasi klien: harus PDF & maks 5MB (server tetap sumber kebenaran) */
        if (file.type !== 'application/pdf' && !file.name.toLowerCase().endsWith('.pdf')) {
            alert('File surat harus berformat PDF.');
            removeSurat();
            return;
        }
        if (file.size > MAX_SURAT) {
            alert('Ukuran file surat maksimal 5MB.');
            removeSurat();
            return;
        }

        suratNameEl.textContent = file.name;
        suratSizeEl.textContent = (file.size / 1024).toFixed(1) + ' KB';

        suratArea.classList.add('hidden');
        suratPrevArea.classList.remove('hidden');
    }

    function removeSurat() {
        inputSurat.value = '';
        suratNameEl.textContent = '';
        suratSizeEl.textContent = '';

        suratPrevArea.classList.add('hidden');
        suratArea.classList.remove('hidden');
    }

    /* Drag & drop untuk dropzone surat */
    ['dragover', 'dragenter'].forEach(evt =>
        suratArea.addEventListener(evt, e => { e.preventDefault(); suratArea.classList.add('is-dragover'); })
    );
    ['dragleave', 'drop'].forEach(evt =>
        suratArea.addEventListener(evt, e => { e.preventDefault(); suratArea.classList.remove('is-dragover'); })
    );
    suratArea.addEventListener('drop', e => {
        const files = e.dataTransfer.files;
        if (files.length) {
            inputSurat.files = files;
            previewSurat(inputSurat);
        }
    });

    /* Dropzone surat bisa dioperasikan dari keyboard (Enter / Space) */
    suratArea.addEventListener('keydown', e => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            inputSurat.click();
        }
    });

    /* Dropzone bisa dioperasikan dari keyboard (Enter / Space) */
    uploadArea.addEventListener('keydown', e => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            inputKtp.click();
        }
    });

    /* Penghitung karakter Maksud & Keperluan */
    const keperluanInput = document.getElementById('keperluan');
    const keperluanCount = document.getElementById('keperluan-count');
    if (keperluanInput && keperluanCount) {
        const updateCount = () => { keperluanCount.textContent = keperluanInput.value.length; };
        keperluanInput.addEventListener('input', updateCount);
        updateCount(); // inisialisasi (termasuk saat old() mengembalikan isi)
    }

    /* Tombol submit: tampilkan status memproses, cegah klik ganda */
    const form      = document.getElementById('form-registrasi');
    const submitBtn = document.getElementById('btn-submit');
    if (form && submitBtn) {
        form.addEventListener('submit', function () {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Memproses...';
        });
        /* Pulihkan tombol saat kembali ke halaman via cache browser */
        window.addEventListener('pageshow', function () {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Daftar Sekarang';
        });
    }
</script>
@endpush
