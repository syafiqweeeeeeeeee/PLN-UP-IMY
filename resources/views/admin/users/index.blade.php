@extends('layouts.admin')

@section('title', 'Kelola Pengguna — E-PPID PLN')
@section('page-title', 'Kelola Pengguna')

@push('styles')
<style>
    .user-status {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }
    .user-status.active { background: #10b981; }
    .user-status.inactive { background: #9ca3af; }
    .role-badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.6rem;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .role-admin { background: #fee2e2; color: #b91c1c; }
    .role-user { background: #dbeafe; color: #1d4ed8; }
    .role-petugas { background: #fef3c7; color: #92400e; }
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
    .action-btn.view { background: #dbeafe; color: #1d4ed8; }
    .action-btn.edit { background: #fef3c7; color: #92400e; }
    .action-btn.delete { background: #fee2e2; color: #b91c1c; }
    .search-box {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }
    .search-box:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0, 91, 156, 0.1);
        outline: none;
    }
    .table-pengguna tbody tr {
        transition: background 0.15s ease;
    }
    .table-pengguna tbody tr:hover {
        background: #f8fafc;
    }
    .avatar-placeholder {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.85rem;
    }
    #deleteConfirmModal .modal-body p { color: #6b7280; }
    #deleteConfirmModal .btn-danger {
        background: #dc2626;
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
    }
    #deleteConfirmModal .btn-danger:hover {
        background: #b91c1c;
    }
</style>
@endpush

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="dash-card">
            <div class="dash-card-header">
                <div>
                    <h5 class="dash-card-title">Daftar Pengguna</h5>
                    <p class="dash-card-subtitle">Kelola semua akun pengguna di sistem</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary" style="background: var(--pln-yellow); color: var(--pln-blue); border-radius: 8px; font-weight: 600; font-size: 0.85rem;">
                    <i class="fas fa-plus me-1"></i> Tambah Pengguna
                </a>
            </div>

            {{-- Search & Filter --}}
            <div class="row g-2 align-items-center mb-3">
                <div class="col-md-6">
                    <div class="d-flex gap-2">
                        <div class="input-group" style="border-radius: 8px; overflow: hidden;">
                            <span class="input-group-text" style="background: #f3f4f6; border: 1px solid #e5e7eb; border-right: none; border-radius: 8px 0 0 8px;">
                                <i class="fas fa-search" style="color: #6b7280; font-size: 0.8rem;"></i>
                            </span>
                            <input type="text" id="searchInput" class="search-box" placeholder="Cari nama atau email..." style="border: none; border-radius: 0 8px 8px 0;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-end text-muted" style="font-size: 0.8rem;">
                        @if (is_object($users))
                            Menampilkan {{ $users->total() }} pengguna
                        @else
                            0 pengguna
                        @endif
                    </div>
                </div>
            </div>

            {{-- Tabel Pengguna --}}
            <div class="table-responsive">
                <table class="table table-pengguna align-middle mb-0">
                    <thead>
                        <tr style="border-bottom: 2px solid #f3f4f6;">
                            <th style="text-align: left; padding: 1rem 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Pengguna</th>
                            <th style="text-align: left; padding: 1rem 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Role</th>
                            <th style="text-align: left; padding: 1rem 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                            <th style="text-align: left; padding: 1rem 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Terdaftar</th>
                            <th style="text-align: right; padding: 1rem 1rem; font-weight: 600; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td style="padding: 1rem;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-placeholder">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; color: #1f2937; font-size: 0.9rem;">
                                            {{ $user->name }}
                                        </div>
                                        <div style="color: #9ca3af; font-size: 0.8rem; margin-top: 2px;">
                                            <i class="fas fa-envelope me-1" style="font-size: 0.65rem;"></i>{{ $user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 1rem;">
                                <span class="role-badge role-{{ $user->role }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="user-status {{ $user->email_verified_at ? 'active' : 'inactive' }}"></span>
                                    <span style="font-size: 0.85rem; color: #6b7280;">
                                        {{ $user->email_verified_at ? 'Aktif' : 'Belum Verifikasi' }}
                                    </span>
                                </div>
                            </td>
                            <td style="padding: 1rem;">
                                <span style="font-size: 0.85rem; color: #6b7280;">
                                    <i class="far fa-calendar me-1"></i>
                                    {{ $user->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td style="padding: 1rem; text-align: right;">
                                <div class="d-flex gap-1 justify-content-end">
                                    <button class="action-btn view" onclick="window.location.href='{{ route('admin.users.show', $user) }}'" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" onclick="window.location.href='{{ route('admin.users.edit', $user) }}'" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="action-btn delete" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="padding: 3rem; text-align: center;">
                                <div style="color: #9ca3af;">
                                    <i class="fas fa-users" style="font-size: 2.5rem; margin-bottom: 1rem; display: block;"></i>
                                    <strong style="font-size: 1rem;">Belum ada pengguna</strong>
                                    <p style="font-size: 0.85rem; margin-top: 0.5rem;">Klik tombol "Tambah Pengguna" untuk menambahkan pengguna baru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if (is_object($users) && $users->hasPages())
            <div class="d-flex justify-content-center mt-3">
                <ul class="pagination mb-0" style="border-radius: 8px; border: 1px solid #e5e7eb; overflow: hidden;">
                    {{-- Previous Page Link --}}
                    @if ($users->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" style="background: #f3f4f6; border: none; color: #9ca3af;" href="#">&laquo;</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" style="background: #f3f4f6; border: none; color: var(--pln-blue);" href="{{ $users->previousPageUrl() }}">&laquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Links --}}
                    @foreach ($users->links() as $link)
                        @if (str_contains($link, 'page='))
                            <li class="page-item">
                                <a class="page-link" style="background: #f3f4f6; border: none; color: var(--pln-blue); font-weight: 500;" href="{{ $link }}">
                                    {!! str_replace(['<span class="page-link">', '</span>'], '', $link) !!}
                                </a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" style="background: #f3f4f6; border: none; color: var(--pln-blue);" href="{{ $users->nextPageUrl() }}">&raquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" style="background: #f3f4f6; border: none; color: #9ca3af;" href="#">&raquo;</a>
                        </li>
                    @endif
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; overflow: hidden;">
            <div class="modal-header" style="background: #fee2e2; border-bottom: none; padding: 1.25rem;">
                <i class="fas fa-triangle-exclamation" style="color: #dc2626; font-size: 1.25rem;"></i>
                <h6 class="modal-title" style="color: #b91c1c; font-weight: 700; margin-left: 0.5rem;">Hapus Pengguna?</h6>
                <button type="button" class="btn-close" style="filter: invert(1); opacity: 0.7;" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding: 1rem 1.25rem;">
                <p style="margin: 0; font-size: 0.9rem;">
                    Apakah Anda yakin ingin menghapus pengguna
                    <strong><span id="deleteUserName"></span></strong>?
                </p>
                <p style="margin: 0.75rem 0 0 0; font-size: 0.8rem; color: #ef4444;">
                    <i class="fas fa-exclamation-circle me-1"></i> Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer" style="border-top: none; padding: 0.75rem 1.25rem; gap: 0.5rem;">
                <button type="button" class="btn" style="background: #f3f4f6; color: #6b7280; border: none; border-radius: 8px; font-weight: 500;" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput')?.addEventListener('keyup', function(e) {
        const searchValue = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });

    // Delete modal
    const deleteModal = document.getElementById('deleteConfirmModal');
    deleteModal?.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const userId = button.getAttribute('data-id');
        const userName = button.getAttribute('data-name');
        
        document.getElementById('deleteUserName').textContent = userName;
        
        const form = document.getElementById('deleteForm');
        form.action = `/admin/users/${userId}`;
    });
</script>
@endpush
