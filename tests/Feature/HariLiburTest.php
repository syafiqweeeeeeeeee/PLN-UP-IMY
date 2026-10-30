<?php

namespace Tests\Feature;

use App\Models\HariLibur;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * HARI LIBUR / TANGGAL MERAH — CRUD panel admin
 * (route admin.hari-libur.*, gate permission hari_libur.* dengan
 * FALLBACK alias ke tamu.*), termasuk 2 TIPE status tanggal: libur
 * (blokir kunjungan) & masuk_kerja (override weekend agar bisa
 * dipilih pengunjung).
 *
 * Pemblokiran/pengizinan tanggal di form registrasi publik diuji di
 * TamuTest (test_store_rejects_tanggal_libur, test_store_menerima_akhir_pekan_di_override).
 */
class HariLiburTest extends TestCase
{
    use RefreshDatabase;

    private function adminWithPermissions(array $permissions): User
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name'        => 'Admin Hari Libur ' . uniqid(),
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

    public function test_index_requires_tamu_view_permission(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('admin.hari-libur.index'))
            ->assertForbidden();
    }

    public function test_index_bisa_diakses_dengan_permission_hari_libur_baru(): void
    {
        // Permission khusus modul (ID Menu 13) — TANPA tamu.* sama sekali.
        $admin = $this->adminWithPermissions(['hari_libur.view']);
        HariLibur::create([
            'tanggal'    => now()->addDays(7)->format('Y-m-d'),
            'keterangan' => 'Libur Perusahaan',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.hari-libur.index'))
            ->assertOk()
            ->assertSee('Libur Perusahaan');
    }

    public function test_fallback_tamu_view_masih_membuka_hari_libur(): void
    {
        // Role lama hanya punya tamu.* → tetap bisa akses (alias fallback).
        $admin = $this->adminWithPermissions(['tamu.view']);

        $this->actingAs($admin)
            ->get(route('admin.hari-libur.index'))
            ->assertOk();
    }

    public function test_matriks_hak_akses_memuat_menu_hari_libur(): void
    {
        // Matriks hanya me-render permission yang BENAR-BENAR terdaftar
        // di tabel permissions → seed dulu (55 baris = set Super Admin).
        $this->seed(\Database\Seeders\PermissionSeeder::class);

        $admin = $this->adminWithPermissions(['roles.create']);

        $response = $this->actingAs($admin)
            ->get(route('admin.roles.create'))
            ->assertOk()
            // Menu tambahan yang ikut matriks = persis set Super Admin.
            ->assertSee('Hari Libur')
            ->assertSee('Data Karyawan')
            ->assertSee('Master Bidang')
            ->assertSee('Master Jabatan')
            ->assertDontSee('contoh'); // baris dummy lama sudah dihapus

        // 55 permission = 1 dashboard + 13 menu × 4 aksi + 2 log (tanpa create/edit).
        $this->assertSame(55, substr_count($response->getContent(), 'name="permissions[]"'));
    }

    public function test_index_renders_daftar_tanggal_merah(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        HariLibur::create([
            'tanggal'    => now()->addDays(7)->format('Y-m-d'),
            'keterangan' => 'Libur Perusahaan',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.hari-libur.index'))
            ->assertOk()
            ->assertSee('Hari Libur / Tanggal Merah')
            ->assertSee('Libur Perusahaan');
    }

    public function test_store_creates_hari_libur(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);
        $tanggal = now()->addDays(3)->format('Y-m-d');

        $this->actingAs($admin)
            ->post(route('admin.hari-libur.store'), [
                'tanggal'    => $tanggal,
                'tipe'       => 'libur',
                'keterangan' => 'Hari Raya Natal',
            ])
            ->assertRedirect(route('admin.hari-libur.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('hari_liburs', [
            'tanggal'    => $tanggal,
            'tipe'       => 'libur',
            'keterangan' => 'Hari Raya Natal',
        ]);
    }

    public function test_store_accepts_tipe_masuk_kerja(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);
        // Sabtu pekan depan — di-override jadi hari kerja khusus.
        $tanggal = now()->next(\Carbon\Carbon::SATURDAY)->format('Y-m-d');

        $this->actingAs($admin)
            ->post(route('admin.hari-libur.store'), [
                'tanggal'    => $tanggal,
                'tipe'       => 'masuk_kerja',
                'keterangan' => 'Lembur Sabtu',
            ])
            ->assertRedirect(route('admin.hari-libur.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('hari_liburs', [
            'tanggal' => $tanggal,
            'tipe'    => 'masuk_kerja',
        ]);
    }

    public function test_store_rejects_tipe_tidak_valid(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);

        $this->actingAs($admin)
            ->post(route('admin.hari-libur.store'), [
                'tanggal'    => now()->addDays(3)->format('Y-m-d'),
                'tipe'       => 'libur-banget',
                'keterangan' => 'Tipe Salah',
            ])
            ->assertSessionHasErrors(['tipe']);

        $this->assertDatabaseCount('hari_liburs', 0);
    }

    public function test_store_rejects_tipe_kosong(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);

        $this->actingAs($admin)
            ->post(route('admin.hari-libur.store'), [
                'tanggal'    => now()->addDays(3)->format('Y-m-d'),
                'keterangan' => 'Tanpa Tipe',
            ])
            ->assertSessionHasErrors(['tipe']);

        $this->assertDatabaseCount('hari_liburs', 0);
    }

    public function test_index_menampilkan_badge_tipe(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);
        HariLibur::create([
            'tanggal'    => now()->addDays(7)->format('Y-m-d'),
            'tipe'       => 'libur',
            'keterangan' => 'Libur Perusahaan',
        ]);
        HariLibur::create([
            'tanggal'    => now()->addDays(8)->format('Y-m-d'),
            'tipe'       => 'masuk_kerja',
            'keterangan' => 'Sabtu Kerja',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.hari-libur.index'))
            ->assertOk()
            ->assertSee('hl-badge libur', false)
            ->assertSee('hl-badge masuk_kerja', false)
            ->assertSee('Masuk Kerja');
    }

    public function test_store_requires_tamu_create_permission(): void
    {
        $viewer = $this->adminWithPermissions(['tamu.view']);

        $this->actingAs($viewer)
            ->post(route('admin.hari-libur.store'), [
                'tanggal'    => now()->addDays(3)->format('Y-m-d'),
                'keterangan' => 'Libur',
            ])
            ->assertForbidden();

        $this->assertDatabaseCount('hari_liburs', 0);
    }

    public function test_store_rejects_duplicate_tanggal(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);
        $tanggal = now()->addDays(3)->format('Y-m-d');
        HariLibur::create(['tanggal' => $tanggal, 'keterangan' => 'Sudah Ada']);

        $this->actingAs($admin)
            ->post(route('admin.hari-libur.store'), [
                'tanggal'    => $tanggal,
                'tipe'       => 'libur',
                'keterangan' => 'Duplikat',
            ])
            ->assertSessionHasErrors(['tanggal']);

        $this->assertDatabaseCount('hari_liburs', 1);
    }

    public function test_store_rejects_tanggal_lampau(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);

        $this->actingAs($admin)
            ->post(route('admin.hari-libur.store'), [
                'tanggal'    => now()->subDay()->format('Y-m-d'),
                'tipe'       => 'libur',
                'keterangan' => 'Libur Lampau',
            ])
            ->assertSessionHasErrors(['tanggal']);
    }

    public function test_store_rejects_keterangan_kosong(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.create']);

        $this->actingAs($admin)
            ->post(route('admin.hari-libur.store'), [
                'tanggal'    => now()->addDays(3)->format('Y-m-d'),
                'tipe'       => 'libur',
                'keterangan' => '',
            ])
            ->assertSessionHasErrors(['keterangan']);
    }

    public function test_update_mengubah_tanggal_dan_keterangan(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.edit']);
        $libur = HariLibur::create([
            'tanggal'    => now()->addDays(5)->format('Y-m-d'),
            'keterangan' => 'Nama Lama',
        ]);
        $baru = now()->addDays(9)->format('Y-m-d');

        $this->actingAs($admin)
            ->put(route('admin.hari-libur.update', $libur), [
                'tanggal'    => $baru,
                'tipe'       => 'libur',
                'keterangan' => 'Nama Baru',
            ])
            ->assertRedirect(route('admin.hari-libur.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('hari_liburs', [
            'id'         => $libur->id,
            'tanggal'    => $baru,
            'keterangan' => 'Nama Baru',
        ]);
    }

    public function test_update_mengubah_tipe(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.edit']);
        $libur = HariLibur::create([
            'tanggal'    => now()->addDays(5)->format('Y-m-d'),
            'tipe'       => 'libur',
            'keterangan' => 'Tadinya Libur',
        ]);

        $this->actingAs($admin)
            ->put(route('admin.hari-libur.update', $libur), [
                'tanggal'    => $libur->tanggal->format('Y-m-d'),
                'tipe'       => 'masuk_kerja',
                'keterangan' => 'Jadi Hari Kerja Khusus',
            ])
            ->assertRedirect(route('admin.hari-libur.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('hari_liburs', [
            'id'   => $libur->id,
            'tipe' => 'masuk_kerja',
        ]);
    }

    public function test_update_requires_tamu_edit_permission(): void
    {
        $viewer = $this->adminWithPermissions(['tamu.view']);
        $libur = HariLibur::create([
            'tanggal'    => now()->addDays(5)->format('Y-m-d'),
            'keterangan' => 'Tetap',
        ]);

        $this->actingAs($viewer)
            ->put(route('admin.hari-libur.update', $libur), [
                'tanggal'    => now()->addDays(5)->format('Y-m-d'),
                'keterangan' => 'Berubah',
            ])
            ->assertForbidden();

        $this->assertSame('Tetap', $libur->fresh()->keterangan);
    }

    public function test_destroy_menghapus_hari_libur(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view', 'tamu.delete']);
        $libur = HariLibur::create([
            'tanggal'    => now()->addDays(5)->format('Y-m-d'),
            'keterangan' => 'Akan Dihapus',
        ]);

        $this->actingAs($admin)
            ->delete(route('admin.hari-libur.destroy', $libur))
            ->assertRedirect(route('admin.hari-libur.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('hari_liburs', ['id' => $libur->id]);
    }
}
