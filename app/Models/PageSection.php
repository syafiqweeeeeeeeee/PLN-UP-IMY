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
}
