<?php

namespace Tests\Feature;

use App\Models\Announcement;
use App\Models\Menu;
use App\Models\News;
use App\Models\Page;
use App\Models\Tamu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GlobalSearchTest extends TestCase
{
    use RefreshDatabase;

    private function adminUser(): User
    {
        // Administrator dengan permission view semua modul yang dicari
        // oleh global search — hasil modul tanpa permission dihapus.
        return $this->userWithPermissions([
            'users.view',
            'news.view',
            'announcements.view',
            'pages.view',
            'menus.view',
            'tamu.view',
        ], [
            'name'  => 'Admin Uji',
            'role'  => 'Administrator',
        ]);
    }

    /* =========================================================
       AKSES
       ========================================================= */

    public function test_global_search_requires_authentication(): void
    {
        $this->get(route('admin.global-search', ['q' => 'uji']))
            ->assertRedirect(route('login'));
    }

    public function test_global_search_validates_minimum_keyword(): void
    {
        $this->actingAs($this->adminUser())
            ->get(route('admin.global-search', ['q' => 'a']))
            ->assertSessionHasErrors('q');
    }

    /* =========================================================
       PENCARIAN LINTAS MODUL
       ========================================================= */

    public function test_searches_across_users_news_announcements_pages_menus_and_tamu(): void
    {
        $admin = $this->adminUser();

        // Data uji: tiap modul memuat kata kunci "spionase"
        User::create([
            'name'  => 'Petugas Spionase',
            'email' => 'spionase@example.test',
            'password' => bcrypt('secret123'),
            'role'  => 'Administrator',
            'role_id' => 1,
        ]);
        News::create([
            'title' => 'Berita Spionase Terdeteksi', 'slug' => 'berita-spionase',
            'category' => 'umum', 'excerpt' => 'e', 'content' => 'c',
            'author' => 'a', 'is_published' => true, 'published_at' => now(),
        ]);
        Announcement::create([
            'title' => 'Pengumuman Spionase', 'slug' => 'pengumuman-spionase',
            'category' => 'umum', 'excerpt' => 'e', 'content' => 'c', 'is_published' => true,
        ]);
        Page::create([
            'title' => 'Halaman Spionase', 'slug' => 'halaman-spionase',
            'status' => Page::STATUS_PUBLISHED,
        ]);
        Menu::create([
            'label' => 'Menu Spionase', 'type' => 'url', 'url' => '/x',
            'sort_order' => 1, 'is_active' => true,
        ]);
        Tamu::create([
            'nik' => '321001', 'nama' => 'Tamu Spionase', 'instansi' => 'PT Spionase',
            'no_hp' => '0812', 'email' => 'tamu@example.test',
            'tujuan_ditemui' => 'Admin', 'jumlah_tamu' => 1,
            'tanggal_kunjungan' => today(), 'keperluan' => 'konsultasi',
            'status_verifikasi' => Tamu::STATUS_MENUNGGU,
        ]);

        $response = $this->actingAs($admin)
            ->get(route('admin.global-search', ['q' => 'spionase']));

        $response->assertOk();
        $groups = $response->viewData('groups');

        $this->assertArrayHasKey('Pengguna', $groups);
        $this->assertArrayHasKey('Berita', $groups);
        $this->assertArrayHasKey('Pengumuman', $groups);
        $this->assertArrayHasKey('Halaman', $groups);
        $this->assertArrayHasKey('Menu', $groups);
        $this->assertArrayHasKey('Tamu', $groups);
    }

    public function test_group_rows_carry_action_links_to_manage_pages(): void
    {
        News::create([
            'title' => 'Berita Navbawa', 'slug' => 'berita-navbawa',
            'category' => 'umum', 'excerpt' => 'e', 'content' => 'c',
            'author' => 'a', 'is_published' => true, 'published_at' => now(),
        ]);
        $user = User::create([
            'name' => 'Petugas Navbawa', 'email' => 'navbawa@example.test',
            'password' => bcrypt('secret123'),
            'role' => 'Administrator', 'role_id' => 1,
        ]);

        $response = $this->actingAs($this->adminUser())
            ->get(route('admin.global-search', ['q' => 'navbawa']));

        $groups = $response->viewData('groups');

        $this->assertSame(
            route('admin.news.edit', News::where('slug', 'berita-navbawa')->first()),
            $groups['Berita'][0]['url']
        );
        $this->assertSame(
            route('admin.users.show', $user),
            $groups['Pengguna'][0]['url']
        );
    }

    public function test_search_hits_content_not_just_title(): void
    {
        News::create([
            'title' => 'Berita Lain', 'slug' => 'berita-lain',
            'category' => 'umum', 'excerpt' => 'e',
            'content' => 'isis konten memuat kata zebraunik',
            'author' => 'a', 'is_published' => true, 'published_at' => now(),
        ]);

        $response = $this->actingAs($this->adminUser())
            ->get(route('admin.global-search', ['q' => 'zebraunik']));

        $groups = $response->viewData('groups');
        $this->assertArrayHasKey('Berita', $groups);
        $this->assertSame('Berita Lain', $groups['Berita'][0]['title']);
    }

    /* =========================================================
       RESULT: TIDAK ADA KATA KUNCI COCOK
       ========================================================= */

    public function test_empty_result_renders_fallback_message(): void
    {
        $this->actingAs($this->adminUser())
            ->get(route('admin.global-search', ['q' => 'zzz-tidak-ada']))
            ->assertOk()
            ->assertSee('Tidak ada hasil ditemukan');
    }

    /* =========================================================
       HAK AKSES: MODUL TANPA PERMISSION DIHAPUS
       ========================================================= */

    public function test_module_without_view_permission_is_hidden(): void
    {
        // User TANPA permission tamu.view — data tamu tidak boleh bocor.
        $user = $this->userWithPermissions(['news.view'], [
            'name' => 'Admin Terbatas',
            'role' => 'Administrator',
        ]);

        Tamu::create([
            'nik' => '321002', 'nama' => 'Tamu Rahasia', 'instansi' => 'PT Rahasia',
            'no_hp' => '0812', 'email' => 't2@example.test',
            'tujuan_ditemui' => 'Admin', 'jumlah_tamu' => 1,
            'tanggal_kunjungan' => today(), 'keperluan' => 'konsultasi',
            'status_verifikasi' => Tamu::STATUS_MENUNGGU,
        ]);

        $response = $this->actingAs($user)
            ->get(route('admin.global-search', ['q' => 'rahasia']));

        $groups = $response->viewData('groups');
        $this->assertArrayNotHasKey('Tamu', $groups);
        $this->assertArrayNotHasKey('Pengguna', $groups);
    }
}
