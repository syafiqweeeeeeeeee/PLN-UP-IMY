<?php

namespace Database\Seeders;

use App\Models\MasterMenu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * PermissionSeeder — SISTEM HAK AKSES PER ID MENU.
 *
 * Total permission di database = 51 baris: 39 baris matriks mengikuti
 * struktur 11 ID Menu Sidebar (lihat MasterMenu::MENUS) × aksi CRUD
 * yang benar-benar AKTIF di kode, ditambah 4 baris `karyawan_data.*`
 * dan 8 baris `master_bidang.*` / `master_jabatan.*` (module Data
 * Karyawan, Master Bidang & Master Jabatan di panel admin — di
 * luar matriks admin, diassign lewat halaman Kelola Permission /
 * Direct Permission):
 *
 *      ID Menu | permission_key  | hak akses yang didaftarkan
 *      --------|-----------------|--------------------------------
 *      1  Dashboard      | dashboard              | view            (1)
 *      2  Berita         | news                   | view/custom/edit/delete
 *      3  Data Tamu      | tamu                   | view/custom/edit/delete
 *      4  Pengumuman     | announcements          | view/custom/edit/delete
 *      5  Halaman        | pages                  | view/custom/edit/delete
 *      6  Menu           | menus                  | view/custom/edit/delete
 *      7  Pengguna       | users                  | view/custom/edit/delete
 *      8  Galeri         | galleries              | view/custom/edit/delete
 *      9  Link Kerja     | work_links             | view/custom/edit/delete
 *      10 Log Aktivitas  | activity_logs          | view/delete     (2)
 *      11 Role/Hak Akses | roles                  | view/custom/edit/delete
 *
 *      1 + (8 × 4) + 2 + 4 = 39  (+ 4 karyawan_data.* = 43,
 *                                 + 4 master_bidang.*
 *                                 + 4 master_jabatan.* = 51)
 *
 * Aksi spesifik non-CRUD yang dulu terdaftar terpisah (news.publish,
 * announcements.publish, tamu.checkout, user.reset-password,
 * roles.assign_permission) TIDAK LAGI menjadi baris permission —
 * kemampuan tersebut kini menyatu dengan aksi EDIT induknya dan
 * dipetakan lewat Permission::ACTION_ALIASES (dibaca @can & middleware
 * permission: melalui User::hasPermission), sehingga tidak ada
 * callback/fitur yang kehilangan otorisasi (tidak ada 403).
 *
 * Permission lama/dummy di luar daftar ini (settings.*, groups.*,
 * applications.*, internal.view, logout, dst.) DIHAPUS dari database
 * bersama baris pivotnya agar tidak ada sisa data legacy.
 */
class PermissionSeeder extends Seeder
{
    /**
     * Aksi yang benar-benar AKTIF per permission_key (urutan mengikuti
     * kolom matriks UI Dashboard→Role di form Tambah/Edit Role).
     *
     * @var array<string, array<int, string>>
     */
    private const MENU_ACTIONS = [
        'dashboard' => ['view'],
        'news' => ['view', 'create', 'edit', 'delete'],
        'tamu' => ['view', 'create', 'edit', 'delete'],
        'announcements' => ['view', 'create', 'edit', 'delete'],
        'pages' => ['view', 'create', 'edit', 'delete'],
        'menus' => ['view', 'create', 'edit', 'delete'],
        'users' => ['view', 'create', 'edit', 'delete'],
        'galleries' => ['view', 'create', 'edit', 'delete'],
        'work_links' => ['view', 'create', 'edit', 'delete'],
        'activity_logs' => ['view', 'delete'],
        'roles' => ['view', 'create', 'edit', 'delete'],
        // Data Karyawan — master data HR di portal karyawan (bukan menu
        // matriks admin; dikelola akun karyawan yang diberi permission ini
        // via Edit Role / Direct Permission).
        'karyawan_data' => ['view', 'create', 'edit', 'delete'],
        // Master Bidang & Master Jabatan — master data hierarki di
        // panel admin (di luar matriks admin; dikelola akun yang
        // diberi permission ini via Kelola Role / Direct Permission —
        // pola sama dengan karyawan_data).
        'master_bidang' => ['view', 'create', 'edit', 'delete'],
        'master_jabatan' => ['view', 'create', 'edit', 'delete'],
    ];

    /** Nama modul (untuk pengelompokan halaman "Kelola Permission"). */
    private const MENU_MODULES = [
        'dashboard' => 'Dashboard',
        'news' => 'News',
        'tamu' => 'Guest Book',
        'announcements' => 'Announcements',
        'pages' => 'Page Management',
        'menus' => 'Menu Management',
        'users' => 'User Management',
        'galleries' => 'Gallery',
        'work_links' => 'Work Link Management',
        'activity_logs' => 'Activity Log',
        'roles' => 'Role Management',
        'karyawan_data' => 'Data Karyawan',
        'master_bidang' => 'Master Bidang',
        'master_jabatan' => 'Master Jabatan',
    ];

