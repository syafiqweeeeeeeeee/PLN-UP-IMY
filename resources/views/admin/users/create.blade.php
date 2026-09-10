@extends('layouts.admin')

@section('title', 'Tambah Pengguna — E-PPID PLN')
@section('page-title', 'Tambah Pengguna')

@push('styles')
<style>
    .form-label { font-weight: 600; font-size: 0.85rem; color: #374151; margin-bottom: 0.4rem; }
    .form-control, .form-select {
        border: 1px solid #e5e7eb; border-radius: 8px;
        padding: 0.65rem 0.9rem; font-size: 0.875rem; transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--pln-blue); box-shadow: 0 0 0 3px rgba(0,91,156,0.1); outline: none;
    }
    .input-icon { position: relative; }
    .input-icon .icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 0.85rem; }
    .input-icon .form-control { padding-left: 2rem; }
    .password-wrapper { position: relative; }
    .password-toggle {
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        background: none; border: none; color: #9ca3af; cursor: pointer; padding: 0;
    }
    .password-toggle:hover { color: var(--pln-blue); }
    .password-strength { height: 4px; border-radius: 2px; margin-top: 0.5rem; width: 0%; background: #e5e7eb; }
    .strength-text { font-size: 0.75rem; margin-top: 0.25rem; }
    .help-text { font-size: 0.78rem; color: #9ca3af; margin-top: 0.25rem; }
    .error-text { font-size: 0.78rem; color: #dc2626; margin-top: 0.25rem; }
    .btn-back { background: #f3f4f6; color: #6b7280; border: none; border-radius: 8px; padding: 0.6rem 1.2rem; font-weight: 500; }
    .btn-back:hover { background: #e5e7eb; color: #374151; }
    .btn-submit { background: var(--pln-yellow); color: var(--pln-blue); border: none; border-radius: 8px; padding: 0.65rem 1.5rem; font-weight: 700; font-size: 0.9rem; }
    .btn-submit:hover { background: #fff; }
</style>
@endpush

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="dash-card">
            <div class="dash-card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="dash-card-title">Tambah Pengguna Baru</h5>
                        <p class="dash-card-subtitle">Isi formulir di bawah untuk mendaftarkan pengguna baru</p>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="name">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="input-icon">
                            <i class="fas fa-user icon"></i>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autocomplete="name">
                        </div>
                        @error('name') <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        <div class="input-icon">
                            <i class="fas fa-envelope icon"></i>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="email" placeholder="email@contoh.com">
                        </div>
                        @error('email') <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password" placeholder="Min. 8 karakter">
                            <button type="button" class="password-toggle" onclick="togglePassword('password', this)"><i class="fas fa-eye"></i></button>
                        </div>
                        <div id="passwordStrength" class="password-strength"></div>
                        <div id="strengthText" class="strength-text"></div>
                        @error('password') <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                        <div class="password-wrapper">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password">
                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="role_id">Role Pengguna <span class="text-danger">*</span></label>
                        <select id="role_id" name="role_id" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }} {{ $role->status ? '' : '(Nonaktif)' }}
                                </option>
                            @endforeach
                        </select>
                        <p class="help-text">Pilih role aktif. Role nonaktif tidak dapat digunakan.</p>
                        @error('role_id') <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="no_hp">No. Telepon</label>
                        <div class="input-icon">
                            <i class="fas fa-phone icon"></i>
                            <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder="081234567890">
                        </div>
                        <p class="help-text">Isi jika diperlukan untuk kontak</p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap pengguna...">{{ old('alamat') }}</textarea>
                        <p class="help-text">Isi jika diperlukan</p>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #d66565;">
                    <button type="button" class="btn-back" onclick="history.back()"><i class="fas fa-times me-1"></i> Batal</button>
                    <button type="submit" class="btn-submit"><i class="fas fa-save me-1"></i> Tambah Pengguna</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePassword(fieldId, btn) {
        const field = document.getElementById(fieldId);
        const icon = btn.querySelector('i');
        if (field.type === 'password') { field.type = 'text'; icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); }
        else { field.type = 'password'; icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); }
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
@endpush
