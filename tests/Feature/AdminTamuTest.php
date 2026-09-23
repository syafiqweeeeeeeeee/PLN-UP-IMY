<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Tamu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminTamuTest extends TestCase
{
    use RefreshDatabase;

    /* =========================================================
       HELPERS
       ========================================================= */

    private function adminWithPermissions(array $permissions): User
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name'        => 'Admin Tamu ' . uniqid(),
            'description' => 'Role uji otomatis',
            'status'      => true,
        ]);

        foreach ($permissions as $permission) {
            $perm = Permission::firstOrCreate(
                ['name' => $permission],
                ['display_name' => $permission, 'module' => 'Guest Book']
            );
            $role->permissions()->attach($perm->id);
        }

        $user->roles()->attach($role->id);

        return $user;
    }

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'nik'            => '3201999000000001',
            'nama'           => 'Siti Aminah',
            'instansi'       => 'PT Contoh Sejahtera',
            'no_hp'          => '081298765432',
            'email'          => 'siti@contoh.id',
            'tujuan_ditemui' => 'Divisi IT',
            'jumlah_tamu'    => '3',
            'tanggal_kunjungan' => now()->addDay()->format('Y-m-d\TH:i'),
            'keperluan'      => 'Audit sistem informasi.',
        ], $overrides);
    }

    private function createTamu(array $overrides = []): Tamu
    {
        return Tamu::create(array_merge([
            'nik'            => '3201123456780001',
            'nama'           => 'Budi Santoso',
            'no_hp'          => '081234567890',
            'foto_ktp'       => 'ktp/budi.png',
            'tujuan_ditemui' => 'Divisi Humas',
            'jumlah_tamu'    => 1,
            'tanggal_kunjungan' => now()->addDay(),
            'keperluan'      => 'Kunjungan industri.',
        ], $overrides));
    }

    /* =========================================================
       AKSES & GATE
       ========================================================= */

    public function test_index_requires_tamu_view_permission(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('admin.tamu.index'))
            ->assertForbidden();
    }

    public function test_index_renders_with_data(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu();

        $this->actingAs($admin)
            ->get(route('admin.tamu.index'))
            ->assertOk()
            ->assertSee('Manajemen Data Tamu')
            ->assertSee('Budi Santoso')
            ->assertSee('3201123456780001')
            ->assertSee('Berkunjung');
    }

    /* =========================================================
       STORE — TAMU MANUAL
       ========================================================= */

    public function test_store_creates_tamu_manual_without_ktp(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);

        $this->actingAs($admin)
            ->post(route('admin.tamu.store'), $this->validPayload())
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success');

        $tamu = Tamu::where('nik', '3201999000000001')->first();
        $this->assertNotNull($tamu);
        $this->assertSame('Siti Aminah', $tamu->nama);
        $this->assertNull($tamu->foto_ktp); // tanpa lampiran KTP pun valid
    }

    public function test_store_accepts_optional_ktp_upload(): void
    {
        Storage::fake('public');
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);

        $this->actingAs($admin)
            ->post(route('admin.tamu.store'), $this->validPayload([
                'foto_ktp' => UploadedFile::fake()->image('ktp.png'),
            ]))
            ->assertRedirect(route('admin.tamu.index'));

        $tamu = Tamu::where('nik', '3201999000000001')->first();
        Storage::disk('public')->assertExists($tamu->foto_ktp);
    }

    public function test_store_requires_tamu_create_permission(): void
    {
        $viewer = $this->adminWithPermissions(['tamu.view']);

        $this->actingAs($viewer)
            ->post(route('admin.tamu.store'), $this->validPayload())
            ->assertForbidden();

        $this->assertDatabaseMissing('tamus', ['nik' => '3201999000000001']);
    }

    public function test_store_rejects_duplicate_nik(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);
        $this->createTamu(); // NIK 3201123456780001

        $this->actingAs($admin)
            ->post(route('admin.tamu.store'), $this->validPayload(['nik' => '3201123456780001']))
            ->assertSessionHasErrors(['nik']);
    }

    /* =========================================================
       CHECK-OUT
       ========================================================= */

    public function test_checkout_sets_checked_out_at(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.checkout']);
        $tamu = $this->createTamu();

        $this->actingAs($admin)
            ->patch(route('admin.tamu.checkout', $tamu))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success');

        $this->assertNotNull($tamu->fresh()->checked_out_at);
    }

    public function test_checkout_is_idempotent_guarded(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.checkout']);
        $tamu = $this->createTamu(['checked_out_at' => now()->subHour()]);

        $this->actingAs($admin)
            ->patch(route('admin.tamu.checkout', $tamu))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('error');
    }

    /* =========================================================
       DELETE
       ========================================================= */

    public function test_destroy_deletes_tamu_and_ktp_file(): void
    {
        Storage::fake('public');
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.delete']);
        $tamu = $this->createTamu();
        Storage::disk('public')->put($tamu->foto_ktp, 'dummy');

        $this->actingAs($admin)
            ->delete(route('admin.tamu.destroy', $tamu))
            ->assertRedirect(route('admin.tamu.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('tamus', ['id' => $tamu->id]);
        Storage::disk('public')->assertMissing($tamu->foto_ktp);
    }

    public function test_destroy_requires_tamu_delete_permission(): void
    {
        $viewer = $this->adminWithPermissions(['tamu.view']);
        $tamu = $this->createTamu();

        $this->actingAs($viewer)
            ->delete(route('admin.tamu.destroy', $tamu))
            ->assertForbidden();

        $this->assertDatabaseHas('tamus', ['id' => $tamu->id]);
    }

    /* =========================================================
       FILTER & EXPORT
       ========================================================= */

    public function test_index_filters_by_status(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu(['nama' => 'Tamu Aktif']);
        $this->createTamu([
            'nama'           => 'Tamu Selesai',
            'nik'            => '3201123456780002',
            'checked_out_at' => now()->subHour(),
        ]);

        $this->actingAs($admin)
            ->get(route('admin.tamu.index', ['status' => 'berkunjung']))
            ->assertOk()
            ->assertSee('Tamu Aktif')
            ->assertDontSee('Tamu Selesai');
    }

    public function test_index_search_matches_nama_instansi_nik(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu(['nama' => 'Budi Santoso']);
        $this->createTamu([
            'nama'     => 'Ani Lestari',
            'nik'      => '3201123456780003',
            'instansi' => 'PT Maju Bersama',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.tamu.index', ['q' => 'maju']))
            ->assertOk()
            ->assertSee('Ani Lestari')
            ->assertDontSee('Budi Santoso');
    }

    public function test_export_streams_csv_with_filter(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        $this->createTamu(['nama' => 'Budi Export']);
        $this->createTamu([
            'nama' => 'Ani Tersembunyi',
            'nik'  => '3201123456780004',
        ]);

        $response = $this->actingAs($admin)
            ->get(route('admin.tamu.export', ['q' => 'Budi Export']))
            ->assertOk();

        $this->assertStringContainsString(
            'text/csv',
            (string) $response->headers->get('Content-Type')
        );

        $content = $response->streamedContent();
        $this->assertStringContainsString('Budi Export', $content);
        $this->assertStringNotContainsString('Ani Tersembunyi', $content);
    }
}
