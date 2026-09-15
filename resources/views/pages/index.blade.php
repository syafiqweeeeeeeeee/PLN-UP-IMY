@extends('layouts.app')

@section('title', 'Halaman — E-PPID PLN')

@section('content')
<style>
    .pg-index-wrap { padding: 7.5rem 0 4rem; background: var(--pln-gray); min-height: 100vh; }
    .pg-index-title { font-weight: 800; color: var(--pln-dark); }
    .pg-card {
        display: block; background: #fff; border: 1px solid #E2E8F0; border-radius: 14px;
        padding: 1.25rem 1.5rem; text-decoration: none; height: 100%;
        transition: all 0.2s ease;
    }
    .pg-card:hover { border-color: var(--pln-cyan); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,163,224,0.12); }
    .pg-card h6 { font-weight: 700; color: #1E293B; margin: 0 0 0.35rem; }
    .pg-card p { font-size: 0.82rem; color: #64748B; margin: 0; }
    .pg-card .pg-icon {
        width: 38px; height: 38px; border-radius: 10px; background: #E6F7FD; color: var(--pln-cyan);
        display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem;
    }
    .pg-locked {
        display: inline-flex; align-items: center; gap: 0.3rem;
        font-size: 0.7rem; font-weight: 700; color: #6d28d9; background: #ede9fe;
        padding: 0.15rem 0.6rem; border-radius: 999px;
    }
</style>

<div class="pg-index-wrap">
    <div class="container">
        <h1 class="pg-index-title mb-1">Halaman</h1>
        <p class="text-muted mb-4">Informasi & dokumen yang dipublikasikan{{ auth()->check() ? ' (termasuk halaman internal untuk role Anda)' : '' }}.</p>

        <div class="row g-3">
            @forelse ($pages as $page)
                    <div class="col-md-4">
                        <a href="{{ route('pages.show', $page) }}" class="pg-card">
                            <div class="pg-icon"><i class="fas fa-file-lines"></i></div>
                            <h6>{{ $page->title }}</h6>
                            <p>/halaman/{{ $page->slug }}</p>
                            @if ($page->visibility === 'role_restricted')
                                <span class="pg-locked"><i class="fas fa-lock"></i> Internal</span>
                            @endif
                        </a>
                    </div>
            @empty
            <div class="text-center text-muted py-5">
                <i class="fas fa-folder-open fa-2x mb-3 d-block" style="color:#cbd5e1;"></i>
                Belum ada halaman yang dipublikasikan.
            </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
