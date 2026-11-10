<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Integrasi dropdown SUB-BIDANG Link Kerja dengan MASTER JABATAN.
 *
 * - `jabatan_id` → jabatans.id: Sub-Bidang target link adalah jabatan
 *   koordinator/manajerial (mis. ASSISTANT MANAGER KEUANGAN). Akses
 *   diwariskan ke seluruh jabatan bawahan lewat relasi `parent_id`
 *   Master Jabatan.
 * - `bidang_id` tetap menunjuk Bidang tempat jabatan itu berada; bila
 *   `jabatan_id` NULL, link berlaku untuk SELURUH pegawai di Bidang
 *   terpilih (termasuk sub-bidang di bawahnya).
 * - FK `restrictOnDelete`: jabatan yang masih dipakai link kerja tidak
 *   dapat dihapus di level database. Pesan ramah diberikan controller
 *   Master Jabatan (cek `workLinks()` sebelum delete).
 *
 * Link lama tidak berubah: `jabatan_id` NULL berarti target level Bidang.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('work_links', function (Blueprint $table) {
            $table->foreignId('jabatan_id')
                ->nullable()
                ->after('bidang_id')
                ->constrained('jabatans')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('work_links', function (Blueprint $table) {
            $table->dropConstrainedForeignId('jabatan_id');
        });
    }
};
