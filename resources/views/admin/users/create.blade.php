@extends('layouts.admin')

@section('title', 'Tambah Pengguna — E-PPID PLN')
@section('page-title', 'Tambah Pengguna')

@push('styles')
    <style data-page>
        /* Password strength bar — hanya aktif di halaman form pengguna */
        #passwordStrength {
            height: 4px;
            border-radius: 2px;
            background: #e5e7eb;
            margin-top: 0.5rem;
            transition: width 0.2s ease, background 0.2s ease;
        }
        .strength-text {
            font-size: 0.72rem;
            min-height: 1rem;
        }
        .perm-matrix-block { display: block; }
        .perm-matrix-wrap { overflow-x: auto; }
        .perm-matrix { min-width: 680px; }
        @media (max-width: 767.98px) {
            .form-section { padding: 1rem; }
        }
    </style>
@endpush

@section('content')
    <div class="space-y-6">
        @include('admin.users._form', [
            'user'              => null,
            'roles'             => $roles,
            'menuMatrix'        => $menuMatrix ?? [],
            'userPermissionIds' => [],
        ])
    </div>
@endsection
