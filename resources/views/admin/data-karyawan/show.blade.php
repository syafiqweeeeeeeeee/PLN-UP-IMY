@extends('layouts.admin')

@section('title', 'Detail Karyawan — E-PPID PLN')
@section('page-title', 'Detail Data Karyawan')

@push('styles')
<style>
    /* Detail Data Karyawan — 5 grup kolom, tema panel admin. */
    .dk-detail-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 1.5rem 1.75rem;
        margin-bottom: 1.25rem;
    }
    .dk-detail-card .header-row {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem;
    }
    .dk-detail-card h5 {
        font-size: 1.1rem; font-weight: 800; color: var(--pln-text);
        margin: 0 0 0.2rem;
    }
    .dk-detail-card .header-left p { font-size: 0.8rem; color: #6b7280; margin: 0; }
    .dk-header-actions { display: flex; gap: 0.6rem; flex-wrap: wrap; }

    .dk-section-head {
        display: flex; align-items: center; gap: 0.5rem;
        margin: 1.5rem 0 0.75rem; padding: 0.5rem 0.8rem;
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

    .dk-detail-grid {
        display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 0.1rem 1.5rem;
    }
    .dk-detail-item {
        padding: 0.5rem 0; border-bottom: 1px dashed var(--border-color);
    }
    .dk-detail-item dt {
        font-size: 0.7rem; font-weight: 700; color: #6b7280;
        text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.15rem;
    }
    .dk-detail-item dd {
        margin: 0; font-size: 0.86rem; font-weight: 600; color: var(--pln-text);
        word-break: break-word;
    }
    .dk-detail-item dd.empty { color: #cbd5e1; font-weight: 400; }
</style>
@endpush

@section('content')
<div class="dk-detail-card">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-id-badge" style="color: var(--pln-blue); margin-right: 0.5rem;"></i>{{ $karyawan->nama }}</h5>
            <p>
                NID {{ $karyawan->nid }}
                @if($karyawan->jabatanLabel()) · {{ $karyawan->jabatanLabel() }} @endif
                @if($karyawan->bidangLabel()) · {{ $karyawan->bidangLabel() }} @endif
            </p>
        </div>
        <div class="dk-header-actions">
            @can('karyawan_data.edit')
            <a href="{{ route('admin.karyawan_data.edit', $karyawan) }}" class="btn-corp btn-corp-primary">
                <i class="fas fa-pen me-1"></i> Edit
            </a>
            @endcan
            <a href="{{ route('admin.karyawan_data.index') }}" class="btn-corp btn-corp-soft">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    @php
        // 24 kolom spesifikasi, dikelompokkan menjadi 5 bagian sesuai
        // struktur form (Identitas / Pekerjaan / Riwayat / Kontak /
        // Tambahan).
        $groups = [
            ['1. Identitas Karyawan', 'fa-id-card', [
                'NID' => $karyawan->nid,
                'NAMA' => $karyawan->nama,
                'TEMPAT LAHIR' => $karyawan->tempat_lahir,
                'TGL LAHIR' => $karyawan->formatTanggal('tanggal_lahir'),
                'AGAMA' => $karyawan->agama,
                'GENDER' => $karyawan->genderLabel(),
                'STATUS KAWIN' => $karyawan->statusKawinLabel(),
            ]],
            ['2. Informasi Pekerjaan', 'fa-briefcase', [
                'BIDANG' => $karyawan->bidangLabel(),
                'JABATAN' => $karyawan->jabatanLabel(),
                'JENJAB' => $karyawan->jenjang_jabatan,
                'GRADE' => $karyawan->grade,
                'INSTITUSI' => $karyawan->institusi,
                'ORGANIK' => $karyawan->organik,
                'UNIT' => $karyawan->unit,
            ]],
            ['3. Riwayat Tanggal dan Masa Kerja', 'fa-calendar-days', [
                'SERVICE DATE' => $karyawan->formatTanggal('service_date'),
                'HIRE DATE' => $karyawan->formatTanggal('hire_date'),
                'RETIRE DATE' => $karyawan->formatTanggal('retire_date'),
                'GRADE DATE' => $karyawan->formatTanggal('grade_date'),
                'TGL JAB' => $karyawan->formatTanggal('tgl_jab'),
            ]],
            ['4. Informasi Kontak', 'fa-address-book', [
                'TELP' => $karyawan->telp,
                'HP' => $karyawan->hp,
                'EMAIL' => $karyawan->email,
            ]],
            ['5. Informasi Tambahan', 'fa-circle-info', [
                'FTE' => $karyawan->fte !== null ? number_format($karyawan->fte, 2) : null,
                'MIMS' => $karyawan->mims,
            ]],
        ];
    @endphp

    @foreach ($groups as [$title, $icon, $items])
        <div class="dk-section-head">
            <span class="dk-section-icon"><i class="fas {{ $icon }}"></i></span>
            <span class="dk-section-title">{{ $title }}</span>
        </div>
        <dl class="dk-detail-grid" style="margin-bottom:0;">
            @foreach ($items as $label => $value)
                <div class="dk-detail-item">
                    <dt>{{ $label }}</dt>
                    <dd class="{{ $value === null || $value === '' ? 'empty' : '' }}">{{ $value ?: '—' }}</dd>
                </div>
            @endforeach
        </dl>
    @endforeach
</div>
@endsection
