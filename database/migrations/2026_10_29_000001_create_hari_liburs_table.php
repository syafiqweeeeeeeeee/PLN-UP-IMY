<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel hari_liburs — daftar Tanggal Merah / Hari Libur (nasional
 * maupun libur perusahaan) yang dikelola admin.
 *
 * Satu baris = satu tanggal libur (unik). Form registrasi tamu publik
 * memblokir tanggal ini di sisi klien (JS) dan menolaknya lewat
 * validasi server-side di TamuController::store.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hari_liburs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->unique();
            $table->string('keterangan', 150);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hari_liburs');
    }
};
