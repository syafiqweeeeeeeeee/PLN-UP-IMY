<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * DATA KARYAWAN — master data ±300 karyawan UP Indramayu.
 *
 * BUKAN tabel akun autentikasi: akun login tetap di `users`. Tautan ke
 * akun pengguna memakai tabel yang sudah ada (`employee_profiles`,
 * relasi `employeeProfile()`), sehingga tidak ada kolom/relasi baru di
 * `users`. Kolom mengikuti 24 kolom spesifikasi; label dipertahankan
 * lewat COLUMNS_LABELS.
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
     * Terapkan filter dropdown — saat ini hanya BIDANG (lihat
     * DataKaryawanController::INDEX_FILTERS). Dua bentuk nilai:
     *
     * - `#<id>`  → filter lewat relasi master: baris yang sudah
     *   terhubung ke id TERSEBUT ATAU baris teks lama yang namanya
     *   sama dengan node master (termasuk seluruh anak/cucunya).
     *   Sebelumnya hanya `bidang_id = id` — padahal hampir semua
     *   data lama kolom id-nya NULL sehingga filter selalu kosong.
     * - teks     → filter persis lewat kolom teks lama (data yang
     *   belum terpetakan tetap bisa dicari).
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
                $this->applyMasterFilter(
                    $query,
                    $column,
                    $idColumn,
                    (int) substr($value, strlen(self::FILTER_ID_PREFIX)),
                );

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

    /**
     * Filter satu node master beserta seluruh keturunannya.
     *
     * Baris cocok bila salah satu dari keduanya terpenuhi:
     * 1. Kolom FK (`bidang_id`/`jabatan_id`) menunjuk salah satu id
     *    di dalam sub-pohon (data yang sudah terpetakan).
     * 2. Kolom teks lama (`bidang`/`jabatan`) sama persis dengan nama
     *    node di sub-pohon (data yang belum dipetakan — kolom id NULL,
     *    isi tabel karyawans saat ini didominasi kondisi ini).
     *
     * Sub-pohon dihitung lewat `parent_id` (bidangs & jabatans sama),
     * di-cache per-request agar tidak query berulang.
     */
    private function applyMasterFilter(
        Builder $query,
        string $column,
        string $idColumn,
        int $id,
    ): Builder {
        [$ids, $names] = static::masterSubtree($column, $id);

        return $query->where(function (Builder $q) use ($column, $idColumn, $ids, $names): void {
            $q->whereIn($idColumn, $ids);

            if ($names !== []) {
                $q->orWhereIn($column, $names);
            }
        });
    }

    /**
     * [ids, nama] sub-pohon master: node $id + seluruh keturunannya.
     * Id tidak dikenal → tetap dipakai (tanpa nama) supaya filter tetap
     * berperilaku seperti `whereIn($idColumn, [$id])`.
     *
     * @return array{0: array<int, int>, 1: array<int, string>}
     */
    private static function masterSubtree(string $column, int $id): array
    {
        /** @var array<string, array{0: array<int, int>, 1: array<int, string>}> */
        static $cache = [];

        if (isset($cache[$column][$id])) {
            return $cache[$column][$id];
        }

        /** @var class-string<Bidang|Jabatan> $modelClass */
        $modelClass = $column === 'bidang' ? Bidang::class : Jabatan::class;

        $rows = $modelClass::query()->get(['id', 'nama', 'parent_id']);
        $root = $rows->firstWhere('id', $id);

        if ($root === null) {
            return $cache[$column][$id] = [[$id], []];
        }

        $children = $rows->groupBy(fn ($row): string => (string) $row->parent_id);

        $ids = [];
        $names = [];
        $queue = [$id];
        $seen = [];

        while ($queue !== []) {
            $current = (int) array_shift($queue);

            if (isset($seen[$current])) {
                continue;
            }
            $seen[$current] = true;

            $node = $rows->firstWhere('id', $current);

            if ($node === null) {
                continue;
            }

            $ids[] = (int) $node->id;

            $name = trim((string) $node->nama);

            if ($name !== '') {
                $names[$name] = $name;
            }

            foreach ($children->get((string) $current, collect()) as $child) {
                $queue[] = (int) $child->id;
            }
        }

        return $cache[$column][$id] = [$ids, array_values($names)];
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

    /* =========================================================
       AKUN PENGGUNA (relasi yang sudah ada: employee_profiles)
       ------------------------------------------------------------
       Satu data karyawan paling banyak terhubung ke satu akun
       pengguna. Penghubungnya adalah tabel `employee_profiles`
       (karyawan_id = soft-link ke master HR, user_id = akun login),
       bukan relasi baru di tabel `users` — struktur lama tidak
       diubah.
       ========================================================= */

    /** Profil kepegawaian yang menautkan data ini ke akun pengguna. */
    public function employeeProfile(): HasOne
    {
        return $this->hasOne(EmployeeProfile::class, 'karyawan_id');
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
