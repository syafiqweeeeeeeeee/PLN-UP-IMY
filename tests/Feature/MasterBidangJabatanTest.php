<?php

namespace Tests\Feature;

use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\WorkLink;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * MASTER BIDANG & MASTER JABATAN (panel admin).
 *
 * Mencakup spesifikasi pengujian:
 * - Pembuatan, pengubahan, penghapusan data.
 * - Relasi parent-child + hierarki bertingkat; parent boleh kosong.
 * - Parent tidak valid (tidak ada di tabelnya sendiri), parent = diri
 *   sendiri, siklus hierarki multi-tingkat — semuanya ditolak
 *   server-side.
 * - Proteksi penghapusan: masih punya child, masih dipakai jabatan
 *   (bidang), masih dipakai data karyawan — dengan pesan jelas.
 * - Otorisasi memakai RBAC yang ada (permission master_bidang.* /
 *   master_jabatan.* via PermissionSeeder; halaman di /admin —
 *   karyawan masuk sebagai "half-admin" berpermission ekstra) —
 *   tanpa sistem otorisasi baru.
 * - Data karyawan TIDAK diubah otomatis oleh fitur ini.
 */
class MasterBidangJabatanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(PermissionSeeder::class);
    }

    /* =========================================================
       HELPER
       ========================================================= */

    private const ALL_PERMISSIONS = [
        'master_bidang.view', 'master_bidang.create', 'master_bidang.edit', 'master_bidang.delete',
        'master_jabatan.view', 'master_jabatan.create', 'master_jabatan.edit', 'master_jabatan.delete',
    ];

    /**
     * Akun tanpa role + direct permission tertentu — lolos admin.access
     * (akun tanpa role diteruskan, pola test RBAC lain) sehingga pengujian
     * mengukur permission:master_* secara murni.
     */
    private function masterUser(array $permissions = self::ALL_PERMISSIONS): User
    {
        $user = User::factory()->create();
        $user->syncPermissions(
            Permission::whereIn('name', $permissions)->pluck('id')->all()
        );

        return $user;
    }

    /**
     * Akun role Karyawan — akses master via permission yang di-assign ke
     * ROLE (Kelola Permission). Karena di luar baseline karyawan, itu
     * termasuk "permission ekstra" sehingga akun boleh masuk /admin
     * (aturan EnsureNotKaryawan yang sudah ada).
     */
    private function karyawanRoleUser(bool $withMasterPermission = true): User
    {
        $role = Role::firstOrCreate(
            ['name' => 'Karyawan'],
            ['description' => 'Pengguna internal / karyawan', 'status' => true]
        );

        if ($withMasterPermission) {
            $role->permissions()->syncWithoutDetaching(
                Permission::whereIn('name', self::ALL_PERMISSIONS)->pluck('id')->all()
            );
        }

        $user = User::factory()->create(['role' => 'Karyawan', 'role_id' => $role->id]);
        $user->roles()->syncWithoutDetaching([$role->id]);

        return $user;
    }

    /** Data karyawan fixture (hanya untuk menguji proteksi hapus). */
    private function karyawanUsing(string $bidang, string $jabatan): Karyawan
    {
        return Karyawan::create([
            'nid'    => str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'nama'   => 'Karyawan Uji',
            'bidang' => $bidang,
            'jabatan' => $jabatan,
        ]);
    }

    /**
     * Cari id yang ADA di jabatans tetapi TIDAK ADA di bidangs.
     * (AUTO_INCREMENT dua tabel terpisah & tidak di-reset antar test,
     * jadi kandidatnya dicari eksplisit — bukan asumsi id.)
     */
    private function jabatanIdNotInBidangs(Bidang $bidang): int
    {
        for ($i = 0; $i < 50; $i++) {
            $kandidat = Jabatan::create([
                'nama'      => "Kandidat Silang {$i}",
                'bidang_id' => $bidang->id,
            ]);

            if (Bidang::find($kandidat->id) === null) {
                return (int) $kandidat->id;
            }
        }

        $this->fail('Tidak menemukan id jabatan yang tidak ada di bidangs.');
    }

    /* =========================================================
       1. REGISTRASI PERMISSION & OTORISASI (RBAC YANG ADA)
       ========================================================= */

    public function test_permission_rows_registered_by_seeder(): void
    {
        foreach (self::ALL_PERMISSIONS as $name) {
            $this->assertDatabaseHas('permissions', ['name' => $name]);
        }

        // Super Admin mendapat semua permission yang terdaftar (pola seeder).
        $superAdmin = Role::firstOrCreate(
            ['name' => User::SUPER_ADMIN_ROLE],
            ['description' => 'Super Admin', 'status' => true]
        );
        $superAdmin->permissions()->sync(
            Permission::whereIn('name', self::ALL_PERMISSIONS)->pluck('id')->all()
        );

        $this->assertSame(
            count(self::ALL_PERMISSIONS),
            $superAdmin->permissions()->whereIn('name', self::ALL_PERMISSIONS)->count()
        );
    }

    public function test_admin_master_pages_require_permission(): void
    {
        $user = $this->masterUser([]); // tanpa permission sama sekali

        $this->actingAs($user)->get(route('admin.master_bidang.index'))->assertForbidden();
        $this->actingAs($user)->get(route('admin.master_jabatan.index'))->assertForbidden();
        $this->actingAs($user)
            ->post(route('admin.master_bidang.store'), ['nama' => 'X'])
            ->assertForbidden();
    }

    public function test_view_permission_cannot_create(): void
    {
        $user = $this->masterUser(['master_bidang.view']);

        $this->actingAs($user)->get(route('admin.master_bidang.index'))->assertOk();
        $this->actingAs($user)->get(route('admin.master_bidang.create'))->assertForbidden();
        $this->actingAs($user)
            ->post(route('admin.master_bidang.store'), ['nama' => 'Tanpa Akses'])
            ->assertForbidden();
        $this->assertDatabaseMissing('bidangs', ['nama' => 'Tanpa Akses']);
    }

    public function test_super_admin_can_open_master_pages(): void
    {
        $admin = User::factory()->create([
            'role'    => User::SUPER_ADMIN_ROLE,
            'role_id' => Role::firstOrCreate(
                ['name' => User::SUPER_ADMIN_ROLE],
                ['description' => 'Super Admin', 'status' => true]
            )->id,
        ]);
        $admin->roles()->syncWithoutDetaching([
            Role::where('name', User::SUPER_ADMIN_ROLE)->value('id'),
        ]);

        // Super Admin mendapat semua permission master dari PermissionSeeder
        // → halaman terbuka penuh dari sidebar panel admin.
        $this->actingAs($admin)->get(route('admin.master_bidang.index'))->assertOk();
        $this->actingAs($admin)->get(route('admin.master_jabatan.index'))->assertOk();
    }

    public function test_karyawan_role_user_with_role_grant_can_open_master_pages(): void
    {
        // Role Karyawan TANPA assign → ditolak masuk /admin
        // (aturan admin.access lama, redirect ramah ke portal).
        // Dibuat DULU sebelum grant, supaya benar-benar bersih.
        $plain = $this->karyawanRoleUser(false);
        $this->actingAs($plain)
            ->get(route('admin.master_bidang.index'))
            ->assertRedirect(route('karyawan.dashboard'));

        // Role Karyawan DENGAN permission master (assign Kelola Permission)
        // → halaman terbuka (permission = ekstra, lolos admin.access).
        $user = $this->karyawanRoleUser();
        $this->actingAs($user)->get(route('admin.master_bidang.index'))->assertOk();
        $this->actingAs($user)->get(route('admin.master_jabatan.index'))->assertOk();
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get(route('admin.master_bidang.index'))->assertRedirect(route('login'));
    }

    public function test_admin_sidebar_shows_master_links_only_with_permission(): void
    {
        // Punya permission → link Master muncul di sidebar panel admin.
        $authorized = $this->masterUser(['master_bidang.view', 'master_jabatan.view']);
        $this->actingAs($authorized)->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Master Bidang')
            ->assertSee('Master Jabatan');

        // Tanpa permission → link tidak tampil sama sekali.
        $plain = $this->masterUser([]);
        $this->actingAs($plain)->get(route('admin.dashboard'))
            ->assertOk()
            ->assertDontSee('Master Bidang')
            ->assertDontSee('Master Jabatan');
    }

    /* =========================================================
       2. BIDANG — INDEX, CREATE, SHOW, UPDATE
       ========================================================= */

    public function test_index_renders_hierarchy_table(): void
    {
        $root  = Bidang::create(['nama' => 'Teknik']);
        $child = Bidang::create(['nama' => 'Pembangkitan', 'parent_id' => $root->id]);

        $this->actingAs($this->masterUser())
            ->get(route('admin.master_bidang.index'))
            ->assertOk()
            ->assertSee('Master Bidang')
            ->assertSee('Teknik')
            ->assertSee('Pembangkitan')
            ->assertSee('tingkat atas')   // parent kolom root
            ->assertSee('tingkat 2');     // indentasi child
    }

    public function test_store_creates_top_level_bidang_when_parent_empty(): void
    {
        $this->actingAs($this->masterUser(['master_bidang.create']))
            ->post(route('admin.master_bidang.store'), ['nama' => 'Operasi'])
            ->assertRedirect(route('admin.master_bidang.index'))
            ->assertSessionHas('success');

        $bidang = Bidang::where('nama', 'Operasi')->firstOrFail();
        $this->assertNull($bidang->parent_id); // parent kosong = tingkat teratas
    }

    public function test_store_creates_child_bidang_with_valid_parent(): void
    {
        $root = Bidang::create(['nama' => 'Induk']);

        $this->actingAs($this->masterUser(['master_bidang.create']))
            ->post(route('admin.master_bidang.store'), [
                'nama'      => 'Anak',
                'parent_id' => $root->id,
            ])
            ->assertRedirect(route('admin.master_bidang.index'));

        $child = Bidang::where('nama', 'Anak')->firstOrFail();
        $this->assertSame($root->id, (int) $child->parent_id);
        $this->assertSame($root->id, (int) $child->parent->id); // relasi parent→bidang
        $this->assertTrue($root->children->contains('id', $child->id)); // relasi child
    }

    public function test_show_displays_parent_and_children(): void
    {
        $root  = Bidang::create(['nama' => 'Induk Bidang']);
        $child = Bidang::create(['nama' => 'Child Bidang', 'parent_id' => $root->id]);

        $this->actingAs($this->masterUser())
            ->get(route('admin.master_bidang.show', $root))
            ->assertOk()
            ->assertSee('Induk Bidang')
            ->assertSee('Child Bidang'); // child tercantum di halaman induk

        $this->actingAs($this->masterUser())
            ->get(route('admin.master_bidang.show', $child))
            ->assertOk()
            ->assertSee('Induk Bidang'); // parent tercantum di halaman child
    }

    public function test_update_moves_bidang_to_new_parent(): void
    {
        $a = Bidang::create(['nama' => 'A']);
        $b = Bidang::create(['nama' => 'B']);

        $this->actingAs($this->masterUser(['master_bidang.edit']))
            ->put(route('admin.master_bidang.update', $a), [
                'nama'      => 'A Baru',
                'parent_id' => $b->id,
            ])
            ->assertRedirect(route('admin.master_bidang.index'))
            ->assertSessionHas('success');

        $a->refresh();
        $this->assertSame('A Baru', $a->nama);
        $this->assertSame($b->id, (int) $a->parent_id);
    }

    /* =========================================================
       3. BIDANG — VALIDASI RELASI (SERVER-SIDE)
       ========================================================= */

    public function test_form_pages_render_for_both_modules(): void
    {
        $bidang  = Bidang::create(['nama' => 'Untuk Form']);
        $jabatan = Jabatan::create(['nama' => 'Jabatan Form', 'bidang_id' => $bidang->id]);
        $user = $this->masterUser();

        $this->actingAs($user)->get(route('admin.master_bidang.create'))
            ->assertOk()->assertSee('Tambah Bidang Baru');
        $this->actingAs($user)->get(route('admin.master_bidang.edit', $bidang))
            ->assertOk()->assertSee('Edit Bidang');
        $this->actingAs($user)->get(route('admin.master_jabatan.create'))
            ->assertOk()->assertSee('Tambah Jabatan Baru');
        $this->actingAs($user)->get(route('admin.master_jabatan.edit', $jabatan))
            ->assertOk()->assertSee('Edit Jabatan');
    }

    public function test_bidang_parent_must_exist_in_bidangs_table(): void
    {
        // parent_id harus ditolak karena hanya boleh mengarah ke
        // bidangs.id — kandidat id diambil dari jabatans (bukan bidangs).
        $bidang = Bidang::create(['nama' => 'Satu']);
        $idMilikJabatan = $this->jabatanIdNotInBidangs($bidang);

        $this->actingAs($this->masterUser(['master_bidang.create']))
            ->post(route('admin.master_bidang.store'), [
                'nama'      => 'Salah Parent',
                'parent_id' => $idMilikJabatan, // id milik jabatan, bukan bidang
            ])
            ->assertSessionHasErrors('parent_id');

        $this->assertDatabaseMissing('bidangs', ['nama' => 'Salah Parent']);
    }

    public function test_bidang_name_is_required(): void
    {
        $this->actingAs($this->masterUser(['master_bidang.create']))
            ->post(route('admin.master_bidang.store'), [])
            ->assertSessionHasErrors('nama');
    }

    public function test_bidang_cannot_choose_itself_as_parent(): void
    {
        $bidang = Bidang::create(['nama' => 'Diri Sendiri']);

        $this->actingAs($this->masterUser(['master_bidang.edit']))
            ->put(route('admin.master_bidang.update', $bidang), [
                'nama'      => 'Diri Sendiri',
                'parent_id' => $bidang->id, // ← parent = diri sendiri
            ])
            ->assertSessionHasErrors('parent_id');

        $this->assertNull($bidang->fresh()->parent_id); // tidak berubah
    }

    public function test_bidang_blocks_multilevel_cycle(): void
    {
        // A → B → C, lalu A dipindah jadi child C = siklus.
        $a = Bidang::create(['nama' => 'A']);
        $b = Bidang::create(['nama' => 'B', 'parent_id' => $a->id]);
        $c = Bidang::create(['nama' => 'C', 'parent_id' => $b->id]);

        $response = $this->actingAs($this->masterUser(['master_bidang.edit']))
            ->put(route('admin.master_bidang.update', $a), [
                'nama'      => 'A',
                'parent_id' => $c->id,
            ]);

        $response->assertSessionHasErrors('parent_id');
        $this->assertStringContainsString(
            'siklus',
            session('errors')->first('parent_id')
        );
        $this->assertNull($a->fresh()->parent_id); // hierarki lama utuh
    }

    /* =========================================================
       4. BIDANG — PROTEKSI PENGHAPUSAN
       ========================================================= */

    public function test_delete_leaf_bidang_succeeds(): void
    {
        $bidang = Bidang::create(['nama' => 'Tanpa Child']);

        $this->actingAs($this->masterUser(['master_bidang.delete']))
            ->delete(route('admin.master_bidang.destroy', $bidang))
            ->assertRedirect(route('admin.master_bidang.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('bidangs', ['id' => $bidang->id]);
    }

    public function test_delete_bidang_with_children_is_blocked(): void
    {
        $root  = Bidang::create(['nama' => 'Induk']);
        $child = Bidang::create(['nama' => 'Anak', 'parent_id' => $root->id]);

        $this->actingAs($this->masterUser(['master_bidang.delete']))
            ->delete(route('admin.master_bidang.destroy', $root))
            ->assertRedirect(route('admin.master_bidang.index'))
            ->assertSessionHasErrors('delete');

        $this->assertStringContainsString('sub-bidang', session('errors')->first('delete'));
        $this->assertDatabaseHas('bidangs', ['id' => $root->id]); // tetap ada
        $this->assertDatabaseHas('bidangs', ['id' => $child->id]);
    }

    public function test_delete_bidang_used_by_jabatan_is_blocked(): void
    {
        $bidang = Bidang::create(['nama' => 'Dipakai Jabatan']);
        Jabatan::create(['nama' => 'Kepala', 'bidang_id' => $bidang->id]);

        $this->actingAs($this->masterUser(['master_bidang.delete']))
            ->delete(route('admin.master_bidang.destroy', $bidang))
            ->assertSessionHasErrors('delete');

        $this->assertStringContainsString('jabatan', session('errors')->first('delete'));
        $this->assertDatabaseHas('bidangs', ['id' => $bidang->id]);
    }

    public function test_delete_bidang_used_by_work_link_is_blocked(): void
    {
        $bidang = Bidang::create(['nama' => 'Target Link Kerja']);
        WorkLink::create([
            'title' => 'Link Terikat Bidang',
            'url' => 'https://link.pln.co.id',
            'category' => 'khusus',
            'bidang_id' => $bidang->id,
            'is_active' => true,
        ]);

        $this->actingAs($this->masterUser(['master_bidang.delete']))
            ->delete(route('admin.master_bidang.destroy', $bidang))
            ->assertRedirect(route('admin.master_bidang.index'))
            ->assertSessionHasErrors('delete');

        $this->assertStringContainsString('Link Kerja', session('errors')->first('delete'));
        $this->assertDatabaseHas('bidangs', ['id' => $bidang->id]);
        $this->assertDatabaseHas('work_links', [
            'title' => 'Link Terikat Bidang',
            'bidang_id' => $bidang->id,
        ]);
    }

    public function test_delete_bidang_used_by_karyawan_is_blocked_and_data_untouched(): void
    {
        $bidang  = Bidang::create(['nama' => 'Dipakai Karyawan']);
        $karyawan = $this->karyawanUsing('Dipakai Karyawan', 'Staf');

        $this->actingAs($this->masterUser(['master_bidang.delete']))
            ->delete(route('admin.master_bidang.destroy', $bidang))
            ->assertRedirect(route('admin.master_bidang.index'))
            ->assertSessionHasErrors('delete');

        $message = session('errors')->first('delete');
        $this->assertStringContainsString('data karyawan', $message);
        $this->assertStringContainsString('1 data karyawan', $message);

        $this->assertDatabaseHas('bidangs', ['id' => $bidang->id]);
        // Kolom BIDANG karyawan tidak diubah / dihapus oleh fitur ini.
        $this->assertDatabaseHas('karyawans', [
            'id'     => $karyawan->id,
            'bidang' => 'Dipakai Karyawan',
        ]);
    }

    /* =========================================================
       5. JABATAN — CREATE, INDEX, SHOW, UPDATE
       ========================================================= */

    public function test_store_creates_jabatan_with_bidang_and_parent(): void
    {
        $bidang = Bidang::create(['nama' => 'Teknik']);
        $root   = Jabatan::create(['nama' => 'Manajer', 'bidang_id' => $bidang->id]);

        $this->actingAs($this->masterUser(['master_jabatan.create']))
            ->post(route('admin.master_jabatan.store'), [
                'nama'      => 'Kepala Seksi',
                'bidang_id' => $bidang->id,
                'parent_id' => $root->id,
            ])
            ->assertRedirect(route('admin.master_jabatan.index'))
            ->assertSessionHas('success');

        $jabatan = Jabatan::where('nama', 'Kepala Seksi')->firstOrFail();
        $this->assertSame($bidang->id, (int) $jabatan->bidang_id);
        $this->assertSame($root->id, (int) $jabatan->parent_id);
        $this->assertSame($bidang->id, (int) $jabatan->bidang->id); // relasi → bidang
    }

    public function test_jabatan_index_shows_bidang_parent_and_children(): void
    {
        $bidang = Bidang::create(['nama' => 'Operasi Listrik']);
        $root   = Jabatan::create(['nama' => 'Supervisor', 'bidang_id' => $bidang->id]);
        Jabatan::create(['nama' => 'Teknisi', 'bidang_id' => $bidang->id, 'parent_id' => $root->id]);

        $this->actingAs($this->masterUser())
            ->get(route('admin.master_jabatan.index'))
            ->assertOk()
            ->assertSee('Master Jabatan')
            ->assertSee('Operasi Listrik') // nama bidang tampil
            ->assertSee('Supervisor')
            ->assertSee('Teknisi')
            ->assertSee('tingkat 2'); // hierarki child
    }

    public function test_jabatan_requires_bidang(): void
    {
        $this->actingAs($this->masterUser(['master_jabatan.create']))
            ->post(route('admin.master_jabatan.store'), ['nama' => 'Tanpa Bidang'])
            ->assertSessionHasErrors('bidang_id');
    }

    public function test_jabatan_bidang_must_exist_in_bidangs_table(): void
    {
        // bidang_id harus ditolak — kandidat id diambil dari jabatans.
        $bidang = Bidang::create(['nama' => 'Satu']);
        $idMilikJabatan = $this->jabatanIdNotInBidangs($bidang);

        $this->actingAs($this->masterUser(['master_jabatan.create']))
            ->post(route('admin.master_jabatan.store'), [
                'nama'      => 'Salah Bidang',
                'bidang_id' => $idMilikJabatan, // id milik jabatan, bukan bidang
            ])
            ->assertSessionHasErrors('bidang_id');

        $this->assertDatabaseMissing('jabatans', ['nama' => 'Salah Bidang']);
    }

    public function test_jabatan_parent_must_exist_in_jabatans_table(): void
    {
        $bidang = Bidang::create(['nama' => 'Satu']);

        // parent_id = id bidang yang tidak dimiliki jabatan manapun.
        $this->actingAs($this->masterUser(['master_jabatan.create']))
            ->post(route('admin.master_jabatan.store'), [
                'nama'      => 'Salah Parent',
                'bidang_id' => $bidang->id,
                'parent_id' => 999999,
            ])
            ->assertSessionHasErrors('parent_id');

        $this->assertDatabaseMissing('jabatans', ['nama' => 'Salah Parent']);
    }

    public function test_jabatan_cannot_choose_itself_as_parent(): void
    {
        $bidang  = Bidang::create(['nama' => 'Satu']);
        $jabatan = Jabatan::create(['nama' => 'Diri', 'bidang_id' => $bidang->id]);

        $this->actingAs($this->masterUser(['master_jabatan.edit']))
            ->put(route('admin.master_jabatan.update', $jabatan), [
                'nama'      => 'Diri',
                'bidang_id' => $bidang->id,
                'parent_id' => $jabatan->id,
            ])
            ->assertSessionHasErrors('parent_id');

        $this->assertNull($jabatan->fresh()->parent_id);
    }

    public function test_jabatan_blocks_multilevel_cycle(): void
    {
        $bidang = Bidang::create(['nama' => 'Satu']);
        $a = Jabatan::create(['nama' => 'A', 'bidang_id' => $bidang->id]);
        $b = Jabatan::create(['nama' => 'B', 'bidang_id' => $bidang->id, 'parent_id' => $a->id]);
        $c = Jabatan::create(['nama' => 'C', 'bidang_id' => $bidang->id, 'parent_id' => $b->id]);

        $this->actingAs($this->masterUser(['master_jabatan.edit']))
            ->put(route('admin.master_jabatan.update', $a), [
                'nama'      => 'A',
                'bidang_id' => $bidang->id,
                'parent_id' => $c->id, // ← leluhur jadi child = siklus
            ])
            ->assertSessionHasErrors('parent_id');

        $this->assertStringContainsString(
            'siklus',
            session('errors')->first('parent_id')
        );
        $this->assertNull($a->fresh()->parent_id);
    }

    public function test_update_moves_jabatan_to_another_bidang(): void
    {
        $b1  = Bidang::create(['nama' => 'Bidang Satu']);
        $b2  = Bidang::create(['nama' => 'Bidang Dua']);
        $j   = Jabatan::create(['nama' => 'Staf', 'bidang_id' => $b1->id]);

        $this->actingAs($this->masterUser(['master_jabatan.edit']))
            ->put(route('admin.master_jabatan.update', $j), [
                'nama'      => 'Staf',
                'bidang_id' => $b2->id,
                'parent_id' => '',
            ])
            ->assertRedirect(route('admin.master_jabatan.index'))
            ->assertSessionHas('success');

        $j->refresh();
        $this->assertSame($b2->id, (int) $j->bidang_id);
        $this->assertNull($j->parent_id); // parent kosong = tingkat teratas
    }

    /* =========================================================
       6. JABATAN — PROTEKSI PENGHAPUSAN
       ========================================================= */

    public function test_delete_leaf_jabatan_succeeds(): void
    {
        $bidang  = Bidang::create(['nama' => 'Satu']);
        $jabatan = Jabatan::create(['nama' => 'Bisa Dihapus', 'bidang_id' => $bidang->id]);

        $this->actingAs($this->masterUser(['master_jabatan.delete']))
            ->delete(route('admin.master_jabatan.destroy', $jabatan))
            ->assertRedirect(route('admin.master_jabatan.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('jabatans', ['id' => $jabatan->id]);
        $this->assertDatabaseHas('bidangs', ['id' => $bidang->id]); // bidang tetap
    }

    public function test_delete_jabatan_with_children_is_blocked(): void
    {
        $bidang = Bidang::create(['nama' => 'Satu']);
        $root   = Jabatan::create(['nama' => 'Induk Jabatan', 'bidang_id' => $bidang->id]);
        $child  = Jabatan::create(['nama' => 'Anak Jabatan', 'bidang_id' => $bidang->id, 'parent_id' => $root->id]);

        $this->actingAs($this->masterUser(['master_jabatan.delete']))
            ->delete(route('admin.master_jabatan.destroy', $root))
            ->assertSessionHasErrors('delete');

        $this->assertStringContainsString('jabatan anak', session('errors')->first('delete'));
        $this->assertDatabaseHas('jabatans', ['id' => $root->id]);
        $this->assertDatabaseHas('jabatans', ['id' => $child->id]);
    }

    public function test_delete_jabatan_used_by_karyawan_is_blocked_and_data_untouched(): void
    {
        $bidang   = Bidang::create(['nama' => 'Satu']);
        $jabatan  = Jabatan::create(['nama' => 'Jabatan Terpakai', 'bidang_id' => $bidang->id]);
        $karyawan = $this->karyawanUsing('Operasi', 'Jabatan Terpakai');

        $this->actingAs($this->masterUser(['master_jabatan.delete']))
            ->delete(route('admin.master_jabatan.destroy', $jabatan))
            ->assertRedirect(route('admin.master_jabatan.index'))
            ->assertSessionHasErrors('delete');

        $this->assertStringContainsString('data karyawan', session('errors')->first('delete'));
        $this->assertDatabaseHas('jabatans', ['id' => $jabatan->id]);
        // Kolom JABATAN karyawan tidak diubah / dihapus oleh fitur ini.
        $this->assertDatabaseHas('karyawans', [
            'id'      => $karyawan->id,
            'jabatan' => 'Jabatan Terpakai',
        ]);
    }

    /* =========================================================
       7. INTEGRASI — TIDAK MENGUBAH DATA KARYAWAN YANG ADA
       ========================================================= */

    public function test_full_flow_leaves_existing_karyawan_rows_unchanged(): void
    {
        $karyawan = $this->karyawanUsing('Bidang Lama', 'Jabatan Lama');
        $before = $karyawan->fresh()->toArray();

        // Alur lengkap: buat bidang+jabatan, ubah, hapus keduanya (leaf).
        $bidang = Bidang::create(['nama' => 'Bidang Baru']);
        $jabatan = Jabatan::create(['nama' => 'Jabatan Baru', 'bidang_id' => $bidang->id]);

        $this->actingAs($this->masterUser(['master_bidang.edit']))
            ->put(route('admin.master_bidang.update', $bidang), [
                'nama'      => 'Bidang Baru Diubah',
                'parent_id' => '',
            ])->assertSessionHas('success');

        $this->actingAs($this->masterUser(['master_jabatan.delete']))
            ->delete(route('admin.master_jabatan.destroy', $jabatan))
            ->assertSessionHas('success');
        $this->actingAs($this->masterUser(['master_bidang.delete']))
            ->delete(route('admin.master_bidang.destroy', $bidang))
            ->assertSessionHas('success');

        // Baris karyawan existing identik dengan sebelum alur.
        $this->assertSame($before, $karyawan->fresh()->toArray());
        $this->assertDatabaseHas('karyawans', [
            'id'      => $karyawan->id,
            'bidang'  => 'Bidang Lama',
            'jabatan' => 'Jabatan Lama',
        ]);
    }

    /* =========================================================
       8. KODE LEGACY (department_code / sub_department_code)
       ------------------------------------------------------------
       - Dropdown Link Kerja menampilkan SEMUA baris Master Bidang,
         termasuk yang belum punya kode legacy (fix dropdown kosong).
       - Form Master Bidang bisa mengisi kode legacy & validasi kode
         tidak sah ditolak server-side.
       - Fitur "Petakan Kode Legacy": pratinjau tidak menulis apa pun,
         penerapan mengisi kode yang masih kosong, tidak menimpa kode
         lama, tidak menebak baris yang tidak cocok, dan idempoten.
       ========================================================= */

    public function test_work_link_form_lists_master_bidangs_without_legacy_codes(): void
    {
        $bidang = Bidang::create(['nama' => 'BIDANG UJI LINK KERJA']);
        $sub    = Bidang::create(['nama' => 'SUB BIDANG UJI', 'parent_id' => $bidang->id]);

        // Keduanya sengaja TANPA kode legacy — tetap harus tampil.
        $this->assertNull($bidang->departmentCode());
        $this->assertNull($sub->departmentCode());

        $user = $this->masterUser(array_merge(self::ALL_PERMISSIONS, ['work_links.create']));

        $this->actingAs($user)
            ->get(route('admin.work-links.create'))
            ->assertOk()
            ->assertSee('BIDANG UJI LINK KERJA')
            ->assertSee('SUB BIDANG UJI');
    }

    public function test_master_bidang_form_accepts_and_validates_legacy_codes(): void
    {
        $user = $this->masterUser(['master_bidang.view', 'master_bidang.create', 'master_bidang.edit']);

        $this->actingAs($user)
            ->get(route('admin.master_bidang.create'))
            ->assertOk()
            ->assertSee('Kode Legacy', false);

        $this->actingAs($user)
            ->post(route('admin.master_bidang.store'), [
                'nama'                 => 'BIDANG UJI KODE',
                'parent_id'            => '',
                'department_code'      => 'operasi',
                'sub_department_code'  => 'asmen_prod_a',
            ])
            ->assertRedirect(route('admin.master_bidang.index'));

        $this->assertDatabaseHas('bidangs', [
            'nama'                => 'BIDANG UJI KODE',
            'department_code'     => 'operasi',
            'sub_department_code' => 'asmen_prod_a',
        ]);

        // Kode di luar daftar legacy ditolak — tidak ada baris tersimpan.
        $this->actingAs($user)
            ->post(route('admin.master_bidang.store'), [
                'nama'            => 'BIDANG UJI KODE TOLAK',
                'department_code' => 'kode_ngawur',
            ])
            ->assertSessionHasErrors('department_code');

        $this->assertDatabaseMissing('bidangs', ['nama' => 'BIDANG UJI KODE TOLAK']);

        // Mengosongkan field saat EDIT → kode ikut dikosongkan (explicit clear).
        $bidang = Bidang::create(['nama' => 'BIDANG UJI KOSONG', 'department_code' => 'operasi']);

        $this->actingAs($user)
            ->put(route('admin.master_bidang.update', $bidang), [
                'nama'                 => 'BIDANG UJI KOSONG',
                'parent_id'            => '',
                'department_code'      => '',
                'sub_department_code'  => '',
            ])
            ->assertSessionHas('success');

        $this->assertNull($bidang->fresh()->department_code);
    }

    public function test_map_legacy_codes_preview_writes_nothing(): void
    {
        $this->seedLegacyFixture();

        $json = $this->actingAs($this->masterUser())
            ->getJson(route('admin.master_bidang.map-legacy-preview'))
            ->assertOk()
            ->json();

        $this->assertSame(5, $json['rows']);
        $this->assertSame(3, $json['rows_updated'], 'Induk Operasi + sub Prod A + fuzzy Business Support.');
        $this->assertSame(2, $json['dept_filled']);
        $this->assertSame(1, $json['sub_filled']);
        $this->assertSame(1, $json['root_no_code'], 'Induk umum sengaja tanpa kode.');
        $this->assertSame(1, $json['no_code_total'], 'Nama tanpa padanan TIDAK ditebak.');
        $this->assertContains('BIDANG NAMA BEBAS TANPA PADANAN', $json['no_code']);

        // Pratinjau TIDAK menulis apa pun.
        $this->assertSame(0, Bidang::query()->whereNotNull('department_code')->count());
        $this->assertSame(0, Bidang::query()->whereNotNull('sub_department_code')->count());
    }

    public function test_map_legacy_codes_apply_fills_codes_without_overwriting_and_is_idempotent(): void
    {
        $rows = $this->seedLegacyFixture();

        // Baris yang SUDAH punya kode — nilainya tidak boleh berubah.
        $sudah = Bidang::create([
            'nama'             => 'BIDANG SUDAH BERKODE',
            'department_code'  => 'engineering',
            'sub_department_code' => 'asmen_so',
        ]);

        $this->actingAs($this->masterUser())
            ->post(route('admin.master_bidang.map-legacy'))
            ->assertRedirect(route('admin.master_bidang.index'))
            ->assertSessionHas('map_summary.rows_updated', 3)
            ->assertSessionHas('success');

        $this->assertDatabaseHas('bidangs', ['id' => $rows['operasi']->id, 'department_code' => 'operasi']);
        $this->assertDatabaseHas('bidangs', ['id' => $rows['sub']->id, 'department_code' => null, 'sub_department_code' => 'asmen_prod_a']);
        $this->assertDatabaseHas('bidangs', ['id' => $rows['fuzzy']->id, 'department_code' => 'business_support']);

        // Induk umum tetap tanpa kode; nama tanpa padanan TIDAK ditebak.
        $this->assertNull($rows['root']->fresh()->department_code);
        $this->assertNull($rows['bebas']->fresh()->department_code);

        // Kode lama tidak ditimpa.
        $sudah->refresh();
        $this->assertSame('engineering', $sudah->department_code);
        $this->assertSame('asmen_so', $sudah->sub_department_code);

        // Warisan: sub bidang tanpa kode sendiri mewarisi induknya.
        $this->assertSame('operasi', $rows['sub']->fresh()->departmentCode());

        // Dijalankan ulang → idempoten, tidak ada baris yang berubah lagi.
        $this->actingAs($this->masterUser())
            ->getJson(route('admin.master_bidang.map-legacy-preview'))
            ->assertOk()
            ->assertJsonPath('rows_updated', 0);

        $this->actingAs($this->masterUser())
            ->post(route('admin.master_bidang.map-legacy'))
            ->assertSessionHas('map_summary.rows_updated', 0);
    }

    public function test_map_legacy_codes_requires_edit_permission(): void
    {
        $viewOnly = User::factory()->create();
        $viewOnly->syncPermissions(
            Permission::whereIn('name', ['master_bidang.view'])->pluck('id')->all()
        );

        $this->actingAs($viewOnly)
            ->get(route('admin.master_bidang.map-legacy-preview'))
            ->assertForbidden();

        $this->actingAs($viewOnly)
            ->post(route('admin.master_bidang.map-legacy'))
            ->assertForbidden();
    }

    /**
     * Fixture 5 baris tanpa kode legacy — dipakai test pratinjau/penerapan:
     * - PLTU INDRAMAYU → pemetaan nama bilang "sengaja tanpa kode".
     * - BIDANG OPERASI → pemetaan nama persis (department_code).
     * - SUB BIDANG PRODUKSI A → kode sub persis + department warisan.
     * - BIDANG BUSINES SUPPORT → pencocokan nama (levenshtein) ke business_support.
     * - BIDANG NAMA BEBAS TANPA PADANAN → tidak ada padanan, tidak ditebak.
     *
     * @return array<string, Bidang>
     */
    private function seedLegacyFixture(): array
    {
        $root    = Bidang::create(['nama' => 'PLTU INDRAMAYU']);
        $operasi = Bidang::create(['nama' => 'BIDANG OPERASI']);
        $sub     = Bidang::create(['nama' => 'SUB BIDANG PRODUKSI A', 'parent_id' => $operasi->id]);
        $fuzzy   = Bidang::create(['nama' => 'BIDANG BUSINES SUPPORT']);
        $bebas   = Bidang::create(['nama' => 'BIDANG NAMA BEBAS TANPA PADANAN']);

        return compact('root', 'operasi', 'sub', 'fuzzy', 'bebas');
    }
}
