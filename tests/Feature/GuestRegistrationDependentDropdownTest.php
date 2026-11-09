<?php

namespace Tests\Feature;

use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * DEPENDENT DROPDOWN REGISTRASI TAMU (berbasis kunci primer):
 *
 *   Bidang  → GET /api/get-jabatan?bidang_id=...
 *   Jabatan → GET /api/get-karyawan?jabatan_id=...
 *   Orang   → karyawans (aktif, level Asisten Manajer/Junior/Staff)
 *
 * Endpoint 3 level lama (/api/get-pegawai) tetap diuji terpisah di
 * GuestRegistrationPegawaiTest — kompatibilitasnya tidak berubah.
 */
class GuestRegistrationDependentDropdownTest extends TestCase
{
    use RefreshDatabase;

    private Bidang $enjiniring;

    private Bidang $operasi;

    protected function setUp(): void
    {
        parent::setUp();

        $this->enjiniring = Bidang::create(['nama' => 'ENJINIRING']);
        $this->operasi = Bidang::create(['nama' => 'OPERASI']);
    }

    private function jabatan(string $nama, Bidang $bidang, ?Jabatan $parent = null): Jabatan
    {
        return Jabatan::create([
            'nama'      => $nama,
            'bidang_id' => $bidang->id,
            'parent_id' => $parent?->id,
        ]);
    }

    private function karyawan(
        string $nama,
        ?Jabatan $jabatan,
        string $status = Karyawan::STATUS_AKTIF,
        ?string $teksJabatan = null,
    ): Karyawan {
        return Karyawan::factory()->create([
            'nama'      => $nama,
            'nid'       => 'NID-' . strtoupper(substr(md5($nama), 0, 8)),
            'status'    => $status,
            'jabatan_id' => $jabatan?->id,
            'jabatan'   => $teksJabatan ?? $jabatan?->nama,
            'bidang_id' => $jabatan?->bidang_id,
            'bidang'    => $jabatan?->bidang?->nama,
        ]);
    }

    /* =========================================================
       RELASI MODEL (tanpa tabel/kolom baru)
       ========================================================= */

    public function test_relasi_master_bidang_jabatan_karyawan_tersedia(): void
    {
        $jabatan = $this->jabatan('ASSISTANT MANAGER CONDITION BASED MAINTENANCE', $this->enjiniring);
        $karyawan = $this->karyawan('ZULFIQRI ACHMAD', $jabatan);

        $this->assertSame([$jabatan->id], $this->enjiniring->jabatans()->pluck('id')->all());
        $this->assertSame([$karyawan->id], $this->enjiniring->karyawans()->pluck('id')->all());
        $this->assertSame([$karyawan->id], $jabatan->karyawans()->pluck('id')->all());

        $this->assertTrue($karyawan->jabatanMaster->is($jabatan));
        $this->assertTrue($karyawan->bidangMaster->is($this->enjiniring));
    }

    /* =========================================================
       ENDPOINT 1 — /api/get-jabatan
       ========================================================= */

    public function test_get_jabatan_hanya_mengembalikan_jabatan_pada_bidang_terpilih(): void
    {
        $amCbm = $this->jabatan('ASSISTANT MANAGER CONDITION BASED MAINTENANCE', $this->enjiniring);
        $amProduksi = $this->jabatan('ASSISTANT MANAGER PRODUKSI A', $this->operasi);

        $response = $this->getJson('/api/get-jabatan?' . http_build_query([
            'bidang_id' => $this->enjiniring->id,
        ]))->assertOk();

        $this->assertSame([$amCbm->id], collect($response->json())->pluck('id')->all());
        $this->assertSame('asisten_manager', $response->json()[0]['level']);
        $this->assertNotContains($amProduksi->id, collect($response->json())->pluck('id')->all());
    }

    public function test_get_jabatan_membuang_level_di_luar_asisten_manajer_junior_staff(): void
    {
        $this->jabatan('MANAGER ENJINIRING & QA', $this->enjiniring);
        $this->jabatan('SENIOR MANAGER UP INDRAMAYU', $this->enjiniring);
        $staff = $this->jabatan('JUNIOR OFFICER KIMIA DAN LABORATORIUM', $this->enjiniring);

        $response = $this->getJson('/api/get-jabatan?' . http_build_query([
            'bidang_id' => $this->enjiniring->id,
        ]))->assertOk();

        $this->assertSame([$staff->id], collect($response->json())->pluck('id')->all());
    }

    public function test_get_jabatan_memvalidasi_bidang_id(): void
    {
        $this->getJson('/api/get-jabatan')->assertUnprocessable();
        $this->getJson('/api/get-jabatan?bidang_id=999999')->assertUnprocessable();
    }

