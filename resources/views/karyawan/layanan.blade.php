@extends('layouts.karyawan')

@section('title', 'Layanan Internal — Portal Karyawan')

@section('content')

    <div class="kry-breadcrumb">
        <a href="{{ route('karyawan.dashboard') }}">Dashboard</a> &nbsp;/&nbsp; Layanan
    </div>

    <div class="kry-page-head">
        <h1>Layanan Internal</h1>
        <p>Panduan dan prosedur layanan internal perusahaan. Sifatnya view-only — ikuti langkah pada tiap layanan atau hubungi kontak yang tercantum.</p>
    </div>

    <div class="kry-service-grid">
        @foreach ($services as $service)
            <article class="kry-card kry-service-card">
                <span class="kry-service-icon" style="background: {{ $service['color'] }};">
                    <i class="fas {{ $service['icon'] }}"></i>
                </span>
                <h3>{{ $service['name'] }}</h3>
                <p>{{ $service['description'] }}</p>
                <a href="{{ route('karyawan.layanan.detail', $service['slug']) }}" class="kry-service-link">
                    Lihat Prosedur <i class="fas fa-arrow-right"></i>
                </a>
            </article>
        @endforeach
    </div>

@endsection
