@extends('layouts.admin')

@section('title', 'Edit Role — E-PPID PLN')
@section('page-title', 'Edit Role')

@push('styles')
<style>
    .form-label {
        font-weight:600;
        font-size:0.85rem;
        color:#374151;
        margin-bottom:0.4rem;
    }
    .form-control, .form-select {
        border:1px solid #e5e7eb;
        border-radius:8px;
        padding:0.65rem 0.9rem;
        font-size:0.875rem;
        transition:all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color:var(--pln-blue);
        box-shadow:0 0 0 3px rgba(0,91,156,0.1);
        outline:none;
    }
    .input-icon { position:relative; }
    .input-icon .icon {
        position:absolute;
        left:12px;
        top:50%;
        transform:translateY(-50%);
        color:#9ca3af;
        font-size:0.85rem;
    }
    .input-icon .form-control { padding-left:2rem; }
    .help-text { font-size:0.78rem; color:#9ca3af; margin-top:0.25rem; }
    .error-text { font-size:0.78rem; color:#dc2626; margin-top:0.25rem; }
    .status-card {
        border:2px solid #e5e7eb;
        border-radius:10px;
        padding:1rem 1.25rem;
        cursor:pointer;
        transition:all 0.2s ease;
        background:#fff;
    }
    .status-card:hover { border-color:#d1d5db; background:#f9fafb; }
    .status-card.active { border-color:var(--pln-blue); background:#eff6ff; }
    .status-card input { position:absolute; opacity:0; cursor:pointer; }
    .status-card .status-icon {
        width:44px; height:44px;
        border-radius:10px;
        display:flex; align-items:center; justify-content:center;
        font-size:1.25rem; margin-bottom:0.75rem;
    }
    .status-card .status-title { font-weight:600; font-size:0.95rem; margin-bottom:0.25rem; }
    .status-card .status-desc { font-size:0.8rem; color:#6b7280; margin:0; }
    .status-card.status-active .status-icon { background:#dcfce7; color:#166534; }
    .status-card.status-active .status-title { color:#166534; }
    .status-card.status-inactive .status-icon { background:#fef3c7; color:#92400e; }
    .status-card.status-inactive .status-title { color:#92400e; }
    .info-item {
        background:#f9fafb; border-radius:8px; padding:0.75rem 1rem; border:1px solid #f3f4f6;
    }
    .info-label { font-size:0.75rem; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; }
    .info-value { font-weight:600; color:#1f2937; font-size:0.9rem; }
    .badge-role {
        font-size:0.75rem; padding:0.3rem 0.7rem; border-radius:20px; font-weight:600;
    }
    .badge-role-active { background:#dcfce7; color:#166534; }
    .badge-role-inactive { background:#fef3c7; color:#92400e; }
    .btn-back {
        background:#f3f4f6; color:#6b7280; border:none; border-radius:8px;
        padding:0.6rem 1.2rem; font-weight:500; transition:all 0.2s ease;
    }
    .btn-back:hover { background:#e5e7eb; color:#374151; }
    .btn-submit {
        background:var(--pln-yellow); color:var(--pln-blue); border:none; border-radius:8px;
        padding:0.65rem 1.5rem; font-weight:700; font-size:0.9rem; transition:all 0.2s ease;
    }
    .btn-submit:hover { background:#fff; box-shadow:0 4px 12px rgba(255,230,0,0.4); transform:translateY(-1px); }
</style>
@endpush

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="dash-card">
            <div class="dash-card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="dash-card-title">Edit Role</h5>
                        <p class="dash-card-subtitle">Perbarui informasi role ini</p>
                    </div>
                    <a href="{{ route('admin.roles.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="row g-2 mb-4">
                <div class="col-md-4">
                    <div class="info-item">
                        <div class="info-label">Nama Role</div>
                        <div class="info-value">{{ $role->name }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-item">
                        <div class="info-label">Deskripsi</div>
                        <div class="info-value" style="color:#6b7280; font-weight:400; font-size:0.8rem;">
                            {{ $role->description ?? '-' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-item d-flex justify-content-between align-items-center">
                        <div>
                            <div class="info-label">Status</div>
                            <span class="badge-role {{ $role->status ? 'badge-role-active' : 'badge-role-inactive' }}">
                                {{ $role->status ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="name">Nama Role <span class="text-danger">*</span></label>
                        <div class="input-icon">
                            <i class="fas fa-tag icon"></i>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $role->name) }}" required autocomplete="organization" maxlength="100">
                        </div>
                        <p class="help-text">Wajib diisi, maksimal 100 karakter, harus unik.</p>
                        @error('name')
                            <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="description">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control" rows="2" maxlength="255">{{ old('description', $role->description) }}</textarea>
                        <p class="help-text">Opsional. Maksimal 255 karakter.</p>
                        @error('description')
                            <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label" style="display:block; margin-bottom:0.75rem;">Status <span class="text-danger">*</span></label>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="status-card {{ old('status', $role->status ? 'active' : 'inactive') === 'active' ? 'active' : '' }}">
                                    <input type="radio" name="status" value="active" {{ old('status', $role->status ? 'active' : 'inactive') === 'active' ? 'checked' : '' }}>
                                    <div class="status-icon"><i class="fas fa-check-circle"></i></div>
                                    <div class="status-title">Aktif</div>
                                    <p class="status-desc">Role dapat digunakan untuk login & akses</p>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="status-card {{ old('status', $role->status ? 'active' : 'inactive') === 'inactive' ? 'active' : '' }}">
                                    <input type="radio" name="status" value="inactive" {{ old('status', $role->status ? 'active' : 'inactive') === 'inactive' ? 'checked' : '' }}>
                                    <div class="status-icon"><i class="fas fa-pause-circle"></i></div>
                                    <div class="status-title">Nonaktif</div>
                                    <p class="status-desc">Role tidak dapat digunakan saat ini</p>
                                </label>
                            </div>
                        </div>
                        @error('status')
                            <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4 pt-3" style="border-top:1px solid #f3f4f6;">
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
@endpush
