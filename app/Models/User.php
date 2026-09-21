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

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'role_id',
        'no_hp',
        'alamat',
    ];

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
