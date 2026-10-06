<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * MasterMenu — master ID Menu Sidebar Admin Panel (tabel master_menus).
 *
 * Sumber tunggal struktur menu untuk matriks hak akses granular pada
 * Halaman Kelola Role (Tambah/Edit Role). ID 1–11 FIXED sesuai spec
 * RBAC; setiap ID Menu dipecah menjadi 4 hak akses granular CRUD pada
 * tabel permissions: [permission_key].view / .create / .edit / .delete.
 */
class MasterMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'route',
        'icon',
        'permission_key',
        'sort_order',
    ];

    /** 4 hak akses granular per menu — urutan kolom matriks UI. */
    public const CRUD_ACTIONS = [
        'view'   => 'Buka Menu (View)',
        'create' => 'Tambah (Create)',
        'edit'   => 'Edit (Update)',
        'delete' => 'Hapus (Delete)',
    ];

    /**
     * Master 11 ID Menu Sidebar (id FIXED sesuai spec):
     * [id, name, route, icon, permission_key].
     */
    public const MENUS = [
        ['id' => 1,  'name' => 'Dashboard',       'route' => 'admin.dashboard',           'icon' => 'fa-th-large',       'permission_key' => 'dashboard'],
        ['id' => 2,  'name' => 'Berita',          'route' => 'admin.news.index',          'icon' => 'fa-newspaper',      'permission_key' => 'news'],
        ['id' => 3,  'name' => 'Data Tamu',       'route' => 'admin.tamu.index',          'icon' => 'fa-id-card',        'permission_key' => 'tamu'],
        ['id' => 4,  'name' => 'Pengumuman',      'route' => 'admin.announcements.index', 'icon' => 'fa-bullhorn',       'permission_key' => 'announcements'],
        ['id' => 5,  'name' => 'Halaman',         'route' => 'admin.pages.index',         'icon' => 'fa-file-lines',     'permission_key' => 'pages'],
        ['id' => 6,  'name' => 'Menu',            'route' => 'admin.menus.index',         'icon' => 'fa-bars',           'permission_key' => 'menus'],
        ['id' => 7,  'name' => 'Pengguna',        'route' => 'admin.users.index',         'icon' => 'fa-users',          'permission_key' => 'users'],
        ['id' => 8,  'name' => 'Galeri',          'route' => 'admin.galeri.index',        'icon' => 'fa-images',         'permission_key' => 'galleries'],
        ['id' => 9,  'name' => 'Link Kerja',      'route' => 'admin.work-links.index',    'icon' => 'fa-link',           'permission_key' => 'work_links'],
        ['id' => 10, 'name' => 'Log Aktivitas',   'route' => 'admin.activity-logs.index', 'icon' => 'fa-clipboard-list', 'permission_key' => 'activity_logs'],
        ['id' => 11, 'name' => 'Role / Hak Akses','route' => 'admin.roles.index',         'icon' => 'fa-user-tag',       'permission_key' => 'roles'],
    ];

    /* =========================================================
       HELPER PERMISSION MATRIX
       ========================================================= */

    /**
     * Nama 4 permission CRUD untuk satu menu: [key.view, key.create,
     * key.edit, key.delete]. Dashboard (ID 1) hanya punya .view di tabel
     * permissions — pemakaian tetap melalui intersect dengan permissions
     * yang benar-benar terdaftar.
     *
     * @return array<int, string>
     */
    public static function permissionNamesFor(string $permissionKey): array
    {
        return array_map(
            fn (string $action) => "{$permissionKey}.{$action}",
            array_keys(self::CRUD_ACTIONS)
        );
    }

    /**
     * Seluruh nama permission yang termasuk matriks (maks 4 × 11).
     *
     * @return array<int, string>
     */
    public static function matrixPermissionNames(): array
    {
        $names = [];

        foreach (self::MENUS as $menu) {
            $names = array_merge($names, self::permissionNamesFor($menu['permission_key']));
        }

        return array_values(array_unique($names));
    }

    /**
     * Matriks menu → permissions untuk UI checklist Halaman Kelola Role.
     *
     * Setiap elemen: ['menu' => MasterMenu, 'permissions' => Collection
     * berisi HANYA permission yang benar-benar terdaftar di tabel
     * permissions (mis. Dashboard hanya .view)].
     *
     * @return array<int, array{menu: self, permissions: \Illuminate\Support\Collection<int, Permission>}>
     */
    public static function matrixForRoleForm(): array
    {
        // Ambil permission CRUD & baris master_menus dari DB sekali
        // (name → model), lalu susun per menu mengikuti urutan kolom
        // matriks yang FIXED — total hanya 2 query.
        $crudPermissions = Permission::whereIn('name', self::matrixPermissionNames())
            ->get()
            ->keyBy('name');

        $menusByName = static::query()->get()->keyBy('name');

        $matrix = [];

        foreach (self::MENUS as $menuDefinition) {
            $menu = $menusByName->get($menuDefinition['name'])
                ?? static::make($menuDefinition);

            $permissions = collect();

            foreach (array_keys(self::CRUD_ACTIONS) as $action) {
                $permission = $crudPermissions->get($menuDefinition['permission_key'] . '.' . $action);

                if ($permission !== null) {
                    $permissions->push($permission);
                }
            }

            $matrix[] = [
                'menu'        => $menu,
                'definition'  => $menuDefinition,
                'permissions' => $permissions,
            ];
        }

        return $matrix;
    }
}
