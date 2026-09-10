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
    .table-role tbody tr {
        transition: background 0.15s ease;
    }
    .table-role tbody tr:hover {
        background: #f8fafc;
    }
    .btn-role-primary {
        background: var(--pln-yellow);
        color: var(--pln-blue);
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
        font-weight: 600;
    }
    .btn-role-primary:hover {
        background: #fff;
    }
    .btn-role-outline {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 500;
        font-size: 0.85rem;
    }
    .btn-role-outline:hover {
        background: #e5e7eb;
    }
    .btn-role-danger {
        background: #fee2e2;
        color: #b91c1c;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 500;
        font-size: 0.85rem;
    }
    .btn-role-danger:hover {
        background: #fecaca;
    }
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
    .action-btn.view { background: #dbeafe; color: #1d4ed8; }
    .action-btn.edit { background: #fef3c7; color: #92400e; }
    .action-btn.permissions { background: #f3e8ff; color: #7c3aed; }
    .action-btn.activate { background: #dcfce7; color: #166534; }
    .action-btn.delete { background: #fee2e2; color: #b91c1c; }
    .action-btn:hover { transform: translateY(-1px); }
</style>
@endpush

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="dash-card">
            <div class="dash-card-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div>
                        <h5 class="dash-card-title">Daftar Role</h5>
                        <p class="dash-card-subtitle">Kelola hak akses role pengguna di sistem</p>
                    </div>
                    <a href="{{ route('admin.roles.create') }}" class="btn-role-primary" style="display:inline-flex; align-items:center; gap:0.4rem;">
                        <i class="fas fa-plus"></i> Tambah Role
                    </a>
                </div>
            </div>

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
                    @foreach ($roles->links() as $link)
                        @if (str_contains($link, 'page='))
                            <li class="page-item">
                                <a class="page-link" style="background:#f3f4f6; border:none; color:var(--pln-blue);" href="{{ $link }}">
                                    {!! str_replace(['<span class="page-link">', '</span>'], '', $link) !!}
                                </a>
                            </li>
                        @endif
                    @endforeach
                    @if ($roles->hasMorePages())
                        <li class="page-item"><a class="page-link" style="background:#f3f4f6; border:none; color:var(--pln-blue);" href="{{ $roles->nextPageUrl() }}">&raquo;</a></li>
                    @else
                        <li class="page-item disabled"><a class="page-link" style="background:#f3f4f6; border:none; color:#9ca3af;" href="#">&raquo;</a></li>
                    @endif
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:12px; border:none; overflow:hidden;">
            <div class="modal-header" style="background:#fee2e2; border-bottom:none; padding:1.25rem;">
                <i class="fas fa-triangle-exclamation" style="color:#dc2626; font-size:1.25rem;"></i>
                <h6 class="modal-title" style="color:#b91c1c; font-weight:700; margin-left:0.5rem;">Hapus Role?</h6>
                <button type="button" class="btn-close" style="filter:invert(1); opacity:0.7;" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding:1rem 1.25rem;">
                <p style="margin:0; font-size:0.9rem;">
                    Apakah Anda yakin ingin menghapus role <strong id="deleteRoleName"></strong>?
                </p>
                <p style="margin:0.75rem 0 0 0; font-size:0.8rem; color:#ef4444;">
                    <i class="fas fa-exclamation-circle me-1"></i> Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer" style="border-top:none; padding:0.75rem 1.25rem; gap:0.5rem;">
                <button type="button" class="btn" style="background:#f3f4f6; color:#6b7280; border:none; border-radius:8px; font-weight:500;" data-bs-dismiss="modal">Batal</button>
                <form id="deleteRoleForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="background:#dc2626; color:#fff; font-weight:600; padding:0.5rem 1.5rem; border-radius:8px;">
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
    const deleteRoleModal = document.getElementById('deleteRoleModal');
    deleteRoleModal?.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const roleId = button.getAttribute('data-id');
        const roleName = button.getAttribute('data-name');
        document.getElementById('deleteRoleName').textContent = roleName;
        document.getElementById('deleteRoleForm').action = `/admin/roles/${roleId}`;
    });

    function deactivateRole(roleId, name) {
        if (!confirm(`Nonaktifkan role "${name}"?`)) return;
        fetch(`/admin/roles/${roleId}/toggle-status`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ status: 'inactive' })
        }).then(r => r.ok ? window.location.reload() : alert('Gagal memperbarui status.'));
    }

    function activateRole(roleId, name) {
        if (!confirm(`Aktifkan role "${name}"?`)) return;
        fetch(`/admin/roles/${roleId}/toggle-status`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ status: 'active' })
        }).then(r => r.ok ? window.location.reload() : alert('Gagal memperbarui status.'));
    }
</script>
@endpush
