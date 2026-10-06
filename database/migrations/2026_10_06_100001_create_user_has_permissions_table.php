<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * user_has_permissions — pivot DIRECT PERMISSION (hak akses langsung
 * per akun pengguna).
 *
 * REVISI ARSITEKTUR RBAC: pembagian hak akses menu yang berbeda-beda
 * TIDAK dibuat lewat role baru, melainkan diatur langsung per akun di
 * form Pengguna (matriks ID Menu Sidebar × CRUD). Tabel ini menyimpan
 * pemetaan tersebut; efektif = permission role (baseline) ∪ direct.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_has_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('permission_id')->constrained('permissions')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'permission_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_has_permissions');
    }
};
