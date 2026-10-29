<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Anti-"419 Page Expired" halaman Detail Pengguna (admin/users/show).
 *
 * Diverifikasi pada HTML hasil render:
 * - Tombol Hapus = <form> POST dengan @csrf + @method('DELETE') — BUKAN <a>.
 * - Form Toggle Status = POST + @csrf + @method('PATCH').
 * - Layout admin menyematkan <meta name="csrf-token">.
 * - Tombol kunci membuka modal konfirmasi #resetPasswordModal yang
 *   memuat form POST + @csrf + @method('PATCH') ke route reset.
 * - Modal hasil #successResetModal tampil dari session flash.
 */
class AdminUserShowCsrfTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Render halaman Detail Pengguna.
     *
     * @param  array<string, mixed> $session  flash session opsional (mis. temporaryPassword)
     * @return array{0: string, 1: User}     [html halaman, target user]
     */
    private function renderShowPage(array $session = []): array
    {
        $admin  = $this->userWithPermissions(['users.view', 'users.edit', 'user.reset-password']);
        $target = User::factory()->create();

        $request = $this->actingAs($admin);

        if ($session !== []) {
            $request = $request->withSession($session);
        }

        $html = $request
            ->get(route('admin.users.show', $target))
            ->assertOk()
            ->getContent();

        return [$html, $target];
    }

    /** Ambil potongan HTML satu <form> berdasarkan atribut pembukanya. */
    private function extractForm(string $html, string $opening): ?string
    {
        $start = strpos($html, $opening);
        if ($start === false) {
            return null;
        }

        $end = strpos($html, '</form>', $start);

        return $end === false ? null : substr($html, $start, $end - $start);
    }

    public function test_delete_action_is_a_post_form_with_csrf_and_delete_method(): void
    {
        [$html, $target] = $this->renderShowPage();
        $url             = route('admin.users.destroy', $target);

        // BUKAN elemen link — tidak ada <a> yang menunjuk ke route destroy.
        $this->assertDoesNotMatchRegularExpression(
            '/<a\b[^>]*href="' . preg_quote($url, '/') . '"/',
            $html,
            'Tombol Hapus tidak boleh berupa elemen <a>.'
        );

        // Berupa <form> POST yang membawa @csrf + @method('DELETE').
        $form = $this->extractForm($html, '<form action="' . $url . '" method="POST"');
        $this->assertNotNull($form, 'Tombol Hapus harus berupa <form action=... method="POST">.');
        $this->assertStringContainsString('name="_token"', $form, 'Form Hapus wajib memuat @csrf.');
        $this->assertStringContainsString('name="_method" value="DELETE"', $form, 'Form Hapus wajib memuat @method(\'DELETE\').');
        $this->assertStringContainsString(
            'data-swal-confirm=',
            $form,
            'Form Hapus wajib punya konfirmasi SweetAlert (AdminSwal), bukan confirm() bawaan browser.'
        );
        $this->assertStringNotContainsString(
            'onsubmit="return confirm(',
            $form,
            'Form Hapus tidak boleh memakai confirm() bawaan browser.'
        );
        $this->assertStringContainsString('type="submit"', $form, 'Pemicu hapus harus <button type="submit">, bukan link.');
    }

    public function test_toggle_status_form_carries_csrf_token(): void
    {
        [$html, $target] = $this->renderShowPage();

        $form = $this->extractForm($html, '<form action="' . route('admin.users.toggle-status', $target) . '" method="POST"');
        $this->assertNotNull($form, 'Toggle status harus berupa <form> POST biasa.');
        $this->assertStringContainsString('name="_token"', $form, 'Form toggle status wajib memuat @csrf.');
        $this->assertStringContainsString('name="_method" value="PATCH"', $form, 'Form toggle status wajib memuat @method(\'PATCH\').');
    }

    public function test_layout_renders_csrf_meta_tag(): void
    {
        [$html] = $this->renderShowPage();

        $this->assertMatchesRegularExpression(
            '/<meta name="csrf-token" content="[^"]+">/',
            $html,
            'Layout admin harus menyematkan <meta name="csrf-token">.'
        );
    }

    public function test_key_button_opens_confirmation_modal_with_post_form(): void
    {
        [$html, $target] = $this->renderShowPage();
        $url             = route('admin.users.reset-password', $target);

        // Tombol kunci membuka modal konfirmasi (bukan SweetAlert/fetch).
        $this->assertMatchesRegularExpression(
            '/title="Reset Password"\s+data-bs-toggle="modal"\s+data-bs-target="#resetPasswordModal"/',
            $html,
            'Tombol kunci wajib membuka #resetPasswordModal.'
        );
        $this->assertStringNotContainsString('data-action="reset-password"', $html);
        $this->assertStringContainsString('meta[name="csrf-token"]', $html);

        // Di dalam modal: form POST + @csrf + @method('PATCH') ke route reset.
        $this->assertStringContainsString('id="resetPasswordModal"', $html);

        $form = $this->extractForm($html, '<form action="' . $url . '" method="POST"');
        $this->assertNotNull($form, 'Tombol "Ya, Reset Password" harus berupa form POST ke route reset password.');
        $this->assertStringContainsString('name="_token"', $form, 'Form reset wajib memuat @csrf (anti 419).');
        $this->assertStringContainsString('name="_method" value="PATCH"', $form);
        $this->assertStringContainsString('Ya, Reset Password', $form);
    }

    public function test_success_reset_modal_renders_from_session_flash(): void
    {
        [$html] = $this->renderShowPage(['temporaryPassword' => 'abcXYZ12345']);

        $this->assertStringContainsString('id="successResetModal"', $html);
        $this->assertStringContainsString(
            'style="display: block; background: rgba(0,0,0,0.5);"',
            $html,
            'Modal hasil reset harus tampil otomatis tanpa JavaScript.'
        );
        $this->assertStringContainsString('id="tempPasswordInput"', $html);
        $this->assertStringContainsString('value="abcXYZ12345"', $html);
        $this->assertStringContainsString('Password Berhasil Direset', $html);
    }

    public function test_success_reset_modal_is_absent_without_flash(): void
    {
        [$html] = $this->renderShowPage();

        $this->assertStringNotContainsString('id="successResetModal"', $html);
    }
}
