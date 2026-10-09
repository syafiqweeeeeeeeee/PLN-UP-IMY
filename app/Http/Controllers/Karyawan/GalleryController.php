<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

/**
 * Pengelolaan Galeri dari KONTEKS PORTAL KARYAWAN.
 *
 * Logic/backend (validasi, upload, toggle status) mengikuti
 * Admin\GalleryController — perbedaannya hanya tampilan: view
 * `karyawan.galeri.*` memakai layout Portal Karyawan (layouts.karyawan).
 */
class GalleryController extends Controller
{
    public function index()
    {
        Gate::authorize('galleries.view');

        $galleries = Gallery::query()
            ->latest('tanggal_kegiatan')
            ->orderByDesc('id')
            ->paginate(12);

        return view('karyawan.galeri.index', compact('galleries'));
    }

    public function create()
    {
        Gate::authorize('galleries.create');

        return view('karyawan.galeri.form', [
            'gallery'     => null,
            'categories'  => Gallery::CATEGORIES,
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('galleries.create');

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

        ActivityLogger::log('create', null, [
            'module'      => 'galeri',
            'description' => "menambahkan foto galeri \"{$gallery->judul}\" (Portal Karyawan)",
            'subject'     => $gallery,
        ]);

        return redirect()->route('karyawan.galeri.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $galeri)
    {
        Gate::authorize('galleries.edit');

        return view('karyawan.galeri.form', [
            'gallery'    => $galeri,
            'categories' => Gallery::CATEGORIES,
        ]);
    }

    /**
     * Update galeri.
     * - Gambar nullable: hanya jika ada upload baru, file lama dihapus dari
     *   storage lalu path di DB diganti.
     * - Tanpa upload baru: gambar lama dipertahankan.
     */
    public function update(Request $request, Gallery $galeri)
    {
        Gate::authorize('galleries.edit');

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
            if (!empty($galeri->file_gambar) && Storage::disk('public')->exists($galeri->file_gambar)) {
                Storage::disk('public')->delete($galeri->file_gambar);
            }

            $validated['file_gambar'] = $request->file('file_gambar')->store('galeri', 'public');
        }

        $galeri->update($validated);

        ActivityLogger::log('update', null, [
            'module'      => 'galeri',
            'description' => "mengubah foto galeri \"{$galeri->judul}\" (Portal Karyawan)",
            'subject'     => $galeri,
        ]);

        return redirect()->route('karyawan.galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    /**
     * Quick toggle status publikasi <-> draft tanpa membuka form edit.
     */
    public function toggleStatus(Gallery $galeri)
    {
        Gate::authorize('galleries.edit');

        $newStatus = $galeri->status === 'publikasi' ? 'draft' : 'publikasi';

        $galeri->update(['status' => $newStatus]);

        ActivityLogger::log($newStatus === 'publikasi' ? 'publish' : 'unpublish', null, [
            'module'      => 'galeri',
            'description' => ($newStatus === 'publikasi' ? 'memublikasikan foto galeri "' : 'menarik foto galeri "') . $galeri->judul . '" (Portal Karyawan)',
            'subject'     => $galeri,
        ]);

        return redirect()->route('karyawan.galeri.index')
            ->with('success', $newStatus === 'publikasi'
                ? 'Foto galeri berhasil dipublikasikan.'
                : 'Foto galeri ditarik menjadi draft.');
    }

    /**
     * Hapus galeri: file foto dihapus dari storage fisik, record dari DB.
     */
    public function destroy(Gallery $galeri)
    {
        Gate::authorize('galleries.delete');

        ActivityLogger::log('delete', null, [
            'module'      => 'galeri',
            'description' => "menghapus foto galeri \"{$galeri->judul}\" (Portal Karyawan)",
            'subject'     => $galeri,
        ]);

        if (!empty($galeri->file_gambar) && Storage::disk('public')->exists($galeri->file_gambar)) {
            Storage::disk('public')->delete($galeri->file_gambar);
        }

        $galeri->delete();

        return redirect()->route('karyawan.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
