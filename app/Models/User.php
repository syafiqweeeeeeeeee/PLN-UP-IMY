<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Level Jabatan (Role Utama) — Hirarki Organisasi.
     * REVISI: HANYA 4 tingkat — opsi dropdown "Level Jabatan" pada form
     * Pengguna (khusus role Karyawan). Nilai lama ('administrator',
     * 'staf_spv') tetap dikenali via LEGACY_LEVEL_JABATAN.
     */
    public const LEVEL_JABATAN = [
        'senior_manager'  => 'Senior Manager',
        'manager_bidang'  => 'Manager Bidang',
        'asisten_manager' => 'Asisten Manager',
        'staf'            => 'Staff',
    ];

    /**
     * Level jabatan legacy (akun lama) — tidak lagi tersedia di dropdown
     * form, tetapi label & aturan aksesnya tetap dikenali sistem.
     */
    public const LEGACY_LEVEL_JABATAN = [
        'administrator' => 'Administrator',
        'staf_spv'      => 'Supervisor / Asisten Manager / Staf',
    ];

    /** Bidang Utama (Department) — Hirarki Organisasi. */
    public const DEPARTMENTS = [
        'operasi'          => 'Operasi',
        'pemeliharaan'     => 'Pemeliharaan',
        'engineering'      => 'Engineering',
        'business_support' => 'Business Support',
        'k3_kam'           => 'K3 & KAM',
        'lingkungan'       => 'Lingkungan',
    ];

    /**
     * Sub-Bidang / Bagian per Bidang Utama — master data struktur unit
     * kerja UP Indramayu. Struktur: ['kode_department' => ['kode_sub' =>
     * 'Label', ...]]. Dropdown Sub-Bidang di seluruh Admin Panel (form
     * Pengguna, form & modal Link Kerja) dibangun dinamis dari konstanta
     * ini — mengikuti nilai Bidang Utama yang dipilih (dependent dropdown).
     */
    public const SUB_DEPARTMENTS = [
        'operasi' => [
            'asmen_prod_a'    => 'Asisten Manager Prod A',
            'asmen_prod_b'    => 'Asisten Manager Prod B',
            'asmen_prod_c'    => 'Asisten Manager Prod C',
            'asmen_prod_d'    => 'Asisten Manager Prod D',
            'spv_chcb_a'      => 'Supervisor CHCB A',
            'spv_chcb_b'      => 'Supervisor CHCB B',
            'spv_chcb_c'      => 'Supervisor CHCB C',
            'spv_chcb_d'      => 'Supervisor CHCB D',
            'asmen_renops'    => 'Asisten Manager RenOps',
            'asmen_niaga_bb'  => 'Asisten Manager Niaga BB',
            'asmen_kimia_lab' => 'Asisten Manager Kimia & Lab',
        ],
        'pemeliharaan' => [
            'asmen_rendal_har' => 'Asisten Manager Rendal Har',
            'asmen_mo'         => 'Asisten Manager MO',
            'asmen_mesin_1'    => 'Asisten Manager Mesin 1',
            'asmen_mesin_2'    => 'Asisten Manager Mesin 2',
            'asmen_listrik'    => 'Asisten Manager Listrik',
            'asmen_konin'      => 'Asisten Manager Konin',
            'asmen_inventori'  => 'Asisten Manager Inventori Kontrol & Gudang',
        ],
        'engineering' => [
            'asmen_so'   => 'Asisten Manager SO',
            'asmen_cbm'  => 'Asisten Manager CBM',
            'asmen_mmrk' => 'Asisten Manager MMRK',
        ],
        'business_support' => [
            'asmen_pengadaan' => 'Asisten Manager Pengadaan',
            'asmen_sdm_umum_csr' => 'Asisten Manager SDM Umum CSR',
            'asmen_keuangan'  => 'Asisten Manager Keuangan',
        ],
        'k3_kam' => [
            'k3_kam' => 'K3 & KAM',
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
        'weekly'  => true,
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
     * (mis. "operasi", "spv_chcb_b" → "Supervisor CHCB B"). Statis agar
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
        'password'          => 'hashed',
        'must_change_password' => 'boolean',
        'department_id'     => 'integer',
        'notification_settings' => 'array',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
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
     *
     * @return string
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

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user')->withTimestamps();
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
        return $this->belongsToMany(Permission::class, 'user_has_permissions')->withTimestamps();
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

        return $this->permissions()->where('permissions.name', $permission)->exists();
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
    }

    /**
     * Nama-nama direct permission akun (dinamis untuk UI).
     *
     * @return \Illuminate\Support\Collection<int, string>
     */
    public function directPermissionNames(): \Illuminate\Support\Collection
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
     * @return Collection<int, string>
     */
    public function roleNames(): Collection
    {
        $names = $this->relationLoaded('roles')
            ? $this->roles->pluck('name')
            : $this->roles()->pluck('roles.name');

        if ($this->role_id) {
            $role = $this->relationLoaded('role') ? $this->role : $this->role()->first();

            if ($role !== null && ! $role->isInactive()) {
                $names->push($role->name);
            }
        }

        return $names->filter()->unique()->values();
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

        // 1) DIRECT PERMISSION — diatur per akun via form Pengguna.
        //    Jika user secara eksplisit mengikutsertakan permission ini → ALLOW.
        if ($this->hasDirectPermission($permission)) {
            return true;
        }

        // 2) Cek apakah user memiliki direct permission untuk MODUL yang sama.
        //    Jika YA → berarti user pernah mengelola matriks hak akses untuk
        //    modul ini, dan permission yang tidak dicentang dianggap TIDAK
        //    DIINGINKAN → BLOCK (override role permission).
        $module = $this->permissionModule($permission);
        if ($module !== null && $this->hasAnyDirectPermissionForModule($module)) {
            // User pernah mengelola matriks modul ini, tapi permission ini
            // tidak ada di direct permission → BLOCK.
            return false;
        }

        // 3) FALLBACK ROLE — permission yang melekat pada role aktif.
        //    Hanya digunakan jika user TIDAK PUNYA direct permission untuk
        //    modul ini (belum pernah mengedit matriks hak akses).
        $roles = $this->relationLoaded('roles')
            ? $this->roles
            : $this->roles()->with('permissions')->get();

        foreach ($roles as $role) {
            if ($role->isInactive()) {
                continue;
            }

            if ($role->hasPermission($permission)) {
                return true;
            }
        }

        // Fallback kompatibilitas: akun lama yang dibuat lewat UI hanya punya
        // kolom users.role_id tanpa baris pivot role_user.
        if ($roles->isEmpty() && $this->role_id) {
            $role = $this->relationLoaded('role') ? $this->role : $this->role()->first();

            return $role !== null
                && ! $role->isInactive()
                && $role->hasPermission($permission);
        }

        return false;
    }

    /**
     * Ekstrak nama modul dari permission string.
     * Contoh: 'news.edit' → 'news', 'activity_logs.delete' → 'activity_logs'.
     * Permission yang tidak mengandung titik (mis. permission kustom) → null.
     */
    private function permissionModule(string $permission): ?string
    {
        $parts = explode('.', $permission);
        return count($parts) > 1 ? $parts[0] : null;
    }

    /**
     * Apakah user memiliki SAMA SALAH SATU direct permission untuk modul tertentu?
     * Dipakai untuk menentukan apakah user pernah mengelola matriks hak akses
     * untuk modul ini (sehingga permission yang tidak dicentang berarti ditolak).
     */
    private function hasAnyDirectPermissionForModule(string $module): bool
    {
        if (! $this->exists) {
            return false;
        }

        return $this->permissions()
            ->where('permissions.name', 'like', $module . '.%')
            ->exists();
    }
}
