<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_news_list_page(): void
    {
        News::create([
            'title'        => 'Berita Uji Publik',
            'slug'         => 'berita-uji-publik',
            'category'     => 'umum',
            'excerpt'      => 'Ringkasan berita uji publik.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->get(route('berita'))
            ->assertStatus(200)
            ->assertSee('Berita Uji Publik');
    }

    public function test_guest_can_view_news_detail_page(): void
    {
        News::create([
            'title'        => 'Berita Uji Detail',
            'slug'         => 'berita-uji-detail',
            'category'     => 'teknis',
            'excerpt'      => 'Ringkasan berita uji detail.',
            'content'      => 'Isi lengkap berita uji detail.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->get(route('berita.detail', 'berita-uji-detail'))
            ->assertStatus(200)
            ->assertSee('Berita Uji Detail')
            ->assertSee('Isi lengkap berita uji detail.');
    }

    public function test_draft_news_not_shown_on_public_pages(): void
    {
        News::create([
            'title'        => 'Berita Draft Tersembunyi',
            'slug'         => 'berita-draft-tersembunyi',
            'category'     => 'umum',
            'excerpt'      => 'Ringkasan draft.',
            'is_published' => false,
        ]);

        $this->get(route('berita'))
            ->assertStatus(200)
            ->assertDontSee('Berita Draft Tersembunyi');

        $this->get(route('berita.detail', 'berita-draft-tersembunyi'))
            ->assertStatus(404);
    }

    public function test_admin_news_pages_render(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.news.index'))
            ->assertStatus(200)
            ->assertSee('Daftar Berita');

        $this->actingAs($user)
            ->get(route('admin.news.create'))
            ->assertStatus(200)
            ->assertSee('Tambah Berita');
    }

    public function test_admin_can_create_and_publish_news(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.news.store'), [
            'title'        => 'Berita Baru dari Admin',
            'category'     => 'kegiatan',
            'excerpt'      => 'Ringkasan berita baru.',
            'content'      => 'Isi lengkap berita baru.',
            'image'        => UploadedFile::fake()->image('berita.jpg', 800, 450),
            'is_published' => '1',
        ]);

        $response->assertRedirect(route('admin.news.index'));

        $this->assertDatabaseHas('news', [
            'title'          => 'Berita Baru dari Admin',
            'is_published'   => true,
            'author_user_id' => $user->id,
        ]);

        // Berita yang dipublikasikan langsung tampil di halaman publik
        $this->get(route('berita'))
            ->assertSee('Berita Baru dari Admin');
    }

    public function test_admin_can_toggle_publish_news(): void
    {
        $user = User::factory()->create();

        $news = News::create([
            'title'        => 'Berita Toggle Publish',
            'slug'         => 'berita-toggle-publish',
            'category'     => 'umum',
            'excerpt'      => 'Ringkasan toggle publish.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        // Tarik dari publikasi
        $this->actingAs($user)
            ->post(route('admin.news.publish', $news))
            ->assertRedirect();

        $this->assertFalse($news->fresh()->is_published);

        // Publikasikan lagi
        $this->actingAs($user)
            ->post(route('admin.news.publish', $news))
            ->assertRedirect();

        $this->assertTrue($news->fresh()->is_published);
        $this->assertNotNull($news->fresh()->published_at);
    }

    public function test_admin_can_update_news(): void
    {
        $user = User::factory()->create();

        $news = News::create([
            'title'        => 'Judul Awal Berita',
            'slug'         => 'judul-awal-berita',
            'category'     => 'umum',
            'excerpt'      => 'Ringkasan awal.',
            'is_published' => false,
        ]);

        $this->actingAs($user)
            ->put(route('admin.news.update', $news), [
                'title'        => 'Judul Berita Setelah Edit',
                'category'     => 'umum',
                'excerpt'      => 'Ringkasan setelah edit.',
                'is_published' => '1',
            ])
            ->assertRedirect(route('admin.news.index'));

        $this->assertDatabaseHas('news', [
            'id'           => $news->id,
            'title'        => 'Judul Berita Setelah Edit',
            'is_published' => true,
        ]);
    }

    public function test_store_validation_shows_field_errors(): void
    {
        $user = User::factory()->create();

        // Submit form kosong: semua kolom wajib harus ditandai error
        $response = $this->actingAs($user)
            ->from(route('admin.news.create'))
            ->post(route('admin.news.store'), []);

        $response->assertSessionHasErrors(['title', 'category', 'excerpt', 'image']);

        // Halaman setelah redirect harus menampilkan alert perbaikan + pesan spesifik
        $this->followingRedirects()
            ->actingAs($user)
            ->post(route('admin.news.store'), [])
            ->assertOk()
            ->assertSee('Perbaiki data berikut.')
            ->assertSee('The title field is required.')
            ->assertSee('The category field is required.')
            ->assertSee('The excerpt field is required.')
            ->assertSee('The image field is required.');
    }

    public function test_admin_can_delete_news(): void
    {
        $user = User::factory()->create();

        $news = News::create([
            'title'        => 'Berita Akan Dihapus',
            'slug'         => 'berita-akan-dihapus',
            'category'     => 'umum',
            'excerpt'      => 'Ringkasan.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->actingAs($user)
            ->delete(route('admin.news.destroy', $news))
            ->assertRedirect(route('admin.news.index'));

        $this->assertDatabaseMissing('news', ['id' => $news->id]);
    }
}
