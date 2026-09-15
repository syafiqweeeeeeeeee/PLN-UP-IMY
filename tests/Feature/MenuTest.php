<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    /* =========================================================
       HELPERS
       ========================================================= */

    private function adminWithPermissions(array $permissions = []): User
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name'        => 'Tester ' . uniqid(),
            'description' => 'Role uji otomatis',
            'status'      => true,
        ]);

        foreach ($permissions as $permission) {
            $perm = \App\Models\Permission::firstOrCreate(
                ['name' => $permission],
                ['display_name' => $permission, 'module' => 'Menu Management']
            );
            $role->permissions()->attach($perm->id);
        }

        $user->roles()->attach($role->id);

        return $user;
    }

    private function createMenus(): array
    {
        $parent = Menu::create([
            'label' => 'Informasi', 'type' => 'url', 'url' => '#',
            'icon' => 'fa-book-open', 'sort_order' => 1, 'is_active' => true,
        ]);
        $berita = Menu::create([
            'parent_id' => $parent->id, 'label' => 'Berita',
            'type' => 'route', 'route_name' => 'berita', 'sort_order' => 1, 'is_active' => true,
        ]);
        $halaman = Menu::create([
            'parent_id' => $parent->id, 'label' => 'Halaman Dinamis',
            'type' => 'page', 'page_id' => $this->pageId, 'sort_order' => 2, 'is_active' => true,
        ]);

        return [$parent, $berita, $halaman];
    }

    private Page $page;

    private int $pageId;

    /* =========================================================
       FALLBACK & RENDERING
       ========================================================= */

    public function test_navbar_falls_back_to_default_structure_without_menus(): void
    {
        $this->assertTrue(Schema::hasTable('menus'));

        $response = $this->get(route('home'));
        $response->assertOk();

        // Struktur navbar lama tetap tampil walau DB kosong
        $response->assertSee('Tentang Kami')
            ->assertSee('Profil Perusahaan')
            ->assertSee('Visi &amp; Misi', false)
            ->assertSee('Layanan')
            ->assertSee('Kontak');
    }

    public function test_navbar_renders_dynamic_menus_from_database(): void
    {
        [$parent, $berita, $halaman] = $this->createMenus();

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Informasi')
            ->assertSee('Berita')
            ->assertSee('Halaman Dinamis');
    }

    public function test_menu_linking_to_page_hides_when_page_not_accessible(): void
    {
        [$parent, $berita, $halaman] = $this->createMenus();

        // Halaman role_restricted TANPA role → terkunci untuk semua
        $this->page->update(['visibility' => 'role_restricted', 'status' => 'published']);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Informasi')
            ->assertSee('Berita')
            ->assertDontSee('Halaman Dinamis');

        // Halaman draft juga disembunyikan
        $this->page->update(['visibility' => 'public', 'status' => 'draft']);

        $this->get(route('home'))
            ->assertOk()
            ->assertDontSee('Halaman Dinamis');
    }

    public function test_menu_linking_to_page_shows_when_accessible(): void
    {
        [$parent, $berita, $halaman] = $this->createMenus();

        $member = $this->adminWithPermissions([]);
        $this->page->update(['visibility' => 'role_restricted', 'status' => 'published']);
        $this->page->roles()->attach($member->roles->pluck('id'));

        // Guest tidak melihat (cek dulu — actingAs persists)
        $this->get(route('home'))
            ->assertOk()
            ->assertDontSee('Halaman Dinamis');

        // Member yang punya role-nya melihat
        $this->actingAs($member)
            ->get(route('home'))
            ->assertOk()
            ->assertSee('Halaman Dinamis');
    }

    public function test_root_group_without_target_still_renders_when_children_visible(): void
    {
        // Regresi: grup root tanpa url (type=url, url kosong) membuat seluruh navbar hilang
        // karena grup tersaring. Grup dropdown seharusnya tetap tampil selama submenu-nya tampil.
        $root = Menu::create([
            'label' => 'Grup Tanpa Url', 'type' => 'url', 'url' => null,
            'sort_order' => 1, 'is_active' => true,
        ]);
        Menu::create([
            'parent_id' => $root->id, 'label' => 'Anak Grup',
            'type' => 'route', 'route_name' => 'berita', 'sort_order' => 1, 'is_active' => true,
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Grup Tanpa Url')
            ->assertSee('Anak Grup');
    }

    public function test_inactive_menu_is_hidden(): void
    {
        [$parent, $berita, $halaman] = $this->createMenus();

        $berita->update(['is_active' => false]);

        $this->get(route('home'))
            ->assertOk()
            ->assertDontSee('>Berita</a>');
    }

    public function test_menu_with_missing_route_target_is_hidden(): void
    {
        [$parent, $berita, $halaman] = $this->createMenus();

        $berita->update(['route_name' => 'route.yang.tidak.ada']);

        $this->get(route('home'))
            ->assertOk()
            ->assertDontSee('>Berita</a>');
    }

    /* =========================================================
       ADMIN CRUD
       ========================================================= */

    public function test_admin_menus_require_permission(): void
    {
        $noPermission = User::factory()->create();

        $this->actingAs($noPermission)
            ->get(route('admin.menus.index'))
            ->assertForbidden();

        $permitted = $this->adminWithPermissions(['menus.view', 'menus.create', 'menus.edit', 'menus.delete']);

        $this->actingAs($permitted)
            ->get(route('admin.menus.index'))
            ->assertOk()
            ->assertSee('Struktur Menu');
    }

    public function test_admin_create_form_renders(): void
    {
        $admin = $this->adminWithPermissions(['menus.create']);

        $this->actingAs($admin)
            ->get(route('admin.menus.create'))
            ->assertOk()
            ->assertSee('Mau mengarah ke mana?')
            ->assertSee('Tambah Menu');
    }

    public function test_admin_edit_form_renders(): void
    {
        $admin = $this->adminWithPermissions(['menus.edit']);
        [$parent, $berita, $halaman] = $this->createMenus();

        $this->actingAs($admin)
            ->get(route('admin.menus.edit', $berita))
            ->assertOk()
            ->assertSee('Berita');
    }

    public function test_admin_can_create_route_menu(): void
    {
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

        $this->assertDatabaseHas('menus', [
            'label'      => 'Berita',
            'type'       => 'route',
            'route_name' => 'berita',
            'page_id'    => null,
            'url'        => null,
        ]);
    }

    public function test_admin_can_create_page_menu(): void
    {
        $admin = $this->adminWithPermissions(['menus.create']);

        $this->actingAs($admin)
            ->post(route('admin.menus.store'), [
                'label'     => 'Halaman Khusus',
                'type'      => 'page',
                'page_id'   => $this->page->id,
                'sort_order' => 2,
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.menus.index'));

        $this->assertDatabaseHas('menus', [
            'label'   => 'Halaman Khusus',
            'type'    => 'page',
            'page_id' => $this->page->id,
        ]);
    }

    public function test_admin_can_reorder_menu(): void
    {
        $admin = $this->adminWithPermissions(['menus.edit']);
        [$parent, $berita, $halaman] = $this->createMenus();

        // Naikkan "Halaman Dinamis" (sort_order 2) ke posisi "Berita" (sort_order 1)
        $this->actingAs($admin)
            ->patch(route('admin.menus.move', $halaman), ['direction' => 'up'])
            ->assertRedirect(route('admin.menus.index'));

        $this->assertSame(1, $halaman->fresh()->sort_order);
        $this->assertSame(2, $berita->fresh()->sort_order);
    }

    public function test_icon_input_is_normalized_to_fa_prefix(): void
    {
        $admin = $this->adminWithPermissions(['menus.create']);

        $this->actingAs($admin)
            ->post(route('admin.menus.store'), [
                'label' => 'Menu Ikon',
                'type'  => 'url',
                'url'   => 'https://contoh.id',
                'icon'  => 'building',
            ])
            ->assertRedirect(route('admin.menus.index'));

        $this->assertSame('fa-building', Menu::where('label', 'Menu Ikon')->first()->icon);
    }

    public function test_admin_can_update_and_toggle_menu(): void
    {
        $admin = $this->adminWithPermissions(['menus.edit']);
        [$parent, $berita, $halaman] = $this->createMenus();

        $this->actingAs($admin)
            ->put(route('admin.menus.update', $berita), [
                'label'      => 'Berita Terbaru',
                'type'       => 'route',
                'route_name' => 'berita',
                'sort_order' => 5,
            ])
            ->assertRedirect(route('admin.menus.index'));

        $this->assertDatabaseHas('menus', ['id' => $berita->id, 'label' => 'Berita Terbaru', 'sort_order' => 5]);

        $this->actingAs($admin)
            ->patch(route('admin.menus.toggle-status', $berita))
            ->assertRedirect();

        $this->assertFalse($berita->fresh()->is_active);
    }

    public function test_admin_can_delete_menu_with_children(): void
    {
        $admin = $this->adminWithPermissions(['menus.delete']);
        [$parent, $berita, $halaman] = $this->createMenus();

        $this->actingAs($admin)
            ->delete(route('admin.menus.destroy', $parent))
            ->assertRedirect(route('admin.menus.index'));

        $this->assertDatabaseMissing('menus', ['id' => $parent->id]);
        $this->assertDatabaseMissing('menus', ['id' => $berita->id]); // anak ikut terhapus
        $this->assertDatabaseMissing('menus', ['id' => $halaman->id]);
    }

    /* =========================================================
       SETUP
       ========================================================= */

    protected function setUp(): void
    {
        parent::setUp();

        $this->page = Page::create([
            'title'      => 'Halaman Untuk Menu',
            'slug'       => 'halaman-untuk-menu',
            'status'     => 'published',
            'visibility' => 'public',
        ]);
        $this->pageId = $this->page->id;
    }
}
