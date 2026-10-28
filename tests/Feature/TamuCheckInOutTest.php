<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Tamu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * ALUR CHECK-OUT TAMU — metode rekomendasi utama (TANPA foto check-out).
 *
 * - Check-in  : satpam menandai kedatangan (prasyarat status "Berkunjung").
 * - Check-out : SATU klik tombol pada kartu Detail/Modal -> kolom
 *               checked_out_at terisi timestamp & status menjadi "Selesai",
 *               jam langsung tampil di layar tanpa reload (respons JSON AJAX).
 * - Guard     : kunjungan yang sudah check-out tidak bisa diklik ulang,
 *               dan check-out diblokir bila belum check-in.
 */
class TamuCheckInOutTest extends TestCase
{
    use RefreshDatabase;

    /* =========================================================
       HELPERS
       ========================================================= */

    /** Petugas front office (satpam) dengan gerbang tamu.checkout. */
    private function satpam(): User
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name'        => 'Satpam ' . uniqid(),
            'description' => 'Petugas front office uji otomatis',
            'status'      => true,
        ]);

        foreach (['tamu.view', 'tamu.checkout'] as $name) {
            $perm = Permission::firstOrCreate(
                ['name' => $name],
                ['display_name' => $name, 'module' => 'Guest Book']
            );
            $role->permissions()->attach($perm->id);
        }

        $user->roles()->attach($role->id);

        return $user;
    }

    /** Kunjungan berstatus disetujui (sudah lewat verifikasi admin). */
    private function kunjungan(array $overrides = []): Tamu
    {
        return Tamu::create(array_merge([
            'nik'               => '3201123456780901',
            'nama'              => 'Tamu Alur Check-Out',
            'no_hp'             => '081234567890',
            'dokumen_zip'       => 'dokumen/alur.zip',
            'tujuan_ditemui'    => 'Divisi Humas',
            'jumlah_tamu'       => 1,
            'tanggal_kunjungan' => now(),
            'keperluan'         => 'Kunjungan industri.',
            'status_verifikasi' => Tamu::STATUS_DISETUJUI,
            'verified_at'       => now()->subHour(),
            'verified_by'       => User::factory()->create()->id,
        ], $overrides));
    }

    /**
     * Ambil tag pembuka elemen (button/span) berdasarkan atributnya,
     * dipakai untuk memastikan tombol VISIBLE atau tersembunyi (hidden).
     */
    private function tagOf(string $html, string $attribute): string
    {
        $pattern = '/<(?:button|span)[^>]*\b' . preg_quote($attribute, '/') . '[^>]*>/';

        return preg_match($pattern, $html, $m) ? $m[0] : '';
    }

    /* =========================================================
       CHECK-IN — kedatangan tamu
       ========================================================= */

    public function test_checkin_mencatat_waktu_tiba(): void
    {
        $satpam = $this->satpam();
        $tamu   = $this->kunjungan();

        $sebelum = now()->subSecond();

        $this->actingAs($satpam)
            ->patch(route('admin.tamu.checkin', $tamu))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success');

        $fresh = $tamu->fresh();
        $this->assertNotNull($fresh->checked_in_at);
        $this->assertNull($fresh->checked_out_at);
        $this->assertTrue($fresh->checked_in_at->between($sebelum, now()->addSecond()));
        $this->assertTrue($fresh->isBerkunjung());
        $this->assertTrue($fresh->canCheckout());
        $this->assertFalse($fresh->canCheckin());
    }

    public function test_checkin_ditolak_bila_kunjungan_belum_disetujui(): void
    {
        $satpam = $this->satpam();
        $tamu   = $this->kunjungan([
            'status_verifikasi' => Tamu::STATUS_MENUNGGU,
            'verified_at'       => null,
            'verified_by'       => null,
        ]);

        $this->actingAs($satpam)
            ->patch(route('admin.tamu.checkin', $tamu))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('error');

        $this->assertNull($tamu->fresh()->checked_in_at);
    }

    public function test_checkin_tidak_bisa_diklik_ulang(): void
    {
        $satpam = $this->satpam();
        $jam    = now()->subHour()->startOfSecond();
        $tamu   = $this->kunjungan(['checked_in_at' => $jam]);

        $this->actingAs($satpam)
            ->patchJson(route('admin.tamu.checkin', $tamu))
            ->assertStatus(422)
            ->assertJsonPath('ok', false);

        $this->assertTrue($tamu->fresh()->checked_in_at->equalTo($jam));
    }

    public function test_checkin_butuh_permission_checkout(): void
    {
        $viewer = $this->satpam();
        $viewer->roles()->first()->permissions()->detach();
        $tamu = $this->kunjungan();

        $this->actingAs($viewer)
            ->patch(route('admin.tamu.checkin', $tamu))
            ->assertForbidden();

        $this->assertNull($tamu->fresh()->checked_in_at);
    }

    /* =========================================================
       CHECK-OUT — SATU KLIK, TANPA FOTO
       ========================================================= */

    public function test_checkout_diblokir_sebelum_checkin(): void
    {
        $satpam = $this->satpam();
        $tamu   = $this->kunjungan(); // belum check-in

        $this->actingAs($satpam)
            ->patch(route('admin.tamu.checkout', $tamu))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('error');

        $this->assertNull($tamu->fresh()->checked_out_at);
    }

    public function test_checkout_ajax_satu_klik_mengisi_timestamp_dan_status_selesai(): void
    {
        $satpam = $this->satpam();
        $tamu   = $this->kunjungan();

        $this->actingAs($satpam)
            ->patchJson(route('admin.tamu.checkin', $tamu))
            ->assertOk();

        $sebelum = now()->subSecond();

        $response = $this->actingAs($satpam)
            ->patchJson(route('admin.tamu.checkout', $tamu));

        $response->assertOk()
            ->assertJsonPath('ok', true)
            ->assertJsonPath('tamu.status', 'selesai')
            ->assertJsonPath('tamu.selesai', true)
            ->assertJsonPath('tamu.label', 'Selesai')
            ->assertJsonPath('tamu.badge', 'selesai')
            ->assertJsonPath('tamu.can_checkout', false)
            ->assertJsonPath('tamu.can_checkin', false);

        $fresh = $tamu->fresh();

        // Timestamp check-out tersimpan akurat (bukan string kosong/temporer)
        $this->assertNotNull($fresh->checked_out_at);
        $this->assertTrue($fresh->checked_out_at->between($sebelum, now()->addSecond()));
        $this->assertSame(
            $fresh->checked_out_at->format('d M Y, H:i'),
            $response->json('tamu.checkout'),
            'Jam check-out pada respons JSON harus sama dengan nilai tersimpan.'
        );
        $this->assertNotNull($fresh->checked_in_at);
        $this->assertNotNull($fresh->durasiKunjungan());
        $this->assertSame('Selesai', $fresh->kunjunganState()['label']);
    }

    public function test_checkout_ajax_tidak_bisa_diklik_ulang(): void
    {
        $satpam = $this->satpam();
        $jam    = now()->subMinutes(30)->startOfSecond();
        $tamu   = $this->kunjungan([
            'checked_in_at'  => now()->subHour(),
            'checked_out_at' => $jam,
        ]);

        $this->actingAs($satpam)
            ->patchJson(route('admin.tamu.checkout', $tamu))
            ->assertStatus(422)
            ->assertJsonPath('ok', false)
            ->assertJsonPath('tamu.status', 'selesai');

        $this->assertTrue($tamu->fresh()->checked_out_at->equalTo($jam));
    }

    public function test_checkout_butuh_permission_checkout(): void
    {
        $viewer = $this->satpam();
        $viewer->roles()->first()->permissions()->detach();
        $tamu = $this->kunjungan(['checked_in_at' => now()->subHour()]);

        $this->actingAs($viewer)
            ->patch(route('admin.tamu.checkout', $tamu))
            ->assertForbidden();

        $this->assertNull($tamu->fresh()->checked_out_at);
    }

    public function test_alur_lengkap_checkin_lalu_checkout_tanpa_error(): void
    {
        $satpam = $this->satpam();
        $tamu   = $this->kunjungan();

        // Simulasi hit: Check-In -> Check-Out -> cek ulang (idempoten)
        $this->actingAs($satpam)->patchJson(route('admin.tamu.checkin', $tamu))->assertOk();
        $this->actingAs($satpam)->patchJson(route('admin.tamu.checkout', $tamu))->assertOk();
        $this->actingAs($satpam)->patchJson(route('admin.tamu.checkout', $tamu))->assertStatus(422);

        $fresh = $tamu->fresh();
        $this->assertTrue($fresh->checked_in_at->lessThanOrEqualTo($fresh->checked_out_at));
        $this->assertTrue($fresh->durasiKunjungan() >= 0);

        // Tidak ada field kosong / redundant pada state kunjungan
        $state = $fresh->kunjunganState();
        foreach (['status', 'label', 'badge', 'badge_label', 'durasi_label'] as $kunci) {
            $this->assertNotEmpty($state[$kunci], "Kolom state '{$kunci}' tidak boleh kosong.");
        }
        $this->assertNotNull($state['checkin']);
        $this->assertNotNull($state['checkout']);
    }

    /* =========================================================
       TAMPILAN MINIMALIS — kartu + tombol
       ========================================================= */

    public function test_detail_menampilkan_tombol_check_out_saat_sedang_berkunjung(): void
    {
        $satpam = $this->satpam();
        $tamu   = $this->kunjungan(['checked_in_at' => now()->subHour()]);

        $html = $this->actingAs($satpam)
            ->get(route('admin.tamu.detail', $tamu))
            ->assertOk()
            ->assertSee('Check-Out Tamu')
            ->assertSee('Berkunjung')
            ->getContent();

        $tombol = $this->tagOf($html, 'data-action="checkout"');
        $this->assertNotSame('', $tombol, 'Tombol check-out harus ada di halaman detail.');
        $this->assertStringNotContainsString('hidden', $tombol, 'Tombol check-out harus aktif saat tamu berkunjung.');

        // Jam check-in ikut tampil; chip "Kunjungan selesai" masih tersembunyi
        $this->assertStringContainsString('data-role="checkin"', $html);
        $this->assertStringContainsString('hidden', $this->tagOf($html, 'data-role="done"'));
    }

    public function test_detail_menyembunyikan_tombol_check_out_setelah_selesai(): void
    {
        $satpam = $this->satpam();
        $tamu   = $this->kunjungan([
            'checked_in_at'  => now()->subHour(),
            'checked_out_at' => now()->subMinutes(10),
        ]);

        $html = $this->actingAs($satpam)
            ->get(route('admin.tamu.detail', $tamu))
            ->assertOk()
            ->assertSee('Selesai')
            ->getContent();

        $tombol = $this->tagOf($html, 'data-action="checkout"');
        $this->assertNotSame('', $tombol);
        $this->assertStringContainsString('hidden', $tombol, 'Tombol check-out disembunyikan setelah selesai.');

        // Chip "Kunjungan selesai" tampil tanpa hidden
        $chip = $this->tagOf($html, 'data-role="done"');
        $this->assertNotSame('', $chip);
        $this->assertStringNotContainsString('hidden', $chip);
    }

    public function test_index_menyediakan_kartu_checkinout_untuk_modal_detail(): void
    {
        $satpam = $this->satpam();
        $tamu   = $this->kunjungan();

        $html = $this->actingAs($satpam)
            ->get(route('admin.tamu.index'))
            ->assertOk()
            ->assertSee('id="coTemplate"', false)
            ->getContent();

        // Template kartu tersedia & URL aksi memakai placeholder :id
        $this->assertStringContainsString('data-co-card', $html);
        $this->assertStringContainsString('tamu/:id/checkout', $html);
        $this->assertStringContainsString('tamu/:id/checkin', $html);
        $this->assertStringContainsString('data-tamu-id="' . $tamu->id . '"', $html);

        // State kunjungan ikut dikirim ke JS agar modal menampilkan data terbaru
        $this->assertStringContainsString('"kunjungan"', $html);
    }

    /* =========================================================
       PORTAL KARYAWAN — konteks berbeda, alur sama
       ========================================================= */

    public function test_karyawan_portal_memakai_alur_checkin_checkout_sama(): void
    {
        $role = Role::firstOrCreate(
            ['name' => 'Karyawan'],
            ['description' => 'Pengguna internal / karyawan', 'status' => true]
        );

        foreach (['tamu.view', 'tamu.checkout'] as $name) {
            $perm = Permission::firstOrCreate(
                ['name' => $name],
                ['display_name' => $name, 'module' => 'Guest Book']
            );
            $role->permissions()->attach($perm->id);
        }

        $karyawan = User::factory()->create(['name' => 'Karyawan Satpam', 'role' => 'Karyawan']);
        $karyawan->role_id = $role->id;
        $karyawan->save();
        $karyawan->roles()->sync([$role->id]);

        $tamu = $this->kunjungan();

        $this->actingAs($karyawan)
            ->patchJson(route('karyawan.tamu.checkin', $tamu))
            ->assertOk()
            ->assertJsonPath('tamu.status', 'berkunjung');

        $this->actingAs($karyawan)
            ->patchJson(route('karyawan.tamu.checkout', $tamu))
            ->assertOk()
            ->assertJsonPath('tamu.status', 'selesai');

        $this->assertNotNull($tamu->fresh()->checked_out_at);

        // Kartu check-in/out juga tersedia di modal detail portal karyawan
        $this->actingAs($karyawan)
            ->get(route('karyawan.tamu.index'))
            ->assertOk()
            ->assertSee('id="coTemplate"', false)
            // Modal Detail memakai parsial bersama (shell + slot dinamis)
            ->assertSee('data-role="info"', false)
            ->assertSee('data-role="co-slot"', false)
            ->assertDontSee("['Check-In', t.checkin", false)
            ->assertDontSee("['Status', t.status", false);
    }

    /* =========================================================
       MODAL DETAIL — desain minimalis (parsial detail-tamu-modal)
       ========================================================= */

    public function test_modal_detail_tanpa_baris_redundan_checkin_checkout_status(): void
    {
        $satpam = $this->satpam();
        $this->kunjungan(['checked_in_at' => now()->subHour()]);

        $html = $this->actingAs($satpam)
            ->get(route('admin.tamu.index'))
            ->assertOk()
            ->getContent();

        // Parsial baru dipakai (shell berisi slot info/keperluan/dokumen/kartu)
        $this->assertStringContainsString('data-role="info"', $html);
        $this->assertStringContainsString('data-role="co-slot"', $html);
        $this->assertSame(1, substr_count($html, 'id="detailModal"'),
            'Modal Detail Tamu harus dirender tepat satu kali dari parsial bersama.');

        // Baris redundan DIHAPUS dari daftar informasi utama bagian atas
        $this->assertStringNotContainsString("['Check-In', t.checkin", $html);
        $this->assertStringNotContainsString("['Check-Out', t.checkout", $html);
        $this->assertStringNotContainsString("['Status', t.status", $html);

        // Bagian atas tetap menampilkan jadwal pendaftaran
        foreach (['Jumlah Tamu', 'Tanggal Kunjungan', 'Waktu Pendaftaran'] as $label) {
            $this->assertStringContainsString($label, $html);
        }
    }

    public function test_partial_modal_mode_lengkap_render_tanpa_checkin_out_status(): void
    {
        // Aksi tampil hanya bagi pemegang tamu.checkout — render sebagai satpam.
        $this->actingAs($this->satpam());

        $tamu = $this->kunjungan([
            'checked_in_at'  => now()->subHour(),
            'checked_out_at' => now()->subMinutes(10),
        ]);

        $html = view('admin.tamu.detail-tamu-modal', [
            'tamu'        => $tamu,
            'detailUrl'   => route('admin.tamu.detail', $tamu),
            'checkinUrl'  => route('admin.tamu.checkin', $tamu),
            'checkoutUrl' => route('admin.tamu.checkout', $tamu),
        ])->render();

        // Bagian atas: identitas + jadwal, tanpa 3 baris redundan
        $this->assertStringContainsString('Jumlah Tamu', $html);
        $this->assertStringContainsString('Waktu Pendaftaran', $html);
        $this->assertStringNotContainsString('<dt>Check-In</dt>', $html);
        $this->assertStringNotContainsString('<dt>Check-Out</dt>', $html);
        $this->assertStringNotContainsString('<dt>Status</dt>', $html);

        // Kartu dinamis (kondisi selesai) ikut ter-render di bagian bawah
        $this->assertStringContainsString('data-co-card', $html);
        $this->assertStringContainsString('Kunjungan selesai', $html);
        $this->assertStringContainsString(route('admin.tamu.checkout', $tamu), $html);
    }

    /* =========================================================
       ID TIDAK VALID — harus pesan ramah, BUKAN crash 404/500
       "No query results for model [App\Models\Tamu] ..."
       ========================================================= */

    public function test_checkin_checkout_id_tidak_dikenal_mengembalikan_flash_error(): void
    {
        $satpam = $this->satpam();

        foreach (['admin.tamu.checkin', 'admin.tamu.checkout'] as $route) {
            $this->actingAs($satpam)
                ->from(route('admin.tamu.index'))
                ->patch(route($route, 999999))
                ->assertRedirect(route('admin.tamu.index'))
                ->assertSessionHas('error');
        }
    }

    public function test_url_literal_placeholder_id_tidak_memicu_model_not_found(): void
    {
        // Regresi bug asli: tombol pada kartu TEMPLATE yang di-clone ke
        // modal daftar masih membawa URL '/tamu/:id/checkout' (placeholder
        // tidak pernah diganti) sehingga server melempar
        // "No query results for model [App\Models\Tamu] :id".
        $satpam = $this->satpam();

        foreach (['admin.tamu.checkin', 'admin.tamu.checkout'] as $route) {
            $this->actingAs($satpam)
                ->from(route('admin.tamu.index'))
                ->patch(route($route, ':id'))
                ->assertRedirect(route('admin.tamu.index'))
                ->assertSessionHas('error', 'Data tamu tidak ditemukan atau ID tidak valid.');
        }
    }

    public function test_ajax_id_invalid_membalas_json_404_bukan_halaman_error(): void
    {
        $satpam = $this->satpam();

        $this->actingAs($satpam)
            ->patchJson(route('admin.tamu.checkout', 999999))
            ->assertStatus(404)
            ->assertJsonPath('ok', false)
            ->assertJsonPath('message', 'Data tamu tidak ditemukan atau ID tidak valid.');
    }

    public function test_template_modal_menjajikan_placeholder_id_dan_script_menggantinya(): void
    {
        $satpam = $this->satpam();

        $html = $this->actingAs($satpam)
            ->get(route('admin.tamu.index'))
            ->assertOk()
            ->getContent();

        // Tombol template masih memakai placeholder (di-replace saat clone)...
        $tombol = $this->tagOf($html, 'data-action="checkout"');
        $this->assertNotSame('', $tombol);
        $this->assertStringContainsString('tamu/:id/checkout', $tombol);

        // ...dan kartu/klik menjaganya: placeholder diganti sebelum fetch.
        $this->assertStringContainsString("url.replace(':id', cid)", $html);
        $this->assertStringContainsString("el.dataset.url = String(el.dataset.url || '').replace(':id', t.id)", $html);
    }
}
