@extends('layouts.admin')

@section('title', 'Kelola Menu — E-PPID PLN')
@section('page-title', 'Kelola Menu')

@push('styles')
<style>
    .menus-header {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 14px; padding: 1.5rem 1.75rem; margin-bottom: 1.25rem;
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem;
    }
    .menus-header h5 { font-size: 1.1rem; font-weight: 700; color: var(--pln-text); margin: 0 0 0.2rem; }
    .menus-header p  { font-size: 0.8rem; color: #9ca3af; margin: 0; }
    .btn-add-menu {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.6rem 1.25rem; background: var(--pln-blue); color: #fff;
        border-radius: 10px; font-weight: 600; font-size: 0.85rem; text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-add-menu:hover { background: #003d6b; color: #fff; transform: translateY(-1px); }

    .howto-box {
        background: #f0f7ff; border: 1px solid #d6e6f7; border-radius: 14px;
        padding: 1.1rem 1.4rem; margin-bottom: 1.25rem; font-size: 0.82rem; color: #334155;
    }
    .howto-box .howto-title {
        font-weight: 700; color: var(--pln-blue); margin-bottom: 0.4rem;
        display: flex; align-items: center; gap: 0.45rem; font-size: 0.85rem;
    }
    .howto-box ol { margin: 0; padding-left: 1.2rem; }
    .howto-box li { margin-bottom: 0.2rem; }
    .howto-box kbd {
        background: #fff; border: 1px solid #dbe4ee; border-radius: 5px;
        padding: 0.05rem 0.4rem; font-size: 0.72rem; font-weight: 700; color: var(--pln-blue);
    }

    .preview-wrap {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 14px; padding: 1.1rem 1.4rem; margin-bottom: 1.25rem;
    }
    .preview-label {
        font-size: 0.72rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;
        color: #9ca3af; margin-bottom: 0.6rem; display: flex; align-items: center; gap: 0.4rem;
    }
    .preview-navbar {
        background: var(--pln-blue); border-radius: 10px; padding: 0.5rem 1rem;
        display: flex; align-items: center; gap: 0.25rem; flex-wrap: wrap;
    }
    .preview-navbar .pv-item {
        color: rgba(255,255,255,0.92); font-size: 0.78rem; font-weight: 600;
        padding: 0.45rem 0.75rem; border-radius: 7px; text-decoration: none;
        display: inline-flex; align-items: center; gap: 0.4rem;
    }
    .preview-navbar .pv-caret { font-size: 0.55rem; opacity: 0.8; }
    .pv-menu-dropdown { position: relative; }
    .pv-menu-dropdown .pv-sub {
        display: none; position: absolute; top: 100%; left: 0; z-index: 30;
        background: #0b3d68; border-radius: 8px; padding: 0.4rem; min-width: 200px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    }
    .pv-menu-dropdown:hover .pv-sub { display: block; }
    .pv-menu-dropdown .pv-sub a {
        display: block; color: rgba(255,255,255,0.9); font-size: 0.76rem; font-weight: 500;
        padding: 0.4rem 0.7rem; border-radius: 6px; text-decoration: none; white-space: nowrap;
    }
    .pv-menu-dropdown .pv-sub a:hover { background: rgba(255,255,255,0.1); }
    .pv-leaf { color: rgba(255,255,255,0.92); font-size: 0.78rem; font-weight: 600; padding: 0.45rem 0.75rem; }

    .menus-card {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 14px; overflow: hidden;
    }
    .menus-table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
    .menus-table th {
        text-align: left; padding: 0.85rem 1.25rem; font-size: 0.72rem; font-weight: 700;
        letter-spacing: 0.05em; text-transform: uppercase; color: #6b7280;
        background: #f8fafc; border-bottom: 1px solid var(--border-color);
    }
    .menus-table td { padding: 0.9rem 1.25rem; border-bottom: 1px solid #f3f4f6; color: #374151; vertical-align: middle; }
    .menus-table tr:last-child td { border-bottom: none; }
    .menu-label { font-weight: 600; color: var(--pln-text); display: flex; align-items: center; gap: 0.5rem; }
    .menu-target { font-size: 0.73rem; color: #9ca3af; margin-top: 0.15rem; }
    .menu-target i { margin-right: 0.25rem; }

    .badge-type {
        display: inline-flex; align-items: center;
        padding: 0.25rem 0.7rem; border-radius: 999px; font-size: 0.7rem; font-weight: 700;
    }
    .badge-type.route { background: #dbeafe; color: #1d4ed8; }
    .badge-type.page  { background: #dcfce7; color: #15803d; }
    .badge-type.url   { background: #fef3c7; color: #b45309; }
    .badge-inactive   { background: #fee2e2; color: #b91c1c; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.68rem; font-weight: 700; }

    .children-chips { display: flex; flex-wrap: wrap; gap: 0.35rem; }
    .chip {
        display: inline-flex; align-items: center; gap: 0.3rem;
        background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 999px;
        padding: 0.2rem 0.65rem; font-size: 0.7rem; font-weight: 600; color: #475569;
        text-decoration: none; transition: all 0.15s ease;
    }
    .chip:hover { border-color: var(--pln-blue); color: var(--pln-blue); }
    .chip.inactive { background: #fee2e2; border-color: #fecaca; color: #b91c1c; text-decoration: line-through; }
    .chip-add {
        display: inline-flex; align-items: center; gap: 0.3rem;
        background: #fff; border: 1px dashed #cbd5e1; border-radius: 999px;
        padding: 0.2rem 0.65rem; font-size: 0.7rem; font-weight: 600; color: #64748b;
        text-decoration: none; transition: all 0.15s ease;
    }
    .chip-add:hover { border-color: var(--pln-blue); color: var(--pln-blue); background: #f0f7ff; }

    .page-actions { display: flex; gap: 0.35rem; flex-wrap: wrap; align-items: center; }
    .btn-action {
        display: inline-flex; align-items: center; gap: 0.35rem;
        padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.75rem; font-weight: 600;
        text-decoration: none; border: 1px solid var(--border-color);
        background: #fff; color: #4b5563; cursor: pointer; transition: all 0.15s ease;
    }
    .btn-action:hover { border-color: var(--pln-blue); color: var(--pln-blue); }
    .btn-action.warn:hover   { border-color: #d97706; color: #d97706; }
    .btn-action.danger:hover { border-color: #dc2626; color: #dc2626; }
    .btn-move {
        border: 1px solid var(--border-color); background: #fff; color: #6b7280;
        border-radius: 7px; padding: 0.3rem 0.5rem; font-size: 0.65rem; cursor: pointer;
        transition: all 0.15s ease;
    }
    .btn-move:hover { border-color: var(--pln-blue); color: var(--pln-blue); }
    .btn-move:disabled { opacity: 0.35; cursor: not-allowed; }
    .order-num { font-weight: 700; color: var(--pln-text); font-size: 0.85rem; }
</style>
@endpush

@section('content')
<div class="menus-header">
    <div>
        <h5>Struktur Menu</h5>
        <p>Atur menu navigasi situs publik di sini — perubahan langsung tampil di navbar.</p>
    </div>
    @can('menus.create')
    <a href="{{ route('admin.menus.create') }}" class="btn-add-menu">
        <i class="fas fa-plus"></i> Tambah Menu
    </a>
    @endcan
</div>

@if (session('success'))
    <div class="alert alert-success py-2 px-3" style="border-radius:10px; font-size:0.83rem;">
        <i class="fas fa-circle-check me-2"></i>{{ session('success') }}
    </div>
@endif

<div class="howto-box">
    <div class="howto-title"><i class="fas fa-lightbulb"></i> Cara kerja menu</div>
    <ol>
        <li><strong>Menu Utama</strong> = grup dropdown besar (contoh: "Tentang Kami"). Biarkan <kbd>Menu Induk</kbd> kosong.</li>
        <li><strong>Submenu</strong> = item di dalam dropdown (contoh: "Berita" dalam grup "Informasi"). Pilih grupnya di <kbd>Menu Induk</kbd>.</li>
        <li>Simpan → langsung tampil di navbar. Urutan cukup pakai panah — tidak perlu isi angka.</li>
    </ol>
</div>

<div class="preview-wrap">
    <div class="preview-label"><i class="fas fa-eye"></i> Pratinjau navbar saat ini</div>
    <div class="preview-navbar">
        @php
            $previewTree = app(\App\Services\MenuBuilderService::class)->treeFor(auth()->user());
        @endphp
        @forelse ($previewTree as $pv)
            @if (count($pv['children']) > 0)
                <div class="pv-menu-dropdown">
                    <span class="pv-item">
                        @if ($pv['icon'])<i class="fas {{ $pv['icon'] }}"></i>@endif
                        {{ $pv['label'] }} <i class="fas fa-chevron-down pv-caret"></i>
                    </span>
                    <div class="pv-sub">
                        @foreach ($pv['children'] as $pvChild)
                            <a href="{{ $pvChild['url'] }}">{{ $pvChild['label'] }}</a>
                        @endforeach
                    </div>
                </div>
            @elseif ($pv['url'])
                <span class="pv-leaf">
                    @if ($pv['icon'])<i class="fas {{ $pv['icon'] }}"></i>@endif
                    {{ $pv['label'] }}
                </span>
            @endif
        @empty
            <span class="pv-leaf" style="opacity:0.75;">(memakai struktur default — tambahkan menu pertama Anda)</span>
        @endforelse
    </div>
    <div class="menu-target mt-2">
        <i class="fas fa-circle-info"></i> Inilah yang dilihat pengunjung — termasuk penyembunyian otomatis untuk menu ber-halaman internal.
    </div>
</div>

<div class="menus-card">
    <table class="menus-table">
        <thead>
            <tr>
                <th>Menu Utama</th>
                <th>Tujuan</th>
                <th>Submenu</th>
                <th style="width:1%;">Urutan</th>
                <th style="width:1%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($menus as $menu)
                <tr>
                    <td>
                        <div class="menu-label">
                            @if ($menu->icon)
                                <i class="fas {{ $menu->icon }}"></i>
                            @endif
                            {{ $menu->label }}
                            @unless ($menu->is_active)
                                <span class="badge-inactive">Disembunyikan</span>
                            @endunless
                        </div>
                        <div class="menu-target">
                            @if ($menu->type === 'route')
                                <i class="fas fa-link"></i>Halaman situs
                            @elseif ($menu->type === 'page')
                                <i class="fas fa-file-lines"></i>Halaman CMS{{ $menu->page ? ': ' . $menu->page->slug : ' (halaman sudah dihapus)' }}
                            @else
                                <i class="fas fa-up-right-from-square"></i>{{ $menu->url }}
                            @endif
                        </div>
                    </td>
                    <td><span class="badge-type {{ $menu->type }}">{{ $typeLabels[$menu->type] ?? $menu->type }}</span></td>
                    <td>
                        @if ($menu->children->isEmpty())
                            <span class="text-muted small">—</span>
                        @else
                            <div class="children-chips">
                                @foreach ($menu->children as $child)
                                    <a href="{{ route('admin.menus.edit', $child) }}" class="chip {{ $child->is_active ? '' : 'inactive' }}" title="Klik untuk mengedit">
                                        {{ $child->label }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        @can('menus.create')
                        <a href="{{ route('admin.menus.create', ['parent' => $menu->id]) }}" class="chip-add mt-1">
                            <i class="fas fa-plus"></i> Tambah submenu
                        </a>
                        @endcan
                    </td>
                    <td>
                        <span class="order-num">{{ $menu->sort_order }}</span>
                        @can('menus.edit')
                        <span class="d-flex gap-1 mt-1">
                            <form method="POST" action="{{ route('admin.menus.move', $menu) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="direction" value="up">
                                <button type="submit" class="btn-move" title="Naikkan" @disabled($loop->first)><i class="fas fa-arrow-up"></i></button>
                            </form>
                            <form method="POST" action="{{ route('admin.menus.move', $menu) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="direction" value="down">
                                <button type="submit" class="btn-move" title="Turunkan" @disabled($loop->last)><i class="fas fa-arrow-down"></i></button>
                            </form>
                        </span>
                        @endcan
                    </td>
                    <td>
                        <div class="page-actions">
                            @can('menus.edit')
                            <a href="{{ route('admin.menus.edit', $menu) }}" class="btn-action"><i class="fas fa-pen"></i> Edit</a>
                            <form method="POST" action="{{ route('admin.menus.toggle-status', $menu) }}">
                                @csrf
                                <button type="submit" class="btn-action {{ $menu->is_active ? 'warn' : '' }}" title="{{ $menu->is_active ? 'Sembunyikan dari navbar' : 'Tampilkan lagi di navbar' }}">
                                    <i class="fas {{ $menu->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                    {{ $menu->is_active ? 'Tampil' : 'Tersembunyi' }}
                                </button>
                            </form>
                            @endcan
                            @can('menus.delete')
                            <form method="POST" action="{{ route('admin.menus.destroy', $menu) }}" onsubmit="return confirm('Hapus menu \\'{{ $menu->label }}\\'? Submenu di dalamnya ikut terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-5">
                        <i class="fas fa-bars fa-2x mb-3 d-block" style="color:#d1d5db;"></i>
                        Belum ada menu di database — navbar memakai struktur default bawaan.<br>
                        Klik "Tambah Menu" untuk mulai mengatur sendiri.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3 d-flex justify-content-center">
    {{ $menus->withQueryString()->links() }}
</div>
@endsection
