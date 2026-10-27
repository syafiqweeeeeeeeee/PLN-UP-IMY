<?php

namespace Tests\Feature;

use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\MasterBidangJabatanSeeder;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

/**
 * DATA KARYAWAN × MASTER BIDANG/JABATAN.
 *
 * Mencakup spesifikasi integrasi:
 * - Form tambah/edit memakai dropdown master; teks SELALU diturunkan dari
 *   master saat relasi dipilih (pasangan id ↔ nama tidak bertentangan).
 * - Jabatan dari bidang lain / tanpa bidang ditolak server-side.
 * - Teks lama yang belum terpetakan tidak hilang saat diedit, dan tetap
 *   tampil/dicari/difilter/diekspor.
 * - Impor memetakan nama ke id (normalisasi spasi & huruf besar/kecil),
 *   tidak menebak saat ambigu, dan tidak membuat master baru.
 * - Backfill aman dijalankan ulang & tidak menimpa relasi yang sudah ada.
 */
class DataKaryawanMasterIntegrationTest extends TestCase
{
    use RefreshDatabase;

    private const PERMISSIONS = [
        'karyawan_data.view', 'karyawan_data.create', 'karyawan_data.edit', 'karyawan_data.delete',
        'master_bidang.view', 'master_bidang.delete',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(PermissionSeeder::class);
    }

    /* =========================================================
       HELPER
       ========================================================= */

    private function user(): User
    {
        $user = User::factory()->create();

        $user->syncPermissions(
            Permission::whereIn('name', self::PERMISSIONS)->pluck('id')->all()
        );

        return $user;
    }

    private function bidang(string $nama, ?Bidang $parent = null): Bidang
    {
        return Bidang::create(['nama' => $nama, 'parent_id' => $parent?->id]);
    }

