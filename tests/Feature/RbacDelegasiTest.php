<?php

namespace Tests\Feature;

use App\Models\Announcement;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use App\Models\WorkLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * RBAC — Super Admin & Admin Bidang (Admin Delegasi per Bidang).
 *
 * 1. Role & menu:  Super Admin = akses penuh; Admin Bidang hanya
 *    Pengumuman Internal + Link Kerja (menu sensitif disembunyikan
 *    dan routes diblokir).
 * 2. Data scoping: Admin Bidang terikat users.department_id —
 *    Read difilter, Create dipaksa bidangnya, Edit/Delete data
 *    bidang lain → 403.
 */
class RbacDelegasiTest extends TestCase
{
    use RefreshDatabase;

    private function makeRole(string $name, array $permissions): Role
    {
        $role = Role::firstOrCreate(
            ['name' => $name],
            ['description' => "Role {$name}", 'status' => true]
        );

        foreach ($permissions as $permission) {
            $perm = \App\Models\Permission::firstOrCreate(
                ['name' => $permission],
                ['display_name' => $permission, 'module' => 'Test']
            );
            $role->permissions()->syncWithoutDetaching([$perm->id]);
        }

        return $role;
    }

    private function superAdmin(): User
    {
        $role = $this->makeRole('Super Admin', [
            'dashboard.view', 'users.view', 'users.create', 'users.edit', 'users.delete',
            'roles.view', 'news.view', 'news.create', 'tamu.view',
            'pages.view', 'menus.view', 'activity_logs.view',
            'announcements.view', 'announcements.create', 'announcements.edit', 'announcements.delete', 'announcements.publish',
            'work_links.view', 'work_links.create', 'work_links.edit', 'work_links.delete',
        ]);

        $user = User::factory()->create(['role' => 'Super Admin', 'role_id' => $role->id]);
        $user->roles()->sync([$role->id]);

        return $user;
    }

    private function adminBidang(string $department, array $permissions = []): User
    {
        $role = $this->makeRole('Admin Bidang', array_merge([
            'dashboard.view',
            'announcements.view', 'announcements.create', 'announcements.edit', 'announcements.delete', 'announcements.publish',
            'work_links.view', 'work_links.create', 'work_links.edit', 'work_links.delete',
        ], $permissions));

        $departmentId = Department::byCode($department)?->id ?? Department::create([
            'code' => $department, 'name' => ucfirst($department), 'is_active' => true,
        ])->id;

        $user = User::factory()->create([
            'role'          => 'Admin Bidang',
            'role_id'       => $role->id,
            'department'    => $department,
            'department_id' => $departmentId,
        ]);
        $user->roles()->sync([$role->id]);

        return $user;
    }

    /* =========================================================
       1. HAK AKSES MENU & ROUTES
       ========================================================= */

    public function test_admin_bidang_blocked_from_sensitive_menus_and_routes(): void
    {
        $admin = $this->adminBidang('operasi', ['users.view', 'roles.view', 'tamu.view', 'pages.view']);

        // Middleware role.scope:super_admin memblokir manajemen user/role.
        $this->actingAs($admin)->get(route('admin.users.create'))->assertForbidden();
        $this->actingAs($admin)->post(route('admin.users.store'), [])->assertForbidden();
        $this->actingAs($admin)->get(route('admin.roles.index'))->assertForbidden();

        // Data Tamu & Halaman (landing page) hanya Super Admin.
        $this->actingAs($admin)->get(route('admin.tamu.index'))->assertForbidden();
        $this->actingAs($admin)->get(route('admin.pages.index'))->assertForbidden();
    }

    public function test_super_admin_has_full_access(): void
    {
        $admin = $this->superAdmin();

        $this->actingAs($admin)->get(route('admin.dashboard'))->assertOk();
        $this->actingAs($admin)->get(route('admin.users.create'))->assertOk();
        $this->actingAs($admin)->get(route('admin.roles.index'))->assertOk();
        $this->actingAs($admin)->get(route('admin.announcements.index'))->assertOk();
        $this->actingAs($admin)->get(route('admin.work-links.index'))->assertOk();
    }

    public function test_admin_bidang_without_department_binding_is_blocked(): void
    {
        // Admin Bidang tanpa department_id/department → diblokir modul bidang.
        $role = $this->makeRole('Admin Bidang', ['dashboard.view', 'work_links.view']);
        $user = User::factory()->create(['role' => 'Admin Bidang', 'role_id' => $role->id]);
        $user->roles()->sync([$role->id]);

        $this->actingAs($user)
            ->get(route('admin.work-links.index'))
            ->assertForbidden();
    }

    public function test_sidebar_hides_sensitive_menus_for_admin_bidang(): void
    {
        $html = $this->actingAs($this->adminBidang('operasi'))
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->getContent();

        // Menu relevan tampil.
        $this->assertStringContainsString('Pengumuman Internal', $html);
        $this->assertStringContainsString('Link Kerja', $html);

        // Menu sensitif disembunyikan.
        $this->assertStringNotContainsString('>Data Tamu<', $html);
        $this->assertStringNotContainsString('>Halaman<', $html);
        $this->assertStringNotContainsString('>Pengguna<', $html);
        $this->assertStringNotContainsString('>Role<', $html);
        $this->assertStringNotContainsString('Log Aktivitas<', $html);
    }

