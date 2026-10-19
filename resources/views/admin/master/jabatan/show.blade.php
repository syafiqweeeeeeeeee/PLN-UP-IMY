@extends('layouts.admin')

@section('title', 'Detail Jabatan — E-PPID PLN')
@section('page-title', 'Detail Jabatan')

@push('styles')
<style>
    /* MASTER JABATAN — halaman detail (bidang, parent & child jelas). */
    .mj-detail-head {
        background: var(--bg-card, #fff);
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.25rem;
    }
    .mj-detail-head .header-row {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem;
    }
    .mj-detail-head h5 {
        font-size: 1.05rem; font-weight: 700; color: var(--pln-text, #1f2937); margin: 0 0 0.2rem;
    }
    .mj-detail-head p { font-size: 0.78rem; color: #9ca3af; margin: 0; }
    .mj-detail-actions { display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center; }

    .mj-info-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 0.75rem; margin-bottom: 1.25rem;
    }
    .mj-info-card {
        background: var(--bg-card, #fff); border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 12px; padding: 0.9rem 1.1rem;
    }
    .mj-info-card .label {
        font-size: 0.68rem; font-weight: 700; color: #6b7280;
        text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.3rem;
    }
    .mj-info-card .value { font-size: 0.95rem; font-weight: 700; color: var(--pln-text, #1f2937); }
    .mj-info-card .value.big { font-size: 1.3rem; }
    .mj-info-card a { color: var(--pln-blue, #0056a3); text-decoration: none; }
    .mj-info-card a:hover { text-decoration: underline; }
    .mj-info-card .muted { color: #9ca3af; font-style: italic; font-weight: 500; font-size: 0.85rem; }

    .mj-panel {
        background: var(--bg-card, #fff); border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 14px; padding: 1.1rem 1.4rem; margin-bottom: 1.1rem;
    }
    .mj-panel h6 {
        font-size: 0.85rem; font-weight: 700; color: var(--pln-text, #1f2937);
        margin: 0 0 0.7rem; display: flex; align-items: center; gap: 0.45rem;
    }
    .mj-panel h6 i { color: var(--pln-blue, #0056a3); }
    .mj-rel-list { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 0.4rem; }
    .mj-rel-list li {
        display: flex; align-items: center; gap: 0.55rem;
        padding: 0.5rem 0.75rem; background: #f8fafc; border: 1px solid #eef2f7;
        border-radius: 10px; font-size: 0.8rem; color: #1f2937;
    }
    .mj-rel-list li i { color: var(--kry-teal, #00a3a3); font-size: 0.75rem; }
    .mj-rel-list li a { color: var(--pln-blue, #0056a3); font-weight: 600; text-decoration: none; }
    .mj-rel-list li a:hover { text-decoration: underline; }
    .mj-rel-empty { font-size: 0.8rem; color: #9ca3af; font-style: italic; margin: 0; }
    .mj-usage-warn { color: #b45309; font-weight: 600; }
    .mj-usage-ok { color: #16a34a; font-weight: 600; }
</style>
@endpush

@section('content')
<div class="mj-detail-head">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-id-badge" style="color: var(--pln-blue, #0056a3); margin-right: 0.5rem;"></i>{{ $jabatan->nama }}</h5>
            <p>
                Bidang: <b>{{ $bidang?->nama ?? '—' }}</b> ·
                @if ($parent)
                    Induk: <b>{{ $parent->nama }}</b> ·
                @else
                    <b>Jabatan tingkat atas</b> ·
                @endif
                {{ $children->count() }} jabatan anak
            </p>
        </div>
        <div class="mj-detail-actions">
            @can('master_jabatan.edit')
            <a href="{{ route('admin.master_jabatan.edit', $jabatan) }}" class="btn-corp btn-corp-primary">
                <i class="fas fa-pen me-1"></i> Edit
            </a>
            @endcan
            @can('master_jabatan.delete')
            <form method="POST" action="{{ route('admin.master_jabatan.destroy', $jabatan) }}"
                  onsubmit="return confirm('Hapus jabatan {{ addslashes($jabatan->nama) }}? Pastikan tidak memiliki jabatan anak maupun data karyawan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-corp btn-corp-soft" style="color:#dc2626;">
                    <i class="fas fa-trash me-1"></i> Hapus
                </button>
            </form>
            @endcan
            <a href="{{ route('admin.master_jabatan.index') }}" class="btn-corp btn-corp-soft">
                <i class="fas fa-arrow-left me-1"></i> Daftar Jabatan
            </a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="mj-panel" style="border-color:#fecaca; background:#fef2f2; color:#dc2626;">
        <ul style="margin:0; padding-left:1.1rem; font-size:0.8rem; font-weight:500;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mj-info-grid">
    <div class="mj-info-card">
        <div class="label">Bidang</div>
        <div class="value">
            @if ($bidang)
                <a href="{{ route('admin.master_bidang.show', $bidang) }}">{{ $bidang->nama }}</a>
            @else
                <span class="muted">— tidak terhubung</span>
            @endif
        </div>
    </div>
    <div class="mj-info-card">
        <div class="label">Parent (Induk Jabatan)</div>
        <div class="value">
            @if ($parent)
                <a href="{{ route('admin.master_jabatan.show', $parent) }}">{{ $parent->nama }}</a>
            @else
                <span class="muted">— tingkat atas (tanpa induk)</span>
            @endif
        </div>
    </div>
    <div class="mj-info-card">
        <div class="label">Jabatan Anak (Child)</div>
        <div class="value big">{{ $children->count() }}</div>
    </div>
    <div class="mj-info-card">
        <div class="label">Data Karyawan Memakai Nama Ini</div>
        <div class="value big {{ $karyawanUsage > 0 ? 'mj-usage-warn' : '' }}">{{ $karyawanUsage }}</div>
    </div>
</div>

<div class="mj-panel">
    <h6><i class="fas fa-sitemap"></i> Jabatan Anak (Child)</h6>
    @if ($children->isEmpty())
        <p class="mj-rel-empty">Belum ada jabatan anak di bawah jabatan ini.</p>
    @else
        <ul class="mj-rel-list">
            @foreach ($children as $child)
            <li>
                <i class="fas fa-level-down-alt"></i>
                <a href="{{ route('admin.master_jabatan.show', $child) }}">{{ $child->nama }}</a>
                @if ($child->bidang)
                    <span style="color:#9ca3af; font-size:0.72rem;">· bidang: {{ $child->bidang->nama }}</span>
                @endif
            </li>
            @endforeach
        </ul>
    @endif
</div>

<div class="mj-panel">
    <h6><i class="fas fa-users"></i> Pemakaian pada Data Karyawan</h6>
    @if ($karyawanUsage > 0)
        <p class="mj-rel-empty" style="font-style:normal;">
            <span class="mj-usage-warn"><i class="fas fa-triangle-exclamation"></i>
            {{ $karyawanUsage }} data karyawan memiliki kolom JABATAN = "{{ $jabatan->nama }}"</span> —
            jabatan ini <b>tidak bisa dihapus</b> sampai pemakaian dipindahkan. Kolom data karyawan tidak diubah otomatis oleh fitur ini.
        </p>
    @else
        <p class="mj-rel-empty" style="font-style:normal;">
            <span class="mj-usage-ok"><i class="fas fa-circle-check"></i> Tidak ada data karyawan</span> yang memakai nama jabatan ini — aman dihapus bila tidak punya jabatan anak.
        </p>
    @endif
</div>
@endsection
