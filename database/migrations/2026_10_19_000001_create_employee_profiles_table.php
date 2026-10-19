<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * TABEL RELASI DATA KEPEGAWAIAN ↔ AKUN PENGGUNA.
 *
 * Employee_profiles menyimpan data master kepegawaian (24 kolom
 * spesifikasi Excel yang sama dengan tabel `karyawans`) yang terhubung
 * 1:1 ke akun login `users` — ditampilkan pada halaman Detail Pengguna
 * (ikon mata di Kelola Pengguna) dan diisi via tombol "Edit Detail /
 * Lengkapi Data".
 *
 * Perancangan:
 * - `user_id` UNIQUE (relasi 1:1, cascade ketika akun pengguna dihapus).
 * - `karyawan_id` NULLABLE FK ke `karyawans` — kolom PENANDA (soft-link)
 *   ke master data HR hasil impor Excel; diisi otomatis ketika NID
 *   yang disimpan cocok dengan baris karyawans. Data master `karyawans`
 *   TIDAK diubah dari sini (modul Data Karyawan tetap satu sumber
 *   kebenaran untuk master HR).
 * - `nid` di-index (bukan unique) karena menurun dari akun pengguna;
 *   pencocokannya dilakukan saat penyimpanan.
 * - Kolom kepegawaian semuanya nullable — akun bisa disimpan tanpa
 *   lengkap (nama diisi fallback dari users.name).
 * - Tipe data & lebar kolom disamakan persis dengan tabel `karyawans`
 *   (termasuk ORGANIK 100 char hasil migrasi widen) sehingga data yang
 *   disalin dari master Excel tidak pernah kepotong.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_profiles', function (Blueprint $table) {
            $table->id();

            // --- Relasi ke akun pengguna (1:1) ---
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            // --- Soft-link ke master data HR (karyawans) ---
            $table->foreignId('karyawan_id')
                ->nullable()
                ->constrained('karyawans')
                ->nullOnDelete();

            // --- Identitas (mengikuti spesifikasi 24 kolom) ---
            $table->string('nid', 30)->nullable()->index();   // NID
            $table->string('nama', 150)->nullable();          // NAMA

            // --- Organisasi & Jabatan ---
            $table->string('unit', 100)->nullable();          // UNIT
            $table->string('bidang', 100)->nullable();        // BIDANG
            $table->string('jabatan', 100)->nullable();       // JABATAN
            $table->string('jenjang_jabatan', 50)->nullable(); // JENJAB
            $table->string('grade', 30)->nullable();          // GRADE
            $table->string('organik', 100)->nullable();       // ORGANIK
            $table->string('institusi', 100)->nullable();     // INSTITUSI
            $table->decimal('fte', 5, 2)->nullable();         // FTE
            $table->string('mims', 50)->nullable();           // MIMS

            // --- Tanggal Penting ---
            $table->date('service_date')->nullable();         // SERVICE DATE
            $table->date('hire_date')->nullable();            // HIRE DATE
            $table->date('retire_date')->nullable();          // RETIRE DATE
            $table->date('grade_date')->nullable();           // GRADE DATE
            $table->date('tgl_jab')->nullable();              // TGL JAB
            $table->date('tanggal_lahir')->nullable();        // TGL LAHIR

            // --- Kontak & Komunikasi ---
            $table->string('telp', 50)->nullable();           // TELP
            $table->string('hp', 50)->nullable();             // HP
            $table->string('email', 150)->nullable();         // EMAIL

            // --- Data Pribadi ---
            $table->string('tempat_lahir', 100)->nullable();  // TEMPAT LAHIR
            $table->string('agama', 30)->nullable();          // AGAMA
            $table->string('gender', 10)->nullable();         // GENDER (L/P)
            $table->string('status_kawin', 20)->nullable();   // STATUS KAWIN

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_profiles');
    }
};
