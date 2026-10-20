<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Referensi master organisasi pada data karyawan.
 *
 * - `bidang_id`  → bidangs.id  (nullable)
 * - `jabatan_id` → jabatans.id (nullable)
 *
 * Kolom teks lama (`bidang`, `jabatan`) TIDAK dihapus/diubah: masih
 * dipakai data historis, impor, dan ekspor. Kolom ID hanya pelengkap
 * yang boleh NULL selama nama lama belum bisa dipetakan dengan aman.
 *
 * `restrictOnDelete` mengikuti konvensi master (bidangs/jabatans):
 * master yang masih direferensikan data karyawan tidak boleh dihapus di
 * level database — proteksi utama tetap di controller dengan pesan jelas.
 *
 * Migrasi ALTER terpisah agar aman untuk database yang sudah terisi.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->foreignId('bidang_id')
                ->nullable()
                ->after('nama')
                ->constrained('bidangs')
                ->restrictOnDelete();

            $table->foreignId('jabatan_id')
                ->nullable()
                ->after('bidang_id')
                ->constrained('jabatans')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('jabatan_id');
            $table->dropConstrainedForeignId('bidang_id');
        });
    }
};
