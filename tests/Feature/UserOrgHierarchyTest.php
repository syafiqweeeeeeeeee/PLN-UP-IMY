<?php

namespace Tests\Feature;

use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Aturan organisasi pada form Tambah Pengguna (revisi 22 Okt 2026).
 *
 * Form hanya meminta Role Pengguna + Master Bidang + Master Jabatan.
 * Kolom legacy yang dipakai filter data diturunkan otomatis:
 *
 * - department (+ department_id) & sub_department ← Master Bidang
 *   (kolom department_code / sub_department_code).
 * - level_jabatan ← nama Master Jabatan (role Karyawan saja):
 *   Senior Manager / Manager Bidang / Asisten Manager / Staff.
 *
 * Aturan yang TETAP berlaku: kuota Super Admin (3), kuota Senior Manager
 * aktif (3), pembersihan unit untuk Super Admin, dan role "Administrator"
 * legacy yang tidak bisa dipilih.
 */
class UserOrgHierarchyTest extends TestCase
{
    use RefreshDatabase;

    /** Admin dengan permission users.create. */
    private function admin(): User
    {
        return $this->userWithPermissions(['users.view', 'users.create', 'users.edit']);
    }

    private function role(string $name = 'Karyawan'): Role
    {
        return Role::firstOrCreate(
            ['name' => $name],
            ['description' => $name, 'status' => true]
        );
    }

    /** Bidang induk dengan kode legacy. */
    private function bidangInduk(string $nama, string $departmentCode): Bidang
    {
        return Bidang::create([
            'nama' => $nama,
            'department_code' => $departmentCode,
        ]);
    }

