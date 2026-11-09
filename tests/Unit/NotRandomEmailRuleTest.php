<?php

namespace Tests\Unit;

use App\Rules\NotRandomEmail;
use Tests\TestCase;

/**
 * WHITE-BOX — App\Rules\NotRandomEmail
 *
 * Peta cabang rule (urutan pemeriksaan di validate()):
 *   0. tanpa '@' / local-part kosong     → lolos (biarkan rule 'email')
 *   0b. local-part <= 3 huruf             → lolos (akronim: hrd, adm, cs)
 *   1. tanpa vokal sama sekali            → GAGAL
 *   2. rantai konsonan beruntun >= 5      → GAGAL
 *   3. rasio konsonan:vokal > 5:1         → GAGAL
 *   selain itu                            → lolos
 */
class NotRandomEmailRuleTest extends TestCase
{
    private const FAIL_MESSAGE = 'Alamat email tampak tidak valid — gunakan email asli Anda (contoh: nama@domain.com).';

    /**
     * Jalankan rule sekali. True = lolos (tidak ada $fail terpanggil).
     */
    private function lolos(string $email): bool
    {
        $pesanGagal = null;

        (new NotRandomEmail())->validate('email', $email, function (string $pesan) use (&$pesanGagal) {
            $pesanGagal = $pesan;

            return $pesan;
        });

        return $pesanGagal === null;
    }

    private function gagal(string $email): void
    {
        $pesanGagal = null;

        (new NotRandomEmail())->validate('email', $email, function (string $pesan) use (&$pesanGagal) {
            $pesanGagal = $pesan;

            return $pesan;
        });

        $this->assertSame(self::FAIL_MESSAGE, $pesanGagal, "Email seharusnya DITOLAK: {$email}");
    }

    /* =========================================================
       CABANG 0 — format dasar dibiarkan ke rule 'email'
       ========================================================= */

    public function test_tanpa_tanda_at_ditolak_oleh_rule_lain_bukan_rule_ini(): void
    {
        $this->assertTrue($this->lolos('budi-santoso'));
        $this->assertTrue($this->lolos('@pln.co.id')); // local-part kosong ($at === 0)
    }

    /* =========================================================
       CABANG 0b — akronim pendek dikecualikan
       ========================================================= */

    public function test_local_part_pendek_terkecualikan_dari_heuristik(): void
    {
        $this->assertTrue($this->lolos('hrd@pln.co.id'));
        $this->assertTrue($this->lolos('adm@pln.co.id'));
        $this->assertTrue($this->lolos('cs@pln.co.id'));

        // Angka murni → tidak ada huruf sama sekali (strlen 0 <= 3)
        $this->assertTrue($this->lolos('123456@pln.co.id'));
    }

    /* =========================================================
       CABANG 1 — wajib ada vokal
       ========================================================= */

    public function test_local_part_tanpa_vokal_ditolak(): void
    {
        $this->gagal('xqzw@domain.com');
        $this->gagal('kjhgfd@pln.co.id');
    }

    /* =========================================================
       CABANG 2 — rantai konsonan >= 5
       ========================================================= */

    public function test_rantai_konsonan_panjang_ditolak(): void
    {
        $this->gagal('asdfgh@gmail.com');   // rantai s-d-f-g-h = 5
        $this->gagal('zxcvbnm@pln.co.id');  // rantai 7 konsonan
    }

    public function test_rantai_konsonan_pendek_karena_vokal_memotong_tetap_lolos(): void
    {
        // "christopher": rantai terpanjang hanya 3 (chr / stph), vokal memecah
        $this->assertTrue($this->lolos('christopher@gmail.com'));
    }

    /* =========================================================
       CABANG 3 — rasio konsonan:vokal > 5:1
       ========================================================= */

    public function test_rasio_konsonan_ke_vokal_lebih_besar_dari_5_ditolak(): void
    {
        // huruf = "bcdafgh": vokal 1, konsonan 6 → rasio 6 (> 5),
        // rantai terpanjang hanya 3 → jatuh ke cabang rasio, bukan cabang rantai.
        $this->gagal('bcdafgh@pln.co.id');
    }

    /* =========================================================
       CABANG lolos — nama & kata wajar
       ========================================================= */

    public function test_email_manusiawi_wajar_tetap_lolos(): void
    {
        $this->assertTrue($this->lolos('budi.santoso@gmail.com'));
        $this->assertTrue($this->lolos('muhammad.rizki123@pln.co.id'));
        $this->assertTrue($this->lolos('john@doe.com'));
        $this->assertTrue($this->lolos('info@pln.co.id'));
    }

    public function test_angka_diabaikan_dari_perhitungan_rasio(): void
    {
        // huruf = "bcdafc": vokal 1, konsonan 5 → rasio 5 TIDAK lebih besar dari 5.
        // Tanpa pembuangan angka, string ini dihitung jauh lebih "berat konsonan".
        $this->assertTrue($this->lolos('b1c2d3a4f5c6@pln.co.id'));
    }
}