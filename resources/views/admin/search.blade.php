@extends('layouts.admin')

@section('title', 'Hasil Pencarian — E-PPID PLN')
@section('page-title', 'Hasil Pencarian')

@section('content')
<div class="container-fluid p-0" style="max-width: 100%; overflow-x: hidden;">

    {{-- ================= HEADER + FORM PENCARIAN ULANG ================= --}}
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="dash-card" style="background: linear-gradient(135deg, var(--pln-blue) 0%, var(--pln-blue-dark) 100%); border: none; color: #fff;">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-5">
                        <h4 style="font-weight: 700; margin-bottom: 0.25rem;">
                            <i class="fas fa-search me-2"></i>Hasil Pencarian
                        </h4>
                        <p style="opacity: 0.8; font-size: 0.88rem; margin: 0;">
                            @if ($total > 0)
                                Ditemukan <strong>{{ $total }}</strong> hasil untuk kata kunci &ldquo;{{ $q }}&rdquo; di seluruh modul.
                            @else
                                Tidak ada hasil untuk kata kunci &ldquo;{{ $q }}&rdquo;.
                            @endif
                        </p>
                    </div>
                    <div class="col-lg-7">
                        <form action="{{ route('admin.global-search') }}" method="GET" class="position-relative" role="search">
                            <input type="text" name="q" value="{{ $q }}" required minlength="2" maxlength="100"
                                   placeholder="Cari pengguna, berita, pengumuman, menu, tamu..."
                                   class="form-control"
                                   style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.35); border-radius: 10px; padding: 0.6rem 1rem 0.6rem 2.6rem; color: #fff; font-size: 0.9rem;">
                            <i class="fas fa-search" style="position: absolute; left: 0.95rem; top: 50%; transform: translateY(-50%); opacity: 0.6; font-size: 0.85rem; pointer-events: none;"></i>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= KELOMPOK HASIL PER KATEGORI =================
         Kelompok dengan 0 hasil tidak dirender — hanya kategori yang
         benar-benar menemukan data. Bila SEMUA kosong, tampil pesan
         fallback "Tidak ada hasil ditemukan". --}}
    @forelse (array_filter($groups) as $label => $items)
        @if (count($items) === 0) @continue @endif
        <div class="row g-3 mb-3">
            <div class="col-12">
                <div class="dash-card h-100" style="min-width: 0; overflow: hidden;">
                    <div class="dash-card-header">
                        <div>
                            <h5 class="dash-card-title">Hasil {{ $label }}</h5>
                            <p class="dash-card-subtitle">{{ count($items) }} hasil ditemukan</p>
                        </div>
                    </div>

                    @foreach ($items as $item)
                        <a href="{{ $item['url'] }}" class="search-result-row">
                            <div class="search-result-icon" style="background: {{ $item['color'] }}22; color: {{ $item['color'] }};" data-icon-bg="{{ $item['color'] }}">
                                <i class="{{ $item['icon'] }}"></i>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div class="search-result-title">{{ $item['title'] }}</div>
                                <div class="search-result-meta">{{ $item['meta'] }}</div>
                            </div>
                            <span class="btn btn-sm btn-outline-primary search-result-cta" style="border-radius: 8px; font-size: 0.75rem; font-weight: 600; white-space: nowrap; flex-shrink: 0;">
                                {{ $item['cta'] }} <i class="fas fa-arrow-right ms-1" style="font-size: 0.65rem;"></i>
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="row g-3">
            <div class="col-12">
                <div class="dash-card" style="padding: 3rem 1rem; text-align: center;">
                    <i class="fas fa-magnifying-glass-minus" style="font-size: 2.5rem; color: #d1d5db; display: block; margin-bottom: 1rem;"></i>
                    <h6 style="font-weight: 700; color: #374151;">Tidak ada hasil ditemukan</h6>
                    <p style="font-size: 0.85rem; color: #6b7280; margin: 0;">
                        Coba kata kunci lain — pencarian mencakup Pengguna, Berita, Pengumuman, Halaman, Menu, dan Tamu.
                    </p>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary mt-3" style="border-radius: 8px; font-size: 0.8rem; font-weight: 600;">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    @endforelse

</div>
@endsection

@push('styles')
<style>
    /* Baris hasil: seluruh area bisa diklik (link ke halaman kelola). */
    .search-result-row {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #f3f4f6;
        color: inherit;
        text-decoration: none;
        transition: background 0.15s ease;
    }
    .search-result-row:last-child { border-bottom: none; }
    .search-result-row:hover { background: #f8fafc; }

    .search-result-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        flex-shrink: 0;
    }
    .search-result-title {
        font-weight: 600;
        font-size: 0.88rem;
        color: var(--pln-text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .search-result-meta {
        font-size: 0.75rem;
        color: #9ca3af;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    @media (max-width: 576px) {
        .search-result-cta { display: none; }
    }
</style>
@endpush
