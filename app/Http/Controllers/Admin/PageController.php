<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Page;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        $pages = Page::with('roles')
            ->latest('updated_at')
            ->paginate(12);

        return view('admin.pages.index', [
            'pages'        => $pages,
            'statusLabels' => ['draft' => 'Draft', 'published' => 'Terbit'],
            'visibilityLabels' => ['public' => 'Publik', 'role_restricted' => 'Role Terbatas'],
        ]);
    }

    public function create(): View
    {
        return view('admin.pages.form', [
            'page' => null,
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePage($request);

        $validated['slug'] = Page::generateSlug($validated['title']);
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        $page = Page::create($validated);
        $page->roles()->sync($this->roleIds($request));

        ActivityLog::record('halaman', 'create', "membuat halaman \"{$page->title}\"", $page);

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Halaman berhasil dibuat. Lanjutkan mengisi konten.');
    }

    public function edit(Page $page): View
    {
        $page->load(['sections', 'roles']);

        return view('admin.pages.form', [
            'page' => $page,
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $validated = $this->validatePage($request);

        // Slug hanya di-generate ulang jika judul berubah (pola NewsController)
        if ($page->title !== $validated['title']) {
            $validated['slug'] = Page::generateSlug($validated['title'], $page->id);
        }

        $validated['updated_by'] = auth()->id();

        $page->update($validated);
        $page->roles()->sync($this->roleIds($request));

        ActivityLog::record('halaman', 'update', "mengubah halaman \"{$page->title}\"", $page);

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        ActivityLog::record('halaman', 'delete', "menghapus halaman \"{$page->title}\"", $page);

        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman berhasil dihapus.');
    }

    public function togglePublish(Page $page): RedirectResponse
    {
        $published = $page->status === Page::STATUS_PUBLISHED
            ? Page::STATUS_DRAFT
            : Page::STATUS_PUBLISHED;

        $page->update(['status' => $published]);

        ActivityLog::record(
            'halaman',
            $published === Page::STATUS_PUBLISHED ? 'publish' : 'unpublish',
            ($published === Page::STATUS_PUBLISHED ? 'memublikasikan halaman "' : 'menarik halaman "') . $page->title . '"',
            $page
        );

        return back()->with('success', $published === Page::STATUS_PUBLISHED
            ? 'Halaman berhasil dipublikasikan.'
            : 'Halaman ditarik menjadi draft.');
    }

    /* =========================================================
       HELPER
       ========================================================= */

    private function validatePage(Request $request): array
    {
        return $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'status'       => ['required', 'in:draft,published'],
            'visibility'   => ['required', 'in:public,role_restricted'],
            'show_in_list' => ['nullable', 'boolean'],
        ]);
    }

    private function roleIds(Request $request): array
    {
        if ($request->input('visibility') !== Page::VISIBILITY_ROLE_ONLY) {
            return [];
        }

        $roleIds = $request->input('role_ids', []);

        return is_array($roleIds)
            ? array_map('intval', array_filter($roleIds, fn ($v) => (int) $v > 0))
            : [];
    }
}
