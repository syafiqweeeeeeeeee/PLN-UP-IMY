<?php

namespace App\Support;

use Illuminate\Http\Request;

/**
 * PREFERENSI TEMA — satu sumber kebenaran di sisi server.
 *
 * Nilai yang dikenal: `light`, `dark`, `system` (ikut preferensi OS).
 * Preferensi disimpan di COOKIE (bukan kolom database baru) sehingga:
 * - bertahan setelah refresh, pindah halaman, logout, dan login lagi;
 * - dapat dibaca SERVER sebelum HTML dikirim → kelas tema pada
 *   `<html>` sudah benar pada paint pertama (tanpa kedip);
 * - tidak mengubah skema database, autentikasi, RBAC, atau fungsi bisnis.
 *
 * Nilai per-pengguna disimpan di localStorage ber-kunci `pln-theme:u{id}`
 * (dua akun di satu peramban tidak saling menimpa); cookie generik
 * `pln_theme` menjadi cermin server-side agar `<html>` sudah memakai tema
 * yang benar saat HTML dikirim. Cookie ini NON-terenkripsi (didaftarkan
 * di `bootstrap/app.php` → `encryptCookies(except: ['pln_theme'])`) karena
 * ditulis oleh JavaScript, bukan oleh Laravel.
 *
 * Cookie ditulis oleh `public/js/theme.js` saat pengguna mengganti tema
 * (JavaScript adalah satu-satunya penulisnya agar localStorage dan
 * cookie selalu sinkron). Kelas CSS yang dipakai: `html.theme-dark`.
 */
final class Theme
{
    public const LIGHT = 'light';

    public const DARK = 'dark';

    public const SYSTEM = 'system';

    /** Default: ikuti preferensi sistem operasi. */
    public const DEFAULT = self::SYSTEM;

    public const COOKIE = 'pln_theme';

    /** Umur cookie satu tahun (detik) — cukup untuk "ingat tema". */
    public const MAX_AGE = 31536000;

    /** @return array<int, string> */
    public static function preferences(): array
    {
        return [self::LIGHT, self::DARK, self::SYSTEM];
    }

    /** Normalkan nilai cookie/JS; `null` bila bukan pilihan yang dikenal. */
    public static function normalize(mixed $value): ?string
    {
        if (! is_string($value)) {
            return null;
        }

        $value = strtolower(trim($value));

        return in_array($value, self::preferences(), true) ? $value : null;
    }

    /**
     * Preferensi yang berlaku untuk request ini: cookie → default
     * (`system`). Nilai per-pengguna di localStorage diterapkan skrip
     * bootstrap di <head> bila berbeda dari cookie.
     */
    public static function preference(Request $request): string
    {
        return self::normalize($request->cookie(self::COOKIE)) ?? self::DEFAULT;
    }

    /**
     * Apakah tema gelap pasti aktif di sisi server. Preferensi `system`
     * tidak bisa diputuskan server (butuh matchMedia) — skrip bootstrap
     * kecil di <head> yang melengkapinya sebelum CSS dipakai.
     */
    public static function isDark(Request $request): bool
    {
        return self::preference($request) === self::DARK;
    }

    /** Kelas untuk elemen <html> (string kosong = tema terang). */
    public static function htmlClass(Request $request): string
    {
        return self::isDark($request) ? 'theme-dark' : '';
    }
}
