<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactMessageTest extends TestCase
{
    use RefreshDatabase;

    /* =========================================================
       HELPER — payload valid siap pakai (bisa dioverride per test)
       ========================================================= */
    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'nama'     => 'Budi Santoso',
            'email'    => 'budi@gmail.com',
            'telepon'  => '081234567890',
            'kategori' => 'pertanyaan_umum',
            'subjek'   => 'Subjek Uji',
            'pesan'    => 'Pesan yang cukup panjang untuk lolos validasi.',
        ], $overrides);
    }

    /* =========================================================
       FORM KONTAK PUBLIK
       ========================================================= */

    public function test_public_contact_form_stores_message(): void
    {
        $this->post(route('kontak.store'), [
            'nama'     => 'Budi Santoso',
            'email'    => 'budi@example.com',
            'telepon'  => '081234567890',
            'kategori' => 'pertanyaan_umum',
            'subjek'   => 'Pertanyaan tentang layanan',
            'pesan'    => 'Saya ingin menanyakan informasi lebih lanjut tentang layanan PLN.',
        ])->assertRedirect(route('hubungi-kami') . '#contact')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'nama'    => 'Budi Santoso',
            'email'   => 'budi@example.com',
            'telepon' => '081234567890',
            'subjek'  => 'Pertanyaan tentang layanan',
            'status'  => ContactMessage::STATUS_BELUM_DIBACA,
        ]);
    }

    public function test_public_contact_form_ajax_returns_json(): void
    {
        $this->postJson(route('kontak.store'), [
            'nama'     => 'Siti Aminah',
            'email'    => 'siti@example.com',
            'telepon'  => '089876543210',
            'kategori' => 'kerjasama_bisnis',
            'subjek'   => 'Kemitraan FABA',
            'pesan'    => 'Kami tertarik menjajaki kemitraan FABA dengan PLN Nusantara Power.',
        ])->assertOk()
            ->assertJsonPath('success', true);
    }

    public function test_public_contact_form_validation_fails(): void
    {
        // Semua field kosong
        $this->post(route('kontak.store'), [])
            ->assertSessionHasErrors(['nama', 'email', 'telepon', 'kategori', 'subjek', 'pesan']);

        // Email tidak valid
        $this->post(route('kontak.store'), [
            'nama'     => 'Budi',
            'email'    => 'bukan-email',
            'telepon'  => '081234567890',
            'kategori' => 'pertanyaan_umum',
            'subjek'   => 'Subjek',
            'pesan'    => 'Pesan yang cukup panjang untuk lolos validasi.',
        ])->assertSessionHasErrors(['email']);

        // Telepon mengandung huruf
        $this->post(route('kontak.store'), [
            'nama'     => 'Budi',
            'email'    => 'budi@example.com',
            'telepon'  => '08abc123',
            'kategori' => 'pertanyaan_umum',
            'subjek'   => 'Subjek',
            'pesan'    => 'Pesan yang cukup panjang untuk lolos validasi.',
        ])->assertSessionHasErrors(['telepon']);

        // Kategori di luar daftar
        $this->post(route('kontak.store'), [
            'nama'     => 'Budi',
            'email'    => 'budi@example.com',
            'telepon'  => '081234567890',
            'kategori' => 'kategori_ngawur',
            'subjek'   => 'Subjek',
            'pesan'    => 'Pesan yang cukup panjang untuk lolos validasi.',
        ])->assertSessionHasErrors(['kategori']);

        $this->assertSame(0, ContactMessage::count());
    }

    public function test_public_contact_page_renders_form_with_csrf(): void
    {
        $this->get(route('hubungi-kami'))
            ->assertOk()
            ->assertSee('name="_token"', false)
            ->assertSee(route('kontak.store'), false);
    }

    /* =========================================================
       VALIDASI EMAIL KETAT (email:dns + regex)
       ========================================================= */

    public function test_email_without_tld_is_rejected(): void
    {
        $this->post(route('kontak.store'), $this->validPayload(['email' => 'user@gmail']))
            ->assertSessionHasErrors(['email']);
    }

    public function test_email_without_domain_is_rejected(): void
    {
        $this->post(route('kontak.store'), $this->validPayload(['email' => 'nama@']))
            ->assertSessionHasErrors(['email']);
    }

    public function test_email_with_fictional_domain_is_rejected(): void
    {
        // email:dns → domain tanpa record A/AAAA/MX harus ditolak
        $this->post(route('kontak.store'), $this->validPayload(['email' => 'test@domainpalsu12345.xyz']))
            ->assertSessionHasErrors(['email']);
    }

    public function test_email_with_valid_domain_is_accepted(): void
    {
        $this->post(route('kontak.store'), $this->validPayload(['email' => 'budi@gmail.com']))
            ->assertSessionHasNoErrors();

        $this->assertSame(1, ContactMessage::count());
    }

    /* =========================================================
       FILTER EMAIL ACAK-ASALAN (rule NotRandomEmail)
       ========================================================= */

    public function test_random_looking_email_is_rejected(): void
    {
        // Tanpa vokal — pola acak klasik
        $this->post(route('kontak.store'), $this->validPayload(['email' => 'xqzwvk@gmail.com']))
            ->assertSessionHasErrors(['email']);

        // Rantai konsonan beruntun >= 5
        $this->post(route('kontak.store'), $this->validPayload(['email' => 'asdfgh@gmail.com']))
            ->assertSessionHasErrors(['email']);

        $this->assertSame(0, ContactMessage::count());
    }

    public function test_human_looking_email_is_accepted(): void
    {
        // Nama wajar dengan vokal & pemisah titik/angka harus lolos
        $this->post(route('kontak.store'), $this->validPayload(['email' => 'muhammad.rizki123@gmail.com']))
            ->assertSessionHasNoErrors();

        $this->assertSame(1, ContactMessage::count());
    }

    public function test_business_acronym_email_is_accepted(): void
    {
        // Akronim bisnis pendek (hrd, info, cs) tidak boleh ditolak
        $this->post(route('kontak.store'), $this->validPayload(['email' => 'hrd@pln.co.id']))
            ->assertSessionHasNoErrors();

        // Nama umum dengan vokal 'o' harus lolos (regresi vokal e/o)
        $this->post(route('kontak.store'), $this->validPayload(['email' => 'john@gmail.com']))
            ->assertSessionHasNoErrors();

        $this->assertSame(2, ContactMessage::count());
    }

    /* =========================================================
       HALAMAN ADMIN KELOLA PERMOHONAN
       ========================================================= */

    public function test_admin_permohonan_page_requires_auth(): void
    {
        $this->get(route('admin.contact-messages.index'))
            ->assertRedirect(route('login'));
    }

    public function test_admin_permohonan_page_shows_stats_and_rows(): void
    {
        ContactMessage::create([
            'nama' => 'Pengirim Satu', 'email' => 'satu@example.com', 'telepon' => '081111111111',
            'kategori' => 'pertanyaan_umum', 'subjek' => 'Pesan Pertama', 'pesan' => 'Isi pesan pertama.',
        ]);
        ContactMessage::create([
            'nama' => 'Pengirim Dua', 'email' => 'dua@example.com', 'telepon' => '082222222222',
            'kategori' => 'kerjasama_bisnis', 'subjek' => 'Pesan Kedua', 'pesan' => 'Isi pesan kedua.',
            'status' => ContactMessage::STATUS_SELESAI,
        ]);

        $this->actingAs(\App\Models\User::factory()->create())
            ->get(route('admin.contact-messages.index'))
            ->assertOk()
            ->assertSee('Kelola Permohonan &amp; Pesan Masuk', false)
            ->assertSee('Pesan Pertama')
            ->assertSee('Pengirim Satu')
            ->assertSee('Belum Dibaca')
            ->assertSee('Selesai');
    }

    public function test_admin_permohonan_search_and_filters(): void
    {
        ContactMessage::create([
            'nama' => 'Andi Wijaya', 'email' => 'andi@example.com', 'telepon' => '081111111111',
            'kategori' => 'pertanyaan_umum', 'subjek' => 'Cari Saya', 'pesan' => 'Isi pesan.',
        ]);
        ContactMessage::create([
            'nama' => 'Budi Santoso', 'email' => 'budi@example.com', 'telepon' => '082222222222',
            'kategori' => 'karir', 'subjek' => 'Lamaran Kerja', 'pesan' => 'Isi pesan lain.',
            'status' => ContactMessage::STATUS_DIPROSES,
        ]);

        // Pencarian nama & subjek
        $this->actingAs(\App\Models\User::factory()->create())
            ->get(route('admin.contact-messages.index', ['q' => 'Cari Saya']))
            ->assertOk()
            ->assertSee('Cari Saya')
            ->assertDontSee('Lamaran Kerja');

        // Filter kategori
        $this->actingAs(\App\Models\User::factory()->create())
            ->get(route('admin.contact-messages.index', ['kategori' => 'karir']))
            ->assertOk()
            ->assertSee('Lamaran Kerja')
            ->assertDontSee('Cari Saya');

        // Filter status
        $this->actingAs(\App\Models\User::factory()->create())
            ->get(route('admin.contact-messages.index', ['status' => 'diproses']))
            ->assertOk()
            ->assertSee('Lamaran Kerja')
            ->assertDontSee('Cari Saya');
    }

    public function test_show_marks_unread_as_diproses_and_returns_json(): void
    {
        $message = ContactMessage::create([
            'nama' => 'Pengirim', 'email' => 'p@example.com', 'telepon' => '081234567890',
            'kategori' => 'pertanyaan_umum', 'subjek' => 'Detail Uji', 'pesan' => 'Isi pesan.',
        ]);

        $this->actingAs(\App\Models\User::factory()->create())
            ->getJson(route('admin.contact-messages.show', $message))
            ->assertOk()
            ->assertJsonPath('status', ContactMessage::STATUS_DIPROSES)
            ->assertJsonPath('subjek', 'Detail Uji')
            ->assertJsonPath('wa_link', 'https://wa.me/6281234567890');

        $this->assertDatabaseHas('contact_messages', [
            'id' => $message->id, 'status' => ContactMessage::STATUS_DIPROSES,
        ]);
    }

    public function test_update_status_changes_and_logs(): void
    {
        $message = ContactMessage::create([
            'nama' => 'Pengirim', 'email' => 'p@example.com', 'telepon' => '081234567890',
            'kategori' => 'media_pers', 'subjek' => 'Status Uji', 'pesan' => 'Isi pesan.',
        ]);

        $this->actingAs(\App\Models\User::factory()->create())
            ->postJson(route('admin.contact-messages.update-status', $message), [
                'status' => ContactMessage::STATUS_SELESAI,
            ])
            ->assertOk()
            ->assertJsonPath('status', ContactMessage::STATUS_SELESAI);

        $this->assertDatabaseHas('contact_messages', [
            'id' => $message->id, 'status' => ContactMessage::STATUS_SELESAI,
        ]);

        $this->assertDatabaseHas('activity_logs', [
            'module' => 'permohonan', 'action' => 'update',
        ]);

        // Status invalid ditolak
        $this->actingAs(\App\Models\User::factory()->create())
            ->post(route('admin.contact-messages.update-status', $message), [
                'status' => 'ngawur',
            ])
            ->assertSessionHasErrors(['status']);
    }

    public function test_destroy_deletes_message_and_logs(): void
    {
        $message = ContactMessage::create([
            'nama' => 'Pengirim', 'email' => 'p@example.com', 'telepon' => '081234567890',
            'kategori' => 'karir', 'subjek' => 'Hapus Saya', 'pesan' => 'Isi pesan.',
        ]);

        $this->actingAs(\App\Models\User::factory()->create())
            ->delete(route('admin.contact-messages.destroy', $message))
            ->assertRedirect();

        $this->assertDatabaseMissing('contact_messages', ['id' => $message->id]);
        $this->assertDatabaseHas('activity_logs', [
            'module' => 'permohonan', 'action' => 'delete',
        ]);
    }

    /* =========================================================
       SIDEBAR BADGE
       ========================================================= */

    public function test_sidebar_shows_unread_badge(): void
    {
        ContactMessage::create([
            'nama' => 'Pengirim', 'email' => 'p@example.com', 'telepon' => '081234567890',
            'kategori' => 'pertanyaan_umum', 'subjek' => 'Badge Uji', 'pesan' => 'Isi pesan.',
        ]);

        // Badge merah tampil di sidebar saat ada pesan belum dibaca
        $this->actingAs(\App\Models\User::factory()->create())
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('<span class="badge"', false);

        // Semua pesan selesai -> badge hilang dari sidebar
        ContactMessage::query()->update(['status' => ContactMessage::STATUS_SELESAI]);

        $this->actingAs(\App\Models\User::factory()->create())
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertDontSee('<span class="badge"', false);
    }
}
