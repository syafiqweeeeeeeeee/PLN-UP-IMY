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
        /* Jarak atas mengikuti tinggi navbar fixed (--nav-h disinkronkan via JS,
           fallback 81px desktop / 92px mobile) agar logo & judul header
           tidak menempel/tertutup top bar. */
        padding: calc(var(--nav-h, 81px) + 1.1rem) 1rem 1.1rem;
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

        select.pln-input {
            padding-right: 1.6rem;
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

        /* Lepaskan penempatan kolom 2 milik layout desktop; jika tidak,
           grid satu kolom tetap membuat kolom implisit sempit sehingga
           isi form (dan popup kalender) melebar keluar kartu. */
        .pln-card-body > .pln-section--data,
        .pln-card-body > .pln-section--doc,
        .pln-card-body > .pln-section--detail {
            grid-column: 1;
            grid-row: auto;
        }
    }

    /* Tablet desktop kecil: kompak */
    @media (max-width: 991.98px) {
        .pln-page { padding-top: calc(var(--nav-h, 81px) + 1rem); }
    }

    /* Tablet landscape: grid-2 menjadi 2 kolom */
    @media (min-width: 640px) {
        .grid-2 { grid-template-columns: 1fr 1fr; }
    }

    /* Mobile: full-width */
    @media (max-width: 767.98px) {
        .pln-page { padding-top: calc(var(--nav-h, 92px) + 0.85rem); }
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

    /* Select jam: hilangkan panah bawaan browser supaya tampilannya
       persis seperti dropdown Divisi (satu panah FA di kiri). */
    select.pln-input {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    /* ===== KALENDER KUSTOM TANGGAL KUNJUNGAN =====
       Menggantikan datepicker native browser — hanya dengan widget ini
       tanggal libur/akhir pekan bisa diwarnai MERAH (disabled) dan akhir
       pekan yang di-override admin tampil HITAM (bisa dipilih). */
    .pln-cal {
        /* ABSOLUTE terhadap wrapper input di dalam .pln-card — SELALU
           terbuka ke bawah (bottom-start), tidak pernah membalik ke atas.
           Kartu memakai overflow: hidden, jadi ruang bawah kartu ditambah
           JS (sesuaikanRuangKalender) agar seluruh popup tetap di dalam
           area card dan footer "Hari ini" tidak terpotong. */
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        z-index: 1050;
        width: min(288px, calc(100vw - 1rem));
        max-height: min(340px, calc(100vh - 1rem));
        overflow-y: auto;
        overscroll-behavior: contain;
        background: var(--bg-card, #fff);
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 12px;
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.16);
        padding: 0.6rem;
    }
    .pln-cal[hidden] { display: none; }
    .pln-cal-head {
        display: flex; align-items: center; justify-content: space-between;
        gap: 0.4rem; margin-bottom: 0.45rem;
    }
    .pln-cal-title { font-size: 0.82rem; font-weight: 700; color: var(--pln-text, #1f2937); }
    .pln-cal-nav {
        width: 28px; height: 28px; border-radius: 8px;
        border: 1px solid var(--border-color, #e5e7eb); background: #f8fafc;
        color: #4b5563; cursor: pointer; font-size: 1rem; line-height: 1;
    }
    .pln-cal-nav:hover { background: #e6f2fb; color: var(--pln-blue, #0056a3); }
    .pln-cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 2px; }
    .pln-cal-dow span {
        text-align: center; font-size: 0.64rem; font-weight: 700;
        color: #9ca3af; padding: 0.25rem 0; text-transform: uppercase;
    }
    .pln-cal-day {
        aspect-ratio: 1; border: none; border-radius: 8px; background: transparent;
        font-size: 0.76rem; font-weight: 600; color: var(--pln-text, #1f2937); cursor: pointer;
    }
    .pln-cal-day:hover:not(:disabled) { background: #e6f2fb; }
    .pln-cal-day.is-empty { visibility: hidden; pointer-events: none; }
    .pln-cal-day.is-past { color: #cbd5e1; cursor: not-allowed; }
    /* MERAH — tanggal libur (tipe libur) & akhir pekan tanpa override: disabled */
    .pln-cal-day.is-red { background: #fee2e2; color: #b91c1c; cursor: not-allowed; }
    /* HITAM — akhir pekan yang di-override admin (tipe masuk_kerja): BISA dipilih */
    .pln-cal-day.is-masuk { background: #111827; color: #fff; }
    .pln-cal-day.is-masuk:hover { background: #1f2937; }
    .pln-cal-day.is-hari-ini { box-shadow: inset 0 0 0 2px rgba(0, 86, 163, 0.35); }
    .pln-cal-day.is-terpilih { background: var(--pln-blue, #0056a3) !important; color: #fff !important; }
    .pln-cal-foot {
        display: flex; justify-content: flex-end; margin-top: 0.5rem;
        border-top: 1px solid var(--border-color, #f1f5f9); padding-top: 0.4rem;
    }
    .pln-cal-today {
        background: none; border: none; color: var(--pln-blue, #0056a3);
        font-size: 0.74rem; font-weight: 700; cursor: pointer;
        padding: 0.15rem 0.35rem; border-radius: 6px;
    }
    .pln-cal-today:hover { background: #e6f2fb; }

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

    /* Indentasi hierarki opsi bidang: root tanpa indent, child agak
       masuk, grandchild lebih masuk — via padding, konsep "sepatah"
       per tingkat agar terbaca sebagai pohon. */
    .dropdown-option.dd-depth-1 { padding-left: 1.35rem; }
    .dropdown-option.dd-depth-2 { padding-left: 1.95rem; }

    /* Placeholder di garis pertama: tanpa titik & selalu netral,
       tidak pernah ikut ter-highlight sebagai "pilihan". */
    .dropdown-option[data-value=""]:not(.dropdown-jabatan-placeholder)::before {
        display: none;
    }
    .dropdown-option[data-value=""]:not(.dropdown-jabatan-placeholder):hover {
        background: transparent;
        color: #94a3b8;
    }
    .dropdown-option[data-value=""].selected::before { display: none; }

    /* Teks placeholder jabatan & label tak ergis tetap netral abu-abu */
    .dropdown-jabatan-placeholder { color: #94a3b8; font-style: italic; }

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

    /* ---- KOTAK PENCARIAN DI DALAM DROPDOWN (Divisi & Jabatan) ----
       Sticky di atas daftar opsi; mengetik memfilter opsi secara
       live tanpa menutup dropdown. */
    .dd-search-wrap {
        position: sticky;
        top: 0;
        z-index: 2;
        background: #fff;
        padding: 0.3rem 0.5rem;
        border-bottom: 1px solid var(--pg-line);
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .dd-search-wrap > i {
        color: #94a3b8;
        font-size: 0.7rem;
        flex-shrink: 0;
    }
    .dd-search-input {
        flex: 1;
        min-width: 0;
        border: none;
        outline: none;
        background: transparent;
        font: inherit;
        font-size: 0.78rem;
        color: #1e293b;
        padding: 0.15rem 0;
    }
    .dd-search-input::placeholder { color: #94a3b8; }
    .dd-search-empty {
        padding: 0.4rem 0.65rem;
        color: #94a3b8;
        font-style: italic;
        font-size: 0.75rem;
    }

    /* Opsi non-aktif (mis. jam istirahat) — netral, bukan merah */
    select.pln-input option:disabled {
        color: #94a3b8 !important;
        background: #f1f5f9 !important;
    }

    select.pln-input optgroup { font-weight: 600; color: #475569; background: #f8fafc; }
    select.pln-input option { padding: 0.25rem 0.4rem; line-height: 1.25; }

    /* Peringatan tanggal merah (hari libur) — kotak merah di bawah
       input tanggal saat tanggal yang dipilih termasuk hari libur. */
    .holiday-warning {
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
    .holiday-warning.show { display: flex; }
    .holiday-warning i { margin-top: 0.02rem; }

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
    .pln-file-card .file-badge.badge-img   { background: rgba(217, 119, 6, 0.1); color: #d97706; }

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
<div class="pln-page">
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
                            NIK / No. KTP <span class="required">*</span>
                        </label>
                        <p class="pln-hint" style="margin: -0.4rem 0 0.5rem; font-size: 0.72rem;">
                            16 digit angka sesuai KTP
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
                                       onpaste="(function(t){ t.value=t.value.replace(/[^0-9]/g,''); if(t.value.length>16) t.value=t.value.slice(0,16); })(this)" />
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
                        <h2 class="pln-section-title" data-i18n="form.doc_dokumen">Berkas Pendukung</h2>
                    </div>

                    <div>
                        <label class="pln-label" for="dokumen">
                            Upload Dokumen <span class="required">*</span>
                        </label>
                        <p class="pln-hint" style="margin: -0.4rem 0 0.5rem; font-size: 0.72rem;">
                            ZIP, RAR, PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG — maksimal 10MB
                        </p>
                        <div id="dokumen-upload-status" class="text-danger" style="font-size: 0.75rem; margin-top: 0.25rem;"></div>
                        <div class="pln-upload-wrap">
                            <input type="file" id="dokumen" name="dokumen" required
                                   accept=".zip,.rar,.pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx,application/pdf,image/jpeg,image/png,application/zip,application/x-zip-compressed,application/x-rar-compressed,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
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
                            Bidang yang Ditemui <span class="required">*</span>
                        </label>
                        <div class="pln-input-icon" style="position: relative;">
                            <input type="text" id="tujuan_ditemui_display" readonly
                                   value="{{ old('tujuan_ditemui', '') }}"
                                   placeholder="— Pilih Bidang —"
                                   class="pln-input custom-dropdown-input @error('tujuan_ditemui') has-error @enderror"
                                   aria-haspopup="listbox">
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                            <div id="divisi-dropdown" class="custom-dropdown-menu custom-scroll-menu" role="listbox" style="display: none;">
                                {{-- Kotak pencarian — memfilter opsi bidang secara live. --}}
                                <div class="dd-search-wrap">
                                    <i class="fas fa-search"></i>
                                    <input type="text" class="dd-search-input" id="divisi-search"
                                           placeholder="Ketik untuk mencari bidang..."
                                           autocomplete="off" aria-label="Cari bidang">
                                </div>
                                {{-- Opsi bidang dinamis dari MASTER bidangs —
                                     partial juga dipakai modal Tambah/Edit admin
                                     & portal karyawan agar nilainya selalu sinkron. --}}
                                <div class="dropdown-options custom-scroll-content" id="divisi-options">
                                    {{-- Unit induk struktural (SM UP INDRAMAYU) BUKAN
                                         tujuan kunjungan → tidak ditawarkan di form
                                         publik; admin & portal tetap memakai daftar
                                         lengkap (partial tanpa argumen). --}}
                                    @include('admin.tamu._divisi-options', [
                                        'bidangRows' => \App\Models\Bidang::treeOrderedTujuanTamu(),
                                    ])
                                </div>
                                <div class="dd-search-empty" id="divisi-search-empty" style="display: none;">Tidak ada bidang yang cocok.</div>
                            </div>
                        </div>
                        <input type="hidden" name="tujuan_ditemui" id="tujuan_ditemui" value="{{ old('tujuan_ditemui', '') }}">
                        {{-- Kunci primer bidang (bidangs.id) — dipakai cascading
                             dropdown Jabatan & Orang. Nama di atas tetap dikirim
                             agar kolom string `tamus.tujuan_ditemui` dan seluruh
                             data lama tidak berubah. --}}
                        <input type="hidden" name="bidang_id" id="bidang_id" value="{{ old('bidang_id', '') }}">
                        {{-- Proxy <select> (ID: bidang_select) — jembatan event 'change'
                             untuk dependent dropdown "Orang yang Ditemui". Nilainya selalu
                             sinkron dengan hidden input tujuan_ditemui di atas (dua arah),
                             TIDAK ikut disubmit (tanpa name) & disembunyikan via class
                             .hidden sehingga tampilan custom dropdown tidak berubah. --}}
                        <select id="bidang_select" class="hidden" aria-hidden="true" tabindex="-1">
                            <option value="">— Pilih Bidang —</option>
                            {{-- Sama dengan partial di atas: unit induk struktural
                                 tidak ikut sebagai pilihan bidang. --}}
                            @foreach (\App\Models\Bidang::treeOrderedTujuanTamu() as $bidangRow)
                                <option value="{{ $bidangRow['node']->nama }}"
                                    data-id="{{ $bidangRow['node']->id }}"
                                    @selected(old('tujuan_ditemui') === $bidangRow['node']->nama)>
                                    {{ $bidangRow['node']->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('tujuan_ditemui')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jabatan yang Ditemui — dropdown BERTINGKAT dari
                         MASTER jabatans: opsi mengikuti bidang yang dipilih
                         di atas. WAJIB dipilih. --}}
                    <div>
                        <label for="jabatan_ditemui_display" class="pln-label" data-i18n="form.label_jabatan">
                            Jabatan yang Ditemui <span class="required">*</span>
                        </label>
                        <div class="pln-input-icon" style="position: relative;">
                            <input type="text" id="jabatan_ditemui_display" readonly
                                   value="{{ old('jabatan_ditemui', '') }}"
                                   placeholder="— Pilih Jabatan —"
                                   data-i18n-placeholder="form.ph_jabatan"
                                   class="pln-input custom-dropdown-input @error('jabatan_ditemui') has-error @enderror"
                                   aria-haspopup="listbox">
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                            <div id="jabatan-dropdown" class="custom-dropdown-menu custom-scroll-menu" role="listbox" style="display: none;">
                                {{-- Kotak pencarian — memfilter opsi jabatan live,
                                     dikombinasikan dengan filter bidang terpilih. --}}
                                <div class="dd-search-wrap">
                                    <i class="fas fa-search"></i>
                                    <input type="text" class="dd-search-input" id="jabatan-search"
                                           placeholder="Ketik untuk mencari jabatan..."
                                           autocomplete="off" aria-label="Cari jabatan">
                                </div>
                                <div class="dropdown-options custom-scroll-content" id="jabatan-options">
                                    @include('admin.tamu._jabatan-options')
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="jabatan_ditemui" id="jabatan_ditemui" value="{{ old('jabatan_ditemui', '') }}">
                        {{-- Kunci primer jabatan (jabatans.id) — dikirim bersama
                             nama jabatan; dipakai sebagai filter "Orang yang
                             Ditemui" (karyawans.jabatan_id). --}}
                        <input type="hidden" name="jabatan_id" id="jabatan_id" value="{{ old('jabatan_id', '') }}">
                        {{-- Proxy <select> (ID: jabatan_select) — pasangan bidang_select di
                             atas; sumber nilai "jabatan" untuk request /api/get-karyawan.
                             Opsi DIBATASI 3 LEVEL (Jabatan::TAMU_LEVELS: Asisten Manajer,
                             Junior, Staff) lewat scope forTamu() — sama dengan partial
                             _jabatan-options di atas. TIDAK ikut disubmit. --}}
                        <select id="jabatan_select" class="hidden" aria-hidden="true" tabindex="-1">
                            <option value="">— Pilih Jabatan —</option>
                            @foreach (\App\Models\Jabatan::query()->forTamu()->with('bidang:id,nama')->orderBy('nama')->get() as $jabatanRow)
                                <option value="{{ $jabatanRow->nama }}" data-bidang="{{ $jabatanRow->bidang?->nama }}"
                                    data-id="{{ $jabatanRow->id }}" data-bidang-id="{{ $jabatanRow->bidang_id }}"
                                    @selected(old('jabatan_ditemui') === $jabatanRow->nama)>
                                    {{ $jabatanRow->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('jabatan_ditemui')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Orang yang Ditemui — CUSTOM DROPDOWN dengan pencarian
                         (pola sama dengan dropdown Divisi & Jabatan di atas),
                         bersifat DEPENDENT: daftar opsi diambil dari
                         GET /api/get-karyawan?jabatan_id=... — hanya karyawan
                         AKTIF pada jabatan terpilih, dan hanya pada 3 level
                         yang boleh ditemui tamu (Asisten Manajer, Junior,
                         Staff — Jabatan::TAMU_LEVELS). Nilai yang dikirim:
                         nama (orang_ditemui) + karyawan_id + akun tertaut
                         (orang_ditemui_id, bila ada) untuk portal karyawan.
                         Input TIDAK readonly: mengetik = memfilter opsi (search). --}}
                    <div>
                        <label for="orang_ditemui" class="pln-label" data-i18n="form.label_orang">
                            Orang yang Ditemui <span class="required">*</span>
                        </label>
                        <div class="pln-input-icon" style="position: relative;">
                            <i class="fas fa-user-tie"></i>
                            <input type="text" id="orang_ditemui" name="orang_ditemui"
                                   value="{{ old('orang_ditemui', '') }}"
                                   placeholder="— Pilih Pengguna / Ketik untuk mencari —"
                                   autocomplete="off"
                                   aria-haspopup="listbox"
                                   aria-expanded="false"
                                   required
                                   class="pln-input custom-dropdown-input @error('orang_ditemui') has-error @enderror" />
                            {{-- Penautan akun: diisi saat memilih opsi dari daftar
                                 (server tetap memvalidasi nama ⇄ akun). --}}
                            <input type="hidden" name="orang_ditemui_id" id="orang_ditemui_id"
                                   value="{{ old('orang_ditemui_id', '') }}" />
                            {{-- Kunci primer karyawan (karyawans.id) — diisi saat
                                 memilih opsi dari daftar hasil /api/get-karyawan. --}}
                            <input type="hidden" name="karyawan_id" id="karyawan_id"
                                   value="{{ old('karyawan_id', '') }}" />
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                            <div id="orang-dropdown" class="custom-dropdown-menu custom-scroll-menu" role="listbox" style="display: none;">
                                <div class="dropdown-options custom-scroll-content" id="orang-options">
                                    {{-- Daftar nama DIBANGUN DINAMIS oleh dependent dropdown:
                                         hanya terisi setelah "Bidang" & "Jabatan" dipilih,
                                         dari hasil GET /api/get-pegawai (role karyawan/staff
                                         pada pasangan bidang + jabatan tersebut). Sebelumnya
                                         kedua dropdown kosong — tampil sebagai petunjuk. --}}
                                    <div class="dropdown-placeholder orang-empty">
                                        Pilih Jabatan yang Ditemui terlebih dahulu untuk menampilkan daftar nama.
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Proxy <select> (ID: orang_ditemui_select) — tempat opsi hasil
                             filter disimpan dalam bentuk <option> sehingga komponen UI
                             berbasis <select> (mis. TomSelect) bisa membaca & sinkron
                             dengannya. TIDAK ikut disubmit: nilai yang dikirim tetap input
                             teks #orang_ditemui di atas (teks bebas diperbolehkan). --}}
                        <select id="orang_ditemui_select" class="hidden" aria-hidden="true" tabindex="-1">
                            <option value="" data-i18n="form.opt_pilih_pengguna">— Pilih Pengguna —</option>
                        </select>
                        <p class="pln-hint" style="margin: 0.25rem 0 0;" data-i18n="form.hint_orang">
                            Daftar nama mengikuti Jabatan yang dipilih di atas — hanya
                            karyawan aktif level Asisten Manajer, Junior, dan Staff.
                            Ketik untuk mencari, atau klik untuk memilih dari daftar.
                        </p>
                        @error('orang_ditemui')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal & Jam Kunjungan + Jumlah Tamu --}}
                    <div class="grid-2">
                        <div>
                            <label for="tanggal_kunjungan" class="pln-label" data-i18n="form.label_tanggal">
                                Tanggal Kunjungan <span class="required">*</span>
                            </label>
                            <div class="pln-input-icon" style="position: relative;">
                                {{-- Kalender KUSTOM (bukan datepicker native) — nilai Y-m-d;
                                     hari libur/akhir pekan tampil MERAH & disabled,
                                     weekend yang di-override admin tampil HITAM. --}}
                                <input type="text" id="tanggal_kunjungan" name="tanggal_kunjungan"
                                       value="{{ old('tanggal_kunjungan', today()->format('Y-m-d')) }}"
                                       required readonly autocomplete="off" inputmode="none"
                                       aria-label="tanggal kunjungan" aria-haspopup="dialog"
                                       data-i18n-aria-label="form.aria_tanggal"
                                       aria-expanded="false"
                                       title="Klik untuk memilih tanggal kunjungan"
                                       data-i18n-title="form.title_tanggal"
                                       placeholder="Pilih tanggal"
                                       data-i18n-placeholder="cal.pick_date"
                                       class="pln-input custom-dropdown-input @error('tanggal_kunjungan') has-error @enderror" />
                                {{-- Panah persis seperti dropdown Divisi (ikon kiri, ruang kanan lega) --}}
                                <i class="fas fa-chevron-down dropdown-arrow"></i>

                                {{-- Widget kalender --}}
                                <div class="pln-cal" id="tanggal-calendar" role="dialog"
                                     aria-label="Kalender tanggal kunjungan" hidden>
                                    <div class="pln-cal-head">
                                        <button type="button" class="pln-cal-nav" id="cal-prev"
                                                aria-label="Bulan sebelumnya"
                                                data-i18n-aria-label="cal.prev_month">&lsaquo;</button>
                                        <span class="pln-cal-title" id="cal-title" aria-live="polite"></span>
                                        <button type="button" class="pln-cal-nav" id="cal-next"
                                                aria-label="Bulan berikutnya"
                                                data-i18n-aria-label="cal.next_month">&rsaquo;</button>
                                    </div>
                                    <div class="pln-cal-grid pln-cal-dow" aria-hidden="true">
                                        {{-- Sunday-first: urutan ini WAJIB sama dengan offset
                                             getDay() (0 = Minggu) pada renderKalender(). --}}
                                        <span data-i18n="day.0">Min</span><span data-i18n="day.1">Sen</span><span data-i18n="day.2">Sel</span><span data-i18n="day.3">Rab</span>
                                        <span data-i18n="day.4">Kam</span><span data-i18n="day.5">Jum</span><span data-i18n="day.6">Sab</span>
                                    </div>
                                    <div class="pln-cal-grid" id="cal-days"></div>
                                    <div class="pln-cal-foot">
                                        <button type="button" class="pln-cal-today" id="cal-today" data-i18n="cal.today">Hari ini</button>
                                    </div>
                                </div>
                            </div>
                            <p class="pln-hint" style="margin: 0.25rem 0 0;" data-i18n="form.hint_tanggal">Minimal hari ini — tanggal kemarin, akhir pekan (Sabtu/Minggu, kecuali dibuka admin), hari libur &amp; tanggal merah tidak dapat dipilih.</p>
                            <div class="holiday-warning" id="holiday-warning" style="display: none;">
                                <i class="fas fa-circle-exclamation"></i>
                                <span id="holiday-warning-text" data-i18n="form.holiday_warning">Tanggal ini adalah hari libur. Silakan pilih tanggal lain.</span>
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
                                <select id="jam_kunjungan" name="jam_kunjungan" required
                                        data-old="{{ old('jam_kunjungan') }}"
                                        aria-label="jam kunjungan"
                                        class="pln-input custom-dropdown-input @error('jam_kunjungan') has-error @enderror">
                                    <option value="">— Pilih Jam —</option>
                                </select>
                                <i class="fas fa-chevron-down dropdown-arrow"></i>
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
                                  class="pln-textarea @error('keperluan') has-error @enderror">                        {{ old('keperluan') }}</textarea>
                        @error('keperluan')
                            <p class="pln-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- ================= FOOTER FORM & TOMBOL SUBMIT ================= --}}
            <div class="pln-actions">
                <p class="pln-required-note"><span class="required">*</span> Wajib diisi. Data Anda aman &amp; hanya untuk keperluan registrasi.</p>
                <button type="submit" class="btn-pln-primary" id="btn-submit">
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
    /* ============================================================
       SINKRONISASI TINGGI TOP BAR (navbar fixed)
       --nav-h dipakai oleh padding atas .pln-page supaya header
       logo + judul selalu berada di bawah navbar (tidak tertutup),
       di semua ukuran layar.
       ============================================================ */
    (function () {
        var nav = document.querySelector('.navbar-pln');
        if (!nav || !document.documentElement.style.setProperty) return;

        function sync() {
            var collapse = document.getElementById('navbarResponsive');
            // Saat menu mobile terbuka navbar memanjang — jangan dipakai,
            // cukup pakai tinggi navbar dalam kondisi tertutup.
            if (collapse && collapse.classList.contains('show')) return;

            var h = Math.round(nav.getBoundingClientRect().height);
            if (h > 0) document.documentElement.style.setProperty('--nav-h', h + 'px');
        }

        sync();
        window.addEventListener('load', sync);
        window.addEventListener('resize', sync);
        document.addEventListener('shown.bs.collapse', sync);
        document.addEventListener('hidden.bs.collapse', sync);
    })();

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
        var DOKUMEN_EXT  = ['zip', 'doc', 'docx', 'xls', 'xlsx', 'pdf', 'rar', 'jpg', 'jpeg', 'png'];
        var DOKUMEN_TEXT = 'PDF, DOC, DOCX, XLS, XLSX, ZIP, RAR, JPG, JPEG, atau PNG';

        var DOKUMEN_BADGE_CLASS = {
            zip: 'badge-zip',
            pdf: 'badge-pdf',
            jpg: 'badge-img',
            jpeg: 'badge-img',
            png: 'badge-img',
        };
        var DOKUMEN_ICON = {
            zip: 'fa-file-archive',
            rar: 'fa-file-archive',
            doc: 'fa-file-word',
            docx: 'fa-file-word',
            xls: 'fa-file-excel',
            xlsx: 'fa-file-excel',
            pdf: 'fa-file-pdf',
            jpg: 'fa-file-image',
            jpeg: 'fa-file-image',
            png: 'fa-file-image',
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
            if (!input) {
                console.error('[Dokumen] Input tidak ditemukan');
                return;
            }

            if (!input.files || !input.files[0]) {
                return;
            }

            var file = input.files[0];
            var ext = getFileExt(file.name);

            // Validasi sisi klien (server tetap sumber kebenaran)
            if (!isAllowedExt(file, DOKUMEN_EXT)) {
                console.error('[Dokumen] Format tidak didukung:', file.name, 'ekstensi:', ext);
                var statusEl = document.getElementById('dokumen-upload-status');
                if (statusEl) {
                    statusEl.textContent = '✗ Format tidak didukung: .' + ext + ' (didukung: ' + DOKUMEN_TEXT + ')';
                }
                window.removeDokumen();

                if (window.AdminSwal) {
                    window.AdminSwal.warning(
                        'Dukungan: ' + DOKUMEN_TEXT + '.\n\nAnda memilih: ' + file.name + ' (.' + ext + ')',
                        'Format Berkas Tidak Didukung'
                    );
                }
                return;
            }

            if (file.size > MAX_DOKUMEN) {
                console.error('[Dokumen] Ukuran terlalu besar:', formatFileSize(file.size), 'maksimal:', formatFileSize(MAX_DOKUMEN));
                var statusEl = document.getElementById('dokumen-upload-status');
                if (statusEl) {
                    statusEl.textContent = '✗ Ukuran terlalu besar: ' + formatFileSize(file.size) + ' (maksimal: 10MB)';
                }
                window.removeDokumen();

                if (window.AdminSwal) {
                    window.AdminSwal.warning(
                        'Maksimal: 10MB\nUkuran file: ' + formatFileSize(file.size),
                        'Ukuran Berkas Terlalu Besar'
                    );
                }
                return;
            }

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
        };

        // Inisialisasi upload dokumen
        try {
            (function initDokumenUpload() {
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

                // Klik area untuk membuka file picker
                dokArea.addEventListener('click', function (e) {
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

                    if (files.length > 0) {
                        try {
                            inputDokumen.files = files;
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
                inputDokumen.addEventListener('change', function () {
                    window.previewDokumen(inputDokumen);
                });
            })();
        } catch (err) {
            console.error('[UPLOAD TEST] ERROR fatal:', err);
        }

        /* ===== DROPDOWN DIVISI ===== */
        /* EKSKLUSIVITAS DROPDOWN — hanya SATU dropdown (Bidang/Jabatan)
           yang boleh terbuka bersamaan: setiap dropdown yang DIBUKA
           otomatis menutup dropdown lain agar panel tidak bertumpuk. */
        window.__registrasiDropdownClosers = window.__registrasiDropdownClosers || [];

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
                if (isOpen) {
                    // EKSKLUSIF: tutup dulu semua dropdown lain sebelum
                    // membuka menu ini — tampilan tidak bertumpuk.
                    window.__registrasiDropdownClosers.forEach(function (closer) {
                        if (closer.owner !== 'divisi') closer.close();
                    });
                }
                dropdownMenu.style.display = isOpen ? 'block' : 'none';
                inputDisplay.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                if (inputDisplay.parentElement) inputDisplay.parentElement.classList.toggle('dropdown-open', isOpen);
            }

            window.__registrasiDropdownClosers.push({
                owner: 'divisi',
                close: function () {
                    isOpen = false;
                    dropdownMenu.style.display = 'none';
                    inputDisplay.setAttribute('aria-expanded', 'false');
                    if (inputDisplay.parentElement) inputDisplay.parentElement.classList.remove('dropdown-open');
                },
            });

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

                // Kunci primer bidang — sumber filter dropdown Jabatan.
                var bidangIdInput = document.getElementById('bidang_id');
                if (bidangIdInput) bidangIdInput.value = opt.getAttribute('data-id') || '';

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
                if (!match) {
                    /* Data lama dari partial rentan bisa menyimpan
                       entitas &nbsp;/spasi pantas sebagai nama —
                       normaalkan lalu cocokkan ulang ke opsi bersih. */
                    var bersih = initVal.replace(/&nbsp;|\u00A0/g, '').replace(/\s+/g, ' ').trim();
                    if (bersih && bersih !== initVal) {
                        match = optionsContainer.querySelector('.dropdown-option[data-value="' + bersih + '"]');
                        if (match) {
                            inputHidden.value = bersih;
                            initVal = bersih;
                        }
                    }
                }
                if (match) select(match);
            }
        })();

        /* ===== PENCARIAN DI DROPDOWN DIVISI =====
           Kotak pencarian (#divisi-search) memfilter opsi bidang
           secara live. Judul grup (optgroup) ikut disembunyikan
           bila semua opsi di bawahnya tersaring. Pencarian di-reset
           setiap dropdown dibuka. */
        (function () {
            var searchInput = document.getElementById('divisi-search');
            var displayInput = document.getElementById('tujuan_ditemui_display');
            var menu = document.getElementById('divisi-dropdown');
            var optionsContainer = document.getElementById('divisi-options');
            var emptyState = document.getElementById('divisi-search-empty');

            if (!searchInput || !menu || !optionsContainer) {
                console.error('[DivisiSearch] Elemen tidak ditemukan');
                return;
            }

            function applyDivisiFilter() {
                var q = searchInput.value.trim().toLowerCase();
                var visible = 0;

                optionsContainer.querySelectorAll('.dropdown-option').forEach(function (opt) {
                    /* Placeholder "— Pilih Bidang —" (data-value="") ikut
                       disembunyikan saat pencarian aktif. */
                    var teks = (opt.getAttribute('data-value') || opt.textContent || '').toLowerCase();
                    var show = q === '' || teks.indexOf(q) !== -1;
                    opt.style.display = show ? '' : 'none';
                    if (show && opt.getAttribute('data-value') !== '') visible++;
                });

                /* Sembunyikan judul grup yang tidak punya opsi tampil. */
                optionsContainer.querySelectorAll('.dropdown-optgroup').forEach(function (grp) {
                    var el = grp.nextElementSibling;
                    var adaTampil = false;
                    while (el && !el.classList.contains('dropdown-optgroup')) {
                        if (el.classList.contains('dropdown-option') && el.style.display !== 'none') {
                            adaTampil = true;
                            break;
                        }
                        el = el.nextElementSibling;
                    }
                    grp.style.display = adaTampil ? '' : 'none';
                });

                if (emptyState) emptyState.style.display = visible === 0 ? '' : 'none';
            }

            function resetDivisiSearch() {
                searchInput.value = '';
                applyDivisiFilter();
            }

            searchInput.addEventListener('click', function (e) { e.stopPropagation(); });
            searchInput.addEventListener('input', applyDivisiFilter);
            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    e.stopPropagation();
                    if (searchInput.value !== '') resetDivisiSearch();
                    else { menu.style.display = 'none'; if (displayInput) displayInput.blur(); }
                }
            });

            /* Reset pencarian setiap dropdown dibuka. */
            if (displayInput) displayInput.addEventListener('click', function () { resetDivisiSearch(); });
        })();

        /* ===== DROPDOWN JABATAN (BERTINGKAT) =====
           Opsi jabatan diambil dari MASTER jabatans dan difilter
           mengikuti bidang yang dipilih pada dropdown "Bidang yang
           Ditemui" (tiap opsi membawa data-bidang). Mengganti bidang
           akan memfilter ulang opsi & mengosongkan jabatan jika opsi
           lama tak lagi cocok. */
        (function () {
            var jabatanDisplay = document.getElementById('jabatan_ditemui_display');
            var jabatanHidden = document.getElementById('jabatan_ditemui');
            var divisiHidden = document.getElementById('tujuan_ditemui');
            var jabatanSearch = document.getElementById('jabatan-search');
            var jWrapper = jabatanDisplay && jabatanDisplay.closest ? jabatanDisplay.closest('.pln-input-icon') : null;
            var jabatanMenu = jWrapper && jWrapper.querySelector ? jWrapper.querySelector('#jabatan-dropdown') : null;
            var jabatanOptionsContainer = jWrapper && jWrapper.querySelector ? jWrapper.querySelector('#jabatan-options') : null;

            if (!jabatanDisplay || !jabatanHidden || !divisiHidden || !jabatanMenu || !jabatanOptionsContainer) {
                console.error('[Jabatan] Elemen tidak ditemukan');
                return;
            }

            var jIsOpen = false;

            function jToggle() {
                jIsOpen = !jIsOpen;
                if (jIsOpen) {
                    // EKSKLUSIF: tutup dulu semua dropdown lain sebelum
                    // membuka menu ini — tampilan tidak bertumpuk.
                    window.__registrasiDropdownClosers.forEach(function (closer) {
                        if (closer.owner !== 'jabatan') closer.close();
                    });
                }
                jabatanMenu.style.display = jIsOpen ? 'block' : 'none';
                jabatanDisplay.setAttribute('aria-expanded', jIsOpen ? 'true' : 'false');
                if (jabatanDisplay.parentElement) jabatanDisplay.parentElement.classList.toggle('dropdown-open', jIsOpen);
            }

            window.__registrasiDropdownClosers.push({
                owner: 'jabatan',
                close: function () {
                    jIsOpen = false;
                    jabatanMenu.style.display = 'none';
                    jabatanDisplay.setAttribute('aria-expanded', 'false');
                    if (jabatanDisplay.parentElement) jabatanDisplay.parentElement.classList.remove('dropdown-open');
                },
            });

            function jClose() {
                jIsOpen = false;
                jabatanMenu.style.display = 'none';
                jabatanDisplay.setAttribute('aria-expanded', 'false');
            }

            function jSelect(opt) {
                jabatanOptionsContainer.querySelectorAll('.dropdown-option').forEach(function (o) { o.classList.remove('selected'); });
                opt.classList.add('selected');
                jabatanDisplay.value = opt.textContent.trim();
                jabatanHidden.value = opt.getAttribute('data-value');

                // Kunci primer jabatan — sumber filter dropdown Orang.
                var jabatanIdInput = document.getElementById('jabatan_id');
                if (jabatanIdInput) jabatanIdInput.value = opt.getAttribute('data-id') || '';

                jClose();
                // Seperti dropdown divisi: kabarkan perubahan lewat event
                // 'change' supaya dependent dropdown "Orang yang Ditemui"
                // (proxy #jabatan_select) ikut sinkron & memicu fetch.
                jabatanHidden.dispatchEvent(new Event('change', { bubbles: true }));
            }

            jabatanDisplay.addEventListener('click', function (e) {
                e.stopPropagation(); jToggle();
            });
            jabatanOptionsContainer.addEventListener('click', function (e) {
                var opt = e.target.closest('.dropdown-option');
                if (opt && opt.getAttribute('data-value')) jSelect(opt);
            });
            document.addEventListener('click', function (e) { if (!jWrapper.contains(e.target)) jClose(); });
            jabatanDisplay.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') { jClose(); jabatanDisplay.blur(); }
                if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); jToggle(); }
            });

            /* Filter opsi jabatan sesuai bidang terpilih (string,
               bukan id, agar data lama & partial admin tetap serasi).
               PENCARIAN (#jabatan-search) digabungkan: opsi tampil
               bila cocok bidang DAN cocok dengan teks pencarian. */
            function filterJabatanOpsi(divisiNama) {
                var q = jabatanSearch ? jabatanSearch.value.trim().toLowerCase() : '';
                var bidangIdInput = document.getElementById('bidang_id');
                var bidangId = bidangIdInput ? (bidangIdInput.value || '').trim() : '';
                var adaCocok = false;

                jabatanOptionsContainer.querySelectorAll('.dropdown-option').forEach(function (o) {
                    if (o.classList.contains('dropdown-jabatan-placeholder')) return;

                    // Utama: relasi kunci primer (jabatans.bidang_id). Fallback
                    // nama tetap ada agar halaman lama/data tanpa id tidak kosong.
                    var cocokId = bidangId !== '' && o.getAttribute('data-bidang-id') === bidangId;
                    var cocokNama = divisiNama !== '' && o.getAttribute('data-bidang') === divisiNama;
                    var cocokBidang = cocokId || cocokNama;
                    var teks = (o.getAttribute('data-value') || o.textContent || '').toLowerCase();
                    var cocokCari = q === '' || teks.indexOf(q) !== -1;
                    var tampil = cocokBidang && cocokCari;

                    o.style.display = tampil ? '' : 'none';
                    if (tampil) adaCocok = true;
                });

                var placeholder = jabatanOptionsContainer.querySelector('.dropdown-jabatan-placeholder');
                if (placeholder) {
                    if (divisiNama === '') {
                        placeholder.style.display = '';
                        placeholder.textContent = '— Pilih bidang terlebih dahulu —';
                    } else if (!adaCocok) {
                        placeholder.style.display = '';
                        placeholder.textContent = q !== ''
                            ? 'Tidak ada jabatan yang cocok dengan pencarian'
                            : 'Belum ada jabatan pada bidang ini';
                    } else {
                        placeholder.style.display = 'none';
                    }
                }
            }

            /* ===== PENCARIAN JABATAN (LIVE) ===== */
            if (jabatanSearch) {
                jabatanSearch.addEventListener('click', function (e) { e.stopPropagation(); });

                jabatanSearch.addEventListener('input', function () {
                    filterJabatanOpsi(divisiHidden.value.trim());
                });

                jabatanSearch.addEventListener('keydown', function (e) {
                    if (e.key !== 'Escape') return;
                    e.stopPropagation();
                    if (jabatanSearch.value !== '') {
                        jabatanSearch.value = '';
                        filterJabatanOpsi(divisiHidden.value.trim());
                    } else {
                        jClose();
                        jabatanDisplay.blur();
                    }
                });

                /* Reset pencarian setiap dropdown jabatan dibuka. */
                jabatanDisplay.addEventListener('click', function () {
                    jabatanSearch.value = '';
                    filterJabatanOpsi(divisiHidden.value.trim());
                });
            }

            /* Bersihkan pilihan jabatan yang tidak cocok dengan bidang baru. */
            function syncJabatanKeDivisi(divisiNama) {
                filterJabatanOpsi(divisiNama);

                var current = jabatanHidden.value;
                if (!current) return;

                var masihCocok = false;
                jabatanOptionsContainer.querySelectorAll('.dropdown-option').forEach(function (o) {
                    if (o.classList.contains('dropdown-jabatan-placeholder')) return;
                    if (o.getAttribute('data-value') === current
                        && o.getAttribute('data-bidang') === divisiNama
                        && o.style.display !== 'none') {
                        masihCocok = true;
                    }
                });

                if (!masihCocok) {
                    var sebelumnya = jabatanHidden.value;
                    jabatanHidden.value = '';
                    jabatanDisplay.value = '';
                    var jabatanIdInput = document.getElementById('jabatan_id');
                    if (jabatanIdInput) jabatanIdInput.value = '';
                    jabatanOptionsContainer.querySelectorAll('.dropdown-option').forEach(function (o) {
                        o.classList.remove('selected');
                    });
                    // Jabatan ikut berubah saat bidang diganti — dispatch
                    // 'change' hanya bila nilainya memang berubah agar
                    // dependent dropdown "Orang" ikut tersaring.
                    if (sebelumnya !== '') {
                        jabatanHidden.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                }
            }

            /* Cascade: dropdown divisi men-dispatch event 'change' pada
               hidden input-nya setiap opsi dipilih (lihat IIFE divisi). */
            divisiHidden.addEventListener('change', function () {
                syncJabatanKeDivisi(divisiHidden.value.trim());
            });

            /* Restore old() input: filter dulu sesuai bidang lama,
               lalu tandai opsi jabatan lama (jika masih cocok). */
            (function restoreJabatanAwal() {
                var divisiAwal = divisiHidden.value.trim();
                filterJabatanOpsi(divisiAwal);

                var jabatanAwal = jabatanHidden.value;
                if (!jabatanAwal || !divisiAwal) return;

                jabatanOptionsContainer.querySelectorAll('.dropdown-option').forEach(function (o) {
                    if (o.classList.contains('dropdown-jabatan-placeholder')) return;
                    if (o.getAttribute('data-value') === jabatanAwal
                        && (o.getAttribute('data-bidang') === divisiAwal
                            || o.getAttribute('data-bidang-id') === (document.getElementById('bidang_id') || {}).value)) {
                        o.classList.add('selected');
                        jabatanDisplay.value = o.textContent.trim();

                        // Lengkapi kunci primer saat halaman lama hanya membawa nama.
                        var jabatanIdInput = document.getElementById('jabatan_id');
                        if (jabatanIdInput && !jabatanIdInput.value) {
                            jabatanIdInput.value = o.getAttribute('data-id') || '';
                        }
                    }
                });
            })();
        })();

        /* ===== DROPDOWN ORANG DITEMUI (DENGAN PENCARIAN) =====
           Pola sama dengan dropdown Divisi/Jabatan, tetapi input
           TIDAK readonly sehingga FITUR SEARCH tetap berfungsi:
           - mengetik  → memfilter opsi nama pengguna secara live;
           - klik opsi → mengisi input dengan nama terpilih;
           - mengetik di luar daftar → tetap diperbolehkan (field
             opsional, teks bebas).
           Opsi diambil dari TABEL USERS (akun terverifikasi). */
        (function () {
            var orangInput = document.getElementById('orang_ditemui');
            var oWrapper = orangInput && orangInput.closest ? orangInput.closest('.pln-input-icon') : null;
            var orangMenu = oWrapper && oWrapper.querySelector ? oWrapper.querySelector('#orang-dropdown') : null;
            var orangOptionsContainer = oWrapper && oWrapper.querySelector ? oWrapper.querySelector('#orang-options') : null;

            if (!orangInput || !orangMenu || !orangOptionsContainer) {
                console.error('[OrangDitemui] Elemen tidak ditemukan');
                return;
            }

            var oIsOpen = false;
            var orangOptionList = Array.prototype.slice.call(
                orangOptionsContainer.querySelectorAll('.dropdown-option')
            );
            var orangEmptyState = orangOptionsContainer.querySelector('.orang-empty');

            /* ===== RENDER ULANG OPSI — dipakai dependent dropdown =====
               `list` : array [{id, name}] hasil GET /api/get-pegawai
                        (boleh kosong), sudah difilter sesuai bidang+jabatan.
               `hint` : teks yang tampil bila daftar kosong (mis. saat kedua
                        dropdown induk belum dipilih).
               Fungsi ini membangun ulang DOM opsi SEKALIGUS cache
               `orangOptionList` & empty-state supaya pencarian live (oFilter)
               tetap bekerja terhadap daftar terbaru. */
            function escapeHtml(teks) {
                return String(teks)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            function rebuildOrangOpsi(list, hint) {
                var items = Array.isArray(list) ? list : [];
                var kosongTeks = 'Tidak ada nama yang cocok — teks yang Anda ketik tetap akan digunakan.';
                var html = '';

                items.forEach(function (p) {
                    var nama = String((p && (p.nama || p.name)) || '').trim();
                    if (!nama) return;

                    var nid = String((p && p.nid) || '').trim();
                    var userId = String((p && (p.user_id || p.userId)) || '').trim();
                    var jabatan = String((p && p.jabatan) || '').trim();

                    // Tampilan opsi: NAMA + JABATAN saja. NID hanya dipakai
                    // sebagai indeks pencarian (data-search), TIDAK ditampilkan.
                    html += '<div class="dropdown-option orang-option"'
                        + ' data-value="' + escapeHtml(nama) + '"'
                        + ' data-id="' + escapeHtml(String((p && p.id) || '')) + '"'
                        + ' data-user-id="' + escapeHtml(userId) + '"'
                        + ' data-search="' + escapeHtml((nama + ' ' + nid + ' ' + jabatan).toLowerCase()) + '">'
                        + '<div style="min-width: 0;">'
                        + '<div style="font-weight: 600;">' + escapeHtml(nama) + '</div>'
                        + (jabatan !== ''
                            ? '<div style="font-size: 0.72rem; opacity: 0.75;">' + escapeHtml(jabatan) + '</div>'
                            : '')
                        + '</div></div>';
                });

                if (html === '') {
                    // Daftar kosong: tampilkan petunjuk (bukan pesan "tidak
                    // ada yang cocok") — mis. induk belum dipilih / 0 hasil.
                    html += '<div class="dropdown-placeholder orang-empty">'
                        + escapeHtml(hint || kosongTeks) + '</div>';
                } else {
                    html += '<div class="dropdown-placeholder orang-empty" style="display: none;">'
                        + escapeHtml(kosongTeks) + '</div>';
                }

                orangOptionsContainer.innerHTML = html;

                orangOptionList = Array.prototype.slice.call(
                    orangOptionsContainer.querySelectorAll('.dropdown-option')
                );
                orangEmptyState = orangOptionsContainer.querySelector('.orang-empty');

                // Tandai kembali nama yang masih terpilih pada daftar baru.
                var nilaiSekarang = orangInput.value.trim();
                if (nilaiSekarang) {
                    orangOptionList.forEach(function (o) {
                        if ((o.getAttribute('data-value') || '') === nilaiSekarang) {
                            o.classList.add('selected');
                        }
                    });
                }

                if (oIsOpen) oFilter();
            }

            /* Diekspor ke window agar skrip dependent dropdown (IIFE di bawah
               blok ini) bisa memperbarui daftar dari respons /api/get-pegawai. */
            window.rebuildOrangOpsi = rebuildOrangOpsi;

            function oToggle() {
                oIsOpen = !oIsOpen;

                if (oIsOpen) {
                    // MUTUALLY EXCLUSIVE: tutup Bidang & Jabatan lebih dulu —
                    // hanya SATU menu boleh terbuka dalam satu waktu.
                    window.__registrasiDropdownClosers.forEach(function (closer) {
                        if (closer.owner !== 'orang') closer.close();
                    });
                }

                orangMenu.style.display = oIsOpen ? 'block' : 'none';
                orangInput.setAttribute('aria-expanded', oIsOpen ? 'true' : 'false');
                if (orangInput.parentElement) orangInput.parentElement.classList.toggle('dropdown-open', oIsOpen);
                if (oIsOpen) oFilter();
            }

            function oClose() {
                oIsOpen = false;
                orangMenu.style.display = 'none';
                orangInput.setAttribute('aria-expanded', 'false');
                if (orangInput.parentElement) orangInput.parentElement.classList.remove('dropdown-open');
            }

            // Daftarkan ke registry bersama sehingga membuka dropdown lain
            // ikut menutup menu ini (bidang & jabatan sudah terdaftar).
            window.__registrasiDropdownClosers.push({ owner: 'orang', close: oClose });

            function oSelect(opt) {
                orangOptionList.forEach(function (o) { o.classList.remove('selected'); });
                opt.classList.add('selected');
                orangInput.value = opt.getAttribute('data-value') || opt.textContent.trim();

                // Pilihan eksplisit dari daftar → simpan kunci primer karyawan
                // DAN akun login yang tertaut (bila ada) untuk portal karyawan.
                var hiddenKaryawanId = document.getElementById('karyawan_id');
                if (hiddenKaryawanId) hiddenKaryawanId.value = opt.getAttribute('data-id') || '';

                var hiddenOrangId = document.getElementById('orang_ditemui_id');
                if (hiddenOrangId) hiddenOrangId.value = opt.getAttribute('data-user-id') || '';

                // Kembalikan fokus ke input TANPA membuka ulang menu.
                fokusSetelahPilih = true;
                oClose();
                orangInput.focus();
                fokusSetelahPilih = false;
            }

            /* FITUR SEARCH — filter opsi berdasarkan nama. */
            function oFilter() {
                var q = orangInput.value.trim().toLowerCase();
                var visible = 0;

                orangOptionList.forEach(function (opt) {
                    var hay = opt.getAttribute('data-search') || opt.textContent.toLowerCase();
                    var show = !q || hay.indexOf(q) !== -1;
                    opt.style.display = show ? '' : 'none';
                    if (show) visible++;
                });

                if (orangEmptyState) {
                    orangEmptyState.style.display = visible === 0 ? '' : 'none';
                }
            }

            /* Buka dropdown saat fokus/klik, filter saat mengetik.
               `fokusSetelahPilih` mencegah menu terbuka lagi tepat setelah
               opsi dipilih (focus() programatis) — auto-close wajib menang. */
            var fokusSetelahPilih = false;

            orangInput.addEventListener('focus', function () {
                if (fokusSetelahPilih) return;
                if (!oIsOpen) oToggle();
            });
            orangInput.addEventListener('click', function (e) { e.stopPropagation(); if (!oIsOpen) oToggle(); });
            orangInput.addEventListener('input', function () {
                // Mengetik bebas = bukan pilihan dari daftar → kedua kunci
                // (karyawan & akun) dikosongkan; server mencocokkan ulang
                // dari nama agar tautan akun tidak bisa dipalsukan.
                var hiddenOrangId = document.getElementById('orang_ditemui_id');
                if (hiddenOrangId) hiddenOrangId.value = '';
                var hiddenKaryawanId = document.getElementById('karyawan_id');
                if (hiddenKaryawanId) hiddenKaryawanId.value = '';

                if (!oIsOpen) oToggle();
                else oFilter();
            });

            orangOptionsContainer.addEventListener('click', function (e) {
                var opt = e.target.closest('.dropdown-option');
                if (opt) oSelect(opt);
            });

            document.addEventListener('click', function (e) { if (!oWrapper.contains(e.target)) oClose(); });
            orangInput.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') { oClose(); orangInput.blur(); }
            });

            /* Restore nilai lama (old()/edit): tandai opsi yang cocok. */
            var orangInitVal = orangInput.value.trim();
            if (orangInitVal) {
                // old() hanya membawa nama — lengkapi karyawan_id dari opsi
                // yang namanya cocok agar cascading tetap konsisten.
                var karyawanIdInput = document.getElementById('karyawan_id');
                if (karyawanIdInput && !karyawanIdInput.value) {
                    var initMatch = orangOptionList.filter(function (o) {
                        return o.getAttribute('data-value') === orangInitVal;
                    })[0];
                    if (initMatch) karyawanIdInput.value = initMatch.getAttribute('data-id') || '';
                }

                var orangMatch = orangOptionList.filter(function (o) {
                    return o.getAttribute('data-value') === orangInitVal;
                })[0];
                if (orangMatch) orangMatch.classList.add('selected');
            }
        })();

        /* ============================================================
           DEPENDENT DROPDOWN "ORANG YANG DITEMUI" (AJAX, BERBASIS ID)
           ------------------------------------------------------------
           Rantai nilai form registrasi tamu:
             Bidang  → #bidang_id  (bidangs.id)
             Jabatan → #jabatan_id (jabatans.id, difilter #bidang_id)
             Orang   → #karyawan_id (karyawans.id, difilter #jabatan_id)
           Nama tetap dikirim lewat hidden tujuan_ditemui/jabatan_ditemui
           agar kolom string `tamus` dan seluruh data lama tidak berubah.

           1. Proxy <select> tersembunyi (bidang_select / jabatan_select /
              orang_ditemui_select) selalu sinkron DUA ARAH dengan hidden
              input milik custom dropdown — nilai yang disubmit tidak berubah.
           2. Event 'change' pada proxy jabatan memicu Fetch API ke
              /api/get-karyawan?jabatan_id=... (hanya saat jabatan terisi),
              lalu menulis ulang opsi #orang_ditemui_select + #orang-options.
              Endpoint hanya mengembalikan karyawan AKTIF level Asisten
              Manajer / Junior / Staff.
           3. Komponen UI berbasis <select> (mis. TomSelect bila dipakai)
              ikut disinkronkan lewat syncTomSelect().
           ============================================================ */
        (function () {
            var bidangSelect  = document.getElementById('bidang_select');
            var jabatanSelect = document.getElementById('jabatan_select');
            var orangSelect   = document.getElementById('orang_ditemui_select');
            var bidangHidden  = document.getElementById('tujuan_ditemui');
            var jabatanHidden = document.getElementById('jabatan_ditemui');

            if (!bidangSelect || !jabatanSelect || !orangSelect) {
                console.error('[OrangFilter] Proxy <select> tidak ditemukan');
                return;
            }

            var ENDPOINT = '{{ route('api.get-karyawan') }}';
            var HINT_KOSONG = 'Pilih Jabatan yang Ditemui terlebih dahulu untuk menampilkan daftar nama.';
            var HINT_GAGAL  = 'Gagal memuat daftar nama — silakan coba lagi.';

            /* Penanda request terakhir: respons dari pilihan yang sudah
               diganti (stale) harus dibuang, bukan dirender. */
            var seq = 0;

            function optionExists(sel, nilai) {
                if (!nilai) return false;
                for (var i = 0; i < sel.options.length; i++) {
                    if (sel.options[i].value === nilai) return true;
                }
                return false;
            }

            /* Tambahkan opsi bila nilai yang akan diset belum ada di daftar
               (nilainya datang dari hidden input / set eksternal). */
            function ensureOption(sel, nilai) {
                if (!nilai || optionExists(sel, nilai)) return;
                sel.appendChild(new Option(nilai, nilai));
            }

            /* Set nilai proxy <select> + dispatch 'change' hanya bila berubah
               — kunci supaya sync dua arah tidak berputar. */
            function setSelect(sel, nilai) {
                ensureOption(sel, nilai);
                if (sel.value === nilai) return;
                sel.value = nilai;
                sel.dispatchEvent(new Event('change', { bubbles: true }));
            }

            /* hidden input (custom dropdown) → proxy <select>. */
            function selectDariHidden(hidden, sel) {
                if (!hidden) return;
                setSelect(sel, hidden.value);
            }

            /* proxy <select> → hidden input (bila nilai di-set langsung dari
               luar, mis. lewat DevTools / komponen UI lain), sehingga value
               yang disubmit & cascading jabatan tetap ikut berubah. Teks input
               tampilan + penanda opsi custom dropdown ikut disamakan supaya
               tampilan tidak tertinggal di belakang nilai programatis. */
            function hiddenDariSelect(sel, hidden, displayId, optionsId) {
                if (!hidden || hidden.value === sel.value) return;
                hidden.value = sel.value;

                var display = document.getElementById(displayId);
                if (display) display.value = hidden.value;

                var wrap = document.getElementById(optionsId);
                if (wrap) {
                    wrap.querySelectorAll('.dropdown-option').forEach(function (o) {
                        var cocok = hidden.value !== ''
                            && (o.getAttribute('data-value') || '') === hidden.value;
                        o.classList.toggle('selected', cocok);
                    });
                }

                hidden.dispatchEvent(new Event('change', { bubbles: true }));
            }

            /* Sinkronkan komponen UI berbasis <select> (TomSelect & sejenis)
               setelah daftar opsi diganti — hanya bila benar-benar dipakai. */
            function syncTomSelect(sel) {
                if (!sel) return;
                try {
                    var instance = sel.tomselect
                        || (window.TomSelect && typeof window.TomSelect.get === 'function'
                            ? window.TomSelect.get(sel)
                            : null);

                    if (instance) {
                        if (typeof instance.sync === 'function') instance.sync();
                        if (typeof instance.refreshOptions === 'function') instance.refreshOptions(true);
                        if (sel.value && typeof instance.setValue === 'function') instance.setValue(sel.value, false);
                    }
                } catch (err) {
                    console.warn('[OrangFilter] Sinkronisasi TomSelect gagal:', err);
                }

                // Kabarkan ke komponen UI lain yang mendengar event pada <select>.
                sel.dispatchEvent(new Event('change', { bubbles: true }));
            }

            /* Tulis hasil filter ke #orang_ditemui_select + custom dropdown. */
            function render(list, hint) {
                var nilaiLama = orangSelect.value;

                orangSelect.innerHTML = '';
                orangSelect.appendChild(new Option('— Pilih Pengguna —', ''));

                (list || []).forEach(function (row) {
                    var nama = String((row && (row.nama || row.name)) || '').trim();
                    if (!nama) return;

                    var option = new Option(nama, nama);
                    if (row.id) option.setAttribute('data-id', String(row.id));
                    if (row.user_id) option.setAttribute('data-user-id', String(row.user_id));
                    orangSelect.appendChild(option);
                });

                // Pertahankan pilihan lama bila masih ada di daftar baru.
                if (nilaiLama && optionExists(orangSelect, nilaiLama)) {
                    orangSelect.value = nilaiLama;
                }

                if (typeof window.rebuildOrangOpsi === 'function') {
                    window.rebuildOrangOpsi(list || [], hint);
                }

                syncTomSelect(orangSelect);
            }

            /* Kosongkan pilihan Orang saat jabatan induknya berubah sehingga
               nama dari daftar lama tidak diam-diam terkirim bersama jabatan
               yang baru (cascading reset berjenjang). */
            function resetOrangPilihan() {
                var input = document.getElementById('orang_ditemui');
                if (input) input.value = '';

                var karyawanId = document.getElementById('karyawan_id');
                if (karyawanId) karyawanId.value = '';

                var userId = document.getElementById('orang_ditemui_id');
                if (userId) userId.value = '';

                orangSelect.value = '';
            }

            /* Ambil daftar karyawan aktif sesuai JABATAN terpilih
               (karyawans.jabatan_id) — endpoint memvalidasi level jabatan
               (Asisten Manajer / Junior / Staff) di sisi server. */
            function loadOrang() {
                var jabatanIdInput = document.getElementById('jabatan_id');
                var jabatanId = jabatanIdInput ? (jabatanIdInput.value || '').trim() : '';
                var mySeq = ++seq;

                // Induk belum dipilih → daftar dikosongkan + petunjuk.
                if (!jabatanId) {
                    render([], HINT_KOSONG);
                    return;
                }

                var query = '?jabatan_id=' + encodeURIComponent(jabatanId);

                fetch(ENDPOINT + query, { headers: { 'Accept': 'application/json' } })
                    .then(function (res) {
                        if (!res.ok) throw new Error('HTTP ' + res.status);
                        return res.json();
                    })
                    .then(function (body) {
                        if (mySeq !== seq) return; // pilihan sudah berubah → buang
                        // Bentuk respons: array langsung, atau object {data|pegawai: []}.
                        var list = Array.isArray(body)
                            ? body
                            : (body && (body.data || body.pegawai)) || [];
                        render(list, HINT_KOSONG);
                    })
                    .catch(function (err) {
                        if (mySeq !== seq) return;
                        console.error('[OrangFilter] Gagal memuat pegawai:', err);
                        render([], HINT_GAGAL);
                    });
            }

            /* ---- SINKRONISASI DUA ARAH ---- */
            if (bidangHidden) {
                bidangHidden.addEventListener('change', function () {
                    selectDariHidden(bidangHidden, bidangSelect);
                });
            }
            if (jabatanHidden) {
                jabatanHidden.addEventListener('change', function () {
                    selectDariHidden(jabatanHidden, jabatanSelect);
                });
            }

            bidangSelect.addEventListener('change', function () {
                hiddenDariSelect(bidangSelect, bidangHidden, 'tujuan_ditemui_display', 'divisi-options');

                // Sinkronkan kunci primer bidang dari proxy <select>.
                var bidangIdInput = document.getElementById('bidang_id');
                var opsi = bidangSelect.options[bidangSelect.selectedIndex];
                if (bidangIdInput) bidangIdInput.value = opsi ? (opsi.getAttribute('data-id') || '') : '';

                loadOrang();
            });
            /* ---- RESET BERJENJANG ----
               Mengganti jabatan mengosongkan pilihan Orang (nama + kedua
               hidden id) karena daftar lama tidak lagi relevan. Saat init
               (restore old()) reset dilewati supaya isian tidak hilang. */
            var sedangInit = true;

            jabatanSelect.addEventListener('change', function () {
                hiddenDariSelect(jabatanSelect, jabatanHidden, 'jabatan_ditemui_display', 'jabatan-options');

                // Sinkronkan kunci primer jabatan dari proxy <select>.
                var jabatanIdInput = document.getElementById('jabatan_id');
                var opsi = jabatanSelect.options[jabatanSelect.selectedIndex];
                if (jabatanIdInput) jabatanIdInput.value = opsi ? (opsi.getAttribute('data-id') || '') : '';

                if (!sedangInit) resetOrangPilihan();

                loadOrang();
            });

            /* ---- INIT: samakan dengan nilai awal (old()/restore), lalu muat ---- */
            selectDariHidden(bidangHidden, bidangSelect);
            selectDariHidden(jabatanHidden, jabatanSelect);

            // Halaman lama hanya mengirim nama — lengkapi id dari opsi proxy.
            (function lengkapiIdAwal() {
                var bidangIdInput = document.getElementById('bidang_id');
                if (bidangIdInput && !bidangIdInput.value && bidangSelect.value) {
                    var opsiBidang = Array.prototype.slice.call(bidangSelect.options).filter(function (o) {
                        return o.value === bidangSelect.value;
                    })[0];
                    if (opsiBidang) bidangIdInput.value = opsiBidang.getAttribute('data-id') || '';
                }

                var jabatanIdInput = document.getElementById('jabatan_id');
                if (jabatanIdInput && !jabatanIdInput.value && jabatanSelect.value) {
                    var opsiJabatan = Array.prototype.slice.call(jabatanSelect.options).filter(function (o) {
                        return o.value === jabatanSelect.value;
                    })[0];
                    if (opsiJabatan) jabatanIdInput.value = opsiJabatan.getAttribute('data-id') || '';
                }
            })();

            loadOrang();
            sedangInit = false;
        })();

        /* ===== KETERBUKAAN DROPDOWN — HANYA SATU TERBUKA =====
           (1) Menekan/membuka satu dropdown menutup dua dropdown lain lewat
               registry window.__registrasiDropdownClosers (terdaftar di
               blok Bidang, Jabatan, dan Orang di atas).
           (2) Listener CAPTURE di bawah menutup SEMUA menu saat klik terjadi
               di luar ketiga komponen — capture dipakai karena beberapa
               widget lain (mis. input Tanggal Kunjungan & kalender) memanggil
               stopPropagation(), yang akan memblokir listener click biasa
               sehingga menu bisa tertinggal terbuka. */
        (function () {
            function wrappersDropdown() {
                return ['tujuan_ditemui_display', 'jabatan_ditemui_display', 'orang_ditemui']
                    .map(function (id) {
                        var el = document.getElementById(id);
                        return el && el.closest ? el.closest('.pln-input-icon') : null;
                    })
                    .filter(Boolean);
            }

            document.addEventListener('click', function (e) {
                var target = e.target;
                if (!target || !target.closest) return;

                var diDalamDropdown = wrappersDropdown().some(function (wrapper) {
                    return wrapper.contains(target);
                });

                if (diDalamDropdown) return;

                (window.__registrasiDropdownClosers || []).forEach(function (closer) {
                    closer.close();
                });
            }, true);
        })();

        /* Tanggal hari ini (Y-m-d) — dipakai pembatas tanggal lewat dan
           render kalender kustom; dideklarasikan di luar IIFE agar bisa
           dipakai semua blok pada skrip ini. */
        function todayLocal() {
            var d = new Date();
            var mm = String(d.getMonth() + 1).padStart(2, '0');
            var dd = String(d.getDate()).padStart(2, '0');
            return d.getFullYear() + '-' + mm + '-' + dd;
        }

        /* ===== TANGGAL KUNJUNGAN: blokir tanggal yang sudah lewat ===== */
        (function () {
            var tanggal = document.getElementById('tanggal_kunjungan');
            if (!tanggal) return;

            function batasiTanggal() {
                var min = todayLocal();
                tanggal.min = min; // browser menutup pilihan tanggal sebelum hari ini
                if (tanggal.value && tanggal.value < min) {
                    tanggal.value = min; // bersihkan nilai lama yang sudah lewat
                }
            }

            batasiTanggal();
            // Setelah lewat tengah malam, perbarui batasnya
            setInterval(batasiTanggal, 60000);

            // Klik pada input dibuka oleh kalender KUSTOM (#tanggal-calendar)
            // di blok "AKHIR PEKAN + TANGGAL MERAH" — datepicker native
            // browser sudah tidak dipakai agar bisa diwarnai per-hari.

            tanggal.addEventListener('input', function () {
                var min = tanggal.min || todayLocal();
                if (tanggal.value && tanggal.value < min) {
                    tanggal.setCustomValidity('Tanggal kunjungan tidak boleh di masa lalu (minimal hari ini).');
                    try { tanggal.reportValidity(); } catch (e) {}
                } else {
                    tanggal.setCustomValidity('');
                }
            });
        })();

        /* ===== JAM KUNJUNGAN =====
           Opsi jam dibangun lokal (1:1 dengan Tamu::SLOT_JAM di server).
           Jam istirahat 11:30–13:00 dinonaktifkan — tidak ada pemblokiran
           jam akibat kunjungan lain. */
        (function () {
            var SLOT_OPSIONAL = [
                { jam: '08:00', label: '08:00 – 09:00' },
                { jam: '09:00', label: '09:00 – 10:00' },
                { jam: '10:00', label: '10:00 – 11:00' },
                { jam: '11:00', label: '11:00 – 11:30' },
                { jam: '13:00', label: '13:00 – 14:00' },
                { jam: '14:00', label: '14:00 – 15:00' },
                { jam: '15:00', label: '15:00 – 16:00' },
            ];
            var JAM_ISTIRAHAT_AWAL = '11:30';
            var JAM_ISTIRAHAT_AKHR = '13:00';

            var selectJam = document.getElementById('jam_kunjungan');
            var tanggalInput = document.getElementById('tanggal_kunjungan');

            if (!selectJam || !tanggalInput) {
                console.error('[Jam] Elemen tidak ditemukan', {
                    selectJam: !!selectJam,
                    tanggalInput: !!tanggalInput,
                });
                return;
            }

            function buildJamOptions() {
                // Pertahankan pilihan user bila masih valid (tidak disabled).
                var previous = selectJam.value;

                selectJam.innerHTML = '<option value="">— Pilih Jam —</option>';

                SLOT_OPSIONAL.forEach(function (opt) {
                    var val = opt.jam;
                    var istirahat = val >= JAM_ISTIRAHAT_AWAL && val < JAM_ISTIRAHAT_AKHR;

                    var option = document.createElement('option');
                    option.value = val;
                    option.textContent = istirahat ? opt.label + ' (Jam Istirahat)' : opt.label;
                    option.setAttribute('data-status', istirahat ? 'istirahat' : 'tersedia');
                    if (istirahat) option.disabled = true;

                    selectJam.appendChild(option);
                });

                var candidate = previous || selectJam.dataset.old || '';
                var found = candidate ? selectJam.querySelector('option[value="' + candidate + '"]') : null;
                if (found && !found.disabled) {
                    selectJam.value = candidate;
                } else {
                    selectJam.value = '';
                }
            }

            buildJamOptions();

            // Guard: slot istirahat tidak boleh tersimpan (bisa ter-set
            // lewat manipulasi nilai programatis).
            selectJam.addEventListener('change', function () {
                var opt = selectJam.selectedOptions && selectJam.selectedOptions[0];
                if (opt && opt.disabled) selectJam.value = '';
            });
        })();

        /* ===== AKHIR PEKAN + TANGGAL MERAH / HARI LIBUR =====
           Tiga sumber penolakan tanggal, DIVALIDASI ULANG oleh server
           dengan urutan yang sama:
             1. Hari Kerja Khusus — daftar dinamis dari tabel hari_liburs
                (tipe = masuk_kerja, via $tanggalMasuk): Sabtu/Minggu
                yang di-override admin menjadi BISA dipilih (hitam).
             2. Tanggal Merah — tipe libur dari tabel hari_liburs
                (via $tanggalMerah): merah/disabled.
             3. Akhir pekan — Sabtu & Minggu di-HARDCODE libur
                (hari kerja hanya Senin–Jumat) bila tidak di-override.
           Input ditandai customValidity (submit browser ikut terblokir)
           + kotak peringatan merah. */
        (function () {
            var tanggal = document.getElementById('tanggal_kunjungan');
            var warning = document.getElementById('holiday-warning');
            var warningText = document.getElementById('holiday-warning-text');
            var TANGGAL_MERAH = @json((object) $tanggalMerah);
            var TANGGAL_MASUK = @json((object) $tanggalMasuk);
            var sedangSetLibur = false;

            /* Penerjemah untuk pesan yang dirakit JavaScript. */
            function tr(key, fallback) {
                return (window.PLNI18N && window.PLNI18N.t) ? window.PLNI18N.t(key, fallback) : fallback;
            }

            if (!tanggal) return;

            /** Alasan penolakan tanggal (null = boleh dipilih). */
            function alasanTanggalLibur(value) {
                if (!value) return null;

                // 1) Hari kerja khusus (override weekend) — selalu diizinkan
                if (Object.prototype.hasOwnProperty.call(TANGGAL_MASUK, value)) {
                    return null;
                }

                // 2) Tanggal merah dinamis (tipe libur, dikelola admin)
                if (Object.prototype.hasOwnProperty.call(TANGGAL_MERAH, value)) {
                    var keterangan = TANGGAL_MERAH[value];
                    return {
                        pesan: tr('form.msg_holiday', 'Tanggal {date} adalah hari libur dan tidak dapat dipilih untuk kunjungan.')
                            .replace('{date}', value + (keterangan ? ' (' + keterangan + ')' : ''))
                    };
                }

                // 3) Akhir pekan tanpa override — hardcode Sabtu (6) & Minggu (0)
                var bagian = String(value).split('-');
                var d = new Date(Number(bagian[0]), Number(bagian[1]) - 1, Number(bagian[2]));
                if (isNaN(d.getTime())) return null;

                var dow = d.getDay();
                if (dow === 0 || dow === 6) {
                    return {
                        pesan: tr('form.msg_weekend', 'Tanggal {date} jatuh pada {day} (akhir pekan) — kunjungan hanya dapat dijadwalkan pada hari kerja.')
                            .replace('{date}', value)
                            .replace('{day}', dow === 0
                                ? tr('day.sunday', 'Minggu')
                                : tr('day.saturday', 'Sabtu'))
                    };
                }

                return null;
            }

            function cekTanggalLibur() {
                var value = tanggal.value;
                var alasan = alasanTanggalLibur(value);

                if (alasan) {
                    var pesan = alasan.pesan;
                    tanggal.setCustomValidity(pesan);
                    tanggal.classList.add('has-error'); // kotak merah
                    sedangSetLibur = true;
                    if (warningText) warningText.textContent = pesan;
                    if (warning) warning.classList.add('show');
                    try { tanggal.reportValidity(); } catch (e) {}
                } else if (sedangSetLibur) {
                    // Hapus hanya pesan milik kita — pesan validasi
                    // tanggal lampau milik handler lain tidak diusik.
                    tanggal.setCustomValidity('');
                    tanggal.classList.remove('has-error');
                    sedangSetLibur = false;
                    if (warning) warning.classList.remove('show');
                }
            }

            tanggal.addEventListener('change', cekTanggalLibur);
            tanggal.addEventListener('input', cekTanggalLibur);
            cekTanggalLibur();

            /* ===== KALENDER KUSTOM (pengganti datepicker native) =====
               Satu-satunya cara memberi warna per-hari di datepicker:
                 MERAH  (.is-red)   — tanggal merah (tipe libur) & akhir pekan
                                      tanpa override → DISABLED
                 HITAM  (.is-masuk) — akhir pekan di-override admin
                                      (tipe masuk_kerja) → BISA dipilih
                 abu    (.is-past)  — tanggal lampau → DISABLED
               Klik hari yang diizinkan → set value + dispatch input/change,
               sehingga validasi ulang (cekTanggalLibur) ikut berjalan. */
            var kalender = document.getElementById('tanggal-calendar');
            var kalTitle = document.getElementById('cal-title');
            var kalDays = document.getElementById('cal-days');
            var kalToday = document.getElementById('cal-today');
            var BULAN_FALLBACK = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            /* Nama bulan mengikuti bahasa aktif (kamus i18n). */
            function namaBulan(index) {
                return tr('month.long.' + (index + 1), BULAN_FALLBACK[index]);
            }
            var tampilTahun;
            var tampilBulan;

            if (kalender && kalTitle && kalDays) {
                function pad2(n) { return String(n).padStart(2, '0'); }

                function ymd(tahun, bulan, hari) {
                    return tahun + '-' + pad2(bulan + 1) + '-' + pad2(hari);
                }

                /** Status satu tanggal: 'lampau' | 'libur' | 'masuk' | 'biasa'. */
                function statusHari(str) {
                    if (str < todayLocal()) return 'lampau';
                    if (alasanTanggalLibur(str)) return 'libur';
                    if (Object.prototype.hasOwnProperty.call(TANGGAL_MASUK, str)) return 'masuk';
                    return 'biasa';
                }

                function renderKalender() {
                    var totalHari = new Date(tampilTahun, tampilBulan + 1, 0).getDate();
                    var hariPertama = new Date(tampilTahun, tampilBulan, 1).getDay(); // 0 = Min

                    kalTitle.textContent = namaBulan(tampilBulan) + ' ' + tampilTahun;
                    kalDays.innerHTML = '';

                    for (var i = 0; i < hariPertama; i++) {
                        var kosong = document.createElement('button');
                        kosong.type = 'button';
                        kosong.className = 'pln-cal-day is-empty';
                        kosong.tabIndex = -1;
                        kosong.setAttribute('aria-hidden', 'true');
                        kalDays.appendChild(kosong);
                    }

                    for (var tgl = 1; tgl <= totalHari; tgl++) {
                        var str = ymd(tampilTahun, tampilBulan, tgl);
                        var status = statusHari(str);
                        var alasan = status === 'libur' ? alasanTanggalLibur(str) : null;
                        var nama = tgl + ' ' + namaBulan(tampilBulan) + ' ' + tampilTahun;

                        var btn = document.createElement('button');
                        btn.type = 'button';
                        btn.dataset.tanggal = str;
                        btn.textContent = tgl;
                        btn.className = 'pln-cal-day'
                            + (status === 'libur' ? ' is-red' : '')
                            + (status === 'masuk' ? ' is-masuk' : '')
                            + (status === 'lampau' ? ' is-past' : '')
                            + (str === todayLocal() ? ' is-hari-ini' : '')
                            + (str === tanggal.value ? ' is-terpilih' : '');

                        if (status === 'libur' || status === 'lampau') {
                            btn.disabled = true;
                            btn.title = alasan ? alasan.pesan : tr('cal.past', 'Tanggal sudah lewat.');
                        } else if (status === 'masuk') {
                            btn.title = tr('cal.special_workday', 'Hari kerja khusus (override weekend) — bisa dipilih.');
                        }
                        btn.setAttribute('aria-label', nama + (btn.title ? ' — ' + btn.title : ''));
                        kalDays.appendChild(btn);
                    }

                    // Sesuaikan lagi ruang bawah kartu bila jumlah baris
                    // minggu berubah (mis. ganti bulan).
                    if (!kalender.hidden) sesuaikanRuangKalender();
                }

                /* Ganti bahasa → judul bulan & label hari ikut diperbarui. */
                document.addEventListener('pln:languagechange', function () {
                    renderKalender();
                });

                /* Popup selalu di bawah input (bottom-start). Karena kartu
                   memakai overflow: hidden, popup dijepit ke dalam area
                   kartu (horizontal) dan ruang bawah kartu ditambah
                   seperlunya supaya footer "Hari ini" tidak terpotong. */
                function sesuaikanRuangKalender() {
                    var kartu = document.getElementById('form-registrasi');
                    if (!kartu) return;

                    var tepi = 10;
                    kartu.style.paddingBottom = '';
                    kalender.style.left = '';
                    kalender.style.maxWidth = '';

                    var batasKartu = kartu.getBoundingClientRect();
                    kalender.style.maxWidth = Math.floor(batasKartu.width - tepi * 2) + 'px';

                    // Geser horizontal agar popup tidak melewati sisi kartu.
                    var batasKalender = kalender.getBoundingClientRect();
                    var geser = 0;
                    if (batasKalender.right > batasKartu.right - tepi) {
                        geser = Math.round((batasKartu.right - tepi) - batasKalender.right);
                    }
                    if (batasKalender.left + geser < batasKartu.left + tepi) {
                        geser = Math.round((batasKartu.left + tepi) - batasKalender.left);
                    }
                    if (geser !== 0) {
                        kalender.style.left = geser + 'px';
                        batasKalender = kalender.getBoundingClientRect();
                    }

                    var kurang = batasKalender.bottom - (batasKartu.bottom - tepi);
                    if (kurang > 0) {
                        kartu.style.paddingBottom = Math.ceil(kurang + tepi) + 'px';
                    }
                }

                function bukaKalender() {
                    var dasar = tanggal.value && tanggal.value >= todayLocal()
                        ? tanggal.value : todayLocal();
                    var bagian = dasar.split('-');
                    tampilTahun = Number(bagian[0]);
                    tampilBulan = Number(bagian[1]) - 1;
                    renderKalender();
                    kalender.hidden = false;
                    sesuaikanRuangKalender();
                    tanggal.setAttribute('aria-expanded', 'true');
                }

                function tutupKalender() {
                    kalender.hidden = true;
                    var kartu = document.getElementById('form-registrasi');
                    if (kartu) kartu.style.paddingBottom = '';
                    tanggal.setAttribute('aria-expanded', 'false');
                }

                function setTanggal(str) {
                    tanggal.value = str;
                    tutupKalender();
                    tanggal.dispatchEvent(new Event('input', { bubbles: true }));
                    tanggal.dispatchEvent(new Event('change', { bubbles: true }));
                }

                tanggal.addEventListener('click', function (e) {
                    e.stopPropagation();
                    if (kalender.hidden) { bukaKalender(); } else { tutupKalender(); }
                });

                tanggal.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        if (kalender.hidden) bukaKalender(); else tutupKalender();
                    }
                });

                // Klik di luar kalender / tombol Escape → tutup.
                document.addEventListener('click', function (e) {
                    if (!kalender.hidden && !kalender.contains(e.target)) tutupKalender();
                });
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape' && !kalender.hidden) tutupKalender();
                });
                kalender.addEventListener('click', function (e) { e.stopPropagation(); });

                kalDays.addEventListener('click', function (e) {
                    var btn = e.target.closest('button[data-tanggal]');
                    if (!btn || btn.disabled) return;
                    setTanggal(btn.dataset.tanggal);
                });

                document.getElementById('cal-prev').addEventListener('click', function () {
                    tampilBulan--;
                    if (tampilBulan < 0) { tampilBulan = 11; tampilTahun--; }
                    renderKalender();
                });

                document.getElementById('cal-next').addEventListener('click', function () {
                    tampilBulan++;
                    if (tampilBulan > 11) { tampilBulan = 0; tampilTahun++; }
                    renderKalender();
                });

                if (kalToday) {
                    kalToday.addEventListener('click', function () {
                        var bagian = todayLocal().split('-');
                        tampilTahun = Number(bagian[0]);
                        tampilBulan = Number(bagian[1]) - 1;
                        if (statusHari(todayLocal()) !== 'lampau'
                            && statusHari(todayLocal()) !== 'libur') {
                            setTanggal(todayLocal());
                        } else {
                            renderKalender();
                        }
                    });
                }
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
    })();
</script>@endpush

