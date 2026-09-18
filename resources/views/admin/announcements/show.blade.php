@extends('layouts.admin')

@section('title', 'Detail Pengumuman — E-PPID PLN')
@section('page-title', 'Detail Pengumuman')

@push('styles')
<style>
    .detail-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #9ca3af;
        margin-bottom: 0.25rem;
    }

    .detail-value {
        font-size: 0.95rem;
        color: #1f2937;
        font-weight: 500;
    }

    .announcement-status-badge {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
    }
    .announcement-status-badge.published { background: #dcfce7; color: #166534; }
    .announcement-status-badge.draft { background: #fef3c7; color: #92400e; }

    .announcement-category-badge {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.2rem 0.55rem;
        border-radius: 6px;
    }
    .announcement-category-badge.umum        { background: rgba(0,91,156,0.88); color: #fff; }
    .announcement-category-badge.teknis      { background: rgba(0,163,224,0.88); color: #fff; }
    .announcement-category-badge.kepegawaian { background: rgba(139,92,246,0.88); color: #fff; }
    .announcement-category-badge.keuangan    { background: rgba(16,185,129,0.88); color: #fff; }
    .announcement-category-badge.layanan     { background: rgba(245,158,11,0.92); color: #fff; }

    .detail-content {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 1.25rem 1.5rem;
        font-size: 0.92rem;
        line-height: 1.8;
        color: #334155;
        white-space: pre-wrap;
    }
    .btn-edit {
        background: var(--pln-blue);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.55rem 1.3rem;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.2s ease;
    }
    .btn-edit:hover {
        background: #003d6b;
        color: #fff;
        transform: translateY(-1px);
    }
</style>
@endpush

@section('content')
{{-- ============================================
     TOP NAVIGATION — standar Design System Form
     ============================================ --}}
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.announcements.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">Detail Pengumuman</h4>
            <p class="form-page-subtitle">Pratinjau pengumuman sesuai data yang tersimpan</p>
        </div>
    </div>
    <div class="form-topbar-actions">
        <a href="{{ route('admin.announcements.edit', $announcement) }}" class="form-btn-save" style="text-decoration:none;">
            <i class="fas fa-pen"></i> Edit
        </a>
    </div>
</div>

<div class="form-section">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="detail-label">Judul</div>
                    <div class="detail-value" style="font-size: 1.15rem; font-weight: 700; margin-bottom: 1.25rem;">
                        {{ $announcement->title }}
                    </div>

                    <div class="detail-label">Ringkasan (Excerpt)</div>
                    <div class="detail-content" style="margin-bottom: 1.25rem;">{{ $announcement->excerpt }}</div>

                    <div class="detail-label">Konten Lengkap</div>
                    <div class="detail-content">@if ($announcement->content){{ $announcement->content }}@else<span style="color: #9ca3af; font-style: italic;">Tidak ada konten lengkap</span>@endif</div>
                </div>

                <div class="col-lg-4">
                    <div class="detail-label">Kategori</div>
                    <div style="margin-bottom: 1.25rem;">
                        <span class="announcement-category-badge {{ $announcement->category }}">{{ ucfirst($announcement->category) }}</span>
                    </div>

                    <div class="detail-label">Status</div>
                    <div style="margin-bottom: 1.25rem;">
                        <span class="announcement-status-badge {{ $announcement->is_published ? 'published' : 'draft' }}">
                            {{ $announcement->is_published ? 'Terpublikasi' : 'Draft' }}
                        </span>
                    </div>

                    <div class="detail-label">Slug</div>
                    <div class="detail-value" style="font-family: monospace; font-size: 0.82rem; margin-bottom: 1.25rem;">{{ $announcement->slug }}</div>

                    <div class="detail-label">Dibuat</div>
                    <div class="detail-value" style="margin-bottom: 1.25rem;">
                        <i class="far fa-calendar me-1" style="color: #9ca3af;"></i> {{ $announcement->created_at->format('d M Y H:i') }}
                    </div>

                    @if ($announcement->published_at)
                    <div class="detail-label">Dipublikasikan</div>
                    <div class="detail-value" style="margin-bottom: 1.25rem;">
                        <i class="far fa-calendar-check me-1" style="color: #16a34a;"></i> {{ $announcement->published_at->format('d M Y H:i') }}
                    </div>
                    @endif

                    @if ($announcement->authorUser)
                    <div class="detail-label">Dibuat Oleh</div>
                    <div class="detail-value">{{ $announcement->authorUser->name }}</div>
                    @endif
                </div>
            </div>
</div>
@endsection
