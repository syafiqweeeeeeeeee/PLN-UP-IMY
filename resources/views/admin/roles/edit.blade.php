@extends('layouts.admin')

@section('title', 'Edit Role — E-PPID PLN')
@section('page-title', 'Edit Role')

@push('styles')
<style>
    /* ============================================
       ROLE EDIT FORM — DESIGN SYSTEM FORM STANDAR
       Struktur & style SAMA dengan form Tambah Role
       (konsistensi Tambah = Edit, hanya isi & form action yang beda).
       Class dasar global di public/css/admin.css; yang tersisa di
       sini HANYA komponen unik Role: status cards + badge.
       ============================================ */

    /* Input dengan ikon di kiri — gaya standar form-input */
    .input-icon { position: relative; }
    .input-icon .icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 0.85rem;
        pointer-events: none;
    }
    html.theme-dark .input-icon .icon { color: var(--ink-faint); }
    .input-icon .form-input { padding-left: 2.25rem; }

    /* Status cards — pilihan Aktif/Nonaktif */
    .status-card {
        position: relative;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #fff;
        height: 100%;
    }
    html.theme-dark .status-card { background: var(--panel); border-color: var(--line); }
    .status-card:hover { border-color: #d1d5db; background: #f9fafb; }
    html.theme-dark .status-card:hover { background: var(--panel-hover); }
    .status-card.active { border-color: var(--pln-blue); background: #eff6ff; }
    html.theme-dark .status-card.active { background: var(--panel-hover); }
    .status-card input { position: absolute; opacity: 0; cursor: pointer; }
    .status-card .status-icon {
        width: 44px; height: 44px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem; margin-bottom: 0.75rem;
    }
    .status-card .status-title { font-weight: 600; font-size: 0.95rem; margin-bottom: 0.25rem; }
    .status-card .status-desc { font-size: 0.8rem; color: #6b7280; margin: 0; }
    html.theme-dark .status-card .status-desc { color: var(--ink-muted); }
    .status-card.status-active .status-icon { background: #dcfce7; color: #166534; }
    .status-card.status-active .status-title { color: #166534; }
    .status-card.status-inactive .status-icon { background: #fef3c7; color: #92400e; }
    .status-card.status-inactive .status-title { color: #92400e; }

    /* ============================================
       MATRIKS HAK AKSES (checkbox per ID Menu Sidebar)
       Kolom: [ Buka Menu (View) | Tambah (Create) |
               Edit (Update) | Hapus (Delete) ]
       ============================================ */
    .perm-matrix-wrap { overflow-x: auto; border: 1px solid #e5e7eb; border-radius: 12px; }
    html.theme-dark .perm-matrix-wrap { border-color: var(--line); }
    .perm-matrix { width: 100%; border-collapse: collapse; min-width: 720px; }
    .perm-matrix thead th {
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
        padding: 0.75rem 1rem;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6b7280;
        text-align: center;
        white-space: nowrap;
    }
    .perm-matrix thead th:nth-child(1),
    .perm-matrix thead th:nth-child(2) { text-align: left; }
    html.theme-dark .perm-matrix thead th { background: var(--panel-2); border-color: var(--line); color: var(--ink-muted); }
    .perm-matrix tbody td {
        padding: 0.65rem 1rem;
        border-bottom: 1px solid #f3f4f6;
        text-align: center;
        font-size: 0.85rem;
    }
    .perm-matrix tbody td:nth-child(1),
    .perm-matrix tbody td:nth-child(2) { text-align: left; }
    .perm-matrix tbody tr:last-child td { border-bottom: none; }
    .perm-matrix tbody tr:hover td { background: #f9fafb; }
    html.theme-dark .perm-matrix tbody td { border-color: var(--line); }
    html.theme-dark .perm-matrix tbody tr:hover td { background: var(--panel-hover); }
    .perm-menu-id {
        display: inline-block;
        min-width: 1.75rem;
        padding: 0.15rem 0.4rem;
        border-radius: 6px;
        background: #eef2ff;
        color: #4338ca;
        font-weight: 700;
        font-size: 0.75rem;
    }
    html.theme-dark .perm-menu-id { background: var(--panel-2); color: var(--ink-body); }
    .perm-menu-name {
        font-weight: 600;
        color: var(--ink-heading);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .perm-menu-name i { color: var(--pln-blue); width: 1.1rem; text-align: center; }
    .perm-check {
        width: 1.05rem;
        height: 1.05rem;
        border-radius: 4px;
        border: 1px solid #d1d5db;
        accent-color: var(--pln-blue);
        cursor: pointer;
    }
    .perm-na { color: #cbd5e1; font-size: 0.8rem; }
    .btn-permission-outline {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.55rem 1rem;
        font-weight: 500;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .btn-permission-outline:hover { background: #e5e7eb; }
    html.theme-dark .btn-permission-outline { background: var(--panel-2); color: var(--ink-body); border-color: var(--line); }

    /* Badge status pada ringkasan atas */
    .badge-role {
        font-size: 0.75rem; padding: 0.3rem 0.7rem; border-radius: 20px; font-weight: 600;
    }
    .badge-role-active { background: #dcfce7; color: #166534; }
    .badge-role-inactive { background: #fef3c7; color: #92400e; }
</style>
@endpush

@section('content')
{{-- ============================================
     TOP NAVIGATION — standar Design System Form
     ============================================ --}}
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.roles.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">Edit Role</h4>
            <p class="form-page-subtitle">Perbarui informasi role ini</p>
        </div>
    </div>
</div>

@if (session('success'))
<div class="form-alert success">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="form-alert danger">
    <i class="fas fa-circle-exclamation"></i> Perbaiki data berikut.
</div>
@endif

{{-- Ringkasan data role — kartu section standar --}}
<div class="form-section">
    <div class="form-section-header">
        <div class="form-section-icon purple">
            <i class="fas fa-id-card"></i>
        </div>
        <div>
            <h6 class="form-section-title">Data Role</h6>
            <p class="form-section-desc">Ringkasan data yang sedang diedit</p>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="form-group-label" style="margin-bottom:0.1rem;">Nama Role</div>
            <div style="font-size:0.88rem; color:var(--ink-heading); font-weight:600;">{{ $role->name }}</div>
        </div>
        <div class="col-md-4">
            <div class="form-group-label" style="margin-bottom:0.1rem;">Deskripsi</div>
            <div style="font-size:0.88rem; color:var(--ink-muted);">{{ $role->description ?? '-' }}</div>
        </div>
        <div class="col-md-4">
            <div class="form-group-label" style="margin-bottom:0.1rem;">Status</div>
            <span class="badge-role {{ $role->status ? 'badge-role-active' : 'badge-role-inactive' }}">
                {{ $role->status ? 'Aktif' : 'Nonaktif' }}
            </span>
        </div>
    </div>
</div>

<form action="{{ route('admin.roles.update', $role) }}" method="POST" id="roleForm">
    @csrf
    @method('PUT')

    {{-- ============================================
         SECTION: Detail Role — sama dengan form Tambah
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon blue">
                <i class="fas fa-user-tag"></i>
            </div>
            <div>
                <h6 class="form-section-title">Detail Role</h6>
                <p class="form-section-desc">Nama dan deskripsi role</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label" for="name">
                Nama Role <span class="required">*</span>
            </label>
            <div class="input-icon">
                <i class="fas fa-tag icon"></i>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $role->name) }}" required autocomplete="organization" maxlength="100">
            </div>
            <div class="form-hint flex">
                <i class="far fa-lightbulb"></i> Wajib diisi, maksimal 100 karakter, harus unik.
            </div>
            @error('name')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-group-label" for="description">
                Deskripsi <span class="optional">(opsional)</span>
            </label>
            <textarea id="description" name="description" class="form-input" rows="2" maxlength="255">{{ old('description', $role->description) }}</textarea>
            <div class="form-hint flex">
                <i class="far fa-lightbulb"></i> Maksimal 255 karakter.
            </div>
            @error('description')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- ============================================
         SECTION: Status Role — sama dengan form Tambah
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon yellow">
                <i class="fas fa-toggle-on"></i>
            </div>
            <div>
                <h6 class="form-section-title">Status Role</h6>
                <p class="form-section-desc">Tentukan apakah role langsung dapat digunakan</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="status-card status-active {{ old('status', $role->status ? 'active' : 'inactive') === 'active' ? 'active' : '' }}">
                    <input type="radio" name="status" value="active" {{ old('status', $role->status ? 'active' : 'inactive') === 'active' ? 'checked' : '' }}>
                    <div class="status-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="status-title">Aktif</div>
                    <p class="status-desc">Role dapat digunakan untuk login & akses</p>
                </label>
            </div>
            <div class="col-md-6">
                <label class="status-card status-inactive {{ old('status', $role->status ? 'active' : 'inactive') === 'inactive' ? 'active' : '' }}">
                    <input type="radio" name="status" value="inactive" {{ old('status', $role->status ? 'active' : 'inactive') === 'inactive' ? 'checked' : '' }}>
                    <div class="status-icon"><i class="fas fa-pause-circle"></i></div>
                    <div class="status-title">Nonaktif</div>
                    <p class="status-desc">Role tidak dapat digunakan saat ini</p>
                </label>
            </div>
        </div>
        @error('status')
            <div class="form-error mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
        @enderror
    </div>

    {{-- ============================================
         SECTION: Matriks Hak Akses (ID Menu Sidebar × CRUD)
         Checkbox disimpan dinamis ke pivot role_permission.
         Permission di luar matriks (publish/checkout/assign)
         tetap dikelola di halaman "Kelola Permission".
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon purple">
                <i class="fas fa-shield-halved"></i>
            </div>
            <div>
                <h6 class="form-section-title">Hak Akses Menu (Permission)</h6>
                <p class="form-section-desc">Centang hak akses granular per ID Menu Sidebar — perubahan tersimpan saat form disimpan</p>
            </div>
        </div>

        @include('admin.partials.permission-matrix', [
            'menuMatrix' => $menuMatrix,
            'checkedIds' => old('permissions', $rolePermissionIds ?? []),
        ])
    </div>

    {{-- ============================================
         FOOTER — standar Design System Form
         ============================================ --}}
    <div class="form-footer">
        <div class="form-footer-info">
            <i class="fas fa-circle-info"></i> Field dengan <span style="color:#dc2626;">*</span> wajib diisi
        </div>
        <div class="form-footer-actions">
            <button type="button" class="form-btn-cancel" onclick="history.back()">
                Batal
            </button>
            <button type="submit" class="form-btn-save">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </div>
</form>

{{-- Script WAJIB di dalam @section('content') (bukan @push('scripts'))
     karena client-side router (router.js) hanya mengeksekusi ulang
     <script> di dalam <main> setelah navigasi SPA. --}}
<script>
    document.querySelectorAll('.status-card').forEach(card => {
        card.addEventListener('click', function () {
            this.classList.add('active');
            this.querySelector('input[type="radio"]').checked = true;
            document.querySelectorAll('.status-card').forEach(c => {
                if (c !== this) c.classList.remove('active');
            });
        });
    });
</script>
@endsection
