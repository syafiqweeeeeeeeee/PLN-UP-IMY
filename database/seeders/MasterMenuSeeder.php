<?php

namespace Database\Seeders;

use App\Models\MasterMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * MasterMenuSeeder — mengisi tabel master_menus dengan menu sidebar
 * Admin Panel sesuai MasterMenu::MENUS (spec RBAC + menu tambahan:
 * Hari Libur, Data Karyawan, Master Bidang, Master Jabatan — semua
 * ikut matriks hak akses form Tambah/Edit Role):
 *
 *   ID 1  : Dashboard          ID 9  : Link Kerja
 *   ID 2  : Berita             ID 10 : Log Aktivitas
 *   ID 3  : Data Tamu          ID 11 : Role / Hak Akses
 *   ID 4  : Pengumuman         ID 13 : Hari Libur
 *   ID 7  : Pengguna           ID 14 : Data Karyawan
 *   ID 8  : Galeri             ID 15 : Master Bidang
 *                              ID 16 : Master Jabatan
 *
 * Idempotent: updateOrCreate by id — aman dijalankan berulang.
 * Baris di luar daftar MENUS (mis. baris uji "contoh") DIHAPUS agar
 * matriks tidak menampilkan menu ganda/dummy.
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

        // Bersihkan baris di luar MENUS (baris uji/legacy) — pola sama
        // dengan pembersihan permission legacy di PermissionSeeder.
        MasterMenu::query()
            ->whereNotIn('id', array_column(MasterMenu::MENUS, 'id'))
            ->delete();
    }
}
