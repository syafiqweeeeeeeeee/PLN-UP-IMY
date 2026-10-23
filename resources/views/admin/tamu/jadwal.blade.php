@extends('layouts.admin')

@section('title', 'Jadwal Tamu — E-PPID PLN')
@section('page-title', 'Jadwal Tamu')

@push('styles')
<style>
    /* ============================================
       JADWAL TAMU — KALENDER MINIMALIS
       Pola & token sama dengan halaman Data Tamu:
       page header card, stats chips, kartu bersih,
       modal overlay. Hanya penambahan grid kalender.
       ============================================ */

    /* Page Header (selaras .tamu-page-header di index) */
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

    /* Stats (bulan tampilan) */
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
    .tamu-stat-card .stat-icon.red   { background: linear-gradient(135deg, #ef4444, #dc2626); }
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

    /* ================= KALENDER ================= */
    .jdwl-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow: hidden;
    }

    /* Bar navigasi bulan */
    .jdwl-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        padding: 0.9rem 1.15rem;
        border-bottom: 1px solid #eef2f7;
    }
    .jdwl-nav .jdwl-bulan {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--pln-text);
        text-transform: capitalize;
        display: flex;
        flex-direction: column;
        line-height: 1.25;
    }
    .jdwl-nav .jdwl-bulan small {
        font-size: 0.7rem;
        font-weight: 500;
        color: #9ca3af;
        text-transform: none;
    }
    .jdwl-nav .jdwl-nav-btns { display: flex; gap: 0.4rem; align-items: center; }
    .jdwl-nav-btn {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        border: 1px solid #eef2f7;
        background: #f8fafc;
        color: #475569;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.82rem;
        text-decoration: none;
        transition: all 0.15s ease;
    }
    .jdwl-nav-btn:hover { background: #fff; border-color: var(--pln-blue); color: var(--pln-blue); }
    .jdwl-nav-today {
        height: 34px;
        padding: 0 0.9rem;
        border-radius: 9px;
        border: 1px solid #eef2f7;
        background: #f8fafc;
        color: #475569;
        display: inline-flex;
        align-items: center;
        font-size: 0.76rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.15s ease;
    }
    .jdwl-nav-today:hover { background: #fff; border-color: var(--pln-blue); color: var(--pln-blue); }

    /* Legenda status */
    .jdwl-legend {
        display: flex;
        gap: 1.2rem;
        flex-wrap: wrap;
        padding: 0.7rem 1.15rem;
    }
    .jdwl-legend .legend-item {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.78rem;
        color: #6b7280;
    }
    .legend-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        display: inline-block;
    }
    .legend-dot.dot-disetujui { background: #16a34a; }
    .legend-dot.dot-ditolak   { background: #dc2626; }
    .legend-dot.dot-menunggu  { background: #f59e0b; }

    /* Grid kalender */
    .jdwl-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
    }
    .jdwl-grid.jdwl-head { border-bottom: 1px solid #eef2f7; }
    .jdwl-head .jdwl-nama-hari {
        text-align: center;
        padding: 0.6rem 0.25rem;
        font-size: 0.72rem;
        font-weight: 700;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        background: #f9fafb;
    }
    html.theme-dark .jdwl-head .jdwl-nama-hari { background: var(--panel); color: var(--ink-muted); }
    html.theme-dark .jdwl-nav { border-color: var(--line); }

    /* Sel tanggal */
    .jdwl-cell {
        min-height: 112px;
        padding: 0.55rem 0.6rem;
        border-top: 1px solid #f1f4f9;
        border-right: 1px solid #f1f4f9;
        font-size: 0.84rem;
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
        background: var(--bg-card, #fff);
    }
    .jdwl-cell:nth-child(7n) { border-right: none; }
    html.theme-dark .jdwl-cell { border-color: var(--line); }
    .jdwl-cell.bulan-lain { background: #fafbfd; }
    html.theme-dark .jdwl-cell.bulan-lain { background: rgba(255,255,255,0.02); }
    .jdwl-cell .jdwl-tgl {
        align-self: flex-end;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        color: #475569;
        font-size: 0.92rem;
        font-weight: 600;
        font-variant-numeric: tabular-nums;
        line-height: 1.5;
        cursor: default;
        transition: background 0.15s ease, color 0.15s ease;
    }
    .jdwl-cell.bulan-lain .jdwl-tgl { color: #cbd5e1; }
    .jdwl-cell .jdwl-tgl { cursor: pointer; }
    .jdwl-cell.punya-data .jdwl-tgl:hover { background: #e8f2fc; }
    .jdwl-cell.hari-ini .jdwl-tgl {
        background: var(--pln-blue, #005b9c);
        color: #fff;
        font-weight: 700;
    }
    .jdwl-cell.hari-ini.punya-data .jdwl-tgl:hover { background: var(--pln-blue, #005b9c); }
    /* Semua sel tanggal bisa diklik — tanggal tanpa tamu tetap
       membuka pop-up dengan keterangan "tidak ada jadwal". */
    .jdwl-cell { cursor: pointer; transition: background 0.15s ease; }
    .jdwl-cell:hover { background: #f8fafc; }
    .jdwl-cell.punya-data:hover { background: #eff6ff; }
    html.theme-dark .jdwl-cell:hover,
    html.theme-dark .jdwl-cell.punya-data:hover { background: var(--panel); }

    /* Chip jumlah tamu per status di dalam sel */
    .jdwl-chips { display: flex; gap: 0.3rem; flex-wrap: wrap; align-items: center; }
    .jdwl-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.26rem;
        min-width: 30px;
        justify-content: center;
        height: 20px;
        padding: 0 0.4rem;
        border-radius: 999px;
        font-size: 0.7rem;
        font-weight: 700;
        font-variant-numeric: tabular-nums;
        line-height: 1;
        cursor: pointer;
    }
    .jdwl-chip.ch-disetujui { background: #dcfce7; color: #15803d; }
    .jdwl-chip.ch-ditolak   { background: #fee2e2; color: #dc2626; }
    .jdwl-chip.ch-menunggu  { background: #fef3c7; color: #b45309; }
    html.theme-dark .jdwl-chip.ch-disetujui { background: rgba(21,128,61,0.28); color: #86efac; }
    html.theme-dark .jdwl-chip.ch-ditolak   { background: rgba(220,38,38,0.28); color: #fca5a5; }
    html.theme-dark .jdwl-chip.ch-menunggu  { background: rgba(180,83,9,0.28); color: #fcd34d; }

    /* Sel kosong>Total terkecil: tanpa tampilan apa pun selain tanggal */

    /* Status badge (popup) — pola sama dengan .tamu-badge */
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
    .tamu-badge.menunggu   { background: #fef3c7; color: #b45309; }
    .tamu-badge.disetujui  { background: #dcfce7; color: #15803d; }
    .tamu-badge.ditolak    { background: #fee2e2; color: #dc2626; }
    .tamu-badge.selesai    { background: #f1f5f9; color: #64748b; }
    html.theme-dark .tamu-badge.menunggu  { background: rgba(180,83,9,0.25); color: #fcd34d; }
    html.theme-dark .tamu-badge.disetujui { background: rgba(21,128,61,0.25); color: #86efac; }
    html.theme-dark .tamu-badge.ditolak   { background: rgba(220,38,38,0.25); color: #fca5a5; }
    html.theme-dark .tamu-badge.selesai    { background: var(--panel); color: var(--ink-muted); }

    /* ---------- POP-UP DETAIL TANGGAL ---------- */
    .jdwl-modal-overlay {
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
    .jdwl-modal-overlay.show { display: flex; }
    .jdwl-modal {
        background: var(--bg-card, #fff);
        border-radius: 16px;
        width: 100%;
        max-width: 620px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: jdwlModalIn 0.2s ease both;
    }
    @keyframes jdwlModalIn {
        from { opacity: 0; transform: translateY(14px) scale(0.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    .jdwl-modal-header {
        position: sticky;
        top: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.6rem;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #eef2f7;
        background: var(--bg-card, #fff);
        z-index: 2;
    }
    html.theme-dark .jdwl-modal-header { border-color: var(--line); }
    .jdwl-modal-header .jdwl-modal-title {
        font-weight: 700;
        font-size: 0.92rem;
        color: var(--pln-text);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .jdwl-modal-header .jdwl-modal-title i { color: var(--pln-blue); }
    .jdwl-modal-close {
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
        flex-shrink: 0;
    }
    .jdwl-modal-close:hover { background: #e2e8f0; color: #dc2626; }
    html.theme-dark .jdwl-modal-close { background: var(--panel); color: var(--ink-muted); }

    .jdwl-modal-body { padding: 1rem 1.25rem 1.25rem; }

    /* Ringkasan jumlah per status dalam popup */
    .jdwl-modal-jumlah {
        display: flex;
        gap: 0.45rem;
        flex-wrap: wrap;
        margin-bottom: 0.9rem;
    }

    /* Kartu tamu di popup */
    .jdwl-tamu-card {
        border: 1px solid #eef2f7;
        border-radius: 12px;
        padding: 0.8rem 0.9rem;
        margin-bottom: 0.7rem;
        background: var(--bg-card, #fff);
    }
    .jdwl-tamu-card:last-child { margin-bottom: 0; }
    html.theme-dark .jdwl-tamu-card { border-color: var(--line); }
    .jdwl-tamu-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.6rem;
        flex-wrap: wrap;
        margin-bottom: 0.55rem;
        padding-bottom: 0.55rem;
        border-bottom: 1px dashed #eef2f7;
    }
    html.theme-dark .jdwl-tamu-head { border-color: var(--line); }
    .jdwl-tamu-nama {
        font-weight: 700;
        font-size: 0.86rem;
        color: var(--pln-text);
        display: flex;
        align-items: baseline;
        gap: 0.55rem;
        flex-wrap: wrap;
    }
    .jdwl-tamu-nik {
        font-size: 0.72rem;
        font-weight: 500;
        color: #9ca3af;
        font-family: monospace;
        letter-spacing: 0.4px;
    }
    .jdwl-wa-link {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.76rem;
        font-weight: 600;
        color: #16a34a;
        text-decoration: none;
    }
    .jdwl-wa-link:hover { text-decoration: underline; }

    /* Baris detail tabular: label kiri — nilai kanan */
    .jdwl-detail-row {
        display: grid;
        grid-template-columns: 118px 1fr;
        gap: 0.6rem;
        padding: 0.32rem 0;
        font-size: 0.79rem;
        line-height: 1.45;
    }
    .jdwl-detail-row .lbl { color: #9ca3af; font-weight: 600; font-size: 0.73rem; }
    .jdwl-detail-row .val { color: #374151; word-break: break-word; }
    html.theme-dark .jdwl-detail-row .val { color: var(--ink-body); }
    .jdwl-detail-row .val strong { font-weight: 700; }
    .jdwl-detail-row .val a { color: #2563eb; text-decoration: none; }
    .jdwl-detail-row .val a:hover { text-decoration: underline; }

    /* Empty state popup */
    .jdwl-empty {
        text-align: center;
        padding: 2.2rem 1rem;
    }
    .jdwl-empty .empty-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin: 0 auto 0.8rem;
    }
    .jdwl-empty h6 { font-weight: 700; color: var(--pln-text); margin-bottom: 0.25rem; }
    .jdwl-empty p { font-size: 0.8rem; color: #9ca3af; margin: 0; }

    /* ========== RESPONSIF ==========
       Tablet (≤1023px) → Mobile (≤767px) → HP kecil (≤479px).
       Kalender tetap 7 kolom di semua ukuran; sel, chip, dan
       pop-up menyesuaikan proporsional. */
    @media (max-width: 1023.98px) {
        .tamu-page-header { padding: 1.25rem 1.25rem; }
        .jdwl-cell { min-height: 100px; font-size: 0.8rem; }
        .jdwl-chip { height: 18px; font-size: 0.66rem; min-width: 28px; }
    }

    @media (max-width: 767.98px) {
        /* Header: tombol Kembali melebar penuh agar mudah dijangkau jempol */
        .tamu-page-header { padding: 1.1rem 1rem; }
        .tamu-page-header .header-row { flex-direction: column; align-items: stretch; }
        .tamu-page-header .header-actions { width: 100%; }
        .tamu-page-header .header-actions .btn-corp {
            display: flex;
            justify-content: center;
        }

        /* Bar navigasi bulan: label + tombol menumpuk rapi di tengah */
        .jdwl-nav { flex-direction: column; align-items: stretch; padding: 0.7rem 0.75rem; }
        .jdwl-nav .jdwl-bulan { align-items: center; text-align: center; }
        .jdwl-nav .jdwl-nav-btns { justify-content: center; }
        .jdwl-legend { padding: 0.55rem 0.75rem; gap: 0.9rem; }
        .jdwl-legend .legend-item { font-size: 0.7rem; }

        /* Sel kalender */
        .jdwl-cell { min-height: 84px; padding: 0.3rem 0.35rem; font-size: 0.78rem; }
        .jdwl-cell .jdwl-tgl { width: 27px; height: 27px; font-size: 0.8rem; }
        .jdwl-chip { height: 18px; font-size: 0.64rem; min-width: 27px; }

        /* Pop-up */
        .jdwl-modal-overlay { padding: 0.75rem; }
        .jdwl-modal { max-height: 92vh; }
        .jdwl-modal-header { padding: 0.8rem 1rem; }
        .jdwl-modal-header .jdwl-modal-title { font-size: 0.84rem; }
        .jdwl-modal-body { padding: 0.85rem 1rem 1rem; }
        .jdwl-detail-row { grid-template-columns: 96px 1fr; gap: 0.45rem; font-size: 0.76rem; }
        .jdwl-tamu-card { padding: 0.7rem 0.8rem; }
    }

    /* HP kecil (≤479px): sel & chip dipersempit lagi agar
       7 kolom tetap terbaca tanpa scroll horizontal */
    @media (max-width: 479.98px) {
        .jdwl-cell { min-height: 66px; padding: 0.2rem 0.22rem; font-size: 0.72rem; }
        .jdwl-cell .jdwl-tgl { width: 23px; height: 23px; font-size: 0.72rem; border-radius: 7px; }
        .jdwl-chip { height: 15px; font-size: 0.56rem; min-width: 22px; padding: 0 0.28rem; }
        .jdwl-head .jdwl-nama-hari { padding: 0.45rem 0.1rem; font-size: 0.62rem; letter-spacing: 0.3px; }
        .jdwl-legend { gap: 0.7rem; }
        .jdwl-nav .jdwl-bulan { font-size: 1.02rem; }
        .jdwl-nav .jdwl-bulan small { font-size: 0.64rem; }
        .jdwl-modal-jumlah { margin-bottom: 0.7rem; }
        .jdwl-tamu-head { gap: 0.4rem; }
        .jdwl-empty .empty-icon { width: 46px; height: 46px; font-size: 1rem; }
        .jdwl-detail-row { grid-template-columns: 88px 1fr; font-size: 0.74rem; }
    }
    @media (prefers-reduced-motion: reduce) {
        .jdwl-cell, .jdwl-modal, .jdwl-nav-btn, .jdwl-nav-today { transition: none !important; animation: none !important; }
    }
</style>
@endpush

@section('content')
@php
    /* Selalu bahasa Indonesia — tidak bergantung pada locale app,
       karena label di halaman admin lain berbahasa Indonesia. */
    $namaBulan = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $labelBulan = $namaBulan[$bulan->month] . ' ' . $bulan->year;
@endphp
{{-- ============================================
     PAGE HEADER
     ============================================ --}}
<div class="tamu-page-header">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-calendar-days" style="color: var(--pln-blue); margin-right: 0.5rem;"></i>Jadwal Tamu</h5>
            <p>Kalender kunjungan tamu — dalam diizinkan, ditolak, dan yang menunggu verifikasi.</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.tamu.index') }}" class="btn-corp btn-corp-primary" title="Kembali ke halaman Data Tamu">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Data Tamu
            </a>
        </div>
    </div>

    {{-- Ringkasan kunjungan pada bulan tampilan --}}
    <div class="tamu-stats-row">
        <div class="tamu-stat-card">
            <div class="stat-icon amber"><i class="fas fa-hourglass-half"></i></div>
            <div>
                <div class="stat-label">Menunggu Verifikasi</div>
                <div class="stat-value">{{ $statBulan['menunggu'] }}</div>
            </div>
        </div>
        <div class="tamu-stat-card">
            <div class="stat-icon green"><i class="fas fa-circle-check"></i></div>
            <div>
                <div class="stat-label">Diizinkan (Disetujui)</div>
                <div class="stat-value">{{ $statBulan['disetujui'] }}</div>
            </div>
        </div>
        <div class="tamu-stat-card">
            <div class="stat-icon red"><i class="fas fa-circle-xmark"></i></div>
            <div>
                <div class="stat-label">Ditolak</div>
                <div class="stat-value">{{ $statBulan['ditolak'] }}</div>
            </div>
        </div>
    </div>
</div>

{{-- ============================================
     KALENDER
     ============================================ --}}
<div class="jdwl-card">

    {{-- Navigasi bulan: prev / label / hari ini / next --}}
    <div class="jdwl-nav">
        <span class="jdwl-bulan">{{ $labelBulan }}
            <small>Jadwal kunjungan tamu — klik tanggal untuk detail</small>
        </span>
        <div class="jdwl-nav-btns">
            <a href="{{ route('admin.tamu.jadwal', ['bulan' => $bulan->copy()->subMonth()->format('Y-m')]) }}"
               class="jdwl-nav-btn" title="Bulan sebelumnya"><i class="fas fa-chevron-left"></i></a>
            <a href="{{ route('admin.tamu.jadwal') }}" class="jdwl-nav-today" title="Kembali ke bulan berjalan">
                Bulan ini
            </a>
            <a href="{{ route('admin.tamu.jadwal', ['bulan' => $bulan->copy()->addMonth()->format('Y-m')]) }}"
               class="jdwl-nav-btn" title="Bulan berikutnya"><i class="fas fa-chevron-right"></i></a>
        </div>
    </div>

    {{-- Legenda --}}
    <div class="jdwl-legend">
        <span class="legend-item"><span class="legend-dot dot-disetujui"></span> Diizinkan</span>
        <span class="legend-item"><span class="legend-dot dot-menunggu"></span> Belum diizinkan</span>
        <span class="legend-item"><span class="legend-dot dot-ditolak"></span> Ditolak</span>
    </div>

    {{-- Nama hari (Senin-first) --}}
    <div class="jdwl-grid jdwl-head">
        <div class="jdwl-nama-hari">Sen</div>
        <div class="jdwl-nama-hari">Sel</div>
        <div class="jdwl-nama-hari">Rab</div>
        <div class="jdwl-nama-hari">Kam</div>
        <div class="jdwl-nama-hari">Jum</div>
        <div class="jdwl-nama-hari">Sab</div>
        <div class="jdwl-nama-hari">Min</div>
    </div>

    {{-- Sel tanggal. Sel yang punya tamu bisa diklik → pop-up detail --}}
    <div class="jdwl-grid" id="jdwl-grid">
        @foreach ($sel as $selCell)
            <div class="jdwl-cell {{ $selCell['bulan_lain'] ? 'bulan-lain' : '' }} {{ $selCell['hari_ini'] ? 'hari-ini' : '' }} {{ $selCell['punya_data'] ? 'punya-data' : '' }}"
                 data-tanggal="{{ $selCell['tanggal_key'] }}"
                 role="button" tabindex="0"
                 aria-label="Detail tamu tanggal {{ $selCell['tanggal_key'] }}">
                <div class="jdwl-tgl">{{ $selCell['nomor'] }}</div>
                @if ($selCell['punya_data'])
                    <div class="jdwl-chips">
                        @if ($selCell['disetujui'])
                            <span class="jdwl-chip ch-disetujui" title="Diizinkan"><i class="fas fa-check fa-2xs"></i>{{ $selCell['disetujui'] }}</span>
                        @endif
                        @if ($selCell['menunggu'])
                            <span class="jdwl-chip ch-menunggu" title="Belum diizinkan"><i class="fas fa-clock fa-2xs"></i>{{ $selCell['menunggu'] }}</span>
                        @endif
                        @if ($selCell['ditolak'])
                            <span class="jdwl-chip ch-ditolak" title="Ditolak"><i class="fas fa-xmark fa-2xs"></i>{{ $selCell['ditolak'] }}</span>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>

{{-- ============================================
     POP-UP: DETAIL TAMU TANGGAL TERPILIH
     Isi datanya dikirim controller sebagai $perHari
     dan dirender ulang via JS di bawah.
     ============================================ --}}
<div class="jdwl-modal-overlay" id="jdwlModal">
    <div class="jdwl-modal" role="dialog" aria-modal="true" aria-labelledby="jdwlModalTitle">
        <div class="jdwl-modal-header">
            <h6 class="jdwl-modal-title" id="jdwlModalTitle">
                <i class="fas fa-calendar-check"></i>
                <span id="jdwlModalTanggal">—</span>
            </h6>
            <button type="button" class="jdwl-modal-close" id="jdwlModalClose" aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
        <div class="jdwl-modal-body" id="jdwlModalBody"><!-- diisi via JS --></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var perHari = @json($perHari);
    var modal = document.getElementById('jdwlModal');
    var modalBody = document.getElementById('jdwlModalBody');
    var modalTanggal = document.getElementById('jdwlModalTanggal');
    var btnClose = document.getElementById('jdwlModalClose');

    function buatBadgeTamuan(item) {
        var detailRows = '';

        function row(label, valueHtml) {
            if (valueHtml === undefined || valueHtml === null || valueHtml === '') return '';
            return '<div class="jdwl-detail-row">' +
                       '<span class="lbl">' + label + '</span>' +
                       '<span class="val">' + valueHtml + '</span>' +
                   '</div>';
        }

        var namaWa = item.nama;
        if (item.wa_url) {
            namaWa = '<a href="' + item.wa_url + '" target="_blank" rel="noopener" ' +
                     'style="text-decoration:none; color:inherit;">' + namaWa + '</a>';
        }

        var tujuan = [item.tujuan, item.jabatan, item.orang]
            .filter(function (v) { return v && v !== ''; })
            .join(' — ');

        var kontakWa = '';
        if (item.wa_url) {
            kontakWa = '<a href="' + item.wa_url + '" target="_blank" rel="noopener" class="jdwl-wa-link">' +
                       '<i class="fab fa-whatsapp"></i>' + (item.no_hp || '') + '</a>';
        } else if (item.no_hp) {
            kontakWa = '<span style="font-size:0.78rem; color:#6b7280;">' + item.no_hp + '</span>';
        }

        var dok = '';
        if (item.dokumen) {
            dok = '<a href="' + item.dokumen + '" target="_blank" rel="noopener">Dokumen pendukung</a>';
        } else {
            dok = '<span style="color:#cbd5e1;">—</span>';
        }

        return '<div class="jdwl-tamu-card">' +
                   '<div class="jdwl-tamu-head">' +
                       '<div class="jdwl-tamu-nama">' + namaWa +
                           (item.nik ? '<span class="jdwl-tamu-nik">NIK ' + item.nik + '</span>' : '') +
                       '</div>' +
                       '<span class="tamu-badge ' + item.status + '">' +
                           '<i class="fas fa-circle"></i> ' + item.status_label +
                       '</span>' +
                   '</div>' +
                   row('Jam Kunjungan', '<strong>' + item.jam + '</strong>' +
                       (item.jumlah_tamu ? ' · ' + item.jumlah_tamu + ' tamu' : '')) +
                   row('Instansi', item.instansi) +
                   row('Kontak', kontakWa + (item.email
                       ? '<br><a href="mailto:' + item.email + '">' + item.email + '</a>'
                       : item.email ? '<br>' + item.email : '')) +
                   row('Ditemui', tujuan) +
                   row('Keperluan', item.keperluan) +
                   row('Dokumen', dok) +
               '</div>';
    }

    function buatBadgeJumlah(daftar) {
        var hitung = { menunggu: 0, disetujui: 0, ditolak: 0 };
        (daftar || []).forEach(function (item) {
            if (item.status === 'menunggu') hitung.menunggu++;
            else if (item.status === 'ditolak') hitung.ditolak++;
            else hitung.disetujui++;   // disetujui / selesai = diizinkan
        });

        var chips = '';
        if (hitung.disetujui) {
            chips += '<span class="jdwl-chip ch-disetujui"><i class="fas fa-check fa-2xs"></i>' + hitung.disetujui + '</span>';
        }
        if (hitung.menunggu) {
            chips += '<span class="jdwl-chip ch-menunggu"><i class="fas fa-clock fa-2xs"></i>' + hitung.menunggu + '</span>';
        }
        if (hitung.ditolak) {
            chips += '<span class="jdwl-chip ch-ditolak"><i class="fas fa-xmark fa-2xs"></i>' + hitung.ditolak + '</span>';
        }
        return chips ? '<div class="jdwl-modal-jumlah">' + chips + '</div>' : '';
    }

    function formatTanggal(keyValue) {
        var t = new Date(keyValue + 'T00:00:00');
        return t.toLocaleDateString('id-ID', {
            weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
        });
    }

    function bukaModal(tanggalKey) {
        var data = perHari[tanggalKey] || { tamu: [] };
        var daftar = data.tamu || [];

        modalTanggal.textContent = formatTanggal(tanggalKey);

        if (daftar.length === 0) {
            modalBody.innerHTML =
                '<div class="jdwl-empty">' +
                    '<div class="empty-icon"><i class="fas fa-calendar-xmark"></i></div>' +
                    '<h6>Tidak ada jadwal tamu</h6>' +
                    '<p>Tidak ada pendaftaran kunjungan pada tanggal ini.</p>' +
                '</div>';
        } else {
            var chipsHtml = buatBadgeJumlah(daftar);
            var listHtml = chipsHtml;
            daftar.forEach(function (item) { listHtml += buatBadgeTamuan(item); });
            modalBody.innerHTML = listHtml;
        }

        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function tutupModal() {
        modal.classList.remove('show');
        document.body.style.overflow = '';
    }

    /* Klik sel kalender yang punya data */
    var grid = document.getElementById('jdwl-grid');
    if (grid) {
        grid.addEventListener('click', function (e) {
            var cell = e.target.closest('.jdwl-cell');
            if (cell && cell.dataset.tanggal) bukaModal(cell.dataset.tanggal);
        });

        grid.addEventListener('keydown', function (e) {
            var cell = e.target.closest('.jdwl-cell');
            if (cell && cell.dataset.tanggal && (e.key === 'Enter' || e.key === ' ')) {
                e.preventDefault();
                bukaModal(cell.dataset.tanggal);
            }
        });
    }

    /* Tutup popup: tombol, klik overlay, tombol Esc */
    btnClose.addEventListener('click', tutupModal);
    modal.addEventListener('click', function (e) { if (e.target === modal) tutupModal(); });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.classList.contains('show')) tutupModal();
    });
})();
</script>
@endpush
