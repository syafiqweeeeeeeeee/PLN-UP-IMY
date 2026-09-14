<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'file_gambar',
        'tanggal_kegiatan',
        'status',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];

    public const CATEGORIES = ['KEGIATAN', 'FASILITAS', 'DOKUMENTASI', 'SEREMONIAL'];

    /** Kategori yang tersedia untuk publik, lowercase sebagai nilai filter. */
    public const PUBLIC_FILTERS = [
        'kegiatan'    => 'Kegiatan',
        'fasilitas'   => 'Fasilitas',
        'dokumentasi' => 'Dokumentasi',
        'seremonial'  => 'Seremonial',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'publikasi');
    }

    /** URL lengkap gambar dari storage public. */
    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->file_gambar);
    }
}
