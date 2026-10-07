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
    .pln-card-body { padding: 1.1rem 1rem 1.25rem; }

    /* Jarak antar seksi pada mode satu kolom */
    .pln-card-body > .pln-section + .pln-section { margin-top: 1rem; }

    /* Jarak antar blok field dalam satu seksi (label+input berikutnya) */
    .pln-section > * + * { margin-top: 0.8rem; }

    /* ---- MOBILE (≤639px): lebih kompak agar muat tanpa scroll berlebih ---- */
    @media (max-width: 639.98px) {
        .pln-card-body {
            padding: 0.9rem 0.85rem 1rem;
        }

        .pln-card-body > .pln-section + .pln-section { margin-top: 0.8rem; }

        .pln-section > * + * { margin-top: 0.65rem; }

        .pln-section {
            padding: 0.85rem 0.85rem 1rem;
        }

        .pln-section-head {
            margin-bottom: 0.7rem;
        }

        .pln-section-icon {
            width: 26px;
            height: 26px;
            font-size: 0.65rem;
        }

        .pln-section-title {
            font-size: 0.7rem;
        }

        .pln-label {
            font-size: 0.74rem;
            margin-bottom: 0.2rem;
        }

        .pln-input,
        .pln-textarea,
        select.pln-input {
            padding: 0.5rem 0.8rem 0.5rem 2.2rem;
            font-size: 0.82rem;
        }

        .pln-textarea {
            padding-left: 0.8rem;
            min-height: 80px;
        }

        .pln-input-icon > i {
            left: 0.75rem;
            font-size: 0.8rem;
        }

        .pln-input[type="date"] { padding-right: 0.3rem; }

        select.pln-input {
            padding-right: 2.2rem;
            background-position: right 0.6rem center;
            background-size: 0.85rem;
        }

        select.pln-input option {
            padding: 0.25rem 0.4rem;
        }

        .btn-pln-primary {
            font-size: 0.82rem;
            padding: 0.5rem 1.2rem;
        }

        .pln-actions {
            padding: 0.75rem 1rem;
        }

        .pln-hint { font-size: 0.68rem; }
    }

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

    /* Tablet/desktop kecil (≥640px): grid-2 jadi 2 kolom */
    @media (min-width: 640px) {
        .grid-2 { grid-template-columns: 1fr 1fr; }
    }

    /* Tablet landscape (≥900px): grid-meet — Tanggal | Jam | Jumlah
       jadi 3 kolom sejajar */
    @media (min-width: 900px) {        .grid-meet {
            grid-template-columns: 1fr 1fr 1fr;
        }
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
    .pln-input[type="date"] { padding-right: 0.5rem; }
    .pln-input[type="date"]::-webkit-calendar-picker-indicator { opacity: 0.55; cursor: pointer; }

    /* Dropdown (jam & divisi) */
    select.pln-input {
        padding-right: 2.2rem;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748B' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.8rem center;
        background-size: 1rem;
        padding-right: 2.5rem;
    }

    /* Opsi jam yang TERBLOKIR (rentang 3 jam sudah di-approve untuk
       divisi sama): teks & latar merah — disabled oleh JS sehingga
       tidak dapat dipilih */
    select.pln-input option.slot-penuh { color: #B91C1C; background: #FEF2F2; font-weight: 600; }

    /* Garis pemisah antar optgroup */
    select.pln-input optgroup {
        font-weight: 600;
        color: #475569;
        background: #F8FAFB;
    }

    select.pln-input option {
        padding: 0.35rem 0.5rem;
        line-height: 1.4;
    }

    /* Kotak peringatan slot tidak tersedia */
    .slot-warning {
        display: none;
        align-items: flex-start;
        gap: 0.45rem;
        margin-top: 0.45rem;
        padding: 0.55rem 0.75rem;
        border: 1px solid #FECACA;
        background: #FEF2F2;
        color: #B91C1C;
        border-radius: 10px;
        font-size: 0.74rem;
        line-height: 1.5;
    }
    .slot-warning.show { display: flex; }
    .slot-warning i { margin-top: 0.1rem; }

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
    .flex-1      { flex: 1 1 0%; min-width: 0; }
    .gap-2       { gap: 0.5rem; }
    .justify-center { justify-content: center; }
    .text-center { text-align: center; }
    .mt-3        { margin-top: 0.75rem; }        /* ---- ALERT ---- */
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

    /* ---- DROPZONE ----
       Input file diletakkan di LUAR dropzone agar klik tidak
       memicu dialog ganda lewat event bubbling.
       Input disembunyikan secara VISUAL tetapi tetap focusable
       (bukan display:none) agar validasi `required` native tetap
       dapat menampilkan pesan browser. */
    .pln-upload-wrap { position: relative; }

    .pln-file-input {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0 0 0 0);
        clip-path: inset(50%);
        white-space: nowrap;
        border: 0;
    }

    .pln-file-input:focus + .pln-dropzone {
        border-color: var(--pg-cyan);
        box-shadow: 0 0 0 3px var(--pg-ring);
    }

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

    /* ---- KARTU FILE TERPILIH ---- */
    .pln-file-card {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
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
        background: rgba(0, 194, 209, 0.10);
        color: var(--pg-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .pln-file-card .file-badge.badge-pdf   { background: rgba(237, 28, 36, 0.10); color: var(--pg-red); }
    .pln-file-card .file-badge.badge-image { background: rgba(22, 163, 74, 0.12); color: #15803D; }

    .pln-file-card .file-name { font-size: 0.8rem; font-weight: 600; color: var(--pg-text); margin: 0; word-break: break-all; }
    .pln-file-card .file-size { font-size: 0.72rem; color: var(--pg-soft); margin: 0.1rem 0 0; }

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

    /* ---- TOMBOL AKSI ---- */
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

    .pln-required-note {
        margin: 0;
        font-size: 0.74rem;
        color: var(--pg-soft);
    }

    @media (max-width: 639.98px) {
        .pln-actions {
            flex-direction: column-reverse;
            align-items: stretch;
            gap: 0.4rem;
        }
        .pln-required-note { text-align: center; }
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

    /* ---- MODAL SUKSES ---- */
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

    /* ---- FOOTNOTE ---- */
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
                <button type="button" class="btn-pln-primary pln-success-close" onclick="closeSuccessModal()">
                    <i class="fas fa-check"></i> <span data-i18n="form.btn_done">Selesai</span>
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

                    {{-- NIK / No. KTP — hanya angka, maksimal 16 digit (JS + pattern native) --}}
                    <div>
                        <label for="nik" class="pln-label" data-i18n="form.label_nik">
                            NIK / No. KTP <span class="required">*</span>
                        </label>
                        <div class="pln-input-icon">
                            <i class="fas fa-fingerprint"></i>
                            <input type="text" id="nik" name="nik" inputmode="numeric" maxlength="16"
                                   pattern="[0-9]{16}"
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

                {{-- ========== SEKSI 2: DOKUMEN (multi-format: ZIP / RAR / PDF / JPG / JPEG / PNG) ========== --}}
                <div class="pln-section pln-section--doc">
                    <div class="pln-section-head">
                        <span class="pln-section-icon"><i class="fas fa-folder-open"></i></span>
                        <h2 class="pln-section-title" data-i18n="form.section_documents">Dokumen</h2>
                    </div>

                    <div>
                        <label class="pln-label" for="dokumen">
                            <span data-i18n="form.doc_dokumen">Berkas Pendukung</span> <span class="required">*</span>
                            <span class="pln-hint" data-i18n="form.doc_dokumen_hint">ZIP, RAR, PDF, JPG, JPEG, atau PNG — maks 10MB</span>
                        </label>

                        {{-- Satu slot upload untuk seluruh berkas pendukung.
                             Input diletakkan di LUAR dropzone agar klik tidak
                             memicu dialog ganda lewat event bubbling. --}}
                        <div class="pln-upload-wrap">
                            <input type="file" id="dokumen" name="dokumen" required
                                   accept=".zip,.rar,.pdf,.jpg,.jpeg,.png"
                                   class="pln-file-input" />

                            {{-- Dropzone horizontal (tersembunyi setelah ada file) --}}
                            <div id="dokumen-upload-area"
                                 class="pln-dropzone @error('dokumen') has-error @enderror"
                                 role="button" tabindex="0"
                                 aria-label="Pilih berkas dokumen pendukung"
                                 aria-describedby="dokumen-hint">
                                <i class="fas fa-cloud-arrow-up dz-icon"></i>
                                <div>
                                    <p class="pln-dropzone-title" data-i18n="form.dz_title">Klik untuk memilih berkas</p>
                                    <p class="pln-dropzone-hint" id="dokumen-hint" data-i18n="form.dz_hint">
                                        atau seret &amp; letakkan di sini — maksimal 10MB
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Kartu pratinjau file terpilih --}}
                        <div id="dokumen-preview-area" class="hidden">
                            <div class="pln-file-card">
                                <div class="file-badge" id="dokumen-file-badge"><i class="fas fa-file-lines"></i></div>
                                <div class="flex-1">
                                    <p id="dokumen-file-name" class="file-name"></p>
                                    <p id="dokumen-file-size" class="file-size"></p>
                                </div>
                                <div class="flex gap-2">
                                    <button type="button" class="btn-mini btn-mini-danger" onclick="removeDokumen()">
                                        <i class="fas fa-trash-can"></i> <span data-i18n="form.btn_hapus">Hapus</span>
                                    </button>
                                    <button type="button" class="btn-mini btn-mini-neutral" onclick="document.getElementById('dokumen').click()">
                                        <i class="fas fa-rotate"></i> <span data-i18n="form.btn_ganti">Ganti</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        @error('dokumen')
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

                    {{-- Orang/Divisi yang Ditemui — Select Option statis + Tom Select --}}
                    <div>
                        <label for="tujuan_ditemui" class="pln-label" data-i18n="form.label_tujuan">
                            Orang / Divisi yang Ditemui <span class="required">*</span>
                        </label>
                        <div class="pln-input-icon">
                            <select id="tujuan_ditemui" name="tujuan_ditemui" required
                                    class="pln-input @error('tujuan_ditemui') has-error @enderror">
                                <option value="">— Pilih Divisi —</option>

                                {{-- Manager Operasi --}}
                                <optgroup label="Manager Operasi">
                                    <option value="Assisten Manajer Prod A">Assisten Manajer Prod A</option>
                                    <option value="Assisten Manajer Prod B">Assisten Manajer Prod B</option>
                                    <option value="Assisten Manajer Prod C">Assisten Manajer Prod C</option>
                                    <option value="Assisten Manajer Prod D">Assisten Manajer Prod D</option>
                                    <option value="Supervisor CHCB A">Supervisor CHCB A</option>
                                    <option value="Supervisor CHCB B">Supervisor CHCB B</option>
                                    <option value="Supervisor CHCB C">Supervisor CHCB C</option>
                                    <option value="Supervisor CHCB D">Supervisor CHCB D</option>
                                    <option value="Assisten Manajer RenOps">Assisten Manajer RenOps</option>
                                    <option value="Assisten Manajer Niaga BB">Assisten Manajer Niaga BB</option>
                                    <option value="Assisten Manajer Kimia &amp; Lab">Assisten Manajer Kimia &amp; Lab</option>
                                </optgroup>

                                {{-- Manager Pemeliharaan --}}
                                <optgroup label="Manager Pemeliharaan">
                                    <option value="Assisten Manajer Rendal Har">Assisten Manajer Rendal Har</option>
                                    <option value="Assisten Manajer MO">Assisten Manajer MO</option>
                                    <option value="Assisten Manajer Mesin 1">Assisten Manajer Mesin 1</option>
                                    <option value="Assisten Manajer Mesin 2">Assisten Manajer Mesin 2</option>
                                    <option value="Assisten Manajer Listrik">Assisten Manajer Listrik</option>
                                    <option value="Assisten Manajer Konin">Assisten Manajer Konin</option>
                                    <option value="Assisten Manajer Inventori Kontrol &amp; Gudang">Assisten Manajer Inventori Kontrol &amp; Gudang</option>
                                </optgroup>

                                {{-- Manager Engineering --}}
                                <optgroup label="Manager Engineering">
                                    <option value="Assisten Manajer SO">Assisten Manajer SO</option>
                                    <option value="Assisten Manajer CBM">Assisten Manajer CBM</option>
                                    <option value="Assisten Manajer MMRK">Assisten Manajer MMRK</option>
                                </optgroup>

                                {{-- Manager Business Support --}}
                                <optgroup label="Manager Business Support">
                                    <option value="Assisten Manajer Pengadaan">Assisten Manajer Pengadaan</option>
                                    <option value="Assisten Manajer SDM Umum CSR">Assisten Manajer SDM Umum CSR</option>
                                    <option value="Assisten Manajer Keuangan">Assisten Manajer Keuangan</option>
                                </optgroup>

                                {{-- Posisi Langsung di Bawah Senior Manager (tanpa nama pejabat &amp; tanpa "Senior Manager") --}}
                                <optgroup label="Posisi Langsung di Bawah Senior Manager">
                                    <option value="Assisten Manager K3 &amp; KAM">Assisten Manager K3 &amp; KAM</option>
                                    <option value="Assisten Manager Lingkungan">Assisten Manager Lingkungan</option>
                                </optgroup>
                            </select>
                        </div>
                        @error('tujuan_ditemui')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal, Jam & Jumlah Tamu — opsi jam dirender dinamis oleh JS --}}
                    <div class="grid-meet">
                        <div>
                            <label for="tanggal_kunjungan" class="pln-label" data-i18n="form.label_tanggal">
                                Tanggal Kunjungan <span class="required">*</span>
                            </label>
                            <div class="pln-input-icon">
                                <i class="fas fa-calendar-day"></i>
                                <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan"
                                       value="{{ old('tanggal_kunjungan') }}" required
                                       min="{{ now()->toDateString() }}"
                                       class="pln-input @error('tanggal_kunjungan') has-error @enderror" />
                            </div>
                            @error('tanggal_kunjungan')
                                <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="jam_kunjungan" class="pln-label" data-i18n="form.label_jam">
                                Jam Kunjungan <span class="required">*</span>
                            </label>
                            <div class="pln-input-icon">
                                <i class="fas fa-clock"></i>
                                <select id="jam_kunjungan" name="jam_kunjungan" required
                                        data-old="{{ old('jam_kunjungan') }}"
                                        class="pln-input @error('jam_kunjungan') has-error @enderror">
                                    <option value="">— Pilih Jam —</option>
                                </select>
                            </div>
                            {{-- Peringatan: jam terpilih ternyata sudah terblokir --}}
                            <div class="slot-warning" id="slot-warning">
                                <i class="fas fa-circle-exclamation"></i>
                                <span data-i18n="form.slot_taken">Jam ini sudah penuh / sudah di-approve untuk divisi ini. Silakan pilih jam lain.</span>
                            </div>
                            @error('jam_kunjungan')
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

                    {{-- Maksud & Keperluan — dengan counter karakter dinamis (0/2000) --}}
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
                <button type="submit" class="btn-pln-primary" id="btn-submit">
                    <i class="fas fa-paper-plane"></i> <span data-i18n="form.btn_submit">Daftar Sekarang</span>
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
{{-- ============ JAVASCRIPT: UPLOAD DOKUMEN MULTI-FORMAT + POLISH INPUT ============ --}}
<script>
    /* =====================================================================
       0. KONSTANTA — WHITELIST FORMAT & BATAS UKURAN
       ===================================================================== */
    const MAX_DOKUMEN  = 10 * 1024 * 1024; // 10MB
    const DOKUMEN_EXT  = ['zip', 'rar', 'pdf', 'jpg', 'jpeg', 'png'];
    const DOKUMEN_TEXT = 'ZIP, RAR, PDF, JPG, JPEG, atau PNG';

    /* =====================================================================
       1. NIK — terima digit saja, maksimal 16 karakter
       ===================================================================== */
    const nikInput = document.getElementById('nik');
    if (nikInput) {
        nikInput.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 16);
        });
    }

    /* =====================================================================
       2. DOKUMEN PENDUKUNG — SATU SLOT BERKAS (klik / keyboard / drag & drop)
          Whitelist format: .zip .rar .pdf .jpg .jpeg .png — maks 10MB
       ===================================================================== */
    const inputDokumen = document.getElementById('dokumen');
    const dokArea      = document.getElementById('dokumen-upload-area');
    const dokPrevArea  = document.getElementById('dokumen-preview-area');
    const dokNameEl    = document.getElementById('dokumen-file-name');
    const dokSizeEl    = document.getElementById('dokumen-file-size');
    const dokBadgeEl   = document.getElementById('dokumen-file-badge');

    /* Ekstensi file dalam huruf kecil (tanpa titik) */
    function getFileExt(name) {
        const parts = String(name).split('.');
        return parts.length > 1 ? parts.pop().toLowerCase() : '';
    }

    /* Apakah ekstensi file termasuk whitelist? */
    function isAllowedDokumen(file) {
        return DOKUMEN_EXT.indexOf(getFileExt(file.name)) !== -1;
    }

    /* Ukuran file: MB bila ≥ 1MB, selain itu KB */
    function formatFileSize(bytes) {
        if (bytes >= 1024 * 1024) {
            return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
        }
        return Math.max(1, Math.round(bytes / 1024)) + ' KB';
    }

    /* Ikon & varian warna badge pratinjau sesuai jenis berkas */
    const DOKUMEN_ICON = {
        zip:  'fa-file-zipper',
        rar:  'fa-file-zipper',
        pdf:  'fa-file-pdf',
        jpg:  'fa-file-image',
        jpeg: 'fa-file-image',
        png:  'fa-file-image',
    };
    const DOKUMEN_BADGE_CLASS = {
        pdf:  'badge-pdf',
        jpg:  'badge-image',
        jpeg: 'badge-image',
        png:  'badge-image',
    };

    /* Tampilkan pratinjau file (nama + ukuran MB/KB) */
    function previewDokumen(input) {
        if (!input.files || !input.files[0]) return;

        const file = input.files[0];
        const ext  = getFileExt(file.name);

        /* Validasi sisi klien (server tetap sumber kebenaran):
           whitelist ekstensi & maksimal 10MB */
        if (!isAllowedDokumen(file)) {
            alert('Format berkas tidak didukung. Gunakan: ' + DOKUMEN_TEXT + '.');
            removeDokumen();
            return;
        }
        if (file.size > MAX_DOKUMEN) {
            alert('Ukuran berkas maksimal 10MB.');
            removeDokumen();
            return;
        }

        /* Badge mengikuti jenis berkas */
        dokBadgeEl.className = 'file-badge' +
            (DOKUMEN_BADGE_CLASS[ext] ? ' ' + DOKUMEN_BADGE_CLASS[ext] : '');
        dokBadgeEl.innerHTML = '<i class="fas ' + (DOKUMEN_ICON[ext] || 'fa-file-lines') + '"></i>';

        dokNameEl.textContent = file.name;
        dokSizeEl.textContent = formatFileSize(file.size);

        dokArea.classList.remove('has-error');
        dokArea.classList.add('hidden');
        dokPrevArea.classList.remove('hidden');
    }

    /* Hapus file terpilih → kembali ke dropzone kosong */
    function removeDokumen() {
        if (!inputDokumen) return;

        inputDokumen.value = '';
        dokNameEl.textContent = '';
        dokSizeEl.textContent = '';
        dokBadgeEl.className = 'file-badge';
        dokBadgeEl.innerHTML = '<i class="fas fa-file-lines"></i>';

        dokPrevArea.classList.add('hidden');
        dokArea.classList.remove('hidden');
    }

    if (inputDokumen && dokArea) {
        /* Klik dropzone → buka dialog file */
        dokArea.addEventListener('click', () => inputDokumen.click());

        /* Navigasi keyboard (Enter / Space) → buka dialog file */
        dokArea.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                inputDokumen.click();
            }
        });

        /* Drag & drop */
        ['dragover', 'dragenter'].forEach(evt =>
            dokArea.addEventListener(evt, e => { e.preventDefault(); dokArea.classList.add('is-dragover'); })
        );
        ['dragleave', 'drop'].forEach(evt =>
            dokArea.addEventListener(evt, e => { e.preventDefault(); dokArea.classList.remove('is-dragover'); })
        );
        dokArea.addEventListener('drop', e => {
            const files = e.dataTransfer.files;
            if (files.length) {
                /* DataTransfer.files bersifat read-only — salin via
                   DataTransfer sebagai gantinya */
                try {
                    inputDokumen.files = files;
                } catch (err) {
                    const dt = new DataTransfer();
                    for (const f of files) dt.items.add(f);
                    inputDokumen.files = dt.files;
                }
                previewDokumen(inputDokumen);
            }
        });

        inputDokumen.addEventListener('change', () => previewDokumen(inputDokumen));
    }

    /* =====================================================================
       3. POP-UP SUKSES SETELAH SUBMIT
       ===================================================================== */
    const successModal = document.getElementById('successModal');

    if (successModal) {
        document.body.style.overflow = 'hidden';

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

    /* =====================================================================
       4. SLOT LOCKING — dropdown jam dirender dinamis.
          Setiap kali user memilih Divisi & Tanggal, frontend memanggil
          API /api/booked-slots. Jam dalam rentang 3-jam kunjungan
          yang sudah DI-APPROVE untuk divisi yang sama ditandai
          "(Penuh / Sudah Di-approve)" dan disabled.
       ===================================================================== */
    const SLOT_JAM          = @json(\App\Models\Tamu::SLOT_JAM);
    const BOOKED_SLOTS_API  = @json(route('layanan.registrasi-tamu.booked-slots'));
    const SLOT_PENUH_LABEL  = ' (Penuh / Sudah Di-approve)';

    const divisiInput  = document.getElementById('tujuan_ditemui');
    const tanggalInput = document.getElementById('tanggal_kunjungan');
    const jamSelect    = document.getElementById('jam_kunjungan');
    const slotWarning  = document.getElementById('slot-warning');    let jamTerblokir = [];
    let slotAbort    = null;

    /* ---- Render ulang opsi dropdown jam sesuai daftar slot terblokir ---- */
    function renderOpsiJam() {
        const terpilih = jamSelect.dataset.old || jamSelect.value;

        jamSelect.innerHTML = '';
        jamSelect.add(new Option('— Pilih Jam —', ''));

        SLOT_JAM.forEach(jam => {
            const penuh = jamTerblokir.includes(jam);
            const opsi  = new Option(jam + (penuh ? SLOT_PENUH_LABEL : ''), jam);

            if (penuh) {
                opsi.disabled  = true;
                opsi.className = 'slot-penuh';
            }
            jamSelect.add(opsi);
        });

        if (terpilih && !jamTerblokir.includes(terpilih)) {
            jamSelect.value = terpilih;
        }
        jamSelect.dataset.old = '';

        evaluasiSlot();
    }

    /* Peringatan + blokir submit bila jam terpilih ternyata terblokir */
    function evaluasiSlot() {
        if (!jamSelect || !slotWarning) return;

        const bentrok = jamSelect.value !== '' && jamTerblokir.includes(jamSelect.value);
        slotWarning.classList.toggle('show', bentrok);

        jamSelect.setCustomValidity(bentrok
            ? 'Jam kunjungan ini sudah penuh. Silakan pilih jam lain.'
            : '');
    }

    /* Panggil API booked-slots untuk kombinasi divisi + tanggal terpilih */
    async function muatSlotTerblokir() {
        const divisi  = divisiInput ? divisiInput.value.trim() : '';
        const tanggal = tanggalInput ? tanggalInput.value : '';

        if (!divisi || !tanggal) {
            jamTerblokir = [];
            renderOpsiJam();
            return;
        }

        /* Batalkan request sebelumnya yang masih berjalan */
        if (slotAbort) slotAbort.abort();
        slotAbort = new AbortController();

        try {
            const res = await fetch(
                BOOKED_SLOTS_API
                + '?divisi=' + encodeURIComponent(divisi)
                + '&tanggal=' + encodeURIComponent(tanggal),
                { headers: { 'Accept': 'application/json' }, signal: slotAbort.signal }
            );
            const data = await res.json();
            jamTerblokir = Array.isArray(data.jam_terblokir) ? data.jam_terblokir : [];
        } catch (err) {
            if (err.name === 'AbortError') return; // digantikan request baru

            /* Gagal memuat: semua slot dianggap aktif — validasi store()
               di server tetap sumber kebenaran */
            jamTerblokir = [];
        }

        renderOpsiJam();
    }

    if (jamSelect && divisiInput && tanggalInput) {
        jamSelect.addEventListener('change', evaluasiSlot);
        tanggalInput.addEventListener('change', muatSlotTerblokir);
        divisiInput.addEventListener('change', muatSlotTerblokir);

        renderOpsiJam();
        muatSlotTerblokir();
    }

    /* =====================================================================
       5. DIVISI — select native (tanpa Tom Select / pencarian)
          Dropdown divisi bersifat statis, sudah berisi semua opsi
          yang di-render di HTML. Tidak ada library pihak ketiga.
       ===================================================================== */
    // Tidak ada inisialisasi Tom Select — menggunakan <select> native.

    /* =====================================================================
       6. PENGHITUNG KARAKTER — MAKSUD & KEPERLUAN (0/2000)
       ===================================================================== */
    const keperluanInput = document.getElementById('keperluan');
    const keperluanCount = document.getElementById('keperluan-count');
    if (keperluanInput && keperluanCount) {
        const updateCount = () => { keperluanCount.textContent = keperluanInput.value.length; };
        keperluanInput.addEventListener('input', updateCount);
        updateCount();
    }

    /* =====================================================================
       7. TOMBOL SUBMIT: status memproses + anti klik ganda
       ===================================================================== */
    const form      = document.getElementById('form-registrasi');
    const submitBtn = document.getElementById('btn-submit');
    const submitBtnOriginalHtml = submitBtn ? submitBtn.innerHTML : '';
    let isSubmitting = false;

    if (form && submitBtn) {
        form.addEventListener('submit', function (e) {
            if (isSubmitting) { e.preventDefault(); return; }

            if (inputDokumen && inputDokumen.files.length === 0) {
                e.preventDefault();
                dokArea.classList.add('has-error');
                alert('Berkas pendukung wajib diunggah.');
                return;
            }

            isSubmitting = true;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Memproses...';
        });

        window.addEventListener('pageshow', function () {
            isSubmitting = false;
            submitBtn.disabled = false;
            submitBtn.innerHTML = submitBtnOriginalHtml;
        });
    }
</script>
@endpush
