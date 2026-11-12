<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Tamu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Route;
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
            // Selaras form: tanggal (input date) + jam (dropdown slot)
            // dikirim terpisah, digabung jadi datetime oleh controller
            'tanggal_kunjungan' => now()->addDay()->format('Y-m-d'),
            'jam_kunjungan'     => '09:00',
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
                'dokumen' => UploadedFile::fake()->create('dokumen.txt', 300, 'text/plain'),
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

    /* Tombol "Edit Data Tamu" — kontrak JS dropdown custom.
       ensureDivisiOption() dahulu memanggil .closest('.tamu-dd-wrap')
       pada hidden input yang berada DI LUAR wrapper -> null -> TypeError
       -> openEditModal terhenti sebelum modal terbuka (tombol terasa
       mati). Proyek belum punya test runner JS, jadi kunci kontraknya
       di sini. */
    public function test_edit_modal_js_dropdown_mengambil_wrapper_dengan_aman(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.edit']);
        $this->createTamu();

        $html = $this->actingAs($admin)
            ->get(route('admin.tamu.index'))
            ->assertOk()
            ->getContent();

        // Tombol Edit tersedia & membawa payload baris tabel.
        $this->assertStringContainsString('openEditModal(', $html);

        // Guard: wrapper diambil dari hidden ATAU display input —
        // tidak mengandalkan hidden input berada di dalam wrapper.
        $this->assertStringContainsString(
            "hidden.closest('.tamu-dd-wrap') || display.closest('.tamu-dd-wrap')",
            $html
        );

        // Opsi jam dibangun via JS lokal (tanpa fetch API blokir jam);
        // select jam wajib selalu terisi sehingga form tetap bisa disimpan.
        $this->assertStringContainsString('function buildJamOptions(prefix)', $html);
        $this->assertStringNotContainsString('booked-slots', $html);
    }

    /* =========================================================
       CHECK-OUT
       ========================================================= */

    public function test_checkout_sets_checked_out_at(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.checkout']);
        $tamu = $this->createTamu(['status_verifikasi' => Tamu::STATUS_DISETUJUI]);

        // Prasyarat alur: tamu tiba di front office -> check-in dulu,
        // baru check-out boleh dilakukan.
        $this->actingAs($admin)
            ->patch(route('admin.tamu.checkin', $tamu))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success');

        $this->actingAs($admin)
            ->patch(route('admin.tamu.checkout', $tamu))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success');

        $fresh = $tamu->fresh();
        $this->assertNotNull($fresh->checked_in_at);
        $this->assertNotNull($fresh->checked_out_at);
        $this->assertSame('Selesai', $fresh->kunjunganState()['label']);
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

    public function test_index_menampilkan_log_verifikasi_dan_tombol_revisi(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.checkout']);
        $karyawan = User::factory()->create(['name' => 'ABDI ROBBI IKHSAN']);

        // Baris yang SUDAH diproses karyawan -> log tampil DAN tombol
        // revisi muncul (Dibatalkan -> tombol "Ubah menjadi Disetujui").
        $this->createTamu([
            'status_verifikasi' => Tamu::STATUS_DITOLAK,
            'verified_by'       => $karyawan->id,
            'verified_at'       => now()->subHour(),
        ]);
        // Baris masih menunggu -> tombol Setujui/Tolak tetap tampil.
        $this->createTamu([
            'nik'  => '3201123456780002',
            'nama' => 'Tamu Masih Menunggu',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.tamu.index'));

        $response->assertOk()
            ->assertSee('Dibatalkan oleh Karyawan atasnama')
            ->assertSee('ABDI ROBBI IKHSAN')
            ->assertSee('pada tanggal')
            ->assertSee('Tamu Masih Menunggu');

        // 2 tombol baris "Menunggu" + 1 tombol revisi baris "Dibatalkan".
        $this->assertSame(3, substr_count($response->getContent(), 'onclick="openVerifikasiModal('));
    }

    public function test_index_tabel_ringkas_lima_kolom_sisanya_di_popup(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu();

        $response = $this->actingAs($admin)->get(route('admin.tamu.index'));
        $response->assertOk();

        $html = $response->getContent();

        // Header: hanya 5 kolom — No/Waktu Masuk, Jadwal, Instansi, Status, Aksi.
        $this->assertSame(1, preg_match('/<thead>(.*?)<\/thead>/s', $html, $head));
        $this->assertSame(5, substr_count($head[1], '<th'));
        foreach (['No / Waktu Masuk', 'Jadwal Kunjungan', 'Instansi', 'Status', 'Aksi'] as $label) {
            $this->assertStringContainsString($label, $head[1]);
        }

        // Baris data juga hanya 5 sel (identitas, kontak, tujuan & dokumen
        // sudah pindah ke popup detail).
        $this->assertSame(1, preg_match('/<tbody>(.*?)<\/tbody>/s', $html, $body));
        $this->assertSame(1, preg_match('/<tr[^>]*>(.*?)<\/tr>/s', $body[1], $row));
        $this->assertSame(5, substr_count($row[1], '<td'));

        // Payload popup tetap memuat identitas + kontak (WA & email).
        $this->assertStringContainsString('"wa":', $html);
        $this->assertStringContainsString('"email":', $html);
        $this->assertStringContainsString('waHref(', $html);
        $this->assertStringContainsString('mailto:', $html);
    }

    public function test_verifikasi_status_bisa_direvisi_oleh_pihak_lain(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.checkout']);

        // Karyawan yang ditemui sudah memproses lebih dulu.
        $karyawan = User::factory()->create(['name' => 'ABDI ROBBI IKHSAN']);
        $tamu = $this->createTamu([
            'status_verifikasi' => Tamu::STATUS_DISETUJUI,
            'verified_by'       => $karyawan->id,
            'verified_at'       => now()->subHour(),
        ]);

        // REVISI: status "Disetujui" -> "Dibatalkan" diperbolehkan,
        // verified_by & verified_at ikut diperbarui ke pihak terakhir.
        $this->actingAs($admin)
            ->post(route('admin.tamu.verifikasi', $tamu), ['keputusan' => 'tolak'])
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success')
            ->assertSessionHas('wa_konfirmasi');

        $tamu->refresh();
        $this->assertSame(Tamu::STATUS_DITOLAK, $tamu->status_verifikasi);
        $this->assertSame($admin->id, $tamu->verified_by);
        $this->assertNotNull($tamu->verified_at);
        $this->assertTrue($tamu->verified_at->gte(now()->subMinute()));
    }

    /* =========================================================
       HALAMAN DETAIL DIHAPUS — modal pop-up satu-satunya tampilan detail
       ========================================================= */

    public function test_halaman_detail_dihapus_dan_index_membuka_modal(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $tamu  = $this->createTamu();

        // Halaman detail lama tidak ada lagi (route dihapus) -> 404,
        // sementara daftar tetap bisa diakses & memuat modal detail.
        $this->actingAs($admin)
            ->get('/admin/tamu/' . $tamu->id . '/detail')
            ->assertNotFound();

        $this->actingAs($admin)
            ->get(route('admin.tamu.index'))
            ->assertOk()
            ->assertSee('id="detailModal"', false)
            ->assertSee('Status Kunjungan');
    }

    public function test_modal_detail_menampilkan_log_dan_payload_sesuai_status(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.checkout']);
        $karyawan = User::factory()->create(['name' => 'ABDI ROBBI IKHSAN']);

        // Kunjungan SUDAH diproses -> payload log berisi siapa & kapan.
        $this->createTamu([
            'nik'               => '3201123456780022',
            'nama'              => 'Tamu Disetujui Detail',
            'status_verifikasi' => Tamu::STATUS_DISETUJUI,
            'verified_by'       => $karyawan->id,
            'verified_at'       => now()->subHour(),
        ]);
        // Kunjungan masih menunggu -> catatan "belum ada perubahan".
        $this->createTamu([
            'nik'  => '3201123456780021',
            'nama' => 'Tamu Menunggu Detail',
        ]);

        $html = $this->actingAs($admin)->get(route('admin.tamu.index'))
            ->assertOk()
            ->assertSee('Status Kunjungan')
            ->getContent();

        // Kartu status ada di shell modal & diisi JS dari payload.
        $this->assertStringContainsString('data-role="status-card"', $html);
        $this->assertStringContainsString('data-role="status-info"', $html);
        $this->assertStringContainsString('data-role="status-badge"', $html);
        $this->assertStringNotContainsString('data-role="log"', $html);

        // Isi log terkirim per tamu lewat payload (pengganti halaman detail).
        $this->assertStringContainsString('Terakhir diperbarui oleh', $html);
        $this->assertStringContainsString('ABDI ROBBI IKHSAN', $html);
        $this->assertStringContainsString('Belum ada perubahan status', $html);

        // Aksi status tetap dari baris tabel -> modal verifikasi.
        $this->assertStringContainsString('openVerifikasiModal(', $html);
    }

    public function test_approve_revisi_dari_dibatalkan_menjadi_disetujui(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.checkout']);
        $karyawan = User::factory()->create(['name' => 'ABDI ROBBI IKHSAN']);
        $tamu = $this->createTamu([
            'status_verifikasi' => Tamu::STATUS_DITOLAK,
            'verified_by'       => $karyawan->id,
            'verified_at'       => now()->subHour(),
        ]);

        $this->actingAs($admin)
            ->post(route('admin.tamu.approve', $tamu))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success')
            ->assertSessionHas('wa_konfirmasi');

        $tamu->refresh();
        $this->assertSame(Tamu::STATUS_DISETUJUI, $tamu->status_verifikasi);
        $this->assertSame($admin->id, $tamu->verified_by);
        $this->assertTrue($tamu->verified_at->gte(now()->subMinute()));

        // Sebaliknya: Disetujui -> Dibatalkan lewat reject().
        $this->actingAs($admin)
            ->post(route('admin.tamu.reject', $tamu))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success')
            ->assertSessionHas('wa_konfirmasi');

        $tamu->refresh();
        $this->assertSame(Tamu::STATUS_DITOLAK, $tamu->status_verifikasi);
        $this->assertSame($admin->id, $tamu->verified_by);
    }

    public function test_approve_reject_butuh_permission_checkout(): void
    {
        $viewer = $this->adminWithPermissions(['tamu.view']);
        $tamu = $this->createTamu();

        $this->actingAs($viewer)->post(route('admin.tamu.approve', $tamu))->assertForbidden();
        $this->actingAs($viewer)->post(route('admin.tamu.reject', $tamu))->assertForbidden();

        $this->assertSame(Tamu::STATUS_MENUNGGU, $tamu->fresh()->status_verifikasi);
    }

    public function test_approve_tetap_diterima_meski_jadwal_sama_dengan_kunjungan_lain(): void
    {
        // Revisi bisnis: pemblokiran slot jam DIHAPUS — approve tidak
        // lagi ditolak hanya karena jadwal sama dengan kunjungan lain.
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.checkout']);
        $jadwal = now()->addDays(3)->setTime(9, 0);

        // Kunjungan lain sudah DISETUJUI pada slot & divisi yang sama.
        $this->createTamu([
            'nik'               => '3201123456780031',
            'nama'              => 'Tamu Sudah Disetujui',
            'tanggal_kunjungan' => $jadwal,
            'status_verifikasi' => Tamu::STATUS_DISETUJUI,
            'verified_by'       => User::factory()->create()->id,
            'verified_at'       => now()->subHour(),
        ]);
        $tamu = $this->createTamu([
            'nik'               => '3201123456780032',
            'nama'              => 'Tamu Jadwal Sama',
            'tanggal_kunjungan' => $jadwal,
        ]);

        $this->actingAs($admin)
            ->post(route('admin.tamu.approve', $tamu))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success');

        $this->assertSame(Tamu::STATUS_DISETUJUI, $tamu->fresh()->status_verifikasi);
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

    public function test_print_renders_official_report_for_both_styles(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu(['nama' => 'Budi Cetak']);

        // Kedua URL gaya cetak kini menghasilkan dokumen resmi yang sama.
        foreach (['excel', 'pdf'] as $style) {
            $content = $this->actingAs($admin)
                ->get(route('admin.tamu.print', ['style' => $style]))
                ->assertOk()
                ->assertSee('LAPORAN BUKU REGISTRASI TAMU')
                ->assertSee('Budi Cetak')
                ->assertSee('PT PLN NUSANTARA POWER')
                ->assertSee('UNIT PEMBANGKITAN INDRAMAYU')
                ->assertSee('Periode Cetak:')
                ->assertSee('Waktu Cetak:')
                ->assertDontSee('Dicetak dari')
                ->getContent();

            // Abjad indeks kolom ala spreadsheet sudah dihapus.
            $this->assertStringNotContainsString('col-id', $content);
        }
    }

    public function test_print_menampilkan_kolom_detail_tamu_lengkap(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu([
            'nama'             => 'Budi Detail',
            'jabatan_ditemui'  => 'JUNIOR OFFICER KEUANGAN',
            'orang_ditemui'    => 'Siti Aminah',
        ]);

        $content = $this->actingAs($admin)
            ->get(route('admin.tamu.print', ['style' => 'excel']))
            ->assertOk()
            ->getContent();

        // 8 kolom gabungan sesuai format dokumen resmi.
        foreach ([
            'No',
            'Waktu &amp; Tanggal Kunjungan',
            'Nama Tamu &amp; Instansi',
            'NIK &amp; No. WhatsApp',
            'Bidang &amp; Jabatan Ditemui',
            'Personil Ditemui',
            'Keperluan',
            'Status Verifikasi',
        ] as $header) {
            $this->assertStringContainsString($header, $content);
        }

        // Nilai jabatan & personil ikut tercetak.
        $this->assertStringContainsString('JUNIOR OFFICER KEUANGAN', $content);
        $this->assertStringContainsString('Siti Aminah', $content);

        // Tidak ada lagi abjad indeks kolom (A, B, C, ... P).
        $this->assertStringNotContainsString('col-id', $content);
    }

    public function test_print_pdf_style_renders_formal_report(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu(['nama' => 'Siti Laporan']);

        $this->actingAs($admin)
            ->get(route('admin.tamu.print', ['style' => 'pdf']))
            ->assertOk()
            ->assertSee('LAPORAN BUKU REGISTRASI TAMU')
            ->assertSee('Siti Laporan')
            ->assertSee('PT PLN NUSANTARA POWER')
            ->assertSee('UNIT PEMBANGKITAN INDRAMAYU')
            ->assertSee('Jl. Raya Preteg - Sumuradem, Kec. Sukra, Kab. Indramayu, Jawa Barat 45257')
            ->assertSee('Petugas Security / Admin Services') // blok tanda tangan
            ->assertSee('Indramayu, ');
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

    public function test_print_tabel_rapi_pakai_lebar_kolom_tetap_di_kedua_gaya(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu(['nama' => 'Budi Rapi']);

        // Kedua URL gaya cetak harus memakai lebar kolom tetap (<colgroup>),
        // bukan lebar otomatis yang membuat kolom menyusut jadi satu
        // karakter per baris.
        foreach (['excel', 'pdf'] as $style) {
            $content = $this->actingAs($admin)
                ->get(route('admin.tamu.print', ['style' => $style]))
                ->assertOk()
                ->getContent();

            $this->assertSame(
                1,
                preg_match('/<colgroup>.*?<\/colgroup>/s', $content, $colgroup),
                "gaya {$style} tanpa colgroup"
            );

            $cols = substr_count($colgroup[0], '<col ');
            $this->assertSame(8, $cols, "gaya {$style} tidak punya 8 kolom tetap");

            // Total lebar kolom harus 100% → tabel selalu muat di kertas.
            preg_match_all('/width:([\d.]+)%/', $colgroup[0], $widths);
            $this->assertEqualsWithDelta(100.0, array_sum(array_map('floatval', $widths[1])), 0.01, "total lebar kolom gaya {$style}");

            // Tabel 8 kolom: lebar inline per <th> dilarang karena
            // menimpa colgroup dan membuat tabel keluar kertas.
            $this->assertStringNotContainsString('<th style="width:', $content, "gaya {$style} masih memakai lebar inline");

            // Teks panjang turun baris, tidak terpotong di kolom sempit.
            $this->assertStringContainsString('word-wrap: break-word', $content);
            $this->assertStringContainsString('white-space: normal', $content);
        }
    }

    public function test_print_unrecognized_style_still_renders_official_report(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu();

        // URL gaya tidak dikenal tetap aman dan menampilkan dokumen resmi.
        $this->actingAs($admin)
            ->get(route('admin.tamu.print', ['style' => 'hack']))
            ->assertOk()
            ->assertSee('LAPORAN BUKU REGISTRASI TAMU');
    }

    /* =========================================================
       PRINT — FILTER STATUS & PASS INDIVIDUAL
       ========================================================= */

    public function test_print_bar_menyediakan_dropdown_filter_status(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu();

        $html = $this->actingAs($admin)
            ->get(route('admin.tamu.index'))
            ->assertOk()
            ->assertSee('Filter Status')
            // Komponen custom (bukan <select> native) + label ringkas.
            ->assertSee('print-status-dd', false)
            ->assertSee('print-status-trigger', false)
            ->assertSee('print-status-menu', false)
            ->assertSee('role="listbox"', false)
            ->assertSee('Semua Status')
            ->assertSee('Disetujui')
            ->assertSee('Menunggu Verifikasi')
            ->assertSee('Ditolak')
            ->assertSee('Cetak / Export')
            ->getContent();

        // Label lama yang panjang sudah tidak dipakai.
        $this->assertStringNotContainsString('All (Semua Data)', $html);
        $this->assertStringNotContainsString('Approved / Checked-out', $html);
        $this->assertStringNotContainsString('(Pending)', $html);
        $this->assertStringNotContainsString('(Rejected)', $html);

        // Print form tetap mengirim status lewat hidden input.
        $this->assertStringContainsString('name="status" id="printStatus"', $html);
    }

    public function test_print_status_verifikasi_tanpa_kolom_checkin_checkout(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu([
            'nik' => '3201123456780151',
            'nama' => 'Tamu Sudah Pulang',
            'status_verifikasi' => Tamu::STATUS_DISETUJUI,
            'checked_in_at' => now()->subHours(2),
            'checked_out_at' => now()->subHour(),
        ]);

        $this->actingAs($admin)
            ->get(route('admin.tamu.print', ['style' => 'pdf']))
            ->assertOk()
            ->assertSee('Status Verifikasi')
            ->assertSee('Disetujui')
            ->assertDontSee('In: ')
            ->assertDontSee('Out: ')
            ->assertDontSee('Berkunjung')
            ->assertDontSee('Selesai');
    }

    public function test_print_mengikuti_filter_status_yang_dipilih(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);

        $this->createTamu([
            'nik' => '3201123456780101', 'nama' => 'Tamu Disetujui',
            'status_verifikasi' => Tamu::STATUS_DISETUJUI,
        ]);
        $this->createTamu([
            'nik' => '3201123456780102', 'nama' => 'Tamu Menunggu',
            'status_verifikasi' => Tamu::STATUS_MENUNGGU,
        ]);
        $this->createTamu([
            'nik' => '3201123456780103', 'nama' => 'Tamu Ditolak',
            'status_verifikasi' => Tamu::STATUS_DITOLAK,
        ]);

        $disetujui = $this->actingAs($admin)
            ->get(route('admin.tamu.print', ['style' => 'pdf', 'status' => 'disetujui']))
            ->assertOk()
            ->assertSee('Tamu Disetujui')
            ->assertSee('Status: Disetujui / Selesai')
            ->assertDontSee('Tamu Menunggu')
            ->assertDontSee('Tamu Ditolak')
            ->getContent();

        // Judul dokumen resmi tetap tampil pada hasil filter status.
        $this->assertStringContainsString('LAPORAN BUKU REGISTRASI TAMU', $disetujui);

        $this->actingAs($admin)
            ->get(route('admin.tamu.print', ['style' => 'pdf', 'status' => 'menunggu']))
            ->assertOk()
            ->assertSee('Tamu Menunggu')
            ->assertDontSee('Tamu Disetujui')
            ->assertDontSee('Tamu Ditolak');

        $this->actingAs($admin)
            ->get(route('admin.tamu.print', ['style' => 'pdf', 'status' => 'ditolak']))
            ->assertOk()
            ->assertSee('Tamu Ditolak')
            ->assertDontSee('Tamu Disetujui')
            ->assertDontSee('Tamu Menunggu');
    }

    public function test_halaman_pass_tamu_sudah_dihapus(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $tamu = $this->createTamu([
            'nik' => '3201123456780201',
            'status_verifikasi' => Tamu::STATUS_DISETUJUI,
        ]);

        // Fitur pass individual dihapus: route-nya tidak terdaftar lagi dan
        // URL lama (…/admin/tamu/{id}/pass) tidak menghasilkan dokumen apa pun.
        $this->assertFalse(Route::has('admin.tamu.pass'));

        $this->actingAs($admin)
            ->get('/admin/tamu/' . $tamu->id . '/pass')
            ->assertNotFound();
    }

    /* =========================================================
       PRINT — HEADER/FOOTER BAWAAN BROWSER (URL, TANGGAL, JUDUL)
       ========================================================= */

    public function test_dokumen_cetak_memakai_page_margin_nol_agar_header_footer_browser_hilang(): void
    {
        // Chrome/Edge/Firefox hanya membuang header & footer bawaan (URL
        // halaman, tanggal, judul) bila halaman cetak tidak menyisakan ruang
        // margin. Karena itu margin @page WAJIB 0 dan jarak ke tepi kertas
        // dipindah ke padding .paper — jangan dikembalikan ke 15mm.
        $admin = $this->adminWithPermissions(['tamu.view']);
        $tamu = $this->createTamu([
            'nik' => '3201123456780601',
            'nama' => 'Tamu Cetak Bersih',
            'status_verifikasi' => Tamu::STATUS_DISETUJUI,
        ]);

        $dokumen = [
            'laporan' => [$this->actingAs($admin)->get(route('admin.tamu.print', ['style' => 'pdf']))->assertOk()->getContent(), 'A4 landscape'],
        ];

        foreach ($dokumen as $label => [$html, $ukuran]) {
            $this->assertSame(
                1,
                preg_match('/@page\s*\{[^}]*\}/', $html, $atPage),
                "{$label}: aturan @page tidak ditemukan"
            );

            $aturanPage = $atPage[0];
            $this->assertStringContainsString('margin: 0', $aturanPage, "{$label}: @page harus margin 0 agar URL browser tidak tercetak");
            $this->assertStringContainsString("size: {$ukuran}", $aturanPage, "{$label}: orientasi kertas berubah");
            $this->assertStringNotContainsString('15mm', $aturanPage, "{$label}: margin @page 15mm memunculkan header/footer browser");

            // Jarak aman ke tepi kertas tetap ada lewat padding kertas.
            $this->assertMatchesRegularExpression(
                '/\.paper\s*\{[^}]*padding:\s*\d+mm/',
                $html,
                "{$label}: .paper kehilangan padding cetak"
            );

            // Elemen yang tidak boleh tercetak.
            $this->assertMatchesRegularExpression(
                '/\.no-print,[^{]*\.btn-print[^{]*\{[^}]*display:\s*none\s*!important/',
                $html,
                "{$label}: .btn-print belum disembunyikan saat cetak"
            );
            $this->assertMatchesRegularExpression(
                '/\.no-print,[^{]*\bfooter\b[^{]*\{[^}]*display:\s*none\s*!important/',
                $html,
                "{$label}: elemen footer belum disembunyikan saat cetak"
            );

            // Warna latar (kop/kop-garis/header tabel) tetap tercetak.
            $this->assertStringContainsString('print-color-adjust: exact', $html, "{$label}: print-color-adjust hilang");

            // Body cetak tanpa padding layar (body punya padding di layar).
            $this->assertMatchesRegularExpression(
                '/@media print\s*\{[\s\S]*?\bbody\s*\{[^}]*padding:\s*0/',
                $html,
                "{$label}: body cetak masih membawa padding layar"
            );
        }
    }

    public function test_tombol_pass_sudah_dihapus_dari_tabel(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.edit', 'tamu.checkout', 'tamu.delete']);

        $disetujui = $this->createTamu([
            'nik' => '3201123456780401',
            'nama' => 'Tamu Lolos',
            'status_verifikasi' => Tamu::STATUS_DISETUJUI,
        ]);
        $menunggu = $this->createTamu([
            'nik' => '3201123456780402',
            'nama' => 'Tamu Tunggu',
            'status_verifikasi' => Tamu::STATUS_MENUNGGU,
        ]);

        $content = $this->actingAs($admin)
            ->get(route('admin.tamu.index'))
            ->assertOk()
            ->getContent();

        // Tombol (dan CSS-nya) yang membuka halaman pass sudah tidak ada,
        // termasuk untuk tamu berstatus disetujui.
        $this->assertStringNotContainsString('Cetak Pass Tamu / Surat Izin', $content);
        $this->assertStringNotContainsString('tamu-action-btn pass', $content);
        $this->assertStringNotContainsString('/admin/tamu/' . $disetujui->id . '/pass', $content);
        $this->assertStringNotContainsString('/admin/tamu/' . $menunggu->id . '/pass', $content);
    }

    public function test_durasi_tidak_tampil_di_modal_detail_dan_laporan(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu([
            'nik' => '3201123456780501',
            'checked_in_at' => now()->subHour(),
            'checked_out_at' => now()->subMinutes(5),
        ]);

        // Modal detail (shell + template kartu check-in/out) tanpa kartu Durasi.
        $this->actingAs($admin)
            ->get(route('admin.tamu.index'))
            ->assertOk()
            ->assertDontSee('data-role="durasi"', false)
            ->assertDontSee('>Durasi<', false);

        // Laporan cetak juga tanpa kolom/nilai durasi.
        $this->actingAs($admin)
            ->get(route('admin.tamu.print', ['style' => 'pdf']))
            ->assertOk()
            ->assertDontSee('Durasi');
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
