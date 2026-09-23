<?php

namespace Tests\Feature;

use App\Models\Announcement;
use App\Models\News;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Portal Karyawan (Employee Portal):
 * - Login karyawan diarahkan ke /karyawan/dashboard.
 * - Karyawan diblokir dari /admin/*.
 * - Halaman portal view-only berjalan (informasi, layanan, link, profil).
 * - Data link kerja lengkap (5 umum + 5 per bidang).
 */
class KaryawanPortalTest extends TestCase
{
    use RefreshDatabase;

    private function karyawanUser(array $attributes = []): User
    {
        $role = Role::firstOrCreate(
            ['name' => 'Karyawan'],
            ['description' => 'Pengguna internal / karyawan', 'status' => true]
        );

        $user = User::factory()->create(array_merge([
            'name' => 'Naufal Adzmi',
            'role' => 'Karyawan',
        ], $attributes));

        $user->role_id = $role->id;
        $user->save();
        $user->roles()->sync([$role->id]);

        return $user;
    }

    /* =========================================================
       AUTENTIKASI & ASESI ROLE
       ========================================================= */

    public function test_karyawan_login_redirects_to_portal(): void
    {
        $user = $this->karyawanUser(['password' => 'password123']);

        $response = $this->post(route('login'), [
            'email'    => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('karyawan.dashboard'));
    }

    public function test_admin_login_still_redirects_to_admin_dashboard(): void
    {
        $role = Role::firstOrCreate(
            ['name' => 'Administrator'],
            ['description' => 'Akses penuh sistem', 'status' => true]
        );

        $admin = User::factory()->create(['password' => 'password123']);
        $admin->role_id = $role->id;
        $admin->save();
        $admin->roles()->sync([$role->id]);

        $this->post(route('login'), [
            'email'    => $admin->email,
            'password' => 'password123',
        ])->assertRedirect(route('admin.dashboard'));
    }

    public function test_karyawan_cannot_access_admin_routes(): void
    {
        $user = $this->karyawanUser();

        // Karyawan diblokir dari /admin/* dan dialihkan balik ke portal
        // (redirect ramah, bukan halaman 403 mentah).
        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('karyawan.dashboard'));

        $this->actingAs($user)
            ->get(route('admin.news.index'))
            ->assertRedirect(route('karyawan.dashboard'));
    }

    public function test_non_karyawan_cannot_access_portal(): void
    {
        // Tamu diarahkan ke halaman login (dicek dulu — actingAs
        // di bawah persist untuk sisa test yang sama).
        $this->get(route('karyawan.dashboard'))
            ->assertRedirect(route('login'));

        $plain = User::factory()->create();

        // Pengguna tanpa role karyawan dialihkan ke panel admin.
        $this->actingAs($plain)
            ->get(route('karyawan.dashboard'))
            ->assertRedirect(route('admin.dashboard'));
    }

    /* =========================================================
       HALAMAN PORTAL
       ========================================================= */

    public function test_portal_dashboard_loads_for_karyawan(): void
    {
        $user = $this->karyawanUser(['name' => 'Naufal Adzmi']);

        $this->actingAs($user)
            ->get(route('karyawan.dashboard'))
            ->assertOk()
            ->assertSee('Naufal Adzmi')
            ->assertSee('Portal Karyawan');
    }

    public function test_portal_dashboard_shows_published_information(): void
    {
        $user = $this->karyawanUser();

        News::create([
            'title' => 'Berita Internal Uji', 'slug' => 'berita-internal-uji', 'category' => 'umum',
            'excerpt' => 'Ringkasan berita internal.', 'content' => 'Isi.',
            'is_published' => true, 'published_at' => now(),
        ]);
        Announcement::create([
            'title' => 'Pengumuman Internal Uji', 'slug' => 'pengumuman-internal-uji', 'category' => 'umum',
            'excerpt' => 'Ringkasan pengumuman.', 'content' => 'Isi.',
            'is_published' => true, 'published_at' => now(),
        ]);

        $this->actingAs($user)
            ->get(route('karyawan.dashboard'))
            ->assertOk()
            ->assertSee('Berita Internal Uji')
            ->assertSee('Pengumuman Internal Uji')
            ->assertSee('Baca Selengkapnya');
    }

