@extends('layouts.karyawan')

@section('title', $service['name'] . ' — Portal Karyawan')

@section('content')

    <div class="kry-breadcrumb">
        <a href="{{ route('karyawan.dashboard') }}">Dashboard</a> &nbsp;/&nbsp;
        <a href="{{ route('karyawan.layanan') }}">Layanan</a> &nbsp;/&nbsp; {{ $service['name'] }}
    </div>

    <article class="kry-card kry-detail">
        <div class="kry-detail-meta">
            <span class="kry-badge">Prosedur Layanan</span>
        </div>

        <h1>{{ $service['name'] }}</h1>

        <div class="kry-detail-content">
            <p>{{ $service['description'] }}</p>

            <h3 style="font-size:0.95rem; font-weight:800; color:#00599c; margin:24px 0 4px;">
                <i class="fas fa-list-ol"></i> Langkah-langkah
            </h3>

            <ol class="kry-steps">
                @foreach ($service['steps'] as $step)
                    <li>{{ $step }}</li>
                @endforeach
            </ol>

            <div class="kry-contact-chip">
                <i class="fas fa-envelope"></i> Kontak layanan: {{ $service['contact'] }}
            </div>
        </div>
    </article>

    @if ($others->isNotEmpty())
        <div class="kry-mini-grid">
            @foreach ($others as $other)
                <a href="{{ route('karyawan.layanan.detail', $other['slug']) }}" class="kry-card kry-mini-card">
                    <h4>{{ $other['name'] }}</h4>
                    <span><i class="fas {{ $other['icon'] }}" style="color: {{ $other['color'] }};"></i> Layanan internal</span>
                    <p>{{ $other['description'] }}</p>
                </a>
            @endforeach
        </div>
    @endif

@endsection
