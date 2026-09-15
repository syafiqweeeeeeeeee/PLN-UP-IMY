<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Seed struktur menu default — identik dengan navbar hardcode lama,
 * sehingga setelah seeding tampilan navbar tidak berubah sama sekali.
 * Aman dijalankan berulang (firstOrCreate by label+parent).
 */
class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();

        $tree = [
            [
                'label' => 'Beranda', 'icon' => 'fa-house', 'sort_order' => 1, 'type' => 'route', 'route_name' => 'home',
            ],
            [
                'label' => 'Tentang Kami', 'icon' => 'fa-building', 'sort_order' => 2, 'type' => 'url', 'url' => '#',
                'children' => [
                    ['label' => 'Profil Perusahaan',   'type' => 'route', 'route_name' => 'profil-perusahaan',   'sort_order' => 1],
                    ['label' => 'Sejarah',             'type' => 'route', 'route_name' => 'sejarah',             'sort_order' => 2],
                    ['label' => 'Visi & Misi',         'type' => 'route', 'route_name' => 'visi-misi',           'sort_order' => 3],
                    ['label' => 'Struktur Organisasi', 'type' => 'route', 'route_name' => 'struktur-organisasi', 'sort_order' => 4],
                ],
            ],
            [
                'label' => 'Informasi', 'icon' => 'fa-book-open', 'sort_order' => 3, 'type' => 'url', 'url' => '#',
                'children' => [
                    ['label' => 'Berita',            'type' => 'route', 'route_name' => 'berita',            'sort_order' => 1],
                    ['label' => 'Pengumuman',        'type' => 'route', 'route_name' => 'pengumuman',        'sort_order' => 2],
                    ['label' => 'Informasi Layanan', 'type' => 'route', 'route_name' => 'informasi.layanan', 'sort_order' => 3],
                    ['label' => 'Galeri',            'type' => 'route', 'route_name' => 'galeri',            'sort_order' => 4],
                ],
            ],
            [
                'label' => 'Layanan', 'icon' => 'fa-concierge-bell', 'sort_order' => 4, 'type' => 'url', 'url' => '#',
                'children' => [
                    ['label' => 'Daftar Layanan', 'type' => 'route', 'route_name' => 'layanan.daftar', 'sort_order' => 1],
                    ['label' => 'FAQ',            'type' => 'route', 'route_name' => 'layanan.faq',    'sort_order' => 2],
                ],
            ],
            [
                'label' => 'Kontak', 'icon' => 'fa-envelope', 'sort_order' => 5, 'type' => 'url', 'url' => '#',
                'children' => [
                    ['label' => 'Hubungi Kami', 'type' => 'route', 'route_name' => 'hubungi-kami', 'sort_order' => 1],
                    ['label' => 'Lokasi',       'type' => 'route', 'route_name' => 'lokasi',       'sort_order' => 2],
                    ['label' => 'Sosial Media', 'type' => 'route', 'route_name' => 'sosial-media', 'sort_order' => 3],
                ],
            ],
        ];

        foreach ($tree as $group) {
            $children = $group['children'] ?? [];
            unset($group['children']);

            $parent = Menu::firstOrCreate(
                ['label' => $group['label'], 'parent_id' => null],
                $group + ['is_active' => true, 'created_by' => $admin?->id]
            );

            foreach ($children as $child) {
                Menu::firstOrCreate(
                    ['label' => $child['label'], 'parent_id' => $parent->id],
                    $child + ['is_active' => true, 'created_by' => $admin?->id]
                );
            }
        }
    }
}
