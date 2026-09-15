<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContactMessage extends Model
{
    use HasFactory;

    /* =========================================================
       STATUS
       ========================================================= */
    public const STATUS_BELUM_DIBACA = 'belum_dibaca';
    public const STATUS_DIPROSES     = 'diproses';
    public const STATUS_SELESAI      = 'selesai';

    public const STATUSES = [
        self::STATUS_BELUM_DIBACA,
        self::STATUS_DIPROSES,
        self::STATUS_SELESAI,
    ];

    /* =========================================================
       KATEGORI (sesuai form kontak publik)
       ========================================================= */
    public const KATEGORI_UMUM           = 'pertanyaan_umum';
    public const KATEGORI_KERJASAMA      = 'kerjasama_bisnis';
    public const KATEGORI_LAYANAN_OM     = 'layanan_om';
    public const KATEGORI_MEDIA          = 'media_pers';
    public const KATEGORI_KARIR          = 'karir';

    public const KATEGORI = [
        self::KATEGORI_UMUM,
        self::KATEGORI_KERJASAMA,
        self::KATEGORI_LAYANAN_OM,
        self::KATEGORI_MEDIA,
        self::KATEGORI_KARIR,
    ];

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'kategori',
        'subjek',
        'pesan',
        'status',
        'read_at',
    ];

    /*
     * Nilai default eksplisit — setiap pesan baru (dari form kontak publik,
     * seeder, maupun tinker) selalu berstatus 'belum_dibaca' tanpa bergantung
     * pada default kolom database.
     */
    protected $attributes = [
        'status' => self::STATUS_BELUM_DIBACA,
    ];

    protected $casts = [
        'read_at'   => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* =========================================================
       SCOPES
       ========================================================= */
    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_BELUM_DIBACA);
    }

    /* =========================================================
       HELPERS
       ========================================================= */

    public function isUnread(): bool
    {
        return $this->status === self::STATUS_BELUM_DIBACA;
    }

    public function markAsRead(): void
    {
        if ($this->isUnread()) {
            $this->update([
                'status'  => self::STATUS_DIPROSES,
                'read_at' => now(),
            ]);
        }
    }

    public static function unreadCount(): int
    {
        return static::query()->unread()->count();
    }

    /* =========================================================
       LABEL UNTUK TAMPILAN ADMIN
       ========================================================= */
    public static function statusLabels(): array
    {
        return [
            self::STATUS_BELUM_DIBACA => 'Belum Dibaca',
            self::STATUS_DIPROSES     => 'Diproses',
            self::STATUS_SELESAI      => 'Selesai',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return static::statusLabels()[$this->status] ?? ucfirst($this->status);
    }

    public function getKategoriLabelAttribute(): string
    {
        return match ($this->kategori) {
            self::KATEGORI_UMUM       => 'Pertanyaan Umum',
            self::KATEGORI_KERJASAMA  => 'Kerjasama Bisnis',
            self::KATEGORI_LAYANAN_OM => 'Layanan Pembangkitan/O&M',
            self::KATEGORI_MEDIA      => 'Media & Pers',
            self::KATEGORI_KARIR      => 'Karir',
            default                   => ucfirst($this->kategori),
        };
    }

    /* Normalisasi nomor WA: 08xx / +62xx → 62xx untuk link wa.me */
    public function getWaNumberAttribute(): string
    {
        $digits = preg_replace('/\D/', '', $this->telepon) ?? '';

        if (Str::startsWith($digits, '0')) {
            return '62' . substr($digits, 1);
        }

        return $digits;
    }

    public function getWaLinkAttribute(): string
    {
        return 'https://wa.me/' . $this->wa_number;
    }

    public function getMailtoLinkAttribute(): string
    {
        return 'mailto:' . $this->email . '?subject=' . rawurlencode('Re: ' . $this->subjek);
    }
}
