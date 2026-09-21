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

        ActivityLogger::log('login', $user, [
            'module'      => 'autentikasi',
            'description' => 'melakukan login ke panel admin',
            'subject'     => $user,
        ]);

        $request->session()->regenerate();

        $intended = $request->session()->pull('url.intended', route('admin.dashboard'));

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
