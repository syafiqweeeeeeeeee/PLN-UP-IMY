<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Services\PublicPageCache;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Halaman CMS dinamis (dua pintu: publik & internal).
 * Enforcement visibilitas ada di middleware 'page.visible' — bukan di sini.
 */
class PageDisplayController extends Controller
{
    public function index(Request $request): View
    {
        // Pengunjung publik (guest): daftar halaman sama untuk semua orang
        // → di-cache (TTL 10 menit + flush saat halaman CMS diubah).
        // User login TIDAK di-cache karena visibilitasnya per role.
        $pages = $request->user()
            ? $this->queryPages($request->user())->get()
            : PublicPageCache::remember('pages.index', fn () => $this->queryPages(null)->get());

        return view('pages.index', compact('pages'));
    }

    public function show(Request $request, Page $page): View
    {
        // Load sections sekali saat miss; hasilnya di-cache per slug.
        // (Visibilitas/keamanan tetap di-enforce middleware page.visible
        //  SETIAP request — cache di sini hanya menyangkut data konten.)
        if ($request->user()) {
            $page->load('sections');
        } else {
            $page = PublicPageCache::remember('pages.show.'.$page->slug, function () use ($page) {
                return $page->load('sections');
            });
        }

        return view('pages.show', compact('page'));
    }

    /** Query dasar daftar halaman CMS (dipakai jalur cache & non-cache). */
    protected function queryPages(?\App\Models\User $user): \Illuminate\Database\Eloquent\Builder
    {
        return Page::published()
            ->listing()
            ->visibleTo($user)
            ->with('roles')
            ->orderBy('title');
    }
}
