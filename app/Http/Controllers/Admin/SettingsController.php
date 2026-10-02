<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

/**
 * Pengaturan Panel Admin — profil akun, preferensi notifikasi,
 * dan ubah kata sandi (akun yang sedang login).
 *
 * Semua aksi tulis menerima fetch AJAX (JSON) maupun submit form
 * biasa (redirect back) — pola yang sama dengan WorkLinkController.
 */
class SettingsController extends Controller
{
    /**
     * Halaman Pengaturan (tema, notifikasi, akun).
     */
    public function index(Request $request)
    {
        return view('admin.settings', [
            'user'       => $request->user(),
            'notifSettings' => $request->user()->notificationSettings(),
        ]);
    }

    /**
     * Simpan Nama Tampilan (kartu Akun).
     */
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Nama Tampilan wajib diisi.',
            'name.max'      => 'Nama Tampilan maksimal 255 karakter.',
        ]);

        $user = $request->user();
        $user->update(['name' => trim($validated['name'])]);

        ActivityLogger::log('update', null, [
            'module'      => 'pengaturan',
            'description' => "memperbarui profil akun (nama tampilan: \"{$user->name}\")",
            'subject'     => $user,
        ]);

        return $this->jsonOrBack($request, 'Profil berhasil diperbarui.', [
            'name' => $user->name,
        ]);
    }

    /**
     * Simpan preferensi notifikasi (kartu Notifikasi).
     */
    public function updateNotifications(Request $request)
    {
        $validated = $request->validate([
            'desktop' => ['required', 'boolean'],
            'weekly'  => ['required', 'boolean'],
            'pending' => ['required', 'boolean'],
        ]);

        $request->user()->updateNotificationSettings($validated);

        ActivityLogger::log('update', null, [
            'module'      => 'pengaturan',
            'description' => 'memperbarui preferensi notifikasi panel',
            'subject'     => $request->user(),
        ]);

        return $this->jsonOrBack($request, 'Pengaturan berhasil diperbarui.');
    }

    /**
     * Ubah kata sandi akun sendiri (validasi sandi lama wajib).
     */
    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.required'  => 'Kata sandi saat ini wajib diisi.',
            'current_password.current_password' => 'Kata sandi saat ini tidak sesuai.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min'      => 'Kata sandi baru minimal 8 karakter.',
        ]);

        $user->update(['password' => Hash::make($validated['password'])]);

        ActivityLogger::log('update', null, [
            'module'      => 'pengaturan',
            'description' => "mengubah kata sandi akun ({$user->email})",
            'subject'     => $user,
        ]);

        return $this->jsonOrBack($request, 'Kata sandi berhasil diubah.');
    }

    /**
     * Balasan seragam: fetch AJAX → JSON; submit form → redirect back
     * dengan flash success (toast tampil setelah reload).
     */
    private function jsonOrBack(Request $request, string $message, array $extra = [])
    {
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => $message] + $extra);
        }

        return redirect()->route('admin.settings')->with('success', $message);
    }
}
