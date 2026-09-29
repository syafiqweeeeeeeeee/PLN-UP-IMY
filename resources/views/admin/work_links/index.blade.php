@extends('layouts.admin')

@section('title', 'Manajemen Link Kerja — E-PPID PLN')
@section('page-title', 'Link Kerja')

@push('styles')
<style>
    /* ============================================
       WORK LINKS — pola halaman Pengumuman (tabel)
       ============================================ */
    .worklink-badge {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
        white-space: nowrap;
    }
    .worklink-badge.umum {
        background: #dcfce7;
        color: #166534;
    }
    .worklink-badge.khusus {
        background: rgba(0, 143, 168, 0.14);
        color: #007790;
    }
    .worklink-status-badge {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
        white-space: nowrap;
    }
    .worklink-status-badge.aktif {
        background: #dcfce7;
        color: #166534;
    }
    .worklink-status-badge.nonaktif {
        background: #fee2e2;
        color: #b91c1c;
    }
    .worklink-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #008fa8, #00566b);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }
    .worklink-url {
        color: var(--ink-faint);
        font-size: 0.78rem;
        font-family: monospace;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 280px;
    }
    .target-cell {
        font-size: 0.8rem;
        color: var(--ink-muted);
        white-space: nowrap;
    }

    /* ============================================
       DELETE CONFIRMATION MODAL (pola news modal)
       ============================================ */
    .worklink-delete-overlay {
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
    .worklink-delete-overlay.show { display: flex; }
    .worklink-delete-dialog {
        background: #fff;
        border-radius: 16px;
        padding: 2rem 1.75rem 1.5rem;
        max-width: 420px;
        width: 100%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        animation: worklinkDeleteIn 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    @keyframes worklinkDeleteIn {
        from { opacity: 0; transform: scale(0.9) translateY(10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .worklink-delete-icon {
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
    .worklink-delete-title { font-size: 1.05rem; font-weight: 700; color: #1f2937; margin: 0 0 0.5rem; }
    .worklink-delete-text { font-size: 0.88rem; color: #6b7280; line-height: 1.6; margin: 0 0 0.35rem; }
    .worklink-delete-name {
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
    .worklink-delete-actions { display: flex; gap: 0.6rem; justify-content: center; }
    .worklink-delete-btn {
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }
    .worklink-delete-btn.cancel { background: #f3f4f6; color: #6b7280; }
    .worklink-delete-btn.cancel:hover { background: #e5e7eb; color: #374151; }
    .worklink-delete-btn.confirm { background: #DC2626; color: #fff; }
    .worklink-delete-btn.confirm:hover {
        background: #B91C1C;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }
</style>
@endpush

@section('content')
{{-- ============================================
     PAGE HEADER (pola /admin/announcements)
     ============================================ --}}
<div class="page-header-card">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-link header-icon"></i>Manajemen Link Kerja</h5>
            <p>Kelola tautan alat kerja yang tampil di Portal Karyawan</p>
        </div>
        @can('work_links.create')
        <a href="{{ route('admin.work-links.create') }}" class="btn-corp btn-corp-add">
            <i class="fas fa-plus"></i> Tambah Link Kerja
        </a>
        @endcan
    </div>

    <div class="stat-chips-row">
        <div class="stat-chip">
            <span class="stat-dot blue"></span>
            Total
            <span class="stat-number">{{ $links->total() }}</span>
        </div>
        <div class="stat-chip">
            <span class="stat-dot green"></span>
            Aktif
            <span class="stat-number">{{ \App\Models\WorkLink::where('is_active', true)->count() }}</span>
        </div>
        <div class="stat-chip">
            <span class="stat-dot amber"></span>
            Nonaktif
            <span class="stat-number">{{ \App\Models\WorkLink::where('is_active', false)->count() }}</span>
        </div>
    </div>
</div>

{{-- ============================================
     FILTER BAR
     ============================================ --}}
<div class="page-filter-bar">
    <div class="search-wrapper">
        <i class="fas fa-search search-icon"></i>
        <input type="text" id="searchInput" class="filter-input" placeholder="Cari nama link atau URL..." value="{{ request('q') }}">
    </div>
    <div class="filter-divider"></div>
    <select id="filterCategory" class="filter-input" style="width:auto;">
        <option value="">Semua Kategori</option>
        <option value="umum" {{ request('kategori') === 'umum' ? 'selected' : '' }}>Umum</option>
        <option value="khusus" {{ request('kategori') === 'khusus' ? 'selected' : '' }}>Khusus</option>
    </select>
    <select id="filterStatus" class="filter-input" style="width:auto;">
        <option value="">Semua Status</option>
        <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
        <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
    </select>
    <div class="filter-divider"></div>
    <span class="filter-count">{{ $links->total() }} link kerja</span>
</div>

{{-- ============================================
     WORK LINK TABLE
     ============================================ --}}
<div class="dash-card">
    <div class="table-responsive">
        <table class="table admin-table align-middle mb-0">
            <thead>
                <tr>
                    <th>Nama Link</th>
                    <th class="col-hide-mobile">URL</th>
                    <th>Kategori</th>
                    <th>Target Bidang</th>
                    <th>Target Sub-Bidang</th>
                    <th>Status</th>
                    <th class="th-actions">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($links as $item)
                <tr data-title="{{ strtolower($item->title) }}"
                    data-url="{{ strtolower($item->url) }}"
                    data-category="{{ $item->category }}"
                    data-status="{{ $item->is_active ? 'aktif' : 'nonaktif' }}">
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <span class="worklink-icon"><i class="fas {{ $item->icon ?: 'fa-link' }}"></i></span>
                            <div style="min-width: 0;">
                                <div style="font-weight: 600; color: var(--ink-heading); font-size: 0.88rem;">
                                    {{ $item->title }}
                                </div>
                                @if ($item->description)
                                    <div style="color: var(--ink-faint); font-size: 0.76rem; max-width: 260px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $item->description }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="col-hide-mobile">
                        <a href="{{ $item->url }}" target="_blank" rel="noopener" class="worklink-url" title="{{ $item->url }}">
                            {{ $item->url }}
                        </a>
                    </td>
                    <td>
                        <span class="worklink-badge {{ $item->category }}">{{ ucfirst($item->category) }}</span>
                    </td>
                    <td>
                        <span class="target-cell">
                            {{ $item->category === 'umum' ? '—' : (\App\Models\User::DEPARTMENTS[$item->department] ?? '-') }}
                        </span>
                    </td>
                    <td>
                        <span class="target-cell">
                            @if ($item->category === 'umum' || ! $item->sub_department)
                                —
                            @else
                                {{ \App\Models\User::subDepartmentLabel($item->department, $item->sub_department) ?? $item->sub_department }}
                            @endif
                        </span>
                    </td>
                    <td>
                        <span class="worklink-status-badge {{ $item->is_active ? 'aktif' : 'nonaktif' }}">
                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="td-actions">
                        <div class="d-flex gap-1 justify-content-end">
                            @can('work_links.edit')
                            <a href="{{ route('admin.work-links.edit', $item) }}" class="news-action-btn edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.work-links.toggle-status', $item) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="news-action-btn {{ $item->is_active ? 'unpublish' : 'publish' }}"
                                        title="{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    <i class="fas {{ $item->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                </button>
                            </form>
                            @endcan
                            @can('work_links.delete')
                            <button type="button" class="news-action-btn delete" title="Hapus"
                                    onclick="openWorkLinkDeleteModal('{{ route('admin.work-links.destroy', $item) }}', '{{ addslashes($item->title) }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="news-empty-state" style="grid-column: auto; border: none;">
                            <div class="empty-icon"><i class="fas fa-link"></i></div>
                            <h6>Belum ada link kerja</h6>
                            <p>Klik tombol "Tambah Link Kerja" untuk membuat tautan baru untuk Portal Karyawan.</p>
                            @can('work_links.create')
                            <a href="{{ route('admin.work-links.create') }}" class="btn-corp btn-corp-add">
                                <i class="fas fa-plus"></i> Tambah Link Pertama
                            </a>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($links->hasPages())
    <div class="page-pagination">
        <div class="pagination">
            @if ($links->onFirstPage())
                <span class="page-btn disabled"><i class="fas fa-chevron-left"></i></span>
            @else
                <a class="page-btn" href="{{ $links->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach ($links->getUrlRange(max(1, $links->currentPage() - 2), min($links->lastPage(), $links->currentPage() + 2)) as $page => $url)
                <a class="page-btn {{ $page == $links->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
            @endforeach

            @if ($links->hasMorePages())
                <a class="page-btn" href="{{ $links->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
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
<div class="worklink-delete-overlay" id="deleteWorkLinkModal">
    <div class="worklink-delete-dialog">
        <div class="worklink-delete-icon">
            <i class="fas fa-trash-can"></i>
        </div>
        <h6 class="worklink-delete-title">Hapus Link Kerja?</h6>
        <p class="worklink-delete-text">Apakah Anda yakin ingin menghapus link kerja ini?</p>
        <div class="worklink-delete-name" id="deleteWorkLinkTitle"></div>
        <div class="worklink-delete-actions">
            <button class="worklink-delete-btn cancel" onclick="closeWorkLinkDeleteModal()">Batal</button>
            <form id="deleteWorkLinkForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="worklink-delete-btn confirm">
                    <i class="fas fa-trash me-1"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Script inline — WAJIB di dalam content agar router.js
     mengeksekusi ulang setelah navigasi SPA. --}}
<script>
    (function() {
        const searchInput = document.getElementById('searchInput');
        const filterCategory = document.getElementById('filterCategory');
        const filterStatus = document.getElementById('filterStatus');
        const rows = document.querySelectorAll('tbody tr[data-title]');

        function applyFilters() {
            const search = (searchInput?.value ?? '').toLowerCase();
            const category = filterCategory?.value ?? '';
            const status = filterStatus?.value ?? '';

            rows.forEach(function(row) {
                const title = row.dataset.title || '';
                const url = row.dataset.url || '';
                const rowCategory = row.dataset.category || '';
                const rowStatus = row.dataset.status || '';

                const matchSearch = !search || title.includes(search) || url.includes(search);
                const matchCategory = !category || rowCategory === category;
                const matchStatus = !status || rowStatus === status;

                row.style.display = (matchSearch && matchCategory && matchStatus) ? '' : 'none';
            });
        }

        searchInput?.addEventListener('input', applyFilters);
        filterCategory?.addEventListener('change', applyFilters);
        filterStatus?.addEventListener('change', applyFilters);
    })();

    if (!window.__workLinkDeleteModalBound) {
        window.__workLinkDeleteModalBound = true;

        window.openWorkLinkDeleteModal = function(url, title) {
            const modal = document.getElementById('deleteWorkLinkModal');
            document.getElementById('deleteWorkLinkTitle').textContent = title;
            document.getElementById('deleteWorkLinkForm').action = url;
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        };

        window.closeWorkLinkDeleteModal = function() {
            document.getElementById('deleteWorkLinkModal').classList.remove('show');
            document.body.style.overflow = '';
        };

        document.getElementById('deleteWorkLinkModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeWorkLinkDeleteModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('deleteWorkLinkModal')?.classList.contains('show')) {
                closeWorkLinkDeleteModal();
            }
        });
    }
</script>
@endsection
