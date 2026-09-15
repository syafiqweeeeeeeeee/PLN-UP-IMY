@extends('layouts.admin')

@section('title', 'Kelola Pengumuman — E-PPID PLN')
@section('page-title', 'Kelola Pengumuman')

@push('styles')
<style>
    .announcement-status-badge {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
    }
    .announcement-status-badge.published {
        background: #dcfce7;
        color: #166534;
    }
    .announcement-status-badge.draft {
        background: #fef3c7;
        color: #92400e;
    }
    .announcement-category-badge {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.2rem 0.55rem;
        border-radius: 6px;
    }
    .announcement-category-badge.umum        { background: rgba(0,91,156,0.88); color: #fff; }
    .announcement-category-badge.teknis      { background: rgba(0,163,224,0.88); color: #fff; }
    .announcement-category-badge.kepegawaian { background: rgba(139,92,246,0.88); color: #fff; }
    .announcement-category-badge.keuangan    { background: rgba(16,185,129,0.88); color: #fff; }
    .announcement-category-badge.layanan     { background: rgba(245,158,11,0.92); color: #fff; }

    /* ============================================
       DELETE CONFIRMATION MODAL (pola news modal)
       ============================================ */
    .announcement-delete-overlay {
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
    .announcement-delete-overlay.show { display: flex; }
    .announcement-delete-dialog {
        background: #fff;
        border-radius: 16px;
        padding: 2rem 1.75rem 1.5rem;
        max-width: 420px;
        width: 100%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        animation: announcementDeleteIn 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    @keyframes announcementDeleteIn {
        from { opacity: 0; transform: scale(0.9) translateY(10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .announcement-delete-icon {
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
    .announcement-delete-title { font-size: 1.05rem; font-weight: 700; color: #1f2937; margin: 0 0 0.5rem; }
    .announcement-delete-text { font-size: 0.88rem; color: #6b7280; line-height: 1.6; margin: 0 0 0.35rem; }
    .announcement-delete-name {
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
    .announcement-delete-actions { display: flex; gap: 0.6rem; justify-content: center; }
</style>
@endpush

@section('content')
{{-- ============================================
     PAGE HEADER (pola /admin/news)
     ============================================ --}}
<div class="page-header-card">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-bullhorn header-icon"></i>Daftar Pengumuman</h5>
            <p>Kelola pengumuman resmi yang ditampilkan di halaman publik</p>
        </div>
        <a href="{{ route('admin.announcements.create') }}" class="btn-corp btn-corp-add">
            <i class="fas fa-plus"></i> Tambah Pengumuman
        </a>
    </div>

    {{-- Stats Chips --}}
    <div class="stat-chips-row">
        <div class="stat-chip">
            <span class="stat-dot blue"></span>
            Total
            <span class="stat-number">
                @if (is_object($announcements)) {{ $announcements->total() }} @else 0 @endif
            </span>
        </div>
        @if (is_object($announcements))
        <div class="stat-chip">
            <span class="stat-dot green"></span>
            Terpublikasi
            <span class="stat-number">{{ $announcements->filter(fn ($a) => $a->is_published)->count() }}</span>
        </div>
        <div class="stat-chip">
            <span class="stat-dot amber"></span>
            Draft
            <span class="stat-number">{{ $announcements->filter(fn ($a) => !$a->is_published)->count() }}</span>
        </div>
        @endif
    </div>
</div>

{{-- ============================================
     FILTER BAR
     ============================================ --}}
<div class="page-filter-bar">
    <div class="search-wrapper">
        <i class="fas fa-search search-icon"></i>
        <input type="text" id="searchInput" class="filter-input" placeholder="Cari judul pengumuman...">
    </div>
    <div class="filter-divider"></div>
    <select id="filterCategory" class="filter-input" style="width:auto;">
        <option value="">Semua Kategori</option>
        <option value="umum">Umum</option>
        <option value="teknis">Teknis</option>
        <option value="kepegawaian">Kepegawaian</option>
        <option value="keuangan">Keuangan</option>
        <option value="layanan">Layanan</option>
    </select>
    <select id="filterStatus" class="filter-input" style="width:auto;">
        <option value="">Semua Status</option>
        <option value="1">Terpublikasi</option>
        <option value="0">Draft</option>
    </select>
    <div class="filter-divider"></div>
    <span class="filter-count">
        @if (is_object($announcements))
            {{ $announcements->total() }} pengumuman
        @else
            0 pengumuman
        @endif
    </span>
</div>

{{-- ============================================
     ANNOUNCEMENT TABLE
     ============================================ --}}
<div class="dash-card">
    <div class="table-responsive">
        <table class="table admin-table align-middle mb-0">
            <thead>
                <tr>
                    <th>Pengumuman</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th class="th-actions">Aksi</th>
                </tr>
            </thead>
            <tbody id="announcementTableBody">
                @forelse ($announcements as $item)
                <tr data-title="{{ strtolower($item->title) }}" data-category="{{ $item->category }}" data-status="{{ $item->is_published ? '1' : '0' }}">
                    <td>
                        <div style="min-width: 0;">
                            <div style="font-weight: 600; color: var(--ink-heading); font-size: 0.88rem;">
                                {{ $item->title }}
                            </div>
                            <div style="color: var(--ink-faint); font-size: 0.78rem; margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ Str::limit($item->excerpt, 60) }}
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="announcement-category-badge {{ $item->category }}">{{ ucfirst($item->category) }}</span>
                    </td>
                    <td>
                        <span class="announcement-status-badge {{ $item->is_published ? 'published' : 'draft' }}">
                            {{ $item->is_published ? 'Terpublikasi' : 'Draft' }}
                        </span>
                    </td>
                    <td>
                        <span style="font-size: 0.85rem; color: var(--ink-muted);">
                            <i class="far fa-calendar me-1"></i>{{ $item->created_at->format('d M Y') }}
                        </span>
                    </td>
                    <td class="td-actions">
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="{{ route('admin.announcements.edit', $item) }}" class="news-action-btn edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            @if ($item->is_published)
                                <form action="{{ route('admin.announcements.publish', $item) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="news-action-btn unpublish" title="Tarik Publikasi">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </form>
                                <button type="button" class="news-action-btn delete" title="Hapus"
                                        onclick="openAnnouncementDeleteModal('{{ route('admin.announcements.destroy', $item) }}', '{{ addslashes($item->title) }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @else
                                <form action="{{ route('admin.announcements.publish', $item) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="news-action-btn publish" title="Publikasi">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </form>
                                <button type="button" class="news-action-btn delete" title="Hapus"
                                        onclick="openAnnouncementDeleteModal('{{ route('admin.announcements.destroy', $item) }}', '{{ addslashes($item->title) }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="news-empty-state" style="grid-column: auto; border: none;">
                            <div class="empty-icon"><i class="fas fa-bullhorn"></i></div>
                            <h6>Belum ada pengumuman</h6>
                            <p>Klik tombol "Tambah Pengumuman" untuk membuat pengumuman baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination (pola news) --}}
    @if (is_object($announcements) && $announcements->hasPages())
    <div class="page-pagination">
        <div class="pagination">
            @if ($announcements->onFirstPage())
                <span class="page-btn disabled"><i class="fas fa-chevron-left"></i></span>
            @else
                <a class="page-btn" href="{{ $announcements->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach ($announcements->getUrlRange(max(1, $announcements->currentPage() - 2), min($announcements->lastPage(), $announcements->currentPage() + 2)) as $page => $url)
                <a class="page-btn {{ $page == $announcements->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
            @endforeach

            @if ($announcements->hasMorePages())
                <a class="page-btn" href="{{ $announcements->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
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
<div class="announcement-delete-overlay" id="deleteAnnouncementModal">
    <div class="announcement-delete-dialog">
        <div class="announcement-delete-icon">
            <i class="fas fa-trash-can"></i>
        </div>
        <h6 class="announcement-delete-title">Hapus Pengumuman?</h6>
        <p class="announcement-delete-text">Apakah Anda yakin ingin menghapus pengumuman ini?</p>
        <div class="announcement-delete-name" id="deleteAnnouncementTitle"></div>
        <div class="announcement-delete-actions">
            <button class="btn-corp btn-corp-soft" onclick="closeAnnouncementDeleteModal()">Batal</button>
            <form id="deleteAnnouncementForm" method="POST" style="display:inline;">
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
    // Filter functionality (pola news)
    (function() {
        const searchInput = document.getElementById('searchInput');
        const filterCategory = document.getElementById('filterCategory');
        const filterStatus = document.getElementById('filterStatus');
        const rows = document.querySelectorAll('#announcementTableBody tr[data-title]');

        function applyFilters() {
            const search = (searchInput?.value ?? '').toLowerCase();
            const category = filterCategory?.value ?? '';
            const status = filterStatus?.value ?? '';

            rows.forEach(function(row) {
                const title = row.dataset.title || '';
                const rowCategory = row.dataset.category || '';
                const rowStatus = row.dataset.status || '';

                const matchSearch = !search || title.includes(search);
                const matchCategory = !category || rowCategory === category;
                const matchStatus = !status || rowStatus === status;

                row.style.display = (matchSearch && matchCategory && matchStatus) ? '' : 'none';
            });
        }

        searchInput?.addEventListener('input', applyFilters);
        filterCategory?.addEventListener('change', applyFilters);
        filterStatus?.addEventListener('change', applyFilters);
    })();

    // Delete modal
    function openAnnouncementDeleteModal(url, title) {
        const modal = document.getElementById('deleteAnnouncementModal');
        document.getElementById('deleteAnnouncementTitle').textContent = title;
        document.getElementById('deleteAnnouncementForm').action = url;
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeAnnouncementDeleteModal() {
        document.getElementById('deleteAnnouncementModal').classList.remove('show');
        document.body.style.overflow = '';
    }

    document.getElementById('deleteAnnouncementModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeAnnouncementDeleteModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('deleteAnnouncementModal')?.classList.contains('show')) {
            closeAnnouncementDeleteModal();
        }
    });
</script>
@endpush
