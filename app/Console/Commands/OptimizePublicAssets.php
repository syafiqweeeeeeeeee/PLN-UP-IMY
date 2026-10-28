<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Kompres & resize aset gambar statis halaman publik.
 *
 * Masalah lama: beberapa gambar beresolusi jauh lebih besar dari
 * kebutuhan tampil (mis. logo 16.111 px lebar untuk navbar 52 px tinggi),
 * sehingga First Contentful Paint lambat karena unduhan gambar ratusan KB
 * bahkan MB.
 *
 * Aksi per gambar:
 *  1. Resize proporsional ke lebar maksimal (maks ~2x ukuran tampil CSS).
 *  2. Re-encode PNG (level 9); untuk gambar TANPA alpha dibandingkan
 *     dengan varian palet 256 warna — yang paling kecil yang dipakai.
 *  3. Buat varian WebP (kompresi lossy, alpha didukung) sebagai gambar
 *     utama via <picture><source type="image/webp">.
 *
 * File PNG asli ditimpa (versi asli tersimpan di git), sehingga view
 * lama yang masih menunjuk PNG tetap valid sebagai fallback.
 *
 * Pemakaian:
 *   php artisan assets:optimize          # proses yang belum punya hasil
 *   php artisan assets:optimize --force  # proses ulang semua
 */
class OptimizePublicAssets extends Command
{
    protected $signature = 'assets:optimize
                            {--force : Proses ulang semua gambar walau hasil sudah ada}';

    protected $description = 'Kompres + resize aset gambar statis publik (PNG optimal + varian WebP)';

    /**
     * Manifest gambar publik: path relatif terhadap public/,
     * lebar maksimum hasil resize, dan kualitas WebP.
     */
    private const IMAGES = [
        ['path' => 'assets/images/logo-pln.png',                   'max_width' => 640,  'webp_quality' => 90],
        ['path' => 'assets/images/logo-pln1.png',                  'max_width' => 900,  'webp_quality' => 90],
        ['path' => 'assets/images/mobile-pln.png',                 'max_width' => 840,  'webp_quality' => 82],
        ['path' => 'assets/images/qr-mobile-pln.png',              'max_width' => 300,  'webp_quality' => 88],
        ['path' => 'assets/images/struktur/struktural_organisasi.png', 'max_width' => 1600, 'webp_quality' => 82],
        ['path' => 'assets/halaman_utama/wilayah operasional1.png', 'max_width' => 1440, 'webp_quality' => 80],
        ['path' => 'assets/halaman_utama/wilayah operasional2.png', 'max_width' => 1440, 'webp_quality' => 80],
        ['path' => 'assets/halaman_utama/sistem interkoneksi.png',  'max_width' => 1440, 'webp_quality' => 80],
    ];

    public function handle(): int
    {
        if (! extension_loaded('gd')) {
            $this->error('Ekstensi PHP GD tidak tersedia — optimasi gambar dibatalkan.');

            return self::FAILURE;
        }

        $info = gd_info();
        if (empty($info['WebP Support'])) {
            $this->error('GD tidak mendukung WebP — optimasi gambar dibatalkan.');

            return self::FAILURE;
        }

        $force = (bool) $this->option('force');
        $rows = [];

        foreach (self::IMAGES as $item) {
            $abs = public_path($item['path']);
            $webpPath = preg_replace('/\.png$/i', '.webp', $abs);

            if (! file_exists($abs)) {
                $rows[] = [$item['path'], '-', '-', 'lewati (tidak ada)'];

                continue;
            }

            if (! $force && file_exists($webpPath) && filemtime($webpPath) >= filemtime($abs)) {
                $rows[] = [
                    $item['path'],
                    $this->kb(filesize($abs)),
                    $this->kb(filesize($webpPath)),
                    'sudah dioptimasi',
                ];

                continue;
            }

            $rows[] = $this->optimize($abs, $webpPath, $item);
        }

        $this->table(['Gambar', 'PNG', 'WebP', 'Catatan'], $rows);

        return self::SUCCESS;
    }

    /**
     * Proses satu gambar: resize → PNG optimal → WebP.
     *
     * @return array{0:string,1:string,2:string,3:string}
     */
    private function optimize(string $abs, string $webpPath, array $item): array
    {
        $before = filesize($abs);
        $source = @imagecreatefromstring(file_get_contents($abs));

        if ($source === false) {
            return [$item['path'], '-', '-', 'gagal dibaca'];
        }

        imagesavealpha($source, true);
        imagealphablending($source, false);

        [$w, $h] = [imagesx($source), imagesy($source)];
        $targetW = (int) min($w, $item['max_width']);
        $targetH = max(1, (int) round($h * $targetW / $w));

        $canvas = imagecreatetruecolor($targetW, $targetH);
        imagealphablending($canvas, false);
        imagesavealpha($canvas, true);
        imagecopyresampled($canvas, $source, 0, 0, 0, 0, $targetW, $targetH, $w, $h);
        imagedestroy($source);

        $hasAlpha = $this->hasAlpha($canvas);

        // PNG final: truecolor (wajib bila ada alpha) vs palet 256 warna
        // (untuk gambar tanpa alpha) — keduanya dikompresi level 9, yang
        // paling kecil yang dipakai.
        $truecolorPng = $this->tempFile('tc.png');
        imagepng($canvas, $truecolorPng, 9);
        $chosenPng = $truecolorPng;
        $note = 'resize';

        if ($hasAlpha) {
            $note .= ', alpha';
        } else {
            $palette = imagecreatetruecolor($targetW, $targetH);
            imagecopy($palette, $canvas, 0, 0, 0, 0, $targetW, $targetH);
            imagetruecolortopalette($palette, true, 256);
            $palettePng = $this->tempFile('pal.png');
            imagepng($palette, $palettePng, 9);
            imagedestroy($palette);

            if (filesize($palettePng) < filesize($truecolorPng)) {
                $chosenPng = $palettePng;
                @unlink($truecolorPng);
                $note .= ', palet256';
            } else {
                @unlink($palettePng);
                $note .= ', truecolor';
            }
        }

        $pngPath = $abs;
        $tmpPng = $this->tempFile('final.png');
        rename($chosenPng, $tmpPng);
        rename($tmpPng, $pngPath); // timpa PNG asli (versi asli ada di git)
        touch($pngPath, time());

        // Varian WebP — gambar utama di view (lebih kecil, alpha aman).
        $tmpWebp = $this->tempFile('out.webp');
        imagewebp($canvas, $tmpWebp, (int) $item['webp_quality']);
        imagedestroy($canvas);
        rename($tmpWebp, $webpPath);

        return [
            $item['path'],
            $this->kb($before).' → '.$this->kb(filesize($pngPath)),
            $this->kb(filesize($webpPath)),
            $note,
        ];
    }

    /** Apakah gambar punya kanal alpha (transparansi) — sampel 60x60 titik. */
    private function hasAlpha(\GdImage $image): bool
    {
        $w = imagesx($image);
        $h = imagesy($image);
        $stepX = max(1, intdiv($w, 60));
        $stepY = max(1, intdiv($h, 60));

        for ($y = 0; $y < $h; $y += $stepY) {
            for ($x = 0; $x < $w; $x += $stepX) {
                if (((imagecolorat($image, $x, $y) >> 24) & 0x7F) !== 0) {
                    return true;
                }
            }
        }

        return false;
    }

    private function tempFile(string $suffix): string
    {
        return rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.'pln-opt-'.uniqid('', true).'.'.$suffix;
    }

    private function kb(int $bytes): string
    {
        return round($bytes / 1024).' KB';
    }
}
