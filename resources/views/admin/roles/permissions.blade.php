@extends('layouts.admin')

@section('title', 'Kelola Permission — ' . ($role->name ?? 'Role') . ' — E-PPID PLN')
@section('page-title', 'Kelola Permission')

@push('styles')
<style>
    .permission-card {
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:12px;
        overflow:hidden;
    }
    .permission-card-header {
        background:#f8fafc;
        border-bottom:1px solid #e5e7eb;
        padding:1rem 1.25rem;
    }
    .permission-card-title {
        font-weight:600;
        font-size:0.9rem;
        color:#374151;
        margin:0;
    }
    .permission-card-body { padding:0.5rem 0; }
    .permission-item {
        display:flex;
        align-items:center;
        gap:0.75rem;
        padding:0.55rem 1.25rem;
        transition:background 0.15s ease;
    }
    .permission-item:hover { background:#f9fafb; }
    .permission-item input[type="checkbox"] {
        width:1rem;
        height:1rem;
        border-radius:4px;
        border:1px solid #d1d5db;
        accent-color:var(--pln-blue);
        cursor:pointer;
    }
    .permission-label {
        font-size:0.85rem;
        color:#374151;
    }
    .permission-desc {
        font-size:0.72rem;
        color:#9ca3af;
        margin-left:auto;
    }
    .permission-section {
        border-left:3px solid var(--pln-blue);
        padding-left:1rem;
        margin-bottom:1.5rem;
    }
    .permission-section-title {
        font-size:0.72rem;
        font-weight:700;
        text-transform:uppercase;
        letter-spacing:0.5px;
        color:#6b7280;
        margin-bottom:0.5rem;
    }
    .btn-permission {
        background:var(--pln-yellow);
        color:var(--pln-blue);
        border:none;
        border-radius:8px;
        padding:0.6rem 1.2rem;
        font-weight:700;
        transition:all 0.2s ease;
    }
    .btn-permission:hover { background:#fff; }
    .btn-permission-outline {
        background:#f3f4f6;
        color:#374151;
        border:1px solid #e5e7eb;
        border-radius:8px;
        padding:0.55rem 1rem;
        font-weight:500;
        font-size:0.85rem;
    }
    .btn-permission-outline:hover { background:#e5e7eb; }
    .status-badge-role {
        font-size:0.7rem;
        padding:0.25rem 0.6rem;
        border-radius:20px;
        font-weight:600;
        text-transform:uppercase;
    }
    .status-badge-role.active { background:#dcfce7; color:#166534; }
    .status-badge-role.inactive { background:#fef3c7; color:#92400e; }
</style>
@endpush

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="dash-card">
            <div class="dash-card-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div>
                        <h5 class="dash-card-title">Kelola Permission</h5>
                        <p class="dash-card-subtitle">Tentukan permission untuk role <strong>{{ $role->name }}</strong></p>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge {{ $role->status ? 'status-badge-role active' : 'status-badge-role inactive' }}">
                            {{ $role->status ? 'Aktif' : 'Nonaktif' }}
                        </span>
                        <a href="{{ route('admin.roles.index') }}" class="btn-permission-outline" style="display:inline-flex; align-items:center; gap:0.4rem;">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-3">
                @if (session('success'))
                <div class="alert alert-success d-flex align-items-center gap-2" style="border-radius:8px; border:none; background:#dcfce7; color:#166534; font-size:0.85rem; margin-bottom:1rem;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
                @endif

                <div class="row g-2 mb-3">
                    <div class="col-auto">
                        <button type="button" id="selectAllBtn" class="btn-permission-outline" style="display:inline-flex; align-items:center; gap:0.4rem;">
                            <i class="fas fa-check-double"></i> Pilih Semua
                        </button>
                    </div>
                    <div class="col-auto">
                        <button type="button" id="clearAllBtn" class="btn-permission-outline" style="display:inline-flex; align-items:center; gap:0.4rem;">
                            <i class="fas fa-times"></i> Hapus Semua
                        </button>
                    </div>
                    <div class="col-auto ms-auto">
                        <form action="{{ route('admin.roles.permissions', $role) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn-permission" style="display:inline-flex; align-items:center; gap:0.4rem;">
                                <i class="fas fa-save"></i> Simpan Permission
                            </button>
                        </form>
                    </div>
                </div>

                <div class="permission-card">
                    <div class="permission-card-body">
                        @foreach ($grouped as $module => $permissions)
                        <div class="permission-section">
                            <div class="permission-section-title">{{ $module }}</div>
                            @foreach ($permissions as $permission)
                            <div class="permission-item">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                       id="perm-{{ $permission->id }}"
                                       {{ in_array($permission->id, $role->permission_ids) ? 'checked' : '' }}>
                                <label for="perm-{{ $permission->id }}" class="permission-label">{{ $permission->display_name ?? str_replace('.', ' ', ucfirst($permission->name)) }}</label>
                            </div>
                            @endforeach
                        </div>
                        @endforeach

                        @if ($grouped->isEmpty())
                        <div style="padding:2rem; text-align:center; color:#9ca3af;">
                            <i class="fas fa-lock" style="font-size:2rem; margin-bottom:0.75rem; display:block;"></i>
                            <strong>Belum ada permission</strong>
                            <p style="font-size:0.85rem; margin-top:0.5rem;">Buat permission terlebih dahulu melalui seeder atau admin.</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="mt-3 pt-3" style="border-top:1px solid #f3f4f6;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted" style="font-size:0.8rem;">
                            <i class="fas fa-info-circle me-1"></i> Tandai permission yang diinginkan, lalu klik "Simpan Permission".
                        </div>
                        <div class="text-muted" style="font-size:0.8rem;">
                            {{ $role->permissions()->count() }} permission tersimpan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
        const selectAllBtn = document.getElementById('selectAllBtn');
        const clearAllBtn = document.getElementById('clearAllBtn');

        function updateSelectAllState() {
            const checked = Array.from(checkboxes).filter(cb => cb.checked).length;
            if (checked === 0) {
                selectAllBtn.innerHTML = '<i class="fas fa-check-double"></i> Pilih Semua';
            } else if (checked === checkboxes.length) {
                selectAllBtn.innerHTML = '<i class="fas fa-check-double"></i> Semua Dipilih';
            } else {
                selectAllBtn.innerHTML = `<i class="fas fa-check-double"></i> Pilih (${checked}/${checkboxes.length})`;
            }
        }

        selectAllBtn?.addEventListener('click', function () {
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            checkboxes.forEach(cb => cb.checked = !allChecked);
            updateSelectAllState();
        });

        clearAllBtn?.addEventListener('click', function () {
            checkboxes.forEach(cb => cb.checked = false);
            updateSelectAllState();
        });

        checkboxes.forEach(cb => cb.addEventListener('change', updateSelectAllState));
        updateSelectAllState();
    })();
</script>
@endpush
