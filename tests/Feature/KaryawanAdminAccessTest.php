<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Akses panel admin untuk akun KARYAWAN ber-permission EKSTRA.
 *
 * Spec (setuju dengan pemilik sistem):
 * - Karyawan murni TANPA permission ekstra → tetap tertutup total dari
 *   /admin (redirect ke portal) — baseline PermissionSeeder tidak membuka.
 * - Karyawan murni DENGAN permission ekstra (di luar baseline, mis.
 *   users.view yang diberikan lewat Edit Role) → boleh masuk /admin;
 *   route tetap dijaga permission masing-masing, sidebar hanya menampilkan
 *   menu yang lolos @can.
 * - Tautan "Panel Admin" di nav portal hanya tampil untuk karyawan
 *   ber-permission ekstra.
 */
class KaryawanAdminAccessTest extends TestCase
{
    use RefreshDatabase;

    /** Karyawan murni dengan baseline PermissionSeeder (tanpa ekstra). */
    private function plainKaryawan(): User
    {
        $this->seed(\Database\Seeders\PermissionSeeder::class);

        $role = Role::where('name', 'Karyawan')->firstOrFail();

        $user = User::factory()->create(['role' => 'Karyawan']);
        $user->role_id = $role->id;
        $user->save();
        $user->roles()->sync([$role->id]);

        return $user;
    }

    /** Karyawan yang DIBERI permission ekstra via Edit Role (role_permission). */
    private function karyawanWith(array $extraPermissionNames): User
    {
        $user = $this->plainKaryawan();

        $role = Role::where('name', 'Karyawan')->firstOrFail();
        $ids = Permission::whereIn('name', $extraPermissionNames)->pluck('id');
        $role->permissions()->syncWithoutDetaching($ids);

        return $user;
    }

    public function test_plain_karyawan_still_redirected_to_portal(): void
    {
        $user = $this->plainKaryawan();

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('karyawan.dashboard'));

        $this->actingAs($user)
            ->get(route('admin.users.index'))
            ->assertRedirect(route('karyawan.dashboard'));
    }

    public function test_karyawan_with_extra_permission_can_open_admin_users_page(): void
    {
        $user = $this->karyawanWith(['users.view']);

        $this->actingAs($user)
            ->get(route('admin.users.index'))
            ->assertOk()
            ->assertSee('Daftar Pengguna');
    }

    public function test_extra_permission_still_enforced_per_route(): void
    {
        // Ekstra = roles.view SAHAJA → daftar Pengguna tetap 403,
        // halaman Role justru terbuka.
        $user = $this->karyawanWith(['roles.view']);

        $this->actingAs($user)
            ->get(route('admin.users.index'))
            ->assertForbidden();

        $this->actingAs($user)
            ->get(route('admin.roles.index'))
            ->assertOk()
            ->assertSee('Daftar Role');
    }

    public function test_portal_shows_panel_admin_link_only_for_extra_permission(): void
    {
        $plain = $this->plainKaryawan();

        $this->actingAs($plain)
            ->get(route('karyawan.dashboard'))
            ->assertOk()
            ->assertDontSee('Panel Admin');

        $extra = $this->karyawanWith(['users.view']);

        $this->actingAs($extra)
            ->get(route('karyawan.dashboard'))
            ->assertOk()
            ->assertSee('Panel Admin');
    }

    public function test_portal_nav_management_items_follow_permission(): void
    {
        // "Karyawan SDM" — direct permission konten (mirip form Pengguna).
        $sdm = $this->plainKaryawan();
        $sdm->syncPermissions(Permission::whereIn('name', [
            'news.view', 'news.create',
            'announcements.view', 'announcements.create',
            'galleries.view', 'galleries.create',
        ])->pluck('id')->all());

        $this->actingAs($sdm)
            ->get(route('karyawan.dashboard'))
            ->assertOk()
            ->assertSee('Kelola Berita')
            ->assertSee('Kelola Pengumuman')
            ->assertSee('Kelola Galeri')
            ->assertDontSee('Data Tamu');

        // "Karyawan Sekuriti" — hanya akses data tamu.
        $sekuriti = $this->plainKaryawan();
        $sekuriti->syncPermissions(
            Permission::where('name', 'tamu.view')->pluck('id')->all()
        );

        $this->actingAs($sekuriti)
            ->get(route('karyawan.dashboard'))
            ->assertOk()
            ->assertSee('Data Tamu')
            ->assertDontSee('Kelola Berita');

        // Karyawan biasa (tanpa permission ekstra) → tanpa menu fitur.
        $plain = $this->plainKaryawan();

        $this->actingAs($plain)
            ->get(route('karyawan.dashboard'))
            ->assertOk()
            ->assertDontSee('Kelola Berita')
            ->assertDontSee('Kelola Pengumuman')
            ->assertDontSee('Kelola Galeri')
            ->assertDontSee('Data Tamu');
    }
}
