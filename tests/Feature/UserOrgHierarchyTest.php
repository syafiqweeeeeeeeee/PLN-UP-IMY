<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Hirarki Organisasi pada form Tambah/Edit Pengguna:
 * - level_jabatan, department, sub_department tersimpan di tabel users.
 * - Validasi kondisional per level jabatan:
 *   * Administrator / Senior Manager → department & sub_department dikosongkan (akses global).
 *   * Manager Bidang → department wajib, sub_department dikosongkan.
 *   * Supervisor / Asisten Manager / Staf → department & sub_department wajib.
 */
class UserOrgHierarchyTest extends TestCase
{
    use RefreshDatabase;

    /** Admin dengan permission users.create (edit fitur dihapus, hanya toggle). */
    private function admin(): User
    {
        return $this->userWithPermissions(['users.view', 'users.create', 'users.edit']);
    }

    /** Role aktif apa pun untuk dropdown role_id (nama unik per pemanggilan). */
    private function role(): Role
    {
        return Role::create(['name' => 'Role Uji Hirarki ' . uniqid(), 'status' => true]);
    }

    public function test_create_form_renders_three_hierarchy_dropdowns(): void
    {
        $this->actingAs($this->admin())
            ->get(route('admin.users.create'))
            ->assertOk()
            ->assertSee('name="level_jabatan"', false)
            ->assertSee('name="department"', false)
            ->assertSee('name="sub_department"', false)
            ->assertSee('Asisten Manager Prod A')
            ->assertSee('Supervisor CHCB D');
    }

    public function test_store_saves_hierarchy_for_staf_spv(): void
    {
        $response = $this->actingAs($this->admin())
            ->post(route('admin.users.store'), [
                'name'           => 'Budi Spv',
                'email'          => 'budi.spv@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $this->role()->id,
                'level_jabatan'  => 'staf_spv',
                'department'     => 'operasi',
                'sub_department' => 'spv_chcb_a',
            ]);

        $response->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'email'          => 'budi.spv@example.com',
            'level_jabatan'  => 'staf_spv',
            'department'     => 'operasi',
            'sub_department' => 'spv_chcb_a',
        ]);
    }

    public function test_store_manager_bidang_requires_department_and_clears_sub(): void
    {
        // Department wajib → tanpa department validasi gagal.
        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), [
                'name'          => 'Rina Manager',
                'email'         => 'rina.manager@example.com',
                'password'      => 'password123',
                'password_confirmation' => 'password123',
                'role_id'       => $this->role()->id,
                'level_jabatan' => 'manager_bidang',
                'sub_department' => 'spv_chcb_a',
            ])
            ->assertSessionHasErrors('department');

        // Dengan department → sukses, sub_department dipaksa null.
        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), [
                'name'          => 'Rina Manager',
                'email'         => 'rina.manager@example.com',
                'password'      => 'password123',
                'password_confirmation' => 'password123',
                'role_id'       => $this->role()->id,
                'level_jabatan' => 'manager_bidang',
                'department'    => 'operasi',
            ]);

        $this->assertDatabaseHas('users', [
            'email'         => 'rina.manager@example.com',
            'level_jabatan' => 'manager_bidang',
            'department'    => 'operasi',
            'sub_department' => null,
        ]);
    }

    public function test_store_senior_manager_clears_department_and_sub(): void
    {
        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), [
                'name'           => 'Pak Senio',
                'email'          => 'senior.manager@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $this->role()->id,
                'level_jabatan'  => 'senior_manager',
                // Nilai terkirim walau field disabled di UI (mis. via API) → harus dibersihkan server.
                'department'     => 'operasi',
                'sub_department' => 'spv_chcb_a',
            ]);

        $this->assertDatabaseHas('users', [
            'email'          => 'senior.manager@example.com',
            'level_jabatan'  => 'senior_manager',
            'department'     => null,
            'sub_department' => null,
        ]);
    }

    public function test_store_staf_spv_requires_sub_department(): void
    {
        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), [
                'name'          => 'Sinta Staf',
                'email'         => 'sinta.staf@example.com',
                'password'      => 'password123',
                'password_confirmation' => 'password123',
                'role_id'       => $this->role()->id,
                'level_jabatan' => 'staf_spv',
                'department'    => 'operasi',
                // sub_department tidak diisi → wajib, gagal.
            ])
            ->assertSessionHasErrors('sub_department');
    }

}
