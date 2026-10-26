<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\News;
use App\Models\Tamu;
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
            // Dashboard menampilkan campuran seimbang Umum + Khusus sub-bidang;
            // "Lihat Semua" (halaman Link) tetap memakai workLinksFor() lengkap.
            'workLinks'        => PortalContentService::workLinksBalancedFor($user),
            'workLinkTotal'    => PortalContentService::workLinkTotalFor($user),
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
            ? News::where('slug', $slug)->where('is_published', true)->forPortal()->firstOrFail()
            : Announcement::where('slug', $slug)->where('is_published', true)->forPortal()->firstOrFail();

        $terkait = collect();

        if ($type === 'berita') {
            $terkait = News::where('is_published', true)
                ->forPortal()
                ->where('id', '!=', $item->id)
                ->latest('published_at')
                ->take(3)
                ->get()
                ->map(fn ($n) => ['type' => 'berita', 'model' => $n]);
        } else {
            $terkait = Announcement::where('is_published', true)
                ->forPortal()
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
     * KUNJUNGAN TAMU (khusus Portal Karyawan)
     * ---------------------------------------------------------
     * Daftar registrasi tamu dari form publik /layanan/form-registrasi-tamu
     * yang MENYEBUT akun ini sebagai "Orang yang Ditemui"
     * (`tamus.orang_ditemui` = nama akun login).
     *
     * SCOPING ketat per akun — dibandingkan case-insensitive + trim
     * (nama dari dropdown registrasi diambil langsung dari kolom
     * users.name, tapi input teks bebas bisa beda kapital/spasi).
     * Akun lain (termasuk Super Admin) TIDAK lewat halaman ini:
     * Super Admin melihat seluruh data lewat panel admin
     * (admin.tamu.index) yang sudah ada.
     *
     * View-only mengikuti aturan portal karyawan: tanpa aksi verifikasi
     * / edit / hapus — cukup filter + baca detail & tautan WA/dokumen.
     */
    public function kunjunganTamu(Request $request): View
    {
        $user = auth()->user();

        // Basis scoping: tamu yang menunjuk nama akun ini.
        $scoped = fn () => Tamu::query()->whereRaw(
            'LOWER(TRIM(orang_ditemui)) = ?',
            [mb_strtolower(trim((string) $user->name))]
        );

        // Statistik dari basis scoping (tanpa filter halaman ini).
        $stats = [
            'total'    => $scoped()->count(),
            'menunggu' => (clone $scoped())->where('status_verifikasi', Tamu::STATUS_MENUNGGU)->count(),
            'disetujui'=> (clone $scoped())->where('status_verifikasi', Tamu::STATUS_DISETUJUI)->count(),
            'ditolak'  => (clone $scoped())->where('status_verifikasi', Tamu::STATUS_DITOLAK)->count(),
        ];

        // Daftar + filter (reuse scope search/tanggalAntara/status model).
        $tamus = $scoped()
            ->search($request->query('q'))
            ->tanggalAntara($request->query('dari'), $request->query('sampai'))
            ->status($request->query('status'))
            ->orderByDesc('tanggal_kunjungan')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('karyawan.kunjungan-tamu', [
            'user'  => $user,
            'tamus' => $tamus,
            'stats' => $stats,
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
            'no_hp'    => ['required', 'string', 'max:20'],
            'alamat'   => ['required', 'string', 'max:500'],
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
     * Pengumuman terbit yang ditujukan ke Portal Karyawan
     * (target 'portal' atau 'all'), terbaru lebih dulu.
     */
    private function publishedAnnouncements(int $limit = -1)
    {
        $query = Announcement::where('is_published', true)
            ->forPortal()
            ->latest('published_at');

        return $limit > 0 ? $query->take($limit)->get() : $query->get();
    }

    /**
     * Berita terbit yang ditujukan ke Portal Karyawan
     * (target 'portal' atau 'all'), terbaru lebih dulu.
     */
    private function publishedNews(int $limit = -1)
    {
        $query = News::where('is_published', true)
            ->forPortal()
            ->latest('published_at');

        return $limit > 0 ? $query->take($limit)->get() : $query->get();
    }
}
