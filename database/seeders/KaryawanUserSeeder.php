<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Membuat akun Karyawan contoh agar portal karyawan langsung bisa
 * dicoba setelah fresh install / re-seed.
 *
 * - Idempotent: updateOrCreate, aman dijalankan berulang.
 * - Role "Karyawan" dibuat bila belum ada (fallback jika seeder ini
 *   dipanggil langsung tanpa PermissionSeeder).
 */
class KaryawanUserSeeder extends Seeder
{
    public function run(): void
    {
        $karyawan = Role::where('name', 'Karyawan')->first();

        if (! $karyawan) {
            $this->call(PermissionSeeder::class);
            $karyawan = Role::where('name', 'Karyawan')->firstOrFail();
        }

        $user = User::updateOrCreate(
            ['email' => 'opaladzmii@gmail.com'],
            [
                'name'     => 'Naufal Adzmi',
                'password' => Hash::make('karyawan123'),
                'role'     => $karyawan->name,
                'role_id'  => $karyawan->id,
            ]
        );

        // Pivot role_user — dibaca oleh @can & middleware role check.
        $user->roles()->syncWithoutDetaching([$karyawan->id]);
    }
}
