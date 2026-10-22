<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Integrasi MASTER Bidang & Jabatan ke tabel users (fitur Tambah/Edit
 * Pengguna):
 * - bidang_id  → bidangs.id  (master organisasi, terpisah dari
 *                departments / kolom string `department` untuk RBAC).
 * - jabatan_id → jabatans.id (posisi pekerjaan; BUKAN role — role tetap
 *                menentukan hak akses sistem lewat role_id).
 *
 * Kedua kolom nullable (opsional; akun legacy tidak terpengaruh) dan
 * FK `restrictOnDelete`: bidang/jabatan yang masih dipakai akun tidak
 * dapat dihapus dari master — proteksi di level database, sejalan dengan
 * kebijakan fitur master bidang/jabatan lainnya.
 *
 * Kolom RBAC lama (level_jabatan, department, department_id,
 * sub_department) TIDAK disentuh — scoping data & hak akses tetap
 * mengikuti jalur lama.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('bidang_id')
                ->nullable()
                ->after('sub_department')
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('jabatan_id');
            $table->dropConstrainedForeignId('bidang_id');
        });
    }
};
