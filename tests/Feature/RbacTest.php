<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * RBAC — memastikan permission benar-benar ditegakkan di route admin.
 *
 * Sebelum perbaikan ini, route berita/pengumuman/galeri/users/permohonan/roles
 * hanya dilindungi `auth` — siapa pun yang login bisa menulis meski rolenya
 * tidak punya permission. Test ini mengunci perilaku gate per aksi.
 */
class RbacTest extends TestCase
{
    use RefreshDatabase;

    /* =========================================================
       BERITA
       ========================================================= */

    public function test_user_without_permission_cannot_access_news(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.news.index'))
            ->assertForbidden();
    }

    public function test_viewer_can_read_but_not_write_news(): void
    {
        $viewer = $this->userWithPermissions(['news.view', 'dashboard.view']);

        $this->actingAs($viewer)
            ->get(route('admin.news.index'))
            ->assertOk();

        $this->actingAs($viewer)
            ->post(route('admin.news.store'), ['title' => 'X'])
            ->assertForbidden();

        $this->actingAs($viewer)
            ->delete(route('admin.news.destroy', News::create([
                'title' => 'Uji', 'slug' => 'uji', 'category' => 'umum',
                'excerpt' => 'e', 'is_published' => false,
            ])))
            ->assertForbidden();
    }

    public function test_writer_can_create_news_but_not_delete(): void
    {
        Storage::fake('public');
        $writer = $this->userWithPermissions(['news.view', 'news.create']);

        $this->actingAs($writer)
            ->post(route('admin.news.store'), [
                'title'    => 'Berita dari Writer',
                'category' => 'umum',
                'excerpt'  => 'Ringkasan.',
                'content'  => 'Isi.',
                'image'    => UploadedFile::fake()->image('berita.jpg'),
            ])
            ->assertRedirect(route('admin.news.index'));

        $this->assertDatabaseHas('news', ['title' => 'Berita dari Writer']);
    }

    /* =========================================================
       PENGUMUMAN
       ========================================================= */

    public function test_announcements_routes_are_gated(): void
    {
        $noAccess = User::factory()->create();
        $editor   = $this->userWithPermissions(['announcements.view', 'announcements.create']);

        $this->actingAs($noAccess)
            ->get(route('admin.announcements.index'))
            ->assertForbidden();

        $this->actingAs($editor)
            ->get(route('admin.announcements.index'))
            ->assertOk();

        $this->actingAs($editor)
            ->post(route('admin.announcements.store'), [
                'title'    => 'Pengumuman Uji RBAC',
                'category' => 'umum',
                'excerpt'  => 'Ringkasan.',
            ])
            ->assertRedirect(route('admin.announcements.index'));

        $this->assertDatabaseHas('announcements', ['title' => 'Pengumuman Uji RBAC']);
    }

    /* =========================================================
       GALERI
       ========================================================= */

    public function test_gallery_routes_are_gated(): void
    {
        $noAccess = User::factory()->create();
        $manager  = $this->userWithPermissions(['galleries.view']);

        $this->actingAs($noAccess)
            ->get(route('admin.galeri.index'))
            ->assertForbidden();

        $this->actingAs($manager)
            ->get(route('admin.galeri.index'))
            ->assertOk();
    }

    /* =========================================================
       PENGGUNA — show tetap terbuka (profil saya di topbar)
       ========================================================= */

    public function test_users_index_gated_but_profile_show_open(): void
    {
        $plain = User::factory()->create();
        $other = User::factory()->create(['name' => 'Teman Satu Tim']);

        // Tanpa users.view → index ditolak
        $this->actingAs($plain)
            ->get(route('admin.users.index'))
            ->assertForbidden();

        // Tapi profil sendiri (dan show user lain) tetap bisa diakses —
        // dipakai menu "Profil Saya" di topbar semua role
        $this->actingAs($plain)
            ->get(route('admin.users.show', $other))
            ->assertOk();
    }

    public function test_users_destroy_requires_users_delete_permission(): void
    {
        $editor = $this->userWithPermissions(['users.view']);
        $target = User::factory()->create();

        $this->actingAs($editor)
            ->delete(route('admin.users.destroy', $target))
            ->assertForbidden();
    }

    /* =========================================================
       ROLES
       ========================================================= */

    public function test_roles_routes_are_gated(): void
    {
        $plain = User::factory()->create();
        $admin = $this->userWithPermissions(['roles.view']);

        $this->actingAs($plain)
            ->get(route('admin.roles.index'))
            ->assertForbidden();

        $this->actingAs($admin)
            ->get(route('admin.roles.index'))
            ->assertOk();
    }

    /* =========================================================
       SIDEBAR — menu menyesuaikan permission
       ========================================================= */

