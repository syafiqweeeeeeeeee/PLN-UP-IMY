<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Rule anti email acak-asalan.
 *
 * Menolak local-part (bagian sebelum @) yang berpola acak, mis.:
 *   xqzw@domain.com, asdf1234@gmail.com, kjhgfd@pln.co.id
 *
 * Heuristik:
 *   0. Local-part pendek (<= 3 huruf, mis. hrd, adm, svc) dikecualikan —
 *      akronim bisnis yang sah.
 *   1. Wajib ada minimal satu huruf vokal (a, i, u, e, o) — kata manusiawi
 *      hampir selalu punya vokal; string acak sering tidak.
 *   2. Rantai konsonan beruntun >= 5 → acak ("christopher" lolos karena
 *      vokal memecah rantai; "asdfgh" ditolak).
 *   3. Rasio konsonan:vokal keseluruhan > 5:1 → tampak acak.
 *
 * Angka & titik diabaikan dari perhitungan rasio. Nama email yang wajar
 * (budi.santoso, muhammad.rizki123, john, hrd, info) tetap lolos.
 */
class NotRandomEmail implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $email = trim((string) $value);

        // Ambil local-part (sebelum @). Format dasar sudah divalidasi rule lain.
        $at = strrpos($email, '@');
        if ($at === false || $at === 0) {
            return; // biarkan rule 'email' yang menolak format rusak
        }

        $local = strtolower(substr($email, 0, $at));

        // Buang pemisah umum & angka — sisakan huruf saja untuk analisis
        $letters = preg_replace('/[^a-z]/', '', $local) ?? '';

        // 0. Akronim pendek (hrd, adm, svc, cs) — dikecualikan dari heuristik
        if (strlen($letters) <= 3) {
            return;
        }

        // 1. Wajib ada vokal (a, i, u, e, o)
        if (! preg_match('/[aeiou]/', $letters)) {
            $fail('Alamat email tampak tidak valid — gunakan email asli Anda (contoh: nama@domain.com).');

            return;
        }

        // 2. Rantai konsonan beruntun >= 5 dianggap acak
        if (preg_match('/[bcdfghjklmnpqrstvwxyz]{5,}/', $letters)) {
            $fail('Alamat email tampak tidak valid — gunakan email asli Anda (contoh: nama@domain.com).');

            return;
        }

        // 3. Rasio konsonan:vokal > 5:1 → pola acak
        $vowelCount = preg_match_all('/[aeiou]/', $letters);
        $consonantCount = strlen($letters) - $vowelCount;

        if ($vowelCount > 0 && ($consonantCount / $vowelCount) > 5) {
            $fail('Alamat email tampak tidak valid — gunakan email asli Anda (contoh: nama@domain.com).');
        }
    }
}
