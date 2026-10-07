<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Tamu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminTamuTest extends TestCase
{
    use RefreshDatabase;

    /* =========================================================
       HELPERS
       ========================================================= */

    private function adminWithPermissions(array $permissions): User
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name'        => 'Admin Tamu ' . uniqid(),
            'description' => 'Role uji otomatis',
            'status'      => true,
        ]);

        foreach ($permissions as $permission) {
            $perm = Permission::firstOrCreate(
                ['name' => $permission],
                ['display_name' => $permission, 'module' => 'Guest Book']
            );
            $role->permissions()->attach($perm->id);
        }

        $user->roles()->attach($role->id);

        return $user;
    }

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'nik'            => '3201999000000001',
            'nama'           => 'Siti Aminah',
            'instansi'       => 'PT Contoh Sejahtera',
            'no_hp'          => '081298765432',
            'email'          => 'siti@contoh.id',
            'tujuan_ditemui' => 'Divisi IT',
            'jumlah_tamu'    => '3',
            'tanggal_kunjungan' => now()->addDay()->format('Y-m-d\TH:i'),
            'keperluan'      => 'Audit sistem informasi.',
        ], $overrides);
    }

    private function createTamu(array $overrides = []): Tamu
    {
        return Tamu::create(array_merge([
            'nik'            => '3201123456780001',
            'nama'           => 'Budi Santoso',
            'no_hp'          => '081234567890',
            // dokumen_zip: path satu berkas pendukung di disk private
            'dokumen_zip'    => 'dokumen/budi.zip',
            'tujuan_ditemui' => 'Divisi Humas',
            'jumlah_tamu'    => 1,
            'tanggal_kunjungan' => now()->addDay(),
            'keperluan'      => 'Kunjungan industri.',
        ], $overrides));
    }

    /* =========================================================
       AKSES & GATE
       ========================================================= */

    public function test_index_requires_tamu_view_permission(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('admin.tamu.index'))
            ->assertForbidden();
    }

    public function test_index_renders_with_data(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu();

        $this->actingAs($admin)
            ->get(route('admin.tamu.index'))
            ->assertOk()
            ->assertSee('Manajemen Data Tamu')
            ->assertSee('Budi Santoso')
            ->assertSee('3201123456780001')
            ->assertSee('Berkunjung');
    }

    /* =========================================================
       STORE — TAMU MANUAL
       ========================================================= */

    public function test_store_creates_tamu_manual_without_dokumen(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);

        $this->actingAs($admin)
            ->post(route('admin.tamu.store'), $this->validPayload())
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success');

        $tamu = Tamu::where('nik', '3201999000000001')->first();
        $this->assertNotNull($tamu);
        $this->assertSame('Siti Aminah', $tamu->nama);
        $this->assertNull($tamu->dokumen_zip); // tanpa lampiran pun valid
    }

    public function test_store_accepts_optional_dokumen_upload(): void
    {
        Storage::fake('private');
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);

        $this->actingAs($admin)
            ->post(route('admin.tamu.store'), $this->validPayload([
                'dokumen' => UploadedFile::fake()->create('dokumen.zip', 200, 'application/zip'),
            ]))
            ->assertRedirect(route('admin.tamu.index'));

        $tamu = Tamu::where('nik', '3201999000000001')->first();
        Storage::disk('private')->assertExists($tamu->dokumen_zip);
        $this->assertStringStartsWith('dokumen/', $tamu->dokumen_zip);
    }

    public function test_store_rejects_dokumen_with_disallowed_extension(): void
    {
        Storage::fake('private');
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);

        $this->actingAs($admin)
            ->post(route('admin.tamu.store'), $this->validPayload([
                'dokumen' => UploadedFile::fake()->create('dokumen.docx', 300,
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
            ]))
            ->assertSessionHasErrors(['dokumen']);
    }

    public function test_store_requires_tamu_create_permission(): void
    {
        $viewer = $this->adminWithPermissions(['tamu.view']);

        $this->actingAs($viewer)
            ->post(route('admin.tamu.store'), $this->validPayload())
            ->assertForbidden();

        $this->assertDatabaseMissing('tamus', ['nik' => '3201999000000001']);
    }

    public function test_store_rejects_duplicate_nik(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);
        $this->createTamu(); // NIK 3201123456780001

        $this->actingAs($admin)
            ->post(route('admin.tamu.store'), $this->validPayload(['nik' => '3201123456780001']))
            ->assertSessionHasErrors(['nik']);
    }

    /* =========================================================
       UPDATE — MODAL EDIT
       ========================================================= */

    public function test_update_replaces_dokumen_and_deletes_old_file(): void
    {
        Storage::fake('private');
        // REVISI RBAC — edit tamu kini memakai permission tamu.edit
        // (matriks CRUD per ID Menu), bukan tamu.create.
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.edit']);
        $tamu = $this->createTamu();
        Storage::disk('private')->put($tamu->dokumen_zip, 'lama');

        $this->actingAs($admin)
            ->put(route('admin.tamu.update', $tamu), $this->validPayload([
                'dokumen' => UploadedFile::fake()->create('baru.pdf', 150, 'application/pdf'),
            ]))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success');

        $tamu->refresh();
        Storage::disk('private')->assertMissing('dokumen/budi.zip');
        Storage::disk('private')->assertExists($tamu->dokumen_zip);
    }

    public function test_update_requires_tamu_edit_permission(): void
    {
        // REVISI RBAC — PUT tamu/{tamu} dilindungi permission:tamu.edit;
        // admin yang hanya punya tamu.create ditolak 403.
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);
        $tamu = $this->createTamu();

        $this->actingAs($admin)
            ->put(route('admin.tamu.update', $tamu), $this->validPayload())
            ->assertForbidden();
    }

    /* =========================================================
       CHECK-OUT
       ========================================================= */

    public function test_checkout_sets_checked_out_at(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.checkout']);
        $tamu = $this->createTamu();

        $this->actingAs($admin)
            ->patch(route('admin.tamu.checkout', $tamu))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success');

        $this->assertNotNull($tamu->fresh()->checked_out_at);
    }

    public function test_checkout_is_idempotent_guarded(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.checkout']);
        $tamu = $this->createTamu(['checked_out_at' => now()->subHour()]);

        $this->actingAs($admin)
            ->patch(route('admin.tamu.checkout', $tamu))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('error');
    }

    /* =========================================================
       DELETE
       ========================================================= */

    public function test_destroy_deletes_tamu_and_dokumen_file(): void
    {
        Storage::fake('private');
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.delete']);
        $tamu = $this->createTamu();
        Storage::disk('private')->put($tamu->dokumen_zip, 'dummy');

        $this->actingAs($admin)
            ->delete(route('admin.tamu.destroy', $tamu))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('tamus', ['id' => $tamu->id]);
        Storage::disk('private')->assertMissing($tamu->dokumen_zip);
    }

    public function test_destroy_requires_tamu_delete_permission(): void
    {
        $viewer = $this->adminWithPermissions(['tamu.view']);
        $tamu = $this->createTamu();

        $this->actingAs($viewer)
            ->delete(route('admin.tamu.destroy', $tamu))
            ->assertForbidden();

        $this->assertDatabaseHas('tamus', ['id' => $tamu->id]);
    }

    /* =========================================================
       FILTER & EXPORT
       ========================================================= */

    public function test_index_filters_by_status(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        // "berkunjung" hanya untuk tamu yang sudah DISETUJUI & belum check-out
        $this->createTamu([
            'nama'               => 'Tamu Aktif',
            'status_verifikasi'  => Tamu::STATUS_DISETUJUI,
        ]);
        $this->createTamu([
            'nama'               => 'Tamu Selesai',
            'nik'                => '3201123456780002',
            'status_verifikasi'  => Tamu::STATUS_DISETUJUI,
            'checked_out_at'     => now()->subHour(),
        ]);

        $this->actingAs($admin)
            ->get(route('admin.tamu.index', ['status' => 'berkunjung']))
            ->assertOk()
            ->assertSee('Tamu Aktif')
            ->assertDontSee('Tamu Selesai');
    }

    public function test_index_filters_by_verifikasi_menunggu(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu(['nama' => 'Tamu Menunggu Verifikasi']);
        $this->createTamu([
            'nama'              => 'Tamu Sudah Disetujui',
            'nik'               => '3201123456780005',
            'status_verifikasi' => Tamu::STATUS_DISETUJUI,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.tamu.index', ['status' => 'menunggu']))
            ->assertOk()
            ->assertSee('Tamu Menunggu Verifikasi')
            ->assertDontSee('Tamu Sudah Disetujui');
    }

    public function test_verifikasi_setuju_updates_status_and_redirects_with_wa(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.checkout']);
        $tamu = $this->createTamu();

        $this->actingAs($admin)
            ->post(route('admin.tamu.verifikasi', $tamu), ['keputusan' => 'setuju'])
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success')
            ->assertSessionHas('wa_konfirmasi');

        $tamu->refresh();
        $this->assertSame(Tamu::STATUS_DISETUJUI, $tamu->status_verifikasi);
        $this->assertNotNull($tamu->verified_at);
        $this->assertSame($admin->id, $tamu->verified_by);
    }

    public function test_verifikasi_tolak_updates_status(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.checkout']);
        $tamu = $this->createTamu();

        $this->actingAs($admin)
            ->post(route('admin.tamu.verifikasi', $tamu), ['keputusan' => 'tolak'])
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('wa_konfirmasi');

        $tamu->refresh();
        $this->assertSame(Tamu::STATUS_DITOLAK, $tamu->status_verifikasi);
    }

    public function test_verifikasi_requires_checkout_permission(): void
    {
        $viewer = $this->adminWithPermissions(['tamu.view']);
        $tamu = $this->createTamu();

        $this->actingAs($viewer)
            ->post(route('admin.tamu.verifikasi', $tamu), ['keputusan' => 'setuju'])
            ->assertForbidden();

        $this->assertSame(Tamu::STATUS_MENUNGGU, $tamu->fresh()->status_verifikasi);
    }

    public function test_verifikasi_rejects_invalid_keputusan(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.checkout']);
        $tamu = $this->createTamu();

        $this->actingAs($admin)
            ->post(route('admin.tamu.verifikasi', $tamu), ['keputusan' => 'cacat'])
            ->assertSessionHasErrors(['keputusan']);
    }

    public function test_index_search_matches_nama_instansi_nik(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu(['nama' => 'Budi Santoso']);
        $this->createTamu([
            'nama'     => 'Ani Lestari',
            'nik'      => '3201123456780003',
            'instansi' => 'PT Maju Bersama',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.tamu.index', ['q' => 'maju']))
            ->assertOk()
            ->assertSee('Ani Lestari')
            ->assertDontSee('Budi Santoso');
    }

    public function test_export_streams_csv_with_filter(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu(['nama' => 'Budi Export']);
        $this->createTamu([
            'nama' => 'Ani Tersembunyi',
            'nik'  => '3201123456780004',
        ]);

        $response = $this->actingAs($admin)
            ->get(route('admin.tamu.export', ['q' => 'Budi Export']))
            ->assertOk();

        $this->assertStringContainsString(
            'text/csv',
            (string) $response->headers->get('Content-Type')
        );

        $content = $response->streamedContent();
        $this->assertStringContainsString('Budi Export', $content);
        $this->assertStringNotContainsString('Ani Tersembunyi', $content);
    }

    /* =========================================================
       PRINT — CETAK EXCEL / PDF (di bawah tabel)
       ========================================================= */

    public function test_print_page_requires_tamu_view_permission(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('admin.tamu.print', ['style' => 'excel']))
            ->assertForbidden();
    }

    public function test_print_excel_style_renders_spreadsheet_layout(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu(['nama' => 'Budi Cetak']);

        $response = $this->actingAs($admin)
            ->get(route('admin.tamu.print', ['style' => 'excel']))
            ->assertOk()
            ->assertSee('Data Tamu — Buku Registrasi')
            ->assertSee('Budi Cetak')
            ->assertSee('sheet', false); // class pembungkus gaya excel

        // Kolom ber-label abjad ala Excel (A, B, C, ...)
        $response->assertSee('col-id', false);
    }

    public function test_print_pdf_style_renders_formal_report(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu(['nama' => 'Siti Laporan']);

        $response = $this->actingAs($admin)
            ->get(route('admin.tamu.print', ['style' => 'pdf']))
            ->assertOk()
            ->assertSee('Laporan Daftar Tamu')
            ->assertSee('Siti Laporan')
            ->assertSee('report', false)   // class pembungkus gaya pdf
            ->assertSee('Petugas Front Office'); // blok tanda tangan
    }

    public function test_print_follows_active_filter_and_shows_all_rows(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);

        // 20+ tamu bernama sama → melebihi 15 baris per halaman di index
        for ($i = 1; $i <= 20; $i++) {
            $this->createTamu([
                'nama' => 'Tamu Filter ' . $i,
                'nik'  => sprintf('320112345678%04d', $i),
            ]);
        }
        // Tamu lain yang HARUS tersembunyi oleh filter pencarian
        $this->createTamu(['nama' => 'Ani Tersembunyi', 'nik' => '3201999000000011']);

        $content = $this->actingAs($admin)
            ->get(route('admin.tamu.print', ['style' => 'excel', 'q' => 'Tamu Filter']))
            ->assertOk()
            ->getContent();

        // Seluruh 20 baris tercetak (bukan cuma 15 seperti pagination index)
        foreach ([1, 15, 20] as $n) {
            $this->assertStringContainsString('Tamu Filter ' . $n, $content);
        }
        $this->assertStringNotContainsString('Ani Tersembunyi', $content);
    }

    public function test_print_style_defaults_to_excel_for_unknown_style(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu();

        $this->actingAs($admin)
            ->get(route('admin.tamu.print', ['style' => 'hack']))
            ->assertOk()
            ->assertSee('sheet', false);
    }

    /* =========================================================
       DOKUMEN PRIVAT (satu berkas pendukung per tamu)
       ========================================================= */

    public function test_dokumen_requires_login(): void
    {
        $tamu = $this->createTamu();

        // Pengunjung (belum login) tidak bisa mengakses dokumen tamu
        $this->get(route('admin.tamu.dokumen', $tamu))->assertRedirect(route('login'));
    }

    public function test_dokumen_requires_tamu_view_permission(): void
    {
        // User login TANPA permission tamu.view → ditolak (403)
        $user = User::factory()->create();
        $tamu = $this->createTamu();

        $this->actingAs($user)
            ->get(route('admin.tamu.dokumen', $tamu))
            ->assertForbidden();
    }

    public function test_dokumen_streams_file_for_authorized_admin(): void
    {
        Storage::fake('private');
        $admin = $this->adminWithPermissions(['tamu.view']);
        $tamu = $this->createTamu();
        Storage::disk('private')->put($tamu->dokumen_zip, 'fake-document-bytes');

        $response = $this->actingAs($admin)
            ->get(route('admin.tamu.dokumen', $tamu))
            ->assertOk();

        $this->assertSame('fake-document-bytes', $response->streamedContent());
    }

    public function test_dokumen_404_when_tamu_has_no_dokumen(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $tamu = $this->createTamu(['dokumen_zip' => null]);

        $this->actingAs($admin)
            ->get(route('admin.tamu.dokumen', $tamu))
            ->assertNotFound();
    }

    public function test_dokumen_404_when_file_missing_on_disk(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $tamu = $this->createTamu(); // path terisi, tapi file tidak ada

        $this->actingAs($admin)
            ->get(route('admin.tamu.dokumen', $tamu))
            ->assertNotFound();
    }

    public function test_dokumen_url_points_to_private_route_not_public_storage(): void
    {
        $tamu = $this->createTamu();

        // URL tidak boleh mengarah ke /storage (publik)
        $url = $tamu->dokumen_zip_url;
        $this->assertNotNull($url);
        $this->assertStringNotContainsString('/storage/', $url);
        $this->assertStringContainsString('/dokumen', $url);
    }
}
