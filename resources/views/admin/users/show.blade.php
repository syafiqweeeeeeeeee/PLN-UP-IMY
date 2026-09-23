@extends('layouts.admin')

@section('title', 'Detail Pengguna — E-PPID PLN')
@section('page-title', 'Detail Pengguna')

@push('styles')
<style>
    .detail-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
    }
    .detail-card-header {
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
        padding: 1.25rem 1.5rem;
    }
    .detail-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.5rem;
    }
    .detail-info-item {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f3f4f6;
    }
    .detail-info-item:last-child {
        border-bottom: none;
    }
    .detail-label {
        font-size: 0.75rem;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }
    .detail-value {
        font-weight: 600;
        color: #1f2937;
        font-size: 0.95rem;
    }
    .detail-value.muted {
        color: #6b7280;
    }
    /* Banner alert flash message */
    .alert-show-success {
        background: #dcfce7; color: #166534; border: 1px solid #bbf7d0;
        border-radius: 10px; padding: 0.75rem 1rem; font-size: 0.85rem;
        font-weight: 600; margin-bottom: 1rem;
        display: flex; align-items: center; gap: 0.5rem;
    }
    html.theme-dark .alert-show-success { background: rgba(22,163,74,0.15); color: #86efac; border-color: rgba(22,163,74,0.35); }
    /* btn-back → global di public/css/admin.css */
    .btn-edit {
        background: var(--pln-yellow);
        color: var(--pln-blue);
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }
    .btn-edit:hover {
        background: #fff;
        box-shadow: 0 4px 12px rgba(255, 230, 0, 0.4);
        transform: translateY(-1px);
    }
    /* Toggle switch status (pengganti Edit) — skema warna sama dengan daftar:
       ON hijau = aktif; OFF oranye soft = nonaktif/belum verifikasi. */
    .btn-toggle-status {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #f59e0b;
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: 0.6rem 1.2rem;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }
    .btn-toggle-status:hover {
        background: #d97706;
    }
    .btn-toggle-status.on {
        background: #16a34a;
    }
    .btn-toggle-status.on:hover {
        background: #15803d;
    }
    .btn-toggle-status:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }
    .btn-delete {
        background: #fee2e2;
        color: #b91c1c;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }
    .btn-delete:hover {
        background: #fecaca;
    }
    .role-badge-lg {
        font-size: 0.8rem;
        padding: 0.35rem 0.85rem;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .role-badge-lg.role-admin { background: #fee2e2; color: #b91c1c; }
    .role-badge-lg.role-user { background: #dbeafe; color: #1d4ed8; }
    .role-badge-lg.role-petugas { background: #fef3c7; color: #92400e; }
    .status-badge-lg {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.35rem 0.85rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .status-badge-lg.active {
        background: #dcfce7;
        color: #166534;
    }
    .status-badge-lg.inactive {
        background: #fef3c7;
        color: #92400e;
    }
    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: currentColor;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }
</style>
@endpush

@section('content')
@if (session('success'))
<div class="alert-show-success">
    <i class="fas fa-circle-check"></i> {{ session('success') }}
</div>
@endif
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="detail-card">
            {{-- Header --}}
            <div class="detail-card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-4">
                    <div class="detail-avatar">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div>
                        <h4 style="font-weight: 700; color: #1f2937; margin: 0;">{{ $user->name }}</h4>
                        <p style="margin: 0.25rem 0 0 0; color: #6b7280; font-size: 0.9rem;">
                            <i class="fas fa-user-circle me-1"></i>{{ $user->email }}
                        </p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    @if (auth()->id() === $user->id)
                        <button type="button" class="btn-toggle-status off" disabled title="Akun Anda sendiri tidak dapat dinonaktifkan">
                            <i class="fas fa-toggle-off me-1"></i> Akun Anda
                        </button>
                    @else
                        <button type="button"
                                class="btn-toggle-status {{ $user->email_verified_at ? 'on' : 'off' }}"
                                title="{{ $user->email_verified_at ? 'Akun aktif — klik untuk menonaktifkan' : 'Akun nonaktif — klik untuk mengaktifkan' }}"
                                onclick="toggleUserStatusFromShow({{ $user->id }}, '{{ addslashes($user->name) }}', {{ $user->email_verified_at ? 'false' : 'true' }})">
                            <i class="fas fa-toggle-{{ $user->email_verified_at ? 'on' : 'off' }} me-1"></i>
                            {{ $user->email_verified_at ? 'Aktif' : 'Nonaktif' }}
                        </button>
                    @endif
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">
                            <i class="fas fa-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>

            {{-- Body --}}
            <div class="p-4">
                <div class="row g-3 mb-4">
                    {{-- Role & Status --}}
                    <div class="col-md-4">
                        <div class="detail-info-item">
                            <div class="detail-label">Role</div>
                            @php
                                $roleModel = $user->getRelationValue('role');
                                $roleName = $roleModel && $roleModel instanceof App\Models\Role ? $roleModel->name : (is_string($user->role) ? $user->role : 'Pengguna');
                                $roleStatus = $roleModel && $roleModel instanceof App\Models\Role ? $roleModel->status : true;
                                $roleIcon = $roleName === 'Administrator' ? 'shield-halved' : ($roleName === 'Karyawan' ? 'briefcase' : 'user');
                                $roleBadgeClass = $roleStatus ? 'role-badge-active' : 'role-badge-inactive';
                                $inactiveLabel = $roleStatus ? '' : ' (Nonaktif)';
                            @endphp
                            <span class="role-badge-lg {{ $roleBadgeClass }}">
                                <i class="fas fa-{{ $roleIcon }}"></i>
                                {{ $roleName }}{{ $inactiveLabel }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-info-item">
                            <div class="detail-label">Status</div>
                            <span class="status-badge-lg {{ $user->email_verified_at ? 'active' : 'inactive' }}">
                                <span class="status-dot"></span>
                                {{ $user->email_verified_at ? 'Aktif' : 'Belum Verifikasi' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-info-item">
                            <div class="detail-label">Terdaftar</div>
                            <div class="detail-value">
                                <i class="far fa-calendar me-1" style="color: var(--pln-blue);"></i>
                                {{ $user->created_at->format('d F Y') }}
                            </div>
                        </div>
                    </div>
                </div>

                <hr style="border: none; border-top: 1px solid #f3f4f6; margin: 1.5rem 0;">

                {{-- Informasi Detail --}}
                <h6 style="font-weight: 600; color: #374151; margin-bottom: 1rem;">Informasi Details</h6>
                
                <div class="info-grid">
                    <div>
                        <div class="detail-label">Nama Lengkap</div>
                        <div class="detail-value">{{ $user->name }}</div>
                    </div>
                    <div>
                        <div class="detail-label">Email</div>
                        <div class="detail-value">{{ $user->email }}</div>
                    </div>
                    <div>
                        <div class="detail-label">No. Telepon</div>
                        <div class="detail-value {{ !$user->no_hp ? 'muted' : '' }}">
                            @if($user->no_hp)
                                <i class="fas fa-phone me-1" style="color: var(--pln-blue);"></i>{{ $user->no_hp }}
                            @else
                                <span class="text-muted">Belum diatur</span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="detail-label">Alamat</div>
                        <div class="detail-value {{ !$user->alamat ? 'muted' : '' }}">
                            @if($user->alamat)
                                {{ $user->alamat }}
                            @else
                                <span class="text-muted">Belum diatur</span>
                            @endif
                        </div>
                    </div>
                </div>

                <hr style="border: none; border-top: 1px solid #f3f4f6; margin: 1.5rem 0;">

                {{-- Metadata --}}
                <h6 style="font-weight: 600; color: #374151; margin-bottom: 1rem;">Metadata</h6>
                <div class="info-grid">
                    <div>
                        <div class="detail-label">ID Pengguna</div>
                        <div class="detail-value muted">{{ $user->id }}</div>
                    </div>
                    <div>
                        <div class="detail-label">Dibuat Pada</div>
                        <div class="detail-value muted">{{ $user->created_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                    <div>
                        <div class="detail-label">Diperbarui Pada</div>
                        <div class="detail-value muted">{{ $user->updated_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                    @if($user->email_verified_at)
                    <div>
                        <div class="detail-label">Verifikasi Email</div>
                        <div class="detail-value" style="color: #10b981;">
                            <i class="fas fa-check-circle me-1"></i>{{ $user->email_verified_at->format('d F Y H:i') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Toggle status dari halaman Detail — pola sama dengan daftar pengguna.
     WAJIB inline di content agar router.js mengeksekusi ulang setelah SPA. --}}
<script>
    function toggleUserStatusFromShow(userId, userName, activate) {
        const verb = activate ? 'Aktifkan' : 'Nonaktifkan';

        // Popup konfirmasi SweetAlert2 — konsisten dengan design system.
        Swal.fire({
            title: activate ? 'Aktifkan Pengguna?' : 'Nonaktifkan Pengguna?',
            html: 'Akun <strong>"' + userName + '"</strong> akan ' +
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

            fetch('/admin/users/' + userId + '/toggle-status', {
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
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: data.message || 'Status pengguna berhasil diperbarui.',
                        showConfirmButton: false,
                        timer: 2500,
                        timerProgressBar: true
                    }).then(function () { window.location.reload(); });
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
    }
</script>
@endsection
