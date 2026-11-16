<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * EnsureAccountActive — akun yang dinonaktifkan langsung kehilangan akses.
 *
 * Login baru sudah ditolak LoginController, tetapi sesi yang dibuat
 * SEBELUM akun dinonaktifkan tetap hidup sampai logout/expired. Middleware
 * ini memutus sesi tersebut pada request berikutnya.
 */
class EnsureAccountActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && ! $user->isActive()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Akun Anda telah dinonaktifkan.',
                ], 401);
            }

            return redirect()
                ->route('login')
                ->withErrors(['email' => 'Akun Anda telah dinonaktifkan. Hubungi administrator.']);
        }

        return $next($request);
    }
}
