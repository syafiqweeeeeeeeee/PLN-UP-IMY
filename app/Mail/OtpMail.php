<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Email OTP untuk reset password (fitur Lupa Password).
 *
 * Tampilan email dibangun inline tanpa file view terpisah agar
 * self-contained. Subjek & teks berbahasa Indonesia.
 */
class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $otp,
        public string $nama,
        public int $masaBerlakuMenit = 10,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode OTP Reset Password — E-PPID PLN Nusantara Power',
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: $this->buildHtml(),
            // CATATAN: parameter `text` pada Mailables\Content adalah NAMA VIEW
            // (bukan string mentah) — dipakai sebagai plain-text alternative.
            text: 'mail.otp-text',
        );
    }

    /**
     * Template HTML inline-style (aman untuk klien email yang
     * membuang <style>, mis. Gmail) — dikirim sebagai string mentah
     * lewat Content::htmlString (tanpa file view terpisah).
     */
    private function buildHtml(): string
    {
        $nama = e($this->nama);
        $otp  = e($this->otp);

        $html = <<<HTML
<!DOCTYPE html>
<html lang="id">
<body style="margin:0;padding:0;background-color:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f9;padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:520px;background:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 4px 14px rgba(0,0,0,0.06);">
                    <tr>
                        <td style="background:linear-gradient(135deg,#005b9c,#00b4d8);padding:22px 28px;color:#ffffff;">
                            <div style="font-size:18px;font-weight:bold;">E-PPID PLN Nusantara Power</div>
                            <div style="font-size:12px;opacity:0.9;margin-top:4px;">Reset Password — Kode OTP</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px;">
                            <p style="margin:0 0 12px;font-size:14px;color:#1f2937;">Halo <strong>{$nama}</strong>,</p>
                            <p style="margin:0 0 18px;font-size:14px;color:#4b5563;line-height:1.6;">
                                Gunakan kode berikut untuk mengatur ulang password akun Anda.
                                Kode berlaku <strong>{$this->masaBerlakuMenit} menit</strong>.
                            </p>
                            <div style="text-align:center;margin:0 0 20px;">
                                <span style="display:inline-block;letter-spacing:10px;font-size:30px;font-weight:bold;color:#005b9c;background:#eef6fc;border:1px dashed #005b9c;border-radius:10px;padding:12px 20px 12px 30px;">{$otp}</span>
                            </div>
                            <p style="margin:0 0 6px;font-size:13px;color:#6b7280;line-height:1.6;">
                                Jangan bagikan kode ini kepada siapa pun — petugas kami tidak akan pernah meminta kode OTP Anda.
                            </p>
                            <p style="margin:0;font-size:13px;color:#6b7280;line-height:1.6;">
                                Jika Anda tidak merasa meminta reset password, abaikan email ini; password Anda tidak berubah.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 28px;border-top:1px solid #f3f4f6;font-size:11px;color:#9ca3af;">
                            Email otomatis — mohon tidak dibalas. &copy; PLN Nusantara Power UP Indramayu
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
HTML;

        return $html;
    }
}
