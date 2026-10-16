<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMXPath;

/**
 * PEMBACA .xlsx NATIVE — tanpa ekstensi `zip` (ext-zip tidak tersedia
 * di server produksi, dan ekstensi PHP lain juga tidak dipakai).
 *
 * Alur:
 *  1. Parsing arsip ZIP secara manual: cari End-Of-Central-Directory,
 *     telusuri central directory, lalu baca tiap entri dari local file
 *     header-nya. Metode 0 (store) diambil apa adanya, metode 8
 *     (deflate) dibuka dengan `gzinflate()` mentah.
 *  2. Baca XML lembar kerja dengan DOMDocument/DOMXPath: `workbook.xml`
 *     → sheet pertama lewat `workbook.xml.rels`, `sharedStrings.xml`
 *     (teks tersimpan), `styles.xml` (deteksi format tanggal).
 *  3. Tiap sel diubah menjadi string polos: teks → apa adanya, angka
 *     → angka (nol di depan sudah hilang di file Excel bila disimpan
 *     sebagai angka), sel bergaya tanggal → `Y-m-d` dari serial Excel.
 *
 * Query XML memakai `local-name()` supaya tidak bergantung pada URI
 * namespace (transitional/strict sama-sama terbaca), dan DOCTYPE
 * ditolak agar tidak ada ekspansi entitas (billion-laughs).
 *
 * Hasil `read()` berupa baris SEL: pemetaan header ke kolom database
 * tetap dilakukan pemanggil (dipakai bersama dengan jalur CSV).
 */
final class XlsxReader
{
    /** Batas ukuran total tak terkompres — penjaga anti zip-bomb. */
    private const MAX_UNCOMPRESSED = 67108864; // 64 MB

    /** Batas jumlah entri arsip. */
    private const MAX_ENTRIES = 10000;

    /** Hari antara 1899-12-30 (dasar serial Excel 1900) dan 1970-01-01. */
    private const EPOCH_OFFSET = 25569;

    /** Selisih hari sistem tanggal 1904 (Excel Mac lama) terhadap 1900. */
    private const EPOCH_1904_OFFSET = 1462;

    /** numFmtId bawaan Excel yang berarti tanggal/waktu. */
    private const BUILTIN_DATE_FORMATS = [
        14, 15, 16, 17, 18, 19, 20, 21, 22,
        27, 28, 29, 30, 31, 32, 33, 34, 35, 36,
        45, 46, 47,
        50, 51, 52, 53, 54, 55, 56, 57, 58,
    ];

    /**
     * Baca sheet pertama yang berisi.
     *
     * @return array{error: string|null, rows: list<array{row: int, cells: array<int, string>}>}
     *                                                                                           `row` = nomor baris asli
     *                                                                                           di lembar (untuk laporan
     *                                                                                           error), `cells` = sel
     *                                                                                           per indeks kolom (0 =
     *                                                                                           kolom A).
     */
    public function read(string $path): array
    {
        try {
            $raw = @file_get_contents($path);

            if ($raw === false || $raw === '') {
                throw new \RuntimeException('File XLSX tidak dapat dibaca.');
            }

            $entries = $this->readArchive($raw);

            $workbookPath = $this->locate($entries, 'xl/workbook.xml');
            $workbook = $this->loadXml($entries[$workbookPath], 'workbook.xml');

            $date1904 = $this->uses1904Epoch($workbook);
            $sheetPath = $this->firstSheetPath($workbook, $workbookPath, $entries);

            $shared = $this->sharedStrings($entries);
            $dateStyles = $this->dateStyleIndexes($entries);

            return [
                'error' => null,
                'rows' => $this->readSheet($entries[$sheetPath], $shared, $dateStyles, $date1904),
            ];
        } catch (\RuntimeException $e) {
            return ['error' => $e->getMessage(), 'rows' => []];
        }
    }

    /* =========================================================
       ZIP — central directory + local file header (tanpa ext-zip)
       ========================================================= */

