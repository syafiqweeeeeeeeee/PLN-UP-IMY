<?php

namespace App\Models\Scopes;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * ScopedToUserDepartment — GLOBAL SCOPE filter data per bidang.
 *
 * REVISI ARSITEKTUR RBAC: isolasi data bidang diikat pada atribut
 * users.bidang_id / users.sub_bidang_id (kolom fisik department_id &
 * sub_department) — BUKAN lewat banyak role terpisah. Scope ini
 * otomatis menyaring SEMUA query model yang memakainya:
 *
 *   WHERE bidang = auth()->user()->bidang_id   (dan sub-bidang bila terkunci)
 *
 * Aturan bypass (melihat SELURUH data semua bidang):
 * - Super Admin (role/pivot), dan
 * - Level Jabatan "Senior Manager" (akses global view-only), serta
 * - akun TANPA pengikatan bidang (data legacy — perilaku lama dipertahankan),
 * - tamu/publik (belum login).
 *
 * Kontrak per-model: model pemakai scope wajib mendefinisikan
 * applyDataScoping(Builder $query, User $user) yang menerjemahkan
 * tingkat akses (User::dataScopingLevel()) menjadi kondisi WHERE
 * sesuai skema tabelnya.
 *
 * PENTING: scope ini menyaring DAFTAR/INDEX. Akses langsung via URL
 * ID tetap harus ditolak 403 oleh guard controller — model yang
 * memakai scope ini meng-override resolveRouteBinding() agar binding
 * route menemukan baris lintas-bidang dan guard bisa memutus 403
 * (bukan 404).
 */
class ScopedToUserDepartment implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $user = auth()->user();

        if (! $user instanceof User) {
            return; // Tamu/publik — tidak difilter (konten publik dikurasi target_publication).
        }

        if ($user->bypassesDataScoping()) {
            return; // Super Admin & Senior Manager: seluruh data semua bidang.
        }

        if ($user->bidangCode() === null) {
            return; // Tanpa pengikatan bidang (akun legacy) — perilaku lama.
        }

        if (! method_exists($model, 'applyDataScoping')) {
            return;
        }

        $model->applyDataScoping($builder, $user);
    }
}
