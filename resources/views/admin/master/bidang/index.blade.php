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

    /* ==== MODAL "PETAKAN KODE LEGACY" (pola modal Data Karyawan) ==== */
    .mb-modal-overlay {
        position: fixed; inset: 0;
        background: rgba(15, 23, 42, 0.55);
        backdrop-filter: blur(2px);
        display: none; align-items: center; justify-content: center;
        z-index: 1055; padding: 1.25rem;
    }
    .mb-modal-overlay.show { display: flex; }
    .mb-modal {
        background: #fff; border-radius: 16px; width: 100%; max-width: 620px;
        max-height: 90vh; overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }
    .mb-modal-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 1rem 1.25rem; border-bottom: 1px solid var(--border-color, #e5e7eb);
    }
    .mb-modal-header h6 { font-weight: 700; font-size: 0.92rem; color: var(--pln-text, #1f2937); margin: 0; }
    .mb-modal-close {
        background: #f1f5f9; border: none; width: 30px; height: 30px;
        border-radius: 8px; color: #64748b; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
    }
    .mb-modal-body { padding: 1.25rem; font-size: 0.85rem; }
    .mb-summary-grid {
        display: grid; grid-template-columns: repeat(4, 1fr);
        gap: 0.5rem; margin: 0.75rem 0;
    }
    .mb-summary-item {
        background: #f8fafc; border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 10px; padding: 0.6rem; text-align: center;
    }
    .mb-summary-item b { display: block; font-size: 1.15rem; color: var(--pln-text, #1f2937); }
    .mb-summary-item small { font-size: 0.68rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.4px; }
    .mb-code-list {
        max-height: 190px; overflow-y: auto; margin: 0.5rem 0 0;
        padding-left: 1.1rem; font-size: 0.76rem; color: #4b5563;
    }
    .mb-code-list li + li { margin-top: 0.15rem; }
    .mb-note { font-size: 0.75rem; color: #b45309; font-weight: 600; margin: -0.3rem 0 0.8rem; }
    @media (max-width: 767.98px) {
        .mb-summary-grid { grid-template-columns: repeat(2, 1fr); }
    }
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

{{-- ============ RINGKASAN PENERAPAN "PETAKAN KODE LEGACY" ============ --}}
@if (session('map_summary'))
@php $mbSummary = session('map_summary'); @endphp
<div class="mb-summary-grid" role="status" style="max-width: 760px;">
    <div class="mb-summary-item"><b style="color:#15803d;">{{ $mbSummary['rows_updated'] }}</b><small>Baris Diperbarui</small></div>
    <div class="mb-summary-item"><b>{{ $mbSummary['dept_filled'] }}</b><small>Kode Bidang</small></div>
    <div class="mb-summary-item"><b>{{ $mbSummary['sub_filled'] }}</b><small>Kode Sub-Bidang</small></div>
    <div class="mb-summary-item"><b>{{ $mbSummary['already_coded'] + $mbSummary['inherited'] }}</b><small>Sudah / Mewarisi</small></div>
</div>
@if ($mbSummary['no_code_total'] > 0)
<p style="font-size:0.76rem; color:#b45309; font-weight:600; margin:-0.3rem 0 1rem;">
    <i class="fas fa-circle-exclamation me-1"></i>{{ $mbSummary['no_code_total'] }} baris masih tanpa kode bidang —
    isi lewat form <b>Edit Bidang</b> bila baris itu perlu jadi target Link Kerja / unit akun.
</p>
@endif
@endif

{{-- ============ PAGE HEADER + AKSI ============ --}}
<div class="mb-head">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-sitemap" style="color: var(--pln-blue, #0056a3); margin-right: 0.5rem;"></i>Master Bidang</h5>
            <p>Daftar bidang berhirarki — induk dan sub-bidang. Kolom <b>Parent</b> menunjukkan induk tiap baris, indentasi menunjukkan tingkat.</p>
        </div>
        <div class="header-actions">
            @can('master_bidang.edit')
            <button type="button" id="mbMapLegacyBtn" class="btn-corp btn-corp-soft" style="margin-right: 0.5rem;">
                <i class="fas fa-code-branch me-1"></i> Petakan Kode Legacy
            </button>
            @endcan
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

{{-- ============ MODAL PETAKAN KODE LEGACY ============ --}}
@can('master_bidang.edit')
<div class="mb-modal-overlay" id="mbMapLegacyModal" onclick="if(event.target===this) this.classList.remove('show')">
    <div class="mb-modal">
        <div class="mb-modal-header">
            <h6><i class="fas fa-code-branch" style="color: var(--pln-blue, #0056a3);"></i> Petakan Kode Legacy</h6>
            <button type="button" class="mb-modal-close" onclick="document.getElementById('mbMapLegacyModal').classList.remove('show')"><i class="fas fa-xmark"></i></button>
        </div>
        <div class="mb-modal-body">
            <p style="color:#6b7280; font-size:0.8rem; margin:0 0 0.8rem;">
                Mengisi <b>department_code</b> &amp; <b>sub_department_code</b> yang masih kosong dari nama baris:
                pemetaan nama persis dulu, lalu pencocokan terhadap daftar kode legacy (hanya bila hasilnya tunggal —
                tidak menebak). Kode yang <b>sudah ada tidak ditimpa</b>, baris yang tidak cocok <b>tidak diubah</b>,
                dan sub-bidang tetap mewarisi kode induknya. Aman dijalankan berulang.
            </p>

            <div id="mbMapLegacyPreview" class="mb-summary-grid">
                <div class="mb-summary-item"><small>Memuat pratinjau…</small></div>
            </div>
            <div id="mbMapLegacyLists" style="font-size:0.76rem; color:#4b5563;"></div>
            <div id="mbMapLegacyNote" class="mb-note"></div>

            <form action="{{ route('admin.master_bidang.map-legacy') }}" method="POST">
                @csrf
                <div style="display:flex; gap:0.6rem; justify-content:flex-end;">
                    <button type="button" class="btn-corp btn-corp-soft" onclick="document.getElementById('mbMapLegacyModal').classList.remove('show')">Batal</button>
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
     Pratinjau pemetaan kode legacy — diambil saat modal dibuka
     (GET JSON, TANPA menulis apa pun). Script INLINE di dalam
     content agar router.js mengeksekusinya ulang setelah navigasi
     SPA (konsisten dengan halaman Data Karyawan).
     ============================================================ --}}
<script>
    (function () {
        var openBtn  = document.getElementById('mbMapLegacyBtn');
        var modal    = document.getElementById('mbMapLegacyModal');
        var preview  = document.getElementById('mbMapLegacyPreview');
        var lists    = document.getElementById('mbMapLegacyLists');
        var note     = document.getElementById('mbMapLegacyNote');
        if (!openBtn || !modal || !preview || openBtn.dataset.mbDdBound === '1') return;
        openBtn.dataset.mbDdBound = '1';

        var previewUrl = @json(route('admin.master_bidang.map-legacy-preview'));

        function item(value, label) {
            return '<div class="mb-summary-item"><b>' + value + '</b><small>' + label + '</small></div>';
        }

        function render(data) {
            preview.innerHTML =
                item(data.rows_updated, 'Baris Akan Diperbarui') +
                item(data.dept_filled, 'Kode Bidang Terisi') +
                item(data.sub_filled, 'Kode Sub-Bidang Terisi') +
                item(data.already_coded + data.inherited + data.root_no_code, 'Sudah / Mewarisi');

            var parts = [];
            if (data.items.length) {
                parts.push('<b>Akan diubah:</b><ul class="mb-code-list">' + data.items.map(function (row) {
                    var target = row.department_code ? 'bidang=' + row.department_code : '';
                    if (row.sub_department_code) target += (target ? ', ' : '') + 'sub=' + row.sub_department_code;
                    return '<li>' + row.nama + ' → ' + target + '</li>';
                }).join('') + '</ul>');
            }
            lists.innerHTML = parts.join('');

            note.innerHTML = data.no_code_total > 0
                ? '<i class="fas fa-circle-exclamation me-1"></i>' + data.no_code_total
                    + ' baris tetap tanpa kode bidang (tidak diubah): ' + data.no_code.join(' · ')
                    + ' — isi manual lewat form Edit Bidang bila perlu.'
                : (data.rows_updated === 0
                    ? '<i class="fas fa-circle-check me-1" style="color:#15803d;"></i>Semua kode sudah terisi — tidak ada perubahan.'
                    : '');
        }

        function load() {
            preview.innerHTML = '<div class="mb-summary-item"><small>Memuat pratinjau…</small></div>';
            lists.innerHTML = '';
            note.innerHTML = '';

            fetch(previewUrl, {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin'
            })
                .then(function (res) { if (!res.ok) throw new Error('HTTP ' + res.status); return res.json(); })
                .then(render)
                .catch(function () {
                    preview.innerHTML = '<div class="mb-summary-item"><small style="color:#dc2626;">Pratinjau gagal dimuat — tutup lalu buka lagi.</small></div>';
                });
        }

        openBtn.addEventListener('click', function () {
            modal.classList.add('show');
            load();
        });
    })();
</script>
@endsection
