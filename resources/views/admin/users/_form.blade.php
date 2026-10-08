{{-- ============================================================
     PARTIAL: Form Tambah/Edit Pengguna (Menu Pengguna)
     Dipakai admin/users/create (user = null) & admin/users/edit.
     Parameter: $user (?User), $roles, $menuMatrix, $userPermissionIds
     ============================================================ --}}
@php
    $isEdit = $user !== null;
    $isSuperAdminEdit = ($isEdit && ($isEditingSuperAdmin ?? false));
    // Direct permission tercentang: input lama (validasi gagal) atau
    // hak akses aktif milik user (spec: edit menampilkan kondisi saat ini).
    $checkedPermissionIds = old('permissions', $userPermissionIds ?? []);
@endphp

@push('styles')
    <style data-page>
        .perm-check { cursor: pointer; }
        /* Super Admin locked fields — disabled appearance */
        .field-locked {
            background: var(--panel-2) !important;
            color: var(--ink-muted) !important;
            cursor: not-allowed !important;
            opacity: 0.85;
        }
        .field-locked input,
        .field-locked select,
        .field-locked textarea {
            background: var(--panel-2) !important;
            color: var(--ink-heading) !important;
            cursor: not-allowed !important;
            opacity: 0.9;
        }
        .field-locked .form-group-label {
            color: var(--ink-muted) !important;
        }
    </style>
@endpush

