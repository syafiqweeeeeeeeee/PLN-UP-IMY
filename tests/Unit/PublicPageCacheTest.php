<?php

namespace Tests\Unit;

use App\Services\PublicPageCache;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

/**
 * WHITE-BOX — App\Services\PublicPageCache
 *
 * Struktur internal yang diuji:
 *   - version() : inisialisasi versi 1 saat kunci VERSION_KEY belum ada.
 *   - key()     : 'public.pages.' + kunci logis + '.v' + versi aktif.
 *   - flush()   : null → set 1; selain itu → increment (tanpa wildcard flush).
 *   - remember(): Cache::remember pada kunci berversi — kunci lama dibiarkan
 *                 basi dan tak terpakai lagi setelah flush.
 */
class PublicPageCacheTest extends TestCase
{
    public function test_key_menginisialisasi_versi_pertama_ke_1(): void
    {
        $this->assertNull(Cache::get(PublicPageCache::VERSION_KEY));

        $key = PublicPageCache::key('berita.page.1');

        $this->assertSame('public.pages.berita.page.1.v1', $key);
        $this->assertSame(1, (int) Cache::get(PublicPageCache::VERSION_KEY));
    }

    public function test_flush_menginisialisasi_lalu_menaikkan_versi(): void
    {
        // flush pertama saat kunci kosong → hanya inisialisasi ke 1 (bukan 2)
        PublicPageCache::flush();
        $this->assertSame(1, (int) Cache::get(PublicPageCache::VERSION_KEY));

        PublicPageCache::flush();
        $this->assertSame(2, (int) Cache::get(PublicPageCache::VERSION_KEY));

        PublicPageCache::flush();
        $this->assertSame(3, (int) Cache::get(PublicPageCache::VERSION_KEY));

        $this->assertSame('public.pages.uji.v3', PublicPageCache::key('uji'));
    }

    public function test_versi_yang_sudah_ada_dihormati(): void
    {
        Cache::forever(PublicPageCache::VERSION_KEY, 7);

        $this->assertSame('public.pages.uji.v7', PublicPageCache::key('uji'));

        PublicPageCache::flush();
        $this->assertSame('public.pages.uji.v8', PublicPageCache::key('uji'));
    }

    public function test_remember_menghitung_sekali_lalu_kembali_hitung_setelah_flush(): void
    {
        $panggilan = 0;
        $callback = function () use (&$panggilan) {
            $panggilan++;

            return 'nilai-' . $panggilan;
        };

        // Miss pertama → eksekusi; hit kedua → ambil dari cache
        $this->assertSame('nilai-1', PublicPageCache::remember('uji', $callback));
        $this->assertSame('nilai-1', PublicPageCache::remember('uji', $callback));
        $this->assertSame(1, $panggilan);

        // flush → kunci logis yang sama memakai kunci fisik BARU → dihitung ulang
        PublicPageCache::flush();

        $this->assertSame('nilai-2', PublicPageCache::remember('uji', $callback));
        $this->assertSame(2, $panggilan);

        // Kunci lama ditinggalkan basi tanpa dihapus (tanpa wildcard flush),
        // sementara kunci versi baru sudah terisi hasil hitung ulang.
        $this->assertSame('nilai-1', Cache::get('public.pages.uji.v1'));
        $this->assertSame('nilai-2', Cache::get('public.pages.uji.v2'));
    }

    public function test_ttl_default_dipakai_bila_tanpa_argumen_menit(): void
    {
        PublicPageCache::remember('tanpa-ttl', fn () => 'isi');

        // Cache::remember sudah menulis nilai di kunci berversi → terbaca lagi
        $this->assertSame('isi', Cache::get(PublicPageCache::key('tanpa-ttl')));
        $this->assertSame(PublicPageCache::TTL_MINUTES, 10);
    }
}