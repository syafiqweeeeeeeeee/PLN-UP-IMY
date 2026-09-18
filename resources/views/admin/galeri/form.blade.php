@php
    $isEdit = !is_null($gallery);
    $oldKategori = old('kategori', $gallery?->kategori);
    $oldStatus = old('status', $gallery?->status ?? 'publikasi');
@endphp

{{-- ============================================
     GALERI FORM — DESIGN SYSTEM FORM STANDAR
     Struktur & style sama dengan form Berita (referensi utama):
     form-section(+icon), form-group, form-input, form-error,
     form-alert, image-upload-*, form-footer, form-btn-save/cancel
     → semua global di public/css/admin.css.
     Yang tersisa di sini HANYA komponen unik Galeri: kategori badge
     + preview card thumbnail dengan tombol hapus.
     ============================================ --}}
<div class="form-alert success d-none">
    <i class="fas fa-check-circle"></i> <span></span>
</div>

<form action="{{ $isEdit ? route('admin.galeri.update', $gallery) : route('admin.galeri.store') }}"
      method="POST" enctype="multipart/form-data" id="galeriForm">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    {{-- ============================================
         SECTION: Informasi Foto
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon blue">
                <i class="fas fa-image"></i>
            </div>
            <div>
                <h6 class="form-section-title">Informasi Foto</h6>
                <p class="form-section-desc">Judul, tanggal kegiatan, dan kategori foto</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-8">
                <div class="form-group">
                    <label class="form-group-label" for="judul">
                        Judul Foto <span class="required">*</span>
                    </label>
                    <input type="text"
                           id="judul"
                           name="judul"
                           value="{{ old('judul', $gallery?->judul) }}"
                           class="form-input @error('judul') is-invalid @enderror"
                           placeholder="Contoh: Dokumentasi Kegiatan Sosialisasi"
                           maxlength="255">
                    @error('judul')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <div class="form-error d-none" id="judulError">
                        <i class="fas fa-exclamation-circle"></i> Judul foto wajib diisi.
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-group-label" for="tanggal_kegiatan">
                        Tanggal Kegiatan <span class="required">*</span>
                    </label>
                    <input type="date"
                           id="tanggal_kegiatan"
                           name="tanggal_kegiatan"
                           value="{{ old('tanggal_kegiatan', $gallery?->tanggal_kegiatan?->format('Y-m-d')) }}"
                           max="{{ now()->format('Y-m-d') }}"
                           class="form-input @error('tanggal_kegiatan') is-invalid @enderror">
                    @error('tanggal_kegiatan')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <div class="form-error d-none" id="tanggalError">
                        <i class="fas fa-exclamation-circle"></i> Tanggal kegiatan wajib diisi (tidak boleh di masa depan).
                    </div>
                </div>
            </div>

            {{-- Kategori — badge interaktif pola pills Berita, warna per kategori --}}
            <div class="col-12">
                <div class="form-group">
                    <label class="form-group-label">
                        Kategori <span class="required">*</span>
                    </label>
                    <div class="category-pills" role="radiogroup" aria-label="Kategori foto">
                        @foreach ($categories as $cat)
                        <div class="category-pill">
                            <input type="radio" name="kategori" value="{{ $cat }}" id="cat-{{ $loop->index }}" {{ $oldKategori === $cat ? 'checked' : '' }}>
                            <label for="cat-{{ $loop->index }}" class="category-pill-label cat-{{ strtolower($cat) }}">
                                <span class="pill-dot"></span> {{ $cat }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @error('kategori')
                        <div class="form-error" style="margin-top: 0.4rem;"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <div class="form-error d-none" id="kategoriError" style="margin-top: 0.4rem;">
                        <i class="fas fa-exclamation-circle"></i> Pilih salah satu kategori.
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         SECTION: Deskripsi & Status
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon cyan">
                <i class="fas fa-align-left"></i>
            </div>
            <div>
                <h6 class="form-section-title">Deskripsi & Status</h6>
                <p class="form-section-desc">Keterangan foto dan status publikasi</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-8">
                <div class="form-group">
                    <label class="form-group-label">
                        Deskripsi <span class="optional">(opsional)</span>
                    </label>
                    <textarea id="deskripsi"
                              name="deskripsi"
                              class="form-input"
                              placeholder="Keterangan singkat foto (maksimal 2000 karakter)...">{{ old('deskripsi', $gallery?->deskripsi) }}</textarea>
                    <div class="form-hint flex">
                        <i class="far fa-lightbulb"></i> Maksimal 2000 karakter — tampil di halaman galeri publik
                    </div>
                    @error('deskripsi')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-group-label">
                        Status Publikasi
                    </label>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <label class="status-radio">
                            <input type="radio" name="status" value="publikasi" {{ $oldStatus === 'publikasi' ? 'checked' : '' }}>
                            <span><i class="fas fa-eye me-1" style="color: var(--pln-cyan);"></i> Publikasi</span>
                        </label>
                        <label class="status-radio muted">
                            <input type="radio" name="status" value="draft" {{ $oldStatus === 'draft' ? 'checked' : '' }}>
                            <span><i class="fas fa-pen me-1" style="color: #9ca3af;"></i> Simpan sebagai Draft</span>
                        </label>
                    </div>
                    <div class="form-hint flex">
                        <i class="far fa-clock"></i> Draft tidak akan tampil di halaman galeri publik
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         SECTION: Gambar — dropzone standar Berita
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon yellow">
                <i class="fas fa-cloud-arrow-up"></i>
            </div>
            <div>
                <h6 class="form-section-title">Gambar Foto</h6>
                <p class="form-section-desc">Unggah foto utama untuk galeri</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label">
                Gambar <span class="required">{{ $isEdit ? '' : '*' }}</span>
                @if ($isEdit)
                    <span class="optional">(kosongkan jika tidak ingin mengubah)</span>
                @endif
            </label>
            <div class="image-upload-row-layout">
                <div class="image-upload-area" id="imageDropzone" role="button" tabindex="0" aria-label="Unggah gambar">
                    <div class="image-upload-row">
                        <div class="image-upload-icon">
                            <i class="fas fa-cloud-arrow-up"></i>
                        </div>
                        <div class="image-upload-info">
                            <div class="image-upload-text">
                                <span>{{ $isEdit ? 'Klik untuk ganti gambar' : 'Klik untuk upload' }}</span> atau drag & drop
                            </div>
                            <div class="image-upload-hint">PNG, JPG, JPEG — Maks 5MB</div>
                        </div>
                    </div>
                    <input type="file"
                           id="imageInput"
                           name="file_gambar"
                           class="d-none"
                           accept="image/png, image/jpeg, image/jpg">
                </div>

                @if ($isEdit && $gallery?->file_gambar)
                <div class="image-preview-container" id="currentImagePreview">
                    <img src="{{ $gallery->image_url }}" alt="Gambar saat ini">
                </div>
                @endif
            </div>

            {{-- Preview card file baru (menampilkan nama + ukuran file) --}}
            <div class="galeri-file-card d-none" id="newFileCard">
                <div class="preview-thumb">
                    <img id="newFileImg" alt="Preview foto">
                </div>
                <div class="preview-meta">
                    <div class="preview-name" id="newFileName"></div>
                    <div class="preview-size" id="newFileSize"></div>
                </div>
                <button type="button" class="btn-remove-image" id="removeNewFileBtn" title="Batalkan pilihan">
                    <i class="fas fa-trash-can"></i> <span>Batalkan</span>
                </button>
 </div>

            <div class="form-error d-none" id="imageError">
                <i class="fas fa-exclamation-circle"></i> <span id="imageErrorText">Gambar wajib diunggah — klik area upload.</span>
            </div>
            @error('file_gambar')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
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
            <a href="{{ route('admin.galeri.index') }}" class="form-btn-cancel">
                Batal
            </a>
            <button type="submit" class="form-btn-save">
                <i class="fas fa-save"></i> {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Foto' }}
            </button>
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
        var form = document.getElementById('galeriForm');
        if (!form || form.dataset.galleryBound) return;   // anti double-bind navigasi SPA
        form.dataset.galleryBound = '1';

        var MAX_SIZE = 5 * 1024 * 1024; // 5MB
        var VALID_TYPES = ['image/png', 'image/jpeg', 'image/jpg'];

        var dropzone    = document.getElementById('imageDropzone');
        var imageInput  = document.getElementById('imageInput');
        var newFileCard = document.getElementById('newFileCard');
        var newFileImg  = document.getElementById('newFileImg');
        var newFileName = document.getElementById('newFileName');
        var newFileSize = document.getElementById('newFileSize');
        var removeBtn   = document.getElementById('removeNewFileBtn');
        var imageError  = document.getElementById('imageError');
        var errorText   = document.getElementById('imageErrorText');

        var existingPreview = document.getElementById('currentImagePreview');
        var hasExisting = !!existingPreview;

        var judulInput   = document.getElementById('judul');
        var tanggalInput = document.getElementById('tanggal_kegiatan');
        var errors = {
            judul:    document.getElementById('judulError'),
            tanggal:  document.getElementById('tanggalError'),
            kategori: document.getElementById('kategoriError')
        };

        function setError(el, errEl, show) {
            if (errEl) errEl.classList.toggle('d-none', !show);
            if (el) el.classList.toggle('is-invalid', show);
        }

        function showImageError(msg) {
            if (errorText) errorText.textContent = msg;
            if (imageError) imageError.classList.remove('d-none');
        }

        function hideImageError() {
            if (imageError) imageError.classList.add('d-none');
        }

        function formatSize(bytes) {
            if (bytes >= 1048576) return (bytes / 1048576).toFixed(2) + ' MB';
            return Math.max(1, Math.round(bytes / 1024)) + ' KB';
        }

        /* ---------- Preview file baru ---------- */
        function showNewFilePreview(dataUrl, name, sizeText) {
            if (newFileImg) newFileImg.src = dataUrl;
            if (newFileName) newFileName.textContent = name;
            if (newFileSize) newFileSize.textContent = sizeText;
            if (newFileCard) newFileCard.classList.remove('d-none');
        }

        function clearNewFilePreview() {
            if (newFileImg) newFileImg.src = '';
            if (newFileName) newFileName.textContent = '';
            if (newFileSize) newFileSize.textContent = '';
            if (newFileCard) newFileCard.classList.add('d-none');
        }

        /* ---------- Validasi + terima file (klik maupun drop) ---------- */
        function handleFile(file) {
            if (!file) return;

            if (VALID_TYPES.indexOf(file.type) === -1) {
                imageInput.value = '';
                showImageError('Format file tidak didukung (' + (file.type || 'tidak dikenal') + '). Gunakan JPG, JPEG, atau PNG.');
                dropzone.style.borderColor = '#dc2626';
                dropzone.style.background = '#fef2f2';
                return;
            }

            if (file.size > MAX_SIZE) {
                imageInput.value = '';
                showImageError('Ukuran gambar maksimal 5MB — file Anda ' + (file.size / 1048576).toFixed(1) + ' MB.');
                dropzone.style.borderColor = '#dc2626';
                dropzone.style.background = '#fef2f2';
                return;
            }

            // Valid — assign ke input agar ikut ter-submit (penting untuk hasil drop)
            try {
                var dt = new DataTransfer();
                dt.items.add(file);
                imageInput.files = dt.files;
            } catch (e) {
                // Browser lama tanpa konstruktor DataTransfer: file hasil klik
                // sudah ada di input; file hasil drop tidak terkirim → fallback.
            }

            dropzone.style.borderColor = '#d1d5db';
            dropzone.style.background = '#fafafa';
            hideImageError();

            // Baca file sebagai data URL → thumbnail menampilkan gambar aktual
            var reader = new FileReader();
            reader.onload = function(e) {
                showNewFilePreview(e.target.result, file.name, formatSize(file.size) + ' • siap diunggah');
            };
            reader.onerror = function() {
                showImageError('Gagal membaca file. Silakan pilih gambar sekali lagi.');
                imageInput.value = '';
            };
            reader.readAsDataURL(file);
        }

        /* ---------- Klik dropzone → buka file explorer ---------- */
        function openPicker() {
            if (imageInput) imageInput.click();
        }
        dropzone.addEventListener('click', openPicker);
        dropzone.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openPicker();
            }
        });

        /* ---------- Drag & drop HTML5 ---------- */
        ['dragenter', 'dragover'].forEach(function(ev) {
            dropzone.addEventListener(ev, function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.add('dragover');
            });
        });

        dropzone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('dragover');
        });

        dropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('dragover');

            var files = e.dataTransfer && e.dataTransfer.files;
            if (files && files.length) handleFile(files[0]);
        });

        // Cegah browser membuka gambar saat file di-drop di luar dropzone
        ['dragover', 'drop'].forEach(function(ev) {
            window.addEventListener(ev, function(e) {
                if (!dropzone.contains(e.target)) e.preventDefault();
            });
        });

        /* ---------- File dipilih via file explorer ---------- */
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                handleFile(this.files[0]);
            }
        });

        /* ---------- Batalkan pilihan file baru ---------- */
        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                imageInput.value = '';
                clearNewFilePreview();
                hideImageError();
                dropzone.style.borderColor = '#d1d5db';
                dropzone.style.background = '#fafafa';
            });
        }

        /* ---------- Badge kategori: sinkron visual lewat CSS :checked sibling ---------- */
        var categoryInputs = document.querySelectorAll('input[name="kategori"]');

        Array.prototype.forEach.call(categoryInputs, function(radio) {
            radio.addEventListener('change', function() {
                if (errors.kategori) errors.kategori.classList.add('d-none');
            });
        });

        /* ---------- Validasi saat submit ---------- */
        form.addEventListener('submit', function(e) {
            var firstInvalid = null;
            function mark(el) { firstInvalid = firstInvalid || el; }

            var judulBad = judulInput.value.trim() === '';
            setError(judulInput, errors.judul, judulBad);
            if (judulBad) mark(judulInput);

            var tanggalBad = tanggalInput.value === '';
            setError(tanggalInput, errors.tanggal, tanggalBad);
            if (tanggalBad) mark(tanggalInput);

            var kategoriBad = !document.querySelector('input[name="kategori"]:checked');
            if (errors.kategori) errors.kategori.classList.toggle('d-none', !kategoriBad);
            if (kategoriBad) mark(document.querySelector('.category-pills'));

            // Gambar wajib sudah ter-upload sebelum data dikirim
            var hasFile = imageInput.files && imageInput.files.length > 0;
            var imageBad = !hasExisting && !hasFile;
            if (imageBad) {
                showImageError('Gambar wajib diunggah — klik area upload.');
                dropzone.style.borderColor = '#dc2626';
                dropzone.style.background = '#fef2f2';
                mark(dropzone);
            }

            if (firstInvalid) {
                e.preventDefault();
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                if (firstInvalid === judulInput || firstInvalid === tanggalInput) firstInvalid.focus();
            }
        });

        /* ---------- Error hilang otomatis saat kolom diisi ---------- */
        judulInput.addEventListener('input', function() {
            setError(judulInput, errors.judul, judulInput.value.trim() === '');
        });
        tanggalInput.addEventListener('input', function() {
            setError(tanggalInput, errors.tanggal, tanggalInput.value === '');
        });
    })();
