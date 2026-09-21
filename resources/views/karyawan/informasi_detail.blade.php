@extends('layouts.karyawan')

@section('title', $item->title . ' — Portal Karyawan')

@section('content')

    <div class="kry-breadcrumb">
        <a href="{{ route('karyawan.dashboard') }}">Dashboard</a> &nbsp;/&nbsp;
        <a href="{{ route('karyawan.informasi') }}">Informasi</a> &nbsp;/&nbsp;
        {{ Str::limit($item->title, 40) }}
    </div>

    <article class="kry-card kry-detail">
        <div class="kry-detail-meta">
            <span class="kry-badge kry-badge-umum">{{ $type === 'berita' ? 'Berita' : 'Pengumuman' }}</span>
            <span><i class="fas fa-calendar-day"></i>
                {{ optional($item->published_at)->translatedFormat('d F Y') ?? '-' }}</span>
            @if ($type === 'berita' && !empty($item->category))
                <span><i class="fas fa-tag"></i> {{ ucfirst($item->category) }}</span>
            @endif
        </div>

        <h1>{{ $item->title }}</h1>

        @if ($type === 'berita')
            <div class="kry-detail-hero">
                @if ($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                @else
                    <i class="fas fa-newspaper"></i>
                @endif
            </div>
        @endif

        <div class="kry-detail-content">
            <p><strong>{{ $item->excerpt }}</strong></p>

            {!! $type === 'berita' ? $item->content : $item->content !!}
        </div>
    </article>

    @if ($terkait->isNotEmpty())
        <div class="kry-mini-grid">
            @foreach ($terkait as $row)
                <a href="{{ route('karyawan.informasi.detail', ['type' => $row['type'], 'slug' => $row['model']->slug]) }}"
                   class="kry-card kry-mini-card">
                    <h4>{{ $row['model']->title }}</h4>
                    <span>
                        <i class="fas fa-calendar-day"></i>
                        {{ optional($row['model']->published_at)->translatedFormat('d F Y') ?? '-' }}
                    </span>
                    <p>{{ $row['model']->excerpt }}</p>
                </a>
            @endforeach
        </div>
    @endif

@endsection
