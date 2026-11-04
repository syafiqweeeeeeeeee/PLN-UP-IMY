@extends('errors.layout')

@section('code', '500')
@section('title', 'Terjadi Kesalahan pada Sistem')
@section('icon', '!')
@section('message', 'Permintaan Anda tidak dapat diproses saat ini. Tim kami sudah menerima catatan kejadian ini — silakan coba beberapa saat lagi.')

@section('actions')
    <button type="button" class="err-btn primary" onclick="window.location.reload()">Muat Ulang Halaman</button>
@endsection