    public function test_portal_informasi_page_lists_and_opens_detail(): void
    {
        $user = $this->karyawanUser();

        News::create([
            'title' => 'Berita Detail Uji', 'slug' => 'berita-detail-uji', 'category' => 'umum',
            'excerpt' => 'Ringkasan.', 'content' => '<p>Isi lengkap berita.</p>',
            'is_published' => true, 'published_at' => now(),
        ]);
        // Draft tidak boleh muncul
        News::create([
            'title' => 'Berita Draft Uji', 'slug' => 'berita-draft-uji', 'category' => 'umum',
            'excerpt' => 'Ringkasan.', 'is_published' => false,
        ]);

        $this->actingAs($user)->get(route('karyawan.informasi'))
            ->assertOk()
            ->assertSee('Berita Detail Uji')
            ->assertDontSee('Berita Draft Uji');

        $this->actingAs($user)
            ->get(route('karyawan.informasi.detail', ['type' => 'berita', 'slug' => 'berita-detail-uji']))
            ->assertOk()
            ->assertSee('Berita Detail Uji')
            ->assertSee('Isi lengkap berita.');
    }

    public function test_portal_informasi_detail_rejects_draft_and_unknown_type(): void
    {
        $user = $this->karyawanUser();

        News::create([
            'title' => 'Draft Rahasia', 'slug' => 'draft-rahasia', 'category' => 'umum',
            'excerpt' => 'e', 'is_published' => false,
        ]);

        $this->actingAs($user)
            ->get(route('karyawan.informasi.detail', ['type' => 'berita', 'slug' => 'draft-rahasia']))
            ->assertNotFound();

        $this->actingAs($user)
            ->get(route('karyawan.informasi.detail', ['type' => 'tidak-ada', 'slug' => 'apa-saja']))
            ->assertNotFound();
    }

    public function test_portal_layanan_page_lists_services_and_detail(): void
    {
        $user = $this->karyawanUser();

        $this->actingAs($user)->get(route('karyawan.layanan'))
            ->assertOk()
            ->assertSee('Pengajuan Cuti')
            ->assertSee('Layanan IT');

        $this->actingAs($user)->get(route('karyawan.layanan.detail', 'layanan-it'))
            ->assertOk()
            ->assertSee('Layanan IT')
            ->assertSee('it-support@pln-np.co.id');

        $this->actingAs($user)->get(route('karyawan.layanan.detail', 'tidak-ada'))
            ->assertNotFound();
    }

    public function test_portal_link_page_shows_umum_links_for_user_without_hierarchy(): void
    {
        // Akun tanpa data hierarki (level/bidang kosong) → hanya link Akses Umum.
        $user = $this->karyawanUser();

        $this->actingAs($user)->get(route('karyawan.link'))
            ->assertOk()
            ->assertSee('Web Email PLN')
            ->assertSee('Portal SDM')
            ->assertSee('E-Office')
            ->assertSee('Presensi Online')
            ->assertSee('Portal K2')
            ->assertDontSee('SCADA Monitoring')
            ->assertDontSee('CMMS Pemeliharaan')
            // Tombol buka website target _blank
            ->assertSee('target="_blank"', false);
    }

    /* =========================================================
       HIRARKI ORGANISASI — FILTERING KONTEN PORTAL
       ========================================================= */

    public function test_senior_manager_sees_all_links_and_full_filters(): void
    {
        $user = $this->karyawanUser([
            'level_jabatan' => 'senior_manager',
            'role'          => 'Karyawan',
        ]);

        $this->actingAs($user)->get(route('karyawan.link'))
            ->assertOk()
            // Semua 10 link
            ->assertSee('SCADA Monitoring')
            ->assertSee('CMMS Pemeliharaan')
            ->assertSee('SI-FIN Keuangan')
            ->assertSee('E-K3 Safety')
            ->assertSee('SIM Administrasi')
            // Filter lengkap
            ->assertSee('Semua Link')
            ->assertSee('Bidang Operasi')
            ->assertSee('Bidang Pemeliharaan');
    }

    public function test_manager_bidang_sees_department_links_and_umum_only(): void
    {
        $user = $this->karyawanUser([
            'level_jabatan' => 'manager_bidang',
            'department'    => 'operasi',
        ]);

        $this->actingAs($user)->get(route('karyawan.link'))
            ->assertOk()
            // Link umum + link Bidang Operasi
            ->assertSee('Web Email PLN')
            ->assertSee('SCADA Monitoring')
            // Link bidang lain disembunyikan
            ->assertDontSee('CMMS Pemeliharaan')
            ->assertDontSee('E-K3 Safety');
    }

    public function test_staf_spv_locked_to_own_sub_department(): void
    {
        $user = $this->karyawanUser([
            'level_jabatan' => 'staf_spv',
            'department'    => 'operasi',
            'sub_department' => 'asmen_prod_a',
        ]);

        $response = $this->actingAs($user)->get(route('karyawan.link'));

        $response->assertOk()
            ->assertSee('Web Email PLN')
            ->assertSee('SCADA Monitoring')
            ->assertDontSee('CMMS Pemeliharaan')
            ->assertDontSee('E-K3 Safety')
            // Indikator terkunci pada sub-bidang sendiri
            ->assertSee('terkunci');
    }

