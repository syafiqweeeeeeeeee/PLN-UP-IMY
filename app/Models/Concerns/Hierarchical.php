<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Hierarki parent-child lewat self-FK `parent_id` — dipakai model
 * Master Bidang (bidangs) dan Master Jabatan (jabatans).
 *
 * Aturan yang dijaga method di trait ini:
 * - parent selalu berasal dari tabel yang sama (relasi sederhana ke
 *   static::class — memenuhi "parent_id hanya boleh mengarah ke
 *   tabelnya sendiri"; validasi input dilakukan di controller lewat
 *   Rule::exists pada tabel yang sesuai).
 * - Cegah pemilihan diri sendiri sebagai parent (createsCycle dengan
 *   $parentId === id sendiri).
 * - Cegah siklus hierarki multi-tingkat (keturunan tidak boleh jadi
 *   parent leluhurnya).
 */
trait Hierarchical
{
    /* =========================================================
       CACHE DAFTAR MASTER — bidang & jabatan jarang berubah
       ------------------------------------------------------------
       Dropdown/filter yang dipakai di banyak halaman (Data Karyawan,
       form Pengguna, form master, Tamu) tidak meng-query tabel master
       pada setiap render halaman. Cache TTL 10 menit dan DIBUANG
       otomatis setiap kali baris master dibuat/diubah/dihapus
       (bootHierarchical di bawah), sehingga data selalu segar.
       ========================================================= */

    /** Prefix key cache master untuk model ini. */
    protected static function masterCacheKey(string $suffix): string
    {
        return 'master.' . static::class . '.' . $suffix;
    }

    /** Daftar rata urut nama, hasil cache — dropdown pilihan. */
    public static function cachedList(): Collection
    {
        return Cache::remember(
            static::masterCacheKey('list'),
            now()->addMinutes(10),
            fn () => static::query()->orderBy('nama')->get()
        );
    }

    /** Daftar berjenjang (root → child), hasil cache — filter & form. */
    public static function cachedTreeOrdered(): Collection
    {
        return Cache::remember(
            static::masterCacheKey('tree'),
            now()->addMinutes(10),
            fn () => static::treeOrdered()
        );
    }

    /** Buang cache master model ini — dipanggil oleh event CRUD. */
    public static function flushMasterCache(): void
    {
        Cache::forget(static::masterCacheKey('tree'));
        Cache::forget(static::masterCacheKey('list'));
        // Key cache turunan yang bergantung daftar master ini.
        Cache::forget('master.user-form-bidangs');
    }

    /** Auto-flush cache master saat baris dibuat/diubah/dihapus. */
    public static function bootHierarchical(): void
    {
        static::saved(fn () => static::flushMasterCache());
        static::deleted(fn () => static::flushMasterCache());
    }

    /** Parent sesama tabel (NULL = tingkat teratas). */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    /** Child langsung sesama tabel. */
    public function children(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    /**
     * Semua id keturunan (child, grandchild, dst.) — dipakai untuk
     * mengecualikan opsi parent di form dan deteksi siklus.
     *
     * @return array<int, int>
     */
    public function descendantIds(): array
    {
        $ids = [];
        $stack = [$this->getKey()];

        while ($stack !== []) {
            $current = array_pop($stack);

            foreach (static::query()->where('parent_id', $current)->pluck('id') as $childId) {
                $childId = (int) $childId;

                if (! in_array($childId, $ids, true)) {
                    $ids[] = $childId;
                    $stack[] = $childId;
                }
            }
        }

        return $ids;
    }

    /**
     * Apakah menjadikan $parentId sebagai parent akan membentuk siklus?
     *
     * - NULL      → aman (tingkat teratas).
     * - id sendiri → SELALU ditolak (pemilihan data itu sendiri).
     * - id yang merupakan keturunan → siklus multi-tingkat
     *   (mis. A → B → C, lalu A dijadikan child C).
     */
    public function createsCycle(?int $parentId): bool
    {
        if ($parentId === null) {
            return false;
        }

        if ($parentId === (int) $this->getKey()) {
            return true;
        }

        return in_array($parentId, $this->descendantIds(), true);
    }

    /**
     * Daftar berjenjang untuk tampilan tabel: akar lebih dulu, lalu
     * anak-anaknya secara rekursif, tiap entri membawa tingkat (depth).
     *
     * Query boleh dikustom (mis. withCount('children') / with('bidang'))
     * lewat parameter $query — pengurutan nama per tingkat dilakukan di
     * sini agar urutan tampilan konsisten.
     *
     * @param  array<string, mixed>  $relations  Relasi eager-load.
     * @return Collection<int, array{node: static, depth: int}>
     */
    public static function treeOrdered(?Builder $query = null, array $relations = []): Collection
    {
        $query ??= static::query();
        $items = $query->with($relations)->orderBy('nama')->get()->keyBy('id');

        $childrenOf = $items
            ->groupBy(fn ($item) => (string) $item->parent_id)
            ->map(fn ($group) => $group->sortBy('nama')->values());

        $rows = collect();
        $visited = [];

        $walk = function ($parentId, int $depth) use (&$walk, $childrenOf, $rows, &$visited): void {
            foreach ($childrenOf->get((string) $parentId, collect()) as $item) {
                $visited[(int) $item->id] = true;
                $rows->push(['node' => $item, 'depth' => $depth]);
                $walk($item->id, $depth + 1);
            }
        };

        $walk(null, 0);

        // Pengaman integritas: entri yatim (parent-nya tak dikenal /
        // terhapus paksa) tetap tampil, jangan sampai hilang dari daftar.
        foreach ($items as $item) {
            if (! isset($visited[(int) $item->id])) {
                $rows->push(['node' => $item, 'depth' => 0]);
            }
        }

        return $rows->values();
    }
}
