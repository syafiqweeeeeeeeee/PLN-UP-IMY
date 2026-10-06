<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * master_menus — struktur master ID Menu Sidebar Admin Panel.
 *
 * Mencatat seluruh 11 ID Menu Sidebar sebagai sumber tunggal (source of
 * truth) untuk matriks hak akses granular pada Halaman Kelola Role:
 *
 *   ID 1  : Dashboard          ID 7  : Pengguna
 *   ID 2  : Berita             ID 8  : Galeri
 *   ID 3  : Data Tamu          ID 9  : Link Kerja
 *   ID 4  : Pengumuman         ID 10 : Log Aktivitas
 *   ID 5  : Halaman            ID 11 : Role / Hak Akses
 *   ID 6  : Menu
 *
 * Setiap ID Menu dipecah menjadi 4 hak akses granular (CRUD) pada tabel
 * permissions: [permission_key].view / .create / .edit / .delete —
 * kolom permission_key dipetakan ke tabel roles (role_permission).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('route', 150)->nullable();
            $table->string('icon', 100)->nullable();
            $table->string('permission_key', 100)->nullable()->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_menus');
    }
};
