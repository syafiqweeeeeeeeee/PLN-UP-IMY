@extends('layouts.admin')

@section('title', ($bidang ? 'Edit Bidang' : 'Tambah Bidang') . ' — E-PPID PLN')
@section('page-title', $bidang ? 'Edit Bidang' : 'Tambah Bidang')

@push('styles')
<style>
    /* MASTER BIDANG — form tambah/edit. Mengikuti Design System Form
       panel admin (form-topbar, form-section, form-input — global di
       admin.css); aturan di sini hanya khusus halaman ini. */
    .mb-parent-hint {
        font-size: 0.72rem; color: #9ca3af; margin-top: 0.3rem;
    }
    .mb-error {
        background: #fef2f2; border: 1px solid #fecaca; color: #dc2626;
        border-radius: 12px; padding: 0.75rem 1rem; margin-bottom: 1rem;
        font-size: 0.8rem; font-weight: 500;
    }
    .mb-error ul { margin: 0.3rem 0 0; padding-left: 1.1rem; }
</style>
@endpush

@section('content')
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.master_bidang.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">{{ $bidang ? 'Edit Bidang' : 'Tambah Bidang Baru' }}</h4>
            <p class="form-page-subtitle">
                {{ $bidang ? 'Perbarui nama atau posisi bidang dalam hierarki' : 'Buat bidang baru — boleh tingkat atas atau sub-bidang' }}
            </p>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="mb-error" role="alert">
    <i class="fas fa-circle-exclamation"></i>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ $bidang ? route('admin.master_bidang.update', $bidang) : route('admin.master_bidang.store') }}" method="POST">
    @csrf
    @if ($bidang)
        @method('PUT')
    @endif

    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon blue">
                <i class="fas fa-sitemap"></i>
            </div>
            <div>
                <h6 class="form-section-title">Informasi Bidang</h6>
                <p class="form-section-desc">Nama bidang dan induknya dalam hierarki</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label" for="nama">
                Nama Bidang <span class="required" style="color:#dc2626;">*</span>
            </label>
            <input type="text"
                   id="nama"
                   name="nama"
                   value="{{ old('nama', $bidang?->nama) }}"
                   class="form-input @error('nama') is-invalid @enderror"
                   placeholder="Contoh: Teknik Pembangkitan"
                   maxlength="100" required>
            @error('nama')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-group-label" for="parent_id">
                Parent (Induk Bidang) <span style="color:#9ca3af; font-weight:500;">(opsional)</span>
            </label>
            <select id="parent_id" name="parent_id" class="form-input @error('parent_id') is-invalid @enderror">
                <option value="">— Tingkat atas (tanpa induk) —</option>
                @foreach ($parents as $row)
                    <option value="{{ $row['node']->id }}"
                        @selected((string) old('parent_id', $bidang?->parent_id) === (string) $row['node']->id)>
                        {{ str_repeat("\u{00A0}\u{00A0}\u{00A0}", $row['depth']) }}{{ $row['depth'] > 0 ? '└ ' : '' }}{{ $row['node']->nama }}
                    </option>
                @endforeach
            </select>
            @error('parent_id')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
            <div class="mb-parent-hint">
                Kosongkan untuk bidang tingkat atas. Pilihan yang berupa keturunan bidang ini
                (termasuk bidang itu sendiri) tidak ditampilkan agar hierarki tidak bersiklus.
            </div>
        </div>
    </div>

    <div class="form-footer">
        <div class="form-footer-info">
            <i class="fas fa-circle-info"></i>
            Field bertanda <b>*</b> wajib diisi.
        </div>
        <div class="form-footer-actions">
            <a href="{{ route('admin.master_bidang.index') }}" class="btn-corp btn-corp-soft">Batal</a>
            <button type="submit" class="form-btn-save">
                <i class="fas fa-check me-1"></i> {{ $bidang ? 'Simpan Perubahan' : 'Simpan Bidang' }}
            </button>
        </div>
    </div>
</form>
@endsection