    public function test_sidebar_shows_all_menus_for_super_admin(): void
    {
        $html = $this->actingAs($this->superAdmin())
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->getContent();

        $this->assertStringContainsString('Data Tamu', $html);
        $this->assertStringContainsString('>Halaman<', $html);
        $this->assertStringContainsString('>Pengguna<', $html);
        $this->assertStringContainsString('Log Aktivitas', $html);
    }

    /* =========================================================
       2. DYNAMIC DATA SCOPING — LINK KERJA
       ========================================================= */

    public function test_admin_bidang_sees_only_own_department_work_links(): void
    {
        WorkLink::create(['title' => 'Link Operasi', 'url' => 'https://ops.co.id', 'category' => 'khusus', 'department' => 'operasi', 'is_active' => true]);
        WorkLink::create(['title' => 'Link Pemeliharaan', 'url' => 'https://pml.co.id', 'category' => 'khusus', 'department' => 'pemeliharaan', 'is_active' => true]);

        $html = $this->actingAs($this->adminBidang('operasi'))
            ->get(route('admin.work-links.index'))
            ->assertOk()
            ->getContent();

        $this->assertStringContainsString('Link Operasi', $html);
        $this->assertStringNotContainsString('Link Pemeliharaan', $html);
    }

    public function test_admin_bidang_create_forces_own_department(): void
    {
        // Coba manipulasi: kirim department bidang lain → tetap dipaksa operasi.
        $this->actingAs($this->adminBidang('operasi'))
            ->post(route('admin.work-links.store'), [
                'title' => 'Link Coba Manipulasi',
                'url' => 'https://manipulasi.co.id',
                'category' => 'khusus',
                'department' => 'pemeliharaan',
                'sub_department' => null,
                'is_active' => '1',
            ])->assertRedirect(route('admin.work-links.index'));

        $this->assertDatabaseHas('work_links', [
            'title' => 'Link Coba Manipulasi',
            'department' => 'operasi',
        ]);
    }

    public function test_admin_bidang_cannot_edit_or_delete_other_department_link(): void
    {
        $foreign = WorkLink::create(['title' => 'Link Milik PML', 'url' => 'https://pml.co.id', 'category' => 'khusus', 'department' => 'pemeliharaan', 'is_active' => true]);

        $this->actingAs($this->adminBidang('operasi'))
            ->get(route('admin.work-links.edit', $foreign))
            ->assertForbidden();

        $this->actingAs($this->adminBidang('operasi'))
            ->put(route('admin.work-links.update', $foreign), ['title' => 'Diretas', 'url' => 'https://x.co.id', 'category' => 'umum'])
            ->assertForbidden();

        $this->actingAs($this->adminBidang('operasi'))
            ->delete(route('admin.work-links.destroy', $foreign))
            ->assertForbidden();

        $this->assertSame('Link Milik PML', $foreign->fresh()->title);
    }

    public function test_admin_bidang_can_edit_own_department_link(): void
    {
        $own = WorkLink::create(['title' => 'Link Milik Ops', 'url' => 'https://ops.co.id', 'category' => 'khusus', 'department' => 'operasi', 'is_active' => true]);

        $this->actingAs($this->adminBidang('operasi'))
            ->put(route('admin.work-links.update', $own), [
                'title' => 'Link Milik Ops (Baru)',
                'url' => 'https://ops2.co.id',
                'category' => 'khusus',
                'department' => 'operasi',
                'sub_department' => 'asmen_prod_a',
                'is_active' => '1',
            ])->assertRedirect(route('admin.work-links.index'));

        $this->assertSame('Link Milik Ops (Baru)', $own->fresh()->title);
    }

    public function test_work_link_form_locks_department_for_admin_bidang(): void
    {
        $html = $this->actingAs($this->adminBidang('operasi'))
            ->get(route('admin.work-links.create'))
            ->assertOk()
            ->getContent();

        // Bidang terkunci: select disabled + hidden input + opsi bidang
        // hanya operasi (dropdown bidang tanpa <option> bidang lain).
        $this->assertStringContainsString('id="department" name="department" class="form-input"', $html);
        $this->assertStringContainsString('disabled', $html);
        $this->assertStringContainsString('name="department" value="operasi"', $html);
        $this->assertStringNotContainsString('<option value="pemeliharaan"', $html);
    }

    /* =========================================================
       3. DYNAMIC DATA SCOPING — PENGUMUMAN INTERNAL
       ========================================================= */

