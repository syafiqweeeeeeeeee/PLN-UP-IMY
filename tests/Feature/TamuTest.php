<?php

namespace Tests\Feature;

use App\Models\Tamu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TamuTest extends TestCase
{
    use RefreshDatabase;

    /* =========================================================
       HELPERS
       ========================================================= */

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'nik'            => '3201123456780001',
            'nama'           => 'Budi Santoso',
            'instansi'       => 'PT Maju Jaya',
            'no_hp'          => '081234567890',
            'email'          => 'budi@majujaya.id',
            'foto_ktp'       => UploadedFile::fake()->image('ktp.png', 400, 250),
            'surat_jalan'    => UploadedFile::fake()->create('surat.pdf', 500, 'application/pdf'),
            'tujuan_ditemui' => 'Divisi Humas',
            'jumlah_tamu'    => '2',
            'tanggal_kunjungan' => now()->addDay()->format('Y-m-d\TH:i'),
            'keperluan'      => 'Kunjungan industri dan wawancara.',
        ], $overrides);
    }

    /* =========================================================
       HALAMAN FORM
       ========================================================= */

    public function test_guest_can_view_registration_form(): void
    {
        $this->get(route('layanan.registrasi-tamu'))
            ->assertOk()
            ->assertSee('Form Registrasi Tamu')
            ->assertSee('NIK / No. KTP')
            ->assertSee('Foto KTP')
            ->assertSee('Surat Permohonan / Undangan (Opsional)')
            ->assertSee('Maksud &amp; Keperluan Kunjungan', false);
    }

    /* =========================================================
       STORE — SUKSES
       ========================================================= */

    public function test_store_creates_tamu_and_saves_ktp(): void
    {
        Storage::fake('private');

        $response = $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload());

        $response->assertRedirect(route('layanan.registrasi-tamu'))
            ->assertSessionHas('success');

        $tamu = Tamu::where('nik', '3201123456780001')->first();
        $this->assertNotNull($tamu);
        $this->assertSame('Budi Santoso', $tamu->nama);
        $this->assertSame(2, $tamu->jumlah_tamu);
        $this->assertNull($tamu->checked_in_at);
        $this->assertSame(
            now()->addDay()->format('Y-m-d H:i'),
            $tamu->tanggal_kunjungan->format('Y-m-d H:i')
        );

        // File tersimpan di disk private (storage/app/private/documents/ktp)
        Storage::disk('private')->assertExists($tamu->foto_ktp);
        $this->assertStringStartsWith('ktp/', $tamu->foto_ktp);

        // Surat PDF juga tersimpan di disk private
        Storage::disk('private')->assertExists($tamu->surat_jalan);
        $this->assertStringStartsWith('surat/', $tamu->surat_jalan);
    }

    /* =========================================================
       STORE — VALIDASI SURAT (PDF)
       ========================================================= */

    public function test_store_succeeds_without_surat_pdf(): void
    {
        Storage::fake('private');

        // Surat kini opsional: tanpa surat pun pendaftaran tetap valid
        $response = $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'surat_jalan' => null,
        ]));

        $response->assertRedirect(route('layanan.registrasi-tamu'))
            ->assertSessionHas('success');

        $tamu = Tamu::where('nik', '3201123456780001')->first();
        $this->assertNotNull($tamu);
        $this->assertNull($tamu->surat_jalan);
        Storage::disk('private')->assertExists($tamu->foto_ktp);
    }

    public function test_store_rejects_non_pdf_surat(): void
    {
        Storage::fake('private');

        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'surat_jalan' => UploadedFile::fake()->create('surat.docx', 300,
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
        ]))->assertSessionHasErrors(['surat_jalan']);
    }

    public function test_store_rejects_surat_over_5mb(): void
    {
        Storage::fake('private');

        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'surat_jalan' => UploadedFile::fake()->create('surat.pdf', 5121, 'application/pdf'),
        ]))->assertSessionHasErrors(['surat_jalan']);
    }

    /* =========================================================
       STORE — VALIDASI GAGAL
       ========================================================= */

    public function test_store_requires_nik(): void
    {
        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload(['nik' => '']))
            ->assertSessionHasErrors(['nik']);
    }

    public function test_store_rejects_nik_not_16_digits(): void
    {
        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload(['nik' => '12345']))
            ->assertSessionHasErrors(['nik']);
    }

    public function test_store_rejects_duplicate_nik(): void
    {
        Tamu::create([
            'nik'            => '3201123456780001',
            'nama'           => 'Lama',
            'no_hp'          => '08111',
            'foto_ktp'       => 'ktp/lama.png',
            'tujuan_ditemui' => 'Humas',
            'jumlah_tamu'    => 1,
            'keperluan'      => 'Kunjungan.',
        ]);

        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload())
            ->assertSessionHasErrors(['nik']);
    }

    public function test_store_rejects_ktp_over_2mb(): void
    {
        Storage::fake('private');

        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'foto_ktp' => UploadedFile::fake()->create('ktp.png', 2049, 'image/png'),
        ]))->assertSessionHasErrors(['foto_ktp']);
    }

    public function test_store_rejects_non_image_ktp(): void
    {
        Storage::fake('private');

        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'foto_ktp' => UploadedFile::fake()->create('ktp.pdf', 500, 'application/pdf'),
        ]))->assertSessionHasErrors(['foto_ktp']);
    }

    public function test_store_requires_required_fields(): void
    {
        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'nama'           => '',
            'no_hp'          => '',
            'tujuan_ditemui' => '',
            'keperluan'      => '',
        ]))->assertSessionHasErrors(['nama', 'no_hp', 'tujuan_ditemui', 'keperluan']);
    }

    public function test_store_requires_tanggal_kunjungan(): void
    {
        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'tanggal_kunjungan' => '',
        ]))->assertSessionHasErrors(['tanggal_kunjungan']);
    }

    public function test_store_rejects_tanggal_kunjungan_in_the_past(): void
    {
        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'tanggal_kunjungan' => now()->subDay()->format('Y-m-d\TH:i'),
        ]))->assertSessionHasErrors(['tanggal_kunjungan']);
    }

    public function test_old_input_is_retained_on_validation_error(): void
    {
        // Validasi gagal → Laravel men-flash old input ke session;
        // di view dipakai via old('nama').
        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload(['nik' => 'salah']))
            ->assertSessionHasErrors(['nik'])
            ->assertSessionHas('_old_input.nama', 'Budi Santoso');
    }
}