    /* =========================================================
       ENDPOINT 2 — /api/get-karyawan
       ========================================================= */

    public function test_get_karyawan_hanya_karyawan_aktif_pada_jabatan_terpilih(): void
    {
        $jabatan = $this->jabatan('JUNIOR OFFICER KIMIA DAN LABORATORIUM', $this->operasi);
        $lain = $this->jabatan('TECHNICIAN CCR, DCS & ELEKTRIKAL A', $this->operasi);

        $aktif = $this->karyawan('ANI AKTIF', $jabatan);
        $this->karyawan('BUDI NONAKTIF', $jabatan, Karyawan::STATUS_NONAKTIF);
        $this->karyawan('CICI JABATAN LAIN', $lain);

        $response = $this->getJson('/api/get-karyawan?' . http_build_query([
            'jabatan_id' => $jabatan->id,
        ]))->assertOk();

        $this->assertSame(['ANI AKTIF'], collect($response->json())->pluck('nama')->all());
        $this->assertSame($aktif->id, $response->json()[0]['id']);
        $this->assertSame($jabatan->id, $response->json()[0]['jabatan_id']);
    }

    public function test_get_karyawan_tetap_menampilkan_data_lama_tanpa_jabatan_id(): void
    {
        $jabatan = $this->jabatan('JUNIOR TECHNICIAN PEMELIHARAAN MESIN 1', $this->enjiniring);

        // Data lama: teks jabatan sudah ada, FK belum terpetakan.
        $this->karyawan('DATA LAMA', null, Karyawan::STATUS_AKTIF, $jabatan->nama);

        $response = $this->getJson('/api/get-karyawan?' . http_build_query([
            'jabatan_id' => $jabatan->id,
        ]))->assertOk();

        $this->assertSame(['DATA LAMA'], collect($response->json())->pluck('nama')->all());
    }

    public function test_get_karyawan_kosong_untuk_jabatan_di_luar_level_tamu(): void
    {
        $manager = $this->jabatan('MANAGER ENJINIRING & QA', $this->enjiniring);
        $this->karyawan('MANAJER ENJINIRING', $manager);

        $this->getJson('/api/get-karyawan?' . http_build_query([
            'jabatan_id' => $manager->id,
        ]))->assertOk()->assertExactJson([]);
    }

    public function test_get_karyawan_memvalidasi_jabatan_id(): void
    {
        $this->getJson('/api/get-karyawan')->assertUnprocessable();
        $this->getJson('/api/get-karyawan?jabatan_id=999999')->assertUnprocessable();
    }

    public function test_get_karyawan_menyertakan_akun_tertaut_bila_ada(): void
    {
        $jabatan = $this->jabatan('ASSISTANT MANAGER SYSTEM OWNER', $this->enjiniring);
        $karyawan = $this->karyawan('AHMAD DENY RIZQI ALFAKIH', $jabatan);

        $user = User::factory()->create(['name' => 'AHMAD DENY RIZQI ALFAKIH']);
        $user->employeeProfile()->create([
            'karyawan_id' => $karyawan->id,
            'bidang'      => 'ENJINIRING',
            'jabatan'     => $jabatan->nama,
        ]);

        $response = $this->getJson('/api/get-karyawan?' . http_build_query([
            'jabatan_id' => $jabatan->id,
        ]))->assertOk();

        $this->assertSame($user->id, $response->json()[0]['user_id']);
    }

    /* =========================================================
       FORM — hidden id & opsi membawa kunci primer
       ========================================================= */

    public function test_form_mengirim_kunci_primer_berjenjang(): void
    {
        $jabatan = $this->jabatan('ASSISTANT MANAGER CONDITION BASED MAINTENANCE', $this->enjiniring);

        $this->get(route('layanan.registrasi-tamu'))
            ->assertOk()
            ->assertSee('name="bidang_id"', false)
            ->assertSee('name="jabatan_id"', false)
            ->assertSee('name="karyawan_id"', false)
            // Partial bidang & jabatan membawa id agar JS bisa mencascade
            // tanpa bergantung pada nama.
            ->assertSee('data-id="' . $this->enjiniring->id . '"', false)
            ->assertSee('data-bidang-id="' . $this->enjiniring->id . '"', false)
            ->assertSee("data-id=\"{$jabatan->id}\"", false);
    }

