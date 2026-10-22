{{-- ============================================================
     PARTIAL: Form Tambah/Edit Pengguna (Menu Pengguna)
     Dipakai admin/users/create (user = null) & admin/users/edit.
     Parameter: $user (?User), $roles, $menuMatrix, $userPermissionIds
     ============================================================ --}}
@php
    $isEdit = $user !== null;

    // Penentu hak edit & kompak:
    // - SuperAdminEdit = akun yang diedit adalah Super Admin / Admin utama
    //   DAN pembuka form juga Super Admin / Admin utama.
    // - LockedEdit     = profil sendiri yang diedit oleh Non-Super Admin.
    // - CompactSelfEdit= versi bentuk pendek (hanya Informasi Akun).
    $actor = $actor ?? auth()->user();
    $actorRoleRaw = ($actor && $actor->role) ? trim((string) $actor->role) : '';
    $actorRoleName = strtolower($actorRoleRaw);
    $actorIsSuperUser = ($actorRoleName === 'super admin' || $actorRoleName === 'admin' || ($actor->role_id ?? null) == 1);

    $targetRoleRaw = ($user && $user->role) ? trim((string) $user->role) : '';
    $isEditingSuperAdmin = ($isEdit && ($targetRoleRaw === 'Super Admin' || $targetRoleRaw === 'Admin' || ($user->role_id ?? null) == 1));

    $isSuperAdminEdit = ($isEditingSuperAdmin && $actorIsSuperUser);
    $isLockedEdit     = ($isEdit && !$actorIsSuperUser && $user->id === $actor?->id);
    $isCompactSelfEdit = $isLockedEdit;

    // PETA HAK AKSES BAWAAN (DEFAULT) PER ROLE — di-embed sebagai JSON
    // lalu dipakai JavaScript untuk auto-centang matriks Direct Permission
    // begitu Role dipilih di dropdown "Role Pengguna" (tanpa AJAX).
    // Hanya ID permission yang benar-benar dirender sebagai checkbox di
    // matriks menu yang disertakan, agar sinkron dengan .perm-check di client.
    $matrixPermissionIds = collect($menuMatrix ?? [])
        ->flatMap(fn ($row) => collect($row['permissions'] ?? [])->pluck('id')->all())
        ->unique()
        ->values();

    $roleDefaultPermissionIds = \App\Models\Role::query()
        ->whereIn('id', collect($roles)->pluck('id'))
        ->with('permissions')
        ->get()
        ->mapWithKeys(fn ($role) => [
            $role->id => array_values(array_intersect(
                $role->permissions->pluck('id')->all(),
                $matrixPermissionIds->all()
            )),
        ]);

    // Direct permission tercentang (EDITABLE): input lama (validasi gagal)
    // atau hak akses ekstra per akun (user_has_permissions).
    // MERGE DISPLAY (spec Catatan Perbaikan): view Edit Pengguna menampilkan
    // GABUNGAN = direct permission akun (editable) ∪ hak akses bawaan Role
    // (tampil tercentang TAPI terkunci/read-only). Yang terkunci TIDAK
    // dikirim saat form disimpan — tidak ada lagi penyalinan baseline Role
    // ke user_has_permissions; hak akses tetap aktif karena dibaca
    // dinamis dari role (User::hasPermission).
    $lockedPermissionIds = $roleDefaultPermissionIds[$user?->role_id] ?? [];
    $checkedPermissionIds = array_values(array_unique(array_merge(
        old('permissions', $userPermissionIds ?? []),
        $lockedPermissionIds
    )));

    // Tujuan tombol Kembali / Batal
    // - Edit akun yang ada: kembali ke DETAIL pengguna yang bersangkutan
    //   (admin.users.show) — halaman Edit dibuka dari halaman detail.
    // - Super Admin / Admin utama pada mode Tambah Akun: kembali ke daftar.
    // - Admin Bidang / Non-Super Admin yang edit profil sendiri:
    //   kembali ke profil mereka (admin.users.show).
    if ($isEdit && $user?->id) {
        $backUrl   = route('admin.users.show', $user);
        $cancelUrl = $backUrl;
    } elseif ($actorIsSuperUser) {
        $backUrl   = route('admin.users.index');
        $cancelUrl = $backUrl;
    } elseif ($user?->id === $actor?->id) {
        $backUrl   = route('admin.users.show', $user);
        $cancelUrl = $backUrl;
    } else {
        $backUrl   = url()->previous();
        $cancelUrl = $backUrl;
    }
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
        /* Kelompok visual di dalam section tunggal "Bidang & Jabatan"
           (Akses Sistem / Organisasi / Jabatan) — SATU card, tiga blok
           berbingkai tipis agar bidang/jabatan tidak terlihat duplikat. */
        .bj-group {
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 0.8rem 1rem 1rem;
            margin-bottom: 0.85rem;
        }
        .bj-group:last-of-type { margin-bottom: 0; }
        .bj-group-title {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--pln-blue);
            margin-bottom: 0.8rem;
        }
        .bj-group-title .bj-group-note {
            font-weight: 500;
            text-transform: none;
            letter-spacing: 0;
            font-size: 0.72rem;
            color: var(--ink-muted);
        }
    </style>
