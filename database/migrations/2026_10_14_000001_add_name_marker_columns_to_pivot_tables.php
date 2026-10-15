<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Kolom penanda nama pada tabel pivot Role & Permission.
 *
 * TUJUAN HANYA KETERBACAAN: pivot seperti `role_permission`
 * (id, role_id, permission_id) sulit dibaca di phpMyAdmin karena hanya
 * berisi ID. Kolom `*_name` di bawah adalah SALINAN (denormalisasi)
 * dari tabel sumber, dipakai orang untuk membaca saja.
 *
 * ATURAN MAIN — kolom ini BUKAN bagian dari mekanisme RBAC:
 *   - Semua proses aplikasi (sync/attach/permission check) TETAP
 *     memakai ID: role_id, permission_id, user_id, page_id.
 *   - Kolom dibiarkan nullable TANPA default, sehingga INSERT lama
 *     yang tidak mengirim kolom ini TETAP berhasil.
 *   - Tidak ada kolom/FK/unique constraint lama yang diubah, dan
 *     tidak ada tabel/kolom yang dihapus.
 *
 * Sumber kolom penanda:
 *   role_permission.role_name            <- roles.name
 *   role_permission.permission_name      <- permissions.name
 *   role_user.user_name                  <- users.name
 *   role_user.role_name                  <- roles.name
 *   user_has_permissions.user_name       <- users.name
 *   user_has_permissions.permission_name <- permissions.name
 *   page_role.page_name                  <- pages.title
 *                                         (tabel pages TIDAK punya kolom `name`)
 *   page_role.role_name                  <- roles.name
 *
 * Pengisian awal nilai dilakukan di migration terpisah
 * (2026_10_14_000002_backfill_name_marker_columns_to_pivot_tables).
 */
return new class extends Migration
{
    public function up(): void
    {
        // --- role_permission: salinan nama role & permission ---
        if (Schema::hasTable('role_permission')) {
            Schema::table('role_permission', function (Blueprint $table) {
                if (! Schema::hasColumn('role_permission', 'role_name')) {
                    $table->string('role_name', 100)->nullable()->after('role_id');
                }
                if (! Schema::hasColumn('role_permission', 'permission_name')) {
                    $table->string('permission_name', 100)->nullable()->after('permission_id');
                }
            });
        }

        // --- role_user: salinan nama user & role ---
        if (Schema::hasTable('role_user')) {
            Schema::table('role_user', function (Blueprint $table) {
                if (! Schema::hasColumn('role_user', 'user_name')) {
                    $table->string('user_name', 255)->nullable()->after('user_id');
                }
                if (! Schema::hasColumn('role_user', 'role_name')) {
                    $table->string('role_name', 100)->nullable()->after('role_id');
                }
            });
        }

        // --- user_has_permissions: salinan nama user & permission ---
        if (Schema::hasTable('user_has_permissions')) {
            Schema::table('user_has_permissions', function (Blueprint $table) {
                if (! Schema::hasColumn('user_has_permissions', 'user_name')) {
                    $table->string('user_name', 255)->nullable()->after('user_id');
                }
                if (! Schema::hasColumn('user_has_permissions', 'permission_name')) {
                    $table->string('permission_name', 100)->nullable()->after('permission_id');
                }
            });
        }

        // --- page_role: salinan judul halaman (pages.title) & role ---
        if (Schema::hasTable('page_role')) {
            Schema::table('page_role', function (Blueprint $table) {
                if (! Schema::hasColumn('page_role', 'page_name')) {
                    $table->string('page_name', 255)->nullable()->after('page_id');
                }
                if (! Schema::hasColumn('page_role', 'role_name')) {
                    $table->string('role_name', 100)->nullable()->after('role_id');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('role_permission')) {
            Schema::table('role_permission', function (Blueprint $table) {
                foreach (['role_name', 'permission_name'] as $column) {
                    if (Schema::hasColumn('role_permission', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        if (Schema::hasTable('role_user')) {
            Schema::table('role_user', function (Blueprint $table) {
                foreach (['user_name', 'role_name'] as $column) {
                    if (Schema::hasColumn('role_user', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        if (Schema::hasTable('user_has_permissions')) {
            Schema::table('user_has_permissions', function (Blueprint $table) {
                foreach (['user_name', 'permission_name'] as $column) {
                    if (Schema::hasColumn('user_has_permissions', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        if (Schema::hasTable('page_role')) {
            Schema::table('page_role', function (Blueprint $table) {
                foreach (['page_name', 'role_name'] as $column) {
                    if (Schema::hasColumn('page_role', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};
