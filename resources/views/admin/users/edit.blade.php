@extends('layouts.admin')

@section('title', 'Edit Pengguna — E-PPID PLN')
@section('page-title', 'Edit Pengguna')

@push('styles')
<style>
    /* ============================================
       USER EDIT FORM — DESIGN SYSTEM FORM STANDAR
       Struktur & style SAMA dengan form Tambah Pengguna
       (konsistensi Tambah = Edit, hanya isi & form action yang beda).
       Class dasar global di public/css/admin.css; yang tersisa di
       sini HANYA komponen unik Pengguna + blok OTP.
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
    .password-wrapper .form-input { padding-right: 2.4rem; }

    /* Badge role pada ringkasan atas */
    .role-badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.6rem;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .role-badge-active { background: #dcfce7; color: #166534; }
    .role-badge-inactive { background: #fef3c7; color: #92400e; }

    /* ===== Blok OTP ===== */
    .otp-card {
        background: #f0f7ff;
        border: 1px solid #d8e6f5;
        border-radius: 12px;
        padding: 1.1rem 1.25rem;
    }
    html.theme-dark .otp-card { background: rgba(0,91,156,0.14); border-color: rgba(0,163,224,0.25); }
    .otp-card-head { display: flex; align-items: center; gap: 0.65rem; margin-bottom: 0.3rem; }
    .otp-lock {
        width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0;
        background: var(--pln-blue); color: #fff;
        display: flex; align-items: center; justify-content: center; font-size: 0.9rem;
    }
    .otp-card-title { font-weight: 700; font-size: 0.92rem; color: #1f2937; flex: 1; min-width: 0; }
    html.theme-dark .otp-card-title { color: var(--ink-heading); }
    .otp-badge {
        font-size: 0.68rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.3px;
        background: #dbeafe; color: #1d4ed8; border-radius: 20px; padding: 0.2rem 0.65rem;
        white-space: nowrap;
    }
    html.theme-dark .otp-badge { background: rgba(0,163,224,0.18); color: #7cc7ff; }
    .otp-desc { font-size: 0.8rem; color: #64748b; margin: 0 0 0.85rem 0; }
    html.theme-dark .otp-desc { color: var(--ink-muted); }
    .otp-desc strong { color: #1f2937; word-break: break-all; }
    html.theme-dark .otp-desc strong { color: var(--ink-heading); }
    .otp-controls { display: flex; gap: 0.65rem; align-items: stretch; flex-wrap: wrap; }
    .otp-input {
        flex: 1 1 210px; min-width: 0;
        text-align: center; font-family: 'Courier New', Courier, monospace;
        font-size: 1rem; font-weight: 600; letter-spacing: 2px;
        border: 1px solid #cbd5e1; border-radius: 10px; padding: 0.6rem 0.75rem;
        transition: all 0.2s ease;
        background: #fff;
    }
    html.theme-dark .otp-input { background: var(--panel); border-color: var(--line); color: var(--ink-heading); }
    .otp-input:focus { border-color: var(--pln-blue); box-shadow: 0 0 0 3px rgba(0,91,156,0.12); outline: none; }
    .otp-input.has-value { letter-spacing: 6px; font-weight: 700; }
    .btn-otp {
        background: var(--pln-blue); color: #fff; border: none; border-radius: 10px;
        padding: 0.6rem 1.15rem; font-weight: 600; font-size: 0.85rem;
        white-space: nowrap; flex-shrink: 0; transition: all 0.2s ease;
    }
    .btn-otp:hover:not(:disabled) { background: #004a80; }
    .btn-otp:disabled { background: #94a3b8; cursor: not-allowed; opacity: 0.8; }
    .otp-alert { display: none; font-size: 0.8rem; border-radius: 8px; padding: 0.55rem 0.85rem; margin-top: 0.7rem; }
    .otp-alert.show { display: block; }
    .otp-alert-success { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
    .otp-alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

    /* ===== Auto-validate OTP: state valid / invalid / loading ===== */
    .otp-field { position: relative; flex: 1 1 210px; min-width: 0; }
    .otp-field .otp-input { width: 100%; padding-right: 2.4rem; transition: border-color 0.2s ease, box-shadow 0.2s ease; }
    .otp-status {
        position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%);
        width: 20px; text-align: center; font-size: 0.95rem; display: none;
    }
    .otp-status.show { display: inline-block; }
    .otp-status .fa-spinner { color: var(--pln-blue); }
    .otp-status .fa-circle-check { color: #16a34a; }
    .otp-status .fa-circle-xmark { color: #dc2626; }
    .otp-input.is-valid { border-color: #16a34a; box-shadow: 0 0 0 3px rgba(22,163,74,0.12); background: #f0fdf4; }
    .otp-input.is-invalid { border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,0.10); }
    .otp-input[readonly] { background: #f0fdf4; color: #14532d; cursor: not-allowed; }
    .otp-validate-msg { display: none; font-size: 0.78rem; margin-top: 0.4rem; font-weight: 600; }
    .otp-validate-msg.show { display: block; }
    .otp-validate-msg.ok { color: #16a34a; }
    .otp-validate-msg.err { color: #dc2626; }

    /* ===== Inline field error: frame merah + pesan di bawah input ===== */
    .field-error,
    input.field-error, select.field-error, textarea.field-error {
        border-color: #dc2626 !important;
        box-shadow: 0 0 0 3px rgba(220,38,38,0.12);
    }
    .field-error:focus {
        border-color: #dc2626 !important;
        box-shadow: 0 0 0 3px rgba(220,38,38,0.20);
    }
    .inline-error {
        display: flex; align-items: center; gap: 0.3rem;
        font-size: 0.78rem; color: #dc2626; font-weight: 600; margin-top: 0.3rem;
    }
</style>
@endpush

@section('content')
{{-- ============================================
     TOP NAVIGATION — standar Design System Form
     ============================================ --}}
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.users.show', $user) }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">Edit Pengguna</h4>
            <p class="form-page-subtitle">Perbarui informasi pengguna ini</p>
        </div>
    </div>
</div>

@if (session('success'))
<div class="form-alert success">
    <i class="fas fa-circle-check"></i> {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="form-alert danger">
    <i class="fas fa-circle-exclamation"></i> Perbaiki data berikut.
</div>
@endif

{{-- Ringkasan data pengguna — kartu section standar --}}
<div class="form-section">
    <div class="form-section-header">
        <div class="form-section-icon purple">
            <i class="fas fa-id-card"></i>
        </div>
        <div>
            <h6 class="form-section-title">Data Pengguna</h6>
            <p class="form-section-desc">Ringkasan data yang sedang diedit</p>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="d-flex align-items-center gap-3">
                <div style="width:44px;height:44px;background:linear-gradient(135deg,var(--pln-blue),var(--pln-cyan));color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:1rem;flex-shrink:0;border-radius:10px;">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                    <div class="form-group-label" style="margin-bottom:0.1rem;">Nama</div>
                    <div style="font-size:0.88rem; color:var(--ink-heading); font-weight:600;">{{ $user->name }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group-label" style="margin-bottom:0.1rem;">Email</div>
            <div style="font-size:0.88rem; color:var(--ink-heading);">{{ $user->email }}</div>
        </div>
        <div class="col-md-4">
            <div class="form-group-label" style="margin-bottom:0.1rem;">Role</div>
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
        </div>
    </div>
</div>

<form id="formEditUser" action="{{ route('admin.users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- ============================================
         SECTION: Informasi Akun — sama dengan form Tambah
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
                        <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $user->name) }}" required autocomplete="name">
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
                        <input type="email" id="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required autocomplete="email">
                    </div>
                    @error('email')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="password">
                        Password Baru <span class="optional">(opsional)</span>
                    </label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" class="form-input" autocomplete="new-password" placeholder="Kosongkan jika tidak ingin mengubah">
                        <button type="button" class="password-toggle" onclick="togglePassword('password', this)" aria-label="Tampilkan password"><i class="fas fa-eye-slash"></i></button>
                    </div>
                    <div class="form-hint flex">
                        <i class="far fa-lightbulb"></i> Biarkan kosong jika tidak ingin mengubah password
                    </div>
                    @error('password')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="password_confirmation">
                        Konfirmasi Password Baru <span class="optional">(opsional)</span>
                    </label>
                    <div class="password-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" autocomplete="new-password" placeholder="Ulangi password baru...">
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)" aria-label="Tampilkan password"><i class="fas fa-eye-slash"></i></button>
                    </div>
                </div>
            </div>

            {{-- ===== Verifikasi OTP (wajib hanya jika password baru diisi) ===== --}}
            <div class="col-12">
                <div class="otp-card">
                    {{-- Baris 1: judul + badge --}}
                    <div class="otp-card-head">
                        <div class="otp-lock"><i class="fas fa-lock"></i></div>
                        <div class="otp-card-title">Verifikasi Keamanan (OTP)</div>
                        <span class="otp-badge">Wajib jika mengubah password</span>
                    </div>
                    {{-- Baris 2: sub-deskripsi --}}
                    <p class="otp-desc">
                        Kode OTP akan dikirimkan ke email: <strong>{{ $user->email }}</strong>
                    </p>
                    {{-- Baris 3: input + tombol sejajar --}}
                    <div class="otp-controls">
                        <div class="otp-field">
                            <input type="text" id="otp_code" name="otp_code" class="otp-input"
                                   inputmode="numeric" pattern="[0-9]*" maxlength="6"
                                   placeholder="Masukkan 6 digit OTP" autocomplete="one-time-code">
                            <span id="otpStatus" class="otp-status"><i class="fas fa-spinner fa-spin"></i></span>
                        </div>
                        <button type="button" id="btnSendOtp" class="btn-otp">
                            <i class="fas fa-paper-plane me-1"></i>
                            <span id="btnSendOtpText">Kirim Kode OTP</span>
                        </button>
                    </div>
                    <div id="otpValidateOk" class="otp-validate-msg ok">OTP Valid <i class="fas fa-check"></i></div>
                    <div id="otpValidateErr" class="otp-validate-msg err">Kode OTP salah atau kadaluwarsa <i class="fas fa-xmark"></i></div>
                    <div id="otpAlertSuccess" class="otp-alert otp-alert-success">
                        <i class="fas fa-circle-check me-1"></i><span></span>
                    </div>
                    <div id="otpAlertError" class="otp-alert otp-alert-error">
                        <i class="fas fa-circle-exclamation me-1"></i><span></span>
                    </div>
                    @error('otp_code')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         SECTION: Role & Kontak — sama dengan form Tambah
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
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
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

            {{-- ===== Hirarki Organisasi: 3 dropdown dinamis ===== --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-group-label" for="level_jabatan">
                        Level Jabatan (Role Utama) <span class="required">*</span>
                    </label>
                    <select id="level_jabatan" name="level_jabatan" class="form-input" required>
                        <option value="">-- Pilih Level --</option>
                        @foreach(\App\Models\User::LEVEL_JABATAN as $code => $label)
                            <option value="{{ $code }}" {{ old('level_jabatan', $user->level_jabatan) === $code ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('level_jabatan')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4" id="deptWrapper">
                <div class="form-group">
                    <label class="form-group-label" for="department">
                        Bidang Utama <span class="required required-dept">*</span>
                    </label>
                    <select id="department" name="department" class="form-input">
                        <option value="">-- Pilih Bidang --</option>
                        @foreach(\App\Models\User::DEPARTMENTS as $code => $label)
                            <option value="{{ $code }}" {{ old('department', $user->department) === $code ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <div class="form-hint flex" id="deptHint" style="display:none;">
                        <i class="far fa-lightbulb"></i> Wajib dipilih untuk Manager Bidang & Staf/Asmen/Spv.
                    </div>
                    @error('department')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4" id="subDeptWrapper">
                <div class="form-group">
                    <label class="form-group-label" for="sub_department">
                        Sub-Bidang / Bagian <span class="required required-sub">*</span>
                    </label>
                    <select id="sub_department" name="sub_department" class="form-input">
                        <option value="">-- Pilih Sub-Bidang --</option>
                        @if(old('department', $user->department) && old('sub_department', $user->sub_department))
                            @php $oldSubs = \App\Models\User::SUB_DEPARTMENTS[old('department', $user->department)] ?? []; @endphp
                            @foreach($oldSubs as $code => $label)
                                <option value="{{ $code }}" {{ old('sub_department', $user->sub_department) === $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="form-hint flex" id="subHint" style="display:none;">
                        <i class="far fa-lightbulb"></i> Daftar sub-bidang saat ini tersedia untuk Bidang Operasi.
                    </div>
                    @error('sub_department')
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
                        <input type="text" id="no_hp" name="no_hp" class="form-input" value="{{ old('no_hp', $user->no_hp) }}" placeholder="081234567890">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="alamat">
                        Alamat <span class="optional">(opsional)</span>
                    </label>
                    <textarea id="alamat" name="alamat" class="form-input" rows="2" placeholder="Alamat lengkap pengguna...">{{ old('alamat', $user->alamat) }}</textarea>
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
            <button type="submit" id="btnSubmitUser" class="form-btn-save">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </div>
</form>

{{-- Script HARUS di dalam @section('content'): konten di luar @section pada
     template yang @extends layout tidak dirender Blade. Ditempatkan di sini juga
     membuat router SPA mengeksekusi ulang script saat navigasi AJAX. --}}
<script>
    function togglePassword(fieldId, btn) {
        const field = document.getElementById(fieldId);
        const icon = btn.querySelector('i');
        // Konvensi: password tersembunyi = eye-slash, terlihat = eye
        if (field.type === 'password') { field.type = 'text'; icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); }
        else { field.type = 'password'; icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); }
    }

    /* ===== Hirarki Organisasi — Dynamic Dropdown (sama dengan form Tambah) =====
       - Administrator / Senior Manager → dept & sub disembunyikan + disabled.
       - Manager Bidang → dept wajib, sub disembunyikan.
       - Staf/Asmen/Spv → dept & sub wajib (sub terisi sesuai dept). */
    (function () {
        const levelSelect = document.getElementById('level_jabatan');
        if (!levelSelect || levelSelect.dataset.hierarchyBound) return;   // anti double-bind
        levelSelect.dataset.hierarchyBound = '1';

        const SUBS = @json(\App\Models\User::SUB_DEPARTMENTS);
        const deptSelect  = document.getElementById('department');
        const subSelect   = document.getElementById('sub_department');
        const deptWrapper = document.getElementById('deptWrapper');
        const subWrapper  = document.getElementById('subDeptWrapper');
        const deptHint    = document.getElementById('deptHint');
        const subHint     = document.getElementById('subHint');
        const deptReqStar = document.querySelector('.required-dept');
        const subReqStar  = document.querySelector('.required-sub');

        function setHidden(wrapper, select, star, hint) {
            wrapper.style.display = 'none';
            select.disabled = true;      // disabled → tidak dikirim ke server
            select.required = false;
            if (star) star.style.display = 'none';
            if (hint) hint.style.display = 'none';
        }

        function setVisible(wrapper, select, star, hint, required) {
            wrapper.style.display = '';
            select.disabled = false;
            select.required = required;
            if (star) star.style.display = required ? '' : 'none';
            if (hint) hint.style.display = '';
        }

        function fillSubOptions(deptCode) {
            // Reset: sisakan placeholder lalu isi opsi sesuai dept terpilih.
            subSelect.innerHTML = '<option value="">-- Pilih Sub-Bidang --</option>';
            const subs = SUBS[deptCode] || {};
            Object.keys(subs).forEach(function (code) {
                const opt = document.createElement('option');
                opt.value = code;
                opt.textContent = subs[code];
                subSelect.appendChild(opt);
            });
        }

        function applyHierarchy() {
            const level = levelSelect.value;

            if (level === 'administrator' || level === 'senior_manager') {
                // Akses global → dept & sub disembunyikan + disabled.
                setHidden(deptWrapper, deptSelect, deptReqStar, deptHint);
                setHidden(subWrapper, subSelect, subReqStar, subHint);
            } else if (level === 'manager_bidang') {
                setVisible(deptWrapper, deptSelect, deptReqStar, deptHint, true);
                setHidden(subWrapper, subSelect, subReqStar, subHint);
            } else if (level === 'staf_spv') {
                setVisible(deptWrapper, deptSelect, deptReqStar, deptHint, true);
                setVisible(subWrapper, subSelect, subReqStar, subHint, true);
            } else {
                // Level belum dipilih: tampilkan dept (opsional), sembunyikan sub.
                setVisible(deptWrapper, deptSelect, deptReqStar, deptHint, false);
                setHidden(subWrapper, subSelect, subReqStar, subHint);
            }
        }

        // Ganti dept saat staf/spv → opsi sub di-reset sesuai dept baru.
        deptSelect.addEventListener('change', function () {
            fillSubOptions(this.value);
            if (!this.value) subSelect.value = '';
        });

        levelSelect.addEventListener('change', applyHierarchy);

        // Restore tampilan setelah validasi gagal (old input) atau data user existing.
        if (levelSelect.value) {
            applyHierarchy();
            const currentDept = deptSelect.value;
            if (currentDept) {
                fillSubOptions(currentDept);
                const currentSub = @json(old('sub_department', $user->sub_department));
                if (currentSub) subSelect.value = currentSub;
            }
        } else {
            applyHierarchy();
        }
    })();

    /* ===== Kirim OTP via AJAX + countdown 60 detik ===== */
    (function () {
        const btnSendOtp = document.getElementById('btnSendOtp');
        if (!btnSendOtp || btnSendOtp.dataset.otpBound) return;   // anti double-bind
        btnSendOtp.dataset.otpBound = '1';

        const btnIcon  = btnSendOtp.querySelector('i');
        const btnText  = document.getElementById('btnSendOtpText');
        const otpInput = document.getElementById('otp_code');
        const alertOk  = document.getElementById('otpAlertSuccess');
        const alertErr = document.getElementById('otpAlertError');
        const targetEmail = @json($user->email);
        const otpUrl      = @json(route('admin.users.send-otp', $user));
        const verifyUrl   = @json(route('admin.users.verify-otp', $user));
        const otpStatus   = document.getElementById('otpStatus');
        const otpMsgOk    = document.getElementById('otpValidateOk');
        const otpMsgErr   = document.getElementById('otpValidateErr');
        let countdownInterval = null;
        let verifyTimer  = null;
        let verifyAbort  = null;
        let otpValidated = false;

        function setButton(iconClass, text, disabled) {
            btnIcon.className = iconClass;
            btnText.textContent = text;
            btnSendOtp.disabled = disabled;
        }

        function showAlert(el, message) {
            [alertOk, alertErr].forEach(function (a) { a.classList.remove('show'); });
            if (el && message) {
                el.querySelector('span').textContent = message;
                el.classList.add('show');
            }
        }

        function startCountdown(seconds) {
            let remaining = seconds;
            btnSendOtp.disabled = true;
            btnIcon.className = 'fas fa-clock me-1';
            btnText.textContent = 'Kirim Ulang (' + remaining + 's)';
            countdownInterval = setInterval(function () {
                remaining--;
                if (remaining > 0) {
                    btnText.textContent = 'Kirim Ulang (' + remaining + 's)';
                } else {
                    clearInterval(countdownInterval);
                    countdownInterval = null;
                    setButton('fas fa-paper-plane me-1', 'Kirim Ulang Kode OTP', false);
                }
            }, 1000);
        }

        function resetValidation() {
            otpValidated = false;
            otpInput.classList.remove('is-valid', 'is-invalid');
            otpInput.readOnly = false;   // readonly, BUKAN disabled — nilai tetap ikut terkirim saat submit
            otpMsgOk.classList.remove('show');
            otpMsgErr.classList.remove('show');
            otpStatus.classList.remove('show');
        }

        // Auto-validate: begitu 6 digit terisi, kirim verifikasi instan ke server.
        if (otpInput) {
            otpInput.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '').slice(0, 6);
                this.classList.toggle('has-value', this.value.length > 0);

                // Pengguna mengetik lagi / mengubah isi → reset state validasi
                resetValidation();
                if (verifyTimer) { clearTimeout(verifyTimer); verifyTimer = null; }
                if (verifyAbort) { verifyAbort.abort(); verifyAbort = null; }

                if (this.value.length === 6) {
                    verifyTimer = setTimeout(autoVerify, 350);   // debounce 350ms
                }
            });
        }

        function autoVerify() {
            if (otpInput.value.length !== 6 || otpValidated) return;

            // Indikator loading kecil di dalam input
            otpStatus.querySelector('i').className = 'fas fa-spinner fa-spin';
            otpStatus.classList.add('show');
            otpInput.classList.remove('is-valid', 'is-invalid');
            otpMsgOk.classList.remove('show');
            otpMsgErr.classList.remove('show');

            verifyAbort = new AbortController();
            fetch(verifyUrl, {
                method: 'POST',
                signal: verifyAbort.signal,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ otp_code: otpInput.value })
            })
            .then(function (res) {
                return res.json().catch(function () {
                    throw new Error('Respons tidak valid dari server.');
                });
            })
            .then(function (data) {
                verifyAbort = null;
                if (otpInput.value.length !== 6) return;   // isi berubah di tengah request

                if (data.success) {
                    otpValidated = true;
                    otpStatus.querySelector('i').className = 'fas fa-circle-check';
                    otpInput.classList.add('is-valid');
                    otpMsgOk.classList.add('show');
                    otpInput.readOnly = true;              // kunci setelah valid — readonly agar nilai tetap terkirim saat submit
                } else {
                    otpStatus.querySelector('i').className = 'fas fa-circle-xmark';
                    otpInput.classList.add('is-invalid');
                    otpMsgErr.classList.add('show');
                }
            })
            .catch(function (err) {
                if (err && err.name === 'AbortError') return;   // dibatalkan pengguna mengetik
                verifyAbort = null;
                otpStatus.querySelector('i').className = 'fas fa-circle-xmark';
                otpInput.classList.add('is-invalid');
                otpMsgErr.textContent = 'Gagal memverifikasi. Periksa koneksi lalu ubah salah satu digit untuk mencoba lagi.';
                otpMsgErr.classList.add('show');
            });
        }

        // Simpan teks default pesan error agar bisa dipulihkan setelah error jaringan
        const defaultErrMsg = otpMsgErr.textContent;

        btnSendOtp.addEventListener('click', function () {
            if (btnSendOtp.disabled) return;
            showAlert(null);
            resetValidation();
            otpMsgErr.textContent = defaultErrMsg;
            setButton('fas fa-spinner fa-spin me-1', 'Mengirim...', true);

            fetch(otpUrl, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(function (res) {
                return res.json().catch(function () {
                    throw new Error('Respons tidak valid dari server (HTTP ' + res.status + ').');
                }).then(function (data) { return { ok: res.ok, data: data }; });
            })
            .then(function (result) {
                if (result.ok && result.data.success) {
                    showAlert(alertOk, 'Kode OTP berhasil dikirim ke ' + (result.data.email || targetEmail) + '. Berlaku 5 menit.');
                    startCountdown(60);
                } else {
                    setButton('fas fa-paper-plane me-1', 'Kirim Kode OTP', false);
                    showAlert(alertErr, (result.data && result.data.message) || 'Gagal mengirim OTP. Silakan coba lagi.');
                }
            })
            .catch(function (err) {
                setButton('fas fa-paper-plane me-1', 'Kirim Kode OTP', false);
                showAlert(alertErr, (err && err.message) ? err.message : 'Terjadi kesalahan jaringan. Silakan coba lagi.');
            });
        });
    })();

    /* ===== Submit form via AJAX + pop-up SweetAlert2 =====
       Sukses  → pop-up hijau (timer 1.5s) lalu redirect ke Detail Pengguna.
       Gagal   → pop-up merah + frame merah per field, TETAP di halaman edit. */
    (function () {
        const form = document.getElementById('formEditUser');
        if (!form || form.dataset.submitBound) return;   // anti double-bind
        form.dataset.submitBound = '1';

        /* ---- Inline field error helpers ---- */
        function clearFieldErrors() {
            form.querySelectorAll('.field-error').forEach(function (el) {
                el.classList.remove('field-error');
            });
            form.querySelectorAll('.inline-error').forEach(function (el) {
                el.remove();
            });
        }

        function clearOneFieldError(el) {
            if (!el || !el.name) return;
            el.classList.remove('field-error');
            const wrapper = el.closest('.input-icon, .password-wrapper, .otp-field') || el;
            const next = wrapper.nextElementSibling;
            if (next && next.classList && next.classList.contains('inline-error')) next.remove();
        }

        function showFieldError(input, message) {
            if (!input) return;
            input.classList.add('field-error');
            const wrapper = input.closest('.input-icon, .password-wrapper, .otp-field') || input;
            let msg = wrapper.nextElementSibling;
            if (!msg || !msg.classList || !msg.classList.contains('inline-error')) {
                msg = document.createElement('div');
                msg.className = 'inline-error';
                wrapper.parentNode.insertBefore(msg, wrapper.nextSibling);
            }
            msg.innerHTML = '<i class="fas fa-circle-exclamation"></i> ' + message;
        }

        // Render semua error validasi 422 ke field masing-masing + scroll ke field pertama
        function renderFieldErrors(errors) {
            clearFieldErrors();
            let firstInput = null;
            Object.keys(errors).forEach(function (name) {
                const message = Array.isArray(errors[name]) ? errors[name][0] : String(errors[name]);
                const input = form.querySelector('[name="' + name + '"]');
                showFieldError(input, message);
                if (name === 'password') {
                    // konfirmasi password ikut ditandai karena error 'confirmed'
                    const pc = form.querySelector('[name="password_confirmation"]');
                    if (pc) pc.classList.add('field-error');
                }
                if (!firstInput && input) firstInput = input;
            });
            if (firstInput) firstInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // AUTO CLEAR: begitu user mengetik/mengubah field yang error, frame merah
        // dan pesan di bawahnya hilang otomatis.
        ['input', 'change'].forEach(function (evt) {
            form.addEventListener(evt, function (e) {
                clearOneFieldError(e.target);
                if (e.target.name === 'password') {
                    clearOneFieldError(form.querySelector('[name="password_confirmation"]'));
                }
            });
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();   // cegah submit penuh — pakai AJAX

            const btn  = document.getElementById('btnSubmitUser');
            const icon = btn.querySelector('i');
            const origIcon = icon.className;
            btn.disabled = true;
            icon.className = 'fas fa-spinner fa-spin me-1';
            clearFieldErrors();   // bersihkan error submit sebelumnya

            const payload = new FormData(form);

            // Ambil pesan error pertama dari bentuk JSON validasi Laravel (422):
            // { message: ..., errors: { field: ["pesan"] } }
            function firstError(data) {
                if (data && data.errors) {
                    const first = Object.values(data.errors)[0];
                    if (Array.isArray(first) && first.length) return first[0];
                }
                return (data && data.message) || 'Periksa kembali data yang diisi.';
            }

            fetch(form.action, {
                method: 'POST',   // form punya @method('PUT') di field tersembunyi
                body: payload,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(function (res) {
                return res.json().catch(function () {
                    throw new Error('Terjadi kesalahan server (HTTP ' + res.status + ').');
                }).then(function (data) { return { ok: res.ok, status: res.status, data: data }; });
            })
            .then(function (result) {
                if (result.ok && result.data.success) {
                    // Sukses: pop-up hijau, otomatis hilang 1.5 detik, lalu redirect ke Detail Pengguna
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: result.data.message,
                        timer: 1500,
                        showConfirmButton: false,
                        timerProgressBar: true
                    }).then(function () {
                        window.location.href = result.data.redirect;
                    });
                } else {
                    // Gagal (validasi / OTP salah / role nonaktif): pop-up merah, tetap di halaman
                    btn.disabled = false;
                    icon.className = origIcon;

                    // Validasi 422 → tandai field yang salah dengan frame merah + pesan inline
                    if (result.status === 422 && result.data && result.data.errors) {
                        renderFieldErrors(result.data.errors);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal memperbarui data',
                            text: 'Silakan periksa kembali isian yang berwarna merah.',
                            confirmButtonText: 'Mengerti',
                            confirmButtonColor: '#dc2626'
                        });
                    } else {
                        // Error non-validasi (OTP salah, role nonaktif, dsb.)
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal menyimpan',
                            text: firstError(result.data),
                            confirmButtonText: 'Mengerti',
                            confirmButtonColor: '#dc2626'
                        });
                    }
                }
            })
            .catch(function (err) {
                btn.disabled = false;
                icon.className = origIcon;
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal menyimpan',
                    text: (err && err.message) ? err.message : 'Terjadi kesalahan jaringan. Silakan coba lagi.',
                    confirmButtonText: 'Mengerti',
                    confirmButtonColor: '#dc2626'
                });
            });
        });
    })();
</script>
@endsection
