<?php

namespace Database\Seeders;

use App\Models\Bidang;
use App\Models\Jabatan;
use Illuminate\Database\Seeder;

/**
 * MASTER BIDANG & JABATAN — kerangka organisasi UP Indramayu.
 *
 * Sumber data: isi tabel `bidangs` (38 baris) dan `jabatans` (5 baris)
 * yang sudah ada di database pengembangan per 20 Okt 2026 — bukan nama
 * rekaan. Bila struktur organisasi berubah, ubah konstanta di bawah
 * dan jalankan ulang seeder.
 *
 * Aman dijalankan berulang:
 * - Bidang dicocokkan per `nama` (persis, termasuk spasi), jabatan per
 *   pasangan `nama` + `bidang_id` — nama jabatan yang sama boleh ada di
 *   bidang berbeda.
 * - `parent_id` hanya DIISI bila masih kosong; hierarki yang sudah
 *   diubah manual tidak ditimpa.
 * - Tidak ada data master yang dihapus.
 */
class MasterBidangJabatanSeeder extends Seeder
{
    /**
     * [nama bidang, nama parent|null]
     *
     * @var array<int, array{0: string, 1: string|null}>
     */
    private const BIDANGS = [
        ['PLTU INDRAMAYU', null],
        ['BIDANG ENJINIRING', 'PLTU INDRAMAYU'],
        ['SUB BIDANG  SYSTEM OWNER TURBINE & AUX', 'BIDANG ENJINIRING'],
        ['SUB BIDANG SYSTEM OWNER BOILER & AUX', 'BIDANG ENJINIRING'],
        ['SUB BIDANG SYSTEM OWNER COMMON AUX', 'BIDANG ENJINIRING'],
        ['SUB BIDANG COMPONENT ANALYST', 'BIDANG ENJINIRING'],
        ['SUB BIDANG CONDITION BASED MAINTENANCE', 'BIDANG ENJINIRING'],
        ['SUB BIDANG MANAJEMEN MUTU & KINERJA', 'BIDANG ENJINIRING'],
        ['SUB BIDANG MANAJEMEN RISIKO & KEPATUHAN', 'BIDANG ENJINIRING'],
        ['BIDANG OPERASI', 'PLTU INDRAMAYU'],
        ['SUB BIDANG RENDAL OPERASI', 'BIDANG OPERASI'],
        ['SUB BIDANG PRODUKSI A', 'BIDANG OPERASI'],
        ['SUB BIDANG PRODUKSI B', 'BIDANG OPERASI'],
        ['SUB BIDANG PRODUKSI C', 'BIDANG OPERASI'],
        ['SUB BIDANG PRODUKSI D', 'BIDANG OPERASI'],
        ['SUB BIDANG KIMIA & LABORATORIUM', 'BIDANG OPERASI'],
        ['SUB BIDANG BAHAN BAKAR', 'BIDANG OPERASI'],
        ['SUB BIDANG COAL & ASH HANDLING A', 'BIDANG OPERASI'],
        ['SUB BIDANG COAL & ASH HANDLING B', 'BIDANG OPERASI'],
        ['SUB BIDANG COAL & ASH HANDLING C', 'BIDANG OPERASI'],
        ['SUB BIDANG COAL & ASH HANDLING D', 'BIDANG OPERASI'],
        ['BIDANG PEMELIHARAAN', 'PLTU INDRAMAYU'],
        ['SUB BIDANG RENDAL PEMELIHARAAN', 'BIDANG PEMELIHARAAN'],
        ['SUB BIDANG OUTAGE MANAGEMENT', 'BIDANG PEMELIHARAAN'],
        ['SUB BIDANG LISTRIK', 'BIDANG PEMELIHARAAN'],
        ['SUB BIDANG KONTROL & INSTRUMEN', 'BIDANG PEMELIHARAAN'],
        ['SUB BIDANG MESIN 1 BOILER, TURBIN & AAB', 'BIDANG PEMELIHARAAN'],
        ['SUB BIDANG MESIN 2 SISTEM BAHAN BAKAR & ABU', 'BIDANG PEMELIHARAAN'],
        ['SUB BIDANG SARANA', 'BIDANG PEMELIHARAAN'],
        ['SUB BIDANG LINGKUNGAN', 'BIDANG PEMELIHARAAN'],
        ['SUB BIDANG K3', 'BIDANG PEMELIHARAAN'],
        ['SUB BIDANG SUMBER DAYA MANUSIA', 'BIDANG PEMELIHARAAN'],
        ['SUB BIDANG KEUANGAN', 'BIDANG PEMELIHARAAN'],
        ['SUB BIDANG UMUM & CSR', 'BIDANG PEMELIHARAAN'],
        ['BIDANG LOGISTIK', 'PLTU INDRAMAYU'],
        ['SUB BIDANG INVENTORI KONTROL & KATALOGER', 'BIDANG LOGISTIK'],
        ['SUB BIDANG PENGADAAN', 'BIDANG LOGISTIK'],
        ['SUB BIDANG ADMINISTRASI GUDANG', 'BIDANG LOGISTIK'],
    ];

