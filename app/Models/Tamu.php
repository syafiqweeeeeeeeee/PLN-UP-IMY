<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Tamu — buku registrasi pengunjung kantor/instansi.
 *
 * Kolom status: checked_in_at / checked_out_at (null = belum).
 * Helper isCheckedin() & durasiKunjungan() memudahkan front office.
 */
class Tamu extends Model
{
    protected $table = 'tamus';

    protected $fillable = [
        'nik',
        'nama',
        'instansi',
        'no_hp',
        'email',
        'foto_ktp',
        'tujuan_ditemui',
        'jumlah_tamu',
        'tanggal_kunjungan',
        'keperluan',
        'checked_in_at',
        'checked_out_at',
    ];

    protected $casts = [
        'jumlah_tamu'       => 'integer',
        'tanggal_kunjungan' => 'datetime',
        'checked_in_at'     => 'datetime',
        'checked_out_at'    => 'datetime',
    ];

    /**
     * URL publik foto KTP (disk 'public').
     */
    public function getFotoKtpUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->foto_ktp);
    }

    /**
     * Apakah tamu sudah check-in (dan belum check-out).
     */
    public function isCheckedIn(): bool
    {
        return $this->checked_in_at !== null && $this->checked_out_at === null;
    }

    /**
     * Durasi kunjungan dalam menit (null bila belum check-out).
     */
    public function durasiKunjungan(): ?int
    {
        if ($this->checked_in_at === null || $this->checked_out_at === null) {
            return null;
        }

        return (int) round($this->checked_in_at->diffInMinutes($this->checked_out_at));
    }

    /* =========================================================
       QUERY SCOPES (filter halaman admin)
       ========================================================= */

    /**
     * Cari berdasarkan nama, instansi, atau NIK (contains).
     */
    public function scopeSearch($query, ?string $term)
    {
        $term = trim((string) $term);

        if ($term === '') {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('nama', 'like', "%{$term}%")
              ->orWhere('instansi', 'like', "%{$term}%")
              ->orWhere('nik', 'like', "%{$term}%");
        });
    }

    /**
     * Filter rentang tanggal kunjungan (inklusif).
     */
    public function scopeTanggalAntara($query, ?string $dari, ?string $sampai)
    {
        if ($dari) {
            $query->whereDate('tanggal_kunjungan', '>=', $dari);
        }

        if ($sampai) {
            $query->whereDate('tanggal_kunjungan', '<=', $sampai);
        }

        return $query;
    }

    /**
     * Filter status kunjungan: "berkunjung" (belum check-out)
     * atau "selesai" (sudah check-out).
     */
    public function scopeStatus($query, ?string $status)
    {
        return match ($status) {
            'berkunjung' => $query->whereNull('checked_out_at'),
            'selesai'    => $query->whereNotNull('checked_out_at'),
            default      => $query,
        };
    }
}
