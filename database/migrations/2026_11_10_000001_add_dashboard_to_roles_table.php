<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Dashboard Setelah Login per Role.
 *
 * Kolom ini menentukan halaman pertama yang terbuka setelah pengguna
 * dengan role tersebut login: 'admin' (panel admin) atau 'karyawan'
 * (Portal Karyawan). Nullable agar role lama / role yang dibuat tanpa
 * pengaturan memakai fallback Role::dashboardType() — role "Karyawan"
 * ke portal, lainnya ke panel admin.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('dashboard', 20)->nullable()->after('status');
        });

        // Role Karyawan bawaan → Portal Karyawan (perilaku lama tetap).
        DB::table('roles')
            ->where('name', 'Karyawan')
            ->update(['dashboard' => 'karyawan']);
    }

    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('dashboard');
        });
    }
};
