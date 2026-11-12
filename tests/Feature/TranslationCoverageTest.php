<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Cakupan terjemahan ID/EN (public/js/i18n.js).
 *
 * Memastikan setiap kunci yang dipakai view / skrip benar-benar ada di
 * kamus, dan kamus ID & EN selalu sepasang. Tanpa test ini, satu salah
 * ketik kunci (mis. data-i18n="faq.q10") membuat teks tetap Indonesia
 * tanpa error apa pun — persis gejala "pilih bahasa tapi tidak berubah".
 */
class TranslationCoverageTest extends TestCase
{
    private static function dictionary(): array
    {
        $path = base_path('public/js/i18n.js');
        $js   = (string) file_get_contents($path);

        // Pisahkan blok id: { ... } dan en: { ... } — keduanya objek literal
        // dengan indentasi 8 spasi di dalam konstanta `translations`.
        if (! preg_match('/\n\s{8}id\s*:\s*\{(.*?)\n\s{8}\},\s*\n\s{8}en\s*:\s*\{(.*?)\n\s{8}\}\s*\n\s{4}\};/s', $js, $m)) {
            self::fail('Struktur kamus i18n.js tidak dikenali (blok id/en tidak ditemukan).');
        }

        $keys = static function (string $block): array {
            preg_match_all("/'([a-zA-Z0-9_.]+)'\s*:/", $block, $matches);

            return array_values(array_unique($matches[1]));
        };

        return ['id' => $keys($m[1]), 'en' => $keys($m[2])];
    }

    /** Seluruh kunci yang dirujuk view & skrip halaman. */
    private static function referencedKeys(): array
    {
        $files = [public_path('js/date-picker.js')];

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(resource_path('views'), \FilesystemIterator::SKIP_DOTS)
        );
        foreach ($iterator as $file) {
            if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
                $files[] = $file->getPathname();
            }
        }

        $keys = [];

        foreach (array_unique($files) as $file) {
            $source = (string) file_get_contents($file);

            // Atribut: data-i18n, data-i18n-placeholder, data-i18n-aria-label, data-i18n-title
            preg_match_all('/data-i18n(?:-placeholder|-aria-label|-title)?="([a-zA-Z0-9_.]+)"/', $source, $attrs);
            // Skrip: PLNI18N.t('kunci', ...) dan tr('kunci', ...). Kunci yang
            // dirakit dinamis (mis. tr('month.long.' + i)) sengaja dilewati —
            // huruf setelah kutip penutup bukan koma/kurung tutup.
            preg_match_all('/(?:PLNI18N\.t|tr)\(\s*\'([a-zA-Z0-9_.]+)\'\s*[,)]/', $source, $calls);

            $keys = array_merge($keys, $attrs[1], $calls[1]);
        }

        sort($keys);

        return array_values(array_unique($keys));
    }

    public function test_setiap_kunci_yang_dipakai_tersedia_di_kamus_id_dan_en(): void
    {
        $dict = self::dictionary();
        $used = self::referencedKeys();

        $this->assertNotEmpty($used, 'Tidak ada kunci i18n yang terdeteksi di view.');

        $missingId = array_values(array_diff($used, $dict['id']));
        $missingEn = array_values(array_diff($used, $dict['en']));

        $this->assertSame([], $missingId, 'Kunci tanpa terjemahan ID: ' . implode(', ', $missingId));
        $this->assertSame([], $missingEn, 'Kunci tanpa terjemahan EN: ' . implode(', ', $missingEn));
    }

    public function test_kamus_id_dan_en_saling_berpasangan(): void
    {
        $dict = self::dictionary();

        $this->assertSame(
            [],
            array_values(array_diff($dict['id'], $dict['en'])),
            'Kunci ada di ID tapi tidak di EN.'
        );
        $this->assertSame(
            [],
            array_values(array_diff($dict['en'], $dict['id'])),
            'Kunci ada di EN tapi tidak di ID.'
        );

        $this->assertGreaterThan(150, count($dict['id']), 'Kamus terjemahan terlalu sedikit — cek pemisahan blok.');
    }

    public function test_halaman_publik_tidak_lagi_memakai_teks_indonesia_tanpa_kunci(): void
    {
        // Halaman yang isinya statis (bukan konten database) harus punya
        // penanda terjemahan pada judul/eyebrow utamanya.
        $wajib = [
            'informasi/layanan.blade.php'              => 'spl.title',
            'layanan/faq.blade.php'                    => 'faq.title',
            'informasi/berita.blade.php'               => 'berita.title',
            'informasi/berita_detail.blade.php'        => 'berita.related_title',
            'informasi/pengumuman.blade.php'           => 'png.title',
            'informasi/pengumuman_detail.blade.php'    => 'png.back_link',
        ];

        foreach ($wajib as $view => $key) {
            $html = file_get_contents(resource_path('views/' . $view));

            $this->assertStringContainsString(
                'data-i18n="' . $key . '"',
                (string) $html,
                "View {$view} kehilangan penanda terjemahan {$key}."
            );
        }
    }
}
