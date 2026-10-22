<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Jembatan MASTER BIDANG → kolom scoping legacy.
 *
 * Form Pengguna kini hanya meminta Role + Master Bidang + Master Jabatan.
 * Filter data (ScopedToUserDepartment / ScopesToDepartment) tetap membaca
 * `users.department` + `users.department_id` + `users.sub_department`
 * sehingga nilai itu DITURUNKAN otomatis dari baris Master Bidang:
 *
 *   bidangs.department_code      → users.department (+ department_id)
 *   bidangs.sub_department_code  → users.sub_department
 *
 * Kolom ini sengaja terpisah dari `nama` karena nama master adalah teks
 * bebas ("BIDANG OPERASI") sedangkan kode legacy adalah slug tetap
 * ('operasi'). Pemetaan dilakukan sekali di sini dan diulang oleh
 * MasterBidangJabatanSeeder untuk instalasi baru; baris yang sudah punya
 * kode tidak pernah ditimpa (aman bila admin mengubahnya manual).
 *
 * Catatan pemetaan (dikurasi, karena struktur master tidak 1:1 dengan
 * 6 bidang legacy):
 * - BIDANG ENJINIRING          → engineering
 * - BIDANG OPERASI             → operasi
 * - BIDANG PEMELIHARAAN        → pemeliharaan
 * - BIDANG LOGISTIK            → business_support (tidak ada kode legacy
 *                                "logistik"; pengadaan/gudang masuk BS)
 * - SUB BIDANG K3              → k3_kam
 * - SUB BIDANG LINGKUNGAN      → lingkungan
 * - SUB BIDANG SDM/KEUANGAN/
 *   UMUM & CSR                 → business_support
 * - SUB BIDANG INVENTORI /
 *   ADMINISTRASI GUDANG        → pemeliharaan (kode inventori legacy)
 * - Sub-bidang yang tidak punya padanan kode → sub_department_code NULL
 *   (akun hanya terikat level bidang, bukan sub-bidang).
 */
return new class extends Migration
{
    /**
     * nama Master Bidang => [department_code, sub_department_code]
     *
     * @var array<string, array{0: string|null, 1: string|null}>
     */
    private const CODES = [
        'PLTU INDRAMAYU' => [null, null],

        // ── Engineering ────────────────────────────────────────────
        'BIDANG ENJINIRING' => ['engineering', null],
        'SUB BIDANG  SYSTEM OWNER TURBINE & AUX' => ['engineering', 'asmen_so'],
        'SUB BIDANG SYSTEM OWNER BOILER & AUX' => ['engineering', 'asmen_so'],
        'SUB BIDANG SYSTEM OWNER COMMON AUX' => ['engineering', 'asmen_so'],
        'SUB BIDANG COMPONENT ANALYST' => ['engineering', 'asmen_cbm'],
        'SUB BIDANG CONDITION BASED MAINTENANCE' => ['engineering', 'asmen_cbm'],
        'SUB BIDANG MANAJEMEN MUTU & KINERJA' => ['engineering', 'asmen_mmrk'],
        'SUB BIDANG MANAJEMEN RISIKO & KEPATUHAN' => ['engineering', 'asmen_mmrk'],

        // ── Operasi ────────────────────────────────────────────────
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

        // ── Pemeliharaan ───────────────────────────────────────────
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

        // ── Logistik ───────────────────────────────────────────────
        'BIDANG LOGISTIK' => ['business_support', null],
        'SUB BIDANG INVENTORI KONTROL & KATALOGER' => ['pemeliharaan', 'asmen_inventori'],
        'SUB BIDANG PENGADAAN' => ['business_support', 'asmen_pengadaan'],
        'SUB BIDANG ADMINISTRASI GUDANG' => ['pemeliharaan', 'asmen_inventori'],
    ];

    public function up(): void
    {
        Schema::table('bidangs', function (Blueprint $table) {
            $table->string('department_code', 50)->nullable()->after('parent_id');
            $table->string('sub_department_code', 50)->nullable()->after('department_code');

            $table->index('department_code');
        });

        foreach (self::CODES as $nama => [$departmentCode, $subDepartmentCode]) {
            if ($departmentCode === null && $subDepartmentCode === null) {
                continue;
            }

            DB::table('bidangs')
                ->where('nama', $nama)
                ->whereNull('department_code')
                ->whereNull('sub_department_code')
                ->update([
                    'department_code'     => $departmentCode,
                    'sub_department_code' => $subDepartmentCode,
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('bidangs', function (Blueprint $table) {
            $table->dropIndex(['department_code']);
            $table->dropColumn(['department_code', 'sub_department_code']);
        });
    }
};