    public function test_form_menyembunyikan_unit_induk_struktural_dari_pilihan_bidang(): void
    {
        // Unit induk (root hierarki) — bukan tujuan kunjungan tamu.
        $root = Bidang::create(['nama' => 'SM UP INDRAMAYU']);
        $unit = Bidang::create(['nama' => 'UNIT UJI OPERASI', 'parent_id' => $root->id]);

        $this->get(route('layanan.registrasi-tamu'))
            ->assertOk()
            // Tidak tampil sebagai opsi maupun judul kelompok.
            ->assertDontSee('SM UP INDRAMAYU')
            // Anak tetap tersedia, lengkap dengan kunci primernya.
            ->assertSee('data-value="UNIT UJI OPERASI"', false)
            ->assertSee('data-id="' . $unit->id . '"', false);
    }

    /* =========================================================
       STORE — pasangan id divalidasi di server
       ========================================================= */

    private function payload(array $overrides = []): array
    {
        $tanggal = now()->startOfDay();
        do {
            $tanggal->addDay();
        } while ($tanggal->isWeekend());

        return array_merge([
            'nik'               => '3201123456780099',
            'nama'              => 'Tamu Uji',
            'instansi'          => 'PT Uji',
            'no_hp'             => '081234567890',
            'email'             => 'tamu@uji.id',
            'dokumen'           => UploadedFile::fake()->create('dokumen.pdf', 100, 'application/pdf'),
            'tujuan_ditemui'    => 'ENJINIRING',
            'jabatan_ditemui'   => 'ASSISTANT MANAGER SYSTEM OWNER',
            'orang_ditemui'     => 'AHMAD DENY RIZQI ALFAKIH',
            'jumlah_tamu'       => 1,
            'tanggal_kunjungan' => $tanggal->format('Y-m-d'),
            'jam_kunjungan'     => '09:00',
            'keperluan'         => 'Koordinasi proyek.',
        ], $overrides);
    }

    public function test_store_menerima_pasangan_bidang_jabatan_karyawan_yang_konsisten(): void
    {
        Storage::fake('private');

        $jabatan = $this->jabatan('ASSISTANT MANAGER SYSTEM OWNER', $this->enjiniring);
        $karyawan = $this->karyawan('AHMAD DENY RIZQI ALFAKIH', $jabatan);

        $this->post(route('layanan.registrasi-tamu.store'), $this->payload([
            'bidang_id'   => $this->enjiniring->id,
            'jabatan_id'  => $jabatan->id,
            'karyawan_id' => $karyawan->id,
        ]))->assertSessionHasNoErrors();

        $this->assertDatabaseHas('tamus', [
            'nik'             => '3201123456780099',
            'tujuan_ditemui'  => 'ENJINIRING',
            'jabatan_ditemui' => 'ASSISTANT MANAGER SYSTEM OWNER',
            'orang_ditemui'   => 'AHMAD DENY RIZQI ALFAKIH',
        ]);
    }

    public function test_store_menolak_jabatan_yang_bukan_milik_bidang(): void
    {
        Storage::fake('private');

        $jabatanEnjiniring = $this->jabatan('ASSISTANT MANAGER SYSTEM OWNER', $this->enjiniring);

        $this->post(route('layanan.registrasi-tamu.store'), $this->payload([
            'bidang_id'  => $this->operasi->id,
            'jabatan_id' => $jabatanEnjiniring->id,
        ]))->assertSessionHasErrors(['jabatan_id']);
    }

    public function test_store_menolak_karyawan_yang_tidak_aktif(): void
    {
        Storage::fake('private');

        $jabatan = $this->jabatan('ASSISTANT MANAGER SYSTEM OWNER', $this->enjiniring);
        $karyawan = $this->karyawan('AHMAD DENY RIZQI ALFAKIH', $jabatan, Karyawan::STATUS_NONAKTIF);

        $this->post(route('layanan.registrasi-tamu.store'), $this->payload([
            'bidang_id'   => $this->enjiniring->id,
            'jabatan_id'  => $jabatan->id,
            'karyawan_id' => $karyawan->id,
        ]))->assertSessionHasErrors(['karyawan_id']);
    }

    public function test_store_menolak_karyawan_dari_jabatan_lain(): void
    {
        Storage::fake('private');

        $jabatan = $this->jabatan('ASSISTANT MANAGER SYSTEM OWNER', $this->enjiniring);
        $lain = $this->jabatan('ASSISTANT MANAGER PRODUKSI A', $this->operasi);
        $karyawanLain = $this->karyawan('AHMAD DENY RIZQI ALFAKIH', $lain);

        $this->post(route('layanan.registrasi-tamu.store'), $this->payload([
            'bidang_id'   => $this->enjiniring->id,
            'jabatan_id'  => $jabatan->id,
            'karyawan_id' => $karyawanLain->id,
        ]))->assertSessionHasErrors(['karyawan_id']);
    }
}
