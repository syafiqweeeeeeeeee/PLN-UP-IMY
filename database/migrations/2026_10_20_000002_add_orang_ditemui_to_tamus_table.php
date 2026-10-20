<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tamu — kolom "Orang yang Ditemui" (nama orang, bebas teks).
 *
 * Melengkapi integrasi master bidang/jabatan: tujuan_ditemui menyimpan
 * NAMA bidang tujuan kunjungan, jabatan_ditemui jabatannya, dan kolom
 * baru ini menyimpan nama orang yang ditemui di bidang tersebut.
 *
 * Aman untuk data lama: menambah kolom nullable saja — baris lama
 * bernilai NULL dan tidak ada kolom/data lain yang disentuh.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->string('orang_ditemui', 150)
                ->nullable()
                ->after('jabatan_ditemui')
                ->comment('Nama orang yang ditemui di bidang tujuan (teks bebas, kosong = tidak diisi)');
        });
    }

    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->dropColumn('orang_ditemui');
        });
    }
};
