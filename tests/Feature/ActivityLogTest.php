<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
use App\Models\Gallery;
use App\Models\Permission;
use App\Models\News;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ActivityLogTest extends TestCase
{
    use RefreshDatabase;

    /* =========================================================
       HELPER — user dengan role Administrator + permission penuh
       ========================================================= */
    private function adminUser(): User
    {
        $role = Role::create([
            'name'        => 'Administrator',
            'description' => 'Akses penuh sistem',
            'status'      => true,
        ]);

        $permissions = ['activity_logs.view', 'logout'];

        foreach ($permissions as $name) {
            $perm = Permission::create(['name' => $name, 'display_name' => $name, 'module' => 'Test']);
            $role->permissions()->attach($perm->id);
        }

        $user = User::factory()->create();
        $user->roles()->attach($role->id);

        return $user;
    }

    /* =========================================================
       PENCATATAN AKTIVITAS
       ========================================================= */

    public function test_login_is_logged(): void
    {
        $user = User::factory()->create(['password' => bcrypt('password123')]);

        $this->post('/admin/login', [
            'email'    => $user->email,
            'password' => 'password123',
        ])->assertRedirect();

        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'module'  => 'autentikasi',
            'action'  => 'login',
        ]);
    }

    public function test_logout_is_logged(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('logout'))->assertRedirect();

        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'module'  => 'autentikasi',
            'action'  => 'logout',
        ]);
    }

    public function test_news_create_update_publish_toggle_and_delete_are_logged(): void
    {
        $user = $this->userWithPermissions(['news.create', 'news.edit', 'news.publish', 'news.delete']);

        // 1. Buat berita -> log create
        $this->actingAs($user)->post(route('admin.news.store'), [
            'title'        => 'Berita Uji Log',
            'category'     => 'umum',
            'excerpt'      => 'Ringkasan berita uji log.',
            'image'        => UploadedFile::fake()->image('uji.jpg'),
            'is_published' => true,
        ]);

        $news = News::where('title', 'Berita Uji Log')->firstOrFail();

        $this->assertDatabaseHas('activity_logs', [
            'user_id'     => $user->id,
            'module'      => 'berita',
            'action'      => 'create',
            'subject_id'  => $news->id,
            'description' => 'membuat berita "Berita Uji Log"',
        ]);

        // 2. Ubah berita -> log update
        $this->actingAs($user)->put(route('admin.news.update', $news), [
            'title'        => 'Berita Uji Log (Revisi)',
            'category'     => 'umum',
            'excerpt'      => 'Ringkasan berita uji log.',
            'is_published' => true,
        ]);

        $this->assertDatabaseHas('activity_logs', [
            'module'      => 'berita',
            'action'      => 'update',
            'description' => 'mengubah berita "Berita Uji Log (Revisi)"',
        ]);

        // 3. Tarik publikasi -> log unpublish
        $this->actingAs($user)->post(route('admin.news.publish', $news));

        $this->assertDatabaseHas('activity_logs', [
            'module' => 'berita',
            'action' => 'unpublish',
        ]);

        // 4. Hapus berita -> log delete (judul ikut tercatat)
        $this->actingAs($user)->delete(route('admin.news.destroy', $news));

        $this->assertDatabaseHas('activity_logs', [
            'module'      => 'berita',
            'action'      => 'delete',
            'description' => 'menghapus berita "Berita Uji Log (Revisi)"',
        ]);

        $this->assertSame(4, ActivityLog::where('module', 'berita')->count());
    }

    public function test_announcement_create_is_logged(): void
    {
        $user = $this->userWithPermissions(['announcements.create']);

        $this->actingAs($user)->post(route('admin.announcements.store'), [
            'title'        => 'Pengumuman Uji Log',
            'category'     => 'umum',
            'excerpt'      => 'Ringkasan pengumuman uji log.',
            'is_published' => true,
        ]);

        $this->assertDatabaseHas('activity_logs', [
            'module'      => 'pengumuman',
            'action'      => 'create',
            'description' => 'membuat pengumuman "Pengumuman Uji Log"',
        ]);
    }

    public function test_user_create_and_delete_are_logged(): void
    {
        $admin = $this->userWithPermissions(['users.create', 'users.delete']);
        $role  = Role::create(['name' => 'Karyawan Uji', 'description' => 'Role untuk test', 'status' => true]);

        $this->actingAs($admin)->post(route('admin.users.store'), [
            'name'     => 'Karyawan Baru',
            'email'    => 'karyawanbaru@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role_id'  => $role->id,
        ]);

        $this->assertDatabaseHas('activity_logs', [
            'module'      => 'pengguna',
            'action'      => 'create',
            'description' => 'menambahkan akun pengguna "Karyawan Baru" (karyawanbaru@example.com)',
        ]);

        $newUser = User::where('email', 'karyawanbaru@example.com')->firstOrFail();

        $this->actingAs($admin)->delete(route('admin.users.destroy', $newUser));

        $this->assertDatabaseHas('activity_logs', [
            'module' => 'pengguna',
            'action' => 'delete',
        ]);
    }

    public function test_gallery_create_publish_toggle_and_delete_are_logged(): void
    {
        $user = $this->userWithPermissions(['galleries.create', 'galleries.edit', 'galleries.delete']);

        // 1. Tambah foto galeri -> log create
        $this->actingAs($user)->post(route('admin.galeri.store'), [
            'judul'            => 'Foto Kegiatan Uji Log',
            'kategori'         => 'KEGIATAN',
            'deskripsi'        => 'Deskripsi foto uji.',
            'file_gambar'      => UploadedFile::fake()->image('uji.png'),
            'tanggal_kegiatan' => now()->toDateString(),
            'status'           => 'publikasi',
        ]);

        $gallery = Gallery::where('judul', 'Foto Kegiatan Uji Log')->firstOrFail();

        $this->assertDatabaseHas('activity_logs', [
            'user_id'     => $user->id,
            'module'      => 'galeri',
            'action'      => 'create',
            'subject_id'  => $gallery->id,
            'description' => 'menambahkan foto galeri "Foto Kegiatan Uji Log"',
        ]);

        // 2. Tarik menjadi draft -> log unpublish
        $this->actingAs($user)->patch(route('admin.galeri.toggle-status', $gallery->id));

        $this->assertDatabaseHas('activity_logs', [
            'module' => 'galeri',
            'action' => 'unpublish',
        ]);

        // 3. Hapus -> log delete dengan judul tercatat
        $this->actingAs($user)->delete(route('admin.galeri.destroy', $gallery->id));

        $this->assertDatabaseHas('activity_logs', [
            'module'      => 'galeri',
            'action'      => 'delete',
            'description' => 'menghapus foto galeri "Foto Kegiatan Uji Log"',
        ]);
    }

    /* =========================================================
       HALAMAN ADMIN LOG AKTIVITAS
       ========================================================= */

    public function test_activity_log_page_requires_authentication(): void
    {
        $this->get(route('admin.activity-logs.index'))
            ->assertRedirect(route('login'));
    }

    public function test_activity_log_page_shows_entries_and_filters_work(): void
    {
        $user = $this->adminUser();

        ActivityLog::record('berita', 'create', 'membuat berita "Uji Filter A"', null);
        ActivityLog::record('pengumuman', 'delete', 'menghapus pengumuman "Uji Filter B"', null);

        // Halaman utama menampilkan semua
        $this->actingAs($user)->get(route('admin.activity-logs.index'))
            ->assertOk()
            ->assertSee('membuat berita "Uji Filter A"')
            ->assertSee('menghapus pengumuman "Uji Filter B"');

        // Filter modul
        $this->actingAs($user)->get(route('admin.activity-logs.index', ['module' => 'berita']))
            ->assertOk()
            ->assertSee('membuat berita "Uji Filter A"')
            ->assertDontSee('menghapus pengumuman "Uji Filter B"');

        // Pencarian
        $this->actingAs($user)->get(route('admin.activity-logs.index', ['q' => 'Uji Filter B']))
            ->assertOk()
            ->assertSee('menghapus pengumuman "Uji Filter B"')
            ->assertDontSee('membuat berita "Uji Filter A"');
    }

    public function test_single_log_can_be_deleted(): void
    {
        $user = $this->adminUser();
        $log  = ActivityLog::record('berita', 'create', 'membuat berita "Hapus Saya"', null);

        $this->actingAs($user)
            ->delete(route('admin.activity-logs.destroy', $log))
            ->assertRedirect();

        $this->assertDatabaseMissing('activity_logs', ['id' => $log->id]);
    }

    public function test_clear_all_deletes_logs_but_records_itself(): void
    {
        $user = $this->adminUser();

        ActivityLog::record('berita', 'create', 'membuat berita "Lama A"', null);
        ActivityLog::record('pengumuman', 'create', 'membuat pengumuman "Lama B"', null);

        $this->actingAs($user)
            ->delete(route('admin.activity-logs.clear'))
            ->assertRedirect(route('admin.activity-logs.index'));

        // Semua log lama hilang, tersisa 1: catatan pembersihan itu sendiri
        $this->assertDatabaseCount('activity_logs', 1);
        $this->assertDatabaseHas('activity_logs', [
            'module' => 'log',
            'action' => 'clear',
            'user_id' => $user->id,
        ]);
    }

    /* =========================================================
       PERMISSION — hanya Administrator yang boleh akses log
       ========================================================= */

    public function test_user_without_permission_gets_403(): void
    {
        $user = User::factory()->create(); // tanpa role / permission

        $this->actingAs($user)
            ->get(route('admin.activity-logs.index'))
            ->assertForbidden();

        $log = ActivityLog::record('berita', 'create', 'membuat berita "X"', null);

        $this->actingAs($user)
            ->delete(route('admin.activity-logs.destroy', $log))
            ->assertForbidden();

        $this->actingAs($user)
            ->delete(route('admin.activity-logs.clear'))
            ->assertForbidden();
    }

    public function test_sidebar_hides_log_menu_without_permission(): void
    {
        $admin = $this->adminUser();
        $plain = User::factory()->create();

        // Punya permission -> menu tampil
        $this->actingAs($admin)->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Log Aktivitas');

        // Tidak punya permission -> menu disembunyikan
        $this->actingAs($plain)->get(route('admin.dashboard'))
            ->assertOk()
            ->assertDontSee('Log Aktivitas');
    }

    /* =========================================================
       DASHBOARD — AKTIVITAS TERBARU
       ========================================================= */

    public function test_dashboard_shows_real_activity_logs(): void
    {
        $user = User::factory()->create();

        ActivityLog::record('berita', 'create', 'membuat berita "Berita Dashboard Uji"', null);

        $this->actingAs($user)->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Berita Dashboard Uji')
            // Data palsu lama harus sudah tidak ada
            ->assertDontSee('Mendaftar');
    }

    public function test_log_stays_when_subject_user_is_deleted(): void
    {
        $admin  = User::factory()->create();
        $victim = User::factory()->create(['name' => 'Akun Dihapus']);

        ActivityLog::record('pengguna', 'delete', 'menghapus akun pengguna "Akun Dihapus"', $victim);
        $victim->delete();

        // Log tetap ada walau user pelakunya dihapus (null on delete)
        $this->assertDatabaseHas('activity_logs', [
            'description' => 'menghapus akun pengguna "Akun Dihapus"',
        ]);
    }
}
