<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * REVISI AKTOR — hapus Role "Administrator" dari database.
 *
 * Spec RBAC: role yang diizinkan HANYA 3 — Super Admin, Admin Bidang,
 * Karyawan. Role legacy "Administrator" diganti fungsinya oleh
 * "Super Admin" (akses penuh). Migrasi ini:
 *
 *   1. Memastikan role "Super Admin" ada.
 *   2. Memindahkan seluruh akun ber-role "Administrator" (kolom
 *      users.role_id, kolom legacy users.role, dan pivot role_user)
 *      ke role "Super Admin" — akun lama tidak kehilangan akses.
 *   3. Menghapus role "Administrator" (pivot role_user & role_permission
 *      ikut terhapus lewat cascadeOnDelete).
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('roles')) {
            return;
        }

        // 1) Pastikan role "Super Admin" tersedia sebagai pengganti.
        $superAdminId = DB::table('roles')->where('name', 'Super Admin')->value('id');

        if ($superAdminId === null) {
            $superAdminId = DB::table('roles')->insertGetId([
                'name'        => 'Super Admin',
                'description' => 'Super Admin — Sekretariat/Humas, akses penuh seluruh fitur',
                'status'      => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        $administratorId = DB::table('roles')->where('name', 'Administrator')->value('id');

        if ($administratorId === null) {
            return; // Role legacy memang tidak ada — tidak ada yang dihapus.
        }

        // 2) Pindahkan akun-akun legacy ke Super Admin.
        //    a. Kolom users.role_id (pemetaan utama) — hindari duplikat pivot.
        $affectedUserIds = DB::table('users')->where('role_id', $administratorId)->pluck('id');

        DB::table('users')
            ->where('role_id', $administratorId)
            ->update([
                'role_id'    => $superAdminId,
                'role'       => 'Super Admin',
                'updated_at' => now(),
            ]);

        //    b. Pivot role_user: pindahkan binding yang belum ada, hapus duplikat.
        if (Schema::hasTable('role_user')) {
            foreach ($affectedUserIds as $userId) {
                $exists = DB::table('role_user')
                    ->where('user_id', $userId)
                    ->where('role_id', $superAdminId)
                    ->exists();

                if ($exists) {
                    DB::table('role_user')
                        ->where('user_id', $userId)
                        ->where('role_id', $administratorId)
                        ->delete();
                } else {
                    DB::table('role_user')
                        ->where('user_id', $userId)
                        ->where('role_id', $administratorId)
                        ->update(['role_id' => $superAdminId]);
                }
            }

            // Akun yang hanya terikat lewat pivot (tanpa kolom role_id).
            $pivotOnlyUserIds = DB::table('role_user')->where('role_id', $administratorId)->pluck('user_id');

            foreach ($pivotOnlyUserIds as $userId) {
                $exists = DB::table('role_user')
                    ->where('user_id', $userId)
                    ->where('role_id', $superAdminId)
                    ->exists();

                if (! $exists) {
                    DB::table('role_user')
                        ->where('user_id', $userId)
                        ->where('role_id', $administratorId)
                        ->update(['role_id' => $superAdminId]);
                } else {
                    DB::table('role_user')
                        ->where('user_id', $userId)
                        ->where('role_id', $administratorId)
                        ->delete();
                }

                // Kolom legacy users.role ikut dirapikan bila masih "Administrator".
                DB::table('users')
                    ->where('id', $userId)
                    ->where('role', 'Administrator')
                    ->update(['role' => 'Super Admin', 'updated_at' => now()]);
            }
        }

        // 3) Hapus role legacy "Administrator".
        DB::table('roles')->where('id', $administratorId)->delete();
    }

    public function down(): void
    {
        // Rollback best-effort: kembalikan akun Super Admin legacy yang pernah
        // dimigrasi tidak dimungkinkan secara akurat — migrasi ini one-way.
        // Role Administrator dibuat ulang (nonaktif) agar referensi lama tidak error.
        if (Schema::hasTable('roles') && DB::table('roles')->where('name', 'Administrator')->doesntExist()) {
            DB::table('roles')->insert([
                'name'        => 'Administrator',
                'description' => 'Legacy role (dinonaktifkan — digantikan Super Admin)',
                'status'      => false,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
};
