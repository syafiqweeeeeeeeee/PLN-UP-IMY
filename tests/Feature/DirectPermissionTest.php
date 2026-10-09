<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * DIRECT PERMISSION — Hak Akses Fitur per akun (Menu Pengguna).
 *
 * REVISI ARSITEKTUR RBAC:
 * - Role dikunci 3 Role Dasar permanen; pembuatan role baru nonaktif.
 * - Hak akses menu berbeda-beda diatur langsung per akun: form
 *   Tambah/Edit Pengguna menyimpan matriks (ID Menu × CRUD) ke tabel
 *   user_has_permissions (syncPermissions).
 * - Efektif = permission role (baseline) ∪ direct (real-time).
 * - Khusus role Admin Bidang: form menampilkan Bidang Utama +
 *   Sub-Bidang (wajib) & section Direct Permission.
 * - Data scoping Admin Bidang terkunci unit kerja (bidang AND sub).
 */
class DirectPermissionTest extends TestCase
{
    use RefreshDatabase;

    private function superAdmin(): User
    {
        $this->seed(PermissionSeeder::class);

        $user = User::factory()->create([
            'role' => 'Super Admin', 'role_id' => Role::where('name', 'Super Admin')->value('id'),
        ]);
        $user->roles()->sync([Role::where('name', 'Super Admin')->value('id')]);

        return $user;
    }

    /**
     * Akun Admin Bidang dengan unit kerja (operasi + asmen_prod_a)
     * dan direct permission sesuai daftar nama.
     */
    private function adminBidangUser(array $permNames = [], array $overrides = []): User
    {
        $this->seed(PermissionSeeder::class);

        $roleId = Role::where('name', 'Admin Bidang')->value('id');

        $user = User::factory()->create(array_merge([
            'role'           => 'Admin Bidang',
            'role_id'        => $roleId,
            'department'     => 'operasi',
            'department_id'  => Department::byCode('operasi')->id,
            'sub_department' => 'asmen_prod_a',
        ], $overrides));
        $user->roles()->sync([$roleId]);

        if ($permNames !== []) {
            $user->syncPermissions($this->matrixIds($permNames));
        }

        return $user;
    }

    private function validPayload(array $overrides = []): array
    {
        $roleBidang = Role::where('name', 'Admin Bidang')->value('id');

        return array_merge([
            'name'           => 'Admin Operasi Baru',
            'email'          => 'admin.ops.baru@example.com',
            'password'       => 'rahasia123',
            'password_confirmation' => 'rahasia123',
            'role_id'        => $roleBidang,
            'department'     => 'operasi',
            'sub_department' => 'asmen_prod_a',
            'no_hp'          => '081234567890',
        ], $overrides);
    }

    private function matrixIds(array $names): array
    {
        return \App\Models\Permission::whereIn('name', $names)->pluck('id')->all();
    }

    /* =========================================================
       1. FORM — section Direct Permission
       ========================================================= */

    public function test_create_form_shows_direct_permission_section_for_admin_bidang(): void
    {
        $this->actingAs($this->superAdmin())
            ->get(route('admin.users.create'))
            ->assertOk()
            // Section Direct Permission ada (disembunyikan via JS sampai
            // role Admin Bidang dipilih) — berisi matriks penuh.
            ->assertSee('Hak Akses Fitur (Direct Permission)')
            ->assertSee('Buka Menu (View)')
            ->assertSee('Tambah (Create)')
            ->assertSee('Edit (Update)')
            ->assertSee('Hapus (Delete)')
            // Seluruh 11 ID Menu tampil
            ->assertSee('Role / Hak Akses')
            ->assertSee('Log Aktivitas');
    }

