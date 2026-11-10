<?php

namespace App\Models;

use App\Models\Concerns\HasNameMarkerPivots;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory, HasNameMarkerPivots;

    /** Pilihan dashboard setelah login — panel admin. */
    public const DASHBOARD_ADMIN = 'admin';

    /** Pilihan dashboard setelah login — Portal Karyawan. */
    public const DASHBOARD_KARYAWAN = 'karyawan';

    /** Label pilihan dashboard pada form Tambah/Edit Role. */
    public const DASHBOARDS = [
        self::DASHBOARD_ADMIN    => 'Dashboard Admin',
        self::DASHBOARD_KARYAWAN => 'Dashboard Karyawan',
    ];

    protected $fillable = [
        'name',
        'description',
        'status',
        'dashboard',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permission')->withTimestamps()
            ->withNameMarkers(parent: ['role_name' => 'name'], related: ['permission_name' => 'name']);
    }

    public function getPermissionIdsAttribute(): array
    {
        return $this->permissions()->pluck('permissions.id')->toArray();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user')->withTimestamps()
            ->withNameMarkers(parent: ['role_name' => 'name'], related: ['user_name' => 'name']);
    }

    public function isInactive(): bool
    {
        return ! $this->status;
    }

    /**
     * Dashboard setelah login untuk role ini.
     *
     * Nilai kolom `dashboard` diutamakan; bila kosong (role lama / dibuat
     * sebelum kolom ada) → role "Karyawan" memakai portal, lainnya admin.
     */
    public function dashboardType(): string
    {
        $value = $this->dashboard;

        if (array_key_exists((string) $value, self::DASHBOARDS)) {
            return $value;
        }

        return $this->name === 'Karyawan'
            ? self::DASHBOARD_KARYAWAN
            : self::DASHBOARD_ADMIN;
    }

    /** Apakah role ini mengarah ke Portal Karyawan setelah login? */
    public function usesKaryawanDashboard(): bool
    {
        return $this->dashboardType() === self::DASHBOARD_KARYAWAN;
    }

    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->where('name', $permission)->exists();
    }
}
