<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Melindungi area /karyawan/* agar hanya diakses akun Karyawan murni.
 *
 * - Role Karyawan (murni)         → diteruskan.
 * - Role admin/pengelola lain     → 403 + redirect panel admin.
 * - Login tanpa role sama sekali  → 403 (tidak termasuk karyawan).
 *
 * Catatan: halaman profil sendiri di admin (admin.users.show) tetap
 * terbuka untuk semua — middleware ini hanya memagari prefix karyawan.
 */
class EnsureKaryawan
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! $user->isKaryawan()) {
            if ($request->expectsJson()) {
                abort(403, 'Halaman ini khusus akun Karyawan.');
            }

            // Belum login → biarkan auth yang mengarahkan ke login.
            if (! $user) {
                return redirect()->route('login');
            }

            return redirect()
                ->route('admin.dashboard')
                ->with('warning', 'Portal karyawan khusus untuk akun dengan role Karyawan.');
        }

        return $next($request);
    }
}
