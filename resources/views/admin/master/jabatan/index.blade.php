@extends('layouts.admin')

@section('title', 'Master Jabatan — E-PPID PLN')
@section('page-title', 'Master Jabatan')

@push('styles')
<style>
    /* MASTER JABATAN — daftar tabel hierarki (parent → child) dengan
       kolom Bidang. Class diprefiks mj- agar tidak bentrok. */
    .mj-head {
        background: var(--bg-card, #fff);
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.25rem;
    }
    .mj-head .header-row {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem;
    }
    .mj-head h5 {
        font-size: 1.05rem; font-weight: 700; color: var(--pln-text, #1f2937);
        margin: 0 0 0.2rem;
    }
    .mj-head p { font-size: 0.78rem; color: #9ca3af; margin: 0; }
    .mj-stats { display: flex; gap: 0.6rem; flex-wrap: wrap; margin-top: 0.9rem; }
    .mj-stat {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.4rem 0.85rem; background: #f8fafc; border: 1px solid #e5e7eb;
        border-radius: 8px; font-size: 0.75rem; font-weight: 600; color: #4b5563;
    }

    .mj-error {
        background: #fef2f2; border: 1px solid #fecaca; color: #dc2626;
        border-radius: 12px; padding: 0.75rem 1rem; margin-bottom: 1rem;
        font-size: 0.8rem; font-weight: 500;
    }
    .mj-error ul { margin: 0.3rem 0 0; padding-left: 1.1rem; }

    .mj-table-wrap {
        background: var(--bg-card, #fff);
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px;
        overflow-x: auto;
    }
    .mj-table { width: 100%; border-collapse: collapse; min-width: 900px; }
    .mj-table th {
        text-align: left; padding: 0.7rem 0.9rem; font-size: 0.68rem;
        font-weight: 700; color: #6b7280; text-transform: uppercase;
        letter-spacing: 0.5px; border-bottom: 2px solid var(--border-color, #e5e7eb);
        white-space: nowrap; background: #f8fafc;
    }
    .mj-table td {
        padding: 0.65rem 0.9rem; border-bottom: 1px solid #f1f4f9;
        font-size: 0.8rem; color: #1f2937; vertical-align: middle;
    }
    .mj-table tbody tr:last-child td { border-bottom: none; }
    .mj-table tbody tr:hover { background: #e6f2fb; }

    .mj-tree { display: inline-flex; align-items: center; gap: 0.45rem; font-weight: 600; }
    .mj-tree .branch { color: #9ca3af; font-weight: 500; }
    .mj-tree .icon-root { color: var(--pln-blue, #0056a3); }
    .mj-tree .icon-child { color: var(--kry-teal, #00a3a3); }
    .mj-bidang-chip {
        display: inline-flex; align-items: center; gap: 0.35rem;
        padding: 0.18rem 0.6rem; border-radius: 999px;
        background: #eef6ff; color: #0b5394; font-size: 0.72rem; font-weight: 700;
        white-space: nowrap;
    }
    .mj-bidang-chip i { font-size: 0.62rem; }
    .mj-parent { color: #6b7280; }
    .mj-parent .none { color: #9ca3af; font-style: italic; }
    .mj-count-chip {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 0.15rem 0.55rem; border-radius: 999px;
        background: #eef6ff; color: #0b5394; font-size: 0.72rem; font-weight: 700;
    }
    .mj-count-chip.zero { background: #f1f5f9; color: #94a3b8; }

    .mj-actions { display: flex; gap: 0.3rem; align-items: center; }
    .mj-action-btn {
        width: 30px; height: 30px; border-radius: 8px; border: none;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 0.75rem; cursor: pointer; text-decoration: none;
        transition: all 0.15s ease;
    }
    .mj-action-btn.detail { background: #e6f2fb; color: var(--pln-cyan, #008fa8); }
    .mj-action-btn.edit   { background: #fef3c7; color: #b45309; }
    .mj-action-btn.delete { background: #fef2f2; color: #dc2626; }
    .mj-action-btn:hover { transform: translateY(-1px); }

    .mj-empty { text-align: center; padding: 3rem 1rem; color: #9ca3af; }
    .mj-empty i { font-size: 1.8rem; color: #cbd5e1; display: block; margin-bottom: 0.5rem; }
    .mj-empty h6 { font-size: 0.95rem; font-weight: 700; color: #6b7280; margin: 0 0 0.25rem; }
    .mj-empty p { font-size: 0.8rem; margin: 0; }
</style>
@endpush

@section('content')
@if (session('success'))
    {{-- Flash sukses → pop-up SweetAlert tengah layar (AdminSwal di layout). --}}
    <div hidden data-swal-success="{{ session('success') }}"></div>
@endif
@if (session('warning'))
    {{-- Flash peringatan → pop-up SweetAlert tengah layar (AdminSwal di layout). --}}
    <div hidden data-swal-warning="{{ session('warning') }}"></div>
@endif

{{-- ============ PAGE HEADER + AKSI ============ --}}
<div class="mj-head">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-user-tie" style="color: var(--pln-blue, #0056a3); margin-right: 0.5rem;"></i>Master Jabatan</h5>
            <p>Daftar jabatan berhirarki beserta bidangnya. Kolom <b>Bidang</b> = tempat jabatan, <b>Parent</b> = induk jabatan, indentasi = tingkat.</p>
        </div>
        <div class="header-actions">
            @can('master_jabatan.create')
            <a href="{{ route('admin.master_jabatan.create') }}" class="btn-corp btn-corp-primary">
                <i class="fas fa-plus me-1"></i> Tambah Jabatan
            </a>
            @endcan
        </div>
    </div>
    <div class="mj-stats">
        <span class="mj-stat"><i class="fas fa-id-badge"></i> Total: {{ $total }}</span>
        <span class="mj-stat"><i class="fas fa-layer-group"></i> Tingkat Atas: {{ $roots }}</span>
        <span class="mj-stat"><i class="fa-solid fa-arrow-turn-down"></i> Jabatan Anak: {{ $total - $roots }}</span>
        <span class="mj-stat"><i class="fas fa-building"></i> Bidang: {{ $bidangs->count() }}</span>
    </div>
</div>

@if ($errors->any())
    <div class="mj-error" role="alert">
        <i class="fas fa-circle-exclamation"></i>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- ============ TABEL HIERARKI JABATAN ============ --}}
<div class="mj-table-wrap">
    @if ($total === 0)
        <div class="mj-empty">
            <i class="fas fa-user-tie"></i>
            <h6>Belum ada data jabatan</h6>
            <p>
                @if ($bidangs->isEmpty())
                    Tambahkan <b>Master Bidang</b> terlebih dahulu, lalu tambah jabatan lewat tombol <b>Tambah Jabatan</b>.
                @else
                    Tambahkan jabatan pertama lewat tombol <b>Tambah Jabatan</b>.
                @endif
            </p>
        </div>
    @else
    <table class="mj-table">
        <thead>
            <tr>
                <th style="width: 52px;">No</th>
                <th>Nama Jabatan</th>
                <th>Bidang</th>
                <th>Parent (Induk Jabatan)</th>
                <th style="width: 110px;" class="text-center">Anak</th>
                <th style="width: 130px;" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $i => $row)
            @php $jabatan = $row['node']; @endphp
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>
                    <span class="mj-tree" style="padding-left: {{ $row['depth'] * 1.4 }}rem;">
                        @if ($row['depth'] > 0)
                            <span class="branch">└─</span>
                            <i class="fas fa-level-down-alt icon-child"></i>
                        @else
                            <i class="fas fa-id-badge icon-root"></i>
                        @endif
                        {{ $jabatan->nama }}
                        @if ($row['depth'] > 0)
                            <span class="mj-count-chip zero">tingkat {{ $row['depth'] + 1 }}</span>
                        @endif
                    </span>
                </td>
                <td>
                    @if ($jabatan->bidang)
                        <span class="mj-bidang-chip"><i class="fas fa-building"></i> {{ $jabatan->bidang->nama }}</span>
                    @else
                        <span style="color:#dc2626; font-size:0.75rem; font-weight:600;">Bidang terhapus</span>
                    @endif
                </td>
                <td class="mj-parent">
                    @if ($jabatan->parent)
                        <i class="fas fa-arrow-up" style="font-size:0.65rem; margin-right:0.3rem;"></i>{{ $jabatan->parent->nama }}
                    @else
                        <span class="none">— tingkat atas</span>
                    @endif
                </td>
                <td class="text-center">
                    <span class="mj-count-chip {{ ($jabatan->children_count ?? 0) === 0 ? 'zero' : '' }}">
                        <i class="fas fa-sitemap"></i> {{ $jabatan->children_count ?? 0 }}
                    </span>
                </td>
                <td>
                    <div class="mj-actions">
                        <a href="{{ route('admin.master_jabatan.show', $jabatan) }}" class="mj-action-btn detail" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        @can('master_jabatan.edit')
                            <a href="{{ route('admin.master_jabatan.edit', $jabatan) }}" class="mj-action-btn edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                        @endcan
                        @can('master_jabatan.delete')
                            <form method="POST" action="{{ route('admin.master_jabatan.destroy', $jabatan) }}"
                                  data-swal-confirm-title="Hapus Jabatan?"
                                  data-swal-confirm="Hapus jabatan {{ $jabatan->nama }}? Pastikan tidak memiliki jabatan anak maupun data karyawan.">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mj-action-btn delete" title="Hapus">
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
