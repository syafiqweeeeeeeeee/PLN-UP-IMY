@extends('layouts.karyawan')

@section('title', 'Kelola Pengumuman — Portal Karyawan')

@push('styles')
<style>
    .portal-news-header {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.25rem;
    }
    .portal-news-header .header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .portal-news-header .header-left h5 {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--pln-text);
        margin: 0 0 0.2rem;
    }
    .portal-news-header .header-left p {
        font-size: 0.78rem;
        color: #9ca3af;
        margin: 0;
    }

    .portal-news-stats {
        display: flex;
        gap: 0.6rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }
    .portal-news-stat {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 0.85rem;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        color: #4b5563;
    }
    .portal-news-stat .stat-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
    }
    .portal-news-stat .stat-dot.blue { background: var(--pln-blue); }
    .portal-news-stat .stat-dot.green { background: #22c55e; }
    .portal-news-stat .stat-dot.amber { background: #f59e0b; }

    .portal-news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 0.85rem;
    }
    .portal-news-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.2s ease;
        display: flex;
        flex-direction: column;
    }
    .portal-news-card:hover {
        border-color: #d1d5db;
        box-shadow: 0 6px 18px rgba(0,0,0,0.05);
        transform: translateY(-1px);
    }
    .portal-news-card-banner {
        padding: 0.75rem 0.9rem 0.5rem;
        display: flex;
        gap: 0.3rem;
        flex-wrap: wrap;
    }
    .portal-news-badge {
        font-size: 0.58rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        padding: 0.18rem 0.5rem;
        border-radius: 5px;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    .portal-news-badge.status-published {
        background: rgba(220, 252, 231, 0.9);
        color: #166534;
    }
    .portal-news-badge.status-draft {
        background: rgba(254, 243, 199, 0.9);
        color: #92400e;
    }
    .portal-news-badge.cat {
        background: rgba(255, 255, 255, 0.88);
        color: #4b5563;
        border: 1px solid rgba(0,0,0,0.06);
    }
    .portal-news-badge.cat-umum { background: rgba(0,91,156,0.88); color: #fff; }
    .portal-news-badge.cat-teknis { background: rgba(0,163,224,0.88); color: #fff; }
    .portal-news-badge.cat-kepegawaian { background: rgba(139,92,246,0.88); color: #fff; }
    .portal-news-badge.cat-keuangan { background: rgba(16,185,129,0.88); color: #fff; }
    .portal-news-badge.cat-layanan { background: rgba(245,158,11,0.88); color: #fff; }

    .portal-news-card-body {
        padding: 0 0.9rem 0.8rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .portal-news-card-title {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--pln-text);
        margin: 0 0 0.3rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .portal-news-card-excerpt {
        font-size: 0.74rem;
        color: #6b7280;
        line-height: 1.5;
        margin: 0 0 0.6rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }
    .portal-news-card-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 0.55rem;
        border-top: 1px solid #f3f4f6;
    }
    .portal-news-card-date {
        font-size: 0.68rem;
        color: #9ca3af;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    .portal-news-card-actions {
        display: flex;
        gap: 0.3rem;
    }
    .portal-news-action-btn {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        border: none;
        font-size: 0.68rem;
        transition: all 0.15s ease;
        padding: 0;
        cursor: pointer;
    }
    .portal-news-action-btn:hover { transform: translateY(-1px); }
    .portal-news-action-btn.edit { background: #fef3c7; color: #92400e; }
    .portal-news-action-btn.edit:hover { background: #fde68a; }
    .portal-news-action-btn.delete { background: #fee2e2; color: #b91c1c; }
    .portal-news-action-btn.delete:hover { background: #fecaca; }
    .portal-news-action-btn.publish { background: #dcfce7; color: #166534; }
    .portal-news-action-btn.publish:hover { background: #bbf7d0; }
    .portal-news-action-btn.unpublish { background: #fee2e2; color: #b91c1c; }
    .portal-news-action-btn.unpublish:hover { background: #fecaca; }

    .portal-news-empty {
        grid-column: 1 / -1;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 3rem 2rem;
        text-align: center;
    }
    .portal-news-empty .empty-icon {
        width: 60px;
        height: 60px;
        background: #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }
    .portal-news-empty .empty-icon i {
        font-size: 1.4rem;
        color: #cbd5e1;
    }
    .portal-news-empty h6 {
        font-size: 0.95rem;
        font-weight: 700;
        color: #374151;
        margin: 0 0 0.3rem;
    }
    .portal-news-empty p {
        font-size: 0.8rem;
        color: #9ca3af;
        margin: 0 0 1rem;
    }

    .portal-news-pagination {
        display: flex;
        justify-content: center;
        margin-top: 1.25rem;
    }
    .portal-news-pagination .pagination {
        display: flex;
        gap: 0.3rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .portal-news-pagination .page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 32px;
        padding: 0 0.5rem;
        border-radius: 8px;
        font-size: 0.78rem;
        font-weight: 600;
        color: #6b7280;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        cursor: pointer;
        transition: all 0.15s ease;
        text-decoration: none;
    }
    .portal-news-pagination .page-btn:hover {
        border-color: var(--pln-blue);
        color: var(--pln-blue);
        background: #f0f7ff;
    }
    .portal-news-pagination .page-btn.active {
        background: var(--pln-blue);
        color: #fff;
        border-color: var(--pln-blue);
    }
    .portal-news-pagination .page-btn.disabled {
        opacity: 0.4;
        cursor: not-allowed;
        pointer-events: none;
    }

    /* Delete confirmation modal */
    .portal-news-delete-overlay {
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
    .portal-news-delete-overlay.show {
        display: flex;
    }
    .portal-news-delete-dialog {
        background: #fff;
        border-radius: 14px;
        padding: 1.75rem 1.5rem 1.4rem;
        max-width: 400px;
        width: 100%;
        text-align: center;
        box-shadow: 0 18px 50px rgba(0, 0, 0, 0.25);
    }
    .portal-news-delete-icon {
        width: 48px;
        height: 48px;
        background: #FEE2E2;
        color: #DC2626;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin: 0 auto 1rem;
    }
    .portal-news-delete-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 0.4rem;
    }
    .portal-news-delete-text {
        font-size: 0.82rem;
        color: #6b7280;
        line-height: 1.5;
        margin: 0 0 0.3rem;
    }
    .portal-news-delete-preview {
        font-size: 0.8rem;
        font-weight: 600;
        color: #1f2937;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        padding: 0.4rem 0.7rem;
        margin: 0.6rem 0 1rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .portal-news-delete-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }
    .portal-news-delete-btn {
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.15s ease;
        border: none;
    }
    .portal-news-delete-btn.cancel {
        background: #f3f4f6;
        color: #6b7280;
    }
    .portal-news-delete-btn.cancel:hover {
        background: #e5e7eb;
        color: #374151;
    }
    .portal-news-delete-btn.confirm {
        background: #DC2626;
        color: #fff;
    }
    .portal-news-delete-btn.confirm:hover {
        background: #B91C1C;
        transform: translateY(-1px);
    }

    @media (max-width: 767.98px) {
        .portal-news-grid {
            grid-template-columns: 1fr;
        }
        .portal-news-header .header-row {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endpush

@section('content')
<div class="portal-news-header">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-bullhorn" style="color: var(--pln-blue); margin-right: 0.4rem;"></i>Kelola Pengumuman</h5>
            <p>Pengumuman yang dapat Anda kelola berdasarkan hak akses</p>
        </div>
        @can('announcements.create')
        <a href="{{ route('karyawan.announcements.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pengumuman
        </a>
        @endcan
    </div>
    <div class="portal-news-stats">
        <div class="portal-news-stat">
            <span class="stat-dot blue"></span>
            Total: {{ $announcements->total() }}
        </div>
        <div class="portal-news-stat">
            <span class="stat-dot green"></span>
            Terpublikasi: {{ $announcements->where('is_published', true)->count() }}
        </div>
        <div class="portal-news-stat">
            <span class="stat-dot amber"></span>
            Draft: {{ $announcements->where('is_published', false)->count() }}
        </div>
    </div>
</div>

<div class="portal-news-grid">
    @forelse ($announcements as $item)
    <div class="portal-news-card">
        <div class="portal-news-card-banner">
            @if (!$item->is_published)
                <span class="portal-news-badge status-draft"><i class="fas fa-pen" style="font-size: 0.5rem;"></i>Draft</span>
            @else
                <span class="portal-news-badge status-published"><i class="fas fa-check" style="font-size: 0.5rem;"></i>Published</span>
            @endif
            <span class="portal-news-badge cat cat-{{ $item->category }}">{{ ucfirst($item->category) }}</span>
            @if ($item->departmentRef)
                <span class="portal-news-badge cat"><i class="fas fa-building" style="font-size: 0.5rem;"></i> {{ $item->departmentRef->name }}</span>
            @else
                <span class="portal-news-badge cat"><i class="fas fa-globe" style="font-size: 0.5rem;"></i> Semua Bidang</span>
            @endif
        </div>
        <div class="portal-news-card-body">
            <h6 class="portal-news-card-title">
                <a href="{{ route('karyawan.announcements.show', $item) }}" style="color: inherit; text-decoration: none;">
                    {{ $item->title }}
                </a>
            </h6>
            <p class="portal-news-card-excerpt">{{ Str::limit($item->excerpt, 90) }}</p>
            <div class="portal-news-card-meta">
                <span class="portal-news-card-date">
                    <i class="far fa-calendar"></i> {{ ($item->published_at ?? $item->created_at)->format('d M Y') }}
                </span>
                <div class="portal-news-card-actions">
                    @can('announcements.edit')
                    <a href="{{ route('karyawan.announcements.edit', $item) }}" class="portal-news-action-btn edit" title="Edit">
                        <i class="fas fa-pen"></i>
                    </a>
                    @endcan
                    @can('announcements.publish')
                    <form action="{{ route('karyawan.announcements.publish', $item) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="portal-news-action-btn {{ $item->is_published ? 'unpublish' : 'publish' }}"
                                title="{{ $item->is_published ? 'Tarik Publikasi' : 'Publikasi' }}">
                            <i class="fas {{ $item->is_published ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                        </button>
                    </form>
                    @endcan
                    @can('announcements.delete')
                    <button type="button" class="portal-news-action-btn delete" title="Hapus"
                            onclick="openDeleteModal('{{ route('karyawan.announcements.destroy', $item) }}', '{{ addslashes($item->title) }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="portal-news-empty">
        <div class="empty-icon">
            <i class="far fa-bell"></i>
        </div>
        <h6>Belum ada pengumuman</h6>
        <p>Mulai tambahkan pengumuman baru.</p>
        @can('announcements.create')
        <a href="{{ route('karyawan.announcements.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pengumuman Pertama
        </a>
        @endcan
    </div>
    @endforelse
</div>

@if ($announcements->hasPages())
<div class="portal-news-pagination">
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

<!-- Delete modal -->
<div class="portal-news-delete-overlay" id="deleteModal">
    <div class="portal-news-delete-dialog">
        <div class="portal-news-delete-icon">
            <i class="fas fa-trash-can"></i>
        </div>
        <h6 class="portal-news-delete-title">Hapus Pengumuman?</h6>
        <p class="portal-news-delete-text">Apakah Anda yakin ingin menghapus pengumuman ini?</p>
        <div class="portal-news-delete-preview" id="deleteTitle"></div>
        <div class="portal-news-delete-actions">
            <button class="portal-news-delete-btn cancel" onclick="closeDeleteModal()">Batal</button>
            <form id="deleteForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="portal-news-delete-btn confirm">
                    <i class="fas fa-trash me-1"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openDeleteModal(url, title) {
    const modal = document.getElementById('deleteModal');
    document.getElementById('deleteTitle').textContent = title;
    document.getElementById('deleteForm').action = url;
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('show');
    document.body.style.overflow = '';
}

document.getElementById('deleteModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && document.getElementById('deleteModal')?.classList.contains('show')) {
        closeDeleteModal();
    }
});
</script>
@endsection
