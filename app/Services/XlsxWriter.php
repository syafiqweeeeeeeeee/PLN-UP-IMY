<?php

namespace App\Services;

/**
 * PENULIS .xlsx NATIVE — pasangan `App\Services\XlsxReader`, tanpa
 * ekstensi `zip` (ext-zip tidak tersedia di server produksi) dan tanpa
 * paket eksternal.
 *
 * Arsip ZIP disusun manual: tiap bagian OOXML ditulis sebagai entri
 * METODE 0 (store, tanpa kompresi) — file template hanya berisi satu
 * baris header sehingga ukurannya tetap kecil, dan tidak ada
 * ketergantungan pada zlib.
 *
 * NILAI SEL:
 * - `string`      → teks (`t="inlineStr"`), nol di depan NID tetap utuh.
 * - `int`/`float` → angka (`<v>` murni).
 * - `null`/`''`   → sel dilewati (sel kosong).
 *
 * `build()` menerima seluruh baris sekaligus; pemanggil yang punya data
 * besar dapat memecahnya sendiri. Header (baris pertama) dapat ditebalkan
 * + dibekukan + difilter lewat `$options`.
 */
final class XlsxWriter
{
    /** Gaya `<cellXfs>`: 0 = teks biasa, 1 = header tebal. */
    private const STYLE_DEFAULT = 0;

    private const STYLE_HEADER = 1;

    /**
     * Susun konten berkas .xlsx (satu lembar kerja).
     *
     * @param  array<int, array<int, mixed>>  $rows  baris sel; indeks 0 = kolom A
     * @param  array{sheet?: string, header_row?: bool, freeze_header?: bool, auto_filter?: bool, column_width?: int}  $options
     *                                                                                                                           `header_row` menebalkan baris pertama, `freeze_header`
     *                                                                                                                           membekukan baris pertama, `auto_filter` menambah filter pada
     *                                                                                                                           baris pertama, `column_width` lebar kolom (0 = bawaan Excel).
     */
    public static function build(array $rows, array $options = []): string
    {
        $sheetName = trim((string) ($options['sheet'] ?? 'Sheet1'));
        $headerRow = (bool) ($options['header_row'] ?? false);
        $freezeHeader = (bool) ($options['freeze_header'] ?? false) && $rows !== [];
        $autoFilter = (bool) ($options['auto_filter'] ?? false) && $rows !== [];
        $columnWidth = (int) ($options['column_width'] ?? 0);

        $parts = [
            '[Content_Types].xml' => self::contentTypes(),
            '_rels/.rels' => self::rootRels(),
            'xl/workbook.xml' => self::workbook($sheetName === '' ? 'Sheet1' : $sheetName),
            'xl/_rels/workbook.xml.rels' => self::workbookRels(),
            'xl/styles.xml' => self::styles(),
            'xl/worksheets/sheet1.xml' => self::sheet($rows, $headerRow, $freezeHeader, $autoFilter, $columnWidth),
        ];

        return self::zip($parts);
    }

    /* =========================================================
       LEMBAR KERJA
       ========================================================= */

    /**
     * @param  array<int, array<int, mixed>>  $rows
     */
    private static function sheet(
        array $rows,
        bool $headerRow,
        bool $freezeHeader,
        bool $autoFilter,
        int $columnWidth
    ): string {
        $sheetData = '';

        foreach (array_values($rows) as $rowIndex => $cells) {
            $rowNumber = $rowIndex + 1;
            $style = $headerRow && $rowIndex === 0 ? self::STYLE_HEADER : self::STYLE_DEFAULT;
            $cellsXml = '';

            foreach (array_values($cells) as $column => $value) {
                $cellsXml .= self::cell(self::columnLetter($column).$rowNumber, $value, $style);
            }

            // Baris tanpa sel tidak perlu ditulis sama sekali.
            if ($cellsXml !== '') {
                $sheetData .= '<row r="'.$rowNumber.'">'.$cellsXml.'</row>';
            }
        }

        $lastColumn = self::lastColumnLetter($rows);
        $lastRow = max(1, count($rows));

        $views = '';
        if ($freezeHeader) {
            $views = '<sheetViews><sheetView workbookViewId="0">'
                .'<pane ySplit="1" topLeftCell="A2" activePane="bottomLeft" state="frozen"/>'
                .'<selection pane="bottomLeft" activeCell="A2" sqref="A2"/>'
                .'</sheetView></sheetViews>';
        }

        $cols = '';
        if ($columnWidth > 0) {
            $cols = '<cols><col min="1" max="'.max(1, count(self::widestRow($rows))).'"'
                .' width="'.$columnWidth.'" customWidth="1"/></cols>';
        }

        $filter = $autoFilter
            ? '<autoFilter ref="A1:'.$lastColumn.'1"/>'
            : '';

        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
            .'<dimension ref="A1:'.$lastColumn.$lastRow.'"/>'
            .$views
            .$cols
            .'<sheetData>'.$sheetData.'</sheetData>'
            .$filter
            .'</worksheet>';
    }

