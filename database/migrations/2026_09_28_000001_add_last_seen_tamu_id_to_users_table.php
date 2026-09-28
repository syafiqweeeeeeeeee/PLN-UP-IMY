<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Penanda "sudah dilihat" lonceng notifikasi kini PER-AKUN USER (kolom
 * users.last_seen_tamu_id), bukan lagi session. Status terbaca jadi
 * permanen: tetap tersimpan walau sesi habis, logout, atau login dari
 * browser/perangkat berbeda.
 *
 * Default 0 = belum pernah melihat tamu mana pun → semua tamu terhitung
 * belum dibaca (perilaku sama seperti session lama yang default-nya 0).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('last_seen_tamu_id')->default(0)->after('sub_department');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_seen_tamu_id');
        });
    }
};
