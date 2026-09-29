<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * RoleMiddleware — RBAC Admin Delegasi per Bidang.
 *
 * Pemakaian di route:
 *   ->middleware('role.scope:super_admin')        // menu sensitif — semua
 *                                                 // admin KECUALI Admin Bidang
 *   ->middleware('role.scope:department_admin')   // hanya Admin Bidang
 *   ->middleware('role.scope:admin')              // admin apa pun (Super,
 *                                                 // Bidang, maupun legacy)
 *
 * Aturan menu sensitif (Manajemen User & Role, Data Tamu, Halaman/Menu
 * landing page): role 'Admin Bidang' SELALU ditolak — sesuai spesifikasi
 * delegasi per bidang. Role admin lain (Super Admin, Administrator,
 * role kustom bawaan panel) tetap diizinkan selama punya permission.
 *
 * Untuk modul milik bidang (work-links, announcements), middleware ini
 * BLOKIR akses Admin Bidang tanpa pengikatan department (department_id
 * maupun kolom legacy department kosong) — tidak boleh mengelola konten
 * tanpa terikat bidang.
 */
class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $scope = 'admin'): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(401, 'Belum terautentikasi.');
        }

        $isDepartmentAdmin = $user->isDepartmentAdmin();

        $allowed = match ($scope) {
            'super_admin'      => ! $isDepartmentAdmin,
            'department_admin' => $isDepartmentAdmin,
            'admin', 'any'     => ! $user->isKaryawan(),
            default            => false,
        };

        if (! $allowed) {
            abort(403, 'Anda tidak memiliki peran yang sesuai untuk mengakses halaman ini.');
        }

        // Admin Bidang wajib terikat satu bidang sebelum boleh mengelola
        // konten modul bidang (Link Kerja / Pengumuman Internal).
        if ($isDepartmentAdmin && $user->boundDepartment() === null) {
            abort(403, 'Akun Admin Bidang belum terikat pada Bidang Utama. Hubungi Super Admin untuk mengatur bidang Anda.');
        }

        return $next($request);
    }
}
