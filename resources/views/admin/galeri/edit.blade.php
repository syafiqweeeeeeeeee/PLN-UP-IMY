@extends('layouts.admin')

@section('title', 'Edit Foto Galeri — E-PPID PLN')
@section('page-title', 'Edit Foto Galeri')

@section('content')
{{-- TOP NAVIGATION — standar Design System Form (sama dengan form Berita) --}}
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.galeri.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">Edit Foto Galeri</h4>
            <p class="form-page-subtitle">Perbarui data foto galeri</p>
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

{{-- Form bersama admin/galeri/form.blade.php:
     - nilai awal semua field dari old() / $gallery
     - @method('PUT') + @csrf, action route('admin.galeri.update', $gallery)
     - preview foto lama tersimpan + dropzone ganti gambar
     - badge kategori interaktif terisi sesuai data lama --}}
@include('admin.galeri.form', ['gallery' => $gallery, 'categories' => $categories])
@endsection
