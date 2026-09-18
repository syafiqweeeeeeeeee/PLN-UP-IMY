@extends('layouts.admin')

@section('title', ($news ? 'Edit Berita' : 'Tambah Berita') . ' — E-PPID PLN')
@section('page-title', ($news ? 'Edit Berita' : 'Tambah Berita'))

@push('styles')
<style>
    /* ============================================
       NEWS FORM — REFERENSI UTAMA DESIGN SYSTEM FORM
       Semua class dasar (form-topbar, form-back-btn, form-page-title,
       form-section, form-section-icon, form-group, form-input, form-hint,
       form-error, form-alert, image-upload-*, form-footer, form-btn-save,
       form-btn-cancel) → global di public/css/admin.css.
       Yang tersisa di sini HANYA komponen unik Berita: category pills.
       ============================================ */

    /* Category Pills */
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
    .category-pill-label:hover {
        border-color: #cbd5e1;
        background: #f9fafb;
    }
    .category-pill-label .pill-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .category-pill-label .pill-dot.dot-blue { background: var(--pln-blue); }
    .category-pill-label .pill-dot.dot-cyan { background: var(--pln-cyan); }
    .category-pill-label .pill-dot.dot-yellow { background: #eab308; }
    .category-pill-label .pill-dot.dot-purple { background: #8b5cf6; }

    .category-pill input:checked + .category-pill-label {
        color: #fff;
        border-color: transparent;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    }
    .category-pill input:checked + .category-pill-label.cat-umum { background: var(--pln-blue); }
    .category-pill input:checked + .category-pill-label.cat-teknis { background: var(--pln-cyan); }
    .category-pill input:checked + .category-pill-label.cat-kegiatan { background: #eab308; color: #1a1a2e; }
    .category-pill input:checked + .category-pill-label.cat-kepegawaian { background: #8b5cf6; }

    /* Responsive khusus pills (sisanya global di admin.css) */
    @media (max-width: 767.98px) {
        .category-pills { gap: 0.4rem; }
        .category-pill-label { padding: 0.4rem 0.75rem; font-size: 0.78rem; }
    }
</style>
@endpush

@section('content')
{{-- ============================================
     TOP NAVIGATION
     ============================================ --}}    <div class="form-topbar">
        <div class="form-topbar-left">
            <a href="{{ route('admin.news.index') }}" class="form-back-btn">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <div>
                <h4 class="form-page-title">{{ $news ? 'Edit Berita' : 'Tambah Berita Baru' }}</h4>
                <p class="form-page-subtitle">{{ $news ? 'Perbarui informasi berita yang sudah ada' : 'Buat dan publikasikan berita baru' }}</p>
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

<form action="{{ $news ? route('admin.news.update', $news) : route('admin.news.store') }}" method="POST" enctype="multipart/form-data" id="newsForm">
    @csrf
    @if ($news)
        @method('PUT')
    @endif

    {{-- ============================================
         SECTION: Informasi Utama
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon blue">
                <i class="fas fa-file-lines"></i>
            </div>
            <div>
                <h6 class="form-section-title">Informasi Utama</h6>
                <p class="form-section-desc">Judul, kategori, dan penulis berita</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-8">
                <div class="form-group">
                    <label class="form-group-label">
                        Judul Berita <span class="required">*</span>
                    </label>
                    <input type="text"
                           id="title"
                           name="title"
                           value="{{ old('title', $news?->title) }}"
                           class="form-input @error('title') is-invalid @enderror"
                           placeholder="Masukkan judul berita..."
                           maxlength="255">
                    @error('title')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <div class="form-error d-none" id="titleError">
                        <i class="fas fa-exclamation-circle"></i> Judul berita wajib diisi.
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-group-label">
                        Penulis <span class="optional">(opsional)</span>
                    </label>
                    <input type="text"
                           id="author"
                           name="author"
                           value="{{ old('author', $news?->author) }}"
                           class="form-input"
                           placeholder="Contoh: Humas PLN">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label">
                Kategori <span class="required">*</span>
            </label>
            <div class="category-pills">
                <div class="category-pill">
                    <input type="radio" name="category" value="umum" id="cat-umum" {{ old('category', $news?->category) === 'umum' ? 'checked' : '' }}>
                    <label for="cat-umum" class="category-pill-label cat-umum">
                        <span class="pill-dot dot-blue"></span> Umum
                    </label>
                </div>
                <div class="category-pill">
                    <input type="radio" name="category" value="teknis" id="cat-teknis" {{ old('category', $news?->category) === 'teknis' ? 'checked' : '' }}>
                    <label for="cat-teknis" class="category-pill-label cat-teknis">
                        <span class="pill-dot dot-cyan"></span> Teknis
                    </label>
                </div>
                <div class="category-pill">
                    <input type="radio" name="category" value="kegiatan" id="cat-kegiatan" {{ old('category', $news?->category) === 'kegiatan' ? 'checked' : '' }}>
                    <label for="cat-kegiatan" class="category-pill-label cat-kegiatan">
                        <span class="pill-dot dot-yellow"></span> Kegiatan
                    </label>
                </div>
                <div class="category-pill">
                    <input type="radio" name="category" value="kepegawaian" id="cat-kepegawaian" {{ old('category', $news?->category) === 'kepegawaian' ? 'checked' : '' }}>
                    <label for="cat-kepegawaian" class="category-pill-label cat-kepegawaian">
                        <span class="pill-dot dot-purple"></span> Kepegawaian
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
         SECTION: Konten Berita
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon cyan">
                <i class="fas fa-align-left"></i>
            </div>
            <div>
                <h6 class="form-section-title">Konten Berita</h6>
                <p class="form-section-desc">Ringkasan dan isi lengkap berita</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label">
                Ringkasan <span class="required">*</span>
            </label>
            <textarea id="excerpt"
                      name="excerpt"
                      class="form-input @error('excerpt') is-invalid @enderror"
                      placeholder="Tuliskan ringkasan singkat berita yang akan ditampilkan di halaman utama..."
                      maxlength="1000"
                      rows="4">{{ old('excerpt', $news?->excerpt) }}</textarea>
            <div class="form-hint flex">
                <i class="far fa-lightbulb"></i> Maksimal 1000 karakter — tampil di kartu berita
            </div>
            @error('excerpt')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
            <div class="form-error d-none" id="excerptError">
                <i class="fas fa-exclamation-circle"></i> Ringkasan berita wajib diisi.
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label">
                Konten Lengkap <span class="optional">(opsional)</span>
            </label>
            <textarea id="content"
                      name="content"
                      class="form-input"
                      placeholder="Tuliskan konten berita secara lengkap untuk halaman detail..."
                      rows="5">{{ old('content', $news?->content) }}</textarea>
            <div class="form-hint flex">
                <i class="far fa-lightbulb"></i> Ditampilkan di halaman detail berita
            </div>
        </div>
    </div>

    {{-- ============================================
         SECTION: Gambar
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon yellow">
                <i class="fas fa-image"></i>
            </div>
            <div>
                <h6 class="form-section-title">Gambar Berita</h6>
                <p class="form-section-desc">Unggah gambar utama untuk berita</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label">
                Gambar Utama <span class="required">*</span>
            </label>
            <div class="image-upload-row-layout">
                <div class="image-upload-area" id="imageDropzone">
                    <div class="image-upload-row">
                        <div class="image-upload-icon">
                            <i class="fas fa-cloud-arrow-up"></i>
                        </div>
                        <div class="image-upload-info">
                            <div class="image-upload-text">
                                <span>Klik untuk upload</span> atau drag & drop
                            </div>
                            <div class="image-upload-hint">PNG, JPG, WebP — Maks 5MB</div>
                        </div>
                    </div>
                    <input type="file"
                           id="imageInput"
                           name="image"
                           class="d-none"
                           accept="image/png,image/jpeg,image/webp">
                </div>

                @if ($news && $news->image)
                <div class="image-preview-container" id="currentImagePreview">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="Gambar saat ini">
                </div>
                @endif
            </div>

            @if ($news && $news->image)
            <label class="replace-image-check">
                <input type="checkbox" name="replace_image" id="replaceImageCheck">
                <span>Ganti gambar dengan yang baru</span>
            </label>
            @endif

            <div class="form-error d-none" id="imageError">
                <i class="fas fa-exclamation-circle"></i> <span id="imageErrorText">Gambar wajib diunggah.</span>
            </div>
            @error('image')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
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
            <a href="{{ route('admin.news.index') }}" class="form-btn-cancel">
                Batal
            </a>
            <button type="submit" class="form-btn-save">
                <i class="fas fa-save"></i> {{ $news ? 'Simpan Perubahan' : 'Publikasikan' }}
            </button>
        </div>
    </div>
</form>

<script>
(function() {
    const imageInput = document.getElementById('imageInput');
    const imageDropzone = document.getElementById('imageDropzone');
    const replaceCheckbox = document.getElementById('replaceImageCheck');
    const hasExistingImage = '{{ $news?->image ?? "" }}' !== '';
    const MAX_IMAGE_SIZE = 5 * 1024 * 1024;

    if (imageDropzone && imageInput) {
        // Click to upload
        imageDropzone.addEventListener('click', function() {
            if (replaceCheckbox && !replaceCheckbox.checked && hasExistingImage) return;
            imageInput.click();
        });

        // Drag & Drop
        imageDropzone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });
        imageDropzone.addEventListener('dragleave', function() {
            this.classList.remove('dragover');
        });
        imageDropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            if (e.dataTransfer.files.length) {
                imageInput.files = e.dataTransfer.files;
                imageInput.dispatchEvent(new Event('change'));
            }
        });

        // File selected
        imageInput.addEventListener('change', function() {
            if (!this.files || !this.files[0]) return;
            const file = this.files[0];

            if (file.size > MAX_IMAGE_SIZE) {
                const mb = (file.size / 1024 / 1024).toFixed(1);
                document.getElementById('imageErrorText').textContent = 'Ukuran gambar maksimal 5MB — file Anda ' + mb + 'MB.';
                document.getElementById('imageError')?.classList.remove('d-none');
                imageDropzone.style.borderColor = '#dc2626';
                imageDropzone.style.background = '#fef2f2';
                return;
            }

            document.getElementById('imageError')?.classList.add('d-none');
            imageDropzone.style.borderColor = '#d1d5db';
            imageDropzone.style.background = '#f9fafb';

            const reader = new FileReader();
            reader.onload = function(e) {
                let container = document.getElementById('newImagePreview');
                if (!container) {
                    container = document.createElement('div');
                    container.id = 'newImagePreview';
                    container.className = 'image-preview-container';
                    container.innerHTML = '<img src="" alt="Preview">';
                    imageDropzone.parentNode.insertBefore(container, imageDropzone.nextSibling);
                }
                container.querySelector('img').src = e.target.result;
            };
            reader.readAsDataURL(file);
        });

        // Replace image checkbox
        if (replaceCheckbox) {
            replaceCheckbox.addEventListener('change', function() {
                imageDropzone.style.borderColor = this.checked ? 'var(--pln-blue)' : '#d1d5db';
                imageDropzone.style.background = this.checked ? '#f0f7ff' : '#f9fafb';
            });
        }
    }

    // Form validation
    const form = document.getElementById('newsForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            let firstInvalid = null;

            const titleInput = document.getElementById('title');
            const titleError = document.getElementById('titleError');
            const titleVal = (titleInput?.value ?? '').trim();
            if (titleVal === '') {
                titleError?.classList.remove('d-none');
                titleInput?.classList.add('is-invalid');
                firstInvalid = firstInvalid ?? titleInput;
            } else {
                titleError?.classList.add('d-none');
                titleInput?.classList.remove('is-invalid');
            }

            const hasCategory = !!document.querySelector('input[name="category"]:checked');
            const categoryError = document.getElementById('categoryError');
            categoryError?.classList.toggle('d-none', hasCategory);
            if (!hasCategory) firstInvalid = firstInvalid ?? document.querySelector('.category-pills');

            const excerptInput = document.getElementById('excerpt');
            const excerptError = document.getElementById('excerptError');
            const excerptVal = (excerptInput?.value ?? '').trim();
            if (excerptVal === '') {
                excerptError?.classList.remove('d-none');
                excerptInput?.classList.add('is-invalid');
                firstInvalid = firstInvalid ?? excerptInput;
            } else {
                excerptError?.classList.add('d-none');
                excerptInput?.classList.remove('is-invalid');
            }

            const hasFile = imageInput?.files && imageInput.files.length > 0;
            const imageError = document.getElementById('imageError');
            const imageErrorText = document.getElementById('imageErrorText');
            let imageBad = false;
            if (!hasFile && (!hasExistingImage || replaceCheckbox?.checked)) {
                if (imageErrorText) imageErrorText.textContent = 'Gambar wajib diunggah — klik area upload.';
                imageBad = true;
            } else if (hasFile && imageInput.files[0].size > MAX_IMAGE_SIZE) {
                if (imageErrorText) imageErrorText.textContent = 'Ukuran gambar maksimal 5MB.';
                imageBad = true;
            }
            imageError?.classList.toggle('d-none', !imageBad);
            if (imageBad) {
                imageDropzone.style.borderColor = '#dc2626';
                imageDropzone.style.background = '#fef2f2';
                firstInvalid = firstInvalid ?? imageDropzone;
            }

            if (firstInvalid) {
                e.preventDefault();
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                if (firstInvalid.tagName === 'INPUT' || firstInvalid.tagName === 'TEXTAREA') {
                    firstInvalid.focus();
                }
            }
        });

        // Clear errors on input
        document.getElementById('title')?.addEventListener('input', function() {
            if (this.value.trim()) {
                document.getElementById('titleError')?.classList.add('d-none');
                this.classList.remove('is-invalid');
            }
        });
        document.getElementById('excerpt')?.addEventListener('input', function() {
            if (this.value.trim()) {
                document.getElementById('excerptError')?.classList.add('d-none');
                this.classList.remove('is-invalid');
            }
        });
        document.querySelectorAll('input[name="category"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                document.getElementById('categoryError')?.classList.add('d-none');
            });
        });
    }
})();
</script>
@endsection
