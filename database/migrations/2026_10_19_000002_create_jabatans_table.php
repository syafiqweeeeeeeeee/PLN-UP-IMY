<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Master Jabatan — katalog jabatan berhirarki yang terikat satu bidang.
 *
 * Catatan desain:
 * - TABEL BARU. Tidak mengubah kolom string `karyawans.jabatan` maupun
 *   data karyawan yang sudah ada.
 * - `bidang_id` wajib, FK ke `bidangs.id` — jabatan selalu berada di
 *   bawah satu bidang.
 * - `parent_id` self-FK hanya mengarah ke `jabatans.id` (hirarki
 *   jabatan di dalam/b lintas bidang, NULL untuk jabatan tingkat
 *   teratas).
 * - FK `restrictOnDelete` (lihat alasan di migration bidangs).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->foreignId('bidang_id')
                ->constrained('bidangs')
                ->restrictOnDelete();
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('jabatans')
                ->restrictOnDelete();
            $table->timestamps();

            $table->index('bidang_id');
            $table->index('parent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jabatans');
    }
};
