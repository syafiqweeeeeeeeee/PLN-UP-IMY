<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        Gate::authorize('news.view');

        $news = News::latest()->paginate(12);

        return view('karyawan.news.index', compact('news'));
    }

    public function create()
    {
        // simplified version tanpa Gate dan view check
        return view('karyawan.news.form', ['news' => null]);
    }

    public function store(Request $request)
    {
        Gate::authorize('news.create');

        $validated = $request->validate([
            'title'     => ['required', 'string', 'max:255'],
            'category'  => ['required', 'in:umum,teknis,kegiatan,kepegawaian'],
            'target_publication' => ['nullable', 'in:' . implode(',', News::TARGETS)],
            'excerpt'   => ['required', 'string', 'max:1000'],
            'content'   => ['nullable', 'string'],
            'image'     => ['required', 'image', 'max:5120'],
            'author'    => ['nullable', 'string', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
        ], [
            'target_publication.required' => 'Target publikasi wajib dipilih.',
            'target_publication.in'       => 'Target publikasi tidak valid.',
        ]);

        $imagePath = $request->file('image')?->store('news', 'public');

        $validated['slug'] = News::generateSlug($validated['title']);
        $validated['image'] = $imagePath;
        $validated['is_published'] = !empty($validated['is_published']);
        $validated['author_user_id'] = auth()->id();
        $validated['target_publication'] = $validated['target_publication'] ?? 'all';

        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        $news = News::create($validated);

        ActivityLogger::log('create', null, [
            'module'      => 'berita',
            'description' => "membuat berita \"{$news->title}\"",
            'subject'     => $news,
        ]);

        return redirect()->route('karyawan.news.index')
            ->with('success', 'Berita berhasil dibuat.');
    }

    public function show(News $news)
    {
        Gate::authorize('news.view');

        return view('karyawan.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        Gate::authorize('news.edit');

        return view('karyawan.news.form', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        Gate::authorize('news.edit');

        $validated = $request->validate([
            'title'     => ['required', 'string', 'max:255'],
            'category'  => ['required', 'in:umum,teknis,kegiatan,kepegawaian'],
            'target_publication' => ['nullable', 'in:' . implode(',', News::TARGETS)],
            'excerpt'   => ['required', 'string', 'max:1000'],
            'content'   => ['nullable', 'string'],
            'image'     => ['nullable', 'image', 'max:5120'],
            'author'    => ['nullable', 'string', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
        ], [
            'target_publication.required' => 'Target publikasi wajib dipilih.',
            'target_publication.in'       => 'Target publikasi tidak valid.',
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $validated['is_published'] = !empty($validated['is_published']);

        if ($news->title !== $validated['title']) {
            $validated['slug'] = News::generateSlug($validated['title']);
        }

        if ($validated['is_published'] && !$news->is_published) {
            $validated['published_at'] = now();
        }

        $news->update($validated);

        ActivityLogger::log('update', null, [
            'module'      => 'berita',
            'description' => "mengubah berita \"{$news->title}\"",
            'subject'     => $news,
        ]);

        return redirect()->route('karyawan.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        Gate::authorize('news.delete');

        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        ActivityLogger::log('delete', null, [
            'module'      => 'berita',
            'description' => "menghapus berita \"{$news->title}\"",
            'subject'     => $news,
        ]);

        $news->delete();

        return redirect()->route('karyawan.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    public function togglePublish(News $news)
    {
        Gate::authorize('news.publish');

        $published = $news->is_published ? false : true;

        $news->update([
            'is_published' => $published,
            'published_at' => $published ? now() : null,
        ]);

        ActivityLogger::log($published ? 'publish' : 'unpublish', null, [
            'module'      => 'berita',
            'description' => ($published ? 'memublikasikan berita "' : 'menarik berita "') . $news->title . '"',
            'subject'     => $news,
        ]);

        return back()
            ->with('success', $published
                ? 'Berita berhasil dipublikasikan.'
                : 'Berita ditarik dari publikasi.');
    }
}
