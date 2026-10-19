@extends('layouts.admin')

@section('title', 'Detail Bidang — E-PPID PLN')
@section('page-title', 'Detail Bidang')

@push('styles')
<style>
    /* MASTER BIDANG — halaman detail (hubungan parent & child jelas). */
    .mb-detail-head {
        background: var(--bg-card, #fff);
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.25rem;
    }
    .mb-detail-head .header-row {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem;
    }
    .mb-detail-head h5 {
        font-size: 1.05rem; font-weight: 700; color: var(--pln-text, #1f2937); margin: 0 0 0.2rem;
    }
    .mb-detail-head p { font-size: 0.78rem; color: #9ca3af; margin: 0; }
    .mb-detail-actions { display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center; }

    .mb-info-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 0.75rem; margin-bottom: 1.25rem;
    }
    .mb-info-card {
        background: var(--bg-card, #fff); border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 12px; padding: 0.9rem 1.1rem;
    }
    .mb-info-card .label {
        font-size: 0.68rem; font-weight: 700; color: #6b7280;
        text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.3rem;
    }
    .mb-info-card .value { font-size: 0.95rem; font-weight: 700; color: var(--pln-text, #1f2937); }
    .mb-info-card .value.big { font-size: 1.3rem; }
    .mb-info-card a { color: var(--pln-blue, #0056a3); text-decoration: none; }
    .mb-info-card a:hover { text-decoration: underline; }
    .mb-info-card .muted { color: #9ca3af; font-style: italic; font-weight: 500; font-size: 0.85rem; }

    .mb-panel {
        background: var(--bg-card, #fff); border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px; padding: 1.1rem 1.4rem; margin-bottom: 1.1rem;
    }
    .mb-panel h6 {
        font-size: 0.85rem; font-weight: 700; color: var(--pln-text, #1f2937);
        margin: 0 0 0.7rem; display: flex; align-items: center; gap: 0.45rem;
    }
    .mb-panel h6 i { color: var(--pln-blue, #0056a3); }
    .mb-rel-list { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 0.4rem; }
    .mb-rel-list li {
        display: flex; align-items: center; gap: 0.55rem;
        padding: 0.5rem 0.75rem; background: #f8fafc; border: 1px solid #eef2f7;
        border-radius: 10px; font-size: 0.8rem; color: #1f2937;
    }
    .mb-rel-list li i { color: var(--kry-teal, #00a3a3); font-size: 0.75rem; }
    .mb-rel-list li a { color: var(--pln-blue, #0056a3); font-weight: 600; text-decoration: none; }
    .mb-rel-list li a:hover { text-decoration: underline; }
    .mb-rel-empty { font-size: 0.8rem; color: #9ca3af; font-style: italic; margin: 0; }
    .mb-usage-warn { color: #b45309; font-weight: 600; }
    .mb-usage-ok { color: #16a34a; font-weight: 600; }
</style>
@endpush

@section('content')
<div class="mb-detail-head">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-folder-tree" style="color: var(--pln-blue, #0056a3); margin-right: 0.5rem;"></i>{{ $bidang->nama }}</h5>
            <p>
                @if ($parent)
                    Induk: <b>{{ $parent->nama }}</b> ·
                @else
                    <b>Bidang tingkat atas</b> ·
                @endif
                {{ $children->count() }} sub-bidang · {{ $jabatans->count() }} jabatan
            </p>
        </div>
        <div class="mb-detail-actions">
            @can('master_bidang.edit')
            <a href="{{ route('admin.master_bidang.edit', $bidang) }}" class="btn-corp btn-corp-primary">
                <i class="fas fa-pen me-1"></i> Edit
            </a>
            @endcan
            @can('master_bidang.delete')
            <form method="POST" action="{{ route('admin.master_bidang.destroy', $bidang) }}"
                  onsubmit="return confirm('Hapus bidang {{ addslashes($bidang->nama) }}? Pastikan tidak memiliki sub-bidang, jabatan, maupun data karyawan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-corp btn-corp-soft" style="color:#dc2626;">
                    <i class="fas fa-trash me-1"></i> Hapus
                </button>
            </form>
            @endcan
            <a href="{{ route('admin.master_bidang.index') }}" class="btn-corp btn-corp-soft">
                <i class="fas fa-arrow-left me-1"></i> Daftar Bidang
            </a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="mb-panel" style="border-color:#fecaca; background:#fef2f2; color:#dc2626;">
        <ul style="margin:0; padding-left:1.1rem; font-size:0.8rem; font-weight:500;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-info-grid">
    <div class="mb-info-card">
        <div class="label">Parent (Induk)</div>
        <div class="value">
            @if ($parent)
                <a href="{{ route('admin.master_bidang.show', $parent) }}">{{ $parent->nama }}</a>
            @else
                <span class="muted">— tingkat atas (tanpa induk)</span>
            @endif
        </div>
    </div>
    <div class="mb-info-card">
        <div class="label">Sub-Bidang (Child)</div>
        <div class="value big">{{ $children->count() }}</div>
    </div>
    <div class="mb-info-card">
        <div class="label">Jabatan di Bidang Ini</div>
        <div class="value big">{{ $jabatans->count() }}</div>
    </div>
    <div class="mb-info-card">
        <div class="label">Data Karyawan Memakai Nama Ini</div>
        <div class="value big {{ $karyawanUsage > 0 ? 'mb-usage-warn' : '' }}">{{ $karyawanUsage }}</div>
    </div>
</div>

<div class="mb-panel">
    <h6><i class="fas fa-sitemap"></i> Sub-Bidang (Child)</h6>
    @if ($children->isEmpty())
        <p class="mb-rel-empty">Belum ada sub-bidang di bawah bidang ini.</p>
    @else
        <ul class="mb-rel-list">
            @foreach ($children as $child)
            <li>
                <i class="fas fa-level-down-alt"></i>
                <a href="{{ route('admin.master_bidang.show', $child) }}">{{ $child->nama }}</a>
                <span style="color:#9ca3af; font-size:0.72rem;">· {{ $child->children()->count() }} sub-bidang lagi</span>
            </li>
            @endforeach
        </ul>
    @endif
</div>

<div class="mb-panel">
    <h6><i class="fas fa-user-tie"></i> Jabatan di Bidang Ini</h6>
    @if ($jabatans->isEmpty())
        <p class="mb-rel-empty">Belum ada jabatan yang terikat ke bidang ini.</p>
    @else
        <ul class="mb-rel-list">
            @foreach ($jabatans as $jabatan)
            <li>
                <i class="fas fa-id-badge"></i>
                @can('master_jabatan.view')
                    <a href="{{ route('admin.master_jabatan.show', $jabatan) }}">{{ $jabatan->nama }}</a>
                @else
                    <span style="font-weight:600;">{{ $jabatan->nama }}</span>
                @endcan
            </li>
            @endforeach
        </ul>
    @endif
</div>

<div class="mb-panel">
    <h6><i class="fas fa-users"></i> Pemakaian pada Data Karyawan</h6>
    @if ($karyawanUsage > 0)
        <p class="mb-rel-empty" style="font-style:normal;">
            <span class="mb-usage-warn"><i class="fas fa-triangle-exclamation"></i>
            {{ $karyawanUsage }} data karyawan memiliki kolom BIDANG = "{{ $bidang->nama }}"</span> —
            bidang ini <b>tidak bisa dihapus</b> sampai pemakaian dipindahkan. Kolom data karyawan tidak diubah otomatis oleh fitur ini.
        </p>
    @else
        <p class="mb-rel-empty" style="font-style:normal;">
            <span class="mb-usage-ok"><i class="fas fa-circle-check"></i> Tidak ada data karyawan</span> yang memakai nama bidang ini — aman dihapus bila tidak punya sub-bidang/jabatan.
        </p>
    @endif
</div>
@endsection