    /**
     * Baca seluruh entri arsip ZIP dari satu konten biner.
     *
     * @return array<string, string> nama entri => isi terkompresi yang
     *                               sudah dibuka
     */
    private function readArchive(string $raw): array
    {
        $length = strlen($raw);

        if ($length < 22 || ! str_starts_with($raw, "PK\x03\x04")) {
            throw new \RuntimeException('File bukan arsip XLSX yang valid (bukan file ZIP).');
        }

        $eocd = $this->findEndOfCentralDirectory($raw);

        $count = unpack('v', substr($raw, $eocd + 10, 2))[1];
        $cdOffset = unpack('V', substr($raw, $eocd + 16, 4))[1];

        if ($count > self::MAX_ENTRIES) {
            throw new \RuntimeException('File XLSX ditolak: terlalu banyak entri arsip.');
        }

        $entries = [];
        $position = $cdOffset;
        $totalUncompressed = 0;

        for ($i = 0; $i < $count; $i++) {
            if (substr($raw, $position, 4) !== "PK\x01\x02") {
                throw new \RuntimeException('File XLSX rusak: central directory tidak konsisten.');
            }

            $method = unpack('v', substr($raw, $position + 10, 2))[1];
            $compressed = unpack('V', substr($raw, $position + 20, 4))[1];
            $uncompressed = unpack('V', substr($raw, $position + 24, 4))[1];
            $nameLength = unpack('v', substr($raw, $position + 28, 2))[1];
            $extraLength = unpack('v', substr($raw, $position + 30, 2))[1];
            $commentLength = unpack('v', substr($raw, $position + 32, 2))[1];
            $localOffset = unpack('V', substr($raw, $position + 42, 4))[1];
            $name = substr($raw, $position + 46, $nameLength);

            if ($compressed === 0xFFFFFFFF || $uncompressed === 0xFFFFFFFF || $localOffset === 0xFFFFFFFF) {
                throw new \RuntimeException('File XLSX ditolak: format ZIP64 tidak didukung.');
            }

            $totalUncompressed += $uncompressed;
            if ($totalUncompressed > self::MAX_UNCOMPRESSED) {
                throw new \RuntimeException('File XLSX ditolak: ukuran isi terlalu besar (maks 64MB).');
            }

            // Entri direktori (diakhiri "/") — lewati.
            if (! str_ends_with($name, '/')) {
                $entries[$name] = [
                    'method' => $method,
                    'compressed' => $compressed,
                    'offset' => $localOffset,
                    'uncompressed' => $uncompressed,
                ];
            }

            $position += 46 + $nameLength + $extraLength + $commentLength;

            if ($position > $length) {
                throw new \RuntimeException('File XLSX rusak: central directory terpotong.');
            }
        }

        $contents = [];
        foreach ($entries as $name => $entry) {
            $contents[$name] = $this->extract($raw, $entry);
        }

        return $contents;
    }

    /**
     * Cari posisi signature End Of Central Directory (PK\x05\x06),
     * dipindai dari akhir file; kandidat divalidasi dengan mengecek
     * apakah offset central directory-nya benar-benar menunjuk
     * signature PK\x01\x02 (agar komentar berisi "PK\x05\x06" tidak
     * salah dianggap EOCD).
     */
    private function findEndOfCentralDirectory(string $raw): int
    {
        $length = strlen($raw);
        $limit = max(0, $length - 22 - 0xFFFF);

        for ($i = $length - 22; $i >= $limit; $i--) {
            if (substr($raw, $i, 4) !== "PK\x05\x06") {
                continue;
            }

            $cdOffset = unpack('V', substr($raw, $i + 16, 4))[1];
            $count = unpack('v', substr($raw, $i + 10, 2))[1];

            if ($cdOffset > $length - 4) {
                continue;
            }

            if ($count === 0 || substr($raw, $cdOffset, 4) === "PK\x01\x02") {
                return $i;
            }
        }

        throw new \RuntimeException('File bukan arsip XLSX yang valid (struktur ZIP tidak ditemukan).');
    }

