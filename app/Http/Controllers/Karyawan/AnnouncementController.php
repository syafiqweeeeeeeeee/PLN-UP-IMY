<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Concerns\ScopesToDepartment;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Department;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 * Pengelolaan Pengumuman dari KONTEKS PORTAL KARYAWAN.
 *
 * Logic/backend (validasi, scoping bidang, guard 403 lintas bidang)
 * mengikuti Admin\AnnouncementController — perbedaannya hanya pada
 * tampilan: view `karyawan.announcements.*` yang memakai layout
 * Portal Karyawan (layouts.karyawan), bukan layout Admin.
 */
class AnnouncementController extends Controller
{
    use ScopesToDepartment;

    public function index()
    {
        Gate::authorize('announcements.view');

        // Global scope ScopedToUserDepartment otomatis menyaring:
        // Admin Bidang → pengumuman bidangnya + global (NULL).
        $announcements = Announcement::query()
            ->latest('published_at')
            ->latest('created_at')
            ->paginate(12);

        return view('karyawan.announcements.index', compact('announcements'));
    }

    public function create()
    {
        Gate::authorize('announcements.create');

        return view('karyawan.announcements.form', array_merge([
            'announcement' => null,
        ], $this->formContext()));
    }

    public function store(Request $request)
    {
        Gate::authorize('announcements.create');

        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'category'     => ['required', 'in:umum,teknis,kepegawaian,keuangan,layanan'],
            'target_publication' => ['nullable', 'in:' . implode(',', Announcement::TARGETS)],
            'excerpt'      => ['required', 'string', 'max:1000'],
            'content'      => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ], [
            'target_publication.in' => 'Target publikasi tidak valid.',
        ]);

        $validated['slug'] = Announcement::generateSlug($validated['title']);
        // Default "Semua (Publik & Portal)" bila tidak dipilih.
        $validated['target_publication'] = $validated['target_publication'] ?? 'all';
        $validated['is_published'] = !empty($validated['is_published']);
        $validated['author_user_id'] = auth()->id();

        // Data Scoping: karyawan terikat bidang → pengumuman "Khusus Bidang"
        // otomatis dimiliki bidangnya (input form tidak dipercaya);
        // "Semua Karyawan (Umum)" → global (NULL).
        $validated['department_id'] = $this->resolveDepartmentIdForCreate($request);

        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        $announcement = Announcement::create($validated);

        ActivityLogger::log('create', null, [
            'module'      => 'pengumuman',
            'description' => "membuat pengumuman \"{$announcement->title}\" (Portal Karyawan)",
            'subject'     => $announcement,
        ]);

        return redirect()->route('karyawan.announcements.index')
            ->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function show(Announcement $announcement)
    {
        Gate::authorize('announcements.view');

        return view('karyawan.announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        Gate::authorize('announcements.edit');

        // Delete/Edit Guard: blokir pengumuman milik bidang lain (403).
        $this->authorizeAnnouncementAccess($announcement);

        return view('karyawan.announcements.form', array_merge(
            ['announcement' => $announcement],
            $this->formContext()
        ));
    }

    public function update(Request $request, Announcement $announcement)
    {
        Gate::authorize('announcements.edit');

        $this->authorizeAnnouncementAccess($announcement);

        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'category'     => ['required', 'in:umum,teknis,kepegawaian,keuangan,layanan'],
            'target_publication' => ['nullable', 'in:' . implode(',', Announcement::TARGETS)],
            'excerpt'      => ['required', 'string', 'max:1000'],
            'content'      => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ], [
            'target_publication.in' => 'Target publikasi tidak valid.',
        ]);

        $validated['is_published'] = !empty($validated['is_published']);
        $validated['target_publication'] = $validated['target_publication'] ?? 'all';

        // Pemilik bidang tidak berubah saat update.
        $validated['department_id'] = $announcement->department_id;

        // Auto update slug hanya jika judul berubah.
        if ($announcement->title !== $validated['title']) {
            $validated['slug'] = Announcement::generateSlug($validated['title']);
        }

        if ($validated['is_published'] && !$announcement->is_published) {
            $validated['published_at'] = now();
        }

        $announcement->update($validated);

        ActivityLogger::log('update', null, [
            'module'      => 'pengumuman',
            'description' => "mengubah pengumuman \"{$announcement->title}\" (Portal Karyawan)",
            'subject'     => $announcement,
        ]);

        return redirect()->route('karyawan.announcements.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $announcement)
    {
        Gate::authorize('announcements.delete');

        $this->authorizeAnnouncementAccess($announcement);

        ActivityLogger::log('delete', null, [
            'module'      => 'pengumuman',
            'description' => "menghapus pengumuman \"{$announcement->title}\" (Portal Karyawan)",
            'subject'     => $announcement,
        ]);

        $announcement->delete();

        return redirect()->route('karyawan.announcements.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function togglePublish(Announcement $announcement)
    {
        Gate::authorize('announcements.publish');

        $this->authorizeAnnouncementAccess($announcement);

        $published = $announcement->is_published ? false : true;

        $announcement->update([
            'is_published' => $published,
            'published_at' => $published ? now() : null,
        ]);

        ActivityLogger::log($published ? 'publish' : 'unpublish', null, [
            'module'      => 'pengumuman',
            'description' => ($published ? 'memublikasikan pengumuman "' : 'menarik pengumuman "') . $announcement->title . '" (Portal Karyawan)',
            'subject'     => $announcement,
        ]);

        return back()
            ->with('success', $published
                ? 'Pengumuman berhasil dipublikasikan.'
                : 'Pengumuman ditarik dari publikasi.');
    }

    /* =========================================================
       RBAC — SCOPING PER BIDANG (sama dengan Admin)
       ========================================================= */

    /**
     * Guard edit/update/delete/publish: pengumuman bidang lain → 403.
     */
    private function authorizeAnnouncementAccess(Announcement $announcement): void
    {
        $department = $this->scopedDepartment();

        if ($department === null) {
            return;
        }

        $ownerId = Department::byCode($department)?->id;

        if ($announcement->department_id !== null && $announcement->department_id !== $ownerId) {
            abort(403, 'Pengumuman ini milik bidang lain — Anda hanya dapat mengelola pengumuman bidang Anda.');
        }
    }

    /**
     * department_id saat create (konteks karyawan):
     * - Terikat bidang → radio "Target Pembaca": 'umum' = global (NULL),
     *   'bidang' = ID bidangnya (default — instruksi internal).
     * - Tanpa pengikatan → global (NULL).
     */
    private function resolveDepartmentIdForCreate(Request $request): ?int
    {
        $department = $this->scopedDepartment();

        if ($department === null) {
            return null;
        }

        if ($request->input('target_audience') === 'umum') {
            return null;
        }

        return Department::byCode($department)?->id;
    }

    /**
     * Konteks form: karyawan terikat bidang → daftar bidang hanya
     * memuat bidangnya (terkunci).
     *
     * @return array<string, mixed>
     */
    private function formContext(): array
    {
        $bound = $this->scopedDepartment();

        return [
            'departments'      => $bound !== null ? array_intersect_key(\App\Models\User::DEPARTMENTS, [$bound => true]) : [],
            'lockedDepartment' => $bound,
        ];
    }
}
