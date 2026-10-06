<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Hirarki Organisasi & aturan Role pada form Tambah Pengguna:
 * - level_jabatan, department, sub_department tersimpan di tabel users.
 * - Dropdown Role Pengguna HANYA berisi 3 aktor: Super Admin, Admin
 *   Bidang, Karyawan (role "Administrator" dihapus dari opsi).
 * - Kuota Super Admin: maksimal 3 akun di database.
 * - Field kondisional mengikuti ROLE terpilih:
 *   * Super Admin → seluruh field hirarki dikosongkan.
 *   * Admin Bidang → Level Jabatan disembunyikan/dikosongkan; Bidang
 *     Utama & Sub-Bidang wajib (dependent dropdown).
 *   * Karyawan → ketiga field tampil; Level Jabatan HANYA 4 tingkat
 *     (Senior Manager, Manager Bidang, Asisten Manager, Staff):
 *     - Senior Manager → department & sub_department DISEMBUNYIKAN total;
 *       backend memaksa keduanya null (ALL) otomatis. Kuota: maksimal 3
 *       akun Senior Manager AKTIF di database.
 *     - Manager Bidang → department wajib; sub_department DISEMBUNYIKAN
 *       (membawahi seluruh sub-bidang) → nilai terkirim dipaksa null.
 *     - Asisten Manager / Staff → department & sub_department wajib.
 */
class UserOrgHierarchyTest extends TestCase
{
    use RefreshDatabase;

    /** Admin dengan permission users.create (edit fitur dihapus, hanya toggle). */
    private function admin(): User
    {
        return $this->userWithPermissions(['users.view', 'users.create', 'users.edit']);
    }

