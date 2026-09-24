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
        'surat_jalan',
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
     * URL foto KTP — disajikan lewat route PRIVAT (admin.tamu.ktp)
     * yang meng-stream file dari disk private.
     *
     * Route berada di grup middleware auth + permission:tamu.view,
     * sehingga foto KTP tidak bisa diakses publik via /storage.
     * Relatif agar valid di host/port mana pun.
     */
    public function getFotoKtpUrlAttribute(): string
    {
        return route('admin.tamu.ktp', $this);
    }

    /**
     * URL surat permohonan PDF — juga lewat route privat (admin.tamu.surat).
     * Null bila tamu tidak memiliki lampiran surat.
     */
    public function getSuratJalanUrlAttribute(): ?string
    {
        if (! $this->surat_jalan) {
            return null;
        }

        return route('admin.tamu.surat', $this);
    }

    /**
     * Nomor HP dalam format internasional (awalan 08 -> 62)
     * untuk link click-to-chat WhatsApp.
     */
    public function getWaNumberAttribute(): string
    {
        $digits = preg_replace('/\D/', '', (string) $this->no_hp);

        // 0xxxxxxxxxx  -> 62xxxxxxxxxx
        // 8xxxxxxxxxx  -> 62xxxxxxxxxx (user lupa mengetik 0)
        // 62xxxxxxxxxx -> sudah benar
        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        } elseif (str_starts_with($digits, '8')) {
            $digits = '62' . $digits;
        }

        return $digits;
    }

    /**
     * URL click-to-chat WhatsApp dengan template pesan konfirmasi
     * kunjungan yang sudah terisi nama tamu.
     */
    public function getWaChatUrlAttribute(): string
    {
        $message = "Halo Bpk/Ibu {$this->nama}, terkait pendaftaran kunjungan "
            . "Anda di PT PLN Nusantara Power UP PLTU Indramayu, "
            . "kami ingin mengonfirmasi jadwal kunjungan Anda. Terima kasih.";

        return 'https://wa.me/' . $this->wa_number . '?text=' . rawurlencode($message);
    }

    /**
     * Link mailto dengan subjek email otomatis (konfirmasi kunjungan).
     * Null bila tamu tidak mengisi email.
     */
    public function getMailtoUrlAttribute(): ?string
    {
        if (! $this->email) {
            return null;
        }

        $subject = 'Konfirmasi Kunjungan Tamu - PLN Nusantara Power';

        return 'mailto:' . $this->email . '?subject=' . rawurlencode($subject);
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