{{-- ============================================
     TOP NAVIGATION — standar Design System Form
     ============================================ --}}
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ route('admin.users.index') }}" class="form-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h4 class="form-page-title">{{ $isEdit ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}</h4>
            <p class="form-page-subtitle">
                {{ $isEdit
                    ? 'Perbarui data akun, unit kerja, dan Hak Akses Fitur (Direct Permission)'
                    : 'Isi formulir di bawah untuk mendaftarkan pengguna baru' }}
            </p>
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

<form action="{{ $isEdit ? route('admin.users.update', $user) : route('admin.users.store') }}"
      method="POST" id="userForm">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    {{-- ============================================
         SECTION: Informasi Akun
         ============================================ --}}
    @php
        // Super Admin edit: kunci field data diri (nama, email, password)
        $lockedFields = $isSuperAdminEdit ? 'field-locked' : '';
    @endphp
    <div class="form-section {{ $lockedFields }}">
        <div class="form-section-header">
            <div class="form-section-icon blue">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <h6 class="form-section-title">Informasi Akun</h6>
                <p class="form-section-desc">
                    {{ $isSuperAdminEdit
                        ? 'Akun Super Admin — data diri dikunci. Hanya Role & Hak Akses yang bisa diubah.'
                        : 'Nama, email, dan keamanan akun' }}
                </p>
            </div>
        </div>

        @if ($isSuperAdminEdit)
            <div class="alert alert-info d-flex align-items-start gap-2 mb-3">
                <i class="fas fa-lock"></i>
                <div>
                    <strong>Data diri Super Admin terkunci.</strong>
                    Nama, email, dan password tidak dapat diubah. Hanya Role dan Matriks Hak Akses yang dapat dikonfigurasi.
                </div>
            </div>
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="name">
                        Nama Lengkap <span class="required">*</span>
                        @if ($isSuperAdminEdit)<span class="text-muted" style="font-size:0.7rem;">(dikunci)</span>@endif
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-user icon"></i>
                        <input type="text" id="name" name="name"
                               class="form-input {{ $lockedFields }}"
                               value="{{ old('name', $user->name ?? '') }}"
                               {{ $isSuperAdminEdit ? 'readonly' : 'required' }}
                               autocomplete="name" placeholder="Nama lengkap pengguna...">
                    </div>
                    @error('name')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="email">
                        Email <span class="required">*</span>
                        @if ($isSuperAdminEdit)<span class="text-muted" style="font-size:0.7rem;">(dikunci)</span>@endif
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-envelope icon"></i>
                        <input type="email" id="email" name="email" class="form-input {{ $lockedFields }}"
                               value="{{ old('email', $user->email ?? '') }}"
                               {{ $isSuperAdminEdit ? 'readonly' : 'required' }}
                               autocomplete="email" placeholder="email@contoh.com">
                    </div>
                    @error('email')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="password">
                        Password
                        @if (! $isEdit)<span class="required">*</span>@endif
                        @if ($isSuperAdminEdit)<span class="text-muted" style="font-size:0.7rem;">(dikunci)</span>@endif
                    </label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" class="form-input {{ $lockedFields }}"
                               {{ $isSuperAdminEdit ? 'readonly' : ($isEdit ? '' : 'required') }}
                               autocomplete="new-password"
                               placeholder="{{ $isEdit ? 'Biarkan kosong jika tidak ingin mengganti' : 'Min. 8 karakter' }}">
                        <button type="button" class="password-toggle" onclick="togglePassword('password', this)" aria-label="Tampilkan password"
                                {{ $isSuperAdminEdit ? 'disabled style="opacity:0.4;"' : '' }}><i class="fas fa-eye-slash"></i></button>
                    </div>
                    <div id="passwordStrength" class="password-strength"></div>
                    <div id="strengthText" class="strength-text"></div>
                    @error('password')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="password_confirmation">
                        Konfirmasi Password
                        @if (! $isEdit)<span class="required">*</span>@endif
                        @if ($isSuperAdminEdit)<span class="text-muted" style="font-size:0.7rem;">(dikunci)</span>@endif
                    </label>
                    <div class="password-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input {{ $lockedFields }}"
                               {{ $isSuperAdminEdit ? 'readonly' : ($isEdit ? '' : 'required') }}
                               autocomplete="new-password"
                               placeholder="{{ $isEdit ? 'Ulangi password baru (opsional)' : 'Ulangi password...' }}">
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)" aria-label="Tampilkan password"
                                {{ $isSuperAdminEdit ? 'disabled style="opacity:0.4;"' : '' }}><i class="fas fa-eye-slash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         SECTION: Role & Kontak
         selalu tampil — termasuk untuk Super Admin (yang hanya bisa ubah role & permission)
         ============================================ --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon cyan">
                <i class="fas fa-user-tag"></i>
            </div>
            <div>
                <h6 class="form-section-title">Role & Kontak</h6>
                <p class="form-section-desc">
                    {{ $isSuperAdminEdit
                        ? 'Tetapkan Role serta Hak Akses Fitur (Direct Permission) untuk akun ini'
                        : 'Hak akses dan informasi kontak pengguna' }}
                </p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12">
                <div class="form-group">
                    <label class="form-group-label" for="role_id">
                        Role Pengguna <span class="required">*</span>
                    </label>
                    <select id="role_id" name="role_id" class="form-input" required>
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ old('role_id', $user->role_id ?? '') == $role->id ? 'selected' : '' }}
                                {{ $isSuperAdminEdit && $role->name === User::SUPER_ADMIN_ROLE ? 'disabled' : '' }}>
                                {{ $role->name }} {{ $role->status ? '' : '(Nonaktif)' }}
                                @if ($isSuperAdminEdit && $role->name === User::SUPER_ADMIN_ROLE)
                                    (akun sedang dipilih)
                                @endif
                            </option>
                        @endforeach
                    </select>
                    <div class="form-hint flex">
                        <i class="far fa-lightbulb"></i>
                        {{ $isSuperAdminEdit
                            ? 'Pilih role aktif. Role Super Admin tidak dapat diubah karena akun sedang diedit.'
                            : 'Pilih role aktif — role nonaktif tidak dapat digunakan.' }}
                    </div>
                    @error('role_id')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- ===== Hirarki Organisasi: 3 dropdown dinamis =====
                 TIDAK tampil untuk Super Admin edit (tidak ada hirarki) --}}
            @if (! $isSuperAdminEdit)
            <div class="col-md-4" id="levelWrapper">
                <div class="form-group">
                    <label class="form-group-label" for="level_jabatan">
                        Level Jabatan (Role Utama) <span class="required">*</span>
                    </label>
                    <select id="level_jabatan" name="level_jabatan" class="form-input" required>
                        <option value="">-- Pilih Level --</option>
                        @foreach(\App\Models\User::LEVEL_JABATAN as $code => $label)
                            <option value="{{ $code }}"{{ old('level_jabatan', $user->level_jabatan ?? '') === $code ? ' selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('level_jabatan')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4" id="deptWrapper">
                <div class="form-group">
                    <label class="form-group-label" for="department">
                        Bidang Utama <span class="required required-dept">*</span>
                    </label>
                    <select id="department" name="department" class="form-input">
                        <option value="">-- Pilih Bidang --</option>
                        @foreach(\App\Models\User::DEPARTMENTS as $code => $label)
                            <option value="{{ $code }}" {{ old('department', $user->department ?? '') === $code ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <div class="form-hint flex" id="deptHint" style="display:none;">
                        <i class="far fa-lightbulb"></i> Wajib dipilih untuk Admin Bidang, Manager Bidang, Asisten Manager & Staff.
                    </div>
                    @error('department')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4" id="subDeptWrapper">
                <div class="form-group">
                    <label class="form-group-label" for="sub_department">
                        Sub-Bidang / Bagian <span class="required required-sub">*</span>
                    </label>
                    <select id="sub_department" name="sub_department" class="form-input">
                        <option value="">-- Pilih Sub-Bidang --</option>
                    </select>
                    <div class="form-hint flex" id="subHint" style="display:none;">
                        <i class="far fa-lightbulb"></i> Daftar sub-bidang mengikuti Bidang Utama yang dipilih.
                    </div>
                    @error('sub_department')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            @endif

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="no_hp">
                        No. Telepon <span class="optional">(opsional)</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-phone icon"></i>
                        <input type="text" id="no_hp" name="no_hp" class="form-input"
                               value="{{ old('no_hp', $user->no_hp ?? '') }}" placeholder="081234567890">
                    </div>
                    <div class="form-hint flex">
                        <i class="far fa-lightbulb"></i> Isi jika diperlukan untuk kontak
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="alamat">
                        Alamat <span class="optional">(opsional)</span>
                    </label>
                    <textarea id="alamat" name="alamat" class="form-input" rows="2" placeholder="Alamat lengkap pengguna...">{{ old('alamat', $user->alamat ?? '') }}</textarea>
                    <div class="form-hint flex">
                        <i class="far fa-lightbulb"></i> Isi jika diperlukan
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
         SECTION: Hak Akses Fitur (DIRECT PERMISSION)
         Tampil saat Role "Admin Bidang" ATAU "KARYAWAN" dipilih — hak
         akses menu berbeda-beda diatur langsung per akun (bukan via role
         baru), disinkronkan ke tabel user_has_permissions. Untuk karyawan,
         ini jalur membuat varian tugas (mis. "Karyawan SDM" → centang
         Berita/Pengumuman/Galeri, "Karyawan Sekuriti" → Data Tamu).
         TIDAK tampil untuk Super Admin edit (akses penuh sudah otomatis).
         ============================================ --}}
    <div class="form-section" id="directPermSection" @if($isSuperAdminEdit) style="display:none;" @endif>
        <div class="form-section-header">
            <div class="form-section-icon purple">
                <i class="fas fa-shield-halved"></i>
            </div>
            <div>
                <h6 class="form-section-title">Hak Akses Fitur (Direct Permission)</h6>
                <p class="form-section-desc">Centang menu &amp; aksi yang boleh diakses akun ini — tersimpan langsung ke akun, bukan ke role</p>
            </div>
        </div>

        <div class="perm-matrix-block" id="directPermMatrix">
            @include('admin.partials.permission-matrix', [
                'menuMatrix' => $menuMatrix ?? [],
                'checkedIds' => $checkedPermissionIds,
            ])
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
            <button type="button" class="form-btn-cancel" onclick="history.back()">
                Batal
            </button>
            <button type="submit" class="form-btn-save">
                <i class="fas fa-save"></i> {{ $isEdit ? 'Simpan Perubahan' : 'Tambah Pengguna' }}
            </button>
        </div>
    </div>
</form>

{{-- Script WAJIB di dalam @section('content') (bukan @push('scripts'))
     karena client-side router (router.js) hanya mengeksekusi ulang
     <script> di dalam <main>; kalau di push stack, tombol show password
     & indikator kekuatan password mati setelah navigasi via sidebar. --}}
<script>
    function togglePassword(fieldId, btn) {
        const field = document.getElementById(fieldId);
        const icon = btn.querySelector('i');
        // Konvensi: password tersembunyi = eye-slash, terlihat = eye
        if (field.type === 'password') { field.type = 'text'; icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); }
        else { field.type = 'password'; icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); }
    }

    /* ===== Conditional Fields berdasarkan ROLE =====
       - Super Admin  → Level Jabatan, Bidang Utama & Sub-Bidang disembunyikan.
       - Admin Bidang → Level disembunyikan; Bidang Utama & Sub-Bidang tampil
                        (wajib, sub dependent) + SECTION DIRECT PERMISSION tampil.
       - Karyawan     → ketiga field tampil; Level Jabatan hanya 4 tingkat;
                        kewajiban bidang/sub mengikuti level terpilih. */
    (function () {
        const roleSelect = document.getElementById('role_id');
        if (!roleSelect || roleSelect.dataset.roleRulesBound) return;   // anti double-bind
        roleSelect.dataset.roleRulesBound = '1';

        const ROLE_NAMES = @json($roles->pluck('name', 'id'));
        const SUBS = @json(\App\Models\User::SUB_DEPARTMENTS);

        const levelSelect  = document.getElementById('level_jabatan');
        const deptSelect   = document.getElementById('department');
        const subSelect    = document.getElementById('sub_department');
        const levelWrapper = document.getElementById('levelWrapper');
        const deptWrapper  = document.getElementById('deptWrapper');
        const subWrapper   = document.getElementById('subDeptWrapper');
        const deptHint     = document.getElementById('deptHint');
        const subHint      = document.getElementById('subHint');
        const deptReqStar  = document.querySelector('.required-dept');
        const subReqStar   = document.querySelector('.required-sub');
        const permSection  = document.getElementById('directPermSection');
        const permChecks   = Array.from((document.getElementById('directPermMatrix') ?? document).querySelectorAll('.perm-check'));

        function setHidden(wrapper, select, star, hint) {
            wrapper.style.display = 'none';
            select.disabled = true;      // disabled → tidak dikirim ke server
            select.required = false;
            if (star) star.style.display = 'none';
            if (hint) hint.style.display = 'none';
        }

        function setVisible(wrapper, select, star, hint, required) {
            wrapper.style.display = '';
            select.disabled = false;
            select.required = required;
            if (star) star.style.display = required ? '' : 'none';
            if (hint) hint.style.display = '';
        }

        /* Direct Permission section: tampil & aktif HANYA untuk role
           Admin Bidang. Checkbox disabled saat tersembunyi agar nilai
           lama tidak terkirim ke server. */
        function setDirectPermVisible(visible) {
            if (permSection) permSection.style.display = visible ? '' : 'none';
            permChecks.forEach(cb => (cb.disabled = !visible));
        }

        function fillSubOptions(deptCode) {
            // Reset: sisakan placeholder lalu isi opsi sesuai dept terpilih.
            subSelect.innerHTML = '<option value="">-- Pilih Sub-Bidang --</option>';
            const subs = SUBS[deptCode] || {};
            Object.keys(subs).forEach(function (code) {
                const opt = document.createElement('option');
                opt.value = code;
                opt.textContent = subs[code];
                subSelect.appendChild(opt);
            });
        }

        /* Rapikan placeholder dropdown Bidang Utama (bersihkan opsi spesial
           lama & pastikan placeholder standar tampil). */
        function setDeptPlaceholder(placeholder) {
            deptSelect.querySelector('option[value="semua"]')?.remove();
            const empty = deptSelect.querySelector('option[value=""]');
            if (empty) {
                empty.disabled = false;
                empty.textContent = placeholder;
            }
        }

        /* Aturan per Level Jabatan (4 tingkat) — hanya berlaku untuk role
           Karyawan:
           - Senior Manager          → dept & sub DISEMBUNYIKAN TOTAL dari
                                       form; backend mengisi NULL/ALL
                                       otomatis (max 3 akun, akses
                                       view-only seluruh bidang).
           - Manager Bidang          → dept WAJIB; sub DISEMBUNYIKAN
                                       (membawahi seluruh sub-bidang
                                       bidangnya).
           - Asisten Manager / Staff → dept & sub WAJIB; opsi sub dependent
                                       mengikuti dept terpilih. */
        function applyLevelRules() {
            const level = levelSelect.value;

            if (level === 'senior_manager') {
                // Akses global view-only semua bidang → dept & sub
                // disembunyikan total (backend set NULL/ALL otomatis).
                setHidden(deptWrapper, deptSelect, deptReqStar, deptHint);
                setHidden(subWrapper, subSelect, subReqStar, subHint);
                setDeptPlaceholder('-- Pilih Bidang --');
            } else if (level === 'manager_bidang') {
                // Cakupan bidang → dept wajib; sub disembunyikan (membawahi
                // seluruh sub-bidang di bidang tersebut).
                setHidden(subWrapper, subSelect, subReqStar, subHint);
                setVisible(deptWrapper, deptSelect, deptReqStar, deptHint, true);
                deptHint.style.display = 'none';
                setDeptPlaceholder('-- Pilih Bidang --');
                fillSubOptions(deptSelect.value);
            } else if (level === 'asisten_manager' || level === 'staf') {
                // Terkunci sub-bidang → dept & sub wajib (dependent).
                setVisible(deptWrapper, deptSelect, deptReqStar, deptHint, true);
                deptHint.style.display = 'none';
                setVisible(subWrapper, subSelect, subReqStar, subHint, true);
                setDeptPlaceholder('-- Pilih Bidang --');
                fillSubOptions(deptSelect.value);
            } else {
                // Level belum dipilih: dept opsional, sub disembunyikan.
                setVisible(deptWrapper, deptSelect, deptReqStar, deptHint, false);
                deptHint.style.display = '';
                setHidden(subWrapper, subSelect, subReqStar, subHint);
                setDeptPlaceholder('-- Pilih Bidang --');
                fillSubOptions(deptSelect.value);
            }
        }

        /* Aturan utama: conditional fields mengikuti ROLE terpilih. */
        function applyRoleRules() {
            const roleName = ROLE_NAMES[roleSelect.value] || '';

            if (roleName === 'Super Admin') {
                // Semua field hirarki disembunyikan + disabled.
                setHidden(levelWrapper, levelSelect, null, null);
                setHidden(deptWrapper, deptSelect, deptReqStar, deptHint);
                setHidden(subWrapper, subSelect, subReqStar, subHint);
                setDirectPermVisible(false);
            } else if (roleName === 'Admin Bidang') {
                // Level disembunyikan; Bidang Utama & Sub-Bidang wajib
                // (dependent dropdown) + Direct Permission tampil.
                setHidden(levelWrapper, levelSelect, null, null);
                setVisible(deptWrapper, deptSelect, deptReqStar, deptHint, true);
                deptHint.style.display = 'none';
                setVisible(subWrapper, subSelect, subReqStar, subHint, true);
                setDeptPlaceholder('-- Pilih Bidang --');
                fillSubOptions(deptSelect.value);
                setDirectPermVisible(true);
            } else if (roleName === 'Karyawan') {
                setVisible(levelWrapper, levelSelect, null, null, true);
                applyLevelRules();
                // Direct permission TAMPIL untuk karyawan — hak akses
                // fitur per orang (varian tugas) diatur di sini.
                setDirectPermVisible(true);
            } else {
                // Role belum dipilih → sembunyikan seluruh field hirarki.
                setHidden(levelWrapper, levelSelect, null, null);
                setHidden(deptWrapper, deptSelect, deptReqStar, deptHint);
                setHidden(subWrapper, subSelect, subReqStar, subHint);
                setDirectPermVisible(false);
            }
        }

        /* ===== SUPER ADMIN EDIT MODE =====
           Saat mengedit akun Super Admin, seluruh field data diri
           sudah dikunci (readonly) dari sisi HTML. Hirarki OTOMATIS
           disembunyikan karena Super Admin tidak punya hirarki.
           Direct Permission TIDAK ditampilkan karena Super Admin
           memiliki akses penuh ke semua menu. */
        function applySuperAdminEditMode() {
            if (! {{ $isSuperAdminEdit ? 'true' : 'false' }}) return;

            // Sembunyikan seluruh field hirarki
            setHidden(levelWrapper, levelSelect, null, null);
            setHidden(deptWrapper, deptSelect, deptReqStar, deptHint);
            setHidden(subWrapper, subSelect, subReqStar, subHint);
            // Sembunyikan section Direct Permission (Super Admin punya akses penuh)
            setDirectPermVisible(false);

            // Lock role dropdown merujuk ke role saat ini
            if (roleSelect) {
                roleSelect.querySelector('option[value="' + {{ $user?->role_id ?? '0' }} + '"]');
            }
        }

        // Ganti dept → opsi sub di-reset sesuai dept baru (dependent dropdown).
        deptSelect.addEventListener('change', function () {
            fillSubOptions(this.value);
            if (!this.value) subSelect.value = '';
        });

        levelSelect.addEventListener('change', applyLevelRules);
        roleSelect.addEventListener('change', applyRoleRules);

        // Restore tampilan setelah validasi gagal (old input) atau
        // role pre-selected (mode Edit Pengguna).
        applyRoleRules();
        applySuperAdminEditMode();
        const currentRoleName = ROLE_NAMES[roleSelect.value] || '';
        if (currentRoleName === 'Karyawan' || currentRoleName === 'Admin Bidang') {
            // Isi opsi sub sesuai bidang terpilih (old input ATAU data user
            // saat edit), lalu pulihkan nilai sub-nya.
            const currentDept = deptSelect.value;
            if (currentDept) {
                fillSubOptions(currentDept);
                const subValue = @json(old('sub_department', $user->sub_department ?? ''));
                if (subValue) subSelect.value = subValue;
            }
        }
    })();
    const passwordInput = document.getElementById('password');
    const strengthBar = document.getElementById('passwordStrength');
    const strengthText = document.getElementById('strengthText');
    passwordInput?.addEventListener('input', function () {
        const pw = this.value;
        let s = 0;
        if (pw.length >= 8) s++;
        if (pw.length >= 12) s++;
        if (/[A-Z]/.test(pw)) s++;
        if (/[0-9]/.test(pw)) s++;
        if (/[^A-Za-z0-9]/.test(pw)) s++;
        const color = s <= 1 ? '#dc2626' : s <= 2 ? '#f59e0b' : s <= 3 ? '#10b981' : '#059669';
        const text = s <= 1 ? 'Lemah' : s <= 2 ? 'Cukup' : s <= 3 ? 'Kuat' : 'Sangat Kuat';
        strengthBar.style.width = (s * 20) + '%';
        strengthBar.style.background = color;
        strengthText.textContent = text;
        strengthText.style.color = color;
    });
</script>
