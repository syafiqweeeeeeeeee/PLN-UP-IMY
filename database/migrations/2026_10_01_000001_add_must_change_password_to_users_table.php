<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Reset Password oleh Admin (password sekali pakai):
 *
 - Kolom `must_change_password` (boolean, default false) menandai akun
   yang password-nya direset admin menjadi password sementara sekali
   pakai. Saat akun bersangkutan login, ia WAJIB mengganti password
   sebelum dapat mengakses aplikasi (lihat MustChangePassword
   middleware & ChangePasswordController).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('must_change_password')->default(false)->after('password');
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'must_change_password')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('must_change_password');
            });
        }
    }
};