    /** Ambil isi satu entri dari local file header pada offset entri. */
    private function extract(string $raw, array $entry): string
    {
        $offset = $entry['offset'];

        if (substr($raw, $offset, 4) !== "PK\x03\x04") {
            throw new \RuntimeException('File XLSX rusak: header entri arsip tidak valid.');
        }

        $nameLength = unpack('v', substr($raw, $offset + 26, 2))[1];
        $extraLength = unpack('v', substr($raw, $offset + 28, 2))[1];
        $start = $offset + 30 + $nameLength + $extraLength;
        $data = substr($raw, $start, $entry['compressed']);

        if (strlen($data) < $entry['compressed']) {
            throw new \RuntimeException('File XLSX rusak: isi entri arsip terpotong.');
        }

        return match ($entry['method']) {
            0 => $data, // stored
            8 => $this->inflate($data), // deflate (raw)
            default => throw new \RuntimeException(
                'File XLSX memakai metode kompresi yang tidak didukung (metode '.$entry['method'].').'
            ),
        };
    }

    /** Deflate mentah sesuai spesifikasi ZIP (bukan zlib header). */
    private function inflate(string $data): string
    {
        $result = @gzinflate($data);

        if ($result === false) {
            throw new \RuntimeException('File XLSX rusak: data terkompresi gagal dibuka.');
        }

        return $result;
    }

    /* =========================================================
       XML — workbook, sheet, shared strings, styles
       ========================================================= */

    /** Cari entri dengan nama persis, atau yang diakhiri nama tsb. */
    private function locate(array $entries, string $name): string
    {
        if (isset($entries[$name])) {
            return $name;
        }

        foreach (array_keys($entries) as $entry) {
            if (str_ends_with($entry, '/'.$name)) {
                return $entry;
            }
        }

        throw new \RuntimeException('File XLSX tidak berisi berkas wajib "'.$name.'".');
    }

    /** Parse satu berkas XML menjadi DOMXPath siap query. */
    private function loadXml(string $xml, string $what): DOMXPath
    {
        if (trim($xml) === '') {
            throw new \RuntimeException("File XLSX rusak: {$what} kosong.");
        }

        // Tolak DOCTYPE — mencegah ekspansi entitas (billion laughs).
        if (stripos($xml, '<!DOCTYPE') !== false) {
            throw new \RuntimeException("File XLSX ditolak: {$what} memuat DOCTYPE.");
        }

        $document = new DOMDocument;

        $previous = libxml_use_internal_errors(true);
        $loaded = $document->loadXML($xml, LIBXML_NONET | LIBXML_COMPACT | LIBXML_NOERROR | LIBXML_NOWARNING);
        $errors = libxml_get_errors();
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        if (! $loaded) {
            $detail = $errors !== [] ? trim($errors[0]->message) : 'XML tidak valid';

            throw new \RuntimeException("File XLSX rusak: {$what} gagal dibaca ({$detail}).");
        }

        return new DOMXPath($document);
    }

    /** Ambil atribut berdasarkan local name (bebas namespace prefix). */
    private function attribute(DOMElement $element, string $localName): ?string
    {
        foreach ($element->attributes as $attribute) {
            if ($attribute->localName === $localName || $attribute->nodeName === $localName) {
                return $attribute->nodeValue;
            }
        }

        return null;
    }

    /** Apakah workbook memakai sistem tanggal 1904 (Excel Mac lama)? */
    private function uses1904Epoch(DOMXPath $workbook): bool
    {
        $nodes = $workbook->query("/*[local-name()='workbook']/*[local-name()='workbookPr']");

        if ($nodes === false || $nodes->length === 0) {
            return false;
        }

        $value = strtolower((string) $this->attribute($nodes->item(0), 'date1904'));

        return $value === '1' || $value === 'true';
    }