    public function run(): void
    {
        $menuNames = array_column(MasterMenu::MENUS, 'name', 'permission_key');

        // ================================================
        // 1) Pastikan baris permission matriks ada (43).
        // ================================================
        $permissionIds = [];

        foreach (self::MENU_ACTIONS as $key => $actions) {
            foreach ($actions as $action) {
                $name = "{$key}.{$action}";

                $permissionIds[$name] = Permission::firstOrCreate(
                    ['name' => $name],
                    [
                        'display_name' => self::displayName($key, $action),
                        'module' => self::MENU_MODULES[$key],
                    ]
                )->id;
            }
        }

        $activeNames = array_keys($permissionIds);

        // ================================================
        // 2) Hapus permission legacy/diam di luar 39 baris
        //    matriks — bersama pivot role & direct-permission
        //    user agar tidak ada sisa data dummy.
        // ================================================
        Permission::query()
            ->whereNotIn('name', $activeNames)
            ->get()
            ->each(function (Permission $permission): void {
                $permission->roles()->detach();
                DB::table('user_has_permissions')->where('permission_id', $permission->id)->delete();
                $permission->delete();
            });

        // ================================================
        // 3) Sinkronkan 3 Role Dasar (replace penuh → pivot
        //    bebas sisa permission lama).
        // ================================================

        $superAdmin = Role::firstOrCreate(
            ['name' => User::SUPER_ADMIN_ROLE],
            ['description' => 'Super Admin — Sekretariat/Humas, akses penuh seluruh fitur', 'status' => true]
        );

        // Super Admin: akses penuh = TEPAT seluruh 39 permission matriks
        // (sync() mengganti isi pivot → tidak ada sisa permission legacy).
        $superAdmin->permissions()->sync(array_values($permissionIds));

        // RBAC — Admin Bidang: akses dibatasi modul bidangnya (Pengumuman
        // Internal & Link Kerja). Menu sensitif TIDAK diberikan.
        $adminBidang = Role::firstOrCreate(
            ['name' => User::DEPARTMENT_ADMIN_ROLE],
            ['description' => 'Admin Bidang — pengelola konten terbatas satu bidang', 'status' => true]
        );

        $adminBidang->permissions()->sync(array_intersect_key($permissionIds, array_flip([
            'dashboard.view',
            'announcements.view', 'announcements.create', 'announcements.edit', 'announcements.delete',
            'work_links.view', 'work_links.create', 'work_links.edit', 'work_links.delete',
            'master_bidang.view', 'master_jabatan.view',
        ])));

        // Karyawan: baseline portal — SATU sumber di
        // User::KARYAWAN_BASELINE_PERMISSIONS (dipotong ke permission yang
        // benar-benar terdaftar).
        $karyawan = Role::firstOrCreate(
            ['name' => 'Karyawan'],
            ['description' => 'Pengguna internal / karyawan', 'status' => true]
        );

        $karyawan->permissions()->sync(array_intersect_key(
            $permissionIds,
            array_flip(User::KARYAWAN_BASELINE_PERMISSIONS)
        ));
    }

    /**
     * Label Indonesia per aksi (tampil di matriks & halaman
     * Kelola Permission), konsisten dengan MasterMenu::CRUD_ACTIONS.
     */
    private static function displayName(string $key, string $action): string
    {
        $menuName = MasterMenu::MENUS[array_search($key, array_column(MasterMenu::MENUS, 'permission_key'))]['name'] ?? $key;

        $verb = match ($action) {
            'view' => 'Lihat',
            'create' => 'Tambah',
            'edit' => 'Edit',
            'delete' => 'Hapus',
        };

        switch ($key) {
            case 'dashboard':
                return 'Akses Dashboard';
            case 'activity_logs':
                return $action === 'view' ? 'Akses Log Aktivitas' : 'Hapus Log Aktivitas';
            case 'pages':
                return $action === 'view' ? 'Lihat Halaman' : "{$verb} Halaman";
            case 'menus':
                return $action === 'view' ? 'Lihat Menu' : "{$verb} Menu";
            case 'tamu':
                return $action === 'view' ? 'Akses Data Tamu' : "{$verb} Tamu";
            case 'users':
                return $action === 'view' ? 'Lihat Pengguna' : "{$verb} Pengguna";
            case 'roles':
                return $action === 'view' ? 'Lihat Role' : "{$verb} Role";
            case 'news':
                return "{$verb} Berita";
            case 'announcements':
                return "{$verb} Pengumuman";
            case 'galleries':
                return "{$verb} Galeri";
            case 'work_links':
                return "{$verb} Link Kerja";
            case 'karyawan_data':
                return $action === 'view' ? 'Lihat Data Karyawan' : "{$verb} Data Karyawan";
            case 'master_bidang':
                return $action === 'view' ? 'Lihat Master Bidang' : "{$verb} Master Bidang";
            case 'master_jabatan':
                return $action === 'view' ? 'Lihat Master Jabatan' : "{$verb} Master Jabatan";
        }

        return "{$verb} {$menuName}";
    }
}
