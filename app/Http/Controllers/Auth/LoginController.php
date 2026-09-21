<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if (! $user || ! \Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans('auth.failed')]);
        }

        Auth::login($user, $request->boolean('remember'));

        ActivityLog::record('autentikasi', 'login', "melakukan login ke panel admin", $user);

        $request->session()->regenerate();

        // Karyawan → portal karyawan; role lain → panel admin.
        $fallback = $menujuPortal ? route('karyawan.dashboard') : route('admin.dashboard');

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