    /**
     * Jalur entri sheet pertama yang benar-benar ada di arsip —
     * didapat dari `r:id` sheet pertama di workbook.xml, dipetakan lewat
     * `xl/_rels/workbook.xml.rels` (target relatif terhadap folder
     * workbook, bisa juga absolut "/xl/...").
     */
    private function firstSheetPath(DOMXPath $workbook, string $workbookPath, array $entries): string
    {
        $sheets = $workbook->query("/*[local-name()='workbook']/*[local-name()='sheets']/*[local-name()='sheet']");

        if ($sheets === false || $sheets->length === 0) {
            throw new \RuntimeException('File XLSX tidak memuat lembar kerja (sheet) apa pun.');
        }

        $base = str_contains($workbookPath, '/')
            ? substr($workbookPath, 0, strrpos($workbookPath, '/') + 1)
            : '';

        $targets = $this->relationshipTargets($workbookPath, $entries);

        foreach ($sheets as $sheet) {
            $id = $this->attribute($sheet, 'id');
            $target = $id !== null ? ($targets[$id] ?? null) : null;

            if ($target !== null) {
                $path = str_starts_with($target, '/')
                    ? ltrim($target, '/')
                    : $this->normalizePath($base.$target);

                if (isset($entries[$path])) {
                    return $path;
                }
            }
        }

        // Fallback tanpa relasi: nama baku "xl/worksheets/sheet1.xml".
        if (isset($entries['xl/worksheets/sheet1.xml'])) {
            return 'xl/worksheets/sheet1.xml';
        }

        throw new \RuntimeException('File XLSX tidak memuat berkas sheet yang dapat dibaca.');
    }

    /**
     * Peta relasi workbook (Id → target) dari
     * `xl/_rels/workbook.xml.rels`.
     *
     * @return array<string, string>
     */
    private function relationshipTargets(string $workbookPath, array $entries): array
    {
        $folder = str_contains($workbookPath, '/')
            ? substr($workbookPath, 0, strrpos($workbookPath, '/'))
            : '';

        $relsPath = ($folder !== '' ? $folder.'/' : '').'_rels/'.basename($workbookPath).'.rels';

        if (! isset($entries[$relsPath])) {
            return [];
        }

        $xpath = $this->loadXml($entries[$relsPath], 'workbook.xml.rels');
        $nodes = $xpath->query("//*[local-name()='Relationship']");

        $targets = [];

        foreach ($nodes ?: [] as $node) {
            if (! $node instanceof DOMElement) {
                continue;
            }

            $id = $this->attribute($node, 'Id');
            $target = $this->attribute($node, 'Target');

            if ($id !== null && $target !== null) {
                $targets[$id] = $target;
            }
        }

        return $targets;
    }

    /** Normalisasi "xl/./worksheets/../worksheets/sheet1.xml" → jalur rapi. */
    private function normalizePath(string $path): string
    {
        $parts = [];

        foreach (explode('/', str_replace('\\', '/', $path)) as $segment) {
            if ($segment === '' || $segment === '.') {
                continue;
            }

            if ($segment === '..') {
                array_pop($parts);

                continue;
            }

            $parts[] = $segment;
        }

        return implode('/', $parts);
    }

    /**
     * Teks bersama (`xl/sharedStrings.xml`) — tiap `<si>` bisa berisi
     * satu `<t>` atau banyak run `<r><t>` (teks ber-format) yang harus
     * disambung.
     *
     * @return list<string>
     */
    private function sharedStrings(array $entries): array
    {
        if (! isset($entries['xl/sharedStrings.xml'])) {
            return [];
        }

        $xpath = $this->loadXml($entries['xl/sharedStrings.xml'], 'sharedStrings.xml');
        $items = $xpath->query("/*[local-name()='sst']/*[local-name()='si']");

        $strings = [];

        foreach ($items ?: [] as $item) {
            $text = '';

            foreach ($xpath->query(".//*[local-name()='t']", $item) ?: [] as $part) {
                $text .= $part->textContent;
            }

            $strings[] = $text;
        }

        return $strings;
    }

