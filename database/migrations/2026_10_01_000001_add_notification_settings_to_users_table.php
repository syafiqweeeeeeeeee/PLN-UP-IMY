<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Preferensi Notifikasi Panel Admin per user (halaman Pengaturan):
 * - notif_desktop  : pemberitahuan browser saat aktivitas baru.
 * - notif_weekly   : ringkasan aktivitas konten tiap Senin pagi.
 * - notif_pending  : alert draft berita/pengumuman yang belum dipublikasi.
 *
 * Disimpan sebagai JSON agar mudah ditambah tanpa migrasi baru;
 * null = belum pernah disimpan (pakai default di model).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('notification_settings')->nullable()->after('last_seen_tamu_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('notification_settings');
        });
    }
};
