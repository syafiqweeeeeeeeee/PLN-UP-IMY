@extends('layouts.app')

@section('title', $page->title . ' — E-PPID PLN')

@section('content')
@php
    $accent = '#00A3E0';
@endphp
<style>
    .pg-show-hero {
        background: linear-gradient(135deg, var(--pln-blue) 0%, var(--pln-dark) 100%);
        padding: 8rem 0 3.5rem; color: #fff;
    }
    .pg-show-hero h1 { font-weight: 800; margin: 0; }
    .pg-show-hero .crumb { font-size: 0.8rem; opacity: 0.85; margin-bottom: 0.75rem; }
    .pg-show-hero .crumb a { color: #fff; opacity: 0.9; }
    .pg-internal-badge {
        display: inline-flex; align-items: center; gap: 0.4rem;
        background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3);
        padding: 0.25rem 0.8rem; border-radius: 999px; font-size: 0.72rem; font-weight: 700;
    }
    .pg-show-body { background: var(--pln-gray); padding: 3rem 0 4rem; min-height: 50vh; }
    .pg-section { margin-bottom: 2rem; }
    .pg-section-heading {
        font-weight: 800; color: var(--pln-dark); font-size: 1.3rem;
        margin-bottom: 1rem; position: relative; padding-left: 0.9rem;
    }
    .pg-section-heading::before {
        content: ''; position: absolute; left: 0; top: 0.2rem; bottom: 0.2rem;
        width: 4px; border-radius: 2px; background: {{ $accent }};
    }
    .pg-text-body { color: #334155; font-size: 0.95rem; line-height: 1.75; white-space: pre-line; }
    .pg-cards-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1rem; }
    .pg-card-item {
        background: #fff; border: 1px solid #E2E8F0; border-radius: 12px; padding: 1.1rem 1.25rem;
        transition: all 0.2s ease; display: block; text-decoration: none; color: inherit;
    }
    .pg-card-item:hover { border-color: {{ $accent }}; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,163,224,0.1); }
    .pg-card-item h6 { font-weight: 700; color: #1E293B; margin: 0 0 0.3rem; }
    .pg-card-item p { font-size: 0.82rem; color: #64748B; margin: 0 0 0.5rem; }
    .pg-card-item .open-link { font-size: 0.75rem; font-weight: 700; color: var(--pln-cyan); }
    .pg-file-item {
        display: flex; align-items: center; gap: 0.9rem;
        background: #fff; border: 1px solid #E2E8F0; border-radius: 12px;
        padding: 0.9rem 1.1rem; text-decoration: none; color: inherit; transition: all 0.2s ease;
    }
    .pg-file-item:hover { border-color: {{ $accent }}; background: #f8fdff; }
    .pg-file-item .f-icon {
        width: 38px; height: 38px; border-radius: 10px; background: #fee2e2; color: #dc2626;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .pg-file-item .f-title { font-weight: 700; color: #1E293B; font-size: 0.88rem; }
    .pg-file-item .f-desc { font-size: 0.75rem; color: #64748B; }
    .pg-faq-item { background: #fff; border: 1px solid #E2E8F0; border-radius: 12px; margin-bottom: 0.75rem; overflow: hidden; }
    .pg-faq-item summary {
        padding: 0.95rem 1.2rem; font-weight: 700; color: #1E293B; cursor: pointer;
        list-style: none; display: flex; align-items: center; justify-content: space-between; gap: 1rem;
    }
    .pg-faq-item summary::-webkit-details-marker { display: none; }
    .pg-faq-item summary::after { content: '\\f078'; font-family: 'Font Awesome 6 Free'; font-weight: 900; font-size: 0.7rem; color: #94a3b8; transition: transform 0.2s ease; }
    .pg-faq-item[open] summary::after { transform: rotate(180deg); }
    .pg-faq-item .faq-answer { padding: 0 1.2rem 1.1rem; color: #475569; font-size: 0.88rem; line-height: 1.7; white-space: pre-line; }
</style>

<div class="pg-show-hero">
    <div class="container">
        <div class="crumb">
            <a href="{{ route('home') }}">Beranda</a> &rsaquo;
            <a href="{{ route('pages.index') }}">Halaman</a> &rsaquo;
            {{ $page->title }}
        </div>
        <h1>{{ $page->title }}</h1>
        @if ($page->visibility === 'role_restricted')
            <div class="mt-2">
                <span class="pg-internal-badge"><i class="fas fa-lock"></i> Halaman Internal</span>
            </div>
        @endif
    </div>
</div>

<div class="pg-show-body">
    <div class="container">
        @if ($page->sections->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-file-lines fa-2x mb-3 d-block" style="color:#cbd5e1;"></i>
                Halaman ini belum memiliki konten.
            </div>
        @endif

        @foreach ($page->sections as $section)
            <div class="pg-section" id="section-{{ $section->id }}">
                @if ($section->type === 'banner')
                    <div class="p-4 p-lg-5 rounded-4" style="background: linear-gradient(135deg, #E6F7FD 0%, #fff 100%); border: 1px solid #E2E8F0;">
                        <h2 style="font-weight:800; color: var(--pln-dark);">{{ $section->dataValue('heading') }}</h2>
                        @if ($section->dataValue('subheading'))
                            <p class="mb-0 mt-2" style="color:#475569;">{{ $section->dataValue('subheading') }}</p>
                        @endif
                        @if ($section->dataValue('button_text') && $section->dataValue('button_url'))
                            <a href="{{ $section->dataValue('button_url') }}" class="btn btn-primary mt-3 px-4"
                               style="background: var(--pln-cyan); border: none; font-weight:600;">
                                {{ $section->dataValue('button_text') }} <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        @endif
                    </div>

                @elseif ($section->type === 'text')
                    @if ($section->dataValue('heading'))
                        <h2 class="pg-section-heading">{{ $section->dataValue('heading') }}</h2>
                    @endif
                    <div class="pg-text-body">{{ $section->dataValue('body') }}</div>

                @elseif ($section->type === 'cards')
                    @if ($section->dataValue('heading'))
                        <h2 class="pg-section-heading">{{ $section->dataValue('heading') }}</h2>
                    @endif
                    <div class="pg-cards-grid">
                        @foreach ($section->items() as $item)
                            @if (($item['url'] ?? '') !== '')
                                <a href="{{ $item['url'] }}" class="pg-card-item">
                            @else
                                <div class="pg-card-item">
                            @endif
                                    <h6>{{ $item['title'] ?? '' }}</h6>
                                    @if (($item['description'] ?? '') !== '')
                                        <p>{{ $item['description'] }}</p>
                                    @endif
                                    @if (($item['url'] ?? '') !== '')
                                        <span class="open-link">Buka <i class="fas fa-arrow-right"></i></span>
                                    @endif
                            @if (($item['url'] ?? '') !== '')
                                </a>
                            @else
                                </div>
                            @endif
                        @endforeach
                    </div>

                @elseif ($section->type === 'file')
                    @if ($section->dataValue('heading'))
                        <h2 class="pg-section-heading">{{ $section->dataValue('heading') }}</h2>
                    @endif
                    <div class="d-flex flex-column gap-2">
                        @foreach ($section->items() as $item)
                            <a href="{{ $item['url'] ?? '#' }}" class="pg-file-item" target="_blank" rel="noopener">
                                <span class="f-icon"><i class="fas fa-file-pdf"></i></span>
                                <span>
                                    <span class="f-title d-block">{{ $item['title'] ?? 'File' }}</span>
                                    @if (($item['description'] ?? '') !== '')
                                        <span class="f-desc">{{ $item['description'] }}</span>
                                    @endif
                                </span>
                                <i class="fas fa-download ms-auto" style="color:#94a3b8;"></i>
                            </a>
                        @endforeach
                    </div>

                @elseif ($section->type === 'faq')
                    @if ($section->dataValue('heading'))
                        <h2 class="pg-section-heading">{{ $section->dataValue('heading') }}</h2>
                    @endif
                    <div>
                        @foreach ($section->items() as $item)
                            <details class="pg-faq-item">
                                <summary>{{ $item['question'] ?? '' }}</summary>
                                <div class="faq-answer">{{ $item['answer'] ?? '' }}</div>
                            </details>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
