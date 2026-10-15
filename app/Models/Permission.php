<?php

namespace App\Models;

use App\Models\Concerns\HasNameMarkerPivots;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory, HasNameMarkerPivots;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'display_name',
        'module',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permission')
            ->withTimestamps()
            ->withNameMarkers(parent: ['permission_name' => 'name'], related: ['role_name' => 'name']);
    }

    /**
     * Aksi non-CRUD yang aktif dipakai kode, dipetakan ke hak akses
     * matriks induknya di tabel permissions (total baris = 39 per ID
     * Menu). Contoh "publish/unpublish berita" menyatu dengan aksi edit
     * menu Berita — punya news.edit = bisa publish.
     *
     * Mapping ini dibaca lewat resolveAlias() oleh User::hasPermission,
     * sehingga @can('news.publish'), middleware permission:tamu.checkout,
     * dst. tetap berjalan normal (tanpa 403) meski barisnya tak lagi
     * terdaftar terpisah di tabel permissions.
     */
    public const ACTION_ALIASES = [
        'news.publish' => 'news.edit',
        'announcements.publish' => 'announcements.edit',
        'tamu.checkout' => 'tamu.edit',
        'user.reset-password' => 'users.edit',
        'roles.assign_permission' => 'roles.edit',
    ];

    /**
     * Resolusikan nama permission alias ke permission matriks induknya.
     * Nama yang sudah merupakan permission matriks (mis. 'news.edit')
     * dikembalikan tanpa perubahan.
     */
    public static function resolveAlias(string $name): string
    {
        return self::ACTION_ALIASES[$name] ?? $name;
    }
}
