<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Alur verifikasi kunjungan tamu:
 * - status_verifikasi: "menunggu" (default, pendaftaran baru),
 *   "disetujui" (admin menyetujui) atau "ditolak" (admin menolak).
 * - verified_at / verified_by: kapan & oleh siapa keputusan diambil.
 *
 * Slot tanggal+jam kunjungan yang sudah DISSETUJUI dianggap terbooking:
 * tidak bisa dipilih lagi di form registrasi publik (ditandai merah).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->string('status_verifikasi', 20)
                ->default('menunggu')
                ->index()
                ->comment('menunggu | disetujui | ditolak')
                ->after('keperluan');

            $table->timestamp('verified_at')
                ->nullable()
                ->comment('Waktu keputusan verifikasi admin')
                ->after('status_verifikasi');

            $table->unsignedBigInteger('verified_by')
                ->nullable()
                ->comment('ID user admin yang memverifikasi')
                ->after('verified_at');
        });
    }

    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->dropColumn(['status_verifikasi', 'verified_at', 'verified_by']);
        });
    }
};
