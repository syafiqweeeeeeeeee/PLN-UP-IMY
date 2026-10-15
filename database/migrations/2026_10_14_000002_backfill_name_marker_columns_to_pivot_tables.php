<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Backfill kolom penanda nama pada tabel pivot (Tahap 3).
 *
 * Mengisi `*_name` yang masih NULL dari tabel sumber, memakai relasi ID
 * yang sudah ada. KODE INI:
 *   - TIDAK pernah meng-INSERT baris baru;
 *   - TIDAK pernah meng-DELETE baris;
 *   - TIDAK pernah mengubah kolom id / role_id / permission_id /
 *     user_id / page_id;
 *   - hanya mengisi kolom penanda yang masih NULL (aman dijalankan
 *     berulang, tidak pernah menimpa penanda yang sudah terisi).
 *
 * ID baris dipungut DAHULU ke memori (pluck) sebelum di-update, karena
 * update akan mengeluarkan baris dari filter `whereNull` sehingga
 * chunk/offset bisa melompati baris.
 *
 * Sumber nilai:
 *   role_permission.role_name          <- roles.name
 *   role_permission.permission_name    <- permissions.name
 *   role_user.user_name                <- users.name
 *   role_user.role_name                <- roles.name
 *   user_has_permissions.user_name     <- users.name
 *   user_has_permissions.permission_name <- permissions.name
 *   page_role.page_name                <- pages.title (bukan `name`)
 *   page_role.role_name                <- roles.name
 *
 * Baris dengan relasi ID tidak valid dibiarkan NULL; secara praktis
 * tidak ada karena foreign key ON DELETE CASCADE.
 */
return new class extends Migration
{
    public function up(): void
    {
        // --- Kamus sumber: id => nama (dibaca sekali, hemat query) ---
        $roles       = DB::table('roles')->pluck('name', 'id');
        $permissions = DB::table('permissions')->pluck('name', 'id');
        $users       = DB::table('users')->pluck('name', 'id');
        $pages       = DB::table('pages')->pluck('title', 'id');

        // --- role_permission: role_name + permission_name ---
        $this->fill(
            'role_permission',
            ['role_name' => $roles, 'permission_name' => $permissions],
            ['role_name' => 'role_id', 'permission_name' => 'permission_id']
        );

        // --- role_user: user_name + role_name ---
        $this->fill(
            'role_user',
            ['user_name' => $users, 'role_name' => $roles],
            ['user_name' => 'user_id', 'role_name' => 'role_id']
        );

        // --- user_has_permissions: user_name + permission_name ---
        $this->fill(
            'user_has_permissions',
            ['user_name' => $users, 'permission_name' => $permissions],
            ['user_name' => 'user_id', 'permission_name' => 'permission_id']
        );

        // --- page_role: page_name (dari pages.title) + role_name ---
        if (DB::getSchemaBuilder()->hasTable('page_role')) {
            $this->fill(
                'page_role',
                ['page_name' => $pages, 'role_name' => $roles],
                ['page_name' => 'page_id', 'role_name' => 'role_id']
            );
        }
    }

    public function down(): void
    {
        // Backfill tidak menyimpan data apa pun, jadi rollback cukup
        // mengembalikan penanda ke NULL. Relasi/ID tidak tersentuh.
        DB::table('role_permission')->update(['role_name' => null, 'permission_name' => null]);
        DB::table('role_user')->update(['user_name' => null, 'role_name' => null]);
        DB::table('user_has_permissions')->update(['user_name' => null, 'permission_name' => null]);

        if (DB::getSchemaBuilder()->hasTable('page_role')) {
            DB::table('page_role')->update(['page_name' => null, 'role_name' => null]);
        }
    }

    /**
     * Isi kolom penanda yang masih NULL untuk SELURUH baris tabel pivot.
     *
     * @param  array<string, \Illuminate\Support\Collection>  $sources  nama kolom penanda => (id sumber => nilai)
     * @param  array<string, string>  $idColumns  nama kolom penanda => kolom FK pembawa ID sumber
     */
    private function fill(string $table, array $sources, array $idColumns): void
    {
        foreach ($sources as $markerColumn => $source) {
            $idColumn = $idColumns[$markerColumn];

            // 1. Kumpulkan ID baris yang masih NULL pada kolom ini
            //    SEBELUM ada update apa pun (hindari offset chunking).
            $rowIds = DB::table($table)->whereNull($markerColumn)->pluck('id');

            // 2. Isi satu per satu dari dictionary sumber.
            foreach ($rowIds as $rowId) {
                $row = DB::table($table)->where('id', $rowId)->first(['id', $idColumn]);

                if ($row === null || $row->{$idColumn} === null) {
                    continue; // relasi tidak ada / tanpa nilai sumber → biarkan NULL
                }

                $value = $source[$row->{$idColumn}] ?? null;

                if ($value !== null) {
                    DB::table($table)->where('id', $rowId)->update([$markerColumn => $value]);
                }
            }
        }
    }
};
