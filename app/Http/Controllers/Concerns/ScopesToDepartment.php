<?php

namespace App\Http\Controllers\Concerns;

use App\Models\User;

/**
 * ScopesToDepartment — Dynamic Data Scoping untuk Admin Bidang.
 *
 * Super Admin (Sekretariat/Humas) melihat & mengelola SELURUH data.
 * Admin Bidang hanya melihat & mengelola data bidangnya sendiri;
 * akses tulis ke data bidang lain diblokir (guard URL/API direct access
 * → 403 Forbidden).
 *
 * REVISI ARSITEKTUR: pengikatan data memakai atribut users bidang_id /
 * sub_bidang_id (User::bidangId()/subBidangId()) — BUKAN banyak role
 * terpisah. Selain itu, model WorkLink & Announcement kini memakai
 * GLOBAL SCOPE ScopedToUserDepartment sehingga query list terfilter
 * otomatis; trait ini tetap menjadi lapisan guard tulis (403) dan
 * pemaksaan bidang pada create.
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
     * Kode bidang tempat Admin Bidang terikat (null bila bypass —
     * Super Admin maupun Senior Manager — atau tidak terikat).
     */
    protected function scopedDepartment(): ?string
    {
        $user = auth()->user();

        // REVISI — bypass eksplisit sesuai spec: Super Admin DAN Level
        // Jabatan "Senior Manager" melihat seluruh data semua bidang.
        if ($user === null || $user->bypassesDataScoping()) {
            return null;
        }

        return $user->bidangCode();
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
     * Aturan kelola Link Kerja (unit kerja = bidang + sub-bidang):
     * - Kategori 'umum'  → BOLEH dikelola (semua Admin Bidang berhak
     *   memelihara link yang tampil untuk seluruh karyawan).
     * - Kategori 'khusus' → hanya milik unit kerjanya: bidang harus
     *   cocok, DAN bila akun terikat sub-bidang (Admin Bidang baru &
     *   Karyawan Asmen/Staff) sub-bidang data harus sama — data level
     *   bidang / sub lain hanya dikelola Super Admin.
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

        $user = auth()->user();

        // Terkunci sub-bidang → wajib cocok bidang + sub-bidang.
        if ($user !== null && $user->dataScopingLevel() === 'bidang_sub') {
            if (($link->department ?? null) === $department
                && ($link->sub_department ?? null) === $user->subBidangId()) {
                return;
            }

            abort(403, 'Data ini di luar unit kerja Anda ('
                . (User::DEPARTMENTS[$department] ?? $department) . ' — '
                . (User::subDepartmentLabel($department, $user->subBidangId()) ?? $user->subBidangId())
                . '): hanya Super Admin yang dapat mengelolanya.');
        }

        $this->authorizeDepartmentAccess($link, 'department');
    }

    /**
     * Nilai department yang dipaksa pada create: Admin Bidang selalu
     * di-set ke bidangnya (input form diabaikan — anti manipulasi).
     * Bila akun terikat sub-bidang, sub-bidang juga dipaksa ke
     * unit kerjanya.
     */
    protected function forcedDepartmentForCreate(?string $requested = null): ?string
    {
        $department = $this->scopedDepartment();

        return $department ?? $requested;
    }

    /**
     * Nilai sub-bidang yang dipaksa pada create Link Kerja untuk akun
     * terkunci sub-bidang (anti manipulasi — input form diabaikan).
     */
    protected function forcedSubDepartmentForCreate(?string $requested = null): ?string
    {
        $user = auth()->user();

        if ($user !== null && $user->dataScopingLevel() === 'bidang_sub') {
            return $user->subBidangId();
        }

        return $requested;
    }
}
