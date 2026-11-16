<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Akun NONAKTIF tidak boleh login dan sesi lamanya harus diputus.
 *
 * Status aktif adalah kolom `users.is_active` (bukan email_verified_at):
 * toggle di panel admin menulis kolom itu, LoginController menolak akun
 * nonaktif, dan EnsureAccountActive memutus sesi yang masih berjalan.
 */
class InactiveAccountLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_inactive_account_cannot_login(): void
    {
        $user = User::factory()->create([
            'email'     => 'nonaktif@example.com',
            'password'  => 'rahasia123',
            'is_active' => false,
        ]);

        $this->post(route('login'), [
            'email'    => $user->email,
            'password' => 'rahasia123',
        ])->assertRedirect()
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_active_account_can_login(): void
    {
        $user = User::factory()->create([
            'email'     => 'aktif@example.com',
            'password'  => 'rahasia123',
            'is_active' => true,
        ]);

        $this->post(route('login'), [
            'email'    => $user->email,
            'password' => 'rahasia123',
        ])->assertRedirect(route($user->dashboardRouteName()));

        $this->assertAuthenticatedAs($user);
    }

    public function test_existing_session_is_terminated_when_account_becomes_inactive(): void
    {
        $user = User::factory()->create(['is_active' => false]);

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }
}
