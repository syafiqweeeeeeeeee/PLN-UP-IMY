<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * STATUS KARYAWAN — kolom `aktif` / `nonaktif` pada tabel `karyawans`.
 *
 * Halaman Data Karyawan menampilkan HANYA karyawan berstatus Aktif secara
 * default; daftar Nonaktif dibuka lewat tombol "Karyawan Nonaktif".
 *
 * Aturan:
 * - Kolom wajib terisi (NOT NULL) dengan DEFAULT 'aktif', sehingga SELURUH
 *   data karyawan lama otomatis dianggap AKTIF saat migrasi berjalan
 *   (nilai existing diisi dari default).
 * - Mengubah status TIDAK menghapus data — baris tetap ada, hanya
 *   statusnya yang berpindah (lihat
 *   DataKaryawanController::toggleStatus).
 * - Diindeks karena menjadi filter bawaan setiap pembukaan halaman
 *   daftar, ekspor, pencarian, dan pagination.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->string('status', 10)->default('aktif')->after('unit');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropColumn('status');
        });
    }
};
