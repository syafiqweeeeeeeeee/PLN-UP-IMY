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

    /* Tombol modal — selaras persis dengan .news-delete-btn di /admin/news */
    .role-delete-btn {
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }
    .role-delete-btn.cancel {
        background: #f3f4f6;
        color: #6b7280;
    }
    .role-delete-btn.cancel:hover {
        background: #e5e7eb;
        color: #374151;
    }
    .role-delete-btn.confirm {
        background: #DC2626;
        color: #fff;
    }
    .role-delete-btn.confirm:hover {
        background: #B91C1C;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }
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
                    <th class="col-hide-mobile">Deskripsi</th>
                    <th style="text-align: center;">User</th>
                    <th style="text-align: center;">Permission</th>
                    <th style="text-align: center;">Status</th>
                    <th class="col-hide-mobile">Dibuat</th>
                    <th class="th-actions">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                <tr>
                    <td>
                        <div style="font-weight:600; color:var(--ink-heading);">{{ $role->name }}</div>
                    </td>
                    <td class="col-hide-mobile" style="color:var(--ink-muted); font-size:0.85rem;">
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
                    <td class="col-hide-mobile" style="color:var(--ink-muted); font-size:0.85rem;">
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
            <button class="role-delete-btn cancel" onclick="closeRoleDeleteModal()">Batal</button>
            <form id="deleteRoleForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="role-delete-btn confirm">
                    <i class="fas fa-trash me-1"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

{{-- ============================================================
     Script INLINE di dalam content section — WAJIB di sini (bukan
     @push('scripts')) karena client-side router (router.js) hanya
     menukar isi <main> dan mengeksekusi ulang <script> di dalamnya.
     Jika ditaruh di @push('scripts'), popup hapus tidak muncul
     saat berpindah halaman via sidebar tanpa reload.
     ============================================================ --}}
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
@endsection