    private function jabatan(string $nama, Bidang $bidang): Jabatan
    {
        return Jabatan::create(['nama' => $nama, 'bidang_id' => $bidang->id]);
    }

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'nid' => '00123',
            'nama' => 'Budi Santoso',
        ], $overrides);
    }

    /** Impor CSV 24 kolom; $rows berisi nilai mulai dari kolom NID. */
    private function importCsv(array $rows): void
    {
        $lines = [implode(';', array_values(Karyawan::COLUMNS_LABELS))];

        foreach ($rows as $row) {
            $lines[] = implode(';', array_pad($row, 24, ''));
        }

        $file = UploadedFile::fake()->createWithContent('karyawan.csv', implode("\n", $lines));

        $this->actingAs($this->user())
            ->post(route('admin.karyawan_data.import'), ['file' => $file, 'mode' => 'skip'])
            ->assertRedirect(route('admin.karyawan_data.index'));
    }

    /* =========================================================
       1. FORM — DROPDOWN MASTER & VALIDASI SERVER
       ========================================================= */

    public function test_store_saves_master_ids_and_derives_text_from_master(): void
    {
        $bidang = $this->bidang('BIDANG OPERASI');
        $jabatan = $this->jabatan('MANAGER OPERASI', $bidang);

        $this->actingAs($this->user())
            ->post(route('admin.karyawan_data.store'), $this->payload([
                'bidang_id' => (string) $bidang->id,
                'jabatan_id' => (string) $jabatan->id,
                // Teks kiriman sengaja berbeda — server harus memakai nama master.
                'bidang_text' => 'TEKS NGawur',
                'jabatan_text' => 'TEKS NGawur',
            ]))
            ->assertRedirect(route('admin.karyawan_data.index'));

        $karyawan = Karyawan::where('nid', '00123')->firstOrFail();

        $this->assertSame($bidang->id, $karyawan->bidang_id);
        $this->assertSame($jabatan->id, $karyawan->jabatan_id);
        $this->assertSame('BIDANG OPERASI', $karyawan->bidang);
        $this->assertSame('MANAGER OPERASI', $karyawan->jabatan);

        // Bidang induk jabatan bisa ditelusuri dari relasi master.
        $this->assertSame('BIDANG OPERASI', $karyawan->jabatanMaster->bidang->nama);
    }

    public function test_jabatan_from_another_bidang_is_rejected(): void
    {
        $operasi = $this->bidang('BIDANG OPERASI');
        $logistik = $this->bidang('BIDANG LOGISTIK');
        $jabatanLogistik = $this->jabatan('MANAGER LOGISTIK', $logistik);

        $this->actingAs($this->user())
            ->post(route('admin.karyawan_data.store'), $this->payload([
                'bidang_id' => (string) $operasi->id,
                'jabatan_id' => (string) $jabatanLogistik->id,
            ]))
            ->assertSessionHasErrors('jabatan_id');

        $this->assertDatabaseMissing('karyawans', ['nid' => '00123']);
    }

    public function test_jabatan_master_requires_selected_bidang(): void
    {
        $bidang = $this->bidang('BIDANG OPERASI');
        $jabatan = $this->jabatan('MANAGER OPERASI', $bidang);

        $this->actingAs($this->user())
            ->post(route('admin.karyawan_data.store'), $this->payload([
                'bidang_id' => '',
                'jabatan_id' => (string) $jabatan->id,
            ]))
            ->assertSessionHasErrors('jabatan_id');

        $this->assertDatabaseMissing('karyawans', ['nid' => '00123']);
    }

    public function test_unknown_master_id_is_rejected(): void
    {
        $this->actingAs($this->user())
            ->post(route('admin.karyawan_data.store'), $this->payload([
                'bidang_id' => '999999',
            ]))
            ->assertSessionHasErrors('bidang_id');

        $this->assertDatabaseMissing('karyawans', ['nid' => '00123']);
    }

    /* =========================================================
       2. EDIT — NILAI LAMA TIDAK HILANG
       ========================================================= */

    public function test_edit_keeps_legacy_text_when_not_mapped(): void
    {
        $karyawan = Karyawan::factory()->create([
            'nid' => '300',
            'bidang' => 'BIDANG TIDAK DIKENAL',
            'jabatan' => 'JABATAN TIDAK DIKENAL',
        ]);

        $this->actingAs($this->user())
            ->put(route('admin.karyawan_data.update', $karyawan), $this->payload([
                'nid' => '300',
                'nama' => 'Nama Baru',
                'bidang_id' => 'legacy',
                'jabatan_id' => 'legacy',
                'bidang_text' => 'BIDANG TIDAK DIKENAL',
                'jabatan_text' => 'JABATAN TIDAK DIKENAL',
            ]))
            ->assertRedirect(route('admin.karyawan_data.index'));

        $fresh = $karyawan->fresh();

        $this->assertSame('Nama Baru', $fresh->nama);
        $this->assertSame('BIDANG TIDAK DIKENAL', $fresh->bidang);
        $this->assertSame('JABATAN TIDAK DIKENAL', $fresh->jabatan);
        $this->assertNull($fresh->bidang_id);
        $this->assertNull($fresh->jabatan_id);
    }

    public function test_edit_form_shows_legacy_value_and_master_options(): void
    {
        $bidang = $this->bidang('BIDANG OPERASI');

        $karyawan = Karyawan::factory()->create([
            'bidang' => 'BIDANG LAMA',
            'jabatan' => 'JABATAN LAMA',
        ]);

        $this->actingAs($this->user())
            ->get(route('admin.karyawan_data.edit', $karyawan))
            ->assertOk()
            ->assertSee('BIDANG LAMA (teks lama — belum dipetakan)')
            ->assertSee('JABATAN LAMA (teks lama — belum dipetakan)')
            ->assertSee($bidang->nama);
    }

    public function test_edit_form_preselects_current_master_values(): void
    {
        $bidang = $this->bidang('BIDANG OPERASI');
        $jabatan = $this->jabatan('MANAGER OPERASI', $bidang);

        $karyawan = Karyawan::factory()->create([
            'bidang_id' => $bidang->id,
            'bidang' => 'BIDANG OPERASI',
            'jabatan_id' => $jabatan->id,
            'jabatan' => 'MANAGER OPERASI',
        ]);

        $html = $this->actingAs($this->user())
            ->get(route('admin.karyawan_data.edit', $karyawan))
            ->assertOk()
            ->getContent();

        $this->assertMatchesRegularExpression(
            '/value="'.$bidang->id.'"\s+selected/s',
            $html,
            'Bidang karyawan saat ini harus terpilih di dropdown.'
        );

        $this->assertMatchesRegularExpression(
            '/value="'.$jabatan->id.'"[^>]*selected/s',
            $html,
            'Jabatan karyawan saat ini harus terpilih di dropdown.'
        );
    }

    public function test_clear_choice_removes_legacy_text(): void
    {
        $karyawan = Karyawan::factory()->create(['bidang' => 'BIDANG LAMA']);

        $this->actingAs($this->user())
            ->put(route('admin.karyawan_data.update', $karyawan), $this->payload([
                'nid' => $karyawan->nid,
                'bidang_id' => 'clear',
                'bidang_text' => 'BIDANG LAMA',
            ]))
            ->assertRedirect(route('admin.karyawan_data.index'));

        $this->assertNull($karyawan->fresh()->bidang);
        $this->assertNull($karyawan->fresh()->bidang_id);
    }

    public function test_update_switches_master_reference_and_keeps_text_in_sync(): void
    {
        $lama = $this->bidang('BIDANG LAMA');
        $baru = $this->bidang('BIDANG BARU');
        $jabatan = $this->jabatan('MANAGER BARU', $baru);

        $karyawan = Karyawan::factory()->create([
            'bidang_id' => $lama->id,
            'bidang' => 'BIDANG LAMA',
        ]);

        $this->actingAs($this->user())
            ->put(route('admin.karyawan_data.update', $karyawan), $this->payload([
                'nid' => $karyawan->nid,
                'bidang_id' => (string) $baru->id,
                'jabatan_id' => (string) $jabatan->id,
                'bidang_text' => 'BIDANG LAMA',
            ]))
            ->assertRedirect(route('admin.karyawan_data.index'));

        $fresh = $karyawan->fresh();

        $this->assertSame($baru->id, $fresh->bidang_id);
        $this->assertSame('BIDANG BARU', $fresh->bidang);
        $this->assertSame($jabatan->id, $fresh->jabatan_id);
        $this->assertSame('MANAGER BARU', $fresh->jabatan);
    }

    /* =========================================================
       3. FILTER, PENCARIAN, TAMPILAN
       ========================================================= */

    public function test_filter_uses_master_relation_legacy_text_and_subtree(): void
    {
        $operasi = $this->bidang('BIDANG OPERASI');
        $logistik = $this->bidang('BIDANG LOGISTIK');
        $produkA = $this->bidang('SUB BIDANG PRODUKSI A', $operasi);

        Karyawan::factory()->create(['nid' => '801', 'bidang_id' => $operasi->id, 'bidang' => 'BIDANG OPERASI']);
        // Data lama: kolom bidang_id masih NULL, hanya teks yang sama
        // dengan master (kondisi dominan di database produksi).
        Karyawan::factory()->create(['nid' => '802', 'bidang' => 'BIDANG OPERASI']);
        Karyawan::factory()->create(['nid' => '804', 'bidang' => 'SUB BIDANG PRODUKSI A']);
        Karyawan::factory()->create(['nid' => '805', 'bidang_id' => $produkA->id, 'bidang' => 'SUB BIDANG PRODUKSI A']);
        Karyawan::factory()->create(['nid' => '803', 'bidang' => 'TEKS LAMA KHUSUS']);

        // Pilih bidang induk → node + seluruh sub-bidang, lewat kolom id
        // MAUPUN teks lama (sebelumnya baris id-NULL tidak pernah muncul).
        $response = $this->actingAs($this->user())
            ->get(route('admin.karyawan_data.index', ['bidang' => '#'.$operasi->id]));

        $response->assertOk();
        $this->assertSame(
            ['801', '802', '804', '805'],
            $response->viewData('karyawans')->pluck('nid')->sort()->values()->all()
        );

        // Bidang lain tidak menarik baris di luar sub-pohonnya.
        $response = $this->actingAs($this->user())
            ->get(route('admin.karyawan_data.index', ['bidang' => '#'.$logistik->id]));

        $this->assertSame([], $response->viewData('karyawans')->pluck('nid')->all());

        // Filter teks lama tetap menemukan data yang belum ada di master.
        $response = $this->actingAs($this->user())
            ->get(route('admin.karyawan_data.index', ['bidang' => 'TEKS LAMA KHUSUS']));

        $this->assertSame(['803'], $response->viewData('karyawans')->pluck('nid')->all());

        // Opsi filter menampilkan master + nilai lama (tetap bisa dipilih).
        $this->actingAs($this->user())
            ->get(route('admin.karyawan_data.index'))
            ->assertSee('#'.$logistik->id)
            ->assertSee('TEKS LAMA KHUSUS');
    }

    public function test_bidang_dropdown_uses_indentation_without_dash_prefix(): void
    {
        $operasi = $this->bidang('BIDANG OPERASI');
        $this->bidang('SUB BIDANG PRODUKSI A', $operasi);

        $html = $this->actingAs($this->user())
            ->get(route('admin.karyawan_data.index'))
            ->assertOk()
            ->getContent();

        $nbsp = "\u{00A0}";

        // Level 1 ditandai indentasi NBSP — bukan strip "—" yang terbaca
        // seperti sebagian nama bidang.
        $this->assertStringContainsString($nbsp.$nbsp.$nbsp.'SUB BIDANG PRODUKSI A', $html);
        $this->assertStringNotContainsString('— SUB BIDANG PRODUKSI A', $html);
        $this->assertStringNotContainsString('— BIDANG OPERASI', $html);
    }

    public function test_removed_jabatan_filter_is_ignored(): void
    {
        $bidang = $this->bidang('BIDANG OPERASI');
        $jabatan = $this->jabatan('MANAGER OPERASI', $bidang);

        Karyawan::factory()->create(['nid' => '811', 'jabatan_id' => $jabatan->id, 'jabatan' => 'MANAGER OPERASI']);
        Karyawan::factory()->create(['nid' => '812', 'jabatan' => 'MANAGER OPERASI']);

        // Filter JABATAN sudah dihapus dari halaman daftar (pencarian
        // hanya NID/NAMA + BIDANG) — parameter lama diabaikan backend.
        $response = $this->actingAs($this->user())
            ->get(route('admin.karyawan_data.index', ['jabatan' => '#'.$jabatan->id]));

        $response->assertOk();
        $this->assertSame(
            ['811', '812'],
            $response->viewData('karyawans')->pluck('nid')->sort()->values()->all(),
            'Parameter jabatan tidak boleh lagi menyaring baris.'
        );
    }

    public function test_legacy_rows_stay_searchable_and_visible(): void
    {
        $karyawan = Karyawan::factory()->create([
            'nid' => '9001',
            'nama' => 'Data Lama',
            'bidang' => 'BIDANG TIDAK DIKENAL',
            'jabatan' => 'JABATAN TIDAK DIKENAL',
        ]);

        $this->actingAs($this->user())
            ->get(route('admin.karyawan_data.index', ['q' => 'Data Lama']))
            ->assertOk()
            ->assertSee('BIDANG TIDAK DIKENAL')
            // Dropdown JABATAN sudah dihapus dari halaman daftar (pencarian
            // kini hanya NID/NAMA + BIDANG)…
            ->assertDontSee('name="jabatan"');

        // …namun teks lamanya tetap tampil utuh di halaman Detail, dan
        // parameter `jabatan` (filter yang sudah dihapus) kini DIABAIKAN —
        // baris lain tetap ikut tampil.
        Karyawan::factory()->create([
            'nid' => '9002',
            'nama' => 'Data Baru',
            'bidang' => 'BIDANG LAIN',
            'jabatan' => 'JABATAN LAIN',
        ]);

        $this->actingAs($this->user())
            ->get(route('admin.karyawan_data.index', ['jabatan' => 'JABATAN TIDAK DIKENAL']))
            ->assertOk()
            ->assertSee('Data Lama')
            ->assertSee('Data Baru');

        $this->actingAs($this->user())
            ->get(route('admin.karyawan_data.show', $karyawan))
            ->assertOk()
            ->assertSee('BIDANG TIDAK DIKENAL')
            ->assertSee('JABATAN TIDAK DIKENAL');
    }

    /* =========================================================
       4. IMPOR — PEMETAAN NAMA, AMBIGU, TANPA MASTER BARU
       ========================================================= */

    public function test_import_maps_names_to_master_and_keeps_unmatched_text(): void
    {
        $bidang = $this->bidang('BIDANG  OPERASI'); // spasi ganda di master
        $jabatan = $this->jabatan('MANAGER OPERASI', $bidang);

        $this->importCsv([
            // Huruf kecil & spasi tunggal — tetap harus cocok.
            ['1001', 'Cocok', 'bidang operasi', 'manager operasi'],
            ['1002', 'Tidak Cocok', 'BIDANG ASING', 'JABATAN ASING'],
        ]);

        $cocok = Karyawan::where('nid', '1001')->firstOrFail();
        $this->assertSame($bidang->id, $cocok->bidang_id);
        $this->assertSame($jabatan->id, $cocok->jabatan_id);
        // Teks asli dari file dipertahankan apa adanya.
        $this->assertSame('bidang operasi', $cocok->bidang);
        $this->assertSame('manager operasi', $cocok->jabatan);

        $tidakCocok = Karyawan::where('nid', '1002')->firstOrFail();
        $this->assertNull($tidakCocok->bidang_id);
        $this->assertNull($tidakCocok->jabatan_id);
        $this->assertSame('BIDANG ASING', $tidakCocok->bidang);
        $this->assertSame('JABATAN ASING', $tidakCocok->jabatan);

        // Tidak ada master baru yang dibuat.
        $this->assertSame(1, Bidang::count());
        $this->assertSame(1, Jabatan::count());

        $summary = session('import_summary');
        $this->assertSame(1, $summary['mapping']['bidang']['matched']);
        $this->assertSame(1, $summary['mapping']['bidang']['unmapped']);
        $this->assertSame(1, $summary['mapping']['jabatan']['matched']);
        $this->assertSame(1, $summary['mapping']['jabatan']['unmapped']);
    }

    public function test_import_does_not_guess_when_bidang_name_is_ambiguous(): void
    {
        $this->bidang('BIDANG GANDA');
        $this->bidang('BIDANG GANDA');

        $this->importCsv([
            ['2001', 'Ambigu', 'BIDANG GANDA', ''],
        ]);

        $karyawan = Karyawan::where('nid', '2001')->firstOrFail();

        $this->assertNull($karyawan->bidang_id, 'Nama ambigu tidak boleh dipetakan otomatis.');
        $this->assertSame('BIDANG GANDA', $karyawan->bidang, 'Teks lama harus tetap utuh.');
        $this->assertSame(2, Bidang::count(), 'Impor tidak boleh membuat master baru.');

        $summary = session('import_summary');
        $this->assertSame(1, $summary['mapping']['bidang']['ambiguous']);
    }

    public function test_import_does_not_map_jabatan_when_bidang_is_unmapped(): void
    {
        $bidang = $this->bidang('BIDANG OPERASI');
        $this->jabatan('MANAGER OPERASI', $bidang);

        $this->importCsv([
            ['3001', 'Bidang Asing', 'BIDANG ASING', 'MANAGER OPERASI'],
        ]);

        $karyawan = Karyawan::where('nid', '3001')->firstOrFail();

        $this->assertNull($karyawan->bidang_id);
        $this->assertNull($karyawan->jabatan_id, 'Jabatan tidak boleh dipetakan tanpa bidang induknya.');
    }

    /* =========================================================
       5. EKSPOR — FORMAT LAMA DIPERTAHANKAN
       ========================================================= */

    public function test_export_keeps_text_columns_and_legacy_values(): void
    {
        Karyawan::factory()->create([
            'nid' => '80001',
            'bidang' => 'BIDANG TIDAK DIKENAL',
            'jabatan' => 'JABATAN TIDAK DIKENAL',
        ]);

        $response = $this->actingAs($this->user())
            ->get(route('admin.karyawan_data.export', ['bidang' => 'BIDANG TIDAK DIKENAL']));

        $response->assertOk();
        $content = $response->streamedContent();

        $this->assertStringContainsString('80001', $content);
        $this->assertStringContainsString('BIDANG TIDAK DIKENAL', $content);
        $this->assertStringContainsString('JABATAN TIDAK DIKENAL', $content);

        foreach (array_values(Karyawan::COLUMNS_LABELS) as $label) {
            $this->assertStringContainsString($label, $content, "Ekspor harus memuat header {$label}.");
        }
    }

    /* =========================================================
       6. BACKFILL — AMAN & IDEMPOTEN
       ========================================================= */

    public function test_backfill_requires_apply_and_only_fills_null_ids(): void
    {
        $bidang = $this->bidang('BIDANG OPERASI');
        $jabatan = $this->jabatan('MANAGER OPERASI', $bidang);

        $belum = Karyawan::factory()->create([
            'nid' => '5001',
            'bidang' => 'bidang operasi',
            'jabatan' => 'Manager Operasi',
        ]);

        $sudah = Karyawan::factory()->create([
            'nid' => '5002',
            'bidang_id' => $bidang->id,
            'bidang' => 'BIDANG OPERASI',
        ]);

        // Tanpa --apply: simulasi, tidak ada tulisan.
        $this->artisan('karyawan:backfill-master')->assertSuccessful();
        $this->assertNull($belum->fresh()->bidang_id);

        $this->artisan('karyawan:backfill-master', ['--apply' => true])->assertSuccessful();

        $fresh = $belum->fresh();
        $this->assertSame($bidang->id, $fresh->bidang_id);
        $this->assertSame($jabatan->id, $fresh->jabatan_id);
        // Kolom teks tidak diubah.
        $this->assertSame('bidang operasi', $fresh->bidang);

        // Relasi yang sudah ada tidak ditimpa.
        $this->assertSame($bidang->id, $sudah->fresh()->bidang_id);

        $terpetakan = Karyawan::whereNotNull('bidang_id')->count();

        // Dijalankan ulang: tidak ada relasi ganda / perubahan baru.
        $this->artisan('karyawan:backfill-master', ['--apply' => true])->assertSuccessful();

        $this->assertSame($terpetakan, Karyawan::whereNotNull('bidang_id')->count());
        $this->assertSame(1, Karyawan::where('nid', '5001')->count());
    }

    /* =========================================================
       7. MASTER TIDAK BISA DIHAPUS SAAT MASIH DIPAKAI RELASI ID
       ========================================================= */

    public function test_master_used_only_by_id_cannot_be_deleted(): void
    {
        $bidang = $this->bidang('BIDANG OPERASI');

        // Tanpa kolom teks — proteksi harus tetap jalan lewat bidang_id.
        Karyawan::factory()->create(['nid' => '6001', 'bidang_id' => $bidang->id, 'bidang' => null]);

        $this->actingAs($this->user())
            ->delete(route('admin.master_bidang.destroy', $bidang))
            ->assertRedirect(route('admin.master_bidang.index'))
            ->assertSessionHasErrors('delete');

        $this->assertDatabaseHas('bidangs', ['id' => $bidang->id]);
    }

    /* =========================================================
       8. SEEDER MASTER — AMAN DIJALANKAN BERULANG
       ========================================================= */

    public function test_master_seeder_creates_hierarchy_once_and_is_idempotent(): void
    {
        $this->seed(MasterBidangJabatanSeeder::class);

        $this->assertSame(38, Bidang::count());
        $this->assertSame(5, Jabatan::count());

        $akar = Bidang::where('nama', 'PLTU INDRAMAYU')->firstOrFail();
        $this->assertNull($akar->parent_id);
        $this->assertSame(
            (int) $akar->id,
            (int) Bidang::where('nama', 'BIDANG OPERASI')->value('parent_id')
        );

        // Dijalankan ulang — tidak boleh menduplikasi bidang/jabatan.
        $this->seed(MasterBidangJabatanSeeder::class);

        $this->assertSame(38, Bidang::count());
        $this->assertSame(5, Jabatan::count());
    }

    /* =========================================================
       9. HAK AKSES TIDAK BERUBAH
       ========================================================= */

    public function test_user_without_karyawan_permission_still_forbidden(): void
    {
        // Akun admin tanpa permission karyawan_data.* → 403 di backend
        // (aturan lama tidak berubah oleh integrasi master).
        $admin = User::factory()->create([
            'role' => 'Admin Bidang',
            'role_id' => Role::where('name', 'Admin Bidang')->value('id'),
        ]);
        $admin->roles()->syncWithoutDetaching([Role::where('name', 'Admin Bidang')->value('id')]);

        $this->actingAs($admin)
            ->get(route('admin.karyawan_data.index'))
            ->assertForbidden();
    }
}
