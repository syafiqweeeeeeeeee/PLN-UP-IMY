<?php

namespace Tests\Support;

/**
 * PENULIS .xlsx untuk uji — menyusun arsip ZIP secara manual (tanpa
 * ext-zip, tanpa ZipArchive) sehingga test impor XLSX benar-benar
 * membelokkan parser ZIP native di `App\Services\XlsxReader`.
 *
 * Nilai sel:
 * - `string`        → sel teks lewat sharedStrings.xml (`t="s"`)
 * - `int`/`float`   → sel angka (`<v>` murni, tanpa gaya)
 * - `['date' => 'Y-m-d']` → sel angka bergaya tanggal (`s="1"`,
 *   numFmtId 164 "dd/mm/yyyy") — menguji deteksi gaya tanggal.
 *
 * Opsional `$options`:
 * - `'store' => true` → entri tanpa kompresi (metode 0); default
 *   memakai deflate mentah (metode 8, `gzdeflate`) seperti Excel.
 */
final class XlsxWriter
{
    /** Gaya tanggal pada `<cellXfs>` urutan ke-2 (indeks `s="1"`). */
    public const DATE_STYLE_INDEX = 1;

    /**
     * Susun konten berkas .xlsx.
     *
     * @param  array<int, array<int, mixed>>  $rows  daftar baris (baris 0 umumnya header)
     * @param  array{store?: bool}  $options
     */
    public static function build(array $rows, array $options = []): string
    {
        $store = (bool) ($options['store'] ?? false);

        $shared = [];
        $sharedIndex = [];
        $sheet = '';

        foreach ($rows as $rowOffset => $cells) {
            $rowNumber = $rowOffset + 1;
            $sheet .= '<row r="'.$rowNumber.'">';

            foreach ($cells as $column => $value) {
                if ($value === null || $value === '') {
                    continue;
                }

                $reference = self::columnLetter($column).$rowNumber;

                if (is_array($value) && isset($value['date'])) {
                    $sheet .= '<c r="'.$reference.'" s="'.self::DATE_STYLE_INDEX.'"><v>'
                        .self::dateSerial($value['date']).'</v></c>';

                    continue;
                }

                if (is_int($value) || is_float($value)) {
                    $sheet .= '<c r="'.$reference.'"><v>'.$value.'</v></c>';

                    continue;
                }

                $text = (string) $value;

                if (! isset($sharedIndex[$text])) {
                    $sharedIndex[$text] = count($shared);
                    $shared[] = $text;
                }

                $sheet .= '<c r="'.$reference.'" t="s"><v>'.$sharedIndex[$text].'</v></c>';
            }

            $sheet .= '</row>';
        }

        $parts = [
            '[Content_Types].xml' => self::contentTypes(),
            '_rels/.rels' => self::rootRels(),
            'xl/workbook.xml' => self::workbook(),
            'xl/_rels/workbook.xml.rels' => self::workbookRels(),
            'xl/styles.xml' => self::styles(),
            'xl/sharedStrings.xml' => self::sharedStrings($shared),
            'xl/worksheets/sheet1.xml' => '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
                .'<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
                .'<sheetData>'.$sheet.'</sheetData></worksheet>',
        ];

        return self::zip($parts, $store);
    }

    /** Y-m-d → serial Excel (basis 1899-12-30). */
    public static function dateSerial(string $date): int
    {
        $timestamp = strtotime($date.' UTC');

        return (int) round($timestamp / 86400 + 25569);
    }

    /** Indeks kolom (0 = A) → huruf kolom Excel (25 = Z, 26 = AA). */
    public static function columnLetter(int $index): string
    {
        $letter = '';

        for ($position = $index + 1; $position > 0; $position = intdiv($position - 1, 26)) {
            $letter = chr(65 + (($position - 1) % 26)).$letter;
        }

        return $letter;
    }

    /* =========================================================
       ZIP manual — local file header + central directory + EOCD
       ========================================================= */

    /**
     * Susun arsip ZIP dari nama → isi.
     *
     * @param  array<string, string>  $parts
     */
    private static function zip(array $parts, bool $store): string
    {
        $local = '';
        $central = '';
        $offset = 0;
        $count = 0;

        foreach ($parts as $name => $content) {
            $method = $store ? 0 : 8;
            $payload = $store ? $content : gzdeflate($content);
            $crc = crc32($content);
            $nameBytes = $name;

            $header = pack(
                'VvvvvvVVVvv',
                0x04034B50, 20, 0, $method, 0, 0x21, // sig, versi, flags, metode, jam, tanggal
                $crc, strlen($payload), strlen($content),
                strlen($nameBytes), 0
            ).$nameBytes.$payload;

            $central .= pack(
                'VvvvvvvVVVvvvvvVV',
                0x02014B50, 20, 20, 0, $method, 0, 0x21,
                $crc, strlen($payload), strlen($content),
                strlen($nameBytes), 0, 0, 0, 0, 0,
                $offset
            ).$nameBytes;

            $local .= $header;
            $offset += strlen($header);
            $count++;
        }

        $end = pack(
            'VvvvvVVv',
            0x06054B50, 0, 0, $count, $count,
            strlen($central), strlen($local), 0
        );

        return $local.$central.$end;
    }

    /* =========================================================
       Bagian XML OOXML
       ========================================================= */

    private static function contentTypes(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
            .'<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
            .'<Default Extension="xml" ContentType="application/xml"/>'
            .'<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>'
            .'<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>'
            .'<Override PartName="/xl/sharedStrings.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sharedStrings+xml"/>'
            .'<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>'
            .'</Types>';
    }

    private static function rootRels(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            .'<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>'
            .'</Relationships>';
    }

    private static function workbook(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"'
            .' xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
            .'<sheets><sheet name="Sheet1" sheetId="1" r:id="rId1"/></sheets>'
            .'</workbook>';
    }

    private static function workbookRels(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            .'<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>'
            .'<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>'
            .'<Relationship Id="rId3" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/sharedStrings" Target="sharedStrings.xml"/>'
            .'</Relationships>';
    }

    private static function styles(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
            .'<numFmts count="1"><numFmt numFmtId="164" formatCode="dd/mm/yyyy"/></numFmts>'
            .'<fonts count="1"><font><sz val="11"/><name val="Calibri"/></font></fonts>'
            .'<fills count="1"><fill><patternFill patternType="none"/></fill></fills>'
            .'<borders count="1"><border/></borders>'
            .'<cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>'
            .'<cellXfs count="2">'
            .'<xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/>'
            .'<xf numFmtId="164" fontId="0" fillId="0" borderId="0" xfId="0" applyNumberFormat="1"/>'
            .'</cellXfs>'
            .'</styleSheet>';
    }

    /**
     * @param  list<string>  $strings
     */
    private static function sharedStrings(array $strings): string
    {
        $items = '';

        foreach ($strings as $string) {
            $items .= '<si><t xml:space="preserve">'.self::escape($string).'</t></si>';
        }

        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<sst xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"'
            .' count="'.count($strings).'" uniqueCount="'.count($strings).'">'
            .$items
            .'</sst>';
    }

    private static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }
}
