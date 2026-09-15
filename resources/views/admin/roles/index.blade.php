@extends('layouts.admin')

@section('title', 'Kelola Role — E-PPID PLN')
@section('page-title', 'Kelola Role')

@push('styles')
<style>
    .role-badge-active {
        background: #dcfce7;
        color: #166534;
    }
    .role-badge-inactive {
        background: #fef3c7;
        color: #92400e;
    }

    /* ============================================
       DELETE CONFIRMATION MODAL (pola news modal)
       ============================================ */
    .role-delete-overlay {
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
    .role-delete-overlay.show { display: flex; }
    .role-delete-dialog {
        background: #fff;
        border-radius: 16px;
        padding: 2rem 1.75rem 1.5rem;
        max-width: 420px;
        width: 100%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        animation: roleDeleteIn 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    @keyframes roleDeleteIn {
        from { opacity: 0; transform: scale(0.9) translateY(10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .role-delete-icon {
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
    .role-delete-title { font-size: 1.05rem; font-weight: 700; color: #1f2937; margin: 0 0 0.5rem; }
    .role-delete-text { font-size: 0.88rem; color: #6b7280; line-height: 1.6; margin: 0 0 0.35rem; }
    .role-delete-name {
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
    .role-delete-actions { display: flex; gap: 0.6rem; justify-content: center; }
</style>
@endpush

@section('content')
{{-- ============================================
     PAGE HEADER (pola /admin/news)
     ============================================ --}}
<div class="page-header-card">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-user-tag header-icon"></i>Daftar Role</h5>
            <p>Kelola hak akses role pengguna di sistem</p>
        </div>
        <a href="{{ route('admin.roles.create') }}" class="btn-corp btn-corp-add">
            <i class="fas fa-plus"></i> Tambah Role
        </a>
    </div>

<<<<<<< HEAD
    {{-- Stats Chips --}}
    <div class="stat-chips-row">
        <div class="stat-chip">
            <span class="stat-dot blue"></span>
            Total Role
            <span class="stat-number">{{ $roles->total() }}</span>
        </div>
        <div class="stat-chip">
            <span class="stat-dot green"></span>
            Aktif
            <span class="stat-number">{{ $roles->filter(fn ($r) => $r->status)->count() }}</span>
        </div>
        <div class="stat-chip">
            <span class="stat-dot amber"></span>
            Nonaktif
            <span class="stat-number">{{ $roles->filter(fn ($r) => !$r->status)->count() }}</span>
=======
            <div class="table-responsive">
                <table class="table table-role align-middle mb-0">
                    <thead>
                        <tr style="border-bottom: 2px solid #f3f4f6;">
                            <th style="text-align:left; padding:1rem;">Nama Role</th>
                            <th style="text-align:left; padding:1rem;">Deskripsi</th>
                            <th style="text-align:center; padding:1rem;">User</th>
                            <th style="text-align:center; padding:1rem;">Permission</th>
                            <th style="text-align:center; padding:1rem;">Status</th>
                            <th style="text-align:left; padding:1rem;">Dibuat</th>
                            <th style="text-align:right; padding:1rem;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                        <tr>
                            <td style="padding:1rem;">
                                <div style="font-weight:600; color:#1f2937;">{{ $role->name }}</div>
                            </td>
                            <td style="padding:1rem; color:#6b7280; font-size:0.85rem;">
                                {{ $role->description ?? '-' }}
                            </td>
                            <td style="padding:1rem; text-align:center; color:#374151; font-weight:600;">
                                {{ $role->users_count }}
                            </td>
                            <td style="padding:1rem; text-align:center; color:#374151; font-weight:600;">
                                {{ $role->permissions_count }}
                            </td>
                            <td style="padding:1rem; text-align:center;">
                                <span class="badge {{ $role->status ? 'role-badge-active' : 'role-badge-inactive' }}" style="border-radius:20px; font-size:0.75rem; font-weight:600; padding:0.3rem 0.7rem;">
                                    {{ $role->status ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td style="padding:1rem; color:#6b7280; font-size:0.85rem;">
                                {{ $role->created_at->format('d M Y') }}
                            </td>
                            <td style="padding:1rem; text-align:right;">
                                <div class="d-flex gap-1 justify-content-end flex-wrap">
                                    <button class="action-btn view" onclick="window.location.href='{{ route('admin.roles.permissions', $role) }}'" title="Kelola Permission">
                                        <i class="fas fa-lock-open"></i>
                                    </button>
                                    <button class="action-btn edit" onclick="window.location.href='{{ route('admin.roles.edit', $role) }}'" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    @if ($role->status)
                                        <button class="action-btn activate" onclick="deactivateRole({{ $role->id }}, '{{ $role->name }}')" title="Nonaktifkan">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    @else
                                        <button class="action-btn activate" onclick="activateRole({{ $role->id }}, '{{ $role->name }}')" title="Aktifkan">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                    @endif
                                    <button class="action-btn delete" data-bs-toggle="modal" data-bs-target="#deleteRoleModal" data-id="{{ $role->id }}" data-name="{{ $role->name }}" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="padding:3rem; text-align:center;">
                                <div style="color:#9ca3af;">
                                    <i class="fas fa-user-tag" style="font-size:2.5rem; margin-bottom:1rem; display:block;"></i>
                                    <strong style="font-size:1rem;">Belum ada role</strong>
                                    <p style="font-size:0.85rem; margin-top:0.5rem;">Klik tombol "Tambah Role" untuk membuat role baru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (isset($roles) && $roles->hasPages())
            <div class="d-flex justify-content-center mt-3">
                <ul class="pagination mb-0" style="border-radius:8px; border:1px solid #e5e7eb; overflow:hidden;">
                    @if ($roles->onFirstPage())
                        <li class="page-item disabled"><a class="page-link" style="background:#f3f4f6; border:none; color:#9ca3af;" href="#">&laquo;</a></li>
                    @else
                        <li class="page-item"><a class="page-link" style="background:#f3f4f6; border:none; color:var(--pln-blue);" href="{{ $roles->previousPageUrl() }}">&laquo;</a></li>
                    @endif
                    @foreach ($roles->getUrlRange(max(1, $roles->currentPage() - 2), min($roles->lastPage(), $roles->currentPage() + 2)) as $page => $url)
                        <li class="page-item {{ $page == $roles->currentPage() ? 'active' : '' }}">
                            <a class="page-link" style="background:#f3f4f6; border:none; {{ $page == $roles->currentPage() ? 'font-weight:700; color:#fff; background:var(--pln-blue);' : 'color:var(--pln-blue);' }}" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    @if ($roles->hasMorePages())
                        <li class="page-item"><a class="page-link" style="background:#f3f4f6; border:none; color:var(--pln-blue);" href="{{ $roles->nextPageUrl() }}">&raquo;</a></li>
                    @else
                        <li class="page-item disabled"><a class="page-link" style="background:#f3f4f6; border:none; color:#9ca3af;" href="#">&raquo;</a></li>
                    @endif
                </ul>
            </div>
            @endif
>>>>>>> 1712595b57b4dcf086b363062f2fd394416f58ce
        </div>
    </div>
</div>

{{-- ============================================
     ROLE TABLE
     ============================================ --}}
<div class="dash-card">
    <div class="table-responsive">
        <table class="table admin-table align-middle mb-0">
            <thead>
                <tr>
                    <th>Nama Role</th>
                    <th>Deskripsi</th>
                    <th style="text-align: center;">User</th>
                    <th style="text-align: center;">Permission</th>
                    <th style="text-align: center;">Status</th>
                    <th>Dibuat</th>
                    <th class="th-actions">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                <tr>
                    <td>
                        <div style="font-weight:600; color:var(--ink-heading);">{{ $role->name }}</div>
                    </td>
                    <td style="color:var(--ink-muted); font-size:0.85rem;">
                        {{ $role->description ?? '-' }}
                    </td>
                    <td style="text-align:center; color:var(--ink-body); font-weight:600;">
                        {{ $role->users_count }}
                    </td>
                    <td style="text-align:center; color:var(--ink-body); font-weight:600;">
                        {{ $role->permissions_count }}
                    </td>
                    <td style="text-align:center;">
                        <span class="badge {{ $role->status ? 'role-badge-active' : 'role-badge-inactive' }}" style="border-radius:20px; font-size:0.75rem; font-weight:600; padding:0.3rem 0.7rem;">
                            {{ $role->status ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td style="color:var(--ink-muted); font-size:0.85rem;">
                        {{ $role->created_at->format('d M Y') }}
                    </td>
                    <td class="td-actions">
                        <div class="d-flex gap-1 justify-content-end flex-wrap">
                            <button class="news-action-btn edit" style="background: #dbeafe; color: #1d4ed8;" onclick="window.location.href='{{ route('admin.roles.permissions', $role) }}'" title="Kelola Permission">
                                <i class="fas fa-lock-open"></i>
                            </button>
                            <a href="{{ route('admin.roles.edit', $role) }}" class="news-action-btn edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            @if ($role->status)
                                <button class="news-action-btn publish" onclick="toggleRoleStatus({{ $role->id }}, '{{ $role->name }}', false)" title="Nonaktifkan">
                                    <i class="fas fa-ban"></i>
                                </button>
                            @else
                                <button class="news-action-btn publish" onclick="toggleRoleStatus({{ $role->id }}, '{{ $role->name }}', true)" title="Aktifkan">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            @endif
                            <button class="news-action-btn delete" title="Hapus"
                                    onclick="openRoleDeleteModal({{ $role->id }}, '{{ addslashes($role->name) }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding:3rem; text-align:center;">
                        <div style="color:#9ca3af;">
                            <i class="fas fa-user-tag" style="font-size:2.5rem; margin-bottom:1rem; display:block;"></i>
                            <strong style="font-size:1rem;">Belum ada role</strong>
                            <p style="font-size:0.85rem; margin-top:0.5rem;">Klik tombol "Tambah Role" untuk membuat role baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination (pola news) --}}
    @if ($roles->hasPages())
    <div class="page-pagination">
        <div class="pagination">
            @if ($roles->onFirstPage())
                <span class="page-btn disabled"><i class="fas fa-chevron-left"></i></span>
            @else
                <a class="page-btn" href="{{ $roles->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach ($roles->getUrlRange(max(1, $roles->currentPage() - 2), min($roles->lastPage(), $roles->currentPage() + 2)) as $page => $url)
                <a class="page-btn {{ $page == $roles->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
            @endforeach

            @if ($roles->hasMorePages())
                <a class="page-btn" href="{{ $roles->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
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
<div class="role-delete-overlay" id="deleteRoleModal">
    <div class="role-delete-dialog">
        <div class="role-delete-icon">
            <i class="fas fa-trash-can"></i>
        </div>
        <h6 class="role-delete-title">Hapus Role?</h6>
        <p class="role-delete-text">Apakah Anda yakin ingin menghapus role ini?</p>
        <div class="role-delete-name" id="deleteRoleName"></div>
        <div class="role-delete-actions">
            <button class="btn-corp btn-corp-soft" onclick="closeRoleDeleteModal()">Batal</button>
            <form id="deleteRoleForm" method="POST" style="display:inline;">
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
    function openRoleDeleteModal(roleId, roleName) {
        const modal = document.getElementById('deleteRoleModal');
        document.getElementById('deleteRoleName').textContent = roleName;
        document.getElementById('deleteRoleForm').action = `/admin/roles/${roleId}`;
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeRoleDeleteModal() {
        document.getElementById('deleteRoleModal').classList.remove('show');
        document.body.style.overflow = '';
    }

    document.getElementById('deleteRoleModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeRoleDeleteModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('deleteRoleModal')?.classList.contains('show')) {
            closeRoleDeleteModal();
        }
    });

    // Toggle status role (fetch + reload, pola lama dipertahankan)
    function toggleRoleStatus(roleId, name, activate) {
        const verb = activate ? 'Aktifkan' : 'Nonaktifkan';
        if (!confirm(`${verb} role "${name}"?`)) return;
        fetch(`/admin/roles/${roleId}/toggle-status`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ status: activate ? 'active' : 'inactive' })
        }).then(r => r.ok ? window.location.reload() : alert('Gagal memperbarui status.'));
    }
</script>
@endpush
