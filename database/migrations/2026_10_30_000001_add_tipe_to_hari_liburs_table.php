<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menambahkan kolom `tipe` pada tabel hari_liburs — dua makna tanggal:
 *
 *   libur       : Tanggal Merah — blokir kunjungan (default, perilaku lama).
 *   masuk_kerja : Hari Kerja Khusus — override akhir pekan (Sabtu/Minggu
 *                 yang tadinya libur menjadi BISA dipilih pengunjung).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hari_liburs', function (Blueprint $table) {
            $table->enum('tipe', ['libur', 'masuk_kerja'])
                ->default('libur')
                ->after('tanggal');
        });
    }

    public function down(): void
    {
        Schema::table('hari_liburs', function (Blueprint $table) {
            $table->dropColumn('tipe');
        });
    }
};
