<?php

namespace Tests\Feature;

use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Integrasi MASTER Bidang & Jabatan (tabel bidangs & jabatans) ke fitur
 * Tambah/Edit Pengguna:
 * - Dropdown Bidang & Jabatan bersumber dari tabel master (bukan
 *   konstanta RBAC User::DEPARTMENTS / departments).
 * - Relasi disimpan sebagai ID (users.bidang_id → bidangs.id,
 *   users.jabatan_id → jabatans.id).
 * - Jabatan mengikuti bidang terpilih (dependent): jabatan_id divalidasi
 *   harus berada di bawah bidang_id yang sama.
 * - Kewajiban: role Karyawan & Admin Bidang wajib memilih bidang (jabatan
 *   wajib bila bidangnya punya daftar jabatan); role lain opsional.
 * - Role tetap penentu hak akses — jabatan TIDAK memengaruhi role,
 *   permission, grup (pivot role_user), status akun, maupun reset
 *   password.
 */
class UserMasterBidangJabatanTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return $this->userWithPermissions(['users.view', 'users.create', 'users.edit']);
    }

    /**
     * Super Admin actor — satu-satunya yang boleh mengubah role &
     * field terkait (hirarki RBAC + master bidang/jabatan) saat update.
     */
    private function superAdminActor(): User
    {
        $role = $this->superAdminRole();

        $user = User::factory()->create([
            'role'    => 'Super Admin',
            'role_id' => $role->id,
        ]);
        $user->roles()->sync([$role->id]);

        return $user;
    }

    private function karyawanRole(): Role
    {
        return Role::firstOrCreate(
            ['name' => 'Karyawan'],
            ['description' => 'Pengguna internal / karyawan', 'status' => true]
        );
    }

    private function superAdminRole(): Role
    {
        return Role::firstOrCreate(
            ['name' => 'Super Admin'],
            ['description' => 'Super Admin', 'status' => true]
        );
    }

    private function adminBidangRole(): Role
    {
        return Role::firstOrCreate(
            ['name' => 'Admin Bidang'],
            ['description' => 'Admin Bidang', 'status' => true]
        );
    }

    /**
     * Pasangan bidang + jabatan di bawahnya (untuk test dependent).
     * Bidang induk diberi kode legacy agar muncul di dropdown form
     * (hanya bidang dengan padanan scoping yang bisa dipilih).
     */
    private function masterPair(): array
    {
        $bidang = Bidang::create([
            'nama' => 'BIDANG OPERASI',
            'department_code' => 'operasi',
        ]);
        $jabatan = Jabatan::create(['nama' => 'MANAGER OPERASI', 'bidang_id' => $bidang->id]);

        return [$bidang, $jabatan];
    }

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'name'                 => 'Budi Master',
            'email'                => 'budi.master@example.com',
            'password'             => 'password123',
            'password_confirmation' => 'password123',
            'role_id'              => $this->karyawanRole()->id,
            'no_hp'                => '081234567890',
            'alamat'               => 'Indramayu',
        ], $overrides);
    }

    public function test_create_form_renders_master_bidang_and_jabatan_dropdowns(): void
    {
        [$bidang, $jabatan] = $this->masterPair();

        $this->actingAs($this->admin())
            ->get(route('admin.users.create'))
            ->assertOk()
            ->assertSee('name="bidang_id"', false)
            ->assertSee('name="jabatan_id"', false)
            // Opsi dropdown berasal dari tabel master.
            ->assertSee($bidang->nama)
            ->assertSee($jabatan->nama);
    }

    public function test_create_form_shows_mapped_master_rows_even_before_legacy_codes_are_backfilled(): void
    {
        // Kondisi database lama/aktif: baris master ada, tetapi kolom
        // department_code dan sub_department_code belum diisi.
        $induk = Bidang::create(['nama' => 'BIDANG OPERASI']);
        $sub = Bidang::create([
            'nama' => 'SUB BIDANG PRODUKSI A',
            'parent_id' => $induk->id,
        ]);
        $unknown = Bidang::create(['nama' => 'BIDANG UJI TANPA PADANAN']);
        $jabatanInduk = Jabatan::create(['nama' => 'MANAGER OPERASI', 'bidang_id' => $induk->id]);
        $jabatanSub = Jabatan::create(['nama' => 'ASISTEN PRODUKSI A', 'bidang_id' => $sub->id]);

        $response = $this->actingAs($this->admin())->get(route('admin.users.create'))->assertOk();
        $html = $response->getContent();
        $bidangOptions = $response->viewData('bidangs');
        $jabatans = $response->viewData('jabatans');

        $this->assertTrue($bidangOptions->contains('id', $induk->id));
        $this->assertTrue($bidangOptions->contains('id', $sub->id));
        $this->assertFalse($bidangOptions->contains('id', $unknown->id), 'Bidang akar tanpa pemetaan aman tidak boleh membuat akun tanpa scope.');
        $this->assertStringContainsString('value="' . $induk->id . '"', $html);
        $this->assertStringContainsString('value="' . $sub->id . '"', $html);
        $this->assertTrue($jabatans->contains('id', $jabatanInduk->id));
        $this->assertTrue($jabatans->contains('id', $jabatanSub->id));
        $this->assertSame('operasi', $induk->fresh()->departmentCode());
        $this->assertSame('operasi', $sub->fresh()->departmentCode());
        $this->assertSame('asmen_prod_a', $sub->fresh()->subDepartmentCode());

        // Form edit menggunakan provider opsi yang sama; data tersimpan
        // tetap terlihat meskipun belum pernah di-backfill ke kolom kode.
        $karyawanRole = $this->karyawanRole();
        $target = User::factory()->create([
            'role' => 'Karyawan',
            'role_id' => $karyawanRole->id,
            'bidang_id' => $sub->id,
            'jabatan_id' => $jabatanSub->id,
        ]);
        $target->roles()->sync([$karyawanRole->id]);

        $superAdminRole = $this->superAdminRole();
        $superAdmin = User::factory()->create([
            'role' => 'Super Admin',
            'role_id' => $superAdminRole->id,
        ]);
        $superAdmin->roles()->sync([$superAdminRole->id]);

        $editResponse = $this->actingAs($superAdmin)
            ->get(route('admin.users.edit', $target))
            ->assertOk();
        $this->assertTrue($editResponse->viewData('bidangs')->contains('id', $sub->id));
        $this->assertTrue($editResponse->viewData('jabatans')->contains('id', $jabatanSub->id));
        $editResponse->assertSee('value="' . $sub->id . '"', false)
            ->assertSee('value="' . $jabatanSub->id . '"', false);
    }

    public function test_store_saves_master_bidang_and_jabatan_ids(): void
    {
        [$bidang, $jabatan] = $this->masterPair();

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), $this->validPayload([
                'bidang_id'  => $bidang->id,
                'jabatan_id' => $jabatan->id,
            ]))
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'email'      => 'budi.master@example.com',
            'bidang_id'  => $bidang->id,
            'jabatan_id' => $jabatan->id,
        ]);
    }

    public function test_store_karyawan_requires_master_bidang(): void
    {
        // Master bidangs terisi → kewajiban berlaku untuk role Karyawan.
        Bidang::create(['nama' => 'BIDANG OPERASI']);

        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), $this->validPayload())
            ->assertSessionHasErrors('bidang_id');

        $this->assertDatabaseMissing('users', ['email' => 'budi.master@example.com']);
    }

    public function test_store_admin_bidang_requires_master_bidang(): void
    {
        // Master bidangs terisi → kewajiban berlaku untuk role Admin Bidang.
        Bidang::create(['nama' => 'BIDANG OPERASI']);

        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), $this->validPayload([
                'role_id'        => $this->adminBidangRole()->id,
                'level_jabatan'  => null,
                'department'     => 'engineering',
                'sub_department' => 'asmen_so',
            ]))
            ->assertSessionHasErrors('bidang_id');
    }

    public function test_store_rejects_bidang_not_in_master(): void
    {
        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), $this->validPayload([
                'bidang_id' => 999999,
            ]))
            ->assertSessionHasErrors('bidang_id');

        $this->assertDatabaseMissing('users', ['email' => 'budi.master@example.com']);
    }

    public function test_store_rejects_jabatan_from_different_bidang(): void
    {
        // Jabatan harus mengikuti bidang terpilih — pasangan tidak cocok
        // (jabatan milik bidang lain) → validasi gagal.
        [$bidangA] = $this->masterPair();
        $bidangB = Bidang::create(['nama' => 'BIDANG PEMELIHARAAN']);
        $jabatanB = Jabatan::create(['nama' => 'MANAGER PEMELIHARAAN', 'bidang_id' => $bidangB->id]);

        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), $this->validPayload([
                'bidang_id'  => $bidangA->id,
                'jabatan_id' => $jabatanB->id,
            ]))
            ->assertSessionHasErrors('jabatan_id');

        $this->assertDatabaseMissing('users', ['email' => 'budi.master@example.com']);
    }

    public function test_store_rejects_unknown_jabatan(): void
    {
        [$bidang] = $this->masterPair();

        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), $this->validPayload([
                'bidang_id'  => $bidang->id,
                'jabatan_id' => 999999,
            ]))
            ->assertSessionHasErrors('jabatan_id');
    }

    public function test_store_jabatan_required_when_bidang_has_jabatan(): void
    {
        // Bidang terpilih punya daftar jabatan → jabatan wajib diisi.
        [$bidang] = $this->masterPair();

        $this->actingAs($this->admin())
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), $this->validPayload([
                'bidang_id' => $bidang->id,
            ]))
            ->assertSessionHasErrors('jabatan_id');
    }

    public function test_store_bidang_without_jabatan_still_accepted(): void
    {
        // Bidang yang belum punya jabatan di master → akun tetap bisa
        // dibuat (jabatan tidak dipaksakan).
        $bidang = Bidang::create(['nama' => 'BIDANG LOGISTIK']);

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), $this->validPayload([
                'bidang_id' => $bidang->id,
            ]))
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'email'      => 'budi.master@example.com',
            'bidang_id'  => $bidang->id,
            'jabatan_id' => null,
        ]);
    }

    public function test_store_succeeds_when_master_bidangs_table_is_empty(): void
    {
        // Lingkungan tanpa master bidang (install baru, belum di-seed):
        // pembuatan akun Karyawan TIDAK terblokir — kewajiban bidang
        // hanya berlaku bila tabel master sudah terisi.
        $this->assertSame(0, Bidang::query()->count());

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), $this->validPayload())
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'email'      => 'budi.master@example.com',
            'bidang_id'  => null,
            'jabatan_id' => null,
        ]);
    }

    public function test_store_super_admin_forces_null_master_unit(): void
    {
        [$bidang, $jabatan] = $this->masterPair();

        // Field disembunyikan untuk Super Admin; nilai kiriman via API
        // dipaksa null di server (konsisten dengan hirarki RBAC).
        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), $this->validPayload([
                'role_id'       => $this->superAdminRole()->id,
                'level_jabatan' => null,
                'department'    => null,
                'sub_department' => null,
                'bidang_id'     => $bidang->id,
                'jabatan_id'    => $jabatan->id,
            ]))
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'email'      => 'budi.master@example.com',
            'bidang_id'  => null,
            'jabatan_id' => null,
        ]);
    }

    public function test_jabatan_is_not_role_and_does_not_change_access(): void
    {
        // Jabatan hanyalah posisi pekerjaan — TIDAK menentukan role,
        // permission, maupun grup (pivot role_user).
        [$bidang, $jabatan] = $this->masterPair();

        $this->actingAs($this->admin())
            ->post(route('admin.users.store'), $this->validPayload([
                'bidang_id'  => $bidang->id,
                'jabatan_id' => $jabatan->id,
            ]))
            ->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'budi.master@example.com')->firstOrFail();

        $karyawan = $this->karyawanRole();

        $this->assertSame($karyawan->id, $user->role_id);
        $this->assertSame('Karyawan', $user->role);
        $this->assertTrue($user->roles()->where('roles.id', $karyawan->id)->exists());
        $this->assertSame($jabatan->id, $user->jabatan_id);
        // Relasi model tersedia & menunjuk data master yang benar.
        $this->assertTrue($user->bidangRef()->is($bidang));
        $this->assertTrue($user->jabatanRef()->is($jabatan));
    }

    public function test_update_can_change_and_clear_master_unit(): void
    {
        [$bidangA, $jabatanA] = $this->masterPair();
        $bidangB = Bidang::create(['nama' => 'BIDANG ENJINIRING']);
        $jabatanB = Jabatan::create(['nama' => 'MANAGER ENJINIRING', 'bidang_id' => $bidangB->id]);

        $user = User::factory()->create([
            'role'      => 'Karyawan',
            'role_id'   => $this->karyawanRole()->id,
            'bidang_id' => $bidangA->id,
            'jabatan_id' => $jabatanA->id,
        ]);
        $user->roles()->sync([$this->karyawanRole()->id]);

        // Pindah ke bidang/jabatan lain.
        $this->actingAs($this->superAdminActor())
            ->put(route('admin.users.update', $user), [
                'name'                 => $user->name,
                'email'                => $user->email,
                'role_id'              => $this->karyawanRole()->id,
                'level_jabatan'        => 'staf',
                'department'           => 'operasi',
                'sub_department'       => 'spv_chcb_a',
                'no_hp'                => '081234567890',
                'alamat'               => 'Indramayu',
                'bidang_id'            => $bidangB->id,
                'jabatan_id'           => $jabatanB->id,
            ])
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'id'         => $user->id,
            'bidang_id'  => $bidangB->id,
            'jabatan_id' => $jabatanB->id,
        ]);

        // Jabatan lama tidak lagi milik bidang baru → ditolak.
        $this->actingAs($this->superAdminActor())
            ->from(route('admin.users.edit', $user))
            ->put(route('admin.users.update', $user), [
                'name'                 => $user->name,
                'email'                => $user->email,
                'role_id'              => $this->karyawanRole()->id,
                'level_jabatan'        => 'staf',
                'department'           => 'operasi',
                'sub_department'       => 'spv_chcb_a',
                'no_hp'                => '081234567890',
                'alamat'               => 'Indramayu',
                'bidang_id'            => $bidangB->id,
                'jabatan_id'           => $jabatanA->id,
            ])
            ->assertSessionHasErrors('jabatan_id');
    }

    public function test_update_without_master_unit_fields_keeps_values(): void
    {
        // Payload lama tanpa bidang_id/jabatan_id (mis. form compact
        // self-edit) tidak menghapus terikatan yang sudah ada.
        [$bidang, $jabatan] = $this->masterPair();

        $user = User::factory()->create([
            'role'       => 'Karyawan',
            'role_id'    => $this->karyawanRole()->id,
            'bidang_id'  => $bidang->id,
            'jabatan_id' => $jabatan->id,
        ]);
        $user->roles()->sync([$this->karyawanRole()->id]);

        $this->actingAs($this->superAdminActor())
            ->put(route('admin.users.update', $user), [
                'name'           => $user->name,
                'email'          => $user->email,
                'role_id'        => $this->karyawanRole()->id,
                'level_jabatan'  => 'staf',
                'department'     => 'operasi',
                'sub_department' => 'spv_chcb_a',
                'no_hp'          => '081234567890',
                'alamat'         => 'Indramayu',
            ])
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'id'         => $user->id,
            'bidang_id'  => $bidang->id,
            'jabatan_id' => $jabatan->id,
        ]);
    }

    public function test_master_bidang_used_by_user_cannot_be_deleted(): void
    {
        [$bidang] = $this->masterPair();

        $user = User::factory()->create([
            'role'      => 'Karyawan',
            'role_id'   => $this->karyawanRole()->id,
            'bidang_id' => $bidang->id,
        ]);
        $user->roles()->sync([$this->karyawanRole()->id]);

        $master = $this->userWithPermissions(['master_bidang.delete']);

        $this->actingAs($master)
            ->delete(route('admin.master_bidang.destroy', $bidang))
            ->assertSessionHasErrors('delete');

        $this->assertDatabaseHas('bidangs', ['id' => $bidang->id]);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'bidang_id' => $bidang->id]);
    }

    public function test_master_jabatan_used_by_user_cannot_be_deleted(): void
    {
        [, $jabatan] = $this->masterPair();

        $user = User::factory()->create([
            'role'       => 'Karyawan',
            'role_id'    => $this->karyawanRole()->id,
            'jabatan_id' => $jabatan->id,
        ]);
        $user->roles()->sync([$this->karyawanRole()->id]);

        $master = $this->userWithPermissions(['master_jabatan.delete']);

        $this->actingAs($master)
            ->delete(route('admin.master_jabatan.destroy', $jabatan))
            ->assertSessionHasErrors('delete');

        $this->assertDatabaseHas('jabatans', ['id' => $jabatan->id]);
    }

    public function test_reset_password_still_works_after_master_unit_integration(): void
    {
        // Fitur reset password tidak terganggu integrasi kolom baru.
        [$bidang, $jabatan] = $this->masterPair();

        $target = User::factory()->create([
            'role'       => 'Karyawan',
            'role_id'    => $this->karyawanRole()->id,
            'bidang_id'  => $bidang->id,
            'jabatan_id' => $jabatan->id,
        ]);
        $target->roles()->sync([$this->karyawanRole()->id]);

        $admin = $this->userWithPermissions(['users.view', 'users.edit']);

        $response = $this->actingAs($admin)
            ->patchJson(route('admin.users.reset-password', $target));

        $response->assertOk()->assertJsonPath('success', true);
        $this->assertNotEmpty($response->json('temporary_password'));

        $target->refresh();
        $this->assertTrue($target->must_change_password);
        // Terikatan master tidak berubah oleh reset.
        $this->assertSame($bidang->id, $target->bidang_id);
        $this->assertSame($jabatan->id, $target->jabatan_id);
    }
}
