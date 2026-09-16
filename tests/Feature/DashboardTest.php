<?php

namespace Tests\Feature;

use App\Models\Announcement;
use App\Models\ContactMessage;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    private function adminUser(): User
    {
        return User::factory()->create(['role' => 'Administrator']);
    }

    public function test_dashboard_requires_authentication(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
    }

    public function test_dashboard_shows_real_stats_from_database(): void
    {
        // 2 berita: 1 terbit, 1 draft
        News::create([
            'title' => 'Berita Terbit Uji', 'slug' => 'berita-terbit-uji', 'category' => 'umum',
            'excerpt' => 'e', 'content' => 'c', 'author' => 'a',
            'is_published' => true, 'published_at' => now(),
        ]);
        News::create([
            'title' => 'Berita Draft Uji', 'slug' => 'berita-draft-uji', 'category' => 'umum',
            'excerpt' => 'e', 'content' => 'c', 'author' => 'a', 'is_published' => false,
        ]);

        // 1 pengumuman draft
        Announcement::create([
            'title' => 'Pengumuman Draft Uji', 'slug' => 'pengumuman-draft-uji', 'category' => 'umum',
            'excerpt' => 'e', 'content' => 'c', 'is_published' => false,
        ]);

        // 1 halaman terbit
        Page::create(['title' => 'Halaman Uji', 'slug' => 'halaman-uji', 'status' => Page::STATUS_PUBLISHED]);

        $admin = $this->adminUser();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertOk();

        $stats = $response->viewData('stats');
        $this->assertSame(1, $stats['total_users']);
        $this->assertSame(1, $stats['total_pages']);
        $this->assertSame(1, $stats['total_news']);
        // Draft gabungan: 1 berita + 1 pengumuman + 0 halaman
        $this->assertSame(2, $stats['pending_content']);
    }

    public function test_dashboard_lists_mixed_latest_content_without_placeholders(): void
    {
        News::create([
            'title' => 'Berita Campur Uji', 'slug' => 'berita-campur-uji', 'category' => 'umum',
            'excerpt' => 'e', 'content' => 'c', 'author' => 'a',
            'is_published' => true, 'published_at' => now(),
        ]);
        Page::create([
            'title' => 'Halaman Campur Uji', 'slug' => 'halaman-campur-uji',
            'status' => Page::STATUS_DRAFT,
        ]);

        $response = $this->actingAs($this->adminUser())->get(route('admin.dashboard'));

        $response->assertOk()
            ->assertSee('Berita Campur Uji')
            ->assertSee('Halaman Campur Uji');

        $latest = $response->viewData('latest_content');
        $this->assertNotEmpty($latest);

        // Semua baris berasal dari DB — tidak ada placeholder statis lama
        foreach ($latest as $item) {
            $this->assertContains($item['title'], ['Berita Campur Uji', 'Halaman Campur Uji']);
        }
    }

    public function test_dashboard_notifications_reflect_unread_permohonan(): void
    {
        ContactMessage::create([
            'nama'    => 'Pengirim Uji',
            'email'   => 'pengirim@example.com',
            'telepon' => '081234567890',
            'kategori' => ContactMessage::KATEGORI_UMUM,
            'subjek'  => 'Subjek Uji',
            'pesan'   => 'Isi pesan uji notifikasi.',
        ]);

        $response = $this->actingAs($this->adminUser())->get(route('admin.dashboard'));

        $response->assertOk()
            ->assertSee('permohonan belum dibaca');
    }

    public function test_dashboard_shows_storage_summary_when_disk_readable(): void
    {
        $response = $this->actingAs($this->adminUser())->get(route('admin.dashboard'));

        $response->assertOk();

        $storage = $response->viewData('storage');

        // Di lingkungan test lokal, disk harus terbaca; bila tidak, view
        // harus membiarkan blok storage tersembunyi (null).
        if ($storage !== null) {
            $this->assertArrayHasKey('percent', $storage);
            $this->assertArrayHasKey('used', $storage);
            $this->assertArrayHasKey('total', $storage);
            $this->assertGreaterThanOrEqual(0, $storage['percent']);
            $this->assertLessThanOrEqual(100, $storage['percent']);
        } else {
            $response->assertDontSee('Storage Usage');
        }
    }

    public function test_dashboard_system_status_includes_database_check(): void
    {
        $response = $this->actingAs($this->adminUser())->get(route('admin.dashboard'));

        $response->assertOk();

        $systemStatus = $response->viewData('system_status');
        $names = array_column($systemStatus, 'name');

        $this->assertContains('Database', $names);
        $this->assertContains('Application', $names);
        $this->assertContains('Storage', $names);

        // Database terhubung saat test → status Normal
        $db = $systemStatus[0];
        $this->assertSame('Database', $db['name']);
        $this->assertSame('Normal', $db['status']);
    }
}
