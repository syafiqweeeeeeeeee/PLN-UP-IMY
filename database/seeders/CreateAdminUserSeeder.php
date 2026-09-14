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
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('12345678'),
                'role'     => 'admin',
            ]
        );

        // Pastikan akun admin terhubung ke role Administrator (pivot role_user),
        // supaya permission seperti activity_logs.view berfungsi.
        $administrator = Role::where('name', 'Administrator')->first();

        if ($administrator) {
            $admin->roles()->syncWithoutDetaching([$administrator->id]);
        }
    }
}
