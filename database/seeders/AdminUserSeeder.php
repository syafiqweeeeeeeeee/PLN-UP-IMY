<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Membuat akun Super Admin agar fresh install selalu punya
 * akun login ke dashboard admin.
 *
 * - Idempotent: aman dijalankan berulang (updateOrCreate).
 * - REVISI AKTOR: memakai role "Super Admin" (bukan legacy
 *   "Administrator" yang sudah dihapus dari database).
 * - Role Super Admin dibuat bila belum ada (mis. seeder ini
 *   dipanggil langsung via db:seed --class sebelum PermissionSeeder),
 *   lengkap dengan seluruh permission yang terdaftar.
 * - Email & password dapat dioverride lewat .env:
 *   ADMIN_EMAIL / ADMIN_PASSWORD (wajib diganti di produksi).
 */
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // PermissionSeeder selalu dijalankan (idempotent — firstOrCreate):
        // selain membuat role Super Admin/Admin Bidang/Karyawan bila belum
        // ada, ia juga memastikan seluruh permission terdaftar lalu
        // tersinkron ke role — akun langsung punya akses penuh.
        $this->call(PermissionSeeder::class);

        $superAdmin = Role::where('name', User::SUPER_ADMIN_ROLE)->firstOrFail();

        $email    = config('services.admin.email', 'admin@example.com');
        $password = config('services.admin.password', 'password123');

        $admin = User::updateOrCreate(
            ['email' => $email],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make($password),
                'role'     => $superAdmin->name,
                'role_id'  => $superAdmin->id,
            ]
        );

        // Sistem permission (@can, middleware permission:) membaca dari
        // pivot role_user — pastikan relasinya selalu ada.
        $admin->roles()->syncWithoutDetaching([$superAdmin->id]);

        $this->seedDepartmentAdmins();
    }

    /**
     * RBAC — contoh akun Admin Bidang (delegasi per bidang).
     * Akun terikat satu bidang via users.department_id; hanya bisa
     * mengelola Pengumuman Internal & Link Kerja bidangnya.
     */
    private function seedDepartmentAdmins(): void
    {
        $role = Role::where('name', User::DEPARTMENT_ADMIN_ROLE)->first();

        if (! $role) {
            return; // PermissionSeeder belum jalan → lewati.
        }

        $samples = [
            ['name' => 'Admin Operasi',      'email' => 'admin.operasi@example.com',      'department' => 'operasi'],
            ['name' => 'Admin Pemeliharaan', 'email' => 'admin.pemeliharaan@example.com', 'department' => 'pemeliharaan'],
            ['name' => 'Admin SDM',          'email' => 'admin.sdm@example.com',          'department' => 'business_support'],
        ];

        foreach ($samples as $sample) {
            $departmentId = \App\Models\Department::byCode($sample['department'])?->id;

            $deptAdmin = User::updateOrCreate(
                ['email' => $sample['email']],
                [
                    'name'          => $sample['name'],
                    'password'      => Hash::make(config('services.admin.password', 'password123')),
                    'role'          => $role->name,
                    'role_id'       => $role->id,
                    'department'    => $sample['department'],
                    'department_id' => $departmentId,
                ]
            );

            $deptAdmin->roles()->syncWithoutDetaching([$role->id]);
        }
    }
}
