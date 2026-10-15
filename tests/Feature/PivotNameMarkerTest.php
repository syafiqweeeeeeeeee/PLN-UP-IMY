<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * KOLOM PENANDA NAMA (*_name) pada tabel pivot RBAC.
 *
 * Kolom ini HANYA untuk keterbacaan di phpMyAdmin; seluruh
 * mekanisme RBAC tetap memakai ID. Test memastikan dua mekanisme
 * pemeliharaan (Tahap 4) bekerja:
 *
 *   1. BelongsToManyNameMarkers → baris pivot BARU dari attach()/sync()
 *      langsung terisi penanda nama.
 *   2. NameMarkerObserver       → rename role/permission/user/page
 *      memperbarui penanda di seluruh baris pivot terkait.
 */
class PivotNameMarkerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(PermissionSeeder::class);
    }

    private function karyawanRole(): Role
    {
        return Role::where('name', 'Karyawan')->firstOrFail();
    }

    private function newUser(array $overrides = []): User
    {
        $user = User::factory()->create($overrides);
        $user->roles()->syncWithoutDetaching([$this->karyawanRole()->id]);

        return $user;
    }

    /* =========================================================
       1. ATTACH / SYNC → baris baru langsung terisi
       ========================================================= */

    public function test_sync_role_permissions_fills_marker_columns(): void
    {
        $role = $this->karyawanRole();

        $ids = Permission::whereIn('name', ['dashboard.view', 'news.view'])->pluck('id')->all();
        $role->permissions()->sync($ids);

        $rows = DB::table('role_permission')->where('role_id', $role->id)->get();

        $this->assertCount(2, $rows);

        foreach ($rows as $row) {
            $this->assertSame('Karyawan', $row->role_name);
            $this->assertSame(
                Permission::find($row->permission_id)->name,
                $row->permission_name
            );
        }
    }

    public function test_sync_user_roles_fills_marker_columns(): void
    {
        $user = User::factory()->create(['name' => 'Budi Santoso']);

        $user->roles()->sync([$this->karyawanRole()->id]);

        $row = DB::table('role_user')->where('user_id', $user->id)->first();

        $this->assertNotNull($row);
        $this->assertSame('Budi Santoso', $row->user_name);
        $this->assertSame('Karyawan', $row->role_name);
    }

    public function test_sync_direct_permissions_fills_marker_columns(): void
    {
        $user = $this->newUser(['name' => 'Siti Aminah']);

        $ids = Permission::whereIn('name', ['tamu.view'])->pluck('id')->all();
        $user->syncPermissions($ids);

        $row = DB::table('user_has_permissions')->where('user_id', $user->id)->first();

        $this->assertNotNull($row);
        $this->assertSame('Siti Aminah', $row->user_name);
        $this->assertSame('tamu.view', $row->permission_name);
    }

    public function test_sync_without_detaching_fills_markers_for_new_rows_only(): void
    {
        $user = $this->newUser(['name' => 'Penanda Lama']);

        $existing = DB::table('role_user')->where('user_id', $user->id)->first();
        $this->assertSame('Penanda Lama', $existing->user_name);

        // Sync role lain dengan nama berbeda → baris baru ikut terisi.
        $role = Role::create(['name' => 'Role Tambahan', 'status' => true]);
        $user->roles()->syncWithoutDetaching([$role->id]);

        $row = DB::table('role_user')
            ->where('user_id', $user->id)->where('role_id', $role->id)->first();

        $this->assertSame('Role Tambahan', $row->role_name);
    }

    public function test_sync_page_roles_fills_marker_from_page_title(): void
    {
        $page = Page::create([
            'title' => 'Profil Perusahaan',
            'slug' => 'profil-perusahaan',
            'status' => Page::STATUS_PUBLISHED,
        ]);

        $page->roles()->sync([$this->karyawanRole()->id]);

        $row = DB::table('page_role')->where('page_id', $page->id)->first();

        $this->assertNotNull($row);
        // pages tidak punya kolom `name` — penanda diambil dari `title`.
        $this->assertSame('Profil Perusahaan', $row->page_name);
        $this->assertSame('Karyawan', $row->role_name);
    }

    /* =========================================================
       2. RENAME SUMBER → penanda lama diperbarui
       ========================================================= */

    public function test_renaming_role_updates_marker_in_all_pivots(): void
    {
        $user = $this->newUser();
        $role = $this->karyawanRole();

        $perm = Permission::where('name', 'dashboard.view')->firstOrFail();
        $role->permissions()->sync([$perm->id]);

        $role->update(['name' => 'Karyawan Baru']);

        // Ketiga pivot yang membawa role_name ikut berubah.
        $this->assertSame('Karyawan Baru', DB::table('role_user')->where('role_id', $role->id)->value('role_name'));
        $this->assertSame('Karyawan Baru', DB::table('role_permission')->where('role_id', $role->id)->value('role_name'));

        // ID tidak berubah — RBAC tetap utuh.
        $this->assertSame($role->id, (int) DB::table('role_user')->where('user_id', $user->id)->value('role_id'), 'role_id tidak boleh berubah saat rename.');
        $this->assertTrue($user->fresh()->hasPermission('dashboard.view'), 'Pengecekan permission tetap berjalan normal setelah rename.');
    }

    public function test_renaming_user_updates_marker_in_pivots(): void
    {
        $user = $this->newUser(['name' => 'Nama Lama']);
        $user->syncPermissions(Permission::whereIn('name', ['news.view'])->pluck('id')->all());

        $user->update(['name' => 'Nama Baru']);

        $this->assertSame('Nama Baru', DB::table('role_user')->where('user_id', $user->id)->value('user_name'));
        $this->assertSame('Nama Baru', DB::table('user_has_permissions')->where('user_id', $user->id)->value('user_name'));
    }

    public function test_renaming_permission_updates_marker_in_pivots(): void
    {
        $role = $this->karyawanRole();
        $user = $this->newUser();

        $perm = Permission::where('name', 'news.view')->firstOrFail();
        $role->permissions()->sync([$perm->id]);
        $user->syncPermissions([$perm->id]);

        $perm->update(['name' => 'news.read']);

        $this->assertSame('news.read', DB::table('role_permission')->where('permission_id', $perm->id)->value('permission_name'));
        $this->assertSame('news.read', DB::table('user_has_permissions')->where('permission_id', $perm->id)->value('permission_name'));
    }

    public function test_updating_other_fields_does_not_touch_pivot(): void
    {
        $role = $this->karyawanRole();
        $perm = Permission::where('name', 'dashboard.view')->firstOrFail();
        $role->permissions()->sync([$perm->id]);

        // Ubah deskripsi (bukan name) → penanda & baris pivot tak tersentuh.
        $role->update(['description' => 'Role untuk karyawan biasa']);

        $this->assertSame(1, DB::table('role_permission')->where('role_id', $role->id)->count());
        $this->assertSame('Karyawan', DB::table('role_permission')->where('role_id', $role->id)->value('role_name'));
    }

    public function test_markers_never_affect_rbac_logic(): void
    {
        // Penanda sengaja dibuat basi/NULL — pengecekan permission harus
        // tetap benar karena RBAC membaca ID, bukan kolom penanda.
        $user = $this->newUser();
        $user->syncPermissions(Permission::whereIn('name', ['galleries.view'])->pluck('id')->all());

        DB::table('user_has_permissions')->where('user_id', $user->id)->update(['user_name' => 'NULL-MANUAL', 'permission_name' => null]);

        $this->assertTrue($user->fresh()->hasPermission('galleries.view'));
    }
}
