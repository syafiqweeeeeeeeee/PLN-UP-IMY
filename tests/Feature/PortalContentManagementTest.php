<?php

namespace Tests\Feature;

use App\Models\Announcement;
use App\Models\News;
use App\Models\WorkLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Manajemen Konten Portal Karyawan:
 *
 * 1. Target Publikasi Berita & Pengumuman ('public' | 'portal' | 'all'):
 *    - Portal Karyawan hanya menampilkan 'portal' + 'all'.
 *    - Landing page publik hanya menampilkan 'public' + 'all'.
 *
 * 2. Manajemen Link Kerja (tabel work_links):
 *    - CRUD dari Panel Admin (gated permission work_links.*).
 *    - Portal Karyawan membaca link dari tabel; 'umum' tampil untuk
 *      semua, 'khusus' ter-filter bidang/sub-bidang user.
 */
class PortalContentManagementTest extends TestCase
{
    use RefreshDatabase;

    private function adminUser(): \App\Models\User
    {
        return $this->userWithPermissions([
            'news.view', 'news.create', 'news.edit',
            'announcements.view', 'announcements.create', 'announcements.edit',
            'work_links.view', 'work_links.create', 'work_links.edit', 'work_links.delete',
        ], ['role' => 'Administrator']);
    }

    private function karyawanUser(array $attributes = []): \App\Models\User
    {
        $role = \App\Models\Role::firstOrCreate(
            ['name' => 'Karyawan'],
            ['description' => 'Pengguna internal / karyawan', 'status' => true]
        );

        $user = \App\Models\User::factory()->create(array_merge([
            'role' => 'Karyawan',
        ], $attributes));

        $user->role_id = $role->id;
        $user->save();
        $user->roles()->sync([$role->id]);

        return $user;
    }

    /* =========================================================
       1. TARGET PUBLIKASI — QUERY PORTAL & PUBLIK
       ========================================================= */

    public function test_portal_only_shows_portal_and_all_news(): void
    {
        News::create([
            'title' => 'Berita Publik', 'slug' => 'berita-publik', 'category' => 'umum',
            'excerpt' => 'e', 'target_publication' => 'public',
            'is_published' => true, 'published_at' => now(),
        ]);
        News::create([
            'title' => 'Berita Portal', 'slug' => 'berita-portal', 'category' => 'umum',
            'excerpt' => 'e', 'target_publication' => 'portal',
            'is_published' => true, 'published_at' => now(),
        ]);
        News::create([
            'title' => 'Berita Semua', 'slug' => 'berita-semua', 'category' => 'umum',
            'excerpt' => 'e', 'target_publication' => 'all',
            'is_published' => true, 'published_at' => now(),
        ]);

        $user = $this->karyawanUser();

        $this->actingAs($user)->get(route('karyawan.informasi'))
            ->assertOk()
            ->assertSee('Berita Portal')
            ->assertSee('Berita Semua')
            ->assertDontSee('Berita Publik');

        // Detail berita target 'public' tidak boleh diakses via portal.
        $this->actingAs($user)
            ->get(route('karyawan.informasi.detail', ['type' => 'berita', 'slug' => 'berita-publik']))
            ->assertNotFound();
    }

    public function test_public_site_only_shows_public_and_all_announcements(): void
    {
        Announcement::create([
            'title' => 'Pengumuman Publik', 'slug' => 'pengumuman-publik', 'category' => 'umum',
            'excerpt' => 'e', 'target_publication' => 'public',
            'is_published' => true, 'published_at' => now(),
        ]);
        Announcement::create([
            'title' => 'Pengumuman Portal', 'slug' => 'pengumuman-portal', 'category' => 'umum',
            'excerpt' => 'e', 'target_publication' => 'portal',
            'is_published' => true, 'published_at' => now(),
        ]);
        Announcement::create([
            'title' => 'Pengumuman Semua', 'slug' => 'pengumuman-semua', 'category' => 'umum',
            'excerpt' => 'e', 'target_publication' => 'all',
            'is_published' => true, 'published_at' => now(),
        ]);

        $this->get(route('pengumuman'))
            ->assertOk()
            ->assertSee('Pengumuman Publik')
            ->assertSee('Pengumuman Semua')
            ->assertDontSee('Pengumuman Portal');

        // Detail target 'portal' tidak boleh diakses dari halaman publik.
        $this->get(route('pengumuman.detail', 'pengumuman-portal'))
            ->assertNotFound();
    }

    public function test_news_and_announcement_forms_show_target_publication_field(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)->get(route('admin.news.create'))
            ->assertOk()
            ->assertSee('Target Publikasi')
            ->assertSee('Publik Utama')
            ->assertSee('Portal Karyawan')
            ->assertSee('Semua (Publik & Portal)', false)
            // Default terpilih: 'all'
            ->assertSee('id="target-all" checked', false);

