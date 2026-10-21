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
    /* ===== Action Buttons Layout =====
       Flexible action button group di header card.
       Gunakan flexbox dengan gap konsisten untuk tampilan rapi. ===== */
    .news-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.82rem;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        flex: 0 0 auto;
        white-space: nowrap;
    }
    .news-action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }
    .news-action-btn:focus-visible {
        outline: 2px solid var(--pln-blue);
        outline-offset: 2px;
    }
    .news-action-btn.edit {
        background: #dbeafe; color: #1d4ed8;
    }
    .news-action-btn.edit:hover {
        background: #bfdbfe; color: #1e40af;
    }
    .news-action-btn.delete {
        background: #fecaca; color: #b91c1c;
    }
    .news-action-btn.delete:hover {
        background: #f6e05e; color: #991b1b;
    }
    .news-action-btn.cancel {
        background: #e5e7eb; color: #374151;
    }
    .news-action-btn.cancel:hover {
        background: #d1d5db; color: #1f2937;
    }
    .news-action-btn.confirm {
        background: #d97706; color: #fff;
    }
    .news-action-btn.confirm:hover {
        background: #b91c1c; color: #fff;
    }
    /* Tombol switch status tetap pakai kelas user-switch */
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
    .user-switch.off:hover { background: #d97706; }
    .user-switch:disabled {
        opacity: 0.45;
        cursor: not-allowed;
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
    /* Pastikan gap antar tombol di header card ada dan konsisten */
    .detail-card-header .d-flex.gap-2,
    .news-action-btn-group .news-action-btn {
        gap: 3rem !important;
    }
    /* Force nowrap on all action buttons inside this header - FIX FLEXBOX */
    .detail-card-header .news-action-btn {
        white-space: nowrap !important;
        flex: 0 0 auto !important;
        min-width: 0 !important;
    }
    /* Reduced gap for smaller screens */
    @media (max-width: 768px) {
        .detail-card-header .d-flex.gap-2,
        .news-action-btn-group .news-action-btn {
            gap: 1rem !important;
        }
    }
    .avatar-circle {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1d4ed8, #3b82f6);
        color: #ffffff;
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 6px rgba(29, 78, 216, 0.25);
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
    /* =========================================================
       DATA KEPEGAWAIAN (employee_profiles)
       ---------------------------------------------------------
       Kartu terpisah di bawah kartu akun; struktur grid & label
       mengikuti pola halaman Data Karyawan (4 grup spesifikasi).
       ========================================================= */
    .ep-section-head {
        display: flex; align-items: center; gap: 0.5rem;
        margin: 1.4rem 0 0.65rem; padding: 0.5rem 0.8rem;
        background: #f8fafc; border: 1px solid #e5e7eb;
        border-radius: 10px;
    }
    .ep-section-head:first-of-type { margin-top: 0.25rem; }
    .ep-section-icon {
        display: inline-flex; align-items: center; justify-content: center;
        width: 26px; height: 26px; border-radius: 7px;
        background: var(--pln-blue); color: #fff; font-size: 0.7rem;
    }
    .ep-section-title {
        font-weight: 700; font-size: 0.8rem; color: #374151;
        text-transform: uppercase; letter-spacing: 0.5px;
    }
    .ep-detail-grid {
        display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 0.1rem 1.5rem;
    }
    .ep-detail-item {
        padding: 0.5rem 0; border-bottom: 1px dashed #e5e7eb;
    }
    .ep-detail-item dt {
        font-size: 0.7rem; font-weight: 700; color: #9ca3af;
        text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.15rem;
    }
    .ep-detail-item dd {
        margin: 0; font-size: 0.86rem; font-weight: 600; color: #1f2937;
        word-break: break-word;
    }
    .ep-detail-item dd.ep-empty { color: #cbd5e1; font-weight: 400; }
    /* Input field — rounded 10px, border tipis konsisten. */
    .ep-form-fieldset .form-control,
    .ep-form-fieldset .form-select {
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        box-shadow: none;
    }
    .ep-form-fieldset .form-control:focus,
    .ep-form-fieldset .form-select:focus {
        border-color: var(--pln-blue, #0b5ea9);
        box-shadow: 0 0 0 0.15rem rgba(11, 94, 169, 0.15);
    }
    .ep-link-badge {
        display: inline-flex; align-items: center; gap: 0.35rem;
        font-size: 0.75rem; font-weight: 600; color: #1d4ed8;
        background: #dbeafe; border-radius: 20px; padding: 0.2rem 0.7rem;
    }
    .ep-modal-alert {
        background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca;
        border-radius: 10px; padding: 0.75rem 1rem; font-size: 0.82rem;
        font-weight: 600; margin-bottom: 1rem;
    }
    .ep-modal-alert ul { margin: 0.35rem 0 0; padding-left: 1.1rem; }
    .ep-form-label {
        font-size: 0.72rem; font-weight: 700; color: #6b7280;
        text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.25rem;
    }
    .ep-form-fieldset { border: 1px solid #e5e7eb; border-radius: 12px; padding: 1rem; }
    .ep-form-fieldset legend {
        font-size: 0.75rem; font-weight: 700; color: #374151;
        text-transform: uppercase; letter-spacing: 0.6px; width: auto;
        padding: 0 0.55rem; margin-bottom: 0;
        border-left: 3px solid var(--pln-blue);
        border-radius: 2px;
    }

    /* =========================================================
       MODAL KEPEGAWAIAN — struktur flex tiga bagian:
       header tetap di atas, HANYA body yang men-scroll,
       footer tetap utuh di bawah (tidak terpotong).
       ========================================================= */
    .ep-modal-dialog {
        max-width: 860px;
        max-height: 90vh;
    }
    /* =========================================================
       ANIMASI BUKA-TUTUP — fade + scale-up lembut (0.25s ease-out).
       Dibatasi modal ini (#editDetailModal) agar tidak memengaruhi
       modal lain di panel admin.
       ========================================================= */
    #editDetailModal.modal.fade .modal-dialog {
        transform: scale(0.95) translateY(8px);
        opacity: 0;
        transition: transform 0.25s ease-out, opacity 0.25s ease-out;
    }
    #editDetailModal.modal.show .modal-dialog {
        transform: scale(1) translateY(0);
        opacity: 1;
        transition: transform 0.25s ease-out, opacity 0.25s ease-out;
    }
    /* Hormati preferensi pengguna yang menonaktifkan animasi. */
    @media (prefers-reduced-motion: reduce) {
        #editDetailModal .modal-dialog {
            transition: none;
        }
    }
    .ep-modal-dialog .modal-content {
        max-height: 85vh;
        display: flex;
        flex-direction: column;
        border-radius: 16px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        overflow: hidden; /* cegah konten keluar dari sudut rounded */
    }
    .ep-modal-dialog .modal-header {
        flex-shrink: 0; /* header selalu menempel di atas */
    }
    .ep-modal-body {
        flex: 1 1 auto;
        overflow-y: auto; /* scrollbar hanya berada di dalam body */
        padding: 24px;
        --ep-pad-x: 1.5rem;
    }
    .ep-modal-body .ep-form-fieldset {
        padding: 1.1rem 1.25rem;
    }
    /* Jarak "bernapas" antar section + garis pembatas tipis di
       atas header section berikutnya (kemasan fieldset sudah cukup
       menopang pembatasan visual; hr berfungsi sebagai pemisah). */
    .ep-modal-body .ep-form-fieldset + .ep-form-fieldset {
        margin-top: 1.25rem /* jarak antar section */;
    }
    .ep-modal-footer {
        flex-shrink: 0; /* footer tidak ikut menyusut — tetap di bawah */
        background-color: #ffffff;
        border-top: 1px solid #e9ecef;
        padding: 16px 24px;
        z-index: 10;
        box-shadow: 0 -6px 14px rgba(15, 23, 42, 0.06);
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.6rem;
        margin: 0;
    }
    .ep-modal-footer .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.84rem;
        padding: 0.55rem 1.25rem;
        transition: background 0.15s ease, transform 0.1s ease;
    }
    .ep-btn-cancel {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
    }
    .ep-btn-cancel:hover {
        background: #e2e8f0;
        color: #334155;
    }
    .ep-btn-save {
        background: var(--pln-blue, #0b5ea9);
        color: #fff;
        border: none;
    }
    .ep-btn-save:hover {
        filter: brightness(1.1);
    }
    .ep-btn-save:active {
        transform: translateY(1px);
    }
    .ep-modal-footer .btn:focus,
    .ep-btn-save:focus {
        box-shadow: 0 0 0 0.2rem rgba(11, 94, 169, 0.25);
        outline: none;
    }

    html.theme-dark .ep-section-head { background: var(--panel-2, #1f2937); border-color: var(--line, #374151); }
    html.theme-dark .ep-section-title { color: var(--ink-heading, #f9fafb); }
    html.theme-dark .ep-detail-item { border-bottom-color: var(--line, #374151); }
    html.theme-dark .ep-detail-item dt { color: var(--ink-faint, #9ca3af); }
    html.theme-dark .ep-detail-item dd { color: var(--ink-heading, #f9fafb); }
    html.theme-dark .ep-form-fieldset { border-color: var(--line, #374151); }
    html.theme-dark .ep-form-label { color: var(--ink-muted, #9ca3af); }
    html.theme-dark .ep-modal-footer { background: var(--bg-card, #1e293b); border-top-color: var(--line, #374151); }
    html.theme-dark .ep-btn-cancel { background: var(--panel-2, #25303e); color: var(--ink-muted, #cbd5e1); border-color: var(--line, #374151); }
    html.theme-dark .ep-btn-cancel:hover { background: var(--panel, #31404f); color: var(--ink-heading, #f8fafc); }
    html.theme-dark .ep-modal-dialog .modal-content { background: var(--bg-card, #1e293b); }
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
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm rounded-pill px-3 shadow-sm">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
        <div class="detail-card">
            {{-- Header --}}<div class="card-body p-4">
       <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <!-- SISI KIRI: INFORMASI PROFIL -->
            <div class="d-flex align-items-center gap-3 flex-shrink-0">
                <div class="avatar-circle">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="mb-0 fw-bold lh-base text-dark">{{ $user->name }}</h4>
                    <p class="text-muted mb-0 d-flex align-items-center gap-2" style="font-size: 0.875rem;">
                        <i class="fas fa-user" style="font-size: 0.75rem;"></i>
                        <span>{{ $user->email }}</span>
                    </p>
                </div>
            </div>
            <!-- SISI KANAN: GROUP TOMBOL AKSI EMONLY (TANPA TEKS) -->
            <div class="d-flex align-items-center gap-2">
                {{-- Edit Akun --}}
                @if(auth()->id() === $user->id || auth()->user()?->can('users.edit'))
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-light border" style="cursor: pointer;" title="Edit Akun" onclick="event.stopPropagation();">
                        <i class="fas fa-pen text-primary"></i>
                    </a>
                @endif
                {{-- Aktifkan / Nonaktifkan Akun --}}
                @if(auth()->user()?->can('users.edit') && auth()->id() !== $user->id)
                    <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="d-inline mb-0" onclick="event.stopPropagation();">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-light border" style="cursor: pointer;" title="{{ $user->email_verified_at ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}">
                            <i class="fas {{ $user->email_verified_at ? 'fa-toggle-on text-success' : 'fa-toggle-off text-secondary' }}"></i>
                        </button>
                    </form>
                @endif
                {{-- Reset Password — tombol kunci MEMBUKA MODAL KONFIRMASI
                     pertama (#resetPasswordModal) via data-bs-toggle/
                     data-bs-target; di dalam modal itu tombol "Ya, Reset
                     Password" disubmit sebagai form POST + @csrf +
                     @method('PATCH') — tanpa AJAX. --}}
                @if(auth()->user()?->can('user.reset-password'))
                    @unless (auth()->id() === $user->id)
                    <button type="button" class="btn btn-sm btn-light border" style="cursor: pointer;" title="Reset Password"
                            data-bs-toggle="modal" data-bs-target="#resetPasswordModal" onclick="event.stopPropagation();">
                        <i class="fas fa-key text-warning"></i>
                    </button>
                    @endunless
                @endif
                {{-- Hapus --}}
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-light border" title="Hapus Pengguna">
                            <i class="fas fa-trash text-danger"></i>
                        </button>
                    </form>
            </div>
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
                                $roleIcon = in_array($roleName, ['Super Admin', 'Administrator'], true) ? 'shield-halved' : ($roleName === 'Karyawan' ? 'briefcase' : 'user');
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

{{-- ============================================================
     DATA KEPEGAWAIAN (tabel relasi employee_profiles)
     ------------------------------------------------------------
     Kartu terpisah di bawah kartu akun — memuat seluruh data
     kepegawaian 24 kolom spesifikasi (sama dengan master Data
     Karyawan hasil impor Excel), dikelompokkan 4 bagian. Tombol
     "Edit Detail / Lengkapi Data" membuka modal form upsert ke
     endpoint PUT admin.users.kepegawaian.update.
     ============================================================ --}}
@php
    $ep = $user->employeeProfile;

    // Nilai prefill form modal — identik dengan nilai tampil kartu.
    // Prefill SEMUA field selalu memiliki key — nilai profil nullable
    // menjadi null (string) sehingga akses array di bawah tidak pernah
    // melempar "Undefined array key" saat profil belum pernah diisi.
    $epPrefill = array_fill_keys([
        'nid','nama','unit','bidang','jabatan','jenjang_jabatan','grade',
        'organik','institusi','mims','telp','hp','email','tempat_lahir',
        'agama','gender','status_kawin',
    ], null);
    foreach (array_keys($epPrefill) as $epField) {
        $epPrefill[$epField] = $ep?->$epField ?? null;
    }
    $epPrefill['fte'] = ($ep !== null && $ep->fte !== null) ? number_format($ep->fte, 2, '.', '') : null;
    foreach (['service_date','hire_date','retire_date','grade_date','tgl_jab','tanggal_lahir'] as $epField) {
        $epPrefill[$epField] = $ep?->$epField?->format('Y-m-d');
    }
    // FALLBACK CERDAS DARI DATA AKUN — saat profil kepegawaian belum
    // diisi, modal tetap terisi otomatis dari data akun (users):
    // NAMA <- users.name, HP <- users.no_hp, EMAIL <- users.email.
    // Data akun TIDAK pernah diubah oleh form ini ( hanya tabel
    // employee_profiles yang disimpan).
    $epPrefill['nama'] = $epPrefill['nama'] ?: $user->name;
    $epPrefill['hp'] = $epPrefill['hp'] ?: $user->no_hp;
    $epPrefill['email'] = $epPrefill['email'] ?: $user->email;

    // FALLBACK DATA PENDAFTARAN (tabel users) untuk UNIT/BIDANG/JABATAN
    // —-dropdown tidak lagi "— Pilih —" kosong bila akun sudah terikat
    // unit kerja saat pendaftaran. Kolom users menyimpan KODE ('operasi',
    // 'spv_chcb_b', 'manager_bidang') yang diterjemahkan ke LABEL master
    // agar cocok dengan nilai option dropdown yang ditampilan; nilai
    // legacy/raw tetap aman (injeksi option menyelamatkan nilai tak
    // dikenal). Urutan tetap: old() → profil → akun.
    $epPrefill['bidang'] = $epPrefill['bidang']
        ?: ((\App\Models\User::DEPARTMENTS[$user->department] ?? null) ?: $user->department);
    $epPrefill['unit'] = $epPrefill['unit']
        ?: ((\App\Models\User::subDepartmentLabel($user->department, $user->sub_department) ?? null) ?: $user->sub_department);
    $epPrefill['jabatan'] = $epPrefill['jabatan']
        ?: \App\Models\User::levelJabatanLabel($user->level_jabatan);

    // =========================================================
    // MASTER REFERENSI dropdown — Unit/Bidang/Jabatan/Agama diambil
    // dari master data struktur organisasi aplikasi (User::SUB_
    // DEPARTMENTS, User::DEPARTMENTS, User::LEVEL_JABATAN + legacy)
    // dan daftar agama standar. old() TETAP jadi sumber terpilih
    // (validasi gagal), lalu prefill profil, lalu fallback akun.
    // =========================================================
    $epSelectedUnit = old('unit', $epPrefill['unit']);
    $epSelectedBidang = old('bidang', $epPrefill['bidang']);
    $epSelectedJabatan = old('jabatan', $epPrefill['jabatan']);
    $epSelectedAgama = old('agama', $epPrefill['agama']);

    // Nilai tersimpan yang TIDAK persis sama dengan label master
    // (data historis Excel, dll.) SELALU di-inject sebagai option
    // tambahan agar dropdown tidak kehilangan nilai tersimpan.
    $epInjectOption = function (array $masters, ?string $current): array {
        if ($current === null || trim($current) === '') {
            return $masters;
        }
        foreach ($masters as $master) {
            if (strcasecmp($master, $current) === 0) {
                return $masters; // sudah terwakili label master
            }
        }

        return array_merge($masters, [$current]);
    };

    $epOptionsUnit = $epInjectOption(
        collect(\App\Models\User::SUB_DEPARTMENTS)
            ->flatMap(fn ($subs) => array_values($subs))
            ->unique()
            ->values()
            ->all(),
        $epSelectedUnit
    );

    $epOptionsBidang = $epInjectOption(
        array_values(\App\Models\User::DEPARTMENTS),
        $epSelectedBidang
    );

    $epOptionsJabatan = $epInjectOption(
        array_values(array_merge(
            \App\Models\User::LEVEL_JABATAN,
            \App\Models\User::LEGACY_LEVEL_JABATAN
        )),
        $epSelectedJabatan
    );

    $epOptionsAgama = $epInjectOption(
        \App\Models\EmployeeProfile::AGAMAS,
        $epSelectedAgama
    );
@endphp
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="detail-card">
            <div class="detail-card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 style="font-weight: 700; color: #1f2937; margin: 0;">
                        <i class="fas fa-id-badge me-2" style="color: var(--pln-blue);"></i>Data Kepegawaian
                    </h5>
                    <p style="margin: 0.25rem 0 0 0; color: #6b7280; font-size: 0.85rem;">
                        @if($ep && $ep->nid)
                            NID {{ $ep->nid }}
                            @if($ep->jabatan) · {{ $ep->jabatan }} @endif
                            @if($ep->bidang) · {{ $ep->bidang }} @endif
                        @else
                            Profil kepegawaian akun ini (24 kolom master HR)
                        @endif
                        @if($ep && $ep->karyawan_id)
                            <span class="ep-link-badge ms-1">
                                <i class="fas fa-link"></i> Tertaut master Data Karyawan
                            </span>
                        @endif
                    </p>
                </div>
                @can('users.edit:self', $user)
                    <button type="button" class="btn btn-sm btn-primary shadow-sm px-3 py-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#editDetailModal">
                        <i class="fas fa-user-pen me-1"></i>{{ $ep ? 'Edit Detail' : 'Lengkapi Data' }}
                    </button>
                @endcan
            </div>
            <div class="p-4">
                @if ($ep)
                    @php
                        // 4 grup spesifikasi: Organisasi & Jabatan /
                        // Tanggal Penting / Kontak & Komunikasi / Data Pribadi.
                        $epGroups = [
                            ['Organisasi & Jabatan', 'fa-sitemap', [
                                'UNIT' => $ep->unit,
                                'BIDANG' => $ep->bidang,
                                'JABATAN' => $ep->jabatan,
                                'JENJAB' => $ep->jenjang_jabatan,
                                'GRADE' => $ep->grade,
                                'ORGANIK' => $ep->organik,
                                'INSTITUSI' => $ep->institusi,
                                'FTE' => $ep->fte !== null ? number_format($ep->fte, 2) : null,
                                'MIMS' => $ep->mims,
                            ]],
                            ['Tanggal Penting', 'fa-calendar-days', [
                                'SERVICE DATE' => $ep->formatTanggal('service_date'),
                                'HIRE DATE' => $ep->formatTanggal('hire_date'),
                                'RETIRE DATE' => $ep->formatTanggal('retire_date'),
                                'GRADE DATE' => $ep->formatTanggal('grade_date'),
                                'TGL JAB' => $ep->formatTanggal('tgl_jab'),
                                'TGL LAHIR' => $ep->formatTanggal('tanggal_lahir'),
                            ]],
                            ['Kontak & Komunikasi', 'fa-address-book', [
                                'TELP' => $ep->telp,
                                'HP' => $ep->hp,
                                'EMAIL' => $ep->email,
                            ]],
                            ['Data Pribadi', 'fa-user', [
                                'TEMPAT LAHIR' => $ep->tempat_lahir,
                                'AGAMA' => $ep->agama,
                                'GENDER' => $ep->genderLabel(),
                                'STATUS KAWIN' => $ep->statusKawinLabel(),
                            ]],
                        ];
                    @endphp
                    @foreach ($epGroups as [$epTitle, $epIcon, $epItems])
                        <div class="ep-section-head">
                            <span class="ep-section-icon"><i class="fas {{ $epIcon }}"></i></span>
                            <span class="ep-section-title">{{ $epTitle }}</span>
                        </div>
                        <dl class="ep-detail-grid" style="margin-bottom:0;">
                            @foreach ($epItems as $epLabel => $epValue)
                                <div class="ep-detail-item">
                                    <dt>{{ $epLabel }}</dt>
                                    <dd class="{{ $epValue === null || $epValue === '' ? 'ep-empty' : '' }}">{{ $epValue ?: '—' }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    @endforeach
                @elseif (auth()->user()?->can('users.edit:self', $user))
                    <div class="alert alert-light border d-inline-flex align-items-center gap-2 mb-0" style="font-size: 0.85rem; color: #6b7280;">
                        <i class="fas fa-circle-info" style="color: var(--pln-blue);"></i>
                        Data kepegawaian belum diisi. Klik tombol <strong>“Lengkapi Data”</strong> — isi manual atau muat otomatis dari master Data Karyawan melalui NID.
                    </div>
                @else
                    <p class="mb-0" style="font-size: 0.85rem; color: #6b7280;"><i class="fas fa-circle-info me-1"></i>Data kepegawaian belum diisi.</p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ============================================================
     MODAL EDIT DETAIL KEPEGAWAIAN — form upsert seluruh field
     ke tabel employee_profiles. Submit form biasa (PUT) — Error
     validasi ditampilkan ulang di modal (dibuka otomatis) dan
     sukses kembali ke halaman ini dengan flash message.
     ============================================================ --}}
@can('users.edit:self', $user)
<div class="modal fade" id="editDetailModal" tabindex="-1" aria-labelledby="editDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered ep-modal-dialog">
        <div class="modal-content">
            {{-- Tiga bagian utama langsung di dalam modal-content:
                 header (tetap), body (satu-satunya yang scroll),
                 footer (tetap di bawah, tidak terpotong). --}}
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="editDetailModalLabel" style="font-weight: 700; color: #1f2937;">
                        <i class="fas fa-user-pen me-2" style="color: var(--pln-blue);"></i>{{ $ep ? 'Edit Detail Kepegawaian' : 'Lengkapi Data Kepegawaian' }}
                    </h5>
                    <small style="color: #6b7280;">{{ $user->name }} ({{ $user->email }})</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body ep-modal-body">
                <form action="{{ route('admin.users.kepegawaian.update', $user) }}" method="POST" id="epForm">
                    @csrf
                    @method('PUT')
                    @if (isset($errors) && $errors->any())
                        <div class="ep-modal-alert">
                            <i class="fas fa-circle-exclamation me-1"></i>Periksa kembali isian berikut:
                            <ul>
                                @foreach ($errors->all() as $epError)
                                    <li>{{ $epError }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Identitas + muat dari master via NID --}}
                    @can('karyawan_data.view')
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fas fa-wand-magic-sparkles" style="color: var(--pln-blue); font-size: 0.8rem;"></i>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="epLoadFromNid()" style="font-size: 0.75rem; font-weight: 600;">
                                <i class="fas fa-cloud-arrow-down me-1"></i> Muat Data dari NID (master Excel)
                            </button>
                            <span style="font-size: 0.72rem; color: #9ca3af;">Isi NID lalu klik untuk mengambil seluruh field dari master Data Karyawan.</span>
                        </div>
                    @endcan

                    <fieldset class="ep-form-fieldset mb-3">
                        <legend>Identitas</legend>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="ep-form-label" for="ep_nid">NID</label>
                                <input type="text" id="ep_nid" name="nid" value="{{ old('nid', $epPrefill['nid'] ?? '') }}" class="form-control form-control-sm" maxlength="30" placeholder="NID karyawan">
                            </div>
                            <div class="col-md-8">
                                <label class="ep-form-label" for="ep_nama">NAMA</label>
                                <input type="text" id="ep_nama" name="nama" value="{{ old('nama', $epPrefill['nama'] ?? '') }}" class="form-control form-control-sm" maxlength="150">
                                <small style="font-size: 0.7rem; color: #9ca3af;">Awal otomatis dari nama akun — perubahan di sini hanya menyimpan ke data kepegawaian, bukan nama akun.</small>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="ep-form-fieldset mb-3">
                        <legend>Organisasi & Jabatan</legend>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="ep-form-label" for="ep_unit">Unit</label>
                                <select id="ep_unit" name="unit" class="form-select form-select-sm">
                                    <option value="">— Pilih —</option>
                                    @foreach ($epOptionsUnit as $epOption)
                                        <option value="{{ $epOption }}" @selected($epSelectedUnit === $epOption)>{{ $epOption }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="ep-form-label" for="ep_bidang">Bidang</label>
                                <select id="ep_bidang" name="bidang" class="form-select form-select-sm">
                                    <option value="">— Pilih —</option>
                                    @foreach ($epOptionsBidang as $epOption)
                                        <option value="{{ $epOption }}" @selected($epSelectedBidang === $epOption)>{{ $epOption }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="ep-form-label" for="ep_jabatan">Jabatan</label>
                                <select id="ep_jabatan" name="jabatan" class="form-select form-select-sm">
                                    <option value="">— Pilih —</option>
                                    @foreach ($epOptionsJabatan as $epOption)
                                        <option value="{{ $epOption }}" @selected($epSelectedJabatan === $epOption)>{{ $epOption }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="ep-form-label" for="ep_jenjang_jabatan">Jenjab</label>
                                <input type="text" id="ep_jenjang_jabatan" name="jenjang_jabatan" value="{{ old('jenjang_jabatan', $epPrefill['jenjang_jabatan'] ?? '') }}" class="form-control form-control-sm" maxlength="50">
                            </div>
                            <div class="col-md-4">
                                <label class="ep-form-label" for="ep_grade">Grade</label>
                                <input type="text" id="ep_grade" name="grade" value="{{ old('grade', $epPrefill['grade'] ?? '') }}" class="form-control form-control-sm" maxlength="30">
                            </div>
                            <div class="col-md-4">
                                <label class="ep-form-label" for="ep_organik">Organik</label>
                                <input type="text" id="ep_organik" name="organik" value="{{ old('organik', $epPrefill['organik'] ?? '') }}" class="form-control form-control-sm" maxlength="100">
                            </div>
                            <div class="col-md-4">
                                <label class="ep-form-label" for="ep_institusi">Institusi</label>
                                <input type="text" id="ep_institusi" name="institusi" value="{{ old('institusi', $epPrefill['institusi'] ?? '') }}" class="form-control form-control-sm" maxlength="100">
                            </div>
                            <div class="col-md-4">
                                <label class="ep-form-label" for="ep_fte">FTE</label>
                                <input type="number" step="0.01" min="0" max="99" id="ep_fte" name="fte" value="{{ old('fte', $epPrefill['fte'] ?? '') }}" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-4">
                                <label class="ep-form-label" for="ep_mims">MIMS</label>
                                <input type="text" id="ep_mims" name="mims" value="{{ old('mims', $epPrefill['mims'] ?? '') }}" class="form-control form-control-sm" maxlength="50">
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="ep-form-fieldset mb-3">
                        <legend>Tanggal Penting</legend>
                        <div class="row g-3">
                            @foreach (['service_date' => 'Service Date', 'hire_date' => 'Hire Date', 'retire_date' => 'Retire Date', 'grade_date' => 'Grade Date', 'tgl_jab' => 'Tgl Jab', 'tanggal_lahir' => 'Tgl Lahir'] as $epDateField => $epDateLabel)
                                <div class="col-md-4">
                                    <label class="ep-form-label" for="ep_{{ $epDateField }}">{{ $epDateLabel }}</label>
                                    <input type="date" id="ep_{{ $epDateField }}" name="{{ $epDateField }}" value="{{ old($epDateField, $epPrefill[$epDateField] ?? '') }}" class="form-control form-control-sm">
                                </div>
                            @endforeach
                        </div>
                    </fieldset>

                    <fieldset class="ep-form-fieldset mb-3">
                        <legend>Kontak & Komunikasi</legend>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="ep-form-label" for="ep_telp">Telp</label>
                                <input type="text" id="ep_telp" name="telp" value="{{ old('telp', $epPrefill['telp'] ?? '') }}" class="form-control form-control-sm" maxlength="50">
                            </div>
                            <div class="col-md-4">
                                <label class="ep-form-label" for="ep_hp">HP</label>
                                <input type="text" id="ep_hp" name="hp" value="{{ old('hp', $epPrefill['hp'] ?? '') }}" class="form-control form-control-sm" maxlength="50">
                            </div>
                            <div class="col-md-4">
                                <label class="ep-form-label" for="ep_email">Email</label>
                                <input type="email" id="ep_email" name="email" value="{{ old('email', $epPrefill['email'] ?? '') }}" class="form-control form-control-sm" maxlength="150">
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="ep-form-fieldset mb-3">
                        <legend>Data Pribadi</legend>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="ep-form-label" for="ep_tempat_lahir">Tempat Lahir</label>
                                <input type="text" id="ep_tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $epPrefill['tempat_lahir'] ?? '') }}" class="form-control form-control-sm" maxlength="100">
                            </div>
                            <div class="col-md-3">
                                <label class="ep-form-label" for="ep_agama">Agama</label>
                                <select id="ep_agama" name="agama" class="form-select form-select-sm">
                                    <option value="">— Pilih —</option>
                                    @foreach ($epOptionsAgama as $epOption)
                                        <option value="{{ $epOption }}" @selected($epSelectedAgama === $epOption)>{{ $epOption }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="ep-form-label" for="ep_gender">Gender</label>
                                <select id="ep_gender" name="gender" class="form-select form-select-sm">
                                    <option value="">— Pilih —</option>
                                    <option value="L" @selected(old('gender', $epPrefill['gender'] ?? '') === 'L')>Laki-laki</option>
                                    <option value="P" @selected(old('gender', $epPrefill['gender'] ?? '') === 'P')>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="ep-form-label" for="ep_status_kawin">Status Kawin</label>
                                <select id="ep_status_kawin" name="status_kawin" class="form-select form-select-sm">
                                    <option value="">— Pilih —</option>
                                    <option value="TK" @selected(old('status_kawin', $epPrefill['status_kawin'] ?? '') === 'TK')>Tidak Kawin</option>
                                    <option value="K" @selected(old('status_kawin', $epPrefill['status_kawin'] ?? '') === 'K')>Kawin</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer ep-modal-footer">
                <button type="button" class="btn btn-light ep-btn-cancel" data-bs-dismiss="modal">
                    <i class="fas fa-xmark"></i> Batal
                </button>
                <button type="submit" class="btn btn-primary ep-btn-save" form="epForm">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>
@endcan

{{-- Script halaman Detail Pengguna — aksi header (toggle status, hapus,
     reset password) SEMUANYA berupa form submit biasa + @csrf/@method;
     tidak ada fetch mutasi data di halaman ini (epLoadFromNid hanya GET).
     WAJIB inline di content agar router.js mengeksekusi ulang setelah SPA. --}}
<script>
    /* =========================================================
       EDIT DETAIL KEPEGAWAIAN (modal)
       1. epLoadFromNid — prefill seluruh field form dari MASTER
          karyawans (hasil impor Excel) berdasarkan NID.
       2. Modal otomatis dibuka kembali saat validasi server gagal
          (error list dirender ulang di dalam modal).
       ========================================================= */
    function epLoadFromNid() {
        var nid = (document.getElementById('ep_nid')?.value || '').trim();

        if (!nid) {
            Swal.fire({
                icon: 'warning',
                title: 'NID belum diisi',
                text: 'Masukkan NID terlebih dahulu, lalu klik "Muat Data dari NID".',
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#1d4ed8'
            });
            return;
        }

        fetch('{{ route('admin.users.karyawan-lookup') }}?nid=' + encodeURIComponent(nid), {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(function (res) {
                return res.json().then(function (data) {
                    data.httpOk = res.ok;
                    return data;
                });
            })
            .then(function (data) {
                if (!data.httpOk || !data.success) {
                    Swal.fire({
                        icon: 'error',
                        title: 'NID tidak ditemukan',
                        text: data.message || 'Periksa kembali NID pada master Data Karyawan.',
                        confirmButtonText: 'Mengerti',
                        confirmButtonColor: '#dc2626'
                    });
                    return;
                }

                // Isi seluruh field form dari master (nilai kosong
                // master → dikosongkan juga di form, agar tampilan
                // selalu mencerminkan master yang dimuat).
                var values = data.data || {};
                Object.keys(values).forEach(function (column) {
                    var el = document.getElementById('ep_' + column);
                    if (!el) return;

                    var value = values[column] === null || values[column] === undefined ? '' : values[column];

                    // SELECT (Unit/Bidang/Jabatan/Agama/Gender/Status
                    // Kawin): bila nilai master tidak ada di daftar
                    // option, tambahkan sebagai option ekstra supaya
                    // ter-pilih — tidak ada data yang hilang.
                    if (el.tagName === 'SELECT' && value !== '') {
                        var hasOption = Array.prototype.some.call(el.options, function (opt) {
                            return opt.value === value;
                        });
                        if (!hasOption) {
                            var extra = document.createElement('option');
                            extra.value = value;
                            extra.textContent = value;
                            el.appendChild(extra);
                        }
                    }

                    el.value = value;
                });

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data master karyawan "' + (values.nama || nid) + '" berhasil dimuat.',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                });
            })
            .catch(function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal memuat data',
                    text: 'Terjadi kesalahan jaringan. Coba lagi.',
                    confirmButtonText: 'Mengerti',
                    confirmButtonColor: '#dc2626'
                });
            });
    }
</script>

{{-- ============================================================
     INISIALISASI MODAL EDIT DETAIL (#editDetailModal)
     ------------------------------------------------------------
     Vanilla Bootstrap JS yang bersih — tanpa duplikasi ID atau
     listener yang menumpuk:
     - Instance modal dibuat SEKALI (getInstance || new) sehingga
       aman terhadap re-eksekusi script oleh router.js setelah
       swap konten SPA (tidak pernah ada dua instance untuk satu
       elemen).
     - Berjalan pada event DOMContentLoaded (full load) dan juga
       langsung dieksekusi ulang saat router.js menaruh konten
       baru (readyState bukan 'loading') — tombol "Lengkapi Data"
       / "Edit Detail" SELALU bisa diklik tanpa refresh halaman.
     - Modal dibuka otomatis HANYA saat validasi server gagal
       (daftar error dirender ulang di dalam modal).
     ============================================================ --}}
<script>
    (function () {
        function initEditDetailModal() {
            var modalEl = document.getElementById('editDetailModal');
            if (!modalEl || !window.bootstrap) return;

            var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modal.show();
        }

        @if (isset($errors) && $errors->any())
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initEditDetailModal);
        } else {
            // Konten baru hasil swap router.js — langsung inisialisasi.
            initEditDetailModal();
        }
        @endif
    })();
</script>

{{-- ============================================================
     MODAL KONFIRMASI RESET PASSWORD (#resetPasswordModal)
     ---------------------------------------------------------
     Dibuka oleh tombol kunci (ikon 🔑) di header kartu melalui
     data-bs-toggle="modal" data-bs-target="#resetPasswordModal".
     Tombol "Ya, Reset Password" adalah submit form POST biasa
     dengan @csrf + @method('PATCH') ke route reset password —
     tanpa AJAX, sehingga token CSRF selalu ikut terkirim dan
     tidak berujung "419 Page Expired".
     ============================================================ --}}
@if(auth()->user()?->can('user.reset-password') && auth()->id() !== $user->id)
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="resetPasswordModalLabel">
                    <i class="fas fa-key me-2" style="color: #d97706;"></i>Reset Password Pengguna?
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <span class="p-3 bg-warning-subtle rounded-circle text-warning fs-3 d-inline-block mb-3">🔑</span>
                <p class="text-muted small mb-2">
                    Password lama <b>{{ $user->name }}</b> (<b>{{ $user->email }}</b>) akan dinonaktifkan
                    dan diganti <b>password sementara acak</b> yang dibuat sistem. Saat login berikutnya,
                    pengguna <b>wajib mengganti password</b> tersebut sebelum dapat masuk.
                </p>
                <div class="alert alert-light border mb-0 small">
                    Password sementara hanya ditampilkan <b>sekali</b> setelah reset —
                    sampaikan via WhatsApp/lisan, <b>tidak dikirim email</b>.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                {{-- Form POST biasa: @csrf mencegah 419 Page Expired; @method('PATCH')
                     dipakai karena route admin.users.reset-password didefinisikan PATCH. --}}
                <form action="{{ route('admin.users.reset-password', $user) }}" method="POST" class="d-inline mb-0">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-warning text-white">
                        <i class="fas fa-key me-1"></i>Ya, Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

{{-- ============================================================
     MODAL HASIL RESET (#successResetModal) — modal KEDUA
     ---------------------------------------------------------
     Muncul OTOMATIS saat session flash temporaryPassword ada
     (dibawa redirect dari controller setelah submit form
     "Ya, Reset Password"). Dirender langsung dengan
     style="display: block" sehingga tampil tanpa perlu JavaScript.
     Password hanya tampil SEKALI; session flash hilang setelah
     request ini.
     ============================================================ --}}
@if(session('temporaryPassword'))
<div class="modal fade show" id="successResetModal" tabindex="-1" style="display: block; background: rgba(0,0,0,0.5);" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 text-center">
            <div class="mb-3">
                <span class="p-3 bg-warning-subtle rounded-circle text-warning fs-3">🔑</span>
            </div>
            <h4 class="fw-bold mb-2">Password Berhasil Direset</h4>
            <p class="text-muted small mb-3">
                Password sementara untuk <b>{{ $user->name }}</b>. Salin dan sampaikan via WhatsApp/lisan — tidak dikirim email dan hanya ditampilkan sekali ini.
            </p>
            <div class="input-group mb-3">
                <input type="text" class="form-control text-center fw-bold text-dark bg-light" id="tempPasswordInput" value="{{ session('temporaryPassword') }}" readonly>
                <button class="btn btn-outline-secondary" type="button" onclick="navigator.clipboard.writeText(document.getElementById('tempPasswordInput').value); alert('Password disalin!');">Copy</button>
            </div>
            <button type="button" class="btn btn-warning text-white w-100" onclick="document.getElementById('successResetModal').style.display='none'">Selesai</button>
        </div>
    </div>
</div>
<script>
    /* Fallback tombol Copy — navigator.clipboard hanya tersedia pada
       konteks secure (https / localhost). Pada http murni properti ini
       tidak ada sehingga onclick tombol Copy melempar TypeError; sediakan
       implementasi setara berbasis document.execCommand('copy') agar
       tetap berfungsi. Idempoten — aman dijalankan ulang oleh router.js. */
    (function () {
        if (navigator.clipboard && navigator.clipboard.writeText) return;

        try {
            Object.defineProperty(navigator, 'clipboard', {
                configurable: true,
                value: {
                    writeText: function (text) {
                        return new Promise(function (resolve, reject) {
                            var input = document.getElementById('tempPasswordInput');
                            if (!input) {
                                reject(new Error('Kolom password sementara tidak ditemukan.'));
                                return;
                            }

                            input.focus();
                            input.select();

                            try {
                                document.execCommand('copy') ? resolve(text) : reject(new Error('Browser menolak perintah salin.'));
                            } catch (e) {
                                reject(e);
                            }
                        });
                    }
                }
            });
        } catch (e) {
            /* Browser menolak penambahan properti — biarkan perilaku bawaan. */
        }
    })();
</script>
@endif
@endsection
