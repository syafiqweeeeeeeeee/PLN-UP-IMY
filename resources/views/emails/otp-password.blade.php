@component('mail::layout')
{{-- Header: Logo PLN NP --}}
@slot('header')
<table width="100%" cellpadding="0" cellspacing="0" style="background: #003a70; border-radius: 8px 8px 0 0; padding: 24px 20px; text-align: center;">
    <tr>
        <td align="center">
            @if(file_exists(public_path('assets/images/logo-pln.png')))
                <img src="{{ $message->embed(public_path('assets/images/logo-pln.png')) }}" alt="PLN Nusantara Power" width="150" style="display: block; margin: 0 auto 10px;">
            @endif
            <div style="color: #ffffff; font-size: 15px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">
                PLN NP &mdash; Security System
            </div>
        </td>
    </tr>
</table>
@endslot

{{-- Body: Pemberitahuan --}}
<table width="100%" cellpadding="0" cellspacing="0" style="padding: 8px 0;">
    <tr>
        <td style="font-family: Arial, Helvetica, sans-serif; color: #1f2937; font-size: 15px; line-height: 1.7;">
            <p style="margin: 0 0 14px;">Yth. <strong>{{ $recipientName }}</strong>,</p>
            <p style="margin: 0 0 18px;">
                Kami menerima permintaan untuk <strong>mengubah password</strong> akun Anda di
                <strong>PLN Nusantara Power</strong>. Gunakan kode One-Time Password (OTP)
                di bawah ini untuk memverifikasi perubahan tersebut.
            </p>
        </td>
    </tr>
    <tr>
        <td align="center" style="padding: 6px 0 22px;">
            <div style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #6b7280; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">
                Kode OTP Anda
            </div>
            <div style="font-family: 'Courier New', Courier, monospace; font-size: 40px; font-weight: 700; letter-spacing: 12px; color: #003a70; background: #f1f5f9; border: 1px dashed #005b9c; border-radius: 10px; padding: 18px 28px; display: inline-block;">
                {{ $otpCode }}
            </div>
        </td>
    </tr>
    <tr>
        <td style="font-family: Arial, Helvetica, sans-serif; color: #1f2937; font-size: 15px; line-height: 1.7;">
            <div style="background: #fef3c7; border-left: 4px solid #f59e0b; border-radius: 6px; padding: 12px 16px; color: #92400e; font-size: 13.5px;">
                <strong>&#9200; Peringatan:</strong> Kode ini hanya berlaku selama
                <strong>{{ $expiresInMinutes }} menit</strong>. Jangan bagikan kode ini kepada siapa pun,
                termasuk pihak yang mengaku sebagai petugas PLN NP.
            </div>
            <p style="margin: 16px 0 0; font-size: 13.5px; color: #6b7280;">
                Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini atau segera hubungi
                administrator sistem. Password Anda tidak akan berubah tanpa verifikasi kode OTP.
            </p>
        </td>
    </tr>
</table>
@endcomponent

@component('mail::footer')
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #9ca3af; line-height: 1.6; text-align: center;">
            Email ini dikirim otomatis oleh sistem &mdash; mohon tidak membalas email ini.<br>
            &copy; {{ date('Y') }} PT PLN Nusantara Power UP PLTU Indramayu. All rights reserved.
        </td>
    </tr>
</table>
@endcomponent