        $this->actingAs($admin)->get(route('admin.announcements.create'))
            ->assertOk()
            ->assertSee('Target Publikasi')
            ->assertSee('Publik Utama');
    }

    public function test_admin_can_store_news_with_target_publication(): void
    {
        \Illuminate\Support\Facades\Storage::fake('public');

        $admin = $this->adminUser();

        $this->actingAs($admin)->post(route('admin.news.store'), [
            'title' => 'Berita Target Portal',
            'category' => 'umum',
            'target_publication' => 'portal',
            'excerpt' => 'Ringkasan berita.',
            'image' => \Illuminate\Http\Testing\File::image('berita.png'),
            'is_published' => '1',
        ])->assertRedirect(route('admin.news.index'));

        $this->assertDatabaseHas('news', [
            'title' => 'Berita Target Portal',
            'target_publication' => 'portal',
        ]);
    }

    /* =========================================================
       2. MANAJEMEN LINK KERJA — CRUD ADMIN
       ========================================================= */

    public function test_work_links_index_requires_permission(): void
    {
        $this->actingAs($this->userWithPermissions(['dashboard.view']))
            ->get(route('admin.work-links.index'))
            ->assertForbidden();

        $this->actingAs($this->adminUser())
            ->get(route('admin.work-links.index'))
            ->assertOk()
            ->assertSee('Manajemen Link Kerja');
    }

    public function test_admin_can_create_umum_and_khusus_work_links(): void
    {
        $admin = $this->adminUser();

        // Link Umum: department dikosongkan otomatis.
        $this->actingAs($admin)->post(route('admin.work-links.store'), [
            'title' => 'Aplikasi Umum Uji',
            'url' => 'aplikasi-uji.pln.co.id', // tanpa skema → auto https
            'description' => 'Deskripsi singkat.',
            'icon' => 'fa-envelope',
            'category' => 'umum',
            'is_active' => '1',
        ])->assertRedirect(route('admin.work-links.index'));

        $this->assertDatabaseHas('work_links', [
            'title' => 'Aplikasi Umum Uji',
            'category' => 'umum',
            'url' => 'https://aplikasi-uji.pln.co.id',
            'department' => null,
        ]);

        // Link Khusus: bidang + sub-bidang target.
        $this->actingAs($admin)->post(route('admin.work-links.store'), [
            'title' => 'Aplikasi Prod A Uji',
            'url' => 'https://proda.pln-np.co.id',
            'icon' => 'fa-gauge-high',
            'category' => 'khusus',
            'department' => 'operasi',
            'sub_department' => 'asmen_prod_a',
            'is_active' => '1',
        ])->assertRedirect(route('admin.work-links.index'));

        $this->assertDatabaseHas('work_links', [
            'title' => 'Aplikasi Prod A Uji',
            'category' => 'khusus',
            'department' => 'operasi',
            'sub_department' => 'asmen_prod_a',
        ]);
    }

    public function test_work_link_validation_rejects_bad_category_and_sub_department(): void
    {
        $admin = $this->adminUser();

        // Kategori di luar umum/khusus.
        $this->actingAs($admin)->post(route('admin.work-links.store'), [
            'title' => 'Salah Kategori',
            'url' => 'https://contoh.co.id',
            'category' => 'rahasia',
        ])->assertSessionHasErrors('category');

        // Sub-bidang tidak termasuk bidang yang dipilih → dinormalisasi null.
        $this->actingAs($admin)->post(route('admin.work-links.store'), [
            'title' => 'Sub Bidang Salah',
            'url' => 'https://contoh.co.id',
            'category' => 'khusus',
            'department' => 'pemeliharaan',
            'sub_department' => 'asmen_prod_a', // milik operasi, bukan pemeliharaan
        ])->assertRedirect(route('admin.work-links.index'));

        $this->assertDatabaseHas('work_links', [
            'title' => 'Sub Bidang Salah',
            'sub_department' => null,
        ]);
    }

    public function test_work_link_toggle_status_and_delete(): void
    {
        $admin = $this->adminUser();

        $link = WorkLink::create([
            'title' => 'Link Toggle Uji',
            'url' => 'https://toggle.pln.co.id',
            'category' => 'umum',
            'is_active' => true,
        ]);

        $this->actingAs($admin)
            ->patch(route('admin.work-links.toggle-status', $link))
            ->assertRedirect();

        $this->assertFalse($link->fresh()->is_active);

        $this->actingAs($admin)
            ->delete(route('admin.work-links.destroy', $link))
            ->assertRedirect(route('admin.work-links.index'));

        $this->assertDatabaseMissing('work_links', ['id' => $link->id]);
    }

    public function test_work_link_edit_form_shows_dynamic_target_fields(): void
    {
        $link = WorkLink::create([
            'title' => 'Link Edit Uji',
            'url' => 'https://edit.pln-np.co.id',
            'category' => 'khusus',
            'department' => 'operasi',
            'sub_department' => 'spv_chcb_a',
            'is_active' => true,
        ]);

        $this->actingAs($this->adminUser())
            ->get(route('admin.work-links.edit', $link))
            ->assertOk()
            ->assertSee('Bidang Utama')
            ->assertSee('Sub-Bidang')
            // Bidang terpilih di-render server; sub-bidang via JS (JSON data)
            ->assertSee('value="operasi" selected', false)
            ->assertSee('"spv_chcb_a"', false)
            ->assertSee('Select Icon');
    }

    /* =========================================================
       3. PORTAL KARYAWAN MEMBACA TABEL WORK_LINKS
       ========================================================= */

    public function test_portal_reads_work_links_from_database(): void
    {
        // DB kosong (RefreshDatabase) → fallback array statis.
        $this->assertCount(15, \App\Services\PortalContentService::workLinks());

        // Seed 1 link umum + 1 khusus via tabel.
        WorkLink::create([
            'title' => 'Link DB Umum',
            'url' => 'https://db-umum.pln.co.id',
            'category' => 'umum',
            'is_active' => true,
        ]);
        WorkLink::create([
            'title' => 'Link DB Khusus Prod A',
            'url' => 'https://db-proda.pln-np.co.id',
            'category' => 'khusus',
            'department' => 'operasi',
            'sub_department' => 'asmen_prod_a',
            'is_active' => true,
        ]);
        // Link nonaktif tidak boleh muncul.
        WorkLink::create([
            'title' => 'Link Nonaktif Uji',
            'url' => 'https://mati.pln.co.id',
            'category' => 'umum',
            'is_active' => false,
        ]);

        // Staf Prod A: melihat link DB umum + khusus bagian sendiri.
        $links = \App\Services\PortalContentService::workLinksFor(
            $this->karyawanUser([
                'level_jabatan' => 'staf_spv',
                'department' => 'operasi',
                'sub_department' => 'asmen_prod_a',
            ])
        );

        $names = collect($links)->pluck('name')->all();

        $this->assertNotContains('Link Nonaktif Uji', $names);
        $this->assertNotContains('SCADA Monitoring', $names); // fallback statis tidak dipakai saat DB terisi
        $this->assertContains('Link DB Umum', $names);
        $this->assertContains('Link DB Khusus Prod A', $names);
    }

    public function test_seeded_work_links_appear_on_portal_link_page(): void
    {
        $this->seed(\Database\Seeders\WorkLinkSeeder::class);

        // Tanpa hierarki: hanya 5 link umum hasil seeder.
        $this->actingAs($this->karyawanUser())
            ->get(route('karyawan.link'))
            ->assertOk()
            ->assertSee('Presensi Online')
            ->assertSee('Webmail PLN')
            ->assertSee('E-Office')
            ->assertSee('Portal SDM')
            ->assertSee('E-Learning')
            // Link khusus sub-bidang lain disembunyikan
            ->assertDontSee('Dashboard Kontrol Pembangkit')
            ->assertDontSee('Lab Chemistry Portal');

        // Staf Asisten Manager Prod A melihat link khusus bagiannya.
        $this->actingAs($this->karyawanUser([
            'level_jabatan' => 'staf_spv',
            'department' => 'operasi',
            'sub_department' => 'asmen_prod_a',
        ]))->get(route('karyawan.link'))
            ->assertOk()
            ->assertSee('Dashboard Kontrol Pembangkit')
            ->assertSee('Logbook Operator Shift')
            ->assertDontSee('Lab Chemistry Portal');
    }

    public function test_seeder_creates_five_umum_and_five_khusus_links(): void
    {
        $this->seed(\Database\Seeders\WorkLinkSeeder::class);

        $this->assertSame(5, WorkLink::where('category', 'umum')->count());
        $this->assertSame(5, WorkLink::where('category', 'khusus')->count());
        $this->assertSame(5, WorkLink::where('category', 'umum')->where('is_active', true)->count());

        // Khusus: 2 Prod A + 2 CHCB A + 1 Kimia & Lab.
        $this->assertSame(2, WorkLink::where('sub_department', 'asmen_prod_a')->count());
        $this->assertSame(2, WorkLink::where('sub_department', 'spv_chcb_a')->count());
        $this->assertSame(1, WorkLink::where('sub_department', 'asmen_kimia_lab')->count());

        // Seeder idempoten: jalankan ulang tidak menduplikasi.
        $this->seed(\Database\Seeders\WorkLinkSeeder::class);
        $this->assertSame(10, WorkLink::count());
    }

    public function test_sidebar_shows_work_link_menu_with_permission(): void
    {
        $this->actingAs($this->adminUser())
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Link Kerja');
    }
}
