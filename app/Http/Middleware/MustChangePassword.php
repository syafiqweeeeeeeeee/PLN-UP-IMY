<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * MustChangePassword — memaksa pengguna dengan penanda
 * must_change_password (hasil reset password oleh admin) untuk
 * mengganti password terlebih dahulu sebelum boleh mengakses
 * aplikasi.
 *
 * Halaman yang dikecualikan (whitelist):
 * - halaman pemberitahuan & form ganti password (account.password-*)
 * - logout (agar pengguna tetap bisa keluar)
 *
 * Request AJAX/JSON yang membuthkan ganti password dijawab 409
 * dengan URL tujuan agar fetch di sisi klien bisa mengarahkan.
 */
class MustChangePassword
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->must_change_password) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message'     => 'Password Anda harus diganti terlebih dahulu.',
                    'redirect_to' => route('account.password-notice'),
                ], 409);
            }

            // Jangan redirect berulang ke URL yang sama (loop guard).
            if (! $request->routeIs('account.password-*')) {
                return redirect()->route('account.password-notice');
            }
        }

        return $next($request);
    }
}
