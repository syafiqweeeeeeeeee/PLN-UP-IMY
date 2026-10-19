@extends('layouts.admin')

@section('title', ($jabatan ? 'Edit Jabatan' : 'Tambah Jabatan') . ' — E-PPID PLN')
@section('page-title', $jabatan ? 'Edit Jabatan' : 'Tambah Jabatan')

@push('styles')
<style>
    /* MASTER JABATAN — form tambah/edit: pilihan bidang + parent
       jabatan berlabel hierarki. Mengikuti Design System Form panel
       admin (global di admin.css). */
    .mj-parent-hint {
        font-size: 0.72rem; color: #9ca3af; margin-top: 0.3rem;
    }
    .mj-error {
        background: #fef2f2; border: 1px solid #fecaca; color: #dc2626;
        border-radius: 12px; padding: 0.75rem 1rem; margin-bottom: 1rem;
        font-size: 0.8rem; font-weight: 500;
    }
    .mj-error ul { margin: 0.3rem 0 0; padding-left: 1.1rem; }
    .mj-bidang-empty-warn {
        background: #fffbeb; border: 1px solid #fde68a; color: #92400e;
        border-radius: 12px; padding: 0.75rem 1rem; margin-bottom: 1rem;
        font-size: 0.8rem; font-weight: 500;
    }
</style>
@endpush

@section('content')
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.master_jabatan.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">{{ $jabatan ? 'Edit Jabatan' : 'Tambah Jabatan Baru' }}</h4>
            <p class="form-page-subtitle">
                {{ $jabatan ? 'Perbarui nama, bidang, atau posisi jabatan dalam hierarki' : 'Buat jabatan baru — pilih bidangnya dan opsional induk jabatan' }}
            </p>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="mj-error" role="alert">
    <i class="fas fa-circle-exclamation"></i>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if ($bidangs->isEmpty())
<div class="mj-bidang-empty-warn" role="alert">
    <i class="fas fa-triangle-exclamation"></i>
    Belum ada data bidang. Tambahkan <b>Master Bidang</b> terlebih dahulu — setiap jabatan wajib berada di bawah satu bidang.
    <a href="{{ route('admin.master_bidang.index') }}" style="font-weight:700; color:#92400e;">Buka Master Bidang →</a>
</div>
@endif

<form action="{{ $jabatan ? route('admin.master_jabatan.update', $jabatan) : route('admin.master_jabatan.store') }}" method="POST">
    @csrf
    @if ($jabatan)
        @method('PUT')
    @endif

    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon blue">
                <i class="fas fa-user-tie"></i>
            </div>
            <div>
                <h6 class="form-section-title">Informasi Jabatan</h6>
                <p class="form-section-desc">Nama jabatan, bidangnya, dan induk jabatannya</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label" for="nama">
                Nama Jabatan <span style="color:#dc2626;">*</span>
            </label>
            <input type="text"
                   id="nama"
                   name="nama"
                   value="{{ old('nama', $jabatan?->nama) }}"
                   class="form-input @error('nama') is-invalid @enderror"
                   placeholder="Contoh: Manajer UP Indramayu"
                   maxlength="100" required>
            @error('nama')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-group-label" for="bidang_id">
                Bidang <span style="color:#dc2626;">*</span>
            </label>
            <select id="bidang_id" name="bidang_id" class="form-input @error('bidang_id') is-invalid @enderror" required>
                <option value="">— Pilih bidang tempat jabatan ini berada —</option>
                @foreach ($bidangs as $bidang)
                    <option value="{{ $bidang->id }}"
                        @selected((string) old('bidang_id', $jabatan?->bidang_id) === (string) $bidang->id)>
                        {{ $bidang->nama }}{{ $bidang->parent_id ? ' (sub-bidang)' : '' }}
                    </option>
                @endforeach
            </select>
            @error('bidang_id')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
            <div class="mj-parent-hint">Daftar bidang dari Master Bidang — pilih salah satu.</div>
        </div>

        <div class="form-group">
            <label class="form-group-label" for="parent_id">
                Parent (Induk Jabatan) <span style="color:#9ca3af; font-weight:500;">(opsional)</span>
            </label>
            <select id="parent_id" name="parent_id" class="form-input @error('parent_id') is-invalid @enderror">
                <option value="">— Tingkat atas (tanpa induk jabatan) —</option>
                @foreach ($parents as $row)
                    @php $parentJabatan = $row['node']; @endphp
                    <option value="{{ $parentJabatan->id }}"
                        @selected((string) old('parent_id', $jabatan?->parent_id) === (string) $parentJabatan->id)>
                        {{ str_repeat("\u{00A0}\u{00A0}\u{00A0}", $row['depth']) }}{{ $row['depth'] > 0 ? '└ ' : '' }}{{ $parentJabatan->nama }}{{ $parentJabatan->bidang ? ' — bidang: ' . $parentJabatan->bidang->nama : '' }}
                    </option>
                @endforeach
            </select>
            @error('parent_id')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
            <div class="mj-parent-hint">
                Induk jabatan hanya boleh jabatan lain (bukan bidang). Pilihan yang berupa keturunan
                jabatan ini (termasuk jabatan itu sendiri) tidak ditampilkan agar hierarki tidak bersiklus.
            </div>
        </div>
    </div>

    <div class="form-footer">
        <div class="form-footer-info">
            <i class="fas fa-circle-info"></i>
            Field bertanda <b>*</b> wajib diisi.
        </div>
        <div class="form-footer-actions">
            <a href="{{ route('admin.master_jabatan.index') }}" class="btn-corp btn-corp-soft">Batal</a>
            <button type="submit" class="form-btn-save" @if ($bidangs->isEmpty()) disabled @endif>
                <i class="fas fa-check me-1"></i> {{ $jabatan ? 'Simpan Perubahan' : 'Simpan Jabatan' }}
            </button>
        </div>
    </div>
</form>
@endsection