@endpush

{{-- ============================================
     TOP NAVIGATION — standar Design System Form
     ============================================ --}}
<div class="form-topbar">
    <div class="form-topbar-left">
        <a href="{{ $backUrl }}" class="form-back-btn">
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
    <div class="form-section">
        <div class="form-section-header">
            <div class="form-section-icon blue">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <h6 class="form-section-title">Informasi Akun</h6>
                <p class="form-section-desc">
                    {{ $isSuperAdminEdit
                        ? 'Akun Super Admin / Admin utama — Role dan Hak Akses diproteksi.'
                        : ($isCompactSelfEdit
                            ? 'Profil Anda. Hanya data dasar diri yang dapat diperbarui.'
                            : 'Nama, email, kontak, dan keamanan akun') }}
                </p>
            </div>
        </div>

        @if($isSuperAdminEdit)
            <div class="alert alert-info d-flex align-items-start gap-2 mb-3">
                <i class="fas fa-lock"></i>
                <div>
                    <strong>Anda sedang mengedit akun Super Admin / Admin utama.</strong>
                    Hanya role Super Admin yang sedang dipilih yang tidak dapat dipindahkan.
                </div>
            </div>
        @endif        <div class="row g-2">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="name">
                        Nama Lengkap <span class="required">*</span>
                        @if ($isSuperAdminEdit)<span class="text-muted" style="font-size:0.7rem;">(dikunci)</span>@endif
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-user icon"></i>
                        <input type="text" id="name" name="name"
                               class="form-input"
                               value="{{ old('name', $user->name ?? '') }}"
                               {{ $isLockedEdit ? 'readonly' : 'required' }}
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
                        <input type="email" id="email" name="email" class="form-input"
                               value="{{ old('email', $user->email ?? '') }}"
                               {{ $isLockedEdit ? 'readonly' : 'required' }}
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
                        <input type="password" id="password" name="password" class="form-input"
                               {{ $isLockedEdit ? 'readonly' : ($isEdit ? '' : 'required') }}
                               autocomplete="new-password"
                               placeholder="{{ $isEdit ? 'Biarkan kosong jika tidak ingin mengganti' : 'Min. 8 karakter' }}">
                        <button type="button" class="password-toggle" onclick="togglePassword('password', this)" aria-label="Tampilkan password"
                                {{ $isLockedEdit ? 'disabled style="opacity:0.4;"' : '' }}><i class="fas fa-eye-slash"></i></button>
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
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input"
                               {{ $isLockedEdit ? 'readonly' : ($isEdit ? '' : 'required') }}
                               autocomplete="new-password"
                               placeholder="{{ $isEdit ? 'Ulangi password baru (opsional)' : 'Ulangi password...' }}">
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)" aria-label="Tampilkan password"
                                {{ $isLockedEdit ? 'disabled style="opacity:0.4;"' : '' }}><i class="fas fa-eye-slash"></i></button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="no_hp">
                        No. Telepon <span class="required">*</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-phone icon"></i>
                        <input type="text" id="no_hp" name="no_hp" class="form-input"
                               value="{{ old('no_hp', $user->no_hp ?? '') }}" placeholder="081234567890" required>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-group-label" for="alamat">
                        Alamat <span class="required">*</span>
                    </label>
                    <textarea id="alamat" name="alamat" class="form-input" rows="2" style="resize:vertical; max-height:80px;" placeholder="Alamat lengkap pengguna..." required>{{ old('alamat', $user->alamat ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>        {{-- ==========================================================
         SECTION: BIDANG & JABATAN
         Hanya TIGA field (2 kolom): Role Pengguna, Master Bidang,
         Master Jabatan.

         - role_id     → hak akses sistem (permission).
         - bidang_id   → unit kerja; server menurunkan sendiri
                         department/department_id/sub_department
                         (jembatan ke filter data lama).
         - jabatan_id  → posisi pekerjaan; server menurunkan
                         level_jabatan (Senior/Manager/Asisten/Staff).

         Level Jabatan, Bidang Utama, dan Sub-Bidang TIDAK lagi dipilih
         manual — semuanya mengikuti baris Master yang dipilih.
         Sembunyikan total bagi self-edit compact (perilaku lama).
         ============================================ --}}
    @if(! $isCompactSelfEdit)
    <div class="form-section" id="unitSection">
        <div class="form-section-header">
            <div class="form-section-icon cyan">
                <i class="fas fa-sitemap"></i>
            </div>
            <div>
                <h6 class="form-section-title">Bidang & Jabatan</h6>
                <p class="form-section-desc">
                    {{ $isSuperAdminEdit
                        ? 'Role akun ini diproteksi — unit kerja & jabatan mengikuti data master'
                        : 'Role menentukan hak akses; Master Bidang & Master Jabatan menentukan unit kerja dan posisi pengguna' }}
                </p>
            </div>
        </div>

        {{-- ===== KELOMPOK: Akses & Unit Kerja (Role + Master) ===== --}}
        <div class="bj-group" id="groupAkses">
            <div class="bj-group-title">
                <i class="fas fa-key"></i> Akses & Unit Kerja
                <span class="bj-group-note">Role menentukan hak akses sistem; Master Bidang & Master Jabatan menentukan unit kerja dan posisi</span>
            </div>
            <div class="row g-3">
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label utama disembunyikan secara visual (tetap terbaca screen reader)
                         dan digantikan floating label DI DALAM box. --}}
                    <label class="form-group-label pln-label-sr" for="role_id">
                        Role Pengguna <span class="required">*</span>
                    </label>
                    <div class="pln-select-wrap">
                        <span class="pln-field-float">Role Pengguna <span class="required">*</span></span>
                        <select id="role_id" name="role_id" class="form-input" required>
                            <option value="">-- Pilih Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ old('role_id', $user->role_id ?? '') == $role->id ? 'selected' : '' }}
                                    {{ ($isEditingSuperAdmin && $role->name === User::SUPER_ADMIN_ROLE) ? 'disabled' : '' }}>
                                    {{ $role->name }} {{ $role->status ? '' : '(Nonaktif)' }}
                                    @if ($isEditingSuperAdmin && $role->name === User::SUPER_ADMIN_ROLE)
                                        (akun sedang dipilih)
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-hint flex">
                        <i class="far fa-lightbulb"></i>
                        {{ $isEditingSuperAdmin
                            ? 'Pilih role aktif. Role Super Admin sedang dipilih; tidak dapat dipindahkan.'
                            : 'Pilih role aktif — role nonaktif tidak dapat digunakan.' }}
                    </div>
                    @error('role_id')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            </div>{{-- /row g-3 --}}
        </div>{{-- /bj-group: Akses & Unit Kerja --}}

        {{-- ===== KELOMPOK: Master Bidang & Jabatan =====
             Dua field terakhir form: pilihan unit kerja & posisi dari
             tabel bidangs / jabatans. Server menurunkan department,
             department_id, sub_department, dan level_jabatan dari pilihan
             ini (lihat UserController::applyOrgScoping), sehingga filter
             data lama tetap bekerja tanpa field manual tambahan.

             Jabatan bersifat dependent: opsi mengikuti Master Bidang
             yang dipilih. Jabatan BUKAN role — hak akses tetap role_id.
             ===== --}}
        <div class="bj-group" id="masterUnitSection">
            <div class="bj-group-title">
                <i class="fas fa-sitemap"></i> Master Bidang & Jabatan
                <span class="bj-group-note">Pilih unit kerja pada Master Bidang (induk atau sub-bidang), lalu jabatan di dalamnya</span>
            </div>

            <div class="row g-3">
            <div class="col-md-6" id="masterBidangWrapper">
                <div class="form-group">
                    <label class="form-group-label pln-label-sr" for="bidang_id">
                        Master Bidang
                        <span class="required pln-float-star">*</span>
                    </label>
                    <div class="pln-select-wrap">
                        <span class="pln-field-float">Master Bidang <span class="required pln-float-star">*</span></span>
                        <select id="bidang_id" name="bidang_id" class="form-input">
                            <option value="">-- Pilih Bidang --</option>
                            @foreach ($bidangs ?? [] as $bidang)
                                <option value="{{ $bidang->id }}"
                                    {{ old('bidang_id', $user->bidang_id ?? '') == $bidang->id ? 'selected' : '' }}>
                                    {{ $bidang->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-hint flex" id="masterBidangHint" style="display:none;">
                        <i class="far fa-lightbulb"></i> Wajib untuk Admin Bidang & Karyawan. Pilih sub-bidang bila akun terkunci di bagian tertentu.
                    </div>
                    @error('bidang_id')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6" id="masterJabatanWrapper">
                <div class="form-group">
                    <label class="form-group-label pln-label-sr" for="jabatan_id">
                        Jabatan
                    </label>
                    <div class="pln-select-wrap">
                        <span class="pln-field-float">Jabatan <span class="required pln-float-star">*</span></span>
                        <select id="jabatan_id" name="jabatan_id" class="form-input">
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach ($jabatans ?? [] as $jabatan)
                                <option value="{{ $jabatan->id }}"
                                    data-bidang="{{ $jabatan->bidang_id }}"
                                    {{ old('jabatan_id', $user->jabatan_id ?? '') == $jabatan->id ? 'selected' : '' }}>
                                    {{ $jabatan->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-hint flex" id="masterJabatanHint" style="display:none;">
                        <i class="far fa-lightbulb"></i> Daftar jabatan mengikuti Bidang yang dipilih. Jabatan adalah posisi pekerjaan — hak akses sistem tetap ditentukan Role.
                    </div>
                    @error('jabatan_id')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            </div>{{-- /row g-3 --}}
        </div>{{-- /bj-group: Jabatan --}}
    </div>{{-- /form-section: Bidang & Jabatan --}}

    {{-- ============================================
         SECTION: Hak Akses Fitur (DIRECT PERMISSION)
         Tampil saat Role "Admin Bidang" ATAU "KARYAWAN" dipilih — hak
         akses menu berbeda-beda diatur langsung per akun (bukan via role
         baru), disinkronkan ke tabel user_has_permissions. Untuk karyawan,
         ini jalur membuat varian tugas (mis. "Karyawan SDM" → centang
         Berita/Pengumuman/Galeri, "Karyawan Sekuriti" → Data Tamu).
         TIDAK tampil untuk Super Admin edit (akses penuh sudah otomatis).
         ============================================ --}}
    <div class="form-section" id="directPermSection" @if($isCompactSelfEdit) style="display:none;" @endif>
        <div class="form-section-header">
            <div class="form-section-icon purple">
                <i class="fas fa-shield-halved"></i>
            </div>
            <div>
                <h6 class="form-section-title">Hak Akses Fitur (Direct Permission)</h6>
                <p class="form-section-desc">
                    {{ $isCompactSelfEdit
                        ? 'Hak Akses Fitur tidak dapat diubah (hanya Super Admin / Admin utama yang boleh ubah).'
                        : 'Gabungan hak akses: centang bawaan Role tampil terkunci (gembok) & otomatis aktif; centang tambahan tersimpan langsung ke akun, bukan ke role.' }}
                </p>
            </div>
        </div>

        <div class="perm-matrix-block" id="directPermMatrix">
            @include('admin.partials.permission-matrix', [
                'menuMatrix' => $menuMatrix ?? [],
                'checkedIds' => $checkedPermissionIds,
                'lockedIds'  => $lockedPermissionIds,
            ])
        </div>
    </div>
    @endif

    {{-- ============================================
         FOOTER — standar Design System Form
         ============================================ --}}
    <div class="form-footer">
        <div class="form-footer-info">
            <i class="fas fa-circle-info"></i> Field dengan <span style="color:#dc2626;">*</span> wajib diisi
        </div>
        <div class="form-footer-actions">
            <button type="button" class="form-btn-cancel"
                    onclick="location.href='{{ $cancelUrl }}'">
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
        // MASTER Jabatan (tabel jabatans) — untuk dependent dropdown:
        // opsi Jabatan mengikuti Master Bidang terpilih.
        // NOTE: jabatan ≠ role — ini data posisi pekerjaan murni.
        const MASTER_JABATANS = @json($jabatans ?? collect());
        // Default permission (ID) per Role — kunci = role_id, value = array ID.
        const ROLE_DEFAULT_PERMS = @json($roleDefaultPermissionIds);

        const permSection  = document.getElementById('directPermSection');
        const permChecks   = Array.from((document.getElementById('directPermMatrix') ?? document).querySelectorAll('.perm-check'));

        // MASTER Bidang & Jabatan — satu-satunya input organisasi pada form.
        const masterUnitSection = document.getElementById('masterUnitSection');
        const masterBidangSel   = document.getElementById('bidang_id');
        const masterJabatanSel  = document.getElementById('jabatan_id');

        /* Direct Permission section: tampil & aktif HANYA untuk role
           delegasi (Admin Bidang / Karyawan). Checkbox disabled saat
           tersembunyi agar nilai lama tidak terkirim ke server.
           Checkbox ber-tanda bawaan role (role-locked) TETAP disabled
           meskipun section tampil — mereka read-only. */
        function setDirectPermVisible(visible) {
            if (permSection) permSection.style.display = visible ? '' : 'none';
            permChecks.forEach(cb => (cb.disabled = !visible || cb.dataset.roleLocked === '1'));
        }

        /* ===== AUTO-CENTANG MENGIKUTI ROLE (MERGE DISPLAY) =====
           Saat role diganti, matriks di-reset: permission bawaan Role BARU
           tampil tercentang TAPI TERKUNCI (disabled), sedangkan seluruh
           centang editable (direct permission) dikosongkan karena hak
           akses ekstra lama tidak lagi relevan bagi role baru.
           Hanya berjalan saat user MENGUBAH pilihan role — pada load awal
           (mode Edit / old input setelah validasi gagal) centang yang sudah
           ada TIDAK disentuh. */
        function applyRoleDefaultPermissions() {
            const defaults = new Set((ROLE_DEFAULT_PERMS[roleSelect.value] ?? []).map(Number));
            permChecks.forEach(cb => {
                const locked = defaults.has(Number(cb.value));
                cb.checked = locked;
                cb.disabled = true;                 // sementara, dinormalisasi di bawah
                cb.dataset.roleLocked = locked ? '1' : '';
                cb.classList.toggle('perm-role-locked', locked);
            });

            // Aktifkan kembali checkbox editable (bukan bawaan role).
            permChecks.forEach(cb => {
                if (cb.dataset.roleLocked !== '1') cb.disabled = false;
            });
        }

        /* ===== MASTER BIDANG & JABATAN (dependent dropdown) =====
           Jabatan hanya menampilkan opsi milik Master Bidang terpilih.
           Bila bidang berubah, jabatan yang tidak lagi relevan di-reset.
           Required Jabatan aktif hanya bila bidang terpilih punya minimal
           satu jabatan (sinkron dengan aturan server). */
        function fillMasterJabatanOptions(bidangId, keepValue) {
            masterJabatanSel.innerHTML = '<option value="">-- Pilih Jabatan --</option>';

            const rows = MASTER_JABATANS.filter(j => String(j.bidang_id) === String(bidangId));
            rows.forEach(function (j) {
                const opt = document.createElement('option');
                opt.value = j.id;
                opt.textContent = j.nama;
                masterJabatanSel.appendChild(opt);
            });

            // Pertahankan nilai lama (old input / data user saat edit)
            // HANYA bila masih relevan dengan bidang terpilih.
            if (keepValue && rows.some(j => String(j.id) === String(keepValue))) {
                masterJabatanSel.value = String(keepValue);
            }

            masterJabatanSel.required = rows.length > 0;
        }

        /* Tampil & required-nya Master Bidang mengikuti role: wajib untuk
           Admin Bidang & Karyawan, opsional untuk role lain (role buatan
           admin). Level Jabatan / Sub-Bidang tidak lagi dipilih manual —
           server menurunkannya dari Master Bidang & Jabatan. */
        function applyMasterUnitRules(roleName) {
            if (! masterUnitSection) return;   // form compact self-edit

            // Kewajiban Bidang hanya bila master bidangs TERISI — opsi
            // kosong (install baru belum di-seed) tidak memblokir akun.
            const hasBidangOptions = Array.from(masterBidangSel.options)
                .some(opt => opt.value !== '');
            const required = ['Admin Bidang', 'Karyawan'].includes(roleName) && hasBidangOptions;

            masterUnitSection.style.display = '';
            masterBidangSel.disabled = false;
            masterBidangSel.required = required;
            masterJabatanSel.disabled = false;

            const masterBidangHint = document.getElementById('masterBidangHint');
            const masterJabatanHint = document.getElementById('masterJabatanHint');
            if (masterBidangHint) masterBidangHint.style.display = required ? '' : 'none';
            if (masterJabatanHint) masterJabatanHint.style.display = '';

            // Isi ulang opsi jabatan sesuai bidang terpilih (old input /
            // data user saat edit), sekaligus menyetel required-nya.
            fillMasterJabatanOptions(masterBidangSel.value, masterJabatanSel.value);
        }

        function applyRoleRules() {
            const roleName = ROLE_NAMES[roleSelect.value] || '';

            if (roleName === 'Super Admin') {
                // Super Admin tanpa unit kerja: field disembunyikan &
                // disabled (server juga memaksa bidang/jabatan null).
                if (masterUnitSection) {
                    masterUnitSection.style.display = 'none';
                    masterBidangSel.disabled = true;
                    masterBidangSel.required = false;
                    masterJabatanSel.disabled = true;
                    masterJabatanSel.required = false;
                }
                setDirectPermVisible(false);
            } else {
                // Admin Bidang / Karyawan / role buatan admin: Master
                // Bidang & Jabatan tampil (wajib untuk dua role pertama,
                // opsional untuk role lain).
                setDirectPermVisible(['Admin Bidang', 'Karyawan'].includes(roleName));
                applyMasterUnitRules(roleName);
            }
        }

        /* ===== SUPER ADMIN EDIT MODE =====
           Saat mengedit akun Super Admin, data diri sudah dikunci
           (readonly) dari sisi HTML. Master Bidang & Jabatan serta Direct
           Permission disembunyikan karena Super Admin tidak punya unit
           kerja dan sudah memiliki akses penuh. */
        function applySuperAdminEditMode() {
            if (! {{ $isSuperAdminEdit ? 'true' : 'false' }}) return;

            setDirectPermVisible(false);

            if (masterUnitSection) {
                masterUnitSection.style.display = 'none';
                masterBidangSel.disabled = true;
                masterBidangSel.required = false;
                masterJabatanSel.disabled = true;
                masterJabatanSel.required = false;
            }
        }

        // Ganti Master Bidang → opsi Jabatan difilter (dependent dropdown).
        masterBidangSel?.addEventListener('change', function () {
            fillMasterJabatanOptions(this.value, '');
        });

        roleSelect.addEventListener('change', applyRoleRules);
        // Auto-centang hak akses mengikuti Role — didaftarkan SETELAH
        // applyRoleRules agar visibilitas section Direct Permission sudah
        // ditentukan lebih dulu.
        roleSelect.addEventListener('change', applyRoleDefaultPermissions);

        // Restore tampilan setelah validasi gagal (old input) atau
        // role pre-selected (mode Edit Pengguna).
        applyRoleRules();
        applySuperAdminEditMode();
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

    /* ===== ENHANCED SELECT — minimalis + selalu terbuka ke bawah =====
       Select native (Role Pengguna, Master Bidang, Master Jabatan)
       dibungkus panel list custom (.pln-dd-panel):
         - TANPA kotak pencarian & tanpa opsi placeholder: panel hanya
           menampilkan daftar opsi data murni ("Prod A", dst.), langsung
           tersaji begitu dropdown diklik.
         - Panel SELALU terposisi DI BAWAH kontrol (fixed, di-append ke
           <body> sehingga immune terhadap overflow/clip card & footer),
           tidak pernah menutupi/flip menutup input utamanya.
         - Tidak pernah flip ke atas: bila ruang di bawah viewport < 96px,
           halaman di-scroll otomatis sebelum panel tampil agar ruang cukup.
         - List pilihan dibangun fresh SETIAP panel dibuka → selalu sinkron
           dengan opsi dinamis (dependent dropdown Master Jabatan dsb.).
         - Item dipilih men-set nilai pada <select> ASLI lalu men-dispatch
           event 'input' + 'change' → seluruh logika lama (applyRoleRules,
           dependent jabatan, server-side) tidak tersentuh dan form tetap
           mengirim select native.
         - Floating label: wrapper .pln-select-wrap dipantau — state
           is-open (ring fokus saat panel open), is-required (bintang
           wajib mengikuti atribut required), dan is-empty pada select
           (teks kontrol dikosongkan bila belum memilih).*/
    (function () {
        const selects = document.querySelectorAll('#userForm select.form-input');
        if (!selects.length) return;

        let openPanel = null;      // .pln-dd-panel aktif
        let ownerSelect = null;    // <select> pemilik panel aktif
        let ownerWrap = null;      // .pln-select-wrap pemilik panel
        let resultsBox = null;     // container item panel
        let emptyNote = null;      // catatan kosong (tanpa opsi sama sekali)
        let focusIndex = -1;       // index item ter-highlight
        let items = [];            // elemen .pln-dd-item panel

        const MIN_BELOW = 96;      // px ruang minimum di bawah kontrol
        const MAX_HEIGHT = 320;    // px tinggi maksimum panel
        let suppressScrollClose = false;

        function suppressScrollCloseOnce() {
            suppressScrollClose = true;
            requestAnimationFrame(() => requestAnimationFrame(() => { suppressScrollClose = false; }));
        }

        function closePanel() {
            if (openPanel) { openPanel.remove(); openPanel = null; }
            if (ownerWrap) ownerWrap.classList.remove('is-open');
            ownerWrap = null;
            ownerSelect = null;
            focusIndex = -1;
            items = [];
            resultsBox = null;
            emptyNote = null;
        }

        function optionLabel(opt) {
            const extra = opt.dataset?.ddExtra ?? '';
            return (opt.textContent.trim() || '') + (extra ? ' ' + extra : '');
        }

        function setFocus(index) {
            items.forEach(el => el.classList.remove('is-focused'));
            focusIndex = index;
            if (items[focusIndex]) {
                items[focusIndex].classList.add('is-focused');
                items[focusIndex].scrollIntoView({ block: 'nearest' });
            }
        }

        function buildItems() {
            items = [];
            emptyNote = document.createElement('div');
            emptyNote.className = 'pln-dd-empty';

            // Daftar murni opsi data — opsi placeholder (value kosong,
            // "-- Pilih ... --") TIDAK ikut ditampilkan di panel.
            const opts = Array.from(ownerSelect.options).filter(opt => opt.value !== '');
            if (!opts.length) {
                emptyNote.textContent = 'Tidak ada pilihan';
                resultsBox.appendChild(emptyNote);
                return;
            }
            opts.forEach(function (opt) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'pln-dd-item';

                const label = document.createElement('span');
                label.textContent = optionLabel(opt);
                btn.appendChild(label);

                const check = document.createElement('span');
                check.className = 'pln-dd-check';
                check.innerHTML = '<i class="fas fa-check"></i>';
                if (opt.selected) btn.appendChild(check);

                if (opt.value === '') btn.classList.add('is-placeholder');
                if (opt.selected) btn.classList.add('is-selected');
                if (opt.disabled) btn.disabled = true;

                btn.addEventListener('click', function () {
                    if (opt.disabled) return;
                    ownerSelect.value = opt.value;
                    // Dispatch dua-duanya — konsumen yang listen 'change'
                    // atau 'input' tetap terpanggil (sama dengan native).
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
            // scroll halaman otomatis untuk menciptakan ruang — panel
            // TIDAK PERNAH flip ke atas & tidak pernah menutupi input.
            // Rect diambil ulang setelah scroll (viewport berubah).
            let rect = select.getBoundingClientRect();
            let below = window.innerHeight - rect.bottom;
            if (below < MIN_BELOW) {
                suppressScrollCloseOnce();
                window.scrollBy({ top: (MIN_BELOW + 120) - below, behavior: 'instant' });
                rect = select.getBoundingClientRect();
                below = window.innerHeight - rect.bottom;
            }

            // Panel hanya berisi daftar opsi — tanpa kotak pencarian.
            const panel = document.createElement('div');
            panel.className = 'pln-dd-panel';
            panel.style.left = Math.round(rect.left) + 'px';
            // LEBAR 100% kontrol — persis sejajar input box (tanpa min-width).
            panel.style.width = Math.round(rect.width) + 'px';
            // Margin-top 6px antara input box & panel melayang.
            panel.style.top = Math.round(rect.bottom + 6) + 'px';
            panel.style.maxHeight = Math.max(140, Math.min(MAX_HEIGHT, below - 16)) + 'px';

            const results = document.createElement('div');
            results.className = 'pln-dd-results';
            resultsBox = results;

            panel.appendChild(results);
            document.body.appendChild(panel);

            openPanel = panel;
            ownerSelect = select;
            ownerWrap = select.closest('.pln-select-wrap');
            ownerWrap?.classList.add('is-open');
            buildItems();

            // Pre-highlight item terpilih (atau pertama); fokus tetap pada
            // select agar navigasi keyboard langsung bekerja.
            const selectedIdx = items.findIndex(el => el.classList.contains('is-selected'));
            setFocus(selectedIdx >= 0 ? selectedIdx : 0);
            select.focus();
        }

        selects.forEach(function (select) {
            syncFieldState(select);

            // Atribut required/disabled berubah dinamis (applyRoleRules) —
            // pantau agar bintang & tampilan float label ikut sinkron.
            new MutationObserver(function () { syncFieldState(select); })
                .observe(select, { attributes: true, attributeFilter: ['required', 'disabled'] });

            // Klik kontrol → tampilkan panel custom (native picker dicegah).
            select.addEventListener('mousedown', function (e) {
                if (select.disabled) return;          // biarkan disabled apa adanya
                e.preventDefault();
                if (openPanel && ownerSelect === select) { closePanel(); return; }
                if (openPanel) { closePanel(); }
                openPanelFor(select);
            });

            select.addEventListener('keydown', function (e) {
                if (select.disabled) return;
                const key = e.key;
                if (openPanel && ownerSelect === select) {
                    // Terbuka: navigasi & konfirmasi via keyboard.
                    if (key === 'ArrowDown') { e.preventDefault(); if (items.length) setFocus(Math.min(focusIndex + 1, items.length - 1)); }
                    else if (key === 'ArrowUp') { e.preventDefault(); if (items.length) setFocus(Math.max(focusIndex - 1, 0)); }
                    else if (key === 'Enter') { e.preventDefault(); if (items[focusIndex] && !items[focusIndex].disabled) items[focusIndex].click(); }
                    else if (key === 'Escape') { e.preventDefault(); closePanel(); }
                    else if (key === 'Tab') { closePanel(); }
                    return;
                }
                // Tertutup: Enter/Space/panah membuka panel (bukan native picker).
                if (['Enter', ' ', 'ArrowDown', 'ArrowUp'].includes(key)) {
                    e.preventDefault();
                    openPanelFor(select);
                }
            });
        });

        /* Floating label — sinkron state box:
           is-empty  → teks kontrol dikosongkan saat belum memilih;
           is-required → bintang wajib mengikuti atribut required yang
                         berubah dinamis (applyRoleRules) via MutationObserver. */
        function syncFieldState(select) {
            select.classList.toggle('is-empty', select.value === '');
            const wrap = select.closest('.pln-select-wrap');
            if (wrap) wrap.classList.toggle('is-required', !!select.required);
        }

        document.getElementById('userForm')?.addEventListener('change', function () {
            // sinkron & nilai dinamis: reset sub-bidang saat bidang berubah
            selects.forEach(syncFieldState);
        });

        // Klik di luar panel & kontrol → tutup.
        document.addEventListener('mousedown', function (e) {
            if (!openPanel) return;
            if (e.target === ownerSelect || ownerSelect.contains(e.target) || openPanel.contains(e.target)) return;
            closePanel();
        }, true);

        // Scroll/resize viewport → tutup (hindari panel melayang lepas posisi).
        // Scroll yang berasal dari auto-scroll pembuka panel diabaikan.
        window.addEventListener('scroll', function () {
            if (!suppressScrollClose) closePanel();
        }, { passive: true });
        window.addEventListener('resize', closePanel);

        // SPA router re-render → pastikan tidak ada panel yatim.
        window.addEventListener('pagehide', closePanel);
    })();
</script>
