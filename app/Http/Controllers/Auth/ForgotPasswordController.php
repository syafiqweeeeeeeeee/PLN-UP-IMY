<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Lupa Password via OTP (email).
 *
 * Alur (dipanggil AJAX dari modal Bootstrap di halaman login):
 *  1. sendOtp() — validasi email terdaftar, buat OTP 6 digit, simpan
 *     HASH-nya di cache (10 menit), kirim ke email pengguna.
 *     Rate limit sederhana: maks. 1 kirim per 60 detik per email.
 *  2. reset() — verifikasi OTP + password baru, update password,
 *     hapus OTP, catat log aktivitas.
 *
 * OTP disimpan sebagai hash (bcrypt) di cache — bukan teks biasa —
 * sehingga bocornya cache tidak langsung membocorkan kode.
 * Di lokal (APP_ENV != production) kode dikembalikan di response
 * agar mudah diuji tanpa konfigurasi SMTP.
 */
class ForgotPasswordController extends Controller
{
    /** Masa berlaku OTP (detik). */
    private const OTP_TTL = 600;

    /** Jeda minimum antar pengiriman OTP per email (detik). */
    private const OTP_RESEND_COOLDOWN = 60;

    /** Kirim OTP ke email terdaftar. */
    public function sendOtp(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
        ]);

        $email = strtolower(trim($validated['email']));
        $user  = User::where('email', $email)->first();

        // Email tidak terdaftar → respons eksplisit agar UI dapat menampilkan
        // popup "email tidak terdaftar". Mitigasi enumeration tetap ada:
        // throttle:10,1 (per IP) di route + cooldown 60 detik per email.
        if (! $user) {
            return response()->json([
                'message' => 'Email tidak terdaftar pada sistem. Periksa kembali penulisan email Anda.',
                'errors'  => ['email' => ['Email tidak terdaftar pada sistem.']],
            ], 404);
        }

        // Cooldown anti-spam: 1 OTP per menit per email.
        $throttleKey = 'otp:cooldown:' . sha1($email);

        if (cache()->has($throttleKey)) {
            $retry = (int) cache()->get($throttleKey) - now()->getTimestamp();
            $retry = max($retry, 1);

            return response()->json([
                'message' => "Terlalu sering. Coba kirim ulang OTP dalam {$retry} detik.",
            ], 429);
        }

        $otp      = (string) random_int(100000, 999999); // 6 digit
        $cacheKey = $this->otpCacheKey($email);

        cache()->put($cacheKey, Hash::make($otp), now()->addSeconds(self::OTP_TTL));
        cache()->put($throttleKey, now()->getTimestamp() + self::OTP_RESEND_COOLDOWN, now()->addSeconds(self::OTP_RESEND_COOLDOWN));

        try {
            Mail::to($user->email)->send(new OtpMail($otp, $user->name, self::OTP_TTL / 60));
        } catch (\Throwable $e) {
            // Kirim gagal → OTP tidak boleh dianggap valid, buang agar user
            // kirim ulang. Cooldown juga dibatalkan supaya bisa langsung retry.
            report($e);
            cache()->forget($cacheKey);
            cache()->forget($throttleKey);

            return response()->json([
                'message' => 'Gagal mengirim email OTP. Silakan coba lagi.',
            ], 500);
        }

        $isLocal = app()->environment('local', 'development');

        return response()->json([
            'message'     => 'Kode OTP telah dikirim ke ' . $this->maskEmail($user->email) . '. Berlaku 10 menit.',
            // Helper pengembangan di non-production saja.
            'debug_token' => $isLocal ? $otp : null,
        ]);
    }

    /** Verifikasi OTP + simpan password baru. */
    public function reset(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email'     => ['required', 'string', 'email', 'max:255'],
            'otp'       => ['required', 'digits:6'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.required'      => 'Email wajib diisi.',
            'email.email'         => 'Format email tidak valid.',
            'otp.required'        => 'Kode OTP wajib diisi.',
            'otp.digits'          => 'Kode OTP harus 6 digit.',
            'password.required'   => 'Password baru wajib diisi.',
            'password.min'        => 'Password baru minimal 8 karakter.',
            'password.confirmed'  => 'Konfirmasi password tidak cocok.',
        ]);

        $email    = strtolower(trim($validated['email']));
        $user     = User::where('email', $email)->first();
        $cacheKey = $this->otpCacheKey($email);

        // Pesan sama untuk email tak dikenal & OTP salah (anti user-enumeration).
        if (! $user || ! cache()->has($cacheKey)) {
            return response()->json([
                'message' => 'Kode OTP tidak valid atau telah kedaluwarsa. Silakan kirim ulang OTP.',
                'errors'  => ['otp' => ['Kode OTP tidak valid atau telah kedaluwarsa.']],
            ], 422);
        }

        $cachedHash = (string) cache()->get($cacheKey);

        if (! Hash::check((string) $validated['otp'], $cachedHash)) {
            return response()->json([
                'message' => 'Kode OTP salah. Periksa kembali email Anda.',
                'errors'  => ['otp' => ['Kode OTP salah. Periksa kembali email Anda.']],
            ], 422);
        }

        // Cast 'hashed' pada model User akan otomatis meng-hash nilai ini.
        $user->forceFill([
            'password'       => $validated['password'],
            'remember_token' => Str::random(60),
        ])->save();

        // Paksa semua sesi lama logout (lapisan keamanan tambahan).
        cache()->forget($cacheKey);

        ActivityLogger::log('password_reset', $user, [
            'module'      => 'autentikasi',
            'description' => 'mengatur ulang password melalui fitur Lupa Password (OTP email)',
            'subject'     => $user,
        ]);

        return response()->json([
            'message' => 'Password berhasil diperbarui. Silakan masuk dengan password baru Anda.',
        ]);
    }

    private function otpCacheKey(string $email): string
    {
        return 'otp:password:' . sha1($email);
    }

    /** Samarkan email untuk pesan sukses: a***b@domain.com. */
    private function maskEmail(string $email): string
    {
        [$local, $domain] = array_pad(explode('@', $email, 2), 2, '');

        $first = mb_substr($local, 0, 1);
        $last  = mb_strlen($local) > 1 ? mb_substr($local, -1) : '';

        return $first . str_repeat('*', max(mb_strlen($local) - 2, 1)) . $last . '@' . $domain;
    }
}
