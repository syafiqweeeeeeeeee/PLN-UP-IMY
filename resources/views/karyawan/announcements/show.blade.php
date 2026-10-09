@extends('layouts.karyawan')

@section('title', 'Detail Pengumuman — Portal Karyawan')

@push('styles')
<style>
    .portal-detail-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        padding: 1rem 1.5rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        margin-bottom: 0.85rem;
    }
    .portal-detail-back-link {
        color: #6b7280;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        transition: color 0.15s ease;
    }
    .portal-detail-back-link:hover { color: var(--pln-blue); }
    .portal-detail-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--pln-text);
        margin: 0;
    }
    .portal-detail-subtitle {
        font-size: 0.78rem;
        color: #9ca3af;
        margin: 0.15rem 0 0 0;
    }
    .portal-detail-section {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 0.85rem;
    }
    .portal-detail-section-header {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 0.85rem;
    }
    .portal-detail-section-icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: rgba(0,91,156,0.1);
        color: var(--pln-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        flex-shrink: 0;
    }
    .portal-detail-section-title {
        font-size: 0.92rem;
        font-weight: 700;
        color: var(--pln-text);
        margin: 0;
    }
    .portal-detail-section-desc {
        font-size: 0.75rem;
        color: #9ca3af;
        margin: 0.1rem 0 0 0;
    }
    .portal-detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 0.85rem;
    }
    .portal-detail-field { margin-bottom: 0; }
    .portal-detail-label {
        font-size: 0.72rem;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 0.2rem;
    }
    .portal-detail-value {
        font-size: 0.88rem;
        color: var(--pln-text);
    }
    .portal-detail-value.muted { color: #9ca3af; }
    .portal-detail-badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 5px;
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .portal-detail-badge.published { background: #dcfce7; color: #166534; }
    .portal-detail-badge.draft { background: #fef3c7; color: #92400e; }
    .portal-detail-content {
        font-size: 0.88rem;
        color: var(--pln-text);
        background: var(--panel);
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        white-space: pre-wrap;
    }
    .portal-detail-excerpt {
        font-size: 0.88rem;
        color: var(--pln-text);
        background: var(--panel);
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }

    @media (max-width: 767.98px) {
        .portal-detail-topbar { flex-direction: column; align-items: flex-start; }
        .portal-detail-section { padding: 0.85rem; }
    }
</style>
@endpush

@section('content')
<div class="portal-detail-topbar">
    <a href="{{ route('karyawan.announcements.index') }}" class="portal-detail-back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Pengumuman
    </a>
    <div>
        <h4 class="portal-detail-title">{{ $announcement->title }}</h4>
        <p class="portal-detail-subtitle">
            <span class="portal-detail-badge {{ $announcement->is_published ? 'published' : 'draft' }}">
                {{ $announcement->is_published ? 'Dipublikasikan' : 'Draft' }}
            </span>
            &middot; {{ ucfirst($announcement->category) }}
            &middot; {{ ($announcement->published_at ?? $announcement->created_at)->format('d M Y H:i') }}
        </p>
    </div>
</div>

<div class="portal-detail-section">
    <div class="portal-detail-section-header">
        <div class="portal-detail-section-icon">
            <i class="fas fa-bullhorn"></i>
        </div>
        <div>
            <h5 class="portal-detail-section-title">Detail Pengumuman</h5>
            <p class="portal-detail-section-desc">Pratinjau pengumuman sesuai data yang tersimpan</p>
        </div>
    </div>

    <div class="portal-detail-grid">
        <div class="portal-detail-field">
            <div class="portal-detail-label">Judul</div>
            <div class="portal-detail-value">{{ $announcement->title }}</div>
        </div>

        <div class="portal-detail-field">
            <div class="portal-detail-label">Slug</div>
            <div class="portal-detail-value muted" style="font-family: monospace;">{{ $announcement->slug }}</div>
        </div>

        <div class="portal-detail-field">
            <div class="portal-detail-label">Kategori</div>
            <div class="portal-detail-value">{{ ucfirst($announcement->category) }}</div>
        </div>

        <div class="portal-detail-field">
            <div class="portal-detail-label">Target Publikasi</div>
            <div class="portal-detail-value">
                @if ($announcement->target_publication === 'public')
                    Publik Utama
                @elseif ($announcement->target_publication === 'portal')
                    Portal Karyawan
                @else
                    Semua (Publik & Portal)
                @endif
            </div>
        </div>

        <div class="portal-detail-field">
            <div class="portal-detail-label">Bidang Pemilik</div>
            <div class="portal-detail-value">
                {{ $announcement->departmentRef?->name ?? 'Global (Semua Bidang)' }}
            </div>
        </div>

        <div class="portal-detail-field">
            <div class="portal-detail-label">Status</div>
            <div>
                @if ($announcement->is_published)
                <span class="portal-detail-badge published"><i class="fas fa-check-circle" style="margin-right:0.3rem;"></i>Dipublikasikan</span>
                @else
                <span class="portal-detail-badge draft"><i class="fas fa-clock" style="margin-right:0.3rem;"></i>Draft</span>
                @endif
            </div>
        </div>

        @if ($announcement->published_at)
        <div class="portal-detail-field">
            <div class="portal-detail-label">Tanggal Publikasi</div>
            <div class="portal-detail-value">{{ $announcement->published_at->format('d M Y H:i') }}</div>
        </div>
        @endif

        <div class="portal-detail-field">
            <div class="portal-detail-label">Dibuat Pada</div>
            <div class="portal-detail-value muted">{{ $announcement->created_at->format('d/m/Y H:i:s') }}</div>
        </div>

        <div class="portal-detail-field">
            <div class="portal-detail-label">Diperbarui Pada</div>
            <div class="portal-detail-value muted">{{ $announcement->updated_at->format('d/m/Y H:i:s') }}</div>
        </div>
    </div>
</div>

<div class="portal-detail-section">
    <div class="portal-detail-section-header">
        <div class="portal-detail-section-icon" style="background: rgba(0,163,224,0.1); color: #00a3e0;">
            <i class="fas fa-align-left"></i>
        </div>
        <div>
            <h5 class="portal-detail-section-title">Konten Pengumuman</h5>
            <p class="portal-detail-section-desc">Ringkasan dan isi lengkap pengumuman</p>
        </div>
    </div>

    <div class="portal-detail-grid">
        <div class="portal-detail-field" style="grid-column: 1 / -1;">
            <div class="portal-detail-label">Ringkasan</div>
            <div class="portal-detail-excerpt">{{ $announcement->excerpt }}</div>
        </div>

        @if ($announcement->content)
        <div class="portal-detail-field" style="grid-column: 1 / -1;">
            <div class="portal-detail-label" style="margin-top:0.85rem;">Konten Lengkap</div>
            <div class="portal-detail-content">{{ $announcement->content }}</div>
        </div>
        @endif
    </div>
</div>
@endsection
