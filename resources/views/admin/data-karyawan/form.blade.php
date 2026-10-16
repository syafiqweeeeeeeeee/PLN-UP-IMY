@extends('layouts.admin')

@section('title', ($karyawan ? 'Edit' : 'Tambah') . ' Data Karyawan — E-PPID PLN')
@section('page-title', ($karyawan ? 'Edit' : 'Tambah') . ' Data Karyawan')

@push('styles')
<style>
    /* Form Data Karyawan — 5 grup kolom ( Identitas / Pekerjaan /
       Riwayat Tanggal / Kontak / Tambahan ), tema panel admin. */
    .dk-form-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 1.5rem 1.75rem;
        margin-bottom: 1.25rem;
    }
    .dk-form-card h5 {
        font-size: 1.1rem; font-weight: 800; color: var(--pln-text);
        margin: 0 0 0.2rem;
    }
    .dk-form-card > p { font-size: 0.8rem; color: #6b7280; margin: 0 0 1.25rem; }

    .dk-section-head {
        display: flex; align-items: center; gap: 0.5rem;
        margin: 1.5rem 0 1rem; padding: 0.5rem 0.8rem;
        background: #f8fafc; border: 1px solid var(--border-color);
        border-radius: 10px;
    }
    .dk-section-head:first-of-type { margin-top: 0; }
    .dk-section-icon {
        display: inline-flex; align-items: center; justify-content: center;
        width: 26px; height: 26px; border-radius: 7px;
        background: var(--pln-blue); color: #fff; font-size: 0.7rem;
    }
    .dk-section-title {
        font-weight: 700; font-size: 0.8rem; color: var(--pln-text);
        text-transform: uppercase; letter-spacing: 0.5px;
    }

    .dk-form-card .form-label {
        font-size: 0.78rem; font-weight: 600; color: #1f2937;
    }
    .dk-form-card .form-control,
    .dk-form-card .form-select {
        font-size: 0.85rem; border: 1px solid var(--border-color);
        border-radius: 10px; background: #fff; color: #1f2937;
    }
    .dk-form-card .form-control:focus,
    .dk-form-card .form-select:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0, 143, 168, 0.12);
    }

    .dk-form-actions {
        display: flex; gap: 0.6rem; margin-top: 1.5rem;
        padding-top: 1.25rem; border-top: 1px solid var(--border-color);
    }
</style>
@endpush

