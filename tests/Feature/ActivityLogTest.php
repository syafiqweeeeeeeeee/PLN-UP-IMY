<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
use App\Models\Gallery;
use App\Models\Permission;
use App\Models\News;
use App\Models\Role;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
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

    /**
     * Ambil seluruh baris JSONL dari disk fake (urut nama file = kronologis).
     *
     * @return array<int, array{file: string, entry: array<string, mixed>}>
     */
    private function allLines(): array
    {
        $disk = Storage::disk(ActivityLogger::DISK);

        return collect($disk->files('/'))
            ->filter(fn (string $f) => (bool) preg_match('/^activity-\d{4}-\d{2}-\d{2}(-part\d+)?\.jsonl$/', $f))
            ->sort()
            ->flatMap(fn (string $f) => collect(preg_split('/\r\n|\r|\n/', trim((string) $disk->get($f))) ?: [])
                ->filter(fn (string $l) => trim($l) !== '')
                ->map(fn (string $l) => ['file' => $f, 'entry' => json_decode($l, true)]))
            ->values()
            ->all();
    }

    /* =========================================================
       PENULISAN LOG KE FILE (JSONL + penamaan tanggal)
       ========================================================= */

    public function test_login_is_logged_to_todays_jsonl_file(): void
    {
        $user = User::factory()->create(['password' => bcrypt('password123')]);

        $this->post('/admin/login', [
            'email'    => $user->email,
            'password' => 'password123',
        ])->assertRedirect();

        $lines = $this->allLines();

        // Log login tercatat di file hari ini dengan nama sesuai format tanggal.
        $expectedFile = 'activity-' . now()->format('Y-m-d') . '.jsonl';
        $this->assertNotEmpty($lines);
        $this->assertContains($expectedFile, array_column($lines, 'file'));

        $loginLines = array_values(array_filter($lines, fn ($l) => ($l['entry']['event_type'] ?? null) === 'login'));
        $this->assertNotEmpty($loginLines);
        $this->assertSame($expectedFile, $loginLines[0]['file']);
        $this->assertSame($user->id, $loginLines[0]['entry']['actor']['id']);
        $this->assertSame('autentikasi', $loginLines[0]['entry']['module']);
    }

    public function test_logout_is_logged(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('logout'))->assertRedirect();

        $logoutLines = array_values(array_filter(
            $this->allLines(),
            fn ($l) => ($l['entry']['event_type'] ?? null) === 'logout'
        ));

        $this->assertNotEmpty($logoutLines);
        $this->assertSame($user->id, $logoutLines[0]['entry']['actor']['id']);
    }

    public function test_log_entry_json_structure_is_complete(): void
    {
        $user = User::factory()->create(['role' => 'Administrator', 'email' => 'budi@example.com']);

        ActivityLogger::log('create', $user, [
            'module'      => 'berita',
            'description' => 'membuat berita "Struktur Uji"',
            'subject'     => new News(['title' => 'x']),
        ]);

        $line = $this->allLines()[0]['entry'];

        // Struktur wajib: id, timestamp, event_type, actor, context, payload
        $this->assertArrayHasKey('id', $line);
        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i',
            $line['id']
        );
        $this->assertMatchesRegularExpression(
            '/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}/',
            $line['timestamp'] // ISO 8601 UTC (Z di akhir)
        );
        $this->assertStringEndsWith('Z', $line['timestamp']);
        $this->assertSame('create', $line['event_type']);
        $this->assertSame('Administrator', $line['actor']['role']);
        $this->assertSame('budi@example.com', $line['actor']['email']);
        $this->assertArrayHasKey('ip', $line['context']);
        $this->assertArrayHasKey('user_agent', $line['context']);
        $this->assertSame('membuat berita "Struktur Uji"', $line['payload']['description']);
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

        $this->assertTrue(collect($this->allLines())->contains(fn ($l) =>
            $l['entry']['event_type'] === 'create'
            && $l['entry']['module'] === 'berita'
            && ($l['entry']['payload']['description'] ?? '') === 'membuat berita "Berita Uji Log"'
            && ($l['entry']['payload']['subject_id'] ?? null) === $news->id
        ));

        // 2. Ubah berita -> log update
        $this->actingAs($user)->put(route('admin.news.update', $news), [
            'title'        => 'Berita Uji Log (Revisi)',
            'category'     => 'umum',
            'excerpt'      => 'Ringkasan berita uji log.',
            'is_published' => true,
        ]);

        $this->assertTrue(collect($this->allLines())->contains(fn ($l) =>
            $l['entry']['event_type'] === 'update'
            && $l['entry']['module'] === 'berita'
            && ($l['entry']['payload']['description'] ?? '') === 'mengubah berita "Berita Uji Log (Revisi)"'
        ));

        // 3. Tarik publikasi -> log unpublish
        $this->actingAs($user)->post(route('admin.news.publish', $news));

        $this->assertTrue(collect($this->allLines())->contains(fn ($l) =>
            $l['entry']['event_type'] === 'unpublish' && $l['entry']['module'] === 'berita'
        ));

        // 4. Hapus berita -> log delete (judul ikut tercatat)
        $this->actingAs($user)->delete(route('admin.news.destroy', $news));

        $this->assertTrue(collect($this->allLines())->contains(fn ($l) =>
            $l['entry']['event_type'] === 'delete'
            && $l['entry']['module'] === 'berita'
            && ($l['entry']['payload']['description'] ?? '') === 'menghapus berita "Berita Uji Log (Revisi)"'
        ));

        $this->assertSame(4, collect($this->allLines())->filter(fn ($l) => $l['entry']['module'] === 'berita')->count());
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

        $this->assertTrue(collect($this->allLines())->contains(fn ($l) =>
            $l['entry']['event_type'] === 'create'
            && $l['entry']['module'] === 'pengumuman'
            && ($l['entry']['payload']['description'] ?? '') === 'membuat pengumuman "Pengumuman Uji Log"'
        ));
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

        $this->assertTrue(collect($this->allLines())->contains(fn ($l) =>
            $l['entry']['event_type'] === 'create'
            && $l['entry']['module'] === 'pengguna'
            && ($l['entry']['payload']['description'] ?? '') === 'menambahkan akun pengguna "Karyawan Baru" (karyawanbaru@example.com)'
        ));

        $newUser = User::where('email', 'karyawanbaru@example.com')->firstOrFail();

        $this->actingAs($admin)->delete(route('admin.users.destroy', $newUser));

        $this->assertTrue(collect($this->allLines())->contains(fn ($l) =>
            $l['entry']['event_type'] === 'delete' && $l['entry']['module'] === 'pengguna'
        ));
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

        $this->assertTrue(collect($this->allLines())->contains(fn ($l) =>
            $l['entry']['event_type'] === 'create'
            && $l['entry']['module'] === 'galeri'
            && ($l['entry']['payload']['description'] ?? '') === 'menambahkan foto galeri "Foto Kegiatan Uji Log"'
            && ($l['entry']['payload']['subject_id'] ?? null) === $gallery->id
        ));

        // 2. Tarik menjadi draft -> log unpublish
        $this->actingAs($user)->patch(route('admin.galeri.toggle-status', $gallery->id));

        $this->assertTrue(collect($this->allLines())->contains(fn ($l) =>
            $l['entry']['event_type'] === 'unpublish' && $l['entry']['module'] === 'galeri'
        ));

        // 3. Hapus -> log delete dengan judul tercatat
        $this->actingAs($user)->delete(route('admin.galeri.destroy', $gallery->id));

        $this->assertTrue(collect($this->allLines())->contains(fn ($l) =>
            $l['entry']['event_type'] === 'delete'
            && $l['entry']['module'] === 'galeri'
            && ($l['entry']['payload']['description'] ?? '') === 'menghapus foto galeri "Foto Kegiatan Uji Log"'
        ));
    }

    /* =========================================================
       BATAS MAKSIMAL 3000 BARIS → CHUNK part2, part3, dst.
       ========================================================= */

    public function test_daily_file_is_chunked_when_exceeding_max_lines(): void
    {
        $user = User::factory()->create();

        // Tulis MAX_LINES + 5 log — bagian ke-3001..3005 harus jatuh
        // ke chunk part2 (bukan menembus batas file pertama).
        $total = ActivityLogger::MAX_LINES + 5;
        for ($i = 1; $i <= $total; $i++) {
            ActivityLogger::log('update', $user, [
                'module'      => 'berita',
                'description' => "log uji ke-{$i}",
            ]);
        }

        $today = now()->format('Y-m-d');
        $disk  = Storage::disk(ActivityLogger::DISK);

        $this->assertTrue($disk->exists("activity-{$today}.jsonl"));
        $this->assertTrue($disk->exists("activity-{$today}-part2.jsonl"));

        // File pertama PENUH: tepat 3000 baris, tidak lebih.
        $baseLines = array_values(array_filter(explode("\n", trim((string) $disk->get("activity-{$today}.jsonl")))));
        $this->assertCount(ActivityLogger::MAX_LINES, $baseLines);

        $part2Lines = array_values(array_filter(explode("\n", trim((string) $disk->get("activity-{$today}-part2.jsonl")))));
        $this->assertCount(5, $part2Lines);

        // Total entri tetap utuh (tidak ada baris hilang/dipangkas).
        $this->assertCount($total, $this->allLines());
    }

    /* =========================================================
       PEMBACAAN & KELOMPOKKAN PER HARI
       ========================================================= */

    public function test_get_grouped_logs_groups_by_day_with_ui_headers(): void
    {
        // Log "kemarin" dan dua log "hari ini".
        ActivityLogger::appendEntry(ActivityLogger::filePathFor(now()->subDay()), [
            'id'         => '11111111-1111-4111-8111-111111111111',
            'timestamp'  => now()->subDay()->setTime(9, 0)->utc()->toISOString(),
            'event_type' => 'create',
            'module'     => 'berita',
            'actor'      => ['id' => 1, 'name' => 'Budi', 'email' => null, 'role' => 'Administrator'],
            'context'    => ['ip' => '127.0.0.1', 'user_agent' => 'test'],
            'payload'    => ['description' => 'membuat berita "Kemarin"', 'module_label' => 'Berita'],
        ]);
        ActivityLogger::log('login', User::factory()->create(['name' => 'Siti']), [
            'module'      => 'autentikasi',
            'description' => 'login ke dashboard',
        ]);

        $result = ActivityLogger::getGroupedLogs(daysLimit: 7);

        // Dua grup, urut terbaru dulu (hari ini → kemarin).
        $this->assertCount(2, $result['groups']);
        $this->assertSame(now()->format('Y-m-d'), $result['groups'][0]['key']);
        $this->assertSame(now()->subDay()->format('Y-m-d'), $result['groups'][1]['key']);

        // Header UI sesuai format: "Today - ..." / "Yesterday - ..." + nama hari Inggris.
        $this->assertStringStartsWith('Today - ', $result['groups'][0]['label']);
        $this->assertStringContainsString(now()->locale('en')->translatedFormat('l, F j, Y'), $result['groups'][0]['label']);
        $this->assertStringStartsWith('Yesterday - ', $result['groups'][1]['label']);

        // Entri dikelompokkan benar: 1 di kemarin, 1 di hari ini.
        $this->assertCount(1, $result['groups'][0]['entries']);
        $this->assertCount(1, $result['groups'][1]['entries']);
        $this->assertSame('membuat berita "Kemarin"', $result['groups'][1]['entries'][0]['description']);
        $this->assertSame('login ke dashboard', $result['groups'][0]['entries'][0]['description']);
        $this->assertSame(2, $result['total']);
    }

    public function test_read_entries_returns_newest_first_and_hydrates_fields(): void
    {
        $user = User::factory()->create(['name' => 'Pembaca Uji']);

        ActivityLogger::log('create', $user, ['module' => 'berita', 'description' => 'entri pertama']);
        ActivityLogger::log('delete', $user, ['module' => 'berita', 'description' => 'entri kedua']);

        $entries = ActivityLogger::readEntries();

        $this->assertCount(2, $entries);
        // Terbaru dulu
        $this->assertSame('entri kedua', $entries[0]['description']);
        $this->assertSame('entri pertama', $entries[1]['description']);

        // Field hasil hydrate siap-render
        $this->assertSame('Pembaca Uji', $entries[0]['actor_name']);
        $this->assertSame('Berita', $entries[0]['module_label']);
        $this->assertSame('Hapus', $entries[0]['action_label']);
        $this->assertInstanceOf(Carbon::class, $entries[0]['timestamp']);
    }

    public function test_read_entries_filters_by_search_and_event_type(): void
    {
        $budi = User::factory()->create(['name' => 'Budi Santoso', 'email' => 'budi@example.com']);
        $siti = User::factory()->create(['name' => 'Siti Aminah', 'email' => 'siti@example.com']);

        ActivityLogger::log('create', $budi, ['module' => 'berita', 'description' => 'oleh budi']);
        ActivityLogger::log('delete', $siti, ['module' => 'berita', 'description' => 'oleh siti']);
        ActivityLogger::log('update', $budi, ['module' => 'berita', 'description' => 'budi lagi']);

        // Filter search actor (nama, case-insensitive)
        $entries = ActivityLogger::readEntries(search: 'BUDI');
        $this->assertCount(2, $entries);
        $this->assertSame('budi lagi', $entries[0]['description']);

        // Filter event_type persis
        $entries = ActivityLogger::readEntries(eventType: 'delete');
        $this->assertCount(1, $entries);
        $this->assertSame('oleh siti', $entries[0]['description']);

        // Kombinasi keduanya
        $entries = ActivityLogger::readEntries(search: 'budi@example.com', eventType: 'create');
        $this->assertCount(1, $entries);
        $this->assertSame('oleh budi', $entries[0]['description']);
    }

    /* =========================================================
       HALAMAN ADMIN LOG AKTIVITAS — header per hari di UI
       ========================================================= */

    public function test_activity_log_page_requires_authentication(): void
    {
        $this->get(route('admin.activity-logs.index'))
            ->assertRedirect(route('login'));
    }

    public function test_activity_log_page_shows_day_headers_filters_and_search(): void
    {
        $user = $this->adminUser();

        ActivityLogger::log('create', $user, [
            'module'      => 'berita',
            'description' => 'membuat berita "Uji Filter A"',
        ]);
        ActivityLogger::log('delete', $user, [
            'module'      => 'pengumuman',
            'description' => 'menghapus pengumuman "Uji Filter B"',
        ]);

        // Halaman utama menampilkan header hari + kedua log
        $this->actingAs($user)->get(route('admin.activity-logs.index'))
            ->assertOk()
            ->assertSee('log-day-header', false)
            ->assertSee('Today - ', false)
            ->assertSee('membuat berita "Uji Filter A"')
            ->assertSee('menghapus pengumuman "Uji Filter B"');

        // Filter modul
        $this->actingAs($user)->get(route('admin.activity-logs.index', ['module' => 'berita']))
            ->assertOk()
            ->assertSee('membuat berita "Uji Filter A"')
            ->assertDontSee('menghapus pengumuman "Uji Filter B"');

        // Filter aksi (event_type)
        $this->actingAs($user)->get(route('admin.activity-logs.index', ['event_type' => 'delete']))
            ->assertOk()
            ->assertSee('menghapus pengumuman "Uji Filter B"')
            ->assertDontSee('membuat berita "Uji Filter A"');
    }

    public function test_activity_log_page_search_filters_by_actor_name(): void
    {
        $admin = $this->adminUser();
        $siti  = User::factory()->create(['name' => 'Siti Uji']);

        ActivityLogger::log('create', $admin, ['module' => 'berita', 'description' => 'log dari admin']);
        ActivityLogger::log('create', $siti, ['module' => 'berita', 'description' => 'log dari siti']);

        $this->actingAs($admin)->get(route('admin.activity-logs.index', ['q' => 'Siti Uji']))
            ->assertOk()
            ->assertSee('log dari siti')
            ->assertDontSee('log dari admin');
    }

    public function test_single_log_can_be_deleted_by_uuid(): void
    {
        $user  = $this->adminUser();
        $actor = User::factory()->create();

        ActivityLogger::log('create', $actor, ['module' => 'berita', 'description' => 'membuat berita "Hapus Saya"']);
        ActivityLogger::log('create', $actor, ['module' => 'berita', 'description' => 'membuat berita "Tetap Ada"']);

        $target = collect(ActivityLogger::readEntries())
            ->firstWhere('description', 'membuat berita "Hapus Saya"');
        $this->assertNotNull($target);

        $this->actingAs($user)
            ->delete(route('admin.activity-logs.destroy', $target['id']))
            ->assertRedirect();

        $descriptions = collect(ActivityLogger::readEntries())->pluck('description');
        $this->assertFalse($descriptions->contains('membuat berita "Hapus Saya"'));
        $this->assertTrue($descriptions->contains('membuat berita "Tetap Ada"'));
    }

    public function test_clear_all_deletes_files_but_records_itself(): void
    {
        $user  = $this->adminUser();
        $actor = User::factory()->create();

        ActivityLogger::log('create', $actor, ['module' => 'berita', 'description' => 'membuat berita "Lama A"']);
        ActivityLogger::log('create', $actor, ['module' => 'pengumuman', 'description' => 'membuat pengumuman "Lama B"']);

        $this->actingAs($user)
            ->delete(route('admin.activity-logs.clear'))
            ->assertRedirect(route('admin.activity-logs.index'));

        // Semua file lama hilang; tersisa tepat 1 entri: catatan pembersihan itu sendiri.
        $entries = ActivityLogger::readEntries();
        $this->assertCount(1, $entries);
        $this->assertSame('clear', $entries[0]['event_type']);
        $this->assertSame($user->id, $entries[0]['actor']['id']);
        $this->assertSame('log', $entries[0]['module']);
    }

    /* =========================================================
       PERMISSION — hanya yang berizinkan boleh akses log
       ========================================================= */

    public function test_user_without_permission_gets_403(): void
    {
        $user = User::factory()->create(); // tanpa role / permission

        $this->actingAs($user)
            ->get(route('admin.activity-logs.index'))
            ->assertForbidden();

        $actor = User::factory()->create();
        ActivityLogger::log('create', $actor, ['module' => 'berita', 'description' => 'membuat berita "X"']);
        $log = ActivityLogger::readEntries()[0];

        $this->actingAs($user)
            ->delete(route('admin.activity-logs.destroy', $log['id']))
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
       DASHBOARD — AKTIVITAS TERBARU (dari file JSONL)
       ========================================================= */

    public function test_dashboard_shows_real_activity_logs_from_files(): void
    {
        $user = User::factory()->create();

        ActivityLogger::log('create', $user, [
            'module'      => 'berita',
            'description' => 'membuat berita "Berita Dashboard Uji"',
        ]);

        $this->actingAs($user)->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Berita Dashboard Uji')
            // Data palsu lama harus sudah tidak ada
            ->assertDontSee('Mendaftar');
    }

    /* =========================================================
       KOMPATIBILITAS & MIGRASI
       ========================================================= */

    public function test_log_stays_when_subject_user_is_deleted(): void
    {
        $admin  = User::factory()->create();
        $victim = User::factory()->create(['name' => 'Akun Dihapus']);

        ActivityLogger::log('delete', $admin, [
            'module'      => 'pengguna',
            'description' => 'menghapus akun pengguna "Akun Dihapus"',
            'subject'     => $victim,
        ]);
        $victim->delete();

        // Log tetap ada walau user subjeknya dihapus (data tersimpan di file).
        $this->assertTrue(collect(ActivityLogger::readEntries())->contains(fn ($e) =>
            ($e['payload']['description'] ?? '') === 'menghapus akun pengguna "Akun Dihapus"'
        ));
    }

    public function test_migrate_command_moves_db_rows_to_daily_files(): void
    {
        // Seed dua baris DB pada hari yang berbeda (user asli agar FK valid).
        $oldActor = User::factory()->create(['name' => 'Admin Lama']);
        $newActor = User::factory()->create(['name' => 'Admin Baru']);

        $older = ActivityLog::create([
            'user_id' => $oldActor->id, 'user_name' => 'Admin Lama', 'user_role' => 'Administrator',
            'module' => 'berita', 'action' => 'create', 'description' => 'membuat berita "Lama"',
            'ip_address' => '127.0.0.1',
        ]);
        $older->created_at = now()->subDays(2);
        $older->save();

        $newer = ActivityLog::create([
            'user_id' => $newActor->id, 'user_name' => 'Admin Baru', 'user_role' => 'Administrator',
            'module' => 'galeri', 'action' => 'delete', 'description' => 'menghapus foto galeri "Baru"',
            'ip_address' => '127.0.0.2',
        ]);
        $newer->created_at = now();
        $newer->save();

        $this->artisan('logs:migrate-db-to-file')->assertSuccessful();

        $entries = collect(ActivityLogger::readEntries());
        $this->assertCount(2, $entries);

        // Timestamp asli dipertahankan → masuk ke file tanggal asalnya.
        $disk = Storage::disk(ActivityLogger::DISK);
        $this->assertTrue($disk->exists('activity-' . now()->subDays(2)->format('Y-m-d') . '.jsonl'));
        $this->assertTrue($disk->exists('activity-' . now()->format('Y-m-d') . '.jsonl'));

        $old = $entries->firstWhere('description', 'membuat berita "Lama"');
        $this->assertNotNull($old);
        $this->assertSame('Admin Lama', $old['actor_name']);
        $this->assertSame('create', $old['event_type']);
        $this->assertSame(now()->subDays(2)->format('Y-m-d'), $old['timestamp']->format('Y-m-d'));
    }
}
