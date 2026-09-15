<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Google reCAPTCHA v3 — proteksi anti-spam form kontak publik
    |----------------------------------------------------------------------
    | Isi RECAPTCHA_SITE_KEY & RECAPTCHA_SECRET di file .env. Jika keduanya
    | kosong, verifikasi dilewati (fallback dev) dan form tetap berfungsi.
    */
    // Validasi form kontak publik
    'contact' => [
        // Cek DNS domain email (email:rfc,dns). Test suite mematikan ini via
        // phpunit.xml agar tidak bergantung jaringan; default production: aktif.
        'validate_email_dns' => env('CONTACT_VALIDATE_EMAIL_DNS', true),
    ],

    /*
    |----------------------------------------------------------------------
    | Google reCAPTCHA v3 — proteksi anti-spam form kontak publik
    |----------------------------------------------------------------------
    */
    'recaptcha' => [
        'site_key'  => env('RECAPTCHA_SITE_KEY'),
        'secret'    => env('RECAPTCHA_SECRET_KEY'),
        'min_score' => (float) env('RECAPTCHA_MIN_SCORE', 0.5),
    ],

];
