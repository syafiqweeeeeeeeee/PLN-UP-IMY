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
        min-width: 1060px;
    }
    .tamu-table thead th {
        text-align: left;
        padding: 0.8rem 0.9rem;
        font-size: 0.7rem;
        font-weight: 700;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        border-bottom: 2px solid #e8edf5;
        white-space: nowrap;
        background: #f9fafb;
        vertical-align: middle;
    }
    .tamu-table thead th.text-right { text-align: right; }
    .tamu-table thead th.text-center { text-align: center; }

    /* Lebar kolom agar tabel tidak "loncat" antar halaman & tetap rapi */
    .tamu-table th.col-no        { width: 215px; }
    .tamu-table th.col-identitas { width: 17%; min-width: 170px; }
    .tamu-table th.col-instansi  { width: 13%; min-width: 120px; }
    .tamu-table th.col-email     { width: 15%; min-width: 140px; }
    .tamu-table th.col-tujuan    { width: 18%; min-width: 150px; }
    .tamu-table th.col-doc       { width: 92px; }
    .tamu-table th.col-status    { width: 118px; }
    .tamu-table th.col-aksi      { width: 178px; }
    html.theme-dark .tamu-table thead th { background: var(--panel); border-color: var(--line); }
    .tamu-table tbody td {
        padding: 0.75rem 0.9rem;
        border-bottom: 1px solid #f1f4f9;
        vertical-align: middle;
        font-size: 0.83rem;
        line-height: 1.45;
        color: #374151;
    }
    .tamu-table td.text-center { text-align: center; }
    .tamu-table tbody tr:last-child td { border-bottom: none; }
    .tamu-table tbody tr { transition: background 0.15s ease, box-shadow 0.15s ease; }

    /* Baris genap diberi latar tipis (zebra) agar mudah dipindai */
    .tamu-table tbody tr:nth-child(even) { background: #fafbfd; }
    .tamu-table tbody tr:hover {
        background: #eff6ff;
        box-shadow: inset 3px 0 0 var(--pln-blue, #005b9c);
    }
    html.theme-dark .tamu-table tbody td { color: var(--ink-body); border-color: var(--line); }
    html.theme-dark .tamu-table tbody tr:nth-child(even) { background: rgba(255,255,255,0.02); }
    html.theme-dark .tamu-table tbody tr:hover { background: var(--panel); }

    /* ===== Kolom Waktu Daftar: nomor + tanggal/jam bertumpuk =====
       Struktur dua kolom kecil — label kiri (ikon) + nilai kanan —
       agar tanggal & jam sejajar vertikal dan mudah dipindai. */
    .tamu-waktu-row { display: flex; align-items: center; gap: 0.65rem; }
    .tamu-no-badge {
        min-width: 30px;
        height: 30px;
        padding: 0 6px;
        border-radius: 9px;
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
    .tamu-waktu { font-size: 0.78rem; white-space: nowrap; line-height: 1.45; }
    .tamu-waktu-meta {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.25rem;
    }
    /* Baris "Daftar": tanggal + jam dalam satu pill netral */
    .waktu-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.16rem 0.5rem;
        border-radius: 8px;
        background: #f8fafc;
        border: 1px solid #eef2f7;
        font-size: 0.71rem;
        color: #475569;
        white-space: nowrap;
        font-variant-numeric: tabular-nums;
    }
    .waktu-pill i { font-size: 0.64rem; color: #94a3b8; width: 13px; text-align: center; }
    .waktu-pill .pill-jam { font-weight: 600; color: var(--pln-text); }
    .waktu-pill .pill-sep { color: #cbd5e1; }
    html.theme-dark .waktu-pill { background: var(--panel); border-color: var(--line); color: var(--ink-muted); }
    html.theme-dark .waktu-pill .pill-jam { color: var(--ink-heading); }
    /* Baris "Jadwal kunjungan" — pill hijau sebagai pembeda jelas */
    .kunjungan-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        max-width: 100%;
        padding: 0.16rem 0.5rem;
        border-radius: 8px;
        background: #f0fdf4;
        border: 1px solid #dcfce7;
        color: #15803d;
        font-size: 0.7rem;
        font-weight: 600;
        white-space: nowrap;
        font-variant-numeric: tabular-nums;
    }
    .kunjungan-chip i { font-size: 0.62rem; color: #16a34a; width: 13px; text-align: center; }
    .kunjungan-chip .chip-sep { color: #86efac; }
    html.theme-dark .kunjungan-chip { background: rgba(21,128,61,0.18); border-color: rgba(34,197,94,0.3); color: #86efac; }

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
        height: 34px;
        border-radius: 8px;
        border: 1px dashed #d1d5db;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #cbd5e1;
        font-size: 0.7rem;
        margin: 0 auto;
    }

    /* Kolom dokumen & status agar isinya rapi di tengah */
    .tamu-table td.text-center .tamu-badge { justify-content: center; }
    .tamu-table td.text-center .doc-chip { max-width: 100%; }

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
    .tamu-badge.menunggu  { background: #fef3c7; color: #b45309; }
    .tamu-badge.berkunjung { background: #dbeafe; color: #1d4ed8; }
    .tamu-badge.disetujui { background: #dcfce7; color: #15803d; }
    .tamu-badge.ditolak   { background: #fee2e2; color: #dc2626; }
    .tamu-badge.selesai    { background: #f1f5f9; color: #64748b; }
    html.theme-dark .tamu-badge.menunggu  { background: rgba(180,83,9,0.25); color: #fcd34d; }
    html.theme-dark .tamu-badge.berkunjung { background: rgba(29,78,216,0.25); color: #93c5fd; }
    html.theme-dark .tamu-badge.disetujui { background: rgba(21,128,61,0.25); color: #86efac; }
    html.theme-dark .tamu-badge.ditolak   { background: rgba(220,38,38,0.25); color: #fca5a5; }
    html.theme-dark .tamu-badge.selesai    { background: var(--panel); color: var(--ink-muted); }

    /* Action Buttons */
    .tamu-actions { display: flex; gap: 0.3rem; justify-content: flex-end; flex-wrap: wrap; }
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
    
    .tamu-action-btn.delete   { background: #fef2f2; color: #dc2626; }
    .tamu-action-btn.delete:hover { background: #fee2e2; }
    .tamu-action-btn.setuju  { background: #dcfce7; color: #15803d; }
    .tamu-action-btn.setuju:hover { background: #bbf7d0; }
    .tamu-action-btn.tolak   { background: #fee2e2; color: #dc2626; }
    .tamu-action-btn.tolak:hover { background: #fecaca; }

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

    .tamu-jam-status {
        display: block;
        font-size: 0.7rem;
        margin-top: 0.28rem;
        color: #64748b;
    }
    .tamu-jam-status.blocked { color: #dc2626; font-weight: 600; }
    .tamu-jam-status.ok { color: #16a34a; }

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
    .tamu-delete-actions .confirm.tolak-btn { background: #dc2626; }
    .tamu-delete-actions .confirm.tolak-btn:hover { background: #b91c1c; }
    .tamu-delete-actions .confirm.setuju-btn { background: #15803d; }
    .tamu-delete-actions .confirm.setuju-btn:hover { background: #166534; }

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

    /* ============================================================
       CUSTOM DROPDOWN DIVISI + INPUT TANGGAL — modal Tambah/Edit
       Pola & gaya selaras form registrasi publik
       (/layanan/form-registrasi-tamu): input readonly dengan ikon
       chevron, menu absolut berisi opsi bertingkat, plus input date
       yang ikon kalender bawaannya disembunyikan.
       ============================================================ */
    .tamu-dd-wrap { position: relative; }
    .tamu-dd-input {
        cursor: pointer;
        padding-right: 1.6rem;
        background-clip: padding-box;
    }
    .tamu-dd-input[readonly] { background: #fff; }
    .tamu-dd-input.dropdown-open {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0,91,156,0.08);
    }
    .tamu-dd-arrow {
        position: absolute;
        right: 0.6rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        pointer-events: none;
        transition: transform 0.18s ease, color 0.18s ease;
        z-index: 1;
        font-size: 0.75rem;
    }
    .tamu-dd-input:focus ~ .tamu-dd-arrow,
    .tamu-dd-wrap.dropdown-open .tamu-dd-arrow {
        transform: translateY(-50%) rotate(180deg);
        color: var(--pln-blue);
    }
    .tamu-dd-menu {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        z-index: 1100;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        box-shadow: 0 10px 26px rgba(0,0,0,0.09);
        max-height: 210px;
        overflow-y: auto;
        padding: 0.2rem 0;
        display: none;
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 transparent;
    }
    .tamu-dd-menu.open { display: block; }
    .tamu-dd-menu::-webkit-scrollbar { width: 4px; }
    .tamu-dd-menu::-webkit-scrollbar-track { background: transparent; }
    .tamu-dd-menu::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }
    .tamu-dd-menu::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    .tamu-dd-menu .dropdown-optgroup {
        padding: 0.3rem 0.7rem 0.2rem;
        font-weight: 600;
        font-size: 0.62rem;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        background: #f8fafc;
        border-bottom: 1px solid #eef2f7;
        margin: 0.12rem 0 0.04rem;
        border-radius: 5px;
        position: sticky;
        top: 0;
    }
    .tamu-dd-menu .dropdown-option {
        padding: 0.38rem 0.7rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.78rem;
        color: #334155;
        transition: all 0.14s ease;
        border-radius: 6px;
        margin: 0.02rem 0.15rem;
    }
    .tamu-dd-menu .dropdown-option:hover { background: rgba(0,91,156,0.06); }
    .tamu-dd-menu .dropdown-option.selected { background: rgba(0,91,156,0.09); color: var(--pln-blue); font-weight: 600; }
    .tamu-dd-menu .dropdown-option::before {
        content: '';
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #cbd5e1;
        flex-shrink: 0;
    }
    .tamu-dd-menu .dropdown-option.selected::before { background: var(--pln-blue); }

    /* Input tanggal: sembunyikan ikon kalender bawaan browser agar
       tampil bersih seperti dropdown (kalender tetap terbuka saat
       field / panah diklik). */
    .tamu-dd-wrap input[type="date"] {
        padding-right: 1.7rem;
        color-scheme: light;
        cursor: pointer;
    }
    .tamu-dd-wrap input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0;
        cursor: pointer;
        padding: 0.18rem;
        border-radius: 5px;
        transition: background 0.18s ease;
    }
    .tamu-dd-wrap input[type="date"]::-webkit-calendar-picker-indicator:hover {
        background: rgba(0,0,0,0.03);
    }
    html.theme-dark .tamu-dd-input[readonly] { background: var(--panel); }
    html.theme-dark .tamu-dd-menu { background: var(--panel); border-color: var(--line); }
    html.theme-dark .tamu-dd-menu .dropdown-optgroup { background: rgba(255,255,255,0.03); border-color: var(--line); }
    html.theme-dark .tamu-dd-menu .dropdown-option { color: var(--ink-body); }
    html.theme-dark .tamu-dd-menu .dropdown-option:hover { background: rgba(255,255,255,0.05); }
    html.theme-dark .tamu-dd-menu .dropdown-option.selected { background: rgba(0,91,156,0.35); color: #93c5fd; }

    /* Slot jam kunjungan dalam <select> jam */
    .tamu-modal select option:disabled { color: #94a3b8 !important; background: #f1f5f9 !important; }
    .tamu-modal select option.slot-penuh {
        color: #dc2626 !important;
        background: #fef2f2 !important;
        font-weight: 600;
    }

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
@if ($errors->any())
    <div class="alert alert-danger py-2 px-3" style="border-radius:10px; font-size:0.83rem;">
        <i class="fas fa-circle-exclamation me-2"></i>
        <strong>Data belum bisa disimpan — periksa kembali:</strong>
        <ul style="margin:0.3rem 0 0; padding-left:1.2rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
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
        <option value="menunggu" @selected(request('status') === 'menunggu')>Menunggu Verifikasi</option>
        <option value="disetujui" @selected(request('status') === 'disetujui')>Disetujui</option>
        <option value="ditolak" @selected(request('status') === 'ditolak')>Ditolak</option>
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
                <th class="col-no">No / Waktu Masuk</th>
                <th class="col-identitas">Identitas Tamu</th>
                <th class="col-instansi">Instansi</th>
                <th class="col-email">Email</th>
                <th class="col-tujuan">Tujuan Kunjungan</th>
                <th class="col-doc text-center">Dokumen</th>
                <th class="col-status text-center">Status</th>
                <th class="col-aksi text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tamus as $tamu)
            <tr>
                <td class="tamu-waktu">
                    <div class="tamu-waktu-row">
                        <span class="tamu-no-badge">{{ ($tamus->currentPage() - 1) * $tamus->perPage() + $loop->iteration }}</span>
                        <div class="tamu-waktu-meta">
                            <span class="waktu-pill" title="Waktu pendaftaran">
                                <i class="fas fa-calendar-day"></i>{{ $tamu->created_at->translatedFormat('d M Y') }}
                                <span class="pill-sep">·</span>
                                <span class="pill-jam">{{ $tamu->created_at->format('H:i') }}</span>
                            </span>
                            <span class="kunjungan-chip" title="Jadwal kunjungan yang dipilih tamu">
                                <i class="fas fa-calendar-check"></i>
                                {{ $tamu->tanggal_kunjungan?->translatedFormat('d M Y') ?? '—' }}
                                @if ($tamu->tanggal_kunjungan)
                                    <span class="chip-sep">·</span>
                                    <span>{{ $tamu->tanggal_kunjungan->format('H:i') }}</span>
                                @endif
                            </span>
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
                <td class="text-center">
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
                <td class="text-center">
                    {{-- Alur verifikasi: Menunggu -> Disetujui/Ditolak.
                         Setelah disetujui, kunjungan berjalan (Berkunjung/Selesai
                         mengikuti check-in/out). Ditolak = kunjungan batal. --}}
                    @if ($tamu->status_verifikasi === \App\Models\Tamu::STATUS_DITOLAK)
                        <span class="tamu-badge ditolak" title="Kunjungan ditolak"><i class="fas fa-circle"></i> Ditolak</span>
                    @elseif ($tamu->status_verifikasi === \App\Models\Tamu::STATUS_DISETUJUI)
                        @if ($tamu->checked_out_at)
                            <span class="tamu-badge selesai"><i class="fas fa-circle"></i> Selesai</span>
                        @else
                            <span class="tamu-badge disetujui" title="Disetujui — tamu dapat berkunjung"><i class="fas fa-circle"></i> Disetujui</span>
                        @endif
                    @else
                        <span class="tamu-badge menunggu" title="Menunggu verifikasi admin"><i class="fas fa-circle"></i> Menunggu</span>
                    @endif
                </td>
                <td>
                    <div class="tamu-actions">
                        <button type="button" class="tamu-action-btn detail" title="Detail"
                                onclick="openDetailModal({{ $tamu->id }})">
                            <i class="fas fa-eye"></i>
                        </button>
                        @can('tamu.edit')
                            <button type="button" class="tamu-action-btn edit" title="Edit Data Tamu"
                                    onclick='openEditModal(@json($tamuData[$tamu->id] ?? []))'>
                                <i class="fas fa-pen"></i>
                            </button>
                        @endcan
                        @can('tamu.checkout')
                            @if ($tamu->status_verifikasi === \App\Models\Tamu::STATUS_MENUNGGU)
                                <button type="button" class="tamu-action-btn setuju" title="Setujui kunjungan & kirim konfirmasi WA"
                                        onclick="openVerifikasiModal({{ $tamu->id }}, 'setuju')">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button type="button" class="tamu-action-btn tolak" title="Tolak kunjungan & kirim konfirmasi WA"
                                        onclick="openVerifikasiModal({{ $tamu->id }}, 'tolak')">
                                    <i class="fas fa-xmark"></i>
                                </button>
                            @endif
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
     MODAL: VERIFIKASI KUNJUNGAN (Setuju / Tolak)
     ============================================ --}}
@can('tamu.checkout')
<div class="tamu-modal-overlay" id="verifikasiModal" onclick="if(event.target===this) closeTamuModal('verifikasiModal')">
    <div class="tamu-modal">
        <div class="tamu-delete-dialog">
            <div class="del-icon" id="verifikasiIcon"><i class="fas fa-circle-check"></i></div>
            <h6 id="verifikasiTitle">Setujui Kunjungan?</h6>
            <p id="verifikasiDesc">Kunjungan tamu ini akan disetujui. Setelah itu,
                Anda akan diarahkan ke WhatsApp tamu untuk mengirim konfirmasi.</p>
            <div class="tamu-delete-name" id="verifikasiTamuName"></div>
            <div class="tamu-delete-actions">
                <button type="button" class="cancel" onclick="closeTamuModal('verifikasiModal')">Batal</button>
                <form id="verifikasiForm" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="confirm" id="verifikasiConfirmBtn">
                        <i class="fas fa-check me-1"></i> Ya, Setujui
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ============================================
     POP-UP: KIRIM KONFIRMASI WA (setelah verifikasi)
     Muncul saat session('wa_konfirmasi') tersedia —
     menyediakan tombol buka WhatsApp (pesan sudah terisi)
     dan tombol lewati.
     ============================================ --}}
@if (session('wa_konfirmasi'))
@php $wa = session('wa_konfirmasi'); @endphp
<div class="tamu-modal-overlay show" id="waKonfirmasiModal">
    <div class="tamu-modal">
        <div class="tamu-delete-dialog">
            <div class="del-icon" style="background:#e7f9ee; color:#16a34a;"><i class="fab fa-whatsapp" style="font-size:1.5rem;"></i></div>
            <h6>Kirim Konfirmasi WhatsApp</h6>
            <p>Berbaskan tamu <b>{{ $wa['nama'] }}</b> ({{ $wa['no_wa'] }}) bahwa kunjungannya
                <b>{{ $wa['status'] }}</b>. WhatsApp akan terbuka dengan pesan yang sudah terisi otomatis —
                cukup tekan <b>Kirim</b>.</p>
            <div class="tamu-delete-actions">
                <button type="button" class="cancel" onclick="closeTamuModal('waKonfirmasiModal')">Lewati</button>
                <a href="{{ $wa['wa_url'] }}" target="_blank" rel="noopener" class="confirm"
                   style="background:#25D366; color:#fff; text-decoration:none; display:inline-flex; align-items:center;"
                   onclick="setTimeout(function(){ closeTamuModal('waKonfirmasiModal'); }, 300);">
                    <i class="fab fa-whatsapp me-1"></i> Buka WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>
@endif
@endcan

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

                {{-- ========== SEKSI 1: DATA DIRI (selaras form registrasi publik) ========== --}}
                <div class="tamu-form-section-head">
                    <span class="tamu-form-section-icon"><i class="fas fa-user"></i></span>
                    <span class="tamu-form-section-title">Data Diri</span>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">NIK / No. KTP <span class="text-danger">*</span></label>
                        <input type="text" name="nik" id="add-nik" inputmode="numeric" maxlength="16" required autocomplete="off"
                               pattern="[0-9]{1,16}"
                               title="NIK hanya boleh berisi angka (maksimal 16 digit)"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16);"
                               onpaste="(function(t){ t.value=t.value.replace(/[^0-9]/g,''); if(t.value.length>16) t.value=t.value.slice(0,16); })(this)"
                               class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}"
                               placeholder="Masukkan 16 digit NIK (angka saja)" style="font-size:0.85rem;">
                        @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" required autocomplete="name" class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}" placeholder="Nama sesuai KTP" style="font-size:0.85rem;">
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Perusahaan / Instansi <span class="text-danger">*</span></label>
                        <input type="text" name="instansi" required autocomplete="organization" class="form-control @error('instansi') is-invalid @enderror"
                               value="{{ old('instansi') }}" placeholder="Nama instansi asal" style="font-size:0.85rem;">
                        @error('instansi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">No. WhatsApp / HP <span class="text-danger">*</span></label>
                        <input type="tel" name="no_hp" required autocomplete="tel" class="form-control @error('no_hp') is-invalid @enderror"
                               value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" style="font-size:0.85rem;">
                        @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" required autocomplete="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" placeholder="nama@email.com" style="font-size:0.85rem;">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- ========== SEKSI 2: BERKAS PENDUKUNG (selaras form registrasi publik) ========== --}}
                <div class="tamu-form-section-head">
                    <span class="tamu-form-section-icon"><i class="fas fa-folder-open"></i></span>
                    <span class="tamu-form-section-title">Berkas Pendukung</span>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Upload Dokumen <small class="text-muted">(opsional, maks 10MB)</small></label>
                        <input type="file" name="dokumen"
                               accept=".zip,.rar,.pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx"
                               class="form-control @error('dokumen') is-invalid @enderror" style="font-size:0.8rem;">
                        <small class="text-muted" style="font-size:0.7rem;">ZIP, RAR, PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG — maksimal 10MB</small>
                        @error('dokumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                        {{-- Custom dropdown divisi — pola sama dengan form registrasi publik --}}
                        <div class="tamu-dd-wrap">
                            <input type="text" id="add-tujuan_ditemui_display" readonly autocomplete="off"
                                   placeholder="— Pilih Divisi —"
                                   class="form-control tamu-dd-input @error('tujuan_ditemui') is-invalid @enderror"
                                   aria-haspopup="listbox">
                            <i class="fas fa-chevron-down tamu-dd-arrow"></i>
                            <div class="tamu-dd-menu" role="listbox">
                                <div class="tamu-dd-options">@include('admin.tamu._divisi-options')</div>
                            </div>
                        </div>
                        <input type="hidden" name="tujuan_ditemui" id="add-tujuan_ditemui" value="{{ old('tujuan_ditemui') }}">
                        @error('tujuan_ditemui')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Tanggal Kunjungan <span class="text-danger">*</span></label>
                        {{-- Dibatasi hari ini ke depan (min = hari ini), ikon kalender
                             bawaan disembunyikan & diganti chevron ala dropdown --}}
                        <div class="tamu-dd-wrap">
                            <input type="date" name="tanggal_kunjungan" id="add-tanggal_kunjungan" required
                                   min="{{ now()->format('Y-m-d') }}"
                                   class="form-control tamu-dd-input @error('tanggal_kunjungan') is-invalid @enderror"
                                   value="{{ \Illuminate\Support\Str::substr((string) old('tanggal_kunjungan', ''), 0, 10) ?: now()->format('Y-m-d') }}"
                                   title="Tanggal kunjungan minimal hari ini" style="font-size:0.85rem;">
                            <i class="fas fa-chevron-down tamu-dd-arrow"></i>
                        </div>
                        <small style="font-size:0.7rem; color:#9ca3af; display:block; margin-top:0.25rem;">Minimal hari ini.</small>
                        @error('tanggal_kunjungan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Jam Kunjungan <span class="text-danger">*</span></label>
                        {{-- Opsi jam dibangun via JS — selaras form registrasi publik:
                             jam istirahat 11:30–13:00 netral, slot ter-approve merah --}}
                        <select name="jam_kunjungan" id="add-jam_kunjungan" required
                                class="form-select @error('jam_kunjungan') is-invalid @enderror" style="font-size:0.85rem;">
                            <option value="">— Pilih Jam —</option>
                        </select>
                        <small id="add-jam-status" class="tamu-jam-status" style="display:none;"></small>
                        @error('jam_kunjungan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Jumlah Tamu <span class="text-danger">*</span></label>
                        <input type="number" name="jumlah_tamu" min="1" max="100" required
                               class="form-control @error('jumlah_tamu') is-invalid @enderror" value="{{ old('jumlah_tamu', 1) }}"
                               style="font-size:0.85rem;">
                        @error('jumlah_tamu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label" style="font-size:0.78rem; font-weight:600; margin-bottom:0;">Maksud &amp; Keperluan Kunjungan <span class="text-danger">*</span></label>
                            <span class="edit-char-counter"><span id="add-keperluan-count">0</span>/2000</span>
                        </div>
                        <textarea name="keperluan" id="add-keperluan" rows="3" required maxlength="2000"
                                  class="form-control @error('keperluan') is-invalid @enderror"
                                  placeholder="Jelaskan singkat maksud dan keperluan kunjungan Anda..." style="font-size:0.85rem;">{{ old('keperluan') }}</textarea>
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
@can('tamu.edit')
<div class="tamu-modal-overlay" id="editModal" onclick="if(event.target===this) closeTamuModal('editModal')">
    <div class="tamu-modal modal-lg">
        <div class="tamu-modal-header">
            <h6><i class="fas fa-user-pen" style="color: var(--pln-blue);"></i> Edit Data Tamu</h6>
            <button type="button" class="tamu-modal-close" onclick="closeTamuModal('editModal')"><i class="fas fa-xmark"></i></button>
        </div>
        <form id="editTamuForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- ID tujuan — dipakai JS untuk membuka ulang modal edit
                 saat validasi server menolak (old input dipertahankan) --}}
            <input type="hidden" name="tamu_id" id="edit-tamu_id" value="">
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
                        <input type="file" name="dokumen" id="edit-dokumen" accept=".zip,.rar,.pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx" class="form-control" style="font-size:0.8rem;"
                               onchange="showEditFileName(this, 'edit-dokumen-filename')">
                        <small class="text-muted" style="font-size:0.7rem;">ZIP, RAR, PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG — maks 10MB; kosongkan jika tidak ingin mengganti.</small>
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
                        {{-- Custom dropdown divisi — pola sama dengan form registrasi publik --}}
                        <div class="tamu-dd-wrap">
                            <input type="text" id="edit-tujuan_ditemui_display" readonly autocomplete="off"
                                   placeholder="— Pilih Divisi —"
                                   class="form-control tamu-dd-input" aria-haspopup="listbox">
                            <i class="fas fa-chevron-down tamu-dd-arrow"></i>
                            <div class="tamu-dd-menu" role="listbox">
                                <div class="tamu-dd-options">@include('admin.tamu._divisi-options')</div>
                            </div>
                        </div>
                        <input type="hidden" name="tujuan_ditemui" id="edit-tujuan_ditemui" value="">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Tanggal Kunjungan <span class="text-danger">*</span></label>
                        {{-- Sama seperti modal Tambah: min hari ini, ikon kalender
                             bawaan disembunyikan (data lama boleh tetap di masa lalu
                             — JS hanya mem-blokir pemilihan baru sebelum hari ini) --}}
                        <div class="tamu-dd-wrap">
                            <input type="date" name="tanggal_kunjungan" id="edit-tanggal_kunjungan" required
                                   class="form-control tamu-dd-input" style="font-size:0.85rem;">
                            <i class="fas fa-chevron-down tamu-dd-arrow"></i>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Jam Kunjungan <span class="text-danger">*</span></label>
                        {{-- Opsi jam dibangun via JS — selaras form registrasi publik --}}
                        <select name="jam_kunjungan" id="edit-jam_kunjungan" required class="form-select" style="font-size:0.85rem;">
                            <option value="">— Pilih Jam —</option>
                        </select>
                        <small id="edit-jam-status" class="tamu-jam-status" style="display:none;"></small>
                    </div>
                    <div class="col-md-4">
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
        console.log('[Modal] openTamuModal dipanggil:', id);
        const el = document.getElementById(id);
        if (!el) {
            console.error('[Modal] Elemen tidak ditemukan:', id);
            alert('[Modal] Elemen ' + id + ' tidak ditemukan!');
            return;
        }
        el.classList.add('show');
        document.body.style.overflow = 'hidden';
        console.log('[Modal] Modal', id, 'dibuka. classList:', el.classList.contains('show'));
    }
    function closeTamuModal(id) {
        document.getElementById(id).classList.remove('show');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            ['dokumenModal', 'detailModal', 'deleteModal', 'verifikasiModal', 'waKonfirmasiModal', 'addModal', 'editModal'].forEach(function (id) {
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
    }    /* ===== Modal Detail ===== */
    var tamuData = @json($tamuData);
    var tamuFullData = @json($tamuFullDataForJs);

    function openDetailModal(id) {
        var t = tamuData[id];
        if (!t) {
            // Fallback: coba dari tamuFullData kalau tamuData tidak ada
            var tf = tamuFullData && tamuFullData.find ? tamuFullData.find(function(item) { return item.id === id; }) : null;
            if (!tf) return;
            t = tf;
        }

        var rows = [
            ['Nama Lengkap', t.nama],
            ['NIK / No. KTP', t.nik],
            t.wa ? ['No. WhatsApp / HP', t.wa] : null,
            t.email ? ['Email', t.email] : null,
            ['Instansi', t.instansi || '-'],
            ['Tujuan Ditemui', t.tujuan],
            ['Jumlah Tamu', (t.jumlah || 1) + ' orang'],
            ['Tanggal Kunjungan', t.tanggal || '-'],
            ['Waktu Pendaftaran', t.daftar || '-'],
            ['Check-In', t.checkin || '-'],
            ['Check-Out', t.checkout || '-'],
            ['Status', t.status || '-'],
        ];

        var html = '<div class="detail-list">';
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
            var namaSafe = String(t.nama || '-').replace(/'/g, "\\'");
            var dokumenUrl = String(t.dokumen).replace(/'/g, "\\'");
            html += '<div style="margin-top:1rem;"><div style="font-size:0.72rem; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.4rem;">Dokumen Pendukung</div>'
                 + '<a href="javascript:void(0)" onclick="openDokumenModal(\'' + dokumenUrl + '\', \'' + namaSafe + '\')" style="display:inline-flex; align-items:center; gap:0.45rem; font-size:0.8rem; font-weight:600; color:#2563eb; background:#eff6ff; border:1px solid #dbeafe; border-radius:9px; padding:0.5rem 0.9rem; text-decoration:none; cursor:pointer;">'
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

    /* ===== Modal Verifikasi (Setuju / Tolak) =====
       Setelah submit, controller mengarahkan kembali dengan flash
       wa_konfirmasi → pop-up "Buka WhatsApp" tampil otomatis. */
    const verifikasiUrlTemplate = '{{ route('admin.tamu.verifikasi', ['tamu' => ':id']) }}';

    function openVerifikasiModal(id, keputusan) {
        const t = tamuData[id];
        if (!t) return;

        const setuju = keputusan === 'setuju';
        const form   = document.getElementById('verifikasiForm');

        form.action = verifikasiUrlTemplate.replace(':id', id);

        /* Hidden input keputusan (setuju / tolak) */
        let keputusanInput = form.querySelector('input[name="keputusan"]');
        if (!keputusanInput) {
            keputusanInput = document.createElement('input');
            keputusanInput.type  = 'hidden';
            keputusanInput.name  = 'keputusan';
            form.appendChild(keputusanInput);
        }
        keputusanInput.value = keputusan;

        /* Sesuaikan ikon, judul & tombol sesuai keputusan */
        const icon = document.getElementById('verifikasiIcon');
        icon.style.background = setuju ? '#dcfce7' : '#fee2e2';
        icon.style.color      = setuju ? '#15803d' : '#dc2626';
        icon.innerHTML        = setuju
            ? '<i class="fas fa-circle-check"></i>'
            : '<i class="fas fa-circle-xmark"></i>';

        document.getElementById('verifikasiTitle').textContent = setuju
            ? 'Setujui Kunjungan?' : 'Tolak Kunjungan?';

        document.getElementById('verifikasiDesc').textContent = setuju
            ? 'Kunjungan tamu ini akan disetujui & slot jadwalnya terkunci. Setelah itu Anda akan diarahkan ke WhatsApp tamu untuk mengirim konfirmasi.'
            : 'Kunjungan tamu ini akan ditolak. Setelah itu Anda akan diarahkan ke WhatsApp tamu untuk memberitahukan penolakan.';

        document.getElementById('verifikasiTamuName').textContent =
            (t.nama || '-') + ' — ' + (t.tanggal || '-');

        const btn = document.getElementById('verifikasiConfirmBtn');
        btn.innerHTML = setuju
            ? '<i class="fas fa-check me-1"></i> Ya, Setujui'
            : '<i class="fas fa-xmark me-1"></i> Ya, Tolak';
        btn.className = 'confirm ' + (setuju ? 'setuju-btn' : 'tolak-btn');

        openTamuModal('verifikasiModal');
    }

    /* ===== Modal Tambah Manual ===== */
    function openAddModal() {
        openTamuModal('addModal');
        refreshJam('add');

        const ta = document.getElementById('add-keperluan');
        const count = document.getElementById('add-keperluan-count');
        if (ta && count) count.textContent = ta.value.length;
    }

    /* ===== Modal Edit Tamu =====
       Mengisi form edit dari payload $tamuData (satu objek per baris
       tabel) lalu menargetkan PUT /admin/tamu/{id}. */
    const editUrlTemplate = '{{ route('admin.tamu.update', ['tamu' => ':id']) }}';

    function openEditModal(t) {
        if (!t || !t.id) {
            console.error('[Edit] Data tamu tidak ditemukan untuk modal edit');
            return;
        }

        const form = document.getElementById('editTamuForm');
        if (!form) return;
        form.action = editUrlTemplate.replace(':id', t.id);

        const idField = document.getElementById('edit-tamu_id');
        if (idField) idField.value = t.id;

        const set = function (id, value) {
            const el = document.getElementById(id);
            if (el) el.value = (value === undefined || value === null) ? '' : value;
        };

        set('edit-nik', t.nik);
        set('edit-nama', t.nama);
        set('edit-instansi', t.instansi);
        set('edit-no_hp', t.no_hp);
        set('edit-email', t.email);
        set('edit-tujuan_ditemui', t.tujuan);
        /* Data lama dengan nama divisi SEBELUM daftar diganti
           (mis. "Assisten Manajer Prod A") tetap tersedia sebagai opsi
           sementara supaya rekornya bisa diedit tanpa kehilangan tujuan. */
        ensureDivisiOption('edit', t.tujuan, ' (data lama)');
        set('edit-tanggal_kunjungan', t.tanggal_input ? t.tanggal_input.slice(0, 10) : '');
        set('edit-jumlah_tamu', t.jumlah || 1);
        set('edit-keperluan', t.keperluan);

        /* Jam kunjungan: pakai waktu rekaman. Bila di luar slot
           operasional (data lama), buildJamOptions() menyediakannya
           sebagai opsi "(waktu lama)" supaya nilainya tidak hilang. */
        const jamLama = t.tanggal_input ? t.tanggal_input.slice(11, 16) : '';
        const jamSel = document.getElementById('edit-jam_kunjungan');
        if (jamSel) {
            // Jam milik rekaman ini — ditandai merah tapi TIDAK dinonaktifkan
            // supaya admin tetap bisa mempertahankan / mengubahnya.
            jamSel.dataset.jamAwal = jamLama || '';
            jamSel.value = jamLama || '';
        }

        /* Reset pilihan berkas baru (jika sebelumnya pernah dipilih) */
        const fileInput = document.getElementById('edit-dokumen');
        if (fileInput) fileInput.value = '';
        const fileNameBox = document.getElementById('edit-dokumen-filename');
        if (fileNameBox) {
            fileNameBox.style.display = 'none';
            fileNameBox.innerHTML = '';
        }

        /* Tampilkan / sembunyikan tautan dokumen saat ini */
        const linkWrap = document.getElementById('edit-dokumen-link');
        const emptyWrap = document.getElementById('edit-dokumen-empty');
        if (t.dokumen) {
            const urlEl = document.getElementById('edit-dokumen-url');
            if (urlEl) urlEl.href = t.dokumen;
            if (linkWrap) linkWrap.classList.remove('hidden');
            if (emptyWrap) emptyWrap.classList.add('hidden');
        } else {
            if (linkWrap) linkWrap.classList.add('hidden');
            if (emptyWrap) emptyWrap.classList.remove('hidden');
        }

        updateEditCounter();
        openTamuModal('editModal');
        refreshJam('edit'); // muat slot terblokir untuk divisi & tanggal ini
    }

    /* Counter karakter Maksud & Keperluan pada modal edit (0/2000) */
    function updateEditCounter() {
        const ta = document.getElementById('edit-keperluan');
        const count = document.getElementById('edit-keperluan-count');
        if (ta && count) count.textContent = ta.value.length;
    }

    (function () {
        const ta = document.getElementById('edit-keperluan');
        if (ta) ta.addEventListener('input', updateEditCounter);
    })();

    /* Preview nama berkas terpilih pada modal edit */
    function showEditFileName(input, targetId) {
        const box = document.getElementById(targetId);
        if (!box) return;

        if (!input.files || !input.files[0]) {
            box.style.display = 'none';
            box.innerHTML = '';
            return;
        }

        const file = input.files[0];
        const size = file.size >= 1024 * 1024
            ? (file.size / (1024 * 1024)).toFixed(2) + ' MB'
            : Math.max(1, Math.round(file.size / 1024)) + ' KB';

        box.innerHTML = '<i class="fas fa-file-lines me-1"></i>' + file.name + ' <small>(' + size + ')</small>';
        box.style.display = 'block';
    }    /* ============================================================
       CUSTOM DROPDOWN DIVISI — modal Tambah & Edit
       Pola & perilaku identik dengan form registrasi publik:
       input readonly + menu absolut berisi opsi div/divisi.
       ============================================================ */
    const SLOT_OPSIONAL = [
        { jam: '08:00', label: '08:00 – 09:00' },
        { jam: '09:00', label: '09:00 – 10:00' },
        { jam: '10:00', label: '10:00 – 11:00' },
        { jam: '11:00', label: '11:00 – 11:30' },
        { jam: '13:00', label: '13:00 – 14:00' },
        { jam: '14:00', label: '14:00 – 15:00' },
        { jam: '15:00', label: '15:00 – 16:00' },
    ];
    const JAM_ISTIRAHAT_AWAL = '11:30';
    const JAM_ISTIRAHAT_AKHIR = '13:00';

    /* Pastikan sebuah nilai divisi punya opsi di menu dropdown.
       Dipakai untuk data lama yang divisi-nya sudah tak ada di daftar.
       Return elemen hidden input yang bersangkutan. */
    function ensureDivisiOption(prefix, value, suffix) {
        const hidden = document.getElementById(prefix + '-tujuan_ditemui');
        const display = document.getElementById(prefix + '-tujuan_ditemui_display');
        if (!hidden || !display || !value) return;

        const menu = hidden.closest('.tamu-dd-wrap').querySelector('.tamu-dd-options');
        const ada = menu && Array.prototype.some.call(menu.querySelectorAll('.dropdown-option'), function (o) {
            return o.getAttribute('data-value') === value;
        });
        if (!ada && menu) {
            const opt = document.createElement('div');
            opt.className = 'dropdown-option';
            opt.setAttribute('data-value', value);
            opt.textContent = value + (suffix || '');
            menu.appendChild(opt);
        }
        display.value = value + (suffix && !ada ? suffix : '');
    }

    function initDivisiDropdown(prefix) {
        const wrap = document.getElementById(prefix + '-tujuan_ditemui_display');
        if (!wrap) return;
        const display = wrap;
        const hidden = document.getElementById(prefix + '-tujuan_ditemui');
        const container = display.closest('.tamu-dd-wrap');
        const menu = container.querySelector('.tamu-dd-menu');
        const options = container.querySelector('.tamu-dd-options');

        let isOpen = false;

        function openMenu() { isOpen = true; menu.classList.add('open'); container.classList.add('dropdown-open'); }
        function closeMenu() { isOpen = false; menu.classList.remove('open'); container.classList.remove('dropdown-open'); }

        function select(opt) {
            options.querySelectorAll('.dropdown-option').forEach(function (o) { o.classList.remove('selected'); });
            opt.classList.add('selected');
            display.value = opt.textContent.trim();
            hidden.value = opt.getAttribute('data-value') || '';
            closeMenu();
            hidden.dispatchEvent(new Event('change', { bubbles: true }));
        }

        display.addEventListener('click', function (e) {
            e.stopPropagation();
            // Tutup dropdown divisi lain dulu supaya tidak tumpuk
            ['add', 'edit'].forEach(function (p) {
                if (p !== prefix) closeDivisiDropdown(p);
            });
            isOpen ? closeMenu() : openMenu();
        });
        options.addEventListener('click', function (e) {
            const opt = e.target.closest('.dropdown-option');
            if (opt) select(opt);
        });
        document.addEventListener('click', function (e) {
            if (!container.contains(e.target)) closeMenu();
        });
        display.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') { closeMenu(); display.blur(); }
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); isOpen ? closeMenu() : openMenu(); }
        });

        container.__close = closeMenu;
    }

    function closeDivisiDropdown(prefix) {
        const display = document.getElementById(prefix + '-tujuan_ditemui_display');
        const container = display && display.closest('.tamu-dd-wrap');
        if (container && container.__close) container.__close();
    }

    /* Sinkron tampilan display + opsi terpilih dari nilai hidden
       (dipakai modal edit & restore old input). */
    function syncDivisiDisplay(prefix) {
        const hidden = document.getElementById(prefix + '-tujuan_ditemui');
        const display = document.getElementById(prefix + '-tujuan_ditemui_display');
        if (!hidden || !display) return;
        const val = hidden.value;
        const container = display.closest('.tamu-dd-wrap');
        const options = container.querySelector('.tamu-dd-options');
        options.querySelectorAll('.dropdown-option').forEach(function (o) {
            o.classList.toggle('selected', o.getAttribute('data-value') === val && val !== '');
        });
        const match = options.querySelector('.dropdown-option[data-value="' + val + '"]');
        display.value = (val && match) ? match.textContent.trim() : val;
    }

    initDivisiDropdown('add');
    initDivisiDropdown('edit');

    /* ============================================================
       TANGGAL KUNJUNGAN — blokir tanggal yang sudah lewat
       Selaras form registrasi publik: min = hari ini (lokal browser),
       diperbarui tiap menit; klik field/panah membuka kalender.
       ============================================================ */
    (function () {
        function todayLocal() {
            const d = new Date();
            const mm = String(d.getMonth() + 1).padStart(2, '0');
            const dd = String(d.getDate()).padStart(2, '0');
            return d.getFullYear() + '-' + mm + '-' + dd;
        }

        ['add', 'edit'].forEach(function (prefix) {
            const tanggal = document.getElementById(prefix + '-tanggal_kunjungan');
            if (!tanggal) return;

            function batasiTanggal() {
                const min = todayLocal();
                // Modal edit: data lama boleh bertanggal lampau — nilai awal
                // tidak dipaksa berubah; hanya pemilihan BARU yang dibatasi.
                if (!tanggal.dataset.touched && !tanggal.value) tanggal.value = min;
                if (prefix === 'add') tanggal.min = min;
                if (prefix === 'edit') tanggal.min = '';
            }

            batasiTanggal();
            setInterval(batasiTanggal, 60000);

            tanggal.addEventListener('click', function () {
                if (typeof tanggal.showPicker === 'function') {
                    try { tanggal.showPicker(); } catch (e) { /* dibuka browser via klik biasa */ }
                }
            });

            tanggal.addEventListener('change', function () {
                tanggal.dataset.touched = '1';
                if (prefix === 'add') {
                    const min = tanggal.min || todayLocal();
                    if (tanggal.value && tanggal.value < min) {
                        tanggal.setCustomValidity('Tanggal kunjungan tidak boleh di masa lalu (minimal hari ini).');
                        try { tanggal.reportValidity(); } catch (e) {}
                    } else {
                        tanggal.setCustomValidity('');
                    }
                }
            });
        });
    })();

    /* ============================================================
       SLOT JAM KUNJUNGAN — modal Tambah & Edit
       Selaras form registrasi publik: opsi jam dibangun via JS.
       Slot yang sudah DISETUJUI admin untuk divisi + tanggal sama
       ditandai MERAH dan tidak bisa dipilih (data dari
       /api/booked-slots); jam istirahat 11:30–13:00 netral.
       ============================================================ */
    const bookedSlotsUrl = '{{ route('layanan.registrasi-tamu.booked-slots') }}';

    function setJamStatus(el, text, kind) {
        if (!el) return;
        el.style.display = text ? 'block' : 'none';
        el.textContent = text || '';
        el.className = 'tamu-jam-status' + (kind ? ' ' + kind : '');
    }

    function jamContext(prefix) {
        return {
            jam:     document.getElementById(prefix + '-jam_kunjungan'),
            tanggal: document.getElementById(prefix + '-tanggal_kunjungan'),
            divisi:  document.getElementById(prefix + '-tujuan_ditemui'),
            status:  document.getElementById(prefix + '-jam-status'),
        };
    }

    /* Bangun ulang opsi <select> jam — struktur & penandaan identik
       dengan buildJamOptions() di form registrasi publik. */
    function buildJamOptions(prefix, blocked) {
        const c = jamContext(prefix);
        if (!c.jam) return;

        // Pertahankan pilihan user bila masih valid (tidak disabled),
        // supaya ganti tanggal/divisi tidak menghapus pilihan jamnya.
        const previous = c.jam.value;
        const jamAwal = prefix === 'edit' ? (c.jam.dataset.jamAwal || '') : '';

        c.jam.innerHTML = '<option value="">— Pilih Jam —</option>';

        SLOT_OPSIONAL.forEach(function (opt) {
            const val = opt.jam;
            let disabled = false;
            let label = opt.label;
            let isBlocked = false;

            if (val >= JAM_ISTIRAHAT_AWAL && val < JAM_ISTIRAHAT_AKHIR) {
                disabled = true;
                label = opt.label + ' (Jam Istirahat)';
            }

            if (blocked.indexOf(val) !== -1) {
                disabled = true;
                isBlocked = true;
                label = opt.label + ' (Terblokir)';
                // Jam milik rekaman yang sedang diedit: merah sebagai
                // penanda, tapi tetap aktif agar nilainya tidak hilang
                // (server mengecualikan rekaman ini saat validasi).
                if (jamAwal && val === jamAwal) disabled = false;
            }

            const option = document.createElement('option');
            option.value = val;
            option.textContent = label;
            if (isBlocked) {
                option.classList.add('slot-penuh');
                option.title = 'Jam ini sudah di-approve admin dan tidak dapat dipilih.';
            }
            if (disabled) option.disabled = true;

            c.jam.appendChild(option);
        });

        // Data lama di luar slot operasional tetap tersedia sebagai opsi
        // "(waktu lama)" supaya nilainya tidak hilang saat disimpan ulang.
        const kandidat = previous || jamAwal;
        let found = kandidat ? c.jam.querySelector('option[value="' + kandidat + '"]') : null;
        if (!found && kandidat && (previous || jamAwal)) {
            const opt = document.createElement('option');
            opt.value = kandidat;
            opt.textContent = kandidat + ' (waktu lama)';
            opt.disabled = false;
            c.jam.appendChild(opt);
            found = opt;
        }
        if (found && !found.disabled) {
            c.jam.value = kandidat;
        } else {
            c.jam.value = '';
        }
    }

    const jamLoading = { add: false, edit: false };
    const jamRefreshDirty = { add: false, edit: false };

    function refreshJam(prefix) {
        const c = jamContext(prefix);
        if (!c.jam || !c.tanggal || !c.divisi) return;

        const tanggal = c.tanggal.value;
        const divisi = c.divisi.value;

        if (!tanggal || !divisi) {
            buildJamOptions(prefix, []);
            setJamStatus(c.status, 'Pilih divisi & tanggal untuk melihat ketersediaan jam');
            return;
        }

        // Ada request lain masih berjalan — jangan dibuang,
        // tandai saja supaya diulang otomatis setelah selesai.
        if (jamLoading[prefix]) {
            jamRefreshDirty[prefix] = true;
            return;
        }
        jamLoading[prefix] = true;

        setJamStatus(c.status, 'Memuat ketersediaan jam...');

        /* Modal Edit: blokir hanya SATU jam (jam booking itu sendiri),
           bukan rentang 3 jam seperti form publik & modal Tambah —
           supaya admin bebas mengubah jam ke slot lain. */
        const qs = '?tanggal=' + encodeURIComponent(tanggal)
                 + '&divisi=' + encodeURIComponent(divisi)
                 + (prefix === 'edit' ? '&durasi=1' : '');

        fetch(bookedSlotsUrl + qs)
            .then(function (r) { return r.json(); })
            .then(function (data) {
                jamLoading[prefix] = false;
                if (jamRefreshDirty[prefix]) {
                    jamRefreshDirty[prefix] = false;
                    refreshJam(prefix); // parameternya sudah berubah — muat ulang
                    return;
                }
                const blocked = Array.isArray(data.jam_terblokir) ? data.jam_terblokir : [];
                buildJamOptions(prefix, blocked);

                setJamStatus(
                    c.status,
                    blocked.length ? '\u26A0 Jam terblokir: ' + blocked.join(', ') : '\u2713 Semua slot tersedia',
                    blocked.length ? 'blocked' : 'ok'
                );
            })
            .catch(function () {
                jamLoading[prefix] = false;
                if (jamRefreshDirty[prefix]) {
                    jamRefreshDirty[prefix] = false;
                    refreshJam(prefix);
                    return;
                }
                setJamStatus(c.status, 'Gagal memuat ketersediaan jam', 'blocked');
            });
    }

    (function () {
        ['add', 'edit'].forEach(function (prefix) {
            const c = jamContext(prefix);
            if (!c.jam || !c.tanggal || !c.divisi) return;

            c.tanggal.addEventListener('change', function () { refreshJam(prefix); });
            c.divisi.addEventListener('change', function () { refreshJam(prefix); });
            c.jam.addEventListener('change', function () {
                // Guard: slot terblokir/istirahat tidak boleh tersimpan
                const opt = c.jam.selectedOptions && c.jam.selectedOptions[0];
                if (opt && opt.disabled) c.jam.value = '';
            });
        });
    })();

    /* ============================================================
       Buka kembali modal setelah server MENOLAK isian
       (old input dipertahankan Laravel) supaya admin tidak perlu
       mengisi ulang dari nol.
       ============================================================ */
    (function () {
        const hasError = {{ $errors->any() ? 'true' : 'false' }};
        if (!hasError) return;

        const oldInput = @json(old());
        if (!oldInput || !oldInput.nik) return;

        const set = function (id, value) {
            const el = document.getElementById(id);
            if (el && value !== undefined && value !== null) el.value = value;
        };

        if (oldInput.tamu_id && typeof tamuData !== 'undefined' && tamuData[oldInput.tamu_id]) {
            /* Form Edit — isi dengan data asli (termasuk tautan dokumen),
               lalu timpa pakai isian yang tadi ditolak. */
            openEditModal(tamuData[oldInput.tamu_id]);

            set('edit-nik', oldInput.nik);
            set('edit-nama', oldInput.nama);
            set('edit-instansi', oldInput.instansi);
            set('edit-no_hp', oldInput.no_hp);
            set('edit-email', oldInput.email);
            set('edit-tujuan_ditemui', oldInput.tujuan_ditemui);
            ensureDivisiOption('edit', oldInput.tujuan_ditemui, '');
            syncDivisiDisplay('edit');
            set('edit-tanggal_kunjungan', String(oldInput.tanggal_kunjungan || '').slice(0, 10));
            set('edit-jumlah_tamu', oldInput.jumlah_tamu);
            set('edit-keperluan', oldInput.keperluan);

            /* Jam pilihan user yang ditolak server tetap tersedia —
               buildJamOptions() menyisipkannya sebagai "(waktu lama)"
               bila di luar slot operasional. */
            const jamSel = document.getElementById('edit-jam_kunjungan');
            const jamBaru = oldInput.jam_kunjungan || '';
            if (jamSel) {
                jamSel.dataset.jamAwal = jamBaru;
                jamSel.value = jamBaru;
            }

            updateEditCounter();
            refreshJam('edit');
        } else if (document.getElementById('addModal')) {
            /* Form Tambah Manual — isian sudah terisi old() di markup;
               dropdown divisi & jam disinkronkan dari old input. */
            openAddModal();
            const addHidden = document.getElementById('add-tujuan_ditemui');
            if (addHidden && addHidden.value) {
                ensureDivisiOption('add', addHidden.value, '');
                syncDivisiDisplay('add');
            }
        }
    })();

    /* ===== Helper: Dapatkan data tamu lengkap ===== */
    function getTamuData(id) {
        if (!tamuFullData) return null;
        return tamuFullData.find(item => item.id === id);
    }

</script>
@endpush
@endsection
