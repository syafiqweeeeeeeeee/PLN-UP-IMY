<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Master Bidang — katalog nama bidang berhirarki (induk → sub-bidang).
 *
 * Catatan desain:
 * - TABEL BARU, terpisah dari `departments` (katalog Bidang Utama untuk
 *   RBAC/departemen akun) dan dari kolom string `karyawans.bidang`.
 *   Tidak ada perubahan apa pun pada keduanya.
 * - `parent_id` self-FK hanya mengarah ke `bidangs.id` (hierarki
 *   bertingkat, boleh NULL untuk bidang tingkat teratas).
 * - FK `restrictOnDelete`: penghapusan yang merusak hierarki ditolak di
 *   level database. Pemeriksaan utama (parent masih punya child, masih
 *   dipakai jabatan/karyawan) dilakukan di controller dengan pesan yang
 *   jelas — sama seperti kebijakan "data terikat tidak boleh dihapus"
 *   yang berlaku di fitur lain.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bidangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('bidangs')
                ->restrictOnDelete();
            $table->timestamps();

            $table->index('parent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bidangs');
    }
};
