<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOtpPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Kode OTP 6 digit.
     */
    public string $otpCode;

    /**
     * Nama penerima email.
     */
    public string $recipientName;

    /**
     * Masa berlaku OTP dalam menit.
     */
    public int $expiresInMinutes;

    /**
     * Create a new message instance.
     */
    public function __construct(string $otpCode, string $recipientName, int $expiresInMinutes = 5)
    {
        $this->otpCode = $otpCode;
        $this->recipientName = $recipientName;
        $this->expiresInMinutes = $expiresInMinutes;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode OTP Verifikasi Perubahan Password - PLN Nusantara Power',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.otp-password',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
