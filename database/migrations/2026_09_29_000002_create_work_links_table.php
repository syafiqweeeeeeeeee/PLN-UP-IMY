<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Manajemen Link Kerja — tabel work_links untuk CRUD dari Panel Admin.
 *
 * - category 'umum'  → link tampil otomatis di SEMUA akun Karyawan.
 * - category 'khusus'→ link terikat department (+ sub_department bila
 *   targetnya spesifik sub-bidang, mis. Asisten Manager Prod A).
 * - is_active toggle Aktif/Nonaktif: link nonaktif disembunyikan
 *   dari Portal Karyawan tanpa dihapus.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_links', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url', 500);
            $table->text('description')->nullable();
            $table->string('icon')->default('fa-link');
            $table->enum('category', ['umum', 'khusus']);
            $table->string('department')->nullable();
            $table->string('sub_department')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['category', 'is_active']);
            $table->index(['department', 'sub_department']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_links');
    }
};