    /** Sub-bidang dengan kode legacy sendiri. */
    private function subBidang(Bidang $parent, string $nama, string $departmentCode, string $subCode): Bidang
    {
        return Bidang::create([
            'nama' => $nama,
            'parent_id' => $parent->id,
            'department_code' => $departmentCode,
            'sub_department_code' => $subCode,
        ]);
    }

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'name'                  => 'Budi Test',
            'email'                 => 'budi.hierarki@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
            'role_id'               => $this->role()->id,
            'no_hp'                 => '081234567890',
            'alamat'                => 'Indramayu',
        ], $overrides);
    }

    /* =========================================================
       1. FORM — field manual lama sudah tidak ada
       ========================================================= */

    public function test_create_form_does_not_render_legacy_hierarchy_dropdowns(): void
    {
        $this->actingAs($this->admin())
            ->get(route('admin.users.create'))
            ->assertOk()
            ->assertDontSee('name="level_jabatan"', false)
            ->assertDontSee('name="department"', false)
            ->assertDontSee('name="sub_department"', false)
            ->assertSee('name="role_id"', false)
            ->assertSee('name="bidang_id"', false)
            ->assertSee('name="jabatan_id"', false);
    }

    /* =========================================================
       2. LEVEL JABATAN — diturunkan dari nama Master Jabatan
       ========================================================= */

    public function test_level_is_derived_from_master_jabatan_name(): void
    {
        $this->assertSame('senior_manager', User::levelJabatanFromJabatanName('SENIOR MANAGER UP INDRAMAYU'));
        $this->assertSame('manager_bidang', User::levelJabatanFromJabatanName('MANAGER ENJINIRING & QA'));
        $this->assertSame('asisten_manager', User::levelJabatanFromJabatanName('ASMAN  SYSTEM OWNER COMMON AUX'));
        $this->assertSame('asisten_manager', User::levelJabatanFromJabatanName('ASISTEN ANALIS SO TURBIN'));
        $this->assertSame('staf', User::levelJabatanFromJabatanName('STAF TEKNIK'));
        $this->assertSame('staf', User::levelJabatanFromJabatanName(null));
    }

    public function test_store_saves_hierarchy_derived_from_master_unit(): void
    {
        $induk = $this->bidangInduk('BIDANG OPERASI', 'operasi');
        $sub = $this->subBidang($induk, 'SUB BIDANG CHCB A', 'operasi', 'spv_chcb_a');
        $jabatan = Jabatan::create(['nama' => 'STAF TEKNIK', 'bidang_id' => $sub->id]);

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), $this->payload([
                'bidang_id' => $sub->id,
                'jabatan_id' => $jabatan->id,
            ]))
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'email'          => 'budi.hierarki@example.com',
            'level_jabatan'  => 'staf',
            'department'     => 'operasi',
            'sub_department' => 'spv_chcb_a',
        ]);
    }

    public function test_store_manager_bidang_clears_sub_department(): void
    {
        $induk = $this->bidangInduk('BIDANG OPERASI', 'operasi');
        $sub = $this->subBidang($induk, 'SUB BIDANG CHCB A', 'operasi', 'spv_chcb_a');
        $jabatan = Jabatan::create(['nama' => 'MANAGER OPERASI', 'bidang_id' => $sub->id]);

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), $this->payload([
                'bidang_id' => $sub->id,
                'jabatan_id' => $jabatan->id,
            ]))
            ->assertRedirect(route('admin.users.index'));

        // Manager membawahi seluruh sub-bidang → sub dikosongkan server.
        $this->assertDatabaseHas('users', [
            'email'          => 'budi.hierarki@example.com',
            'level_jabatan'  => 'manager_bidang',
            'department'     => 'operasi',
            'sub_department' => null,
        ]);
    }

    public function test_store_senior_manager_has_global_access(): void
    {
        $induk = $this->bidangInduk('BIDANG OPERASI', 'operasi');
        $jabatan = Jabatan::create(['nama' => 'SENIOR MANAGER UP INDRAMAYU', 'bidang_id' => $induk->id]);

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), $this->payload([
                'bidang_id' => $induk->id,
                'jabatan_id' => $jabatan->id,
            ]))
            ->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'budi.hierarki@example.com')->firstOrFail();

        $this->assertSame('senior_manager', $user->level_jabatan);
        $this->assertNull($user->sub_department);
        $this->assertTrue($user->bypassesDataScoping());
        $this->assertSame('bypass', $user->dataScopingLevel());
    }

    public function test_store_senior_manager_blocked_after_quota_reached(): void
    {
        $induk = $this->bidangInduk('BIDANG OPERASI', 'operasi');
        $jabatan = Jabatan::create(['nama' => 'SENIOR MANAGER UP INDRAMAYU', 'bidang_id' => $induk->id]);

        User::factory()->count(3)->create([
            'role'           => 'Karyawan',
            'role_id'        => $this->role()->id,
            'level_jabatan'  => 'senior_manager',
        ]);

        $this->assertSame(3, User::seniorManagerAccountCount());

        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), $this->payload([
                'email' => 'senior.keempat@example.com',
                'bidang_id' => $induk->id,
                'jabatan_id' => $jabatan->id,
            ]))
            ->assertSessionHasErrors('jabatan_id');

        $this->assertDatabaseMissing('users', ['email' => 'senior.keempat@example.com']);
    }

    public function test_senior_manager_quota_ignores_inactive_accounts(): void
    {
        $induk = $this->bidangInduk('BIDANG OPERASI', 'operasi');
        $jabatan = Jabatan::create(['nama' => 'SENIOR MANAGER UP INDRAMAYU', 'bidang_id' => $induk->id]);

        // Akun Senior Manager NONAKTIF tidak memakan slot kuota.
        User::factory()->count(3)->create([
            'role'              => 'Karyawan',
            'role_id'           => $this->role()->id,
            'level_jabatan'     => 'senior_manager',
            'email_verified_at' => null,
        ]);

        $this->assertSame(0, User::seniorManagerAccountCount());

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), $this->payload([
                'email' => 'senior.aktif@example.com',
                'bidang_id' => $induk->id,
                'jabatan_id' => $jabatan->id,
            ]))
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', ['email' => 'senior.aktif@example.com']);
    }

    /* =========================================================
       3. INPUT LEGACY DIABAIKAN — anti manipulasi
       ========================================================= */

    public function test_manually_posted_legacy_fields_are_ignored(): void
    {
        $induk = $this->bidangInduk('BIDANG OPERASI', 'operasi');

        // Payload mengirim level/department/sub manual + bidang master.
        // Server WAJIB memakai turunan Master Bidang/Jabatan, bukan kiriman.
        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), $this->payload([
                'bidang_id'      => $induk->id,
                'level_jabatan'  => 'senior_manager',
                'department'     => 'engineering',
                'sub_department' => 'asmen_so',
            ]))
            ->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'budi.hierarki@example.com')->firstOrFail();

        $this->assertSame('operasi', $user->department);
        $this->assertNull($user->sub_department);
        // Tanpa jabatan → level default staff, BUKAN senior_manager.
        $this->assertSame('staf', $user->level_jabatan);
        $this->assertFalse($user->bypassesDataScoping());
    }

    /* =========================================================
       4. ROLE & KUOTA
       ========================================================= */

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
        $this->administratorRole();

        $this->actingAs($this->admin())
            ->get(route('admin.users.create'))
            ->assertOk()
            ->assertSee('Super Admin', false)
            ->assertSee('Admin Bidang', false)
            ->assertSee('Karyawan', false)
            ->assertDontSee('<option value="' . $this->administratorRole()->id . '"', false);
    }

    public function test_store_rejects_non_assignable_role(): void
    {
        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), $this->payload([
                'email' => 'legacy.admin@example.com',
                'role_id' => $this->administratorRole()->id,
            ]))
            ->assertSessionHasErrors('role_id');

        $this->assertDatabaseMissing('users', ['email' => 'legacy.admin@example.com']);
    }

    public function test_store_super_admin_clears_all_hierarchy_fields(): void
    {
        $superAdmin = $this->role('Super Admin');
        $induk = $this->bidangInduk('BIDANG OPERASI', 'operasi');
        $jabatan = Jabatan::create(['nama' => 'SENIOR MANAGER UP INDRAMAYU', 'bidang_id' => $induk->id]);

        // Field unit tersembunyi untuk Super Admin; nilai kiriman via API
        // tetap dibersihkan server.
        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), $this->payload([
                'email'          => 'pak.super@example.com',
                'role_id'        => $superAdmin->id,
                'level_jabatan'  => 'senior_manager',
                'department'     => 'operasi',
                'sub_department' => 'spv_chcb_a',
                'bidang_id'      => $induk->id,
                'jabatan_id'     => $jabatan->id,
            ]))
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'email'          => 'pak.super@example.com',
            'level_jabatan'  => null,
            'department'     => null,
            'sub_department' => null,
            'bidang_id'      => null,
            'jabatan_id'     => null,
        ]);
    }

    public function test_store_admin_bidang_requires_master_bidang(): void
    {
        $adminBidang = $this->role('Admin Bidang');

        // Master bidangs terisi → bidang wajib untuk Admin Bidang.
        $this->bidangInduk('BIDANG ENJINIRING', 'engineering');

        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), $this->payload([
                'email' => 'dewi.admin.bidang@example.com',
                'role_id' => $adminBidang->id,
            ]))
            ->assertSessionHasErrors('bidang_id');

        // Dengan Master Bidang → sukses; level tetap null (bukan dari
        // jabatan) agar tidak ada eskalasi bypass global.
        $induk = $this->bidangInduk('BIDANG PEMELIHARAAN', 'pemeliharaan');
        $sub = $this->subBidang($induk, 'SUB BIDANG OUTAGE MANAGEMENT', 'pemeliharaan', 'asmen_mo');

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), $this->payload([
                'email' => 'dewi.admin.bidang@example.com',
                'role_id' => $adminBidang->id,
                'level_jabatan' => 'senior_manager', // diabaikan
                'bidang_id' => $sub->id,
            ]))
            ->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'dewi.admin.bidang@example.com')->firstOrFail();

        $this->assertNull($user->level_jabatan);
        $this->assertSame('pemeliharaan', $user->department);
        $this->assertSame('asmen_mo', $user->sub_department);
        $this->assertNotNull($user->department_id);
    }

    public function test_store_super_admin_blocked_after_quota_reached(): void
    {
        $superAdmin = $this->role('Super Admin');

        User::factory()->count(3)->create([
            'role'    => 'Super Admin',
            'role_id' => $superAdmin->id,
        ]);

        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), $this->payload([
                'email' => 'super.keempat@example.com',
                'role_id' => $superAdmin->id,
            ]))
            ->assertSessionHasErrors('role_id');

        $this->assertSame(3, User::superAdminAccountCount());
        $this->assertDatabaseMissing('users', ['email' => 'super.keempat@example.com']);
    }

    public function test_super_admin_quota_counts_legacy_administrator_accounts(): void
    {
        $administrator = $this->administratorRole();

        User::factory()->count(3)->create([
            'role'    => 'Administrator',
            'role_id' => $administrator->id,
        ]);

        $this->assertSame(3, User::superAdminAccountCount());
    }
}
