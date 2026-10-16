<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Kolom ORGANIK dilebarkan 30 → 100 karakter.
 *
 * Data HR asli memuat teks panjang pada ORGANIK (bukan sekadar kode
 * pendek), sehingga batas 30 karakter membuat impor baris valid GAGAL.
 * Kolom sejenis di tabel yang sama (INSTITUSI, UNIT) berukuran 100 —
 * ORGANIK disamakan.
 *
 * Migrasi ALTER terpisah (bukan mengubah migrasi create) agar aman
 * bagi database yang sudah terisi data: hanya lebar kolom yang berubah,
 * data lama tidak tersentuh.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->string('organik', 100)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->string('organik', 30)->nullable()->change();
        });
    }
};
