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
     * Sub-Bidang / Bagian sampel per Bidang Utama (tahap awal: Bidang Operasi).
     * Struktur: ['kode_department' => ['kode_sub' => 'Label', ...]].
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
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'role_id',
        'level_jabatan',
        'department',
        'sub_department',
        'email_verified_at',
        'no_hp',
        'alamat',
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
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    /**
     * Kode department yang sudah punya daftar sub-bidang (tahap awal: operasi).
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
