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
            ['name' => 'users.edit',            'display_name' => 'Kelola Status Pengguna',        'module' => 'User Management'],
            ['name' => 'user.reset-password',   'display_name' => 'Reset Password Pengguna',       'module' => 'User Management'],
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
            ['name' => 'announcements.view',    'display_name' => 'Lihat Pengumuman',              'module' => 'Announcements'],
            ['name' => 'announcements.create',  'display_name' => 'Tambah Pengumuman',             'module' => 'Announcements'],
            ['name' => 'announcements.edit',    'display_name' => 'Edit Pengumuman',               'module' => 'Announcements'],
            ['name' => 'announcements.delete',  'display_name' => 'Hapus Pengumuman',              'module' => 'Announcements'],
            ['name' => 'announcements.publish', 'display_name' => 'Publish Pengumuman',            'module' => 'Announcements'],            ['name' => 'galleries.view',        'display_name' => 'Lihat Galeri',                    'module' => 'Gallery'],
            ['name' => 'galleries.create',      'display_name' => 'Tambah Galeri',                   'module' => 'Gallery'],
            ['name' => 'galleries.edit',        'display_name' => 'Edit Galeri',                     'module' => 'Gallery'],
            ['name' => 'galleries.delete',      'display_name' => 'Hapus Galeri',                    'module' => 'Gallery'],
            ['name' => 'work_links.view',       'display_name' => 'Lihat Link Kerja',                'module' => 'Work Link Management'],
            ['name' => 'work_links.create',     'display_name' => 'Tambah Link Kerja',               'module' => 'Work Link Management'],
            ['name' => 'work_links.edit',       'display_name' => 'Edit Link Kerja',                 'module' => 'Work Link Management'],
            ['name' => 'work_links.delete',     'display_name' => 'Hapus Link Kerja',                'module' => 'Work Link Management'],
            ['name' => 'tamu.view',             'display_name' => 'Lihat Data Tamu',                 'module' => 'Guest Book'],
            ['name' => 'tamu.create',           'display_name' => 'Tambah Tamu Manual',              'module' => 'Guest Book'],
            ['name' => 'tamu.edit',             'display_name' => 'Edit Data Tamu',                  'module' => 'Guest Book'],
            ['name' => 'tamu.checkout',         'display_name' => 'Check-Out Tamu',                  'module' => 'Guest Book'],
            ['name' => 'tamu.delete',           'display_name' => 'Hapus Data Tamu',                 'module' => 'Guest Book'],
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
            ['name' => 'activity_logs.delete',  'display_name' => 'Hapus Log Aktivitas',           'module' => 'Activity Log'],
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

        // REVISI AKTOR — role yang diizinkan HANYA 3: Super Admin,
        // Admin Bidang, Karyawan. Role legacy "Administrator" TIDAK
        // dibuat lagi (dihapus dari database via migrasi).

        // RBAC — Super Admin (Sekretariat/Humas): akses penuh seluruh
        // fitur & menu Admin Panel.
        $superAdmin = Role::firstOrCreate(
            ['name' => \App\Models\User::SUPER_ADMIN_ROLE],
            ['description' => 'Super Admin — Sekretariat/Humas, akses penuh seluruh fitur', 'status' => true]
        );

        // RBAC — Admin Bidang: akses dibatasi satu bidang (Pengumuman
        // Internal & Link Kerja bidangnya saja).
        $adminBidang = Role::firstOrCreate(
            ['name' => \App\Models\User::DEPARTMENT_ADMIN_ROLE],
            ['description' => 'Admin Bidang — pengelola konten terbatas satu bidang', 'status' => true]
        );

        $karyawan = Role::firstOrCreate(
            ['name' => 'Karyawan'],
            ['description' => 'Pengguna internal / karyawan', 'status' => true]
        );

        $adminPermissions = [
            'dashboard.view',
            'users.view', 'users.create', 'users.edit', 'users.delete',
            // users.edit kini berarti "Kelola Status Pengguna" (toggle Aktif/Nonaktif).
            // Reset password permission terpisah agar dapat didelegasikan sendiri.
            'user.reset-password',
            'roles.view', 'roles.create', 'roles.edit', 'roles.delete', 'roles.assign_permission',
            'news.view', 'news.create', 'news.edit', 'news.delete', 'news.publish',
            'pages.view', 'pages.create', 'pages.edit', 'pages.delete',
            'menus.view', 'menus.create', 'menus.edit', 'menus.delete',
            'announcements.view', 'announcements.create', 'announcements.edit', 'announcements.delete', 'announcements.publish',
            'galleries.view', 'galleries.create', 'galleries.edit', 'galleries.delete',
            'tamu.view', 'tamu.create', 'tamu.edit', 'tamu.checkout', 'tamu.delete',
            'work_links.view', 'work_links.create', 'work_links.edit', 'work_links.delete',
            'applications.view', 'applications.create', 'applications.edit', 'applications.delete',
            'groups.view', 'groups.create', 'groups.edit', 'groups.delete',
            'internal.view',
            'activity_logs.view', 'activity_logs.delete',
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

        $karyawan->permissions()->syncWithoutDetaching(array_intersect_key($permissionIds, array_flip($karyawanPermissions)));

        // Super Admin: akses penuh — seluruh permission admin.
        $superAdmin->permissions()->syncWithoutDetaching(
            array_intersect_key($permissionIds, array_flip($adminPermissions))
        );

        // Admin Bidang: HANYA menu relevan — Pengumuman Internal &
        // Link Kerja. Menu sensitif (User, Role, Data Tamu, Halaman/Menu
        // landing page) TIDAK diberikan.
        $adminBidang->permissions()->syncWithoutDetaching(
            array_intersect_key($permissionIds, array_flip([
                'dashboard.view',
                'announcements.view', 'announcements.create', 'announcements.edit', 'announcements.delete', 'announcements.publish',
                'work_links.view', 'work_links.create', 'work_links.edit', 'work_links.delete',
                'logout',
            ]))
        );
    }
}
