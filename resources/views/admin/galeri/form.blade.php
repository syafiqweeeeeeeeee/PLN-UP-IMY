@php
    $isEdit = !is_null($gallery);
    $oldKategori = old('kategori', $gallery?->kategori);
    $oldStatus = old('status', $gallery?->status ?? 'publikasi');
@endphp

<div class="dash-card">
    <div class="dash-card-header">
        <div>
            <h5 class="dash-card-title">{{ $isEdit ? 'Edit Foto Galeri' : 'Tambah Foto Galeri' }}</h5>
            <p class="dash-card-subtitle">{{ $isEdit ? 'Perbarui data foto galeri' : 'Unggah foto baru untuk halaman galeri publik' }}</p>
        </div>
        <a href="{{ route('admin.galeri.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ $isEdit ? route('admin.galeri.update', $gallery) : route('admin.galeri.store') }}"
          method="POST" enctype="multipart/form-data" id="galeriForm">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        @if (session('success'))
        <div class="alert alert-success" style="background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; border-radius: 8px; padding: 0.75rem 1rem; font-size: 0.85rem; margin-bottom: 1rem;">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert" style="background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; border-radius: 8px; padding: 0.75rem 1rem; font-size: 0.85rem; margin-bottom: 1rem;">
            <i class="fas fa-circle-exclamation me-1"></i> Perbaiki data berikut.
        </div>
        @endif

        <div class="row g-3">
            {{-- Judul --}}
            <div class="col-lg-8">
                <label for="judul" class="form-label">Judul Foto <span style="color: #dc2626;">*</span></label>
                <input type="text"
                       id="judul"
                       name="judul"
                       value="{{ old('judul', $gallery?->judul) }}"
                       class="form-control-pln @error('judul') is-invalid @enderror"
                       placeholder="Contoh: Dokumentasi Kegiatan Sosialisasi"
                       maxlength="255">
                @error('judul')
                <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <div class="field-error d-none" id="judulError">
                    <i class="fas fa-exclamation-circle"></i> Judul foto wajib diisi.
                </div>
            </div>

            {{-- Tanggal Kegiatan --}}
            <div class="col-lg-4">
                <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan <span style="color: #dc2626;">*</span></label>
                <input type="date"
                       id="tanggal_kegiatan"
                       name="tanggal_kegiatan"
                       value="{{ old('tanggal_kegiatan', $gallery?->tanggal_kegiatan?->format('Y-m-d')) }}"
                       max="{{ now()->format('Y-m-d') }}"
                       class="form-control-pln @error('tanggal_kegiatan') is-invalid @enderror">
                @error('tanggal_kegiatan')
                <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <div class="field-error d-none" id="tanggalError">
                    <i class="fas fa-exclamation-circle"></i> Tanggal kegiatan wajib diisi (tidak boleh di masa depan).
                </div>
            </div>

            {{-- Kategori — badge interaktif, warna dikontrol CSS (.is-checked) + JS --}}
            <div class="col-12">
                <label class="form-label">Kategori <span style="color: #dc2626;">*</span></label>
                <div class="category-selector" role="radiogroup" aria-label="Kategori foto">
                    @foreach ($categories as $cat)
                    <label class="cat-opt cat-opt-{{ strtolower($cat) }} {{ $oldKategori === $cat ? 'is-checked' : '' }}">
                        <input type="radio" name="kategori" value="{{ $cat }}" {{ $oldKategori === $cat ? 'checked' : '' }}>
                        <span>{{ $cat }}</span>
                    </label>
                    @endforeach
                </div>
                @error('kategori')
                <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <div class="field-error d-none" id="kategoriError">
                    <i class="fas fa-exclamation-circle"></i> Kategori wajib dipilih — klik salah satu badge di atas.
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="col-lg-8">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea id="deskripsi"
                          name="deskripsi"
                          class="form-control-pln"
                          placeholder="Keterangan singkat foto (opsional, maksimal 2000 karakter)...">{{ old('deskripsi', $gallery?->deskripsi) }}</textarea>
                @error('deskripsi')
                <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Status Publikasi — markup persis seperti form Berita --}}
            <div class="col-lg-4">
                <label class="form-label mb-2">Status Publikasi</label>
                <div class="d-flex align-items-center gap-3">
                    <label class="form-label mb-0 d-flex align-items-center gap-2" style="cursor: pointer; font-weight: 500;">
                        <input type="radio" name="status" value="publikasi" {{ $oldStatus === 'publikasi' ? 'checked' : '' }} style="accent-color: var(--pln-blue); width: 16px; height: 16px;">
                        <span style="font-size: 0.9rem;">
                            <i class="fas fa-eye me-1" style="color: var(--pln-cyan);"></i> Publikasi
                        </span>
                    </label>
                    <label class="form-label mb-0 d-flex align-items-center gap-2" style="cursor: pointer; font-weight: 500; color: #6b7280;">
                        <input type="radio" name="status" value="draft" {{ $oldStatus === 'draft' ? 'checked' : '' }} style="accent-color: #9ca3af; width: 16px; height: 16px;">
                        <span style="font-size: 0.9rem;">
                            <i class="fas fa-pen me-1" style="color: #9ca3af;"></i> Simpan sebagai Draft
                        </span>
                    </label>
                </div>
                <div style="font-size: 0.72rem; color: #9ca3af; margin-top: 0.3rem;">
                    <i class="far fa-clock me-1"></i> Draft tidak akan tampil di halaman galeri publik
                </div>
            </div>

            {{-- Gambar (Dropzone + Preview) --}}
            <div class="col-12">
                <label class="form-label">Gambar <span style="color: #dc2626;">{{ $isEdit ? '' : '*' }}</span></label>

                <div class="image-dropzone" id="imageDropzone" role="button" tabindex="0" aria-label="Unggah gambar">
                    <i class="fas fa-cloud-upload-alt" style="font-size: 1.6rem; color: #9ca3af; display: block; margin-bottom: 0.5rem;"></i>
                    <div style="font-size: 0.85rem; color: #6b7280; font-weight: 500;">
                        {{ $isEdit ? 'Ganti gambar — klik atau drag foto baru di sini' : 'Klik atau drag gambar di sini' }}
                    </div>
                    <div style="font-size: 0.72rem; color: #9ca3af; margin-top: 0.25rem;">
                        PNG, JPG, JPEG — maksimal 5MB
                    </div>
                </div>

                {{-- Input file tersembunyi — dipicu via JS (klik dropzone & drop) --}}
                <input type="file"
                       id="imageInput"
                       name="file_gambar"
                       class="d-none"
                       accept="image/png, image/jpeg, image/jpg">

                {{-- Preview card --}}
                <div class="image-preview-card {{ ($isEdit && $gallery?->file_gambar) ? '' : 'd-none' }}" id="previewCard"
                     data-existing-url="{{ $gallery?->image_url ?? '' }}"
                     data-existing-name="{{ $gallery ? basename($gallery->file_gambar) : '' }}">
                    <div class="preview-thumb">
                        <img id="previewImg" alt="Preview foto" src="{{ ($isEdit && $gallery?->file_gambar) ? $gallery->image_url : '' }}">
                    </div>
                    <div class="preview-meta">
                        <div class="preview-name" id="previewName">{{ $gallery ? basename($gallery->file_gambar) : '' }}</div>
                        <div class="preview-size" id="previewSize">{{ ($isEdit && $gallery?->file_gambar) ? 'Gambar tersimpan di server' : '' }}</div>
                    </div>
                    <button type="button" class="btn-remove-image" id="removeImageBtn" title="Hapus Foto">
                        <i class="fas fa-trash-can"></i> <span>Hapus Foto</span>
                    </button>
                </div>

                <div class="field-error d-none" id="imageError">
                    <i class="fas fa-exclamation-circle"></i> <span id="imageErrorText">Gambar wajib diunggah — klik area di atas atau seret file ke dalam kotak.</span>
                </div>
                @error('file_gambar')
                <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-3 mt-4">
            <div class="col-12 d-flex justify-content-end gap-2">
                <a href="{{ route('admin.galeri.index') }}" class="btn" style="background: #f3f4f6; color: #6b7280; border: none; border-radius: 8px; padding: 0.7rem 1.6rem; font-weight: 600; font-size: 0.9rem;">
                    Batal
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save me-1"></i> {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Foto' }}
                </button>
            </div>
        </div>
    </form>
