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
            'page.visible' => \App\Http\Middleware\EnsurePageVisible::class,
            'admin.access' => \App\Http\Middleware\EnsureNotKaryawan::class,
            'karyawan.access' => \App\Http\Middleware\EnsureKaryawan::class,
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