    public function test_edit_form_prechecks_current_direct_permissions(): void
    {
        $admin = $this->superAdmin();

        $user = $this->adminBidangUser(['news.view', 'news.create', 'tamu.view']);

        $html = $this->actingAs($admin)
            ->get(route('admin.users.edit', $user))
            ->assertOk()
            ->getContent();

        // Kondisi checkbox sesuai hak akses AKTIF milik user ini.
        foreach (['news.view', 'news.create', 'tamu.view'] as $name) {
            $permId = \App\Models\Permission::where('name', $name)->value('id');
            $this->assertMatchesRegularExpression(
                '/name="permissions\[\]"\s+value="' . $permId . '"[^>]*checked/',
                $html,
                "Checkbox {$name} harus tercentang."
            );
        }

        // Permission yang TIDAK dimiliki → tidak tercentang.
        $deleteId = \App\Models\Permission::where('name', 'news.delete')->value('id');
        $this->assertDoesNotMatchRegularExpression(
            '/name="permissions\[\]"\s+value="' . $deleteId . '"[^>]*checked/',
            $html
        );
    }

    /* =========================================================
       2. STORE — syncPermissions ke user_has_permissions
       ========================================================= */

    public function test_store_saves_user_with_direct_permissions(): void
    {
        $admin = $this->superAdmin();

        $payload = $this->validPayload([
            'permissions' => $this->matrixIds(['news.view', 'news.create', 'work_links.view', 'work_links.edit']),
        ]);

        $this->actingAs($admin)
            ->post(route('admin.users.store'), $payload)
            ->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'admin.ops.baru@example.com')->first();
        $this->assertNotNull($user);

        // Data bidang/sub-bidang tersimpan di tabel users.
        $this->assertSame('operasi', $user->department);
        $this->assertSame('asmen_prod_a', $user->sub_department);
        $this->assertSame(Department::byCode('operasi')->id, $user->department_id);

        // Sinkronisasi direct permission ke user_has_permissions.
        foreach (['news.view', 'news.create', 'work_links.view', 'work_links.edit'] as $name) {
            $this->assertTrue($user->hasDirectPermission($name), "{$name} harus jadi direct permission.");
        }
        $this->assertFalse($user->hasDirectPermission('news.delete'));

