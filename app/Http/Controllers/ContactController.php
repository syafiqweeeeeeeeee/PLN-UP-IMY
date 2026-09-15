<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use App\Services\RecaptchaService;

class ContactController extends Controller
{
    /**
     * Simpan pesan dari form kontak publik (Hubungi Kami).
     */
    public function store(StoreContactMessageRequest $request, RecaptchaService $recaptcha)
    {
        // --- Verifikasi reCAPTCHA v3 (anti-spam) ---
        // Dilakukan SETELAH validasi field dasar, SEBELUM simpan ke database.
        if (! $recaptcha->verify($request->input('g-recaptcha-response'), 'kontak')) {
            $message = 'Verifikasi Keamanan Gagal: Akses Anda terdeteksi sebagai bot atau tidak valid.';

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'errors'  => ['captcha' => [$message]],
                ], 422);
            }

            return back()
                ->withInput($request->only(['nama', 'email', 'telepon', 'kategori', 'subjek']))
                ->withErrors(['captcha' => $message]);
        }

        $data = $request->validated();

        // Set status awal secara eksplisit: setiap pesan baru = 'belum_dibaca'
        // (tetap berlaku walau default kolom DB berubah atau tidak tersedia)
        $data['status'] = ContactMessage::STATUS_BELUM_DIBACA;

        ContactMessage::create($data);

        // AJAX → balas JSON; submit biasa → redirect + flash toast
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan Anda berhasil terkirim! Tim kami akan merespons secepatnya.',
            ]);
        }

        return redirect()
            ->route('hubungi-kami')
            ->with('success', 'Pesan Anda berhasil terkirim! Tim kami akan merespons secepatnya.')
            ->withFragment('contact'); // penanda scroll ke form
    }
}
