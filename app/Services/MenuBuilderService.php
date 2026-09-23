<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/**
 * MenuBuilderService
 *
 * Membangun tree menu untuk navbar publik:
 * - Hanya menu aktif, terurut.
 * - Menu yang target-nya halaman CMS disaring sesuai visibilitas halaman
 *   (menu ikut hilang jika page tidak bisa dilihat user — keamanan di server,
 *   bukan sekadar disembunyikan).
 * - Menu dengan target tidak valid (route dihapus, page dihapus) disembunyikan.
 * - Jika database belum punya menu sama sekali (belum di-seed), dipakai
 *   struktur default hardcode — navbar lama + link Beranda — sehingga
 *   migrasi antar tampilan minim perubahan.
 *
 * Bentuk item hasil build (konsisten untuk DB maupun fallback):
 * ['menu' => ?Menu, 'label' => string, 'icon' => ?string, 'url' => ?string, 'target' => ?string, 'children' => array]
 */
class MenuBuilderService
{
    /** Fallback identik dengan navbar hardcode lama (termasuk key i18n). */
    private const DEFAULT_TREE = [
        [
            'label' => 'Beranda',
            'icon'  => 'fa-house',
            'i18n'  => 'nav.home',
            'route' => 'home',
            'children' => [],
        ],
        [
            'label' => 'Tentang Kami',
            'icon'  => 'fa-building',
            'i18n'  => 'nav.about',
            'children' => [
                ['label' => 'Profil Perusahaan',   'route' => 'profil-perusahaan',   'i18n' => 'nav.about_profile'],
                ['label' => 'Sejarah',             'route' => 'sejarah',             'i18n' => 'nav.about_history'],
                ['label' => 'Visi & Misi',         'route' => 'visi-misi',           'i18n' => 'nav.about_vision_mission'],
                ['label' => 'Struktur Organisasi', 'route' => 'struktur-organisasi', 'i18n' => 'nav.about_structure'],
            ],
        ],
        [
            'label' => 'Informasi',
            'icon'  => 'fa-book-open',
            'i18n'  => 'nav.information',
            'children' => [
                ['label' => 'Berita',            'route' => 'berita',             'i18n' => 'nav.info_news'],
                ['label' => 'Pengumuman',        'route' => 'pengumuman',         'i18n' => 'nav.info_announcements'],
                ['label' => 'Informasi Layanan', 'route' => 'informasi.layanan',  'i18n' => null],
                ['label' => 'Galeri',            'route' => 'galeri',             'i18n' => 'nav.info_gallery'],
            ],
        ],
        [
            'label' => 'Layanan',
            'icon'  => 'fa-concierge-bell',
            'i18n'  => 'nav.services',
            'children' => [
                ['label' => 'FAQ',                 'route' => 'layanan.faq',    'i18n' => 'nav.services_faq'],
                ['label' => 'Form Registrasi Tamu', 'route' => 'layanan.registrasi-tamu', 'i18n' => 'nav.services_registration'],
            ],
        ],
    ];

    /**
     * Pemetaan menu bawaan ke key i18n (public/js/i18n.js).
     * Key = nama route untuk menu daun, label untuk grup dropdown.
     * Menu dengan label/route di luar daftar ini tetap tampil —
     * hanya tidak ikut dialihbahasakan (i18n = null).
     */
    private const I18N_BY_KEY = [
        'home'                => 'nav.home',
        'Beranda'             => 'nav.home',
        'Tentang Kami'        => 'nav.about',
        'profil-perusahaan'   => 'nav.about_profile',
        'sejarah'             => 'nav.about_history',
        'visi-misi'           => 'nav.about_vision_mission',
        'struktur-organisasi' => 'nav.about_structure',
        'Informasi'           => 'nav.information',
        'berita'              => 'nav.info_news',
        'pengumuman'          => 'nav.info_announcements',
        'galeri'              => 'nav.info_gallery',
        'Layanan'             => 'nav.services',
        'layanan.faq'         => 'nav.services_faq',
        'layanan.registrasi-tamu' => 'nav.services_registration',
        'tamu.create'          => 'nav.services_registration', // kompatibilitas menu lama di DB
    ];