        // ID di luar matriks ditolak (anti-inject).
        $this->assertFalse($user->hasDirectPermission('roles.assign_permission'));
    }

    public function test_store_without_admin_bidang_role_ignores_permissions(): void
    {
        $admin = $this->superAdmin();

        $roleKaryawan = Role::where('name', 'Karyawan')->value('id');

        $this->actingAs($admin)
            ->post(route('admin.users.store'), $this->validPayload([
                'role_id'        => $roleKaryawan,
                'email'          => 'karyawan.baru@example.com',
                'level_jabatan'  => 'staf',
                'permissions'    => $this->matrixIds(['news.view']),
            ]))
            ->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'karyawan.baru@example.com')->first();

        // Role Karyawan → matriks direct permission dikosongkan.
        $this->assertCount(0, $user->directPermissionIds());
    }

    /* =========================================================
       3. UPDATE — permission mengikuti centang terbaru (real-time)
       ========================================================= */

    public function test_update_syncs_direct_permissions_in_real_time(): void
    {
        $admin = $this->superAdmin();

        $user = $this->adminBidangUser(['news.view', 'news.create']);

        $this->assertTrue($user->hasPermission('news.view'));

        $this->actingAs($admin)
            ->put(route('admin.users.update', $user), $this->validPayload([
                'name'           => 'Admin Operasi (Diperbarui)',
                'email'          => $user->email,
                'password'       => '',
                'password_confirmation' => '',
                'department'     => 'operasi',
                'sub_department' => 'asmen_prod_b', // pindah unit kerja
                'permissions'    => $this->matrixIds(['news.view', 'tamu.view', 'galleries.view']),
            ]))
            ->assertRedirect(route('admin.users.index'));

        $user->refresh();

        // Data unit kerja ter-update.
        $this->assertSame('asmen_prod_b', $user->sub_department);

        // Direct permission tersinkron ulang (sync, bukan append).
        $this->assertTrue($user->hasDirectPermission('news.view'));
        $this->assertFalse($user->hasDirectPermission('news.create')); // hilang
        $this->assertTrue($user->hasDirectPermission('tamu.view'));
        $this->assertTrue($user->hasDirectPermission('galleries.view'));
    }

    public function test_update_password_optional(): void
    {
        $admin = $this->superAdmin();

        $user = $this->adminBidangUser();

        $oldHash = $user->password;

        $this->actingAs($admin)
            ->put(route('admin.users.update', $user), $this->validPayload([
                'name' => 'Tanpa Ganti Password',
                'email' => $user->email,
                'password' => '',
                'password_confirmation' => '',
                'department' => 'operasi',
                'sub_department' => 'asmen_prod_a',
                'permissions' => [],
            ]))
            ->assertRedirect(route('admin.users.index'));

        $this->assertSame($oldHash, $user->fresh()->password);
    }

    public function test_update_admin_bidang_requires_department_and_sub(): void
    {
        $admin = $this->superAdmin();

        $user = User::factory()->create([
            'role' => 'Admin Bidang', 'role_id' => Role::where('name', 'Admin Bidang')->value('id'),
        ]);
        $user->roles()->sync([Role::where('name', 'Admin Bidang')->value('id')]);

        // Sub-bidang kosong → ditolak (wajib).
        $this->actingAs($admin)
            ->put(route('admin.users.update', $user), $this->validPayload([
                'name' => 'Tanpa Sub',
                'email' => $user->email,
                'password' => '',
                'password_confirmation' => '',
                'department' => 'operasi',
                'sub_department' => '',
                'permissions' => [],
            ]))
            ->assertSessionHasErrors(['sub_department']);
    }

    /* =========================================================
       4. REAL-TIME EFEK — @can & middleware membaca direct permission
       ========================================================= */

    public function test_direct_permission_grants_menu_and_route_access_real_time(): void
    {
        $user = $this->adminBidangUser();

        // Belum punya news.view → route berita 403.
        $this->actingAs($user)->get(route('admin.news.index'))->assertForbidden();

        // Centang news.view via Direct Permission → langsung bisa akses.
        $user->syncPermissions($this->matrixIds(['news.view']));

        $this->assertTrue($user->hasDirectPermission('news.view'));
        $this->assertTrue($user->fresh()->hasPermission('news.view'));

        $this->actingAs($user)->get(route('admin.news.index'))->assertOk();
    }

    public function test_direct_permission_cannot_inject_non_matrix_permission(): void
    {
        // Coba inject roles.assign_permission (di luar matriks) langsung
        // ke pivot — harus ditolak lapisan sync controller.
        $this->actingAs($this->superAdmin())
            ->post(route('admin.users.store'), $this->validPayload([
                'permissions' => array_merge(
                    $this->matrixIds(['news.view']),
                    [\App\Models\Permission::where('name', 'roles.assign_permission')->value('id')]
                ),
            ]))
            ->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'admin.ops.baru@example.com')->first();

        $this->assertTrue($user->hasDirectPermission('news.view'));
        $this->assertFalse($user->hasDirectPermission('roles.assign_permission'));
    }

    /* =========================================================
       5. DATA SCOPING — Admin Bidang terkunci unit kerja
       ========================================================= */

    public function test_admin_bidang_scoping_locked_to_bidang_and_sub(): void
    {
        // Link milik unit kerja user (operasi + asmen_prod_a), sub lain,
        // dan level bidang — hanya yang pertama + 'umum' terlihat.
        \App\Models\WorkLink::create(['title' => 'Link Umum', 'url' => 'https://u.co.id', 'category' => 'umum', 'is_active' => true]);
        \App\Models\WorkLink::create(['title' => 'Link Unit A', 'url' => 'https://a.co.id', 'category' => 'khusus', 'department' => 'operasi', 'sub_department' => 'asmen_prod_a', 'is_active' => true]);
        \App\Models\WorkLink::create(['title' => 'Link Unit B', 'url' => 'https://b.co.id', 'category' => 'khusus', 'department' => 'operasi', 'sub_department' => 'asmen_prod_b', 'is_active' => true]);
        \App\Models\WorkLink::create(['title' => 'Link Level Bidang', 'url' => 'https://lv.co.id', 'category' => 'khusus', 'department' => 'operasi', 'sub_department' => null, 'is_active' => true]);

        $user = $this->adminBidangUser(['work_links.view', 'work_links.edit']);

        $this->actingAs($user);

        $titles = \App\Models\WorkLink::query()->pluck('title')->all();

        $this->assertContains('Link Umum', $titles);
        $this->assertContains('Link Unit A', $titles);
        $this->assertNotContains('Link Unit B', $titles);
        $this->assertNotContains('Link Level Bidang', $titles);
    }

    public function test_admin_bidang_cannot_write_cross_sub_via_direct_url(): void
    {
        $foreign = \App\Models\WorkLink::create(['title' => 'Link Unit B', 'url' => 'https://b.co.id', 'category' => 'khusus', 'department' => 'operasi', 'sub_department' => 'asmen_prod_b', 'is_active' => true]);

        $user = $this->adminBidangUser(['work_links.view', 'work_links.edit', 'work_links.delete']);

        // Direct URL lintas sub-bidang → 403 Forbidden.
        $this->actingAs($user)
            ->get(route('admin.work-links.edit', $foreign))
            ->assertForbidden();

        $this->actingAs($user)
            ->put(route('admin.work-links.update', $foreign), ['title' => 'Diretas', 'url' => 'https://x.co.id', 'category' => 'khusus'])
            ->assertForbidden();

        $this->actingAs($user)
            ->delete(route('admin.work-links.destroy', $foreign))
            ->assertForbidden();

        $this->assertSame('Link Unit B', $foreign->fresh()->title);
    }

    public function test_admin_bidang_create_forces_own_unit_kerja(): void
    {
        $user = $this->adminBidangUser(['work_links.view', 'work_links.create']);

        // Manipulasi: kirim bidang & sub lain → tetap dipaksa unit kerjanya.
        $this->actingAs($user)
            ->post(route('admin.work-links.store'), [
                'title' => 'Link Coba Manipulasi',
                'url' => 'https://manipulasi.co.id',
                'category' => 'khusus',
                'department' => 'pemeliharaan',
                'sub_department' => 'asmen_mo',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.work-links.index'));

        $this->assertDatabaseHas('work_links', [
            'title' => 'Link Coba Manipulasi',
            'department' => 'operasi',
            'sub_department' => 'asmen_prod_a',
        ]);
    }

    /* =========================================================
       6. STRUKTUR ROLE TERKUNCI
       ========================================================= */

    public function test_permission_seeder_provides_exactly_three_base_roles(): void
    {
        $this->seed(PermissionSeeder::class);

        $this->assertSame(
            ['Super Admin', 'Admin Bidang', 'Karyawan'],
            Role::orderBy('id')->pluck('name')->all()
        );
    }

    public function test_user_has_permissions_table_exists_and_persists(): void
    {
        $user = User::factory()->create();

        // PermissionSeeder untuk mengisi tabel permissions (matriks).
        $this->seed(PermissionSeeder::class);

        $ids = $this->matrixIds(['dashboard.view', 'announcements.view']);
        $user->syncPermissions($ids);

        $this->assertDatabaseCount('user_has_permissions', 2);
        $this->assertEqualsCanonicalizing(
            $ids,
            $user->directPermissionIds(),
            'syncPermissions harus persis menimpa isi pivot.'
        );

        // Sync ulang dengan subset → isi lama tergantikan.
        $user->syncPermissions([$ids[0]]);
        $this->assertDatabaseCount('user_has_permissions', 1);
    }
}
