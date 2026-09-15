<?php

namespace App\Http\Middleware;

use App\Models\Page;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Enforce visibilitas halaman di sisi SERVER (bukan cuma sembunyikan dari menu).
 * Draft / halaman ber-role yang tidak diizinkan → 404 (bukan 403,
 * agar keberadaan halaman "rahasia" tidak terkonfirmasi).
 */
class EnsurePageVisible
{
    public function handle(Request $request, Closure $next): Response
    {
        $page = $request->route('page');

        if (! $page instanceof Page || ! $page->isAccessibleBy($request->user())) {
            abort(404);
        }

        return $next($request);
    }
}
