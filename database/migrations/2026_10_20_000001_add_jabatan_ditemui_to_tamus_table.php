<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tool Registrasi Tamu — integrasi master jabatans.
 *
 * Menambah kolom `jabatan_ditemui` (nullable) pada tabel `tamus`
 * untuk mencatat jabatan orang yang ditemui yang dipilih tamu dari
 * MASTER JABATANS di form registrasi (dropdown bertingkat mengikuti
 * bidang terpilih pada kolom `tujuan_ditemui`).
 *
 * Catatan aman:
 * - MIGRASI TAMBAH KOLOM SAJA — tidak menghapus/mengubah kolom dan
 *   data tamu yang sudah ada (baris lama bernilai NULL, tetap tampil
 *   dan dapat diedit seperti sebelumnya).
 * - Kolom `tujuan_ditemui` (nama bidang tujuan kunjungan) TIDAK
 *   diubah — masih dipakai pemblokiran slot kunjungan per divisi.
 * - Mengikuti pola kolom string yang sudah dipakai tamu lain
 *   (tanpa FK id), supaya data lama tidak terkunci padahal bertahun
 *   tidak berelasi dengan tabel master.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->string('jabatan_ditemui', 150)
                ->nullable()
                ->after('tujuan_ditemui')
                ->comment('Jabatan orang yang ditemui (dipilih dari tabel jabatans, kosong = tidak diisi)');
        });
    }

    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->dropColumn('jabatan_ditemui');
        });
    }
};
