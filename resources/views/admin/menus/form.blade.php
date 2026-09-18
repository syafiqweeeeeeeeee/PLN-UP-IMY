@extends('layouts.admin')

@section('title', ($menu ? 'Edit Menu' : 'Tambah Menu') . ' — E-PPID PLN')
@section('page-title', $menu ? 'Edit Menu' : 'Tambah Menu')

@push('styles')
<style>
    /* ============================================
       MENU FORM — DESIGN SYSTEM FORM STANDAR
       Struktur & style sama dengan form Berita (referensi utama):
       form-topbar, form-section(+icon), form-group, form-input,
       form-hint, form-footer, form-btn-save/cancel
       → semua global di public/css/admin.css.
       Yang tersisa di sini HANYA komponen unik Menu:
       kartu pilihan tipe tujuan + icon picker.
       ============================================ */

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

    /* Dark-mode komponen unik menu */
    html.theme-dark .type-card { background: var(--panel); border-color: var(--line); }
    html.theme-dark .type-card.selected { background: var(--panel-hover); }
    html.theme-dark .icon-opt { background: var(--panel); border-color: var(--line); color: var(--ink-muted); }
</style>
@endpush

@section('content')
{{-- ============================================
     TOP NAVIGATION — standar Design System Form
     ============================================ --}}
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.menus.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">{{ $menu ? 'Edit Menu' : 'Tambah Menu Baru' }}</h4>
            <p class="form-page-subtitle">
                {{ $menu
                    ? 'Mengubah "' . $menu->label . '" — perubahan langsung tampil di navbar situs.'
                    : 'Menu baru akan langsung tampil di navbar setelah disimpan.' }}
            </p>
        </div>
    </div>
    <div class="form-topbar-actions">
        <button type="submit" form="menuForm" class="form-btn-save">
            <i class="fas fa-floppy-disk"></i> Simpan Menu
        </button>
    </div>
</div>

@if (session('success'))
<div class="form-alert success">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="form-alert danger">
    <i class="fas fa-circle-exclamation"></i> Perbaiki data berikut.
</div>
@endif

