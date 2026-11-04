<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Menautkan "orang yang ditemui" pada buku tamu ke AKUN PENGGUNA
 * (users.id), bukan lagi hanya nama teks.
 *
 * Alasan keamanan: Portal Karyawan sebelumnya menentukan hak lihat &
 * verifikasi kunjungan dengan mencocokkan `tamus.orang_ditemui` ke
 * `users.name`. Karena karyawan boleh mengganti nama profilnya sendiri,
 * pencocokan nama bisa dibajak (rename → melihat/memverifikasi tamu
 * milik karyawan lain). Kolom ini menjadi dasar otorisasi yang stabil.
 *
 * Backfill: baris lama dicocokkan sekali secara case-insensitive + trim
 * ke nama akun, sehingga tamu yang sebelumnya tampil di portal tetap
 * tampil setelah migrasi.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->foreignId('orang_ditemui_user_id')
                ->nullable()
                ->after('orang_ditemui')
                ->constrained('users')
                ->nullOnDelete();
        });

        // Backfill data lama: cocokkan nama (case-insensitive, trim) ke akun.
        DB::table('tamus')
            ->whereNull('orang_ditemui_user_id')
            ->orderBy('id')
            ->chunkById(200, function ($rows) {
                foreach ($rows as $row) {
                    $nama = mb_strtolower(trim((string) $row->orang_ditemui));

                    if ($nama === '') {
                        continue;
                    }

                    $userId = DB::table('users')
                        ->whereRaw('LOWER(TRIM(name)) = ?', [$nama])
                        ->orderBy('id')
                        ->value('id');

                    if ($userId !== null) {
                        DB::table('tamus')
                            ->where('id', $row->id)
                            ->update(['orang_ditemui_user_id' => $userId]);
                    }
                }
            });
    }

    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->dropConstrainedForeignId('orang_ditemui_user_id');
        });
    }
};
