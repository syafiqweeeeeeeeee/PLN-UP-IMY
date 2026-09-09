@extends('layouts.admin')

@section('title', 'Edit Pengguna — E-PPID PLN')
@section('page-title', 'Edit Pengguna')

@push('styles')
<style>
    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #374151;
        margin-bottom: 0.4rem;
    }
    .form-control, .form-select {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.65rem 0.9rem;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0, 91, 156, 0.1);
        outline: none;
    }
    .input-icon {
        position: relative;
    }
    .input-icon .icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 0.85rem;
    }
    .input-icon .form-control {
        padding-left: 2rem;
    }
    .password-wrapper {
        position: relative;
    }
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
    .password-toggle:hover {
        color: var(--pln-blue);
    }
    .password-strength {
        height: 4px;
        border-radius: 2px;
        margin-top: 0.5rem;
        transition: width 0.3s ease, background 0.3s ease;
        width: 0%;
    }
    .strength-text {
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }
    .help-text {
        font-size: 0.78rem;
        color: #9ca3af;
        margin-top: 0.25rem;
    }
    .error-text {
        font-size: 0.78rem;
        color: #dc2626;
        margin-top: 0.25rem;
    }
    .role-card {
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #fff;
    }
    .role-card:hover {
        border-color: #d1d5db;
        background: #f9fafb;
    }
    .role-card.active {
        border-color: var(--pln-blue);
        background: #eff6ff;
    }
    .role-card input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }
    .role-card .role-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
    }
    .role-card .role-title {
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 0.25rem;
    }
    .role-card .role-desc {
        font-size: 0.8rem;
        color: #6b7280;
        margin: 0;
    }
    .btn-back {
        background: #f3f4f6;
        color: #6b7280;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .btn-back:hover {
        background: #e5e7eb;
        color: #374151;
    }
    .btn-submit {
        background: var(--pln-yellow);
        color: var(--pln-blue);
        border: none;
        border-radius: 8px;
        padding: 0.65rem 1.5rem;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    .btn-submit:hover {
        background: #fff;
        box-shadow: 0 4px 12px rgba(255, 230, 0, 0.4);
        transform: translateY(-1px);
    }
    .info-item {
        background: #f9fafb;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid #f3f4f6;
    }
    .info-label {
        font-size: 0.75rem;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .info-value {
        font-weight: 600;
        color: #1f2937;
        font-size: 0.9rem;
    }
</style>
@endpush

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="dash-card">
            {{-- Header --}}
            <div class="dash-card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="dash-card-title">Edit Pengguna</h5>
                        <p class="dash-card-subtitle">Perbarui informasi pengguna ini</p>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>

            {{-- Info Pengguna --}}
            <div class="row g-2 mb-4">
                <div class="col-md-4">
                    <div class="info-item d-flex align-items-center gap-3">
                        <div class="avatar-placeholder" style="width: 44px; height: 44px; background: linear-gradient(135deg, var(--pln-blue), var(--pln-cyan)); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 1rem; flex-shrink: 0;">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div>
                            <div class="info-label">Nama</div>
                            <div class="info-value">{{ $user->name }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-item d-flex justify-content-between align-items-center">
                        <div>
                            <div class="info-label">Role</div>
                            <span class="role-badge role-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Edit --}}
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-3">
                    {{-- Nama --}}
                    <div class="col-md-6">
                        <label class="form-label" for="name">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="input-icon">
                            <i class="fas fa-user icon"></i>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autocomplete="name">
                        </div>
                        @error('name')
                            <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        <div class="input-icon">
                            <i class="fas fa-envelope icon"></i>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="email">
                        </div>
                        @error('email')
                            <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password Baru (Opsional) --}}
                    <div class="col-md-6">
                        <label class="form-label" for="password">Password Baru</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" placeholder="Kosongkan jika tidak ingin mengubah">
                            <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <p class="help-text">Biarkan kosong jika tidak ingin mengubah password</p>
                        @error('password')
                            <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="col-md-6">
                        <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
                        <div class="password-wrapper">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password">
                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Role --}}
                    <div class="col-12">
                        <label class="form-label" style="display: block; margin-bottom: 0.75rem;">Role Pengguna <span class="text-danger">*</span></label>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <label class="role-card {{ old('role', $user->role) === 'admin' ? 'active' : '' }}">
                                    <input type="radio" name="role" value="admin" {{ old('role', $user->role) === 'admin' ? 'checked' : '' }}>
                                    <div class="role-icon" style="background: #fee2e2; color: #b91c1c;">
                                        <i class="fas fa-shield-halved"></i>
                                    </div>
                                    <div class="role-title" style="color: #b91c1c;">Admin</div>
                                    <p class="role-desc">Akses penuh sistem</p>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="role-card {{ old('role', $user->role) === 'petugas' ? 'active' : '' }}">
                                    <input type="radio" name="role" value="petugas" {{ old('role', $user->role) === 'petugas' ? 'checked' : '' }}>
                                    <div class="role-icon" style="background: #fef3c7; color: #92400e;">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div class="role-title" style="color: #92400e;">Petugas</div>
                                    <p class="role-desc">Petugas operasional</p>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="role-card {{ old('role', $user->role) === 'user' ? 'active' : '' }}">
                                    <input type="radio" name="role" value="user" {{ old('role', $user->role) === 'user' ? 'checked' : '' }}>
                                    <div class="role-icon" style="background: #dbeafe; color: #1d4ed8;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="role-title" style="color: #1d4ed8;">User</div>
                                    <p class="role-desc">Pengguna biasa</p>
                                </label>
                            </div>
                        </div>
                        @error('role')
                            <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- No HP --}}
                    <div class="col-md-6">
                        <label class="form-label" for="no_hp">No. Telepon</label>
                        <div class="input-icon">
                            <i class="fas fa-phone icon"></i>
                            <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp', $user->no_hp) }}">
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="col-md-6">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="2">{{ old('alamat', $user->alamat) }}</textarea>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #f3f4f6;">
                    <button type="button" class="btn-back" onclick="history.back()">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Toggle password visibility
    function togglePassword(fieldId, btn) {
        const field = document.getElementById(fieldId);
        const icon = btn.querySelector('i');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Select role card
    document.querySelectorAll('.role-card').forEach(card => {
        card.addEventListener('click', function() {
            this.classList.add('active');
            this.querySelector('input[type="radio"]').checked = true;
            document.querySelectorAll('.role-card').forEach(c => {
                if (c !== this) c.classList.remove('active');
            });
        });
    });
</script>
@endpush