    /**
     * Role "Karyawan" — satu-satunya role yang membawa data hirarki
     * (level_jabatan/department/sub_department) pada form pengguna.
     */
    private function role(): Role
    {
        return Role::firstOrCreate(
            ['name' => 'Karyawan'],
            ['description' => 'Pengguna internal / karyawan', 'status' => true]
        );
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

    public function test_create_form_level_jabatan_has_only_four_levels(): void
    {
        $this->actingAs($this->admin())
            ->get(route('admin.users.create'))
            ->assertOk()
            // 4 tingkat baru wajib tersedia sebagai opsi dropdown.
            ->assertSee('<option value="senior_manager">', false)
            ->assertSee('<option value="manager_bidang">', false)
            ->assertSee('<option value="asisten_manager">', false)
            ->assertSee('<option value="staf">Staff</option>', false)
            // Opsi lama tidak lagi tersedia di dropdown.
            ->assertDontSee('<option value="administrator">', false)
            ->assertDontSee('<option value="staf_spv">', false);
    }

    public function test_store_saves_hierarchy_for_staf(): void
    {
        $response = $this->actingAs($this->admin())
            ->post(route('admin.users.store'), [
                'name'           => 'Budi Staf',
                'email'          => 'budi.staf@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $this->role()->id,
                'level_jabatan'  => 'staf',
                'department'     => 'operasi',
                'sub_department' => 'spv_chcb_a',
            ]);

        $response->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'email'          => 'budi.staf@example.com',
            'level_jabatan'  => 'staf',
            'department'     => 'operasi',
            'sub_department' => 'spv_chcb_a',
        ]);
    }

    public function test_store_manager_bidang_requires_department_and_sub_hidden(): void
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

        // Dengan department (sub disembunyikan) → sukses; sub_department
        // dipaksa NULL walau dikirim via API — Manager membawahi seluruh
        // sub-bidang bidangnya.
        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), [
                'name'          => 'Rina Manager',
                'email'         => 'rina.manager@example.com',
                'password'      => 'password123',
                'password_confirmation' => 'password123',
                'role_id'       => $this->role()->id,
                'level_jabatan' => 'manager_bidang',
                'department'    => 'operasi',
                'sub_department' => 'spv_chcb_a',
            ]);

        $this->assertDatabaseHas('users', [
            'email'         => 'rina.manager@example.com',
            'level_jabatan' => 'manager_bidang',
            'department'    => 'operasi',
            'sub_department' => null,
        ]);
    }

    public function test_store_senior_manager_forces_null_department_and_sub(): void
    {
        // Senior Manager (akses global view-only semua bidang): Bidang
        // Utama & Sub-Bidang disembunyikan total dari form → keduanya
        // dipaksa NULL (ALL) otomatis walau dikirim via API.
        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), [
                'name'           => 'Pak Senio',
                'email'          => 'senior.manager@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $this->role()->id,
                'level_jabatan'  => 'senior_manager',
                'department'     => 'operasi',
                'sub_department' => 'spv_chcb_a',
            ])
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'email'          => 'senior.manager@example.com',
            'level_jabatan'  => 'senior_manager',
            'department'     => null,
            'sub_department' => null,
        ]);
    }

    public function test_store_senior_manager_blocked_after_quota_reached(): void
    {
        // Isi kuota: 3 akun Senior Manager AKTIF sudah ada di database.
        User::factory()->count(3)->create([
            'role'           => 'Karyawan',
            'role_id'        => $this->role()->id,
            'level_jabatan'  => 'senior_manager',
        ]);

        $this->assertSame(3, User::seniorManagerAccountCount());

        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), [
                'name'           => 'Senior Keempat',
                'email'          => 'senior.keempat@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $this->role()->id,
                'level_jabatan'  => 'senior_manager',
            ])
            ->assertSessionHasErrors('level_jabatan');

        $this->assertDatabaseMissing('users', ['email' => 'senior.keempat@example.com']);
    }

    public function test_senior_manager_quota_ignores_inactive_accounts(): void
    {
        // Akun Senior Manager NONAKTIF (email belum terverifikasi) tidak
        // memakan slot kuota — hanya akun AKTIF yang dihitung.
        User::factory()->count(3)->create([
            'role'              => 'Karyawan',
            'role_id'           => $this->role()->id,
            'level_jabatan'     => 'senior_manager',
            'email_verified_at' => null,
        ]);

        $this->assertSame(0, User::seniorManagerAccountCount());

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), [
                'name'           => 'Senior Aktif',
                'email'          => 'senior.aktif@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $this->role()->id,
                'level_jabatan'  => 'senior_manager',
            ])
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', ['email' => 'senior.aktif@example.com']);
    }

    public function test_store_staf_requires_sub_department(): void
    {
        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), [
                'name'          => 'Sinta Staf',
                'email'         => 'sinta.staf@example.com',
                'password'      => 'password123',
                'password_confirmation' => 'password123',
                'role_id'       => $this->role()->id,
                'level_jabatan' => 'staf',
                'department'    => 'operasi',
                // sub_department tidak diisi → wajib, gagal.
            ])
            ->assertSessionHasErrors('sub_department');
    }

    public function test_store_rejects_legacy_level_jabatan_value(): void
    {
        // Level lama ('administrator' / 'staf_spv') tidak lagi valid di form.
        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), [
                'name'          => 'Akun Level Lama',
                'email'         => 'level.lama@example.com',
                'password'      => 'password123',
                'password_confirmation' => 'password123',
                'role_id'       => $this->role()->id,
                'level_jabatan' => 'staf_spv',
                'department'    => 'operasi',
                'sub_department' => 'spv_chcb_a',
            ])
            ->assertSessionHasErrors('level_jabatan');
    }

    /** Role "Administrator" (legacy) — tidak lagi dapat dipilih. */
    private function administratorRole(): Role
    {
        return Role::firstOrCreate(
            ['name' => 'Administrator'],
            ['description' => 'Akses penuh sistem', 'status' => true]
        );
    }

    public function test_create_form_offers_only_three_assignable_roles(): void
    {
        $this->administratorRole(); // role legacy harus TIDAK muncul di dropdown.

        $this->actingAs($this->admin())
            ->get(route('admin.users.create'))
            ->assertOk()
            ->assertSee('Super Admin', false)
            ->assertSee('Admin Bidang', false)
            ->assertSee('Karyawan', false)
            // Opsi role "Administrator" tidak ikut ter-render (id role
            // legacy tidak ada sebagai value option mana pun).
            ->assertDontSee('<option value="' . $this->administratorRole()->id . '"', false);
    }

    public function test_store_rejects_non_assignable_role(): void
    {
        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), [
                'name'          => 'Akun Legacy',
                'email'         => 'legacy.admin@example.com',
                'password'      => 'password123',
                'password_confirmation' => 'password123',
                'role_id'       => $this->administratorRole()->id,
                'level_jabatan' => 'administrator',
            ])
            ->assertSessionHasErrors('role_id');

        $this->assertDatabaseMissing('users', ['email' => 'legacy.admin@example.com']);
    }

    public function test_store_super_admin_clears_all_hierarchy_fields(): void
    {
        $superAdmin = Role::firstOrCreate(
            ['name' => 'Super Admin'],
            ['description' => 'Super Admin', 'status' => true]
        );

        // Field hirarki tersembunyi di UI, tetapi nilai terkirim via API
        // tetap harus dibersihkan server.
        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), [
                'name'           => 'Pak Super',
                'email'          => 'pak.super@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $superAdmin->id,
                'level_jabatan'  => 'senior_manager',
                'department'     => 'operasi',
                'sub_department' => 'spv_chcb_a',
            ])
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'email'          => 'pak.super@example.com',
            'level_jabatan'  => null,
            'department'     => null,
            'sub_department' => null,
        ]);
    }

    public function test_store_admin_bidang_requires_department_and_sub_department(): void
    {
        $adminBidang = Role::firstOrCreate(
            ['name' => 'Admin Bidang'],
            ['description' => 'Admin Bidang', 'status' => true]
        );

        // Bidang Utama & Sub-Bidang wajib → tanpa keduanya validasi gagal.
        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), [
                'name'           => 'Dewi Admin Bidang',
                'email'          => 'dewi.admin.bidang@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $adminBidang->id,
            ])
            ->assertSessionHasErrors(['department', 'sub_department']);

        // Dengan department + sub → sukses; level dipaksa null walau dikirim.
        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), [
                'name'           => 'Dewi Admin Bidang',
                'email'          => 'dewi.admin.bidang@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $adminBidang->id,
                'level_jabatan'  => 'senior_manager',
                'department'     => 'engineering',
                'sub_department' => 'asmen_so',
            ])
            ->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'dewi.admin.bidang@example.com')->firstOrFail();

        $this->assertNull($user->level_jabatan);
        $this->assertSame('engineering', $user->department);
        $this->assertSame('asmen_so', $user->sub_department);
        $this->assertNotNull($user->department_id);
    }

    public function test_store_super_admin_blocked_after_quota_reached(): void
    {
        $superAdmin = Role::firstOrCreate(
            ['name' => 'Super Admin'],
            ['description' => 'Super Admin', 'status' => true]
        );

        // Isi kuota: 3 akun Super Admin sudah ada di database.
        User::factory()->count(3)->create([
            'role'    => 'Super Admin',
            'role_id' => $superAdmin->id,
        ]);

        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), [
                'name'           => 'Super Keempat',
                'email'          => 'super.keempat@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $superAdmin->id,
            ])
            ->assertSessionHasErrors('role_id');

        $this->assertSame(3, User::superAdminAccountCount());
        $this->assertDatabaseMissing('users', ['email' => 'super.keempat@example.com']);
    }

    public function test_super_admin_quota_counts_legacy_administrator_accounts(): void
    {
        $administrator = $this->administratorRole();

        // Akun legacy "Administrator" diperlakukan setara Super Admin.
        User::factory()->count(3)->create([
            'role'    => 'Administrator',
            'role_id' => $administrator->id,
        ]);

        $this->assertSame(3, User::superAdminAccountCount());
    }

}
