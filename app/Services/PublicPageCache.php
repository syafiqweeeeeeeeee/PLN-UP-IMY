<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

/**
 * Cache kueri halaman PUBLIK (Beranda, Informasi, Layanan, CMS).
 *
 * Halaman publik bersifat view-only dan sama untuk semua pengunjung,
 * sehingga query listing/detail cukup dibaca dari cache beberapa menit
 * saja — server tidak perlu query database di setiap kunjungan.
 *
 * Invalidasi memakai "version tag": setiap kunci menyimpan nomor versi
 * aktif, dan saat konten berubah (observer News/Announcement/Gallery/Page)
 * versi dinaikkan sehingga seluruh kunci lama otomatis tak terpakai lagi
 * (tanpa perlu wildcard flush yang tidak didukung cache store database).
 *
 * Contoh kunci: public.pages.berita.page.1.v3
 */
class PublicPageCache
{
    /** Kunci penyimpanan nomor versi aktif (di-abadikan di store cache). */
    public const VERSION_KEY = 'public.pages.version';

    /** TTL default halaman publik (menit) — pengaman bila flush terlewat. */
    public const TTL_MINUTES = 10;

    /**
     * Cache::remember untuk halaman publik, dengan version tag.
     *
     * @param  \Closure(): mixed  $callback  Query/riset yang mahal dijalankan.
     * @param  int|null  $minutes  TTL khusus (default: TTL_MINUTES).
     */
    public static function remember(string $key, \Closure $callback, ?int $minutes = null): mixed
    {
        return Cache::remember(
            self::key($key),
            now()->addMinutes($minutes ?? self::TTL_MINUTES),
            $callback
        );
    }

    /** Kunci final: prefix + kunci logis + versi aktif. */
    public static function key(string $key): string
    {
        return 'public.pages.'.$key.'.v'.self::version();
    }

    /**
     * Buang SELURUH cache halaman publik — dipanggil observer setiap
     * kali konten (berita/pengumuman/galeri/halaman CMS) disimpan/dihapus.
     */
    public static function flush(): void
    {
        if (Cache::get(self::VERSION_KEY) === null) {
            Cache::forever(self::VERSION_KEY, 1);

            return;
        }

        Cache::increment(self::VERSION_KEY);
    }

    /** Nomor versi aktif; inisialisasi sekali bila belum ada. */
    protected static function version(): int
    {
        $version = Cache::get(self::VERSION_KEY);

        if ($version === null) {
            Cache::forever(self::VERSION_KEY, 1);

            return 1;
        }

        return (int) $version;
    }
}