</div>

{{-- ============================================================
     Script INLINE di dalam content section — WAJIB di sini (bukan
     @push('scripts')) karena client-side router (router.js) hanya
     menukar isi <main> dan mengeksekusi ulang <script> di dalamnya.
     ============================================================ --}}
<script>
    (function() {
        var form = document.getElementById('galeriForm');
        if (!form) return;

        var MAX_SIZE = 5 * 1024 * 1024; // 5MB
        var VALID_TYPES = ['image/png', 'image/jpeg', 'image/jpg'];

        var dropzone    = document.getElementById('imageDropzone');
        var imageInput  = document.getElementById('imageInput');
        var previewCard = document.getElementById('previewCard');
        var previewImg  = document.getElementById('previewImg');
        var previewName = document.getElementById('previewName');
        var previewSize = document.getElementById('previewSize');
        var removeBtn   = document.getElementById('removeImageBtn');
        var imageError  = document.getElementById('imageError');
        var errorText   = document.getElementById('imageErrorText');

        var existingUrl  = previewCard ? (previewCard.getAttribute('data-existing-url') || '') : '';
        var existingName = previewCard ? (previewCard.getAttribute('data-existing-name') || '') : '';
        var hasExisting  = existingUrl !== '';

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

        /* ---------- Preview (FileReader → data URL, tidak ada objek
           URL yang bisa ter-revoke → thumbnail selalu tampil) ---------- */
        function showPreview(dataUrl, name, sizeText) {
            if (previewImg) previewImg.src = dataUrl;
            if (previewName) previewName.textContent = name;
            if (previewSize) previewSize.textContent = sizeText;
            if (previewCard) previewCard.classList.remove('d-none');
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
                showPreview(e.target.result, file.name, formatSize(file.size) + ' • siap diunggah');
                // Sembunyikan pesan "Klik atau drag gambar di sini" — diganti preview
                dropzone.classList.add('d-none');
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
                dropzone.style.borderColor = '#00A3E0';   // indikator drag aktif — cyan
                dropzone.style.background = '#f0f9ff';
            });
        });

        dropzone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('dragover');
            dropzone.style.borderColor = '#d1d5db';
            dropzone.style.background = '#fafafa';
        });

        dropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('dragover');
            dropzone.style.borderColor = '#d1d5db';
            dropzone.style.background = '#fafafa';

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

        /* ---------- Hapus Foto: kosongkan input + sembunyikan preview ---------- */
        removeBtn.addEventListener('click', function() {
            imageInput.value = '';
            hideImageError();

            if (hasExisting) {
                // Mode edit: gambar lama masih tersimpan di server → kembalikan
                // preview ke gambar tersimpan agar state tetap jujur.
                showPreview(existingUrl, existingName, 'Gambar tersimpan di server');
            } else {
                // Mode tambah: benar-benar kosong → sembunyikan kotak preview
                if (previewImg) previewImg.src = '';
                if (previewName) previewName.textContent = '';
                if (previewSize) previewSize.textContent = '';
                previewCard.classList.add('d-none');
            }

            // Dropzone kembali tampil untuk memilih/menyeret gambar lain
            dropzone.classList.remove('d-none');
        });

        /* ---------- Badge kategori: sinkronkan .is-checked ---------- */
        var categoryInputs = document.querySelectorAll('input[name="kategori"]');

        function syncCategoryBadges() {
            Array.prototype.forEach.call(categoryInputs, function(input) {
                var label = input.closest('label');
                if (label) label.classList.toggle('is-checked', input.checked);
            });
        }

        Array.prototype.forEach.call(categoryInputs, function(radio) {
            radio.addEventListener('change', function() {
                syncCategoryBadges();
                if (errors.kategori) errors.kategori.classList.add('d-none');
            });
        });
        syncCategoryBadges(); // state awal (old() / data edit)

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
            if (kategoriBad) mark(document.querySelector('.category-selector'));

            // Gambar wajib sudah ter-upload sebelum data dikirim
            var hasFile = imageInput.files && imageInput.files.length > 0;
            var imageBad = !hasExisting && !hasFile;
            if (imageBad) {
                showImageError('Gambar wajib diunggah — klik area di atas atau seret file ke dalam kotak.');
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
    .form-label {
        font-weight: 600;
        font-size: 0.82rem;
        color: #374151;
        margin-bottom: 0.4rem;
        display: block;
    }
    .form-control-pln {
        width: 100%;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.62rem 0.9rem;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        background: #fff;
        color: #1f2937;
    }
    .form-control-pln::placeholder { color: #9ca3af; }
    .form-control-pln:focus {
        border-color: var(--pln-blue);
        box-shadow: 0 0 0 3px rgba(0,91,156,0.1);
        outline: none;
    }
    textarea.form-control-pln { resize: vertical; min-height: 110px; }
    .form-control-pln.is-invalid { border-color: #dc2626; background: #fef2f2; }

    .field-error {
        font-size: 0.78rem;
        color: #dc2626;
        margin-top: 0.3rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        color: #6b7280;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: color 0.2s ease;
        padding: 0.4rem 0;
    }
    .btn-back:hover { color: var(--pln-blue); }

    .btn-submit {
        background: linear-gradient(135deg, #0066B2, #00A3E0);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.7rem 1.6rem;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    .btn-submit:hover {
        background: linear-gradient(135deg, #005B9C, #0091c7);
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(0,163,224,0.3);
    }

    /* =============================================
       BADGE KATEGORI INTERAKTIF
       - Unselected: bg putih + teks & border warna kategori
       - Selected  : bg solid warna kategori + teks putih + ring
       Dikontrol oleh .is-checked (JS change listener) dengan
       fallback CSS :has(input:checked) bila JS gagal jalan.
       ============================================= */
    .category-selector {
        display: flex;
        gap: 0.6rem;
        flex-wrap: wrap;
    }
    .category-selector .cat-opt {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.5rem 1.1rem;
        border-radius: 999px;                 /* bentuk badge */
        border: 1.5px solid;
        background: #fff;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.2s ease;
        user-select: none;
    }
    .category-selector .cat-opt input { display: none; }
    .category-selector .cat-opt:hover { transform: translateY(-1px); }

    /* --- Unselected: putih + aksen warna kategori --- */
    .cat-opt-kegiatan    { color: #ca8a04; border-color: #fde047; }
    .cat-opt-fasilitas   { color: #0284c7; border-color: #7dd3fc; }
    .cat-opt-dokumentasi { color: #059669; border-color: #6ee7b7; }
    .cat-opt-seremonial  { color: #9333ea; border-color: #d8b4fe; }

    /* --- Selected: solid + teks putih + ring --- */
    .cat-opt-kegiatan.is-checked,
    .cat-opt-kegiatan:has(input:checked) {
        background: #eab308;                  /* yellow-500 */
        border-color: #eab308;
        color: #fff;
        box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.28);
    }
    .cat-opt-fasilitas.is-checked,
    .cat-opt-fasilitas:has(input:checked) {
        background: #0ea5e9;                  /* sky-500 */
        border-color: #0ea5e9;
        color: #fff;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.28);
    }
    .cat-opt-dokumentasi.is-checked,
    .cat-opt-dokumentasi:has(input:checked) {
        background: #10b981;                  /* emerald-500 */
        border-color: #10b981;
        color: #fff;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.28);
    }
    .cat-opt-seremonial.is-checked,
    .cat-opt-seremonial:has(input:checked) {
        background: #a855f7;                  /* purple-500 */
        border-color: #a855f7;
        color: #fff;
        box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.28);
    }

    /* ---------- Dropzone ---------- */
    .image-dropzone {
        border: 2px dashed #d1d5db;
        border-radius: 10px;
        padding: 1.5rem 1rem;
        text-align: center;
        background: #fafafa;
        transition: border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
        cursor: pointer;
    }
    .image-dropzone:hover {
        border-color: #00A3E0;
        background: #f0f9ff;
    }
    .image-dropzone.dragover {
        border-color: #00A3E0;
        background: #f0f9ff;
        box-shadow: 0 0 0 4px rgba(0,163,224,0.15);
    }
    .image-dropzone:focus-visible {
        outline: none;
        border-color: #00A3E0;
        box-shadow: 0 0 0 3px rgba(0,163,224,0.25);
    }

    /* ---------- Preview card ---------- */
    .image-preview-card {
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
    .image-preview-card .preview-thumb {
        width: 84px;
        height: 84px;
        border-radius: 8px;
        overflow: hidden;
        background: #f1f5f9;
        flex-shrink: 0;
        border: 1px solid #e5e7eb;
    }
    .image-preview-card .preview-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .image-preview-card .preview-meta {
        min-width: 0;
        flex: 1;
    }
    .image-preview-card .preview-name {
        font-size: 0.82rem;
        font-weight: 600;
        color: #1f2937;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .image-preview-card .preview-size {
        font-size: 0.72rem;
        color: #9ca3af;
        margin-top: 0.15rem;
    }
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
    }
    .btn-remove-image:hover {
        background: #dc2626;
        color: #fff;
        transform: translateY(-1px);
    }

    @media (max-width: 575.98px) {
        .category-selector { gap: 0.4rem; }
        .category-selector .cat-opt { padding: 0.4rem 0.8rem; font-size: 0.72rem; }
        .image-preview-card { flex-wrap: wrap; }
    }
</style>
@endpush
@endonce
