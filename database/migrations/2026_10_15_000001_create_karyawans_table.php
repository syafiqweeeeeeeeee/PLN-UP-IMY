<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel Data Karyawan — master data sekitar 300 karyawan UP Indramayu.
 *
 * Struktur mengikuti 24 kolom spesifikasi (label tampilan dipertahankan;
 * nama kolom database memakai snake_case konvensi Laravel):
 *
 *   NID | NAMA | BIDANG | JABATAN | JENJAB | GRADE | INSTITUSI | ORGANIK
 *   TGL LAHIR | SERVICE DATE | HIRE DATE | RETIRE DATE | GRADE DATE | TGL JAB
 *   TELP | HP | EMAIL | FTE | MIMS | TEMPAT LAHIR | AGAMA | GENDER
 *   STATUS KAWIN | UNIT
 *
 * Aturan tipe data:
 * - NID identitas UNIK (unique index) — disimpan sebagai string agar
 *   angka nol di depan tidak hilang ( begitu juga TELP/HP & kode lain).
 * - Kolom tanggal bertipe `date` (TGL LAHIR, SERVICE/HIRE/RETIRE/GRADE
 *   DATE, TGL JAB).
 * - Hanya NID & NAMA yang wajib (NOT NULL) — kolom lain nullable agar
 *   impor data historis yang lengkap sebagian tidak gagal.
 * - TIDAK ada FK ke tabel `users`: data profil karyawan (master data
 *   HR) sengaja dipisah dari akun login (`users`) agar pencampuran
 *   data profil dengan akun autentikasi tidak terjadi — sesuai
 *   struktur autentikasi yang sudah ada (akun login hanya ~beberapa
 *   puluh, karyawan ~300).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();

            // --- Identitas Karyawan ---
            $table->string('nid', 30)->unique();          // NID (unik, string — jaga nol di depan)
            $table->string('nama', 150);                  // NAMA
            $table->string('tempat_lahir', 100)->nullable(); // TEMPAT LAHIR
            $table->date('tanggal_lahir')->nullable();    // TGL LAHIR
            $table->string('agama', 30)->nullable();      // AGAMA
            $table->string('gender', 10)->nullable();     // GENDER (L / P)
            $table->string('status_kawin', 20)->nullable(); // STATUS KAWIN

            // --- Informasi Pekerjaan ---
            $table->string('bidang', 100)->nullable();    // BIDANG
            $table->string('jabatan', 100)->nullable();   // JABATAN
            $table->string('jenjang_jabatan', 50)->nullable(); // JENJAB
            $table->string('grade', 30)->nullable();      // GRADE
            $table->string('institusi', 100)->nullable(); // INSTITUSI
            $table->string('organik', 30)->nullable();    // ORGANIK (kode — string)
            $table->string('unit', 100)->nullable();      // UNIT

            // --- Riwayat Tanggal ---
            $table->date('service_date')->nullable();     // SERVICE DATE
            $table->date('hire_date')->nullable();        // HIRE DATE
            $table->date('retire_date')->nullable();      // RETIRE DATE
            $table->date('grade_date')->nullable();       // GRADE DATE
            $table->date('tgl_jab')->nullable();          // TGL JAB

            // --- Informasi Kontak ---
            $table->string('telp', 50)->nullable();       // TELP (string — jaga nol di depan)
            $table->string('hp', 50)->nullable();         // HP
            $table->string('email', 150)->nullable();     // EMAIL

            // --- Informasi Tambahan ---
            $table->decimal('fte', 5, 2)->nullable();     // FTE (angka desimal, mis. 1.00)
            $table->string('mims', 50)->nullable();       // MIMS (kode — string)

            $table->timestamps();

            // Filter yang didukung halaman daftar: BIDANG, JABATAN,
            // GRADE, GENDER, STATUS KAWIN, UNIT + pencarian NID/NAMA.
            $table->index('bidang');
            $table->index('jabatan');
            $table->index('grade');
            $table->index('gender');
            $table->index('status_kawin');
            $table->index('unit');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
