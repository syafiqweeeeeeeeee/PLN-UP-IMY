<?php

namespace App\Models;

use App\Models\Concerns\HasNameMarkerPivots;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use HasFactory, HasNameMarkerPivots, Notifiable;

    /**
     * Level Jabatan (Role Utama) — Hirarki Organisasi.
     * REVISI: HANYA 4 tingkat — opsi dropdown "Level Jabatan" pada form
     * Pengguna (khusus role Karyawan). Nilai lama ('administrator',
     * 'staf_spv') tetap dikenali via LEGACY_LEVEL_JABATAN.
     */
    public const LEVEL_JABATAN = [
        'senior_manager' => 'Senior Manager',
        'manager_bidang' => 'Manager Bidang',
        'asisten_manager' => 'Asisten Manager',
        'staf' => 'Staff',
    ];

    /**
     * Level jabatan legacy (akun lama) — tidak lagi tersedia di dropdown
     * form, tetapi label & aturan aksesnya tetap dikenali sistem.
     */
    public const LEGACY_LEVEL_JABATAN = [
        'administrator' => 'Administrator',
        'staf_spv' => 'Supervisor / Asisten Manager / Staf',
    ];

    /** Bidang Utama (Department) — Hirarki Organisasi. */
    public const DEPARTMENTS = [
        'operasi' => 'Operasi',
        'pemeliharaan' => 'Pemeliharaan',
        'engineering' => 'Engineering',
        'business_support' => 'Business Support',
        'k3_kam' => 'K3 & KAM',
        'lingkungan' => 'Lingkungan',
    ];

    /**
     * Sub-Bidang / Bagian per Bidang Utama — master data struktur unit
     * kerja UP Indramayu. Struktur: ['kode_department' => ['kode_sub' =>
     * 'Label', ...]]. Dropdown Sub-Bidang di seluruh Admin Panel (form
     * Pengguna, form & modal Link Kerja) dibangun dinamis dari konstanta
     * ini — mengikuti nilai Bidang Utama yang dipilih (dependent dropdown).
     */
    /**
     * Master Sub-Bidang / Bagian — LABEL MURNI NAMA BIDANG (tanpa prefix
     * jabatan "Asisten Manager"/"Supervisor"): dropdown form Pengguna,
     * dashboard, dan work link menampilkan nama bidang sesungguhnya, mis.
     * "Prod A", bukan "Asisten Manager Prod A". Kita kunci kode (key)
     * tidak berubah karena disimpan di kolom users.sub_department,
     * tamus.sub & work_links.sub_department.
     */
    public const SUB_DEPARTMENTS = [
        'operasi' => [
            'asmen_prod_a' => 'Prod A',
            'asmen_prod_b' => 'Prod B',
            'asmen_prod_c' => 'Prod C',
            'asmen_prod_d' => 'Prod D',
            'spv_chcb_a' => 'CHCB A',
            'spv_chcb_b' => 'CHCB B',
            'spv_chcb_c' => 'CHCB C',
            'spv_chcb_d' => 'CHCB D',
            'asmen_renops' => 'RenOps',
            'asmen_niaga_bb' => 'Niaga BB',
            'asmen_kimia_lab' => 'Kimia & Lab',
        ],
        'pemeliharaan' => [
            'asmen_rendal_har' => 'Rendal Har',
            'asmen_mo' => 'MO',
            'asmen_mesin_1' => 'Mesin 1',
            'asmen_mesin_2' => 'Mesin 2',
            'asmen_listrik' => 'Listrik',
            'asmen_konin' => 'Konin',
            'asmen_inventori' => 'Inventori Kontrol & Gudang',
        ],
        'engineering' => [
            'asmen_so' => 'SO',
            'asmen_cbm' => 'CBM',
            'asmen_mmrk' => 'MMRK',
        ],
        'business_support' => [
            'asmen_pengadaan' => 'Pengadaan',
            'asmen_sdm_umum_csr' => 'SDM Umum CSR',
            'asmen_keuangan' => 'Keuangan',
        ],
        'k3_kam' => [
            'k3_kam' => 'K3 & KAM',
            'security' => 'Security',
        ],
        'lingkungan' => [
            'lingkungan' => 'Lingkungan',
        ],
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'must_change_password',
        'role',
        'role_id',
        'level_jabatan',
        'department',
        'department_id',
        'sub_department',
        'bidang_id',
        'jabatan_id',
        'email_verified_at',
        'no_hp',
        'alamat',
        'last_seen_tamu_id',
        'notification_settings',
    ];

    /** Kunci preferensi notifikasi yang dikenal halaman Pengaturan. */
    public const NOTIFICATION_KEYS = ['desktop', 'weekly', 'pending'];

    /** Default preferensi notifikasi bila user belum pernah menyimpan. */
    public const DEFAULT_NOTIFICATION_SETTINGS = [
        'desktop' => true,
        'weekly' => true,
        'pending' => false,
    ];

    /**
     * Apakah level jabatan ini terikat Sub-Bidang — wajib memilih
     * Sub-Bidang pada form DAN akses portal terkunci di sub-bidangnya?
     * Asisten Manager & Staff terikat sub-bidang; 'staf_spv' (gabungan
     * lama "Supervisor / Asisten Manager / Staf") tetap dikenali untuk
     * akun legacy. Null (belum diisi / akun lama) → tidak.
     */
    public static function subDepartmentRequired(?string $level): bool
    {
        return in_array($level, ['asisten_manager', 'staf', 'staf_spv'], true);
    }

    /**
     * Apakah level jabatan ini berhak akses global (tanpa Bidang Utama)?
     * Senior Manager: akses lintas bidang ('administrator' = legacy).
     * Null (belum diisi / akun lama) → bukan global.
     */
    public static function isGlobalLevel(?string $level): bool
    {
        return in_array($level, ['senior_manager', 'administrator'], true);
    }

    /**
     * Turunkan Level Jabatan dari nama Master Jabatan — pengganti field
     * "Level Jabatan" yang kini tidak lagi dipilih manual di form
     * Pengguna. Aturan (urutan penting, dicek dari atas):
     *
     * - nama diawali "SENIOR MANAGER"      → senior_manager (akses global)
     * - diawali "ASMAN" / "ASISTEN"        → asisten_manager (terikat sub)
     * - mengandung "MANAGER"               → manager_bidang (membawahi bidang)
     * - selain itu (atau jabatan kosong)   → staf
     *
     * Hasil ini yang dipakai User::bypassesDataScoping() dan
     * User::dataScopingLevel(), jadi kuota Senior Manager & bypass data
     * global tetap bekerja tanpa field manual.
     */
    public static function levelJabatanFromJabatanName(?string $nama): string
    {
        $nama = strtoupper(trim((string) $nama));

        if ($nama === '') {
            return 'staf';
        }

        if (str_starts_with($nama, 'SENIOR MANAGER')) {
            return 'senior_manager';
        }

        if (str_starts_with($nama, 'ASMAN') || str_starts_with($nama, 'ASISTEN')) {
            return 'asisten_manager';
        }

        if (str_contains($nama, 'MANAGER')) {
            return 'manager_bidang';
        }

        return 'staf';
    }

    /**
     * Label Level Jabatan (legacy-safe): cek daftar aktif dulu, lalu
     * daftar legacy. Null bila nilai tidak dikenal.
     */
    public static function levelJabatanLabel(?string $level): ?string
    {
        return static::LEVEL_JABATAN[$level]
            ?? static::LEGACY_LEVEL_JABATAN[$level]
            ?? null;
    }

    /**
     * Label Sub-Bidang dari pasangan kode department & sub_department
     * (mis. "operasi", "spv_chcb_b" → "CHCB B") — murni nama bidang,
     * tanpa prefix jabatan. Statik agar
     * bisa dipakai dengan maupun tanpa instance model.
     */
    public static function subDepartmentLabel(?string $department, ?string $subDepartment): ?string
    {
        if ($department === null || $subDepartment === null) {
            return null;
        }

        return static::SUB_DEPARTMENTS[$department][$subDepartment] ?? null;
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'must_change_password' => 'boolean',
        'department_id' => 'integer',
        'bidang_id' => 'integer',
        'jabatan_id' => 'integer',
        'notification_settings' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* =========================================================
       PREFERENSI NOTIFIKASI (halaman Pengaturan)
       ========================================================= */

    /**
     * Preferensi notifikasi user (merge default + tersimpan di DB).
     *
     * @return array<string, bool>
     */
    public function notificationSettings(): array
    {
        $stored = $this->notification_settings ?? [];

        $settings = self::DEFAULT_NOTIFICATION_SETTINGS;
        foreach (self::NOTIFICATION_KEYS as $key) {
            if (array_key_exists($key, $stored)) {
                $settings[$key] = (bool) $stored[$key];
            }
        }

        return $settings;
    }

    /**
     * Simpan sebagian/all preferensi notifikasi (merge, bukan timpa).
     */
    public function updateNotificationSettings(array $settings): void
    {
        $merged = $this->notificationSettings();

        foreach (self::NOTIFICATION_KEYS as $key) {
            if (array_key_exists($key, $settings)) {
                $merged[$key] = (bool) $settings[$key];
            }
        }

        $this->update(['notification_settings' => $merged]);
    }

    /* =========================================================
       RBAC — SUPER ADMIN vs ADMIN BIDANG
       ========================================================= */

    /** Nama role yang berhak akses penuh (Sekretariat / Humas). */
    public const SUPER_ADMIN_ROLE = 'Super Admin';

    /** Nama role untuk admin yang didelegasikan ke satu bidang. */
    public const DEPARTMENT_ADMIN_ROLE = 'Admin Bidang';

    /**
     * Role yang dapat dipilih pada form Tambah Pengguna — HANYA 3 aktor:
     * Super Admin, Admin Bidang, Karyawan. Role legacy "Administrator"
     * dihapus dari opsi; akun lama tetap dikenali sebagai Super Admin
     * lewat isSuperAdmin().
     */
    public const ASSIGNABLE_ROLE_NAMES = [
        self::SUPER_ADMIN_ROLE,       // 1) Super Admin
        self::DEPARTMENT_ADMIN_ROLE,  // 2) Admin Bidang
        'Karyawan',                   // 3) Karyawan
    ];

    /**
     * Nama role legacy yang TIDAK boleh dipilih/diberikan lagi pada form
     * Pengguna (akun lama tetap dikenali, tapi tidak bisa dibuat baru
     * atau dipindahkan ke role ini).
     */
    public const LEGACY_ROLE_NAMES = ['Administrator'];

    /**
     * Batas maksimal akun dengan Role "Super Admin" di dalam database.
     * Pendaftaran akun Super Admin baru ditolak bila kuota penuh.
     */
    public const MAX_SUPER_ADMIN_ACCOUNTS = 3;

    /**
     * Batas maksimal akun KARYAWAN ber-Level Jabatan "Senior Manager"
     * (status AKTIF / terverifikasi) di dalam database. Pendaftaran akun
     * Senior Manager baru ditolak bila kuota penuh.
     */
    public const MAX_SENIOR_MANAGER_ACCOUNTS = 3;

    /**
     * Baseline permission bawaan role Karyawan — HANYA daftar ini yang
     * dianggap "wajar" dimiliki semua karyawan (satu sumber kebenaran
     * dipakai PermissionSeeder untuk memberi permission ke role Karyawan).
     *
     * Permission di LUAR daftar ini disebut "permission ekstra" dan
     * menjadi syarat akun Karyawan murni boleh masuk area /admin
     * (lihat EnsureNotKaryawan & hasExtraKaryawanPermission()).
     * Di dalam /admin, tiap route & menu tetap dijaga permission
     * masing-masing seperti biasa.
     */
    public const KARYAWAN_BASELINE_PERMISSIONS = [
        'dashboard.view',
        'news.view',
        'pages.view',
    ];

    /**
     * Apakah akun ini Super Admin (Sekretariat / Humas)?
     * Super Admin = nama role persis 'Super Admin' ATAU role legacy
     * 'Administrator' (kompatibilitas akun existing).
     */
    public function isSuperAdmin(): bool
    {
        if (! $this->exists) {
            return false;
        }

        return $this->roleNames()->contains(fn ($n) => in_array($n, [self::SUPER_ADMIN_ROLE, 'Administrator'], true));
    }

    /**
     * Apakah akun ini Admin Bidang (akses dibatasi satu bidang)?
     */
    public function isDepartmentAdmin(): bool
    {
        if (! $this->exists) {
            return false;
        }

        return $this->roleNames()->contains(self::DEPARTMENT_ADMIN_ROLE);
    }

    /**
     * Jumlah akun yang terikat Role "Super Admin" di database (melalui
     * kolom role_id maupun pivot role_user). Alias legacy "Administrator"
     * ikut dihitung karena isSuperAdmin() memperlakukannya setara
     * Super Admin — kuota menjaga jumlah akun ber-akses-penuh tetap ≤ 3.
     */
    public static function superAdminAccountCount(): int
    {
        $roleIds = Role::query()
            ->whereIn('name', [self::SUPER_ADMIN_ROLE, 'Administrator'])
            ->pluck('id');

        if ($roleIds->isEmpty()) {
            return 0;
        }

        return static::query()
            ->where(function ($query) use ($roleIds) {
                $query->whereIn('role_id', $roleIds)
                    ->orWhereHas('roles', fn ($q) => $q->whereIn('roles.id', $roleIds));
            })
            ->count();
    }

    /**
     * Jumlah akun KARYAWAN ber-Level Jabatan "Senior Manager" dengan
     * status AKTIF (email terverifikasi) di database. Akun nonaktif tidak
     * dihitung sehingga slot kuota bebas saat akun dinonaktifkan.
     */
    public static function seniorManagerAccountCount(): int
    {
        return static::query()
            ->where('level_jabatan', 'senior_manager')
            ->whereNotNull('email_verified_at')
            ->count();
    }

    /**
     * Kode bidang tempat admin bidang ini terikat. Prioritas:
     * department_id (FK tabel departments) → fallback kolom string
     * `department` (data legacy).
     */
    public function boundDepartment(): ?string
    {
        if ($this->department_id) {
            return Department::byCodeCacheById($this->department_id)?->code
                ?? $this->department;
        }

        return $this->department;
    }

    /**
     * Apakah akun terikat pada bidang tertentu (admin bidang atau
     * karyawan yang mengisi hirarki)?
     */
    public function isBoundToDepartment(): bool
    {
        return $this->boundDepartment() !== null;
    }

    /* =========================================================
       DATA SCOPING — PENGIKATAN bidang_id & sub_bidang_id
       ------------------------------------------------------------
       REVISI ARSITEKTUR: isolasi data bidang TIDAK dibuat lewat
       banyak role terpisah, melainkan diikat pada atribut milik
       tabel users saat akun dibuat:

         bidang_id      → kolom department_id (FK tabel departments)
         sub_bidang_id  → kolom sub_department (kode string sub-bidang)

       Nama domain-spec dipetakan ke kolom fisik via helper di bawah
       supaya lapisan scoping (Global Scope & guard controller) bisa
       membacanya dengan istilah spesifikasi tanpa rename kolom.
       ========================================================= */

    /** ID bidang tempat akun terikat (spec: bidang_id). Null = tidak terikat. */
    public function bidangId(): ?int
    {
        return $this->department_id;
    }

    /** Kode bidang tempat akun terikat (mis. 'operasi', 'business_support'). */
    public function bidangCode(): ?string
    {
        return $this->boundDepartment();
    }

    /** Kode sub-bidang tempat akun terikat (spec: sub_bidang_id). Null = tidak terikat. */
    public function subBidangId(): ?string
    {
        return $this->sub_department;
    }

    /**
     * Apakah akun ini bypass (tidak terkena) filter data scoping?
     * Sesuai spec: Super Admin dan Level Jabatan "Senior Manager"
     * (termasuk legacy 'administrator') melihat SELURUH data dari
     * semua bidang/sub-bidang.
     */
    public function bypassesDataScoping(): bool
    {
        if (! $this->exists) {
            return false;
        }

        return $this->isSuperAdmin() || static::isGlobalLevel($this->level_jabatan);
    }

    /**
     * Tingkat penerapan data scoping untuk akun ini:
     *
     * - 'bypass'      → Super Admin / Senior Manager: lihat semua.
     * - 'bidang_sub'  → akun terikat unit kerja (bidang + sub-bidang):
     *                   Admin Bidang (sub wajib) & Karyawan Asisten
     *                   Manager/Staff — filter bidang AND sub-bidang.
     * - 'bidang'      → akun hanya terikat bidang (legacy Admin Bidang
     *                   tanpa sub, atau Karyawan Manager Bidang yang
     *                   membawahi seluruh sub-bidangnya).
     */
    public function dataScopingLevel(): string
    {
        if ($this->bypassesDataScoping()) {
            return 'bypass';
        }

        return $this->sub_department !== null ? 'bidang_sub' : 'bidang';
    }

    public function departmentRef(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /* =========================================================
       MASTER BIDANG & JABATAN (tabel bidangs & jabatans)
       ------------------------------------------------------------
       Data organisasi murni (unit kerja & posisi pekerjaan akun),
       TERPISAH dari kolom RBAC lama (department/sub_department →
       tabel departments untuk scoping data) dan dari role_id
       (hak akses sistem). Jabatan BUKAN role: role tetap satu-satunya
       penentu hak akses, jabatan hanya menunjukkan posisi kerja.
       ========================================================= */

    /** Bidang master tempat akun ini berada (opsional). */
    public function bidangRef(): BelongsTo
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    /** Jabatan master (posisi pekerjaan) milik akun ini (opsional). */
    public function jabatanRef(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    /**
     * Kode department yang memiliki daftar sub-bidang (saat ini: keenam bidang).
     */
    public static function departmentsWithSubs(): array
    {
        return array_keys(static::SUB_DEPARTMENTS);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Data kepegawaian milik akun ini (tabel employee_profiles, 1:1).
     * Menyatu dengan master karyawans via soft-link karyawan_id —
     * diisi/mutakhirkan lewat tombol "Edit Detail / Lengkapi Data"
     * pada halaman Detail Pengguna.
     */
    public function employeeProfile(): HasOne
    {
        return $this->hasOne(EmployeeProfile::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user')->withTimestamps()
            ->withNameMarkers(parent: ['user_name' => 'name'], related: ['role_name' => 'name']);
    }

    /* =========================================================
       DIRECT PERMISSION — hak akses langsung per akun (tabel
       user_has_permissions). Pembagian hak akses menu yang
       berbeda-beda TIDAK dibuat via role baru, melainkan diatur
       langsung per akun di form Pengguna (matriks ID Menu × CRUD).
       Efektif = permission role (baseline) ∪ direct permission.
       ========================================================= */

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'user_has_permissions')->withTimestamps()
            ->withNameMarkers(parent: ['user_name' => 'name'], related: ['permission_name' => 'name']);
    }

    /**
     * Apakah akun punya DIRECT permission dengan nama ini (dari pivot
     * user_has_permissions, tanpa memperhitungkan role)?
     */
    public function hasDirectPermission(string $permission): bool
    {
        if (! $this->exists) {
            return false;
        }

        // Memoized snapshot (lihat permissionState()) — dulu setiap panggilan
        // menjalankan query `exists()` baru.
        return in_array($permission, $this->permissionState()['direct'], true);
    }

    /**
     * ID permission direct milik akun — untuk pre-check matriks pada
     * form Edit Pengguna.
     *
     * @return array<int, int>
     */
    public function directPermissionIds(): array
    {
        if (! $this->exists) {
            return [];
        }

        return $this->permissions()->pluck('permissions.id')->all();
    }

    /**
     * Sinkronisasi direct permission akun (spec: syncPermissions ke
     * tabel user_has_permissions).
     *
     * @param  array<int, int|string>  $permissionIds
     */
    public function syncPermissions(array $permissionIds): void
    {
        $this->permissions()->sync(array_map('intval', $permissionIds));

        // Snapshot RBAC akun ini tidak valid setelah pivot diubah.
        static::flushPermissionStateCache($this->id);
    }

    /**
     * Nama-nama direct permission akun (dinamis untuk UI).
     *
     * @return Collection<int, string>
     */
    public function directPermissionNames(): Collection
    {
        if (! $this->exists) {
            return collect();
        }

        return $this->permissions()->pluck('permissions.name');
    }

    /**
     * Nama-nama seluruh role aktif milik user ini (pivot role_user
     * + kolom fallback role_id), sudah unik & tanpa nilai kosong.
     *
     * MEMOISASI PER-REQUEST — pivot roles + kolom role_id dibaca SEKALI
     * per akun per request, lalu dipakai ulang oleh middleware role/access
     * (isDepartmentAdmin/isKaryawan/isSuperAdmin) yang memanggil ini berulang
     * kali tiap request.
     *
     * @return Collection<int, string>
     */
    public function roleNames(): Collection
    {
        if (! $this->exists) {
            return collect();
        }

        $key = (string) $this->getKey();

        if (isset(static::$rbacSnapshotCache[$key]['roleNames']) && static::$rbacSnapshotCache[$key]['roleNames'] !== null) {
            return static::$rbacSnapshotCache[$key]['roleNames'];
        }

        $names = $this->relationLoaded('roles')
            ? $this->roles->pluck('name')
            : $this->roles()->pluck('roles.name');

        if ($this->role_id) {
            $role = $this->relationLoaded('role') ? $this->role : $this->role()->first();

            if ($role !== null && ! $role->isInactive()) {
                $names->push($role->name);
            }
        }

        $names = $names->filter()->unique()->values();

        static::$rbacSnapshotCache[$key]['roleNames'] = $names;

        return $names;
    }

    /** Cache snapshot RBAC per-request — key id akun, di-reset tiap request (FPM). */
    protected static array $rbacSnapshotCache = [];

    /**
     * Snapshot RBAC akun — DIRECT permission (pivot user_has_permissions)
     * + permission seluruh role aktif (pivot role_permission) dibaca
     * SEKALI per akun per request, lalu dipakai ulang oleh seluruh
     * pengecekan hak akses (middleware permission:, Gate @can, cek menu
     * & tombol). Sebelum optimasi: setiap cek menjalankan query baru → puluhan
     * query DB per render halaman.
     *
     * @return array{direct: array<int,string>, rolePerms: array<int,string>, rolesEmpty: bool}
     */
    private function permissionState(): array
    {
        $key = (string) $this->getKey();

        if (isset(static::$rbacSnapshotCache[$key]['permissions'])) {
            return static::$rbacSnapshotCache[$key]['permissions'];
        }

        // 1) DIRECT PERMISSION — satu query untuk seluruh cek direct.
        $direct = $this->permissions()->pluck('permissions.name')->values()->all();

        // 2) ROLE — relasi roles + permissions dimuat SEKALI: sebelumnya
        //    setiap hasPermission() memanggil roles()->with('permissions')
        //    baru, dan setiap Role::hasPermission() menjalankan exists().
        $roles = $this->relationLoaded('roles') && ! $this->roles->contains(fn ($role) => ! $role->relationLoaded('permissions'))
            ? $this->roles
            : $this->roles()->with('permissions')->get();

        $rolePerms = [];

        foreach ($roles as $role) {
            if ($role->isInactive()) {
                continue;
            }

            foreach ($role->permissions as $permission) {
                $rolePerms[$permission->name] = true;
            }
        }

        $state = [
            'direct'     => $direct,
            'rolePerms'  => array_keys($rolePerms),
            'rolesEmpty' => $roles->isEmpty(),
        ];

        static::$rbacSnapshotCache[$key]['permissions'] = $state;

        return $state;
    }

    /**
     * Bersihkan cache snapshot RBAC — dipanggil setiap kali pivot
     * permission/role akun berubah dalam request yang sama agar semantik
     * real-time RBAC tetap berlaku (disingkat menyertai
     * flushPermissionGateCache() di AuthServiceProvider).
     */
    public static function flushPermissionStateCache(?int $userId = null): void
    {
        if ($userId !== null) {
            unset(static::$rbacSnapshotCache[(string) $userId]);

            return;
        }

        static::$rbacSnapshotCache = [];
    }

    /**
     * Apakah akun ini Karyawan murni (ber-role "Karyawan" tanpa role
     * admin lain)? Dipakai middleware admin.access & redirect login.
     */
    public function isKaryawan(): bool
    {
        if (! $this->exists) {
            return false;
        }

        $names = $this->roleNames();

        if ($names->isNotEmpty()) {
            return $names->contains('Karyawan') && $names->reject(fn ($n) => $n === 'Karyawan')->isEmpty();
        }

        // Fallback akun lama tanpa pivot: kolom users.role
        return ($this->role ?? '') === 'Karyawan';
    }

    /**
     * Apakah akun ini akun admin / pengelola (role apa pun selain
     * Karyawan)? Akun tanpa role sama sekali dianggap bukan admin.
     */
    public function isAdmin(): bool
    {
        if (! $this->exists) {
            return false;
        }

        $names = $this->roleNames();

        if ($names->isNotEmpty()) {
            return $names->contains(fn ($n) => $n !== 'Karyawan');
        }

        $legacy = (string) ($this->role ?? '');

        return $legacy !== '' && $legacy !== 'user' && $legacy !== 'Karyawan';
    }

    /**
     * Daftar permission EKSTRA milik akun ini — seluruh permission
     * (direct ∪ role aktif ∪ fallback role_id) MINUS baseline karyawan
     * (KARYAWAN_BASELINE_PERMISSIONS).
     *
     * Dipakai middleware admin.access: karyawan murni hanya boleh masuk
     * /admin bila daftar ini tidak kosong (dia DIBERI akses tambahan,
     * mis. users.view lewat Edit Role). Karyawan biasa tetap tertutup.
     *
     * @return array<int, string>
     */
    public function extraKaryawanPermissions(): array
    {
        if (! $this->exists) {
            return [];
        }

        // loadMissing agar aman dipanggil berulang dalam satu request
        // (nav portal + middleware) tanpa query ganda. Catatan: relasi
        // `role` TIDAK di-nested-load di sini — kolom legacy users.role
        // (string) menaungi relasi tersebut sehingga pluck('role')
        // mengembalikan string, bukan model.
        $this->loadMissing(['permissions', 'roles.permissions']);

        $names = $this->permissions->pluck('name')->all();

        foreach ($this->roles as $role) {
            if ($role->isInactive()) {
                continue;
            }

            $names = array_merge($names, $role->permissions->pluck('name')->all());
        }

        // Fallback akun lama: kolom users.role_id tanpa pivot role_user.
        // Akses via method role() (bukan atribut $this->role — itu string).
        if ($this->roles->isEmpty() && $this->role_id) {
            $role = $this->role()->first();

            if ($role !== null && ! $role->isInactive()) {
                $names = array_merge($names, $role->permissions()->pluck('name')->all());
            }
        }

        return array_values(array_diff(array_unique($names), self::KARYAWAN_BASELINE_PERMISSIONS));
    }

    /**
     * Apakah akun Karyawan murni ini punya permission ekstra (di luar
     * baseline) sehingga BOLEH masuk area /admin?
     */
    public function hasExtraKaryawanPermission(): bool
    {
        return $this->extraKaryawanPermissions() !== [];
    }

    /**
     * Cek permission EFEKTIF: Direct Permission sebagai WHITE-LIST OVERRIDE.
     *
     * Logika:
     * 1. Jika user memiliki DIRECT permission untuk permission ini → ALLOW
     *    (user secara eksplisit mengikutsertakan permission ini)
     * 2. Jika user memiliki SAMA SALAH SATU direct permission untuk modul
     *    yang sama (mis. punya news.view tetapi tidak news.edit) → artinya
     *    user pernah mengelola matriks ini, dan permission yang TIDAK
     *    dicentang dianggap TIDAK DIINGINKAN → BLOCK (override role)
     * 3. Jika user TIDAK PUNYA direct permission sama sekali untuk modul
     *    ini → gunakan role permission sebagai fallback (perilaku legacy)
     *
     * Contoh:
     * - Admin Bidang SO punya role permission [news.view, news.edit, news.delete]
     * - Di Direct Permission hanya dicentang [news.view, news.delete]
     *   (news.edit dicabut)
     * - HasPermission('news.edit'):
     *   1) hasDirectPermission('news.edit') → false
     *   2) punya direct permission lain untuk modul 'news'? YA (news.view, news.delete)
     *   3) → BLOCK (karena news.edit tidak ada di direct permission)
     *
     * - Admin Bidang yang BELUM PERNAH masuk menu Pengguna:
     * - Tidak punya direct permission apa pun
     * - HasPermission('news.edit'):
     *   1) hasDirectPermission('news.edit') → false
     *   2) punya direct permission lain untuk modul 'news'? TIDAK
     *   3) → fallback ke role → ALLOW (role punya news.edit)
     *
     * Dipakai Gate (@can), middleware permission:, dan seluruh cek
     * menu/tombol — perubahan matriks direct permission pada form
     * Pengguna berlaku REAL-TIME tanpa deploy.
     */
    public function hasPermission(string $permission): bool
    {
        if (! $this->exists) {
            return false;
        }

        // Snapshot RBAC per-request: direct permission + permission role aktif
        // dibaca SEKALI per akun per request (lihat permissionState) — dulu
        // setiap cek memicu query baru (middleware permission:, Gate @can,
        // cek sidebar/menu → puluhan query per render halaman).
        $name  = Permission::resolveAlias($permission);
        $state = $this->permissionState();

        // 0) ALIAS AKSI EKSTRA (news.publish, tamu.checkout, ...) — menyatu
        //    dengan hak akses induknya (Permission::ACTION_ALIASES). Baris
        //    permission legacy yang masih tersimpan juga tetap dihormati.
        if ($name !== $permission
            && (in_array($permission, $state['direct'], true)
                || in_array($permission, $state['rolePerms'], true))) {
            return true;
        }

        // 1) DIRECT PERMISSION — hak ekstra per akun (form Pengguna),
        //    SEMANTIK SPATIE: direct permission HANYA MENAMBAH (union).
        if (in_array($name, $state['direct'], true)) {
            return true;
        }

        // 2) BASELINE ROLE — permission role aktif, dibaca dinamis dari
        //    pivot role_permission (snapshot per-request).
        if (in_array($name, $state['rolePerms'], true)) {
            return true;
        }

        // Fallback kompatibilitas: akun lama yang dibuat lewat UI hanya punya
        // kolom users.role_id tanpa baris pivot role_user.
        if ($state['rolesEmpty'] && $this->role_id) {
            $role = $this->relationLoaded('role') ? $this->role : $this->role()->first();

            return $role !== null
                && ! $role->isInactive()
                && $role->hasPermission($name);
        }

        return false;
    }
}
