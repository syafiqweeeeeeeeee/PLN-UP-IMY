@extends('layouts.app')

@section('title', 'Test Visi Misi')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/tentang-kami.css') }}">
@endpush

@section('content')
<h1>Test Visi Misi</h1>
<p>Jika ini muncul, berarti layout bekerja.</p>
@endsection
