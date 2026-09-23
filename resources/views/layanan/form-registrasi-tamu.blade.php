@extends('layouts.app')

@section('title', 'Form Registrasi Tamu — PLN Nusantara Power')

@push('styles')
<style>
    /* ============================================================
        FORM REGISTRASI TAMU — TEMA MINIMALIS WARNA PLN
        Background: gradient teal selaras halaman utama.
        Semua rule di-scope ke .pln-page agar tidak mengganggu
        navbar & footer milik layout.
        ============================================================ */
    :root {
        --pln-muted:    #64748B;
        --pln-border:   #E8EDF1;
        --pln-ring:     rgba(0, 143, 168, 0.12);
        --pln-gradient: linear-gradient(135deg, #00c2d1 0%, #00a6bd 55%, #008fa8 100%);
    }

    /* Wrapper halaman — kompensasi navbar fixed-top (±70px).
       Layout landscape: konten dirancang muat satu layar (tanpa
       scroll) pada desktop; di mobile kembali satu kolom. */
    .pln-page {
        background:
            radial-gradient(circle at 85% 15%, rgba(255, 255, 255, 0.14) 0, transparent 42%),
            radial-gradient(circle at 10% 90%, rgba(255, 255, 255, 0.10) 0, transparent 40%),
            linear-gradient(135deg, #00c2d1 0%, #00a6bd 55%, #008fa8 100%);
        color: var(--pln-text);
        font-size: 15px;
        line-height: 1.5;
        -webkit-font-smoothing: antialiased;
        padding: 5rem 1rem 1.5rem;
    }

    .pln-container { max-width: 1040px; margin: 0 auto; }

    /* ---------- HEADER (kompak: logo + judul sebaris) ---------- */
    .pln-header-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.65rem;
    }
    .pln-logo {
        height: 36px;
        width: auto;
        margin: 0;
        object-fit: contain;
    }
    .pln-brand-icon {
        display: none;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.16);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        margin: 0;
    }
    .pln-header  { margin-bottom: 1rem; text-align: center; }
    /* Header di atas gradient teal (seperti hero halaman utama): teks putih */
    .pln-title   { color: #fff; font-weight: 700; font-size: 1.2rem; letter-spacing: -0.01em; margin: 0; }
    .pln-subtitle{ color: rgba(255, 255, 255, 0.85); font-size: 0.8rem; margin: 0.3rem 0 0; }

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
    .pln-card::before {
        content: '';
        display: block;
        height: 3px;
        background: var(--pln-gradient);
    }
    .pln-card-body { padding: 1.25rem 1.5rem; }

    /* ---------- SEKSI FORM ---------- */
    .pln-section + .pln-section { margin-top: 1.5rem; }

    .pln-section-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0 0 0.75rem;
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #94A3B8;
        padding-bottom: 0.45rem;
        border-bottom: 1px solid #F1F5F9;
    }
    .pln-section-title i { color: var(--pln-blue); font-size: 0.72rem; }

    /* Jarak antar elemen dalam satu seksi */
    .pln-section > * + * { margin-top: 0.8rem; }

    .grid-2   { display: grid; gap: 0.8rem; grid-template-columns: 1fr; }
    .grid-meet{ display: grid; gap: 0.8rem; grid-template-columns: 1fr; }

    /* Desktop ≥1024px: dua kolom landscape — Data Diri + Dokumen di kiri,
       Detail Kunjungan di kanan — agar form muat tanpa scroll. */
    @media (min-width: 1024px) {
        .pln-card-body {
            padding: 1.5rem 1.75rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 2.25rem;
            row-gap: 1.25rem;
            align-items: start;
        }
        .pln-card-body > .pln-section { margin-top: 0; }
        .pln-section--data   { grid-column: 1; grid-row: 1; }
        .pln-section--doc    { grid-column: 1; grid-row: 2; }
        .pln-section--detail { grid-column: 2; grid-row: 1 / span 2; }
    }

    /* Layar pendek (laptop 768px tinggi): pangkas header & footnote */
    @media (min-width: 1024px) and (max-height: 860px) {
        .pln-page { padding-top: 4.5rem; }
        .pln-header { margin-bottom: 0.6rem; }
        .pln-footnote { display: none; }
    }
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
        font-size: 0.76rem;
        margin-bottom: 0.3rem;
    }
    .pln-label .required { color: var(--pln-red); }
    .pln-hint { color: #94A3B8; font-weight: 400; font-size: 0.72rem; }

    /* ---------- INPUT & TEXTAREA ---------- */
    .pln-input,
    .pln-textarea {
        width: 100%;
        border: 1px solid var(--pln-border);
        border-radius: 10px;
        background: #fff;
        padding: 0.58rem 0.9rem 0.58rem 2.4rem;
        font: inherit;
        font-size: 0.84rem;
        color: var(--pln-text);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .pln-textarea {
        padding-left: 0.9rem;
        resize: vertical;
        min-height: 74px;
    }
    .pln-input::placeholder,
    .pln-textarea::placeholder { color: #AEBAC4; }

    .pln-input:focus,
    .pln-textarea:focus {
        outline: none;
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px var(--pln-ring);
    }
    .pln-input.has-error,
    .pln-textarea.has-error { border-color: var(--pln-red); }
    .pln-input.has-error:focus,
    .pln-textarea.has-error:focus { box-shadow: 0 0 0 3px rgba(237, 28, 36, 0.1); }

    /* Sembunyikan spinner input number agar bersih */
    .pln-input::-webkit-outer-spin-button,
    .pln-input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    .pln-input[type="number"] { -moz-appearance: textfield; appearance: textfield; }

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
    .pln-input-icon:focus-within > i { color: var(--pln-blue); }

    .pln-field-error {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        color: var(--pln-red);
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
    .mt-3 { margin-top: 0.75rem; }

    /* ---------- ALERT ---------- */
    .pln-alert {
        display: flex;
        align-items: flex-start;
        gap: 0.7rem;
        border-radius: 12px;
        padding: 0.7rem 0.9rem;
        margin: 0 0 1rem;
        border: 1px solid transparent;
        font-size: 0.85rem;
    }
    .pln-alert > i { margin-top: 0.15rem; }
    .pln-alert p { margin: 0; }
    .pln-alert ul { margin: 0.3rem 0 0; padding-left: 1.1rem; }
    .pln-alert-success { background: #F0FDF4; border-color: #DCFCE7; color: #15803D; }
    .pln-alert-error   { background: #FEF2F2; border-color: #FECACA; color: #B91C1C; }
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
    /* Dropzone horizontal (ikon + teks sebaris) agar hemat tinggi */
    .pln-dropzone {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.85rem;
        border: 1.5px dashed #D5DEE4;
        border-radius: 14px;
        background: #FAFCFD;
        padding: 0.95rem 1.25rem;
        text-align: left;
        cursor: pointer;
        transition: border-color 0.2s ease, background 0.2s ease;
    }
    .pln-dropzone:hover,
    .pln-dropzone.is-dragover {
        border-color: var(--pln-cyan);
        background: rgba(0, 194, 209, 0.05);
    }
    .pln-dropzone.has-error { border-color: var(--pln-red); }
    .pln-dropzone > i {
        font-size: 1.45rem;
        color: #B6C2CC;
        transition: color 0.2s ease;
    }
    .pln-dropzone:hover > i,
    .pln-dropzone.is-dragover > i { color: var(--pln-cyan); }
    .pln-dropzone p { margin: 0; }
    .pln-dropzone-title { font-size: 0.84rem; font-weight: 500; color: var(--pln-text); }
    .pln-dropzone-hint  { font-size: 0.73rem; color: #94A3B8; margin-top: 0.1rem !important; }

    /* ---------- PREVIEW KTP ---------- */
    .pln-preview {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: center;
        border: 1px solid var(--pln-border);
        border-radius: 14px;
        background: #FAFCFD;
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
        border: 1px solid var(--pln-border);
    }
    .pln-preview-name { font-size: 0.8rem; font-weight: 600; color: var(--pln-dark); margin: 0; word-break: break-all; }
    .pln-preview-size { font-size: 0.72rem; color: #94A3B8; margin: 0.1rem 0 0; }

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
    .btn-mini-neutral { background: #F1F5F9; color: var(--pln-muted); }
    .btn-mini-neutral:hover { color: var(--pln-blue); background: #E2E8F0; }

    /* ---------- TOMBOL AKSI ---------- */
    .pln-actions {
        border-top: 1px solid #F1F5F9;
        background: #FCFDFE;
        padding: 0.8rem 1.5rem;
        display: flex;
        flex-direction: column-reverse;
        gap: 0.55rem;
    }
    @media (min-width: 640px) {
        .pln-actions { flex-direction: row; justify-content: flex-end; padding: 0.8rem 1.75rem; }
    }
    .btn-pln-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.84rem;
        padding: 0.55rem 1.5rem;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    /* Primary: kuning PLN — identik tombol Login di navbar */
    .btn-pln-primary {
        background: var(--pln-yellow);
        color: var(--pln-blue);
        font-weight: 700;
        border: none;
    }
    .btn-pln-primary:hover {
        background: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(255, 230, 0, 0.45);
    }

    /* ---------- FOOTNOTE ---------- */
    .pln-footnote {
        text-align: center;
        font-size: 0.7rem;
        color: rgba(255, 255, 255, 0.8);
        margin: 0.9rem 0 0;
    }
    .pln-footnote i { color: var(--pln-yellow); margin-right: 0.25rem; }

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
                <h1 class="pln-title">Form Registrasi Tamu</h1>
            </div>
            <p class="pln-subtitle">Silakan lengkapi data diri Anda untuk pendaftaran kunjungan.</p>
        </div>

        {{-- ================= FLASH SUKSES ================= --}}
        @if(session('success'))
            <div class="pln-alert pln-alert-success" id="alert-success">
                <i class="fas fa-circle-check"></i>
                <div class="flex-1">
                    <p style="font-weight:600;">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
                <button type="button" class="pln-alert-close" onclick="this.closest('#alert-success').remove()" aria-label="Tutup">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>
        @endif

        {{-- ================= ERROR VALIDASI ================= --}}
        @if($errors->any())
            <div class="pln-alert pln-alert-error" id="alert-error">
                <i class="fas fa-circle-exclamation"></i>
                <div class="flex-1">
                    <p style="font-weight:600;">Periksa kembali isian berikut:</p>
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
        <form action="{{ route('layanan.registrasi-tamu.store') }}" method="POST" enctype="multipart/form-data" class="pln-card">

            @csrf

            <div class="pln-card-body">

                {{-- ========== SEKSI 1: DATA DIRI ========== --}}
                <div class="pln-section pln-section--data">
                    <p class="pln-section-title"><i class="fas fa-user"></i> Data Diri</p>

                    {{-- NIK / No. KTP --}}
                    <div class="pln-field">
                        <label for="nik" class="pln-label">
                            NIK / No. KTP <span class="required">*</span>
                        </label>
                        <div class="pln-input-icon">
                            <i class="fas fa-fingerprint"></i>
                            <input type="text" id="nik" name="nik" inputmode="numeric" maxlength="16"
                                   value="{{ old('nik') }}"
                                   placeholder="Masukkan 16 digit NIK"
                                   required
                                   class="pln-input @error('nik') has-error @enderror" />
                        </div>
                        @error('nik')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama Lengkap + Instansi --}}
                    <div class="grid-2">
                        <div>
                            <label for="nama" class="pln-label">
                                Nama Lengkap <span class="required">*</span>
                            </label>
                            <div class="pln-input-icon">
                                <i class="fas fa-user"></i>
                                <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                       placeholder="Nama sesuai KTP" required autocomplete="name"
                                       class="pln-input @error('nama') has-error @enderror" />
                            </div>
                            @error('nama')
                                <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="instansi" class="pln-label">
                                Perusahaan / Instansi <span class="pln-hint">(opsional)</span>
                            </label>
                            <div class="pln-input-icon">
                                <i class="fas fa-building"></i>
                                <input type="text" id="instansi" name="instansi" value="{{ old('instansi') }}"
                                       placeholder="Nama instansi asal" autocomplete="organization"
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
                            <label for="no_hp" class="pln-label">
                                No. WhatsApp / HP <span class="required">*</span>
                            </label>
                            <div class="pln-input-icon">
                                <i class="fab fa-whatsapp"></i>
                                <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                       placeholder="08xxxxxxxxxx" required autocomplete="tel"
                                       class="pln-input @error('no_hp') has-error @enderror" />
                            </div>
                            @error('no_hp')
                                <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="pln-label">
                                Email <span class="pln-hint">(opsional)</span>
                            </label>
                            <div class="pln-input-icon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                       placeholder="nama@email.com" autocomplete="email"
                                       class="pln-input @error('email') has-error @enderror" />
                            </div>
                            @error('email')
                                <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ========== SEKSI 2: DOKUMEN IDENTITAS ========== --}}
                <div class="pln-section pln-section--doc">
                    <p class="pln-section-title"><i class="fas fa-id-card"></i> Dokumen Identitas</p>

                    <div>
                        <label class="pln-label">
                            Upload Foto KTP <span class="required">*</span>
                            <span class="pln-hint">JPG / PNG, maks 2MB</span>
                        </label>

                        {{-- Dropzone (tersembunyi setelah ada preview) --}}
                        <div id="ktp-upload-area" class="pln-dropzone @error('foto_ktp') has-error @enderror"
                             onclick="document.getElementById('foto_ktp').click()">
                            <i class="fas fa-cloud-arrow-up"></i>
                            <p class="pln-dropzone-title">Klik untuk memilih foto KTP</p>
                            <p class="pln-dropzone-hint">atau seret &amp; letakkan di sini</p>
                            <input type="file" id="foto_ktp" name="foto_ktp" accept="image/jpeg,image/png" class="hidden"
                                   onchange="previewKtp(this)" />
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
                </div>

                {{-- ========== SEKSI 3: DETAIL KUNJUNGAN ========== --}}
                <div class="pln-section pln-section--detail">
                    <p class="pln-section-title"><i class="fas fa-calendar-check"></i> Detail Kunjungan</p>

                    {{-- Orang/Divisi yang Ditemui --}}
                    <div>
                        <label for="tujuan_ditemui" class="pln-label">
                            Orang / Divisi yang Ditemui <span class="required">*</span>
                        </label>
                        <div class="pln-input-icon">
                            <i class="fas fa-user-tie"></i>
                            <input type="text" id="tujuan_ditemui" name="tujuan_ditemui" value="{{ old('tujuan_ditemui') }}"
                                   placeholder="Nama orang / divisi tujuan" required
                                   class="pln-input @error('tujuan_ditemui') has-error @enderror" />
                        </div>
                        @error('tujuan_ditemui')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal & Jam Kunjungan + Jumlah Tamu --}}
                    <div class="grid-meet">
                        <div>
                            <label for="tanggal_kunjungan" class="pln-label">
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
                            <label for="jumlah_tamu" class="pln-label">
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
                        <label for="keperluan" class="pln-label">
                            Maksud &amp; Keperluan Kunjungan <span class="required">*</span>
                        </label>
                        <textarea id="keperluan" name="keperluan" rows="4" maxlength="2000" required
                                  placeholder="Jelaskan singkat maksud dan keperluan kunjungan Anda..."
                                  class="pln-textarea @error('keperluan') has-error @enderror">{{ old('keperluan') }}</textarea>
                        @error('keperluan')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- ================= TOMBOL AKSI ================= --}}
            <div class="pln-actions">
                <button type="submit" class="btn-pln-primary">
                    <i class="fas fa-paper-plane"></i> Daftar Sekarang
                </button>
            </div>
        </form>

        <p class="pln-footnote">
            <i class="fas fa-shield-halved"></i> Data Anda disimpan aman dan hanya digunakan untuk keperluan registrasi kunjungan.
        </p>
    </div>
</div>
@endsection

@push('scripts')
{{-- ================= JAVASCRIPT: LIVE PREVIEW KTP ================= --}}
<script>
    const inputKtp    = document.getElementById('foto_ktp');
    const uploadArea  = document.getElementById('ktp-upload-area');
    const previewArea = document.getElementById('ktp-preview-area');
    const previewImg  = document.getElementById('ktp-preview');
    const fileNameEl  = document.getElementById('ktp-file-name');
    const fileSizeEl  = document.getElementById('ktp-file-size');

    const MAX_SIZE = 2 * 1024 * 1024; // 2MB

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
</script>
@endpush
