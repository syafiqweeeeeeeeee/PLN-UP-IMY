@extends('layouts.admin')

@section('title', 'Data Karyawan — E-PPID PLN')
@section('page-title', 'Data Karyawan')

@push('styles')
<style>
    /* ============================================
       DATA KARYAWAN — PANEL ADMIN
       Struktur selaras karyawan/tamu/index (header +
       stats, filter bar, tabel, pagination) dengan
       tema warna portal.
       ============================================ */

    .dk-page-header {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 1.5rem 1.75rem;
        margin-bottom: 1.25rem;
    }
    .dk-page-header .header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .dk-page-header .header-left h5 {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--pln-text);
        margin: 0 0 0.2rem;
    }
    .dk-page-header .header-left p {
        font-size: 0.8rem;
        color: #6b7280;
        margin: 0;
    }
    .header-actions { display: flex; gap: 0.6rem; flex-wrap: wrap; }

    .dk-stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 0.75rem;
        margin-top: 1.25rem;
    }
    .dk-stat-card {
        background: #f8fafc;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 0.9rem 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.85rem;
    }
    .dk-stat-card .stat-icon {
        width: 40px; height: 40px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.95rem; color: #fff; flex-shrink: 0;
        background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan));
    }
    .dk-stat-card .stat-label {
        font-size: 0.72rem; font-weight: 600; color: #6b7280;
        text-transform: uppercase; letter-spacing: 0.5px;
    }
    .dk-stat-card .stat-value {
        font-size: 1.3rem; font-weight: 800; color: var(--pln-text);
        line-height: 1.1;
    }

    /* Filter Bar */
    .dk-filter-bar {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        flex-wrap: wrap;
    }
    .dk-filter-bar .search-wrapper {
        flex: 1;
        min-width: 200px;
        position: relative;
    }
    .dk-filter-bar .search-wrapper i {
        position: absolute; left: 0.85rem; top: 50%;
        transform: translateY(-50%);
        color: #6b7280; font-size: 0.82rem; pointer-events: none;
    }
    .dk-filter-bar input,
    .dk-filter-bar select {
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 0.5rem 0.8rem;
        font-size: 0.8rem;
        background: #f8fafc;
        color: #1f2937;
        font-family: inherit;
    }
    .dk-filter-bar .search-wrapper input { width: 100%; padding-left: 2.4rem; }
    .dk-filter-bar input:focus,
    .dk-filter-bar select:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0, 143, 168, 0.12);
        outline: none;
    }
    .filter-count {
        font-size: 0.78rem; font-weight: 600; color: #6b7280;
        white-space: nowrap;
    }

    /* Table ringkas — 4 kolom (NID, Nama, Bidang, Aksi):
       tetap punya lebar minimum agar layar sempit menggeser
       horizontal, tapi lebar normalnya mengikuti container. */
    .dk-table-wrap {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow-x: auto;
    }
    .dk-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 720px;
    }
    .dk-table thead th {
        text-align: left;
        padding: 0.7rem 0.75rem;
        font-size: 0.66rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--border-color);
        white-space: nowrap;
        background: #f8fafc;
        vertical-align: middle;
    }
    .dk-table tbody td {
        padding: 0.65rem 0.75rem;
        border-bottom: 1px solid #f1f4f9;
        vertical-align: middle;
        font-size: 0.8rem;
        color: #1f2937;
        white-space: nowrap;
    }
    .dk-table tbody tr:nth-child(even) { background: #fafbfd; }
    .dk-table tbody tr:hover { background: #e6f2fb; }

    /* Kolom identitas (NID & NAMA) sticky di kiri agar tetap terlihat
       saat layar sempit digeser horizontal.

       Penting:
       - left sticky-2 memakai variabel --dk-sticky-2-left yang diukur
         dari lebar kolom NID secara nyata (script inline di bawah).
         Nilai hardcoded menyebabkan kolom NAMA menimpa/menjauh dari
         kolom BIDANG karena offset tidak sama dengan lebar NID.
       - Lapisan z-index: konten biasa (auto) < sticky-2 < sticky-1
         < header tabel, supaya NID tidak pernah tertimpa NAMA dan
         kedua kolom identitas selalu di atas konten yang bergeser. */
    .dk-table th.sticky-1, .dk-table td.sticky-1 {
        position: sticky; left: 0; z-index: 3;
        background: var(--bg-card);
        box-shadow: 1px 0 0 var(--border-color);
    }
    .dk-table th.sticky-2, .dk-table td.sticky-2 {
        position: sticky; left: var(--dk-sticky-2-left, 120px); z-index: 2;
        background: var(--bg-card);
        box-shadow: 1px 0 0 var(--border-color);
    }
    .dk-table thead th.sticky-1, .dk-table thead th.sticky-2 { background: #f8fafc; z-index: 4; }
    .dk-table tbody tr:nth-child(even) td.sticky-1,
    .dk-table tbody tr:nth-child(even) td.sticky-2 { background: #fafbfd; }
    .dk-table tbody tr:hover td.sticky-1,
    .dk-table tbody tr:hover td.sticky-2 { background: #e6f2fb; }

    .dk-nid { font-family: monospace; font-weight: 700; color: var(--pln-text); letter-spacing: 0.4px; }
    .dk-nama { font-weight: 700; color: var(--pln-text); }
    .dk-empty { color: #cbd5e1; }

    .dk-actions { display: flex; gap: 0.3rem; }
    .dk-action-btn {
        width: 30px; height: 30px; border-radius: 8px; border: none;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 0.75rem; cursor: pointer; text-decoration: none;
        transition: all 0.15s ease;
    }
    .dk-action-btn.detail { background: #e6f2fb; color: var(--pln-cyan); }
    .dk-action-btn.edit   { background: #fef3c7; color: #b45309; }
    .dk-action-btn.delete { background: #fef2f2; color: #dc2626; }
    .dk-action-btn.account { background: #e0f2fe; color: #0369a1; }
    .dk-action-btn.account:hover { background: #bae6fd; }
    .dk-action-btn:disabled {
        background: #f1f5f9; color: #94a3b8;
        cursor: not-allowed; opacity: 0.85;
    }

    /* Status akun pada kolom aksi */
    .dk-account-badge {
        display: inline-flex; align-items: center; gap: 0.3rem;
        background: #dcfce7; color: #15803d;
        border: 1px solid #bbf7d0; border-radius: 999px;
        padding: 0.22rem 0.55rem;
        font-size: 0.68rem; font-weight: 700; white-space: nowrap;
    }
    .dk-account-note {
        font-size: 0.66rem; font-weight: 600; color: #b45309;
        white-space: nowrap;
    }

    /* Kartu kata sandi sementara (tampil SEKALI setelah akun dibuat) */
    .dk-credential-card {
        background: #fffbeb; border: 1px solid #fde68a;
        border-radius: 14px; padding: 1.25rem 1.5rem;
        margin-bottom: 1.25rem;
    }
    .dk-credential-card h6 {
        font-size: 0.95rem; font-weight: 800; color: var(--pln-text);
        margin: 0 0 0.35rem;
    }
    .dk-credential-card p { font-size: 0.8rem; color: #6b7280; margin: 0; }
    .dk-credential-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 0.6rem; margin: 0.9rem 0 0.6rem;
    }
    .dk-credential-item {
        background: #fff; border: 1px solid #fde68a;
        border-radius: 10px; padding: 0.6rem 0.8rem;
    }
    .dk-credential-item small {
        display: block; font-size: 0.66rem; font-weight: 700;
        color: #6b7280; text-transform: uppercase; letter-spacing: 0.4px;
        margin-bottom: 0.2rem;
    }
    .dk-credential-item .value {
        font-size: 0.85rem; font-weight: 700; color: var(--pln-text);
        word-break: break-all;
    }
    .dk-credential-password {
        display: flex; align-items: center; justify-content: space-between;
        gap: 0.5rem;
    }
    .dk-credential-password code {
        font-size: 0.95rem; font-weight: 800; letter-spacing: 1px;
        color: #92400e; background: #fef3c7; border-radius: 6px;
        padding: 0.15rem 0.45rem;
    }
    .dk-copy-btn {
        border: 1px solid #fcd34d; background: #fff; color: #92400e;
        border-radius: 8px; padding: 0.25rem 0.5rem;
        font-size: 0.7rem; font-weight: 700; cursor: pointer;
        white-space: nowrap;
    }
    .dk-credential-warning {
        font-size: 0.75rem; font-weight: 600; color: #b45309;
        margin: 0.5rem 0 0;
    }

    .dk-empty-state { text-align: center; padding: 3.5rem 1rem; }
    .dk-empty-state .empty-icon {
        width: 64px; height: 64px; border-radius: 16px;
        background: #e6f2fb; color: var(--pln-blue);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; margin: 0 auto 1rem;
    }
    .dk-empty-state h6 { font-weight: 700; color: var(--pln-text); margin-bottom: 0.3rem; }
    .dk-empty-state p { font-size: 0.82rem; color: #6b7280; margin: 0; }

    /* Modal impor */
    .dk-modal-overlay {
        position: fixed; inset: 0;
        background: rgba(15, 23, 42, 0.55);
        backdrop-filter: blur(2px);
        display: none; align-items: center; justify-content: center;
        z-index: 1055; padding: 1.25rem;
    }
    .dk-modal-overlay.show { display: flex; }
    .dk-modal {
        background: #fff; border-radius: 16px; width: 100%; max-width: 560px;
        max-height: 90vh; overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }
    .dk-modal-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 1rem 1.25rem; border-bottom: 1px solid var(--border-color);
    }
    .dk-modal-header h6 { font-weight: 700; font-size: 0.92rem; color: var(--pln-text); margin: 0; }
    .dk-modal-close {
        background: #f1f5f9; border: none; width: 30px; height: 30px;
        border-radius: 8px; color: #64748b; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
    }
    .dk-modal-body { padding: 1.25rem; font-size: 0.85rem; }

    /* Ringkasan impor */
    .dk-summary-grid {
        display: grid; grid-template-columns: repeat(4, 1fr);
        gap: 0.5rem; margin: 0.75rem 0;
    }
    .dk-summary-item {
        background: #f8fafc; border: 1px solid var(--border-color);
        border-radius: 10px; padding: 0.6rem; text-align: center;
    }
    .dk-summary-item b { display: block; font-size: 1.15rem; color: var(--pln-text); }
    .dk-summary-item small { font-size: 0.68rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.4px; }
    .dk-error-list {
        max-height: 220px; overflow-y: auto; margin: 0.5rem 0 0;
        padding-left: 1.1rem; font-size: 0.78rem; color: #b91c1c;
    }

    @media (max-width: 767.98px) {
        .dk-page-header .header-row { flex-direction: column; align-items: flex-start; }
        .dk-filter-bar { flex-direction: column; align-items: stretch; }
        .dk-dd { flex: 1 1 100%; min-width: 0; }
        .dk-summary-grid { grid-template-columns: repeat(2, 1fr); }
    }

    /* ============================================
       CUSTOM DROPDOWN FILTER (scrollable) — BIDANG satu-satunya filter
       di bar ini (pencarian hanya NID/NAMA + BIDANG; JABATAN, GRADE,
       GENDER, STATUS KAWIN, dan UNIT sudah dihapus — lihat
       DataKaryawanController::INDEX_FILTERS).
       Menggantikan <select> bawaan browser:
       - daftar maksimal max-height 220px + overflow-y auto,
       - sudut panel membulat (8px / rounded-3) + bayangan halus,
       - item padding 8px 12px + hover highlight lembut,
       - TANPA kotak pencarian.
       Value filter tetap dikirim via <input type="hidden"> dengan name
       sama dengan parameter GET (mis. bidang), sehingga filter, ekspor
       & pagination menerima parameter yang sama.
       ============================================ */
    .dk-dd { position: relative; flex: 0 1 200px; min-width: 150px; }
    .dk-dd-trigger {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
        width: 100%;
        text-align: left;
        cursor: pointer;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 0.5rem 0.8rem;
        font-size: 0.8rem;
        font-family: inherit;
        line-height: 1.4;
        background: #f8fafc;
        color: #1f2937;
        transition: border-color 0.18s ease, box-shadow 0.18s ease;
    }
    .dk-dd-trigger:hover { border-color: var(--pln-blue); }
    .dk-dd-trigger:focus,
    .dk-dd.is-open .dk-dd-trigger {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0, 143, 168, 0.12);
        outline: none;
    }
    .dk-dd-label {
        flex: 1 1 auto;
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .dk-dd-trigger.is-placeholder .dk-dd-label { color: #6b7280; }
    .dk-dd-chevron {
        flex-shrink: 0;
        font-size: 0.65rem;
        color: #9ca3af;
        transition: transform 0.18s ease, color 0.18s ease;
    }
    .dk-dd.is-open .dk-dd-chevron { transform: rotate(180deg); color: var(--pln-blue); }

    .dk-dd-menu {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        z-index: 1200;
        box-sizing: border-box;
        padding: 6px;
        background: #fff;
        border: 1px solid var(--border-color);
        border-radius: 8px;                     /* sudut membulat (rounded-3) */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        max-height: 220px;                      /* daftar bidang panjang tidak meluber */
        overflow-y: auto;
        overscroll-behavior: contain;
        scrollbar-width: thin;
        scrollbar-color: rgba(148, 163, 184, 0.45) transparent;
        animation: dk-dd-in 0.14s ease-out;
    }
    .dk-dd-menu[hidden] { display: none; }
    @keyframes dk-dd-in {
        from { opacity: 0; transform: translateY(-4px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    /* Scrollbar tipis & halus (bukan scrollbar bawaan yang tebal). */
    .dk-dd-menu::-webkit-scrollbar { width: 6px; }
    .dk-dd-menu::-webkit-scrollbar-track { background: transparent; }
    .dk-dd-menu::-webkit-scrollbar-thumb { background: rgba(148, 163, 184, 0.45); border-radius: 8px; }
    .dk-dd-menu::-webkit-scrollbar-thumb:hover { background: rgba(100, 116, 139, 0.6); }

    .dk-dd .dropdown-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
        width: 100%;
        padding: 8px 12px;
        border: 0;
        background: transparent;
        border-radius: 6px;
        font-family: inherit;
        font-size: 0.8rem;
        line-height: 1.35;
        color: #1f2937;
        text-align: left;
        cursor: pointer;
        transition: background 0.15s ease, color 0.15s ease;
    }
    .dk-dd .dropdown-option + .dropdown-option { margin-top: 2px; }
    /* Opsi tersembunyi oleh filter bidang — harus benar-benar hilang
       (aturan display:flex di atas mengalahkan atribut hidden bawaan). */
    .dk-dd .dropdown-option[hidden] { display: none; }
    /* Efek hover lembut + sorotan keyboard. */
    .dk-dd .dropdown-option:hover,
    .dk-dd .dropdown-option:focus-visible {
        background: rgba(0, 91, 156, 0.08);
        color: var(--pln-blue);
        outline: none;
    }
    .dk-dd .dropdown-option.is-selected {
        background: rgba(0, 91, 156, 0.12);
        color: var(--pln-blue);
        font-weight: 600;
    }
    .dk-dd .dropdown-option > span { flex: 1 1 auto; min-width: 0; }
    /* Penanda hierarki (— —) pada filter bidang: abu muda & rapat. */
    .dk-dd-dash {
        color: #9ca3af;
        letter-spacing: -0.04em;
        margin-right: 0.25rem;
    }
    .dk-dd .dk-dd-empty { color: #6b7280; }
    .dk-dd-check { display: none; font-size: 0.7rem; flex-shrink: 0; }
    .dk-dd .dropdown-option.is-selected .dk-dd-check { display: inline-block; }

    /* Mode gelap admin. */
    html.theme-dark .dk-dd-trigger,
    html.theme-dark .dk-dd-menu { background: var(--panel); border-color: var(--line); color: var(--ink-heading); }
    html.theme-dark .dk-dd .dropdown-option { color: var(--ink-heading); }
    html.theme-dark .dk-dd .dropdown-option:hover,
    html.theme-dark .dk-dd .dropdown-option:focus-visible {
        background: rgba(0, 163, 224, 0.12);
        color: var(--pln-cyan);
    }
    html.theme-dark .dk-dd .dropdown-option.is-selected {
        background: rgba(0, 163, 224, 0.14);
        color: var(--pln-cyan);
    }
    html.theme-dark .dk-dd .dk-dd-empty { color: var(--ink-faint); }
    html.theme-dark .dk-dd-dash { color: var(--ink-faint); }
    html.theme-dark .dk-dd.is-open .dk-dd-trigger,
    html.theme-dark .dk-dd-trigger:focus {
        border-color: var(--pln-cyan);
        box-shadow: 0 0 0 3px var(--focus-ring);
    }
</style>
@endpush

@section('content')
{{-- ============ PAGE HEADER + STATS ============ --}}
<div class="dk-page-header">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-users-gear" style="color: var(--pln-blue); margin-right: 0.5rem;"></i>Data Karyawan</h5>
            <p>Master data karyawan UP Indramayu — {{ $totalAll }} karyawan terdaftar.</p>
        </div>
        <div class="header-actions">
            @can('karyawan_data.create')
            <a href="{{ route('admin.karyawan_data.create') }}" class="btn-corp btn-corp-primary">
                <i class="fas fa-user-plus me-1"></i> Tambah
            </a>
            <button type="button" class="btn-corp btn-corp-soft" onclick="document.getElementById('importModal').classList.add('show')">
                <i class="fas fa-file-import me-1"></i> Impor Data
            </button>
            <a href="{{ route('admin.karyawan_data.template') }}" class="btn-corp btn-corp-soft" title="Unduh template CSV 24 kolom">
                <i class="fas fa-file-csv me-1"></i> Template
            </a>
            @endcan
            <a href="{{ route('admin.karyawan_data.export', request()->only(['q', 'bidang'])) }}"
               class="btn-corp btn-corp-soft" title="Ekspor data sesuai filter aktif ke CSV (Excel-ready)">
                <i class="fas fa-file-export me-1"></i> Ekspor
            </a>
            @can('karyawan_data.edit')
            <button type="button" id="dkMapMasterBtn" class="btn-corp btn-corp-soft"
                    title="Isi kolom BIDANG & JABATAN dari Master Bidang/Jabatan (ada pratinjau sebelum diterapkan)">
                <i class="fas fa-sitemap me-1"></i> Petakan ke Master
            </button>
            @endcan
        </div>
    </div>

    <div class="dk-stats-row">
        <div class="dk-stat-card">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div>
                <div class="stat-label">Total Karyawan</div>
                <div class="stat-value">{{ $totalAll }}</div>
            </div>
        </div>
        <div class="dk-stat-card">
            <div class="stat-icon"><i class="fas fa-filter"></i></div>
            <div>
                <div class="stat-label">Sesuai Filter</div>
                <div class="stat-value">{{ $karyawans->total() }}</div>
            </div>
        </div>
        <div class="dk-stat-card">
            <div class="stat-icon"><i class="fas fa-building"></i></div>
            <div>
                <div class="stat-label">Jumlah Bidang (Master)</div>
                <div class="stat-value">{{ ($master['bidangRows'] ?? collect())->count() }}</div>
            </div>
        </div>
    </div>
</div>

{{-- ============ ALERT & RINGKASAN IMPOR ============ --}}
@if (session('success'))
    <div class="alert alert-success py-2 px-3" role="status">
        <i class="fas fa-circle-check"></i> {{ session('success') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning py-2 px-3" role="status">
        <i class="fas fa-circle-info"></i> {{ session('warning') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger py-2 px-3" style="background:#fef2f2; border:1px solid #fecaca; color:#dc2626;" role="alert">
        <i class="fas fa-circle-exclamation"></i>
        <span>
            <strong>Data belum bisa disimpan — periksa kembali:</strong>
            <ul style="margin:0.3rem 0 0; padding-left:1.2rem; font-weight:500;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </span>
    </div>
@endif

@php $summary = session('import_summary'); @endphp
@if ($summary)
    <div class="dk-page-header" style="border-color:#bbe7cc; background:#f0fdf9;">
        <h6 style="font-weight:700; color:var(--pln-text); margin:0;">
            <i class="fas fa-clipboard-check me-1"></i> Ringkasan Impor Data
        </h6>
        <div class="dk-summary-grid" style="max-width:520px;">
            <div class="dk-summary-item"><b>{{ $summary['total'] }}</b><small>Total Baris</small></div>
            <div class="dk-summary-item"><b style="color:#15803d;">{{ $summary['inserted'] }}</b><small>Berhasil</small></div>
            <div class="dk-summary-item"><b style="color:#b45309;">{{ $summary['skipped'] }}</b><small>Duplikat Dilewati</small></div>
            <div class="dk-summary-item"><b style="color:#dc2626;">{{ $summary['failed'] }}</b><small>Gagal Validasi</small></div>
        </div>
        @if (!empty($summary['duplicates']))
            <p style="font-size:0.78rem; font-weight:700; color:#b45309; margin:0.4rem 0 0;">
                <i class="fas fa-copy me-1"></i>Baris duplikat yang dilewati (maks. 50 tampil):
            </p>
            <ol class="dk-error-list" style="color:#b45309;">
                @foreach ($summary['duplicates'] as $duplicate)
                    <li>Baris {{ $duplicate['line'] }}: {{ implode(' ', $duplicate['errors']) }}</li>
                @endforeach
            </ol>
        @endif
        @if (!empty($summary['errors']))
            <p style="font-size:0.78rem; font-weight:700; color:#b91c1c; margin:0.4rem 0 0;">
                <i class="fas fa-triangle-exclamation me-1"></i>Baris yang gagal (maks. 50 tampil):
            </p>
            <ol class="dk-error-list">
                @foreach ($summary['errors'] as $error)
                    <li>Baris {{ $error['line'] }}: {{ implode(' ', $error['errors']) }}</li>
                @endforeach
            </ol>
        @endif

        @if (!empty($summary['mapping']))
            @php
                $mapMatched = ($summary['mapping']['bidang']['matched'] ?? 0) + ($summary['mapping']['jabatan']['matched'] ?? 0);
                $mapUnmapped = ($summary['mapping']['bidang']['unmapped'] ?? 0) + ($summary['mapping']['jabatan']['unmapped'] ?? 0);
                $mapAmbiguous = ($summary['mapping']['bidang']['ambiguous'] ?? 0) + ($summary['mapping']['jabatan']['ambiguous'] ?? 0);
            @endphp
            <p style="font-size:0.78rem; font-weight:700; color:var(--pln-text); margin:0.6rem 0 0;">
                <i class="fas fa-sitemap me-1"></i>Pemetaan Bidang &amp; Jabatan ke Master:
            </p>
            <div class="dk-summary-grid" style="max-width:520px;">
                <div class="dk-summary-item"><b style="color:#15803d;">{{ $mapMatched }}</b><small>Terpetakan</small></div>
                <div class="dk-summary-item"><b style="color:#b45309;">{{ $mapUnmapped }}</b><small>Belum Ada di Master</small></div>
                <div class="dk-summary-item"><b style="color:#dc2626;">{{ $mapAmbiguous }}</b><small>Perlu Diperiksa</small></div>
            </div>
            <p style="font-size:0.75rem; color:#6b7280; margin:0.35rem 0 0;">
                Nama yang belum terpetakan tetap disimpan sebagai teks seperti semula (tidak ada master baru yang dibuat otomatis).
            </p>
            @if (!empty($summary['mapping_notes']))
                <ol class="dk-error-list" style="color:#b45309;">
                    @foreach ($summary['mapping_notes'] as $note)
                        <li>Baris {{ $note['line'] }}: {{ implode(' ', $note['notes']) }}</li>
                    @endforeach
                </ol>
            @endif
        @endif
    </div>
@endif

{{-- ============ RINGKASAN PETAKAN KE MASTER ============
     Flash dari POST karyawan_data.map-master — muncul sekali setelah
     penerapan, lalu hilang saat halaman dimuat ulang.
     ===== --}}
@php $mapSummary = session('map_summary'); @endphp
@if ($mapSummary)
    <div class="dk-page-header" style="border-color:#c7d2fe; background:#eef2ff;">
        <h6 style="font-weight:700; color:var(--pln-text); margin:0;">
            <i class="fas fa-sitemap me-1"></i> Ringkasan Pemetaan ke Master Bidang &amp; Jabatan
        </h6>
        <div class="dk-summary-grid" style="max-width:620px;">
            <div class="dk-summary-item"><b>{{ $mapSummary['rows'] }}</b><small>Total Karyawan</small></div>
            <div class="dk-summary-item"><b style="color:#15803d;">{{ $mapSummary['updated'] }}</b><small>Baris Diperbarui</small></div>
            <div class="dk-summary-item"><b style="color:#15803d;">{{ $mapSummary['bidang']['linked'] }}</b><small>Bidang Baru Terpetakan</small></div>
            <div class="dk-summary-item"><b style="color:#15803d;">{{ $mapSummary['jabatan']['linked'] }}</b><small>Jabatan Baru Terpetakan</small></div>
            <div class="dk-summary-item"><b style="color:#0b5394;">{{ $mapSummary['text_synced'] }}</b><small>Teks Disamakan ke Master</small></div>
            <div class="dk-summary-item">
                <b style="color:#b45309;">{{ $mapSummary['bidang']['unmapped'] + $mapSummary['bidang']['ambiguous'] + $mapSummary['jabatan']['unmapped'] + $mapSummary['jabatan']['ambiguous'] }}</b>
                <small>Belum Ada di Master</small>
            </div>
        </div>
        @if ($mapSummary['bidang']['unmapped_names'] !== [])
            <p style="font-size:0.75rem; font-weight:700; color:#b45309; margin:0.5rem 0 0;">
                <i class="fas fa-circle-exclamation me-1"></i>Bidang belum ada di master (teks lama dipertahankan):
                @foreach ($mapSummary['bidang']['unmapped_names'] as $i => $item)
                    {{ $i ? ' · ' : '' }}{{ $item['nama'] }} ({{ $item['jumlah'] }})
                @endforeach
            </p>
        @endif
        @if ($mapSummary['jabatan']['unmapped_names'] !== [])
            <p style="font-size:0.75rem; font-weight:700; color:#b45309; margin:0.35rem 0 0;">
                <i class="fas fa-circle-exclamation me-1"></i>Jabatan belum ada di master (teks lama dipertahankan):
                @foreach ($mapSummary['jabatan']['unmapped_names'] as $i => $item)
                    {{ $i ? ' · ' : '' }}{{ $item['nama'] }} ({{ $item['jumlah'] }})
                @endforeach
            </p>
        @endif
        <p style="font-size:0.75rem; color:#6b7280; margin:0.5rem 0 0;">
            Tambahkan nama yang kurang lewat <b>Master Bidang</b> / <b>Master Jabatan</b>, lalu jalankan tombol
            <b>Petakan ke Master</b> lagi — fitur ini aman dijalankan berulang.
        </p>
    </div>
@endif

{{-- ============ KATA SANDI SEMENTARA (SEKALI TAMPIL) ============
     Dikirim lewat session flash setelah akun berhasil dibuat. Flash
     habis setelah halaman ini dimuat, jadi kata sandi TIDAK muncul lagi
     saat halaman di-refresh dan tidak pernah masuk URL/log.
     ===== --}}
@php $newAccount = session('new_account_credentials'); @endphp
@if ($newAccount)
    <div class="dk-credential-card" role="status">
        <h6><i class="fas fa-key" style="color:#b45309; margin-right:0.4rem;"></i>Akun Pengguna Berhasil Dibuat</h6>
        <p>Sampaikan kata sandi sementara berikut kepada karyawan. Kata sandi ini hanya ditampilkan sekali.</p>
        <div class="dk-credential-grid">
            <div class="dk-credential-item">
                <small>Nama</small>
                <div class="value">{{ $newAccount['name'] }}</div>
            </div>
            <div class="dk-credential-item">
                <small>Email (untuk login)</small>
                <div class="value">{{ $newAccount['email'] }}</div>
            </div>
            <div class="dk-credential-item">
                <small>Kata Sandi Sementara</small>
                <div class="dk-credential-password">
                    <code id="dkTempPassword">{{ $newAccount['password'] }}</code>
                    <button type="button" class="dk-copy-btn" id="dkCopyTempPassword">
                        <i class="fas fa-copy"></i> Salin
                    </button>
                </div>
            </div>
        </div>
        <p class="dk-credential-warning">
            <i class="fas fa-triangle-exclamation"></i>
            Pengguna wajib mengganti kata sandi ini saat login pertama sebelum dapat mengakses portal.
        </p>
    </div>
@endif

{{-- ============ FILTER BAR — PENCARIAN TERBATAS ============
     Pencarian hanya 3 cara: NID/NAMA (input teks) + BIDANG (dropdown
     master) + per_page. Filter lain (JABATAN, GRADE, GENDER, STATUS
     KAWIN, UNIT) dihapus dari halaman ini DAN diabaikan backend
     (lihat DataKaryawanController::INDEX_FILTERS), sehingga tidak ada
     parameter tersembunyi; ekspor mengikuti q & bidang saja.
     ===== --}}
<form class="dk-filter-bar" method="GET" action="{{ route('admin.karyawan_data.index') }}">
    <div class="search-wrapper">
        <i class="fas fa-search"></i>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari NID atau NAMA...">
    </div>

    {{-- Nilai `#id` = filter lewat relasi master (ikut menampilkan
         seluruh sub-bidang di bawahnya, termasuk data lama yang belum
         terpetakan); nilai teks = data lama yang belum ada di master.
         Sufiks "(teks lama)" tidak ditampilkan lagi — value tetap teks
         aslinya supaya data lama tetap bisa difilter & diekspor.

         HANYA BIDANG yang dipakai sebagai pencarian dropdown: JABATAN,
         GRADE, GENDER, STATUS KAWIN, dan UNIT dihapus (lihat
         DataKaryawanController::INDEX_FILTERS). --}}
    @php
        $bidangOptions = [];
        foreach (($master['bidangRows'] ?? []) as $row) {
            $bidangOptions[] = [
                'value'  => '#'.$row['node']->id,
                'name'   => $row['node']->nama,
                // Indentasi hierarki memakai NBSP (bukan tanda —) supaya
                // nama bidang tidak terlihat ber-awalan strip.
                'prefix' => str_repeat("\u{00A0}\u{00A0}\u{00A0}", $row['depth']),
            ];
        }
        foreach (($master['legacyBidang'] ?? []) as $txt) {
            $bidangOptions[] = ['value' => $txt, 'name' => $txt];
        }
    @endphp

    @include('admin.data-karyawan._filter-dropdown', [
        'name'        => 'bidang',
        'title'       => 'Filter BIDANG',
        'placeholder' => 'Semua Bidang',
        'value'       => request('bidang'),
        'options'     => $bidangOptions,
    ])
    <select name="per_page" title="Baris per halaman">
        @foreach ($perPageOptions as $option)
            <option value="{{ $option }}" @selected($perPage === $option)>{{ $option }} / halaman</option>
        @endforeach
    </select>

    <button type="submit" class="btn-corp btn-corp-primary" style="padding:0.5rem 1rem; font-size:0.8rem;">
        <i class="fas fa-filter me-1"></i> Terapkan
    </button>
    @if (request()->anyFilled(['q', 'bidang']))
        <a href="{{ route('admin.karyawan_data.index') }}" class="btn-corp btn-corp-soft" style="padding:0.5rem 1rem; font-size:0.8rem;">
            <i class="fas fa-rotate-left"></i>
        </a>
    @endif
    <span class="filter-count">{{ $karyawans->total() }} karyawan</span>
</form>

{{-- ============ TABEL 4 KOLOM (NID, NAMA, BIDANG, AKSI) ============
     Kolom detail (jabatan, jenjang, grade, tanggal kepegawaian, telp,
     email, dll.) TIDAK ditampilkan di daftar — datanya tetap lengkap
     dan bisa dilihat lewat tombol Detail / form Edit. Filtering &
     pencarian tetap bekerja karena dilakukan server-side (lihat
     Karyawan::search() / Karyawan::filtered()).
     ===== --}}
<div class="dk-table-wrap">
    <table class="dk-table">
        <thead>
            <tr>
                <th class="sticky-1">NID</th>
                <th class="sticky-2">Nama</th>
                <th>Bidang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($karyawans as $karyawan)
            <tr>
                <td class="sticky-1"><span class="dk-nid">{{ $karyawan->nid }}</span></td>
                <td class="sticky-2"><span class="dk-nama">{{ $karyawan->nama }}</span></td>
                <td>{{ $karyawan->bidangLabel() ?? '—' }}</td>
                <td>
                    <div class="dk-actions">
                        <a href="{{ route('admin.karyawan_data.show', $karyawan) }}" class="dk-action-btn detail" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        @can('karyawan_data.edit')
                            <a href="{{ route('admin.karyawan_data.edit', $karyawan) }}" class="dk-action-btn edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                        @endcan
                        @can('karyawan_data.delete')
                            <form method="POST" action="{{ route('admin.karyawan_data.destroy', $karyawan) }}"
                                  onsubmit="return confirm('Hapus data karyawan {{ addslashes($karyawan->nama) }} (NID {{ $karyawan->nid }})? Data yang dihapus tidak dapat dikembalikan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dk-action-btn delete" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endcan

                        {{-- Pendaftaran akun — hanya untuk pemegang permission
                             pengelolaan akun (users.create). Tanpa permission,
                             status akun pun tidak ditampilkan di sini. --}}
                        @can('users.create')
                            @php
                                $akun = $akunByKaryawanId[$karyawan->id] ?? null;
                                $emailKaryawan = trim((string) $karyawan->email);
                                $emailValid = filter_var($emailKaryawan, FILTER_VALIDATE_EMAIL) !== false;
                            @endphp
                            @if ($akun !== null)
                                <span class="dk-account-badge" title="Data karyawan ini sudah terhubung dengan akun pengguna">
                                    <i class="fas fa-circle-check"></i> Sudah Terdaftar
                                </span>
                            @elseif (! $emailValid)
                                <button type="button" class="dk-action-btn account" disabled
                                        title="Email karyawan kosong atau tidak valid. Perbaiki lewat tombol Edit sebelum mendaftarkan akun.">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                                <span class="dk-account-note">Email tidak valid</span>
                            @else
                                <form method="POST" action="{{ route('admin.karyawan_data.register-account', $karyawan) }}"
                                      onsubmit="return confirm('Daftarkan akun pengguna untuk {{ addslashes($karyawan->nama) }} (NID {{ $karyawan->nid }}) dengan email {{ addslashes($emailKaryawan) }}? Kata sandi sementara akan dibuat otomatis dan hanya ditampilkan sekali.')">
                                    @csrf
                                    <button type="submit" class="dk-action-btn account" title="Daftarkan Akun" aria-label="Daftarkan Akun">
                                        <i class="fas fa-user-plus"></i>
                                    </button>
                                </form>
                            @endif
                        @endcan
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">
                    <div class="dk-empty-state">
                        <div class="empty-icon"><i class="fas fa-users"></i></div>
                        <h6>Belum ada data karyawan</h6>
                        <p>Tambahkan manual lewat tombol <b>Tambah</b>, atau impor sekaligus lewat <b>Impor Data</b> (CSV maupun Excel .xlsx)
                            (unduh <b>Template</b> terlebih dahulu).</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ============ INFO HALAMAN + PAGINATION ============ --}}
@if ($karyawans->total() > 0)
<div class="page-pagination">
    <div style="font-size:0.78rem; color:#6b7280; margin-bottom:0.5rem;">
        Menampilkan baris {{ $karyawans->firstItem() }}–{{ $karyawans->lastItem() }}
        dari <b>{{ $karyawans->total() }}</b> data
        (halaman {{ $karyawans->currentPage() }} dari {{ $karyawans->lastPage() }})
    </div>
    @if ($karyawans->hasPages())
    <div class="pagination">
        @if ($karyawans->onFirstPage())
            <span class="page-btn disabled"><i class="fas fa-chevron-left"></i></span>
        @else
            <a class="page-btn" href="{{ $karyawans->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
        @endif

        @foreach ($karyawans->getUrlRange(max(1, $karyawans->currentPage() - 2), min($karyawans->lastPage(), $karyawans->currentPage() + 2)) as $page => $url)
            <a class="page-btn {{ $page == $karyawans->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
        @endforeach

        @if ($karyawans->hasMorePages())
            <a class="page-btn" href="{{ $karyawans->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
        @else
            <span class="page-btn disabled"><i class="fas fa-chevron-right"></i></span>
        @endif
    </div>
    @endif
</div>
@endif

{{-- ============ MODAL IMPOR CSV ============ --}}
@can('karyawan_data.create')
<div class="dk-modal-overlay" id="importModal" onclick="if(event.target===this) this.classList.remove('show')">
    <div class="dk-modal">
        <div class="dk-modal-header">
            <h6><i class="fas fa-file-import" style="color: var(--pln-blue);"></i> Impor Data Karyawan (CSV / XLSX)</h6>
            <button type="button" class="dk-modal-close" onclick="document.getElementById('importModal').classList.remove('show')"><i class="fas fa-xmark"></i></button>
        </div>
        <div class="dk-modal-body">
            <p style="color:#6b7280; font-size:0.8rem; margin:0 0 0.8rem;">
                Unggah file <b>CSV/TXT</b> atau <b>Excel (.xlsx)</b> dengan 24 kolom sesuai <a href="{{ route('admin.karyawan_data.template') }}">template</a>.
                File .xlsx dibaca langsung (tanpa konversi manual) — sel tanggal, angka, dan teks Excel didukung.
                Baris dengan NID yang sudah ada <b>tidak ditimpa</b> — dilewati agar data lama aman.
                Seluruh baris tervalidasi dulu, baru disimpan dalam satu transaksi (tidak ada data setengah tersimpan).
            </p>
            <form action="{{ route('admin.karyawan_data.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="margin-bottom:0.8rem;">
                    <label class="form-label" style="font-size:0.78rem; font-weight:600;">File CSV / XLSX <span class="text-danger">*</span></label>
                    <input type="file" name="file" accept=".csv,.txt,.xlsx,text/csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required
                           class="form-control @error('file') is-invalid @enderror" style="font-size:0.82rem;">
                    @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <input type="hidden" name="mode" value="skip">
                <div style="display:flex; gap:0.6rem; justify-content:flex-end;">
                    <button type="button" class="btn-corp btn-corp-soft" onclick="document.getElementById('importModal').classList.remove('show')">Batal</button>
                    <button type="submit" class="btn-corp btn-corp-primary">
                        <i class="fas fa-upload me-1"></i> Unggah & Impor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan

{{-- ============ MODAL PETAKAN KE MASTER ============ --}}
@can('karyawan_data.edit')
<div class="dk-modal-overlay" id="mapMasterModal" onclick="if(event.target===this) this.classList.remove('show')">
    <div class="dk-modal">
        <div class="dk-modal-header">
            <h6><i class="fas fa-sitemap" style="color: var(--pln-blue);"></i> Petakan ke Master Bidang &amp; Jabatan</h6>
            <button type="button" class="dk-modal-close" onclick="document.getElementById('mapMasterModal').classList.remove('show')"><i class="fas fa-xmark"></i></button>
        </div>
        <div class="dk-modal-body">
            <p style="color:#6b7280; font-size:0.8rem; margin:0 0 0.8rem;">
                Mengisi kolom <b>BIDANG</b> &amp; <b>JABATAN</b> data karyawan dari <b>Master Bidang</b> dan <b>Master Jabatan</b>:
                relasi <code>bidang_id</code>/<code>jabatan_id</code> diisi dari nama yang <b>tepat cocok</b>, lalu isi kolom teks
                disamakan dengan nama master. Nama yang belum ada di master <b>tidak diubah</b> — tidak ada master baru
                yang dibuat otomatis, dan relasi yang sudah ada tidak ditimpa. Aman dijalankan berulang.
            </p>

            <div id="dkMapMasterPreview" class="dk-summary-grid" style="max-width:620px; margin-bottom:0.8rem;">
                <div class="dk-summary-item"><small>Memuat pratinjau…</small></div>
            </div>
            <div id="dkMapMasterNotes" style="font-size:0.75rem; color:#b45309; font-weight:600; margin:-0.4rem 0 0.8rem;"></div>

            <form action="{{ route('admin.karyawan_data.map-master') }}" method="POST">
                @csrf
                <div style="display:flex; gap:0.6rem; justify-content:flex-end;">
                    <button type="button" class="btn-corp btn-corp-soft" onclick="document.getElementById('mapMasterModal').classList.remove('show')">Batal</button>
                    <button type="submit" class="btn-corp btn-corp-primary">
                        <i class="fas fa-wand-magic-sparkles me-1"></i> Terapkan Pemetaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan

{{-- ============================================================
     Pratinjau pemetaan — diambil saat modal dibuka (GET JSON,
     tanpa menulis apa pun). Script INLINE di dalam content agar
     router.js mengeksekusinya ulang setelah navigasi SPA.
     ============================================================ --}}
<script>
    (function () {
        var openBtn = document.getElementById('dkMapMasterBtn');
        var modal   = document.getElementById('mapMasterModal');
        var preview = document.getElementById('dkMapMasterPreview');
        var notes   = document.getElementById('dkMapMasterNotes');
        if (!openBtn || !modal || !preview) return;

        var previewUrl = @json(route('admin.karyawan_data.map-master-preview'));

        function item(value, label) {
            return '<div class="dk-summary-item"><b>' + value + '</b><small>' + label + '</small></div>';
        }

        function names(list) {
            return list.map(function (row) { return row.nama + ' (' + row.jumlah + ')'; }).join(' · ');
        }

        function render(data) {
            var bidangSisa = data.bidang.unmapped + data.bidang.ambiguous;
            var jabatanSisa = data.jabatan.unmapped + data.jabatan.ambiguous;

            preview.innerHTML =
                item(data.rows, 'Total Karyawan') +
                item(data.rows_updated, 'Baris Akan Diperbarui') +
                item(data.bidang.linked, 'Bidang Baru Terpetakan') +
                item(data.jabatan.linked, 'Jabatan Baru Terpetakan') +
                item(data.text_synced, 'Teks Disamakan ke Master') +
                item(bidangSisa + jabatanSisa, 'Belum Ada di Master');

            var parts = [];
            if (data.bidang.unmapped_names.length) {
                parts.push('Bidang: ' + names(data.bidang.unmapped_names));
            }
            if (data.jabatan.unmapped_names.length) {
                parts.push('Jabatan: ' + names(data.jabatan.unmapped_names));
            }
            notes.innerHTML = parts.length
                ? '<i class="fas fa-circle-exclamation me-1"></i>Nama berikut tetap sebagai teks lama — tambahkan ke master lalu jalankan ulang: '
                    + parts.join('<br>')
                : (data.rows_updated === 0
                    ? '<i class="fas fa-circle-check me-1" style="color:#15803d;"></i>Semua data sudah sesuai master — tidak ada perubahan.'
                    : '');
        }

        function load() {
            preview.innerHTML = '<div class="dk-summary-item"><small>Memuat pratinjau…</small></div>';
            notes.innerHTML = '';

            fetch(previewUrl, {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin'
            })
                .then(function (res) { if (!res.ok) throw new Error('HTTP ' + res.status); return res.json(); })
                .then(render)
                .catch(function () {
                    preview.innerHTML = '<div class="dk-summary-item"><small style="color:#dc2626;">Pratinjau gagal dimuat — tutup lalu buka lagi.</small></div>';
                });
        }

        openBtn.addEventListener('click', function () {
            modal.classList.add('show');
            load();
        });
    })();
</script>

{{-- ============================================================
     Script INLINE offset kolom sticky — WAJIB di dalam content
     (bukan @push('scripts')) karena router.js hanya mengeksekusi
     ulang <script> di dalam <main> setelah navigasi SPA.

     Mengukur lebar kolom NID secara nyata lalu menulisnya ke
     --dk-sticky-2-left, supaya left kolom NAMA selalu persis
     selesai kolom NID (tanpa jeda yang membocorkan kolom BIDANG
     dan tanpa menimpa kolom BIDANG saat scroll).
     ============================================================ --}}
<script>
    (function() {
        function syncDkStickyOffset() {
            var table = document.querySelector('.dk-table');
            if (!table) return;
            var first = table.querySelector('thead th.sticky-1')
                     || table.querySelector('tbody td.sticky-1');
            if (!first) return;
            var w = first.getBoundingClientRect().width;
            // Bulatkan 2 desimal saja — pembulatan ke atas (ceil) membuat
            // jeda sub-pixel yang membocorkan garis konten saat scroll.
            w = Math.round(w * 100) / 100;
            if (w > 0) table.style.setProperty('--dk-sticky-2-left', w + 'px');
        }

        // Ukur ulang setelah layout siap (font monospace NID, dll.).
        syncDkStickyOffset();
        requestAnimationFrame(syncDkStickyOffset);
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(syncDkStickyOffset);
        }

        // Guard re-eksekusi: listener resize cukup dipasang sekali,
        // karena callback selalu mengukur elemen tabel yang terbaru.
        if (!window.__dkStickyResizeBound) {
            window.__dkStickyResizeBound = true;
            var dkStickyTimer;
            window.addEventListener('resize', function() {
                clearTimeout(dkStickyTimer);
                dkStickyTimer = setTimeout(syncDkStickyOffset, 120);
            });
        }
    })();

    // ===== CUSTOM DROPDOWN FILTER (Data Karyawan) =====
    // Pencarian bar ini hanya memuat BIDANG (lihat INDEX_FILTERS) — opsi
    // memakai daftar scrollable (max-height 220px) pengganti <select>
    // bawaan browser. Value tetap dikirim lewat <input type="hidden"
    // name="..."> sehingga filter, ekspor & pagination menerima parameter
    // yang sama.
    (function () {
        var bar = document.querySelector('.dk-filter-bar');
        if (!bar || bar.dataset.dkDdBound === '1') return;
        bar.dataset.dkDdBound = '1';

        var registry = {};

        function closeDropdown(api) {
            api.menu.hidden = true;
            api.wrap.classList.remove('is-open');
            api.trigger.setAttribute('aria-expanded', 'false');
        }

        Array.prototype.forEach.call(bar.querySelectorAll('.dk-dd'), function (wrap) {
            var name    = wrap.dataset.dd;
            var hidden  = name ? bar.querySelector('input[type="hidden"][name="' + name + '"]') : null;
            var trigger = wrap.querySelector('.dk-dd-trigger');
            var menu    = wrap.querySelector('.dk-dd-menu');
            var label   = wrap.querySelector('.dk-dd-label');
            var options = menu ? Array.prototype.slice.call(menu.querySelectorAll('.dropdown-option')) : [];

            if (!hidden || !trigger || !menu || !label || !options.length) return;

            var api = {
                wrap: wrap, name: name, hidden: hidden, trigger: trigger, menu: menu,
                label: label, options: options, placeholder: options[0], setValue: null
            };
            registry[name] = api;

            var placeholder = api.placeholder;   // opsi "Semua …" (value kosong)

            function visibleOptions() {
                return options.filter(function (o) { return !o.hidden; });
            }

            function setOpen(open) {
                menu.hidden = !open;
                wrap.classList.toggle('is-open', open);
                trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
                if (open) {
                    var vis = visibleOptions();
                    if (!vis.length) return;
                    var sel = vis.filter(function (o) { return o.classList.contains('is-selected'); })[0];
                    var target = sel || vis[0];
                    target.focus();
                    target.scrollIntoView({ block: 'nearest' });
                }
            }

            // Tulis value ke hidden input + sinkronkan label & penanda terpilih.
            function setValue(opt) {
                hidden.value = opt.dataset.value;
                label.textContent = opt.dataset.label || opt.textContent.trim();
                trigger.classList.toggle('is-placeholder', opt.dataset.value === '');
                trigger.title = opt.dataset.label || '';
                options.forEach(function (o) {
                    var on = o === opt;
                    o.classList.toggle('is-selected', on);
                    o.setAttribute('aria-selected', on ? 'true' : 'false');
                });
                hidden.dispatchEvent(new Event('input', { bubbles: true }));
                hidden.dispatchEvent(new Event('change', { bubbles: true }));
            }

            function choose(opt) {
                setValue(opt);
                setOpen(false);
                trigger.focus();
            }

            api.setValue = setValue;

            trigger.addEventListener('click', function () { setOpen(menu.hidden); });

            // Listener dipasang pada semua opsi (termasuk yang tersembunyi —
            // display:none membuatnya tak bisa diklik, tapi siap saat muncul).
            options.forEach(function (opt) {
                opt.addEventListener('click', function () { choose(opt); });
            });

            trigger.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') { setOpen(false); return; }
                if (e.key === 'ArrowDown' || e.key === 'ArrowUp' || e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();           // cegah aktivasi native button
                    setOpen(true);
                    if (e.key === 'ArrowUp') {
                        var vis = visibleOptions();
                        if (vis.length) vis[vis.length - 1].focus();
                    }
                }
            });

            menu.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    e.preventDefault();
                    setOpen(false);
                    trigger.focus();
                    return;
                }
                if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                    e.preventDefault();
                    var vis = visibleOptions();
                    if (!vis.length) return;
                    var i = vis.indexOf(document.activeElement);
                    var next = i === -1 ? 0 : (e.key === 'ArrowDown'
                        ? Math.min(i + 1, vis.length - 1)
                        : Math.max(i - 1, 0));
                    vis[next].focus();
                    vis[next].scrollIntoView({ block: 'nearest' });
                }
            });

            // Tab keluar dari dropdown → tutup panelnya.
            wrap.addEventListener('focusout', function () {
                requestAnimationFrame(function () {
                    if (!menu.hidden && !wrap.contains(document.activeElement)) closeDropdown(api);
                });
            });
        });

        // Klik di luar baris filter → tutup dropdown mana pun yang terbuka.
        document.addEventListener('mousedown', function (e) {
            Object.keys(registry).forEach(function (key) {
                var api = registry[key];
                if (!api.menu.hidden && !api.wrap.contains(e.target)) closeDropdown(api);
            });
        });
    })();

    // Salin kata sandi sementara (kartu sekali tampil setelah akun dibuat).
    (function () {
        var copyBtn = document.getElementById('dkCopyTempPassword');
        var passwordEl = document.getElementById('dkTempPassword');

        if (!copyBtn || !passwordEl) return;

        copyBtn.addEventListener('click', function () {
            var password = passwordEl.textContent.trim();

            function markCopied() {
                copyBtn.innerHTML = '<i class="fas fa-check"></i> Tersalin';
            }

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(password).then(markCopied, function () {});

                return;
            }

            // Fallback browser lama / konteks non-secure.
            var area = document.createElement('textarea');
            area.value = password;
            area.setAttribute('readonly', 'readonly');
            area.style.position = 'fixed';
            area.style.opacity = '0';
            document.body.appendChild(area);
            area.select();

            try {
                document.execCommand('copy');
                markCopied();
            } catch (e) {
                // Diamkan — admin tetap bisa menyalin manual.
            }

            document.body.removeChild(area);
        });
    })();
</script>
@endsection
