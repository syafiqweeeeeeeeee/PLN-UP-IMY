<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Melindungi area /admin/* dari akun Karyawan.
 *
 * Aturan akses:
 * - Belum login        → ditangani middleware `auth` (redirect ke login).
 * - Role Karyawan murni → 403 + redirect ke portal karyawan
 *                        (browser follow redirect → halaman portal).
 * - Role lain / tanpa role → diteruskan (kompatibel dengan akun lama &
 *   test RBAC yang memakai user tanpa role).
 */
class EnsureNotKaryawan
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->isKaryawan()) {
            // AJAX/JSON: tolak langsung tanpa redirect agar fetch tidak
            // diam-diam menerima HTML halaman portal.
            if ($request->expectsJson()) {
                abort(403, 'Akun Karyawan tidak memiliki akses ke area admin.');
            }

            return redirect()
                ->route('karyawan.dashboard')
                ->with('warning', 'Anda tidak memiliki akses ke halaman admin.');
        }

        return $next($request);
    }
}