    /**
     * Indeks `<xf>` (cellXfs) yang formatnya tanggal — dari numFmtId
     * bawaan Excel atau format kustom yang mengandung token
     * d/m/y/h/s. Dipakai untuk mengubah sel angka bergaya tanggal
     * menjadi Y-m-d (serial Excel).
     *
     * @return array<int, true>
     */
    private function dateStyleIndexes(array $entries): array
    {
        if (! isset($entries['xl/styles.xml'])) {
            return [];
        }

        $xpath = $this->loadXml($entries['xl/styles.xml'], 'styles.xml');

        $customDateFormats = [];
        $formats = $xpath->query("/*[local-name()='styleSheet']/*[local-name()='numFmts']/*[local-name()='numFmt']");

        foreach ($formats ?: [] as $format) {
            if (! $format instanceof DOMElement) {
                continue;
            }

            $id = (int) $this->attribute($format, 'numFmtId');
            $code = (string) $this->attribute($format, 'formatCode');

            $customDateFormats[$id] = $this->looksLikeDateFormat($code);
        }

        $dateStyles = [];
        $cellXfs = $xpath->query("/*[local-name()='styleSheet']/*[local-name()='cellXfs']/*[local-name()='xf']");
        $index = 0;

        foreach ($cellXfs ?: [] as $xf) {
            // Indeks = urutan `<xf>` (atribut `s` pada sel menunjuk ke sini),
            // dihitung manual karena iterasi DOMNodeList tidak menjamin kunci.
            if ($xf instanceof DOMElement) {
                $formatId = (int) $this->attribute($xf, 'numFmtId');

                if (in_array($formatId, self::BUILTIN_DATE_FORMATS, true) || ($customDateFormats[$formatId] ?? false)) {
                    $dateStyles[$index] = true;
                }
            }

            $index++;
        }

        return $dateStyles;
    }

    /**
     * Tebak apakah format angka Excel bersifat tanggal/waktu: buang
     * teks dalam kutipan, blok [..], escape \\x & karakter pengunci
     * ("_x"), lalu sisanya dicek mengandung token d/m/y/h/s.
     */
    private function looksLikeDateFormat(string $code): bool
    {
        $stripped = preg_replace('/"[^"]*"/', '', $code) ?? '';
        $stripped = preg_replace('/\[[^\]]*\]/', '', $stripped) ?? '';
        $stripped = preg_replace('/\\./', '', $stripped) ?? '';
        $stripped = preg_replace('/_[^\s]/', '', $stripped) ?? '';

        return preg_match('/[dmyhs]/i', $stripped) === 1;
    }

    /* =========================================================
       SHEET — daftar baris sel bernomor baris asli
       ========================================================= */

    /**
     * @param  list<string>  $shared
     * @param  array<int, true>  $dateStyles  indeks xf bergaya tanggal
     * @return list<array{row: int, cells: array<int, string>}>
     */
    private function readSheet(string $xml, array $shared, array $dateStyles, bool $date1904): array
    {
        $xpath = $this->loadXml($xml, 'sheet');
        $rowNodes = $xpath->query("//*[local-name()='sheetData']/*[local-name()='row']");

        $rows = [];
        $lastRow = 0;

        foreach ($rowNodes ?: [] as $rowNode) {
            if (! $rowNode instanceof DOMElement) {
                continue;
            }

            $declared = (int) $this->attribute($rowNode, 'r');
            $rowNumber = $declared > 0 ? $declared : $lastRow + 1;
            $lastRow = $rowNumber;

            $cells = [];
            $nextColumn = 0;

            foreach ($rowNode->childNodes as $child) {
                if (! $child instanceof DOMElement || $child->localName !== 'c') {
                    continue;
                }

                $reference = $this->attribute($child, 'r');
                $column = $reference !== null
                    ? $this->columnIndex($reference)
                    : $nextColumn;
                $nextColumn = $column + 1;

                $cells[$column] = $this->cellValue($child, $xpath, $shared, $dateStyles, $date1904);
            }

            if ($cells === []) {
                continue;
            }

            ksort($cells);

            // Pad agar padat 0..kolom terakhir — sel bolong jadi "".
            $maxColumn = array_key_last($cells);
            $dense = array_fill(0, $maxColumn + 1, '');

            foreach ($cells as $index => $value) {
                $dense[$index] = $value;
            }

            $rows[] = ['row' => $rowNumber, 'cells' => $dense];
        }

        return $rows;
    }

