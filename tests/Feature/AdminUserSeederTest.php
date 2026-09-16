<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminUserSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_admin_user_with_administrator_role(): void
    {
        // Role Administrator sudah ada (mis. PermissionSeeder sudah jalan)
        $role = Role::create(['name' => 'Administrator', 'status' => true]);

        $this->seed(AdminUserSeeder::class);

        $admin = User::where('email', 'admin@example.com')->first();

        $this->assertNotNull($admin);
        $this->assertSame('Administrator', $admin->role);
        $this->assertSame($role->id, $admin->role_id);
        $this->assertTrue(Hash::check('password123', $admin->password));

        // Pivot role_user wajib ada — sumber permission @can & middleware
        $this->assertTrue(
            $admin->roles()->where('roles.id', $role->id)->exists()
        );
    }

    public function test_creates_role_and_permissions_when_missing(): void
    {
        // DB kosong total — seeder harus memanggil PermissionSeeder sendiri
        $this->seed(AdminUserSeeder::class);

        $role = Role::where('name', 'Administrator')->first();
        $this->assertNotNull($role);
        $this->assertGreaterThan(0, $role->permissions()->count());

        $admin = User::where('email', 'admin@example.com')->first();
        $this->assertNotNull($admin);

        // Akun langsung punya akses penuh
        $this->assertTrue($admin->hasPermission('dashboard.view'));
        $this->assertTrue($admin->hasPermission('users.delete'));
    }

    public function test_is_idempotent_no_duplicate_admin(): void
    {
        $this->seed(AdminUserSeeder::class);
        $this->seed(AdminUserSeeder::class);

        $this->assertSame(
            1,
            User::where('email', 'admin@example.com')->count()
        );
    }
}
