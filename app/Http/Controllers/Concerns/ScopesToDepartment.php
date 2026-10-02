<?php

namespace App\Http\Controllers\Concerns;

use App\Models\User;

/**
 * ScopesToDepartment — Dynamic Data Scoping untuk Admin Bidang.
 *
 * Super Admin (Sekretariat/Humas) melihat & mengelola SELURUH data.
 * Admin Bidang hanya melihat & mengelola data bidangnya sendiri;
 * akses tulis ke data bidang lain diblokir (guard URL/API direct access).
 */
trait ScopesToDepartment
{
    /**
     * Apakah user yang login adalah Super Admin (bebas scope)?
     */
    protected function scopingUserIsSuperAdmin(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    /**
     * Kode bidang tempat Admin Bidang terikat (null bila Super Admin /
     * tidak terikat).
     */
    protected function scopedDepartment(): ?string
    {
        $user = auth()->user();

        if ($user === null || $user->isSuperAdmin()) {
            return null;
        }

        return $user->boundDepartment();
    }

    /**
     * Terapkan filter bidang pada query list.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $column  Nama kolom kode bidang pada tabel (mis. 'department').
     */
    protected function applyDepartmentScope($query, string $column = 'department')
    {
        $department = $this->scopedDepartment();

        if ($department !== null) {
            $query->where($column, $department);
        }

        return $query;
    }

    /**
     * Guard akses tulis (edit/update/delete) milik bidang lain.
     * Model wajib punya attribute kolom kode bidang (default 'department').
     * Super Admin selalu lolos; Admin Bidang hanya lolos untuk data
     * bidangnya sendiri. Melanggar → 403.
     *
     * @param  mixed  $model
     */
    protected function authorizeDepartmentAccess($model, string $column = 'department'): void
    {
        $department = $this->scopedDepartment();

        if ($department === null) {
            return; // Super Admin / tanpa scope.
        }

        $owner = $model->{$column} ?? null;

        if ($owner !== $department) {
            abort(403, 'Data ini milik bidang lain — Anda hanya dapat mengelola konten Bidang '
                . (User::DEPARTMENTS[$department] ?? $department) . '.');
        }
    }

    /**
     * Guard akses tulis khusus Link Kerja (kategori umum/khusus).
     *
     * Aturan kelola Link Kerja untuk Admin Bidang:
     * - Kategori 'umum'  → BOLEH dikelola (semua Admin Bidang berhak
     *   memelihara link yang tampil untuk seluruh karyawan).
     * - Kategori 'khusus' → hanya milik bidangnya sendiri.
     *
     * Super Admin bebas penuh. Melanggar → 403 (dihandle UI sebagai
     * toast "Akses Dibatasi").
     *
     * @param  \App\Models\WorkLink  $link
     */
    protected function authorizeWorkLinkAccess($link): void
    {
        $department = $this->scopedDepartment();

        if ($department === null) {
            return; // Super Admin / tanpa scope.
        }

        if (($link->category ?? '') === \App\Models\WorkLink::CATEGORY_UMUM) {
            return; // Link umum boleh dikelola semua admin bidang.
        }

        $this->authorizeDepartmentAccess($link, 'department');
    }

    /**
     * Nilai department yang dipaksa pada create: Admin Bidang selalu
     * di-set ke bidangnya (input form diabaikan — anti manipulasi).
     */
    protected function forcedDepartmentForCreate(?string $requested = null): ?string
    {
        $department = $this->scopedDepartment();

        return $department ?? $requested;
    }
}
