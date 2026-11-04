@extends('errors.layout')

@section('code', '404')
@section('title', 'Halaman Tidak Ditemukan')
@section('icon', '?')
@section('message', 'Halaman yang Anda cari tidak tersedia, sudah dipindahkan, atau tautannya tidak lagi berlaku.')

@section('actions')
    <a href="javascript:history.back()" class="err-btn primary">Kembali ke Halaman Sebelumnya</a>
@endsection
