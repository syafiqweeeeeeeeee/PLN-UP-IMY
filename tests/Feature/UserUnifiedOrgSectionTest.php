<?php

namespace Tests\Feature;

use App\Models\Bidang;
use App\Models\Department;
use App\Models\Jabatan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * SECTION "Bidang & Jabatan" pada form Tambah/Edit Pengguna.
 *
 * Kontrak baru (revisi 22 Okt 2026): form hanya meminta TIGA hal —
 * Role Pengguna, Master Bidang, dan Master Jabatan. Level Jabatan,
 * Bidang Utama, dan Sub-Bidang TIDAK lagi dipilih manual:
 *
 * - department (+ department_id) dan sub_department diturunkan dari
 *   baris Master Bidang (kolom department_code / sub_department_code).
 * - level_jabatan diturunkan dari nama Master Jabatan untuk role
 *   Karyawan (Senior Manager / Manager / Asisten / Staff).
 * - Hak akses tetap 100% dari role_id + direct permission; jabatan
 *   bukan role.
 */
class UserUnifiedOrgSectionTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return $this->userWithPermissions(['users.view', 'users.create', 'users.edit']);
    }

    private function role(string $name): Role
    {
        return Role::firstOrCreate(
            ['name' => $name],
            ['description' => $name, 'status' => true]
        );
    }

    private function superAdminActor(): User
    {
        $superAdmin = $this->role('Super Admin');
        $actor = User::factory()->create(['role' => 'Super Admin', 'role_id' => $superAdmin->id]);
        $actor->roles()->sync([$superAdmin->id]);

        return $actor;
    }

    /** Bidang induk dengan kode legacy (hasil pemetaan migrasi). */
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

    /* =========================================================
       1. TAMPILAN — hanya tiga field, tanpa field manual lama
       ========================================================= */

    public function test_create_form_only_shows_role_master_bidang_and_master_jabatan(): void
    {
        $html = $this->actingAs($this->admin())
            ->get(route('admin.users.create'))
            ->assertOk()
            ->getContent();

        // Tepat SATU section "Bidang & Jabatan".
        $this->assertSame(1, substr_count($html, 'form-section-title">Bidang & Jabatan'));
        $this->assertSame(0, substr_count($html, 'form-section-title">Role<'));

        // Field yang WAJIB ada.
        foreach (['role_id', 'bidang_id', 'jabatan_id'] as $field) {
            $this->assertStringContainsString('name="' . $field . '"', $html, "Field {$field} hilang dari form.");
        }

        // Field manual lama TIDAK boleh ada lagi sebagai input.
        foreach (['level_jabatan', 'department', 'sub_department'] as $field) {
            $this->assertStringNotContainsString('name="' . $field . '"', $html, "Field manual {$field} masih ada di form.");
        }

        // Kelompok visual: Akses & Unit Kerja + Master Bidang & Jabatan.
        $this->assertStringContainsString('id="groupAkses"', $html);
        $this->assertStringContainsString('id="masterUnitSection"', $html);
        $this->assertStringNotContainsString('id="groupOrganisasi"', $html);
        $this->assertStringNotContainsString('Level Jabatan (Role Utama)', $html);
    }

    public function test_create_form_has_no_duplicate_section_titles(): void
    {
        $html = $this->actingAs($this->admin())
            ->get(route('admin.users.create'))
            ->assertOk()
            ->getContent();

        $this->assertSame(1, substr_count($html, 'form-section-title">Bidang & Jabatan'));
        $this->assertStringContainsString('id="directPermSection"', $html);
    }

    /* =========================================================
       2. SIMPAN — scoping & level diturunkan otomatis
       ========================================================= */

    public function test_store_derives_scoping_and_level_from_master_selection(): void
    {
        $induk = $this->bidangInduk('BIDANG OPERASI', 'operasi');
        $sub = $this->subBidang($induk, 'SUB BIDANG PRODUKSI A', 'operasi', 'asmen_prod_a');
        $jabatan = Jabatan::create([
            'nama' => 'ASISTEN ANALIS SO TURBIN',
            'bidang_id' => $sub->id,
        ]);

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), [
                'name'           => 'Sari Unified',
                'email'          => 'sari.unified@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $this->role('Karyawan')->id,
                'bidang_id'      => $sub->id,
                'jabatan_id'     => $jabatan->id,
                'no_hp'          => '081234567890',
                'alamat'         => 'Indramayu',
            ])
            ->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'sari.unified@example.com')->firstOrFail();

        // Role tidak berubah.
        $this->assertSame($this->role('Karyawan')->id, $user->role_id);
        $this->assertSame('Karyawan', $user->role);

        // Scoping diturunkan dari Master Bidang (sub-bidang).
        $this->assertSame('operasi', $user->department);
        $this->assertSame('asmen_prod_a', $user->sub_department);
        $this->assertSame(Department::byCode('operasi')->id, $user->department_id);

        // Level diturunkan dari nama Master Jabatan ("ASISTEN …").
        $this->assertSame('asisten_manager', $user->level_jabatan);

        // Master tersimpan apa adanya.
        $this->assertSame($sub->id, $user->bidang_id);
        $this->assertSame($jabatan->id, $user->jabatan_id);
    }

    public function test_store_derives_department_only_when_parent_bidang_is_selected(): void
    {
        $induk = $this->bidangInduk('BIDANG PEMELIHARAAN', 'pemeliharaan');
        $jabatan = Jabatan::create(['nama' => 'MANAGER PEMELIHARAAN', 'bidang_id' => $induk->id]);

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), [
                'name'           => 'Manager Test',
                'email'          => 'manager.pem@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $this->role('Karyawan')->id,
                'bidang_id'      => $induk->id,
                'jabatan_id'     => $jabatan->id,
                'no_hp'          => '081234567890',
                'alamat'         => 'Indramayu',
            ])
            ->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'manager.pem@example.com')->firstOrFail();

        $this->assertSame('pemeliharaan', $user->department);
        // Manager membawahi seluruh sub-bidang → tidak dikunci sub.
        $this->assertNull($user->sub_department);
        $this->assertSame('manager_bidang', $user->level_jabatan);
        $this->assertSame('bidang', $user->dataScopingLevel());
        // Manager Bidang BUKAN bypass global.
        $this->assertFalse($user->bypassesDataScoping());
    }

    /* =========================================================
       3. EDIT — nilai tersimpan termuat & tidak terhapus
       ========================================================= */

    public function test_edit_form_prefills_role_bidang_and_jabatan(): void
    {
        $induk = $this->bidangInduk('BIDANG OPERASI', 'operasi');
        $sub = $this->subBidang($induk, 'SUB BIDANG PRODUKSI A', 'operasi', 'asmen_prod_a');
        $jabatan = Jabatan::create(['nama' => 'ASISTEN ANALIS SO TURBIN', 'bidang_id' => $sub->id]);
        $karyawan = $this->role('Karyawan');

        $user = User::factory()->create([
            'role'           => 'Karyawan',
            'role_id'        => $karyawan->id,
            'level_jabatan'  => 'asisten_manager',
            'department'     => 'operasi',
            'department_id'  => Department::byCode('operasi')->id,
            'sub_department' => 'asmen_prod_a',
            'bidang_id'      => $sub->id,
            'jabatan_id'     => $jabatan->id,
        ]);
        $user->roles()->sync([$karyawan->id]);

        $html = $this->actingAs($this->superAdminActor())
            ->get(route('admin.users.edit', $user))
            ->assertOk()
            ->getContent();

        $this->assertMatchesRegularExpression(
            '/name="role_id"[^>]*>.*?<option value="' . $karyawan->id . '"\s+selected/s',
            $html
        );
        $this->assertMatchesRegularExpression(
            '/name="bidang_id".*?<option value="' . $sub->id . '"[^>]*selected/s',
            $html
        );
        $this->assertMatchesRegularExpression(
            '/name="jabatan_id".*?<option value="' . $jabatan->id . '"[^>]*selected/s',
            $html
        );
    }

    public function test_update_keeps_existing_values_when_form_omits_fields(): void
    {
        $induk = $this->bidangInduk('BIDANG OPERASI', 'operasi');
        $sub = $this->subBidang($induk, 'SUB BIDANG PRODUKSI A', 'operasi', 'asmen_prod_a');
        $jabatan = Jabatan::create(['nama' => 'ASISTEN ANALIS SO TURBIN', 'bidang_id' => $sub->id]);
        $karyawan = $this->role('Karyawan');

        $user = User::factory()->create([
            'role'           => 'Karyawan',
            'role_id'        => $karyawan->id,
            'level_jabatan'  => 'asisten_manager',
            'department'     => 'operasi',
            'department_id'  => Department::byCode('operasi')->id,
            'sub_department' => 'asmen_prod_a',
            'bidang_id'      => $sub->id,
            'jabatan_id'     => $jabatan->id,
        ]);
        $user->roles()->sync([$karyawan->id]);

        // Kirim data akun saja — bidang/jabatan tidak dikirim.
        $this->actingAs($this->superAdminActor())
            ->put(route('admin.users.update', $user), [
                'name'           => $user->name,
                'email'          => $user->email,
                'role_id'        => $karyawan->id,
                'no_hp'          => '081234567890',
                'alamat'         => 'Indramayu',
            ])
            ->assertRedirect(route('admin.users.index'));

        $user->refresh();
        $this->assertSame('operasi', $user->department);
        $this->assertSame(Department::byCode('operasi')->id, $user->department_id);
        $this->assertSame('asmen_prod_a', $user->sub_department);
        $this->assertSame($sub->id, $user->bidang_id);
        $this->assertSame($jabatan->id, $user->jabatan_id);
        $this->assertSame('asisten_manager', $user->level_jabatan);
    }

    /* =========================================================
       4. SCOPING & AKSES — tetap bekerja lewat jembatan master
       ========================================================= */

    public function test_scoping_binding_is_derived_from_master_bidang(): void
    {
        $induk = $this->bidangInduk('BIDANG PEMELIHARAAN', 'pemeliharaan');
        $sub = $this->subBidang($induk, 'SUB BIDANG OUTAGE MANAGEMENT', 'pemeliharaan', 'asmen_mo');

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), [
                'name'           => 'Scope Test',
                'email'          => 'scope.unified@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $this->role('Admin Bidang')->id,
                'bidang_id'      => $sub->id,
                'no_hp'          => '081234567890',
                'alamat'         => 'Indramayu',
            ])
            ->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'scope.unified@example.com')->firstOrFail();

        $this->assertSame('pemeliharaan', $user->bidangCode());
        $this->assertSame($user->department_id, $user->bidangId());
        $this->assertSame('asmen_mo', $user->subBidangId());
        $this->assertSame('bidang_sub', $user->dataScopingLevel());
        $this->assertFalse($user->bypassesDataScoping());
        $this->assertTrue($user->isDepartmentAdmin());
        $this->assertSame($sub->id, $user->bidang_id);

        // Admin Bidang tidak memperoleh level dari jabatan (anti eskalasi).
        $this->assertNull($user->level_jabatan);
    }

    public function test_senior_manager_level_from_master_jabatan_keeps_global_bypass(): void
    {
        $induk = $this->bidangInduk('PLTU KANCI', 'operasi');
        $jabatan = Jabatan::create([
            'nama' => 'SENIOR MANAGER UP INDRAMAYU',
            'bidang_id' => $induk->id,
        ]);

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), [
                'name'           => 'Senior Test',
                'email'          => 'senior.unified@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $this->role('Karyawan')->id,
                'bidang_id'      => $induk->id,
                'jabatan_id'     => $jabatan->id,
                'no_hp'          => '081234567890',
                'alamat'         => 'Indramayu',
            ])
            ->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'senior.unified@example.com')->firstOrFail();

        $this->assertSame('senior_manager', $user->level_jabatan);
        $this->assertTrue($user->bypassesDataScoping());
        $this->assertSame('bypass', $user->dataScopingLevel());
        $this->assertNull($user->sub_department);
    }

    public function test_role_and_permission_flow_unaffected_by_new_section(): void
    {
        $perm = \App\Models\Permission::firstOrCreate(
            ['name' => 'news.view'],
            ['display_name' => 'news.view', 'module' => 'Test']
        );

        $karyawan = $this->role('Karyawan');
        $karyawan->permissions()->syncWithoutDetaching([$perm->id]);

        $induk = $this->bidangInduk('BIDANG OPERASI', 'operasi');

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), [
                'name'           => 'Perm Test',
                'email'          => 'perm.unified@example.com',
                'password'       => 'password123',
                'password_confirmation' => 'password123',
                'role_id'        => $karyawan->id,
                'bidang_id'      => $induk->id,
                'no_hp'          => '081234567890',
                'alamat'         => 'Indramayu',
                'permissions'    => [$perm->id],
            ])
            ->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'perm.unified@example.com')->firstOrFail();

        $this->assertTrue($user->roles()->where('roles.id', $karyawan->id)->exists());
        $this->assertTrue($user->hasPermission('news.view'));
        $this->assertSame($karyawan->id, $user->role_id);
    }
}
