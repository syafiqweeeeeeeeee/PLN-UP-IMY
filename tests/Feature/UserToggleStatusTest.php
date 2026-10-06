<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Fitur Pengguna:
 * - REVISI ARSITEKTUR: route Edit Pengguna KEMBALI (dipakai untuk
 *   Direct Permission per akun) — toggle status tetap ada sebagai
 *   shortcut cepat dari Daftar Pengguna.
 * - UserController@toggleStatus mengubah email_verified_at (Aktif ⇄ Nonaktif).
 * - Proteksi: admin tidak bisa menonaktifkan akunnya sendiri.
 * - Feedback sukses: "Status pengguna berhasil diperbarui."
 */
class UserToggleStatusTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return $this->userWithPermissions(['users.view', 'users.edit']);
    }

    public function test_edit_and_update_routes_are_available_again(): void
    {
        // REVISI ARSITEKTUR — Edit Pengguna aktif kembali: form yang sama
        // dipakai mengatur Direct Permission per akun.
        $admin  = $this->admin();
        $target = User::factory()->create();

        $this->actingAs($admin)
            ->get(route('admin.users.edit', $target))
            ->assertOk()
            ->assertSee('Edit Pengguna');
    }

    public function test_toggle_status_activates_unverified_account(): void
    {
        $admin  = $this->admin();
        $target = User::factory()->unverified()->create();

        // AJAX (Accept: application/json) → balasan JSON + toast.
        $this->actingAs($admin)
            ->patchJson(route('admin.users.toggle-status', $target), ['status' => 'active'])
            ->assertOk()
            ->assertJson(['success' => true, 'message' => 'Status pengguna berhasil diperbarui.', 'status' => 'Aktif']);

        $this->assertNotNull($target->fresh()->email_verified_at);
    }

    public function test_toggle_status_deactivates_verified_account(): void
    {
        $admin  = $this->admin();
        $target = User::factory()->create(); // verified by default

        $this->actingAs($admin)
            ->patchJson(route('admin.users.toggle-status', $target), ['status' => 'inactive'])
            ->assertOk()
            ->assertJson(['success' => true, 'status' => 'Nonaktif']);

        $this->assertNull($target->fresh()->email_verified_at);
    }

    public function test_toggle_status_without_ajax_redirects_with_flash(): void
    {
        $admin  = $this->admin();
        $target = User::factory()->unverified()->create();

        // Submit form biasa (tanpa Accept JSON) → redirect + flash message.
        $this->actingAs($admin)
            ->patch(route('admin.users.toggle-status', $target), ['status' => 'active'])
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas('success', 'Status pengguna berhasil diperbarui.');

        $this->assertNotNull($target->fresh()->email_verified_at);
    }

    public function test_toggle_status_requires_users_edit_permission(): void
    {
        $editor = $this->userWithPermissions(['users.view']);
        $target = User::factory()->create();

        $this->actingAs($editor)
            ->patchJson(route('admin.users.toggle-status', $target), ['status' => 'inactive'])
            ->assertForbidden();
    }

    public function test_admin_cannot_deactivate_own_account(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)
            ->patchJson(route('admin.users.toggle-status', $admin), ['status' => 'inactive'])
            ->assertStatus(422)
            ->assertJson(['success' => false]);

        $this->assertNotNull($admin->fresh()->email_verified_at);
    }

    public function test_toggle_status_is_logged(): void
    {
        $admin  = $this->admin();
        $target = User::factory()->unverified()->create();

        $this->actingAs($admin)
            ->patch(route('admin.users.toggle-status', $target), ['status' => 'active']);

        // Baca seluruh baris JSONL dari disk fake log aktivitas.
        $disk  = Storage::disk(ActivityLogger::DISK);
        $lines = collect($disk->files('/'))
            ->filter(fn (string $f) => (bool) preg_match('/^activity-\d{4}-\d{2}-\d{2}(-part\d+)?\.jsonl$/', $f))
            ->flatMap(fn (string $f) => preg_split('/\r\n|\r|\n/', trim((string) $disk->get($f))) ?: [])
            ->filter(fn (string $l) => trim($l) !== '')
            ->map(fn (string $l) => json_decode($l, true))
            ->values();

        $this->assertTrue($lines->contains(fn ($entry) =>
            ($entry['event_type'] ?? '') === 'update'
            && ($entry['module'] ?? '') === 'pengguna'
            && str_contains($entry['payload']['description'] ?? '', 'mengaktifkan akun pengguna')
        ));
    }
}
