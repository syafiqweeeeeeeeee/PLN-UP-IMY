@extends('layouts.karyawan')

@section('title', ($announcement ? 'Edit Pengumuman' : 'Tambah Pengumuman') . ' — Portal Karyawan')

@push('styles')
<style>
    /* ============================================
       ANNOUNCEMENT FORM — Portal Karyawan
       Markup & class mengikuti design system form
       admin (form-topbar, form-section, form-input,
       category-pills, status-radio, form-footer) —
       global di public/css/karyawan.css. Yang di sini
       HANYA aturan kecil tambahan khusus portal.
       ============================================ */
    .form-input,
    .form-group-label,
    .form-btn-save,
    .form-btn-cancel {
        font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, 'Segoe UI', Roboto, sans-serif;
    }
</style>
@endpush

@section('content')
{{-- ============================================
     TOP NAVIGATION — standar Design System Form
     ============================================ --}}
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('karyawan.announcements.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">{{ $announcement ? 'Edit Pengumuman' : 'Tambah Pengumuman Baru' }}</h4>
            <p class="form-page-subtitle">{{ $announcement ? 'Perbarui informasi pengumuman yang sudah ada' : 'Buat pengumuman resmi baru untuk portal' }}</p>
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

<form action="{{ $announcement ? route('karyawan.announcements.update', $announcement) : route('karyawan.announcements.store') }}" method="POST" id="announcementForm">
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

        <div class="form-group">
            <label class="form-group-label">
                Target Publikasi <span class="required">*</span>
            </label>
            <div class="category-pills">
                <div class="category-pill">
                    <input type="radio" name="target_publication" value="public" id="target-public" {{ old('target_publication', $announcement?->target_publication ?? 'all') === 'public' ? 'checked' : '' }}>
                    <label for="target-public" class="category-pill-label target-public">
                        <span class="pill-dot dot-blue"></span> <i class="fas fa-globe"></i> Publik Utama
                    </label>
                </div>
                <div class="category-pill">
                    <input type="radio" name="target_publication" value="portal" id="target-portal" {{ old('target_publication', $announcement?->target_publication ?? 'all') === 'portal' ? 'checked' : '' }}>
                    <label for="target-portal" class="category-pill-label target-portal">
                        <span class="pill-dot dot-purple"></span> <i class="fas fa-user-lock"></i> Portal Karyawan
                    </label>
                </div>
                <div class="category-pill">
                    <input type="radio" name="target_publication" value="all" id="target-all" {{ old('target_publication', $announcement?->target_publication ?? 'all') === 'all' ? 'checked' : '' }}>
                    <label for="target-all" class="category-pill-label target-all">
                        <span class="pill-dot dot-amber"></span> <i class="fas fa-circle-nodes"></i> Semua (Publik & Portal)
                    </label>
                </div>
            </div>
            <div class="form-hint flex">
                <i class="far fa-lightbulb"></i>
                "Publik Utama" hanya tampil di landing page website publik · "Portal Karyawan" hanya tampil di Portal Karyawan setelah login · "Semua" tampil di keduanya.
            </div>
            @error('target_publication')
                <div class="form-error" style="margin-top: 0.4rem;"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        @if ($lockedDepartment)
        {{-- ===== TARGET PEMBACA (terkunci pada bidang sendiri) =====
             Sama dengan form admin: karyawan terikat bidang hanya boleh
             memilih "Semua Karyawan (Umum)" (global) atau "Khusus Bidang". --}}
        <div class="form-group">
            <label class="form-group-label">
                Target Pembaca
                <span class="optional"><i class="fas fa-lock" style="font-size:0.7rem;"></i> terkunci ({{ \App\Models\User::DEPARTMENTS[$lockedDepartment] ?? $lockedDepartment }})</span>
            </label>
            <div class="category-pills">
                <div class="category-pill">
                    <input type="radio" name="target_audience" value="umum" id="target-audience-umum"
                           {{ old('target_audience', $announcement?->department_id === null ? 'umum' : 'bidang') === 'umum' ? 'checked' : '' }}>
                    <label for="target-audience-umum" class="category-pill-label target-audience-umum">
                        <i class="fas fa-users"></i> Semua Karyawan (Umum)
                    </label>
                </div>
                <div class="category-pill">
                    <input type="radio" name="target_audience" value="bidang" id="target-audience-bidang"
                           {{ old('target_audience', $announcement?->department_id === null ? 'umum' : 'bidang') === 'bidang' ? 'checked' : '' }}>
                    <label for="target-audience-bidang" class="category-pill-label target-audience-bidang">
                        <i class="fas fa-user-lock"></i> Khusus Bidang {{ \App\Models\User::DEPARTMENTS[$lockedDepartment] ?? $lockedDepartment }}
                    </label>
                </div>
            </div>
            <div class="form-hint flex">
                <i class="far fa-lightbulb"></i>
                "Semua Karyawan (Umum)" tampil untuk seluruh pegawai di Portal Karyawan · "Khusus Bidang" hanya untuk internal bidang Anda.
            </div>
        </div>
        @endif
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
            <a href="{{ route('karyawan.announcements.index') }}" class="form-btn-cancel">
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
        if (!form || form.dataset.validated) return;   // anti double-bind
        form.dataset.validated = '1';

        const categoryError = document.getElementById('categoryError');

        // Input kategori tersembunyi (display:none) tidak boleh pakai required
        // HTML5 — validasi manual dengan pesan yang terlihat (sama dengan admin).
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
