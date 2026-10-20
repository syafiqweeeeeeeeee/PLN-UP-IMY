<?php

namespace App\Console\Commands;

use App\Models\Karyawan;
use App\Services\MasterOrgMatcher;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * BACKFILL relasi master pada data karyawan lama.
 *
 * Mengisi `bidang_id`/`jabatan_id` yang masih NULL berdasarkan kolom
 * teks lama (`bidang`, `jabatan`) memakai MasterOrgMatcher — aturan
 * pencocokan yang sama dengan impor.
 *
 * Jaminan keamanan:
 * - DEFAULT hanya SIMULASI (dry-run). Tidak ada baris yang ditulis
 *   kecuali `--apply` diberikan.
 * - Kolom teks TIDAK PERNAH diubah/dikosongkan.
 * - Kolom id yang SUDAH terisi tidak ditimpa → aman dijalankan ulang.
 * - Nama yang tidak ada / ambigu dibiarkan NULL dan dilaporkan; tidak
 *   ada master baru yang dibuat.
 */
class BackfillKaryawanMaster extends Command
{
    protected $signature = 'karyawan:backfill-master
                            {--apply : Simpan hasil pemetaan ke database (tanpa opsi ini hanya simulasi)}';

    protected $description = 'Petakan nama bidang/jabatan lama ke master (dry-run default)';

    public function handle(): int
    {
        $matcher = new MasterOrgMatcher;

        $counts = [
            'rows' => 0,
            'bidang_matched' => 0,
            'bidang_unmapped' => 0,
            'bidang_ambiguous' => 0,
            'jabatan_matched' => 0,
            'jabatan_unmapped' => 0,
            'jabatan_ambiguous' => 0,
        ];

        $updates = [];
        $notes = [];

        Karyawan::query()
            ->orderBy('id')
            ->chunkById(200, function ($rows) use ($matcher, &$counts, &$updates, &$notes): void {
                foreach ($rows as $karyawan) {
                    $counts['rows']++;

                    $match = $matcher->match($karyawan->bidang, $karyawan->jabatan);

                    foreach (['bidang', 'jabatan'] as $field) {
                        $status = $match[$field.'_status'];

                        if (isset($counts[$field.'_'.$status])) {
                            $counts[$field.'_'.$status]++;
                        }
                    }

                    $data = [];

                    // Hanya isi yang masih NULL — jangan pernah menimpa
                    // relasi yang sudah ada.
                    if ($karyawan->bidang_id === null && $match['bidang_id'] !== null) {
                        $data['bidang_id'] = $match['bidang_id'];
                    }

                    if ($karyawan->jabatan_id === null && $match['jabatan_id'] !== null) {
                        $data['jabatan_id'] = $match['jabatan_id'];
                    }

                    if ($data !== []) {
                        $updates[$karyawan->id] = $data;
                    }

                    if ($match['notes'] !== [] && count($notes) < 20) {
                        $notes[] = [
                            $karyawan->nid,
                            $karyawan->nama,
                            implode(' ', $match['notes']),
                        ];
                    }
                }
            });

        $this->table(['Keterangan', 'Jumlah'], [
            ['Baris karyawan diperiksa', $counts['rows']],
            ['Bidang terpetakan', $counts['bidang_matched']],
            ['Bidang belum ada di master', $counts['bidang_unmapped']],
            ['Bidang ambigu (perlu diperiksa)', $counts['bidang_ambiguous']],
            ['Jabatan terpetakan', $counts['jabatan_matched']],
            ['Jabatan belum ada di master', $counts['jabatan_unmapped']],
            ['Jabatan ambigu (perlu diperiksa)', $counts['jabatan_ambiguous']],
            ['Baris yang akan diperbarui', count($updates)],
        ]);

        if ($notes !== []) {
            $this->newLine();
            $this->warn('Contoh nama yang belum terpetakan / perlu diperiksa (maks. 20):');
            $this->table(['NID', 'Nama', 'Catatan'], $notes);
        }

        if ($updates === []) {
            $this->info('Tidak ada relasi baru yang bisa dipetakan. Tidak ada perubahan data.');

            return self::SUCCESS;
        }

        if (! $this->option('apply')) {
            $this->newLine();
            $this->warn('SIMULASI — tidak ada data yang ditulis. Jalankan ulang dengan --apply untuk menyimpan.');

            return self::SUCCESS;
        }

        DB::transaction(function () use ($updates): void {
            foreach ($updates as $id => $data) {
                Karyawan::query()->whereKey($id)->update($data);
            }
        });

        $this->info(count($updates).' baris diperbarui. Kolom teks lama tidak diubah.');

        return self::SUCCESS;
    }
}
