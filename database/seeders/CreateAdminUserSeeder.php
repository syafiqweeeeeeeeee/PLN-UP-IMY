<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role Administrator ada (PermissionSeeder mungkin belum jalan
        // bila seeder ini dipanggil langsung via db:seed --class).
        $administrator = Role::where('name', 'Administrator')->first();

        if (! $administrator) {
            $this->call(PermissionSeeder::class);
            $administrator = Role::where('name', 'Administrator')->firstOrFail();
        }

        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('12345678'),
                'role'     => 'Administrator',
                'role_id'  => $administrator->id,
            ]
        );

        // Hubungkan ke role Administrator lewat pivot role_user — sistem
        // permission (@can, middleware permission:) membaca dari pivot ini.
        $admin->roles()->syncWithoutDetaching([$administrator->id]);
    }
}
