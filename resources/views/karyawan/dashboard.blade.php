@extends('layouts.karyawan')

@section('title', 'Dashboard Karyawan — PLN Nusantara Power')

@section('content')

    {{-- Salam pembuka --}}
    <div class="kry-greeting">
        <div>
            <h1>Selamat datang, {{ $user->name }} 👋</h1>
            <p>Semua informasi internal, layanan karyawan, dan alat kerja ada di satu tempat.</p>
        </div>
        <span class="kry-greeting-badge">
            <i class="fas fa-bolt"></i> Portal Karyawan
        </span>
    </div>

    {{-- Ringkasan --}}
    <div class="kry-stats">
        <div class="kry-card kry-stat">
            <span class="kry-stat-icon"><i class="fas fa-bullhorn"></i></span>
            <div>
                <div class="kry-stat-value">{{ $totalInformasi }}</div>
                <div class="kry-stat-label">Informasi & Pengumuman Aktif</div>
            </div>
        </div>
        <div class="kry-card kry-stat">
            <span class="kry-stat-icon"><i class="fas fa-hand-holding-heart"></i></span>
            <div>
                <div class="kry-stat-value">{{ count($internalServices) }}</div>
                <div class="kry-stat-label">Layanan Internal Tersedia</div>
            </div>
        </div>
        <div class="kry-card kry-stat">
            <span class="kry-stat-icon"><i class="fas fa-link"></i></span>
            <div>
                <div class="kry-stat-value">{{ count($workLinks) }}</div>
                <div class="kry-stat-label">Link Alat Kerja Terdaftar</div>
            </div>
        </div>
    </div>

    {{-- ===== SECTION INFORMASI ===== --}}
    <section class="kry-section">
        <div class="kry-section-head">
            <h2><i class="fas fa-bullhorn"></i> Informasi Terbaru</h2>
            <a href="{{ route('karyawan.informasi') }}" class="kry-link-more">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="kry-grid-3">
            @forelse ($announcements as $item)
                <article class="kry-card kry-news-card">
                    <div class="kry-news-thumb"><i class="fas fa-bullhorn"></i></div>
                    <div class="kry-news-body">
                        <div class="kry-news-date">
                            <i class="fas fa-calendar-day"></i>
                            {{ optional($item->published_at)->translatedFormat('d F Y') ?? '-' }}
                            <span class="kry-tag">Pengumuman</span>
                        </div>
                        <h3>{{ $item->title }}</h3>
                        <p>{{ $item->excerpt }}</p>
                        <a href="{{ route('karyawan.informasi.detail', ['type' => 'pengumuman', 'slug' => $item->slug]) }}"
                           class="kry-btn-more">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
            @endforeach

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
                            <span class="kry-tag">Berita</span>
                        </div>
                        <h3>{{ $item->title }}</h3>
                        <p>{{ $item->excerpt }}</p>
                        <a href="{{ route('karyawan.informasi.detail', ['type' => 'berita', 'slug' => $item->slug]) }}"
                           class="kry-btn-more">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
            @endforeach

            @if ($announcements->isEmpty() && $news->isEmpty())
                <div class="kry-card kry-empty">
                    <i class="fas fa-inbox" style="font-size:1.4rem; display:block; margin-bottom:8px;"></i>
                    Belum ada informasi yang dipublikasikan.
                </div>
            @endif
        </div>
    </section>

    {{-- ===== SECTION LAYANAN ===== --}}
    <section class="kry-section">
        <div class="kry-section-head">
            <h2><i class="fas fa-hand-holding-heart"></i> Layanan Internal</h2>
            <a href="{{ route('karyawan.layanan') }}" class="kry-link-more">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="kry-service-grid">
            @foreach (array_slice($internalServices, 0, 3) as $service)
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
    </section>

    {{-- ===== SECTION LINK KERJA ===== --}}
    <section class="kry-section" style="margin-bottom: 0;">
        <div class="kry-section-head">
            <h2><i class="fas fa-link"></i> Link Kerja Sering Dipakai</h2>
            <a href="{{ route('karyawan.link') }}" class="kry-link-more">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="kry-link-grid">
            @foreach (array_slice($workLinks, 0, 4) as $link)
                <article class="kry-card kry-link-card">
                    <span class="kry-link-icon" style="background: {{ $link['color'] }};">
                        <i class="fas {{ $link['icon'] }}"></i>
                    </span>
                    <div class="kry-link-body">
                        <h3>
                            {{ $link['name'] }}
                            <span class="kry-badge {{ $link['category'] === 'umum' ? 'kry-badge-umum' : '' }}">
                                Umum
                            </span>
                        </h3>
                        <p class="kry-link-desc">{{ $link['description'] }}</p>
                        <a href="{{ $link['url'] }}" target="_blank" rel="noopener" class="kry-btn-open">
                            Buka Website <i class="fas fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

@endsection
