<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * SISTEM TEMA — terang / gelap / sistem.
 *
 * Mencakup:
 * - Semua portal memuat satu set aset tema bersama (theme.css/theme.js)
 *   dan tombol tema (`data-theme-toggle`).
 * - Skrip anti-FOUC berada SEBELUM stylesheet tema sehingga kelas tema
 *   sudah terpasang pada paint pertama.
 * - Cookie preferensi dirender server-side menjadi `class="theme-dark"`.
 * - Cookie tema tidak terenkripsi (ditulis JavaScript), jadi terbaca
 *   oleh App\Support\Theme.
 */
class ThemeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(PermissionSeeder::class);
    }

    private function superAdmin(): User
    {
        $role = Role::query()->where('name', 'Super Admin')->firstOrFail();

        $user = User::factory()->create([
            'role' => 'Super Admin',
            'role_id' => $role->id,
        ]);
        $user->roles()->sync([$role->id]);

        return $user;
    }

    private function karyawanUser(): User
    {
        $role = Role::firstOrCreate(
            ['name' => 'Karyawan'],
            ['description' => 'Pengguna internal / karyawan', 'status' => true],
        );

        $user = User::factory()->create(['role' => 'Karyawan']);
        $user->role_id = $role->id;
        $user->save();
        $user->roles()->sync([$role->id]);

        return $user;
    }

    /** Konten HTML lengkap (bukan partial router) untuk sebuah halaman. */
    private function html(callable $request): string
    {
        return $request()->assertOk()->getContent();
    }

    public function test_public_portal_uses_shared_theme_assets_and_toggle(): void
    {
        $html = $this->html(fn () => $this->get(route('home')));

        $this->assertStringContainsString('css/theme.css', $html);
        $this->assertStringContainsString('js/theme.js', $html);
        $this->assertStringContainsString('data-theme-toggle', $html);
        $this->assertStringContainsString('class="portal-body"', $html);

        // Anti-FOUC: bootstrap tema dijalankan di <head> SEBELUM CSS tema.
        $bootstrap = strpos($html, "localStorage.getItem(userId ? KEY + ':u' + userId : KEY)");
        $stylesheet = strpos($html, 'css/theme.css');

        $this->assertNotFalse($bootstrap, 'Skrip bootstrap tema harus ada di <head>.');
        $this->assertNotFalse($stylesheet);
        $this->assertLessThan($stylesheet, $bootstrap, 'Bootstrap tema harus berjalan sebelum stylesheet dimuat.');
    }

    public function test_dark_cookie_renders_dark_class_without_flash(): void
    {
        $html = $this->html(fn () => $this->withUnencryptedCookie('pln_theme', 'dark')->get(route('home')));

        $this->assertStringContainsString('class="theme-dark"', $html);
        $this->assertStringContainsString('data-theme-pref="dark"', $html);
    }

    public function test_light_and_invalid_cookies_fall_back_safely(): void
    {
        $light = $this->html(fn () => $this->withUnencryptedCookie('pln_theme', 'light')->get(route('home')));
        $this->assertStringContainsString('data-theme-pref="light"', $light);
        $this->assertStringNotContainsString('class="theme-dark"', $light);

        // Nilai tak dikenal tidak boleh merusak render (kembali ke default).
        $invalid = $this->html(fn () => $this->withUnencryptedCookie('pln_theme', 'neon')->get(route('home')));
        $this->assertStringContainsString('data-theme-pref="system"', $invalid);
        $this->assertStringNotContainsString('class="theme-dark"', $invalid);
    }

    public function test_admin_and_login_pages_expose_theme_toggle(): void
    {
        $login = $this->html(fn () => $this->get(route('login')));
        $this->assertStringContainsString('data-theme-toggle', $login);
        $this->assertStringContainsString('js/theme.js', $login);
        $this->assertStringContainsString('class="theme-dark"', $this->html(
            fn () => $this->withUnencryptedCookie('pln_theme', 'dark')->get(route('login'))
        ));

        $admin = $this->html(fn () => $this->actingAs($this->superAdmin())->get(route('admin.dashboard')));
        $this->assertStringContainsString('data-theme-toggle', $admin);
        $this->assertStringContainsString('css/theme.css', $admin);
        $this->assertStringContainsString('js/theme.js', $admin);
        $this->assertStringContainsString('class="admin-body"', $admin);
    }

    public function test_karyawan_portal_uses_shared_theme_assets_and_toggle(): void
    {
        $html = $this->html(
            fn () => $this->actingAs($this->karyawanUser())->get(route('karyawan.dashboard'))
        );

        $this->assertStringContainsString('css/theme.css', $html);
        $this->assertStringContainsString('js/theme.js', $html);
        $this->assertStringContainsString('data-theme-toggle', $html);
        $this->assertStringContainsString('class="kry-body"', $html);
    }
}
