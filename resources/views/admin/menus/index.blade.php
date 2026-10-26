@extends('layouts.admin')

@section('title', 'Kelola Menu — E-PPID PLN')
@section('page-title', 'Kelola Menu')

@push('styles')
<style>
    /* menus-header/btn-add-menu → page-header-card + btn-corp-add (global di admin.css) */

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

    /* Modal Tambah Menu (lebar + rata kiri, beda dengan modal konfirmasi) */
    .modal-menu-dialog {
        background: #fff; border-radius: 16px; padding: 1.5rem 1.75rem 2.5rem;
        max-width: 520px; width: 100%; text-align: left;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        animation: modalPlnIn 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        max-height: 90vh; overflow: visible;
    }
    .modal-menu-form {
        overflow: visible;
    }
    .modal-menu-title { font-size: 1rem; font-weight: 800; color: var(--pln-text); margin: 0; }
    .modal-menu-sub { font-size: 0.75rem; color: #9ca3af; margin: 0.2rem 0 0; }
    .modal-menu-close {
        border: none; background: #f1f5f9; color: #64748b; width: 30px; height: 30px;
        border-radius: 8px; cursor: pointer; flex-shrink: 0;
    }
    .modal-menu-close:hover { background: #e2e8f0; color: #334155; }

    /* Kelas form dipakai modal: form-label-mod, form-control-mod, form-hint,
       form-btn-save → global di public/css/admin.css */

    /* Custom Dropdown untuk modal menu (pengganti select bawaan) */
    .menu-dd { position: relative; }
    .menu-dd-trigger {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.6rem;
        width: 100%;
        text-align: left;
        line-height: 1.4;
        cursor: pointer;
    }
    .menu-dd-trigger:disabled { cursor: not-allowed; opacity: 0.65; }
    .menu-dd-label {
        flex: 1 1 auto;
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .menu-dd-trigger.is-placeholder .menu-dd-label { color: #9ca3af; font-style: italic; }
    .menu-dd-chevron {
        flex-shrink: 0;
        font-size: 0.7rem;
        color: #9ca3af;
        transition: transform 0.18s ease, color 0.18s ease;
    }
    .menu-dd.is-open .menu-dd-chevron { transform: rotate(180deg); color: var(--pln-blue); }
    .menu-dd.is-open .menu-dd-trigger {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0, 91, 156, 0.12);
    }

    .menu-dd-menu {
        position: absolute;
        top: calc(100% + 6px);
        bottom: auto;
        left: 0;
        right: 0;
        z-index: 20000;
        box-sizing: border-box;
        padding: 6px;
        background: #fff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.12);
        max-height: 180px;
        overflow-y: auto;
        overscroll-behavior: contain;
        scrollbar-width: thin;
        scrollbar-color: rgba(148, 163, 184, 0.45) transparent;
        animation: menu-dd-in 0.14s ease-out;
    }
    .menu-dd.menu-dd-up .menu-dd-menu {
        top: auto;
        bottom: calc(100% + 6px);
        animation: menu-dd-in-up 0.14s ease-out;
    }
    @keyframes menu-dd-in-up {
        from { opacity: 0; transform: translateY(4px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .menu-dd-menu[hidden] { display: none; }
    @keyframes menu-dd-in {
        from { opacity: 0; transform: translateY(-4px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .menu-dd-menu::-webkit-scrollbar { width: 6px; }
    .menu-dd-menu::-webkit-scrollbar-track { background: transparent; }
    .menu-dd-menu::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, 0.45);
        border-radius: 8px;
    }
    .menu-dd-menu::-webkit-scrollbar-thumb:hover { background: rgba(100, 116, 139, 0.6); }

    .menu-dd .menu-dd-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
        width: 100%;
        padding: 8px 12px;
        border: 0;
        background: transparent;
        border-radius: 10px;
        font-family: inherit;
        font-size: 0.85rem;
        line-height: 1.4;
        color: #1f2937;
        text-align: left;
        cursor: pointer;
        transition: background 0.15s ease, color 0.15s ease;
    }
    .menu-dd .menu-dd-option + .menu-dd-option { margin-top: 2px; }
    .menu-dd .menu-dd-option:hover,
    .menu-dd .menu-dd-option:focus-visible {
        background: rgba(0, 91, 156, 0.08);
        color: var(--pln-blue);
        outline: none;
    }
    .menu-dd .menu-dd-option.is-selected {
        background: rgba(0, 91, 156, 0.12);
        color: var(--pln-blue);
        font-weight: 600;
    }
    .menu-dd-check { display: none; font-size: 0.7rem; flex-shrink: 0; }
    .menu-dd .menu-dd-option.is-selected .menu-dd-check { display: inline-block; }

    html.theme-dark .menu-dd-menu { background: var(--panel); border-color: var(--line); box-shadow: 0 10px 30px rgba(0,0,0,0.4); }
    html.theme-dark .menu-dd .menu-dd-option { color: var(--ink-heading); }
    html.theme-dark .menu-dd .menu-dd-option:hover,
    html.theme-dark .menu-dd .menu-dd-option:focus-visible { background: rgba(0, 163, 224, 0.12); color: var(--pln-cyan); }
    html.theme-dark .menu-dd .menu-dd-option.is-selected { background: rgba(0, 163, 224, 0.14); color: var(--pln-cyan); }
</style>
@endpush

@section('content')
<div class="page-header-card">
    <div class="header-row">
        <div class="header-left">
            <h5><i class="fas fa-bars header-icon"></i>Struktur Menu</h5>
            <p>Atur menu navigasi situs publik di sini — perubahan langsung tampil di navbar.</p>
        </div>
        @can('menus.create')
        <button type="button" class="btn-corp btn-corp-add" onclick="openMenuModal()">
            <i class="fas fa-plus"></i> Tambah Menu
        </button>
        @endcan
    </div>
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
                                <i class="fas fa-file-lines"></i>Halaman: {{ $menu->page ? $menu->page->title : '(halaman sudah dihapus)' }}
                            @else
                                <i class="fas fa-up-right-from-square"></i>{{ $menu->url }}
                            @endif
                        </div>
                    </td>
                    <td>
                        @if ($menu->type === 'page')
                            <span class="badge-type page" title="/halaman/{{ $menu->page?->slug }}">
                                <i class="fas fa-file-lines me-1"></i>Halaman: {{ $menu->page?->title ?? '(dihapus)' }}
                            </span>
                        @else
                            <span class="badge-type {{ $menu->type }}">{{ $typeLabels[$menu->type] ?? $menu->type }}</span>
                        @endif
                    </td>
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
                        <button type="button" class="chip-add mt-1" style="cursor:pointer;"
                                onclick="openMenuModal({{ $menu->id }}, '{{ addslashes($menu->label) }}')">
                            <i class="fas fa-plus"></i> Tambah submenu
                        </button>
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
                                @method('PATCH')
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

{{-- ============================================================
     MODAL TAMBAH MENU / SUBMENU
     Dropdown "Pilih Halaman Internal" diisi dari tabel pages
     (hanya berstatus Terbit) — dikirim dari MenuController@index.
     ============================================================ --}}
@can('menus.create')
<div class="modal-pln-overlay" id="menuModal" onclick="if(event.target===this) closeMenuModal()">
    <div class="modal-menu-dialog">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h6 class="modal-menu-title" id="menuModalTitle">Tambah Menu</h6>
                <p class="modal-menu-sub">Menu langsung tampil di navbar publik setelah disimpan.</p>
            </div>
            <button type="button" class="modal-menu-close" onclick="closeMenuModal()" aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>

        <form id="menuModalForm" class="modal-menu-form" method="POST" action="{{ route('admin.menus.store') }}">
            @csrf
            <input type="hidden" name="parent_id" id="menuModalParent" value="">
            <input type="hidden" name="is_active" value="1">
            <input type="hidden" name="target" value="_self">

            @if ($errors->any() && old('label') !== null)
                <div class="alert alert-danger py-2 px-3" style="border-radius:10px; font-size:0.8rem;">
                    <i class="fas fa-circle-exclamation me-2"></i>{{ $errors->first() }}
                </div>
            @endif

            <div class="mb-3">
                <label class="form-group-label" for="menuModalLabel">Nama menu <span class="required">*</span></label>
                <input type="text" id="menuModalLabel" name="label" class="form-input" placeholder="Contoh: Karier" required>
            </div>

            <div class="mb-3">
                <label class="form-group-label" for="menuModalTypeTrigger">Tipe tujuan <span class="required">*</span></label>
                <select id="menuModalType" name="type" class="form-input d-none" onchange="if(window.toggleMenuModalTargets) toggleMenuModalTargets();">
                    @foreach ($typeLabels as $typeKey => $typeLabel)
                        <option value="{{ $typeKey }}" @selected($loop->first)>{{ $typeLabel }}</option>
                    @endforeach
                </select>
                <div class="menu-dd" id="menuTypeDd">
                    <button type="button" id="menuModalTypeTrigger" class="form-input menu-dd-trigger" aria-haspopup="listbox" aria-expanded="false" aria-controls="menuTypeDdMenu">
                        <span class="menu-dd-label" id="menuModalTypeLabel">{{ reset($typeLabels) }}</span>
                        <i class="fas fa-chevron-down menu-dd-chevron" aria-hidden="true"></i>
                    </button>
                    <div class="menu-dd-menu" id="menuTypeDdMenu" role="listbox" aria-labelledby="menuModalTypeTrigger" hidden>
                        @foreach ($typeLabels as $typeKey => $typeLabel)
                            <button type="button" class="menu-dd-option{{ $loop->first ? ' is-selected' : '' }}" role="option" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-value="{{ $typeKey }}" data-label="{{ $typeLabel }}">
                                <span>{{ $typeLabel }}</span>
                                <i class="fas fa-check menu-dd-check" aria-hidden="true"></i>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mb-3 menu-modal-target" data-for="route" style="display:none;">
                <label class="form-group-label" for="menuModalRouteTrigger">Pilih halaman situs</label>
                <select id="menuModalRoute" name="route_name" class="form-input d-none">
                    <option value="">— pilih —</option>
                    @foreach ($routeOptions ?? [] as $routeName => $routeLabel)
                        <option value="{{ $routeName }}">{{ $routeLabel }}</option>
                    @endforeach
                </select>
                <div class="menu-dd" id="menuRouteDd">
                    <button type="button" id="menuModalRouteTrigger" class="form-input menu-dd-trigger is-placeholder" aria-haspopup="listbox" aria-expanded="false" aria-controls="menuRouteDdMenu">
                        <span class="menu-dd-label" id="menuModalRouteLabel">— pilih —</span>
                        <i class="fas fa-chevron-down menu-dd-chevron" aria-hidden="true"></i>
                    </button>
                    <div class="menu-dd-menu" id="menuRouteDdMenu" role="listbox" aria-labelledby="menuModalRouteTrigger" hidden>
                        <button type="button" class="menu-dd-option menu-dd-empty is-selected" role="option" aria-selected="true" data-value="" data-label="— pilih —">
                            <span>— pilih —</span>
                            <i class="fas fa-check menu-dd-check" aria-hidden="true"></i>
                        </button>
                        @foreach ($routeOptions ?? [] as $routeName => $routeLabel)
                            <button type="button" class="menu-dd-option" role="option" aria-selected="false" data-value="{{ $routeName }}" data-label="{{ $routeLabel }}">
                                <span>{{ $routeLabel }}</span>
                                <i class="fas fa-check menu-dd-check" aria-hidden="true"></i>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mb-3 menu-modal-target" data-for="page" style="display:none;">
                <label class="form-group-label" for="menuModalPageTrigger">Pilih Halaman Internal <span class="required">*</span></label>
                <select id="menuModalPage" name="page_id" class="form-input d-none">
                    <option value="">— pilih —</option>
                    @foreach ($pages as $pageOption)
                        <option value="{{ $pageOption->id }}">{{ $pageOption->title }} (/halaman/{{ $pageOption->slug }})</option>
                    @endforeach
                </select>
                <div class="menu-dd" id="menuPageDd">
                    <button type="button" id="menuModalPageTrigger" class="form-input menu-dd-trigger is-placeholder" aria-haspopup="listbox" aria-expanded="false" aria-controls="menuPageDdMenu">
                        <span class="menu-dd-label" id="menuModalPageLabel">— pilih —</span>
                        <i class="fas fa-chevron-down menu-dd-chevron" aria-hidden="true"></i>
                    </button>
                    <div class="menu-dd-menu" id="menuPageDdMenu" role="listbox" aria-labelledby="menuModalPageTrigger" hidden>
                        <button type="button" class="menu-dd-option menu-dd-empty is-selected" role="option" aria-selected="true" data-value="" data-label="— pilih —">
                            <span>— pilih —</span>
                            <i class="fas fa-check menu-dd-check" aria-hidden="true"></i>
                        </button>
                        @foreach ($pages as $pageOption)
                            <button type="button" class="menu-dd-option" role="option" aria-selected="false" data-value="{{ $pageOption->id }}" data-label="{{ $pageOption->title }} (/halaman/{{ $pageOption->slug }})">
                                <span>{{ $pageOption->title }} (/halaman/{{ $pageOption->slug }})</span>
                                <i class="fas fa-check menu-dd-check" aria-hidden="true"></i>
                            </button>
                        @endforeach
                    </div>
                </div>
                <div class="form-hint flex">
                    <i class="fas fa-shield-halved"></i>
                    Hanya halaman berstatus <strong>Terbit</strong> yang terdaftar. Menu ini otomatis disembunyikan dari pengunjung yang tidak berhak melihat halamannya.
                </div>
            </div>

            <div class="mb-3 menu-modal-target" data-for="url" style="display:none;">
                <label class="form-group-label" for="menuModalUrl">Alamat link <span class="required">*</span></label>
                <input type="text" id="menuModalUrl" name="url" class="form-input" placeholder="Contoh: https://web.pln.co.id">
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="button" class="btn-corp btn-corp-cancel" onclick="closeMenuModal()">
                    Batal
                </button>
                <button type="submit" class="form-btn-save" style="padding:0.6rem 1.5rem; border-radius:10px;">
                    <i class="fas fa-floppy-disk"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function initMenuDropdown(wrapId, selectId, labelId, onChange) {
        var wrap = document.getElementById(wrapId);
        if (!wrap) return;
        var trigger = wrap.querySelector('.menu-dd-trigger');
        var menu = wrap.querySelector('.menu-dd-menu');
        var selectEl = document.getElementById(selectId);
        var labelEl = document.getElementById(labelId);
        var options = Array.prototype.slice.call(menu.querySelectorAll('.menu-dd-option'));
        if (!trigger || !selectEl || !menu || options.length === 0) return;

        function setOpen(open) {
            wrap.classList.remove('menu-dd-up');
            if (open) {
                var rect = wrap.getBoundingClientRect();
                var spaceBelow = window.innerHeight - rect.bottom;
                var menuHeight = 180 + 12;
                if (spaceBelow < menuHeight && rect.top > menuHeight) {
                    wrap.classList.add('menu-dd-up');
                }
            }
            menu.hidden = !open;
            wrap.classList.toggle('is-open', open);
            trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
            if (open) {
                var idx = options.findIndex(function (o) { return o.classList.contains('is-selected'); });
                var target = options[idx >= 0 ? idx : 0];
                target.focus();
                target.scrollIntoView({ block: 'nearest' });
            }
        }

        function syncFromSelect() {
            var val = selectEl.value;
            var found = null;
            options.forEach(function (o) {
                var on = (o.dataset.value || '') === (val || '');
                o.classList.toggle('is-selected', on);
                o.setAttribute('aria-selected', on ? 'true' : 'false');
                if (on) found = o;
            });
            if (found) {
                if (labelEl) labelEl.textContent = found.dataset.label || found.textContent.trim();
                trigger.classList.toggle('is-placeholder', (found.dataset.value || '') === '');
            } else if (options.length) {
                options[0].classList.add('is-selected');
                options[0].setAttribute('aria-selected', 'true');
                if (labelEl) labelEl.textContent = options[0].dataset.label || options[0].textContent.trim();
                trigger.classList.toggle('is-placeholder', (options[0].dataset.value || '') === '');
                selectEl.value = options[0].dataset.value || '';
                options.forEach(function (o, idx) {
                    if (idx === 0) {
                        o.classList.add('is-selected');
                        o.setAttribute('aria-selected', 'true');
                    } else {
                        o.classList.remove('is-selected');
                        o.setAttribute('aria-selected', 'false');
                    }
                });
            }
            if (typeof onChange === 'function') onChange(selectEl.value);
        }

        function choose(opt) {
            var val = opt.dataset.value || '';
            selectEl.value = val;
            if (labelEl) {
                labelEl.textContent = opt.dataset.label || opt.textContent.trim();
            }
            trigger.classList.toggle('is-placeholder', val === '');
            options.forEach(function (o) {
                var on = o === opt;
                o.classList.toggle('is-selected', on);
                o.setAttribute('aria-selected', on ? 'true' : 'false');
            });
            selectEl.dispatchEvent(new Event('input', { bubbles: true }));
            selectEl.dispatchEvent(new Event('change', { bubbles: true }));
            if (typeof onChange === 'function') onChange(val);
            setOpen(false);
            trigger.focus();
        }

        selectEl.addEventListener('change', syncFromSelect);

        trigger.addEventListener('click', function () { setOpen(menu.hidden); });
        options.forEach(function (opt) {
            opt.addEventListener('click', function () { choose(opt); });
        });
        trigger.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') { setOpen(false); return; }
            if (e.key === 'ArrowDown' || e.key === 'ArrowUp' || e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                setOpen(true);
                if (e.key === 'ArrowUp') options[options.length - 1].focus();
            }
        });
        menu.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                e.preventDefault();
                setOpen(false);
                trigger.focus();
                return;
            }
            if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                e.preventDefault();
                var i = options.indexOf(document.activeElement);
                var next = e.key === 'ArrowDown' ? Math.min(i + 1, options.length - 1) : Math.max(i - 1, 0);
                options[next].focus();
                options[next].scrollIntoView({ block: 'nearest' });
            } else if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                if (document.activeElement && document.activeElement.classList.contains('menu-dd-option')) {
                    choose(document.activeElement);
                }
            }
        });
        document.addEventListener('mousedown', function (e) {
            if (!menu.hidden && !wrap.contains(e.target)) setOpen(false);
        });
        wrap.addEventListener('focusout', function () {
            requestAnimationFrame(function () {
                if (!wrap.contains(document.activeElement)) setOpen(false);
            });
        });

        // initial sync to be safe
        syncFromSelect();

        return { choose: choose, setOpen: setOpen, options: options, syncFromSelect: syncFromSelect };
    }

    var menuTypeDropdown, menuRouteDropdown, menuPageDropdown;

    function toggleMenuModalTargets() {
        var type = document.getElementById('menuModalType').value;
        document.querySelectorAll('.menu-modal-target').forEach(function (el) {
            el.style.display = (el.dataset.for === type) ? '' : 'none';
        });
    }

    function openMenuModal(parentId, parentLabel) {
        var form = document.getElementById('menuModalForm');
        form.reset();

        var isSubmenu = !!parentId;
        document.getElementById('menuModalParent').value = isSubmenu ? parentId : '';
        document.getElementById('menuModalTitle').textContent = isSubmenu
            ? 'Tambah Submenu di \'' + parentLabel + '\''
            : 'Tambah Menu';

        var typeSel = document.getElementById('menuModalType');
        var routeSel = document.getElementById('menuModalRoute');
        var pageSel = document.getElementById('menuModalPage');
        if (typeSel && typeSel.options.length) typeSel.value = typeSel.options[0].value;
        if (routeSel) routeSel.value = '';
        if (pageSel) pageSel.value = '';
        document.getElementById('menuModalUrl').value = '';

        if (menuTypeDropdown && typeof menuTypeDropdown.syncFromSelect === 'function') menuTypeDropdown.syncFromSelect();
        if (menuRouteDropdown && typeof menuRouteDropdown.syncFromSelect === 'function') menuRouteDropdown.syncFromSelect();
        if (menuPageDropdown && typeof menuPageDropdown.syncFromSelect === 'function') menuPageDropdown.syncFromSelect();

        document.querySelectorAll('.menu-dd').forEach(function (el) { el.classList.remove('menu-dd-up'); });

        toggleMenuModalTargets();
        document.getElementById('menuModal').classList.add('show');
        document.getElementById('menuModalLabel').focus();
    }

    function closeMenuModal() {
        document.getElementById('menuModal').classList.remove('show');
        document.querySelectorAll('.menu-dd').forEach(function (el) { el.classList.remove('menu-dd-up'); });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeMenuModal();
    });

    document.addEventListener('DOMContentLoaded', function () {
        menuTypeDropdown = initMenuDropdown('menuTypeDd', 'menuModalType', 'menuModalTypeLabel', toggleMenuModalTargets);
        menuRouteDropdown = initMenuDropdown('menuRouteDd', 'menuModalRoute', 'menuModalRouteLabel');
        menuPageDropdown = initMenuDropdown('menuPageDd', 'menuModalPage', 'menuModalPageLabel');
        toggleMenuModalTargets();
    });

    {{-- Setelah gagal validasi: buka lagi modal + kembalikan nilai yang sudah diisi --}}
    @if ($errors->any() && old('label') !== null)
        (function () {
            var parentId = @js((string) old('parent_id'));
            openMenuModal(parentId ? parseInt(parentId, 10) : null, '');

            document.getElementById('menuModalLabel').value = @js((string) old('label'));
            document.getElementById('menuModalUrl').value = @js((string) old('url', ''));

            var typeSel = document.getElementById('menuModalType');
            var routeSel = document.getElementById('menuModalRoute');
            var pageSel = document.getElementById('menuModalPage');
            if (typeSel) typeSel.value = @js((string) old('type', 'route'));
            if (routeSel) routeSel.value = @js((string) old('route_name', ''));
            if (pageSel) pageSel.value = @js((string) (old('page_id') ?? ''));

            function syncCustom(wrapId, selectId) {
                var wrap = document.getElementById(wrapId);
                var selectEl = document.getElementById(selectId);
                if (!wrap || !selectEl) return;
                var options = wrap.querySelectorAll('.menu-dd-option');
                var labelEl = wrap.querySelector('.menu-dd-label');
                var trigger = wrap.querySelector('.menu-dd-trigger');
                var val = selectEl.value;
                var found = null;
                options.forEach(function (o) {
                    var on = (o.dataset.value || '') === (val || '');
                    o.classList.toggle('is-selected', on);
                    o.setAttribute('aria-selected', on ? 'true' : 'false');
                    if (on) found = o;
                });
                if (found) {
                    if (labelEl) labelEl.textContent = found.dataset.label || found.textContent.trim();
                    if (trigger) trigger.classList.toggle('is-placeholder', (found.dataset.value || '') === '');
                } else if (options.length) {
                    options[0].classList.add('is-selected');
                    options[0].setAttribute('aria-selected', 'true');
                    if (labelEl) labelEl.textContent = options[0].dataset.label || options[0].textContent.trim();
                    if (trigger) trigger.classList.toggle('is-placeholder', (options[0].dataset.value || '') === '');
                    selectEl.value = options[0].dataset.value || '';
                }
            }

            syncCustom('menuTypeDd', 'menuModalType');
            syncCustom('menuRouteDd', 'menuModalRoute');
            syncCustom('menuPageDd', 'menuModalPage');

            toggleMenuModalTargets();
        })();
    @endif
</script>
@endcan
@endsection
