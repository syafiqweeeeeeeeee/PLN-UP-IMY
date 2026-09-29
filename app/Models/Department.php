<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Department — katalog Bidang Utama (Operasi, Pemeliharaan, ...).
 *
 * Kode mengikuti konstanta User::DEPARTMENTS agar konsisten dengan
 * work_links.department & users.department (kode string legacy).
 */
class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function workLinks(): HasMany
    {
        return $this->hasMany(WorkLink::class, 'department', 'code');
    }

    /**
     * Cari baris department berdasar kode ('operasi', ...). Hasil
     * di-cache per-request lewat static property.
     */
    public static function byCode(?string $code): ?self
    {
        if ($code === null || $code === '') {
            return null;
        }

        static $cache = [];

        if (! array_key_exists($code, $cache)) {
            $cache[$code] = static::where('code', $code)->first();
        }

        return $cache[$code];
    }

    /**
     * Cari baris department berdasar ID (untuk User::boundDepartment
     * yang membaca department_id). Cache static per-request.
     */
    public static function byCodeCacheById(int $id): ?self
    {
        static $cache = [];

        if (! array_key_exists($id, $cache)) {
            $cache[$id] = static::find($id);
        }

        return $cache[$id];
    }
}
