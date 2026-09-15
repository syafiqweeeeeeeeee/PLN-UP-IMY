<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Kelola section konten di dalam satu halaman.
 * Section versi sederhana: type tetap + form (banner, text, cards, file, faq).
 */
class PageSectionController extends Controller
{
    public function store(Request $request, Page $page): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'in:' . implode(',', array_keys(PageSection::TYPES))],
        ]);

        $maxOrder = (int) $page->sections()->max('sort_order');

        $section = $page->sections()->create([
            'type'       => $validated['type'],
            'data'       => [],
            'sort_order' => $maxOrder + 1,
        ]);

        ActivityLog::record('halaman', 'update', "menambah section {$section->typeLabel()} di halaman \"{$page->title}\"", $page);

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Section ditambahkan. Isi kontennya lalu simpan.');
    }

    public function update(Request $request, Page $page, PageSection $section): RedirectResponse
    {
        abort_unless($section->page_id === $page->id, 404);

        $section->update([
            'data' => PageSection::buildData($section->type, (array) $request->all()),
        ]);

        ActivityLog::record('halaman', 'update', "mengubah section {$section->typeLabel()} di halaman \"{$page->title}\"", $page);

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Konten section berhasil disimpan.');
    }

    public function destroy(Request $request, Page $page, PageSection $section): RedirectResponse
    {
        abort_unless($section->page_id === $page->id, 404);

        $label = $section->typeLabel();
        $section->delete();

        ActivityLog::record('halaman', 'update', "menghapus section {$label} di halaman \"{$page->title}\"", $page);

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Section dihapus.');
    }

    /** Naik/turunkan urutan section (memindahkan posisi dengan tetangganya). */
    public function move(Request $request, Page $page, PageSection $section): RedirectResponse
    {
        abort_unless($section->page_id === $page->id, 404);

        $direction = $request->input('direction') === 'up' ? 'up' : 'down';

        $query = $page->sections()
            ->where('sort_order', $direction === 'up' ? '<' : '>', $section->sort_order)
            ->orderBy('sort_order', $direction === 'up' ? 'desc' : 'asc');

        $neighbor = $query->first();

        if ($neighbor) {
            DB::transaction(function () use ($section, $neighbor, $direction) {
                $a = $section->sort_order;
                $b = $neighbor->sort_order;

                if ($a === $b) {
                    // orders duplikat: tetapkan posisi tetangga secara deterministik
                    $b = $direction === 'up' ? $a + 1 : $a + 2;
                    $neighbor->update(['sort_order' => $b]);
                    return;
                }

                // Tidak ada unique constraint pada sort_order, swap langsung aman
                $section->update(['sort_order' => $b]);
                $neighbor->update(['sort_order' => $a]);
            });
        }

        return redirect()->route('admin.pages.edit', $page);
    }

}
