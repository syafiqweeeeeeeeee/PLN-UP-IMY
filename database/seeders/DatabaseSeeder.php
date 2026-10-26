<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            AdminUserSeeder::class,
            MenuSeeder::class,
            MasterMenuSeeder::class,
            KaryawanUserSeeder::class,
            // Master Bidang lebih dulu — WorkLinkSeeder memetakan setiap
            // link khusus ke baris bidangs (bidang_id).
            MasterBidangJabatanSeeder::class,
            WorkLinkSeeder::class,
        ]);

        // firstOrCreate agar seeder aman dijalankan berulang (tidak error duplicate)
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => 'password123']
        );
    }
}
