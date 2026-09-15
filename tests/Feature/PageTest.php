<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageTest extends TestCase
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
                ['display_name' => $permission, 'module' => 'Page Management']
            );
            $role->permissions()->attach($perm->id);
        }

        $user->roles()->attach($role->id);

        return $user;
    }

    /* =========================================================
       VISIBILITAS PUBLIK
       ========================================================= */

    public function test_guest_can_view_published_public_page(): void
    {
        $page = Page::create([
            'title'      => 'Profil Perusahaan Baru',
            'slug'       => 'profil-perusahaan-baru',
            'status'     => 'published',
            'visibility' => 'public',
        ]);

        PageSection::create([
            'page_id'    => $page->id,
            'type'       => 'text',
            'data'       => ['heading' => 'Sekilas', 'body' => 'Konten dinamis uji coba.'],
            'sort_order' => 1,
        ]);

        $this->get(route('pages.show', $page))
            ->assertOk()
            ->assertSee('Profil Perusahaan Baru')
            ->assertSee('Konten dinamis uji coba.');
    }

    public function test_draft_page_returns_404_for_guest_and_user(): void
    {
        $page = Page::create([
            'title'      => 'Halaman Draft',
            'slug'       => 'halaman-draft',
            'status'     => 'draft',
            'visibility' => 'public',
        ]);

        $this->get(route('pages.show', $page))->assertNotFound();

        $viewer = $this->adminWithPermissions(['pages.view']);
        $this->actingAs($viewer)->get(route('pages.show', $page))->assertNotFound();
    }

    public function test_role_restricted_page_hidden_from_guest(): void
    {
        $page = Page::create([
            'title'      => 'Data Internal SDM',
            'slug'       => 'data-internal-sdm',
            'status'     => 'published',
            'visibility' => 'role_restricted',
        ]);
        $page->roles()->attach(Role::create(['name' => 'Karyawan ' . uniqid(), 'status' => true]));

        $this->get(route('pages.show', $page))->assertNotFound();

        // Iklan-iklan index juga tidak boleh menampilkannya ke guest
        $this->get(route('pages.index'))->assertDontSee('Data Internal SDM');
    }

    public function test_role_restricted_page_accessible_to_member(): void
    {
        $user = $this->adminWithPermissions([]); // role "Tester ..." lewat pivot

        $page = Page::create([
            'title'      => 'Portal Karyawan',
            'slug'       => 'portal-karyawan',
            'status'     => 'published',
            'visibility' => 'role_restricted',
        ]);
        $page->roles()->attach($user->roles->pluck('id'));

        $this->actingAs($user)
            ->get(route('pages.show', $page))
            ->assertOk()
            ->assertSee('Portal Karyawan');
    }

    public function test_role_restricted_page_404_for_other_user(): void
    {
        $outsider = $this->adminWithPermissions([]);
        $holder   = $this->adminWithPermissions([]);

        $page = Page::create([
            'title'      => 'Dewan Direksi',
            'slug'       => 'dewan-direksi',
            'status'     => 'published',
            'visibility' => 'role_restricted',
        ]);
        $page->roles()->attach($holder->roles->pluck('id'));

        $this->actingAs($outsider)
            ->get(route('pages.show', $page))
            ->assertNotFound();
    }

    public function test_public_page_renders_all_section_types(): void
    {
        $page = Page::create([
            'title' => 'Halaman Semua Section', 'slug' => 'halaman-semua-section',
            'status' => 'published', 'visibility' => 'public',
        ]);

        foreach ([
            ['type' => 'banner', 'data' => ['heading' => 'Banner Uji', 'subheading' => 'Sub banner', 'button_text' => 'Klik', 'button_url' => '/halaman'], 'sort_order' => 1],
            ['type' => 'text',   'data' => ['heading' => 'Teks Uji', 'body' => "Paragraf satu.\n\nParagraf dua."], 'sort_order' => 2],
            ['type' => 'cards',  'data' => ['heading' => 'Kartu Uji', 'items' => [['title' => 'Kartu A', 'description' => 'Desk A', 'url' => ''], ['title' => 'Kartu B', 'description' => 'Desk B', 'url' => '/halaman']]], 'sort_order' => 3],
            ['type' => 'file',   'data' => ['heading' => 'File Uji', 'items' => [['title' => 'Laporan.pdf', 'description' => 'Dokumen uji', 'url' => '/storage/laporan.pdf']]], 'sort_order' => 4],
            ['type' => 'faq',    'data' => ['heading' => 'FAQ Uji', 'items' => [['question' => 'Q1?', 'answer' => 'J1.']]], 'sort_order' => 5],
        ] as $section) {
            PageSection::create(['page_id' => $page->id] + $section);
        }

        $this->get(route('pages.show', $page))
            ->assertOk()
            ->assertSee('Banner Uji')
            ->assertSee('Teks Uji')
            ->assertSee('Paragraf dua.')
            ->assertSee('Kartu A')
            ->assertSee('Laporan.pdf')
            ->assertSee('Q1?');
    }

    public function test_role_restricted_page_without_roles_is_locked_for_everyone(): void
    {
        $user = $this->adminWithPermissions([]);

        $page = Page::create([
            'title'      => 'Lemari Arsip',
            'slug'       => 'lemari-arsip',
            'status'     => 'published',
            'visibility' => 'role_restricted',
            // tidak ada role dipilih
        ]);

        $this->get(route('pages.show', $page))->assertNotFound();
        $this->actingAs($user)->get(route('pages.show', $page))->assertNotFound();
    }

    /* =========================================================
       DAFTAR HALAMAN (INDEX)
       ========================================================= */

    public function test_page_index_lists_only_accessible_published_pages(): void
    {
        $member = $this->adminWithPermissions([]);
        $role   = $member->roles->first();

        $publicPage = Page::create([
            'title'  => 'Halaman Publik A', 'slug' => 'halaman-publik-a',
            'status' => 'published', 'visibility' => 'public',
        ]);
        $internalPage = Page::create([
            'title'  => 'Halaman Internal B', 'slug' => 'halaman-internal-b',
            'status' => 'published', 'visibility' => 'role_restricted',
        ]);
        $internalPage->roles()->attach($role);
        $draftPage = Page::create([
            'title'  => 'Halaman Draft C', 'slug' => 'halaman-draft-c',
            'status' => 'draft', 'visibility' => 'public',
        ]);

        $this->get(route('pages.index'))
            ->assertOk()
            ->assertSee('Halaman Publik A')
            ->assertDontSee('Halaman Internal B')
            ->assertDontSee('Halaman Draft C');

        $this->actingAs($member)
            ->get(route('pages.index'))
            ->assertOk()
            ->assertSee('Halaman Publik A')
            ->assertSee('Halaman Internal B')
            ->assertDontSee('Halaman Draft C');
    }

    /* =========================================================
       ADMIN CRUD
       ========================================================= */

    public function test_admin_pages_require_permission(): void
    {
        $noPermission = User::factory()->create(); // tanpa role/permission

        $this->actingAs($noPermission)
            ->get(route('admin.pages.index'))
            ->assertForbidden();

        $permitted = $this->adminWithPermissions(['pages.view', 'pages.create', 'pages.edit', 'pages.delete']);

        $this->actingAs($permitted)
            ->get(route('admin.pages.index'))
            ->assertOk()
            ->assertSee('Daftar Halaman');
    }

    public function test_admin_create_form_renders(): void
    {
        // Regresi: form create pernah 500 karena $page->roles dibaca saat $page masih null
        $admin = $this->adminWithPermissions(['pages.create']);

        $this->actingAs($admin)
            ->get(route('admin.pages.create'))
            ->assertOk()
            ->assertSee('Tambah Halaman')
            ->assertSee('Visibilitas');
    }

    public function test_admin_can_create_page(): void
    {
        $admin = $this->adminWithPermissions(['pages.create', 'pages.edit']);

        $response = $this->actingAs($admin)->post(route('admin.pages.store'), [
            'title'        => 'Struktur Organisasi 2026',
            'status'       => 'published',
            'visibility'   => 'public',
            'show_in_list' => '1',
        ]);

        $response->assertRedirect(route('admin.pages.edit', Page::where('slug', 'struktur-organisasi-2026')->first()));

        $this->assertDatabaseHas('pages', [
            'slug'       => 'struktur-organisasi-2026',
            'status'     => 'published',
            'created_by' => $admin->id,
        ]);
    }

    public function test_admin_edit_form_renders_with_sections(): void
    {
        $admin = $this->adminWithPermissions(['pages.edit']);
        $page  = Page::create(['title' => 'Halaman Edit Render', 'slug' => 'halaman-edit-render', 'status' => 'published']);

        PageSection::create(['page_id' => $page->id, 'type' => 'text', 'data' => ['heading' => 'Judul Ada'], 'sort_order' => 1]);

        $this->actingAs($admin)
            ->get(route('admin.pages.edit', $page))
            ->assertOk()
            ->assertSee('Konten Halaman (Sections)')
            ->assertSee('Judul Ada');
    }

    public function test_admin_can_add_and_update_section(): void
    {
        $admin   = $this->adminWithPermissions(['pages.edit']);
        $page    = Page::create(['title' => 'Halaman Section', 'slug' => 'halaman-section', 'status' => 'published']);

        $this->actingAs($admin)
            ->post(route('admin.pages.sections.store', $page), ['type' => 'text'])
            ->assertRedirect();

        $section = $page->sections()->first();
        $this->assertNotNull($section);

        $this->actingAs($admin)
            ->put(route('admin.pages.sections.update', [$page, $section]), [
                'heading' => 'Judul Section',
                'body'    => 'Isi konten section.',
            ])
            ->assertRedirect();

        $fresh = $section->fresh();
        $this->assertSame('Judul Section', $fresh->data['heading']);
        $this->assertSame('Isi konten section.', $fresh->data['body']);
    }

    public function test_admin_can_move_section_order(): void
    {
        $admin = $this->adminWithPermissions(['pages.edit']);
        $page  = Page::create(['title' => 'Halaman Urutan', 'slug' => 'halaman-urutan', 'status' => 'published']);

        $first  = PageSection::create(['page_id' => $page->id, 'type' => 'text', 'data' => [], 'sort_order' => 1]);
        $second = PageSection::create(['page_id' => $page->id, 'type' => 'text', 'data' => [], 'sort_order' => 2]);

        $this->actingAs($admin)
            ->post(route('admin.pages.sections.move', [$page, $second]), ['direction' => 'up'])
            ->assertRedirect();

        $this->assertSame(1, $second->fresh()->sort_order);
        $this->assertSame(2, $first->fresh()->sort_order);
    }

    public function test_admin_can_delete_page_and_sections_cascade(): void
    {
        $admin = $this->adminWithPermissions(['pages.delete']);
        $page  = Page::create(['title' => 'Halaman Dihapus', 'slug' => 'halaman-dihapus', 'status' => 'draft']);
        PageSection::create(['page_id' => $page->id, 'type' => 'text', 'data' => [], 'sort_order' => 1]);

        $this->actingAs($admin)
            ->delete(route('admin.pages.destroy', $page))
            ->assertRedirect(route('admin.pages.index'));

        $this->assertDatabaseMissing('pages', ['id' => $page->id]);
        $this->assertDatabaseMissing('page_sections', ['page_id' => $page->id]);
    }

    /* =========================================================
       ACTIVITY LOG
       ========================================================= */

    public function test_page_actions_are_logged(): void
    {
        $admin = $this->adminWithPermissions(['pages.create', 'pages.edit']);

        $this->actingAs($admin)->post(route('admin.pages.store'), [
            'title'      => 'Halaman Terlog',
            'status'     => 'draft',
            'visibility' => 'public',
        ]);

        $this->assertTrue(
            ActivityLog::where('module', 'halaman')
                ->where('action', 'create')
                ->where('description', 'like', '%Halaman Terlog%')
                ->exists()
        );
    }
}
