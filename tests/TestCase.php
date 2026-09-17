<?php

namespace Tests;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Environment variables level OS di Windows/Laragon (mis. APP_ENV=local,
     * DB_DATABASE=pln_up_imy) masuk ke $_SERVER dan diprioritaskan phpdotenv
     * di atas $_ENV yang diisi phpunit.xml — sehingga konfigurasi test tidak
     * pernah diterapkan dan test bisa menyusup ke database development.
     *
     * Fix: sinkronkan semua <env> dari phpunit.xml ke $_SERVER (dan $_ENV)
     * sebelum aplikasi boot, agar test selalu memakai konfigurasi test.
     */
    public function createApplication()
    {
        $phpunitXml = simplexml_load_file(dirname(__DIR__) . '/phpunit.xml');

        foreach ($phpunitXml->xpath('//env') as $env) {
            $name  = (string) $env['name'];
            $value = (string) $env['value'];

            $_ENV[$name]    = $value;
            $_SERVER[$name] = $value;
        }

        return parent::createApplication();
    }

    /**
     * Buat user dengan role berisi permission tertentu (untuk test RBAC).
     * Role dibuat unik per pemanggilan agar tidak saling menimpa.
     *
     * @param  array<int, string>  $permissions
     * @param  array<string, mixed>  $attributes
     */
    protected function userWithPermissions(array $permissions, array $attributes = []): User
    {
        $role = Role::create([
            'name'        => 'Role Uji ' . uniqid(),
            'description' => 'Role otomatis untuk test',
            'status'      => true,
        ]);

        foreach ($permissions as $permission) {
            $perm = Permission::firstOrCreate(
                ['name' => $permission],
                ['display_name' => $permission, 'module' => 'Test']
            );
            $role->permissions()->attach($perm->id);
        }

        $user = User::factory()->create($attributes);
        $user->roles()->attach($role->id);

        return $user;
    }
}
