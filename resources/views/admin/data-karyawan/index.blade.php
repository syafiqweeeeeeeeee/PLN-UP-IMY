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

    /* Table — 24 kolom: scroll horizontal + 2 kolom identitas sticky */
    .dk-table-wrap {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow-x: auto;
    }
    .dk-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 2600px;
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
       saat scroll horizontal 24 kolom.

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
        .dk-summary-grid { grid-template-columns: repeat(2, 1fr); }
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
            <a href="{{ route('admin.karyawan_data.export', request()->only(['q', 'bidang', 'jabatan', 'grade', 'gender', 'status_kawin', 'unit'])) }}"
               class="btn-corp btn-corp-soft" title="Ekspor data sesuai filter aktif ke CSV (Excel-ready)">
                <i class="fas fa-file-export me-1"></i> Ekspor
            </a>
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
                <div class="stat-label">Jumlah Bidang</div>
                <div class="stat-value">{{ count($filterOptions['bidang'] ?? []) }}</div>
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
    </div>
@endif

{{-- ============ FILTER BAR ============ --}}
<form class="dk-filter-bar" method="GET" action="{{ route('admin.karyawan_data.index') }}">
    <div class="search-wrapper">
        <i class="fas fa-search"></i>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari NID atau NAMA...">
    </div>

    <select name="bidang" title="Filter BIDANG">
        <option value="">Semua Bidang</option>
        @foreach (($filterOptions['bidang'] ?? []) as $value)
            <option value="{{ $value }}" @selected(request('bidang') === $value)>{{ $value }}</option>
        @endforeach
    </select>
    <select name="jabatan" title="Filter JABATAN">
        <option value="">Semua Jabatan</option>
        @foreach (($filterOptions['jabatan'] ?? []) as $value)
            <option value="{{ $value }}" @selected(request('jabatan') === $value)>{{ $value }}</option>
        @endforeach
    </select>
    <select name="grade" title="Filter GRADE">
        <option value="">Semua Grade</option>
        @foreach (($filterOptions['grade'] ?? []) as $value)
            <option value="{{ $value }}" @selected(request('grade') === $value)>{{ $value }}</option>
        @endforeach
    </select>
    <select name="gender" title="Filter GENDER">
        <option value="">Semua Gender</option>
        @foreach ($genders as $key => $label)
            <option value="{{ $key }}" @selected(request('gender') === $key)>{{ $label }}</option>
        @endforeach
    </select>
    <select name="status_kawin" title="Filter STATUS KAWIN">
        <option value="">Semua Status Kawin</option>
        @foreach ($statusesKawin as $key => $label)
            <option value="{{ $key }}" @selected(request('status_kawin') === $key)>{{ $label }}</option>
        @endforeach
    </select>
    <select name="unit" title="Filter UNIT">
        <option value="">Semua Unit</option>
        @foreach (($filterOptions['unit'] ?? []) as $value)
            <option value="{{ $value }}" @selected(request('unit') === $value)>{{ $value }}</option>
        @endforeach
    </select>
    <select name="per_page" title="Baris per halaman">
        @foreach ($perPageOptions as $option)
            <option value="{{ $option }}" @selected($perPage === $option)>{{ $option }} / halaman</option>
        @endforeach
    </select>

    <button type="submit" class="btn-corp btn-corp-primary" style="padding:0.5rem 1rem; font-size:0.8rem;">
        <i class="fas fa-filter me-1"></i> Terapkan
    </button>
    @if (request()->anyFilled(['q', 'bidang', 'jabatan', 'grade', 'gender', 'status_kawin', 'unit']))
        <a href="{{ route('admin.karyawan_data.index') }}" class="btn-corp btn-corp-soft" style="padding:0.5rem 1rem; font-size:0.8rem;">
            <i class="fas fa-rotate-left"></i>
        </a>
    @endif
    <span class="filter-count">{{ $karyawans->total() }} karyawan</span>
</form>

{{-- ============ TABEL 24 KOLOM ============ --}}
<div class="dk-table-wrap">
    <table class="dk-table">
        <thead>
            <tr>
                @php $labels = array_values(\App\Models\Karyawan::COLUMNS_LABELS); @endphp
                @foreach ($labels as $i => $label)
                    <th class="{{ $i === 0 ? 'sticky-1' : ($i === 1 ? 'sticky-2' : '') }}">{{ $label }}</th>
                @endforeach
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($karyawans as $karyawan)
            <tr>
                <td class="sticky-1"><span class="dk-nid">{{ $karyawan->nid }}</span></td>
                <td class="sticky-2"><span class="dk-nama">{{ $karyawan->nama }}</span></td>
                <td>{{ $karyawan->bidang ?? '—' }}</td>
                <td>{{ $karyawan->jabatan ?? '—' }}</td>
                <td>{{ $karyawan->jenjang_jabatan ?? '—' }}</td>
                <td>{{ $karyawan->grade ?? '—' }}</td>
                <td>{{ $karyawan->institusi ?? '—' }}</td>
                <td>{{ $karyawan->organik ?? '—' }}</td>
                <td>{{ $karyawan->formatTanggal('tanggal_lahir') ?? '—' }}</td>
                <td>{{ $karyawan->formatTanggal('service_date') ?? '—' }}</td>
                <td>{{ $karyawan->formatTanggal('hire_date') ?? '—' }}</td>
                <td>{{ $karyawan->formatTanggal('retire_date') ?? '—' }}</td>
                <td>{{ $karyawan->formatTanggal('grade_date') ?? '—' }}</td>
                <td>{{ $karyawan->formatTanggal('tgl_jab') ?? '—' }}</td>
                <td>{{ $karyawan->telp ?? '—' }}</td>
                <td>{{ $karyawan->hp ?? '—' }}</td>
                <td>{{ $karyawan->email ?? '—' }}</td>
                <td>{{ $karyawan->fte !== null ? number_format($karyawan->fte, 2) : '—' }}</td>
                <td>{{ $karyawan->mims ?? '—' }}</td>
                <td>{{ $karyawan->tempat_lahir ?? '—' }}</td>
                <td>{{ $karyawan->agama ?? '—' }}</td>
                <td>{{ $karyawan->genderLabel() ?? '—' }}</td>
                <td>{{ $karyawan->statusKawinLabel() ?? '—' }}</td>
                <td>{{ $karyawan->unit ?? '—' }}</td>
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
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="26">
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
</script>
@endsection