    public function test_administrator_sees_all_links_on_portal(): void
    {
        $user = $this->karyawanUser(['level_jabatan' => 'administrator']);

        $this->actingAs($user)->get(route('karyawan.link'))
            ->assertOk()
            ->assertSee('SCADA Monitoring')
            ->assertSee('SIM Administrasi');
    }

    public function test_header_shows_dynamic_jabatan_with_department(): void
    {
        // Staf/Asmen/Spv: "<Sub-Bidang> (<Bidang>)"
        $user = $this->karyawanUser([
            'level_jabatan' => 'staf_spv',
            'department'    => 'operasi',
            'sub_department' => 'asmen_prod_a',
        ]);

        $this->actingAs($user)->get(route('karyawan.dashboard'))
            ->assertOk()
            ->assertSee('Asisten Manager Prod A (Operasi)');

        // Manager Bidang: "Manager Bidang (Operasi)"
        $manager = $this->karyawanUser([
            'level_jabatan' => 'manager_bidang',
            'department'    => 'operasi',
        ]);

        $this->actingAs($manager)->get(route('karyawan.dashboard'))
            ->assertOk()
            ->assertSee('Manager Bidang (Operasi)');
    }

    public function test_layanan_filtered_by_hierarchy(): void
    {
        // Manager Bidang Operasi: layanan umum + milik bidang operasi;
        // layanan bidang lain disembunyikan.
        $user = $this->karyawanUser([
            'level_jabatan' => 'manager_bidang',
            'department'    => 'operasi',
        ]);

        $this->actingAs($user)->get(route('karyawan.layanan'))
            ->assertOk()
            ->assertSee('Pengajuan Cuti')
            ->assertDontSee('Peminjaman APD');

        // Detail layanan di luar scope → 404.
        $this->actingAs($user)
            ->get(route('karyawan.layanan.detail', 'peminjaman-apd'))
            ->assertNotFound();
    }

    public function test_portal_link_data_has_five_umum_and_five_bidang(): void
    {
        $links = \App\Services\PortalContentService::workLinks();

        $this->assertCount(10, $links);
        $this->assertSame(5, collect($links)->where('category', 'umum')->count());
        $this->assertSame(5, collect($links)->where('category', '!=', 'umum')->count());

        $filters = \App\Services\PortalContentService::linkFilters();
        $this->assertArrayHasKey('all', $filters);
        $this->assertArrayHasKey('umum', $filters);
    }

    /* =========================================================
       PROFIL
       ========================================================= */

    public function test_karyawan_can_view_and_update_own_profile(): void
    {
        $user = $this->karyawanUser(['name' => 'Naufal Adzmi']);

        $this->actingAs($user)->get(route('karyawan.profil'))
            ->assertOk()
            ->assertSee('Naufal Adzmi')
            ->assertSee('Edit Profil Saya');

        $this->actingAs($user)->put(route('karyawan.profil.update'), [
            'name'   => 'Naufal Adzmi Update',
            'no_hp'  => '081234567890',
            'alamat' => 'Indramayu, Jawa Barat',
        ])->assertRedirect(route('karyawan.profil'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'id'     => $user->id,
            'name'   => 'Naufal Adzmi Update',
            'no_hp'  => '081234567890',
        ]);
    }

    public function test_karyawan_can_change_password_with_current_password(): void
    {
        $user = $this->karyawanUser(['password' => 'passwordlama']);

        $this->actingAs($user)->put(route('karyawan.profil.update'), [
            'name'             => 'Naufal Adzmi',
            'current_password' => 'passwordlama',
            'password'         => 'passwordbaru99',
            'password_confirmation' => 'passwordbaru99',
        ])->assertRedirect(route('karyawan.profil'))
            ->assertSessionHas('success');

        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('passwordbaru99', $user->fresh()->password));
    }

    public function test_karyawan_password_change_requires_correct_current_password(): void
    {
        $user = $this->karyawanUser(['password' => 'passwordlama']);

        $this->actingAs($user)->put(route('karyawan.profil.update'), [
            'name'             => 'Naufal Adzmi',
            'current_password' => 'salah total',
            'password'         => 'passwordbaru99',
            'password_confirmation' => 'passwordbaru99',
        ])->assertSessionHasErrors('current_password');

        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('passwordlama', $user->fresh()->password));
    }

    /* =========================================================
       ADMIN TETAP PUNYA AKSES PENUH
       ========================================================= */

    public function test_admin_still_access_admin_dashboard(): void
    {
        $admin = $this->userWithPermissions(['dashboard.view']);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk();
    }
}
