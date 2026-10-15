<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

/**
 * BelongsToMany yang menjaga kolom penanda nama (denormalisasi) pada
 * tabel pivot tetap terisi setiap kali baris pivot ditambahkan lewat
 * attach()/sync()/syncWithoutDetaching().
 *
 * Kolom penanda HANYA untuk keterbacaan di phpMyAdmin; mekanisme RBAC
 * tetap memakai ID. Konfigurasi per relasi diberikan lewat
 * withNameMarkers(), contoh:
 *
 *   $this->belongsToMany(Role::class, 'role_user')->withNameMarkers(
 *       parent: ['user_name' => 'name'],   // kolom pivot => kolom di model pemilik relasi
 *       related: ['role_name' => 'name'],  // kolom pivot => kolom di model terkait
 *   );
 *
 * Untuk kolom sumber yang berbeda dari atribut default (mis. page_role
 * memakai pages.title, bukan name), sebutkan kolomnya eksplisit.
 */
class BelongsToManyNameMarkers extends BelongsToMany
{
    /** @var array<string, string> nama kolom penanda => kolom sumber di model pemilik relasi */
    protected array $parentMarkers = [];

    /** @var array<string, string> nama kolom penanda => kolom sumber di model terkait */
    protected array $relatedMarkers = [];

    public function withNameMarkers(array $parent = [], ?array $related = null): static
    {
        $this->parentMarkers = $parent;
        $this->relatedMarkers = $related ?? [];

        return $this;
    }

    /**
     * @param  mixed  $id
     */
    public function attach($id, array $pivotAttributes = [], $touch = true)
    {
        $result = parent::attach($id, $pivotAttributes, $touch);

        $this->fillNameMarkers($this->parseIds($id));

        return $result;
    }

    public function sync($ids, $detaching = true)
    {
        $changes = parent::sync($ids, $detaching);

        // 'updated' disertakan agar baris lama ikut diperbarui nilainya;
        // 'detached' tidak perlu — barisnya sudah hilang dari tabel pivot.
        $this->fillNameMarkers(array_merge($changes['attached'] ?? [], $changes['updated'] ?? []));

        return $changes;
    }

    /**
     * Isi kolom penanda nama untuk baris pivot yang baru ditambahkan /
     * diperbarui. TIDAK mengubah ID apa pun — hanya kolom *_name.
     */
    protected function fillNameMarkers(array $relatedIds): void
    {
        if ($relatedIds === [] || ($this->parentMarkers === [] && $this->relatedMarkers === [])) {
            return;
        }

        $relatedIds = array_map('intval', array_unique($relatedIds));

        // Nilai dari sisi pemilik relasi (sama untuk semua baris).
        $parentValues = [];
        foreach ($this->parentMarkers as $marker => $column) {
            $value = $this->parent->getAttribute($column);
            if ($value !== null) {
                $parentValues[$marker] = $value;
            }
        }

        // Nilai dari sisi model terkait (berbeda per baris).
        $relatedRows = collect();
        if ($this->relatedMarkers !== []) {
            $columns = array_values(array_unique(array_merge([$this->relatedKey], array_values($this->relatedMarkers))));
            $relatedRows = $this->related->newQuery()
                ->whereIn($this->relatedKey, $relatedIds)
                ->get($columns)
                ->keyBy($this->relatedKey);
        }

        foreach ($relatedIds as $relatedId) {
            $values = $parentValues;

            foreach ($this->relatedMarkers as $marker => $column) {
                $value = $relatedRows->get($relatedId)?->{$column};
                if ($value !== null) {
                    $values[$marker] = $value;
                }
            }

            if ($values === []) {
                continue;
            }

            DB::table($this->table)
                ->where($this->foreignPivotKey, $this->parent->getKey())
                ->where($this->relatedPivotKey, $relatedId)
                ->update($values);
        }
    }
}
