<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    public const TYPE_ROUTE = 'route';
    public const TYPE_PAGE  = 'page';
    public const TYPE_URL   = 'url';

    public const TYPES = [
        self::TYPE_ROUTE => 'Halaman yang sudah ada di situs',
        self::TYPE_PAGE  => 'Halaman buatan sendiri (dari menu "Halaman")',
        self::TYPE_URL   => 'Link / alamat lain',
    ];

    /** Penjelasan awam per tipe — tampil di form admin. */
    public const TYPE_DESCRIPTIONS = [
        self::TYPE_ROUTE => 'Untuk halaman bawaan situs seperti Berita, Galeri, atau Kontak. Tinggal pilih dari daftar.',
        self::TYPE_PAGE  => 'Untuk halaman yang kamu buat lewat menu "Halaman" di admin. Kalau halamannya masih draft atau khusus karyawan tertentu, menu ini otomatis disembunyikan dari pengunjung yang tidak berhak.',
        self::TYPE_URL   => 'Untuk alamat lain: situs eksternal (contoh: https://web.pln.co.id) atau alamat dalam situs ini (contoh: /kontak/lokasi).',
    ];

    protected $fillable = [
        'parent_id',
        'label',
        'type',
        'route_name',
        'page_id',
        'url',
        'icon',
        'sort_order',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'sort_order'  => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('sort_order')->orderBy('id');
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /* =========================================================
       SCOPE
       ========================================================= */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeRoots(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /* =========================================================
       URL & LABEL
       ========================================================= */

    public function resolvedUrl(): ?string
    {
        return match ($this->type) {
            self::TYPE_ROUTE => $this->route_name && \Illuminate\Support\Facades\Route::has($this->route_name)
                ? route($this->route_name)
                : null,
            self::TYPE_PAGE  => $this->page?->exists ? route('pages.show', $this->page) : null,
            self::TYPE_URL   => $this->url ?: null,
            default          => null,
        };
    }

    /** True jika target link masih valid (route ada / page masih ada / url terisi). */
    public function hasValidTarget(): bool
    {
        return $this->resolvedUrl() !== null;
    }

    /* =========================================================
       ICON
       ========================================================= */

    /** Kelas ikon Font Awesome final — default per tipe jika kosong. */
    public function iconClass(): string
    {
        $icon = trim((string) $this->icon);

        if ($icon === '') {
            return match ($this->type) {
                self::TYPE_ROUTE => 'fa-link',
                self::TYPE_PAGE  => 'fa-file-lines',
                default          => 'fa-up-right-from-square',
            };
        }

        return $icon;
    }
}
