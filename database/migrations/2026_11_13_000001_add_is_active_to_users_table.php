<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Status AKTIF akun dipisahkan dari `email_verified_at`.
 *
 * Sebelumnya toggle Aktif/Nonaktif menulis ke `email_verified_at`, tetapi
 * login tidak memeriksanya — akun nonaktif tetap bisa masuk. Kolom
 * `is_active` menjadi satu sumber kebenaran untuk akses login dan sesi.
 *
 * BACKFILL: seluruh akun yang sudah ada dianggap AKTIF karena itulah
 * perilaku efektif saat migrasi ini berjalan (login belum pernah ditolak).
 * Admin dapat menonaktifkan akun lewat tombol toggle setelah migrasi.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('users', 'is_active')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_active')->default(true)->after('email_verified_at')->index();
            });
        }

        DB::table('users')->whereNull('is_active')->update(['is_active' => true]);
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'is_active')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }
    }
};
