@extends('layouts.admin')

@section('title', 'Detail Berita — E-PPID PLN')
@section('page-title', 'Detail Berita')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="dash-card">
            <div class="dash-card-header">
                <div>
                    <h5 class="dash-card-title">{{ $news->title }}</h5>
                    <p class="dash-card-subtitle">
                        <span class="badge" style="background: {{ $news->category === 'umum' ? 'var(--pln-blue)' : ($news->category === 'teknis' ? '#00a3e0' : ($news->category === 'kegiatan' ? '#eab900' : '#8b5cf6')) }}; color: #fff; font-size: 0.7rem; padding: 0.2rem 0.6rem; border-radius: 4px; text-transform: uppercase;">
                            {{ $news->category }}
                        </span>
                        &middot; {{ $news->created_at->format('d M Y H:i') }}
                        &middot; {{ $news->is_published ? 'Dipublikasikan' : 'Draft' }}
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-sm" style="background: var(--pln-blue); color: #fff; border-radius: 6px;">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-sm" style="background: #f3f4f6; color: #6b7280; border-radius: 6px;">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="row g-3">
                @if ($news->image)
                <div class="col-lg-6">
                    <label class="form-label" style="font-weight: 600; font-size: 0.82rem; color: #374151;">Gambar Utama</label>
                    <div style="border-radius: 10px; overflow: hidden; background: #f1f5f9;">
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" style="width: 100%; display: block; max-height: 350px; object-fit: cover;">
                    </div>
                </div>
                @endif

                <div class="{{ $news->image ? 'col-lg-6' : 'col-12' }}">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 600; font-size: 0.82rem; color: #374151;">Judul</label>
                        <div style="font-size: 1rem; color: #1f2937;">{{ $news->title }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 600; font-size: 0.82rem; color: #374151;">Slug</label>
                        <div style="font-size: 0.85rem; color: #6b7280; font-family: monospace;">{{ $news->slug }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 600; font-size: 0.82rem; color: #374151;">Penulis</label>
                        <div style="font-size: 0.9rem; color: #1f2937;">{{ $news->author ?: '-' }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 600; font-size: 0.82rem; color: #374151;">Status</label>
                        <div>
                            @if ($news->is_published)
                            <span style="background: #dcfce7; color: #166534; padding: 0.2rem 0.7rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                <i class="fas fa-check-circle me-1"></i> Dipublikasikan
                            </span>
                            @else
                            <span style="background: #fef3c7; color: #92400e; padding: 0.2rem 0.7rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                <i class="fas fa-clock me-1"></i> Draft
                            </span>
                            @endif
                        </div>
                    </div>
                    @if ($news->published_at)
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 600; font-size: 0.82rem; color: #374151;">Tanggal Publikasi</label>
                        <div style="font-size: 0.9rem; color: #1f2937;">{{ $news->published_at->format('d M Y H:i') }}</div>
                    </div>
                    @endif
                </div>

                <div class="col-12">
                    <label class="form-label" style="font-weight: 600; font-size: 0.82rem; color: #374151;">Ringkasan</label>
                    <div style="font-size: 0.9rem; color: #374151; background: #f9fafb; padding: 1rem; border-radius: 8px; border: 1px solid #e5e7eb;">
                        {{ $news->excerpt }}
                    </div>
                </div>

                @if ($news->content)
                <div class="col-12">
                    <label class="form-label" style="font-weight: 600; font-size: 0.82rem; color: #374151;">Konten Lengkap</label>
                    <div style="font-size: 0.9rem; color: #374151; background: #f9fafb; padding: 1rem; border-radius: 8px; border: 1px solid #e5e7eb; white-space: pre-wrap;">
                        {{ $news->content }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
