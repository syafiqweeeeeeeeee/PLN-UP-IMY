<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tanggal (dan jam) kunjungan yang direncanakan tamu.
     * Diisi dari form registrasi; nullable agar data lama tetap valid.
     */
    public function up(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->dateTime('tanggal_kunjungan')
                ->nullable()
                ->after('jumlah_tamu')
                ->comment('Rencana tanggal & jam kunjungan (input tamu)');
        });
    }

    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->dropColumn('tanggal_kunjungan');
        });
    }
};
