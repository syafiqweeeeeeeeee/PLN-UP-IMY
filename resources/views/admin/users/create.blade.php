@extends('layouts.admin')

@section('title', 'Tambah Pengguna — E-PPID PLN')
@section('page-title', 'Tambah Pengguna')

@push('styles')
<style>
    /* ============================================
       USER CREATE FORM — DESIGN SYSTEM FORM STANDAR
       Struktur & style sama dengan form Berita (referensi utama):
       form-topbar, form-section(+icon), form-group, form-input,
       form-error, form-footer, form-btn-save/cancel
       → semua global di public/css/admin.css.
       Yang tersisa di sini HANYA komponen unik Pengguna:
       ikon dalam input + indikator kekuatan password.
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

    /* Wrapper password + tombol show/hide */
    .password-wrapper { position: relative; }
    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 0;
    }
    .password-toggle:hover { color: var(--pln-blue); }
    .input-icon .password-toggle ~ .form-input,
    .password-wrapper .form-input { padding-right: 2.4rem; }

    /* Indikator kekuatan password */
    .password-strength {
        height: 4px;
        border-radius: 2px;
        margin-top: 0.5rem;
        width: 0%;
        background: #e5e7eb;
        transition: width 0.2s ease, background 0.2s ease;
    }
    .strength-text { font-size: 0.75rem; margin-top: 0.25rem; font-weight: 600; }
</style>
@endpush

@section('content')
{{-- ============================================
     TOP NAVIGATION — standar Design System Form
     ============================================ --}}
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.users.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">Tambah Pengguna Baru</h4>
            <p class="form-page-subtitle">Isi formulir di bawah untuk mendaftarkan pengguna baru</p>
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

<form action="{{ route('admin.users.store') }}" method="POST" id="userForm">
    @csrf

    {{-- ============================================
         SECTION: Informasi Akun
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon blue">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <h6 class="form-section-title">Informasi Akun</h6>
                <p class="form-section-desc">Nama, email, dan keamanan akun</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="name">
                        Nama Lengkap <span class="required">*</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-user icon"></i>
                        <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required autocomplete="name" placeholder="Nama lengkap pengguna...">
                    </div>
                    @error('name')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="email">
                        Email <span class="required">*</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-envelope icon"></i>
                        <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required autocomplete="email" placeholder="email@contoh.com">
                    </div>
                    @error('email')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="password">
                        Password <span class="required">*</span>
                    </label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" class="form-input" required autocomplete="new-password" placeholder="Min. 8 karakter">
                        <button type="button" class="password-toggle" onclick="togglePassword('password', this)" aria-label="Tampilkan password"><i class="fas fa-eye-slash"></i></button>
                    </div>
                    <div id="passwordStrength" class="password-strength"></div>
                    <div id="strengthText" class="strength-text"></div>
                    @error('password')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="password_confirmation">
                        Konfirmasi Password <span class="required">*</span>
                    </label>
                    <div class="password-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required autocomplete="new-password" placeholder="Ulangi password...">
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)" aria-label="Tampilkan password"><i class="fas fa-eye-slash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         SECTION: Role & Kontak
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon cyan">
                <i class="fas fa-user-tag"></i>
            </div>
            <div>
                <h6 class="form-section-title">Role & Kontak</h6>
                <p class="form-section-desc">Hak akses dan informasi kontak pengguna</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12">
                <div class="form-group">
                    <label class="form-group-label" for="role_id">
                        Role Pengguna <span class="required">*</span>
                    </label>
                    <select id="role_id" name="role_id" class="form-input" required>
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }} {{ $role->status ? '' : '(Nonaktif)' }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-hint flex">
                        <i class="far fa-lightbulb"></i> Pilih role aktif — role nonaktif tidak dapat digunakan.
                    </div>
                    @error('role_id')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="no_hp">
                        No. Telepon <span class="optional">(opsional)</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-phone icon"></i>
                        <input type="text" id="no_hp" name="no_hp" class="form-input" value="{{ old('no_hp') }}" placeholder="081234567890">
                    </div>
                    <div class="form-hint flex">
                        <i class="far fa-lightbulb"></i> Isi jika diperlukan untuk kontak
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="alamat">
                        Alamat <span class="optional">(opsional)</span>
                    </label>
                    <textarea id="alamat" name="alamat" class="form-input" rows="2" placeholder="Alamat lengkap pengguna...">{{ old('alamat') }}</textarea>
                    <div class="form-hint flex">
                        <i class="far fa-lightbulb"></i> Isi jika diperlukan
                    </div>
                </div>
            </div>
        </div>
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
                <i class="fas fa-save"></i> Tambah Pengguna
            </button>
        </div>
    </div>
</form>

{{-- Script WAJIB di dalam @section('content') (bukan @push('scripts'))
     karena client-side router (router.js) hanya mengeksekusi ulang
     <script> di dalam <main>; kalau di push stack, tombol show password
     & indikator kekuatan password mati setelah navigasi via sidebar. --}}
<script>
    function togglePassword(fieldId, btn) {
        const field = document.getElementById(fieldId);
        const icon = btn.querySelector('i');
        // Konvensi: password tersembunyi = eye-slash, terlihat = eye
        if (field.type === 'password') { field.type = 'text'; icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); }
        else { field.type = 'password'; icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); }
    }
    const passwordInput = document.getElementById('password');
    const strengthBar = document.getElementById('passwordStrength');
    const strengthText = document.getElementById('strengthText');
    passwordInput?.addEventListener('input', function () {
        const pw = this.value;
        let s = 0;
        if (pw.length >= 8) s++;
        if (pw.length >= 12) s++;
        if (/[A-Z]/.test(pw)) s++;
        if (/[0-9]/.test(pw)) s++;
        if (/[^A-Za-z0-9]/.test(pw)) s++;
        const color = s <= 1 ? '#dc2626' : s <= 2 ? '#f59e0b' : s <= 3 ? '#10b981' : '#059669';
        const text = s <= 1 ? 'Lemah' : s <= 2 ? 'Cukup' : s <= 3 ? 'Kuat' : 'Sangat Kuat';
        strengthBar.style.width = (s * 20) + '%';
        strengthBar.style.background = color;
        strengthText.textContent = text;
        strengthText.style.color = color;
    });
</script>
@endsection