    /** Satu sel XML; sel kosong tidak ditulis. */
    private static function cell(string $reference, mixed $value, int $style): string
    {
        if ($value === null) {
            return '';
        }

        $styleAttribute = $style === self::STYLE_DEFAULT ? '' : ' s="'.$style.'"';

        if (is_int($value) || is_float($value)) {
            return '<c r="'.$reference.'"'.$styleAttribute.'><v>'.$value.'</v></c>';
        }

        $text = self::sanitize((string) $value);

        if ($text === '') {
            return '';
        }

        return '<c r="'.$reference.'" t="inlineStr"'.$styleAttribute.'>'
            .'<is><t xml:space="preserve">'.self::escape($text).'</t></is></c>';
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

    /**
     * Baris dengan sel terbanyak — untuk rentang `<col>`.
     *
     * @param  array<int, array<int, mixed>>  $rows
     * @return array<int, mixed>
     */
    private static function widestRow(array $rows): array
    {
        $widest = [];

        foreach ($rows as $cells) {
            if (count($cells) > count($widest)) {
                $widest = $cells;
            }
        }

        return $widest;
    }

    /**
     * Huruf kolom terakhir yang dipakai (minimal A).
     *
     * @param  array<int, array<int, mixed>>  $rows
     */
    private static function lastColumnLetter(array $rows): string
    {
        $count = count(self::widestRow($rows));

        return self::columnLetter(max(0, $count - 1));
    }

    /** Buang karakter yang tidak sah di XML 1.0 (mis. NUL, VT). */
    private static function sanitize(string $value): string
    {
        $clean = preg_replace('/[^\x{9}\x{A}\x{D}\x{20}-\x{D7FF}\x{E000}-\x{FFFD}]/u', '', $value);

        return $clean ?? '';
    }

    private static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }

    /* =========================================================
       ZIP manual — local file header + central directory + EOCD
       ========================================================= */

    /**
     * Susun arsip ZIP (metode 0 / store) dari nama → isi.
     *
     * @param  array<string, string>  $parts
     */
    private static function zip(array $parts): string
    {
        $local = '';
        $central = '';
        $offset = 0;
        $count = 0;

        foreach ($parts as $name => $content) {
            // Tanggal/jam tetap (1980-01-01 00:00) agar berkas identik
            // untuk isi yang sama — tidak ada metadata waktu yang bocor.
            $crc = crc32($content);

            $header = pack(
                'VvvvvvVVVvv',
                0x04034B50, 20, 0, 0, 0, 0x21, // sig, versi, flags, metode, jam, tanggal
                $crc, strlen($content), strlen($content),
                strlen($name), 0
            ).$name.$content;

            $central .= pack(
                'VvvvvvvVVVvvvvvVV',
                0x02014B50, 20, 20, 0, 0, 0, 0x21,
                $crc, strlen($content), strlen($content),
                strlen($name), 0, 0, 0, 0, 0,
                $offset
            ).$name;

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
       BAGIAN XML OOXML
       ========================================================= */

    private static function contentTypes(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
            .'<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
            .'<Default Extension="xml" ContentType="application/xml"/>'
            .'<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>'
            .'<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>'
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

    private static function workbook(string $sheetName): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"'
            .' xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
            .'<sheets><sheet name="'.self::escape(self::sanitizeSheetName($sheetName)).'" sheetId="1" r:id="rId1"/></sheets>'
            .'</workbook>';
    }

    /** Excel membatasi nama sheet 31 karakter & tanpa karakter terlarang. */
    private static function sanitizeSheetName(string $name): string
    {
        $name = str_replace(['\\', '/', '?', '*', '[', ']', ':'], ' ', $name);
        $name = trim(mb_substr($name, 0, 31));

        return $name === '' ? 'Sheet1' : $name;
    }

    private static function workbookRels(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            .'<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>'
            .'<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>'
            .'</Relationships>';
    }

    private static function styles(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
            .'<fonts count="2">'
            .'<font><sz val="11"/><name val="Calibri"/><family val="2"/></font>'
            .'<font><b/><sz val="11"/><name val="Calibri"/><family val="2"/></font>'
            .'</fonts>'
            .'<fills count="2">'
            .'<fill><patternFill patternType="none"/></fill>'
            .'<fill><patternFill patternType="gray125"/></fill>'
            .'</fills>'
            .'<borders count="1"><border><left/><right/><top/><bottom/><diagonal/></border></borders>'
            .'<cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>'
            .'<cellXfs count="2">'
            .'<xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/>'
            .'<xf numFmtId="0" fontId="1" fillId="0" borderId="0" xfId="0" applyFont="1"/>'
            .'</cellXfs>'
            .'<cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0"/></cellStyles>'
            .'</styleSheet>';
    }
}
