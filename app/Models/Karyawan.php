<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * DATA KARYAWAN — master data ±300 karyawan UP Indramayu.
 *
 * Sengaja TIDAK berelasi dengan `users` (akun login): tabel ini adalah
 * data profil karyawan (HR), bukan akun autentikasi. Kolom mengikuti 24
 * kolom spesifikasi; label dipertahankan lewat COLUMNS_LABELS.
 *
 * Kolom yang wajib diisi hanya `nid` (unik) dan `nama` — sisanya
 * nullable agar impor data historis yang lengkap sebagian tidak gagal.
 */
class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawans';

    protected $fillable = [
        'nid', 'nama', 'bidang', 'jabatan', 'jenjang_jabatan', 'grade',
        'institusi', 'organik', 'tanggal_lahir', 'service_date', 'hire_date',
        'retire_date', 'grade_date', 'tgl_jab', 'telp', 'hp', 'email',
        'fte', 'mims', 'tempat_lahir', 'agama', 'gender', 'status_kawin',
        'unit',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'service_date' => 'date',
        'hire_date' => 'date',
        'retire_date' => 'date',
        'grade_date' => 'date',
        'tgl_jab' => 'date',
        'fte' => 'float',
    ];

    /**
     * 24 kolom spesifikasi — urutan tampilan tabel & header template
     * impor/ekspor. Nilai = nama kolom database; kunci = label tampilan
     * yang dipertahankan persis seperti permintaan.
     */
    public const COLUMNS_LABELS = [
        'nid' => 'NID',
        'nama' => 'NAMA',
        'bidang' => 'BIDANG',
        'jabatan' => 'JABATAN',
        'jenjang_jabatan' => 'JENJAB',
        'grade' => 'GRADE',
        'institusi' => 'INSTITUSI',
        'organik' => 'ORGANIK',
        'tanggal_lahir' => 'TGL LAHIR',
        'service_date' => 'SERVICE DATE',
        'hire_date' => 'HIRE DATE',
        'retire_date' => 'RETIRE DATE',
        'grade_date' => 'GRADE DATE',
        'tgl_jab' => 'TGL JAB',
        'telp' => 'TELP',
        'hp' => 'HP',
        'email' => 'EMAIL',
        'fte' => 'FTE',
        'mims' => 'MIMS',
        'tempat_lahir' => 'TEMPAT LAHIR',
        'agama' => 'AGAMA',
        'gender' => 'GENDER',
        'status_kawin' => 'STATUS KAWIN',
        'unit' => 'UNIT',
    ];

    /** Kolom bertipe tanggal (cast date + validasi form/impor). */
    public const DATE_COLUMNS = [
        'tanggal_lahir', 'service_date', 'hire_date', 'retire_date',
        'grade_date', 'tgl_jab',
    ];

    /** Filter dropdown halaman daftar (kolom => label). */
    public const FILTERS = [
        'bidang' => 'BIDANG',
        'jabatan' => 'JABATAN',
        'grade' => 'GRADE',
        'gender' => 'GENDER',
        'status_kawin' => 'STATUS KAWIN',
        'unit' => 'UNIT',
    ];

    /** Nilai Gender yang didukung (label => nilai DB). */
    public const GENDERS = [
        'L' => 'Laki-laki',
        'P' => 'Perempuan',
    ];

    /** Nilai Status Kawin yang didukung (nilai DB => label). */
    public const STATUSES_KAWIN = [
        'TK' => 'Tidak Kawin',
        'K' => 'Kawin',
    ];

    /* =========================================================
       SCOPE — pencarian & filter dipakai halaman daftar & ekspor
       ========================================================= */

    /** Pencarian teks bebas pada NID dan NAMA. */
    public function scopeSearch(Builder $query, ?string $keyword): Builder
    {
        $keyword = trim((string) $keyword);

        if ($keyword === '') {
            return $query;
        }

        return $query->where(function (Builder $q) use ($keyword) {
            $q->where('nid', 'like', "%{$keyword}%")
                ->orWhere('nama', 'like', "%{$keyword}%");
        });
    }

    /** Terapkan filter dropdown (BIDANG, JABATAN, GRADE, dst.). */
    public function scopeFiltered(Builder $query, array $filters): Builder
    {
        foreach (self::FILTERS as $column => $label) {
            $value = trim((string) ($filters[$column] ?? ''));

            if ($value !== '') {
                $query->where($column, $value);
            }
        }

        return $query;
    }

    /** Daftar nilai unik per kolom filter (untuk mengisi dropdown). */
    public static function filterOptions(): array
    {
        $options = [];

        foreach (self::FILTERS as $column => $label) {
            $options[$column] = static::query()
                ->whereNotNull($column)
                ->where($column, '!=', '')
                ->orderBy($column)
                ->distinct()
                ->pluck($column)
                ->all();
        }

        return $options;
    }

    /* =========================================================
       HELPER TAMPILAN
       ========================================================= */

    public function genderLabel(): ?string
    {
        return self::GENDERS[$this->gender] ?? $this->gender;
    }

    public function statusKawinLabel(): ?string
    {
        return self::STATUSES_KAWIN[$this->status_kawin] ?? $this->status_kawin;
    }

    /** Format tanggal yang mudah dibaca (14 Mar 1985); null-safe. */
    public function formatTanggal(?string $column): ?string
    {
        return $this->getAttribute($column)?->translatedFormat('d M Y');
    }
}
