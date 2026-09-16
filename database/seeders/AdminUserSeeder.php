<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Membuat akun Administrator agar fresh install selalu punya
 * akun login ke dashboard admin.
 *
 * - Idempotent: aman dijalankan berulang (updateOrCreate).
 * - Role Administrator dibuat bila belum ada (mis. seeder ini
 *   dipanggil langsung via db:seed --class sebelum PermissionSeeder),
 *   lengkap dengan seluruh permission yang terdaftar.
 * - Email & password dapat dioverride lewat .env:
 *   ADMIN_EMAIL / ADMIN_PASSWORD (wajib diganti di produksi).
 */
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $administrator = Role::where('name', 'Administrator')->first();

        if (! $administrator) {
            // Role belum ada (PermissionSeeder belum jalan) — buat
            // lengkap dengan seluruh permission agar akun langsung
            // punya akses penuh.
            $this->call(PermissionSeeder::class);
            $administrator = Role::where('name', 'Administrator')->firstOrFail();
        }

        $email    = config('services.admin.email', 'admin@example.com');
        $password = config('services.admin.password', 'password123');

        $admin = User::updateOrCreate(
            ['email' => $email],
            [
                'name'     => 'Administrator',
                'password' => Hash::make($password),
                'role'     => $administrator->name,
                'role_id'  => $administrator->id,
            ]
        );

        // Sistem permission (@can, middleware permission:) membaca dari
        // pivot role_user — pastikan relasinya selalu ada.
        $admin->roles()->syncWithoutDetaching([$administrator->id]);
    }
}
