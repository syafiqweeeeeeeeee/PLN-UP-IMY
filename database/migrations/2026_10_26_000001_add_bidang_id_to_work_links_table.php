<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Integrasi Manajemen Link Kerja dengan MASTER BIDANG (tabel bidangs).
 *
 * - `bidang_id` → bidangs.id: bidang target link (NULL untuk link kategori
 *   'umum' / data lama yang belum terpetakan).
 * - FK `restrictOnDelete`: bidang yang masih dipakai link kerja tidak dapat
 *   dihapus di level database. Pesan yang ramah tetap diberikan controller
 *   Master Bidang (cek `workLinks()` sebelum delete).
 * - Kolom legacy `department` / `sub_department` TIDAK dihapus: nilainya
 *   diturunkan ulang dari baris Bidang terpilih (Bidang::departmentCode()
 *   dan Bidang::subDepartmentCode()) sehingga filter data lama & Portal
 *   Karyawan tetap bekerja tanpa perubahan.
 *
 * Backfill: link lama yang masih memakai kode legacy dipetakan ke baris
 * master yang cocok (department_code + sub_department_code). Link kategori
 * 'umum' dibiarkan NULL karena memang tidak bertarget bidang.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('work_links', function (Blueprint $table) {
            $table->foreignId('bidang_id')
                ->nullable()
                ->after('sub_department')
                ->constrained('bidangs')
                ->restrictOnDelete();
        });

        $this->backfillBidangIds();
    }

    public function down(): void
    {
        Schema::table('work_links', function (Blueprint $table) {
            $table->dropConstrainedForeignId('bidang_id');
        });
    }

    /**
     * Petakan setiap kombinasi kode legacy ke baris Master Bidang.
     *
     * Pemilihan baris:
     * - dengan sub-bidang → kode bidang + kode sub harus sama;
     * - tanpa sub-bidang → utamakan bidang induk (parent_id NULL), lalu
     *   baris mana pun yang ber-kode bidang sama dan tanpa kode sub.
     */
    private function backfillBidangIds(): void
    {
        if (! Schema::hasTable('bidangs')) {
            return;
        }

        $legacyLinks = DB::table('work_links')
            ->whereNull('bidang_id')
            ->where('category', 'khusus')
            ->whereNotNull('department')
            ->get(['id', 'department', 'sub_department']);

        foreach ($legacyLinks as $link) {
            $query = DB::table('bidangs')
                ->where('department_code', $link->department);

            if ($link->sub_department !== null && $link->sub_department !== '') {
                $query->where('sub_department_code', $link->sub_department);
            } else {
                $query->whereNull('sub_department_code');
            }

            $bidangId = (clone $query)->whereNull('parent_id')->orderBy('id')->value('id')
                ?? (clone $query)->orderBy('id')->value('id');

            if ($bidangId !== null) {
                DB::table('work_links')
                    ->where('id', $link->id)
                    ->update(['bidang_id' => $bidangId]);
            }
        }
    }
};