    /**
     * [nama jabatan, nama bidang, nama parent|null]
     *
     * @var array<int, array{0: string, 1: string, 2: string|null}>
     */
    private const JABATANS = [
        ['SENIOR MANAGER UP INDRAMAYU', 'PLTU INDRAMAYU', null],
        ['MANAGER ENJINIRING & QA', 'BIDANG ENJINIRING', 'SENIOR MANAGER UP INDRAMAYU'],
        ['ASISTEN ANALIS SO TURBIN & AUXILIARY', 'SUB BIDANG  SYSTEM OWNER TURBINE & AUX', 'MANAGER ENJINIRING & QA'],
        ['ASISTEN ANALIS SO BOILER & AUXILIARY', 'SUB BIDANG SYSTEM OWNER BOILER & AUX', 'ASMAN  SYSTEM OWNER COMMON AUX'],
        ['ASMAN  SYSTEM OWNER COMMON AUX', 'SUB BIDANG SYSTEM OWNER COMMON AUX', 'MANAGER ENJINIRING & QA'],
    ];

    /**
     * Pemetaan nama Master Bidang → kode legacy yang dipakai filter data
     * (`users.department` + `users.sub_department`). Sama dengan peta di
     * migration 2026_10_22_000001; hanya DIISI bila masih kosong agar
     * kode yang sudah dikurasi admin tidak tertimpa.
     *
     * @var array<string, array{0: string|null, 1: string|null}>
     */
    private const CODES = [
        'BIDANG ENJINIRING' => ['engineering', null],
        'SUB BIDANG  SYSTEM OWNER TURBINE & AUX' => ['engineering', 'asmen_so'],
        'SUB BIDANG SYSTEM OWNER BOILER & AUX' => ['engineering', 'asmen_so'],
        'SUB BIDANG SYSTEM OWNER COMMON AUX' => ['engineering', 'asmen_so'],
        'SUB BIDANG COMPONENT ANALYST' => ['engineering', 'asmen_cbm'],
        'SUB BIDANG CONDITION BASED MAINTENANCE' => ['engineering', 'asmen_cbm'],
        'SUB BIDANG MANAJEMEN MUTU & KINERJA' => ['engineering', 'asmen_mmrk'],
        'SUB BIDANG MANAJEMEN RISIKO & KEPATUHAN' => ['engineering', 'asmen_mmrk'],
        'BIDANG OPERASI' => ['operasi', null],
        'SUB BIDANG RENDAL OPERASI' => ['operasi', 'asmen_renops'],
        'SUB BIDANG PRODUKSI A' => ['operasi', 'asmen_prod_a'],
        'SUB BIDANG PRODUKSI B' => ['operasi', 'asmen_prod_b'],
        'SUB BIDANG PRODUKSI C' => ['operasi', 'asmen_prod_c'],
        'SUB BIDANG PRODUKSI D' => ['operasi', 'asmen_prod_d'],
        'SUB BIDANG KIMIA & LABORATORIUM' => ['operasi', 'asmen_kimia_lab'],
        'SUB BIDANG BAHAN BAKAR' => ['operasi', 'asmen_niaga_bb'],
        'SUB BIDANG COAL & ASH HANDLING A' => ['operasi', 'spv_chcb_a'],
        'SUB BIDANG COAL & ASH HANDLING B' => ['operasi', 'spv_chcb_b'],
        'SUB BIDANG COAL & ASH HANDLING C' => ['operasi', 'spv_chcb_c'],
        'SUB BIDANG COAL & ASH HANDLING D' => ['operasi', 'spv_chcb_d'],
        'BIDANG PEMELIHARAAN' => ['pemeliharaan', null],
        'SUB BIDANG RENDAL PEMELIHARAAN' => ['pemeliharaan', 'asmen_rendal_har'],
        'SUB BIDANG OUTAGE MANAGEMENT' => ['pemeliharaan', 'asmen_mo'],
        'SUB BIDANG LISTRIK' => ['pemeliharaan', 'asmen_listrik'],
        'SUB BIDANG KONTROL & INSTRUMEN' => ['pemeliharaan', 'asmen_konin'],
        'SUB BIDANG MESIN 1 BOILER, TURBIN & AAB' => ['pemeliharaan', 'asmen_mesin_1'],
        'SUB BIDANG MESIN 2 SISTEM BAHAN BAKAR & ABU' => ['pemeliharaan', 'asmen_mesin_2'],
        'SUB BIDANG SARANA' => ['pemeliharaan', null],
        'SUB BIDANG LINGKUNGAN' => ['lingkungan', 'lingkungan'],
        'SUB BIDANG K3' => ['k3_kam', 'k3_kam'],
        'SUB BIDANG SUMBER DAYA MANUSIA' => ['business_support', 'asmen_sdm_umum_csr'],
        'SUB BIDANG KEUANGAN' => ['business_support', 'asmen_keuangan'],
        'SUB BIDANG UMUM & CSR' => ['business_support', 'asmen_sdm_umum_csr'],
        'BIDANG LOGISTIK' => ['business_support', null],
        'SUB BIDANG INVENTORI KONTROL & KATALOGER' => ['pemeliharaan', 'asmen_inventori'],
        'SUB BIDANG PENGADAAN' => ['business_support', 'asmen_pengadaan'],
        'SUB BIDANG ADMINISTRASI GUDANG' => ['pemeliharaan', 'asmen_inventori'],
    ];

