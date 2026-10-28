@extends('layouts.karyawan')

@section('title', 'Data Tamu — Portal Karyawan')

@push('styles')
<style>
    /* ============================================
       DATA TAMU — PORTAL KARYAWAN
       Struktur selaras resources/views/admin/tamu/index
       (header + stats, filter bar, tabel, print bar,
       pagination) dengan WARNA tema portal:
         --kry-teal / --kry-teal-dark menggantikan
         --pln-blue / --pln-cyan admin.
       Tombol & pagination memakai kelas global
       karyawan.css (btn-corp*, page-pagination).
       ============================================ */

    .tamu-page-header {
        background: var(--kry-card);
        border: 1px solid var(--kry-line);
        border-radius: var(--kry-radius);
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
        font-weight: 800;
        color: var(--kry-teal-deep);
        margin: 0 0 0.2rem;
    }
    .tamu-page-header .header-left p {
        font-size: 0.8rem;
        color: var(--kry-muted);
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
        background: var(--kry-bg);
        border: 1px solid var(--kry-line);
        border-radius: 12px;
        padding: 0.9rem 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.85rem;
        transition: border-color 0.2s ease;
    }
    .tamu-stat-card:hover { border-color: var(--kry-teal); }
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
    .tamu-stat-card .stat-icon.blue  { background: linear-gradient(135deg, var(--kry-teal), var(--kry-teal-dark)); }
    .tamu-stat-card .stat-icon.green { background: linear-gradient(135deg, #22c55e, #16a34a); }
    .tamu-stat-card .stat-icon.amber { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .tamu-stat-card .stat-label {
        font-size: 0.72rem;
        font-weight: 600;
        color: var(--kry-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .tamu-stat-card .stat-value {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--kry-teal-deep);
        line-height: 1.1;
    }

    /* Filter Bar */
    .tamu-filter-bar {
        background: var(--kry-card);
        border: 1px solid var(--kry-line);
        border-radius: var(--kry-radius);
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
        color: var(--kry-muted);
        font-size: 0.82rem;
        pointer-events: none;
    }
    .tamu-filter-bar input,
    .tamu-filter-bar select {
        border: 1px solid var(--kry-line);
        border-radius: 10px;
        padding: 0.55rem 0.9rem;
        font-size: 0.85rem;
        background: var(--kry-bg);
        color: var(--kry-text);
        font-family: inherit;
        transition: all 0.2s ease;
    }
    .tamu-filter-bar .search-wrapper input {
        width: 100%;
        padding-left: 2.4rem;
    }
    .tamu-filter-bar input:focus,
    .tamu-filter-bar select:focus {
        border-color: var(--kry-teal);
        box-shadow: 0 0 0 3px rgba(0, 143, 168, 0.12);
        background: #fff;
        outline: none;
    }
    .filter-divider {
        width: 1px;
        height: 26px;
        background: var(--kry-line);
        flex-shrink: 0;
    }
    .filter-count {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--kry-muted);
        white-space: nowrap;
    }

    /* Table */
    .tamu-table-wrap {
        background: var(--kry-card);
        border: 1px solid var(--kry-line);
        border-radius: var(--kry-radius);
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
        color: var(--kry-muted);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        border-bottom: 2px solid var(--kry-line);
        white-space: nowrap;
        background: var(--kry-bg);
        vertical-align: middle;
    }
    .tamu-table thead th.text-right { text-align: right; }
    .tamu-table thead th.text-center { text-align: center; }

    .tamu-table th.col-no        { width: 215px; }
    .tamu-table th.col-identitas { width: 17%; min-width: 170px; }
    .tamu-table th.col-instansi  { width: 13%; min-width: 120px; }
    .tamu-table th.col-email     { width: 15%; min-width: 140px; }
    .tamu-table th.col-tujuan    { width: 18%; min-width: 150px; }
    .tamu-table th.col-doc       { width: 92px; }
    .tamu-table th.col-status    { width: 118px; }
    .tamu-table th.col-aksi      { width: 178px; }

    .tamu-table tbody td {
        padding: 0.75rem 0.9rem;
        border-bottom: 1px solid #f1f4f9;
        vertical-align: middle;
        font-size: 0.83rem;
        line-height: 1.45;
        color: var(--kry-text);
    }
    .tamu-table td.text-center { text-align: center; }
    .tamu-table tbody tr:last-child td { border-bottom: none; }
    .tamu-table tbody tr { transition: background 0.15s ease, box-shadow 0.15s ease; }
    .tamu-table tbody tr:nth-child(even) { background: #fafbfd; }
    .tamu-table tbody tr:hover {
        background: var(--kry-teal-soft);
        box-shadow: inset 3px 0 0 var(--kry-teal);
    }

    /* ===== Kolom Waktu Daftar: nomor + tanggal/jam bertumpuk ===== */
    .tamu-waktu-row { display: flex; align-items: center; gap: 0.65rem; }
    .tamu-no-badge {
        min-width: 30px;
        height: 30px;
        padding: 0 6px;
        border-radius: 9px;
        background: var(--kry-teal-soft);
        color: var(--kry-teal-dark);
        font-size: 0.72rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .tamu-waktu { font-size: 0.78rem; white-space: nowrap; line-height: 1.45; }
    .tamu-waktu-meta {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.25rem;
    }
    .waktu-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.16rem 0.5rem;
        border-radius: 8px;
        background: var(--kry-bg);
        border: 1px solid var(--kry-line);
        font-size: 0.71rem;
        color: var(--kry-text);
        white-space: nowrap;
        font-variant-numeric: tabular-nums;
    }
    .waktu-pill i { font-size: 0.64rem; color: var(--kry-muted); width: 13px; text-align: center; }
    .waktu-pill .pill-jam { font-weight: 600; color: var(--kry-teal-deep); }
    .waktu-pill .pill-sep { color: var(--kry-line); }
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

    .tamu-nama { font-weight: 700; color: var(--kry-teal-deep); }
    .tamu-nik  { font-size: 0.74rem; color: var(--kry-muted); font-family: monospace; letter-spacing: 0.4px; }
    .tamu-hp   { font-size: 0.75rem; color: var(--kry-muted); margin-top: 0.1rem; }

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
        color: var(--kry-teal);
        font-size: 0.78rem;
        text-decoration: none;
        max-width: 170px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: color 0.15s ease;
    }
    .mailto-link:hover { color: var(--kry-teal-dark); text-decoration: underline; }
    .mailto-link i { color: var(--kry-muted); font-size: 0.75rem; }

    .email-empty { color: var(--kry-line); font-size: 0.8rem; }

    /* Baris tujuan terstruktur: Bidang (utama) -> Jabatan -> Orang,
        selaras dengan panel admin. */
    .tamu-tujuan .tujuan-line {
        display: flex;
        align-items: center;
        gap: 0.45rem;
        max-width: 240px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .tamu-tujuan .tujuan-line i {
        font-size: 0.72rem;
        flex-shrink: 0;
        width: 1rem;
        text-align: center;
        color: var(--kry-teal);
    }
    .tamu-tujuan .tujuan-line span {
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .tamu-tujuan .tujuan-bidang  { font-weight: 600; font-size: 0.82rem; color: inherit; }
    .tamu-tujuan .tujuan-jabatan  { font-size: 0.76rem; color: var(--kry-muted); }
    .tamu-tujuan .tujuan-orang    { font-size: 0.76rem; color: var(--kry-muted); }
    .tamu-tujuan .tujuan-keperluan {
        margin-top: 0.25rem;
        padding-left: 1.45rem;
        font-size: 0.72rem;
        color: var(--kry-muted);
        display: block;
        max-width: 240px;
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

    /* Chip dokumen pendukung */
    .doc-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        max-width: 190px;
        padding: 0.35rem 0.7rem;
        border-radius: 8px;
        background: var(--kry-teal-soft);
        border: 1px solid #bfe3ea;
        color: var(--kry-teal-dark);
        font-size: 0.72rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.15s ease, border-color 0.15s ease;
    }
    .doc-chip i { color: #dc2626; }
    .doc-chip:hover { background: #d3ecef; border-color: var(--kry-teal); color: var(--kry-teal-deep); }
    .doc-empty {
        width: 56px;
        height: 34px;
        border-radius: 8px;
        border: 1px dashed var(--kry-line);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--kry-muted);
        font-size: 0.7rem;
        margin: 0 auto;
    }
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
    .tamu-badge.berkunjung { background: var(--kry-teal-soft); color: var(--kry-teal-dark); }
    .tamu-badge.disetujui { background: #dcfce7; color: #15803d; }
    .tamu-badge.ditolak   { background: #fee2e2; color: #dc2626; }
    .tamu-badge.selesai    { background: #f1f5f9; color: #64748b; }

    /* Log verifikasi — pengganti tombol Setujui/Tolak setelah kunjungan
       diproses pihak pertama (Admin ATAU karyawan yang ditemui). */
    .tamu-verify-log {
        display: block;
        max-width: 250px;
        margin: 0.35rem auto 0;
        padding: 0.3rem 0.5rem;
        font-size: 0.67rem;
        font-weight: 500;
        line-height: 1.45;
        text-align: left;
        white-space: normal;
        color: var(--kry-muted);
        background: var(--kry-bg);
        border: 1px dashed var(--kry-line);
        border-radius: 8px;
    }
    .tamu-verify-log strong { color: var(--kry-teal-deep); font-weight: 700; }

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
    .tamu-action-btn.detail   { background: var(--kry-teal-soft); color: var(--kry-teal-dark); }
    .tamu-action-btn.detail:hover { background: #d3ecef; }
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
        background: var(--kry-teal-soft);
        color: var(--kry-teal);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 1rem;
    }
    .tamu-empty h6 { font-weight: 700; color: var(--kry-teal-deep); margin-bottom: 0.3rem; }
    .tamu-empty p { font-size: 0.82rem; color: var(--kry-muted); margin: 0; }

    /* ===== Modal (overlay, sama dengan modal Berita admin) ===== */
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
        background: #fff;
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
        border-bottom: 1px solid var(--kry-line);
    }
    .tamu-modal-header h6 {
        font-weight: 700;
        font-size: 0.92rem;
        color: var(--kry-teal-deep);
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

    /* ===== Form sections dalam modal ===== */
    .tamu-form-section-head {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 1.1rem 0 0.9rem;
        padding: 0.45rem 0.75rem;
        background: var(--kry-bg);
        border: 1px solid var(--kry-line);
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
        background: var(--kry-teal);
        color: #fff;
        font-size: 0.68rem;
    }
    .tamu-form-section-title {
        font-weight: 700;
        font-size: 0.78rem;
        color: var(--kry-teal-deep);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .tamu-modal-body .form-label { color: var(--kry-text); }
    .tamu-modal-body .form-control,
    .tamu-modal-body .form-select {
        background: #fff;
        border: 1px solid var(--kry-line);
        color: var(--kry-text);
        border-radius: 10px;
    }
    .tamu-modal-body .form-control:focus,
    .tamu-modal-body .form-select:focus {
        border-color: var(--kry-teal);
        box-shadow: 0 0 0 3px rgba(0, 143, 168, 0.12);
    }
    .edit-char-counter {
        font-size: 0.7rem;
        color: var(--kry-muted);
        font-variant-numeric: tabular-nums;
    }
    .edit-required-note {
        margin: 0;
        font-size: 0.72rem;
        color: var(--kry-muted);
    }
    .edit-file-selected {
        margin-top: 0.4rem;
        font-size: 0.72rem;
        color: var(--kry-teal-dark);
        background: var(--kry-teal-soft);
        border: 1px solid #bfe3ea;
        border-radius: 8px;
        padding: 0.35rem 0.6rem;
        word-break: break-all;
    }
    .tamu-jam-status {
        display: block;
        font-size: 0.7rem;
        margin-top: 0.28rem;
        color: var(--kry-muted);
    }
    .tamu-jam-status.blocked { color: #dc2626; font-weight: 600; }
    .tamu-jam-status.ok { color: #16a34a; }
    .hidden { display: none !important; }

    /* Custom dropdown divisi (pola form registrasi publik) */
    .tamu-dd-wrap { position: relative; }
    .tamu-dd-input {
        cursor: pointer;
        padding-right: 1.6rem;
        background-clip: padding-box;
    }
    .tamu-dd-input[readonly] { background: #fff; }
    .tamu-dd-input.dropdown-open {
        border-color: var(--kry-teal);
        box-shadow: 0 0 0 3px rgba(0, 143, 168, 0.12);
    }
    .tamu-dd-arrow {
        position: absolute;
        right: 0.6rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--kry-muted);
        pointer-events: none;
        transition: transform 0.18s ease, color 0.18s ease;
        z-index: 1;
        font-size: 0.75rem;
    }
    .tamu-dd-input:focus ~ .tamu-dd-arrow,
    .tamu-dd-wrap.dropdown-open .tamu-dd-arrow {
        transform: translateY(-50%) rotate(180deg);
        color: var(--kry-teal);
    }
    .tamu-dd-menu {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        z-index: 1100;
        background: #fff;
        border: 1px solid var(--kry-line);
        border-radius: 10px;
        box-shadow: 0 10px 26px rgba(0,0,0,0.09);
        max-height: 210px;
        overflow-y: auto;
        padding: 0.2rem 0;
        display: none;
        scrollbar-width: thin;
        scrollbar-color: var(--kry-line) transparent;
    }
    .tamu-dd-menu.open { display: block; }
    .tamu-dd-menu::-webkit-scrollbar { width: 4px; }
    .tamu-dd-menu::-webkit-scrollbar-track { background: transparent; }
    .tamu-dd-menu::-webkit-scrollbar-thumb { background: var(--kry-line); border-radius: 8px; }
    .tamu-dd-menu .dropdown-optgroup {
        padding: 0.3rem 0.7rem 0.2rem;
        font-weight: 600;
        font-size: 0.62rem;
        color: var(--kry-muted);
        text-transform: uppercase;
        letter-spacing: 0.04em;
        background: var(--kry-bg);
        border-bottom: 1px solid var(--kry-line);
        margin: 0.12rem 0 0.04rem;
        border-radius: 5px;
        position: sticky;
        top: 0;
    }
    /* Indentasi hierarki opsi bidang: root tanpa indent, child agak
       masuk, grandchild lebih masuk — via padding (klik & teks tersimpan
       tetap bersih, tanpa entitas &nbsp; yang bisa bocor ke input). */
    .tamu-dd-menu .dropdown-option.dd-depth-1 { padding-left: 1.6rem; }
    .tamu-dd-menu .dropdown-option.dd-depth-2 { padding-left: 2.2rem; }

    /* Placeholder di baris pertama: tanpa titik, selalu netral. */
    .tamu-dd-menu .dropdown-option[data-value=""] { color: #94a3b8; font-style: italic; }
    .tamu-dd-menu .dropdown-option[data-value=""]::before { display: none; }
    .tamu-dd-menu .dropdown-option[data-value=""]::after { content: none; }
    .tamu-dd-menu .dropdown-option[data-value=""]:hover { background: transparent; }

    /* Placeholder dropdown jabatan (tanpa pilihan bidang) */
    .tamu-dd-menu .dropdown-jabatan-placeholder { cursor: default; }

    .tamu-dd-menu .dropdown-option {
        padding: 0.38rem 0.7rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.78rem;
        color: var(--kry-text);
        transition: all 0.14s ease;
        border-radius: 6px;
        margin: 0.02rem 0.15rem;
    }
    .tamu-dd-menu .dropdown-option:hover { background: rgba(0, 143, 168, 0.06); }
    .tamu-dd-menu .dropdown-option.selected { background: rgba(0, 143, 168, 0.1); color: var(--kry-teal); font-weight: 600; }
    .tamu-dd-menu .dropdown-option::before {
        content: '';
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: var(--kry-line);
        flex-shrink: 0;
    }
    .tamu-dd-menu .dropdown-option.selected::before { background: var(--kry-teal); }

    /* Input tanggal: sembunyikan ikon kalender bawaan browser */
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

    /* Slot jam kunjungan dalam <select> jam */
    .tamu-modal select option:disabled { color: var(--kry-muted) !important; background: #f1f5f9 !important; }
    .tamu-modal select option.slot-penuh {
        color: #dc2626 !important;
        background: #fef2f2 !important;
        font-weight: 600;
    }

    /* Detail rows */
    .detail-list { display: grid; gap: 0; }
    .detail-row {
        display: grid;
        grid-template-columns: 140px 1fr;
        gap: 0.75rem;
        padding: 0.55rem 0;
        border-bottom: 1px dashed var(--kry-line);
        font-size: 0.83rem;
    }
    .detail-row:last-child { border-bottom: none; }
    .detail-row dt { color: var(--kry-muted); font-weight: 600; }
    .detail-row dd { margin: 0; color: var(--kry-teal-deep); font-weight: 500; word-break: break-word; }

    /* Dialog konfirmasi (hapus / verifikasi / WA) */
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
    .tamu-delete-dialog h6 { font-weight: 700; color: var(--kry-text); margin-bottom: 0.3rem; }
    .tamu-delete-dialog p { font-size: 0.82rem; color: var(--kry-muted); margin-bottom: 0.6rem; }
    .tamu-delete-name {
        background: var(--kry-bg);
        border: 1px solid var(--kry-line);
        border-radius: 8px;
        padding: 0.5rem 0.8rem;
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 1.1rem;
    }
    .tamu-delete-actions { display: flex; gap: 0.6rem; justify-content: center; }
    .tamu-delete-actions button,
    .tamu-delete-actions a {
        border: none;
        border-radius: 9px;
        padding: 0.55rem 1.2rem;
        font-size: 0.83rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.15s ease;
        align-items: center;
        justify-content: center;
    }
    .tamu-delete-actions .cancel { background: #f1f5f9; color: #475569; }
    .tamu-delete-actions .cancel:hover { background: #e2e8f0; }
    .tamu-delete-actions .confirm { background: #dc2626; color: #fff; }
    .tamu-delete-actions .confirm:hover { background: #b91c1c; }
    .tamu-delete-actions .confirm.tolak-btn { background: #dc2626; }
    .tamu-delete-actions .confirm.tolak-btn:hover { background: #b91c1c; }
    .tamu-delete-actions .confirm.setuju-btn { background: #15803d; }
    .tamu-delete-actions .confirm.setuju-btn:hover { background: #166534; }

    /* ---------- Print bar ---------- */
    .tamu-print-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 1.1rem;
        padding: 0.9rem 1.1rem;
        background: var(--kry-card);
        border: 1px solid var(--kry-line);
        border-radius: 12px;
    }
    .tamu-print-bar .print-info {
        font-size: 0.78rem;
        color: var(--kry-muted);
        display: flex;
        align-items: center;
        gap: 0.45rem;
    }
    .tamu-print-bar .print-info i { color: var(--kry-teal); }
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
     PAGE HEADER + STATS
     ============================================ --}}
<div class="tamu-page-header">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-id-card" style="color: var(--kry-teal); margin-right: 0.5rem;"></i>Data Tamu</h5>
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

@if (session('error'))
    <div class="kry-alert" style="background:#fef2f2; border:1px solid #fecaca; color:#dc2626;" role="status">
        <i class="fas fa-circle-exclamation"></i> {{ session('error') }}
    </div>
@endif
@if ($errors->any())
    <div class="kry-alert" style="background:#fef2f2; border:1px solid #fecaca; color:#dc2626;" role="status">
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

{{-- ============================================
     FILTER BAR
     ============================================ --}}
<form class="tamu-filter-bar" method="GET" action="{{ route('karyawan.tamu.index') }}">
    <div class="search-wrapper">
        <i class="fas fa-search"></i>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, instansi, atau NIK...">
    </div>
    <div class="filter-divider"></div>
    <input type="date" name="dari" value="{{ request('dari') }}" title="Tanggal kunjungan dari" style="font-size:0.82rem;">
    <span style="color:var(--kry-muted); font-size:0.75rem;">s/d</span>
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
        <a href="{{ route('karyawan.tamu.index') }}" class="btn-corp btn-corp-soft" style="padding:0.5rem 1rem; font-size:0.8rem;">
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
                <th class="col-tujuan">Bidang / Jabatan / Orang yang Ditemui</th>
                <th class="col-doc text-center">Dokumen</th>
                <th class="col-status text-center">Status</th>
                <th class="col-aksi text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tamus as $tamu)
            <tr data-tamu-id="{{ $tamu->id }}">
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
                    {{-- Tujuan kunjungan terstruktur: Bidang -> Jabatan -> Orang --}}
                    <div class="tujuan-line tujuan-bidang" title="Bidang yang ditemui">
                        <i class="fas fa-sitemap"></i><span>{{ $tamu->tujuan_ditemui }}</span>
                    </div>
                    @if ($tamu->jabatan_ditemui)
                        <div class="tujuan-line tujuan-jabatan" title="Jabatan yang ditemui">
                            <i class="fas fa-id-badge"></i><span>{{ $tamu->jabatan_ditemui }}</span>
                        </div>
                    @endif
                    @if ($tamu->orang_ditemui)
                        <div class="tujuan-line tujuan-orang" title="Orang yang ditemui">
                            <i class="fas fa-user-tie"></i><span>{{ $tamu->orang_ditemui }}</span>
                        </div>
                    @endif
                    <span class="tujuan-keperluan" title="{{ $tamu->keperluan }}">{{ $tamu->keperluan }}</span>
                </td>
                <td class="text-center">
                    @if ($tamu->hasDokumen())
                        <a href="{{ $tamu->dokumen_zip_url_karyawan }}" target="_blank" rel="noopener"
                           class="doc-chip" title="Buka / unduh dokumen pendukung {{ $tamu->nama }}">
                            <i class="fas fa-paperclip"></i>
                            Dokumen
                        </a>
                    @else
                        <div class="doc-empty" title="Tidak ada lampiran"><i class="fas fa-paperclip"></i></div>
                    @endif
                </td>
                <td class="text-center">
                    @if ($tamu->status_verifikasi === \App\Models\Tamu::STATUS_DITOLAK)
                        <span class="tamu-badge ditolak" title="Kunjungan ditolak"><i class="fas fa-circle"></i> Ditolak</span>
                    @elseif ($tamu->status_verifikasi === \App\Models\Tamu::STATUS_DISETUJUI)
                        @if ($tamu->checked_out_at)
                            <span class="tamu-badge selesai"><i class="fas fa-circle"></i> Selesai</span>
                        @else
                            <span class="tamu-badge disetujui" title="Disetujui — tamu dapat berkunjung"><i class="fas fa-circle"></i> Disetujui</span>
                        @endif
                    @else
                        <span class="tamu-badge menunggu" title="Menunggu verifikasi"><i class="fas fa-circle"></i> Menunggu</span>
                    @endif
                    {{-- Log verifikasi — SIAPA & KAPAN perubahan status terakhir.
                         Tombol aksi kini tetap tampil pada status apa pun
                         (revisi status bolak-balik Disetujui <-> Dibatalkan). --}}
                    @if ($tamu->verified_at && $tamu->verified_by)
                        <span class="tamu-verify-log">
                            @if ($tamu->status_verifikasi === \App\Models\Tamu::STATUS_DITOLAK)
                                Dibatalkan oleh {{ $tamu->verifier_role_label }} atasnama <strong>{{ $tamu->verifier_name }}</strong>
                            @else
                                Sudah diapprove oleh <strong>{{ $tamu->verifier_name }}</strong>
                            @endif
                            pada tanggal {{ $tamu->verified_at->translatedFormat('d F Y') }}
                            jam {{ $tamu->verified_at->format('H.i') }}
                        </span>
                    @endif
                </td>
                <td>
                    <div class="tamu-actions">
                        <button type="button" class="tamu-action-btn detail" title="Detail"
                                onclick="openDetailModal({{ $tamu->id }})">
                            <i class="fas fa-eye"></i>
                        </button>
                        @can('tamu.edit')
                            <button type="button" class="tamu-action-btn detail" title="Edit Data Tamu"
                                    onclick='openEditModal(@json($tamuData[$tamu->id] ?? []))'>
                                <i class="fas fa-pen"></i>
                            </button>
                        @endcan
                        @can('tamu.checkout')
                            {{-- Aksi status — REVISI: status boleh diubah berulang.
                                 Menunggu   -> Setujui + Batalkan
                                 Disetujui  -> Ubah menjadi Dibatalkan
                                 Dibatalkan -> Ubah menjadi Disetujui --}}
                            @if ($tamu->status_verifikasi === \App\Models\Tamu::STATUS_MENUNGGU)
                                <button type="button" class="tamu-action-btn setuju" title="Setujui kunjungan & kirim konfirmasi WA"
                                        onclick="openVerifikasiModal({{ $tamu->id }}, 'setuju')">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button type="button" class="tamu-action-btn tolak" title="Tolak kunjungan & kirim konfirmasi WA"
                                        onclick="openVerifikasiModal({{ $tamu->id }}, 'tolak')">
                                    <i class="fas fa-xmark"></i>
                                </button>
                            @elseif ($tamu->status_verifikasi === \App\Models\Tamu::STATUS_DISETUJUI)
                                <button type="button" class="tamu-action-btn tolak" title="Ubah menjadi Dibatalkan"
                                        onclick="openVerifikasiModal({{ $tamu->id }}, 'tolak')">
                                    <i class="fas fa-rotate"></i>
                                </button>
                            @else
                                <button type="button" class="tamu-action-btn setuju" title="Ubah menjadi Disetujui"
                                        onclick="openVerifikasiModal({{ $tamu->id }}, 'setuju')">
                                    <i class="fas fa-rotate"></i>
                                </button>
                            @endif
                        @endcan
                        @can('tamu.delete')
                            <button type="button" class="tamu-action-btn delete" title="Hapus"
                                    onclick="openDeleteModal('{{ route('karyawan.tamu.destroy', $tamu) }}', '{{ addslashes($tamu->nama) }}')">
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
     PRINT BAR
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
     MODAL: DOKUMEN TAMU
     ============================================ --}}
<div class="tamu-modal-overlay" id="dokumenModal" onclick="if(event.target===this) closeTamuModal('dokumenModal')">
    <div class="tamu-modal">
        <div class="tamu-modal-header">
            <h6><i class="fas fa-file-shield" style="color: var(--kry-teal);"></i> Dokumen Tamu — <span id="dokumenModalName"></span></h6>
            <button type="button" class="tamu-modal-close" onclick="closeTamuModal('dokumenModal')"><i class="fas fa-xmark"></i></button>
        </div>
        <div class="tamu-modal-body" style="text-align:center;">
            <p style="font-size:0.82rem; color:var(--kry-muted); margin:0 0 1rem;">
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
     MODAL: DETAIL TAMU — parsial bersama (shell, diisi JS openDetailModal)
     Portal karyawan tidak punya halaman detail -> detailUrl null.
     ============================================ --}}
@include('admin.tamu.detail-tamu-modal', [
    // 'tamu' => NULL sengaja eksplisit: variabel $tamu dari @foreach
    // tabel di atas BOCOR ke include ini — tanpa ini, modal langsung
    // ter-render mode lengkap pakai tamu terakhir dalam loop.
    'tamu'        => null,
    'accentColor' => 'var(--kry-teal)',
    'detailUrl'   => null,
    'checkinUrl'  => route('karyawan.tamu.checkin', ':id'),
    'checkoutUrl' => route('karyawan.tamu.checkout', ':id'),
])

{{-- ============================================
     TEMPLATE: KARTU CHECK-IN / CHECK-OUT (minimalis)
     Di-clone JS ke dalam modal Detail — hanya dirender sekali,
     tombol Check-Out aktif saat tamu sedang berkunjung dan jam
     Check-Out ter-update real-time tanpa reload.
     ============================================ --}}
<div id="coTemplate" hidden>
    @include('admin.tamu._checkinout', [
        'co'          => null,
        'checkinUrl'  => route('karyawan.tamu.checkin', ':id'),
        'checkoutUrl' => route('karyawan.tamu.checkout', ':id'),
    ])
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
     MODAL: VERIFIKASI + POP-UP KIRIM KONFIRMASI WA
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

@if (session('wa_konfirmasi'))
@php $wa = session('wa_konfirmasi'); $waBentrok = ! empty($wa['bentrok']); @endphp
<div class="tamu-modal-overlay show" id="waKonfirmasiModal">
    <div class="tamu-modal">
        <div class="tamu-delete-dialog">
            @if ($waBentrok)
            <div class="del-icon" style="background:#fff7ed; color:#ea580c;"><i class="fas fa-calendar-xmark" style="font-size:1.5rem;"></i></div>
            <h6>Jadwal Kunjungan Sudah Ada yang Diizinkan</h6>
            <p>Kunjungan <b>{{ $wa['nama'] }}</b> ({{ $wa['no_wa'] }}) <b>TIDAK disetujui</b>:
                jadwalnya bentrok — pada jadwal & divisi yang sama sudah ada kunjungan
                <b>{{ $wa['bentrok_dengan'] }}</b> ({{ $wa['bentrok_jadwal'] }} WIB) yang diizinkan.
                WhatsApp tamu ini akan terbuka dengan pesan pemberitahuan agar mengajukan
                jadwal lain — cukup tekan <b>Kirim</b>.</p>
            @else
            <div class="del-icon" style="background:#e7f9ee; color:#16a34a;"><i class="fab fa-whatsapp" style="font-size:1.5rem;"></i></div>
            <h6>Kirim Konfirmasi WhatsApp</h6>
            <p>Berbaskan tamu <b>{{ $wa['nama'] }}</b> ({{ $wa['no_wa'] }}) bahwa kunjungannya
                <b>{{ $wa['status'] }}</b>. WhatsApp akan terbuka dengan pesan yang sudah terisi otomatis —
                cukup tekan <b>Kirim</b>.</p>
            @endif
            <div class="tamu-delete-actions">
                <button type="button" class="cancel" onclick="closeTamuModal('waKonfirmasiModal')">Lewati</button>
                <a href="{{ $wa['wa_url'] }}" target="_blank" rel="noopener" class="confirm"
                   style="background:{{ $waBentrok ? '#ea580c' : '#25D366' }}; color:#fff; text-decoration:none; display:inline-flex;"
                   onclick="setTimeout(function(){ closeTamuModal('waKonfirmasiModal'); }, 300);">
                    <i class="fab fa-whatsapp me-1"></i> {{ $waBentrok ? 'Beritahu via WhatsApp' : 'Buka WhatsApp' }}
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
            <h6><i class="fas fa-user-plus" style="color: var(--kry-teal);"></i> Tambah Tamu Manual</h6>
            <button type="button" class="tamu-modal-close" onclick="closeTamuModal('addModal')"><i class="fas fa-xmark"></i></button>
        </div>
        <form action="{{ route('karyawan.tamu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="tamu-modal-body">

                {{-- ========== SEKSI 1: DATA DIRI ========== --}}
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

                {{-- ========== SEKSI 2: BERKAS PENDUKUNG ========== --}}
                <div class="tamu-form-section-head">
                    <span class="tamu-form-section-icon"><i class="fas fa-folder-open"></i></span>
                    <span class="tamu-form-section-title">Berkas Pendukung</span>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Upload Dokumen <small style="color:var(--kry-muted); font-weight:500;">(opsional, maks 10MB)</small></label>
                        <input type="file" name="dokumen"
                               accept=".zip,.rar,.pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx"
                               class="form-control @error('dokumen') is-invalid @enderror" style="font-size:0.8rem;">
                        <small style="color:var(--kry-muted); font-size:0.7rem;">ZIP, RAR, PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG — maksimal 10MB</small>
                        @error('dokumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- ========== SEKSI 3: DETAIL KUNJUNGAN ========== --}}
                <div class="tamu-form-section-head">
                    <span class="tamu-form-section-icon"><i class="fas fa-calendar-check"></i></span>
                    <span class="tamu-form-section-title">Detail Kunjungan</span>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Orang / Divisi yang Ditemui <span class="text-danger">*</span></label>
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
                        <div class="tamu-dd-wrap">
                            <input type="date" name="tanggal_kunjungan" id="add-tanggal_kunjungan" required
                                   min="{{ now()->format('Y-m-d') }}"
                                   class="form-control tamu-dd-input @error('tanggal_kunjungan') is-invalid @enderror"
                                   value="{{ \Illuminate\Support\Str::substr((string) old('tanggal_kunjungan', ''), 0, 10) ?: now()->format('Y-m-d') }}"
                                   title="Tanggal kunjungan minimal hari ini" style="font-size:0.85rem;">
                            <i class="fas fa-chevron-down tamu-dd-arrow"></i>
                        </div>
                        <small style="font-size:0.7rem; color:var(--kry-muted); display:block; margin-top:0.25rem;">Minimal hari ini.</small>
                        @error('tanggal_kunjungan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Jam Kunjungan <span class="text-danger">*</span></label>
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
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Jabatan yang Ditemui <small class="text-muted" style="text-transform:none;">(opsional — mengikuti bidang)</small></label>
                        {{-- Custom dropdown jabatan BERTINGKAT — opsi dari master jabatans
                             dengan data-bidang, difilter JS mengikuti tujuan_ditemui. --}}
                        <div class="tamu-dd-wrap">
                            <input type="text" id="add-jabatan_ditemui_display" readonly autocomplete="off"
                                   placeholder="— Pilih Jabatan —"
                                   class="form-control tamu-dd-input @error('jabatan_ditemui') is-invalid @enderror"
                                   aria-haspopup="listbox">
                            <i class="fas fa-chevron-down tamu-dd-arrow"></i>
                            <div class="tamu-dd-menu" role="listbox">
                                <div class="tamu-dd-options">@include('admin.tamu._jabatan-options')</div>
                            </div>
                        </div>
                        <input type="hidden" name="jabatan_ditemui" id="add-jabatan_ditemui" value="{{ old('jabatan_ditemui') }}">
                        @error('jabatan_ditemui')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Orang yang Ditemui <small class="text-muted" style="text-transform:none;">(opsional)</small></label>
                        <div class="tamu-dd-wrap" style="position:relative;">
                            <input type="text" name="orang_ditemui" id="add-orang_ditemui"
                                   value="{{ old('orang_ditemui') }}" autocomplete="off"
                                   placeholder="Nama orang yang ditemui"
                                   class="form-control tamu-dd-input @error('orang_ditemui') is-invalid @enderror"
                                   style="padding-left:2.1rem;">
                            <i class="fas fa-user-tie" style="position:absolute; left:0.7rem; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:0.75rem; pointer-events:none;"></i>
                        </div>
                        @error('orang_ditemui')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
            <div class="tamu-modal-header" style="border-top:1px solid var(--kry-line); border-bottom:none; justify-content:flex-end; gap:0.6rem;">
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
     MODAL: EDIT TAMU
     ============================================ --}}
@can('tamu.edit')
<div class="tamu-modal-overlay" id="editModal" onclick="if(event.target===this) closeTamuModal('editModal')">
    <div class="tamu-modal modal-lg">
        <div class="tamu-modal-header">
            <h6><i class="fas fa-user-pen" style="color: var(--kry-teal);"></i> Edit Data Tamu</h6>
            <button type="button" class="tamu-modal-close" onclick="closeTamuModal('editModal')"><i class="fas fa-xmark"></i></button>
        </div>
        <form id="editTamuForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="tamu_id" id="edit-tamu_id" value="">
            <div class="tamu-modal-body">

                {{-- ========== SEKSI 1: DATA DIRI ========== --}}
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

                {{-- ========== SEKSI 2: DOKUMEN ========== --}}
                <div class="tamu-form-section-head">
                    <span class="tamu-form-section-icon"><i class="fas fa-folder-open"></i></span>
                    <span class="tamu-form-section-title">Dokumen</span>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Ganti Dokumen Pendukung <small style="color:var(--kry-muted); font-weight:500;">(opsional)</small></label>
                        <input type="file" name="dokumen" id="edit-dokumen" accept=".zip,.rar,.pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx" class="form-control" style="font-size:0.8rem;"
                               onchange="showEditFileName(this, 'edit-dokumen-filename')">
                        <small style="color:var(--kry-muted); font-size:0.7rem;">ZIP, RAR, PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG — maks 10MB; kosongkan jika tidak ingin mengganti.</small>
                        <div id="edit-dokumen-filename" class="edit-file-selected" style="display:none;"></div>
                        <div id="edit-dokumen-link" class="hidden mt-1">
                            <a id="edit-dokumen-url" href="#" target="_blank" rel="noopener" style="font-size:0.75rem; color:var(--kry-teal); text-decoration:none;">
                                <i class="fas fa-paperclip me-1"></i>Lihat dokumen saat ini
                            </a>
                        </div>
                        <div id="edit-dokumen-empty" class="hidden">
                            <small style="color:var(--kry-muted); font-size:0.7rem;"><i class="fas fa-file-circle-xmark me-1"></i>Belum ada dokumen.</small>
                        </div>
                    </div>
                </div>

                {{-- ========== SEKSI 3: DETAIL KUNJUNGAN ========== --}}
                <div class="tamu-form-section-head">
                    <span class="tamu-form-section-icon"><i class="fas fa-calendar-check"></i></span>
                    <span class="tamu-form-section-title">Detail Kunjungan</span>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Orang / Divisi yang Ditemui <span class="text-danger">*</span></label>
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
                        <div class="tamu-dd-wrap">
                            <input type="date" name="tanggal_kunjungan" id="edit-tanggal_kunjungan" required
                                   class="form-control tamu-dd-input" style="font-size:0.85rem;">
                            <i class="fas fa-chevron-down tamu-dd-arrow"></i>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Jam Kunjungan <span class="text-danger">*</span></label>
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
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Jabatan yang Ditemui <small class="text-muted" style="text-transform:none;">(opsional — mengikuti bidang)</small></label>
                        {{-- Custom dropdown jabatan BERTINGKAT — nilai diisi JS saat modal edit dibuka --}}
                        <div class="tamu-dd-wrap">
                            <input type="text" id="edit-jabatan_ditemui_display" readonly autocomplete="off"
                                   placeholder="— Pilih Jabatan —"
                                   class="form-control tamu-dd-input" aria-haspopup="listbox">
                            <i class="fas fa-chevron-down tamu-dd-arrow"></i>
                            <div class="tamu-dd-menu" role="listbox">
                                <div class="tamu-dd-options">@include('admin.tamu._jabatan-options')</div>
                            </div>
                        </div>
                        <input type="hidden" name="jabatan_ditemui" id="edit-jabatan_ditemui" value="">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-size:0.78rem; font-weight:600;">Orang yang Ditemui <small class="text-muted" style="text-transform:none;">(opsional)</small></label>
                        <div class="tamu-dd-wrap" style="position:relative;">
                            <input type="text" name="orang_ditemui" id="edit-orang_ditemui"
                                   value="" autocomplete="off"
                                   placeholder="Nama orang yang ditemui"
                                   class="form-control tamu-dd-input"
                                   style="padding-left:2.1rem;">
                            <i class="fas fa-user-tie" style="position:absolute; left:0.7rem; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:0.75rem; pointer-events:none;"></i>
                        </div>
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
            <div class="tamu-modal-header" style="border-top:1px solid var(--kry-line); border-bottom:none; justify-content:space-between; gap:0.6rem;">
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
        const el = document.getElementById(id);
        if (!el) return;
        el.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    function closeTamuModal(id) {
        document.getElementById(id)?.classList.remove('show');
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

    /* ===== Modal Detail ===== */
    var tamuData = @json($tamuData);

    function openDokumenModal(url, nama) {
        document.getElementById('dokumenModalUrl').href = url;
        document.getElementById('dokumenModalName').textContent = nama;
        openTamuModal('dokumenModal');
    }

    function openDetailModal(id) {
        var t = tamuData[id];
        if (!t) return;

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
            // Baris Check-In / Check-Out / Status DIHAPUS — redundan,
            // ketiganya pindah ke kartu dinamis di bawah (3 kondisi).
        ];

        var body = document.getElementById('detailModalBody');
        var esc = function (s) { return String(s).replace(/</g, '&lt;'); };

        // 1) Daftar informasi utama (identitas + jadwal pendaftaran)
        var info = body.querySelector('[data-role="info"]');
        if (info) {
            var infoHtml = '';
            rows.forEach(function (row) {
                if (!row) return;
                infoHtml += '<div class="detail-row"><dt>' + esc(row[0]) + '</dt><dd>' + esc(String(row[1])) + '</dd></div>';
            });
            info.innerHTML = infoHtml;
        }

        // 2) Maksud & Keperluan
        var keperluanWrap = body.querySelector('[data-role="keperluan-wrap"]');
        if (keperluanWrap) {
            keperluanWrap.hidden = !t.keperluan;
            if (t.keperluan) {
                body.querySelector('[data-role="keperluan"]').innerHTML =
                    esc(String(t.keperluan)).replace(/\n/g, '<br>');
            }
        }

        // 3) Dokumen Pendukung
        var dokumenWrap = body.querySelector('[data-role="dokumen-wrap"]');
        if (dokumenWrap) {
            dokumenWrap.hidden = !t.dokumen;
            if (t.dokumen) {
                var namaSafe = String(t.nama || '-').replace(/'/g, "\\'");
                var dokumenUrl = String(t.dokumen).replace(/'/g, "\\'");
                body.querySelector('[data-role="dokumen"]').innerHTML =
                    '<a href="javascript:void(0)" onclick="openDokumenModal(\'' + dokumenUrl + '\', \'' + namaSafe + '\')" class="dtm-doc-btn" title="Buka / unduh dokumen (tab baru)">'
                    + '<i class="fas fa-paperclip"></i> Buka / Unduh Dokumen</a>';
            }
        }

        // 4) Card dinamis (badge + jam + aksi check-in/out) ke slot bawah
        appendCoCard(t);
        openTamuModal('detailModal');
    }

    /* ===== Kartu CHECK-IN / CHECK-OUT di modal Detail =====
       Diklone dari #coTemplate lalu disinkronkan dengan state
       kunjungan tamu (jam check-in/out, tombol aksi, badge). */
    function appendCoCard(t) {
        var tpl  = document.getElementById('coTemplate');
        var card = tpl && tpl.querySelector('[data-co-card]');
        if (!card || !t || !t.kunjungan || t.id == null || t.id === '') return;

        var clone = card.cloneNode(true);
        clone.hidden = false;
        clone.dataset.id = String(t.id);
        clone.dataset.checkinUrl  = String(card.dataset.checkinUrl  || '').replace(':id', t.id);
        clone.dataset.checkoutUrl = String(card.dataset.checkoutUrl || '').replace(':id', t.id);

        // URL pada tombol masih membawa placeholder ':id' dari template —
        // ganti juga, supaya fetch tidak pernah mengirim '/data-tamu/:id/checkout'.
        Array.prototype.forEach.call(clone.querySelectorAll('[data-url]'), function (el) {
            el.dataset.url = String(el.dataset.url || '').replace(':id', t.id);
        });

        var msg = clone.querySelector('[data-role="msg"]');
        if (msg) msg.hidden = true;

        var slot = document.querySelector('[data-role="co-slot"]');
        if (slot) {
            slot.innerHTML = '';              // buang kartu tamu sebelumnya
            slot.appendChild(clone);
        } else {
            document.getElementById('detailModalBody').appendChild(clone);
        }

        if (window.tamuCoSync) {
            window.tamuCoSync(clone, Object.assign({}, t.kunjungan, { id: t.id }));
        }
    }

    /* ===== Modal Hapus ===== */
    function openDeleteModal(url, nama) {
        document.getElementById('deleteTamuName').textContent = nama;
        document.getElementById('deleteTamuForm').action = url;
        openTamuModal('deleteModal');
    }

    /* ===== Modal Verifikasi (Setuju / Tolak) ===== */
    const verifikasiUrlTemplate = '{{ route('karyawan.tamu.verifikasi', ['tamu' => ':id']) }}';

    function openVerifikasiModal(id, keputusan) {
        const t = tamuData[id];
        if (!t) return;

        const setuju = keputusan === 'setuju';
        const form   = document.getElementById('verifikasiForm');

        form.action = verifikasiUrlTemplate.replace(':id', id);

        let keputusanInput = form.querySelector('input[name="keputusan"]');
        if (!keputusanInput) {
            keputusanInput = document.createElement('input');
            keputusanInput.type  = 'hidden';
            keputusanInput.name  = 'keputusan';
            form.appendChild(keputusanInput);
        }
        keputusanInput.value = keputusan;

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

    /* ===== Modal Edit Tamu ===== */
    const editUrlTemplate = '{{ route('karyawan.tamu.update', ['tamu' => ':id']) }}';

    function openEditModal(t) {
        if (!t || !t.id) return;

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
        ensureDivisiOption('edit', t.tujuan, ' (data lama)');
        /* Jabatan yang ditemui (master jabatans) — data lama dipertahankan;
           opsi difilter mengikuti divisi di atas. */
        set('edit-jabatan_ditemui', t.jabatan);
        if (t.jabatan) {
            ensureJabatanOption('edit', t.jabatan, t.tujuan, '');
        }
        filterJabatanOpsi('edit', t.tujuan);
        /* Nama orang yang ditemui (teks bebas). */
        set('edit-orang_ditemui', t.orang);
        set('edit-tanggal_kunjungan', t.tanggal_input ? t.tanggal_input.slice(0, 10) : '');
        set('edit-jumlah_tamu', t.jumlah || 1);
        set('edit-keperluan', t.keperluan);

        const jamLama = t.tanggal_input ? t.tanggal_input.slice(11, 16) : '';
        const jamSel = document.getElementById('edit-jam_kunjungan');
        if (jamSel) {
            jamSel.dataset.jamAwal = jamLama || '';
            jamSel.value = jamLama || '';
        }

        const fileInput = document.getElementById('edit-dokumen');
        if (fileInput) fileInput.value = '';
        const fileNameBox = document.getElementById('edit-dokumen-filename');
        if (fileNameBox) {
            fileNameBox.style.display = 'none';
            fileNameBox.innerHTML = '';
        }

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
        refreshJam('edit');
    }

    function updateEditCounter() {
        const ta = document.getElementById('edit-keperluan');
        const count = document.getElementById('edit-keperluan-count');
        if (ta && count) count.textContent = ta.value.length;
    }

    (function () {
        const ta = document.getElementById('edit-keperluan');
        if (ta) ta.addEventListener('input', updateEditCounter);
    })();

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
    }

    /* ============================================================
       CUSTOM DROPDOWN DIVISI — modal Tambah & Edit
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

    function ensureDivisiOption(prefix, value, suffix) {
        const hidden = document.getElementById(prefix + '-tujuan_ditemui');
        const display = document.getElementById(prefix + '-tujuan_ditemui_display');
        if (!hidden || !display || !value) return;

        /* Data lama bisa menyimpan entitas &nbsp;/spasi pantas sebagai
           bagian nama (partial lama ter-escape) — normaalkan dulu
           supaya teks yang tampil & tersimpan bersih. */
        value = String(value).replace(/&nbsp;|\u00A0/g, '').replace(/\s+/g, ' ').trim();
        if (!value) return;
        hidden.value = value;

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
        const display = document.getElementById(prefix + '-tujuan_ditemui_display');
        if (!display) return;
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
       CUSTOM DROPDOWN JABATAN — BERTINGKAT (integrasi master
       jabatans). Opsi membawa data-bidang = nama bidang induk;
       JS hanya menampilkan jabatan yang cocok dengan DIVISI
       (tujuan_ditemui) yang dipilih. Mengganti divisi memfilter
       ulang opsi & mengosongkan pilihan yang tak lagi cocok.
       Pola & perilaku identik dengan dropdown divisi di atas.
       ============================================================ */
    function jabatanContext(prefix) {
        const display = document.getElementById(prefix + '-jabatan_ditemui_display');
        const hidden = document.getElementById(prefix + '-jabatan_ditemui');
        const container = display && display.closest('.tamu-dd-wrap');
        const menu = container && container.querySelector('.tamu-dd-menu');
        const options = container && container.querySelector('.tamu-dd-options');
        return { display, hidden, container, menu, options };
    }

    /* Pastikan nilai jabatan lama tetap tersedia sebagai opsi
       (mis. jabatannya sudah dihapus dari master) supaya rekornya
       bisa diedit tanpa kehilangan data. */
    function ensureJabatanOption(prefix, value, bidang, suffix) {
        const c = jabatanContext(prefix);
        if (!c.display || !c.hidden || !c.options || !value) return;

        /* Normalkan entitas &nbsp;/spasi berlebih bila ada di data lama. */
        value = String(value).replace(/&nbsp;|\u00A0/g, '').replace(/\s+/g, ' ').trim();
        bidang = String(bidang || '').replace(/&nbsp;|\u00A0/g, '').replace(/\s+/g, ' ').trim();
        if (!value) return;
        c.hidden.value = value;

        const ada = Array.prototype.some.call(c.options.querySelectorAll('.dropdown-option'), function (o) {
            return o.getAttribute('data-value') === value;
        });
        if (!ada) {
            const opt = document.createElement('div');
            opt.className = 'dropdown-option dropdown-jabatan-option';
            opt.setAttribute('data-value', value);
            opt.setAttribute('data-bidang', bidang || '');
            opt.textContent = value + (suffix || '');
            c.options.appendChild(opt);
        }
        c.display.value = value + (suffix && !ada ? suffix : '');
        c.hidden.value = value;
    }

    /* Tampilkan hanya opsi jabatan yang bidangnya cocok; tandai &
       sinkronkan teks display dengan nilai hidden. */
    function filterJabatanOpsi(prefix, divisi) {
        const c = jabatanContext(prefix);
        if (!c.options || !c.hidden) return;

        const divisiNama = String(divisi || '').trim();
        const pilihan = c.hidden.value;
        let adaCocok = false;

        c.options.querySelectorAll('.dropdown-option').forEach(function (o) {
            if (o.classList.contains('dropdown-jabatan-placeholder')) {
                o.textContent = divisiNama ? 'Belum ada jabatan pada bidang ini' : '— Pilih bidang terlebih dahulu —';
                return;
            }

            const cocok = divisiNama !== '' && o.getAttribute('data-bidang') === divisiNama;
            o.style.display = cocok ? '' : 'none';
            if (cocok) adaCocok = true;
            o.classList.toggle('selected', cocok && o.getAttribute('data-value') === pilihan);
        });

        const placeholder = c.options.querySelector('.dropdown-jabatan-placeholder');
        if (placeholder) placeholder.style.display = adaCocok ? 'none' : '';

        if (pilihan) syncJabatanDisplay(prefix);
    }

    /* Sinkronkan teks display + status terpilih dari nilai hidden. */
    function syncJabatanDisplay(prefix) {
        const c = jabatanContext(prefix);
        if (!c.display || !c.hidden) return;

        const val = c.hidden.value;
        const cocok = Array.prototype.find.call(
            c.options.querySelectorAll('.dropdown-option'),
            function (o) { return o.getAttribute('data-value') === val && o.style.display !== 'none'; }
        );

        c.display.value = cocok ? cocok.textContent.trim() : val;
    }

    function initJabatanDropdown(prefix) {
        const c = jabatanContext(prefix);
        if (!c.display || !c.menu || !c.options) return;

        let isOpen = false;

        function openMenu() { isOpen = true; c.menu.classList.add('open'); c.container.classList.add('dropdown-open'); }
        function closeMenu() { isOpen = false; c.menu.classList.remove('open'); c.container.classList.remove('dropdown-open'); }

        function select(opt) {
            c.options.querySelectorAll('.dropdown-option').forEach(function (o) { o.classList.remove('selected'); });
            opt.classList.add('selected');
            c.display.value = opt.textContent.trim();
            c.hidden.value = opt.getAttribute('data-value') || '';
            closeMenu();
        }

        c.display.addEventListener('click', function (e) {
            e.stopPropagation();
            // Tutup dropdown divisi & jabatan lain supaya tidak tumpuk
            ['add', 'edit'].forEach(function (p) {
                if (p !== prefix) closeDivisiDropdown(p);
                const jc = jabatanContext(p);
                if (jc.container && jc.container.__closeJabatan) jc.container.__closeJabatan();
            });
            isOpen ? closeMenu() : openMenu();
        });
        c.options.addEventListener('click', function (e) {
            const opt = e.target.closest('.dropdown-option');
            if (opt && opt.getAttribute('data-value')) select(opt);
        });
        document.addEventListener('click', function (e) {
            if (!c.container.contains(e.target)) closeMenu();
        });
        c.display.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') { closeMenu(); c.display.blur(); }
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); isOpen ? closeMenu() : openMenu(); }
        });

        c.container.__closeJabatan = closeMenu;
    }

    ['add', 'edit'].forEach(function (p) {
        initJabatanDropdown(p);
        const divisiHidden = document.getElementById(p + '-tujuan_ditemui');
        if (divisiHidden) {
            divisiHidden.addEventListener('change', function () {
                filterJabatanOpsi(p, divisiHidden.value.trim());
            });
        }
    });

    /* ============================================================
       TANGGAL KUNJUNGAN — blokir tanggal yang sudah lewat
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
       SLOT JAM KUNJUNGAN — slot ter-approve ditandai MERAH
       (data dari /api/booked-slots, pola form registrasi publik)
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

    function buildJamOptions(prefix, blocked) {
        const c = jamContext(prefix);
        if (!c.jam) return;

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
                if (jamAwal && val === jamAwal) disabled = false;
            }

            const option = document.createElement('option');
            option.value = val;
            option.textContent = label;
            if (isBlocked) {
                option.classList.add('slot-penuh');
                option.title = 'Jam ini sudah di-approve dan tidak dapat dipilih.';
            }
            if (disabled) option.disabled = true;

            c.jam.appendChild(option);
        });

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

        if (jamLoading[prefix]) {
            jamRefreshDirty[prefix] = true;
            return;
        }
        jamLoading[prefix] = true;

        setJamStatus(c.status, 'Memuat ketersediaan jam...');

        const qs = '?tanggal=' + encodeURIComponent(tanggal)
                 + '&divisi=' + encodeURIComponent(divisi)
                 + (prefix === 'edit' ? '&durasi=1' : '');

        fetch(bookedSlotsUrl + qs)
            .then(function (r) { return r.json(); })
            .then(function (data) {
                jamLoading[prefix] = false;
                if (jamRefreshDirty[prefix]) {
                    jamRefreshDirty[prefix] = false;
                    refreshJam(prefix);
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
                const opt = c.jam.selectedOptions && c.jam.selectedOptions[0];
                if (opt && opt.disabled) c.jam.value = '';
            });
        });
    })();

    /* ===== Buka kembali modal setelah validasi server MENOLAK isian ===== */
    (function () {
        const hasError = {{ $errors->any() ? 'true' : 'false' }};
        if (!hasError) return;

        const oldInput = @json(old());
        if (!oldInput || !oldInput.nik) return;

        const set = function (id, value) {
            const el = document.getElementById(id);
            if (el && value !== undefined && value !== null) el.value = value;
        };

        if (oldInput.tamu_id && tamuData[oldInput.tamu_id]) {
            openEditModal(tamuData[oldInput.tamu_id]);

            set('edit-nik', oldInput.nik);
            set('edit-nama', oldInput.nama);
            set('edit-instansi', oldInput.instansi);
            set('edit-no_hp', oldInput.no_hp);
            set('edit-email', oldInput.email);
            set('edit-tujuan_ditemui', oldInput.tujuan_ditemui);
            ensureDivisiOption('edit', oldInput.tujuan_ditemui, '');
            syncDivisiDisplay('edit');
            /* Jabatan yang ditemui — restore old + filter opsi mengikuti divisi. */
            set('edit-jabatan_ditemui', oldInput.jabatan_ditemui);
            if (oldInput.jabatan_ditemui) {
                ensureJabatanOption('edit', oldInput.jabatan_ditemui, oldInput.tujuan_ditemui, '');
            }
            filterJabatanOpsi('edit', oldInput.tujuan_ditemui);
            /* Nama orang yang ditemui — restore old. */
            set('edit-orang_ditemui', oldInput.orang_ditemui);
            set('edit-tanggal_kunjungan', String(oldInput.tanggal_kunjungan || '').slice(0, 10));
            set('edit-jumlah_tamu', oldInput.jumlah_tamu);
            set('edit-keperluan', oldInput.keperluan);

            const jamSel = document.getElementById('edit-jam_kunjungan');
            const jamBaru = oldInput.jam_kunjungan || '';
            if (jamSel) {
                jamSel.dataset.jamAwal = jamBaru;
                jamSel.value = jamBaru;
            }

            updateEditCounter();
            refreshJam('edit');
        } else if (document.getElementById('addModal')) {
            openAddModal();
            const addHidden = document.getElementById('add-tujuan_ditemui');
            if (addHidden && addHidden.value) {
                ensureDivisiOption('add', addHidden.value, '');
                syncDivisiDisplay('add');
            }
            /* Jabatan — sinkronkan opsi bertingkat dari old divisi, lalu
               pertahankan pilihan old jabatan (jika masih cocok). */
            const addDivisiValue = addHidden ? addHidden.value.trim() : '';
            filterJabatanOpsi('add', addDivisiValue);
            const addJabatanHidden = document.getElementById('add-jabatan_ditemui');
            if (addJabatanHidden && addJabatanHidden.value) {
                ensureJabatanOption('add', addJabatanHidden.value, addDivisiValue, '');
                syncJabatanDisplay('add');
            }
        }
    })();
</script>
@endpush
@endsection
