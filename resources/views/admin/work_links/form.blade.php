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
<div class="form-alert success">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
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
                    <div class="d-flex align-items-center gap-2">
                        <span class="icon-preview" id="iconPreview">
                            <i class="fas {{ old('icon', $link?->icon ?? 'fa-link') ?: 'fa-link' }}" id="iconPreviewEl"></i>
                        </span>
                        <select id="icon"
                                name="icon"
                                class="form-input"
                                style="flex:1;">
                            @php
                                $iconOptions = [
                                    'fa-link'                => 'Link (umum)',
                                    'fa-gauge-high'          => 'Dashboard / Monitoring',
                                    'fa-chart-line'          => 'Grafik / Statistik',
                                    'fa-envelope'            => 'Email',
                                    'fa-users'               => 'Kepegawaian / SDM',
                                    'fa-file-lines'          => 'Dokumen',
                                    'fa-fingerprint'         => 'Presensi',
                                    'fa-graduation-cap'      => 'E-Learning',
                                    'fa-screwdriver-wrench'  => 'Pemeliharaan',
                                    'fa-coins'               => 'Keuangan',
                                    'fa-helmet-safety'       => 'K3 / Safety',
                                    'fa-folder-open'         => 'Arsip',
                                    'fa-book-open'           => 'Logbook',
                                    'fa-list-check'          => 'Work Order',
                                    'fa-file-export'         => 'Laporan',
                                    'fa-book'                => 'Panduan / SPO',
                                    'fa-calendar-check'      => 'Jadwal',
                                    'fa-headset'             => 'Helpdesk',
                                    'fa-cloud-arrow-up'      => 'Upload / Storage',
                                    'fa-building'            => 'Fasilitas',
                                ];
                            @endphp
                            @foreach ($iconOptions as $value => $label)
                                <option value="{{ $value }}" {{ old('icon', $link?->icon ?? 'fa-link') === $value ? 'selected' : '' }}>{{ $label }}</option>
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
                        <i class="fas fa-users"></i> Umum
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
                    <strong>Umum</strong> — link tampil otomatis di semua akun Karyawan ·
                    <strong>Khusus</strong> — link hanya tampil di Bidang Utama / Sub-Bidang target.
                </span>
            </div>
            @error('category')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        {{-- Panel target — tampil hanya saat kategori Khusus.
             Admin Bidang: Bidang Utama terisi otomatis & dikunci (read-only)
             sesuai bidang admin; server tetap memvalidasi ulang. --}}
        <div id="targetKhususPanel" class="{{ old('category', $link?->category ?? 'umum') === 'khusus' ? '' : 'hidden-panel' }}">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-group-label" for="department">
                            Bidang Utama <span class="required">*</span>
                            @if ($lockedDepartment)
                                <span class="optional"><i class="fas fa-lock" style="font-size:0.7rem;"></i> terkunci ({{ \App\Models\User::DEPARTMENTS[$lockedDepartment] ?? $lockedDepartment }})</span>
                            @endif
                        </label>
                        <select id="department" name="department" class="form-input"
                                @if ($lockedDepartment) disabled @endif>
                            <option value="">— Pilih Bidang Utama —</option>
                            @foreach ($departments as $deptKey => $deptLabel)
                                <option value="{{ $deptKey }}" {{ old('department', $link?->department ?? $lockedDepartment) === $deptKey ? 'selected' : '' }}>{{ $deptLabel }}</option>
                            @endforeach
                        </select>
                        @if ($lockedDepartment)
                            {{-- select disabled tidak dikirim browser →
                                 kirim nilai via hidden input. --}}
                            <input type="hidden" name="department" value="{{ $lockedDepartment }}">
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-group-label" for="sub_department">
                            Sub-Bidang <span class="optional">(opsional)</span>
                        </label>
                        <select id="sub_department" name="sub_department" class="form-input">
                            <option value="">— Semua Sub-Bidang (level Bidang) —</option>
                        </select>
                        <div class="form-hint flex">
                            <i class="far fa-lightbulb"></i> Kosongkan bila link berlaku untuk seluruh bidang
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

{{-- Data sub-bidang untuk dropdown dinamis (JS) --}}
<script id="subDepartmentsData" type="application/json">@json($subDepartments)</script>

<script>
(function() {
    var form = document.getElementById('workLinkForm');
    if (!form || form.dataset.workLinkBound) return;   // anti double-bind saat navigasi SPA
    form.dataset.workLinkBound = '1';

    var SUBS = JSON.parse(document.getElementById('subDepartmentsData').textContent);

    var catUmum   = document.getElementById('cat-umum');
    var catKhusus = document.getElementById('cat-khusus');
    var panel     = document.getElementById('targetKhususPanel');
    var deptSel   = document.getElementById('department');
    var subSel    = document.getElementById('sub_department');
    var iconSel   = document.getElementById('icon');
    var iconEl    = document.getElementById('iconPreviewEl');

    var selectedSub = @json((string) old('sub_department', $link?->sub_department ?? ''));

    function togglePanel() {
        if (catKhusus && catKhusus.checked) {
            panel?.classList.remove('hidden-panel');
        } else {
            panel?.classList.add('hidden-panel');
        }
    }

    function fillSubOptions(department) {
        if (!subSel) return;
        subSel.innerHTML = '<option value="">— Semua Sub-Bidang (level Bidang) —</option>';

        var subs = SUBS[department] || {};
        Object.keys(subs).forEach(function (key) {
            var opt = document.createElement('option');
            opt.value = key;
            opt.textContent = subs[key];
            if (key === selectedSub) opt.selected = true;
            subSel.appendChild(opt);
        });
    }

    catUmum?.addEventListener('change', togglePanel);
    catKhusus?.addEventListener('change', togglePanel);

    deptSel?.addEventListener('change', function () {
        selectedSub = '';
        fillSubOptions(this.value);
    });

    // Kondisi awal: isi dropdown sub sesuai bidang terpilih.
    fillSubOptions(deptSel ? deptSel.value : '');
    togglePanel();

    // Preview icon realtime
    iconSel?.addEventListener('change', function () {
        if (iconEl) iconEl.className = 'fas ' + (this.value || 'fa-link');
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

        // Khusus wajib memilih Bidang Utama
        if (catKhusus && catKhusus.checked && !(deptSel?.value ?? '')) {
            panel?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            e.preventDefault();
            deptSel?.focus();
            return;
        }

        if (firstInvalid) {
            e.preventDefault();
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstInvalid.focus();
        }
    });
})();
</script>
@endsection
