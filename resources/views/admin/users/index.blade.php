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
    .role-badge-active { background: #dcfce7; color: #166534; }
    .role-badge-inactive { background: #fef3c7; color: #92400e; }
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
        flex-shrink: 0;
    }

    /* ============================================
       DELETE CONFIRMATION MODAL (pola news modal)
       ============================================ */
    .user-delete-overlay {
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
    .user-delete-overlay.show { display: flex; }
    .user-delete-dialog {
        background: #fff;
        border-radius: 16px;
        padding: 2rem 1.75rem 1.5rem;
        max-width: 420px;
        width: 100%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        animation: userDeleteIn 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    @keyframes userDeleteIn {
        from { opacity: 0; transform: scale(0.9) translateY(10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .user-delete-icon {
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
    .user-delete-title { font-size: 1.05rem; font-weight: 700; color: #1f2937; margin: 0 0 0.5rem; }
    .user-delete-text { font-size: 0.88rem; color: var(--ink-muted); line-height: 1.6; margin: 0 0 0.35rem; }
    .user-delete-name {
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
    .user-delete-actions { display: flex; gap: 0.6rem; justify-content: center; }
</style>
@endpush

@section('content')
<<<<<<< HEAD
{{-- ============================================
     PAGE HEADER (pola /admin/news)
     ============================================ --}}
<div class="page-header-card">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-users header-icon"></i>Daftar Pengguna</h5>
            <p>Kelola semua akun pengguna di sistem</p>
=======
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
                                    @php
                                        $roleModel = $user->getRelationValue('role');
                                        $roleName = $roleModel && $roleModel instanceof App\Models\Role ? $roleModel->name : (is_string($user->role) ? $user->role : 'Pengguna');
                                        $roleStatus = $roleModel && $roleModel instanceof App\Models\Role ? $roleModel->status : true;
                                        $roleBadgeClass = $roleStatus ? 'role-badge-active' : 'role-badge-inactive';
                                        $inactiveLabel = $roleStatus ? '' : ' (Nonaktif)';
                                    @endphp
                                    <span class="role-badge {{ $roleBadgeClass }}">
                                        {{ $roleName }}{{ $inactiveLabel }}
                                    </span>
                                </td>
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
                    @foreach ($users->getUrlRange(max(1, $users->currentPage() - 2), min($users->lastPage(), $users->currentPage() + 2)) as $page => $url)
                        <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                            <a class="page-link" style="background: #f3f4f6; border: none; {{ $page == $users->currentPage() ? 'font-weight: 700; color: #fff; background: var(--pln-blue);' : 'color: var(--pln-blue); font-weight: 500;' }}" href="{{ $url }}">{{ $page }}</a>
                        </li>
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
>>>>>>> 1712595b57b4dcf086b363062f2fd394416f58ce
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-corp btn-corp-add">
            <i class="fas fa-plus"></i> Tambah Pengguna
        </a>
    </div>

    {{-- Stats Chips --}}
    <div class="stat-chips-row">
        <div class="stat-chip">
            <span class="stat-dot blue"></span>
            Total
            <span class="stat-number">
                @if (is_object($users)) {{ $users->total() }} @else 0 @endif
            </span>
        </div>
        @if (is_object($users))
        <div class="stat-chip">
            <span class="stat-dot green"></span>
            Aktif
            <span class="stat-number">{{ $users->filter(fn ($u) => $u->email_verified_at)->count() }}</span>
        </div>
        <div class="stat-chip">
            <span class="stat-dot amber"></span>
            Belum Verifikasi
            <span class="stat-number">{{ $users->filter(fn ($u) => !$u->email_verified_at)->count() }}</span>
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
        <input type="text" id="searchInput" class="filter-input" placeholder="Cari nama atau email...">
    </div>
    <div class="filter-divider"></div>
    <span class="filter-count">
        @if (is_object($users))
            {{ $users->total() }} pengguna
        @else
            0 pengguna
        @endif
    </span>
</div>

{{-- ============================================
     USER TABLE
     ============================================ --}}
<div class="dash-card">
    <div class="table-responsive">
        <table class="table admin-table align-middle mb-0">
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Terdaftar</th>
                    <th class="th-actions">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr data-search="{{ strtolower($user->name . ' ' . $user->email) }}">
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-placeholder">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div>
                                <div style="font-weight: 600; color: var(--ink-heading); font-size: 0.9rem;">
                                    {{ $user->name }}
                                </div>
                                <div style="color: var(--ink-faint); font-size: 0.8rem; margin-top: 2px;">
                                    <i class="fas fa-envelope me-1" style="font-size: 0.65rem;"></i>{{ $user->email }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @php
                            $roleModel = $user->getRelationValue('role');
                            $roleName = $roleModel && $roleModel instanceof App\Models\Role ? $roleModel->name : (is_string($user->role) ? $user->role : 'Pengguna');
                            $roleStatus = $roleModel && $roleModel instanceof App\Models\Role ? $roleModel->status : true;
                            $roleBadgeClass = $roleStatus ? 'role-badge-active' : 'role-badge-inactive';
                            $inactiveLabel = $roleStatus ? '' : ' (Nonaktif)';
                        @endphp
                        <span class="role-badge {{ $roleBadgeClass }}">
                            {{ $roleName }}{{ $inactiveLabel }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <span class="user-status {{ $user->email_verified_at ? 'active' : 'inactive' }}"></span>
                            <span style="font-size: 0.85rem; color: var(--ink-muted);">
                                {{ $user->email_verified_at ? 'Aktif' : 'Belum Verifikasi' }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <span style="font-size: 0.85rem; color: var(--ink-muted);">
                            <i class="far fa-calendar me-1"></i>
                            {{ $user->created_at->format('d M Y') }}
                        </span>
                    </td>
                    <td class="td-actions">
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="{{ route('admin.users.show', $user) }}" class="news-action-btn edit" style="background: #dbeafe; color: #1d4ed8;" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="news-action-btn edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <button type="button" class="news-action-btn delete" title="Hapus"
                                    onclick="openUserDeleteModal({{ $user->id }}, '{{ addslashes($user->name) }}')">
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

    {{-- Pagination (pola news) --}}
    @if (is_object($users) && $users->hasPages())
    <div class="page-pagination">
        <div class="pagination">
            @if ($users->onFirstPage())
                <span class="page-btn disabled"><i class="fas fa-chevron-left"></i></span>
            @else
                <a class="page-btn" href="{{ $users->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach ($users->getUrlRange(max(1, $users->currentPage() - 2), min($users->lastPage(), $users->currentPage() + 2)) as $page => $url)
                <a class="page-btn {{ $page == $users->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
            @endforeach

            @if ($users->hasMorePages())
                <a class="page-btn" href="{{ $users->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
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
<div class="user-delete-overlay" id="deleteUserModal">
    <div class="user-delete-dialog">
        <div class="user-delete-icon">
            <i class="fas fa-trash-can"></i>
        </div>
        <h6 class="user-delete-title">Hapus Pengguna?</h6>
        <p class="user-delete-text">Apakah Anda yakin ingin menghapus pengguna ini?</p>
        <div class="user-delete-name" id="deleteUserName"></div>
        <div class="user-delete-actions">
            <button class="btn-corp btn-corp-soft" onclick="closeUserDeleteModal()">Batal</button>
            <form id="deleteUserForm" method="POST" style="display:inline;">
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
    // Search functionality
    (function() {
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll('tbody tr[data-search]');

        function applyFilters() {
            const search = (searchInput?.value ?? '').toLowerCase();
            let visibleCount = 0;

            rows.forEach(function(row) {
                const text = row.dataset.search || '';
                const show = !search || text.includes(search);
                row.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });
        }

        searchInput?.addEventListener('input', applyFilters);
    })();

    // Delete modal
    function openUserDeleteModal(userId, userName) {
        const modal = document.getElementById('deleteUserModal');
        document.getElementById('deleteUserName').textContent = userName;
        document.getElementById('deleteUserForm').action = `/admin/users/${userId}`;
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeUserDeleteModal() {
        document.getElementById('deleteUserModal').classList.remove('show');
        document.body.style.overflow = '';
    }

    document.getElementById('deleteUserModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeUserDeleteModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('deleteUserModal')?.classList.contains('show')) {
            closeUserDeleteModal();
        }
    });
</script>
@endpush
