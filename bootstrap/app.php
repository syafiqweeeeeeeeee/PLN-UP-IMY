<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'permission' => \App\Http\Middleware\PermissionMiddleware::class,
            'role.scope' => \App\Http\Middleware\RoleMiddleware::class,
            'page.visible' => \App\Http\Middleware\EnsurePageVisible::class,
            'admin.access' => \App\Http\Middleware\EnsureNotKaryawan::class,
            'karyawan.access' => \App\Http\Middleware\EnsureKaryawan::class,
            'must.password' => \App\Http\Middleware\MustChangePassword::class,
        ]);

        /* ---- Wajib ganti password setelah reset oleh admin ----
           Ditambahkan ke grup `web` (setelah StartSession) agar semua
           halaman — admin, portal karyawan, dan publik yang butuh auth —
           dijaga: akun dengan penanda must_change_password diarahkan
           ke halaman ganti password sebelum boleh lanjut. */
        $middleware->web(append: [
            \App\Http\Middleware\MustChangePassword::class,
        ]);

        /* ---- Trust semua proxy (ngrok / cloudflare tunnel / LB) ----
           Tanpa ini, akses lewat ngrok membuat Laravel menganggap
           request "http" (padahal browser di https): cookie session
           & CSRF tidak ter-set flag Secure, token tidak cocok, dan
           submit form login berujung "419 Page Expired".
           Dengan trustProxies, header X-Forwarded-Proto/Host dipakai
           sehingga URL, cookie, dan redirect tetap https. */
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
