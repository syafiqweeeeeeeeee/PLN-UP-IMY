<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * DATA KARYAWAN — master data ±300 karyawan UP Indramayu.
 *
 * Sengaja TIDAK berelasi dengan `users` (akun login): tabel ini adalah
 * data profil karyawan (HR), bukan akun autentikasi. Kolom mengikuti 24
 * kolom spesifikasi; label dipertahankan lewat COLUMNS_LABELS.
 *
 * Kolom yang wajib diisi hanya `nid` (unik) dan `nama` — sisanya
 * nullable agar impor data historis yang lengkap sebagian tidak gagal.
 *
 * Kolom teks `bidang`/`jabatan` tetap menjadi sumber tampilan & ekspor
 * (kompatibel dengan data lama). Kolom `bidang_id`/`jabatan_id` adalah
 * referensi opsional ke master Bidang/Jabatan — boleh NULL bila nama
 * lama belum dapat dipetakan dengan aman.
 */
class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawans';

    protected $fillable = [
        'nid', 'nama', 'bidang_id', 'jabatan_id',
        'bidang', 'jabatan', 'jenjang_jabatan', 'grade',
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

    /**
     * Filter dropdown yang nilainya boleh berasal dari master memakai
     * prefiks `#` + id (mis. `#12`), sedangkan nilai tanpa prefiks tetap
     * diartikan sebagai teks lama — sehingga data yang belum terpetakan
     * masih bisa difilter dan diekspor.
     */
    public const FILTER_ID_PREFIX = '#';

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

    /**
     * Terapkan filter dropdown (BIDANG, JABATAN, GRADE, dst.).
     *
     * BIDANG & JABATAN menerima dua bentuk nilai:
     * - `#<id>`  → filter lewat relasi master (khusus data yang sudah
     *   terpetakan; nama jabatan bisa sama di beberapa bidang).
     * - teks     → filter lewat kolom teks lama (data yang belum
     *   terpetakan tetap bisa dicari).
     */
    public function scopeFiltered(Builder $query, array $filters): Builder
    {
        foreach (self::FILTERS as $column => $label) {
            $value = trim((string) ($filters[$column] ?? ''));

            if ($value === '') {
                continue;
            }

            $idColumn = $this->masterIdColumn($column);

            if ($idColumn !== null && str_starts_with($value, self::FILTER_ID_PREFIX)) {
                $query->where($idColumn, (int) substr($value, strlen(self::FILTER_ID_PREFIX)));

                continue;
            }

            $query->where($column, $value);
        }

        return $query;
    }

    /** Kolom FK master untuk filter teks (`bidang` → `bidang_id`). */
    private function masterIdColumn(string $column): ?string
    {
        return match ($column) {
            'bidang' => 'bidang_id',
            'jabatan' => 'jabatan_id',
            default => null,
        };
    }

    /* =========================================================
       RELASI MASTER (opsional — boleh NULL untuk data lama)
       ========================================================= */

    /**
     * Bidang master. Sengaja TIDAK dinamai `bidang` karena atribut teks
     * `bidang` sudah ada dan akan menutupi relasi saat diakses.
     */
    public function bidangMaster(): BelongsTo
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    /** Jabatan master (bidang induknya bisa diambil lewat `jabatanMaster->bidang`). */
    public function jabatanMaster(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
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

    /**
     * Nama bidang untuk tampilan: kolom teks lama diutamakan (sumber
     * kebenaran data HR); relasi master dipakai sebagai cadangan bila
     * kolom teks kosong. Null bila keduanya kosong.
     */
    public function bidangLabel(): ?string
    {
        $teks = trim((string) $this->bidang);

        return $teks !== '' ? $this->bidang : ($this->bidangMaster?->nama);
    }

    /** Nama jabatan untuk tampilan (aturan sama dengan bidangLabel()). */
    public function jabatanLabel(): ?string
    {
        $teks = trim((string) $this->jabatan);

        return $teks !== '' ? $this->jabatan : ($this->jabatanMaster?->nama);
    }

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
