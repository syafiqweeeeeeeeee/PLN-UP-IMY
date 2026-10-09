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
 * - Karyawan murni TANPA permission ekstra → 403 + redirect ke portal
 *   karyawan (browser follow redirect → halaman portal).
 * - Karyawan murni DENGAN permission ekstra (di luar baseline karyawan,
 *   mis. users.view yang diberikan lewat Edit Role) → DIZINKAN masuk
 *   /admin. Route tetap dijaga `permission:` masing-masing dan sidebar
 *   hanya menampilkan menu yang lolos @can — lihat User::hasExtraKaryawanPermission().
 * - Role lain / tanpa role → diteruskan (kompatibel dengan akun lama &
 *   test RBAC yang memakai user tanpa role).
 */
class EnsureNotKaryawan
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->isKaryawan() && ! $user->hasExtraKaryawanPermission()) {
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
