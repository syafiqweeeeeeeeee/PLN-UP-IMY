@extends('layouts.admin')

@section('title', ($announcement ? 'Edit Pengumuman' : 'Tambah Pengumuman') . ' — E-PPID PLN')
@section('page-title', ($announcement ? 'Edit Pengumuman' : 'Tambah Pengumuman'))

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

    .form-control-pln.is-invalid {
        border-color: #dc2626;
        background: #fef2f2;
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
    .category-selector label:has(input:checked) {
        background: var(--pln-blue);
        color: #fff;
        border-color: var(--pln-blue);
    }
    .category-selector .badge-umum        { background: rgba(0,91,156,0.88); color: #fff; }
    .category-selector .badge-teknis      { background: rgba(0,163,224,0.88); color: #fff; }
    .category-selector .badge-kepegawaian { background: rgba(139,92,246,0.88); color: #fff; }
    .category-selector .badge-keuangan    { background: rgba(16,185,129,0.88); color: #fff; }
    .category-selector .badge-layanan     { background: rgba(245,158,11,0.92); color: #fff; }

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
                    <h5 class="dash-card-title">{{ $announcement ? 'Edit Pengumuman' : 'Tambah Pengumuman' }}</h5>
                    <p class="dash-card-subtitle">{{ $announcement ? 'Perbarui informasi pengumuman' : 'Buat pengumuman resmi baru untuk publikasi' }}</p>
                </div>
                <a href="{{ route('admin.announcements.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <form action="{{ $announcement ? route('admin.announcements.update', $announcement) : route('admin.announcements.store') }}" method="POST">
                @csrf
                @if ($announcement)
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
                        <label for="title" class="form-label">Judul Pengumuman <span style="color: #dc2626;">*</span></label>
                        <input type="text"
                               id="title"
                               name="title"
                               value="{{ old('title', $announcement?->title) }}"
                               class="form-control-pln @error('title') is-invalid @enderror"
                               placeholder="Judul pengumuman..."
                               maxlength="255">
                        @error('title')
                        <div class="field-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                        <div class="field-error d-none" id="titleError">
                            <i class="fas fa-exclamation-circle"></i> Judul pengumuman wajib diisi.
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div class="col-lg-4">
                        <label class="form-label">Kategori <span style="color: #dc2626;">*</span></label>
                        <div class="category-selector">
                            <label style="background: {{ old('category', $announcement?->category) === 'umum' ? 'var(--pln-blue)' : '#fff' }}; color: {{ old('category', $announcement?->category) === 'umum' ? '#fff' : '#4b5563' }}; border-color: {{ old('category', $announcement?->category) === 'umum' ? 'var(--pln-blue)' : '#e5e7eb' }};">
                                <input type="radio" name="category" value="umum" {{ old('category', $announcement?->category) === 'umum' ? 'checked' : '' }}>
                                <span class="badge-umum" style="border-radius: 4px; padding: 0.1rem 0.45rem; font-size: 0.65rem;">UMUM</span>
                            </label>
                            <label style="background: {{ old('category', $announcement?->category) === 'teknis' ? '#00a3e0' : '#fff' }}; color: {{ old('category', $announcement?->category) === 'teknis' ? '#fff' : '#4b5563' }}; border-color: {{ old('category', $announcement?->category) === 'teknis' ? '#00a3e0' : '#e5e7eb' }};">
                                <input type="radio" name="category" value="teknis" {{ old('category', $announcement?->category) === 'teknis' ? 'checked' : '' }}>
                                <span class="badge-teknis" style="border-radius: 4px; padding: 0.1rem 0.45rem; font-size: 0.65rem;">TEKNIS</span>
                            </label>
                            <label style="background: {{ old('category', $announcement?->category) === 'kepegawaian' ? '#8b5cf6' : '#fff' }}; color: {{ old('category', $announcement?->category) === 'kepegawaian' ? '#fff' : '#4b5563' }}; border-color: {{ old('category', $announcement?->category) === 'kepegawaian' ? '#8b5cf6' : '#e5e7eb' }};">
                                <input type="radio" name="category" value="kepegawaian" {{ old('category', $announcement?->category) === 'kepegawaian' ? 'checked' : '' }}>
                                <span class="badge-kepegawaian" style="border-radius: 4px; padding: 0.1rem 0.45rem; font-size: 0.65rem;">KEPEGAWAIAN</span>
                            </label>
                            <label style="background: {{ old('category', $announcement?->category) === 'keuangan' ? '#059669' : '#fff' }}; color: {{ old('category', $announcement?->category) === 'keuangan' ? '#fff' : '#4b5563' }}; border-color: {{ old('category', $announcement?->category) === 'keuangan' ? '#059669' : '#e5e7eb' }};">
                                <input type="radio" name="category" value="keuangan" {{ old('category', $announcement?->category) === 'keuangan' ? 'checked' : '' }}>
                                <span class="badge-keuangan" style="border-radius: 4px; padding: 0.1rem 0.45rem; font-size: 0.65rem;">KEUANGAN</span>
                            </label>
                            <label style="background: {{ old('category', $announcement?->category) === 'layanan' ? '#b45309' : '#fff' }}; color: {{ old('category', $announcement?->category) === 'layanan' ? '#fff' : '#4b5563' }}; border-color: {{ old('category', $announcement?->category) === 'layanan' ? '#b45309' : '#e5e7eb' }};">
                                <input type="radio" name="category" value="layanan" {{ old('category', $announcement?->category) === 'layanan' ? 'checked' : '' }}>
                                <span class="badge-layanan" style="border-radius: 4px; padding: 0.1rem 0.45rem; font-size: 0.65rem;">LAYANAN</span>
                            </label>
                        </div>
                        @error('category')
                        <div class="field-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                        <div class="field-error d-none" id="categoryError">
                            <i class="fas fa-exclamation-circle"></i> Kategori wajib dipilih — klik salah satu pill di atas.
                        </div>
                    </div>

                    {{-- Excerpt --}}
                    <div class="col-12">
                        <label for="excerpt" class="form-label">Ringkasan (Excerpt) <span style="color: #dc2626;">*</span></label>
                        <textarea id="excerpt"
                                  name="excerpt"
                                  class="form-control-pln @error('excerpt') is-invalid @enderror"
                                  placeholder="Tuliskan ringkasan singkat pengumuman (maksimal 1000 karakter)... tampil di halaman publik"
                                  maxlength="1000">{{ old('excerpt', $announcement?->excerpt) }}</textarea>
                        @error('excerpt')
                        <div class="field-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                        <div class="field-error d-none" id="excerptError">
                            <i class="fas fa-exclamation-circle"></i> Ringkasan pengumuman wajib diisi.
                        </div>
                    </div>

                    {{-- Konten --}}
                    <div class="col-12">
                        <label for="content" class="form-label">Konten Lengkap</label>
                        <textarea id="content"
                                  name="content"
                                  class="form-control-pln"
                                  style="min-height: 180px;"
                                  placeholder="Isi pengumuman secara lengkap (opsional)...">{{ old('content', $announcement?->content) }}</textarea>
                        <div style="font-size: 0.72rem; color: #9ca3af; margin-top: 0.3rem;">
                            <i class="far fa-lightbulb me-1"></i> Opsional — isi detail pengumuman
                        </div>
                    </div>

                    {{-- Status Publikasi --}}
                    <div class="col-lg-4">
                        <label class="form-label mb-2">Status Publikasi</label>
                        <div class="d-flex align-items-center gap-3">
                            <label class="form-label mb-0 d-flex align-items-center gap-2" style="cursor: pointer; font-weight: 500;">
                                <input type="radio" name="is_published" value="1" {{ old('is_published', $announcement?->is_published ?? 1) == 1 ? 'checked' : '' }} style="accent-color: var(--pln-blue); width: 16px; height: 16px;">
                                <span style="font-size: 0.9rem;">
                                    <i class="fas fa-eye me-1" style="color: var(--pln-cyan);"></i> Publikasi
                                </span>
                            </label>
                            <label class="form-label mb-0 d-flex align-items-center gap-2" style="cursor: pointer; font-weight: 500; color: #6b7280;">
                                <input type="radio" name="is_published" value="0" {{ old('is_published', $announcement?->is_published ?? 1) != 1 ? 'checked' : '' }} style="accent-color: #9ca3af; width: 16px; height: 16px;">
                                <span style="font-size: 0.9rem;">
                                    <i class="fas fa-pen me-1" style="color: #9ca3af;"></i> Simpan sebagai Draft
                                </span>
                            </label>
                        </div>
                        <div style="font-size: 0.72rem; color: #9ca3af; margin-top: 0.3rem;">
                            <i class="far fa-clock me-1"></i> Draft tidak akan tampil di halaman pengumuman publik
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-4">
                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.announcements.index') }}" class="btn" style="background: #f3f4f6; color: #6b7280; border: none; border-radius: 8px; padding: 0.7rem 1.6rem; font-weight: 600; font-size: 0.9rem;">
                            Batal
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save me-1"></i> {{ $announcement ? 'Simpan Perubahan' : 'Simpan Pengumuman' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    (function() {
        const form = document.querySelector('form');
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

        form?.addEventListener('submit', function(e) {
            let firstInvalid = null;
            const markInvalid = (el) => { firstInvalid = firstInvalid ?? el; };

            const titleBad = (titleInput?.value ?? '').trim() === '';
            showFieldError(titleInput, titleError, titleBad);
            if (titleBad) markInvalid(titleInput);

            const hasCategory = !!document.querySelector('input[name="category"]:checked');
            categoryError?.classList.toggle('d-none', hasCategory);
            if (!hasCategory) markInvalid(document.querySelector('.category-selector'));

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
