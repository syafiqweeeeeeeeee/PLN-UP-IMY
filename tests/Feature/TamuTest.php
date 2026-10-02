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
            // Satu berkas pendukung (ZIP/RAR/PDF/JPG/JPEG/PNG), maks 10MB
            'dokumen'        => UploadedFile::fake()->create('dokumen.zip', 200, 'application/zip'),
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
            ->assertSee('Berkas Pendukung')
            // Whitelist format pada atribut accept input file
            ->assertSee('.zip,.rar,.pdf,.jpg,.jpeg,.png', false)
            ->assertSee('Maksud &amp; Keperluan Kunjungan', false);
    }

    /* =========================================================
       STORE — SUKSES
       ========================================================= */

    public function test_store_creates_tamu_and_saves_document(): void
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

        // Berkas pendukung tersimpan di disk private (folder dokumen/)
        $this->assertNotNull($tamu->dokumen_zip);
        Storage::disk('private')->assertExists($tamu->dokumen_zip);
        $this->assertStringStartsWith('dokumen/', $tamu->dokumen_zip);
    }

    public function test_store_accepts_all_whitelisted_formats(): void
    {
        Storage::fake('private');

        $cases = [
            ['arsip.zip', 'application/zip'],
            ['arsip.rar', 'application/vnd.rar'],
            ['surat.pdf', 'application/pdf'],
            ['ktp.jpg',   'image/jpeg'],
            ['ktp.jpeg',  'image/jpeg'],
            ['ktp.png',   'image/png'],
        ];

        foreach ($cases as $i => [$name, $mime]) {
            $nik = sprintf('320112345678%04d', $i + 10);

            $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
                'nik'     => $nik,
                'dokumen' => UploadedFile::fake()->create($name, 100, $mime),
            ]))->assertRedirect(route('layanan.registrasi-tamu'));

            $tamu = Tamu::where('nik', $nik)->first();
            $this->assertNotNull($tamu, "Format {$name} harus diterima.");
            Storage::disk('private')->assertExists($tamu->dokumen_zip);
        }
    }

    /* =========================================================
       STORE — VALIDASI DOKUMEN
       ========================================================= */

    public function test_store_requires_dokumen(): void
    {
        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'dokumen' => null,
        ]))->assertSessionHasErrors(['dokumen']);
    }

    public function test_store_rejects_dokumen_with_disallowed_extension(): void
    {
        Storage::fake('private');

        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'dokumen' => UploadedFile::fake()->create('dokumen.docx', 300,
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
        ]))->assertSessionHasErrors(['dokumen']);
    }

    public function test_store_rejects_dokumen_over_10mb(): void
    {
        Storage::fake('private');

        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'dokumen' => UploadedFile::fake()->create('dokumen.zip', 10241, 'application/zip'),
        ]))->assertSessionHasErrors(['dokumen']);
    }

    /* =========================================================
       STORE — VALIDASI LAINNYA
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
            'dokumen_zip'    => 'dokumen/lama.zip',
            'tujuan_ditemui' => 'Humas',
            'jumlah_tamu'    => 1,
            'keperluan'      => 'Kunjungan.',
        ]);

        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload())
            ->assertSessionHasErrors(['nik']);
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
