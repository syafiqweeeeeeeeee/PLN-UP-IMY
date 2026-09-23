<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\News;
use App\Services\PortalContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Portal Karyawan (Employee Portal) — area internal yang terpisah
 * dari panel admin. Seluruh halaman konten bersifat view-only;
 * satu-satunya aksi tulis adalah memperbarui profil sendiri.
 */
class PortalController extends Controller
{
    /**
     * Dashboard portal: ringkasan pengumuman, layanan, dan link kerja.
     * Semua data ter-scope sesuai Hirarki Organisasi user yang login
     * (level jabatan / bidang / sub-bidang).
     */
    public function dashboard(): View
    {
        $user = auth()->user();

        return view('karyawan.dashboard', [
            'user'             => $user,
            'announcements'    => $this->publishedAnnouncements(3),
            'news'             => $this->publishedNews(3),
            'totalInformasi'   => $this->publishedAnnouncements()->count() + $this->publishedNews()->count(),
            'internalServices' => PortalContentService::internalServicesFor($user),
            'workLinks'        => PortalContentService::workLinksFor($user),
            'linkFilters'      => PortalContentService::linkFilters(),
        ]);
    }

    /**
     * Tab Informasi: pengumuman + berita internal (view only).
     */
    public function informasi(): View
    {
        return view('karyawan.informasi', [
            'announcements' => $this->publishedAnnouncements(6),
            'news'          => $this->publishedNews(6),
        ]);
    }

    /**
     * Detail satu informasi (berita / pengumuman internal).
     */
    public function informasiDetail(string $type, string $slug): View
    {
        abort_unless(in_array($type, ['berita', 'pengumuman'], true), 404);

        $item = $type === 'berita'
            ? News::where('slug', $slug)->where('is_published', true)->firstOrFail()
            : Announcement::where('slug', $slug)->where('is_published', true)->firstOrFail();

        $terkait = collect();

        if ($type === 'berita') {
            $terkait = News::where('is_published', true)
                ->where('id', '!=', $item->id)
                ->latest('published_at')
                ->take(3)
                ->get()
                ->map(fn ($n) => ['type' => 'berita', 'model' => $n]);
        } else {
            $terkait = Announcement::where('is_published', true)
                ->where('id', '!=', $item->id)
                ->latest('published_at')
                ->take(3)
                ->get()
                ->map(fn ($a) => ['type' => 'pengumuman', 'model' => $a]);
        }

        return view('karyawan.informasi_detail', [
            'item'    => $item,
            'type'    => $type,
            'terkait' => $terkait,
        ]);
    }

    /**
     * Tab Layanan: grid layanan internal (view only), ter-scope hierarki user.
     */
    public function layanan(): View
    {
        return view('karyawan.layanan', [
            'services' => PortalContentService::internalServicesFor(auth()->user()),
        ]);
    }

    /**
     * Detail prosedur satu layanan internal.
     */
    public function layananDetail(string $slug): View
    {
        $user    = auth()->user();
        $service = collect(PortalContentService::internalServicesFor($user))
            ->firstWhere('slug', $slug);

        // Layanan di luar scope hierarki user → 404.
        abort_if($service === null, 404);

        return view('karyawan.layanan_detail', [
            'service' => $service,
            'others'  => collect(PortalContentService::internalServicesFor($user))
                ->reject(fn ($s) => $s['slug'] === $slug)
                ->values(),
        ]);
    }

    /**
     * Tab Link: direktori tautan alat kerja + filter kategori.
     * Link ter-filter sesuai Hirarki Organisasi user; filter UI
     * (tabs) di-layout sesuai level: Manager/Senior Manager dapat
     * beralih antar sub-bidang, Staf/Asmen terkunci di bagiannya.
     */
    public function link(): View
    {
        $user = auth()->user();

        return view('karyawan.link', [
            'links'      => PortalContentService::workLinksFor($user),
            'filters'    => PortalContentService::linkFiltersFor($user),
            'linkAccess' => PortalContentService::linkAccessFor($user),
            'authUser'   => $user,
        ]);
    }

    /**
     * Halaman profil karyawan yang sedang login.
     */
    public function profil(): View
    {
        return view('karyawan.profil', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Perbarui profil karyawan sendiri (nama, no HP, alamat, password).
     */
    public function updateProfil(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'no_hp'    => ['nullable', 'string', 'max:20'],
            'alamat'   => ['nullable', 'string', 'max:500'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $data = [
            'name'   => $validated['name'],
            'no_hp'  => $validated['no_hp'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
        ];

        if (! empty($validated['password'])) {
            // Karyawan wajib memasukkan password lama yang benar.
            $request->validate([
                'current_password' => ['required', 'current_password:web'],
            ], [
                'current_password.current_password' => 'Password saat ini tidak sesuai.',
            ]);

            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()
            ->route('karyawan.profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Pengumuman terbit, terbaru lebih dulu.
     */
    private function publishedAnnouncements(int $limit = -1)
    {
        $query = Announcement::where('is_published', true)->latest('published_at');

        return $limit > 0 ? $query->take($limit)->get() : $query->get();
    }

    /**
     * Berita terbit, terbaru lebih dulu.
     */
    private function publishedNews(int $limit = -1)
    {
        $query = News::where('is_published', true)->latest('published_at');

        return $limit > 0 ? $query->take($limit)->get() : $query->get();
    }
}
