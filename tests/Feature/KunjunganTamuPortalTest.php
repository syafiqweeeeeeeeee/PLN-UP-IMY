<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Tamu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * KUNJUNGAN TAMU — Portal Karyawan (GET /karyawan/kunjungan-tamu)
 * Navbar "Kunjungan Tamu" khusus portal karyawan; daftar SCOPED ke
 * tamu yang `orang_ditemui` = nama akun login (form registrasi publik
 * memilih nama dari dropdown User). Data lengkap tetap terlihat oleh
 * Super Admin lewat panel admin (admin.tamu.index) yang sudah ada.
 */
class KunjunganTamuPortalTest extends TestCase
{
    use RefreshDatabase;

    private function karyawanUser(string $name = 'ABDI ROBBI IKHSAN'): User
    {
        $role = Role::firstOrCreate(
            ['name' => 'Karyawan'],
            ['description' => 'Pengguna internal / karyawan', 'status' => true]
        );

        $user = User::factory()->create(['name' => $name, 'role' => 'Karyawan']);
        $user->role_id = $role->id;
        $user->save();
        $user->roles()->sync([$role->id]);

        return $user;
    }

    private function tamu(array $overrides = []): Tamu
    {
        return Tamu::create(array_merge([
            'nik'             => '3201123456780001',
            'nama'            => 'Budi Santoso',
            'no_hp'           => '081234567890',
            'tujuan_ditemui'  => 'SUB BIDANG LISTRIK',
            'jabatan_ditemui' => 'JUNIOR ENJINIR LISTRIK',
            'orang_ditemui'   => 'ABDI ROBBI IKHSAN',
            'jumlah_tamu'     => 1,
            'tanggal_kunjungan' => now()->addDay(),
            'keperluan'       => 'Kunjungan industri.',
        ], $overrides));
    }

    public function test_halaman_renders_dan_navigasi_ada_di_navbar(): void
    {
        $user = $this->karyawanUser();
        $this->tamu();

        $response = $this->actingAs($user)->get(route('karyawan.kunjungan-tamu'));

        $response->assertOk()
            ->assertSee('Kunjungan Tamu')
            ->assertSee('Budi Santoso')
            ->assertSee('ABDI ROBBI IKHSAN');

        // Item navbar tampil di halaman portal (layout karyawan).
        $this->actingAs($user)->get(route('karyawan.dashboard'))
            ->assertOk()
            ->assertSee(route('karyawan.kunjungan-tamu'), false);
    }

    public function test_daftar_scoped_ke_nama_akun_login(): void
    {
        $abdi = $this->karyawanUser('ABDI ROBBI IKHSAN');
        $other = $this->karyawanUser('Karyawan Lain');

        $untukAbdi = $this->tamu(['nama' => 'Tamu Untuk Abdi']);
        $untukLain = $this->tamu([
            'nik'           => '3201123456780002',
            'orang_ditemui' => 'KARYAWAN LAIN',
            'nama'          => 'Tamu Untuk Orang Lain',
        ]);

        // Abdi hanya melihat tamu yang menyebut namanya.
        $this->actingAs($abdi)->get(route('karyawan.kunjungan-tamu'))
            ->assertOk()
            ->assertSee('Tamu Untuk Abdi')
            ->assertDontSee('Tamu Untuk Orang Lain');

        // Sebaliknya, akun lain tidak melihat tamu Abdi.
        $this->actingAs($other)->get(route('karyawan.kunjungan-tamu'))
            ->assertOk()
            ->assertSee('Tamu Untuk Orang Lain')
            ->assertDontSee('Tamu Untuk Abdi');

        $this->assertSame(1, Tamu::query()
            ->whereRaw('LOWER(TRIM(orang_ditemui)) = ?', ['abdi robbi ikhsan'])
            ->count());
    }

    public function test_pencocokan_nama_tahan_kapital_dan_spasi(): void
    {
        $user = $this->karyawanUser('ABDI ROBBI IKHSAN');

        // Registrasi mengetik teks bebas — beda kapital & spasi ekor tetap cocok.
        $this->tamu(['orang_ditemui' => '  abdi robbi ikhsan  ']);
        $this->tamu([
            'nik'           => '3201123456780003',
            'orang_ditemui' => 'Orang Lain',
            'nama'          => 'Bukan Tamu Abdi',
        ]);

        $this->actingAs($user)->get(route('karyawan.kunjungan-tamu'))
            ->assertOk()
            ->assertSee('Budi Santoso')
            ->assertDontSee('Bukan Tamu Abdi');
    }

    public function test_akun_tanpa_tamu_tetap_layar_kosong(): void
    {
        $user = $this->karyawanUser();
        $this->tamu(['orang_ditemui' => 'Orang Lain Secara total']);

        $this->actingAs($user)->get(route('karyawan.kunjungan-tamu'))
            ->assertOk()
            ->assertSee('Belum ada kunjungan tamu untuk Anda')
            ->assertDontSee('Budi Santoso');
    }

    public function test_akun_admin_diblokir_dari_portal_karyawan(): void
    {
        // Super Admin melihat SELURUH data lewat panel admin (admin.tamu.index),
        // bukan lewat halaman portal karyawan ini.
        $superRole = Role::firstOrCreate(
            ['name' => 'Super Admin'],
            ['description' => 'Super Admin', 'status' => true]
        );
        $admin = User::factory()->create(['name' => 'Super Admin Akun', 'role' => 'Super Admin']);
        $admin->role_id = $superRole->id;
        $admin->save();
        $admin->roles()->sync([$superRole->id]);

        $this->actingAs($admin)->get(route('karyawan.kunjungan-tamu'))
            ->assertRedirect(route('admin.dashboard'));
    }

    public function test_tamu_tetap_terlihat_di_panel_admin_super_admin(): void
    {
        $this->tamu();

        $superRole = Role::firstOrCreate(
            ['name' => 'Super Admin'],
            ['description' => 'Super Admin', 'status' => true]
        );
        $admin = User::factory()->create(['name' => 'Super Admin Akun', 'role' => 'Super Admin']);
        $admin->role_id = $superRole->id;
        $admin->save();
        $admin->roles()->sync([$superRole->id]);
        // Super Admin = akses penuh (permission.tamu.view via role).
        \App\Models\Permission::firstOrCreate(
            ['name' => 'tamu.view'],
            ['display_name' => 'tamu.view', 'module' => 'Guest Book']
        )->roles()->syncWithoutDetaching([$superRole->id]);
        $admin->syncPermissions([\App\Models\Permission::where('name', 'tamu.view')->first()->id]);

        $this->actingAs($admin)->get(route('admin.tamu.index'))
            ->assertOk()
            ->assertSee('Budi Santoso');
    }
}
