@extends('layouts.admin')

@section('title', 'Tambah Foto Galeri — E-PPID PLN')
@section('page-title', 'Tambah Foto Galeri')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12">
        @include('admin.galeri.form', ['gallery' => null, 'categories' => $categories])
    </div>
</div>
@endsection
