<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Manajemen Konten Portal Karyawan (tahap 1):
 * kolom target_publication untuk Berita & Pengumuman.
 *
 * Nilai (enum):
 * - 'public' → hanya tampil di landing page website publik.
 * - 'portal' → hanya tampil di Portal Karyawan setelah login.
 * - 'all'    → tampil di keduanya (default — kompatibel data lama,
 *              yang sebelumnya selalu tampil di publik + portal).
 */
return new class extends Migration
{
    public function up(): void
    {
        foreach (['news', 'announcements'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->enum('target_publication', ['public', 'portal', 'all'])
                    ->default('all')
                    ->after('category')
                    ->index();
            });
        }
    }

    public function down(): void
    {
        foreach (['news', 'announcements'] as $table) {
            if (Schema::hasColumn($table, 'target_publication')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropIndex(['target_publication']);
                    $table->dropColumn('target_publication');
                });
            }
        }
    }
};