    public function test_admin_bidang_sees_only_own_department_announcements(): void
    {
        $ops = Department::byCode('operasi')->id;
        $pml = Department::byCode('pemeliharaan')->id;

        Announcement::create(['title' => 'Pengumuman Ops', 'slug' => 'pg-ops', 'category' => 'umum', 'excerpt' => 'e', 'department_id' => $ops, 'is_published' => true]);
        Announcement::create(['title' => 'Pengumuman PML', 'slug' => 'pg-pml', 'category' => 'umum', 'excerpt' => 'e', 'department_id' => $pml, 'is_published' => true]);
        Announcement::create(['title' => 'Pengumuman Global', 'slug' => 'pg-global', 'category' => 'umum', 'excerpt' => 'e', 'department_id' => null, 'is_published' => true]);

        $html = $this->actingAs($this->adminBidang('operasi'))
            ->get(route('admin.announcements.index'))
            ->assertOk()
            ->getContent();

        $this->assertStringContainsString('Pengumuman Ops', $html);
        $this->assertStringContainsString('Pengumuman Global', $html); // global terlihat semua
        $this->assertStringNotContainsString('Pengumuman PML', $html);
    }

    public function test_admin_bidang_create_announcement_bound_to_own_department(): void
    {
        $ops = Department::byCode('operasi');

        // Manipulasi department_id bidang lain → tetap dipaksa operasi.
        $this->actingAs($this->adminBidang('operasi'))
            ->post(route('admin.announcements.store'), [
                'title' => 'Pengumuman Uji Delegasi',
                'category' => 'umum',
                'excerpt' => 'Ringkasan.',
                'department_id' => Department::byCode('pemeliharaan')->id,
            ])->assertRedirect(route('admin.announcements.index'));

        $this->assertDatabaseHas('announcements', [
            'title' => 'Pengumuman Uji Delegasi',
            'department_id' => $ops->id,
        ]);
    }

    public function test_admin_bidang_cannot_touch_other_department_announcement(): void
    {
        $pml = Department::byCode('pemeliharaan')->id;

        $foreign = Announcement::create(['title' => 'Pengumuman PML', 'slug' => 'pg-pml', 'category' => 'umum', 'excerpt' => 'e', 'department_id' => $pml, 'is_published' => true]);

        $admin = $this->adminBidang('operasi');

        $this->actingAs($admin)->get(route('admin.announcements.edit', $foreign))->assertForbidden();
        $this->actingAs($admin)->put(route('admin.announcements.update', $foreign), ['title' => 'Diretas', 'category' => 'umum', 'excerpt' => 'e'])->assertForbidden();
        $this->actingAs($admin)->delete(route('admin.announcements.destroy', $foreign))->assertForbidden();
        $this->actingAs($admin)->post(route('admin.announcements.publish', $foreign))->assertForbidden();

        $this->assertSame('Pengumuman PML', $foreign->fresh()->title);
    }

    public function test_super_admin_can_assign_owner_department_on_create(): void
    {
        $pml = Department::byCode('pemeliharaan')->id;

        $this->actingAs($this->superAdmin())
            ->post(route('admin.announcements.store'), [
                'title' => 'Pengumuman Untuk PML',
                'category' => 'umum',
                'excerpt' => 'Ringkasan.',
                'department_id' => $pml,
            ])->assertRedirect(route('admin.announcements.index'));

        $this->assertDatabaseHas('announcements', [
            'title' => 'Pengumuman Untuk PML',
            'department_id' => $pml,
        ]);
    }

    public function test_portal_still_shows_all_announcements_regardless_of_owner(): void
    {
        $ops = Department::byCode('operasi')->id;

        Announcement::create(['title' => 'Pengumuman Karyawan Ops', 'slug' => 'pg-kry-ops', 'category' => 'umum', 'excerpt' => 'e', 'target_publication' => 'portal', 'department_id' => $ops, 'is_published' => true, 'published_at' => now()]);

        // Portal Karyawan tetap melihat pengumuman apa pun pemilik bidangnya.
        $role = Role::firstOrCreate(['name' => 'Karyawan'], ['description' => 'Karyawan', 'status' => true]);
        $user = User::factory()->create(['role' => 'Karyawan', 'role_id' => $role->id]);
        $user->roles()->sync([$role->id]);

        $this->actingAs($user)->get(route('karyawan.informasi'))
            ->assertOk()
            ->assertSee('Pengumuman Karyawan Ops');
    }

    /* =========================================================
       4. SEEDER
       ========================================================= */

    public function test_permission_seeder_creates_super_admin_and_admin_bidang_roles(): void
    {
        $this->seed(\Database\Seeders\PermissionSeeder::class);

        $super = Role::where('name', 'Super Admin')->first();
        $bidang = Role::where('name', 'Admin Bidang')->first();

        $this->assertNotNull($super);
        $this->assertNotNull($bidang);

        // Super Admin: akses penuh (termasuk users & roles).
        $this->assertTrue($super->hasPermission('users.view'));
        $this->assertTrue($super->hasPermission('roles.view'));
        $this->assertTrue($super->hasPermission('work_links.view'));

        // Admin Bidang: hanya menu relevan — TANPA permission sensitif.
        $this->assertTrue($bidang->hasPermission('announcements.view'));
        $this->assertTrue($bidang->hasPermission('work_links.view'));
        $this->assertFalse($bidang->hasPermission('users.view'));
        $this->assertFalse($bidang->hasPermission('roles.view'));
        $this->assertFalse($bidang->hasPermission('tamu.view'));
        $this->assertFalse($bidang->hasPermission('pages.view'));
    }
}
