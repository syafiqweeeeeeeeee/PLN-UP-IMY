<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
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
       PERMOHONAN
       ========================================================= */

    public function test_contact_messages_status_update_is_gated(): void
    {
        $message = ContactMessage::create([
            'nama' => 'Pengirim', 'email' => 'p@example.com', 'telepon' => '081234567890',
            'kategori' => 'pertanyaan_umum', 'subjek' => 'Uji Gate', 'pesan' => 'Isi pesan.',
        ]);

        $viewerOnly = $this->userWithPermissions(['contact_messages.view']);
        $updater    = $this->userWithPermissions(['contact_messages.update']);

        // Boleh lihat...
        $this->actingAs($viewerOnly)
            ->get(route('admin.contact-messages.index'))
            ->assertOk();

        // ...tapi tidak boleh ubah status
        $this->actingAs($viewerOnly)
            ->post(route('admin.contact-messages.update-status', $message), ['status' => 'selesai'])
            ->assertForbidden();

        // Yang punya permission update boleh
        $this->actingAs($updater)
            ->postJson(route('admin.contact-messages.update-status', $message), ['status' => 'selesai'])
            ->assertOk();
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
            'announcements.view', 'contact_messages.view',
        ]);

        $this->actingAs($full)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('href="' . route('admin.news.index') . '"', false)
            ->assertSee('href="' . route('admin.users.index') . '"', false)
            ->assertSee('href="' . route('admin.galeri.index') . '"', false);
    }
}
