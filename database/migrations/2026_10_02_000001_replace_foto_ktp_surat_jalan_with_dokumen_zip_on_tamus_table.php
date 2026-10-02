<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Alur dokumen tamu disederhanakan: seluruh berkas pendukung
 * (foto KTP, surat permohonan, dll.) kini dikumpulkan dalam SATU
 * file ZIP yang diunggah lewat form registrasi.
 *
 * - Kolom dokumen_zip ditambahkan (path file ZIP di disk 'private',
 *   mis. "dokumen/AbC123....zip", disajikan via route ber-auth
 *   admin.tamu.dokumen sesuai kepatuhan UU PDP).
 * - Kolom foto_ktp (JSON array) & surat_jalan dihapus karena tidak
 *   lagi dipakai.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->string('dokumen_zip')
                ->nullable()
                ->comment('Path file ZIP dokumen pendukung di disk private, mis. dokumen/abc.zip')
                ->after('email');

            $table->dropColumn(['foto_ktp', 'surat_jalan']);
        });
    }

    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            // Kembalikan struktur sesuai migration sebelumnya:
            // foto_ktp JSON array + surat_jalan string.
            $table->json('foto_ktp')
                ->nullable()
                ->comment('Array path file KTP di disk private, mis. ["ktp/abc.jpg"]')
                ->after('email');

            $table->string('surat_jalan')
                ->nullable()
                ->comment('Path file surat PDF di disk private, mis. surat/abc.pdf')
                ->after('foto_ktp');

            $table->dropColumn('dokumen_zip');
        });
    }
};
