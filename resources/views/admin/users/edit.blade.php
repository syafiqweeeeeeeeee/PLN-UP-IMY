@extends('layouts.admin')

@section('title', 'Edit Pengguna — E-PPID PLN')
@section('page-title', 'Edit Pengguna')

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
    .help-text { font-size: 0.78rem; color: #9ca3af; margin-top: 0.25rem; }
    .error-text { font-size: 0.78rem; color: #dc2626; margin-top: 0.25rem; }
    .info-item { background: #f9fafb; border-radius: 8px; padding: 0.75rem 1rem; border: 1px solid #f3f4f6; }
    .info-label { font-size: 0.75rem; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; }
    .info-value { font-weight: 600; color: #1f2937; font-size: 0.9rem; }
    .btn-back { background: #f3f4f6; color: #6b7280; border: none; border-radius: 8px; padding: 0.6rem 1.2rem; font-weight: 500; }
    .btn-back:hover { background: #e5e7eb; color: #374151; }
    .btn-submit { background: var(--pln-yellow); color: var(--pln-blue); border: none; border-radius: 8px; padding: 0.65rem 1.5rem; font-weight: 700; font-size: 0.9rem; }
    .btn-submit:hover { background: #fff; }
    .role-badge { font-size: 0.7rem; padding: 0.25rem 0.6rem; border-radius: 20px; font-weight: 600; text-transform: uppercase; }
    .role-badge-active { background: #dcfce7; color: #166534; }
    .role-badge-inactive { background: #fef3c7; color: #92400e; }
</style>
@endpush

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="dash-card">
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

            <div class="row g-2 mb-4">
                <div class="col-md-4">
                    <div class="info-item d-flex align-items-center gap-3">
                        <div class="avatar-placeholder" style="width:44px;height:44px;background:linear-gradient(135deg,var(--pln-blue),var(--pln-cyan));color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:1rem;flex-shrink:0;">
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
            </div>

            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="name">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="input-icon">
                            <i class="fas fa-user icon"></i>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autocomplete="name">
                        </div>
                        @error('name') <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        <div class="input-icon">
                            <i class="fas fa-envelope icon"></i>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="email">
                        </div>
                        @error('email') <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="password">Password Baru</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" placeholder="Kosongkan jika tidak ingin mengubah">
                            <button type="button" class="password-toggle" onclick="togglePassword('password', this)"><i class="fas fa-eye"></i></button>
                        </div>
                        <p class="help-text">Biarkan kosong jika tidak ingin mengubah password</p>
                        @error('password') <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
                        <div class="password-wrapper">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password">
                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="role_id">Role Pengguna <span class="text-danger">*</span></label>
                        <select id="role_id" name="role_id" class="form-select" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
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
                            <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp', $user->no_hp) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="2">{{ old('alamat', $user->alamat) }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #f3f4f6;">
                    <button type="button" class="btn-back" onclick="history.back()"><i class="fas fa-times me-1"></i> Batal</button>
                    <button type="submit" class="btn-submit"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
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
</script>
@endpush
