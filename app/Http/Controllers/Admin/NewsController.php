<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(12);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.form', [
            'news' => null,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => ['required', 'string', 'max:255'],
            'category'  => ['required', 'in:umum,teknis,kegiatan,kepegawaian'],
            'excerpt'   => ['required', 'string', 'max:1000'],
            'content'   => ['nullable', 'string'],
            'image'     => ['required', 'image', 'max:5120'],
            'author'    => ['nullable', 'string', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $imagePath = $request->file('image')?->store('news', 'public');

        $validated['slug'] = News::generateSlug($validated['title']);
        $validated['image'] = $imagePath;
        $validated['is_published'] = !empty($validated['is_published']);
        $validated['author_user_id'] = auth()->id();

        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dibuat.');
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('admin.news.form', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title'     => ['required', 'string', 'max:255'],
            'category'  => ['required', 'in:umum,teknis,kegiatan,kepegawaian'],
            'excerpt'   => ['required', 'string', 'max:1000'],
            'content'   => ['nullable', 'string'],
            'image'     => ['nullable', 'image', 'max:5120'],
            'author'    => ['nullable', 'string', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $validated['is_published'] = !empty($validated['is_published']);

        // Auto update slug hanya jika judul berubah
        if ($news->title !== $validated['title']) {
            $validated['slug'] = News::generateSlug($validated['title']);
        }

        if ($validated['is_published'] && !$news->is_published) {
            $validated['published_at'] = now();
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    public function togglePublish(News $news)
    {
        $published = $news->is_published ? false : true;

        $news->update([
            'is_published' => $published,
            'published_at' => $published ? now() : null,
        ]);

        return back()
            ->with('success', $published
                ? 'Berita berhasil dipublikasikan.'
                : 'Berita ditarik dari publikasi.');
    }
}
