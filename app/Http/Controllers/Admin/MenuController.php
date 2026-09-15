<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\View\View;

class MenuController extends Controller
{
    /** Ikon siap-pilih di form — admin tidak perlu hafal kode Font Awesome. */
    public const ICON_CHOICES = [
        'fa-house', 'fa-building', 'fa-book-open', 'fa-newspaper', 'fa-bullhorn',
        'fa-images', 'fa-concierge-bell', 'fa-envelope', 'fa-location-dot', 'fa-phone',
        'fa-users', 'fa-file-lines', 'fa-file-pdf', 'fa-bolt', 'fa-circle-info',
        'fa-link', 'fa-calendar', 'fa-handshake', 'fa-chart-line', 'fa-shield-halved',
        'fa-gear', 'fa-question', 'fa-download', 'fa-star',
    ];

    public function index(): View
    {
        $menus = Menu::with(['children' => fn ($q) => $q->ordered(), 'page'])
            ->roots()
            ->ordered()
            ->paginate(15);

        return view('admin.menus.index', [
            'menus'            => $menus,
            'typeLabels'       => Menu::TYPES,
            'typeDescriptions' => Menu::TYPE_DESCRIPTIONS,
        ]);
    }

    public function create(): View
    {
        return view('admin.menus.form', [
            'menu'             => null,
            'parents'          => $this->parentOptions(),
            'pages'            => $this->pageOptions(),
            'routeOptions'     => $this->routeOptions(),
            'typeLabels'       => Menu::TYPES,
            'typeDescriptions' => Menu::TYPE_DESCRIPTIONS,
            'iconChoices'      => self::ICON_CHOICES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateMenu($request);

        $validated['parent_id']  = $this->normalizeParentId($validated['parent_id'] ?? null);
        $validated['created_by'] = auth()->id();

        // Urutan dikosongkan = otomatis diletakkan paling akhir
        if (! isset($validated['sort_order'])) {
            $validated['sort_order'] = $this->nextSortOrder($validated['parent_id']);
        }

        $menu = Menu::create($validated);

        ActivityLog::record('menu', 'create', "menambah menu \"{$menu->label}\"", $menu);

        return redirect()->route('admin.menus.index')
            ->with('success', "Menu \"{$menu->label}\" berhasil ditambahkan dan langsung tampil di navbar.");
    }

    public function edit(Menu $menu): View
    {
        return view('admin.menus.form', [
            'menu'             => $menu,
            'parents'          => $this->parentOptions($menu->id),
            'pages'            => $this->pageOptions(),
            'routeOptions'     => $this->routeOptions(),
            'typeLabels'       => Menu::TYPES,
            'typeDescriptions' => Menu::TYPE_DESCRIPTIONS,
            'iconChoices'      => self::ICON_CHOICES,
        ]);
    }

    public function update(Request $request, Menu $menu): RedirectResponse
    {
        $validated = $this->validateMenu($request);

        $validated['parent_id'] = $this->normalizeParentId($validated['parent_id'] ?? null);

        if (! isset($validated['sort_order'])) {
            $validated['sort_order'] = $menu->sort_order;
        }

        $menu->update($validated);

        ActivityLog::record('menu', 'update', "mengubah menu \"{$menu->label}\"", $menu);

        return redirect()->route('admin.menus.index')
            ->with('success', "Menu \"{$menu->label}\" berhasil diperbarui.");
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        $label = $menu->label;
        $menu->delete(); // submenunya ikut terhapus oleh FK cascade

        ActivityLog::record('menu', 'delete', "menghapus menu \"{$label}\" (termasuk submenunya)", $menu);

        return redirect()->route('admin.menus.index')
            ->with('success', "Menu \"{$label}\" berhasil dihapus.");
    }

    public function toggleStatus(Menu $menu): RedirectResponse
    {
        $menu->update(['is_active' => ! $menu->is_active]);

        ActivityLog::record(
            'menu',
            'update',
            ($menu->is_active ? 'mengaktifkan menu "' : 'menyembunyikan menu "') . $menu->label . '"',
            $menu
        );

        return back()->with('success', $menu->is_active
            ? "Menu \"{$menu->label}\" ditampilkan kembali di navbar."
            : "Menu \"{$menu->label}\" disembunyikan dari navbar (bisa diaktifkan lagi kapan saja).");
    }

    /** Naik/turunkan posisi menu di antara saudara satu level. */
    public function move(Request $request, Menu $menu): RedirectResponse
    {
        $direction = $request->input('direction') === 'up' ? 'up' : 'down';

        $neighbor = Menu::query()
            ->where(function ($q) use ($menu) {
                $menu->parent_id ? $q->where('parent_id', $menu->parent_id) : $q->whereNull('parent_id');
            })
            ->where('id', '!=', $menu->id)
            ->where('sort_order', $direction === 'up' ? '<' : '>', $menu->sort_order)
            ->orderBy('sort_order', $direction === 'up' ? 'desc' : 'asc')
            ->orderBy('id', $direction === 'up' ? 'desc' : 'asc')
            ->first();

        if ($neighbor && $neighbor->sort_order !== $menu->sort_order) {
            DB::transaction(function () use ($menu, $neighbor) {
                $a = $menu->sort_order;
                $b = $neighbor->sort_order;

                $menu->update(['sort_order' => $b]);
                $neighbor->update(['sort_order' => $a]);
            });
        }

        return redirect()->route('admin.menus.index');
    }

    /* =========================================================
       HELPER
       ========================================================= */

    private function validateMenu(Request $request): array
    {
        $validated = $request->validate([
            'label'      => ['required', 'string', 'max:255'],
            'type'       => ['required', 'in:route,page,url'],
            'parent_id'  => ['nullable', 'integer', 'exists:menus,id'],
            'route_name' => ['nullable', 'string', 'max:255'],
            'page_id'    => ['nullable', 'integer', 'exists:pages,id'],
            'url'        => ['nullable', 'string', 'max:500'],
            'icon'       => ['nullable', 'string', 'max:60', 'regex:/^[a-z0-9\- ]+$/i'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active'  => ['nullable', 'boolean'],
        ], [
            'label.required' => 'Nama menu wajib diisi.',
            'type.required'  => 'Pilih salah satu jenis tujuan menu.',
            'url.required'   => 'Alamat link wajib diisi untuk jenis "link lain".',
        ]);

        // Pastikan target konsisten dengan jenis yang dipilih
        if ($validated['type'] === Menu::TYPE_ROUTE) {
            $validated['page_id'] = null;
            $validated['url'] = null;
        } elseif ($validated['type'] === Menu::TYPE_PAGE) {
            $validated['route_name'] = null;
            $validated['url'] = null;
        } else {
            $validated['route_name'] = null;
            $validated['page_id'] = null;
        }

        $validated['icon'] = $this->sanitizeIcon($validated['icon'] ?? null);

        return $validated;
    }

    /** Terima input apa pun ("building", "fa-building", "fas fa-building") → "fa-building". */
    private function sanitizeIcon(?string $icon): ?string
    {
        $icon = trim((string) $icon);

        if ($icon === '') {
            return null;
        }

        if (preg_match('/fa[bsrl]?-([a-z0-9\-]+)/i', $icon, $m)) {
            return 'fa-' . $m[1];
        }

        $clean = preg_replace('/[^a-z0-9\-]/i', '', $icon);

        return $clean !== '' ? 'fa-' . $clean : null;
    }

    private function normalizeParentId($parentId): ?int
    {
        $parentId = (int) ($parentId ?: 0);

        return $parentId > 0 ? $parentId : null;
    }

    /** Urutan berikutnya di level yang sama (root atau dalam satu dropdown). */
    private function nextSortOrder(?int $parentId): int
    {
        return (int) Menu::query()
            ->where(function ($q) use ($parentId) {
                $parentId ? $q->where('parent_id', $parentId) : $q->whereNull('parent_id');
            })
            ->max('sort_order') + 1;
    }

    /** Menu induk yang tersedia (menu root lain). */
    private function parentOptions(?int $excludeId = null): array
    {
        return Menu::query()
            ->roots()
            ->ordered()
            ->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))
            ->get(['id', 'label'])
            ->mapWithKeys(fn ($m) => [$m->id => $m->label])
            ->all();
    }

    private function pageOptions(): array
    {
        return Page::query()
            ->orderBy('title')
            ->get(['id', 'title', 'slug', 'status', 'visibility'])
            ->all();
    }

    /** Route publik yang boleh dipakai sebagai link menu. */
    private function routeOptions(): array
    {
        $allowed = [
            'home'                  => 'Beranda',
            'profil-perusahaan'     => 'Profil Perusahaan',
            'sejarah'               => 'Sejarah',
            'visi-misi'             => 'Visi & Misi',
            'struktur-organisasi'   => 'Struktur Organisasi',
            'berita'                => 'Berita',
            'pengumuman'            => 'Pengumuman',
            'informasi.layanan'     => 'Informasi Layanan',
            'galeri'                => 'Galeri',
            'layanan.daftar'        => 'Daftar Layanan',
            'layanan.faq'           => 'FAQ Layanan',
            'hubungi-kami'          => 'Hubungi Kami',
            'lokasi'                => 'Lokasi',
            'sosial-media'          => 'Sosial Media',
            'pages.index'           => 'Semua Halaman CMS',
        ];

        $options = [];
        foreach ($allowed as $name => $label) {
            if (RouteFacade::has($name)) {
                $options[$name] = $label;
            }
        }

        return $options;
    }
}
