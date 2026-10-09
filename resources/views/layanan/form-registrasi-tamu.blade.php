@extends('layouts.app')

@section('title', 'Form Registrasi Tamu — PLN Nusantara Power')

@push('styles')
<style>
    /* ============================================================
        FORM REGISTRASI TAMU — TAMPILAN REFERENSI (UI SEDERHANA)
        Hanya penyesuaian tampilan. Alur, state, validasi tidak diubah.
        ============================================================ */
    .pln-page {
        /* ---- Variabel warna ---- */
        --pg-text:   #1e293b;
        --pg-muted:  #64748b;
        --pg-soft:   #94a3b8;
        --pg-line:   #e2e8f0;
        --pg-panel:  #ffffff;
        --pg-accent: var(--pln-blue, #008fa8);
        --pg-accent-light: rgba(0, 143, 168, 0.08);
        --pg-danger: #dc2626;
        --pg-bg:     #f3f6fb;

        background:
            radial-gradient(circle at 85% 15%, rgba(255, 255, 255, 0.14) 0, transparent 42%),
            radial-gradient(circle at 10% 90%, rgba(255, 255, 255, 0.10) 0, transparent 40%),
            linear-gradient(135deg, #00c2d1 0%, #00a6bd 55%, #008fa8 100%);
        color: var(--pg-text);
        font-size: 14px;
        line-height: 1.42;
        -webkit-font-smoothing: antialiased;
        padding: 1.4rem 1rem 1.1rem;
        position: relative;
        overflow: hidden;
    }

    .pln-container {
        max-width: 880px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    /* ---------- HEADER ---- */
    .pln-header {
        text-align: center;
        margin-bottom: 0.55rem;
    }
    .pln-header-row {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.28rem;
    }
    .pln-logo {
        height: 30px;
        width: auto;
        max-width: 110px;
        object-fit: contain;
        margin: 0;
        display: block;
    }
    .pln-brand-icon {
        display: none;
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.18);
        border: 1.5px solid rgba(255, 255, 255, 0.4);
        color: #fff;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
    }
    .pln-title {
        color: #fff;
        font-weight: 700;
        font-size: 1.12rem;
        letter-spacing: -0.02em;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.12);
    }
    .pln-subtitle {
        color: rgba(255, 255, 255, 0.92);
        font-size: 0.74rem;
        margin: 0;
        max-width: 460px;
        line-height: 1.35;
    }

    /* ---------- KARTU FORM ---- */
    .pln-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04),
                    0 6px 18px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }
    .pln-card-body {
        padding: 0.5rem 0.7rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.55rem;
        align-items: start;
    }

    .pln-card-body > .pln-section + .pln-section {
        margin-top: 0;
    }

    .pln-card-body > .pln-section--data {
        grid-column: 1;
        grid-row: 1;
    }

    .pln-card-body > .pln-section--doc {
        grid-column: 1;
        grid-row: 2;
    }

    .pln-card-body > .pln-section--detail {
        grid-column: 2;
        grid-row: 1 / span 2;
    }

    .pln-section > * + * {
        margin-top: 0.42rem;
    }

    /* ---- MOBILE (≤639px): kompak ---- */
    @media (max-width: 639.98px) {
        .pln-card-body {
            padding: 0.4rem 0.5rem;
        }

        .pln-card-body > .pln-section + .pln-section { margin-top: 0.35rem; }

        .pln-section > * + * { margin-top: 0.3rem; }

        .pln-section {
            padding: 0.4rem 0.45rem;
        }

        .pln-section-head {
            margin-bottom: 0.25rem;
            padding-bottom: 0.3rem;
        }

        .pln-section-icon {
            width: 18px;
            height: 18px;
            font-size: 0.45rem;
        }

        .pln-section-title {
            font-size: 0.52rem;
        }

        .pln-label {
            font-size: 0.62rem;
            margin-bottom: 0.06rem;
        }

        .pln-input,
        .pln-textarea,
        select.pln-input {
            padding: 0.35rem 0.5rem 0.35rem 1.6rem;
            font-size: 0.7rem;
        }

        .pln-textarea {
            padding-left: 0.5rem;
            min-height: 60px;
        }

        .pln-input-icon > i {
            left: 0.5rem;
            font-size: 0.6rem;
        }

        .pln-input[type="date"] { padding-right: 0.15rem; }

        select.pln-input {
            padding-right: 1.6rem;
            background-position: right 0.35rem center;
            background-size: 0.65rem;
        }

        .btn-pln-primary {
            font-size: 0.7rem;
            padding: 0.35rem 0.85rem;
        }

        .pln-actions {
            padding: 0.4rem 0.5rem;
            align-items: stretch;
            flex-direction: column-reverse;
        }

        .pln-actions .btn-pln-primary { width: 100%; }

        .pln-hint { font-size: 0.54rem; }
    }

    /* ---------- PANEL SEKSI ---- */
    .pln-section {
        border: 1px solid var(--pg-line);
        border-radius: 12px;
        padding: 0.65rem 0.7rem;
        background: #fff;
    }
    .pln-section-head {
        display: flex;
        align-items: center;
        gap: 0.55rem;
        margin: 0 0 0.55rem;
        padding-bottom: 0.45rem;
        border-bottom: 1px solid var(--pg-line);
    }
    .pln-section-icon {
        width: 24px;
        height: 24px;
        border-radius: 7px;
        background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan));
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.6rem;
        flex-shrink: 0;
    }
    .pln-section-title {
        margin: 0;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        text-transform: uppercase;
        color: #334155;
    }

    /* ---------- GRID FIELD ---------- */
    .grid-2   { display: grid; gap: 0.5rem; grid-template-columns: 1fr; }
    .grid-3   { display: grid; gap: 0.5rem; grid-template-columns: 1fr; }

    /* Desktop ≥1024px: layout dua kolom */
    @media (min-width: 1024px) {
        .pln-card {
            max-width: 1100px;
            margin: 0 auto;
        }
        .pln-card-body {
            grid-template-columns: 0.85fr 1.15fr;
            gap: 0.6rem;
            align-items: start;
        }
        .pln-card-body > .pln-section + .pln-section { margin-top: 0; }
        .pln-section--data   { grid-column: 1; grid-row: 1; }
        .pln-section--doc    { grid-column: 1; grid-row: 2; }
        .pln-section--detail { grid-column: 2; grid-row: 1 / span 2; }
    }

    /* Tablet: 1 kolom */
    @media (max-width: 1023.98px) {
        .pln-card { max-width: 820px; }
        .pln-card-body { grid-template-columns: 1fr; }
        .pln-section--doc { order: 2; }
        .pln-section--detail { order: 1; }
    }

    /* Tablet desktop kecil: kompak */
    @media (max-width: 991.98px) {
        .pln-page { padding-top: 1.4rem; }
    }

    /* Tablet landscape: grid-2 menjadi 2 kolom */
    @media (min-width: 640px) {
        .grid-2 { grid-template-columns: 1fr 1fr; }
    }

    /* Mobile: full-width */
    @media (max-width: 767.98px) {
        .pln-page { padding-top: 1.2rem; }
        .pln-card { border-radius: 11px; max-width: 100%; box-shadow: 0 6px 16px rgba(0,0,0,0.05); }
        .pln-card-body { grid-template-columns: 1fr; padding: 0.5rem 0.6rem; gap: 0.4rem; }
        .pln-section { padding: 0.5rem 0.55rem; }
        .pln-section > * + * { margin-top: 0.35rem; }
    }

    /* ---------- LABEL ---- */
    .pln-label {
        display: block;
        color: var(--pg-text);
        font-weight: 500;
        font-size: 0.72rem;
        margin-bottom: 0.18rem;
    }
    .pln-label .required { color: var(--pg-danger); }
    .pln-hint { color: var(--pg-muted); font-weight: 400; font-size: 0.66rem; }

    /* Ikon caption kiri atas di dalam dropzone */
    .pln-dropzone .dz-icon {
        font-size: 1.3rem;
        color: var(--pg-soft);
    }

    /* Baris label + elemen kanan (mis. penghitung karakter) */
    .pln-label-row {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        gap: 0.5rem;
    }
    .pln-label-row .pln-label { margin-bottom: 0; }
    .pln-counter { font-size: 0.7rem; color: var(--pg-soft); white-space: nowrap; }

    /* ---------- INPUT & TEXTAREA ---- */
    .pln-input,
    .pln-textarea {
        width: 100%;
        border: 1.15px solid #e2e8f0;
        border-radius: 7px;
        background: #fff;
        padding: 0.5rem 0.7rem 0.5rem 2.1rem;
        font: inherit;
        font-size: 0.78rem;
        color: #1e293b;
        transition: all 0.18s ease;
    }
    .pln-textarea {
        padding-left: 0.7rem;
        resize: vertical;
        min-height: 72px;
    }
    .pln-input::placeholder,
    .pln-textarea::placeholder {
        color: #94a3b8;
    }

    .pln-input:hover:not(:focus),
    .pln-textarea:hover:not(:focus) {
        border-color: #cbd5e1;
    }

    .pln-input:focus,
    .pln-textarea:focus {
        outline: none;
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0, 143, 168, 0.08);
    }

    .pln-input.has-error,
    .pln-textarea.has-error {
        border-color: #dc2626;
    }
    .pln-input.has-error:focus,
    .pln-textarea.has-error:focus {
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.05);
    }

    /* Ikon di dalam input */
    .pln-input-icon {
        position: relative;
    }
    .pln-input-icon > i {
        position: absolute;
        left: 0.6rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.72rem;
        pointer-events: none;
        transition: color 0.18s ease;
    }
    .pln-input:focus ~ i,
    .pln-input-icon:focus-within > i {
        color: var(--pln-blue);
        transform: translateY(-50%) scale(1.04);
    }

    /* Sembunyikan spinner input number */
    .pln-input::-webkit-outer-spin-button,
    .pln-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .pln-input[type="number"] {
        -moz-appearance: textfield;
        appearance: textfield;
    }

    /* Ikon calendar untuk input date */
    .pln-input[type="date"] {
        padding-right: 0.3rem;
        color-scheme: light;
    }
    .pln-input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0.4;
        cursor: pointer;
        padding: 0.18rem;
        border-radius: 5px;
        transition: opacity 0.18s ease, background 0.18s ease;
    }
    .pln-input[type="date"]::-webkit-calendar-picker-indicator:hover {
        opacity: 0.7;
        background: rgba(0, 0, 0, 0.03);
    }

    /* Custom Dropdown Divisi */
    .custom-dropdown-input {
        cursor: pointer;
        padding-right: 1.6rem;
        padding-left: 1.8rem;
        background-clip: padding-box;
    }
    .dropdown-arrow {
        position: absolute;
        right: 0.6rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        pointer-events: none;
        transition: transform 0.18s ease, color 0.18s ease;
        z-index: 1;
    }
    .custom-dropdown-input:focus + .dropdown-arrow,
    .custom-dropdown-input:focus-within ~ .dropdown-arrow {
        transform: translateY(-50%) rotate(180deg);
        color: var(--pln-blue);
    }
    /* Saat menu terbuka, beri indikasi visual pada input */
    .custom-dropdown-input.dropdown-open {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0, 143, 168, 0.06);
    }

    .custom-dropdown-menu {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        width: 100%;
        z-index: 10000;
        background: #fff;
        border: 1px solid var(--pg-line);
        border-radius: 8px;
        box-shadow: 0 10px 26px rgba(0, 0, 0, 0.07);
        box-sizing: border-box;
    }

    .custom-dropdown-menu.custom-scroll-menu {
        max-height: 170px;
        overflow-y: auto;
        padding: 0.15rem 0;
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 transparent;
    }

    .custom-dropdown-menu.custom-scroll-menu::-webkit-scrollbar { width: 4px; }
    .custom-dropdown-menu.custom-scroll-menu::-webkit-scrollbar-track { background: transparent; }
    .custom-dropdown-menu.custom-scroll-menu::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }
    .custom-dropdown-menu.custom-scroll-menu::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

    .custom-scroll-content { padding: 0.05rem 0; }

    .dropdown-option {
        padding: 0.35rem 0.65rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.78rem;
        color: #334155;
        transition: all 0.14s ease;
        border-radius: 5px;
        margin: 0.02rem 0.08rem;
    }
    .dropdown-option:hover { background: rgba(0, 143, 168, 0.06); }
    .dropdown-option.selected { background: rgba(0, 143, 168, 0.08); color: var(--pln-blue); font-weight: 500; }
    .dropdown-option::before {
        content: '';
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #cbd5e1;
        flex-shrink: 0;
    }
    .dropdown-option.selected::before { background: var(--pln-blue); }

    .dropdown-optgroup {
        padding: 0.25rem 0.65rem 0.15rem;
        font-weight: 600;
        font-size: 0.62rem;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        background: #f8fafc;
        border-bottom: 1px solid var(--pg-line);
        margin: 0.12rem 0 0.04rem;
        border-radius: 5px;
    }

    .dropdown-placeholder {
        padding: 0.35rem 0.65rem;
        color: #94a3b8;
        font-style: italic;
        cursor: default;
        border-radius: 5px;
        margin: 0.02rem 0.08rem;
    }

    /* Opsi jam yang TERBLOKIR (sudah di-approve oleh admin):
       teks & latar merah, disabled sehingga tidak bisa dipilih */
    select.pln-input option.slot-penuh {
        color: #dc2626 !important;
        background: #fef2f2 !important;
        font-weight: 500;
        text-decoration: line-through;
    }
    select.pln-input option:disabled {
        color: #dc2626 !important;
        background: #fef2f2 !important;
    }
    select.pln-input optgroup { font-weight: 600; color: #475569; background: #f8fafc; }
    select.pln-input option { padding: 0.25rem 0.4rem; line-height: 1.25; }

    /* Kotak peringatan jam terblokir */
    .slot-warning {
        display: none;
        align-items: flex-start;
        gap: 0.3rem;
        margin-top: 0.3rem;
        padding: 0.35rem 0.55rem;
        border: 1px solid #fecaca;
        background: #fef2f2;
        color: #b91c1c;
        border-radius: 7px;
        font-size: 0.66rem;
        line-height: 1.35;
    }
    .slot-warning.show { display: flex; }
    .slot-warning i { margin-top: 0.02rem; }

    .pln-field-error {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        color: var(--pg-danger);
        font-size: 0.7rem;
        font-weight: 500;
        margin: 0.25rem 0 0;
    }

    /* ---------- UTILITAS LOKAL (dipakai markup & JS) ---------- */
    .hidden      { display: none !important; }
    .flex        { display: flex; }
    .flex-wrap   { flex-wrap: wrap; }
    .flex-1      { flex: 1 1 0%; min-width: 0; }
    .gap-2       { gap: 0.5rem; }
    .justify-center { justify-content: center; }
    .text-center { text-align: center; }
    .mt-3        { margin-top: 0.75rem; }

    /* ---- ALERT ---- */
    .pln-alert {
        display: flex;
        align-items: flex-start;
        gap: 0.8rem;
        border-radius: 14px;
        padding: 1rem 1.15rem;
        margin: 0 0 1.5rem;
        border: 1px solid;
        font-size: 0.9rem;
        animation: pln-fade-in 0.2s ease both;
    }

    .pln-alert > i {
        margin-top: 0.1rem;
        flex-shrink: 0;
    }
    .pln-alert p { margin: 0; }
    .pln-alert ul {
        margin: 0.4rem 0 0;
        padding-left: 1.3rem;
    }

    .pln-alert-success {
        border-color: #bbf7d0;
        color: #166534;
        background: #f0fdf4;
    }
    .pln-alert-success > i {
        color: #16a34a;
    }

    .pln-alert-error {
        border-color: #fecaca;
        color: #991b1b;
        background: #fef2f2;
    }
    .pln-alert-error > i {
        color: #dc2626;
    }

    .pln-alert-close {
        margin-left: auto;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.2rem 0.4rem;
        opacity: 0.5;
        color: inherit;
        transition: opacity 0.2s ease;
        border-radius: 6px;
    }

    .pln-alert-close:hover {
        opacity: 1;
        background: rgba(0, 0, 0, 0.03);
    }

    /* ---- DROPZONE UPLOAD DOKUMENT ---- */
    .pln-upload-wrap { position: relative; width: 100%; }

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

    .pln-file-input:focus + .pln-dropzone { border-color: var(--pln-blue); }

    .pln-dropzone {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.25rem;
        border: 1.4px dashed #cbd5e1;
        border-radius: 9px;
        background: #fff;
        padding: 0.6rem 0.7rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.18s ease;
        min-height: 70px;
    }

    .pln-dropzone .dz-icon { font-size: 1.05rem; color: #94a3b8; transition: color 0.18s ease; }

    .pln-dropzone:hover,
    .pln-dropzone:focus-visible,
    .pln-dropzone.is-dragover {
        border-color: var(--pln-blue);
        background: rgba(0, 143, 168, 0.025);
    }

    .pln-dropzone.has-error { border-color: #dc2626; background: #fef2f2; }

    .pln-dropzone:hover > .dz-icon,
    .pln-dropzone:focus-visible > .dz-icon,
    .pln-dropzone.is-dragover > .dz-icon { color: var(--pln-blue); }

    .pln-dropzone p { margin: 0; }
    .pln-dropzone-title { font-size: 0.66rem; font-weight: 600; color: #334155; }
    .pln-dropzone-hint { font-size: 0.6rem; color: #94a3b8; }

    /* ---- KARTU FILE TERPILIH ---- */
    .pln-file-card {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.4rem;
        border: 1.4px solid #e2e8f0;
        border-radius: 7px;
        background: #fff;
        padding: 0.35rem 0.5rem;
        margin-top: 0.4rem;
    }

    .pln-file-card .file-badge {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        flex-shrink: 0;
    }

    .pln-file-card .file-badge.badge-pdf   { background: rgba(220, 38, 38, 0.1); color: #dc2626; }
    .pln-file-card .file-badge.badge-doc   { background: rgba(0, 112, 192, 0.1); color: #0070c0; }
    .pln-file-card .file-badge.badge-xls   { background: rgba(166, 89, 16, 0.1); color: #a65910; }
    .pln-file-card .file-badge.badge-zip   { background: rgba(0, 194, 209, 0.1); color: #00c2d1; }

    .pln-file-card .file-name {
        font-size: 0.7rem;
        font-weight: 600;
        color: #334155;
        margin: 0;
        word-break: break-all;
        flex: 1;
    }
    .pln-file-card .file-size { font-size: 0.62rem; color: #94a3b8; margin: 0; }

    .btn-mini {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.6rem;
        font-weight: 600;
        padding: 0.18rem 0.45rem;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        transition: all 0.14s ease;
    }
    .btn-mini-danger  { background: #fef2f2; color: #dc2626; }
    .btn-mini-danger:hover  { background: #fee2e2; }
    .btn-mini-neutral { background: #f1f5f9; color: #64748b; }
    .btn-mini-neutral:hover { background: #e2e8f0; color: #008fa8; }

    /* ---- TOMBOL AKSI ---- */
    .pln-actions {
        border-top: 1px solid var(--pg-line);
        background: #fff;
        padding: 0.5rem 0.7rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.45rem;
    }

    .pln-required-note {
        margin: 0;
        font-size: 0.64rem;
        color: var(--pg-muted);
    }

    .pln-required-note .required { color: var(--pg-danger); font-weight: 600; }

    .btn-pln-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
        font-size: 0.74rem;
        font-weight: 600;
        padding: 0.45rem 1rem;
        border-radius: 999px;
        border: none;
        cursor: pointer;
        background: var(--pln-yellow);
        color: var(--pln-blue);
        transition: all 0.18s ease;
        box-shadow: 0 2px 5px rgba(255, 230, 0, 0.32);
    }
    .btn-pln-primary:hover:not(:disabled) {
        background: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 9px rgba(255, 230, 0, 0.42);
    }
    .btn-pln-primary:active:not(:disabled) { transform: translateY(0); }
    .btn-pln-primary:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }
    @media (max-width: 639.98px) {
        .btn-pln-primary { width: 100%; }
    }

    /* ---- MODAL SUKSES ---- */
    @keyframes pln-fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes pln-pop {
        from {
            opacity: 0;
            transform: scale(0.88) translateY(12px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes pln-ring {
        from {
            transform: scale(0.85);
            opacity: 0.85;
        }
        to {
            transform: scale(1.15);
            opacity: 0;
        }
    }

    .pln-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.32);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1200;
        padding: 1.2rem;
        animation: pln-fade-in 0.22s ease both;
    }

    .pln-modal-success {
        background: #fff;
        border-radius: 22px;
        padding: 1.8rem 1.6rem 1.4rem;
        max-width: 380px;
        width: 100%;
        text-align: center;
        box-shadow: 0 22px 60px rgba(0, 0, 0, 0.13);
        animation: pln-pop 0.32s ease both;
    }

    .pln-success-icon {
        position: relative;
        width: 64px;
        height: 64px;
        margin: 0 auto 0.85rem;
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.7rem;
        color: #16a34a;
        box-shadow: 0 5px 14px rgba(22, 163, 74, 0.18);
        animation: pln-pop 0.4s cubic-bezier(0.2, 0.85, 0.3, 1.3) both;
    }

    .pln-success-icon::before {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: 50%;
        border: 3px solid rgba(22, 163, 74, 0.2);
        animation: pln-ring 1.5s ease-out 0.25s 1 both;
    }

    .pln-success-title {
        font-size: 1.04rem;
        font-weight: 700;
        color: var(--pg-text);
        margin: 0 0 0.35rem;
    }

    .pln-success-text {
        font-size: 0.82rem;
        color: var(--pg-muted);
        margin: 0 0 1.1rem;
        line-height: 1.5;
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
        color: rgba(255, 255, 255, 0.9);
        margin: 1.2rem 0 0;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    /* Hormati preferensi reduced motion (scoped ke halaman ini) */
    @media (prefers-reduced-motion: reduce) {
        .pln-page *,
        .pln-card { animation: none !important; transition: none !important; }
    }
</style>
@endpush

@section('content')
<div class="pln-page" style="padding-top: 4.6rem;">
    <div class="pln-container">

        {{-- ================= HEADER RENGAN UNTUK FORM (kecil & mengikuti brand top bar) ================= --}}
        <div class="pln-header">
            <div class="pln-header-row">
                <img src="{{ asset('assets/images/logo-pln.png') }}" alt="PLN Nusantara Power"
                     class="pln-logo"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                <div class="pln-brand-icon d-none">
                    <i class="fas fa-id-card"></i>
                </div>
                <h1 class="pln-title" data-i18n="form.title">Form Registrasi Tamu</h1>
                <p class="pln-subtitle" data-i18n="form.subtitle">Silakan lengkapi data diri Anda untuk pendaftaran kunjungan.</p>
            </div>
        </div>

        {{-- ================= POP-UP SUKSES ================= --}}
        @if(session('success'))
        <div class="pln-modal-overlay" id="successModal" style="display: flex;">
            <div class="pln-modal-success" role="dialog" aria-modal="true" aria-labelledby="successTitle">
                <div class="pln-success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="pln-success-title" id="successTitle" data-i18n="form.success_title">Data Anda Berhasil Dikirim!</h2>
                <p class="pln-success-text" data-i18n="form.success_text">Menunggu konfirmasi admin.<br>Silakan cek email / WhatsApp Anda untuk informasi selanjutnya.</p>
                        <a href="{{ route('layanan.registrasi-tamu') }}" id="btn-modal-selesai"
                   class="btn-pln-primary pln-success-close"
                   data-i18n="form.btn_done"
                   style="display: inline-block; text-decoration: none;"
                   aria-label="Selesai">
                    <span>Selesai</span>
                </a>
            </div>
        </div>
        @endif

        {{-- ================= ERROR VALIDASI ================= --}}
        @if($errors->any())
            <div class="pln-alert pln-alert-error" id="alert-error" role="alert" style="margin: 0 0 1rem;">
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
                            Foto KTP <span class="required">*</span>
                        </label>
                        <p class="pln-hint" style="margin: -0.4rem 0 0.5rem; font-size: 0.72rem;">
                            JPG / PNG, maks 2MB
                        </p>                            <div class="pln-input-icon">
                                <i class="fas fa-fingerprint"></i>
                                <input type="text" id="nik" name="nik"
                                       inputmode="numeric"
                                       maxlength="16"
                                       pattern="[0-9]{1,16}"
                                       value="{{ old('nik') }}"
                                       placeholder="Masukan 16 digit NIK"
                                       data-i18n-placeholder="form.ph_nik"
                                       required autocomplete="off"
                                       class="pln-input @error('nik') has-error @enderror"
                                       oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16);"
                                       onpaste="(function(t){ t.value=t.value.replace(/[^0-9]/g,''); if(t.value.length>16) t.value=t.value.slice(0,16); })(this)"
                                       @error('nik') has-error @enderror" />
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

                    {{-- No. HP / WhatsApp + Email --}}
                    <div class="grid-2">
                    <div>
                        <label for="no_hp" class="pln-label" data-i18n="form.label_nohp">
                            No. WhatsApp / HP <span class="required">*</span>
                        </label>
                        <div class="pln-input-icon">
                            <i class="fas fa-phone"></i>
                            <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                   placeholder="08xxxxxxxxxx" autocomplete="tel" required
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

                {{-- ========== SEKSI 2: DOKUMEN ========== --}}
                <div class="pln-section pln-section--doc">
                    <div class="pln-section-head">
                        <span class="pln-section-icon"><i class="fas fa-file"></i></span>
                        <h2 class="pln-section-title" data-i18n="form.doc_dokumen">BERKAS PENDUKUNG</h2>
                    </div>

                    <div>
                        <label class="pln-label" for="dokumen">
                            Upload Dokumen <span class="required">*</span>
                        </label>
                        <p class="pln-hint" style="margin: -0.4rem 0 0.5rem; font-size: 0.72rem;">
                            ZIP, DOC, DOCX, XLS, XLSX, PDF — maksimal 10MB
                        </p>
                        <div id="dokumen-upload-status" class="text-danger" style="font-size: 0.75rem; margin-top: 0.25rem;"></div>
                        <div class="pln-upload-wrap">
                            <input type="file" id="dokumen" name="dokumen"
                                   accept=".pdf,.doc,.docx,.xls,.xlsx,.zip,.rar,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/zip,application/x-zip-compressed,application/x-rar-compressed"
                                   class="pln-file-input" />
                            <div id="dokumen-area"
                                 class="pln-dropzone @error('dokumen') has-error @enderror"
                                 role="button" tabindex="0"
                                 aria-label="Pilih berkas pendukung">
                                <i class="fas fa-file-upload dz-icon"></i>
                                <div>
                                    <p class="pln-dropzone-title" data-i18n="form.dz_title">Klik untuk memilih berkas</p>
                                    <p class="pln-dropzone-hint" id="dokumen-hint" data-i18n="form.dz_hint">
                                        atau seret &amp; letakkan di sini — maksimal 10MB
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Berkas Terpilih -->
                        <div id="dokumen-preview" class="pln-file-card hidden" style="margin-top: 0.5rem;">
                            <div id="dokumen-badge" class="file-badge">
                                <i class="fas fa-file"></i>
                            </div>
                            <p id="dokumen-name" class="file-name"></p>
                            <p id="dokumen-size" class="file-size"></p>
                            <button type="button" class="btn-mini btn-mini-danger" onclick="removeDokumen()">
                                <i class="fas fa-trash-can"></i> Hapus
                            </button>
                        </div>
                        @error('dokumen')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> <span id="dokumen-error">{{ $message }}</span></p>
                        @enderror
                        <p id="dokumen-status" class="pln-hint" style="margin-top: 0.3rem; display: none;"></p>
                    </div>
                </div>

                {{-- ========== SEKSI 3: DETAIL KUNJUNGAN ========== --}}
                <div class="pln-section pln-section--detail">
                    <div class="pln-section-head">
                        <span class="pln-section-icon"><i class="fas fa-calendar-check"></i></span>
                        <h2 class="pln-section-title" data-i18n="form.section_visit">Detail Kunjungan</h2>
                    </div>

                    {{-- Orang/Divisi yang Ditemui — Select Option statis --}}
                    <div>
                        <label for="tujuan_ditemui" class="pln-label" data-i18n="form.label_tujuan">
                            Orang / Divisi yang Ditemui <span class="required">*</span>
                        </label>
                        <div class="pln-input-icon" style="position: relative;">
                            <input type="text" id="tujuan_ditemui_display" readonly
                                   value="{{ old('tujuan_ditemui', '') }}"
                                   placeholder="— Pilih Divisi —"
                                   class="pln-input custom-dropdown-input @error('tujuan_ditemui') has-error @enderror"
                                   aria-haspopup="listbox">
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                            <div id="divisi-dropdown" class="custom-dropdown-menu custom-scroll-menu" role="listbox" style="display: none;">
                                <div class="dropdown-options custom-scroll-content" id="divisi-options">
                                    <div class="dropdown-option" data-value="" data-selected="true">— Pilih Divisi —</div>

                                    <div class="dropdown-optgroup">Manager Operasi</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer Prod A">Assisten Manajer Prod A</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer Prod B">Assisten Manajer Prod B</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer Prod C">Assisten Manajer Prod C</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer Prod D">Assisten Manajer Prod D</div>
                                    <div class="dropdown-option" data-value="Supervisor CHCB A">Supervisor CHCB A</div>
                                    <div class="dropdown-option" data-value="Supervisor CHCB B">Supervisor CHCB B</div>
                                    <div class="dropdown-option" data-value="Supervisor CHCB C">Supervisor CHCB C</div>
                                    <div class="dropdown-option" data-value="Supervisor CHCB D">Supervisor CHCB D</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer RenOps">Assisten Manajer RenOps</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer Niaga BB">Assisten Manajer Niaga BB</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer Kimia &amp; Lab">Assisten Manajer Kimia &amp; Lab</div>

                                    <div class="dropdown-optgroup">Manager Pemeliharaan</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer Rendal Har">Assisten Manajer Rendal Har</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer MO">Assisten Manajer MO</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer Mesin 1">Assisten Manajer Mesin 1</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer Mesin 2">Assisten Manajer Mesin 2</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer Listrik">Assisten Manajer Listrik</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer Konin">Assisten Manajer Konin</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer Inventori Kontrol &amp; Gudang">Assisten Manajer Inventori Kontrol &amp; Gudang</div>

                                    <div class="dropdown-optgroup">Manager Engineering</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer SO">Assisten Manajer SO</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer CBM">Assisten Manajer CBM</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer MMRK">Assisten Manajer MMRK</div>

                                    <div class="dropdown-optgroup">Manager Business Support</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer Pengadaan">Assisten Manajer Pengadaan</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer SDM Umum CSR">Assisten Manajer SDM Umum CSR</div>
                                    <div class="dropdown-option" data-value="Assisten Manajer Keuangan">Assisten Manajer Keuangan</div>

                                    <div class="dropdown-optgroup">Posisi Langsung di Bawah Senior Manager</div>
                                    <div class="dropdown-option" data-value="Assisten Manager K3 &amp; KAM">Assisten Manager K3 &amp; KAM</div>
                                    <div class="dropdown-option" data-value="Assisten Manager Lingkungan">Assisten Manager Lingkungan</div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="tujuan_ditemui" id="tujuan_ditemui" value="{{ old('tujuan_ditemui', '') }}">
                        @error('tujuan_ditemui')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal & Jam Kunjungan + Jumlah Tamu --}}
                    <div class="grid-2">
                        <div>
                            <label for="tanggal_kunjungan" class="pln-label" data-i18n="form.label_tanggal">
                                Tanggal Kunjungan <span class="required">*</span>
                            </label>
                            <div class="pln-input-icon">
                                <i class="fas fa-calendar-alt"></i>
                                <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan"
                                       value="{{ old('tanggal_kunjungan', today()->format('Y-m-d')) }}"
                                       required aria-label="tanggal kunjungan"
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
                                        aria-label="jam kunjungan"
                                        class="pln-input custom-dropdown-input @error('jam_kunjungan') has-error @enderror">
                                    <option value="">— Pilih Jam —</option>
                                </select>
                                <i class="fas fa-chevron-down dropdown-arrow"></i>
                            </div>
                            <div id="jam-status" class="pln-hint" style="margin-top: 0.25rem; display: none;"></div>
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

                    <div class="slot-warning" id="slot-warning" style="display: none;">
                        <i class="fas fa-circle-exclamation"></i>
                        <span data-i18n="form.slot_taken">Jam ini sudah penuh / sudah di-approve untuk divisi ini. Silakan pilih jam lain.</span>
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

            {{-- ================= FOOTER FORM & TOMBOL SUBMIT ================= --}}
            <div class="pln-actions">
                <p class="pln-required-note"><span class="required">*</span> Wajib diisi. Data Anda aman &amp; hanya untuk keperluan registrasi.</p>
                <button type="submit" class="btn-pln-primary" id="btn-submit" onclick="console.log('[Form] Submit diklik')">
                    <i class="fas fa-paper-plane"></i> <span data-i18n="form.btn_submit">Daftar Sekarang</span>
                </button>
            </div>
        </form>

        <p class="pln-footnote" style="text-align: center; font-size: 0.75rem; color: var(--pg-muted); margin: 1rem 0 0;">
            <span data-i18n="form.footnote">Data Anda disimpan aman dan hanya digunakan untuk keperluan registrasi kunjungan.</span>
        </p>
    </div>
</div>        @endsection

@push('scripts')
<script>
    (function () {
        'use strict';

        /* ===== UPLOAD DOKUMEN PENDUKUNG ===== */
        // Format yang diizinkan:
        //   PDF (.pdf)
        //   Microsoft Word (.doc, .docx)
        //   Microsoft Excel (.xls, .xlsx)
        //   Arsip compressed (.zip, .rar)
        // Maksimal ukuran: 10 MB

        // KONSTANTA
        var MAX_DOKUMEN  = 10 * 1024 * 1024; // 10 MB
        var DOKUMEN_EXT  = ['zip', 'doc', 'docx', 'xls', 'xlsx', 'pdf', 'rar'];
        var DOKUMEN_TEXT = 'PDF, DOC, DOCX, XLS, XLSX, ZIP, atau RAR';

        var DOKUMEN_BADGE_CLASS = {
            zip: 'badge-zip',
            pdf: 'badge-pdf',
        };
        var DOKUMEN_ICON = {
            zip: 'fa-file-archive',
            rar: 'fa-file-archive',
            doc: 'fa-file-word',
            docx: 'fa-file-word',
            xls: 'fa-file-excel',
            xlsx: 'fa-file-excel',
            pdf: 'fa-file-pdf',
        };

        // HELPER
        function getFileExt(name) {
            if (!name) return '';
            var parts = String(name).split('.');    return parts.length > 1 ? parts.pop().toLowerCase() : '';
        }

        function isAllowedExt(file, whitelist) {
            return whitelist.indexOf(getFileExt(file.name)) !== -1;
        }

        function formatFileSize(bytes) {
            if (!bytes || bytes < 0) return '0 B';
            if (bytes >= 1024 * 1024) {
                return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
            }
            return Math.max(1, Math.round(bytes / 1024)) + ' KB';
        }

        /* Hapus file terpilih → kembali ke dropzone kosong */
        window.removeDokumen = function () {
            var input = document.getElementById('dokumen');
            if (!input) {
                console.error('[Dokumen] Input tidak ditemukan');
                return;
            }

            input.value = '';

            var area = document.getElementById('dokumen-area');
            var preview = document.getElementById('dokumen-preview');
            var badge = document.getElementById('dokumen-badge');
            var nameEl = document.getElementById('dokumen-name');
            var sizeEl = document.getElementById('dokumen-size');

            console.log('[Dokumen] File dihapus');

            if (badge) {
                badge.className = 'file-badge';
                badge.innerHTML = '<i class="fas fa-file"></i>';
            }
            if (nameEl) nameEl.textContent = '';
            if (sizeEl) sizeEl.textContent = '';
            if (preview) preview.classList.add('hidden');
            if (area) {
                area.classList.remove('has-error');
                area.classList.remove('hidden');
                // Tampilkan pesan default
                var hint = area.querySelector('.pln-dropzone-hint');
                if (hint) hint.textContent = 'atau seret & letakkan di sini — maksimal 10MB';
            }

            // Sembunyikan status
            var statusEl = document.getElementById('dokumen-status');
            if (statusEl) {
                statusEl.style.display = 'none';
            }
        };

        /* Preview dokumen: badge, nama, ukuran + sembunyikan dropzone kosong */
        window.previewDokumen = function (input) {
            console.log('[Dokumen] previewDokumen dipanggil, input:', input);

            if (!input) {
                console.error('[Dokumen] Input tidak ditemukan');
                return;
            }

            if (!input.files || !input.files[0]) {
                console.log('[Dokumen] Tidak ada file');
                return;
            }

            var file = input.files[0];
            console.log('[Dokumen] File dipilih:', file.name, formatFileSize(file.size), 'type:', file.type);

            var ext = getFileExt(file.name);
            console.log('[Dokumen] Ekstensi:', ext);

            // Validasi sisi klien (server tetap sumber kebenaran)
            if (!isAllowedExt(file, DOKUMEN_EXT)) {
                console.error('[Dokumen] Format tidak didukung:', file.name, 'ekstensi:', ext);
                var statusEl = document.getElementById('dokumen-upload-status');
                if (statusEl) {
                    statusEl.textContent = '✗ Format tidak didukung: .' + ext + ' (didukung: ' + DOKUMEN_TEXT + ')';
                }
                alert('Format berkas tidak didukung.\n\nDukungan: ' + DOKUMEN_TEXT + '.\n\nAnda memilih: ' + file.name + ' (.' + ext + ')');
                window.removeDokumen();
                return;
            }

            if (file.size > MAX_DOKUMEN) {
                console.error('[Dokumen] Ukuran terlalu besar:', formatFileSize(file.size), 'maksimal:', formatFileSize(MAX_DOKUMEN));
                var statusEl = document.getElementById('dokumen-upload-status');
                if (statusEl) {
                    statusEl.textContent = '✗ Ukuran terlalu besar: ' + formatFileSize(file.size) + ' (maksimal: 10MB)';
                }
                alert('Ukuran berkas terlalu besar.\n\nMaksimal: 10MB\nUkuran file: ' + formatFileSize(file.size));
                window.removeDokumen();
                return;
            }

            console.log('[Dokumen] File valid, menampilkan preview');

            var area = document.getElementById('dokumen-area');
            var preview = document.getElementById('dokumen-preview');
            var badge = document.getElementById('dokumen-badge');
            var nameEl = document.getElementById('dokumen-name');
            var sizeEl = document.getElementById('dokumen-size');

            if (badge) {
                badge.className = 'file-badge' +
                    (DOKUMEN_BADGE_CLASS[ext] ? ' ' + DOKUMEN_BADGE_CLASS[ext] : '');
                badge.innerHTML = '<i class="fas ' + (DOKUMEN_ICON[ext] || 'fa-file') + '"></i>';
            }

            if (nameEl) nameEl.textContent = file.name;
            if (sizeEl) sizeEl.textContent = formatFileSize(file.size);

            if (area) {
                area.classList.remove('has-error');
                area.classList.add('hidden');
            }
            if (preview) {
                preview.classList.remove('hidden');
            }

            // Sembunyikan status error sebelumnya
            var statusEl = document.getElementById('dokumen-status');
            if (statusEl) {
                statusEl.style.display = 'block';
                statusEl.textContent = '✓ File dipilih: ' + file.name + ' (' + formatFileSize(file.size) + ')';
                statusEl.style.color = '#16a34a';
            }

            // Sembunyikan pesan error upload
            var uploadStatusEl = document.getElementById('dokumen-upload-status');
            if (uploadStatusEl) {
                uploadStatusEl.textContent = '';
            }

            console.log('[Dokumen] Preview berhasil ditampilkan');
        };

        // Inisialisasi upload dokumen
        try {
            (function initDokumenUpload() {
                console.log('[Dokumen] Inisialisasi upload dokumen...');
                console.log('[Dokumen] document.getElementById("dokumen"):', document.getElementById('dokumen'));
                console.log('[Dokumen] document.getElementById("dokumen-area"):', document.getElementById('dokumen-area'));

                var inputDokumen = document.getElementById('dokumen');
                var dokArea = document.getElementById('dokumen-area');

                if (!inputDokumen) {
                    console.error('[Dokumen] Input file tidak ditemukan!');
                    return;
                }

                if (!dokArea) {
                    console.error('[Dokumen] Area dropzone tidak ditemukan!');
                    return;
                }

                console.log('[Dokumen] Elemen ditemukan:', { input: inputDokumen, area: dokArea });

                // Klik area untuk membuka file picker
                dokArea.addEventListener('click', function (e) {
                    console.log('[Dokumen] Area diklik');
                    e.preventDefault();
                    inputDokumen.click();
                });

                // Support keyboard untuk aksesibilitas
                dokArea.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        inputDokumen.click();
                    }
                });

                // Drag & drop events
                ['dragover', 'dragenter'].forEach(function (evtType) {
                    dokArea.addEventListener(evtType, function (e) {
                        e.preventDefault();
                        dokArea.classList.add('is-dragover');
                    });
                });

                ['dragleave', 'drop'].forEach(function (evtType) {
                    dokArea.addEventListener(evtType, function (e) {
                        e.preventDefault();
                        dokArea.classList.remove('is-dragover');
                    });
                });

                // Handle drop
                dokArea.addEventListener('drop', function (e) {
                    e.preventDefault();
                    dokArea.classList.remove('is-dragover');

                    var files = e.dataTransfer.files;
                    console.log('[Dokumen] Drop event, files:', files.length);

                    if (files.length > 0) {
                        try {
                            inputDokumen.files = files;
                            console.log('[Dokumen] Files berhasil di-set via drop');
                        } catch (err) {
                            console.error('[Dokumen] Error set files via drop:', err);
                            // Fallback untuk browser yang lebih lama
                            var dt = new DataTransfer();
                            for (var i = 0; i < files.length; i++) {
                                dt.items.add(files[i]);
                            }
                            inputDokumen.files = dt.files;
                        }
                        // Panggil preview setelah set files
                        setTimeout(function () {
                            window.previewDokumen(inputDokumen);
                        }, 10);
                    }
                });

                // Handle change ( saat file dipilih via file picker)
                inputDokumen.addEventListener('change', function (e) {
                    console.log('[UPLOAD] Change event dipanggil!');
                    console.log('[UPLOAD] files:', inputDokumen.files);
                    if (inputDokumen.files && inputDokumen.files[0]) {
                        console.log('[UPLOAD] File dipilih:', inputDokumen.files[0].name, formatFileSize(inputDokumen.files[0].size));
                    }
                    window.previewDokumen(inputDokumen);
                });

                console.log('[UPLOAD TEST] === INISIALISASI SELESAI ===');
            })();
        } catch (err) {
            console.error('[UPLOAD TEST] ERROR fatal:', err);
        }

        /* ===== DROPDOWN DIVISI ===== */
        (function () {
            var inputDisplay = document.getElementById('tujuan_ditemui_display');
            var inputHidden = document.getElementById('tujuan_ditemui');
            var wrapper = inputDisplay && inputDisplay.closest ? inputDisplay.closest('.pln-input-icon') : null;
            var dropdownMenu = wrapper && wrapper.querySelector ? wrapper.querySelector('#divisi-dropdown') : null;
            var optionsContainer = wrapper && wrapper.querySelector ? wrapper.querySelector('#divisi-options') : null;

            if (!inputDisplay || !dropdownMenu || !optionsContainer) {
                console.error('[Divisi] Elemen tidak ditemukan');
                return;
            }

            var isOpen = false;

            function toggle() {
                isOpen = !isOpen;
                dropdownMenu.style.display = isOpen ? 'block' : 'none';
                inputDisplay.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                if (inputDisplay.parentElement) inputDisplay.parentElement.classList.toggle('dropdown-open', isOpen);
            }

            function close() {
                isOpen = false;
                if (dropdownMenu) dropdownMenu.style.display = 'none';
                inputDisplay.setAttribute('aria-expanded', 'false');
            }

            function select(opt) {
                optionsContainer.querySelectorAll('.dropdown-option').forEach(function (o) { o.classList.remove('selected'); });
                opt.classList.add('selected');
                inputDisplay.value = opt.textContent.trim();
                inputHidden.value = opt.getAttribute('data-value');
                close();
                // Trigger change untuk jam dropdown
                inputHidden.dispatchEvent(new Event('change', { bubbles: true }));
            }

            inputDisplay.addEventListener('click', function (e) { e.stopPropagation(); toggle(); });
            optionsContainer.addEventListener('click', function (e) {
                var opt = e.target.closest('.dropdown-option');
                if (opt) select(opt);
            });
            document.addEventListener('click', function (e) { if (!wrapper.contains(e.target)) close(); });
            inputDisplay.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') { close(); inputDisplay.blur(); }
                if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggle(); }
            });

            // Load initial value
            var initVal = inputHidden.value;
            if (initVal) {
                var match = optionsContainer.querySelector('.dropdown-option[data-value="' + initVal + '"]');
                if (match) select(match);
            }

            console.log('[Divisi] Inisialisasi selesai');
        })();

        /* ===== JAM KUNJUNGAN ===== */
        (function () {
            var SLOT_OPSIONAL = [
                { jam: '08:00', label: '08:00 – 09:00' },
                { jam: '09:00', label: '09:00 – 10:00' },
                { jam: '10:00', label: '10:00 – 11:00' },
                { jam: '11:00', label: '11:00 – 11:30' },
                { jam: '12:00', label: '13:00 – 14:00' },
                { jam: '13:00', label: '14:00 – 15:00' },
                { jam: '14:00', label: '15:00 – 16:00' },
                { jam: '15:00', label: '16:00 – 17:00' },
                { jam: '16:00', label: '17:00 – 18:00' },
            ];
            var JAM_ISTIRAHAT_AWAL = '11:30';
            var JAM_ISTIRAHAT_AKHR = '13:00';

            var selectJam = document.getElementById('jam_kunjungan');
            var slotWarning = document.getElementById('slot-warning');
            var tanggalInput = document.getElementById('tanggal_kunjungan');
            var divisiInputDisplay = document.getElementById('tujuan_ditemui_display');
            var divisiInputHidden = document.getElementById('tujuan_ditemui');

            if (!selectJam || !tanggalInput || !divisiInputDisplay || !divisiInputHidden) {
                console.error('[Jam] Elemen tidak ditemukan', {
                    selectJam: !!selectJam,
                    tanggalInput: !!tanggalInput,
                    divisiInputDisplay: !!divisiInputDisplay,
                    divisiInputHidden: !!divisiInputHidden,
                });
                return;
            }

            var divisiInput = divisiInputHidden;
            var jamStatus = document.getElementById('jam-status') || (function () {
                var el = document.createElement('div');
                el.id = 'jam-status';
                el.className = 'pln-hint';
                el.style.display = 'none';
                if (selectJam && selectJam.parentElement) {
                    selectJam.parentElement.appendChild(el);
                }
                return el;
            })();

            if (!jamStatus) {
                console.error('[Jam] Elemen jam-status tidak ditemukan dan gagal dibuat');
                return;
            }

            jamStatus.style.display = 'block';
            jamStatus.textContent = 'Vacuum - tunggu divisi & tanggal';
            jamStatus.style.color = '#64748b';

            console.log('[Jam] Elemen OK', { selectJam: selectJam.id, tanggalInput: tanggalInput.id, divisiInput: divisiInput.id, jamStatus: jamStatus.id });

            var renderCount = 0;
            function safeRender() {
                try {
                    renderCount += 1;
                    console.log('[Jam] renderCount:', renderCount);
                    buildJamOptions([], JAM_ISTIRAHAT_AWAL, JAM_ISTIRAHAT_AKHR);
                    jamStatus.textContent = 'Render manual berjalan. Pilih divisi & tanggal.';
                    jamStatus.style.color = '#64748b';
                } catch (err) {
                    console.error('[Jam] Error saat render manual:', err);
                }
            }
            safeRender();

            console.log('[Jam] Divisi awal:', divisiInput.value);
            console.log('[Jam] Tanggal awal:', tanggalInput.value);

            var loading = false;

            function buildJamOptions(blocked, istirahatAwal, istirahatAkhr) {
                selectJam.innerHTML = '<option value="">— Pilih Jam —</option>';

                var mulai = istirahatAwal ? istirahatAwal.trim() : '';
                var akhir = istirahatAkhr ? istirahatAkhr.trim() : '';

                SLOT_OPSIONAL.forEach(function (opt) {
                    var val = opt.jam;
                    var disabled = false;
                    var label = opt.label;
                    var blockedReason = '';

                    if (mulai && akhir && val >= mulai && val < akhir) {
                        disabled = true;
                        label = opt.label + ' (Jam Istirahat)';
                    }

                    if (blocked.indexOf(val) !== -1) {
                        disabled = true;
                        label = opt.label + ' (Terblokir)';
                        blockedReason = 'terblokir';
                    }

                    var option = document.createElement('option');
                    option.value = val;
                    option.textContent = label;
                    if (blockedReason) {
                        option.setAttribute('data-status', 'terblokir');
                    } else if (disabled && val >= mulai && val < akhir) {
                        option.setAttribute('data-status', 'istirahat');
                    } else {
                        option.setAttribute('data-status', 'tersedia');
                    }
                    if (disabled) option.disabled = true;

                    selectJam.appendChild(option);
                });

                var old = selectJam.dataset.old;
                if (old) {
                    var found = selectJam.querySelector('option[value="' + old + '"]');
                    if (found && !found.disabled) {
                        selectJam.value = old;
                    } else {
                        selectJam.value = '';
                    }
                }
            }

            function refreshJamSlot() {
                var tanggal = tanggalInput.value.trim();
                var divisi = divisiInput.value.trim();

                console.log('[Jam] refreshJamSlot()', { tanggal, divisi });

                if (!tanggal || !divisi) {
                    buildJamOptions([], JAM_ISTIRAHAT_AWAL, JAM_ISTIRAHAT_AKHR);
                    if (jamStatus) {
                        jamStatus.style.display = 'block';
                        jamStatus.textContent = 'Pilih divisi & tanggal terlebih dahulu';
                        jamStatus.style.color = '#64748b';
                    }
                    if (slotWarning) slotWarning.style.display = 'none';
                    return;
                }

                if (loading) return;
                loading = true;

                if (jamStatus) {
                    jamStatus.style.display = 'block';
                    jamStatus.textContent = 'Memuat ketersediaan jam...';
                    jamStatus.style.color = '#64748b';
                }

                fetch('{{ route("layanan.registrasi-tamu.booked-slots") }}?tanggal=' + encodeURIComponent(tanggal) + '&divisi=' + encodeURIComponent(divisi))
                    .then(function (r) { return r.json(); })
                    .then(function (data) {
                        loading = false;
                        var blocked = Array.isArray(data.jam_terblokir) ? data.jam_terblokir : [];
                        buildJamOptions(blocked, JAM_ISTIRAHAT_AWAL, JAM_ISTIRAHAT_AKHR);

                        var selected = selectJam.value;
                        var isBlocked = blocked.indexOf(selected) !== -1;
                        if (isBlocked) {
                            slotWarning.style.display = 'flex';
                        } else {
                            slotWarning.style.display = 'none';
                        }

                        if (jamStatus) {
                            jamStatus.style.display = 'block';
                            jamStatus.textContent = blocked.length
                                ? '⚠ Jam terblokir: ' + blocked.join(', ')
                                : '✓ Semua tersedia';
                            jamStatus.style.color = blocked.length ? '#dc2626' : '#16a34a';
                        }
                    })
                    .catch(function (err) {
                        loading = false;
                        console.error('[Jam] Error:', err);
                        if (jamStatus) {
                            jamStatus.style.display = 'block';
                            jamStatus.textContent = 'Gagal memuat ketersediaan jam';
                            jamStatus.style.color = '#dc2626';
                        }
                    });
            }

            renderSlots();
            console.log('[Jam] memanggil refreshJamSlot() saat init');
            refreshJamSlot();
            setTimeout(function () {
                console.log('[Jam] cek ulang divisi setelah timeout 300ms:', divisiInput.value);
                if (divisiInput.value) {
                    refreshJamSlot();
                }
            }, 300);

            console.log('[Jam] Elemen awal:', {
                tanggalInput: !!tanggalInput,
                divisiInput: !!divisiInput,
                selectJam: !!selectJam,
                tanggalValue: tanggalInput.value,
                divisiValue: divisiInput.value,
            });

            buildJamOptions([], JAM_ISTIRAHAT_AWAL, JAM_ISTIRAHAT_AKHR);

            if (jamStatus) {
                jamStatus.style.display = 'block';
                jamStatus.textContent = 'Silakan pilih divisi dan tanggal untuk melihat ketersediaan jam';
                jamStatus.style.color = '#64748b';
            }

            tanggalInput.addEventListener('change', function () {
                console.log('[Jam] tanggalInput change:', tanggalInput.value);
                refreshJamSlot();
            });
            divisiInputDisplay.addEventListener('click', function () {
                console.log('[Jam] divisi display clicked');
            });
            divisiInput.addEventListener('input', function () {
                console.log('[Jam] divisi input:', divisiInput.value);
            });
            divisiInput.addEventListener('change', function () {
                console.log('[Jam] divisi change:', divisiInput.value);
                refreshJamSlot();
            });
            divisiInputDisplay.addEventListener('dropdown-change', function (e) {
                console.log('[Jam] dropdown-change event:', e.detail);
                refreshJamSlot();
            });
            document.addEventListener('dropdown-change', function (e) {
                if (e.detail && e.detail.value) {
                    console.log('[Jam] global dropdown-change:', e.detail.value);
                    refreshJamSlot();
                }
            });
            // fallback: jika ada elemen yang mendispatch change manual
            if (window.CustomEvent) {
                divisiInput.addEventListener('change', function () {
                    refreshJamSlot();
                });
            }
            selectJam.addEventListener('change', function () {
                refreshJamSlot();
            });

            console.log('[Jam] Inisialisasi selesai');

            function debounce(fn, delay) {
                var timer = null;
                return function () {
                    if (timer) clearTimeout(timer);
                    timer = setTimeout(function () {
                        timer = null;
                        fn();
                    }, delay);
                };
            }
        })();

        /* ===== UTILITY ===== */
        var FORM_URL = '{{ route('layanan.registrasi-tamu') }}';

        function closeSuccessModalAndRedirect() {
            var m = document.getElementById('successModal');
            if (m && m.style.display !== 'none') {
                m.style.display = 'none';
                document.body.style.overflow = '';
            }
            window.location.href = FORM_URL;
        }

        function attachSelesaiButton() {
            var btn = document.getElementById('btn-modal-selesai');
            if (!btn) return;
            if (btn.getAttribute('data-selesai-bound') === '1') return;
            btn.setAttribute('data-selesai-bound', '1');
            btn.addEventListener('click', function () {
                console.log('[Modal] btn-modal-selesai clicked');
                window.location.href = '{{ route('layanan.registrasi-tamu') }}';
            });
        }

        attachSelesaiButton();

        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            attachSelesaiButton();
        } else {
            document.addEventListener('DOMContentLoaded', attachSelesaiButton);
        }

        // Fallback: observer kalau modal muncul lebih lambat
        if (window.MutationObserver) {
            var mo = new MutationObserver(function () {
                var m = document.getElementById('successModal');
                if (m && m.style.display === 'flex') {
                    attachSelesaiButton();
                    mo.disconnect();
                }
            });
            mo.observe(document.body, { childList: true, subtree: true });
        }

        window.closeSuccessModal = function () {
            window.location.href = '{{ route('layanan.registrasi-tamu') }}';
        };

        var nikInput = document.getElementById('nik');
        if (nikInput) nikInput.addEventListener('input', function () { this.value = this.value.replace(/\D/g, '').slice(0, 16); });

        var nohpInput = document.getElementById('no_hp');
        if (nohpInput) nohpInput.addEventListener('input', function () { this.value = this.value.replace(/[^0-9+\-\s()]/g, '').slice(0, 25); });

        console.log('[UTILS] Semua selesai');
    })();
</script>@endpush

