<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\News;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopbarTest extends TestCase
{
    use RefreshDatabase;

    private function adminUser(): User
    {
        return User::factory()->create([
            'name' => 'Budi Santoso',
            'role' => 'Administrator',
        ]);
    }

    /* =========================================================
       USER MENU — data asli, bukan hardcode
       ========================================================= */

    public function test_topbar_shows_real_user_name_role_and_initials(): void
    {
        $response = $this->actingAs($this->adminUser())->get(route('admin.dashboard'));

        // Nama & role tampil; avatar memakai inisial "BS" dari nama asli
        $response->assertOk()
            ->assertSee('Budi Santoso')
            ->assertSee('Administrator')
            ->assertSee('>BS</div>', false);
    }

    public function test_topbar_no_longer_contains_hardcoded_admin_pln(): void
    {
        $response = $this->actingAs($this->adminUser())->get(route('admin.dashboard'));

        $response->assertOk()->assertDontSee('Admin PLN');
    }

    /* =========================================================
       NOTIFIKASI — dinamis dari data
       ========================================================= */

    public function test_notification_dot_hidden_when_no_unread_data(): void
    {
        $response = $this->actingAs($this->adminUser())->get(route('admin.dashboard'));

        $response->assertOk()
            ->assertDontSee('notification-dot', false)
            ->assertSee('Tidak ada notifikasi');
    }

    public function test_notification_shows_unread_permohonan_and_draft(): void
    {
        ContactMessage::create([
            'nama'     => 'Pengirim',
            'email'    => 'pengirim@example.com',
            'telepon'  => '081234567890',
            'kategori' => ContactMessage::KATEGORI_UMUM,
            'subjek'   => 'Subjek',
            'pesan'    => 'Pesan uji.',
        ]);

        News::create([
            'title' => 'Berita Draft Notif', 'slug' => 'berita-draft-notif', 'category' => 'umum',
            'excerpt' => 'e', 'content' => 'c', 'author' => 'a', 'is_published' => false,
        ]);

        $response = $this->actingAs($this->adminUser())->get(route('admin.dashboard'));

        $response->assertOk()
            ->assertSee('permohonan belum dibaca')
            ->assertSee('konten masih draft')
            ->assertSee('notification-dot', false);
    }

    /* =========================================================
       SEARCH ENDPOINT
       ========================================================= */

    public function test_search_endpoint_requires_authentication(): void
    {
        // Request JSON tanpa sesi di-authenticate → 401 (bukan redirect HTML)
        $this->getJson(route('admin.search', ['q' => 'berita']))
            ->assertStatus(401);
    }

    public function test_search_endpoint_returns_grouped_results(): void
    {
        News::create([
            'title' => 'Pemeliharaan Unit 2', 'slug' => 'pemeliharaan-unit-2', 'category' => 'teknis',
            'excerpt' => 'e', 'content' => 'c', 'author' => 'a',
            'is_published' => true, 'published_at' => now(),
        ]);

        $response = $this->actingAs($this->adminUser())
            ->getJson(route('admin.search', ['q' => 'pemeliharaan']));

        $response->assertOk();

        $data = $response->json();
        $this->assertSame('Berita', $data[0]['label']);
        $this->assertCount(1, $data[0]['items']);
        $this->assertSame('Pemeliharaan Unit 2', $data[0]['items'][0]['title']);
        $this->assertSame('Terbit', $data[0]['items'][0]['meta']);
    }

    public function test_search_endpoint_validates_minimum_query(): void
    {
        $this->actingAs($this->adminUser())
            ->getJson(route('admin.search', ['q' => 'a']))
            ->assertStatus(422);
    }

    public function test_search_endpoint_returns_empty_groups_when_no_match(): void
    {
        $this->actingAs($this->adminUser())
            ->getJson(route('admin.search', ['q' => 'zzztidakada']))
            ->assertOk()
            ->assertJsonPath('0.items', []);
    }

    /* =========================================================
       TOPBAR MARKUP
       ========================================================= */

    public function test_topbar_renders_search_notification_and_user_dropdowns(): void
    {
        $response = $this->actingAs($this->adminUser())->get(route('admin.dashboard'));

        $response->assertOk()
            ->assertSee('topbarSearchBtn', false)
            ->assertSee('notifBtn', false)
            ->assertSee('notifDropdown', false)
            ->assertSee('userDropdown', false)
            ->assertSee('Profil Saya')
            ->assertSee('Logout');
    }

    public function test_profile_menu_links_to_logged_in_user_profile(): void
    {
        $user = $this->adminUser();

        $this->actingAs($user)->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee(route('admin.users.show', $user), false);
    }
}