    /** Satu sel → string nilai (teks / angka / tanggal terformat). */
    private function cellValue(
        DOMElement $cell,
        DOMXPath $xpath,
        array $shared,
        array $dateStyles,
        bool $date1904
    ): string {
        $type = $this->attribute($cell, 't') ?? 'n';

        // Teks tersimpan di sharedStrings (index) atau inline.
        if ($type === 's') {
            $value = $this->scalarValue($cell);

            return $value === '' ? '' : ($shared[(int) $value] ?? '');
        }

        if ($type === 'inlineStr') {
            $text = '';

            foreach ($xpath->query(".//*[local-name()='t']", $cell) ?: [] as $part) {
                $text .= $part->textContent;
            }

            return $text;
        }

        $value = $this->scalarValue($cell);

        if ($value === '') {
            return '';
        }

        if ($type === 'b') {
            return $value === '1' ? '1' : '0';
        }

        // Sel angka bergaya tanggal → serial Excel diubah jadi Y-m-d.
        if ($type === 'n' && is_numeric($value)) {
            $style = $this->attribute($cell, 's');

            if ($style !== null && isset($dateStyles[(int) $style])) {
                return $this->serialToYmd((float) $value, $date1904);
            }

            return $this->normalizeNumber($value);
        }

        // "str" (hasil rumus), "d" (tanggal ISO), "e" (error) — teks apa adanya.
        return $value;
    }

    /** Isi `<v>` sebuah sel (atau `<is>` bila inline). */
    private function scalarValue(DOMElement $cell): string
    {
        foreach ($cell->childNodes as $child) {
            if ($child instanceof DOMElement && ($child->localName === 'v' || $child->localName === 'is')) {
                if ($child->localName === 'is') {
                    $text = '';

                    foreach ($child->getElementsByTagName('*') as $part) {
                        if ($part->localName === 't') {
                            $text .= $part->textContent;
                        }
                    }

                    return $text;
                }

                return $child->textContent;
            }
        }

        return '';
    }

    /** "ABC" / "A1" → indeks kolom (A = 0, AA = 26). */
    private function columnIndex(string $reference): int
    {
        if (preg_match('/^([A-Za-z]+)/', $reference, $matches) !== 1) {
            return 0;
        }

        $letters = strtoupper($matches[1]);
        $index = 0;
        $length = strlen($letters);

        for ($i = 0; $i < $length; $i++) {
            $index = $index * 26 + (ord($letters[$i]) - 64);
        }

        return $index - 1;
    }

    /** Serial Excel → Y-m-d (basis 1900; bug 1900-02-29 ditolerir). */
    private function serialToYmd(float $serial, bool $date1904): string
    {
        $days = (int) floor($serial);

        if ($date1904) {
            $days += self::EPOCH_1904_OFFSET;
        }

        return gmdate('Y-m-d', ($days - self::EPOCH_OFFSET) * 86400);
    }

    /**
     * Rapikan angka: "34000.0" → "34000" (sekali tulis ulang tidak
     * kehilangan presisi), desimal tetap apa adanya (mis. FTE "1.5").
     */
    private function normalizeNumber(string $value): string
    {
        if (! is_numeric($value)) {
            return $value;
        }

        $float = (float) $value;

        if (is_finite($float) && abs($float) < 1e15 && floor($float) === $float) {
            return (string) (int) $float;
        }

        return $value;
    }
}
