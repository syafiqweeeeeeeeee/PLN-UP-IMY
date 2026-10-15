<?php

namespace App\Observers;

use App\Models\Page;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Menjaga kolom penanda nama (*_name) pada tabel pivot tetap sinkron
 * ketika nama di tabel sumber diubah (rename role/permission/user/page).
 *
 * Kolom penanda HANYA untuk keterbacaan; proses RBAC tetap memakai ID.
 * Insert pivot baru lewat attach/sync ditangani oleh
 * BelongsToManyNameMarkers; observer ini hanya menangani RENAME sumber.
 *
 * Pembaruan dibatasi baris pivot yang relevan (where foreign key = ID
 * sumber), bukan seluruh tabel.
 */
class NameMarkerObserver
{
    public function updated(Role|Permission|User|Page $model): void
    {
        // pages memakai kolom `title`; model lain memakai `name`.
        $nameColumn = $model instanceof Page ? 'title' : 'name';

        // Hanya bertindak bila atribut nama benar-benar berubah.
        if (! $model->wasChanged($nameColumn)) {
            return;
        }

        $value = $model->getAttribute($nameColumn);
        $id = $model->getKey();

        match (true) {
            // roles.name dipakai di tiga pivot sekaligus.
            $model instanceof Role => $this->updatePivots([
                ['role_permission', 'role_id', 'role_name'],
                ['role_user',       'role_id', 'role_name'],
                ['page_role',       'role_id', 'role_name'],
            ], $id, $value),

            $model instanceof Permission => $this->updatePivots([
                ['role_permission',     'permission_id', 'permission_name'],
                ['user_has_permissions', 'permission_id', 'permission_name'],
            ], $id, $value),

            $model instanceof User => $this->updatePivots([
                ['role_user',           'user_id', 'user_name'],
                ['user_has_permissions', 'user_id', 'user_name'],
            ], $id, $value),

            // pages.title → page_role.page_name
            $model instanceof Page => $this->updatePivots([
                ['page_role', 'page_id', 'page_name'],
            ], $id, $value),
        };
    }

    /**
     * @param  array<int, array{0: string, 1: string, 2: string}>  $targets  [tabel, FK, kolom penanda]
     */
    private function updatePivots(array $targets, int|string $id, ?string $value): void
    {
        foreach ($targets as [$table, $foreignKey, $marker]) {
            // Aman bila tabel/kolom belum ada (mis. DB lama belum migrate).
            if (! Schema::hasTable($table) || ! Schema::hasColumn($table, $marker)) {
                continue;
            }

            DB::table($table)->where($foreignKey, $id)->update([$marker => $value]);
        }
    }
}
