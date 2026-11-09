<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

/**
 * DATEPICKER GLOBAL — komponen <x-date-picker /> & asetnya.
 *
 * Seluruh input tanggal di portal memakai satu komponen (port kalender
 * Form Registrasi Tamu): input teks readonly + kalender global
 * (public/js/date-picker.js, public/css/date-picker.css) dengan nilai
 * YYYY-MM-DD. Test ini menjaga agar:
 *   - markup komponen tidak kembali menjadi datepicker native,
 *   - data atribut (min/max, weekend, hari libur, work dates) terkirim,
 *   - aset global termuat di layout & halaman hasil migrasi.
 */
class DatePickerComponentTest extends TestCase
{
    use RefreshDatabase;

    private function adminWithPermissions(array $permissions): User
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name' => 'Admin Datepicker '.uniqid(),
            'description' => 'Role uji otomatis datepicker',
            'status' => true,
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

    /* =========================================================
       KOMPONEN
       ========================================================= */

    public function test_komponen_merender_input_teks_readonly_bukan_datepicker_native(): void
    {
        $html = Blade::render('<x-date-picker name="tanggal_kunjungan" value="2026-11-05" />');

        $this->assertStringContainsString('data-pln-datepicker', $html);
        $this->assertStringContainsString('data-dp-input', $html);
        $this->assertStringContainsString('data-dp-panel', $html);
        $this->assertStringContainsString('name="tanggal_kunjungan"', $html);
        $this->assertStringContainsString('value="2026-11-05"', $html);
        $this->assertStringContainsString('readonly', $html);

        // Datepicker native tidak boleh dipakai lagi (tidak bisa diwarnai
        // per-hari: weekend merah, hari libur, override weekend).
        $this->assertStringNotContainsString('type="date"', $html);
    }

    public function test_komponen_mengirim_konfigurasi_kalender_lewat_data_atribut(): void
    {
        $html = Blade::render(
            '<x-date-picker name="tanggal" min="today" max="2026-12-31"'
            .' :block-weekends="true" :clearable="true"'
            .' :blocked="[\'2026-12-25\' => \'Hari Raya Natal\']"'
            .' :work-dates="[\'2026-11-07\' => \'Lembur Sabtu\']" />'
        );

        $this->assertStringContainsString('data-min="today"', $html);
        $this->assertStringContainsString('data-max="2026-12-31"', $html);
        $this->assertStringContainsString('data-block-weekends="1"', $html);
        $this->assertStringContainsString('data-clearable="1"', $html);
        $this->assertStringContainsString('&quot;2026-12-25&quot;:&quot;Hari Raya Natal&quot;', $html);
        $this->assertStringContainsString('&quot;2026-11-07&quot;:&quot;Lembur Sabtu&quot;', $html);
    }

    public function test_komponen_bawaan_membiarkan_posisi_otomatis_tanpa_batas_tahun(): void
    {
        $html = Blade::render('<x-date-picker name="tanggal" />');

        // "auto" = perilaku lama: boleh membalik ke atas bila ruang kurang.
        $this->assertStringContainsString('data-placement="auto"', $html);
        $this->assertStringContainsString('data-year-start=""', $html);
        $this->assertStringContainsString('data-year-end=""', $html);
    }

    public function test_komponen_mendukung_posisi_bawah_dan_rentang_tahun_lahir(): void
    {
        $html = Blade::render(
            '<x-date-picker name="tanggal_lahir" max="today" placement="bottom"'
            .' year-start="1950" :year-end="2026" />'
        );

        // Popup dikunci ke bawah (tidak pernah flip ke atas).
        $this->assertStringContainsString('data-placement="bottom"', $html);

        // Rentang dropdown Tahun: 1950 s.d. tahun berjalan.
        $this->assertStringContainsString('data-year-start="1950"', $html);
        $this->assertStringContainsString('data-year-end="2026"', $html);
    }

    public function test_komponen_menandai_error_validasi_dan_status_required(): void
    {
        $html = Blade::render('<x-date-picker name="tanggal" required />');

        $this->assertStringContainsString('required', $html);
        $this->assertStringContainsString('pln-dp-input', $html);
    }

    /* =========================================================
       ASET GLOBAL & HALAMAN HASIL MIGRASI
       ========================================================= */

    public function test_layout_publik_memuat_aset_datepicker_global(): void
    {
        $this->get(route('layanan.registrasi-tamu'))
            ->assertOk()
            ->assertSee('css/date-picker.css', false)
            ->assertSee('js/date-picker.js', false);
    }

    public function test_halaman_admin_tamu_memakai_komponen_datepicker(): void
    {
        $admin = $this->adminWithPermissions(['tamu.view']);

        $this->actingAs($admin)
            ->get(route('admin.tamu.index'))
            ->assertOk()
            ->assertSee('data-pln-datepicker', false)
            ->assertSee('name="dari"', false)
            ->assertSee('name="sampai"', false)
            ->assertSee('js/date-picker.js', false)
            ->assertDontSee('type="date"', false);
    }

    public function test_form_data_karyawan_mengunci_popup_tanggal_lahir_ke_bawah(): void
    {
        $admin = $this->adminWithPermissions(['karyawan_data.create']);

        $html = $this->actingAs($admin)
            ->get(route('admin.karyawan_data.create'))
            ->assertOk()
            ->getContent();

        $this->assertMatchesRegularExpression(
            '/name="tanggal_lahir"[^>]*data-placement="bottom"|data-placement="bottom"[\s\S]{0,600}?name="tanggal_lahir"/',
            $html,
            'Field TGL LAHIR harus memakai datepicker yang selalu terbuka ke bawah.'
        );

        $this->assertMatchesRegularExpression(
            '/name="tanggal_lahir"[^>]*data-year-start="1950"|data-year-start="1950"[\s\S]{0,600}?name="tanggal_lahir"/',
            $html,
            'Field TGL LAHIR harus punya dropdown tahun mulai 1950.'
        );

        $this->assertMatchesRegularExpression(
            '/name="tanggal_lahir"[^>]*data-year-end="'.preg_quote((string) now()->year, '/').'"|'
            .'data-year-end="'.preg_quote((string) now()->year, '/').'"[\s\S]{0,600}?name="tanggal_lahir"/',
            $html,
            'Dropdown tahun TGL LAHIR harus berakhir di tahun berjalan.'
        );
    }

    public function test_halaman_hari_libur_memakai_komponen_datepicker(): void
    {
        $admin = $this->adminWithPermissions(['hari_libur.view', 'hari_libur.create', 'hari_libur.edit']);

        $this->actingAs($admin)
            ->get(route('admin.hari-libur.index'))
            ->assertOk()
            ->assertSee('id="hl-tanggal"', false)
            ->assertSee('data-min="today"', false)
            ->assertSee('data-pln-datepicker', false)
            ->assertDontSee('type="date"', false);
    }

    public function test_tidak_ada_lagi_input_date_native_di_view_portal(): void
    {
        // Sisa input type="date" harus nol — semuanya lewat komponen.
        $offenders = [];

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(resource_path('views'), \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if (! $file->isFile() || ! str_ends_with($file->getFilename(), '.blade.php')) {
                continue;
            }

            if (str_contains(file_get_contents($file->getPathname()), 'type="date"')) {
                $offenders[] = str_replace(resource_path('views').DIRECTORY_SEPARATOR, '', $file->getPathname());
            }
        }

        $this->assertSame([], $offenders, 'Masih ada datepicker native: '.implode(', ', $offenders));
    }
}
