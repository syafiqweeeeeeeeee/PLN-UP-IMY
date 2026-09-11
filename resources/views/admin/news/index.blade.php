@extends('layouts.admin')

@section('title', 'Kelola Berita — E-PPID PLN')
@section('page-title', 'Kelola Berita')

@push('styles')
<style>
    .news-status-badge {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
    }
    .news-status-badge.published {
        background: #dcfce7;
        color: #166534;
    }
    .news-status-badge.draft {
        background: #fef3c7;
        color: #92400e;
    }
    .news-category-badge {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.2rem 0.55rem;
        border-radius: 6px;
    }
    .news-category-badge.umum    { background: rgba(0,91,156,0.88); color: #fff; }
    .news-category-badge.teknis  { background: rgba(0,163,224,0.88); color: #fff; }
    .news-category-badge.kegiatan { background: rgba(255,230,0,0.92); color: #005B9C; }
    .news-category-badge.kepegawaian { background: rgba(139,92,246,0.88); color: #fff; }

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
    .action-btn.view   { background: #dbeafe; color: #1d4ed8; }
    .action-btn.edit   { background: #fef3c7; color: #92400e; }
    .action-btn.delete { background: #fee2e2; color: #b91c1c; }
    .action-btn.publish { background: #dcfce7; color: #166534; }
    .action-btn.unpublish { background: #fee2e2; color: #b91c1c; }

    .search-box {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }
    .search-box:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0,91,156,0.1);
        outline: none;
    }

    .table-berita tbody tr { transition: background 0.15s ease; }
    .table-berita tbody tr:hover { background: #f8fafc; }

    .avatar-placeholder {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.8rem;
    }

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
                    <h5 class="dash-card-title">Daftar Berita</h5>
                    <p class="dash-card-subtitle">Kelola berita yang akan ditampilkan di situs informasi</p>
                </div>
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary" style="background: var(--pln-yellow); color: var(--pln-blue); border-radius: 8px; font-weight: 600; font-size: 0.85rem;">
                    <i class="fas fa-plus me-1"></i> Tambah Berita
                </a>
            </div>

            {{-- Search --}}
            <div class="row g-2 align-items-center mb-3">
                <div class="col-md-6">
                    <div class="d-flex gap-2">
                        <div class="input-group" style="border-radius: 8px; overflow: hidden;">
                            <span class="input-group-text" style="background: #f3f4f6; border: 1px solid #e5e7eb; border-right: none; border-radius: 8px 0 0 8px;">
                                <i class="fas fa-search" style="color: #6b7280; font-size: 0.8rem;"></i>
                            </span>
                            <input type="text" id="searchInput" class="search-box" placeholder="Cari judul berita..." style="border: none; border-radius: 0 8px 8px 0;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <select id="filterCategory" class="search-box" style="cursor: pointer;">
                            <option value="">Semua Kategori</option>
                            <option value="umum">Umum</option>
                            <option value="teknis">Teknis</option>
                            <option value="kegiatan">Kegiatan</option>
                            <option value="kepegawaian">Kepegawaian</option>
                        </select>
                        <select id="filterStatus" class="search-box" style="cursor: pointer;">
                            <option value="">Semua Status</option>
                            <option value="1">Terpublikasi</option>
                            <option value="0">Draft</option>
                        </select>
                        <span class="text-muted" style="font-size: 0.8rem; align-self: center;">
                            @if (is_object($news))
                                {{ $news->total() }} berita
                            @else
                                0 berita
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-berita align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="text-align: left; padding: 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Berita</th>
                            <th style="text-align: left; padding: 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Kategori</th>
                            <th style="text-align: left; padding: 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                            <th style="text-align: left; padding: 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Dibuat</th>
                            <th style="text-align: right; padding: 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="newsTableBody">
                        @forelse ($news as $item)
                        <tr>
                            <td style="padding: 1rem;">
                                <div class="d-flex align-items-center gap-3">
                                    @if ($item->image)
                                    <div style="width: 54px; height: 54px; border-radius: 10px; overflow: hidden; background: #f1f5f9; flex-shrink: 0;">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                    @endif
                                    <div style="min-width: 0;">
                                        <div style="font-weight: 600; color: #1f2937; font-size: 0.88rem;">
                                            {{ $item->title }}
                                            @if (!$item->is_published)
                                            <span style="font-size: 0.65rem; font-weight: 700; color: #92400e; background: #fef3c7; padding: 0.1rem 0.45rem; border-radius: 4px; margin-left: 0.4rem; vertical-align: middle;">DRAFT</span>
                                            @endif
                                        </div>
                                        <div style="color: #9ca3af; font-size: 0.78rem; margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            {{ Str::limit($item->excerpt, 50) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 1rem;">
                                <span class="news-category-badge {{ $item->category }}">{{ ucfirst($item->category) }}</span>
                            </td>
                            <td style="padding: 1rem;">
                                <span class="news-status-badge {{ $item->is_published ? 'published' : 'draft' }}">
                                    {{ $item->is_published ? 'Terpublikasi' : 'Draft' }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                <span style="font-size: 0.85rem; color: #6b7280;">
                                    <i class="far fa-calendar me-1"></i>{{ $item->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td style="padding: 1rem; text-align: right;">
                                <div class="d-flex gap-1 justify-content-end">
                                    <a href="{{ route('admin.news.edit', $item) }}" class="action-btn edit" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    @if ($item->is_published)
                                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus berita ini? Tindakan tidak dapat dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.news.publish', $item) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="action-btn unpublish" title="Tarik Publikasi">
                                                <i class="fas fa-eye-slash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.news.publish', $item) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="action-btn publish" title="Publikasi">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus berita ini? Tindakan tidak dapat dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-newspaper"></i>
                                    <h6>Belum ada berita</h6>
                                    <p>Klik tombol "Tambah Berita" untuk menambahkan berita baru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if (is_object($news) && $news->hasPages())
            <div class="d-flex justify-content-center mt-3">
                <ul class="pagination mb-0" style="border-radius: 8px; border: 1px solid #e5e7eb; overflow: hidden;">
                    @if ($news->onFirstPage())
                        <li class="page-item disabled"><a class="page-link" style="background: #f3f4f6; border: none; color: #9ca3af;" href="#">&laquo;</a></li>
                    @else
                        <li class="page-item"><a class="page-link" style="background: #f3f4f6; border: none; color: var(--pln-blue);" href="{{ $news->previousPageUrl() }}">&laquo;</a></li>
                    @endif

                    @foreach ($news->links() as $link)
                        @if (str_contains($link, 'page='))
                            <li class="page-item">
                                <a class="page-link" style="background: #f3f4f6; border: none; color: var(--pln-blue); font-weight: 500;" href="{{ $link }}">
                                    {!! str_replace(['<span class="page-link">', '</span>'], '', $link) !!}
                                </a>
                            </li>
                        @endif
                    @endforeach

                    @if ($news->hasMorePages())
                        <li class="page-item"><a class="page-link" style="background: #f3f4f6; border: none; color: var(--pln-blue);" href="{{ $news->nextPageUrl() }}">&raquo;</a></li>
                    @else
                        <li class="page-item disabled"><a class="page-link" style="background: #f3f4f6; border: none; color: #9ca3af;" href="#">&raquo;</a></li>
                    @endif
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
<script>
    (function() {
        const searchInput = document.getElementById('searchInput');
        const filterCategory = document.getElementById('filterCategory');
        const filterStatus = document.getElementById('filterStatus');
        const tableBody = document.getElementById('newsTableBody');
        const rows = tableBody?.querySelectorAll('tr') ?? [];

        function applyFilters() {
            const search = (searchInput?.value ?? '').toLowerCase();
            const category = filterCategory?.value ?? '';
            const status = filterStatus?.value ?? '';

            rows.forEach(function(row) {
                const titleEl = row.querySelector('td:nth-child(1)');
                const categoryEl = row.querySelector('.news-category-badge');
                const statusEl = row.querySelector('.news-status-badge');

                const titleText = titleEl ? titleEl.textContent.toLowerCase() : '';
                const categoryText = categoryEl ? categoryEl.textContent.trim().toLowerCase() : '';
                const statusText = statusEl ? statusEl.textContent.trim().toLowerCase() : '';

                const matchSearch = !search || titleText.includes(search);
                const matchCategory = !category || categoryText.includes(category);
                const matchStatus = !status || (status === '1' && statusText.includes('terpublikasi'))
                    || (status === '0' && statusText.includes('draft'));

                row.style.display = (matchSearch && matchCategory && matchStatus) ? '' : 'none';
            });
        }

        searchInput?.addEventListener('input', applyFilters);
        filterCategory?.addEventListener('change', applyFilters);
        filterStatus?.addEventListener('change', applyFilters);
    })();
</script>
@endsection
