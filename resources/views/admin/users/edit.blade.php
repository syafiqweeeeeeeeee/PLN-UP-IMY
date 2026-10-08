@extends('layouts.admin')

@section('title', 'Edit Pengguna — ' . ($user->name ?? '') . ' — E-PPID PLN')
@section('page-title', 'Edit Pengguna')

@php
    $isEdit          = $user !== null;

    $actor          = auth()->user();
    $actorRoleRaw  = ($actor && $actor->role) ? trim((string) $actor->role) : '';
    $actorRoleName = strtolower($actorRoleRaw);
    $actorIsSuperUser = ($actorRoleName === 'super admin' || $actorRoleName === 'admin' || ($actor->role_id ?? null) == 1);

    $targetRoleRaw = ($user && $user->role) ? trim((string) $user->role) : '';
    $isEditingSuperAdmin = ($isEdit && ($targetRoleRaw === 'Super Admin' || $targetRoleRaw === 'Admin' || ($user->role_id ?? null) == 1));

    // Tujuan tombol Kembali / Batal
    // - Super Admin / Admin utama: kembali ke tabel pengguna.
    // - Admin Bidang / Non-Super Admin (self-edit): kembali ke profil sendiri.
    // - Sisa kasus: kembali ke halaman sebelumnya.
    if ($actorIsSuperUser) {
        $backUrl   = route('admin.users.index');
        $cancelUrl = $backUrl;
    } elseif ($isEdit && $user?->id === $actor?->id) {
        $backUrl   = route('admin.users.show', $user);
        $cancelUrl = $backUrl;
    } else {
        $backUrl   = url()->previous();
        $cancelUrl = $backUrl;
    }
@endphp

@push('styles')
    <style data-page>
        .form-section { padding: 1.5rem; }
        @media (max-width: 767.98px) {
            .form-section { padding: 1rem; }
        }
    </style>
@endpush

@section('content')
    <div class="space-y-6">
        @include('admin.users._form', [
            'user'                  => $user,
            'roles'                 => $roles,
            'menuMatrix'            => $menuMatrix ?? [],
            'userPermissionIds'     => $userPermissionIds ?? [],
            'isEditingSuperAdmin'   => $isEditingSuperAdmin,
            'backUrl'               => $backUrl,
            'cancelUrl'             => $cancelUrl,
            'actorIsSuperUser'      => $actorIsSuperUser,
        ])
    </div>
@endsection
