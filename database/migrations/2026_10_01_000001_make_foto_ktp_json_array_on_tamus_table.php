<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * foto_ktp kini menampung ARRAY path (JSON) — satu foto KTP per tamu
 * dalam rombongan, mengikuti field "jumlah_tamu" pada form registrasi.
 *
 * Contoh nilai: ["ktp/abc.jpg", "ktp/def.png"]
 * Path tetap di disk 'private' dan disajikan lewat route ber-auth
 * admin.tamu.ktp (lihat TamuDocumentController) sesuai kepatuhan UU PDP.
 *
 * Catatan implementasi: ALTER langsung VARCHAR → JSON akan gagal di MySQL
 * bila nilai lama bukan JSON valid ("Invalid JSON text"). Maka kolom lama
 * di-rename, kolom JSON baru dibuat, data dikonversi via JSON_ARRAY(),
 * lalu kolom lama dihapus — aman untuk data apa pun.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->renameColumn('foto_ktp', 'foto_ktp_legacy');
        });

        Schema::table('tamus', function (Blueprint $table) {
            $table->json('foto_ktp')
                ->nullable()
                ->comment('Array path file KTP di disk private, mis. ["ktp/abc.jpg"]')
                ->after('email');
        });

        // Bungkus path string lama menjadi array JSON berisi satu elemen.
        DB::table('tamus')
            ->whereNotNull('foto_ktp_legacy')
            ->update([
                'foto_ktp' => DB::raw('JSON_ARRAY(foto_ktp_legacy)'),
            ]);

        Schema::table('tamus', function (Blueprint $table) {
            $table->dropColumn('foto_ktp_legacy');
        });
    }

    public function down(): void
    {
        // Kembalikan ke string tunggal: ambil elemen pertama array (bila ada).
        Schema::table('tamus', function (Blueprint $table) {
            $table->string('foto_ktp_legacy')
                ->nullable()
                ->comment('Path file KTP di disk private (rollback), mis. ktp/abc.jpg')
                ->after('email');
        });

        DB::table('tamus')
            ->whereNotNull('foto_ktp')
            ->update([
                'foto_ktp_legacy' => DB::raw("JSON_UNQUOTE(JSON_EXTRACT(foto_ktp, '$[0]'))"),
            ]);

        Schema::table('tamus', function (Blueprint $table) {
            $table->dropColumn('foto_ktp');
        });

        Schema::table('tamus', function (Blueprint $table) {
            $table->renameColumn('foto_ktp_legacy', 'foto_ktp');
        });
    }
};
