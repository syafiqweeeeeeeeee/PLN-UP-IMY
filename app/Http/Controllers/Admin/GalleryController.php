<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Daftar galeri (admin) dengan pagination + filter kategori & status.
     */
    public function index(Request $request)
    {
        $query = Gallery::query();

        if (in_array($request->query('kategori'), Gallery::CATEGORIES, true)) {
            $query->where('kategori', $request->query('kategori'));
        }

        if (in_array($request->query('status'), ['publikasi', 'draft'], true)) {
            $query->where('status', $request->query('status'));
        }

        if ($search = trim((string) $request->query('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $galleries = $query->latest('tanggal_kegiatan')
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return view('admin.galeri.index', compact('galleries'));
    }

    /**
     * Form tambah galeri.
     */
    public function create()
    {
        return view('admin.galeri.create', [
            'gallery' => null,
            'categories' => Gallery::CATEGORIES,
        ]);
    }

    /**
     * Simpan galeri baru beserta file gambarnya.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'            => ['required', 'string', 'max:255'],
            'kategori'         => ['required', 'in:' . implode(',', Gallery::CATEGORIES)],
            'deskripsi'        => ['nullable', 'string', 'max:2000'],
            'file_gambar'      => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:5120'],
            'tanggal_kegiatan' => ['required', 'date', 'before_or_equal:today'],
            'status'           => ['required', 'in:publikasi,draft'],
        ], [
            'file_gambar.required' => 'Gambar wajib diunggah.',
            'file_gambar.image'    => 'File harus berupa gambar.',
            'file_gambar.mimes'    => 'Format gambar harus PNG, JPG, atau JPEG.',
            'file_gambar.max'      => 'Ukuran gambar maksimal 5MB.',
            'tanggal_kegiatan.before_or_equal' => 'Tanggal kegiatan tidak boleh di masa depan.',
        ]);

        $validated['file_gambar'] = $request->file('file_gambar')->store('galeri', 'public');

        $gallery = Gallery::create($validated);

        ActivityLog::record('galeri', 'create', "menambahkan foto galeri \"{$gallery->judul}\"", $gallery);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    /**
     * Form edit galeri — ambil data berdasarkan ID, tampilkan view edit.
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('admin.galeri.edit', [
            'gallery' => $gallery,
            'categories' => Gallery::CATEGORIES,
        ]);
    }

    /**
     * Update galeri berdasarkan ID.
     * - Gambar nullable: hanya jika ada upload baru, file lama dihapus dari
     *   storage (dengan pengecekan keberadaan file) lalu path di DB diganti.
     * - Tanpa upload baru: gambar lama dipertahankan.
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $validated = $request->validate([
            'judul'            => ['required', 'string', 'max:255'],
            'kategori'         => ['required', 'in:' . implode(',', Gallery::CATEGORIES)],
            'deskripsi'        => ['nullable', 'string', 'max:2000'],
            'file_gambar'      => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:5120'],
            'tanggal_kegiatan' => ['required', 'date', 'before_or_equal:today'],
            'status'           => ['required', 'in:publikasi,draft'],
        ], [
            'file_gambar.image' => 'File harus berupa gambar.',
            'file_gambar.mimes' => 'Format gambar harus PNG, JPG, atau JPEG.',
            'file_gambar.max'   => 'Ukuran gambar maksimal 5MB.',
            'tanggal_kegiatan.before_or_equal' => 'Tanggal kegiatan tidak boleh di masa depan.',
        ]);

        if ($request->hasFile('file_gambar')) {
            // Hapus gambar lama dari storage/app/public/galeri/... (jika ada)
            if (!empty($gallery->file_gambar) && Storage::disk('public')->exists($gallery->file_gambar)) {
                Storage::disk('public')->delete($gallery->file_gambar);
            }

            // Simpan gambar baru + update path di database
            $validated['file_gambar'] = $request->file('file_gambar')->store('galeri', 'public');
        }
        // Tanpa upload baru → $validated tidak berisi file_gambar → gambar lama dipertahankan

        $gallery->update($validated);

        ActivityLog::record('galeri', 'update', "mengubah foto galeri \"{$gallery->judul}\"", $gallery);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    /**
     * Quick Toggle status publikasi <-> draft tanpa membuka form edit.
     */
    public function toggleStatus($id)
    {
        $gallery = Gallery::findOrFail($id);

        $newStatus = $gallery->status === 'publikasi' ? 'draft' : 'publikasi';

        $gallery->update(['status' => $newStatus]);

        ActivityLog::record(
            'galeri',
            $newStatus === 'publikasi' ? 'publish' : 'unpublish',
            ($newStatus === 'publikasi' ? 'memublikasikan foto galeri "' : 'menarik foto galeri "') . $gallery->judul . '"',
            $gallery
        );

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', $newStatus === 'publikasi'
                ? 'Foto galeri berhasil dipublikasikan.'
                : 'Foto galeri ditarik menjadi draft.');
    }

    /**
     * Hapus galeri: file foto dihapus dari storage fisik,
     * record dihapus dari database, lalu redirect + flash sukses.
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        ActivityLog::record('galeri', 'delete', "menghapus foto galeri \"{$gallery->judul}\"", $gallery);

        if (!empty($gallery->file_gambar) && Storage::disk('public')->exists($gallery->file_gambar)) {
            Storage::disk('public')->delete($gallery->file_gambar);
        }

        $gallery->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
