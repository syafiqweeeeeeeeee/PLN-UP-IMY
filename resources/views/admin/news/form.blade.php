@extends('layouts.admin')

@section('title', ($news ? 'Edit Berita' : 'Tambah Berita') . ' — E-PPID PLN')
@section('page-title', ($news ? 'Edit Berita' : 'Tambah Berita'))

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

    .field-error {
        font-size: 0.78rem;
        color: #dc2626;
        margin-top: 0.3rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .image-dropzone {
        border: 2px dashed #d1d5db;
        border-radius: 10px;
        padding: 1rem;
        text-align: center;
        background: #fafafa;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .image-dropzone:hover {
        border-color: var(--pln-blue);
        background: #f0f7ff;
    }
    .image-preview {
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        background: #f1f5f9;
        margin-top: 0.75rem;
    }
    .image-preview img {
        width: 100%;
        display: block;
        max-height: 220px;
        object-fit: cover;
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
        background: var(--pln-blue);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.7rem 1.6rem;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    .btn-submit:hover {
        background: #003d6b;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(0,91,156,0.28);
    }

    .category-selector {
        display: flex;
        gap: 0.6rem;
        flex-wrap: wrap;
    }
    .category-selector label {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        color: #4b5563;
    }
    .category-selector input { display: none; }
    .category-selector label:hover { border-color: #cbd5e1; }
    .category-selector input:checked + span {
        color: #fff;
    }
    .category-selector label:has(input:checked) {
        border-color: transparent;
    }
    .category-selector label:has(input:checked) {
        background: var(--pln-blue);
        color: #fff;
        border-color: var(--pln-blue);
    }
    .category-selector .badge-umum:hover { background: #005b9c; }
    .category-selector .badge-teknis:hover { background: #00a3e0; }
    .category-selector .badge-kegiatan:hover { background: #eab900; color: #005b9c; }
    .category-selector .badge-kepegawaian:hover { background: #8b5cf6; }

    /* Responsive */
    @media (max-width: 575.98px) {
        .category-selector { gap: 0.4rem; }
        .category-selector label { padding: 0.4rem 0.75rem; font-size: 0.8rem; }
    }
</style>
@endpush

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="dash-card">
            <div class="dash-card-header">
                <div>
                    <h5 class="dash-card-title">{{ $news ? 'Edit Berita' : 'Tambah Berita' }}</h5>
                    <p class="dash-card-subtitle">{{ $news ? 'Perbarui informasi berita' : 'Buat berita baru untuk publikasi' }}</p>
                </div>
                <a href="{{ route('admin.news.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <form action="{{ $news ? route('admin.news.update', $news) : route('admin.news.store') }}" method="POST" enctype="multipart/form-data" id="newsForm">
                @csrf
                @if ($news)
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
                        <label for="title" class="form-label">Judul Berita <span style="color: #dc2626;">*</span></label>
                        <input type="text"
                               id="title"
                               name="title"
                               value="{{ old('title', $news?->title) }}"
                               class="form-control-pln @error('title') is-invalid @enderror"
                               placeholder="Judul berita..."
                               required
                               maxlength="255">
                        @error('title')
                        <div class="field-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="col-lg-4">
                        <label class="form-label">Kategori <span style="color: #dc2626;">*</span></label>
                        <div class="category-selector">
                            <label style="background: {{ old('category', $news?->category) === 'umum' ? 'var(--pln-blue)' : '#fff' }}; color: {{ old('category', $news?->category) === 'umum' ? '#fff' : '#4b5563' }}; border-color: {{ old('category', $news?->category) === 'umum' ? 'var(--pln-blue)' : '#e5e7eb' }};">
                                <input type="radio" name="category" value="umum" {{ old('category', $news?->category) === 'umum' ? 'checked' : '' }} required>
                                <span style="background: rgba(0,91,156,0.88); color: #fff; border-radius: 4px; padding: 0.1rem 0.45rem; font-size: 0.65rem;">UMUM</span>
                            </label>
                            <label style="background: {{ old('category', $news?->category) === 'teknis' ? '#00a3e0' : '#fff' }}; color: {{ old('category', $news?->category) === 'teknis' ? '#fff' : '#4b5563' }}; border-color: {{ old('category', $news?->category) === 'teknis' ? '#00a3e0' : '#e5e7eb' }};">
                                <input type="radio" name="category" value="teknis" {{ old('category', $news?->category) === 'teknis' ? 'checked' : '' }}>
                                <span style="background: rgba(0,163,224,0.88); color: #fff; border-radius: 4px; padding: 0.1rem 0.45rem; font-size: 0.65rem;">TEKNIS</span>
                            </label>
                            <label style="background: {{ old('category', $news?->category) === 'kegiatan' ? '#ffe600' : '#fff' }}; color: {{ old('category', $news?->category) === 'kegiatan' ? '#005b9c' : '#4b5563' }}; border-color: {{ old('category', $news?->category) === 'kegiatan' ? '#ffe600' : '#e5e7eb' }};">
                                <input type="radio" name="category" value="kegiatan" {{ old('category', $news?->category) === 'kegiatan' ? 'checked' : '' }}>
                                <span style="background: rgba(255,230,0,0.92); color: #005b9c; border-radius: 4px; padding: 0.1rem 0.45rem; font-size: 0.65rem;">KEGIATAN</span>
                            </label>
                            <label style="background: {{ old('category', $news?->category) === 'kepegawaian' ? '#8b5cf6' : '#fff' }}; color: {{ old('category', $news?->category) === 'kepegawaian' ? '#fff' : '#4b5563' }}; border-color: {{ old('category', $news?->category) === 'kepegawaian' ? '#8b5cf6' : '#e5e7eb' }};">
                                <input type="radio" name="category" value="kepegawaian" {{ old('category', $news?->category) === 'kepegawaian' ? 'checked' : '' }}>
                                <span style="background: rgba(139,92,246,0.88); color: #fff; border-radius: 4px; padding: 0.1rem 0.45rem; font-size: 0.65rem;">KEPEGAWAIAN</span>
                            </label>
                        </div>
                        @error('category')
                        <div class="field-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Author --}}
                    <div class="col-lg-4">
                        <label for="author" class="form-label">Penulis / Pengirim</label>
                        <input type="text"
                               id="author"
                               name="author"
                               value="{{ old('author', $news?->author) }}"
                               class="form-control-pln"
                               placeholder="Contoh: Humas PLN NP">
                    </div>

                    {{-- Ekcerpt --}}
                    <div class="col-lg-8">
                        <label for="excerpt" class="form-label">Ringkasan (Ekcerpt) <span style="color: #dc2626;">*</span></label>
                        <textarea id="excerpt"
                                  name="excerpt"
                                  class="form-control-pln @error('excerpt') is-invalid @enderror"
                                  placeholder="Tuliskan ringkasan singkat berita (maksimal 1000 karakter)..."
                                  required
                                  maxlength="1000">{{ old('excerpt', $news?->excerpt) }}</textarea>
                        @error('excerpt')
                        <div class="field-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Konten --}}
                    <div class="col-lg-4">
                        <label for="content" class="form-label">Konten Lengkap</label>
                        <textarea id="content"
                                  name="content"
                                  class="form-control-pln"
                                  placeholder="Konten berita secara lengkap (opsional)...">{{ old('content', $news?->content) }}</textarea>
                        <div style="font-size: 0.72rem; color: #9ca3af; margin-top: 0.3rem;">
                            <i class="far fa-lightbulb me-1"></i> Opsional — isi halaman detail berita
                        </div>
                    </div>

                    {{-- Gambar --}}
                    <div class="col-lg-4">
                        <label class="form-label">Gambar Utama <span style="color: #dc2626;">*</span></label>
                        <div class="image-dropzone" id="imageDropzone">
                            <i class="fas fa-cloud-upload-alt" style="font-size: 1.6rem; color: #9ca3af; display: block; margin-bottom: 0.5rem;"></i>
                            <div style="font-size: 0.85rem; color: #6b7280; font-weight: 500;">
                                Klik atau drag gambar di sini
                            </div>
                            <div style="font-size: 0.72rem; color: #9ca3af; margin-top: 0.25rem;">
                                PNG, JPG — maks 5MB
                            </div>
                            <input type="file"
                                   id="imageInput"
                                   name="image"
                                   class="d-none"
                                   accept="image/png,image/jpeg,image/webp"
                                   {{ $news ? '' : 'required' }}>
                        </div>
                        @if ($news && $news->image)
                        <div class="image-preview">
                            <img src="{{ asset('storage/' . $news->image) }}" alt="Current image">
                        </div>
                        <div class="mt-2">
                            <label class="form-label mb-0" style="font-size: 0.8rem;">
                                <input type="checkbox" name="replace_image" style="margin-right: 0.4rem; accent-color: var(--pln-blue);">
                                Ganti gambar
                            </label>
                        </div>
                        @endif
                        @error('image')
                        <div class="field-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Status Publikasi --}}
                    <div class="col-lg-4">
                        <label class="form-label mb-2">Status Publikasi</label>
                        <div class="d-flex align-items-center gap-3">
                            <label class="form-label mb-0 d-flex align-items-center gap-2" style="cursor: pointer; font-weight: 500;">
                                <input type="radio" name="is_published" value="1" {{ old('is_published', $news?->is_published) == 1 ? 'checked' : '' }} style="accent-color: var(--pln-blue); width: 16px; height: 16px;">
                                <span style="font-size: 0.9rem;">
                                    <i class="fas fa-eye me-1" style="color: var(--pln-cyan);"></i> Publikasi
                                </span>
                            </label>
                            <label class="form-label mb-0 d-flex align-items-center gap-2" style="cursor: pointer; font-weight: 500; color: #6b7280;">
                                <input type="radio" name="is_published" value="0" {{ old('is_published', $news?->is_published) != 1 ? 'checked' : '' }} style="accent-color: #9ca3af; width: 16px; height: 16px;">
                                <span style="font-size: 0.9rem;">
                                    <i class="fas fa-pen me-1" style="color: #9ca3af;"></i> Simpan sebagai Draft
                                </span>
                            </label>
                        </div>
                        <div style="font-size: 0.72rem; color: #9ca3af; margin-top: 0.3rem;">
                            <i class="far fa-clock me-1"></i> Draft tidak akan tampil di halaman berita publik
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-4">
                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.news.index') }}" class="btn" style="background: #f3f4f6; color: #6b7280; border: none; border-radius: 8px; padding: 0.7rem 1.6rem; font-weight: 600; font-size: 0.9rem;">
                            Batal
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save me-1"></i> {{ $news ? 'Simpan Perubahan' : 'Simpan Berita' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    (function() {
        const imageInput = document.getElementById('imageInput');
        const imageDropzone = document.getElementById('imageDropzone');
        const replaceCheckbox = document.querySelector('input[name="replace_image"]');
        const fileLabel = imageDropzone?.querySelector('.d-flex > div');

        if (imageDropzone && imageInput) {
            imageDropzone.addEventListener('click', function(e) {
                if (replaceCheckbox && !replaceCheckbox.checked && '{{ $news?->image ?? 'none' }}' !== 'none') {
                    return;
                }
                imageInput.click();
            });

            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (!imageDropzone.querySelector('.image-preview')) {
                            const preview = document.createElement('div');
                            preview.className = 'image-preview';
                            preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
                            imageDropzone.appendChild(preview);
                        }
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

            if (replaceCheckbox) {
                replaceCheckbox.addEventListener('change', function() {
                    imageDropzone.style.borderColor = this.checked ? 'var(--pln-blue)' : '#d1d5db';
                    imageDropzone.style.background = this.checked ? '#f0f7ff' : '#fafafa';
                    imageInput.required = this.checked;
                });
            }
        }
    })();
</script>
@endsection
