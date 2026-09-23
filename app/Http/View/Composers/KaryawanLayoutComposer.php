<?php

namespace App\Http\View\Composers;

use App\Models\User;
use Illuminate\View\View;

/**
 * Data header Portal Karyawan: nama karyawan yang login, jabatan/bidang
 * (Hirarki Organisasi), dan inisial avatar (maks 2 huruf) — pola sama
 * dengan TopbarComposer.
 *
 * Contoh tampilan jabatan: "Asisten Manager Prod A (Operasi)" —
 * kombinasi Sub-Bidang + Bidang Utama dari data form Pengguna.
 */
class KaryawanLayoutComposer
{
    public function compose(View $view): void
    {
        $user = auth()->user();

        $view->with('karyawanUser', [
            'name'     => $user?->name ?? 'Karyawan',
            'email'    => $user?->email ?? '',
            'role'     => $user?->role ?? 'Karyawan',
            'jabatan'  => self::jabatanLabel($user),
            'initials' => $this->initials($user?->name ?? '?'),
        ]);
    }

    /**
     * Label jabatan dinamis untuk header & profil:
     * - Sub-bidang terisi → "Asisten Manager Prod A (Operasi)".
     * - Hanya bidang      → "Manager Bidang (Operasi)".
     * - Senior Manager    → "Senior Manager" (akses global).
     * - Tanpa data        → fallback kolom role / "Karyawan".
     */
    public static function jabatanLabel(?User $user): string
    {
        if ($user === null) {
            return 'Karyawan';
        }

        $levelLabel = User::LEVEL_JABATAN[$user->level_jabatan] ?? null;
        $deptLabel  = User::DEPARTMENTS[$user->department] ?? null;
        $subLabel   = User::subDepartmentLabel($user->department, $user->sub_department);

        if ($subLabel !== null) {
            return $deptLabel !== null ? "{$subLabel} ({$deptLabel})" : $subLabel;
        }

        if ($levelLabel !== null) {
            return $deptLabel !== null ? "{$levelLabel} ({$deptLabel})" : $levelLabel;
        }

        return $user->role ?? 'Karyawan';
    }

    /**
     * Inisial nama untuk avatar (maks 2 huruf).
     */
    private function initials(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name)) ?: [];

        if ($parts === []) {
            return '?';
        }

        $initials = strtoupper(mb_substr($parts[0], 0, 1));

        if (count($parts) > 1) {
            $initials .= strtoupper(mb_substr(end($parts), 0, 1));
        }

        return $initials;
    }
}
