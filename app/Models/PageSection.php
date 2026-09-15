<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model
{
    /** Jenis section yang didukung — versi sederhana: section tetap + form. */
    public const TYPES = [
        'banner' => 'Banner / Hero',
        'text'   => 'Teks',
        'cards'  => 'Kartu',
        'file'   => 'Daftar File',
        'faq'    => 'Tanya Jawab (FAQ)',
    ];

    protected $fillable = [
        'page_id',
        'type',
        'data',
        'sort_order',
    ];

    protected $casts = [
        'data'      => 'array',
        'sort_order'=> 'integer',
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function typeLabel(): string
    {
        return static::TYPES[$this->type] ?? ucfirst($this->type);
    }

    public function dataValue(string $key, string $default = ''): string
    {
        return (string) ($this->data[$key] ?? $default);
    }

    /** Items normalisasi: title, description, url (opsional). */
    public function items(): array
    {
        $items = $this->data['items'] ?? null;

        return is_array($items) ? $items : [];
    }

    /** Serialisasi items ke format textarea "A | B | C" per baris (untuk form admin). */
    public function itemsAsText(): string
    {
        return collect($this->items())
            ->map(function (array $item) {
                return collect([
                    $item['title'] ?? '',
                    $item['description'] ?? '',
                    $item['url'] ?? '',
                ])->filter(fn ($v) => (string) $v !== '')->implode(' | ');
            })
            ->implode("\n");
    }

    /* =========================================================
       BUILDER DATA (dipakai bersama PageController & PageSectionController)
       ========================================================= */

    /** Susun kolom `data` (JSON) dari input form baris section. */
    public static function buildData(string $type, array $input): array
    {
        return match ($type) {
            'banner' => [
                'heading'     => (string) ($input['heading'] ?? ''),
                'subheading'  => (string) ($input['subheading'] ?? ''),
                'button_text' => (string) ($input['button_text'] ?? ''),
                'button_url'  => (string) ($input['button_url'] ?? ''),
            ],
            'text' => [
                'heading' => (string) ($input['heading'] ?? ''),
                'body'    => (string) ($input['body'] ?? ''),
            ],
            'cards', 'file' => [
                'heading' => (string) ($input['heading'] ?? ''),
                'items'   => static::parseItemsText($input['items'] ?? ''),
            ],
            'faq' => [
                'heading' => (string) ($input['heading'] ?? ''),
                'items'   => static::parseFaqText($input['items'] ?? ''),
            ],
            default => [],
        };
    }

    /** Input textarea: "Judul | Deskripsi | URL" per baris → array items. */
    public static function parseItemsText(?string $text): array
    {
        $lines = preg_split('/\r\n|\r|\n/', (string) $text) ?: [];

        return collect($lines)
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->map(function (string $line) {
                $parts = array_map(fn (string $p) => trim($p), explode('|', $line));

                return [
                    'title'       => $parts[0] ?? '',
                    'description' => $parts[1] ?? '',
                    'url'         => $parts[2] ?? '',
                ];
            })
            ->values()
            ->all();
    }

    /** Input textarea FAQ: "Pertanyaan | Jawaban" per baris. */
    public static function parseFaqText(?string $text): array
    {
        $lines = preg_split('/\r\n|\r|\n/', (string) $text) ?: [];

        return collect($lines)
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->map(function (string $line) {
                $parts = array_map(fn (string $p) => trim($p), explode('|', $line));

                return [
                    'question' => $parts[0] ?? '',
                    'answer'   => $parts[1] ?? '',
                ];
            })
            ->values()
            ->all();
    }
}
