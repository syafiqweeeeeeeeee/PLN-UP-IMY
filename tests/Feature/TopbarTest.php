<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
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
        // Administrator: punya permission view semua modul —
        // pencarian topbar hanya menampilkan modul yang diizinkan.
        return $this->userWithPermissions([
            'news.view',
            'announcements.view',
            'pages.view',
            'galleries.view',
            'users.view',
            'menus.view',
            'roles.view',
            'contact_messages.view',
            'activity_logs.view',
        ], [
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

    public function test_search_skips_modules_without_view_permission(): void
    {
        News::create([
            'title' => 'Berita Rahasia', 'slug' => 'berita-rahasia', 'category' => 'umum',
            'excerpt' => 'e', 'content' => 'c', 'author' => 'a', 'is_published' => true,
        ]);

        // User tanpa permission news.view tidak boleh menemukan berita
        $user = $this->userWithPermissions(['activity_logs.view'], ['name' => 'Karyawan Uji']);

        $data = $this->actingAs($user)
            ->getJson(route('admin.search', ['q' => 'Rahasia']))
            ->assertOk()
            ->json();

        $berita = collect($data)->firstWhere('label', 'Berita');
        $this->assertNotNull($berita);
        $this->assertCount(0, $berita['items']);
    }

    /* =========================================================
       SEARCH LOG AKTIVITAS BERDASARKAN WAKTU
       ========================================================= */

    private function logItems(array $data): array
    {
        return collect($data)->firstWhere('label', 'Log Aktivitas')['items'] ?? [];
    }

    /**
     * Buat log dengan timestamp custom. created_at TIDAK fillable di
     * model (dengan sengaja), jadi di-set via assignment langsung.
     */
    private function createLog(array $attributes, $at = null): ActivityLog
    {
        $log = ActivityLog::create($attributes);

        if ($at !== null) {
            $log->created_at = $at;
            $log->save();
        }

        return $log;
    }

    public function test_search_logs_by_hari_ini(): void
    {
        $this->createLog([
            'user_name' => 'Budi', 'module' => 'berita', 'action' => 'create',
            'description' => 'membuat berita "Hari Ini"',
        ], now());
        $this->createLog([
            'user_name' => 'Budi', 'module' => 'berita', 'action' => 'delete',
            'description' => 'menghapus berita lama',
        ], now()->subDays(5));

        $items = $this->logItems(
            $this->actingAs($this->adminUser())
                ->getJson(route('admin.search', ['q' => 'hari ini']))
                ->assertOk()
                ->json()
        );

        $this->assertCount(1, $items);
        $this->assertStringContainsString('Hari Ini', $items[0]['title']);
    }

    public function test_search_logs_by_kemarin(): void
    {
        $this->createLog([
            'user_name' => 'Budi', 'module' => 'autentikasi', 'action' => 'login',
            'description' => 'login ke dashboard',
        ], now()->subDay()->setTime(9, 15));

        $items = $this->logItems(
            $this->actingAs($this->adminUser())
                ->getJson(route('admin.search', ['q' => 'kemarin']))
                ->assertOk()
                ->json()
        );

        $this->assertCount(1, $items);
        $this->assertSame('login ke dashboard', $items[0]['title']);
    }

    public function test_search_logs_by_tanggal_absolut(): void
    {
        $tgl = now()->subDays(3)->startOfDay();

        $this->createLog([
            'user_name' => 'Budi', 'module' => 'galeri', 'action' => 'create',
            'description' => 'unggah foto proses',
        ], $tgl->copy()->setTime(10, 0));

        // "17 sep" style — hari + nama bulan (3 hari lalu, tahun ini)
        $q = $tgl->translatedFormat('j F');

        $items = $this->logItems(
            $this->actingAs($this->adminUser())
                ->getJson(route('admin.search', ['q' => $q]))
                ->assertOk()
                ->json()
        );

        $this->assertCount(1, $items);
        $this->assertSame('unggah foto proses', $items[0]['title']);
    }

    public function test_search_logs_by_jam_menit(): void
    {
        // startOfMinute: whereTime jam:menit persis (abaikan mikrodetik)
        $t = now()->subHours(2)->startOfMinute();

        $this->createLog([
            'user_name' => 'Budi', 'module' => 'autentikasi', 'action' => 'login',
            'description' => 'login ke dashboard',
        ], $t);

        // Jam:menit persis dari log di atas (2 jam lalu, masih 7 hari terakhir)
        $q = $t->format('H:i');

        $items = $this->logItems(
            $this->actingAs($this->adminUser())
                ->getJson(route('admin.search', ['q' => $q]))
                ->assertOk()
                ->json()
        );

        $this->assertCount(1, $items);
        $this->assertSame('login ke dashboard', $items[0]['title']);
        // Meta kini tanggal+jam lengkap (bukan diffForHumans)
        $this->assertMatchesRegularExpression('/\d{2} \w{3} \d{4} \d{2}:\d{2}/', $items[0]['meta']);
    }

    public function test_search_logs_by_jam_terakhir(): void
    {
        $this->createLog([
            'user_name' => 'Budi', 'module' => 'berita', 'action' => 'update',
            'description' => 'mengubah berita pemeliharaan',
        ], now()->subMinutes(30));
        $this->createLog([
            'user_name' => 'Budi', 'module' => 'berita', 'action' => 'create',
            'description' => 'membuat berita lama',
        ], now()->subHours(5));

        $items = $this->logItems(
            $this->actingAs($this->adminUser())
                ->getJson(route('admin.search', ['q' => '2 jam terakhir']))
                ->assertOk()
                ->json()
        );

        $this->assertCount(1, $items);
        $this->assertStringContainsString('pemeliharaan', $items[0]['title']);
    }

    public function test_search_logs_kombinasi_teks_dan_waktu(): void
    {
        $this->createLog([
            'user_name' => 'Budi', 'module' => 'autentikasi', 'action' => 'login',
            'description' => 'login ke dashboard',
        ], now());
        $this->createLog([
            'user_name' => 'Siti', 'module' => 'berita', 'action' => 'create',
            'description' => 'login gagal percobaan',
        ], now()->subDay()->setTime(8, 30));

        // Teks "login" + waktu "kemarin" — hanya log kemarin yang cocok
        $items = $this->logItems(
            $this->actingAs($this->adminUser())
                ->getJson(route('admin.search', ['q' => 'login kemarin']))
                ->assertOk()
                ->json()
        );

        $this->assertCount(1, $items);
        $this->assertStringContainsString('gagal', $items[0]['title']);
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
