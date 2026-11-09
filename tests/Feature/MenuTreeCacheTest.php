<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\MenuBuilderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

/**
 * WHITE-BOX — cache tree navbar (MenuBuilderService::treeFor / flushTree).
 *
 * Alur internal:
 *   treeFor($user) → Cache::remember('menu.tree.u{id}', TTL 5 menit, …)
 *   flushTree()    → lupa kunci u0 (tamu) + seluruh kunci u{id} akun
 *   CRUD Menu admin → memanggil flushTree() (MenuController)
 *
 * Insert model secara langsung TIDAK memicu flush — oleh karena itu tree
 * tetap basi sampai flushTree() dipanggil (dibuktikan test kedua).
 */
class MenuTreeCacheTest extends TestCase
{
    use RefreshDatabase;

    private function builder(): MenuBuilderService
    {
        return app(MenuBuilderService::class);
    }

    private function adminWithPermissions(array $permissions): User
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name'        => 'Tester ' . uniqid(),
            'description' => 'Role uji otomatis',
            'status'      => true,
        ]);

        foreach ($permissions as $permission) {
            $perm = Permission::firstOrCreate(
                ['name' => $permission],
                ['display_name' => $permission, 'module' => 'Menu Builder']
            );
            $role->permissions()->attach($perm->id);
        }

        $user->roles()->attach($role->id);

        return $user;
    }

    public function test_tree_disimpan_per_pengguna_dan_dibuang_oleh_flush_tree(): void
    {
        // DB belum di-seed menu → fallback default, tetap di-cache
        $fallback = $this->builder()->treeFor(null);
        $this->assertNotEmpty($fallback);
        $this->assertTrue(Cache::has('menu.tree.u0'), 'tree tamu harus masuk cache u0');
        $this->assertNull($fallback[0]['menu'], 'fallback default tidak berasal dari tabel menus');

        // Kunci terpisah per akun login
        $user = User::factory()->create();
        $this->builder()->treeFor($user);
        $this->assertTrue(Cache::has('menu.tree.u' . $user->id));

        MenuBuilderService::flushTree();

        $this->assertFalse(Cache::has('menu.tree.u0'), 'flushTree harus menghapus kunci tamu');
        $this->assertFalse(Cache::has('menu.tree.u' . $user->id), 'flushTree harus menghapus kunci tiap akun');
    }

    public function test_tree_basi_sampai_flush_dipanggil(): void
    {
        $sebelum = $this->builder()->treeFor(null);
        $jumlahFallback = count($sebelum);

        // Tulis langsung ke tabel menus (tanpa lewat controller) → tanpa flush
        Menu::create([
            'label'      => 'Berita',
            'type'       => 'route',
            'route_name' => 'berita',
            'sort_order' => 1,
            'is_active'  => true,
        ]);

        $stale = $this->builder()->treeFor(null);
        $this->assertCount($jumlahFallback, $stale, 'tree harus tetap basi selama cache belum di-flush');
        $this->assertNotSame('Berita', $stale[0]['label']);

        MenuBuilderService::flushTree();

        $sesudah = $this->builder()->treeFor(null);
        $this->assertCount(1, $sesudah);
        $this->assertSame('Berita', $sesudah[0]['label']);
        $this->assertSame(route('berita', [], false), $sesudah[0]['url']);
    }

    public function test_crud_menu_lewat_panel_admin_menghapus_cache_tree(): void
    {
        // Panasi cache dengan isi lama (fallback default)
        $this->builder()->treeFor(null);
        $this->assertTrue(Cache::has('menu.tree.u0'));

        $admin = $this->adminWithPermissions(['menus.create']);

        $this->actingAs($admin)
            ->post(route('admin.menus.store'), [
                'label'      => 'Berita',
                'type'       => 'route',
                'route_name' => 'berita',
                'sort_order' => 1,
                'is_active'  => '1',
            ])
            ->assertRedirect(route('admin.menus.index'));

        $this->assertFalse(Cache::has('menu.tree.u0'), 'MenuController::store harus memanggil flushTree()');

        $tree = $this->builder()->treeFor(null);
        $this->assertCount(1, $tree);
        $this->assertSame('Berita', $tree[0]['label']);
    }
}