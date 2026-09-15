<?php

namespace App\Http\Controllers;

use App\Models\Page;
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
        $pages = Page::published()
            ->listing()
            ->visibleTo($request->user())
            ->with('roles')
            ->orderBy('title')
            ->get();

        return view('pages.index', compact('pages'));
    }

    public function show(Request $request, Page $page): View
    {
        $page->load('sections');

        return view('pages.show', compact('page'));
    }
}
