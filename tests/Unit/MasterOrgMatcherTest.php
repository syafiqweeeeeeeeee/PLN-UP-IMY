<?php

namespace Tests\Unit;

use App\Models\Bidang;
use App\Models\Jabatan;
use App\Services\MasterOrgMatcher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * WHITE-BOX — App\Services\MasterOrgMatcher
 *
 * Peta cabang (resolveBidang / resolveJabatan):
 *   bidang  : kosong → EMPTY | 1 kandidat → MATCHED | 0 → UNMAPPED | >1 → AMBIGUOUS
 *   jabatan : kosong → EMPTY | 0 kandidat → UNMAPPED
 *             ada kandidat tapi bidang belum terpetakan → status mengikuti
 *               bidang (AMBIGUOUS bila bidangnya ambigu, selain itu UNMAPPED)
 *             1 kandidat di bidang yang sama → MATCHED
 *             >1 kandidat di bidang yang sama → AMBIGUOUS
 *             0 kandidat di bidang itu (namanya ada di bidang lain) → AMBIGUOUS
 *
 * Catatan: index dibangun di CONSTRUCTOR — master yang dibuat setelah
 * instance dibuat TIDAK ikut terindeks (dibuktikan di test terakhir).
 */
class MasterOrgMatcherTest extends TestCase
{
    use RefreshDatabase;

    private int $sdmId;

    private int $teknikId;

    private int $humasId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sdmId   = (int) Bidang::create(['nama' => 'Bagian SDM'])->id;
        $this->teknikId = (int) Bidang::create(['nama' => 'Bagian Teknik'])->id;
        $this->humasId = (int) Bidang::create(['nama' => 'Bagian Humas'])->id;

        // Duplikat nama (tanpa unique index) → cabang AMBIGUOUS
        Bidang::create(['nama' => 'BAGIAN HUMAS']);

