@extends('errors.layout')

@section('code', '403')
@section('title', 'Akses Ditolak')
@section('icon', '!')
@section('message', 'Akun Anda tidak memiliki izin untuk membuka halaman atau menjalankan aksi ini. Hubungi administrator apabila Anda merasa ini keliru.')

@section('actions')
    <a href="{{ url('/') }}" class="err-btn primary">Kembali</a>
@endsection
