<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'dashboard.view',         'display_name' => 'Lihat Dashboard',               'module' => 'Dashboard'],
            ['name' => 'users.view',             'display_name' => 'Lihat Pengguna',                'module' => 'User Management'],
            ['name' => 'users.create',          'display_name' => 'Tambah Pengguna',               'module' => 'User Management'],
            ['name' => 'users.edit',            'display_name' => 'Edit Pengguna',                 'module' => 'User Management'],
            ['name' => 'users.delete',          'display_name' => 'Hapus Pengguna',                'module' => 'User Management'],
            ['name' => 'roles.view',            'display_name' => 'Lihat Role',                    'module' => 'Role Management'],
            ['name' => 'roles.create',          'display_name' => 'Tambah Role',                   'module' => 'Role Management'],
            ['name' => 'roles.edit',            'display_name' => 'Edit Role',                     'module' => 'Role Management'],
            ['name' => 'roles.delete',          'display_name' => 'Hapus Role',                    'module' => 'Role Management'],
            ['name' => 'roles.assign_permission','display_name' => 'Kelola Permission',             'module' => 'Role Management'],
            ['name' => 'news.view',             'display_name' => 'Lihat Berita',                  'module' => 'News'],
            ['name' => 'news.create',           'display_name' => 'Tambah Berita',                 'module' => 'News'],
            ['name' => 'news.edit',             'display_name' => 'Edit Berita',                   'module' => 'News'],
            ['name' => 'news.delete',           'display_name' => 'Hapus Berita',                  'module' => 'News'],
            ['name' => 'news.publish',          'display_name' => 'Publish Berita',                'module' => 'News'],
            ['name' => 'pages.view',            'display_name' => 'Lihat Halaman',                 'module' => 'Page Management'],
            ['name' => 'pages.create',          'display_name' => 'Tambah Halaman',                'module' => 'Page Management'],
            ['name' => 'pages.edit',            'display_name' => 'Edit Halaman',                  'module' => 'Page Management'],
            ['name' => 'pages.delete',          'display_name' => 'Hapus Halaman',                 'module' => 'Page Management'],
            ['name' => 'menus.view',            'display_name' => 'Lihat Menu',                    'module' => 'Menu Management'],
            ['name' => 'menus.create',          'display_name' => 'Tambah Menu',                   'module' => 'Menu Management'],
            ['name' => 'menus.edit',            'display_name' => 'Edit Menu',                     'module' => 'Menu Management'],
            ['name' => 'menus.delete',          'display_name' => 'Hapus Menu',                    'module' => 'Menu Management'],
            ['name' => 'applications.view',     'display_name' => 'Lihat Aplikasi',                'module' => 'Application Management'],
            ['name' => 'applications.create',   'display_name' => 'Tambah Aplikasi',               'module' => 'Application Management'],
            ['name' => 'applications.edit',     'display_name' => 'Edit Aplikasi',                 'module' => 'Application Management'],
            ['name' => 'applications.delete',   'display_name' => 'Hapus Aplikasi',                'module' => 'Application Management'],
            ['name' => 'groups.view',           'display_name' => 'Lihat Grup Karyawan',           'module' => 'Employee Group'],
            ['name' => 'groups.create',         'display_name' => 'Tambah Grup Karyawan',          'module' => 'Employee Group'],
            ['name' => 'groups.edit',           'display_name' => 'Edit Grup Karyawan',            'module' => 'Employee Group'],
            ['name' => 'groups.delete',         'display_name' => 'Hapus Grup Karyawan',           'module' => 'Employee Group'],
            ['name' => 'internal.view',         'display_name' => 'Akses Halaman Internal',        'module' => 'Internal Page'],
            ['name' => 'activity_logs.view',    'display_name' => 'Lihat Log Aktivitas',           'module' => 'Activity Log'],
            ['name' => 'settings.view',         'display_name' => 'Lihat Pengaturan',              'module' => 'Settings'],
            ['name' => 'settings.edit',         'display_name' => 'Edit Pengaturan',               'module' => 'Settings'],
            ['name' => 'logout',                'display_name' => 'Logout',                        'module' => 'Auth'],
        ];

        $permissionIds = [];
        foreach ($permissions as $perm) {
            $permissionIds[$perm['name']] = Permission::firstOrCreate(
                ['name' => $perm['name']],
                ['display_name' => $perm['display_name'], 'module' => $perm['module']]
            )->id;
        }

        $administrator = Role::firstOrCreate(
            ['name' => 'Administrator'],
            ['description' => 'Akses penuh sistem', 'status' => true]
        );

        $karyawan = Role::firstOrCreate(
            ['name' => 'Karyawan'],
            ['description' => 'Pengguna internal / karyawan', 'status' => true]
        );

        $adminPermissions = [
            'dashboard.view',
            'users.view', 'users.create', 'users.edit', 'users.delete',
            'roles.view', 'roles.create', 'roles.edit', 'roles.delete', 'roles.assign_permission',
            'news.view', 'news.create', 'news.edit', 'news.delete', 'news.publish',
            'pages.view', 'pages.create', 'pages.edit', 'pages.delete',
            'menus.view', 'menus.create', 'menus.edit', 'menus.delete',
            'applications.view', 'applications.create', 'applications.edit', 'applications.delete',
            'groups.view', 'groups.create', 'groups.edit', 'groups.delete',
            'internal.view',
            'activity_logs.view',
            'settings.view', 'settings.edit',
            'logout',
        ];

        $karyawanPermissions = [
            'dashboard.view',
            'news.view',
            'pages.view',
            'internal.view',
            'applications.view',
            'logout',
        ];

        $administrator->permissions()->syncWithoutDetaching(array_intersect_key($permissionIds, array_flip($adminPermissions)));
        $karyawan->permissions()->syncWithoutDetaching(array_intersect_key($permissionIds, array_flip($karyawanPermissions)));
    }
}
