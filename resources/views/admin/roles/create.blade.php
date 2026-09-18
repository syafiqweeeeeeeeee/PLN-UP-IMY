@extends('layouts.admin')

@section('title', 'Tambah Role — E-PPID PLN')
@section('page-title', 'Tambah Role')

@push('styles')
<style>
    /* ============================================
       ROLE CREATE FORM — DESIGN SYSTEM FORM STANDAR
       Struktur & style sama dengan form Berita (referensi utama):
       form-topbar, form-section(+icon), form-group, form-input,
       form-error, form-footer, form-btn-save/cancel
       → semua global di public/css/admin.css.
       Yang tersisa di sini HANYA komponen unik Role: status cards.
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
            <h4 class="form-page-title">Tambah Role Baru</h4>
            <p class="form-page-subtitle">Buat role baru untuk pengaturan hak akses pengguna</p>
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

<form action="{{ route('admin.roles.store') }}" method="POST" id="roleForm">
    @csrf

    {{-- ============================================
         SECTION: Detail Role
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
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required autocomplete="organization" placeholder="Contoh: Supervisor, Editor, dll." maxlength="100">
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
            <textarea id="description" name="description" class="form-input" rows="2" maxlength="255" placeholder="Deskripsi singkat tentang role ini...">{{ old('description') }}</textarea>
            <div class="form-hint flex">
                <i class="far fa-lightbulb"></i> Maksimal 255 karakter.
            </div>
            @error('description')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- ============================================
         SECTION: Status Role
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
                <label class="status-card status-active {{ old('status') === 'active' ? 'active' : '' }}">
                    <input type="radio" name="status" value="active" {{ old('status') === 'active' ? 'checked' : '' }}>
                    <div class="status-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="status-title">Aktif</div>
                    <p class="status-desc">Role dapat digunakan untuk login & akses</p>
                </label>
            </div>
            <div class="col-md-6">
                <label class="status-card status-inactive {{ old('status') === 'inactive' ? 'active' : '' }}">
                    <input type="radio" name="status" value="inactive" {{ old('status') === 'inactive' ? 'checked' : '' }}>
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
                <i class="fas fa-save"></i> Simpan Role
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
