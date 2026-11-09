<?php

namespace Tests\Feature;

use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * MIGRATION PERBAIKAN DATA — 2026_11_09_000001.
 *
 * Prasyarat dependent dropdown registrasi tamu: `jabatans.bidang_id` dan
 * `karyawans.jabatan_id` harus menunjuk baris master yang benar-benar
 * ada. Test ini menyiapkan data "kotor" (jabatan yatim + jabatan_id
 * NULL) lalu menjalankan up() migration apa adanya.
 */
class MasterRefRepairMigrationTest extends TestCase
{
    use RefreshDatabase;

    private function jalankanMigration(): void
    {
        $migration = require database_path(
            'migrations/2026_11_09_000001_repair_master_refs_for_dependent_dropdown.php'
        );

        $migration->up();
    }

    /**
     * Sisipkan jabatan dengan bidang_id yang tidak ada. Foreign key
     * `jabatans.bidang_id` aktif di database baru (migration lama sempat
     * tidak punya FK), jadi constraint dimatikan hanya saat penyisipan —
     * meniru kondisi data legacy.
     */
    private function jabatanYatim(string $nama, int $bidangId = 999999, ?int $parentId = null): int
    {
        Schema::disableForeignKeyConstraints();

        try {
            return (int) DB::table('jabatans')->insertGetId([
                'nama'       => $nama,
                'bidang_id'  => $bidangId,
                'parent_id'  => $parentId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } finally {
            Schema::enableForeignKeyConstraints();
        }
    }

    private function karyawan(array $data): Karyawan
    {
        return Karyawan::factory()->create(array_merge([
            'nid'        => 'NID-' . strtoupper(substr(md5(json_encode($data)), 0, 8)),
            'status'     => Karyawan::STATUS_AKTIF,
            'jabatan_id' => null,
        ], $data));
    }

    public function test_migration_memperbaiki_jabatan_yatim_dan_melengkapi_jabatan_id(): void
    {
        $enjiniring = Bidang::create(['nama' => 'ENJINIRING']);
        $operasi = Bidang::create(['nama' => 'OPERASI']);

        /* 1. Jabatan yatim yang masih punya karyawan → bidang diambil
              dari satu-satunya bidang karyawannya. */
        $yatimAdaKaryawan = $this->jabatanYatim('ASSISTANT MANAGER K3');
        $this->karyawan([
            'nama'      => 'KARYAWAN K3',
            'bidang_id' => $enjiniring->id,
            'bidang'    => 'ENJINIRING',
            'jabatan'   => 'ASSISTANT MANAGER K3',
        ]);

        /* 2. Jabatan yatim tanpa karyawan → mewarisi bidang dari induk. */
        $indukValid = Jabatan::create([
            'nama'      => 'MANAGER OPERASI',
            'bidang_id' => $operasi->id,
        ]);
        $yatimTanpaKaryawan = $this->jabatanYatim('JUNIOR TECHNICIAN COAL & ASH HANDLING A', 999999, $indukValid->id);

        /* 3. Teks jabatan lebih panjang dari nama master (dalam kurung). */
        $mesin1 = Jabatan::create([
            'nama'      => 'JUNIOR TECHNICIAN PEMELIHARAAN MESIN 1',
            'bidang_id' => $enjiniring->id,
        ]);
        $karyawanKurung = $this->karyawan([
            'nama'      => 'KARYAWAN MESIN',
            'bidang_id' => $enjiniring->id,
            'bidang'    => 'ENJINIRING',
            'jabatan'   => 'JUNIOR TECHNICIAN PEMELIHARAAN MESIN 1 (BOILER, TURBIN & ALA',
        ]);

        /* 4. Pejabat sementara (PJS) pada posisi yang ada di master. */
        $amCahC = Jabatan::create([
            'nama'      => 'ASSISTANT MANAGER COAL & ASH HANDLING C',
            'bidang_id' => $operasi->id,
        ]);
        $karyawanPjs = $this->karyawan([
            'nama'      => 'KARYAWAN PJS',
            'bidang_id' => $operasi->id,
            'bidang'    => 'OPERASI',
            'jabatan'   => 'PJS ASSISTANT MANAGER COAL & ASH HANDLING C',
        ]);

        /* 5. Bidang karyawan BEDA dengan bidang jabatan → jangan ditebak. */
        $karyawanBedaBidang = $this->karyawan([
            'nama'      => 'KARYAWAN BEDA',
            'bidang_id' => $operasi->id,
            'bidang'    => 'OPERASI',
            'jabatan'   => 'JUNIOR TECHNICIAN PEMELIHARAAN MESIN 1',
        ]);

        $this->jalankanMigration();

        // 1. Yatim dengan karyawan → bidang ENJINIRING.
        $this->assertSame($enjiniring->id, (int) DB::table('jabatans')->where('id', $yatimAdaKaryawan)->value('bidang_id'));

        // 2. Yatim tanpa karyawan → mewarisi bidang induk (OPERASI).
        $this->assertSame($operasi->id, (int) DB::table('jabatans')->where('id', $yatimTanpaKaryawan)->value('bidang_id'));

        // 3 & 4. Backfill jabatan_id dari teks (kurung & PJS).
        $this->assertSame($mesin1->id, (int) $karyawanKurung->fresh()->jabatan_id);
        $this->assertSame($amCahC->id, (int) $karyawanPjs->fresh()->jabatan_id);

        // 5. Bidang berbeda → tetap NULL (tidak menebak).
        $this->assertNull($karyawanBedaBidang->fresh()->jabatan_id);

        // Tidak ada lagi jabatan yatim.
        $this->assertSame(0, DB::table('jabatans')
            ->leftJoin('bidangs', 'bidangs.id', '=', 'jabatans.bidang_id')
            ->whereNull('bidangs.id')
            ->count());
    }

    public function test_migration_idempoten_dijalankan_ulang(): void
    {
        $bidang = Bidang::create(['nama' => 'ENJINIRING']);
        $jabatan = $this->jabatanYatim('ASSISTANT MANAGER SYSTEM OWNER');
        $karyawan = $this->karyawan([
            'nama'      => 'KARYAWAN SO',
            'bidang_id' => $bidang->id,
            'bidang'    => 'ENJINIRING',
            'jabatan'   => 'ASSISTANT MANAGER SYSTEM OWNER',
        ]);

        $this->jalankanMigration();

        $snapshot = DB::table('jabatans')->orderBy('id')->get()->toArray();
        $karyawanSnapshot = DB::table('karyawans')->orderBy('id')->get()->toArray();

        $this->jalankanMigration();

        $this->assertEquals($snapshot, DB::table('jabatans')->orderBy('id')->get()->toArray());
        $this->assertEquals($karyawanSnapshot, DB::table('karyawans')->orderBy('id')->get()->toArray());

        $this->assertSame($bidang->id, (int) DB::table('jabatans')->where('id', $jabatan)->value('bidang_id'));
        $this->assertSame($jabatan, (int) $karyawan->fresh()->jabatan_id);
    }
}
