@extends('errors.layout')

@section('code', '419')
@section('title', 'Sesi Anda Telah Berakhir')
@section('icon', '⏱')
@section('message', 'Halaman terlalu lama dibiarkan terbuka sehingga token keamanan kedaluwarsa. Muat ulang halaman lalu coba lagi.')

@section('actions')
    <button type="button" class="err-btn primary" onclick="window.location.reload()">Muat Ulang Halaman</button>
@endsection
