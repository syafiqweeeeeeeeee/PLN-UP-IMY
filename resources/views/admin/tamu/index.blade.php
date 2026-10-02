@extends('layouts.admin')

@section('title', 'Manajemen Data Tamu — E-PPID PLN')
@section('page-title', 'Manajemen Data Tamu')

@push('styles')
<style>
    /* ============================================
       DATA TAMU — MINIMALIST & CLEAN
       Pola sama dengan halaman Berita: page header
       card, stats chips, filter bar, tabel bersih.
       ============================================ */

    /* Page Header Card */
    .tamu-page-header {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 1.5rem 1.75rem;
        margin-bottom: 1.25rem;
    }
    .tamu-page-header .header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .tamu-page-header .header-left h5 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--pln-text);
        margin: 0 0 0.2rem;
    }
    .tamu-page-header .header-left p {
        font-size: 0.8rem;
        color: #9ca3af;
        margin: 0;
    }
    .header-actions { display: flex; gap: 0.6rem; flex-wrap: wrap; }

    /* Stats Cards */
    .tamu-stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 0.75rem;
        margin-top: 1.25rem;
    }
    .tamu-stat-card {
        background: #f8fafc;
        border: 1px solid #eef2f7;
        border-radius: 12px;
        padding: 0.9rem 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.85rem;
        transition: border-color 0.2s ease;
    }
    .tamu-stat-card:hover { border-color: var(--pln-blue); }
    .tamu-stat-card .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        color: #fff;
        flex-shrink: 0;
    }
    .tamu-stat-card .stat-icon.blue  { background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan)); }
    .tamu-stat-card .stat-icon.green { background: linear-gradient(135deg, #22c55e, #16a34a); }
    .tamu-stat-card .stat-icon.amber { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .tamu-stat-card .stat-label {
        font-size: 0.72rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .tamu-stat-card .stat-value {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--pln-text);
        line-height: 1.1;
    }
    html.theme-dark .tamu-stat-card { background: var(--panel); border-color: var(--line); }
    html.theme-dark .tamu-stat-card .stat-label { color: var(--ink-muted); }

    /* Filter Bar */
    .tamu-filter-bar {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    .tamu-filter-bar .search-wrapper {
        flex: 1;
        min-width: 220px;
        position: relative;
    }
    .tamu-filter-bar .search-wrapper i {
        position: absolute;
        left: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 0.82rem;
        pointer-events: none;
    }
    .tamu-filter-bar input,
    .tamu-filter-bar select {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.55rem 0.9rem;
        font-size: 0.85rem;
        background: #f9fafb;
        color: #1f2937;
        transition: all 0.2s ease;
    }
    .tamu-filter-bar .search-wrapper input {
        width: 100%;
        padding-left: 2.4rem;
    }
    .tamu-filter-bar input:focus,
    .tamu-filter-bar select:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0,91,156,0.08);
        background: #fff;
        outline: none;
    }
    .filter-divider {
        width: 1px;
        height: 26px;
        background: #e5e7eb;
        flex-shrink: 0;
    }
    .filter-count {
        font-size: 0.78rem;
        font-weight: 600;
        color: #6b7280;
        white-space: nowrap;
    }

    /* Table */
    .tamu-table-wrap {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow-x: auto;
    }
    .tamu-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }
    .tamu-table thead th {
        text-align: left;
        padding: 0.85rem 1rem;
        font-size: 0.72rem;
        font-weight: 700;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #eef2f7;
        white-space: nowrap;
        background: #f9fafb;
    }
    .tamu-table thead th.text-right { text-align: right; }
    html.theme-dark .tamu-table thead th { background: var(--panel); border-color: var(--line); }
    .tamu-table tbody td {
        padding: 0.9rem 1rem;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
        font-size: 0.84rem;
        color: #374151;
    }
    .tamu-table tbody tr:last-child td { border-bottom: none; }
    .tamu-table tbody tr { transition: background 0.15s ease; }

    /* Baris genap diberi latar tipis (zebra) agar mudah dipindai */
    .tamu-table tbody tr:nth-child(even) { background: #fafbfd; }
    .tamu-table tbody tr:hover { background: #eff6ff; }
    html.theme-dark .tamu-table tbody td { color: var(--ink-body); border-color: var(--line); }
    html.theme-dark .tamu-table tbody tr:nth-child(even) { background: rgba(255,255,255,0.02); }
    html.theme-dark .tamu-table tbody tr:hover { background: var(--panel); }

    /* ===== Kolom Waktu Daftar: nomor + tanggal/jam bertumpuk ===== */
    .tamu-waktu-row { display: flex; align-items: center; gap: 0.6rem; }
    .tamu-no-badge {
        min-width: 28px;
        height: 28px;
        padding: 0 6px;
        border-radius: 8px;
        background: #f1f5f9;
        color: #64748b;
        font-size: 0.72rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    html.theme-dark .tamu-no-badge { background: var(--panel); color: var(--ink-muted); }
    .tamu-waktu { font-size: 0.78rem; white-space: nowrap; line-height: 1.5; }
    .tamu-waktu .tgl {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-weight: 600;
        color: var(--pln-text);
    }
    .tamu-waktu .tgl i { color: #9ca3af; font-size: 0.68rem; width: 12px; text-align: center; }
    .tamu-waktu .jam {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        color: #9ca3af;
        font-size: 0.72rem;
    }
    .tamu-waktu .jam i { font-size: 0.66rem; width: 12px; text-align: center; }

    .tamu-nama { font-weight: 700; color: var(--pln-text); }
    .tamu-nik  { font-size: 0.74rem; color: #9ca3af; font-family: monospace; letter-spacing: 0.4px; }
    .tamu-hp   { font-size: 0.75rem; color: #6b7280; margin-top: 0.1rem; }

    /* ===== Kontak langsung (click-to-chat / click-to-email) ===== */
    .wa-chat-link {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        color: #16a34a;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.15s ease;
    }
    .wa-chat-link:hover { color: #128a3e; text-decoration: underline; }
    .wa-chat-link i { font-size: 0.85rem; }

    .mailto-link {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        color: #2563eb;
        font-size: 0.78rem;
        text-decoration: none;
        max-width: 170px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: color 0.15s ease;
    }
    .mailto-link:hover { color: #1d4ed8; text-decoration: underline; }
    .mailto-link i { color: #9ca3af; font-size: 0.75rem; }

    .email-empty { color: #cbd5e1; font-size: 0.8rem; }
    .tamu-tujuan .tujuan-nama { font-weight: 600; }
    .tamu-tujuan .tujuan-keperluan {
        font-size: 0.75rem;
        color: #9ca3af;
        display: block;
        max-width: 260px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .tamu-instansi {
        font-size: 0.8rem;
        max-width: 170px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Chip dokumen pendukung (satu berkas per tamu) */
    .doc-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        max-width: 190px;
        padding: 0.35rem 0.7rem;
        border-radius: 8px;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        color: #2563eb;
        font-size: 0.72rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.15s ease, border-color 0.15s ease;
    }
    .doc-chip i { color: #dc2626; }
    .doc-chip:hover { background: #dbeafe; border-color: #bfdbfe; color: #1d4ed8; }
    .doc-empty {
        width: 56px;
        height: 36px;
        border-radius: 6px;
        border: 1px dashed #d1d5db;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #cbd5e1;
        font-size: 0.7rem;
    }

    /* Status Badge */
    .tamu-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.3rem 0.7rem;
        border-radius: 999px;
        white-space: nowrap;
    }
    .tamu-badge i { font-size: 0.6rem; }
    .tamu-badge.berkunjung { background: #dbeafe; color: #1d4ed8; }
    .tamu-badge.selesai    { background: #f1f5f9; color: #64748b; }
    html.theme-dark .tamu-badge.berkunjung { background: rgba(29,78,216,0.25); color: #93c5fd; }
    html.theme-dark .tamu-badge.selesai    { background: var(--panel); color: var(--ink-muted); }

    /* Action Buttons */
    .tamu-actions { display: flex; gap: 0.35rem; justify-content: flex-end; }
    .tamu-action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.78rem;
        cursor: pointer;
        transition: all 0.15s ease;
        text-decoration: none;
    }
    .tamu-action-btn.detail   { background: #eff6ff; color: #2563eb; }
    .tamu-action-btn.detail:hover { background: #dbeafe; }
    .tamu-action-btn.edit   { background: #f0fdf4; color: #16a34a; }
    .tamu-action-btn.edit:hover { background: #dcfce7; }
    .tamu-action-btn.delete   { background: #fef2f2; color: #dc2626; }
    .tamu-action-btn.delete:hover { background: #fee2e2; }

    /* Empty State */
    .tamu-empty {
        text-align: center;
        padding: 3.5rem 1rem;
    }
    .tamu-empty .empty-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 1rem;
    }
    .tamu-empty h6 { font-weight: 700; color: var(--pln-text); margin-bottom: 0.3rem; }
    .tamu-empty p { font-size: 0.82rem; color: #9ca3af; margin: 0; }

    /* ===== Modal (overlay pattern, sama dengan modal Berita) ===== */
    .tamu-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.55);
        backdrop-filter: blur(2px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1055;
        padding: 1.25rem;
    }
    .tamu-modal-overlay.show { display: flex; }
    .tamu-modal {
        background: var(--bg-card, #fff);
        border-radius: 16px;
        width: 100%;
        max-width: 460px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: tamuModalIn 0.2s ease both;
    }
    .tamu-modal.modal-lg { max-width: 620px; }
    @keyframes tamuModalIn {
        from { opacity: 0; transform: translateY(14px) scale(0.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    .tamu-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #eef2f7;
    }
    .tamu-modal-header h6 {
        font-weight: 700;
        font-size: 0.92rem;
        color: var(--pln-text);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .tamu-modal-close {
        background: #f1f5f9;
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 8px;
        color: #64748b;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s ease;
    }
    .tamu-modal-close:hover { background: #e2e8f0; color: #dc2626; }
    .tamu-modal-body { padding: 1.25rem; }

    /* ===== Form sections dalam modal (selaras form registrasi publik) ===== */
    .tamu-form-section-head {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 1.1rem 0 0.9rem;
        padding: 0.45rem 0.75rem;
        background: #f8fafc;
        border: 1px solid #eef2f7;
        border-radius: 10px;
    }
    .tamu-form-section-head:first-child { margin-top: 0; }
    .tamu-form-section-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        border-radius: 7px;
        background: var(--pln-blue);
        color: #fff;
        font-size: 0.68rem;
    }
    .tamu-form-section-title {
        font-weight: 700;
        font-size: 0.78rem;
        color: var(--pln-text);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .edit-char-counter {
        font-size: 0.7rem;
        color: #9ca3af;
        font-variant-numeric: tabular-nums;
    }
    .edit-required-note {
        margin: 0;
        font-size: 0.72rem;
        color: #9ca3af;
    }
    .edit-file-selected {
        margin-top: 0.4rem;
        font-size: 0.72rem;
        color: #2563eb;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        border-radius: 8px;
        padding: 0.35rem 0.6rem;
        word-break: break-all;
    }

    /* Utilitas toggle sembunyikan elemen (dipakai modal edit) */
    .hidden { display: none !important; }
    .tamu-modal-body img.ktp-full {
        width: 100%;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }

    /* Detail rows */
    .detail-list { display: grid; gap: 0; }
    .detail-row {
        display: grid;
        grid-template-columns: 140px 1fr;
        gap: 0.75rem;
        padding: 0.55rem 0;
        border-bottom: 1px dashed #eef2f7;
        font-size: 0.83rem;
    }
    .detail-row:last-child { border-bottom: none; }
    .detail-row dt { color: #9ca3af; font-weight: 600; }
    .detail-row dd { margin: 0; color: var(--pln-text); font-weight: 500; word-break: break-word; }
    html.theme-dark .detail-row { border-color: var(--line); }
    html.theme-dark .detail-row dd { color: var(--ink-heading); }

    /* Delete dialog */
    .tamu-delete-dialog { text-align: center; padding: 1.75rem 1.5rem 1.5rem; }
    .tamu-delete-dialog .del-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: #fef2f2;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin: 0 auto 0.9rem;
    }
    .tamu-delete-dialog h6 { font-weight: 700; margin-bottom: 0.3rem; }
    .tamu-delete-dialog p { font-size: 0.82rem; color: #9ca3af; margin-bottom: 0.6rem; }
    .tamu-delete-name {
        background: #f8fafc;
        border: 1px solid #eef2f7;
        border-radius: 8px;
        padding: 0.5rem 0.8rem;
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 1.1rem;
    }
    .tamu-delete-actions { display: flex; gap: 0.6rem; justify-content: center; }
    .tamu-delete-actions button {
        border: none;
        border-radius: 9px;
        padding: 0.55rem 1.2rem;
        font-size: 0.83rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.15s ease;
    }
    .tamu-delete-actions .cancel { background: #f1f5f9; color: #475569; }
    .tamu-delete-actions .cancel:hover { background: #e2e8f0; }
    .tamu-delete-actions .confirm { background: #dc2626; color: #fff; }
    .tamu-delete-actions .confirm:hover { background: #b91c1c; }

    /* ---------- Print bar (di bawah tabel) ---------- */
    .tamu-print-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 1.1rem;
        padding: 0.9rem 1.1rem;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }

    .tamu-print-bar .print-info {
        font-size: 0.78rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 0.45rem;
    }

    .tamu-print-bar .print-info i { color: var(--pln-blue); }

    .tamu-print-bar .print-buttons { display: flex; gap: 0.6rem; }

    .print-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        text-decoration: none;
        font-size: 0.8rem;
        transition: all 0.15s ease;
        border: 1px solid transparent;
    }

    .print-chip span { display: flex; flex-direction: column; line-height: 1.2; }
    .print-chip small { font-weight: 400; opacity: 0.85; font-size: 0.68rem; }

    .print-chip.excel { background: #e8f5ee; color: #15803d; border-color: #bbe7cc; }
    .print-chip.excel:hover { background: #d7efdf; }

    .print-chip.pdf { background: #fdeaea; color: #b91c1c; border-color: #f5c6c6; }
    .print-chip.pdf:hover { background: #fbdcdc; }

    @media (max-width: 767.98px) {
        .tamu-page-header .header-row { flex-direction: column; align-items: flex-start; }
        .tamu-filter-bar { flex-direction: column; align-items: stretch; }
        .tamu-filter-bar .search-wrapper { min-width: 100%; }
        .filter-divider { display: none; }
        .tamu-print-bar { flex-direction: column; align-items: stretch; }
        .tamu-print-bar .print-buttons { flex-direction: column; }
    }
</style>
@endpush

@section('content')
{{-- ============================================
     PAGE HEADER
     ============================================ --}}
<div class="tamu-page-header">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-id-card" style="color: var(--pln-blue); margin-right: 0.5rem;"></i>Manajemen Data Tamu</h5>
            <p>Daftar riwayat dan verifikasi pendaftaran kunjungan tamu PLN Nusantara Power.</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.tamu.export', request()->only(['q', 'dari', 'sampai', 'status'])) }}"
               class="btn-corp btn-corp-soft" title="Unduh CSV (dapat dibuka di Excel)">
                <i class="fas fa-file-csv me-1"></i> Export Excel/CSV
            </a>
            @can('tamu.create')
            <button type="button" class="btn-corp btn-corp-primary" onclick="openAddModal()">
                <i class="fas fa-user-plus me-1"></i> Tambah Tamu Manual
            </button>
            @endcan
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="tamu-stats-row">
        <div class="tamu-stat-card">
            <div class="stat-icon blue"><i class="fas fa-calendar-day"></i></div>
            <div>
                <div class="stat-label">Total Tamu Hari Ini</div>
                <div class="stat-value">{{ $stats['hari_ini'] }}</div>
            </div>
        </div>
        <div class="tamu-stat-card">
            <div class="stat-icon green"><i class="fas fa-user-clock"></i></div>
            <div>
                <div class="stat-label">Tamu Berkunjung (Aktif)</div>
                <div class="stat-value">{{ $stats['aktif'] }}</div>
            </div>
        </div>
        <div class="tamu-stat-card">
            <div class="stat-icon amber"><i class="fas fa-chart-line"></i></div>
            <div>
                <div class="stat-label">Total Kunjungan Bulan Ini</div>
                <div class="stat-value">{{ $stats['bulan_ini'] }}</div>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success py-2 px-3" style="border-radius:10px; font-size:0.83rem;">
        <i class="fas fa-circle-check me-2"></i>{{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger py-2 px-3" style="border-radius:10px; font-size:0.83rem;">
        <i class="fas fa-circle-exclamation me-2"></i>{{ session('error') }}
    </div>
@endif

{{-- ============================================
     FILTER BAR (submit via GET)
     ============================================ --}}
<form class="tamu-filter-bar" method="GET" action="{{ route('admin.tamu.index') }}">
    <div class="search-wrapper">
        <i class="fas fa-search"></i>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, instansi, atau NIK...">
    </div>
    <div class="filter-divider"></div>
    <input type="date" name="dari" value="{{ request('dari') }}" title="Tanggal kunjungan dari" style="font-size:0.82rem;">
    <span style="color:#9ca3af; font-size:0.75rem;">s/d</span>
    <input type="date" name="sampai" value="{{ request('sampai') }}" title="Tanggal kunjungan sampai" style="font-size:0.82rem;">
    <select name="status" style="font-size:0.82rem;">
        <option value="">Semua Status</option>
        <option value="berkunjung" @selected(request('status') === 'berkunjung')>Berkunjung</option>
        <option value="selesai" @selected(request('status') === 'selesai')>Selesai</option>
    </select>
    <button type="submit" class="btn-corp btn-corp-primary" style="padding:0.5rem 1rem; font-size:0.8rem;">
        <i class="fas fa-filter me-1"></i> Terapkan
    </button>
    @if (request()->anyFilled(['q', 'dari', 'sampai', 'status']))
        <a href="{{ route('admin.tamu.index') }}" class="btn-corp btn-corp-soft" style="padding:0.5rem 1rem; font-size:0.8rem;">
            <i class="fas fa-rotate-left"></i>
        </a>
    @endif
    <div class="filter-divider"></div>
    <span class="filter-count">{{ $tamus->total() }} tamu</span>
</form>

{{-- ============================================
     TABEL DATA TAMU
     ============================================ --}}
<div class="tamu-table-wrap">
    <table class="tamu-table">
        <thead>
            <tr>
                <th>No / Waktu Masuk</th>
                <th>Identitas Tamu</th>
                <th>Instansi</th>
                <th>Email</th>
                <th>Tujuan</th>
                <th>Dokumen</th>
                <th>Status</th>
                <th class="text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tamus as $tamu)
            <tr>
                <td class="tamu-waktu">
                    <div class="tamu-waktu-row">
                        <span class="tamu-no-badge">{{ ($tamus->currentPage() - 1) * $tamus->perPage() + $loop->iteration }}</span>
                        <div>
                            <span class="tgl"><i class="fas fa-calendar-day"></i>{{ $tamu->created_at->translatedFormat('d M Y') }}</span><br>
                            <span class="jam"><i class="fas fa-clock"></i>{{ $tamu->created_at->format('H:i') }}</span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="tamu-nama">{{ $tamu->nama }}</div>
                    <div class="tamu-nik">NIK {{ $tamu->nik }}</div>
                    <div class="tamu-hp">
                        <a href="{{ $tamu->wa_chat_url }}" target="_blank" rel="noopener" class="wa-chat-link"
                           title="Chat WhatsApp ke {{ $tamu->no_hp }} (terbuka di tab baru)">
                            <i class="fab fa-whatsapp"></i> {{ $tamu->no_hp }}
                        </a>
                    </div>
                </td>
                <td class="tamu-instansi" title="{{ $tamu->instansi }}">{{ $tamu->instansi ?? '—' }}</td>
                <td>
                    @if ($tamu->email)
                        <a href="{{ $tamu->mailto_url }}" class="mailto-link"
                           title="{{ $tamu->email }} — kirim email konfirmasi">
                            <i class="fas fa-envelope"></i> {{ $tamu->email }}
                        </a>
                    @else
                        <span class="email-empty">—</span>
                    @endif
                </td>
                <td class="tamu-tujuan">
                    <span class="tujuan-nama"><i class="fas fa-user-tie" style="color:#9ca3af; margin-right:0.3rem;"></i>{{ $tamu->tujuan_ditemui }}</span>
                    <span class="tujuan-keperluan" title="{{ $tamu->keperluan }}">{{ $tamu->keperluan }}</span>
                </td>
                <td>
                    @if ($tamu->hasDokumen())
                        {{-- Satu berkas pendukung per tamu — disajikan privat via route ber-auth --}}
                        <a href="{{ $tamu->dokumen_zip_url }}" target="_blank" rel="noopener"
                           class="doc-chip" title="Buka / unduh dokumen pendukung {{ $tamu->nama }}">
                            <i class="fas fa-paperclip"></i>
                            Dokumen
                        </a>
                    @else
                        <div class="doc-empty" title="Tidak ada lampiran"><i class="fas fa-paperclip"></i></div>
                    @endif
                </td>
                <td>
                    @if ($tamu->checked_out_at)
                        <span class="tamu-badge selesai"><i class="fas fa-circle"></i> Selesai</span>
                    @else
                        <span class="tamu-badge berkunjung"><i class="fas fa-circle"></i> Berkunjung</span>
                    @endif
                </td>
                <td>
                    <div class="tamu-actions">
                        <button type="button" class="tamu-action-btn detail" title="Detail"
                                onclick="openDetailModal({{ $tamu->id }})">
                            <i class="fas fa-eye"></i>
                        </button>
                        @can('tamu.create')
                            <button type="button" class="tamu-action-btn edit" title="Edit Data Tamu"
                                    onclick='openEditModal(@json($tamuData[$tamu->id] ?? []))'>
                                <i class="fas fa-pen"></i>
                            </button>
                        @endcan
                        @can('tamu.delete')
                            <button type="button" class="tamu-action-btn delete" title="Hapus"
                                    onclick="openDeleteModal('{{ route('admin.tamu.destroy', $tamu) }}', '{{ addslashes($tamu->nama) }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        @endcan
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <div class="tamu-empty">
                        <div class="empty-icon"><i class="fas fa-id-card"></i></div>
                        <h6>Belum ada data tamu</h6>
                        <p>Data pendaftaran tamu dari form publik maupun input manual akan tampil di sini.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ============================================
     PRINT BAR — CETAK EXCEL / PDF
     (di bawah tabel; mengikuti filter aktif,
      mencetak semua baris hasil filter)
     ============================================ --}}
<div class="tamu-print-bar">
    <div class="print-info">
        <i class="fas fa-circle-info"></i>
        Mencetak seluruh <b>{{ $tamus->total() }}</b> data tamu sesuai filter aktif (bukan hanya halaman ini).
    </div>
    <div class="print-buttons">
        <a href="{{ route('admin.tamu.print', array_merge(['style' => 'excel'], request()->only(['q', 'dari', 'sampai', 'status']))) }}"
           target="_blank" class="print-chip excel" title="Cetak dengan tampilan spreadsheet (grid Excel)">
            <i class="fas fa-file-excel"></i>
            <span>
                <b>Print Excel</b>
                <small>Gaya spreadsheet</small>
            </span>
        </a>
        <a href="{{ route('admin.tamu.print', array_merge(['style' => 'pdf'], request()->only(['q', 'dari', 'sampai', 'status']))) }}"
           target="_blank" class="print-chip pdf" title="Cetak sebagai laporan formal siap tanda tangan">
            <i class="fas fa-file-pdf"></i>
            <span>
                <b>Print PDF</b>
                <small>Gaya laporan resmi</small>
            </span>
        </a>
    </div>
</div>

{{-- ============================================
     PAGINATION
     ============================================ --}}
@if ($tamus->hasPages())
<div class="page-pagination">
    <div class="pagination">
        @if ($tamus->onFirstPage())
            <span class="page-btn disabled"><i class="fas fa-chevron-left"></i></span>
        @else
            <a class="page-btn" href="{{ $tamus->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
        @endif

        @foreach ($tamus->getUrlRange(max(1, $tamus->currentPage() - 2), min($tamus->lastPage(), $tamus->currentPage() + 2)) as $page => $url)
            <a class="page-btn {{ $page == $tamus->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
        @endforeach

        @if ($tamus->hasMorePages())
            <a class="page-btn" href="{{ $tamus->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
        @else
            <span class="page-btn disabled"><i class="fas fa-chevron-right"></i></span>
        @endif
    </div>
</div>
@endif

{{-- ============================================
     MODAL: DOKUMEN TAMU (link unduh privat)
     ============================================ --}}
<div class="tamu-modal-overlay" id="dokumenModal" onclick="if(event.target===this) closeTamuModal('dokumenModal')">
    <div class="tamu-modal">
        <div class="tamu-modal-header">
            <h6><i class="fas fa-file-shield" style="color: var(--pln-blue);"></i> Dokumen Tamu — <span id="dokumenModalName"></span></h6>
            <button type="button" class="tamu-modal-close" onclick="closeTamuModal('dokumenModal')"><i class="fas fa-xmark"></i></button>
        </div>
        <div class="tamu-modal-body" style="text-align:center;">
            <p style="font-size:0.82rem; color:#6b7280; margin:0 0 1rem;">
                Dokumen pendukung tamu (arsip KTP, surat permohonan, dll.) tersimpan privat.
                Berkas ZIP/RAR akan terunduh; PDF/gambar tampil di tab baru.
            </p>
            <a id="dokumenModalUrl" href="#" target="_blank" rel="noopener" class="btn-corp btn-corp-primary" style="text-decoration:none;">
                <i class="fas fa-download me-1"></i> Buka / Unduh Dokumen
            </a>
        </div>
    </div>
</div>

{{-- ============================================
     MODAL: DETAIL TAMU
     ============================================ --}}
<div class="tamu-modal-overlay" id="detailModal" onclick="if(event.target===this) closeTamuModal('detailModal')">
    <div class="tamu-modal modal-lg">
        <div class="tamu-modal-header">
            <h6><i class="fas fa-user" style="color: var(--pln-blue);"></i> Detail Tamu</h6>
            <button type="button" class="tamu-modal-close" onclick="closeTamuModal('detailModal')"><i class="fas fa-xmark"></i></button>
        </div>
        <div class="tamu-modal-body" id="detailModalBody"><!-- diisi via JS --></div>
    </div>
</div>

{{-- ============================================
     MODAL: HAPUS TAMU
     ============================================ --}}
<div class="tamu-modal-overlay" id="deleteModal" onclick="if(event.target===this) closeTamuModal('deleteModal')">
    <div class="tamu-modal">
        <div class="tamu-delete-dialog">
            <div class="del-icon"><i class="fas fa-trash-can"></i></div>
            <h6>Hapus Data Tamu?</h6>
            <p>Data yang dihapus tidak dapat dikembalikan, termasuk file dokumen pendukungnya.</p>
            <div class="tamu-delete-name" id="deleteTamuName"></div>
            <div class="tamu-delete-actions">
                <button type="button" class="cancel" onclick="closeTamuModal('deleteModal')">Batal</button>
                <form id="deleteTamuForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="confirm"><i class="fas fa-trash me-1"></i> Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ============================================
     MODAL: TAMBAH TAMU MANUAL
     ============================================ --}}
@can('tamu.create')
<div class="tamu-modal-overlay" id="addModal" onclick="if(event.target===this) closeTamuModal('addModal')">
    <div class="tamu-modal modal-lg">
        <div class="tamu-modal-header">
            <h6><i class="fas fa-user-plus" style="color: var(--pln-blue);"></i> Tambah Tamu Manual</h6>
            <button type="button" class="tamu-modal-close" onclick="closeTamuModal('addModal')"><i class="fas fa-xmark"></i></button>
        </div>
        <form action="{{ route('admin.tamu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="tamu-modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">NIK / No. KTP <span class="text-danger">*</span></label>
                        <input type="text" name="nik" inputmode="numeric" maxlength="16" required
                               class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}"
                               placeholder="16 digit NIK" style="font-size:0.85rem;">
                        @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" required class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}" placeholder="Nama sesuai KTP" style="font-size:0.85rem;">
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Perusahaan / Instansi</label>
                        <input type="text" name="instansi" class="form-control" value="{{ old('instansi') }}"
                               placeholder="Opsional" style="font-size:0.85rem;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">No. WhatsApp / HP <span class="text-danger">*</span></label>
                        <input type="tel" name="no_hp" required class="form-control @error('no_hp') is-invalid @enderror"
                               value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" style="font-size:0.85rem;">
                        @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                               placeholder="Opsional" style="font-size:0.85rem;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Dokumen Pendukung <small class="text-muted">(opsional, maks 10MB)</small></label>
                        <input type="file" name="dokumen" accept=".zip,.rar,.pdf,.jpg,.jpeg,.png"
                               class="form-control @error('dokumen') is-invalid @enderror" style="font-size:0.8rem;">
                        <small class="text-muted" style="font-size:0.7rem;">ZIP / RAR / PDF / JPG / JPEG / PNG</small>
                        @error('dokumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Orang / Divisi yang Ditemui <span class="text-danger">*</span></label>
                        <input type="text" name="tujuan_ditemui" required class="form-control @error('tujuan_ditemui') is-invalid @enderror"
                               value="{{ old('tujuan_ditemui') }}" placeholder="Nama orang / divisi" style="font-size:0.85rem;">
                        @error('tujuan_ditemui')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Jumlah Tamu <span class="text-danger">*</span></label>
                        <input type="number" name="jumlah_tamu" min="1" max="100" required
                               class="form-control @error('jumlah_tamu') is-invalid @enderror" value="{{ old('jumlah_tamu', 1) }}"
                               style="font-size:0.85rem;">
                        @error('jumlah_tamu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Tanggal & Jam <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="tanggal_kunjungan" required
                               class="form-control @error('tanggal_kunjungan') is-invalid @enderror"
                               value="{{ old('tanggal_kunjungan') }}" style="font-size:0.85rem;">
                        @error('tanggal_kunjungan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Maksud & Keperluan <span class="text-danger">*</span></label>
                        <textarea name="keperluan" rows="3" required maxlength="2000"
                                  class="form-control @error('keperluan') is-invalid @enderror"
                                  placeholder="Jelaskan singkat keperluan kunjungan..." style="font-size:0.85rem;">{{ old('keperluan') }}</textarea>
                        @error('keperluan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="tamu-modal-header" style="border-top:1px solid #eef2f7; border-bottom:none; justify-content:flex-end; gap:0.6rem;">
                <button type="button" class="btn-corp btn-corp-soft" onclick="closeTamuModal('addModal')">Batal</button>
                <button type="submit" class="btn-corp btn-corp-primary">
                    <i class="fas fa-floppy-disk me-1"></i> Simpan Data Tamu
                </button>
            </div>
        </form>
    </div>
</div>
@endcan

{{-- ============================================
     MODAL: EDIT TAMU (POP-UP)
     ============================================ --}}
@can('tamu.create')
<div class="tamu-modal-overlay" id="editModal" onclick="if(event.target===this) closeTamuModal('editModal')">
    <div class="tamu-modal modal-lg">
        <div class="tamu-modal-header">
            <h6><i class="fas fa-user-pen" style="color: var(--pln-blue);"></i> Edit Data Tamu</h6>
            <button type="button" class="tamu-modal-close" onclick="closeTamuModal('editModal')"><i class="fas fa-xmark"></i></button>
        </div>
        <form id="editTamuForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="tamu-modal-body">

                {{-- ========== SEKSI 1: DATA DIRI (selaras form registrasi publik) ========== --}}
                <div class="tamu-form-section-head">
                    <span class="tamu-form-section-icon"><i class="fas fa-user"></i></span>
                    <span class="tamu-form-section-title">Data Diri</span>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">NIK / No. KTP <span class="text-danger">*</span></label>
                        <input type="text" name="nik" id="edit-nik" inputmode="numeric" maxlength="16" required autocomplete="off"
                               class="form-control" placeholder="Masukkan 16 digit NIK" style="font-size:0.85rem;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="edit-nama" required autocomplete="name" class="form-control"
                               placeholder="Nama sesuai KTP" style="font-size:0.85rem;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Perusahaan / Instansi <span class="text-danger">*</span></label>
                        <input type="text" name="instansi" id="edit-instansi" required autocomplete="organization" class="form-control"
                               placeholder="Nama instansi asal" style="font-size:0.85rem;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">No. WhatsApp / HP <span class="text-danger">*</span></label>
                        <input type="tel" name="no_hp" id="edit-no_hp" required autocomplete="tel" class="form-control"
                               placeholder="08xxxxxxxxxx" style="font-size:0.85rem;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="edit-email" required autocomplete="email" class="form-control"
                               placeholder="nama@email.com" style="font-size:0.85rem;">
                    </div>
                </div>

                {{-- ========== SEKSI 2: DOKUMEN (selaras form registrasi publik) ========== --}}
                <div class="tamu-form-section-head">
                    <span class="tamu-form-section-icon"><i class="fas fa-folder-open"></i></span>
                    <span class="tamu-form-section-title">Dokumen</span>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Ganti Dokumen Pendukung <small class="text-muted">(opsional)</small></label>
                        <input type="file" name="dokumen" id="edit-dokumen" accept=".zip,.rar,.pdf,.jpg,.jpeg,.png" class="form-control" style="font-size:0.8rem;"
                               onchange="showEditFileName(this, 'edit-dokumen-filename')">
                        <small class="text-muted" style="font-size:0.7rem;">ZIP/RAR/PDF/JPG/JPEG/PNG, maks 10MB — kosongkan jika tidak ingin mengganti.</small>
                        <div id="edit-dokumen-filename" class="edit-file-selected" style="display:none;"></div>
                        <div id="edit-dokumen-link" class="hidden mt-1">
                            <a id="edit-dokumen-url" href="#" target="_blank" rel="noopener" style="font-size:0.75rem; color:#2563eb; text-decoration:none;">
                                <i class="fas fa-paperclip me-1"></i>Lihat dokumen saat ini
                            </a>
                        </div>
                        <div id="edit-dokumen-empty" class="hidden">
                            <small class="text-muted" style="font-size:0.7rem;"><i class="fas fa-file-circle-xmark me-1"></i>Belum ada dokumen.</small>
                        </div>
                    </div>
                </div>

                {{-- ========== SEKSI 3: DETAIL KUNJUNGAN (selaras form registrasi publik) ========== --}}
                <div class="tamu-form-section-head">
                    <span class="tamu-form-section-icon"><i class="fas fa-calendar-check"></i></span>
                    <span class="tamu-form-section-title">Detail Kunjungan</span>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Orang / Divisi yang Ditemui <span class="text-danger">*</span></label>
                        <input type="text" name="tujuan_ditemui" id="edit-tujuan_ditemui" required class="form-control"
                               placeholder="Nama orang / divisi tujuan" style="font-size:0.85rem;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Tanggal &amp; Jam Kunjungan <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="tanggal_kunjungan" id="edit-tanggal_kunjungan" required
                               class="form-control" style="font-size:0.85rem;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Jumlah Tamu <span class="text-danger">*</span></label>
                        <input type="number" name="jumlah_tamu" id="edit-jumlah_tamu" min="1" max="100" required
                               class="form-control" style="font-size:0.85rem;">
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label" style="font-size:0.78rem; font-weight:600; margin-bottom:0;">Maksud &amp; Keperluan Kunjungan <span class="text-danger">*</span></label>
                            <span class="edit-char-counter"><span id="edit-keperluan-count">0</span>/2000</span>
                        </div>
                        <textarea name="keperluan" id="edit-keperluan" rows="4" required maxlength="2000"
                                  class="form-control"
                                  placeholder="Jelaskan singkat maksud dan keperluan kunjungan Anda..." style="font-size:0.85rem;"></textarea>
                    </div>
                </div>
            </div>
            <div class="tamu-modal-header" style="border-top:1px solid #eef2f7; border-bottom:none; justify-content:space-between; gap:0.6rem;">
                <p class="edit-required-note"><span class="text-danger">*</span> Wajib diisi. Data disimpan aman hanya untuk keperluan registrasi kunjungan.</p>
                <div style="display:flex; gap:0.6rem;">
                    <button type="button" class="btn-corp btn-corp-soft" onclick="closeTamuModal('editModal')">Batal</button>
                    <button type="submit" class="btn-corp btn-corp-primary">
                        <i class="fas fa-floppy-disk me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endcan

@push('scripts')
<script>
    /* ===== Buka/tutup modal generik ===== */
    function openTamuModal(id) {
        document.getElementById(id).classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    function closeTamuModal(id) {
        document.getElementById(id).classList.remove('show');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            ['dokumenModal', 'detailModal', 'deleteModal', 'addModal', 'editModal'].forEach(function (id) {
                const el = document.getElementById(id);
                if (el && el.classList.contains('show')) closeTamuModal(id);
            });
        }
    });

    /* ===== Modal Dokumen ===== */
    function openDokumenModal(url, nama) {
        document.getElementById('dokumenModalUrl').href = url;
        document.getElementById('dokumenModalName').textContent = nama;
        openTamuModal('dokumenModal');
    }

    /* ===== Modal Detail ===== */
    const tamuData = @json($tamuData);

    function openDetailModal(id) {
        const t = tamuData[id];
        if (!t) return;

        const rows = [
            ['Nama Lengkap', t.nama],
            ['NIK / No. KTP', t.nik],
            t.wa ? ['No. WhatsApp / HP', t.wa] : null,
            t.email ? ['Email', t.email] : null,
            ['Instansi', t.instansi || '-'],
            ['Tujuan Ditemui', t.tujuan],
            ['Jumlah Tamu', t.jumlah + ' orang'],
            ['Tanggal Kunjungan', t.tanggal],
            ['Waktu Pendaftaran', t.daftar],
            ['Check-In', t.checkin],
            ['Check-Out', t.checkout],
            ['Status', t.status],
        ];

        let html = '<div class="detail-list">';
        rows.forEach(function (row) {
            if (!row) return; // lewati baris kosong (WA/email null)
            html += '<div class="detail-row"><dt>' + row[0] + '</dt><dd>' + String(row[1]).replace(/</g, '&lt;') + '</dd></div>';
        });
        html += '</div>';

        if (t.keperluan) {
            html += '<div style="margin-top:1rem;"><div style="font-size:0.72rem; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.4rem;">Maksud & Keperluan</div>'
                 + '<div style="background:#f8fafc; border:1px solid #eef2f7; border-radius:10px; padding:0.75rem 0.9rem; font-size:0.83rem; color:#374151;">'
                 + String(t.keperluan).replace(/</g, '&lt;').replace(/\n/g, '<br>')
                 + '</div></div>';
        }

        if (t.dokumen) {
            html += '<div style="margin-top:1rem;"><div style="font-size:0.72rem; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.4rem;">Dokumen Pendukung</div>'
                 + '<a href="javascript:void(0)" onclick="openDokumenModal(\'' + t.dokumen + '\', \'' + String(t.nama).replace(/'/g, "\\'") + '\')" style="display:inline-flex; align-items:center; gap:0.45rem; font-size:0.8rem; font-weight:600; color:#2563eb; background:#eff6ff; border:1px solid #dbeafe; border-radius:9px; padding:0.5rem 0.9rem; text-decoration:none; cursor:pointer;">'
                 + '<i class="fas fa-paperclip" style="color:#dc2626;"></i> Buka / Unduh Dokumen</a></div>';
        }

        document.getElementById('detailModalBody').innerHTML = html;
        openTamuModal('detailModal');
    }

    /* ===== Modal Hapus ===== */
    function openDeleteModal(url, nama) {
        document.getElementById('deleteTamuName').textContent = nama;
        document.getElementById('deleteTamuForm').action = url;
        openTamuModal('deleteModal');
    }

    /* ===== Modal Edit (pop-up) ===== */
    const editUrlTemplate = '{{ route('admin.tamu.update', ['tamu' => ':id']) }}';

    /* Tampilkan nama file yang baru dipilih pada modal edit (dokumen) */
    function showEditFileName(input, targetId) {
        const target = document.getElementById(targetId);
        if (!target) return;
        const file = input.files && input.files[0];
        if (file) {
            target.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
            target.style.display = 'block';
        } else {
            target.textContent = '';
            target.style.display = 'none';
        }
    }

    /* Penghitung karakter Maksud & Keperluan pada modal edit */
    const editKeperluanInput = document.getElementById('edit-keperluan');
    const editKeperluanCount = document.getElementById('edit-keperluan-count');
    if (editKeperluanInput && editKeperluanCount) {
        editKeperluanInput.addEventListener('input', function () {
            editKeperluanCount.textContent = this.value.length;
        });
    }

    function openEditModal(t) {
        if (!t || !t.id) return;

        const form = document.getElementById('editTamuForm');
        form.action = editUrlTemplate.replace(':id', t.id);

        /* Isi field dengan data tamu terpilih */
        document.getElementById('edit-nik').value = t.nik || '';
        document.getElementById('edit-nama').value = t.nama || '';
        document.getElementById('edit-instansi').value = t.instansi || '';
        document.getElementById('edit-no_hp').value = t.no_hp || '';
        document.getElementById('edit-email').value = t.email || '';
        document.getElementById('edit-tujuan_ditemui').value = t.tujuan || '';
        document.getElementById('edit-jumlah_tamu').value = t.jumlah || 1;
        document.getElementById('edit-tanggal_kunjungan').value = t.tanggal_input || '';
        document.getElementById('edit-keperluan').value = t.keperluan || '';
        if (editKeperluanCount) editKeperluanCount.textContent = (t.keperluan || '').length;

        /* Reset pilihan file agar tidak terbawa dari edit sebelumnya */
        const dokInput = document.getElementById('edit-dokumen');
        if (dokInput) dokInput.value = '';
        showEditFileName(dokInput, 'edit-dokumen-filename');

        /* Link dokumen saat ini (disajikan privat via route ber-auth) */
        const dokWrap = document.getElementById('edit-dokumen-link');
        const dokEmpty = document.getElementById('edit-dokumen-empty');
        if (t.dokumen) {
            document.getElementById('edit-dokumen-url').href = t.dokumen;
            dokWrap.classList.remove('hidden');
            dokEmpty.classList.add('hidden');
        } else {
            dokWrap.classList.add('hidden');
            dokEmpty.classList.remove('hidden');
        }

        openTamuModal('editModal');
    }

    /* ===== Modal Tambah Manual ===== */
    function openAddModal() {
        openTamuModal('addModal');
    }
</script>
@endpush
@endsection
