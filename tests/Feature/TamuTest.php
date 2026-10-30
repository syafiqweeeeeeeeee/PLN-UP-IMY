<?php

namespace Tests\Feature;

use App\Models\Bidang;
use App\Models\HariLibur;
use App\Models\Jabatan;
use App\Models\Tamu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TamuTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Master data minimal — validasi bertingkat form registrasi
     * mewajibkan jabatan yang dipilih sesuai bidang tujuan.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $bidang = Bidang::firstOrCreate(['nama' => 'Divisi Humas']);
        Jabatan::firstOrCreate([
            'nama'      => 'Kepala Bagian Humas',
            'bidang_id' => $bidang->id,
        ]);
    }

    /* =========================================================
       HELPERS
       ========================================================= */

    /**
     * Tanggal hari kerja (Senin–Jumat) minimal $hari hari dari hari ini.
     * Form registrasi menolak akhir pekan, sehingga test yang HARUS
     * diterima tidak boleh jatuh pada Sabtu/Minggu (tanggal uji tidak
     * boleh bergantung pada hari test dijalankan).
     */
    private function hariKerja(int $hari = 1): string
    {
        $tanggal = now()->addDays($hari);

        while ($tanggal->isWeekend()) {
            $tanggal->addDay();
        }

        return $tanggal->format('Y-m-d');
    }

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
            // Jabatan wajib & harus terdaftar pada bidang tujuan;
            // orang yang ditemui wajib (teks bebas / pilihan daftar)
            'jabatan_ditemui' => 'Kepala Bagian Humas',
            'orang_ditemui'   => 'Siti Aminah',
            'jumlah_tamu'    => '2',
            // Penjadwalan: tanggal & jam dikirim terpisah dari form.
            // Selalu hari kerja — akhir pekan ditolak validasi server.
            'tanggal_kunjungan' => $this->hariKerja(),
            'jam_kunjungan'     => '09:00',
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
        // Tanggal (input date) + jam (dropdown) digabung menjadi datetime
        $this->assertSame(
            $this->hariKerja() . ' 09:00',
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
            // .txt di luar daftar format yang diizinkan
            'dokumen' => UploadedFile::fake()->create('dokumen.txt', 300, 'text/plain'),
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
            'tanggal_kunjungan' => now()->subDay()->format('Y-m-d'),
        ]))->assertSessionHasErrors(['tanggal_kunjungan']);
    }

    public function test_store_requires_jam_kunjungan(): void
    {
        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'jam_kunjungan' => '',
        ]))->assertSessionHasErrors(['jam_kunjungan']);
    }

    public function test_store_rejects_jam_outside_operational_slots(): void
    {
        // Jam 12:00 adalah jam istirahat & bukan slot operasional
        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'jam_kunjungan' => '12:00',
        ]))->assertSessionHasErrors(['jam_kunjungan']);
    }

    public function test_old_input_is_retained_on_validation_error(): void
    {
        // Validasi gagal → Laravel men-flash old input ke session;
        // di view dipakai via old('nama').
        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload(['nik' => 'salah']))
            ->assertSessionHasErrors(['nik'])
            ->assertSessionHas('_old_input.nama', 'Budi Santoso');
    }

    /* =========================================================
       HARI LIBUR — tanggal merah ditolak form registrasi publik
       ========================================================= */

    private function daftarkanHariLibur(string $tanggal, string $tipe = HariLibur::TIPE_LIBUR): void
    {
        HariLibur::create([
            'tanggal'    => $tanggal,
            'tipe'       => $tipe,
            'keterangan' => $tipe === HariLibur::TIPE_MASUK_KERJA
                ? 'Hari Kerja Khusus' : 'Libur Uji Coba',
        ]);
    }

    public function test_store_rejects_tanggal_libur(): void
    {
        $tanggal = $this->hariKerja(5);
        $this->daftarkanHariLibur($tanggal);

        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'tanggal_kunjungan' => $tanggal,
        ]))->assertSessionHasErrors(['tanggal_kunjungan']);

        $this->assertDatabaseMissing('tamus', ['nik' => '3201123456780001']);
    }

    public function test_store_accepts_tanggal_di_luar_daftar_libur(): void
    {
        $this->daftarkanHariLibur($this->hariKerja(5));

        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'tanggal_kunjungan' => $this->hariKerja(6),
        ]))->assertRedirect(route('layanan.registrasi-tamu'));
    }

    public function test_form_memblokir_tanggal_libur_lewat_js(): void
    {
        $tanggal = $this->hariKerja(5);
        $this->daftarkanHariLibur($tanggal);

        $this->get(route('layanan.registrasi-tamu'))
            ->assertOk()
            ->assertSee('holiday-warning', false)
            ->assertSee('TANGGAL_MERAH', false)
            ->assertSee('TANGGAL_MASUK', false) // daftar override weekend terkirim ke JS
            ->assertSee($tanggal, false); // daftar libur terkirim ke JS
    }

    /* =========================================================
       AKHIR PEKAN — Sabtu & Minggu di-HARDCODE libur, KECUALI admin
       mendaftarkannya sebagai tipe masuk_kerja (override weekend)
       ========================================================= */

    public function test_store_rejects_tanggal_akhir_pekan(): void
    {
        $kasus = [
            'Sabtu'  => now()->next(\Carbon\Carbon::SATURDAY)->format('Y-m-d'),
            'Minggu' => now()->next(\Carbon\Carbon::SUNDAY)->format('Y-m-d'),
        ];

        foreach ($kasus as $hari => $tanggal) {
            $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
                'tanggal_kunjungan' => $tanggal,
            ]))->assertSessionHasErrors(['tanggal_kunjungan']);

            $pesan = session('errors')->first('tanggal_kunjungan');
            $this->assertStringContainsString('akhir pekan', $pesan,
                "Tanggal {$hari} ({$tanggal}) harus ditolak sebagai akhir pekan.");
        }

        // Tidak ada satu pun data tersimpan dari percobaan di atas.
        $this->assertDatabaseMissing('tamus', ['nik' => '3201123456780001']);
    }

    public function test_form_memblokir_akhir_pekan_lewat_js(): void
    {
        // Blokir UI (customValidity) mengikuti aturan yang sama dengan
        // validasi server: 1 fungsi pemeriksaan untuk libur + akhir pekan.
        $this->get(route('layanan.registrasi-tamu'))
            ->assertOk()
            ->assertSee('alasanTanggalLibur', false)
            ->assertSee('getDay()', false)
            ->assertSee('akhir pekan', false);
    }

    /* ---------------------------------------------------------
       OVERRIDE WEEKEND — Sabtu/Minggu bertipe masuk_kerja DIIZINKAN
       --------------------------------------------------------- */

    public function test_store_menerima_akhir_pekan_yang_di_override(): void
    {
        // Dua hari kerja ke depan dijamin akhir pekan (Sabtu atau Minggu).
        $akhirPekan = now()->addDays(2);
        while (! $akhirPekan->isWeekend()) {
            $akhirPekan->addDay();
        }
        $tanggal = $akhirPekan->format('Y-m-d');

        // Tanpa override → tetap ditolak (bukti hardcode masih berlaku).
        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'tanggal_kunjungan' => $tanggal,
        ]))->assertSessionHasErrors(['tanggal_kunjungan']);

        // Admin membuka tanggal itu sebagai hari kerja khusus.
        $this->daftarkanHariLibur($tanggal, HariLibur::TIPE_MASUK_KERJA);

        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'tanggal_kunjungan' => $tanggal,
        ]))->assertRedirect(route('layanan.registrasi-tamu'));

        $this->assertDatabaseHas('tamus', [
            'nik'               => '3201123456780001',
            'tanggal_kunjungan' => $tanggal . ' 09:00',
        ]);
    }

    public function test_store_tetap_menolak_weekend_dengan_tipe_libur(): void
    {
        $akhirPekan = now()->addDays(2);
        while (! $akhirPekan->isWeekend()) {
            $akhirPekan->addDay();
        }
        $tanggal = $akhirPekan->format('Y-m-d');
        $this->daftarkanHariLibur($tanggal, HariLibur::TIPE_LIBUR);

        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'tanggal_kunjungan' => $tanggal,
        ]))->assertSessionHasErrors(['tanggal_kunjungan']);

        $this->assertDatabaseMissing('tamus', ['nik' => '3201123456780001']);
    }

    /* =========================================================
       TANPA PEMBLOKIRAN JAM — kunjungan lain yang sudah disetujui
       pada divisi & jam sama TIDAK lagi memblokir pendaftaran baru
       ========================================================= */

    public function test_store_menerima_jam_sama_dengan_kunjungan_disetujui_lain(): void
    {
        $tanggal = $this->hariKerja(3);

        Tamu::create([
            'nik'               => '3201999000000099',
            'nama'              => 'Tamu Terdahulu',
            'no_hp'             => '081200000001',
            'dokumen_zip'       => 'dokumen/lama.zip',
            'tujuan_ditemui'    => 'Divisi Humas',
            'jumlah_tamu'       => 1,
            'tanggal_kunjungan' => $tanggal . ' 09:00',
            'keperluan'         => 'Kunjungan.',
            'status_verifikasi' => Tamu::STATUS_DISETUJUI,
        ]);

        // Divisi & jam sama, jadwal sama — tetap diterima.
        $this->post(route('layanan.registrasi-tamu.store'), $this->validPayload([
            'tanggal_kunjungan' => $tanggal,
            'jam_kunjungan'     => '09:00',
        ]))->assertRedirect(route('layanan.registrasi-tamu'));

        $this->assertSame(2, Tamu::count());
    }

    /* ---------------------------------------------------------
       FORM — dropdown jam kunjungan dirender dinamis via JS
       --------------------------------------------------------- */

    public function test_form_renders_dynamic_jam_kunjungan_dropdown(): void
    {
        // Opsi jam dibangun via JS (1:1 dengan Tamu::SLOT_JAM);
        // jam istirahat 11:30–13:00 dinonaktifkan, tanpa fetch API.
        $this->get(route('layanan.registrasi-tamu'))
            ->assertOk()
            ->assertSee('id="jam_kunjungan"', false)
            ->assertSee('id="tanggal_kunjungan"', false)
            ->assertSee('08:00', false); // daftar slot operasional dari model
    }

    /* ---------------------------------------------------------
       FORM — kalender KUSTOM (pengganti datepicker native) dengan
       warna per-hari: merah = libur/weekend, hitam = override
       --------------------------------------------------------- */

    public function test_form_memakai_kalender_kustom_dengan_warna_per_hari(): void
    {
        // Datepicker native TIDAK bisa diwarnai per-hari, sehingga diganti
        // widget kalender kustom yang bisa menandai tanggal libur/akhir
        // pekan MERAH (disabled) & weekend yang di-override HITAM.
        $this->get(route('layanan.registrasi-tamu'))
            ->assertOk()
            ->assertDontSee('type="date"', false)   // datepicker native sudah diganti
            ->assertSee('id="tanggal-calendar"', false)
            ->assertSee('statusHari', false)         // logika status per-hari
            ->assertSee('is-red', false)             // kelas merah (libur/weekend)
            ->assertSee('is-masuk', false);          // kelas hitam (override weekend)
    }
}
