<?php

namespace App\Http\Requests;

use App\Models\ContactMessage;
use App\Rules\NotRandomEmail;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // form publik — semua pengunjung boleh mengirim
    }

    public function rules(): array
    {
        return [
            'nama'     => ['required', 'string', 'max:150'],

            // Validasi email ketat (2 lapis):
            // - email:rfc,dns → format RFC valid + domain punya record A/AAAA/MX aktif
            //                   (tolak "user@gmail", "nama@", domain fiktif).
            //                   DNS check bisa dimatikan via config (dipakai test suite
            //                   agar tidak flaky oleh lookup jaringan; production tetap ON).
            // - NotRandomEmail → tolak local-part berpola acak (xqzw@, asdf1234@)
            'email'    => array_values(array_filter([
                'required',
                'string',
                config('services.contact.validate_email_dns', true) ? 'email:rfc,dns' : 'email:rfc',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                new NotRandomEmail(),
                'max:255',
            ])),

            'telepon'  => ['required', 'string', 'min:8', 'max:25', 'regex:/^[0-9+\-\s()]+$/'],
            'kategori' => ['required', 'in:' . implode(',', ContactMessage::KATEGORI)],
            'subjek'   => ['required', 'string', 'max:255'],
            'pesan'    => ['required', 'string', 'min:10', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'      => 'Nama lengkap wajib diisi.',
            'nama.max'           => 'Nama lengkap maksimal 150 karakter.',
            'email.required'     => 'Alamat email wajib diisi.',
            'email.email'        => 'Masukkan alamat email yang valid (contoh: nama@domain.com).',
            'email.regex'        => 'Masukkan alamat email yang valid (contoh: nama@domain.com).',
            'email.not_random_email' => 'Masukkan alamat email yang valid (contoh: nama@domain.com).',
            'telepon.required'   => 'Nomor telepon/WhatsApp wajib diisi.',
            'telepon.min'        => 'Nomor telepon minimal 8 digit.',
            'telepon.max'        => 'Nomor telepon maksimal 25 karakter.',
            'telepon.regex'      => 'Nomor telepon hanya boleh berisi angka.',
            'kategori.required'  => 'Kategori keperluan wajib dipilih.',
            'kategori.in'        => 'Kategori keperluan tidak valid.',
            'subjek.required'    => 'Subjek pesan wajib diisi.',
            'subjek.max'         => 'Subjek pesan maksimal 255 karakter.',
            'pesan.required'     => 'Pesan wajib diisi.',
            'pesan.min'          => 'Pesan minimal 10 karakter.',
            'pesan.max'          => 'Pesan maksimal 5000 karakter.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nama'    => trim((string) $this->input('nama')),
            'email'   => strtolower(trim((string) $this->input('email'))),
            'telepon' => trim((string) $this->input('telepon')),
            'subjek'  => trim((string) $this->input('subjek')),
        ]);
    }
}
