<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecaptchaService
{
    /**
     * Verifikasi token reCAPTCHA v3 ke API Google.
     *
     * @param  string|null  $token  Nilai g-recaptcha-response dari form
     * @param  string       $action Nama action yang diharapkan (mis. 'kontak')
     * @return bool true jika manusia asli, false jika bot/gagal verifikasi
     */
    public function verify(?string $token, string $action = 'kontak'): bool
    {
        $secret = (string) config('services.recaptcha.secret');

        // Secret belum diisi di .env (RECAPTCHA_SECRET_KEY).
        // - Development/testing lokal → verifikasi dilewati agar form tetap
        //   bisa diuji (fallback), dengan warning di log.
        // - Produksi → TETAP DITOLAK: tanpa secret, proteksi anti-spam tidak
        //   ada sama sekali, jadi pesan tidak boleh lolos.
        if ($secret === '') {
            if (app()->environment('production')) {
                Log::error('reCAPTCHA: RECAPTCHA_SECRET_KEY belum diisi di produksi — pesan DITOLAK.');

                return false;
            }

            Log::warning('reCAPTCHA: RECAPTCHA_SECRET_KEY belum diisi — verifikasi dilewati (fallback dev).');

            return true;
        }

        // Token kosong = indikasi kuat bot (script Google gagal dimuat/diblokir)
        if (empty($token)) {
            return false;
        }

        try {
            $response = Http::asForm()
                ->timeout(10)
                ->retry(2, 300)
                ->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret'   => $secret,
                    'response' => $token,
                    'remoteip' => request()?->ip(),
                ]);
        } catch (ConnectionException $e) {
            // Google tidak terjangkau → jangan blokir pengguna asli;
            // catat ke log dan izinkan pesan masuk.
            Log::error('reCAPTCHA: API siteverify tidak terjangkau: ' . $e->getMessage());

            return true;
        }

        $data = $response->json() ?? [];

        $success   = (bool) ($data['success'] ?? false);
        $score     = isset($data['score']) ? (float) $data['score'] : 0.0;
        $minScore  = (float) config('services.recaptcha.min_score', 0.5);
        $actionOk  = ($data['action'] ?? '') === $action;

        if (! $success || $score < $minScore || ! $actionOk) {
            Log::warning('reCAPTCHA: verifikasi gagal', [
                'success'   => $success,
                'score'     => $score,
                'action'    => $data['action'] ?? null,
                'expected'  => $action,
                'errors'    => $data['error-codes'] ?? [],
            ]);

            return false;
        }

        return true;
    }
}
