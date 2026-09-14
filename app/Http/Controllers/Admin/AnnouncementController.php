<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest('published_at')
            ->latest('created_at')
            ->paginate(12);

        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.form', [
            'announcement' => null,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'category'     => ['required', 'in:umum,teknis,kepegawaian,keuangan,layanan'],
            'excerpt'      => ['required', 'string', 'max:1000'],
            'content'      => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Announcement::generateSlug($validated['title']);
        $validated['is_published'] = !empty($validated['is_published']);
        $validated['author_user_id'] = auth()->id();

        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        $announcement = Announcement::create($validated);

        ActivityLog::record('pengumuman', 'create', "membuat pengumuman \"{$announcement->title}\"", $announcement);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function show(Announcement $announcement)
    {
        return view('admin.announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.form', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'category'     => ['required', 'in:umum,teknis,kepegawaian,keuangan,layanan'],
            'excerpt'      => ['required', 'string', 'max:1000'],
            'content'      => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $validated['is_published'] = !empty($validated['is_published']);

        // Auto update slug hanya jika judul berubah
        if ($announcement->title !== $validated['title']) {
            $validated['slug'] = Announcement::generateSlug($validated['title']);
        }

        if ($validated['is_published'] && !$announcement->is_published) {
            $validated['published_at'] = now();
        }

        $announcement->update($validated);

        ActivityLog::record('pengumuman', 'update', "mengubah pengumuman \"{$announcement->title}\"", $announcement);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $announcement)
    {
        ActivityLog::record('pengumuman', 'delete', "menghapus pengumuman \"{$announcement->title}\"", $announcement);

        $announcement->delete();

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function togglePublish(Announcement $announcement)
    {
        $published = $announcement->is_published ? false : true;

        $announcement->update([
            'is_published' => $published,
            'published_at' => $published ? now() : null,
        ]);

        ActivityLog::record(
            'pengumuman',
            $published ? 'publish' : 'unpublish',
            ($published ? 'memublikasikan pengumuman "' : 'menarik pengumuman "') . $announcement->title . '"',
            $announcement
        );

        return back()
            ->with('success', $published
                ? 'Pengumuman berhasil dipublikasikan.'
                : 'Pengumuman ditarik dari publikasi.');
    }
}