<form id="menuForm" method="POST"
      action="{{ $menu ? route('admin.menus.update', $menu) : route('admin.menus.store') }}">
    @csrf
    @if ($menu)
        @method('PUT')
    @endif

    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon blue"><i class="fas fa-pen"></i></div>
            <div>
                <h6 class="form-section-title">Nama & Posisi Menu</h6>
                <p class="form-section-desc">Teks menu dan posisinya di navbar</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="label">Nama menu <span class="required">*</span></label>
                    <input type="text" id="label" name="label" value="{{ old('label', $menu->label ?? '') }}"
                           class="form-input @error('label') is-invalid @enderror"
                           placeholder="Contoh: Karier" required>
                    @error('label')<div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    <div class="form-hint flex"><i class="far fa-lightbulb"></i> Teks yang dilihat pengunjung di navbar.</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="parent_id">Letak menu</label>
                    <select id="parent_id" name="parent_id" class="form-input">
                        <option value="">Sebagai grup sendiri di navbar (Menu Utama)</option>
                        @foreach ($parents as $id => $label)
                            <option value="{{ $id }}" @selected(old('parent_id', $menu->parent_id ?? '') == $id)>
                                Di dalam dropdown "{{ $label }}"
                            </option>
                        @endforeach
                    </select>
                    <div class="form-hint flex">
                        <i class="far fa-lightbulb"></i> Menu Utama = dropdown besar (contoh: "Tentang Kami"). Submenu = item di dalamnya (contoh: "Berita").
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon cyan"><i class="fas fa-location-arrow"></i></div>
            <div>
                <h6 class="form-section-title">Tujuan Menu</h6>
                <p class="form-section-desc">Mau mengarah ke mana saat diklik?</p>
            </div>
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

        <div class="mt-3 type-field form-group" data-for="route">
            <label class="form-group-label" for="route_name">Pilih halaman situs</label>
            <select id="route_name" name="route_name" class="form-input">
                <option value="">— pilih —</option>
                @foreach ($routeOptions as $routeName => $routeLabel)
                    <option value="{{ $routeName }}" @selected(old('route_name', $menu->route_name ?? '') === $routeName)>{{ $routeLabel }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-3 type-field form-group" data-for="page" style="display:none;">
            <label class="form-group-label" for="page_id">Pilih halaman buatan sendiri</label>
            <select id="page_id" name="page_id" class="form-input">
                <option value="">— pilih —</option>
                @foreach ($pages as $pageOption)
                    <option value="{{ $pageOption->id }}" @selected(old('page_id', $menu->page_id ?? '') == $pageOption->id)>
                        {{ $pageOption->title }} ({{ $pageOption->status === 'published' ? 'terbit' : 'draft' }}{{ $pageOption->visibility === 'role_restricted' ? ', khusus role tertentu' : '' }})
                    </option>
                @endforeach
            </select>
            <div class="form-hint flex">
                <i class="fas fa-shield-halved"></i>
                Menu ini otomatis disembunyikan dari pengunjung yang tidak berhak melihat halamannya.
                Belum punya halaman? Buat dulu di menu <strong>Halaman</strong> di sidebar.
            </div>
        </div>

        <div class="mt-3 type-field form-group" data-for="url" style="display:none;">
            <label class="form-group-label" for="url">Alamat link</label>
            <input type="text" id="url" name="url" value="{{ old('url', $menu->url ?? '') }}"
                   class="form-input" placeholder="Contoh: https://web.pln.co.id">
            <div class="form-hint flex"><i class="far fa-lightbulb"></i> Bisa alamat situs lain, atau alamat dalam situs ini yang diawali "/".</div>
        </div>
        @error('url')
            @if (old('type', $menu->type ?? '') === 'url')
                <div class="form-error mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @endif
        @enderror

        <div class="row g-3 mt-1">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="target">Cara membuka link</label>
                    <select id="target" name="target" class="form-input">
                        @foreach ($targetLabels as $targetValue => $targetLabel)
                            <option value="{{ $targetValue }}" @selected(old('target', $menu->target ?? '_self') === $targetValue)>
                                {{ $targetLabel }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-hint flex"><i class="far fa-lightbulb"></i> "Tab baru" cocok untuk link eksternal agar pengunjung tidak meninggalkan situs ini.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon yellow"><i class="fas fa-icons"></i></div>
            <div>
                <h6 class="form-section-title">Ikon Menu</h6>
                <p class="form-section-desc">Opsional — ikon kecil di samping teks menu</p>
            </div>
        </div>
        <div class="icon-grid" id="iconGrid">
            @foreach ($iconChoices as $iconChoice)
                <button type="button" class="icon-opt {{ old('icon', $menu->icon ?? '') === $iconChoice ? 'selected' : '' }}"
                        data-icon="{{ $iconChoice }}" title="{{ $iconChoice }}">
                    <i class="fas {{ $iconChoice }}"></i>
                </button>
            @endforeach
        </div>
        <div class="icon-custom-row form-group">
            <span class="icon-preview" id="iconPreview">
                <i class="fas {{ old('icon', $menu->icon ?? 'fa-link') ?: 'fa-link' }}" id="iconPreviewIcon"></i>
            </span>
            <div style="flex:1;">
                <input type="text" id="icon" name="icon" value="{{ old('icon', $menu->icon ?? '') }}"
                       class="form-input" placeholder="Kosongkan untuk tanpa ikon, atau ketik kode sendiri">
                <div class="form-hint flex"><i class="far fa-lightbulb"></i> Klik ikon di atas untuk memilih, atau ketik manual (otomatis diberi awalan fa-).</div>
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

{{-- ============================================
     FOOTER — standar Design System Form (di luar form,
     tombol simpan utama ada di form-topbar via attribute form="menuForm")
     ============================================ --}}
<div class="form-footer">
    <div class="form-footer-info">
        <i class="fas fa-circle-info"></i> Field dengan <span style="color:#dc2626;">*</span> wajib diisi
    </div>
    <div class="form-footer-actions">
        <a href="{{ route('admin.menus.index') }}" class="form-btn-cancel">
            Batal
        </a>
        <button type="submit" form="menuForm" class="form-btn-save">
            <i class="fas fa-floppy-disk"></i> Simpan Menu
        </button>
    </div>
</div>

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
