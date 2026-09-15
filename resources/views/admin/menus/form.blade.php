@extends('layouts.admin')

@section('title', ($menu ? 'Edit Menu' : 'Tambah Menu') . ' — E-PPID PLN')
@section('page-title', $menu ? 'Edit Menu' : 'Tambah Menu')

@push('styles')
<style>
    .form-topbar {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1.5rem; flex-wrap: wrap; gap: 0.75rem;
    }
    .form-back-btn {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.5rem 1rem; background: var(--bg-card);
        border: 1px solid var(--border-color); border-radius: 10px;
        color: #6b7280; font-weight: 600; font-size: 0.82rem; text-decoration: none;
        transition: all 0.2s ease;
    }
    .form-back-btn:hover { border-color: var(--pln-blue); color: var(--pln-blue); }
    .form-page-title { font-size: 1.25rem; font-weight: 800; color: var(--pln-text); margin: 0; }
    .form-page-subtitle { font-size: 0.8rem; color: #9ca3af; margin: 0.15rem 0 0; }
    .form-btn-save {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.6rem 1.5rem; background: var(--pln-blue); color: #fff;
        border: none; border-radius: 10px; font-weight: 600; font-size: 0.85rem; cursor: pointer;
        transition: all 0.25s ease;
    }
    .form-btn-save:hover { background: #003d6b; transform: translateY(-1px); }

    .form-section {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 14px; padding: 1.5rem; margin-bottom: 1rem;
    }
    .form-section-header {
        display: flex; align-items: center; gap: 0.65rem;
        margin-bottom: 1.25rem; padding-bottom: 0.85rem; border-bottom: 1px solid #f3f4f6;
    }
    .form-section-header .icon-circle {
        width: 34px; height: 34px; border-radius: 9px;
        background: #e8f1fa; color: var(--pln-blue);
        display: flex; align-items: center; justify-content: center; font-size: 0.85rem;
    }
    .form-section-header h6 { margin: 0; font-weight: 700; color: var(--pln-text); font-size: 0.95rem; }
    .form-label-mod { font-size: 0.8rem; font-weight: 600; color: #4b5563; margin-bottom: 0.35rem; }
    .form-control-mod {
        width: 100%; padding: 0.65rem 0.9rem; border: 1px solid #e5e7eb;
        border-radius: 10px; font-size: 0.85rem; color: var(--pln-text); background: #fff;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .form-control-mod:focus { outline: none; border-color: var(--pln-blue); box-shadow: 0 0 0 3px rgba(0,91,156,0.1); }
    .invalid-feedback-mod { color: #dc2626; font-size: 0.75rem; margin-top: 0.3rem; }
    .form-hint { font-size: 0.72rem; color: #9ca3af; margin-top: 0.3rem; }

    /* Kartu pilihan tipe tujuan */
    .type-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.75rem; }
    .type-card {
        border: 2px solid #e5e7eb; border-radius: 12px; padding: 0.9rem 1rem;
        cursor: pointer; transition: all 0.15s ease; background: #fff; display: block;
    }
    .type-card:hover { border-color: #93c5fd; }
    .type-card input { display: none; }
    .type-card .tc-title {
        display: flex; align-items: center; gap: 0.5rem;
        font-weight: 700; font-size: 0.83rem; color: var(--pln-text);
    }
    .type-card .tc-title i { color: var(--pln-blue); width: 1.1rem; text-align: center; }
    .type-card .tc-desc { font-size: 0.73rem; color: #6b7280; margin-top: 0.35rem; line-height: 1.5; }
    .type-card.selected { border-color: var(--pln-blue); background: #f0f7ff; }
    .type-card.selected .tc-title { color: var(--pln-blue); }

    /* Icon picker */
    .icon-grid { display: flex; flex-wrap: wrap; gap: 0.4rem; }
    .icon-opt {
        width: 38px; height: 38px; border: 1px solid #e5e7eb; border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        color: #4b5563; cursor: pointer; background: #fff; transition: all 0.15s ease;
    }
    .icon-opt:hover { border-color: var(--pln-blue); color: var(--pln-blue); }
    .icon-opt.selected { border-color: var(--pln-blue); background: var(--pln-blue); color: #fff; }
    .icon-custom-row { display: flex; gap: 0.5rem; align-items: center; margin-top: 0.75rem; }
    .icon-preview {
        width: 38px; height: 38px; border-radius: 9px; border: 1px dashed #cbd5e1;
        display: flex; align-items: center; justify-content: center; color: var(--pln-blue);
        flex-shrink: 0;
    }
</style>
@endpush

@section('content')
<div class="form-topbar">
    <div>
        <a href="{{ route('admin.menus.index') }}" class="form-back-btn mb-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h1 class="form-page-title">{{ $menu ? 'Edit Menu' : 'Tambah Menu' }}</h1>
        <p class="form-page-subtitle">
            {{ $menu
                ? 'Mengubah "' . $menu->label . '" — perubahan langsung tampil di navbar situs.'
                : 'Menu baru akan langsung tampil di navbar setelah disimpan.' }}
        </p>
    </div>
    <button type="submit" form="menuForm" class="form-btn-save">
        <i class="fas fa-floppy-disk"></i> Simpan Menu
    </button>
</div>

<form id="menuForm" method="POST"
      action="{{ $menu ? route('admin.menus.update', $menu) : route('admin.menus.store') }}">
    @csrf
    @if ($menu)
        @method('PUT')
    @endif

    <div class="form-section">
        <div class="form-section-header">
            <div class="icon-circle"><i class="fas fa-pen"></i></div>
            <h6>Nama & Posisi Menu</h6>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label-mod" for="label">Nama menu <span class="text-danger">*</span></label>
                <input type="text" id="label" name="label" value="{{ old('label', $menu->label ?? '') }}"
                       class="form-control-mod @error('label') is-invalid @enderror"
                       placeholder="Contoh: Karier" required>
                @error('label')<div class="invalid-feedback-mod">{{ $message }}</div>@enderror
                <div class="form-hint">Teks yang dilihat pengunjung di navbar.</div>
            </div>
            <div class="col-md-6">
                <label class="form-label-mod" for="parent_id">Letak menu</label>
                <select id="parent_id" name="parent_id" class="form-control-mod">
                    <option value="">Sebagai grup sendiri di navbar (Menu Utama)</option>
                    @foreach ($parents as $id => $label)
                        <option value="{{ $id }}" @selected(old('parent_id', $menu->parent_id ?? '') == $id)>
                            Di dalam dropdown "{{ $label }}"
                        </option>
                    @endforeach
                </select>
                <div class="form-hint">
                    Menu Utama = dropdown besar (contoh: "Tentang Kami"). Submenu = item di dalamnya (contoh: "Berita").
                </div>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="form-section-header">
            <div class="icon-circle"><i class="fas fa-location-arrow"></i></div>
            <h6>Mau mengarah ke mana?</h6>
        </div>

        <div class="type-cards">
            @foreach ($typeLabels as $typeKey => $typeLabel)
                <label class="type-card {{ old('type', $menu->type ?? 'route') === $typeKey ? 'selected' : '' }}" data-type="{{ $typeKey }}">
                    <input type="radio" name="type" value="{{ $typeKey }}" data-type-radio
                           {{ old('type', $menu->type ?? 'route') === $typeKey ? 'checked' : '' }}>
                    <span class="tc-title">
                        <i class="fas {{ ['route' => 'fa-sitemap', 'page' => 'fa-file-lines', 'url' => 'fa-up-right-from-square'][$typeKey] ?? 'fa-link' }}"></i>
                        {{ $typeLabel }}
                    </span>
                    <div class="tc-desc">{{ $typeDescriptions[$typeKey] ?? '' }}</div>
                </label>
            @endforeach
        </div>

        <div class="mt-3 type-field" data-for="route">
            <label class="form-label-mod" for="route_name">Pilih halaman situs</label>
            <select id="route_name" name="route_name" class="form-control-mod">
                <option value="">— pilih —</option>
                @foreach ($routeOptions as $routeName => $routeLabel)
                    <option value="{{ $routeName }}" @selected(old('route_name', $menu->route_name ?? '') === $routeName)>{{ $routeLabel }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-3 type-field" data-for="page" style="display:none;">
            <label class="form-label-mod" for="page_id">Pilih halaman buatan sendiri</label>
            <select id="page_id" name="page_id" class="form-control-mod">
                <option value="">— pilih —</option>
                @foreach ($pages as $pageOption)
                    <option value="{{ $pageOption->id }}" @selected(old('page_id', $menu->page_id ?? '') == $pageOption->id)>
                        {{ $pageOption->title }} ({{ $pageOption->status === 'published' ? 'terbit' : 'draft' }}{{ $pageOption->visibility === 'role_restricted' ? ', khusus role tertentu' : '' }})
                    </option>
                @endforeach
            </select>
            <div class="form-hint">
                <i class="fas fa-shield-halved me-1"></i>
                Menu ini otomatis disembunyikan dari pengunjung yang tidak berhak melihat halamannya.
                Belum punya halaman? Buat dulu di menu <strong>Halaman</strong> di sidebar.
            </div>
        </div>

        <div class="mt-3 type-field" data-for="url" style="display:none;">
            <label class="form-label-mod" for="url">Alamat link</label>
            <input type="text" id="url" name="url" value="{{ old('url', $menu->url ?? '') }}"
                   class="form-control-mod" placeholder="Contoh: https://web.pln.co.id">
            <div class="form-hint">Bisa alamat situs lain, atau alamat dalam situs ini yang diawali "/".</div>
        </div>
        @error('url')
            @if (old('type', $menu->type ?? '') === 'url')
                <div class="invalid-feedback-mod mt-1">{{ $message }}</div>
            @endif
        @enderror
    </div>

    <div class="form-section">
        <div class="form-section-header">
            <div class="icon-circle"><i class="fas fa-icons"></i></div>
            <h6>Ikon (opsional)</h6>
        </div>
        <div class="icon-grid" id="iconGrid">
            @foreach ($iconChoices as $iconChoice)
                <button type="button" class="icon-opt {{ old('icon', $menu->icon ?? '') === $iconChoice ? 'selected' : '' }}"
                        data-icon="{{ $iconChoice }}" title="{{ $iconChoice }}">
                    <i class="fas {{ $iconChoice }}"></i>
                </button>
            @endforeach
        </div>
        <div class="icon-custom-row">
            <span class="icon-preview" id="iconPreview">
                <i class="fas {{ old('icon', $menu->icon ?? 'fa-link') ?: 'fa-link' }}" id="iconPreviewIcon"></i>
            </span>
            <div style="flex:1;">
                <input type="text" id="icon" name="icon" value="{{ old('icon', $menu->icon ?? '') }}"
                       class="form-control-mod" placeholder="Kosongkan untuk tanpa ikon, atau ketik kode sendiri">
                <div class="form-hint">Klik ikon di atas untuk memilih, atau ketik manual (otomatis diberi awalan fa-).</div>
            </div>
        </div>

        <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                   {{ old('is_active', $menu->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label small" for="is_active">
                Tampilkan di navbar <span class="text-muted">(hilangkan centang untuk menyembunyikan sementara tanpa menghapus)</span>
            </label>
        </div>
    </div>
</form>

{{-- ============================================================
     Script INLINE di dalam content section — WAJIB di sini (bukan
     @push('scripts')) karena client-side router (router.js) hanya
     menukar isi <main> dan mengeksekusi ulang <script> di dalamnya.
     ============================================================ --}}
<script>
    (function() {
        // Kartu tipe: highlight + tampilkan field target yang relevan
        var typeRadios = document.querySelectorAll('[data-type-radio]');
        function syncType() {
            var current = 'route';
            typeRadios.forEach(function (r) {
                r.closest('.type-card').classList.toggle('selected', r.checked);
                if (r.checked) current = r.value;
            });
            document.querySelectorAll('.type-field').forEach(function (el) {
                el.style.display = (el.dataset.for === current) ? '' : 'none';
            });
        }
        typeRadios.forEach(function (r) { r.addEventListener('change', syncType); });
        if (typeRadios.length) syncType();

        // Icon picker
        var iconInput = document.getElementById('icon');
        var iconPreviewIcon = document.getElementById('iconPreviewIcon');
        function normalizeIcon(v) {
            v = (v || '').trim();
            if (!v) return '';
            var m = v.match(/fa[bsrl]?-([a-z0-9\-]+)/i);
            return m ? 'fa-' + m[1] : 'fa-' + v.replace(/[^a-z0-9\-]/gi, '');
        }
        function syncIconPreview() {
            if (!iconInput || !iconPreviewIcon) return;
            var v = normalizeIcon(iconInput.value);
            iconPreviewIcon.className = v ? 'fas ' + v : 'fas fa-link';
        }
        document.querySelectorAll('.icon-opt').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.icon-opt').forEach(function (b) { b.classList.remove('selected'); });
                btn.classList.add('selected');
                if (iconInput) iconInput.value = btn.dataset.icon;
                syncIconPreview();
            });
        });
        if (iconInput) {
            iconInput.addEventListener('input', function () {
                document.querySelectorAll('.icon-opt').forEach(function (b) {
                    b.classList.toggle('selected', b.dataset.icon === normalizeIcon(iconInput.value));
                });
                syncIconPreview();
            });
        }
        syncIconPreview();
    })();
</script>
@endsection
