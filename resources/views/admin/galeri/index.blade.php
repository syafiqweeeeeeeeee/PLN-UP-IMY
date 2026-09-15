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

    /* ============================================
       DELETE CONFIRMATION MODAL (pola news modal)
       ============================================ */
    .galeri-delete-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 2000;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        backdrop-filter: blur(4px);
    }
    .galeri-delete-overlay.show { display: flex; }
    .galeri-delete-dialog {
        background: #fff;
        border-radius: 16px;
        padding: 2rem 1.75rem 1.5rem;
        max-width: 420px;
        width: 100%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        animation: galeriDeleteIn 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    @keyframes galeriDeleteIn {
        from { opacity: 0; transform: scale(0.9) translateY(10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .galeri-delete-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 1rem;
        background: #FEE2E2;
        color: #DC2626;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }
    .galeri-delete-title { font-size: 1.05rem; font-weight: 700; color: #1f2937; margin: 0 0 0.5rem; }
    .galeri-delete-text { font-size: 0.88rem; color: #6b7280; line-height: 1.6; margin: 0 0 0.35rem; }
    .galeri-delete-name {
        font-size: 0.85rem;
        font-weight: 600;
        color: #1f2937;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        margin: 0.75rem 0 1.25rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .galeri-delete-actions { display: flex; gap: 0.6rem; justify-content: center; }
</style>
@endpush

@section('content')
{{-- ============================================
     PAGE HEADER (pola /admin/news)
     ============================================ --}}
<div class="page-header-card">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-images header-icon"></i>Daftar Galeri</h5>
            <p>Kelola foto kegiatan, fasilitas, dokumentasi, dan seremonial UP PLTU Indramayu</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="btn-corp btn-corp-add">
            <i class="fas fa-plus"></i> Tambah Foto
        </a>
    </div>

    {{-- Stats Chips --}}
    <div class="stat-chips-row">
        <div class="stat-chip">
            <span class="stat-dot blue"></span>
            Total
            <span class="stat-number">{{ $galleries->total() }}</span>
        </div>
        <div class="stat-chip">
            <span class="stat-dot green"></span>
            Publikasi
            <span class="stat-number">{{ $galleries->filter(fn ($g) => $g->status === 'publikasi')->count() }}</span>
        </div>
        <div class="stat-chip">
            <span class="stat-dot amber"></span>
            Draft
            <span class="stat-number">{{ $galleries->filter(fn ($g) => $g->status === 'draft')->count() }}</span>
        </div>
    </div>
</div>

{{-- ============================================
     FILTER BAR (server-side, auto submit)
     ============================================ --}}
<form method="GET" action="{{ route('admin.galeri.index') }}" id="galeriFilterForm">
    <div class="page-filter-bar">
        <div class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input type="text" name="q" value="{{ request('q') }}" class="filter-input" placeholder="Cari judul atau deskripsi...">
        </div>
        <div class="filter-divider"></div>
        <select name="kategori" class="filter-input" style="width:auto;" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach (\App\Models\Gallery::CATEGORIES as $cat)
            <option value="{{ $cat }}" {{ request('kategori') === $cat ? 'selected' : '' }}>{{ ucfirst(strtolower($cat)) }}</option>
            @endforeach
        </select>
        <select name="status" class="filter-input" style="width:auto;" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <option value="publikasi" {{ request('status') === 'publikasi' ? 'selected' : '' }}>Publikasi</option>
            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
        <div class="filter-divider"></div>
        <span class="filter-count">{{ $galleries->total() }} foto</span>
    </div>
</form>

{{-- ============================================
     GALLERY TABLE
     ============================================ --}}
<div class="dash-card">
    <div class="table-responsive">
        <table class="table admin-table align-middle mb-0">
            <thead>
                <tr>
                    <th style="min-width: 280px;">Foto</th>
                    <th>Kategori</th>
                    <th>Tanggal Kegiatan</th>
                    <th>Status</th>
                    <th class="th-actions">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($galleries as $item)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="thumb-galeri">
                                <img src="{{ $item->image_url }}" alt="{{ $item->judul }}" loading="lazy">
                            </div>
                            <div style="min-width: 0;">
                                <div style="font-weight: 600; color: var(--ink-heading); font-size: 0.88rem;">
                                    {{ $item->judul }}
                                </div>
                                <div style="color: var(--ink-faint); font-size: 0.78rem; margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 320px;">
                                    {{ $item->deskripsi ? Str::limit($item->deskripsi, 60) : 'Tanpa deskripsi' }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="galeri-kategori-badge {{ $item->kategori }}">{{ $item->kategori }}</span>
                    </td>
                    <td>
                        <span style="font-size: 0.85rem; color: var(--ink-muted); white-space: nowrap;">
                            <i class="far fa-calendar me-1"></i>{{ $item->tanggal_kegiatan->translatedFormat('d M Y') }}
                        </span>
                    </td>
                    <td>
                        <span class="galeri-status-badge {{ $item->status }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="td-actions">
                        <div class="d-flex gap-1 justify-content-end">
                            {{-- Quick Toggle Status: mata terbuka = publikasi (klik → draft), mata coret = draft (klik → publikasi) --}}
                            <form action="{{ route('admin.galeri.toggle-status', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="news-action-btn {{ $item->status === 'publikasi' ? 'publish' : 'unpublish' }}" title="{{ $item->status === 'publikasi' ? 'Tarik ke Draft' : 'Publikasikan' }}">
                                    <i class="fas {{ $item->status === 'publikasi' ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                </button>
                            </form>
                            <a href="{{ route('admin.galeri.edit', $item->id) }}" class="news-action-btn edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <button type="button" class="news-action-btn delete" title="Hapus"
                                    onclick="openGaleriDeleteModal('{{ route('admin.galeri.destroy', $item->id) }}', '{{ addslashes($item->judul) }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="news-empty-state" style="grid-column: auto; border: none;">
                            <div class="empty-icon"><i class="fas fa-images"></i></div>
                            <h6>Belum ada foto galeri</h6>
                            <p>Klik tombol "Tambah Foto" untuk mengunggah foto pertama.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination (pola news) --}}
    @if ($galleries->hasPages())
    <div class="page-pagination">
        <div class="pagination">
            @if ($galleries->onFirstPage())
                <span class="page-btn disabled"><i class="fas fa-chevron-left"></i></span>
            @else
                <a class="page-btn" href="{{ $galleries->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach ($galleries->getUrlRange(max(1, $galleries->currentPage() - 2), min($galleries->lastPage(), $galleries->currentPage() + 2)) as $page => $url)
                <a class="page-btn {{ $page == $galleries->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
            @endforeach

            @if ($galleries->hasMorePages())
                <a class="page-btn" href="{{ $galleries->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
            @else
                <span class="page-btn disabled"><i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    </div>
    @endif
</div>

{{-- ============================================
     DELETE CONFIRMATION MODAL
     ============================================ --}}
<div class="galeri-delete-overlay" id="deleteGaleriModal">
    <div class="galeri-delete-dialog">
        <div class="galeri-delete-icon">
            <i class="fas fa-trash-can"></i>
        </div>
        <h6 class="galeri-delete-title">Hapus Foto Galeri?</h6>
        <p class="galeri-delete-text">Apakah Anda yakin ingin menghapus foto galeri ini?</p>
        <div class="galeri-delete-name" id="deleteGaleriTitle"></div>
        <div class="galeri-delete-actions">
            <button class="btn-corp btn-corp-soft" onclick="closeGaleriDeleteModal()">Batal</button>
            <form id="deleteGaleriForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-corp btn-corp-delete">
                    <i class="fas fa-trash"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Delete modal
    function openGaleriDeleteModal(url, title) {
        const modal = document.getElementById('deleteGaleriModal');
        document.getElementById('deleteGaleriTitle').textContent = title;
        document.getElementById('deleteGaleriForm').action = url;
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeGaleriDeleteModal() {
        document.getElementById('deleteGaleriModal').classList.remove('show');
        document.body.style.overflow = '';
    }

    document.getElementById('deleteGaleriModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeGaleriDeleteModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('deleteGaleriModal')?.classList.contains('show')) {
            closeGaleriDeleteModal();
        }
    });
</script>
@endpush
