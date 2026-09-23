<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Kolom Hirarki Organisasi untuk tabel users (tahap awal):
 * - level_jabatan  → Level Jabatan (Administrator / Senior Manager / ...)
 * - department     → Bidang Utama (Operasi, Pemeliharaan, ...)
 * - sub_department → Sub-Bidang / Bagian (Asmen Prod A, Spv CHCB B, ...)
 *
 * Catatan: kolom `role` (string) SUDAH ADA sejak migrasi
 * 2026_09_09_020514_add_user_profile_fields_to_users_table — tidak dibuat ulang
 * di sini. Kolom tersebut dipakai untuk hak akses sistem (users.role → tabel
 * roles via role_id), sementara `level_jabatan` murni data organisasi.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('level_jabatan')->nullable()->after('role_id');
            $table->string('department')->nullable()->after('level_jabatan');
            $table->string('sub_department')->nullable()->after('department');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['level_jabatan', 'department', 'sub_department']);
        });
    }
};