    public function run(): void
    {
        // Token dipakai agar parent bisa didahulukan tanpa mengandalkan id.
        $bidangIds = [];

        foreach (self::BIDANGS as [$nama]) {
            [$departmentCode, $subDepartmentCode] = self::CODES[$nama] ?? [null, null];

            $bidang = Bidang::query()->where('nama', $nama)->first()
                ?? Bidang::query()->create([
                    'nama' => $nama,
                    'parent_id' => null,
                    'department_code' => $departmentCode,
                    'sub_department_code' => $subDepartmentCode,
                ]);

            // Lengkapi kode legacy yang masih kosong (instalasi lama).
            if ($bidang->department_code === null && $departmentCode !== null) {
                $bidang->update([
                    'department_code' => $departmentCode,
                    'sub_department_code' => $bidang->sub_department_code ?? $subDepartmentCode,
                ]);
            }

            $bidangIds[$nama] = (int) $bidang->id;
        }

        foreach (self::BIDANGS as [$nama, $parentNama]) {
            $parentId = $parentNama === null ? null : ($bidangIds[$parentNama] ?? null);
            $bidang = Bidang::query()->find($bidangIds[$nama]);

            // Hanya isi parent bila belum ada — hierarki manual tidak ditimpa.
            if ($bidang !== null && $bidang->parent_id === null && $parentId !== null) {
                $bidang->update(['parent_id' => $parentId]);
            }
        }

        $jabatanIds = [];

        foreach (self::JABATANS as [$nama, $bidangNama]) {
            $bidangId = $bidangIds[$bidangNama] ?? null;

            if ($bidangId === null) {
                continue;
            }

            $jabatan = Jabatan::query()
                ->where('nama', $nama)
                ->where('bidang_id', $bidangId)
                ->first()
                ?? Jabatan::query()->create([
                    'nama' => $nama,
                    'bidang_id' => $bidangId,
                    'parent_id' => null,
                ]);

            $jabatanIds[$nama] = (int) $jabatan->id;
        }

        foreach (self::JABATANS as [$nama, $bidangNama, $parentNama]) {
            $parentId = $parentNama === null ? null : ($jabatanIds[$parentNama] ?? null);
            $jabatan = Jabatan::query()->find($jabatanIds[$nama] ?? 0);

            if ($jabatan !== null && $jabatan->parent_id === null && $parentId !== null) {
                $jabatan->update(['parent_id' => $parentId]);
            }
        }
    }
}
