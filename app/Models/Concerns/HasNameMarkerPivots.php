<?php

namespace App\Models\Concerns;

use App\Models\Relations\BelongsToManyNameMarkers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Mengganti kelas relasi belongsToMany() default dengan
 * BelongsToManyNameMarkers agar setiap attach()/sync() pivot otomatis
 * mengisi kolom penanda nama (*_name) untuk baris baru.
 *
 * Pakai trait ini di model yang relasinya menyentuh tabel pivot
 * role_permission, role_user, user_has_permissions, atau page_role.
 * Kolom penanda hanya untuk keterbacaan; RBAC tetap memakai ID.
 */
trait HasNameMarkerPivots
{
    protected function newBelongsToMany(
        Builder $query,
        Model $parent,
        $table,
        $foreignPivotKey,
        $relatedPivotKey,
        $parentKey,
        $relatedKey,
        $relationName = null,
    ): BelongsToMany {
        return new BelongsToManyNameMarkers(
            $query,
            $parent,
            $table,
            $foreignPivotKey,
            $relatedPivotKey,
            $parentKey,
            $relatedKey,
            $relationName,
        );
    }
}
