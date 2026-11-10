<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Concerns\VerifiesTamu;
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
 * dari panel admin. Halaman kontens bersifat view-only; aksi tulis:
 * memperbarui profil sendiri + verifikasi kunjungan tamu yang
 * menunjuk akun ini (sekali pakai, lihat trait VerifiesTamu).
 */
class PortalController extends Controller
{
    use VerifiesTamu;

    /** Route tujuan setelah keputusan verifikasi di halaman Kunjungan Tamu. */
    protected function verifikasiRedirectRoute(): string
    {
        return 'karyawan.kunjungan-tamu';
    }

    /**
     * Batas aksi verifikasi di Portal Karyawan: hanya tamu yang MENUNJUK
     * AKUN ini sebagai "Orang yang Ditemui".
     *
     * Perbandingan memakai users.id (kolom orang_ditemui_user_id), BUKAN
     * nama teks: nama profil bisa diubah pemilik akun, sehingga pencocokan
     * nama dahulu bisa dipakai untuk mengambil alih kunjungan orang lain.
     */
    protected function bolehVerifikasi(Request $request, Tamu $tamu): bool
    {
        $user = $request->user();

        if ($user === null || $tamu->orang_ditemui_user_id === null) {
            return false;
        }

        return (int) $tamu->orang_ditemui_user_id === (int) $user->id;
    }

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
     * yang MENUNJUK AKUN ini sebagai "Orang yang Ditemui" — dipetakan
     * sekali saat pendaftaran ke `tamus.orang_ditemui_user_id`.
     *
     * SCOPING ketat per AKUN (users.id), bukan nama teks: nama profil bisa
     * diubah sendiri oleh karyawan, sehingga pencocokan nama tidak lagi
     * dipakai sebagai dasar otorisasi. Akun lain (termasuk Super Admin)
     * TIDAK lewat halaman ini:
     * Super Admin melihat seluruh data lewat panel admin
     * (admin.tamu.index) yang sudah ada.
     *
     * Aksi tulis HALAMAN INI hanya SATU: verifikasi (Setujui / Batalkan)
     * kunjungan yang menunjuk akun ini — hanya boleh dilakukan sekali,
     * dilakukan lewat route karyawan.kunjungan-tamu.verifikasi (tanpa
     * permission khusus; izin dijaga scoping nama akun + guard status
     * "menunggu" di trait VerifiesTamu).
     */
    public function kunjunganTamu(Request $request): View
    {
        $user = auth()->user();

        // Basis scoping: tamu yang menautkan AKUN ini sebagai orang
        // yang ditemui (kolom relasi, bukan nama teks).
        $scoped = fn () => Tamu::query()->where('orang_ditemui_user_id', $user->id);

        // Statistik dengan SATU query agregat (bukan 4 query COUNT
        // terpisah) — hemat koneksi DB per render halaman.
        $statRow = Tamu::query()
            ->where('orang_ditemui_user_id', $user->id)
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("COALESCE(SUM(status_verifikasi = ?), 0) as menunggu", [Tamu::STATUS_MENUNGGU])
            ->selectRaw("COALESCE(SUM(status_verifikasi = ?), 0) as disetujui", [Tamu::STATUS_DISETUJUI])
            ->selectRaw("COALESCE(SUM(status_verifikasi = ?), 0) as ditolak", [Tamu::STATUS_DITOLAK])
            ->first();

        $stats = [
            'total'    => (int) $statRow->total,
            'menunggu' => (int) $statRow->menunggu,
            'disetujui'=> (int) $statRow->disetujui,
            'ditolak'  => (int) $statRow->ditolak,
        ];

        // Daftar + filter tanggal/status (TANPA search — fitur pencarian
        // dihapus agar tidak membebani DB dengan LIKE per render).
        $tamus = $scoped()
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
