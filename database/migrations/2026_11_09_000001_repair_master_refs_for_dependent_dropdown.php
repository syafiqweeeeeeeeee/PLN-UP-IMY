<?php

use App\Models\Bidang;
use App\Models\Jabatan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * PERBAIKAN DATA — prasyarat dependent dropdown registrasi tamu.
 *
 * Alur Bidang → Jabatan → Orang memakai KUNCI PRIMER:
 *   jabatans.bidang_id → bidangs.id
 *   karyawans.jabatan_id → jabatans.id
 *
 * Di database pengembangan ditemukan dua kondisi yang membuat alur itu
 * kosong walau data teksnya lengkap:
 *
 * 1. Jabatan YATIM — `jabatans.bidang_id` menunjuk baris `bidangs` yang
 *    sudah tidak ada (sisa penghapusan sub-bidang). Bidangnya diambil
 *    dari data yang tidak terbantahkan: seluruh karyawan yang teks
 *    `jabatans`-nya sama persis semuanya berada di SATU bidang_id yang
 *    masih ada. Bila karyawan tersebar di beberapa bidang (ambigu) atau
 *    tidak ada karyawan, baris TIDAK diubah.
 *
 * 2. `karyawans.jabatan_id` masih NULL padahal kolom teks `jabatan`
 *    sudah sama persis dengan satu nama di master jabatans (nama
 *    jabatan unik di tabel ini). Hanya baris NULL yang diisi — data
 *    yang sudah punya jabatan_id tidak pernah ditimpa, dan bidang_id
 *    tidak pernah diubah (bila bidang karyawan berbeda dari bidang
 *    jabatan, pasangan itu dilewati karena dianggap tidak yakin).
 *
 * Kedua langkah bersifat idempoten dan tidak menghapus/menggandakan
 * baris apa pun. Pada database kosong (test/fresh install) migration
 * ini tidak melakukan apa-apa.
 */
