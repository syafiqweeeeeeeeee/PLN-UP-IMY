<?php

namespace Tests\Feature;

use App\Models\HariLibur;
use App\Models\News;
use App\Models\Role;
use App\Models\Tamu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * REGRESI KEAMANAN — mengunci perbaikan hasil audit:
 *  - IDOR detail pengguna (admin.users.show)
 *  - Stored XSS konten portal karyawan
 *  - Attribute injection halaman Hari Libur
 *  - Brute force login & OTP
 *  - Throttle registrasi tamu publik
 *  - Halaman error kustom
 */
class SecurityHardeningTest extends TestCase
{
    use RefreshDatabase;

    private function karyawan(string $name = 'KARYAWAN UJI'): User
    {
        $role = Role::firstOrCreate(
            ['name' => 'Karyawan'],
            ['description' => 'Pengguna internal / karyawan', 'status' => true]
        );

        $user = User::factory()->create(['name' => $name, 'role' => 'Karyawan', 'role_id' => $role->id]);
        $user->roles()->sync([$role->id]);

        return $user;
    }

    /* =========================================================
       IDOR DETAIL PENGGUNA
       ========================================================= */

    public function test_admin_tanpa_permission_tidak_bisa_melihat_detail_user_lain(): void
    {
        $admin = $this->userWithPermissions(['dashboard.view']);
        $lain = User::factory()->create(['name' => 'Pegawai Rahasia']);

        $this->actingAs($admin)
            ->get(route('admin.users.show', $lain))
            ->assertForbidden();
    }

    public function test_admin_tetap_bisa_melihat_profil_sendiri(): void
    {
        $admin = $this->userWithPermissions(['dashboard.view']);

        $this->actingAs($admin)
            ->get(route('admin.users.show', $admin))
            ->assertOk();
    }

    public function test_admin_dengan_permission_users_view_bisa_melihat_detail_user_lain(): void
    {
        $admin = $this->userWithPermissions(['users.view']);
        $lain = User::factory()->create(['name' => 'Pegawai Terdaftar']);

        $this->actingAs($admin)
            ->get(route('admin.users.show', $lain))
            ->assertOk()
            ->assertSee('Pegawai Terdaftar');
    }

    /* =========================================================
       XSS
       ========================================================= */

    public function test_konten_portal_karyawan_tidak_merender_html_mentah(): void
    {
        $user = $this->karyawan('PEMBACA PORTAL');

        News::create([
            'title'              => 'Berita Uji XSS',
            'slug'               => 'berita-uji-xss',
            'category'           => 'umum',
            'excerpt'            => 'Ringkasan',
            'content'            => '<script>alert("xss")</script>',
            'is_published'       => true,
            'published_at'       => now(),
            'target_publication' => 'all',
        ]);

        $response = $this->actingAs($user)->get(route('karyawan.informasi.detail', [
            'type' => 'berita',
            'slug' => 'berita-uji-xss',
        ]));

        $response->assertOk()
            ->assertDontSee('<script>alert("xss")</script>', false)
            ->assertSee('&lt;script&gt;', false);
    }

    public function test_keterangan_hari_libur_tidak_bisa_keluar_dari_atribut_onclick(): void
    {
        $admin = $this->userWithPermissions([
            'hari_libur.view', 'hari_libur.create', 'hari_libur.edit', 'hari_libur.delete',
        ]);

        HariLibur::create([
            'tanggal'    => now()->addDays(3)->toDateString(),
            'tipe'       => 'libur',
            'keterangan' => "' onmouseover='alert(1)",
        ]);

        $response = $this->actingAs($admin)->get(route('admin.hari-libur.index'));

        $response->assertOk()
            ->assertDontSee("onmouseover='alert(1)", false)
            // @js menuliskan kutip tunggal sebagai escape unicode.
            ->assertSee('\u0027', false);
    }

    /* =========================================================
       OTORISASI KUNJUNGAN TAMU BERBASIS USER ID
       ========================================================= */

    public function test_pendaftaran_tamu_menautkan_akun_orang_yang_ditemui(): void
    {
        $user = $this->karyawan('Naufal Adzmi');

        $tamu = Tamu::create([
            'nik'                   => '3201123456780021',
            'nama'                  => 'Tamu Uji',
            'instansi'              => 'PT Uji',
            'no_hp'                 => '081200000001',
            'email'                 => 'tamu@example.test',
            'tujuan_ditemui'        => 'Bidang Uji',
            'jabatan_ditemui'       => 'Staf Uji',
            'orang_ditemui'         => '  naufal adzmi ',
            'orang_ditemui_user_id' => Tamu::resolveOrangDitemuiUserId('  naufal adzmi '),
            'jumlah_tamu'           => 1,
            'tanggal_kunjungan'     => now()->addDay(),
            'keperluan'             => 'Uji tautan akun.',
        ]);

        $this->assertSame($user->id, $tamu->fresh()->orang_ditemui_user_id);

        $this->actingAs($user)->get(route('karyawan.kunjungan-tamu'))
            ->assertOk()
            ->assertSee('Tamu Uji');
    }

    public function test_resolusi_user_id_menolak_id_eksplisit_yang_tidak_cocok_nama(): void
    {
        $a = $this->karyawan('Akun A');
        $b = $this->karyawan('Akun B');

        // Hidden id menunjuk B, tetapi nama yang dikirim adalah A → harus
        // memakai A (nama tetap sumber kebenaran, id hanya mempertegas).
        $this->assertSame(
            $a->id,
            Tamu::resolveOrangDitemuiUserId('Akun A', $b->id)
        );
    }

    /* =========================================================
       BRUTE FORCE: LOGIN, OTP, REGISTRASI PUBLIK
       ========================================================= */

    public function test_login_dibatasi_setelah_lima_percobaan_gagal(): void
    {
        User::factory()->create([
            'email'    => 'user.login@example.test',
            'password' => Hash::make('password-benar'),
        ]);

        for ($i = 0; $i < 5; $i++) {
            $this->post('/admin/login', [
                'email'    => 'user.login@example.test',
                'password' => 'password-salah',
            ])->assertSessionHasErrors('email');
        }

        $this->post('/admin/login', [
            'email'    => 'user.login@example.test',
            'password' => 'password-benar',
        ])->assertSessionHasErrors('email');

        $this->assertStringContainsString(
            'Terlalu banyak percobaan',
            (string) session('errors')?->first('email')
        );
        $this->assertGuest();
    }

    public function test_otp_dibatalkan_setelah_lima_percobaan_salah(): void
    {
        $user = User::factory()->create(['email' => 'user.otp@example.test']);
        $cacheKey = 'otp:password:' . sha1($user->email);

        Cache::put($cacheKey, Hash::make('123456'), now()->addMinutes(10));

        $payload = [
            'email'                 => $user->email,
            'otp'                   => '000000',
            'password'              => 'PasswordBaru123',
            'password_confirmation' => 'PasswordBaru123',
        ];

        for ($i = 0; $i < 4; $i++) {
            $this->postJson(route('password.reset'), $payload)->assertStatus(422);
        }

        $this->postJson(route('password.reset'), $payload)->assertStatus(429);

        // Kode yang tersimpan ikut dibatalkan agar tidak bisa ditebak lagi.
        $this->assertFalse(Cache::has($cacheKey));
    }

    public function test_registrasi_tamu_publik_dibatasi_sepuluh_per_menit(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $this->post(route('layanan.registrasi-tamu.store'), []);
        }

        $response = $this->post(route('layanan.registrasi-tamu.store'), []);

        $response->assertStatus(429)
            ->assertSee('Terlalu Banyak Permintaan');
    }

    /* =========================================================
       KONSISTENSI DIALOG (SWEETALERT)
       ========================================================= */

    public function test_helper_sweetalert_dimuat_di_admin_portal_dan_publik(): void
    {
        $admin = $this->userWithPermissions(['dashboard.view']);
        $karyawan = $this->karyawan('PORTAL USER');

        Tamu::create([
            'nik'                   => '3201123456780031',
            'nama'                  => 'Tamu Portal',
            'no_hp'                 => '081200000031',
            'tujuan_ditemui'        => 'Bidang Uji',
            'jabatan_ditemui'       => 'Staf Uji',
            'orang_ditemui'         => 'PORTAL USER',
            'orang_ditemui_user_id' => $karyawan->id,
            'jumlah_tamu'           => 1,
            'tanggal_kunjungan'     => now()->addDay(),
            'keperluan'             => 'Uji dialog.',
        ]);

        $this->actingAs($admin)->get(route('admin.dashboard'))
            ->assertOk()->assertSee('js/swal-helper.js', false);

        $this->actingAs($karyawan)->get(route('karyawan.kunjungan-tamu'))
            ->assertOk()
            ->assertSee('js/swal-helper.js', false)
            // Tombol aksi memakai konfirmasi SweetAlert, bukan confirm().
            ->assertSee('data-swal-confirm', false)
            ->assertDontSee('return confirm(', false);

        $this->get(route('layanan.registrasi-tamu'))
            ->assertOk()
            ->assertSee('js/swal-helper.js', false);
    }

    /* =========================================================
       HALAMAN ERROR KUSTOM
       ========================================================= */

    public function test_halaman_404_memakai_tampilan_kustom(): void
    {
        $this->get('/halaman-yang-tidak-ada-sama-sekali')
            ->assertStatus(404)
            ->assertSee('Halaman Tidak Ditemukan');
    }

    public function test_halaman_403_memakai_tampilan_kustom(): void
    {
        $user = User::factory()->create(['name' => 'Tanpa Izin']);

        $this->actingAs($user)
            ->get(route('admin.news.index'))
            ->assertStatus(403)
            ->assertSee('Akses Ditolak');
    }
}
