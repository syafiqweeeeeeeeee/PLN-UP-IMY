@extends('layouts.admin')

@section('title', 'Tambah Role — E-PPID PLN')
@section('page-title', 'Tambah Role')

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
                        <h5 class="dash-card-title">Tambah Role Baru</h5>
                        <p class="dash-card-subtitle">Buat role baru untuk pengaturan hak akses pengguna</p>
                    </div>
                    <a href="{{ route('admin.roles.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>

            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="name">Nama Role <span class="text-danger">*</span></label>
                        <div class="input-icon">
                            <i class="fas fa-tag icon"></i>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autocomplete="organization" placeholder="Contoh: Supervisor, Editor, dll." maxlength="100">
                        </div>
                        <p class="help-text">Wajib diisi, maksimal 100 karakter, harus unik.</p>
                        @error('name')
                            <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="description">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control" rows="2" maxlength="255" placeholder="Deskripsi singkat tentang role ini...">{{ old('description') }}</textarea>
                        <p class="help-text">Opsional. Maksimal 255 karakter.</p>
                        @error('description')
                            <div class="error-text"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label" style="display:block; margin-bottom:0.75rem;">Status <span class="text-danger">*</span></label>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="status-card {{ old('status') === 'active' ? 'active' : '' }}">
                                    <input type="radio" name="status" value="active" {{ old('status') === 'active' ? 'checked' : '' }}>
                                    <div class="status-icon"><i class="fas fa-check-circle"></i></div>
                                    <div class="status-title">Aktif</div>
                                    <p class="status-desc">Role dapat digunakan untuk login & akses</p>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="status-card {{ old('status') === 'inactive' ? 'active' : '' }}">
                                    <input type="radio" name="status" value="inactive" {{ old('status') === 'inactive' ? 'checked' : '' }}>
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
                        <i class="fas fa-save me-1"></i> Simpan Role
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
