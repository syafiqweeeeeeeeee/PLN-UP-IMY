@extends('layouts.admin')

@section('title', 'Tambah Foto Galeri — E-PPID PLN')
@section('page-title', 'Tambah Foto Galeri')

@section('content')
{{-- TOP NAVIGATION — standar Design System Form (sama dengan form Berita) --}}
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.galeri.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">Tambah Foto Galeri Baru</h4>
            <p class="form-page-subtitle">Unggah foto baru untuk halaman galeri publik</p>
        </div>
    </div>
</div>

@if (session('success'))
<div class="form-alert success">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="form-alert danger">
    <i class="fas fa-circle-exclamation"></i> Perbaiki data berikut.
</div>
@endif

@include('admin.galeri.form', ['gallery' => null, 'categories' => $categories])
@endsection