return new class extends Migration
{
    public function up(): void
    {
        $bidangIds = DB::table('bidangs')->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->all();

        // Database baru/kosong → tidak ada yang perlu diperbaiki.
        if ($bidangIds === []) {
            return;
        }

        $bidangAda = array_flip($bidangIds);

        /* ---------------------------------------------------------
           1. Remap jabatan yang bidang_id-nya sudah tidak ada.
           --------------------------------------------------------- */
        $jabatans = DB::table('jabatans')->get(['id', 'nama', 'bidang_id']);

        foreach ($jabatans as $jabatan) {
            if (isset($bidangAda[(int) $jabatan->bidang_id])) {
                continue;
            }

            $kandidat = DB::table('karyawans')
                ->where('jabatan', $jabatan->nama)
                ->whereNotNull('bidang_id')
                ->distinct()
                ->pluck('bidang_id')
                ->map(fn ($id) => (int) $id)
                ->filter(fn (int $id) => isset($bidangAda[$id]))
                ->unique()
                ->values();

            // Hanya bila seluruh karyawan menunjuk SATU bidang yang sah.
            if ($kandidat->count() === 1) {
                DB::table('jabatans')
                    ->where('id', $jabatan->id)
                    ->update(['bidang_id' => $kandidat->first()]);
            }
        }

        /* ---------------------------------------------------------
           1b. Jabatan tanpa karyawan (mis. posisi kosong) — warisi
           bidang dari jabatan INDUK lewat rantai parent_id. Diulang
           beberapa putaran agar induk yang baru dipulihkan lebih dulu
           bisa menjadi rujukan anaknya.
           --------------------------------------------------------- */
        for ($putaran = 0; $putaran < 10; $putaran++) {
            $jabatans = DB::table('jabatans')->get(['id', 'bidang_id', 'parent_id']);
            $bidangPerId = $jabatans->pluck('bidang_id', 'id');
            $parentPerId = $jabatans->pluck('parent_id', 'id');
            $diubah = 0;

            foreach ($jabatans as $jabatan) {
                if (isset($bidangAda[(int) $jabatan->bidang_id])) {
                    continue;
                }

                $induk = $jabatan->parent_id;
                $dicek = 0;

                while ($induk !== null && $dicek < 20) {
                    $bidangInduk = (int) ($bidangPerId[$induk] ?? 0);

                    if (isset($bidangAda[$bidangInduk])) {
                        DB::table('jabatans')
                            ->where('id', $jabatan->id)
                            ->update(['bidang_id' => $bidangInduk]);
                        $bidangPerId[$jabatan->id] = $bidangInduk;
                        $diubah++;
                        break;
                    }

                    $induk = $parentPerId[$induk] ?? null;
                    $dicek++;
                }
            }

            if ($diubah === 0) {
                break;
            }
        }

        /* ---------------------------------------------------------
           2. Lengkapi karyawans.jabatan_id dari nama jabatan master.
           --------------------------------------------------------- */
        $namaJabatan = DB::table('jabatans')->get(['id', 'nama', 'bidang_id'])
            ->mapWithKeys(fn ($jabatan) => [
                mb_strtoupper(trim((string) $jabatan->nama)) => $jabatan,
            ]);

        if ($namaJabatan->isEmpty()) {
            return;
        }

        DB::table('karyawans')
            ->whereNull('jabatan_id')
            ->orderBy('id')
            ->chunkById(200, function ($rows) use ($namaJabatan) {
                foreach ($rows as $karyawan) {
                    $teks = mb_strtoupper(trim((string) $karyawan->jabatan));
                    $jabatan = $namaJabatan[$teks] ?? $this->jabatanDariTeks($namaJabatan, $teks);

                    if ($jabatan === null) {
                        continue;
                    }

                    // Bidang karyawan harus sama dengan bidang jabatan
                    // (atau belum terisi) — kalau berbeda, jangan menebak.
                    if ($karyawan->bidang_id !== null
                        && (int) $karyawan->bidang_id !== (int) $jabatan->bidang_id) {
                        continue;
                    }

                    DB::table('karyawans')->where('id', $karyawan->id)->update([
                        'jabatan_id' => $jabatan->id,
                        'bidang_id'  => $karyawan->bidang_id ?? $jabatan->bidang_id,
                    ]);
                }
            });

        // Daftar master di-cache 10 menit & update di atas tidak lewat
        // Eloquent (tidak memicu event saved) → buang cache manual.
        Bidang::flushMasterCache();
        Jabatan::flushMasterCache();
    }

    /**
     * Cocokkan teks jabatan karyawan yang lebih panjang dari nama master
     * (mis. "JUNIOR TECHNICIAN ... MESIN 1 (BOILER, TURBIN & ALA" vs
     * "JUNIOR TECHNICIAN ... MESIN 1"), termasuk awalan pejabat
     * sementara (PJS/PLT/PLH). HANYA dipakai bila kandidatnya tunggal —
     * nama yang ambigu dibiarkan NULL.
     *
     * @param  \Illuminate\Support\Collection<string, object>  $namaJabatan
     */
    private function jabatanDariTeks($namaJabatan, string $teks): ?object
    {
        foreach (['PJS ', 'PLT ', 'PLH '] as $awalan) {
            if (str_starts_with($teks, $awalan)) {
                $teks = trim(substr($teks, strlen($awalan)));
                break;
            }
        }

        $kandidat = [];

        foreach ($namaJabatan as $nama => $jabatan) {
            if ($nama === '' || ! str_starts_with($teks, $nama)) {
                continue;
            }

            $sisa = substr($teks, strlen($nama));

            if ($sisa === '' || in_array($sisa[0], [' ', '('], true)) {
                $kandidat[(int) $jabatan->id] = $jabatan;
            }
        }

        return count($kandidat) === 1 ? reset($kandidat) : null;
    }

    /** Tidak ada pembalikan otomatis: data lama tidak disimpan. */
    public function down(): void
    {
        //
    }
};
