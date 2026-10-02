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

    /** Level Jabatan (Role Utama) — Hirarki Organisasi. */
    public const LEVEL_JABATAN = [
        'administrator' => 'Administrator',
        'senior_manager' => 'Senior Manager',
        'manager_bidang' => 'Manager Bidang',
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
     * Apakah level jabatan ini mewajibkan pemilihan Sub-Bidang?
     * Staf / Asisten Manager / Supervisor wajib menentukan bagian spesifiknya.
     * Null (belum diisi / akun lama) → tidak wajib.
     */
    public static function subDepartmentRequired(?string $level): bool
    {
        return $level === 'staf_spv';
    }

    /**
     * Apakah level jabatan ini berhak akses global (tanpa Bidang Utama)?
     * Senior Manager & Administrator: akses lintas bidang.
     * Null (belum diisi / akun lama) → bukan global.
     */
    public static function isGlobalLevel(?string $level): bool
    {
        return in_array($level, ['senior_manager', 'administrator'], true);
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

    public function hasPermission(string $permission): bool
    {
        if (! $this->exists) {
            return false;
        }

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
        // kolom users.role_id tanpa baris pivot role_user. Tanpa fallback ini,
        // menu seperti Log Aktivitas & Role tidak muncul untuk akun tersebut.
        if ($roles->isEmpty() && $this->role_id) {
            $role = $this->relationLoaded('role') ? $this->role : $this->role()->first();

            return $role !== null
                && ! $role->isInactive()
                && $role->hasPermission($permission);
        }

        return false;
    }
}
