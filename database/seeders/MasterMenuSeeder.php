<?php

namespace Database\Seeders;

use App\Models\MasterMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * MasterMenuSeeder — mengisi tabel master_menus dengan 11 ID Menu
 * Sidebar Admin Panel (ID FIXED sesuai spec RBAC):
 *
 *   ID 1  : Dashboard          ID 7  : Pengguna
 *   ID 2  : Berita             ID 8  : Galeri
 *   ID 3  : Data Tamu          ID 9  : Link Kerja
 *   ID 4  : Pengumuman         ID 10 : Log Aktivitas
 *   ID 5  : Halaman            ID 11 : Role / Hak Akses
 *   ID 6  : Menu
 *
 * Idempotent: updateOrCreate by id — aman dijalankan berulang.
 */
class MasterMenuSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('master_menus')) {
            return;
        }

        foreach (MasterMenu::MENUS as $index => $menu) {
            MasterMenu::updateOrCreate(
                ['id' => $menu['id']],
                [
                    'name'           => $menu['name'],
                    'route'          => $menu['route'],
                    'icon'           => $menu['icon'],
                    'permission_key' => $menu['permission_key'],
                    'sort_order'     => $index + 1,
                ]
            );
        }
    }
}
