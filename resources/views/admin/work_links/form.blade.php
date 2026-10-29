@extends('layouts.admin')

@section('title', ($link ? 'Edit Link Kerja' : 'Tambah Link Kerja') . ' — E-PPID PLN')
@section('page-title', 'Link Kerja')

@push('styles')
<style>
    /* ============================================
       WORK LINK FORM — pola form Berita (Design System)
       ============================================ */
    .category-pills {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .category-pill { position: relative; }
    .category-pill input { display: none; }
    .category-pill-label {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        border: 1.5px solid #e5e7eb;
        background: #fff;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        color: #6b7280;
    }
    html.theme-dark .category-pill-label {
        background: var(--panel);
        border-color: var(--line);
        color: var(--ink-muted);
    }
    .category-pill-label:hover {
        border-color: #cbd5e1;
        background: #f9fafb;
    }
    html.theme-dark .category-pill-label:hover {
        border-color: var(--ink-faint);
        background: var(--panel-hover);
    }
    .category-pill input:checked + .category-pill-label {
        color: #fff;
        border-color: transparent;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    }
    .category-pill input:checked + .category-pill-label.cat-umum   { background: #16a34a; }
    .category-pill input:checked + .category-pill-label.cat-khusus { background: var(--pln-blue); }

    /* Status toggle (Aktif / Nonaktif) — pola status-radio Pengumuman */
    .status-radio span {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.55rem 1rem;
        border-radius: 10px;
        border: 1.5px solid #e5e7eb;
        background: #fff;
        font-size: 0.82rem;
        font-weight: 600;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    html.theme-dark .status-radio span {
        background: var(--panel);
        border-color: var(--line);
        color: var(--ink-muted);
    }
    .status-radio input { accent-color: var(--pln-blue); }
    .status-radio:has(input:checked) span {
        border-color: var(--pln-blue);
        background: #f0f7ff;
        color: var(--pln-blue);
    }

    /* Ikon preview */
    .icon-preview {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: linear-gradient(135deg, #008fa8, #00566b);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.05rem;
        flex-shrink: 0;
    }

    /* Panel target khusus */
    #targetKhususPanel {
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        background: #f9fafb;
    }
    html.theme-dark #targetKhususPanel {
        border-color: var(--line);
        background: var(--panel);
    }
    #targetKhususPanel.hidden-panel { display: none; }
</style>
@endpush

@section('content')
{{-- ============================================
     TOP NAVIGATION
     ============================================ --}}
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.work-links.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">{{ $link ? 'Edit Link Kerja' : 'Tambah Link Kerja' }}</h4>
            <p class="form-page-subtitle">{{ $link ? 'Perbarui tautan alat kerja yang sudah ada' : 'Buat tautan alat kerja baru untuk Portal Karyawan' }}</p>
        </div>
    </div>
</div>

@if (session('success'))
{{-- Flash sukses → pop-up SweetAlert tengah layar (AdminSwal di layout). --}}
<div hidden data-swal-success="{{ session('success') }}"></div>
@endif

@if ($errors->any())
<div class="form-alert danger">
    <i class="fas fa-circle-exclamation"></i> Perbaiki data berikut.
</div>
@endif

<form action="{{ $link ? route('admin.work-links.update', $link) : route('admin.work-links.store') }}" method="POST" id="workLinkForm">
    @csrf
    @if ($link)
        @method('PUT')
    @endif

    {{-- ============================================
         SECTION: Informasi Link
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon blue">
                <i class="fas fa-link"></i>
            </div>
            <div>
                <h6 class="form-section-title">Informasi Link</h6>
                <p class="form-section-desc">Nama, URL tujuan, deskripsi, dan ikon link</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-7">
                <div class="form-group">
                    <label class="form-group-label" for="title">
                        Title / Nama Link <span class="required">*</span>
                    </label>
                    <input type="text"
                           id="title"
                           name="title"
                           value="{{ old('title', $link?->title) }}"
                           class="form-input @error('title') is-invalid @enderror"
                           placeholder="Contoh: Dashboard Kontrol Pembangkit"
                           maxlength="255">
                    @error('title')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-lg-5">
                <div class="form-group">
                    <label class="form-group-label" for="icon">
                        Select Icon
                    </label>
                    @php
                        /* 8 ikon utama — nilai 'value' = class lengkap yang
                           disimpan ke DB (mis. 'fa-solid fa-link'). */
                        $iconOptions = [
                            'fa-solid fa-link'       => 'Umum / Link',
                            'fa-solid fa-gauge-high' => 'Dashboard / Monitoring',
                            'fa-solid fa-file-lines' => 'Dokumen & SPO',
                            'fa-solid fa-envelope'   => 'Email & Webmail',
                            'fa-solid fa-id-card'    => 'Kepegawaian & SDM',
                            'fa-solid fa-wrench'     => 'Pemeliharaan & Teknik',
                            'fa-solid fa-hard-hat'   => 'K3 & Safety',
                            'fa-solid fa-database'   => 'Sistem & Database',
                        ];
                        $currentIcon = old('icon', $link?->icon) ?: 'fa-solid fa-link';
                        // Ikon legacy (mis. 'fa-users') → petakan ke opsi utama terdekat.
                        if (! isset($iconOptions[$currentIcon])) {
                            $legacyMap = [
                                'fa-gauge-high'         => 'fa-solid fa-gauge-high',
                                'fa-file-lines'         => 'fa-solid fa-file-lines',
                                'fa-envelope'           => 'fa-solid fa-envelope',
                                'fa-id-card'            => 'fa-solid fa-id-card',
                                'fa-wrench'             => 'fa-solid fa-wrench',
                                'fa-hard-hat'           => 'fa-solid fa-hard-hat',
                                'fa-helmet-safety'      => 'fa-solid fa-hard-hat',
                                'fa-database'           => 'fa-solid fa-database',
                                'fa-users'              => 'fa-solid fa-id-card',
                                'fa-fingerprint'        => 'fa-solid fa-id-card',
                                'fa-screwdriver-wrench' => 'fa-solid fa-wrench',
                            ];
                            $currentIcon = $legacyMap[$currentIcon] ?? 'fa-solid fa-link';
                        }
                    @endphp
                    <div class="d-flex align-items-center gap-2">
                        <span class="icon-preview" id="iconPreview">
                            <i class="{{ $currentIcon }}" id="iconPreviewEl"></i>
                        </span>
                        <select id="icon"
                                name="icon"
                                class="form-input"
                                style="flex:1;">
                            @foreach ($iconOptions as $value => $label)
                                <option value="{{ $value }}" {{ $currentIcon === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-hint flex">
                        <i class="far fa-lightbulb"></i> Ikon FontAwesome yang tampil di kartu link Portal Karyawan
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label" for="url">
                URL Tujuan <span class="required">*</span>
            </label>
            <input type="text"
                   id="url"
                   name="url"
                   value="{{ old('url', $link?->url) }}"
                   class="form-input @error('url') is-invalid @enderror"
                   placeholder="https://contoh.pln-np.co.id (URL internal / eksternal)">
            <div class="form-hint flex">
                <i class="far fa-lightbulb"></i> Tanpa awalan https:// akan otomatis ditambahkan
            </div>
            @error('url')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-group-label" for="description">
                Deskripsi Singkat <span class="optional">(opsional)</span>
            </label>
            <textarea id="description"
                      name="description"
                      class="form-input"
                      placeholder="Jelaskan fungsi singkat link ini..."
                      rows="3"
                      maxlength="1000">{{ old('description', $link?->description) }}</textarea>
            <div class="form-hint flex">
                <i class="far fa-lightbulb"></i> Maksimal 1000 karakter — tampil di kartu link
            </div>
        </div>
    </div>

    {{-- ============================================
         SECTION: Kategori & Target
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon cyan">
                <i class="fas fa-sitemap"></i>
            </div>
            <div>
                <h6 class="form-section-title">Kategori &amp; Target</h6>
                <p class="form-section-desc">Siapa yang dapat melihat link ini di Portal Karyawan</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label">
                Kategori <span class="required">*</span>
            </label>
            <div class="category-pills">
                <div class="category-pill">
                    <input type="radio" name="category" value="umum" id="cat-umum"
                           {{ old('category', $link?->category ?? 'umum') === 'umum' ? 'checked' : '' }}>
                    <label for="cat-umum" class="category-pill-label cat-umum">
                        <i class="fas fa-users"></i> All
                    </label>
                </div>
                <div class="category-pill">
                    <input type="radio" name="category" value="khusus" id="cat-khusus"
                           {{ old('category', $link?->category) === 'khusus' ? 'checked' : '' }}>
                    <label for="cat-khusus" class="category-pill-label cat-khusus">
                        <i class="fas fa-user-lock"></i> Khusus
                    </label>
                </div>
            </div>
            <div class="form-hint flex">
                <i class="far fa-lightbulb"></i>
                <span>
                    <strong>All</strong> — link tampil otomatis di semua akun Karyawan ·
                    <strong>Khusus</strong> — link hanya tampil di Bidang Utama / Sub-Bidang target.
                </span>
            </div>
            @error('category')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        {{-- Panel target — tampil hanya saat kategori Khusus.
             Pilihan Bidang diambil LANGSUNG dari MASTER BIDANG (tabel
             `bidangs`) lewat WorkLinkController::formContext(), berjenjang
             induk → sub-bidang. Akun yang terkunci sub-bidang: nilai
             terisi otomatis & read-only; server tetap memaksa nilai itu. --}}
        <div id="targetKhususPanel" class="{{ old('category', $link?->category ?? 'umum') === 'khusus' ? '' : 'hidden-panel' }}">
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="form-group">
                        {{-- Label utama disembunyikan secara visual (tetap terbaca
                             screen reader) dan digantikan floating label DI DALAM box. --}}
                        <label class="form-group-label pln-label-sr" for="bidang_id">
                            Bidang <span class="required">*</span>
                            @if ($lockedBidangId)
                                <span class="optional"><i class="fas fa-lock" style="font-size:0.7rem;"></i> terkunci ({{ $lockedBidangLabel }})</span>
                            @endif
                        </label>
                        <div class="pln-select-wrap is-required">
                            <span class="pln-field-float">Bidang <span class="required">*</span></span>
                            <select id="bidang_id" name="bidang_id" class="form-input"
                                    @if ($lockedBidangId) disabled @endif>
                                {{-- Opsi value kosong DIHILANGKAN dari tampilan
                                     panel (floating label yang bertanya) — tetap
                                     ada sebagai <option> native untuk mengirim
                                     nilai kosong. --}}
                                <option value=""></option>
                                @foreach ($bidangOptions as $option)
                                    <option value="{{ $option['id'] }}"
                                        {{ (string) $selectedBidangId === (string) $option['id'] ? 'selected' : '' }}>
                                        {{ str_repeat('— ', max(0, $option['depth'] - 1)) }}{{ $option['nama'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @if ($lockedBidangId)
                            <div class="form-hint flex">
                                <i class="fas fa-lock"></i> Terkunci ke unit kerja Anda ({{ $lockedBidangLabel }})
                            </div>
                            {{-- select disabled tidak dikirim browser →
                                 kirim nilai via hidden input. --}}
                            <input type="hidden" name="bidang_id" value="{{ $lockedBidangId }}">
                        @else
                            <div class="form-hint flex">
                                <i class="fas fa-sitemap"></i> Daftar dari Master Bidang — pilih bidang induk untuk seluruh sub-bidangnya, atau sub-bidang tertentu saja.
                            </div>
                        @endif
                        @error('bidang_id')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-group-label">Cakupan Akses</label>
                        <div class="form-hint flex" style="align-items:flex-start;">
                            <i class="fas fa-user-lock" style="margin-top:2px;"></i>
                            <span>Link hanya tampil untuk akun yang terikat pada bidang terpilih. Bila memilih bidang induk, seluruh sub-bidang di bawahnya tercakup.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         SECTION: Status
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon yellow">
                <i class="fas fa-toggle-on"></i>
            </div>
            <div>
                <h6 class="form-section-title">Status Link</h6>
                <p class="form-section-desc">Link nonaktif disembunyikan dari Portal Karyawan</p>
            </div>
        </div>

        <div class="form-group">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <label class="status-radio">
                    <input type="radio" name="is_active" value="1" {{ old('is_active', $link?->is_active ?? 1) == 1 ? 'checked' : '' }}>
                    <span><i class="fas fa-eye me-1" style="color: var(--pln-cyan);"></i> Aktif</span>
                </label>
                <label class="status-radio">
                    <input type="radio" name="is_active" value="0" {{ old('is_active', $link?->is_active ?? 1) != 1 ? 'checked' : '' }}>
                    <span><i class="fas fa-pen me-1" style="color: #9ca3af;"></i> Nonaktif</span>
                </label>
            </div>
            <div class="form-hint flex">
                <i class="far fa-clock"></i> Link nonaktif tidak tampil di Portal Karyawan namun tetap tersimpan
            </div>
        </div>
    </div>

    {{-- ============================================
         FOOTER
         ============================================ --}}
    <div class="form-footer">
        <div class="form-footer-info">
            <i class="fas fa-circle-info"></i> Field dengan <span style="color:#dc2626;">*</span> wajib diisi
        </div>
        <div class="form-footer-actions">
            <a href="{{ route('admin.work-links.index') }}" class="form-btn-cancel">
                Batal
            </a>
            <button type="submit" class="form-btn-save">
                <i class="fas fa-save"></i> {{ $link ? 'Simpan Perubahan' : 'Simpan Link Kerja' }}
            </button>
        </div>
    </div>
</form>

<script>
(function() {
    var form = document.getElementById('workLinkForm');
    if (!form || form.dataset.workLinkBound) return;   // anti double-bind saat navigasi SPA
    form.dataset.workLinkBound = '1';

    var catUmum   = document.getElementById('cat-umum');
    var catKhusus = document.getElementById('cat-khusus');
    var panel     = document.getElementById('targetKhususPanel');
    var bidangSel = document.getElementById('bidang_id');
    var iconSel   = document.getElementById('icon');
    var iconEl    = document.getElementById('iconPreviewEl');

    function togglePanel() {
        if (catKhusus && catKhusus.checked) {
            panel?.classList.remove('hidden-panel');
        } else {
            panel?.classList.add('hidden-panel');
        }
    }

    catUmum?.addEventListener('change', togglePanel);
    catKhusus?.addEventListener('change', togglePanel);

    togglePanel();

    // Preview icon realtime (nilai opsi = class lengkap, mis. 'fa-solid fa-link')
    iconSel?.addEventListener('change', function () {
        if (iconEl) iconEl.className = this.value || 'fa-solid fa-link';
    });

    // Validasi submit
    form.addEventListener('submit', function (e) {
        var firstInvalid = null;

        var titleInput = document.getElementById('title');
        if (!(titleInput?.value ?? '').trim()) {
            titleInput?.classList.add('is-invalid');
            firstInvalid = firstInvalid ?? titleInput;
        } else {
            titleInput?.classList.remove('is-invalid');
        }

        var urlInput = document.getElementById('url');
        if (!(urlInput?.value ?? '').trim()) {
            urlInput?.classList.add('is-invalid');
            firstInvalid = firstInvalid ?? urlInput;
        } else {
            urlInput?.classList.remove('is-invalid');
        }

        // Khusus wajib memilih Bidang (master bidangs)
        if (catKhusus && catKhusus.checked && !(bidangSel?.value ?? '')) {
            panel?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            e.preventDefault();
            bidangSel?.focus();
            return;
        }

        if (firstInvalid) {
            e.preventDefault();
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstInvalid.focus();
        }
    });
})();

/* ============================================================
   CLEAN DROPDOWN (EnhancedSelect — pola form Pengguna)
   ------------------------------------------------------------
   Dropdown Bidang memakai panel list custom (.pln-dd-panel):
     - Floating label DI DALAM box (menggantikan opsi placeholder).
     - TANPA kotak pencarian — daftar opsi data langsung tersaji.
     - Panel SELALU terbuka DI BAWAH kontrol (fixed, di-append ke
       <body>) dan TIDAK PERNAH flip ke atas: bila ruang di bawah
       sempit, halaman di-scroll dulu sebelum panel tampil.
     - Item memilih men-set nilai pada <select> native lalu
       men-dispatch 'input' + 'change' → toggle Khusus dan validasi
       submit tidak tersentuh.
     - Binding per-instance DOM (form.dataset) supaya router.js
       SPA swap selalu me-rebind pada DOM baru.
   ============================================================ */
(function () {
    var form = document.getElementById('workLinkForm');
    if (!form || form.dataset.wlDdBound) return;
    form.dataset.wlDdBound = '1';

    var selects = Array.prototype.slice.call(form.querySelectorAll('.pln-select-wrap select.form-input'));
    if (!selects.length) return;

    var openPanel = null, ownerSelect = null, ownerWrap = null;
    var resultsBox = null, focusIndex = -1, items = [];
    var MIN_BELOW = 96, MAX_HEIGHT = 320, suppressScrollClose = false;

    function syncFieldState(select) {
        select.classList.toggle('is-empty', select.value === '');
    }

    function syncAll() { selects.forEach(syncFieldState); }
    syncAll();

    function closePanel() {
        if (openPanel) { openPanel.remove(); openPanel = null; }
        if (ownerWrap) ownerWrap.classList.remove('is-open');
        ownerWrap = null; ownerSelect = null;
        focusIndex = -1; items = []; resultsBox = null;
    }

    function setFocus(index) {
        items.forEach(function (el) { el.classList.remove('is-focused'); });
        focusIndex = index;
        if (items[focusIndex]) {
            items[focusIndex].classList.add('is-focused');
            items[focusIndex].scrollIntoView({ block: 'nearest' });
        }
    }

    function buildItems() {
        items = [];
        // Opsi placeholder (value kosong) TIDAK ditampilkan di panel —
        // label mengambang DI DALAM box yang berfungsi sebagai pertanyaan.
        var opts = Array.prototype.slice.call(ownerSelect.options).filter(function (opt) {
            return opt.value !== '';
        });
        if (!opts.length) {
            var emptyNote = document.createElement('div');
            emptyNote.className = 'pln-dd-empty';
            emptyNote.textContent = 'Tidak ada pilihan';
            resultsBox.appendChild(emptyNote);
            return;
        }
        opts.forEach(function (opt) {
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'pln-dd-item';

            var label = document.createElement('span');
            label.textContent = opt.textContent.trim();
            btn.appendChild(label);

            if (opt.selected) {
                var check = document.createElement('span');
                check.className = 'pln-dd-check';
                check.innerHTML = '<i class="fas fa-check"></i>';
                btn.appendChild(check);
                btn.classList.add('is-selected');
            }
            if (opt.disabled) btn.disabled = true;

            btn.addEventListener('click', function () {
                if (opt.disabled) return;
                ownerSelect.value = opt.value;
                // Dispatch dua-duanya — listener 'input' maupun 'change'
                // tetap terpanggil (identik dengan interaksi native).
                ownerSelect.dispatchEvent(new Event('input', { bubbles: true }));
                ownerSelect.dispatchEvent(new Event('change', { bubbles: true }));
                closePanel();
                ownerSelect.focus();
            });

            resultsBox.appendChild(btn);
            items.push(btn);
        });
    }

    function openPanelFor(select) {
        closePanel();

        // ARAH SELALU KE BAWAH: bila ruang di bawah kontrol sempit,
        // scroll halaman otomatis menciptakan ruang — panel tidak
        // pernah flip ke atas & tidak pernah menutupi input.
        var rect = select.getBoundingClientRect();
        var below = window.innerHeight - rect.bottom;
        if (below < MIN_BELOW) {
            suppressScrollClose = true;
            window.scrollBy({ top: (MIN_BELOW + 120) - below, behavior: 'instant' });
            requestAnimationFrame(function () { requestAnimationFrame(function () { suppressScrollClose = false; }); });
            rect = select.getBoundingClientRect();
            below = window.innerHeight - rect.bottom;
        }

        var panel = document.createElement('div');
        panel.className = 'pln-dd-panel';
        panel.style.left = Math.round(rect.left) + 'px';
        // LEBAR 100% kontrol — persis sejajar input box (tanpa min-width).
        panel.style.width = Math.round(rect.width) + 'px';
        // Margin-top 6px antara input box & panel melayang.
        panel.style.top = Math.round(rect.bottom + 6) + 'px';
        panel.style.maxHeight = Math.max(140, Math.min(MAX_HEIGHT, below - 16)) + 'px';

        resultsBox = document.createElement('div');
        resultsBox.className = 'pln-dd-results';
        panel.appendChild(resultsBox);
        document.body.appendChild(panel);

        openPanel = panel;
        ownerSelect = select;
        ownerWrap = select.closest('.pln-select-wrap');
        ownerWrap?.classList.add('is-open');
        buildItems();

        var selectedIdx = -1;
        for (var i = 0; i < items.length; i++) {
            if (items[i].classList.contains('is-selected')) { selectedIdx = i; break; }
        }
        setFocus(selectedIdx >= 0 ? selectedIdx : 0);
        select.focus();
    }

    selects.forEach(function (select) {
        syncFieldState(select);

        select.addEventListener('mousedown', function (e) {
            if (select.disabled) return;      // bidang terkunci → biarkan apa adanya
            e.preventDefault();
            if (openPanel && ownerSelect === select) { closePanel(); return; }
            if (openPanel) closePanel();
            openPanelFor(select);
        });

        select.addEventListener('keydown', function (e) {
            if (select.disabled) return;
            var key = e.key;
            if (openPanel && ownerSelect === select) {
                if (key === 'ArrowDown') { e.preventDefault(); if (items.length) setFocus(Math.min(focusIndex + 1, items.length - 1)); }
                else if (key === 'ArrowUp') { e.preventDefault(); if (items.length) setFocus(Math.max(focusIndex - 1, 0)); }
                else if (key === 'Enter') { e.preventDefault(); if (items[focusIndex] && !items[focusIndex].disabled) items[focusIndex].click(); }
                else if (key === 'Escape') { e.preventDefault(); closePanel(); }
                else if (key === 'Tab') { closePanel(); }
                return;
            }
            if (['Enter', ' ', 'ArrowDown', 'ArrowUp'].indexOf(key) !== -1) {
                e.preventDefault();
                openPanelFor(select);
            } else if (key.length === 1) {
                closePanel();  // ketik → tutup panel agar select native menyaring
            }
        });
    });

    form.addEventListener('change', syncAll);

    document.addEventListener('mousedown', function (e) {
        if (!openPanel) return;
        if (e.target === ownerSelect || ownerSelect.contains(e.target) || (openPanel && openPanel.contains(e.target))) return;
        closePanel();
    }, true);

    window.addEventListener('scroll', function () {
        if (!suppressScrollClose) closePanel();
    }, { passive: true });
    window.addEventListener('resize', closePanel);
    window.addEventListener('pagehide', closePanel);
})();
</script>
@endsection