@section('content')
<div class="dk-form-card">
    <h5>
        <i class="fas fa-{{ $karyawan ? 'pen' : 'user-plus' }}" style="color: var(--pln-blue); margin-right: 0.5rem;"></i>
        {{ $karyawan ? 'Edit Data Karyawan' : 'Tambah Data Karyawan' }}
    </h5>
    <p>
        NID dan NAMA wajib diisi; kolom lain opsional.
        @if ($karyawan) Sedang mengubah <b>{{ $karyawan->nama }}</b> (NID {{ $karyawan->nid }}). @endif
    </p>

    @if ($errors->any())
        <div class="alert alert-danger py-2 px-3" style="background:#fef2f2; border:1px solid #fecaca; color:#dc2626;" role="alert">
            <i class="fas fa-circle-exclamation"></i>
            <span>
                <strong>Data belum bisa disimpan — periksa kembali:</strong>
                <ul style="margin:0.3rem 0 0; padding-left:1.2rem; font-weight:500;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </span>
        </div>
    @endif

    <form method="POST"
          action="{{ $karyawan ? route('admin.karyawan_data.update', $karyawan) : route('admin.karyawan_data.store') }}">
        @csrf
        @if ($karyawan) @method('PUT') @endif

        {{-- ========== 1. IDENTITAS KARYAWAN ========== --}}
        <div class="dk-section-head">
            <span class="dk-section-icon"><i class="fas fa-id-card"></i></span>
            <span class="dk-section-title">1. Identitas Karyawan</span>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">NID <span class="text-danger">*</span></label>
                <input type="text" name="nid" maxlength="30" required autocomplete="off"
                       class="form-control @error('nid') is-invalid @enderror"
                       value="{{ old('nid', $karyawan?->nid) }}" placeholder="Nomor Induk (teks — nol di depan aman)">
                @error('nid')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-8">
                <label class="form-label">NAMA <span class="text-danger">*</span></label>
                <input type="text" name="nama" maxlength="150" required autocomplete="name"
                       class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama', $karyawan?->nama) }}" placeholder="Nama lengkap">
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">TEMPAT LAHIR</label>
                <input type="text" name="tempat_lahir" maxlength="100"
                       class="form-control @error('tempat_lahir') is-invalid @enderror"
                       value="{{ old('tempat_lahir', $karyawan?->tempat_lahir) }}">
                @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">TGL LAHIR</label>
                <input type="date" name="tanggal_lahir"
                       class="form-control @error('tanggal_lahir') is-invalid @enderror"
                       value="{{ old('tanggal_lahir', $karyawan?->tanggal_lahir?->format('Y-m-d')) }}">
                @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <label class="form-label">AGAMA</label>
                <input type="text" name="agama" maxlength="30" list="agama-list"
                       class="form-control @error('agama') is-invalid @enderror"
                       value="{{ old('agama', $karyawan?->agama) }}">
                <datalist id="agama-list">
                    <option value="Islam"><option value="Kristen"><option value="Katolik">
                    <option value="Hindu"><option value="Buddha"><option value="Konghucu">
                </datalist>
                @error('agama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-1">
                <label class="form-label">GENDER</label>
                <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                    <option value="">—</option>
                    @foreach ($genders as $key => $label)
                        <option value="{{ $key }}" @selected(old('gender', $karyawan?->gender) === $key)>{{ $key }}</option>
                    @endforeach
                </select>
                @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-1">
                <label class="form-label">KAWIN</label>
                <select name="status_kawin" class="form-select @error('status_kawin') is-invalid @enderror">
                    <option value="">—</option>
                    @foreach ($statusesKawin as $key => $label)
                        <option value="{{ $key }}" @selected(old('status_kawin', $karyawan?->status_kawin) === $key)>{{ $key }}</option>
                    @endforeach
                </select>
                @error('status_kawin')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- ========== 2. INFORMASI PEKERJAAN ========== --}}
        <div class="dk-section-head">
            <span class="dk-section-icon"><i class="fas fa-briefcase"></i></span>
            <span class="dk-section-title">2. Informasi Pekerjaan</span>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">BIDANG</label>
                <input type="text" name="bidang" maxlength="100" list="bidang-list"
                       class="form-control @error('bidang') is-invalid @enderror"
                       value="{{ old('bidang', $karyawan?->bidang) }}" placeholder="mis. Operasi">
                <datalist id="bidang-list">
                    @foreach (($filterOptions['bidang'] ?? []) as $value)
                        <option value="{{ $value }}">
                    @endforeach
                </datalist>
                @error('bidang')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">JABATAN</label>
                <input type="text" name="jabatan" maxlength="100"
                       class="form-control @error('jabatan') is-invalid @enderror"
                       value="{{ old('jabatan', $karyawan?->jabatan) }}">
                @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">JENJAB <small class="text-muted">(jenjang jabatan)</small></label>
                <input type="text" name="jenjang_jabatan" maxlength="50"
                       class="form-control @error('jenjang_jabatan') is-invalid @enderror"
                       value="{{ old('jenjang_jabatan', $karyawan?->jenjang_jabatan) }}">
                @error('jenjang_jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">GRADE</label>
                <input type="text" name="grade" maxlength="30"
                       class="form-control @error('grade') is-invalid @enderror"
                       value="{{ old('grade', $karyawan?->grade) }}">
                @error('grade')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">INSTITUSI</label>
                <input type="text" name="institusi" maxlength="100"
                       class="form-control @error('institusi') is-invalid @enderror"
                       value="{{ old('institusi', $karyawan?->institusi) }}">
                @error('institusi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <label class="form-label">ORGANIK</label>
                <input type="text" name="organik" maxlength="100"
                       class="form-control @error('organik') is-invalid @enderror"
                       value="{{ old('organik', $karyawan?->organik) }}">
                @error('organik')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">UNIT</label>
                <input type="text" name="unit" maxlength="100" list="unit-list"
                       class="form-control @error('unit') is-invalid @enderror"
                       value="{{ old('unit', $karyawan?->unit) }}">
                <datalist id="unit-list">
                    @foreach (($filterOptions['unit'] ?? []) as $value)
                        <option value="{{ $value }}">
                    @endforeach
                </datalist>
                @error('unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- ========== 3. RIWAYAT TANGGAL & MASA KERJA ========== --}}
        <div class="dk-section-head">
            <span class="dk-section-icon"><i class="fas fa-calendar-days"></i></span>
            <span class="dk-section-title">3. Riwayat Tanggal dan Masa Kerja</span>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">SERVICE DATE</label>
                <input type="date" name="service_date"
                       class="form-control @error('service_date') is-invalid @enderror"
                       value="{{ old('service_date', $karyawan?->service_date?->format('Y-m-d')) }}">
                @error('service_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">HIRE DATE</label>
                <input type="date" name="hire_date"
                       class="form-control @error('hire_date') is-invalid @enderror"
                       value="{{ old('hire_date', $karyawan?->hire_date?->format('Y-m-d')) }}">
                @error('hire_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">RETIRE DATE</label>
                <input type="date" name="retire_date"
                       class="form-control @error('retire_date') is-invalid @enderror"
                       value="{{ old('retire_date', $karyawan?->retire_date?->format('Y-m-d')) }}">
                @error('retire_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">GRADE DATE</label>
                <input type="date" name="grade_date"
                       class="form-control @error('grade_date') is-invalid @enderror"
                       value="{{ old('grade_date', $karyawan?->grade_date?->format('Y-m-d')) }}">
                @error('grade_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">TGL JAB <small class="text-muted">(tanggal jabatan)</small></label>
                <input type="date" name="tgl_jab"
                       class="form-control @error('tgl_jab') is-invalid @enderror"
                       value="{{ old('tgl_jab', $karyawan?->tgl_jab?->format('Y-m-d')) }}">
                @error('tgl_jab')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- ========== 4. INFORMASI KONTAK ========== --}}
        <div class="dk-section-head">
            <span class="dk-section-icon"><i class="fas fa-address-book"></i></span>
            <span class="dk-section-title">4. Informasi Kontak</span>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">TELP</label>
                <input type="text" name="telp" maxlength="50" autocomplete="tel"
                       class="form-control @error('telp') is-invalid @enderror"
                       value="{{ old('telp', $karyawan?->telp) }}" placeholder="mis. 0234-321456">
                @error('telp')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">HP</label>
                <input type="text" name="hp" maxlength="50" autocomplete="tel"
                       class="form-control @error('hp') is-invalid @enderror"
                       value="{{ old('hp', $karyawan?->hp) }}" placeholder="mis. 081234567890">
                @error('hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">EMAIL</label>
                <input type="email" name="email" maxlength="150" autocomplete="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $karyawan?->email) }}" placeholder="nama@pln.co.id">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- ========== 5. INFORMASI TAMBAHAN ========== --}}
        <div class="dk-section-head">
            <span class="dk-section-icon"><i class="fas fa-circle-info"></i></span>
            <span class="dk-section-title">5. Informasi Tambahan</span>
        </div>
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">FTE <small class="text-muted">(mis. 1.00)</small></label>
                <input type="number" name="fte" step="0.01" min="0" max="99"
                       class="form-control @error('fte') is-invalid @enderror"
                       value="{{ old('fte', $karyawan?->fte) }}">
                @error('fte')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">MIMS</label>
                <input type="text" name="mims" maxlength="50"
                       class="form-control @error('mims') is-invalid @enderror"
                       value="{{ old('mims', $karyawan?->mims) }}">
                @error('mims')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="dk-form-actions">
            <button type="submit" class="btn-corp btn-corp-primary">
                <i class="fas fa-floppy-disk me-1"></i> {{ $karyawan ? 'Simpan Perubahan' : 'Simpan Data' }}
            </button>
            <a href="{{ route('admin.karyawan_data.index') }}" class="btn-corp btn-corp-soft">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection
