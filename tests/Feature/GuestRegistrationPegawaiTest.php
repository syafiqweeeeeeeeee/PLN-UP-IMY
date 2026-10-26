<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * API DEPENDENT DROPDOWN "Orang yang Ditemui" — GET /api/get-pegawai
 * (GuestRegistrationController::getPegawai), dipakai halaman publik
 * /layanan/form-registrasi-tamu untuk menyaring daftar nama sesuai
 * pasangan "Bidang yang Ditemui" + "Jabatan yang Ditemui".
 */
class GuestRegistrationPegawaiTest extends TestCase
{
    use RefreshDatabase;

    private const BIDANG = 'SUB BIDANG LISTRIK';

    private const JABATAN = 'JUNIOR ENJINIR LISTRIK';

    /** Buat akun + profil kepegawaian yang cocok dengan pasangan di atas. */
    private function buatPegawai(string $name, string $role, string $bidang, string $jabatan): User
    {
        $user = User::factory()->create(['name' => $name, 'role' => $role]);
        $user->employeeProfile()->create([
            'bidang'  => $bidang,
            'jabatan' => $jabatan,
        ]);

        return $user;
    }

    public function test_route_terdaftar_dengan_nama_api_get_pegawai(): void
    {
        $this->assertSame(url('/api/get-pegawai'), route('api.get-pegawai'));
    }

    public function test_mengembalikan_karyawan_pada_pasangan_bidang_dan_jabatan(): void
    {
        $this->buatPegawai('ABDI ROBBI IKHSAN', 'Karyawan', self::BIDANG, self::JABATAN);

        $response = $this->getJson('/api/get-pegawai?' . http_build_query([
            'bidang'  => self::BIDANG,
            'jabatan' => self::JABATAN,
        ]));

        $response->assertOk();

        $this->assertSame(
            ['ABDI ROBBI IKHSAN'],
            collect($response->json())->pluck('name')->all()
        );
    }

    public function test_membuang_role_admin_dan_pasangan_bidang_lain(): void
    {
        // Role non-karyawan/staff dengan profil yang SAMA → tetap dibuang.
        $this->buatPegawai('Admin SDM', 'Admin Bidang', self::BIDANG, self::JABATAN);
        // Karyawan dengan pasangan bidang+jabatan BERBEDA → tidak ikut tampil.
        $this->buatPegawai('Orang Operasi', 'Karyawan', 'BIDANG OPERASI', 'JUNIOR OPERATOR PRODUKSI A');

        $response = $this->getJson('/api/get-pegawai?' . http_build_query([
            'bidang'  => self::BIDANG,
            'jabatan' => self::JABATAN,
        ]));

        $response->assertOk();
        $this->assertSame([], $response->json());
    }

    public function test_parameter_bidang_dan_jabatan_wajib_diisi(): void
    {
        $this->getJson('/api/get-pegawai')->assertUnprocessable();
        $this->getJson('/api/get-pegawai?bidang=' . urlencode(self::BIDANG))->assertUnprocessable();
    }
}