    /**
     * Key i18n untuk menu database: cocokkan route_name (daun)
     * lalu label (grup/daun tanpa route). Null bila tidak dikenal.
     */
    private function resolveI18n(Menu $menu): ?string
    {
        if ($menu->route_name && isset(self::I18N_BY_KEY[$menu->route_name])) {
            return self::I18N_BY_KEY[$menu->route_name];
        }

        return self::I18N_BY_KEY[$menu->label] ?? null;
    }

    public function treeFor(?User $user): array
    {
        $menus = Menu::query()
            ->active()
            ->ordered()
            ->with(['page', 'children' => fn ($q) => $q->active()->ordered()->with('page')])
            ->whereNull('parent_id')
            ->get();

        // Database belum di-seed → struktur default (navbar lama).
        if ($menus->isEmpty()) {
            return $this->defaultTree();
        }

        return $menus
            ->map(fn (Menu $menu) => $this->mapMenu($menu, $user))
            ->filter()
            ->values()
            ->all();
    }

    /* =========================================================
       INTERNAL
       ========================================================= */

    private function mapMenu(Menu $menu, ?User $user): ?array
    {
        $children = $menu->children
            ->map(fn (Menu $child) => $this->mapMenu($child, $user))
            ->filter()
            ->values()
            ->all();

        $url = $menu->resolvedUrl();

        // Grup dropdown (punya submenu tampil) tidak butuh target sendiri —
        // dropdown dirender dengan href="#, yang penting isinya.
        if ($children !== []) {
            return [
                'menu'     => $menu,
                'label'    => $menu->label,
                'icon'     => $menu->icon !== null && trim($menu->icon) !== '' ? $menu->icon : null,
                'i18n'     => $this->resolveI18n($menu),
                'url'      => $url,
                'target'   => null, // grup dropdown tidak membuka tab baru
                'children' => $children,
            ];
        }

        // Menu daun (tanpa submenu): target page yang tidak dapat dilihat user → sembunyikan
        if ($menu->type === Menu::TYPE_PAGE) {
            if (! $menu->page || ! $menu->page->isAccessibleBy($user)) {
                return null;
            }
        }

        // Target tidak valid (route hilang / page hilang / url kosong) → sembunyikan
        if ($url === null) {
            return null;
        }

        return [
            'menu'     => $menu,
            'label'    => $menu->label,
            'icon'     => $menu->icon !== null && trim($menu->icon) !== '' ? $menu->icon : null,
            'i18n'     => $this->resolveI18n($menu),
            'url'      => $url,
            'target'   => $menu->htmlTarget(),
            'children' => $children,
        ];
    }

    private function defaultTree(): array
    {
        return collect(self::DEFAULT_TREE)
            ->map(function (array $group) {
                // Grup daun (mis. Beranda) punya route sendiri; grup dropdown tidak.
                $ownUrl = isset($group['route']) && Route::has($group['route'])
                    ? route($group['route'])
                    : null;

                return [
                    'menu'     => null,
                    'label'    => $group['label'],
                    'icon'     => $group['icon'],
                    'i18n'     => $group['i18n'] ?? null,
                    'url'      => $ownUrl, // grup dropdown: tidak punya target sendiri
                    'target'   => null,
                    'children' => collect($group['children'])
                        ->filter(fn (array $child) => Route::has($child['route']))
                        ->map(fn (array $child) => [
                            'menu'     => null,
                            'label'    => $child['label'],
                            'icon'     => null,
                            'i18n'     => $child['i18n'] ?? null,
                            'url'      => route($child['route']),
                            'target'   => null,
                            'children' => [],
                        ])
                        ->all(),
                ];
            })
            // Grup dropdown tanpa anak valid dibuang, tapi grup daun dengan
            // route valid (mis. Beranda) tetap tampil.
            ->filter(fn (array $group) => $group['children'] !== [] || $group['url'] !== null)
            ->values()
            ->all();
    }
}
