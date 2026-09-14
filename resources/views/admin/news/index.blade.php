@extends('layouts.admin')

@section('title', 'Kelola Berita — E-PPID PLN')
@section('page-title', 'Kelola Berita')

@push('styles')
<style>
    /* ============================================
       NEWS PAGE — MINIMALIST & ATTRACTIVE
       ============================================ */

    /* Page Header Card */
    .news-page-header {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 1.5rem 1.75rem;
        margin-bottom: 1.25rem;
    }
    .news-page-header .header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .news-page-header .header-left h5 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--pln-text);
        margin: 0 0 0.2rem;
    }
    .news-page-header .header-left p {
        font-size: 0.8rem;
        color: #9ca3af;
        margin: 0;
    }

    /* Stats Row */
    .news-stats-row {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.25rem;
        flex-wrap: wrap;
    }
    .news-stat-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 0.78rem;
        font-weight: 600;
        color: #4b5563;
        transition: all 0.2s ease;
    }
    .news-stat-chip:hover {
        background: #f0f7ff;
        border-color: var(--pln-blue);
    }
    .news-stat-chip .stat-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .news-stat-chip .stat-dot.blue { background: var(--pln-blue); }
    .news-stat-chip .stat-dot.green { background: #22c55e; }
    .news-stat-chip .stat-dot.amber { background: #f59e0b; }
    .news-stat-chip .stat-number {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--pln-text);
    }

    /* Filter Bar */
    .news-filter-bar {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    .news-filter-bar .search-wrapper {
        flex: 1;
        min-width: 200px;
        position: relative;
    }
    .news-filter-bar .search-wrapper i {
        position: absolute;
        left: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 0.82rem;
        pointer-events: none;
    }
    .news-filter-bar .search-wrapper input {
        width: 100%;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.55rem 1rem 0.55rem 2.4rem;
        font-size: 0.85rem;
        background: #f9fafb;
        transition: all 0.2s ease;
        color: #1f2937;
    }
    .news-filter-bar .search-wrapper input:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0,91,156,0.08);
        background: #fff;
        outline: none;
    }
    .news-filter-bar .search-wrapper input::placeholder { color: #9ca3af; }

    .filter-select {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.55rem 0.85rem;
        font-size: 0.82rem;
        background: #f9fafb;
        color: #4b5563;
        cursor: pointer;
        transition: all 0.2s ease;
        font-weight: 500;
    }
    .filter-select:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0,91,156,0.08);
        outline: none;
    }

    .filter-divider {
        width: 1px;
        height: 28px;
        background: #e5e7eb;
        flex-shrink: 0;
    }

    .filter-count {
        font-size: 0.78rem;
        color: #9ca3af;
        font-weight: 500;
        white-space: nowrap;
    }

    /* News Card Grid */
    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1rem;
    }

    .news-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
    }
    .news-card:hover {
        border-color: #d1d5db;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        transform: translateY(-2px);
    }

    /* Card Image */
    .news-card-image {
        width: 100%;
        height: 180px;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        overflow: hidden;
        position: relative;
    }
    .news-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .news-card:hover .news-card-image img {
        transform: scale(1.03);
    }
    .news-card-image .image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #cbd5e1;
    }
    .news-card-image .image-placeholder i {
        font-size: 2rem;
        margin-bottom: 0.4rem;
    }
    .news-card-image .image-placeholder span {
        font-size: 0.72rem;
        font-weight: 500;
    }

    /* Card Badges */
    .news-card-badges {
        position: absolute;
        top: 0.75rem;
        left: 0.75rem;
        display: flex;
        gap: 0.35rem;
    }
    .news-badge {
        font-size: 0.62rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.2rem 0.55rem;
        border-radius: 6px;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
    .news-badge.status-published {
        background: rgba(220, 252, 231, 0.9);
        color: #166534;
    }
    .news-badge.status-draft {
        background: rgba(254, 243, 199, 0.9);
        color: #92400e;
    }
    .news-badge.cat {
        background: rgba(255, 255, 255, 0.88);
        color: #4b5563;
        border: 1px solid rgba(0,0,0,0.06);
    }
    .news-badge.cat-umum { background: rgba(0,91,156,0.88); color: #fff; }
    .news-badge.cat-teknis { background: rgba(0,163,224,0.88); color: #fff; }
    .news-badge.cat-kegiatan { background: rgba(255,230,0,0.92); color: #005B9C; }
    .news-badge.cat-kepegawaian { background: rgba(139,92,246,0.88); color: #fff; }

    /* Card Body */
    .news-card-body {
        padding: 1rem 1.15rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .news-card-title {
        font-size: 0.92rem;
        font-weight: 700;
        color: var(--pln-text);
        margin: 0 0 0.4rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .news-card-excerpt {
        font-size: 0.78rem;
        color: #6b7280;
        line-height: 1.55;
        margin: 0 0 0.75rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }
    .news-card-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 0.7rem;
        border-top: 1px solid #f3f4f6;
    }
    .news-card-date {
        font-size: 0.72rem;
        color: #9ca3af;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .news-card-actions {
        display: flex;
        gap: 0.35rem;
    }
    .news-action-btn {
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        border: none;
        font-size: 0.72rem;
        transition: all 0.2s ease;
        padding: 0;
        cursor: pointer;
    }
    .news-action-btn:hover { transform: translateY(-1px); }
    .news-action-btn.edit { background: #fef3c7; color: #92400e; }
    .news-action-btn.edit:hover { background: #fde68a; }
    .news-action-btn.delete { background: #fee2e2; color: #b91c1c; }
    .news-action-btn.delete:hover { background: #fecaca; }
    .news-action-btn.publish { background: #dcfce7; color: #166534; }
    .news-action-btn.publish:hover { background: #bbf7d0; }
    .news-action-btn.unpublish { background: #fee2e2; color: #b91c1c; }
    .news-action-btn.unpublish:hover { background: #fecaca; }

    /* Empty State */
    .news-empty-state {
        grid-column: 1 / -1;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 4rem 2rem;
        text-align: center;
    }
    .news-empty-state .empty-icon {
        width: 72px;
        height: 72px;
        background: #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
    }
    .news-empty-state .empty-icon i {
        font-size: 1.6rem;
        color: #cbd5e1;
    }
    .news-empty-state h6 {
        font-size: 1rem;
        font-weight: 700;
        color: #374151;
        margin: 0 0 0.3rem;
    }
    .news-empty-state p {
        font-size: 0.85rem;
        color: #9ca3af;
        margin: 0 0 1.25rem;
    }

    /* Pagination */
    .news-pagination {
        display: flex;
        justify-content: center;
        margin-top: 1.5rem;
    }
    .news-pagination .pagination {
        display: flex;
        gap: 0.35rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .news-pagination .page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 0.6rem;
        border-radius: 9px;
        font-size: 0.82rem;
        font-weight: 600;
        color: #6b7280;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .news-pagination .page-btn:hover {
        border-color: var(--pln-blue);
        color: var(--pln-blue);
        background: #f0f7ff;
    }
    .news-pagination .page-btn.active {
        background: var(--pln-blue);
        color: #fff;
        border-color: var(--pln-blue);
    }
    .news-pagination .page-btn.disabled {
        opacity: 0.4;
        cursor: not-allowed;
        pointer-events: none;
    }

    /* ============================================
       DELETE CONFIRMATION MODAL
       ============================================ */
    .news-delete-overlay {
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
    .news-delete-overlay.show {
        display: flex;
    }
    .news-delete-dialog {
        background: #fff;
        border-radius: 16px;
        padding: 2rem 1.75rem 1.5rem;
        max-width: 420px;
        width: 100%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        animation: newsDeleteIn 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    @keyframes newsDeleteIn {
        from { opacity: 0; transform: scale(0.9) translateY(10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .news-delete-icon {
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
    .news-delete-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 0.5rem;
    }
    .news-delete-text {
        font-size: 0.88rem;
        color: #6b7280;
        line-height: 1.6;
        margin: 0 0 0.35rem;
    }
    .news-delete-title-preview {
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
    .news-delete-actions {
        display: flex;
        gap: 0.6rem;
        justify-content: center;
    }
    .news-delete-btn {
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }
    .news-delete-btn.cancel {
        background: #f3f4f6;
        color: #6b7280;
    }
    .news-delete-btn.cancel:hover {
        background: #e5e7eb;
        color: #374151;
    }
    .news-delete-btn.confirm {
        background: #DC2626;
        color: #fff;
    }
    .news-delete-btn.confirm:hover {
        background: #B91C1C;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .news-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }
    }
    @media (max-width: 767.98px) {
        .news-page-header .header-row {
            flex-direction: column;
            align-items: flex-start;
        }
        .news-filter-bar {
            flex-direction: column;
        }
        .news-filter-bar .search-wrapper {
            min-width: 100%;
        }
        .filter-divider { display: none; }
        .news-grid {
            grid-template-columns: 1fr;
        }
        .news-card-image { height: 160px; }
    }
    @media (max-width: 575.98px) {
        .news-page-header { padding: 1.15rem; }
        .news-filter-bar { padding: 0.85rem; }
        .news-stats-row { gap: 0.5rem; }
        .news-stat-chip { padding: 0.4rem 0.75rem; font-size: 0.72rem; }
    }
</style>
@endpush

@section('content')
{{-- ============================================
     PAGE HEADER
     ============================================ --}}
<div class="news-page-header">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-newspaper" style="color: var(--pln-blue); margin-right: 0.5rem;"></i>Daftar Berita</h5>
            <p>Kelola berita yang akan ditampilkan di situs informasi</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="btn-corp btn-corp-add">
            <i class="fas fa-plus"></i> Tambah Berita
        </a>
    </div>

    {{-- Stats Chips --}}
    <div class="news-stats-row">
        <div class="news-stat-chip">
            <span class="stat-dot blue"></span>
            Total
            <span class="stat-number">
                @if (is_object($news)) {{ $news->total() }} @else 0 @endif
            </span>
        </div>
        @if (is_object($news))
        <div class="news-stat-chip">
            <span class="stat-dot green"></span>
            Terpublikasi
            <span class="stat-number">{{ $news->where('is_published', true)->count() }}</span>
        </div>
        <div class="news-stat-chip">
            <span class="stat-dot amber"></span>
            Draft
            <span class="stat-number">{{ $news->where('is_published', false)->count() }}</span>
        </div>
        @endif
    </div>
</div>

{{-- ============================================
     FILTER BAR
     ============================================ --}}
<div class="news-filter-bar">
    <div class="search-wrapper">
        <i class="fas fa-search"></i>
        <input type="text" id="searchInput" placeholder="Cari judul berita...">
    </div>
    <div class="filter-divider"></div>
    <select id="filterCategory" class="filter-select">
        <option value="">Semua Kategori</option>
        <option value="umum">Umum</option>
        <option value="teknis">Teknis</option>
        <option value="kegiatan">Kegiatan</option>
        <option value="kepegawaian">Kepegawaian</option>
    </select>
    <select id="filterStatus" class="filter-select">
        <option value="">Semua Status</option>
        <option value="1">Terpublikasi</option>
        <option value="0">Draft</option>
    </select>
    <div class="filter-divider"></div>
    <span class="filter-count">
        @if (is_object($news))
            {{ $news->total() }} berita
        @else
            0 berita
        @endif
    </span>
</div>

{{-- ============================================
     NEWS CARD GRID
     ============================================ --}}
<div class="news-grid" id="newsGrid">
    @forelse ($news as $item)
    <div class="news-card" data-title="{{ strtolower($item->title) }}" data-category="{{ $item->category }}" data-status="{{ $item->is_published ? '1' : '0' }}">
        {{-- Image --}}
        <div class="news-card-image">
            @if ($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" loading="lazy">
            @else
                <div class="image-placeholder">
                    <i class="far fa-newspaper"></i>
                    <span>Tanpa Gambar</span>
                </div>
            @endif
            <div class="news-card-badges">
                @if (!$item->is_published)
                    <span class="news-badge status-draft"><i class="fas fa-pen me-1" style="font-size: 0.55rem;"></i>Draft</span>
                @else
                    <span class="news-badge status-published"><i class="fas fa-check me-1" style="font-size: 0.55rem;"></i>Published</span>
                @endif
                <span class="news-badge cat cat-{{ $item->category }}">{{ ucfirst($item->category) }}</span>
            </div>
        </div>

        {{-- Body --}}
        <div class="news-card-body">
            <h6 class="news-card-title">{{ $item->title }}</h6>
            <p class="news-card-excerpt">{{ Str::limit($item->excerpt, 100) }}</p>
            <div class="news-card-meta">
                <span class="news-card-date">
                    <i class="far fa-calendar"></i>
                    {{ $item->created_at->format('d M Y') }}
                    @if ($item->author)
                        <span style="margin-left: 0.25rem;">· {{ $item->author }}</span>
                    @endif
                </span>
                <div class="news-card-actions">
                    <a href="{{ route('admin.news.edit', $item) }}" class="news-action-btn edit" title="Edit">
                        <i class="fas fa-pen"></i>
                    </a>
                    @if ($item->is_published)
                        <form action="{{ route('admin.news.publish', $item) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('POST')
                            <button type="submit" class="news-action-btn unpublish" title="Tarik Publikasi">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </form>
                        <button type="button" class="news-action-btn delete" title="Hapus"
                                onclick="openDeleteModal('{{ route('admin.news.destroy', $item) }}', '{{ addslashes($item->title) }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    @else
                        <form action="{{ route('admin.news.publish', $item) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('POST')
                            <button type="submit" class="news-action-btn publish" title="Publikasi">
                                <i class="fas fa-eye"></i>
                            </button>
                        </form>
                        <button type="button" class="news-action-btn delete" title="Hapus"
                                onclick="openDeleteModal('{{ route('admin.news.destroy', $item) }}', '{{ addslashes($item->title) }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="news-empty-state">
        <div class="empty-icon">
            <i class="far fa-newspaper"></i>
        </div>
        <h6>Belum ada berita</h6>
        <p>Mulai tambahkan berita baru untuk ditampilkan di situs informasi.</p>
        <a href="{{ route('admin.news.create') }}" class="btn-corp btn-corp-add">
            <i class="fas fa-plus"></i> Tambah Berita Pertama
        </a>
    </div>
    @endforelse
</div>

{{-- ============================================
     PAGINATION
     ============================================ --}}
@if (is_object($news) && $news->hasPages())
<div class="news-pagination">
    <div class="pagination">
        {{-- Prev --}}
        @if ($news->onFirstPage())
            <span class="page-btn disabled"><i class="fas fa-chevron-left"></i></span>
        @else
            <a class="page-btn" href="{{ $news->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
        @endif

        {{-- Pages --}}
        @foreach ($news->getUrlRange(max(1, $news->currentPage() - 2), min($news->lastPage(), $news->currentPage() + 2)) as $page => $url)
            <a class="page-btn {{ $page == $news->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
        @endforeach

        {{-- Next --}}
        @if ($news->hasMorePages())
            <a class="page-btn" href="{{ $news->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
        @else
            <span class="page-btn disabled"><i class="fas fa-chevron-right"></i></span>
        @endif
    </div>
</div>
@endif

<script>
(function() {
    const searchInput = document.getElementById('searchInput');
    const filterCategory = document.getElementById('filterCategory');
    const filterStatus = document.getElementById('filterStatus');
    const newsGrid = document.getElementById('newsGrid');
    const cards = newsGrid?.querySelectorAll('.news-card') ?? [];

    function applyFilters() {
        const search = (searchInput?.value ?? '').toLowerCase();
        const category = filterCategory?.value ?? '';
        const status = filterStatus?.value ?? '';
        let visibleCount = 0;

        cards.forEach(function(card) {
            const title = card.dataset.title || '';
            const cardCategory = card.dataset.category || '';
            const cardStatus = card.dataset.status || '';

            const matchSearch = !search || title.includes(search);
            const matchCategory = !category || cardCategory === category;
            const matchStatus = !status || cardStatus === status;

            const show = matchSearch && matchCategory && matchStatus;
            card.style.display = show ? '' : 'none';
            if (show) visibleCount++;
        });

        // Show/hide empty state
        const emptyState = newsGrid?.querySelector('.news-empty-state');
        if (emptyState) {
            emptyState.style.display = visibleCount === 0 ? '' : 'none';
        }
    }        searchInput?.addEventListener('input', applyFilters);
        filterCategory?.addEventListener('change', applyFilters);
        filterStatus?.addEventListener('change', applyFilters);
    })();
</script>

{{-- ============================================
     DELETE CONFIRMATION MODAL
     ============================================ --}}
<div class="news-delete-overlay" id="deleteNewsModal">
    <div class="news-delete-dialog">
        <div class="news-delete-icon">
            <i class="fas fa-trash-can"></i>
        </div>
        <h6 class="news-delete-title">Hapus Berita?</h6>
        <p class="news-delete-text">Apakah Anda yakin ingin menghapus berita ini?</p>
        <div class="news-delete-title-preview" id="deleteNewsTitle"></div>
        <div class="news-delete-actions">
            <button class="news-delete-btn cancel" onclick="closeDeleteModal()">Batal</button>
            <form id="deleteNewsForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="news-delete-btn confirm">
                    <i class="fas fa-trash me-1"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openDeleteModal(url, title) {
    const modal = document.getElementById('deleteNewsModal');
    const titleEl = document.getElementById('deleteNewsTitle');
    const form = document.getElementById('deleteNewsForm');
    
    titleEl.textContent = title;
    form.action = url;
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteNewsModal');
    modal.classList.remove('show');
    document.body.style.overflow = '';
}

// Close on overlay click
document.getElementById('deleteNewsModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});

// Close on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && document.getElementById('deleteNewsModal')?.classList.contains('show')) {
        closeDeleteModal();
    }
});
</script>
@endsection
