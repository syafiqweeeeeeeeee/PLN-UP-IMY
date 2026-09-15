@extends('layouts.admin')

@section('title', 'Kelola Halaman — E-PPID PLN')
@section('page-title', 'Kelola Halaman')

@push('styles')
<style>
    .pages-header {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 1.5rem 1.75rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .pages-header h5 { font-size: 1.1rem; font-weight: 700; color: var(--pln-text); margin: 0 0 0.2rem; }
    .pages-header p  { font-size: 0.8rem; color: #9ca3af; margin: 0; }
    .btn-add-page {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.6rem 1.25rem; background: var(--pln-blue); color: #fff;
        border-radius: 10px; font-weight: 600; font-size: 0.85rem;
        text-decoration: none; transition: all 0.2s ease;
    }
    .btn-add-page:hover { background: #003d6b; color: #fff; transform: translateY(-1px); }

    .pages-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow: hidden;
    }
    .pages-table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
    .pages-table th {
        text-align: left; padding: 0.85rem 1.25rem;
        font-size: 0.72rem; font-weight: 700; letter-spacing: 0.05em;
        text-transform: uppercase; color: #6b7280;
        background: #f8fafc; border-bottom: 1px solid var(--border-color);
    }
    .pages-table td { padding: 0.9rem 1.25rem; border-bottom: 1px solid #f3f4f6; color: #374151; vertical-align: middle; }
    .pages-table tr:last-child td { border-bottom: none; }
    .page-title-cell { font-weight: 600; color: var(--pln-text); }
    .page-slug { font-size: 0.75rem; color: #9ca3af; font-family: monospace; }

    .badge-status {
        display: inline-flex; align-items: center; gap: 0.35rem;
        padding: 0.25rem 0.7rem; border-radius: 999px;
        font-size: 0.72rem; font-weight: 700;
    }
    .badge-status.draft     { background: #fef3c7; color: #b45309; }
    .badge-status.published { background: #dcfce7; color: #15803d; }
    .badge-vis {
        display: inline-flex; align-items: center; gap: 0.35rem;
        padding: 0.25rem 0.7rem; border-radius: 999px;
        font-size: 0.72rem; font-weight: 700;
    }
    .badge-vis.public          { background: #dbeafe; color: #1d4ed8; }
    .badge-vis.role_restricted { background: #ede9fe; color: #6d28d9; }

    .page-actions { display: flex; gap: 0.4rem; flex-wrap: wrap; }
    .btn-action {
        display: inline-flex; align-items: center; gap: 0.35rem;
        padding: 0.4rem 0.8rem; border-radius: 8px;
        font-size: 0.75rem; font-weight: 600; text-decoration: none;
        border: 1px solid var(--border-color); background: #fff; color: #4b5563;
        cursor: pointer; transition: all 0.15s ease;
    }
    .btn-action:hover { border-color: var(--pln-blue); color: var(--pln-blue); }
    .btn-action.danger:hover  { border-color: #dc2626; color: #dc2626; }
    .btn-action.success:hover { border-color: #16a34a; color: #16a34a; }
</style>
@endpush

@section('content')
@if (session('success'))
    <div class="alert alert-success py-2 px-3" style="border-radius:10px; font-size:0.83rem;">
        <i class="fas fa-circle-check me-2"></i>{{ session('success') }}
    </div>
@endif
<div class="pages-header">
    <div>
        <h5>Daftar Halaman</h5>
        <p>Kelola halaman CMS dinamis — draf, publikasi, dan visibilitas per role.</p>
    </div>
    @can('pages.create')
    <a href="{{ route('admin.pages.create') }}" class="btn-add-page">
        <i class="fas fa-plus"></i> Tambah Halaman
    </a>
    @endcan
</div>

<div class="pages-card">
    <table class="pages-table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Status</th>
                <th>Visibilitas</th>
                <th>Role</th>
                <th>Diperbarui</th>
                <th style="width: 1%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pages as $page)
                <tr>
                    <td>
                        <div class="page-title-cell">{{ $page->title }}</div>
                        <div class="page-slug">/halaman/{{ $page->slug }}</div>
                    </td>
                    <td>
                        <span class="badge-status {{ $page->status }}">
                            <i class="fas {{ $page->status === 'published' ? 'fa-circle-check' : 'fa-pencil' }}"></i>
                            {{ $statusLabels[$page->status] ?? $page->status }}
                        </span>
                    </td>
                    <td>
                        <span class="badge-vis {{ $page->visibility }}">
                            <i class="fas {{ $page->visibility === 'public' ? 'fa-globe' : 'fa-user-lock' }}"></i>
                            {{ $visibilityLabels[$page->visibility] ?? $page->visibility }}
                        </span>
                    </td>
                    <td>
                        @if ($page->visibility === 'role_restricted')
                            @if ($page->roles->isEmpty())
                                <span class="text-danger">Terkunci (tanpa role)</span>
                            @else
                                {{ $page->roles->pluck('name')->implode(', ') }}
                            @endif
                        @else
                            —
                        @endif
                    </td>
                    <td>{{ $page->updated_at->translatedFormat('d M Y H:i') }}</td>
                    <td>
                        <div class="page-actions">
                            @can('pages.edit')
                            <a href="{{ route('admin.pages.edit', $page) }}" class="btn-action" title="Edit">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('admin.pages.publish', $page) }}">
                                @csrf
                                <button type="submit" class="btn-action {{ $page->status === 'published' ? 'danger' : 'success' }}">
                                    <i class="fas {{ $page->status === 'published' ? 'fa-eye-slash' : 'fa-paper-plane' }}"></i>
                                    {{ $page->status === 'published' ? 'Tarik' : 'Terbitkan' }}
                                </button>
                            </form>
                            @endcan
                            @can('pages.delete')
                            <form method="POST" action="{{ route('admin.pages.destroy', $page) }}"
                                  onsubmit="return confirm('Hapus halaman \\'{{ $page->title }}\\'?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        <i class="fas fa-file-lines fa-2x mb-3 d-block" style="color:#d1d5db;"></i>
                        Belum ada halaman. Klik "Tambah Halaman" untuk membuat halaman pertama.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3 d-flex justify-content-center">
    {{ $pages->withQueryString()->links() }}
</div>
@endsection
