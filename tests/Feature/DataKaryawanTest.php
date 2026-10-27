<?php

namespace Tests\Feature;

use App\Models\Bidang;
use App\Models\Department;
use App\Models\EmployeeProfile;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Tests\Support\XlsxWriter;
use Tests\TestCase;

/**
 * DATA KARYAWAN — panel admin (/admin/data-karyawan).
 *
 * Mencakup penerimaan spesifikasi:
 * - CRUD + otorisasi permission karyawan_data.* (RBAC yang sudah ada).
 * - NID unik: validasi form & dilewati saat impor (tidak menimpa).
 * - Impor CSV 300 baris: ringkasan sukses/gagal/duplikat, transaksi.
 * - Impor XLSX: parser ZIP+XML native (XlsxReader, tanpa ext-zip) —
 *   24 kolom, NID nol di depan, angka, serial tanggal, header salah,
 *   kolom ORGANIK, file rusak; penulis arsip ZIP diuji langsung.
 * - Pencarian NID/NAMA, filter dropdown, pagination, ekspor mengikuti
 *   filter aktif.
 */
class DataKaryawanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(PermissionSeeder::class);
    }

    /**
     * Akun Super Admin (memiliki semua permission termasuk
     * karyawan_data.*).
     */
    private function superAdmin(): User
    {
        $user = User::factory()->create([
            'role' => 'Super Admin',
            'role_id' => Role::where('name', 'Super Admin')->value('id'),
        ]);
        $user->roles()->syncWithoutDetaching([Role::where('name', 'Super Admin')->value('id')]);

        return $user;
    }

    /**
     * Akun Karyawan dengan direct permission karyawan_data.*
     * (pola "setengah admin" — pola sama dengan DirectPermissionTest).
     */
    private function hrUser(array $permissions = ['karyawan_data.view', 'karyawan_data.create', 'karyawan_data.edit', 'karyawan_data.delete']): User
    {
        $user = User::factory()->create([
            'role' => 'Karyawan',
            'role_id' => Role::where('name', 'Karyawan')->value('id'),
        ]);
        $user->roles()->syncWithoutDetaching([Role::where('name', 'Karyawan')->value('id')]);

        $ids = Permission::whereIn('name', $permissions)->pluck('id')->all();
        $user->syncPermissions($ids);

        return $user;
    }

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'nid' => '00123',
            'nama' => 'Budi Santoso',
        ], $overrides);
    }

    /* =========================================================
       1. OTORISASI
       ========================================================= */

    public function test_user_without_permission_is_forbidden(): void
    {
        // Akun admin tanpa permission karyawan_data.* → 403 di backend
        // (bukan sekadar tombol disembunyikan).
        $admin = User::factory()->create([
            'role' => 'Admin Bidang',
            'role_id' => Role::where('name', 'Admin Bidang')->value('id'),
        ]);
        $admin->roles()->syncWithoutDetaching([Role::where('name', 'Admin Bidang')->value('id')]);

        $this->actingAs($admin)->get(route('admin.karyawan_data.index'))->assertForbidden();
        $this->actingAs($admin)->post(route('admin.karyawan_data.store'), $this->payload())->assertForbidden();
    }

    public function test_karyawan_with_extra_permission_can_access(): void
    {
        // Karyawan berpermission ekstra lolos middleware admin.access
        // ("setengah admin") dan bisa memakai modul ini.
        $this->actingAs($this->hrUser())
            ->get(route('admin.karyawan_data.index'))
            ->assertOk();
    }

    public function test_super_admin_can_access(): void
    {
        $this->actingAs($this->superAdmin())
            ->get(route('admin.karyawan_data.index'))
            ->assertOk();
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get(route('admin.karyawan_data.index'))->assertRedirect(route('login'));
    }

    /* =========================================================
       2. CRUD & VALIDASI NID UNIK
       ========================================================= */

    public function test_store_creates_karyawan_and_stores_nid_with_leading_zero(): void
    {
        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.store'), $this->payload([
                'nid' => '007',
                'gender' => 'L',
                'hp' => '081234567890',
            ]))
            ->assertRedirect(route('admin.karyawan_data.index'));

        $karyawan = Karyawan::where('nid', '007')->first();
        $this->assertNotNull($karyawan, 'NID dengan nol di depan harus tersimpan sebagai string.');
        $this->assertSame('007', $karyawan->nid);
        $this->assertSame('081234567890', $karyawan->hp);
    }

    public function test_store_rejects_duplicate_nid(): void
    {
        Karyawan::factory()->create(['nid' => '111']);

        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.store'), $this->payload(['nid' => '111']))
            ->assertSessionHasErrors('nid');

        $this->assertSame(1, Karyawan::where('nid', '111')->count());
    }

    public function test_store_requires_nid_and_nama(): void
    {
        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.store'), ['nid' => '', 'nama' => ''])
            ->assertSessionHasErrors(['nid', 'nama']);
    }

    public function test_update_changes_data_but_keeps_nid_unique(): void
    {
        $karyawan = Karyawan::factory()->create(['nid' => '201', 'nama' => 'Nama Lama']);
        $other = Karyawan::factory()->create(['nid' => '202']);

        // Edit diri sendiri — boleh.
        $this->actingAs($this->hrUser())
            ->put(route('admin.karyawan_data.update', $karyawan), $this->payload([
                'nid' => '201', 'nama' => 'Nama Baru',
            ]))
            ->assertRedirect(route('admin.karyawan_data.index'));

        $this->assertSame('Nama Baru', $karyawan->fresh()->nama);

        // Ambil NID milik karyawan lain — ditolak.
        $this->actingAs($this->hrUser())
            ->put(route('admin.karyawan_data.update', $karyawan), $this->payload([
                'nid' => '202', 'nama' => 'Nama Baru',
            ]))
            ->assertSessionHasErrors('nid');
    }

    public function test_destroy_deletes_karyawan(): void
    {
        $karyawan = Karyawan::factory()->create();

        $this->actingAs($this->hrUser())
            ->delete(route('admin.karyawan_data.destroy', $karyawan))
            ->assertRedirect(route('admin.karyawan_data.index'));

        $this->assertDatabaseMissing('karyawans', ['id' => $karyawan->id]);
    }

    public function test_show_and_forms_render(): void
    {
        $karyawan = Karyawan::factory()->create();

        $this->actingAs($this->hrUser())
            ->get(route('admin.karyawan_data.show', $karyawan))->assertOk()->assertSee($karyawan->nama);

        $this->actingAs($this->hrUser())
            ->get(route('admin.karyawan_data.create'))->assertOk()->assertSee('Identitas Karyawan');

        $this->actingAs($this->hrUser())
            ->get(route('admin.karyawan_data.edit', $karyawan))->assertOk()->assertSee($karyawan->nid);
    }

    public function test_index_table_shows_only_four_columns_in_order(): void
    {
        $karyawan = Karyawan::factory()->create([
            'nid' => '9001',
            'nama' => 'Siti Aminah',
            'bidang' => 'Operasi',
            'email' => 'siti.aminah@example.com',
            'hp' => '0812999888777',
        ]);

        $html = $this->actingAs($this->hrUser())
            ->get(route('admin.karyawan_data.index'))
            ->assertOk()
            ->getContent();

        // Header tabel — TEPAT 4 kolom, urutan persis spec.
        $this->assertMatchesRegularExpression('/<thead>[\s\S]*?<\/thead>/', $html);
        preg_match('/<thead>([\s\S]*?)<\/thead>/', $html, $theadBlock);

        preg_match_all('/<th[^>]*>\s*([^<]*?)\s*<\/th>/', $theadBlock[1], $headerCells);

        $this->assertSame(['NID', 'Nama', 'Bidang', 'Aksi'], $headerCells[1]);

        // Setiap baris data juga hanya 4 sel.
        $this->assertMatchesRegularExpression(
            '/<tr>\s*<td class="sticky-1">[\s\S]*?<\/tr>/',
            $html
        );
        preg_match('/(<tr>\s*<td class="sticky-1">[\s\S]*?)<\/tr>/', $html, $firstRow);
        $this->assertSame(4, substr_count($firstRow[1], '<td'));

        // Kolom identitas & bidang tetap tampil di baris yang sama…
        $this->assertStringContainsString('9001', $firstRow[1]);
        $this->assertStringContainsString('Siti Aminah', $firstRow[1]);
        $this->assertStringContainsString('Operasi', $firstRow[1]);

        // …sedangkan kolom detail (email, telepon, dll.) hilang dari tampilan.
        $this->assertStringNotContainsString('siti.aminah@example.com', $html);
        $this->assertStringNotContainsString('0812999888777', $html);

        // Empty state juga cuma menutupi 4 kolom (bukan 26 lagi).
        $this->assertStringNotContainsString('colspan="26"', $html);

        $emptyHtml = $this->actingAs($this->hrUser())
            ->get(route('admin.karyawan_data.index', ['q' => 'tidak-ada-data-xyz']))
            ->assertOk()
            ->getContent();

        $this->assertStringContainsString('<td colspan="4">', $emptyHtml);
    }

    public function test_action_column_targets_correct_karyawan_per_permission(): void
    {
        $karyawan = Karyawan::factory()->create(['nid' => '7788', 'nama' => 'Andi Wijaya']);

        $detailUrl = route('admin.karyawan_data.show', $karyawan);
        $editUrl = route('admin.karyawan_data.edit', $karyawan);

        // Hanya permission view → tombol Detail saja, tanpa Edit/Hapus.
        $html = $this->actingAs($this->hrUser(['karyawan_data.view']))
            ->get(route('admin.karyawan_data.index'))
            ->assertOk()
            ->getContent();

        $this->assertStringContainsString($detailUrl, $html);
        $this->assertStringNotContainsString($editUrl, $html);
        $this->assertStringNotContainsString('name="_method" value="DELETE"', $html);

        // Permission edit & delete → tombol muncul, tetap ID karyawan yang sama.
        $html = $this->actingAs($this->hrUser())
            ->get(route('admin.karyawan_data.index'))
            ->assertOk()
            ->getContent();

        $this->assertStringContainsString($detailUrl, $html);
        $this->assertStringContainsString($editUrl, $html);
        $this->assertMatchesRegularExpression(
            '/<a href="'.preg_quote($editUrl, '/').'"/',
            $html
        );
        // Form hapus memakai URL yang sama dengan detail (method DELETE).
        $this->assertMatchesRegularExpression(
            '/<form method="POST" action="'.preg_quote($detailUrl, '/').'"[\s\S]{0,400}name="_method" value="DELETE"/',
            $html
        );

        // Tombol mengarah ke rute yang benar untuk ID tersebut.
        $this->actingAs($this->hrUser())->get($detailUrl)->assertOk();
        $this->actingAs($this->hrUser())->get($editUrl)->assertOk();
    }

    /* =========================================================
       3. PENCARIAN, FILTER, PAGINATION
       ========================================================= */

    public function test_search_matches_nid_and_nama(): void
    {
        Karyawan::factory()->create(['nid' => '9001', 'nama' => 'Siti Aminah']);
        Karyawan::factory()->create(['nid' => '9002', 'nama' => 'Budi Santoso']);

        $user = $this->hrUser();

        $response = $this->actingAs($user)->get(route('admin.karyawan_data.index', ['q' => '9001']));
        $response->assertOk();
        $this->assertSame('9001', $response->viewData('karyawans')->first()->nid);

        $response = $this->actingAs($user)->get(route('admin.karyawan_data.index', ['q' => 'Siti']));
        $this->assertSame('Siti Aminah', $response->viewData('karyawans')->first()->nama);
    }

    public function test_filter_by_bidang_applies_while_removed_filters_are_ignored(): void
    {
        Karyawan::factory()->create(['bidang' => 'Operasi', 'gender' => 'L', 'grade' => 'IIIA']);
        Karyawan::factory()->create(['bidang' => 'Engineering', 'gender' => 'P', 'grade' => 'IV']);
        Karyawan::factory()->create(['bidang' => 'Operasi', 'gender' => 'P', 'grade' => 'IV']);

        // Filter BIDANG (satu-satunya filter dropdown yang tersisa) tetap berlaku.
        $response = $this->actingAs($this->hrUser())
            ->get(route('admin.karyawan_data.index', ['bidang' => 'Operasi']));

        $response->assertOk();
        $this->assertSame(2, $response->viewData('karyawans')->total());

        // Parameter filter yang SUDAH DIHAPUS (gender, grade, jabatan,
        // status_kawin, unit) diabaikan backend — tidak menyaring apa pun.
        foreach (['gender' => 'P', 'grade' => 'IV', 'jabatan' => 'Manager', 'status_kawin' => 'K', 'unit' => 'Unit 1'] as $name => $value) {
            $response = $this->actingAs($this->hrUser())
                ->get(route('admin.karyawan_data.index', [$name => $value]));

            $response->assertOk();
            $this->assertSame(
                3,
                $response->viewData('karyawans')->total(),
                "Parameter {$name} tidak boleh lagi memengaruhi hasil pencarian."
            );
        }
    }

    public function test_filter_bar_only_offers_nid_name_and_bidang_search(): void
    {
        $html = $this->actingAs($this->hrUser())
            ->get(route('admin.karyawan_data.index'))
            ->assertOk()
            ->getContent();

        // Baris pencarian hanya 3 kontrol input: NID/NAMA, BIDANG, per_page.
        $this->assertMatchesRegularExpression('/<form class="dk-filter-bar"[\s\S]*?<\/form>/', $html);
        preg_match('/<form class="dk-filter-bar"([\s\S]*?)<\/form>/', $html, $bar);

        preg_match_all('/<(?:input|select)[^>]*name="([^"]+)"/', $bar[1], $controls);

        $this->assertSame(['q', 'bidang', 'per_page'], $controls[1]);
        $this->assertStringContainsString('Cari NID atau NAMA', $bar[1]);
        $this->assertStringContainsString('Semua Bidang', $bar[1]);

        // Filter lain sudah dihapus dari halaman ini.
        foreach (['jabatan', 'grade', 'gender', 'status_kawin', 'unit'] as $removed) {
            $this->assertStringNotContainsString('name="'.$removed.'"', $html);
        }

        // Ekspor ikut hanya 2 parameter pencarian yang tersisa.
        preg_match('/href="([^"]*data-karyawan\/export[^"]*)"/', $html, $export);
        $this->assertNotEmpty($export);
        $this->assertStringNotContainsString('gender=', $export[1]);
        $this->assertStringNotContainsString('grade=', $export[1]);
    }

    public function test_pagination_respects_per_page(): void
    {
        Karyawan::factory()->count(30)->create();

        $response = $this->actingAs($this->hrUser())
            ->get(route('admin.karyawan_data.index', ['per_page' => 25]));

        $page = $response->viewData('karyawans');
        $this->assertSame(30, $page->total());
        $this->assertCount(25, $page->items());
        $this->assertSame(2, $page->lastPage());

        // per_page di luar daftar yang diizinkan jatuh ke default 25.
        $response = $this->actingAs($this->hrUser())
            ->get(route('admin.karyawan_data.index', ['per_page' => 7]));
        $this->assertCount(25, $response->viewData('karyawans')->items());
    }

    /* =========================================================
       4. IMPOR CSV — TEMPLATE, 300 BARIS, DUPLIKAT, TRANSAKSI
       ========================================================= */

    public function test_template_download_lists_24_columns(): void
    {
        $response = $this->actingAs($this->hrUser())
            ->get(route('admin.karyawan_data.template'));

        $response->assertOk();
        $content = $response->streamedContent();

        foreach (array_values(Karyawan::COLUMNS_LABELS) as $label) {
            $this->assertStringContainsString($label, $content, "Template harus memuat kolom {$label}.");
        }
    }

    public function test_import_300_rows_succeeds(): void
    {
        // 300 baris valid — data uji lewat file impor, bukan factory
        // yang tersimpan (mengikuti alur yang sama dengan data asli).
        $lines = [implode(';', array_values(Karyawan::COLUMNS_LABELS))];
        for ($i = 1; $i <= 300; $i++) {
            $nid = str_pad((string) $i, 5, '0', STR_PAD_LEFT); // uji nol di depan
            $lines[] = implode(';', [
                $nid, "Karyawan {$i}", 'Operasi', 'Staf', 'JTE', 'IIIA',
                'PLN Nusantara Power', 'Organik',
                '01/06/1990', '01/07/2015', '01/07/2015', '', '01/01/2020', '01/02/2021',
                '0234-321000', "0812{$i}", "k{$i}@pln.co.id", '1.00', "M{$i}",
                'Indramayu', 'Islam', 'L', 'K', 'Unit 1',
            ]);
        }

        $file = UploadedFile::fake()->createWithContent('karyawan.csv', implode("\n", $lines));

        $response = $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.import'), ['file' => $file, 'mode' => 'skip']);

        $response->assertRedirect(route('admin.karyawan_data.index'));

        $this->assertSame(300, Karyawan::query()->count(), 'Semua 300 baris valid harus tersimpan.');
        $this->assertSame('00001', Karyawan::first()->nid, 'Nol di depan harus tetap utuh setelah impor.');

        $summary = session('import_summary');
        $this->assertSame(300, $summary['total']);
        $this->assertSame(300, $summary['inserted']);
        $this->assertSame(0, $summary['failed']);
        $this->assertSame(0, $summary['skipped']);
    }

    public function test_import_reports_duplicates_and_invalid_rows_without_half_saved_data(): void
    {
        Karyawan::factory()->create(['nid' => '55555']);

        $header = implode(';', array_values(Karyawan::COLUMNS_LABELS));
        $valid = implode(';', ['70001', 'Baris Valid', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']);
        $dupDb = implode(';', ['55555', 'Duplikat Database', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']);
        $dupIn = implode(';', ['70002', 'Pertama', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']);
        $dupIn2 = implode(';', ['70002', 'Kedua (dobel dalam file)', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']);
        $noNid = implode(';', ['', 'Tanpa NID', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']);
        $badDay = implode(';', ['70003', 'Tanggal Rusak', '', '', '', '', '', '', '99/99/9999', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']);
        $badSex = implode(';', ['70004', 'Gender Aneh', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'X', '', '']);

        $file = UploadedFile::fake()->createWithContent(
            'campuran.csv',
            implode("\n", [$header, $valid, $dupDb, $dupIn, $dupIn2, $noNid, $badDay, $badSex])
        );

        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.import'), ['file' => $file, 'mode' => 'skip'])
            ->assertRedirect(route('admin.karyawan_data.index'));

        $summary = session('import_summary');

        $this->assertSame(7, $summary['total']);
        $this->assertSame(2, $summary['inserted'], 'Hanya 2 baris valid (70001 & 70002 pertama).');
        $this->assertSame(2, $summary['skipped'], 'Duplikat DB (55555) + dobel dalam file (70002 kedua) dilewati.');
        $this->assertSame(3, $summary['failed'], 'Tanpa NID + tanggal rusak + gender aneh = 3 baris gagal.');

        // Baris valid tersimpan; baris gagal & duplikat TIDAK tersimpan
        // sama sekali (tidak ada data setengah tersimpan).
        $this->assertTrue(Karyawan::where('nid', '70001')->exists());
        $this->assertTrue(Karyawan::where('nid', '70002')->exists());
        $this->assertSame(1, Karyawan::where('nid', '70002')->count());
        $this->assertSame(1, Karyawan::where('nid', '55555')->count(), 'Duplikat DB tidak menimpa data lama.');
        $this->assertFalse(Karyawan::where('nid', '70003')->exists());
        $this->assertFalse(Karyawan::where('nid', '70004')->exists());

        // Tiap kegagalan punya nomor baris + penyebab.
        // Nomor baris file: 1 = header, baris data pertama = baris 2.
        $lines = array_column($summary['errors'], 'line');
        $this->assertContains(6, $lines, 'Baris tanpa NID harus dilaporkan.');
        $this->assertContains(7, $lines, 'Baris tanggal rusak harus dilaporkan.');
        $this->assertContains(8, $lines, 'Baris gender aneh harus dilaporkan.');
    }

    public function test_import_rejects_file_without_validation(): void
    {
        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.import'), ['file' => null, 'mode' => 'skip'])
            ->assertSessionHasErrors('file');
    }

    /* =========================================================
       5. EKSPOR — mengikuti filter aktif
       ========================================================= */

    public function test_export_follows_active_filters(): void
    {
        Karyawan::factory()->create(['nid' => '80001', 'bidang' => 'Operasi']);
        Karyawan::factory()->create(['nid' => '80002', 'bidang' => 'Engineering']);

        $response = $this->actingAs($this->hrUser())
            ->get(route('admin.karyawan_data.export', ['bidang' => 'Operasi']));

        $response->assertOk();
        $content = $response->streamedContent();

        $this->assertStringContainsString('80001', $content);
        $this->assertStringNotContainsString('80002', $content, 'Baris di luar filter tidak boleh ikut terekspor.');

        foreach (array_values(Karyawan::COLUMNS_LABELS) as $label) {
            $this->assertStringContainsString($label, $content, "Ekspor harus memuat header kolom {$label}.");
        }
    }

    /* =========================================================
       6. IMPOR CSV — DELIMITER, BOM, HEADER 24 KOLOM, ORGANIK
       ========================================================= */

    /** Baris data 24 kolom (koma) — NID & NAMA di dua kolom pertama. */
    private function csvRowComma(array $overrides = []): string
    {
        $values = [
            '00421', 'Siti Aminah', 'Operasi', 'Staf', 'JTE', 'IIIA',
            'PLN Nusantara Power', 'Organik',
            '01/06/1990', '', '', '', '', '',
            '0234-321000', '081234', 'siti@pln.co.id', '1.00', 'M1',
            'Indramayu', 'Islam', 'L', 'TK', 'Unit 1',
        ];

        // Override per INDEX kolom (bukan array_merge — numeric key akan
        // menambah baris, bukan mengganti).
        foreach ($overrides as $index => $value) {
            $values[$index] = $value;
        }

        $this->assertCount(24, $values, 'Baris uji harus tepat 24 kolom.');

        return implode(',', $values);
    }

    public function test_import_comma_delimited_csv_with_utf8_bom_and_leading_zero_nid(): void
    {
        // BOM UTF-8 persis seperti template resmi & hasil simpanan
        // Excel "CSV UTF-8" — dulu membuat header "NID" tidak terbaca.
        $content = "\xEF\xBB\xBF"
            .implode(',', array_values(Karyawan::COLUMNS_LABELS))
            ."\n".$this->csvRowComma()."\n";

        $file = UploadedFile::fake()->createWithContent('karyawan.csv', $content);

        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.import'), ['file' => $file, 'mode' => 'skip'])
            ->assertRedirect(route('admin.karyawan_data.index'));

        $this->assertSame(1, Karyawan::query()->count(), 'Impor CSV ber-BOM dengan delimiter koma harus berhasil.');
        $this->assertSame('00421', Karyawan::first()->nid, 'NID dengan nol di depan harus utuh.');

        $summary = session('import_summary');
        $this->assertSame(0, $summary['failed']);
        $this->assertSame(1, $summary['inserted']);
    }

    public function test_import_semicolon_delimited_csv_with_utf8_bom_succeeds(): void
    {
        $header = implode(';', array_values(Karyawan::COLUMNS_LABELS));
        $row = implode(';', [
            '00422', 'Budi Santoso', 'Operasi', 'Staf', 'JTE', 'IIIA',
            'PLN Nusantara Power', 'Organik',
            '01/06/1990', '', '', '', '', '',
            '0234-321000', '081234', 'budi@pln.co.id', '1.00', 'M1',
            'Indramayu', 'Islam', 'L', 'TK', 'Unit 1',
        ]);

        $file = UploadedFile::fake()->createWithContent('lokal.csv', "\xEF\xBB\xBF{$header}\n{$row}\n");

        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.import'), ['file' => $file, 'mode' => 'skip'])
            ->assertRedirect(route('admin.karyawan_data.index'));

        $this->assertSame(1, Karyawan::query()->count(), 'Impor CSV delimiter titik koma (pengaturan regional Excel) harus berhasil.');
        $this->assertSame('00422', Karyawan::first()->nid);
    }

    public function test_import_template_roundtrip_with_bom_is_accepted(): void
    {
        // Alur nyata: unduh template resmi (BOM + koma), isi satu baris,
        // impor ulang — tidak boleh ditolak.
        $template = $this->actingAs($this->hrUser())
            ->get(route('admin.karyawan_data.template'))
            ->streamedContent();

        $file = UploadedFile::fake()->createWithContent(
            'template-diisi.csv',
            $template.$this->csvRowComma([0 => '00999'])."\n"
        );

        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.import'), ['file' => $file, 'mode' => 'skip'])
            ->assertRedirect(route('admin.karyawan_data.index'));

        $this->assertSame(1, Karyawan::query()->count());
        $this->assertSame('00999', Karyawan::first()->nid);
    }

    public function test_import_rejects_csv_with_wrong_column_count_before_validation(): void
    {
        // Header hanya 3 kolom (bukan 24) — harus ditolak dengan pesan
        // format jelas SEBELUM validasi per baris, tanpa menyentuh DB.
        $file = UploadedFile::fake()->createWithContent(
            'singkat.csv',
            "NID,NAMA,BIDANG\n001,Budi,Operasi\n"
        );

        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.import'), ['file' => $file, 'mode' => 'skip'])
            ->assertRedirect(route('admin.karyawan_data.index'));

        $this->assertStringContainsString('Format file CSV tidak sesuai', (string) session('warning'));
        $this->assertNull(session('import_summary'), 'Validasi baris tidak boleh dijalankan bila format header salah.');
        $this->assertSame(0, Karyawan::query()->count());
    }

    public function test_import_rejects_header_with_unknown_column_name(): void
    {
        $header = array_values(Karyawan::COLUMNS_LABELS);
        $header[7] = 'KOLOM_TIDAK_DIKENAL'; // ganti ORGANIK

        $file = UploadedFile::fake()->createWithContent(
            'header-aneh.csv',
            implode(',', $header)."\n".$this->csvRowComma()."\n"
        );

        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.import'), ['file' => $file, 'mode' => 'skip'])
            ->assertRedirect(route('admin.karyawan_data.index'));

        $warning = (string) session('warning');
        $this->assertStringContainsString('Format file CSV tidak sesuai', $warning);
        $this->assertStringContainsString('KOLOM_TIDAK_DIKENAL', $warning);
        $this->assertSame(0, Karyawan::query()->count());
    }

    public function test_import_flags_data_row_with_more_columns_than_header(): void
    {
        $header = implode(';', array_values(Karyawan::COLUMNS_LABELS));

        $valid = array_fill(0, 24, '');
        $valid[0] = '91001';
        $valid[1] = 'Baris Valid';

        // Nilai berisi titik koma tanpa kutip → sel jadi 25 (kolom
        // bergeser) — harus ditandai gagal format, bukan dibaca meleset.
        $shifted = $valid;
        $shifted[1] = 'Budi; Santoso';
        $shifted[] = 'ekstra';

        $file = UploadedFile::fake()->createWithContent(
            'bergeser.csv',
            $header."\n".implode(';', $valid)."\n".implode(';', $shifted)."\n"
        );

        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.import'), ['file' => $file, 'mode' => 'skip'])
            ->assertRedirect(route('admin.karyawan_data.index'));

        $summary = session('import_summary');
        $this->assertSame(2, $summary['total']);
        $this->assertSame(1, $summary['inserted']);
        $this->assertSame(1, $summary['failed']);
        $this->assertStringContainsString('Jumlah kolom tidak sesuai', $summary['errors'][0]['errors'][0]);
        $this->assertTrue(Karyawan::where('nid', '91001')->exists());
    }

    public function test_import_organik_uses_correct_column_and_enforces_limit(): void
    {
        $organikValid = str_repeat('O', 100); // tepat batas (100) — valid
        $organikTooLong = str_repeat('O', 101); // lewat batas — gagal

        // INSTITUSI sengaja dibuat panjang (>30) untuk memastikan batas
        // ORGANIK diambil dari kolom ORGANIK, bukan kolom sebelah.
        $header = implode(',', array_values(Karyawan::COLUMNS_LABELS));

        $valid = $this->csvRowComma([
            0 => '92001',
            6 => 'PT PLN Nusantara Power Pembangkitan Jawa Bali',
            7 => $organikValid,
        ]);
        $tooLong = $this->csvRowComma([
            0 => '92002',
            1 => 'Karyawan Kepanjangan',
            6 => 'PT PLN Nusantara Power Pembangkitan Jawa Bali',
            7 => $organikTooLong,
        ]);

        $file = UploadedFile::fake()->createWithContent(
            'organik.csv',
            $header."\n".$valid."\n".$tooLong."\n"
        );

        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.import'), ['file' => $file, 'mode' => 'skip'])
            ->assertRedirect(route('admin.karyawan_data.index'));

        $summary = session('import_summary');
        $this->assertSame(2, $summary['total']);
        $this->assertSame(1, $summary['inserted'], 'ORGANIK tepat 100 karakter harus valid.');
        $this->assertSame(1, $summary['failed'], 'ORGANIK 101 karakter harus gagal.');

        // Nilai ORGANIK tersimpan berasal dari kolom ORGANIK yang benar.
        $stored = Karyawan::where('nid', '92001')->first();
        $this->assertNotNull($stored);
        $this->assertSame($organikValid, $stored->organik);

        $errors = implode(' ', $summary['errors'][0]['errors']);
        $this->assertStringContainsString('ORGANIK maksimal 100 karakter', $errors);
    }

    public function test_import_tolerates_historical_placeholder_values(): void
    {
        // Data historis nyata: FTE berisi teks "PJS", STATUS KAWIN
        // ditulis "Menikah"/"Belum Menikah", tanggal placeholder
        // "00/00/0000" — ketiganya TIDAK boleh membatalkan baris.
        $historic = $this->csvRowComma([
            0 => '93001',
            1 => 'Data Historis',
            12 => '00/00/0000', // GRADE DATE placeholder
            17 => 'PJS', // FTE bukan angka
            22 => 'Menikah', // STATUS KAWIN teks panjang
        ]);
        $unmarried = $this->csvRowComma([
            0 => '93002',
            1 => 'Belum Menikah',
            22 => 'Belum Menikah',
        ]);

        $file = UploadedFile::fake()->createWithContent(
            'historis.csv',
            implode(',', array_values(Karyawan::COLUMNS_LABELS))."\n".$historic."\n".$unmarried."\n"
        );

        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.import'), ['file' => $file, 'mode' => 'skip'])
            ->assertRedirect(route('admin.karyawan_data.index'));

        $summary = session('import_summary');
        $this->assertSame(0, $summary['failed'], 'Nilai historis tidak boleh membuat baris gagal.');
        $this->assertSame(2, $summary['inserted']);

        $first = Karyawan::where('nid', '93001')->first();
        $this->assertNotNull($first);
        $this->assertNull($first->fte, 'FTE non-angka ("PJS") diabaikan jadi kosong.');
        $this->assertNull($first->grade_date, 'Placeholder "00/00/0000" dianggap tanggal kosong.');
        $this->assertSame('K', $first->status_kawin, '"Menikah" harus dinormalisasi ke K.');
        $this->assertSame('1990-06-01', $first->tanggal_lahir->format('Y-m-d'));

        $second = Karyawan::where('nid', '93002')->first();
        $this->assertNotNull($second);
        $this->assertSame('TK', $second->status_kawin, '"Belum Menikah" harus dinormalisasi ke TK.');
    }

    /* =========================================================
       7. IMPOR XLSX — parser ZIP+XML native (tanpa ext-zip)
       ========================================================= */

    /**
     * Satu baris data 24 kolom untuk penulis XLSX — nilai berupa
     * string (sel teks/shared string), angka (sel numerik), atau
     * `['date' => 'Y-m-d']` (sel angka bergaya tanggal).
     * Override per INDEX kolom (sama seperti csvRowComma).
     */
    private function xlsxRow(array $overrides = []): array
    {
        $values = [
            '00421', 'Siti Aminah', 'Operasi', 'Staf', 'JTE', 'IIIA',
            'PLN Nusantara Power', 'Organik',
            ['date' => '1990-06-01'], 36526, '', '', '', '',
            '0234-321000', '081234', 'siti@pln.co.id', 1.5, 'M1',
            'Indramayu', 'Islam', 'L', 'TK', 'Unit 1',
        ];

        foreach ($overrides as $index => $value) {
            $values[$index] = $value;
        }

        $this->assertCount(24, $values, 'Baris uji XLSX harus tepat 24 kolom.');

        return $values;
    }

    /** Impor .xlsx hasil XlsxWriter; kembalikan respons redirect. */
    private function importXlsx(array $rows, string $name = 'karyawan.xlsx', array $buildOptions = []): void
    {
        $file = UploadedFile::fake()->createWithContent(
            $name,
            XlsxWriter::build($rows, $buildOptions)
        );

        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.import'), ['file' => $file, 'mode' => 'skip'])
            ->assertRedirect(route('admin.karyawan_data.index'));
    }

    public function test_import_xlsx_24_columns_keeps_leading_zero_nid_and_parses_numbers_and_dates(): void
    {
        $this->importXlsx([
            array_values(Karyawan::COLUMNS_LABELS),
            $this->xlsxRow([
                0 => '00421', // NID nol di depan (sel teks/shared string)
                15 => '081234567890', // HP nol di depan
                8 => ['date' => '1990-06-01'], // sel angka bergaya tanggal
                9 => 36526, // serial tanggal mentah → 2000-01-01
                17 => 1.5, // FTE angka desimal
            ]),
        ]);

        $this->assertSame(1, Karyawan::query()->count(), 'File .xlsx 24 kolom harus terimpa ke DB.');

        $karyawan = Karyawan::first();
        $this->assertSame('00421', $karyawan->nid, 'NID nol di depan harus utuh.');
        $this->assertSame('081234567890', $karyawan->hp);
        $this->assertSame('1990-06-01', $karyawan->tanggal_lahir->format('Y-m-d'), 'Sel tanggal bergaya harus diubah dari serial Excel.');
        $this->assertSame('2000-01-01', $karyawan->service_date->format('Y-m-d'), 'Serial tanggal mentah harus ditangani parseDate().');
        $this->assertSame(1.5, (float) $karyawan->fte);
        $this->assertSame('Organik', $karyawan->organik);

        $summary = session('import_summary');
        $this->assertSame(1, $summary['inserted']);
        $this->assertSame(0, $summary['failed']);
        $this->assertSame(0, $summary['skipped']);
    }

    public function test_import_xlsx_without_compression_is_accepted(): void
    {
        // Entri ZIP metode "store" (tanpa deflate) — parser harus
        // menangani kedua metode kompresi arsip.
        $this->importXlsx([
            array_values(Karyawan::COLUMNS_LABELS),
            $this->xlsxRow([0 => '00777', 1 => 'Tanpa Kompresi']),
        ], 'tanpa-kompresi.xlsx', ['store' => true]);

        $this->assertSame(1, Karyawan::query()->count());
        $this->assertSame('00777', Karyawan::first()->nid);
        $this->assertSame(0, session('import_summary')['failed']);
    }

    public function test_import_xlsx_rejects_header_with_unknown_column_name(): void
    {
        $header = array_values(Karyawan::COLUMNS_LABELS);
        $header[7] = 'KOLOM_TIDAK_DIKENAL'; // ganti ORGANIK

        $this->importXlsx([$header, $this->xlsxRow()]);

        $warning = (string) session('warning');
        $this->assertStringContainsString('Format file XLSX tidak sesuai', $warning);
        $this->assertStringContainsString('KOLOM_TIDAK_DIKENAL', $warning);
        $this->assertNull(session('import_summary'), 'Validasi baris tidak boleh dijalankan bila header salah.');
        $this->assertSame(0, Karyawan::query()->count());
    }

    public function test_import_xlsx_organik_uses_correct_column_and_enforces_limit(): void
    {
        $organikValid = str_repeat('O', 100); // tepat batas (100) — valid
        $organikTooLong = str_repeat('O', 101); // lewat batas — gagal

        $this->importXlsx([
            array_values(Karyawan::COLUMNS_LABELS),
            $this->xlsxRow([
                0 => '92001',
                6 => 'PT PLN Nusantara Power Pembangkitan Jawa Bali',
                7 => $organikValid,
            ]),
            $this->xlsxRow([
                0 => '92002',
                1 => 'Karyawan Kepanjangan',
                6 => 'PT PLN Nusantara Power Pembangkitan Jawa Bali',
                7 => $organikTooLong,
            ]),
        ]);

        $summary = session('import_summary');
        $this->assertSame(2, $summary['total']);
        $this->assertSame(1, $summary['inserted'], 'ORGANIK tepat 100 karakter harus valid.');
        $this->assertSame(1, $summary['failed'], 'ORGANIK 101 karakter harus gagal.');

        $stored = Karyawan::where('nid', '92001')->first();
        $this->assertNotNull($stored);
        $this->assertSame($organikValid, $stored->organik);

        $errors = implode(' ', $summary['errors'][0]['errors']);
        $this->assertStringContainsString('ORGANIK maksimal 100 karakter', $errors);
    }

    public function test_import_xlsx_tolerates_historical_placeholder_values(): void
    {
        // Jalur XLSX — toleransi nilai historis yang sama dengan CSV
        // (FTE "PJS", "Menikah", tanggal placeholder).
        $this->importXlsx([
            array_values(Karyawan::COLUMNS_LABELS),
            $this->xlsxRow([
                0 => '93011',
                1 => 'Data Historis',
                12 => '00/00/0000', // GRADE DATE placeholder
                17 => 'PJS', // FTE bukan angka
                22 => 'Menikah', // STATUS KAWIN teks panjang
            ]),
            $this->xlsxRow([
                0 => '93012',
                1 => 'Belum Menikah',
                22 => 'Belum Menikah',
            ]),
        ]);

        $summary = session('import_summary');
        $this->assertSame(0, $summary['failed'], 'Nilai historis tidak boleh membuat baris gagal.');
        $this->assertSame(2, $summary['inserted']);

        $first = Karyawan::where('nid', '93011')->first();
        $this->assertNotNull($first);
        $this->assertNull($first->fte, 'FTE non-angka ("PJS") diabaikan jadi kosong.');
        $this->assertNull($first->grade_date, 'Placeholder "00/00/0000" dianggap tanggal kosong.');
        $this->assertSame('K', $first->status_kawin, '"Menikah" harus dinormalisasi ke K.');
        $this->assertSame('1990-06-01', $first->tanggal_lahir->format('Y-m-d'));

        $second = Karyawan::where('nid', '93012')->first();
        $this->assertNotNull($second);
        $this->assertSame('TK', $second->status_kawin, '"Belum Menikah" harus dinormalisasi ke TK.');
    }

    public function test_import_xlsx_flags_row_with_more_columns_and_reports_sheet_row_number(): void
    {
        $valid = $this->xlsxRow([0 => '91001', 1 => 'Baris Valid']);
        $shifted = $this->xlsxRow([0 => '91002', 1 => 'Baris Bergeser']);
        $shifted[24] = 'ekstra'; // kolom ke-25 melebihi header

        // Baris 3 sengaja kosong — nomor baris yang dilaporkan harus
        // nomor ASLI di lembar (4), bukan urutan setelah difilter.
        $this->importXlsx([
            array_values(Karyawan::COLUMNS_LABELS),
            $valid,
            [],
            $shifted,
        ]);

        $summary = session('import_summary');
        $this->assertSame(2, $summary['total'], 'Baris kosong tidak dihitung.');
        $this->assertSame(1, $summary['inserted']);
        $this->assertSame(1, $summary['failed']);
        $this->assertSame(4, $summary['errors'][0]['line'], 'Laporan error memakai nomor baris lembar asli.');
        $this->assertStringContainsString('Jumlah kolom tidak sesuai', $summary['errors'][0]['errors'][0]);
        $this->assertTrue(Karyawan::where('nid', '91001')->exists());
        $this->assertFalse(Karyawan::where('nid', '91002')->exists());
    }

    public function test_import_rejects_corrupt_xlsx_without_writing_any_row(): void
    {
        $user = $this->hrUser();

        // Bukan arsip ZIP sama sekali.
        $garbage = UploadedFile::fake()->createWithContent('rusak.xlsx', 'ini bukan berkas zip');
        $this->actingAs($user)
            ->post(route('admin.karyawan_data.import'), ['file' => $garbage, 'mode' => 'skip'])
            ->assertRedirect(route('admin.karyawan_data.index'));

        $this->assertStringContainsString('File bukan arsip XLSX', (string) session('warning'));
        $this->assertNull(session('import_summary'));
        $this->assertSame(0, Karyawan::query()->count(), 'File rusak tidak boleh menulis baris apa pun.');

        // Arsip ZIP valid tapi terpotong di tengah.
        $valid = XlsxWriter::build([
            array_values(Karyawan::COLUMNS_LABELS),
            $this->xlsxRow(),
        ]);
        $truncated = UploadedFile::fake()->createWithContent('potong.xlsx', substr($valid, 0, 40));

        $this->actingAs($user)
            ->post(route('admin.karyawan_data.import'), ['file' => $truncated, 'mode' => 'skip'])
            ->assertRedirect(route('admin.karyawan_data.index'));

        $this->assertNotNull(session('warning'), 'Arsip terpotong harus menghasilkan pesan kesalahan.');
        $this->assertNull(session('import_summary'));
        $this->assertSame(0, Karyawan::query()->count());
    }

    public function test_import_rejects_unsupported_file_extension(): void
    {
        $file = UploadedFile::fake()->createWithContent('data.pdf', "NID,NAMA\n001,Budi\n");

        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.import'), ['file' => $file, 'mode' => 'skip'])
            ->assertSessionHasErrors('file');

        $this->assertSame(0, Karyawan::query()->count());
    }

    public function test_import_accepts_txt_file_with_csv_content(): void
    {
        $content = implode(',', array_values(Karyawan::COLUMNS_LABELS))
            ."\n".$this->csvRowComma([0 => '00555'])."\n";

        $file = UploadedFile::fake()->createWithContent('karyawan.txt', $content);

        $this->actingAs($this->hrUser())
            ->post(route('admin.karyawan_data.import'), ['file' => $file, 'mode' => 'skip'])
            ->assertRedirect(route('admin.karyawan_data.index'));

        $this->assertSame(1, Karyawan::query()->count());
        $this->assertSame('00555', Karyawan::first()->nid);
    }

    /* =========================================================
       7. PENDAFTARAN AKUN PENGGUNA DARI DATA KARYAWAN
       ========================================================= */

    /**
     * Admin pengelola akun: akses modul Data Karyawan + permission
     * users.create (permission pengelolaan akun yang sudah ada).
     */
    private function accountManager(): User
    {
        return $this->hrUser(['karyawan_data.view', 'users.create']);
    }

    public function test_register_account_requires_account_management_permission(): void
    {
        $karyawan = Karyawan::factory()->create(['email' => 'calon@example.com']);
        $registerUrl = route('admin.karyawan_data.register-account', $karyawan);

        // Tanpa users.create: tombol pendaftaran tidak dirender…
        $html = $this->actingAs($this->hrUser(['karyawan_data.view']))
            ->get(route('admin.karyawan_data.index'))
            ->assertOk()
            ->getContent();

        $this->assertStringNotContainsString($registerUrl, $html);

        // …dan endpoint menolak akses langsung di backend (bukan hanya UI).
        $this->actingAs($this->hrUser(['karyawan_data.view']))
            ->post($registerUrl)
            ->assertForbidden();

        $this->assertFalse(User::where('email', 'calon@example.com')->exists());
        $this->assertSame(0, EmployeeProfile::query()->count());
    }

    public function test_register_account_creates_karyawan_account_from_master_data(): void
    {
        $department = Department::firstOrCreate(['code' => 'operasi'], ['name' => 'Operasi']);
        $bidang = Bidang::create([
            'nama' => 'PROD A',
            'department_code' => 'operasi',
            'sub_department_code' => 'asmen_prod_a',
        ]);
        $jabatan = Jabatan::create(['nama' => 'ASMAN PROD A', 'bidang_id' => $bidang->id]);

        $karyawan = Karyawan::factory()->create([
            'nid' => '00501',
            'nama' => 'Siti Aminah',
            'email' => 'siti.aminah@example.com',
            'hp' => '0812000111222',
            'bidang_id' => $bidang->id,
            'jabatan_id' => $jabatan->id,
        ]);

        $response = $this->actingAs($this->accountManager())
            ->post(route('admin.karyawan_data.register-account', $karyawan));

        $response->assertRedirect(route('admin.karyawan_data.index'));

        $user = User::where('email', 'siti.aminah@example.com')->firstOrFail();
        $this->assertSame('Siti Aminah', $user->name);
        $this->assertSame('siti.aminah@example.com', $user->email);
        $this->assertSame('0812000111222', $user->no_hp);
        $this->assertTrue($user->must_change_password, 'Akun baru wajib mengganti kata sandi saat login pertama.');

        // Role awal HANYA Karyawan (bukan Super Admin / Admin Bidang).
        $this->assertTrue($user->isKaryawan());
        $this->assertTrue($user->roleNames()->contains('Karyawan'));
        $this->assertFalse($user->hasPermission('users.create'));

        // Bidang/sub-bidang/jabatan mengikuti master + aturan scoping lama.
        $this->assertSame($bidang->id, $user->bidang_id);
        $this->assertSame($jabatan->id, $user->jabatan_id);
        $this->assertSame('operasi', $user->department);
        $this->assertSame($department->id, $user->department_id);
        $this->assertSame('asmen_prod_a', $user->sub_department);
        $this->assertSame('asisten_manager', $user->level_jabatan);

        // Relasi resmi karyawan ↔ akun (employee_profiles, NID sebagai identitas).
        $profile = EmployeeProfile::where('user_id', $user->id)->first();
        $this->assertNotNull($profile);
        $this->assertSame($karyawan->id, $profile->karyawan_id);
        $this->assertSame('00501', $profile->nid);
        $this->assertSame('Siti Aminah', $profile->nama);
        $this->assertSame('siti.aminah@example.com', $profile->email);
    }

    public function test_temporary_password_is_hashed_and_shown_only_once(): void
    {
        $karyawan = Karyawan::factory()->create([
            'nid' => '00502',
            'nama' => 'Budi Santoso',
            'email' => 'budi.santoso@example.com',
        ]);

        $this->actingAs($this->accountManager())
            ->post(route('admin.karyawan_data.register-account', $karyawan))
            ->assertRedirect(route('admin.karyawan_data.index'))
            ->assertSessionHas('new_account_credentials');

        $credentials = session('new_account_credentials');
        $plainPassword = $credentials['password'];

        $this->assertSame('budi.santoso@example.com', $credentials['email']);
        $this->assertGreaterThanOrEqual(12, strlen($plainPassword), 'Kata sandi sementara harus acak & cukup panjang.');

        $user = User::where('email', 'budi.santoso@example.com')->firstOrFail();
        $this->assertNotSame($plainPassword, $user->password, 'Kata sandi asli tidak boleh tersimpan di database.');
        $this->assertTrue(Hash::check($plainPassword, $user->password), 'Kata sandi sementara harus tersimpan sebagai hash Laravel.');

        // Tampil SEKALI di halaman hasil redirect…
        $html = $this->actingAs($this->accountManager())
            ->get(route('admin.karyawan_data.index'))
            ->assertOk()
            ->getContent();

        $this->assertStringContainsString($plainPassword, $html);
        $this->assertStringContainsString('Akun Pengguna Berhasil Dibuat', $html);

        // …dan tidak muncul lagi saat halaman dimuat ulang (flash habis).
        $this->actingAs($this->accountManager())
            ->get(route('admin.karyawan_data.index'))
            ->assertOk()
            ->assertDontSee($plainPassword)
            ->assertSessionMissing('new_account_credentials');
    }

    public function test_register_account_disabled_and_rejected_when_email_missing_or_invalid(): void
    {
        $tanpaEmail = Karyawan::factory()->create(['nid' => '00601', 'nama' => 'Tanpa Email', 'email' => null]);
        $emailRusak = Karyawan::factory()->create(['nid' => '00602', 'nama' => 'Email Rusak', 'email' => 'bukan-email']);

        $html = $this->actingAs($this->accountManager())
            ->get(route('admin.karyawan_data.index'))
            ->assertOk()
            ->getContent();

        // Pesan jelas + tombol nonaktif (tidak ada form yang bisa dikirim).
        $this->assertStringContainsString('Email tidak valid', $html);
        $this->assertSame(2, substr_count($html, 'Email tidak valid'));
        $this->assertStringNotContainsString(route('admin.karyawan_data.register-account', $tanpaEmail), $html);
        $this->assertStringNotContainsString(route('admin.karyawan_data.register-account', $emailRusak), $html);

        foreach ([$tanpaEmail, $emailRusak] as $karyawan) {
            $this->actingAs($this->accountManager())
                ->from(route('admin.karyawan_data.index'))
                ->post(route('admin.karyawan_data.register-account', $karyawan))
                ->assertSessionHasErrors('akun');
        }

        // Tidak ada akun/profil baru yang terbentuk untuk kedua baris itu.
        $this->assertSame(0, EmployeeProfile::query()->count());
    }

    public function test_register_account_rejects_email_already_used_by_another_account(): void
    {
        User::factory()->create(['email' => 'dipakai@example.com']);

        $karyawan = Karyawan::factory()->create(['nid' => '00610', 'email' => 'dipakai@example.com']);

        $this->actingAs($this->accountManager())
            ->from(route('admin.karyawan_data.index'))
            ->post(route('admin.karyawan_data.register-account', $karyawan))
            ->assertSessionHasErrors('akun');

        $this->assertSame(1, User::where('email', 'dipakai@example.com')->count(), 'Email duplikat tidak boleh membuat akun baru.');
        $this->assertSame(0, EmployeeProfile::query()->count());
    }

    public function test_new_account_must_change_temporary_password_before_portal_access(): void
    {
        $karyawan = Karyawan::factory()->create([
            'nid' => '00612',
            'nama' => 'Dewi Lestari',
            'email' => 'dewi.lestari@example.com',
        ]);

        $this->actingAs($this->accountManager())
            ->post(route('admin.karyawan_data.register-account', $karyawan))
            ->assertRedirect(route('admin.karyawan_data.index'));

        $tempPassword = session('new_account_credentials')['password'];
        $user = User::where('email', 'dewi.lestari@example.com')->firstOrFail();

        // Sebelum kata sandi diganti, portal/internal ditahan middleware
        // must.password meskipun password sementaranya valid.
        $this->actingAs($user)
            ->get(route('karyawan.dashboard'))
            ->assertRedirect(route('account.password-notice'));

        // Setelah diganti, penanda dilepas dan pengguna boleh lanjut.
        $this->actingAs($user)
            ->post(route('account.password-update'), [
                'current_password' => $tempPassword,
                'password' => 'passwordbaru99',
                'password_confirmation' => 'passwordbaru99',
            ])
            ->assertRedirect(route('karyawan.dashboard'));

        $this->assertFalse($user->fresh()->must_change_password);
        $this->assertTrue(Hash::check('passwordbaru99', $user->fresh()->password));
    }

    public function test_karyawan_with_account_shows_registered_status_and_cannot_register_twice(): void
    {
        $karyawan = Karyawan::factory()->create([
            'nid' => '00611',
            'nama' => 'Andi Wijaya',
            'email' => 'andi.wijaya@example.com',
        ]);

        $this->actingAs($this->accountManager())
            ->post(route('admin.karyawan_data.register-account', $karyawan))
            ->assertRedirect(route('admin.karyawan_data.index'));

        // Percobaan kedua (mis. klik ganda / request manual) ditolak.
        $this->actingAs($this->accountManager())
            ->from(route('admin.karyawan_data.index'))
            ->post(route('admin.karyawan_data.register-account', $karyawan))
            ->assertSessionHasErrors('akun');

        $this->assertSame(1, User::where('email', 'andi.wijaya@example.com')->count());
        $this->assertSame(1, EmployeeProfile::query()->count());

        // Daftar menampilkan status, bukan tombol pendaftaran ulang.
        $html = $this->actingAs($this->accountManager())
            ->get(route('admin.karyawan_data.index'))
            ->assertOk()
            ->getContent();

        $this->assertStringContainsString('Sudah Terdaftar', $html);
        $this->assertStringNotContainsString(route('admin.karyawan_data.register-account', $karyawan), $html);
    }

    public function test_register_account_is_atomic_when_profile_save_fails(): void
    {
        $karyawan = Karyawan::factory()->create([
            'nid' => '00620',
            'nama' => 'Nama Bentrok',
            'email' => 'bentrok@example.com',
        ]);

        // Paksa kegagalan SETELAH akun & pivot role dibuat (di tengah
        // transaksi) — akun tidak boleh tersisa setengah jadi.
        EmployeeProfile::creating(function (): void {
            throw new \RuntimeException('Simulasi kegagalan penyimpanan profil kepegawaian.');
        });

        try {
            $this->actingAs($this->accountManager())
                ->from(route('admin.karyawan_data.index'))
                ->post(route('admin.karyawan_data.register-account', $karyawan))
                ->assertSessionHasErrors('akun');
        } finally {
            EmployeeProfile::flushEventListeners();
        }

        // Rollback penuh: tidak ada akun, pivot role, atau profil tersisa.
        $this->assertFalse(User::where('email', 'bentrok@example.com')->exists());
        $this->assertSame(0, EmployeeProfile::query()->count());
    }
}
