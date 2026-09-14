@extends('layouts.admin')

@section('title', 'Kelola Galeri — E-PPID PLN')
@section('page-title', 'Kelola Galeri')

@push('styles')
<style>
    .galeri-status-badge {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
    }
    .galeri-status-badge.publikasi { background: #dcfce7; color: #166534; }
    .galeri-status-badge.draft     { background: #fef3c7; color: #92400e; }

    .galeri-kategori-badge {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.2rem 0.55rem;
        border-radius: 6px;
    }
    .galeri-kategori-badge.KEGIATAN    { background: rgba(255,230,0,0.92); color: #005B9C; }
    .galeri-kategori-badge.FASILITAS   { background: rgba(0,163,224,0.88); color: #fff; }
    .galeri-kategori-badge.DOKUMENTASI { background: rgba(22,163,74,0.88); color: #fff; }
    .galeri-kategori-badge.SEREMONIAL  { background: rgba(139,92,246,0.88); color: #fff; }

    .action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        border: none;
        transition: all 0.2s ease;
        padding: 0;
    }
    .action-btn:hover { transform: translateY(-1px); }
    .action-btn.edit   { background: #fef3c7; color: #92400e; }
    .action-btn.delete { background: #fee2e2; color: #b91c1c; }
    .action-btn.view   { background: #dbeafe; color: #1d4ed8; }
    .action-btn.publish   { background: #dcfce7; color: #166534; }   /* publikasi → klik untuk tarik */
    .action-btn.unpublish { background: #fee2e2; color: #b91c1c; }   /* draft → klik untuk publikasi */

    .filter-box {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }
    .filter-box:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0,91,156,0.1);
        outline: none;
    }

    .table-galeri tbody tr { transition: background 0.15s ease; }
    .table-galeri tbody tr:hover { background: #f8fafc; }

    .thumb-galeri {
        width: 64px;
        height: 48px;
        border-radius: 8px;
        overflow: hidden;
        background: #f1f5f9;
        flex-shrink: 0;
        border: 1px solid #e5e7eb;
    }
    .thumb-galeri img { width: 100%; height: 100%; object-fit: cover; }

    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
        color: #9ca3af;
    }
    .empty-state i { font-size: 2.5rem; display: block; margin-bottom: 1rem; }
    .empty-state h6 { font-size: 1rem; font-weight: 600; color: #6b7280; margin-bottom: 0.25rem; }
    .empty-state p { font-size: 0.85rem; }
</style>
@endpush

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="dash-card">
            <div class="dash-card-header">
                <div>
                    <h5 class="dash-card-title">Daftar Galeri</h5>
                    <p class="dash-card-subtitle">Kelola foto kegiatan, fasilitas, dokumentasi, dan seremonial UP PLTU Indramayu</p>
                </div>
                <a href="{{ route('admin.galeri.create') }}" class="btn" style="background: var(--pln-yellow); color: var(--pln-blue); border-radius: 8px; font-weight: 600; font-size: 0.85rem;">
                    <i class="fas fa-plus me-1"></i> Tambah Foto
                </a>
            </div>

            @if (session('success'))
            <div class="alert alert-success" style="background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; border-radius: 8px; padding: 0.75rem 1rem; font-size: 0.85rem; margin-bottom: 1rem;">
                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            </div>
            @endif

            {{-- Filter (server-side, auto submit) --}}
            <form method="GET" action="{{ route('admin.galeri.index') }}" id="galeriFilterForm">
                <div class="row g-2 align-items-center mb-3">
                    <div class="col-md-6">
                        <div class="d-flex gap-2">
                            <div class="input-group" style="border-radius: 8px; overflow: hidden;">
                                <span class="input-group-text" style="background: #f3f4f6; border: 1px solid #e5e7eb; border-right: none; border-radius: 8px 0 0 8px;">
                                    <i class="fas fa-search" style="color: #6b7280; font-size: 0.8rem;"></i>
                                </span>
                                <input type="text" name="q" value="{{ request('q') }}" class="filter-box" placeholder="Cari judul atau deskripsi..." style="border: none; border-radius: 0 8px 8px 0;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-2 justify-content-md-end">
                            <select name="kategori" class="filter-box" style="cursor: pointer;" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                @foreach (\App\Models\Gallery::CATEGORIES as $cat)
                                <option value="{{ $cat }}" {{ request('kategori') === $cat ? 'selected' : '' }}>{{ ucfirst(strtolower($cat)) }}</option>
                                @endforeach
                            </select>
                            <select name="status" class="filter-box" style="cursor: pointer;" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="publikasi" {{ request('status') === 'publikasi' ? 'selected' : '' }}>Publikasi</option>
                                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                            <button type="submit" class="btn" style="background: var(--pln-blue); color: #fff; border-radius: 8px; font-weight: 600; font-size: 0.8rem; padding: 0.5rem 1rem;">
                                Filter
                            </button>
                            <span class="text-muted" style="font-size: 0.8rem; align-self: center; white-space: nowrap;">
                                {{ $galleries->total() }} foto
                            </span>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-galeri align-middle mb-0">
                    <thead>
                        <tr>
                            @foreach (['Foto', 'Kategori', 'Tanggal Kegiatan', 'Status', 'Aksi'] as $i => $th)
                            <th style="padding: 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; text-align: {{ $i === 4 ? 'right' : 'left' }}; {{ $i === 0 ? 'min-width: 280px;' : '' }}">{{ $th }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($galleries as $item)
                        <tr>
                            <td style="padding: 1rem;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="thumb-galeri">
                                        <img src="{{ $item->image_url }}" alt="{{ $item->judul }}" loading="lazy">
                                    </div>
                                    <div style="min-width: 0;">
                                        <div style="font-weight: 600; color: #1f2937; font-size: 0.88rem;">
                                            {{ $item->judul }}
                                            @if ($item->status === 'draft')
                                            <span style="font-size: 0.65rem; font-weight: 700; color: #92400e; background: #fef3c7; padding: 0.1rem 0.45rem; border-radius: 4px; margin-left: 0.4rem; vertical-align: middle;">DRAFT</span>
                                            @endif
                                        </div>
                                        <div style="color: #9ca3af; font-size: 0.78rem; margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 320px;">
                                            {{ $item->deskripsi ? Str::limit($item->deskripsi, 60) : 'Tanpa deskripsi' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 1rem;">
                                <span class="galeri-kategori-badge {{ $item->kategori }}">{{ $item->kategori }}</span>
                            </td>
                            <td style="padding: 1rem;">
                                <span style="font-size: 0.85rem; color: #6b7280; white-space: nowrap;">
                                    <i class="far fa-calendar me-1"></i>{{ $item->tanggal_kegiatan->translatedFormat('d M Y') }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                <span class="galeri-status-badge {{ $item->status }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td style="padding: 1rem; text-align: right;">
                                <div class="d-flex gap-1 justify-content-end">
                                    {{-- Quick Toggle Status: mata terbuka = publikasi (klik → draft), mata coret = draft (klik → publikasi) --}}
                                    <form action="{{ route('admin.galeri.toggle-status', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="action-btn {{ $item->status === 'publikasi' ? 'publish' : 'unpublish' }}" title="{{ $item->status === 'publikasi' ? 'Tarik ke Draft' : 'Publikasikan' }}">
                                            <i class="fas {{ $item->status === 'publikasi' ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                        </button>
                                    </form>
                                    {{-- Tombol Edit: langsung ke form edit (route + id) --}}
                                    <a href="{{ route('admin.galeri.edit', $item->id) }}" class="action-btn edit" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    {{-- Tombol Hapus: POST + @method('DELETE') + konfirmasi --}}
                                    <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto galeri ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-images"></i>
                                    <h6>Belum ada foto galeri</h6>
                                    <p>Klik tombol "Tambah Foto" untuk mengunggah foto pertama.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($galleries->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $galleries->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
