@extends('layouts.admin')

@section('title', 'Kelola Galeri — E-PPID PLN')
@section('page-title', 'Kelola Galeri')

@push('styles')
<style>
    /* ============================================
       KELOLA GALERI — GRID CARDS (pola news)
       ============================================ */

    /* Badges thumbnail (status & kategori) */
    .galeri-badge {
        font-size: 0.62rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.2rem 0.55rem;
        border-radius: 6px;
    }
    .galeri-badge.status-publikasi { background: rgba(220, 252, 231, 0.92); color: #166534; }
    .galeri-badge.status-draft     { background: rgba(254, 243, 199, 0.92); color: #92400e; }

    .galeri-badge.cat { backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); }
    /* Setara backdrop-blur Tailwind: teks badge tetap terbaca di atas foto */
    .galeri-badge { backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); }
    .galeri-badge.cat-KEGIATAN    { background: rgba(255,230,0,0.92); color: #005B9C; }
    .galeri-badge.cat-FASILITAS   { background: rgba(0,163,224,0.88); color: #fff; }
    .galeri-badge.cat-DOKUMENTASI { background: rgba(22,163,74,0.88); color: #fff; }
    .galeri-badge.cat-SEREMONIAL  { background: rgba(139,92,246,0.88); color: #fff; }

    /* ============================================
       GALERI CARD GRID — persist Tailwind:
       grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6
       (mobile-first; Tailwind TIDAK dimuat di layout admin,
        jadi diterjemahkan ke CSS murni di sini)
       ============================================ */
    .galeri-grid {
        display: grid;                                  /* grid */
        grid-template-columns: 1fr;                     /* grid-cols-1 */
        gap: 1.5rem;                                    /* gap-6 */
    }
    @media (min-width: 640px) {                         /* sm: */
        .galeri-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }  /* sm:grid-cols-2 */
    }
    @media (min-width: 768px) {                         /* md: */
        .galeri-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }  /* md:grid-cols-3 */
    }

    .galeri-card {
        width: 100%;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
    }
    .galeri-card:hover {
        border-color: #d1d5db;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        transform: translateY(-2px);
    }

    /* Media thumbnail 16:9 + placeholder */
    .galeri-card-media {
        width: 100%;
        aspect-ratio: 16 / 9;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        overflow: hidden;
        position: relative;
    }
    .galeri-card-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .galeri-card:hover .galeri-card-media img { transform: scale(1.03); }
    .galeri-card-media .image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #cbd5e1;
    }
    .galeri-card-media .image-placeholder i { font-size: 2rem; margin-bottom: 0.4rem; }
    .galeri-card-media .image-placeholder span { font-size: 0.72rem; font-weight: 500; }

    /* Badge overlay DI DALAM container gambar — persist Tailwind:
       absolute top-3 left-3 flex gap-2 (background semi-transparan) */
    .galeri-card-badges {
        position: absolute;                             /* absolute */
        top: 0.75rem;                                   /* top-3 */
        left: 0.75rem;                                  /* left-3 */
        display: flex;                                  /* flex */
        gap: 0.5rem;                                    /* gap-2 */
        z-index: 2;
    }

    /* Body: judul + deskripsi (2 baris) */
    .galeri-card-body {
        padding: 1rem 1.15rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .galeri-card-title {
        font-size: 0.92rem;
        font-weight: 700;
        color: var(--ink-heading);
        margin: 0 0 0.4rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .galeri-card-excerpt {
        font-size: 0.78rem;
        color: var(--ink-muted);
        line-height: 1.55;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }

    /* Footer: tanggal + pembuat, aksi kanan bawah */
    .galeri-card-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
        padding-top: 0.7rem;
        margin-top: 0.75rem;
        border-top: 1px solid var(--line-soft);
    }
    .galeri-card-date {
        font-size: 0.72rem;
        color: var(--ink-faint);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        min-width: 0;
    }
    .galeri-card-date .creator {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .galeri-card-actions { display: flex; gap: 0.35rem; flex-shrink: 0; }

    /* Empty state mengikuti pola news-empty-state */
    .galeri-empty-state {
        grid-column: 1 / -1;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 4rem 2rem;
        text-align: center;
    }
    .galeri-empty-state h6 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--ink-body);
        margin: 0 0 0.3rem;
    }
    .galeri-empty-state p {
        font-size: 0.85rem;
        color: var(--ink-faint);
        margin: 0 0 1.25rem;
    }

    /* ============================================
       DELETE CONFIRMATION MODAL — persist Tailwind:
       fixed inset-0 bg-black/50 backdrop-blur, hidden by default
       (blok ini hilang pada perubahan sebelumnya sehingga
        modal "bocor" tampil statis di bawah grid)
       ============================================ */
    .galeri-delete-overlay {
        display: none;                                  /* hidden / isOpen=false */
        position: fixed;                                /* fixed */
        inset: 0;                                       /* inset-0 */
        background: rgba(0, 0, 0, 0.5);                 /* bg-black/50 */
        z-index: 2000;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        backdrop-filter: blur(4px);                     /* backdrop-blur */
        -webkit-backdrop-filter: blur(4px);
    }
    .galeri-delete-overlay.show { display: flex; }      /* isOpen=true */
    .galeri-delete-dialog {
        background: var(--bg-card, #fff);
        border-radius: 16px;
        padding: 2rem 1.75rem 1.5rem;
        max-width: 420px;
        width: 100%;
        text-align: center;
        box-shadow: var(--shadow-pop, 0 20px 60px rgba(0, 0, 0, 0.25));
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
    .galeri-delete-title { font-size: 1.05rem; font-weight: 700; color: var(--ink-heading); margin: 0 0 0.5rem; }
    .galeri-delete-text { font-size: 0.88rem; color: var(--ink-muted); line-height: 1.6; margin: 0 0 0.35rem; }
    .galeri-delete-name {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--ink-heading);
        background: var(--panel, #f9fafb);
        border: 1px solid var(--line, #e5e7eb);
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        margin: 0.75rem 0 1.25rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .galeri-delete-actions { display: flex; gap: 0.6rem; justify-content: center; }

    /* Tombol modal — selaras persis dengan .news-delete-btn di /admin/news */
    .galeri-delete-btn {
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }
    .galeri-delete-btn.cancel {
        background: #f3f4f6;
        color: #6b7280;
    }
    .galeri-delete-btn.cancel:hover {
        background: #e5e7eb;
        color: #374151;
    }
    .galeri-delete-btn.confirm {
        background: #DC2626;
        color: #fff;
    }
    .galeri-delete-btn.confirm:hover {
        background: #B91C1C;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }
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
     FILTER BAR (server-side, auto submit) — tetap berfungsi
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
     GALERI CARD GRID
     ============================================ --}}
<div class="galeri-grid" id="galeriGrid">
    @forelse ($galleries as $item)
    <div class="galeri-card">
        {{-- Media: thumbnail + badge status & kategori --}}
        <div class="galeri-card-media">
            @if (!empty($item->file_gambar))
                <img src="{{ $item->image_url }}" alt="{{ $item->judul }}" loading="lazy">
            @else
                <div class="image-placeholder">
                    <i class="far fa-image"></i>
                    <span>Tanpa Gambar</span>
                </div>
            @endif
            <div class="galeri-card-badges">
                <span class="galeri-badge status-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                <span class="galeri-badge cat cat-{{ $item->kategori }}">{{ $item->kategori }}</span>
            </div>
        </div>

        {{-- Body: judul + deskripsi --}}
        <div class="galeri-card-body">
            <h6 class="galeri-card-title">{{ $item->judul }}</h6>
            <p class="galeri-card-excerpt">{{ $item->deskripsi ? $item->deskripsi : 'Tanpa deskripsi' }}</p>

            {{-- Footer: tanggal kegiatan + pembuat | aksi --}}
            <div class="galeri-card-meta">
                <span class="galeri-card-date">
                    <i class="far fa-calendar"></i>
                    <span>{{ $item->tanggal_kegiatan->translatedFormat('d M Y') }}</span>
                    @if ($creatorNames[$item->id] ?? null)
                        <span class="creator">· {{ $creatorNames[$item->id] }}</span>
                    @endif
                </span>
                <div class="galeri-card-actions">
                    {{-- Toggle status: mata = publikasi (klik → draft), mata coret = draft (klik → publikasi) --}}
                    <form action="{{ route('admin.galeri.toggle-status', $item->id) }}" method="POST" style="display:inline;">
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
            </div>
        </div>
    </div>
    @empty
    <div class="galeri-empty-state">
        <div class="empty-icon"><i class="fas fa-images"></i></div>
        <h6>Belum ada foto galeri</h6>
        <p>Klik tombol "Tambah Foto" untuk mengunggah foto pertama.</p>
    </div>
    @endforelse
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

{{-- ============================================
     DELETE CONFIRMATION MODAL — pop-up melayang di tengah layar
     (fixed inset-0 bg-black/50 backdrop-blur), default TERSEMBUNYI
     (isOpen = false). Tampil hanya saat tombol hapus diklik.
     ============================================ --}}
<div class="galeri-delete-overlay" id="deleteGaleriModal" hidden>
    <div class="galeri-delete-dialog">
        <div class="galeri-delete-icon">
            <i class="fas fa-trash-can"></i>
        </div>
        <h6 class="galeri-delete-title">Hapus Foto Galeri?</h6>
        <p class="galeri-delete-text">Apakah Anda yakin ingin menghapus foto galeri ini?</p>
        <div class="galeri-delete-name" id="deleteGaleriTitle"></div>
        <div class="galeri-delete-actions">
            <button class="galeri-delete-btn cancel" onclick="closeGaleriDeleteModal()">Batal</button>
            <form id="deleteGaleriForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="galeri-delete-btn confirm">
                    <i class="fas fa-trash me-1"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

{{-- ============================================================
     Script INLINE modal hapus — WAJIB di dalam content (bukan
     @push('scripts')) karena client-side router (router.js) hanya
     mengeksekusi ulang <script> di dalam <main>; kalau di push
     stack, popup hapus tidak muncul setelah navigasi via sidebar.
     ============================================================ --}}
<script>
    // Guard re-eksekusi: hindari listener ganda saat router.js
    // menjalankan ulang script ini setelah swap konten.
    if (!window.__galeriDeleteModalBound) {
        window.__galeriDeleteModalBound = true;

        // Delete modal — isOpen state (default false, elemen ber-atribut hidden)
        window.openGaleriDeleteModal = function(url, title) {
            const modal = document.getElementById('deleteGaleriModal');
            document.getElementById('deleteGaleriTitle').textContent = title;
            document.getElementById('deleteGaleriForm').action = url;
            modal.hidden = false;           // isOpen = true
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        };

        window.closeGaleriDeleteModal = function() {
            const modal = document.getElementById('deleteGaleriModal');
            modal.classList.remove('show');
            modal.hidden = true;            // isOpen = false
            document.body.style.overflow = '';
        };

        document.getElementById('deleteGaleriModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeGaleriDeleteModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('deleteGaleriModal')?.classList.contains('show')) {
                closeGaleriDeleteModal();
            }
        });
    }
</script>
@endsection
