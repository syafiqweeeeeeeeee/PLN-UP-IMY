<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tambah kolom surat_jalan ke tabel tamus:
 * file PDF surat permohonan/undangan resmi dari perusahaan/instansi tamu
 * (wajib diunggah pada form registrasi publik).
 *
 * Path disimpan relatif di disk 'public', mis. "surat/abc.pdf" ->
 * storage/app/public/surat. Nullable agar data lama & input manual
 * admin tetap valid.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->string('surat_jalan')->nullable()
                ->comment('Path file PDF surat permohonan di disk public, mis. surat/abc.pdf')
                ->after('foto_ktp');
        });
    }

    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->dropColumn('surat_jalan');
        });
    }
};