</script>

@once
@push('styles')
<style>
    /* =============================================
       Komponen unik Galeri — sisanya global di admin.css
       (form-section, form-group, form-input, category pills,
       image-upload-*, form-footer, status-radio)
       ============================================= */

    /* Pill kategori galeri: unselected = outline berwarna,
       selected = solid warna kategori (mengikuti pola pills Berita) */
    .category-pill-label .pill-dot.dot-kegiatan    { background: #eab308; }
    .category-pill-label .pill-dot.dot-fasilitas   { background: #0ea5e9; }
    .category-pill-label .pill-dot.dot-dokumentasi { background: #10b981; }
    .category-pill-label .pill-dot.dot-seremonial  { background: #a855f7; }

    .category-pill input:checked + .category-pill-label.cat-kegiatan {
        background: #eab308; color: #1a1a2e;
    }
    .category-pill input:checked + .category-pill-label.cat-fasilitas {
        background: #0ea5e9;
    }
    .category-pill input:checked + .category-pill-label.cat-dokumentasi {
        background: #10b981;
    }
    .category-pill input:checked + .category-pill-label.cat-seremonial {
        background: #a855f7;
    }

    /* ---------- Preview card file baru ---------- */
    .galeri-file-card {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        background: #fff;
        padding: 0.75rem;
        margin-top: 0.75rem;
        max-width: 520px;
    }
    html.theme-dark .galeri-file-card { background: var(--bg-card); border-color: var(--line); }
    .galeri-file-card .preview-thumb {
        width: 84px;
        height: 84px;
        border-radius: 8px;
        overflow: hidden;
        background: #f1f5f9;
        flex-shrink: 0;
        border: 1px solid #e5e7eb;
    }
    html.theme-dark .galeri-file-card .preview-thumb { background: var(--panel-2); border-color: var(--line); }
    .galeri-file-card .preview-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .galeri-file-card .preview-meta {
        min-width: 0;
        flex: 1;
    }
    .galeri-file-card .preview-name {
        font-size: 0.82rem;
        font-weight: 600;
        color: #1f2937;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    html.theme-dark .galeri-file-card .preview-name { color: var(--ink-heading); }
    .galeri-file-card .preview-size {
        font-size: 0.72rem;
        color: #9ca3af;
        margin-top: 0.15rem;
    }
    html.theme-dark .galeri-file-card .preview-size { color: var(--ink-faint); }
    .btn-remove-image {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        border: none;
        background: #fee2e2;
        color: #b91c1c;
        border-radius: 8px;
        padding: 0.45rem 0.8rem;
        font-size: 0.75rem;
        font-weight: 600;
        transition: all 0.2s ease;
        flex-shrink: 0;
        cursor: pointer;
    }
    .btn-remove-image:hover {
        background: #dc2626;
        color: #fff;
        transform: translateY(-1px);
    }

    @media (max-width: 575.98px) {
        .galeri-file-card { flex-wrap: wrap; }
    }
</style>
@endpush
@endonce
