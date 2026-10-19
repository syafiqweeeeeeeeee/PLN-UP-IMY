@extends('layouts.admin')

@section('title', 'Master Bidang — E-PPID PLN')
@section('page-title', 'Master Bidang')

@push('styles')
<style>
    /* MASTER BIDANG — daftar tabel hierarki (induk → sub-bidang).
       Markup mengikuti pola halaman portal lain (page header + tabel +
       action btn), class khusus diprefiks mb- agar tidak bentrok. */
    .mb-head {
        background: var(--bg-card, #fff);
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.25rem;
    }
    .mb-head .header-row {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem;
    }
    .mb-head h5 {
        font-size: 1.05rem; font-weight: 700; color: var(--pln-text, #1f2937);
        margin: 0 0 0.2rem;
    }
    .mb-head p { font-size: 0.78rem; color: #9ca3af; margin: 0; }
    .mb-stats { display: flex; gap: 0.6rem; flex-wrap: wrap; margin-top: 0.9rem; }
    .mb-stat {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.4rem 0.85rem; background: #f8fafc; border: 1px solid #e5e7eb;
        border-radius: 8px; font-size: 0.75rem; font-weight: 600; color: #4b5563;
    }

    .mb-error {
        background: #fef2f2; border: 1px solid #fecaca; color: #dc2626;
        border-radius: 12px; padding: 0.75rem 1rem; margin-bottom: 1rem;
        font-size: 0.8rem; font-weight: 500;
    }
    .mb-error ul { margin: 0.3rem 0 0; padding-left: 1.1rem; }

    .mb-table-wrap {
        background: var(--bg-card, #fff);
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px;
        overflow-x: auto;
    }
    .mb-table { width: 100%; border-collapse: collapse; min-width: 720px; }
    .mb-table th {
        text-align: left; padding: 0.7rem 0.9rem; font-size: 0.68rem;
        font-weight: 700; color: #6b7280; text-transform: uppercase;
        letter-spacing: 0.5px; border-bottom: 2px solid var(--border-color, #e5e7eb);
        white-space: nowrap; background: #f8fafc;
    }
    .mb-table td {
        padding: 0.65rem 0.9rem; border-bottom: 1px solid #f1f4f9;
        font-size: 0.8rem; color: #1f2937; vertical-align: middle;
    }
    .mb-table tbody tr:last-child td { border-bottom: none; }
    .mb-table tbody tr:hover { background: #e6f2fb; }

    .mb-tree { display: inline-flex; align-items: center; gap: 0.45rem; font-weight: 600; }
    .mb-tree .branch { color: #9ca3af; font-weight: 500; }
    .mb-tree .icon-root { color: var(--pln-blue, #0056a3); }
    .mb-tree .icon-child { color: var(--kry-teal, #00a3a3); }
    .mb-parent { color: #6b7280; }
    .mb-parent .none { color: #9ca3af; font-style: italic; }
    .mb-count-chip {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 0.15rem 0.55rem; border-radius: 999px;
        background: #eef6ff; color: #0b5394; font-size: 0.72rem; font-weight: 700;
    }
    .mb-count-chip.zero { background: #f1f5f9; color: #94a3b8; }

    .mb-actions { display: flex; gap: 0.3rem; align-items: center; }
    .mb-action-btn {
        width: 30px; height: 30px; border-radius: 8px; border: none;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 0.75rem; cursor: pointer; text-decoration: none;
        transition: all 0.15s ease;
    }
    .mb-action-btn.detail { background: #e6f2fb; color: var(--pln-cyan, #008fa8); }
    .mb-action-btn.edit   { background: #fef3c7; color: #b45309; }
    .mb-action-btn.delete { background: #fef2f2; color: #dc2626; }
    .mb-action-btn:hover { transform: translateY(-1px); }

    .mb-empty { text-align: center; padding: 3rem 1rem; color: #9ca3af; }
    .mb-empty i { font-size: 1.8rem; color: #cbd5e1; display: block; margin-bottom: 0.5rem; }
    .mb-empty h6 { font-size: 0.95rem; font-weight: 700; color: #6b7280; margin: 0 0 0.25rem; }
    .mb-empty p { font-size: 0.8rem; margin: 0; }
</style>
@endpush

@section('content')
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

{{-- ============ PAGE HEADER + AKSI ============ --}}
<div class="mb-head">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-sitemap" style="color: var(--pln-blue, #0056a3); margin-right: 0.5rem;"></i>Master Bidang</h5>
            <p>Daftar bidang berhirarki — induk dan sub-bidang. Kolom <b>Parent</b> menunjukkan induk tiap baris, indentasi menunjukkan tingkat.</p>
        </div>
        <div class="header-actions">
            @can('master_bidang.create')
            <a href="{{ route('admin.master_bidang.create') }}" class="btn-corp btn-corp-primary">
                <i class="fas fa-plus me-1"></i> Tambah Bidang
            </a>
            @endcan
        </div>
    </div>
    <div class="mb-stats">
        <span class="mb-stat"><i class="fas fa-building"></i> Total: {{ $total }}</span>
        <span class="mb-stat"><i class="fas fa-layer-group"></i> Tingkat Atas: {{ $roots }}</span>
        <span class="mb-stat"><i class="fa-solid fa-arrow-turn-down"></i> Sub-Bidang: {{ $total - $roots }}</span>
    </div>
</div>

@if ($errors->any())
    <div class="mb-error" role="alert">
        <i class="fas fa-circle-exclamation"></i>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- ============ TABEL HIERARKI BIDANG ============ --}}
<div class="mb-table-wrap">
    @if ($total === 0)
        <div class="mb-empty">
            <i class="fas fa-sitemap"></i>
            <h6>Belum ada data bidang</h6>
            <p>Tambahkan bidang pertama lewat tombol <b>Tambah Bidang</b>.</p>
        </div>
    @else
    <table class="mb-table">
        <thead>
            <tr>
                <th style="width: 52px;">No</th>
                <th>Nama Bidang</th>
                <th>Parent (Induk)</th>
                <th style="width: 110px;" class="text-center">Sub-Bidang</th>
                <th style="width: 130px;" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $i => $row)
            @php $bidang = $row['node']; @endphp
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>
                    <span class="mb-tree" style="padding-left: {{ $row['depth'] * 1.4 }}rem;">
                        @if ($row['depth'] > 0)
                            <span class="branch">└─</span>
                            <i class="fas fa-level-down-alt icon-child"></i>
                        @else
                            <i class="fas fa-folder-tree icon-root"></i>
                        @endif
                        {{ $bidang->nama }}
                        @if ($row['depth'] > 0)
                            <span class="mb-count-chip zero">tingkat {{ $row['depth'] + 1 }}</span>
                        @endif
                    </span>
                </td>
                <td class="mb-parent">
                    @if ($bidang->parent)
                        <i class="fas fa-arrow-up" style="font-size:0.65rem; margin-right:0.3rem;"></i>{{ $bidang->parent->nama }}
                    @else
                        <span class="none">— tingkat atas</span>
                    @endif
                </td>
                <td class="text-center">
                    <span class="mb-count-chip {{ ($bidang->children_count ?? 0) === 0 ? 'zero' : '' }}">
                        <i class="fas fa-sitemap"></i> {{ $bidang->children_count ?? 0 }}
                    </span>
                </td>
                <td>
                    <div class="mb-actions">
                        <a href="{{ route('admin.master_bidang.show', $bidang) }}" class="mb-action-btn detail" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        @can('master_bidang.edit')
                            <a href="{{ route('admin.master_bidang.edit', $bidang) }}" class="mb-action-btn edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                        @endcan
                        @can('master_bidang.delete')
                            <form method="POST" action="{{ route('admin.master_bidang.destroy', $bidang) }}"
                                  onsubmit="return confirm('Hapus bidang {{ addslashes($bidang->nama) }}? Pastikan tidak memiliki sub-bidang, jabatan, maupun data karyawan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mb-action-btn delete" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
