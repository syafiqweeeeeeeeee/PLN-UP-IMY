<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\News;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Endpoint pencarian topbar admin (Ctrl+K / ikon kaca pembesar).
 * Mencari berita, pengumuman, dan halaman berdasarkan judul.
 * Hasil JSON dikelompokkan per tipe konten.
 */
class AdminSearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'q' => 'required|string|min:2|max:100',
        ]);

        $q = $validated['q'];

        $news = News::query()
            ->where('title', 'like', "%{$q}%")
            ->latest()
            ->limit(5)
            ->get(['id', 'title', 'is_published', 'created_at']);

        $announcements = Announcement::query()
            ->where('title', 'like', "%{$q}%")
            ->latest('created_at')
            ->limit(5)
            ->get(['id', 'title', 'is_published', 'created_at']);

        $pages = Page::query()
            ->where('title', 'like', "%{$q}%")
            ->latest('updated_at')
            ->limit(5)
            ->get(['id', 'title', 'status', 'updated_at']);

        return response()->json([
            [
                'label' => 'Berita',
                'items' => $news->map(fn (News $n) => [
                    'title' => $n->title,
                    'url'   => route('admin.news.edit', $n),
                    'meta'  => $n->is_published ? 'Terbit' : 'Draft',
                ])->all(),
            ],
            [
                'label' => 'Pengumuman',
                'items' => $announcements->map(fn (Announcement $a) => [
                    'title' => $a->title,
                    'url'   => route('admin.announcements.edit', $a),
                    'meta'  => $a->is_published ? 'Terbit' : 'Draft',
                ])->all(),
            ],
            [
                'label' => 'Halaman',
                'items' => $pages->map(fn (Page $p) => [
                    'title' => $p->title,
                    'url'   => route('admin.pages.edit', $p),
                    'meta'  => $p->status === Page::STATUS_PUBLISHED ? 'Terbit' : 'Draft',
                ])->all(),
            ],
        ]);
    }
}
