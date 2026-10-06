@extends('layouts.admin')

@section('title', 'Edit Pengguna — ' . ($user->name ?? '') . ' — E-PPID PLN')
@section('page-title', 'Edit Pengguna')

@php
    $isEditingSuperAdmin = $user?->isSuperAdmin() ?? false;
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
        ])
    </div>
@endsection
