<?php

namespace App\Services;

use App\Models\Bidang;
use App\Models\Jabatan;

/**
 * Pencocokan NAMA teks (kolom lama `karyawans.bidang` / `karyawans.jabatan`)
 * ke master `bidangs` / `jabatans` — dipakai BERSAMA oleh impor Data
 * Karyawan dan perintah backfill, supaya aturan pemetaan hanya ada di
 * satu tempat.
 *
 * Aturan (sengaja konservatif — lebih baik NULL daripada salah):
 * - Nama dinormalisasi: spasi berlebih dirapikan, huruf besar/kecil
 *   diabaikan. Tidak ada pembuatan master baru.
 * - Bidang hanya dipetakan bila hasilnya TEPAT SATU kandidat. Nama yang
 *   tidak ada → null (unmapped); lebih dari satu → null (ambiguous).
 * - Jabatan hanya dipetakan bila bidangnya sudah terpetakan DAN nama
 *   jabatan menghasilkan tepat satu kandidat DI BAWAH bidang tersebut.
 *   Nama yang ada di master tetapi bukan di bidang itu → ambiguous
 *   (perlu diperiksa manusia, jangan dipaksakan).
 */
class MasterOrgMatcher
{
    public const MATCHED = 'matched';

    public const UNMAPPED = 'unmapped';

    public const AMBIGUOUS = 'ambiguous';

    public const EMPTY_INPUT = 'empty';

    /** @var array<string, array<int, int>> nama ternormalisasi => id bidang */
    private array $bidangIndex = [];

    /** @var array<string, array<int, mixed>> nama ternormalisasi => kandidat jabatan */
    private array $jabatanIndex = [];

    public function __construct()
    {
        foreach (Bidang::query()->get(['id', 'nama']) as $bidang) {
            $this->bidangIndex[self::normalize($bidang->nama)][] = (int) $bidang->id;
        }

        foreach (Jabatan::query()->get(['id', 'nama', 'bidang_id']) as $jabatan) {
            $this->jabatanIndex[self::normalize($jabatan->nama)][] = [
                'id' => (int) $jabatan->id,
                'bidang_id' => (int) $jabatan->bidang_id,
            ];
        }
    }

    /**
     * Normalisasi nama untuk perbandingan: rapikan spasi (awal/akhir &
     * ganda) lalu huruf besar. Dipakai juga oleh form/impor saat
     * membandingkan teks lama dengan nama master.
     */
    public static function normalize(?string $value): string
    {
        $value = preg_replace('/\s+/u', ' ', (string) $value) ?? (string) $value;

        return mb_strtoupper(trim($value));
    }

    /**
     * Cocokkan sepasang nama teks lama ke master.
     *
     * @return array<string, mixed>
     */
    public function match(?string $bidangNama, ?string $jabatanNama): array
    {
        $notes = [];

        $bidang = $this->resolveBidang($bidangNama, $notes);
        $jabatan = $this->resolveJabatan($jabatanNama, $bidang['id'], $bidang['status'], $notes);

        return [
            'bidang_id' => $bidang['id'],
            'bidang_status' => $bidang['status'],
            'jabatan_id' => $jabatan['id'],
            'jabatan_status' => $jabatan['status'],
            'notes' => $notes,
        ];
    }

    /**
     * @param  array<int, string>  $notes
     * @return array{id: int|null, status: string}
     */
    private function resolveBidang(?string $nama, array &$notes): array
    {
        if (trim((string) $nama) === '') {
            return ['id' => null, 'status' => self::EMPTY_INPUT];
        }

        $candidates = $this->bidangIndex[self::normalize($nama)] ?? [];

        if (count($candidates) === 1) {
            return ['id' => $candidates[0], 'status' => self::MATCHED];
        }

        if ($candidates === []) {
            $notes[] = 'Bidang "'.trim((string) $nama).'" tidak ada di master — teks lama dipertahankan.';

            return ['id' => null, 'status' => self::UNMAPPED];
        }

        $notes[] = 'Bidang "'.trim((string) $nama).'" cocok ke lebih dari satu master ('
            .count($candidates).') — perlu diperiksa manual.';

        return ['id' => null, 'status' => self::AMBIGUOUS];
    }

    /**
     * @param  array<int, string>  $notes
     * @return array{id: int|null, status: string}
     */
    private function resolveJabatan(?string $nama, ?int $bidangId, string $bidangStatus, array &$notes): array
    {
        $nama = trim((string) $nama);

        if ($nama === '') {
            return ['id' => null, 'status' => self::EMPTY_INPUT];
        }

        $candidates = $this->jabatanIndex[self::normalize($nama)] ?? [];

        if ($candidates === []) {
            $notes[] = 'Jabatan "'.$nama.'" tidak ada di master — teks lama dipertahankan.';

            return ['id' => null, 'status' => self::UNMAPPED];
        }

        if ($bidangId === null) {
            // Jabatan master wajib punya bidang induk; tanpa bidang yang
            // terpetakan hubungannya tidak bisa dipastikan.
            $notes[] = 'Jabatan "'.$nama.'" belum dapat dipetakan karena bidangnya belum terpetakan.';

            return [
                'id' => null,
                'status' => $bidangStatus === self::AMBIGUOUS ? self::AMBIGUOUS : self::UNMAPPED,
            ];
        }

        $inBidang = array_values(array_filter(
            $candidates,
            fn (array $candidate) => $candidate['bidang_id'] === $bidangId,
        ));

        if (count($inBidang) === 1) {
            return ['id' => $inBidang[0]['id'], 'status' => self::MATCHED];
        }

        if (count($inBidang) > 1) {
            $notes[] = 'Jabatan "'.$nama.'" cocok ke lebih dari satu master di bidang yang sama ('
                .count($inBidang).') — perlu diperiksa manual.';

            return ['id' => null, 'status' => self::AMBIGUOUS];
        }

        // Nama ada di master, tetapi bukan di bidang hasil pemetaan.
        $notes[] = 'Jabatan "'.$nama.'" terdaftar di master pada bidang lain — pasangan bidang/jabatan perlu diperiksa.';

        return ['id' => null, 'status' => self::AMBIGUOUS];
    }
}
