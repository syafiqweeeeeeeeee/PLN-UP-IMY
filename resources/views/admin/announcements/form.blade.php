@extends('layouts.admin')

@section('title', ($announcement ? 'Edit Pengumuman' : 'Tambah Pengumuman') . ' — E-PPID PLN')
@section('page-title', ($announcement ? 'Edit Pengumuman' : 'Tambah Pengumuman'))

@push('styles')
<style>
    /* ============================================
       ANNOUNCEMENT FORM — DESIGN SYSTEM FORM STANDAR
       Struktur & style sama dengan form Berita (referensi utama):
       form-topbar, form-section(+icon), form-group, form-input,
       form-error, form-alert, form-footer, form-btn-save/cancel
       → semua global di public/css/admin.css.
       Yang tersisa di sini HANYA komponen unik Pengumuman.
       ============================================ */

    /* Category Pills — pola yang sama dengan form Berita */
    .category-pills {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .category-pill {
        position: relative;
    }
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
    .category-pill-label .pill-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .category-pill-label .pill-dot.dot-blue    { background: var(--pln-blue); }
    .category-pill-label .pill-dot.dot-cyan    { background: var(--pln-cyan); }
    .category-pill-label .pill-dot.dot-purple  { background: #8b5cf6; }
    .category-pill-label .pill-dot.dot-green   { background: #10b981; }
    .category-pill-label .pill-dot.dot-amber   { background: #eab308; }

    .category-pill input:checked + .category-pill-label {
        color: #fff;
        border-color: transparent;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    }
    .category-pill input:checked + .category-pill-label.cat-umum        { background: var(--pln-blue); }
    .category-pill input:checked + .category-pill-label.cat-teknis      { background: var(--pln-cyan); }
    .category-pill input:checked + .category-pill-label.cat-kepegawaian { background: #8b5cf6; }
    .category-pill input:checked + .category-pill-label.cat-keuangan    { background: #10b981; }
    .category-pill input:checked + .category-pill-label.cat-layanan     { background: #eab308; color: #1a1a2e; }

    /* Responsive khusus pills (sisanya global di admin.css) */
    @media (max-width: 767.98px) {
        .category-pills { gap: 0.4rem; }
        .category-pill-label { padding: 0.4rem 0.75rem; font-size: 0.78rem; }
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
            <h4 class="form-page-title">{{ $announcement ? 'Edit Pengumuman' : 'Tambah Pengumuman Baru' }}</h4>
            <p class="form-page-subtitle">{{ $announcement ? 'Perbarui informasi pengumuman yang sudah ada' : 'Buat pengumuman resmi baru untuk publikasi' }}</p>
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

<form action="{{ $announcement ? route('admin.announcements.update', $announcement) : route('admin.announcements.store') }}" method="POST" id="announcementForm">
    @csrf
    @if ($announcement)
        @method('PUT')
    @endif

    {{-- ============================================
         SECTION: Informasi Utama
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon blue">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div>
                <h6 class="form-section-title">Informasi Utama</h6>
                <p class="form-section-desc">Judul dan kategori pengumuman</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-8">
                <div class="form-group">
                    <label class="form-group-label" for="title">
                        Judul Pengumuman <span class="required">*</span>
                    </label>
                    <input type="text"
                           id="title"
                           name="title"
                           value="{{ old('title', $announcement?->title) }}"
                           class="form-input @error('title') is-invalid @enderror"
                           placeholder="Masukkan judul pengumuman..."
                           maxlength="255">
                    @error('title')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <div class="form-error d-none" id="titleError">
                        <i class="fas fa-exclamation-circle"></i> Judul pengumuman wajib diisi.
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label">
                Kategori <span class="required">*</span>
            </label>
            <div class="category-pills">
                <div class="category-pill">
                    <input type="radio" name="category" value="umum" id="cat-umum" {{ old('category', $announcement?->category) === 'umum' ? 'checked' : '' }}>
                    <label for="cat-umum" class="category-pill-label cat-umum">
                        <span class="pill-dot dot-blue"></span> Umum
                    </label>
                </div>
                <div class="category-pill">
                    <input type="radio" name="category" value="teknis" id="cat-teknis" {{ old('category', $announcement?->category) === 'teknis' ? 'checked' : '' }}>
                    <label for="cat-teknis" class="category-pill-label cat-teknis">
                        <span class="pill-dot dot-cyan"></span> Teknis
                    </label>
                </div>
                <div class="category-pill">
                    <input type="radio" name="category" value="kepegawaian" id="cat-kepegawaian" {{ old('category', $announcement?->category) === 'kepegawaian' ? 'checked' : '' }}>
                    <label for="cat-kepegawaian" class="category-pill-label cat-kepegawaian">
                        <span class="pill-dot dot-purple"></span> Kepegawaian
                    </label>
                </div>
                <div class="category-pill">
                    <input type="radio" name="category" value="keuangan" id="cat-keuangan" {{ old('category', $announcement?->category) === 'keuangan' ? 'checked' : '' }}>
                    <label for="cat-keuangan" class="category-pill-label cat-keuangan">
                        <span class="pill-dot dot-green"></span> Keuangan
                    </label>
                </div>
                <div class="category-pill">
                    <input type="radio" name="category" value="layanan" id="cat-layanan" {{ old('category', $announcement?->category) === 'layanan' ? 'checked' : '' }}>
                    <label for="cat-layanan" class="category-pill-label cat-layanan">
                        <span class="pill-dot dot-amber"></span> Layanan
                    </label>
                </div>
            </div>
            @error('category')
                <div class="form-error" style="margin-top: 0.4rem;"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
            <div class="form-error d-none" id="categoryError" style="margin-top: 0.4rem;">
                <i class="fas fa-exclamation-circle"></i> Pilih salah satu kategori.
            </div>
        </div>
    </div>

    {{-- ============================================
         SECTION: Konten Pengumuman
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon cyan">
                <i class="fas fa-align-left"></i>
            </div>
            <div>
                <h6 class="form-section-title">Konten Pengumuman</h6>
                <p class="form-section-desc">Ringkasan dan isi lengkap pengumuman</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label" for="excerpt">
                Ringkasan <span class="required">*</span>
            </label>
            <textarea id="excerpt"
                      name="excerpt"
                      class="form-input @error('excerpt') is-invalid @enderror"
                      placeholder="Tuliskan ringkasan singkat pengumuman yang akan ditampilkan di halaman publik..."
                      maxlength="1000"
                      rows="4">{{ old('excerpt', $announcement?->excerpt) }}</textarea>
            <div class="form-hint flex">
                <i class="far fa-lightbulb"></i> Maksimal 1000 karakter — tampil di halaman publik
            </div>
            @error('excerpt')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
            <div class="form-error d-none" id="excerptError">
                <i class="fas fa-exclamation-circle"></i> Ringkasan pengumuman wajib diisi.
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label">
                Konten Lengkap <span class="optional">(opsional)</span>
            </label>
            <textarea id="content"
                      name="content"
                      class="form-input"
                      placeholder="Tuliskan isi pengumuman secara lengkap..."
                      rows="5">{{ old('content', $announcement?->content) }}</textarea>
            <div class="form-hint flex">
                <i class="far fa-lightbulb"></i> Ditampilkan di halaman detail pengumuman
            </div>
        </div>
    </div>

    {{-- ============================================
         SECTION: Status Publikasi
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon yellow">
                <i class="fas fa-toggle-on"></i>
            </div>
            <div>
                <h6 class="form-section-title">Status Publikasi</h6>
                <p class="form-section-desc">Tentukan apakah pengumuman langsung tampil di publik</p>
            </div>
        </div>

        <div class="form-group">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <label class="status-radio">
                    <input type="radio" name="is_published" value="1" {{ old('is_published', $announcement?->is_published ?? 1) == 1 ? 'checked' : '' }}>
                    <span><i class="fas fa-eye me-1" style="color: var(--pln-cyan);"></i> Publikasi</span>
                </label>
                <label class="status-radio muted">
                    <input type="radio" name="is_published" value="0" {{ old('is_published', $announcement?->is_published ?? 1) != 1 ? 'checked' : '' }}>
                    <span><i class="fas fa-pen me-1" style="color: #9ca3af;"></i> Simpan sebagai Draft</span>
                </label>
            </div>
            <div class="form-hint flex">
                <i class="far fa-clock"></i> Draft tidak akan tampil di halaman pengumuman publik
            </div>
        </div>
    </div>

    {{-- ============================================
         FOOTER — standar Design System Form
         ============================================ --}}
    <div class="form-footer">
        <div class="form-footer-info">
            <i class="fas fa-circle-info"></i> Field dengan <span style="color:#dc2626;">*</span> wajib diisi
        </div>
        <div class="form-footer-actions">
            <a href="{{ route('admin.announcements.index') }}" class="form-btn-cancel">
                Batal
            </a>
            <button type="submit" class="form-btn-save">
                <i class="fas fa-save"></i> {{ $announcement ? 'Simpan Perubahan' : 'Publikasikan' }}
            </button>
        </div>
    </div>
</form>

<script>
    (function() {
        const form = document.getElementById('announcementForm');
        if (!form || form.dataset.validated) return;   // anti double-bind saat navigasi SPA
        form.dataset.validated = '1';

        const categoryError = document.getElementById('categoryError');

        // Input kategori tersembunyi (display:none) tidak boleh pakai required
        // HTML5 — browser tidak bisa menampilkan errornya dan submit terblokir
        // diam-diam. Validasi manual dengan pesan yang terlihat.
        const titleInput = document.getElementById('title');
        const excerptInput = document.getElementById('excerpt');
        const titleError = document.getElementById('titleError');
        const excerptError = document.getElementById('excerptError');

        function showFieldError(input, errEl, show) {
            errEl?.classList.toggle('d-none', !show);
            input?.classList.toggle('is-invalid', show);
        }

        form.addEventListener('submit', function(e) {
            let firstInvalid = null;
            const markInvalid = (el) => { firstInvalid = firstInvalid ?? el; };

            const titleBad = (titleInput?.value ?? '').trim() === '';
            showFieldError(titleInput, titleError, titleBad);
            if (titleBad) markInvalid(titleInput);

            const hasCategory = !!document.querySelector('input[name="category"]:checked');
            categoryError?.classList.toggle('d-none', hasCategory);
            if (!hasCategory) markInvalid(document.querySelector('.category-pills'));

            const excerptBad = (excerptInput?.value ?? '').trim() === '';
            showFieldError(excerptInput, excerptError, excerptBad);
            if (excerptBad) markInvalid(excerptInput);

            if (firstInvalid) {
                e.preventDefault();
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                if (firstInvalid === titleInput || firstInvalid === excerptInput) firstInvalid.focus();
            }
        });

        titleInput?.addEventListener('input', function() {
            showFieldError(titleInput, titleError, titleInput.value.trim() === '');
        });
        excerptInput?.addEventListener('input', function() {
            showFieldError(excerptInput, excerptError, excerptInput.value.trim() === '');
        });
        document.querySelectorAll('input[name="category"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                categoryError?.classList.add('d-none');
            });
        });
    })();
</script>
@endsection
