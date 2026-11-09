<?php

namespace Tests\Feature;

use App\Models\News;
use App\Services\PublicPageCache;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * WHITE-BOX — jalur invalidasi PublicPageCache pada halaman publik.
 *
 * Alur yang diuji:
 *   GET /informasi/berita
 *     → PublicPageCache::remember('berita.page.N')  (kunci berversi)
 *     → hasil query di-cache
 *   News::saved / News::deleted (observer di AppServiceProvider)
 *     → PublicPageCache::flush() → versi naik → kunci lama tak terpakai
 *
 * Test membedakan tulis-lewat-model (event → flush) dengan tulis-lewat
 * query-builder (tanpa event → cache tetap basi, sengaja dibuktikan).
 */
class PublicPageCacheInvalidationTest extends TestCase
{
    use RefreshDatabase;

    private function beritaJudul(string $judul): News
    {
        return News::create([
            'title'        => $judul,
            'slug'         => str($judul)->slug()->value(),
            'category'     => 'umum',
            'excerpt'      => 'Ringkasan ' . $judul,
            'is_published' => true,
            'published_at' => now(),
        ]);
    }

    public function test_list_berita_menggunakan_cache_dan_basi_bila_tulis_tanpa_event(): void
    {
        $this->beritaJudul('Berita Awal Terlihat');

        $this->get(route('berita'))->assertOk()->assertSee('Berita Awal Terlihat');

        // Kunci versi 1 sudah terisi setelah render pertama
        $this->assertSame(1, (int) Cache::get(PublicPageCache::VERSION_KEY));

        // Tulis langsung lewat query builder → TIDAK memicu observer → versi tak berubah
        DB::table('news')->insert([
            'title'             => 'Berita Tanpa Observer',
            'slug'              => 'berita-tanpa-observer',
            'category'          => 'umum',
            'target_publication' => 'public',
            'excerpt'           => 'Baris ini sengaja ditulis tanpa event model.',
            'content'           => 'Isi berita tanpa event.',
            'author'            => 'Uji White Box',
            'is_published'      => true,
            'published_at'      => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        $this->assertSame(1, (int) Cache::get(PublicPageCache::VERSION_KEY), 'flush tidak boleh terjadi tanpa event');

        // Masih membaca cache lama (basi) — membuktikan remember() benar-benar dipakai
        $this->get(route('berita'))->assertOk()->assertDontSee('Berita Tanpa Observer');

        // Flush eksplisit (perilaku yang dilakukan observer) → kunci versi baru
        PublicPageCache::flush();

        $this->get(route('berita'))
            ->assertOk()
            ->assertSee('Berita Awal Terlihat')
            ->assertSee('Berita Tanpa Observer');
    }

    public function test_observer_news_saved_menaikkan_versi_sehingga_list_segar(): void
    {
        $this->beritaJudul('Berita Sebelum Perubahan');

        $this->get(route('berita'))->assertOk()->assertSee('Berita Sebelum Perubahan');

        $versiSebelum = (int) Cache::get(PublicPageCache::VERSION_KEY);

        // Lewat model → event saved → PublicPageCache::flush()
        $this->beritaJudul('Berita Hasil Editan Admin');

        $this->assertSame($versiSebelum + 1, (int) Cache::get(PublicPageCache::VERSION_KEY));

        $this->get(route('berita'))
            ->assertOk()
            ->assertSee('Berita Hasil Editan Admin')
            ->assertSee('Berita Sebelum Perubahan');
    }

    public function test_detail_berita_yang_dihapus_tidak_muncul_lagi_setelah_flush(): void
    {
        $news = $this->beritaJudul('Berita Akan Dihapus');

        $this->get(route('berita.detail', $news->slug))->assertOk()->assertSee('Berita Akan Dihapus');
        $this->get(route('berita'))->assertOk()->assertSee('Berita Akan Dihapus');

        // Hapus lewat model → observer deleted → flush versi
        $news->delete();

        $this->get(route('berita'))->assertOk()->assertDontSee('Berita Akan Dihapus');
        $this->get(route('berita.detail', $news->slug))->assertNotFound();
    }
}