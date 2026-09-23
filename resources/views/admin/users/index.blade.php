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

    /* Tombol modal — selaras persis dengan .news-delete-btn di /admin/news */
    .user-delete-btn {
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }
    .user-delete-btn.cancel {
        background: #f3f4f6;
        color: #6b7280;
    }
    .user-delete-btn.cancel:hover {
        background: #e5e7eb;
        color: #374151;
    }
    .user-delete-btn.confirm {
        background: #DC2626;
        color: #fff;
    }
    .user-delete-btn.confirm:hover {
        background: #B91C1C;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }

    /* ===== Toggle status akun (pengganti tombol Edit) =====
       Kotak rounded PERSIS news-action-btn (30×30, radius 7) agar
       sejajar dengan tombol Lihat & Hapus. Di dalamnya ada mini-switch
       yang fit. Skema warna:
       - AKTIF    → kotak hijau muda soft, switch hijau (knob kanan).
       - NONAKTIF → kotak oranye muda soft, switch oranye (knob kiri). */
    .user-switch {
        width: 30px;
        height: 30px;
        border: none;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        cursor: pointer;
        flex-shrink: 0;
        transition: background 0.2s ease;
    }
    /* Mini-switch di dalam kotak */
    .user-switch .track {
        position: relative;
        width: 20px;
        height: 12px;
        border-radius: 999px;
        transition: background 0.25s ease;
    }
    .user-switch .knob {
        position: absolute;
        top: 2px;
        left: 2px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
        transition: transform 0.25s ease;
    }
    /* AKTIF: kotak hijau muda + switch hijau, knob di kanan */
    .user-switch.on { background: #dcfce7; }
    .user-switch.on:hover { background: #bbf7d0; }
    .user-switch.on .track { background: #16a34a; }
    .user-switch.on:hover .track { background: #15803d; }
    .user-switch.on .knob { transform: translateX(8px); }
    /* NONAKTIF: kotak oranye muda + switch oranye, knob di kiri */
    .user-switch.off { background: #fef3c7; }
    .user-switch.off:hover { background: #fde68a; }
    .user-switch.off .track { background: #f59e0b; }
    .user-switch.off:hover .track { background: #d97706; }
    .user-switch:disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }

    /* ===== Kepadatan kolom aksi & baris tabel ===== */
    /* Gap rapat antar 3 tombol aksi (Lihat, Switch, Hapus) */
    .user-action-group {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 4px;
    }
    /* Baris lebih ramping: padding sel diperketat */
    .dash-card .admin-table tbody td {
        padding-top: 0.45rem;
        padding-bottom: 0.45rem;
    }
    /* Avatar ikut dipadatkan agar tinggi baris konsisten ramping */
    .avatar-placeholder {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
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
            <h5><i class="fas fa-users header-icon"></i>Daftar Pengguna</h5>
            <p>Kelola semua akun pengguna di sistem</p>
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
                    <th class="col-hide-mobile">Terdaftar</th>
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
                    <td class="col-hide-mobile">
                        <span style="font-size: 0.85rem; color: var(--ink-muted);">
                            <i class="far fa-calendar me-1"></i>
                            {{ $user->created_at->format('d M Y') }}
                        </span>
                    </td>
                    @php
                        $isVerified = (bool) $user->email_verified_at;
                        $isSelf = auth()->id() === $user->id;
                    @endphp
                    <td class="td-actions">
                        <div class="user-action-group">
                            <a href="{{ route('admin.users.show', $user) }}" class="news-action-btn edit" style="background: #dbeafe; color: #1d4ed8;" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if (! $isSelf)
                                {{-- Toggle status akun (pengganti Edit): kotak 30×30
                                     berisi mini-switch — hijau = aktif, oranye = nonaktif. --}}
                                <button type="button"
                                        class="user-switch {{ $isVerified ? 'on' : 'off' }}"
                                        role="switch" aria-checked="{{ $isVerified ? 'true' : 'false' }}"
                                        title="{{ $isVerified ? 'Akun aktif — klik untuk menonaktifkan' : 'Akun nonaktif — klik untuk mengaktifkan' }}"
                                        onclick="toggleUserStatus({{ $user->id }}, '{{ addslashes($user->name) }}', {{ $isVerified ? 'false' : 'true' }})">
                                    <span class="track"><span class="knob"></span></span>
                                </button>
                            @else
                                <button type="button" class="user-switch off" disabled
                                        role="switch" aria-checked="false"
                                        title="Akun Anda sendiri tidak dapat dinonaktifkan">
                                    <span class="track"><span class="knob"></span></span>
                                </button>
                            @endif
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
            <button class="user-delete-btn cancel" onclick="closeUserDeleteModal()">Batal</button>
            <form id="deleteUserForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="user-delete-btn confirm">
                    <i class="fas fa-trash me-1"></i> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

{{-- ============================================================
     Script INLINE modal hapus — WAJIB di dalam content (bukan
     @push('scripts')) karena client-side router (router.js) hanya
     mengeksekusi ulang <script> di dalam <main>; kalau di push
     stack, popup hapus tidak muncul setelah navigasi via sidebar.
     ============================================================ --}}
<script>
    // Guard re-eksekusi: hindari listener ganda saat router.js
    // menjalankan ulang script ini setelah swap konten.
    if (!window.__userDeleteModalBound) {
        window.__userDeleteModalBound = true;

        window.openUserDeleteModal = function(userId, userName) {
            const modal = document.getElementById('deleteUserModal');
            document.getElementById('deleteUserName').textContent = userName;
            document.getElementById('deleteUserForm').action = `/admin/users/${userId}`;
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        };

        window.closeUserDeleteModal = function() {
            document.getElementById('deleteUserModal').classList.remove('show');
            document.body.style.overflow = '';
        };

        document.getElementById('deleteUserModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeUserDeleteModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('deleteUserModal')?.classList.contains('show')) {
                closeUserDeleteModal();
            }
        });
    }
</script>
{{-- Script INLINE search tabel — WAJIB di dalam content (bukan
     @push('scripts')) karena router.js hanya mengeksekusi ulang
     <script> di dalam <main> setelah navigasi SPA. --}}
<script>
    (function() {
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll('tbody tr[data-search]');

        function applyFilters() {
            const search = (searchInput?.value ?? '').toLowerCase();

            rows.forEach(function(row) {
                const text = row.dataset.search || '';
                const show = !search || text.includes(search);
                row.style.display = show ? '' : 'none';
            });
        }

        searchInput?.addEventListener('input', applyFilters);
    })();
</script>
{{-- ============================================================
     Script toggle status akun — WAJIB di dalam content (bukan
     @push('scripts')) agar router.js mengeksekusi ulang setelah
     navigasi SPA. Sukses → Toast Notification (SweetAlert2).
     ============================================================ --}}
<script>
    // Guard re-eksekusi: hindari listener ganda saat router.js
    // menjalankan ulang script ini setelah swap konten.
    if (!window.__userToggleBound) {
        window.__userToggleBound = true;

        window.toggleUserStatus = function(userId, userName, activate) {
            const verb = activate ? 'Aktifkan' : 'Nonaktifkan';

            // Popup konfirmasi SweetAlert2 — konsisten dengan design system
            // (menggantikan confirm() bawaan browser).
            Swal.fire({
                title: activate ? 'Aktifkan Pengguna?' : 'Nonaktifkan Pengguna?',
                html: `Akun <strong>"${userName}"</strong> akan ` +
                    (activate
                        ? 'ditandai <strong style="color:#16a34a">Aktif</strong>.'
                        : 'ditandai <strong style="color:#d97706">Nonaktif</strong>.'),
                icon: activate ? 'question' : 'warning',
                showCancelButton: true,
                confirmButtonText: activate ? 'Ya, Aktifkan' : 'Ya, Nonaktifkan',
                cancelButtonText: 'Batal',
                confirmButtonColor: activate ? '#16a34a' : '#d97706',
                cancelButtonColor: '#6b7280',
                focusCancel: true
            }).then(function (result) {
                if (!result.isConfirmed) return;

                fetch(`/admin/users/${userId}/toggle-status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ status: activate ? 'active' : 'inactive' })
                })
                .then(function (res) {
                    return res.json().catch(function () {
                        throw new Error('Terjadi kesalahan server (HTTP ' + res.status + ').');
                    });
                })
                .then(function (data) {
                    if (data.success) {
                        // Toast Notification sukses (tidak perlu klik).
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: data.message || 'Status pengguna berhasil diperbarui.',
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true
                        });
                        // Segarkan daftar agar badge status ikut berubah.
                        setTimeout(function () { window.location.reload(); }, 700);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal memperbarui status',
                            text: data.message || 'Silakan coba lagi.',
                            confirmButtonText: 'Mengerti',
                            confirmButtonColor: '#dc2626'
                        });
                    }
                })
                .catch(function (err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal memperbarui status',
                        text: (err && err.message) ? err.message : 'Terjadi kesalahan jaringan.',
                        confirmButtonText: 'Mengerti',
                        confirmButtonColor: '#dc2626'
                    });
                });
            });
        };
    }
</script>
@endsection