    public function test_sidebar_hides_modules_without_permission(): void
    {
        $limited = $this->userWithPermissions(['dashboard.view']);

        $this->actingAs($limited)
            ->get(route('admin.dashboard'))
            ->assertOk()
            // Modul tanpa permission disembunyikan
            ->assertDontSee('Daftar Berita')
            ->assertDontSee('href="' . route('admin.users.index') . '"', false)
            // Dashboard tetap ada
            ->assertSee('Dashboard');
    }

    public function test_sidebar_shows_modules_with_permission(): void
    {
        $full = $this->userWithPermissions([
            'dashboard.view', 'news.view', 'users.view', 'galleries.view',
            'announcements.view',
        ]);

        $this->actingAs($full)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('href="' . route('admin.news.index') . '"', false)
            ->assertSee('href="' . route('admin.users.index') . '"', false)
            ->assertSee('href="' . route('admin.galeri.index') . '"', false);
    }

    /* =========================================================
       MATRIKS HAK AKSES — Direct Permission (per akun, menu Pengguna)
       Berbasis master ID Menu Sidebar × 4 aksi CRUD.
       ========================================================= */

    public function test_role_update_preserves_non_matrix_permissions(): void
    {
        $this->seed(\Database\Seeders\PermissionSeeder::class);

        $admin = $this->userWithPermissions(['roles.view', 'roles.edit']);

        $role = \App\Models\Role::create(['name' => 'PIC Konten', 'status' => true]);
        $role->permissions()->sync(
            \App\Models\Permission::whereIn('name', ['news.view', 'news.publish'])->pluck('id')->all()
        );

        $newsViewId = \App\Models\Permission::where('name', 'news.view')->value('id');

        // Simpan form Edit Role HANYA dengan centang matriks news.view —
        // news.publish (di luar matriks) tetap dipertahankan.
        $this->actingAs($admin)
            ->put(route('admin.roles.update', $role), [
                'name'        => 'PIC Konten',
                'description' => 'Uji matriks permission',
                'status'      => 'active',
                'permissions' => [$newsViewId],
            ])
            ->assertRedirect(route('admin.roles.index'));

        $this->assertTrue($role->hasPermission('news.view'));
        $this->assertTrue($role->hasPermission('news.publish'));
        $this->assertFalse($role->hasPermission('news.create'));
    }

    /* =========================================================
       ROLE TERKUNCI — 3 Role Dasar permanen
       ========================================================= */

    public function test_role_creation_is_disabled(): void
    {
        // REVISI ARSITEKTUR: pembuatan role baru dinonaktifkan — route
        // roles.create/roles.store dihapus → 404, tombol UI dikunci.
        $admin = $this->userWithPermissions(['roles.view', 'roles.create']);

        $this->actingAs($admin)
            ->get(route('admin.roles.index'))
            ->assertOk()
            // Tombol tambah DIKUNCI (disabled) — bukan lagi link <a>
            ->assertSee('btn-corp-add" disabled', false)
            ->assertDontSee('btn-corp-add" href=', false);

        // POST ke endpoint roles (create) → tidak lagi tersedia.
        $this->actingAs($admin)
            ->post(route('admin.roles.index'), ['name' => 'Role Baru'])
            ->assertStatus(405); // Method Not Allowed — route store dihapus
    }

    public function test_base_roles_cannot_be_deleted(): void
    {
        $this->seed(\Database\Seeders\PermissionSeeder::class);

        $admin = $this->userWithPermissions(['roles.view', 'roles.delete']);

        foreach (['Super Admin', 'Admin Bidang', 'Karyawan'] as $name) {
            $role = \App\Models\Role::where('name', $name)->first();

            $this->actingAs($admin)
                ->delete(route('admin.roles.destroy', $role))
                ->assertRedirect();

            $this->assertDatabaseHas('roles', ['id' => $role->id]);
        }
    }

    public function test_seeder_provides_crud_permissions_and_drops_legacy_administrator_role(): void
    {
        $this->seed(\Database\Seeders\PermissionSeeder::class);

        // REVISI AKTOR — hanya 3 role di database
        $this->assertSame(
            ['Super Admin', 'Admin Bidang', 'Karyawan'],
            \App\Models\Role::orderBy('id')->pluck('name')->all()
        );

        // Setiap ID Menu punya 4 hak akses granular CRUD
        foreach (['users', 'news', 'tamu', 'galleries', 'work_links'] as $key) {
            foreach (['view', 'create', 'edit', 'delete'] as $action) {
                $this->assertDatabaseHas('permissions', ['name' => "{$key}.{$action}"]);
            }
        }

        // Log aktivitas: aksi hapus terpisah dari lihat
        $this->assertDatabaseHas('permissions', ['name' => 'activity_logs.delete']);
    }
}
