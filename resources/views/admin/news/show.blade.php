@extends('layouts.admin')

@section('title', 'Detail Berita — E-PPID PLN')
@section('page-title', 'Detail Berita')

@section('content')
{{-- ============================================
     TOP NAVIGATION — standar Design System Form
     ============================================ --}}
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.news.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">{{ $news->title }}</h4>
            <p class="form-page-subtitle">
                <span class="badge" style="background: {{ $news->category === 'umum' ? 'var(--pln-blue)' : ($news->category === 'teknis' ? '#00a3e0' : ($news->category === 'kegiatan' ? '#eab900' : '#8b5cf6')) }}; color: #fff; font-size: 0.7rem; padding: 0.2rem 0.6rem; border-radius: 4px; text-transform: uppercase;">
                    {{ $news->category }}
                </span>
                &middot; {{ $news->created_at->format('d M Y H:i') }}
                &middot; {{ $news->is_published ? 'Dipublikasikan' : 'Draft' }}
            </p>
        </div>
    </div>
    <div class="form-topbar-actions">
        <a href="{{ route('admin.news.edit', $news) }}" class="form-btn-save" style="text-decoration:none;">
            <i class="fas fa-edit"></i> Edit
        </a>
    </div>
</div>

<div class="form-section">
    <div class="form-section-header">
        <div class="form-section-icon blue">
            <i class="fas fa-file-lines"></i>
        </div>
        <div>
            <h6 class="form-section-title">Detail Berita</h6>
            <p class="form-section-desc">Pratinjau berita sesuai data yang tersimpan</p>
        </div>
    </div>

    <div class="row g-3">
        @if ($news->image)
        <div class="col-lg-6">
            <label class="form-group-label">Gambar Utama</label>
            <div style="border-radius: 10px; overflow: hidden; background: #f1f5f9;">
                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" style="width: 100%; display: block; max-height: 350px; object-fit: cover;">
            </div>
        </div>
        @endif

        <div class="{{ $news->image ? 'col-lg-6' : 'col-12' }}">
            <div class="mb-3">
                <label class="form-group-label">Judul</label>
                <div style="font-size: 1rem; color: var(--ink-heading);">{{ $news->title }}</div>
            </div>
            <div class="mb-3">
                <label class="form-group-label">Slug</label>
                <div style="font-size: 0.85rem; color: var(--ink-muted); font-family: monospace;">{{ $news->slug }}</div>
            </div>
            <div class="mb-3">
                <label class="form-group-label">Penulis</label>
                <div style="font-size: 0.9rem; color: var(--ink-heading);">{{ $news->author ?: '-' }}</div>
            </div>
            <div class="mb-3">
                <label class="form-group-label">Status</label>
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
                <label class="form-group-label">Tanggal Publikasi</label>
                <div style="font-size: 0.9rem; color: var(--ink-heading);">{{ $news->published_at->format('d M Y H:i') }}</div>
            </div>
            @endif
        </div>

        <div class="col-12">
            <label class="form-group-label">Ringkasan</label>
            <div style="font-size: 0.9rem; color: var(--ink-body); background: var(--panel); padding: 1rem; border-radius: 8px; border: 1px solid var(--border-color);">
                {{ $news->excerpt }}
            </div>
        </div>

        @if ($news->content)
        <div class="col-12">
            <label class="form-group-label">Konten Lengkap</label>
            <div style="font-size: 0.9rem; color: var(--ink-body); background: var(--panel); padding: 1rem; border-radius: 8px; border: 1px solid var(--border-color); white-space: pre-wrap;">
                {{ $news->content }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
