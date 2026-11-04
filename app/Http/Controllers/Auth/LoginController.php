<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    /** Maksimal percobaan login per email+IP sebelum dijeda. */
    private const MAX_ATTEMPTS = 5;

    /** Jeda (detik) setelah batas percobaan terlampaui. */
    private const DECAY_SECONDS = 60;

    public function showLoginForm(): View
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        // Brute-force guard: batasi percobaan per pasangan email + IP agar
        // password tidak bisa ditebak terus-menerus dari satu sumber.
        $throttleKey = Str::lower((string) $credentials['email']) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, self::MAX_ATTEMPTS)) {
            $seconds = max((int) RateLimiter::availableIn($throttleKey), 1);

            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan masuk. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if (! $user || ! \Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            RateLimiter::hit($throttleKey, self::DECAY_SECONDS);

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans('auth.failed')]);
        }

        // Login berhasil → hitungan percobaan gagal direset.
        RateLimiter::clear($throttleKey);

        Auth::login($user, $request->boolean('remember'));

        // Password sementara (reset oleh admin) → wajib ganti password
        // dulu: alihkan ke halaman pemberitahuan, abaikan URL intended.
        if ($user->must_change_password) {
            $request->session()->regenerate();

            ActivityLogger::log('login', $user, [
                'module'      => 'autentikasi',
                'description' => 'login dengan password sementara — diarahkan untuk mengganti password',
                'subject'     => $user,
            ]);

            return redirect()->route('account.password-notice');
        }

        ActivityLogger::log('login', $user, [
            'module'      => 'autentikasi',
            'description' => $user->isKaryawan()
                ? 'melakukan login ke portal karyawan'
                : 'melakukan login ke panel admin',
        ]);

        $request->session()->regenerate();

        // Karyawan → portal karyawan; role lain → panel admin.
        $fallback = $user->isKaryawan() ? route('karyawan.dashboard') : route('admin.dashboard');

        $intended = $request->session()->pull('url.intended', $fallback);

        return redirect()->to($intended);
    }

    public function logout(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user) {
            ActivityLogger::log('logout', $user, [
                'module'      => 'autentikasi',
                'description' => 'melakukan logout dari panel admin',
                'subject'     => $user,
            ]);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
