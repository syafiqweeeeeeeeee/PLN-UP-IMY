@extends('layouts.admin')

@section('title', 'Edit Foto Galeri — E-PPID PLN')
@section('page-title', 'Edit Foto Galeri')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12">
        {{-- Form bersama admin/galeri/form.blade.php:
             - nilai awal semua field dari old() / $gallery (value="{{ $gallery->judul }}" dst.)
             - @method('PUT') + @csrf, action route('admin.galeri.update', $gallery)
             - preview foto lama tersimpan + dropzone ganti gambar
             - badge kategori interaktif terisi sesuai data lama --}}
        @include('admin.galeri.form', ['gallery' => $gallery, 'categories' => $categories])
    </div>
</div>
@endsection
