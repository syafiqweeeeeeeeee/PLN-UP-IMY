<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\ScopesToDepartment;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Services\ActivityLogger;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    use ScopesToDepartment;

    public function index()
    {
        // Read: Admin Bidang hanya melihat pengumuman bidangnya + global (NULL).
        $query = Announcement::query();

        if ($this->scopedDepartment() !== null) {
            $query->where(function ($q) {
                $q->where('department_id', \App\Models\Department::byCode($this->scopedDepartment())?->id)
                  ->orWhereNull('department_id');
            });
        }

        $announcements = $query->latest('published_at')
            ->latest('created_at')
            ->paginate(12);

        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.form', array_merge([
            'announcement' => null,
        ], $this->formContext()));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'category'     => ['required', 'in:umum,teknis,kepegawaian,keuangan,layanan'],
            'target_publication' => ['nullable', 'in:' . implode(',', Announcement::TARGETS)],
            'excerpt'      => ['required', 'string', 'max:1000'],
            'content'      => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ], [
            'target_publication.in'       => 'Target publikasi tidak valid.',
        ]);

        $validated['slug'] = Announcement::generateSlug($validated['title']);
        // Default "Semua (Publik & Portal)" bila tidak dipilih.
        $validated['target_publication'] = $validated['target_publication'] ?? 'all';
        $validated['is_published'] = !empty($validated['is_published']);
        $validated['author_user_id'] = auth()->id();

        // Dynamic Data Scoping: Admin Bidang → pengumuman otomatis dimiliki
        // bidangnya (input form tidak dipercaya). Super Admin → global (NULL)
        // atau bidang pilihannya via select "Bidang Pemilik".
        $validated['department_id'] = $this->resolveDepartmentIdForCreate($request);

        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        $announcement = Announcement::create($validated);

        ActivityLogger::log('create', null, [
            'module'      => 'pengumuman',
            'description' => "membuat pengumuman \"{$announcement->title}\"",
            'subject'     => $announcement,
        ]);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function show(Announcement $announcement)
    {
        return view('admin.announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        // Delete/Edit Guard: blokir pengumuman milik bidang lain.
        $this->authorizeAnnouncementAccess($announcement);

        return view('admin.announcements.form', array_merge(
            ['announcement' => $announcement],
            $this->formContext()
        ));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $this->authorizeAnnouncementAccess($announcement);

        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'category'     => ['required', 'in:umum,teknis,kepegawaian,keuangan,layanan'],
            'target_publication' => ['nullable', 'in:' . implode(',', Announcement::TARGETS)],
            'excerpt'      => ['required', 'string', 'max:1000'],
            'content'      => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ], [
            'target_publication.in'       => 'Target publikasi tidak valid.',
        ]);

        $validated['is_published'] = !empty($validated['is_published']);
        // Default "Semua (Publik & Portal)" bila tidak dipilih.
        $validated['target_publication'] = $validated['target_publication'] ?? 'all';

        // Pemilik bidang tidak berubah saat update: Admin Bidang terkunci
        // di bidangnya; Super Admin mempertahankan pemilik lama.
        $validated['department_id'] = $announcement->department_id;

        // Auto update slug hanya jika judul berubah
        if ($announcement->title !== $validated['title']) {
            $validated['slug'] = Announcement::generateSlug($validated['title']);
        }

        if ($validated['is_published'] && !$announcement->is_published) {
            $validated['published_at'] = now();
        }

        $announcement->update($validated);

        ActivityLogger::log('update', null, [
            'module'      => 'pengumuman',
            'description' => "mengubah pengumuman \"{$announcement->title}\"",
            'subject'     => $announcement,
        ]);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $announcement)
    {
        $this->authorizeAnnouncementAccess($announcement);

        ActivityLogger::log('delete', null, [
            'module'      => 'pengumuman',
            'description' => "menghapus pengumuman \"{$announcement->title}\"",
            'subject'     => $announcement,
        ]);

        $announcement->delete();

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function togglePublish(Announcement $announcement)
    {
        $this->authorizeAnnouncementAccess($announcement);

        $published = $announcement->is_published ? false : true;

        $announcement->update([
            'is_published' => $published,
            'published_at' => $published ? now() : null,
        ]);

        ActivityLogger::log($published ? 'publish' : 'unpublish', null, [
            'module'      => 'pengumuman',
            'description' => ($published ? 'memublikasikan pengumuman "' : 'menarik pengumuman "') . $announcement->title . '"',
            'subject'     => $announcement,
        ]);

        return back()
            ->with('success', $published
                ? 'Pengumuman berhasil dipublikasikan.'
                : 'Pengumuman ditarik dari publikasi.');
    }

    /* =========================================================
       RBAC — ADMIN DELEGASI PER BIDANG
       ========================================================= */

    /**
     * Guard edit/update/delete/publish: Super Admin bebas; Admin Bidang
     * hanya boleh menyentuh pengumuman bidangnya sendiri atau global (NULL).
     */
    private function authorizeAnnouncementAccess(Announcement $announcement): void
    {
        $department = $this->scopedDepartment();

        if ($department === null) {
            return;
        }

        $ownerId = Department::byCode($department)?->id;

        if ($announcement->department_id !== null && $announcement->department_id !== $ownerId) {
            abort(403, 'Pengumuman ini milik bidang lain — Anda hanya dapat mengelola pengumuman Bidang '
                . (User::DEPARTMENTS[$department] ?? $department) . '.');
        }
    }

    /**
     department_id saat create:
     * - Admin Bidang → selalu ID bidangnya (input diabaikan).
     * - Super Admin  → dari input department_id (nullable = global).
     */
    private function resolveDepartmentIdForCreate(Request $request): ?int
    {
        $department = $this->scopedDepartment();

        if ($department !== null) {
            return Department::byCode($department)?->id;
        }

        $requested = (int) $request->input('department_id', 0);

        return $requested > 0 ? $requested : null;
    }

    /**
     * Konteks form: Admin Bidang mendapat bidang terkunci + daftar
     * sub-bidang yang hanya memuat bidangnya.
     *
     * @return array<string, mixed>
     */
    private function formContext(): array
    {
        $bound = $this->scopedDepartment();

        return [
            'departments'      => $bound !== null ? array_intersect_key(User::DEPARTMENTS, [$bound => true]) : User::DEPARTMENTS,
            'lockedDepartment' => $bound,
        ];
    }
}
