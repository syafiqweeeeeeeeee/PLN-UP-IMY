<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Reset Password oleh Admin + alur wajib ganti password.
 *
 * Skenario:
 * - Pemilik permission user.reset-password me-reset password akun lain →
 *   sistem membuat password sementara ACAK (dikembalikan sekali di
 *   response, ter-hash di DB) + penanda must_change_password + log aktivitas.
 * - User yang login dengan password sementara diarahkan ke halaman
 *   pemberitahuan & wajib ganti password sebelum bisa lanjut.
 * - Guard: tidak bisa reset diri sendiri; password sementara tidak
 *   boleh dipakai ulang sebagai password baru.
 */
class AdminResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    protected function seedPermission(): void
    {
        $this->seed(\Database\Seeders\PermissionSeeder::class);
    }

    protected function makeAdmin(): User
    {
        $this->seedPermission();

        $admin = User::factory()->create([
            'email'    => 'admin-reset@example.com',
            'password' => Hash::make('password123'),
        ]);
        $admin->roles()->sync([\App\Models\Role::where('name', 'Administrator')->firstOrFail()->id]);

        return $admin;
    }

    protected function makeTarget(): User
    {
        return User::factory()->create([
            'email'    => 'target@example.com',
            'password' => Hash::make('passwordlama'),
        ]);
    }

    /** @test admin dapat me-reset password akun lain via endpoint JSON. */
    public function admin_can_reset_password_of_other_user(): void
    {
        $admin  = $this->makeAdmin();
        $target = $this->makeTarget();

        $response = $this->actingAs($admin)
            ->patchJson(route('admin.users.reset-password', $target), []);

        $response->assertOk()->assertJson(['success' => true]);

        $target->refresh();

        // Sistem (bukan admin) yang membuat password sementara: dikembalikan
        // di response, 12 karakter alfanumerik, ter-hash di database, dan
        // akun ditandai wajib ganti password.
        $temporary = $response->json('temporary_password');

        $this->assertNotEmpty($temporary);
        $this->assertSame(12, strlen($temporary));
        $this->assertMatchesRegularExpression('/^[A-Za-z0-9]{12}$/', $temporary);
        $this->assertTrue(Hash::check($temporary, $target->password));
        $this->assertTrue($target->must_change_password);
    }

    /** @test dua reset beruntun menghasilkan password sementara berbeda (acak). */
    public function temporary_password_is_random_across_resets(): void
    {
        $admin  = $this->makeAdmin();
        $target = $this->makeTarget();

        $first  = $this->actingAs($admin)
            ->patchJson(route('admin.users.reset-password', $target), [])
            ->json('temporary_password');

        $second = $this->actingAs($admin)
            ->patchJson(route('admin.users.reset-password', $target), [])
            ->json('temporary_password');

        $this->assertNotSame($first, $second);
    }

    /** @test tanpa permission user.reset-password → 403 dari BACKEND. */
    public function user_without_reset_permission_is_forbidden_by_backend(): void
    {
        $this->seedPermission();

        // Role tanpa user.reset-password (mis. Admin Bidang).
        $tanpaAkses = User::factory()->create([
            'email' => 'tanpa-akses@example.com',
        ]);
        $tanpaAkses->roles()->sync([
            \App\Models\Role::where('name', 'Admin Bidang')->firstOrFail()->id,
        ]);

        $target = $this->makeTarget();

        $this->actingAs($tanpaAkses)
            ->patchJson(route('admin.users.reset-password', $target), [])
            ->assertStatus(403);

        // Tidak ada perubahan pada target.
        $target->refresh();
        $this->assertFalse($target->must_change_password);
    }

    /** @test admin tidak dapat me-reset password akunnya sendiri. */
    public function admin_cannot_reset_own_password(): void
    {
        $admin = $this->makeAdmin();

        $response = $this->actingAs($admin)
            ->patchJson(route('admin.users.reset-password', $admin), []);

        $response->assertStatus(422)->assertJson(['success' => false]);

        $admin->refresh();
        $this->assertFalse($admin->must_change_password);
    }



    /** @test reset password menghapus seluruh sesi login lama target. */
    public function reset_password_invalidates_existing_sessions_of_target(): void
    {
        $admin  = $this->makeAdmin();
        $target = $this->makeTarget();

        // Simulasikan satu sesi login lama milik target di tabel sessions
        // (session driver produksi = database; lihat config/session.php).
        \Illuminate\Support\Facades\DB::table('sessions')->insert([
            'id'            => 'session-target-lama',
            'user_id'       => $target->id,
            'ip_address'    => '127.0.0.1',
            'user_agent'    => 'testing',
            'payload'       => base64_encode('foo'),
            'last_activity' => time(),
        ]);

        $this->actingAs($admin)
            ->patchJson(route('admin.users.reset-password', $target), [])
            ->assertOk();

        $this->assertDatabaseMissing('sessions', ['id' => 'session-target-lama']);
    }

    /** @test login dengan password sementara diarahkan ke halaman ganti password. */
    public function login_with_temporary_password_redirects_to_change_password(): void
    {
        $this->seedPermission();

        $user = User::factory()->create([
            'email'                => 'sementara@example.com',
            'password'             => Hash::make('sementara123'),
            'must_change_password' => true,
        ]);

        $this->post(route('login'), [
            'email'    => 'sementara@example.com',
            'password' => 'sementara123',
        ])->assertRedirect(route('account.password-notice'));

        // Halaman wajib ganti password dapat diakses.
        $this->actingAs($user)
            ->get(route('account.password-notice'))
            ->assertOk()
            ->assertSee('Password Anda Direset Admin');
    }

    /** @test user dengan penanda wajib ganti password diblokir dari halaman lain. */
    public function user_with_must_change_password_is_blocked_from_other_pages(): void
    {
        $this->seedPermission();

        $user = User::factory()->create([
            'must_change_password' => true,
        ]);
        $user->roles()->sync([\App\Models\Role::where('name', 'Administrator')->firstOrFail()->id]);

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('account.password-notice'));
    }

    /** @test ganti password sukses: penanda hilang, login normal kembali. */
    public function user_can_change_password_after_admin_reset(): void
    {
        $this->seedPermission();

        $user = User::factory()->create([
            'password'             => Hash::make('sementara123'),
            'must_change_password' => true,
        ]);

        $response = $this->actingAs($user)
            ->post(route('account.password-update'), [
                'current_password' => 'sementara123',
                'password'         => 'passwordbaru99',
                'password_confirmation' => 'passwordbaru99',
            ]);

        $response->assertRedirect();

        $user->refresh();
        $this->assertFalse($user->must_change_password);
        $this->assertTrue(Hash::check('passwordbaru99', $user->password));
        $this->assertFalse(Hash::check('sementara123', $user->password));
    }

    /** @test password baru harus berbeda dari password sementara. */
    public function new_password_must_differ_from_temporary_password(): void
    {
        $this->seedPermission();

        $user = User::factory()->create([
            'password'             => Hash::make('sementara123'),
            'must_change_password' => true,
        ]);

        $this->actingAs($user)
            ->post(route('account.password-update'), [
                'current_password'      => 'sementara123',
                'password'              => 'sementara123',
                'password_confirmation' => 'sementara123',
            ])
            ->assertSessionHasErrors('password');

        $user->refresh();
        $this->assertTrue($user->must_change_password);
    }
}
