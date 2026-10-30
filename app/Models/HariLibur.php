<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * HariLibur — master tanggal yang dikelola admin, dengan 2 TIPE status:
 *
 *   libur       : Tanggal Merah — tanggal diblokir di form registrasi
 *                 publik (UI merah + ditolak validasi server).
 *   masuk_kerja : Hari Kerja Khusus / Override Weekend — tanggal yang
 *                 biasanya libur (Sabtu/Minggu) DIJADIKAN hari kerja,
 *                 sehingga pengunjung BISA memilihnya.
 *
 * Aturan form registrasi publik:
 *   - Senin–Jumat + tipe libur       → DIBLOKIR.
 *   - Sabtu/Minggu tanpa baris       → DIBLOKIR (default hardcode).
 *   - Sabtu/Minggu + tipe masuk_kerja → DIIZINKAN (override).
 */
class HariLibur extends Model
{
    /** Tanggal Merah — blokir kunjungan (default). */
    public const TIPE_LIBUR = 'libur';

    /** Hari Kerja Khusus — override akhir pekan, kunjungan diizinkan. */
    public const TIPE_MASUK_KERJA = 'masuk_kerja';

    /** Semua nilai tipe yang sah (untuk validasi & dropdown admin). */
    public const TIPE_LIST = [
        self::TIPE_LIBUR,
        self::TIPE_MASUK_KERJA,
    ];

    protected $table = 'hari_liburs';

    protected $fillable = [
        'tanggal',
        'tipe',
        'keterangan',
    ];

    protected $attributes = [
        'tipe' => self::TIPE_LIBUR,
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tipe'    => 'string',
    ];

    public function isLibur(): bool
    {
        return $this->tipe === self::TIPE_LIBUR;
    }

    public function isMasukKerja(): bool
    {
        return $this->tipe === self::TIPE_MASUK_KERJA;
    }
}
