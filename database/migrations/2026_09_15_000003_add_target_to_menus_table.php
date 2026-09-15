<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menambah kolom `target` pada tabel menus — spesifikasi link selector:
 * '_self' (buka di tab sama, default) atau '_blank' (tab baru).
 * Nilai lama otomatis '_self' sesuai default kolom.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('target', 10)->default('_self')->after('url');
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('target');
        });
    }
};