        Jabatan::create(['nama' => 'Kepala Bagian', 'bidang_id' => $this->sdmId]);
        Jabatan::create(['nama' => 'Staf', 'bidang_id' => $this->teknikId]);
    }

    private function matcher(): MasterOrgMatcher
    {
        return new MasterOrgMatcher();
    }

    /* =========================================================
       normalize — dasar seluruh perbandingan
       ========================================================= */

    public function test_normalize_merapikan_spasi_dan_mengubah_ke_huruf_besar(): void
    {
        $this->assertSame('BAGIAN SDM', MasterOrgMatcher::normalize('  bagian   sdm '));
        $this->assertSame('BAGIAN SDM', MasterOrgMatcher::normalize("bagian\n\tsdm"));
        $this->assertSame('', MasterOrgMatcher::normalize(null));
        $this->assertSame('', MasterOrgMatcher::normalize('   '));
    }

    public function test_pencocokan_tidak_peduli_huruf_besar_dan_spasi_berlebih(): void
    {
        $hasil = $this->matcher()->match('  bagian   sdm ', null);

        $this->assertSame(MasterOrgMatcher::MATCHED, $hasil['bidang_status']);
        $this->assertSame($this->sdmId, $hasil['bidang_id']);
        $this->assertSame([], $hasil['notes']);
    }

    /* =========================================================
       Cabang resolveBidang
       ========================================================= */

    public function test_bidang_kosong_berstatus_empty_tanpa_catatan(): void
    {
        foreach ([null, '', '   '] as $input) {
            $hasil = $this->matcher()->match($input, null);

            $this->assertSame(MasterOrgMatcher::EMPTY_INPUT, $hasil['bidang_status'], "input: " . var_export($input, true));
            $this->assertNull($hasil['bidang_id']);
            $this->assertSame([], $hasil['notes']);
        }
    }

    public function test_bidang_tidak_ada_di_master_berstatus_unmapped_dengan_catatan(): void
    {
        $hasil = $this->matcher()->match('Bagian Pemasaran', null);

        $this->assertSame(MasterOrgMatcher::UNMAPPED, $hasil['bidang_status']);
        $this->assertNull($hasil['bidang_id']);
        $this->assertCount(1, $hasil['notes']);
        $this->assertStringContainsString('tidak ada di master', $hasil['notes'][0]);
        $this->assertStringContainsString('Bagian Pemasaran', $hasil['notes'][0]);
    }

    public function test_nama_bidang_yang_duplikat_di_master_berstatus_ambiguous(): void
    {
        $hasil = $this->matcher()->match('bagian humas', null);

        $this->assertSame(MasterOrgMatcher::AMBIGUOUS, $hasil['bidang_status']);
        $this->assertNull($hasil['bidang_id']);
        $this->assertCount(1, $hasil['notes']);
        $this->assertStringContainsString('lebih dari satu master', $hasil['notes'][0]);
    }

    /* =========================================================
       Cabang resolveJabatan
       ========================================================= */

    public function test_pasangan_bidang_dan_jabatan_valid_terpetakan_sempurna(): void
    {
        $hasil = $this->matcher()->match('Bagian SDM', 'kepala  bagian');

        $this->assertSame(MasterOrgMatcher::MATCHED, $hasil['bidang_status']);
        $this->assertSame(MasterOrgMatcher::MATCHED, $hasil['jabatan_status']);
        $this->assertSame($this->sdmId, $hasil['bidang_id']);
        $this->assertNotNull($hasil['jabatan_id']);
        $this->assertSame([], $hasil['notes']);
    }

    public function test_jabatan_kosong_hanya_bidang_yang_diisi(): void
    {
        $hasil = $this->matcher()->match('Bagian SDM', '');

        $this->assertSame(MasterOrgMatcher::MATCHED, $hasil['bidang_status']);
        $this->assertSame(MasterOrgMatcher::EMPTY_INPUT, $hasil['jabatan_status']);
        $this->assertNull($hasil['jabatan_id']);
        $this->assertSame([], $hasil['notes']);
    }

    public function test_jabatan_tidak_ada_di_master_berstatus_unmapped(): void
    {
        $hasil = $this->matcher()->match('Bagian SDM', 'Direktur Utama');

        $this->assertSame(MasterOrgMatcher::MATCHED, $hasil['bidang_status']);
        $this->assertSame(MasterOrgMatcher::UNMAPPED, $hasil['jabatan_status']);
        $this->assertStringContainsString('tidak ada di master', $hasil['notes'][0]);
    }

    public function test_jabatan_dipetakan_hanya_bila_bidangnya_juga_terpetakan(): void
    {
        // Bidang tidak dikenal → hubungan jabatan-bidang tak bisa dipastikan
        $hasil = $this->matcher()->match('Bagian Pemasaran', 'Kepala Bagian');

        $this->assertSame(MasterOrgMatcher::UNMAPPED, $hasil['bidang_status']);
        $this->assertSame(MasterOrgMatcher::UNMAPPED, $hasil['jabatan_status']);
        $this->assertNull($hasil['jabatan_id']);
        $this->assertCount(2, $hasil['notes']);
        $this->assertStringContainsString('belum dapat dipetakan', $hasil['notes'][1]);
    }

    public function test_jabatan_terpetakan_pada_bidang_yang_ambiguous_mewarisi_status_ambiguous(): void
    {
        $hasil = $this->matcher()->match('bagian humas', 'Kepala Bagian');

        $this->assertSame(MasterOrgMatcher::AMBIGUOUS, $hasil['bidang_status']);
        $this->assertSame(MasterOrgMatcher::AMBIGUOUS, $hasil['jabatan_status']);
        $this->assertNull($hasil['bidang_id']);
        $this->assertNull($hasil['jabatan_id']);
        // Catatan: ambigu-nya bidang + jabatan belum bisa dipetakan
        $this->assertCount(2, $hasil['notes']);
    }

    public function test_bidang_kosong_membuat_jabatan_valid_jadi_unmapped(): void
    {
        $hasil = $this->matcher()->match('', 'Kepala Bagian');

        $this->assertSame(MasterOrgMatcher::EMPTY_INPUT, $hasil['bidang_status']);
        $this->assertSame(MasterOrgMatcher::UNMAPPED, $hasil['jabatan_status']);
        $this->assertNull($hasil['jabatan_id']);
        $this->assertCount(1, $hasil['notes']);
    }

    public function test_jabatan_yang_ada_di_bidang_lain_berstatus_ambiguous(): void
    {
        // 'Staf' ada di master, tapi di Bagian Teknik — bukan di Bagian SDM
        $hasil = $this->matcher()->match('Bagian SDM', 'Staf');

        $this->assertSame(MasterOrgMatcher::MATCHED, $hasil['bidang_status']);
        $this->assertSame(MasterOrgMatcher::AMBIGUOUS, $hasil['jabatan_status']);
        $this->assertNull($hasil['jabatan_id']);
        $this->assertStringContainsString('bidang lain', $hasil['notes'][0]);
    }

    public function test_jabatan_duplikat_dalam_bidang_yang_sama_berstatus_ambiguous(): void
    {
        Jabatan::create(['nama' => 'Staf', 'bidang_id' => $this->teknikId]);

        $hasil = $this->matcher()->match('Bagian Teknik', 'Staf');

        $this->assertSame(MasterOrgMatcher::MATCHED, $hasil['bidang_status']);
        $this->assertSame(MasterOrgMatcher::AMBIGUOUS, $hasil['jabatan_status']);
        $this->assertNull($hasil['jabatan_id']);
        $this->assertStringContainsString('lebih dari satu master di bidang yang sama', $hasil['notes'][0]);
    }

    /* =========================================================
       Sifat index: dibangun sekali di constructor
       ========================================================= */

    public function test_master_baru_setelah_instance_dibuat_tidak_terbaca(): void
    {
        $matcher = $this->matcher();

        Bidang::create(['nama' => 'Bagian Legal']);

        // Index dibuat saat constructor → nama baru belum terindeks
        $this->assertSame(
            MasterOrgMatcher::UNMAPPED,
            $matcher->match('Bagian Legal', null)['bidang_status']
        );

        // Instance baru membaca master terkini
        $this->assertSame(
            MasterOrgMatcher::MATCHED,
            $this->matcher()->match('Bagian Legal', null)['bidang_status']
        );
    }
}