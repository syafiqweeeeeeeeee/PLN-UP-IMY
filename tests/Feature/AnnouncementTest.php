<?php

namespace Tests\Feature;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnnouncementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_public_announcement_page(): void
    {
        Announcement::create([
            'title'        => 'Pengumuman Uji Publik',
            'slug'         => 'pengumuman-uji-publik',
            'category'     => 'umum',
            'excerpt'      => 'Ringkasan pengumuman uji publik.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->get(route('pengumuman'))
            ->assertStatus(200)
            ->assertSee('Pengumuman Uji Publik');
    }

    public function test_draft_announcement_not_shown_on_public_page(): void
    {
        Announcement::create([
            'title'        => 'Pengumuman Draft Rahasia',
            'slug'         => 'pengumuman-draft-rahasia',
            'category'     => 'umum',
            'excerpt'      => 'Ringkasan draft.',
            'is_published' => false,
        ]);

        $this->get(route('pengumuman'))
            ->assertStatus(200)
            ->assertDontSee('Pengumuman Draft Rahasia');
    }

    public function test_admin_form_create_page_renders(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.announcements.create'))
            ->assertStatus(200)
            ->assertSee('Tambah Pengumuman');
    }

    public function test_admin_can_create_and_publish_announcement(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.announcements.store'), [
            'title'        => 'Pengumuman Baru dari Admin',
            'category'     => 'teknis',
            'excerpt'      => 'Ringkasan pengumuman baru.',
            'content'      => 'Isi lengkap pengumuman.',
            'is_published' => '1',
        ]);

        $response->assertRedirect(route('admin.announcements.index'));

        $this->assertDatabaseHas('announcements', [
            'title'        => 'Pengumuman Baru dari Admin',
            'is_published' => true,
            'author_user_id' => $user->id,
        ]);

        // Pengumuman yang dipublikasikan langsung tampil di halaman publik
        $this->get(route('pengumuman'))
            ->assertSee('Pengumuman Baru dari Admin');
    }

    public function test_guest_can_view_announcement_detail_page(): void
    {
        Announcement::create([
            'title'        => 'Detail Pengumuman Uji',
            'slug'         => 'detail-pengumuman-uji',
            'category'     => 'teknis',
            'excerpt'      => 'Ringkasan detail pengumuman uji.',
            'content'      => 'Isi lengkap pengumuman untuk halaman detail.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->get(route('pengumuman.detail', 'detail-pengumuman-uji'))
            ->assertStatus(200)
            ->assertSee('Detail Pengumuman Uji')
            ->assertSee('Isi lengkap pengumuman untuk halaman detail.');
    }

    public function test_draft_announcement_detail_returns_404(): void
    {
        Announcement::create([
            'title'        => 'Detail Draft Tersembunyi',
            'slug'         => 'detail-draft-tersembunyi',
            'category'     => 'umum',
            'excerpt'      => 'Ringkasan draft.',
            'is_published' => false,
        ]);

        $this->get(route('pengumuman.detail', 'detail-draft-tersembunyi'))
            ->assertStatus(404);
    }

    public function test_detail_shows_related_announcements_same_category(): void
    {
        Announcement::create([
            'title'        => 'Pengumuman Utama Teknis',
            'slug'         => 'pengumuman-utama-teknis',
            'category'     => 'teknis',
            'excerpt'      => 'Ringkasan utama.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        Announcement::create([
            'title'        => 'Pengumuman Teknis Lain',
            'slug'         => 'pengumuman-teknis-lain',
            'category'     => 'teknis',
            'excerpt'      => 'Ringkasan lain.',
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        Announcement::create([
            'title'        => 'Pengumuman Umum Beda Kategori',
            'slug'         => 'pengumuman-umum-beda',
            'category'     => 'umum',
            'excerpt'      => 'Ringkasan beda kategori.',
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        $this->get(route('pengumuman.detail', 'pengumuman-utama-teknis'))
            ->assertStatus(200)
            ->assertSee('Pengumuman Teknis Lain')
            ->assertDontSee('Pengumuman Umum Beda Kategori');
    }

    public function test_store_validation_rejects_invalid_category(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('admin.announcements.create'))
            ->post(route('admin.announcements.store'), [
                'title'    => 'Pengumuman Kategori Salah',
                'category' => 'kategori-ngasal',
                'excerpt'  => 'Ringkasan.',
            ])
            ->assertSessionHasErrors('category');

        $this->assertDatabaseMissing('announcements', [
            'title' => 'Pengumuman Kategori Salah',
        ]);
    }
}
