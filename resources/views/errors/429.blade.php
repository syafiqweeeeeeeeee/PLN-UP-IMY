@extends('errors.layout')

@section('code', '429')
@section('title', 'Terlalu Banyak Permintaan')
@section('icon', '⏳')
@section('message', 'Anda mengirim permintaan terlalu sering dalam waktu singkat. Tunggu sekitar satu menit, lalu coba lagi.')

@section('actions')
    <button type="button" class="err-btn primary" onclick="window.location.reload()">Coba Lagi</button>
@endsection
