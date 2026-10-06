<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Ganti Password Wajib — aluran bagi akun yang password-nya direset
 * admin menjadi password sementara sekali pakai.
 *
 * Alur:
 * 1. notice() — halaman penjelasan "password Anda direset admin".
 * 2. form()   — form ganti password (wajib isi password sementara).
 * 3. update() — validasi password sementara, simpan password baru,
 *    hapus penanda must_change_password, catat log aktivitas.
 */
class ChangePasswordController extends Controller
{
    // Middleware (auth + must.password) didefinisikan pada route group
    // di routes/web.php — Laravel 12 controller dasar tidak memakai
    // $this->middleware() di controller.

    /** Halaman pemberitahuan: password direset oleh admin. */
    public function notice(): View
    {
        return view('auth.password-notice');
    }

    /** Form ganti password wajib. */
    public function form(): View
    {
        return view('auth.password-change');
    }

    /** Proses ganti password: verifikasi password sementara → simpan yang baru. */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password:web'],
            'password'         => ['required', 'string', 'min:8', 'confirmed', 'different:current_password'],
        ], [
            'current_password.required'  => 'Password sementara wajib diisi.',
            'current_password.current_password' => 'Password sementara tidak sesuai.',
            'password.required'          => 'Password baru wajib diisi.',
            'password.min'               => 'Password baru minimal 8 karakter.',
            'password.confirmed'         => 'Konfirmasi password baru tidak cocok.',
            'password.different'         => 'Password baru harus berbeda dari password sementara.',
        ]);

        // Cast 'hashed' pada model User otomatis meng-hash nilai ini.
        $user->forceFill([
            'password'             => $validated['password'],
            'must_change_password' => false,
        ])->save();

        ActivityLogger::log('password_reset', $user, [
            'module'      => 'autentikasi',
            'description' => 'mengganti password sementara setelah reset oleh admin',
            'subject'     => $user,
        ]);

        return redirect()
            ->route($user->isKaryawan() ? 'karyawan.dashboard' : 'admin.dashboard')
            ->with('success', 'Password berhasil diganti. Selamat datang!');
    }
}
