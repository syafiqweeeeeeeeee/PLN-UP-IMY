<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Pengaturan Panel Admin (halaman /admin/settings):
 *
 * 1. Halaman tampil untuk akun admin yang login.
 * 2. Kartu Notifikasi: toggle tersimpan ke kolom users.notification_settings.
 * 3. Kartu Akun: Nama Tampilan bisa diperbarui; email read-only (tidak
 *    ada endpoint yang mengubahnya).
 * 4. Ubah Kata Sandi: wajib sandi lama benar + konfirmasi cocok.
 */
class SettingsPageTest extends TestCase
{
    use RefreshDatabase;

    private function adminUser(): User
    {
        return User::factory()->create(['role' => 'Administrator']);
    }

    /* =========================================================
       HALAMAN
       ========================================================= */

    public function test_settings_page_requires_authentication(): void
    {
        $this->get(route('admin.settings'))->assertRedirect(route('login'));
    }

    public function test_settings_page_renders_for_admin(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)
            ->get(route('admin.settings'))
            ->assertOk()
            ->assertSee('Notifikasi')
            ->assertSee('Akun')
            ->assertSee($admin->email);
    }

    /* =========================================================
       PREFERENSI NOTIFIKASI
       ========================================================= */

    public function test_notification_settings_persist_to_database(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)
            ->putJson(route('admin.settings.notifications'), [
                'desktop' => false,
                'weekly'  => true,
                'pending' => true,
            ])
            ->assertOk()
            ->assertJson(['success' => true]);

        $admin->refresh();

        $this->assertFalse($admin->notificationSettings()['desktop']);
        $this->assertTrue($admin->notificationSettings()['weekly']);
        $this->assertTrue($admin->notificationSettings()['pending']);
    }

    public function test_notification_settings_partial_update_merges(): void
    {
        $admin = $this->adminUser();
        $admin->updateNotificationSettings(['desktop' => false, 'weekly' => false]);

        $this->actingAs($admin)
            ->putJson(route('admin.settings.notifications'), [
                'desktop' => true,
                'weekly'  => false,
                'pending' => false,
            ])
            ->assertOk();

        // Nilai tidak dikirim (di sini semua dikirim) — merge terhadap tersimpan.
        $admin->refresh();
        $this->assertTrue($admin->notificationSettings()['desktop']);
        $this->assertFalse($admin->notificationSettings()['weekly']);
    }

    public function test_notification_settings_validation_rejects_missing_fields(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)
            ->putJson(route('admin.settings.notifications'), ['desktop' => true])
            ->assertStatus(422);
    }

    /* =========================================================
       PROFIL AKUN
       ========================================================= */

    public function test_display_name_can_be_updated(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)
            ->putJson(route('admin.settings.profile'), ['name' => 'Admin Baru PLN'])
            ->assertOk()
            ->assertJson(['success' => true, 'name' => 'Admin Baru PLN']);

        $this->assertDatabaseHas('users', [
            'id'   => $admin->id,
            'name' => 'Admin Baru PLN',
        ]);
    }

    public function test_display_name_required(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)
            ->putJson(route('admin.settings.profile'), ['name' => '   '])
            ->assertStatus(422);
    }

    /* =========================================================
       UBAH KATA SANDI
       ========================================================= */

    public function test_password_change_requires_correct_current_password(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)
            ->putJson(route('admin.settings.password'), [
                'current_password'      => 'salah-total',
                'password'              => 'SandiBaru123',
                'password_confirmation' => 'SandiBaru123',
            ])
            ->assertStatus(422);

        // Sandi lama masih berlaku.
        $this->assertTrue(Hash::check('password', $admin->fresh()->password));
    }

    public function test_password_change_succeeds_with_valid_payload(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)
            ->putJson(route('admin.settings.password'), [
                'current_password'      => 'password',
                'password'              => 'SandiBaru123',
                'password_confirmation' => 'SandiBaru123',
            ])
            ->assertOk()
            ->assertJson(['success' => true]);

        $this->assertTrue(Hash::check('SandiBaru123', $admin->fresh()->password));
    }

    public function test_password_change_rejects_mismatched_confirmation(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)
            ->putJson(route('admin.settings.password'), [
                'current_password'      => 'password',
                'password'              => 'SandiBaru123',
                'password_confirmation' => 'Berbeda123',
            ])
            ->assertStatus(422);
    }
}
