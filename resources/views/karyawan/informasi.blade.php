@extends('layouts.karyawan')

@section('title', 'Informasi Internal — Portal Karyawan')

@section('content')

    <div class="kry-breadcrumb">
        <a href="{{ route('karyawan.dashboard') }}">Dashboard</a> &nbsp;/&nbsp; Informasi
    </div>

    <div class="kry-page-head">
        <h1>Informasi Internal</h1>
        <p>Pengumuman dan berita internal perusahaan. Hanya dapat dibaca — diperbarui oleh tim komunikasi internal.</p>
    </div>

    {{-- ===== PENGUMUMAN ===== --}}
    <section class="kry-section">
        <div class="kry-section-head">
            <h2><i class="fas fa-bullhorn"></i> Pengumuman</h2>
        </div>

        <div class="kry-grid-3">
            @forelse ($announcements as $item)
                <article class="kry-card kry-news-card">
                    <div class="kry-news-thumb"><i class="fas fa-bullhorn"></i></div>
                    <div class="kry-news-body">
                        <div class="kry-news-date">
                            <i class="fas fa-calendar-day"></i>
                            {{ optional($item->published_at)->translatedFormat('d F Y') ?? '-' }}
                            <span class="kry-tag">{{ $item->category ?? 'Umum' }}</span>
                        </div>
                        <h3>{{ $item->title }}</h3>
                        <p>{{ $item->excerpt }}</p>
                        <a href="{{ route('karyawan.informasi.detail', ['type' => 'pengumuman', 'slug' => $item->slug]) }}"
                           class="kry-btn-more">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div class="kry-card kry-empty">
                    <i class="fas fa-inbox" style="font-size:1.4rem; display:block; margin-bottom:8px;"></i>
                    Belum ada pengumuman.
                </div>
            @endforelse
        </div>
    </section>

    {{-- ===== BERITA INTERNAL ===== --}}
    <section class="kry-section" style="margin-bottom: 0;">
        <div class="kry-section-head">
            <h2><i class="fas fa-newspaper"></i> Berita Internal</h2>
        </div>

        <div class="kry-grid-3">
            @forelse ($news as $item)
                <article class="kry-card kry-news-card">
                    <div class="kry-news-thumb">
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" loading="lazy">
                        @else
                            <i class="fas fa-newspaper"></i>
                        @endif
                    </div>
                    <div class="kry-news-body">
                        <div class="kry-news-date">
                            <i class="fas fa-calendar-day"></i>
                            {{ optional($item->published_at)->translatedFormat('d F Y') ?? '-' }}
                            <span class="kry-tag">{{ $item->category ?? 'Umum' }}</span>
                        </div>
                        <h3>{{ $item->title }}</h3>
                        <p>{{ $item->excerpt }}</p>
                        <a href="{{ route('karyawan.informasi.detail', ['type' => 'berita', 'slug' => $item->slug]) }}"
                           class="kry-btn-more">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div class="kry-card kry-empty">
                    <i class="fas fa-inbox" style="font-size:1.4rem; display:block; margin-bottom:8px;"></i>
                    Belum ada berita internal.
                </div>
            @endforelse
        </div>
    </section>

@endsection
