<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogger;
use App\Models\Announcement;
use App\Models\Department;
use App\Models\Menu;
use App\Models\News;
use App\Models\Page;
use App\Models\Tamu;
use App\Models\User;
use App\Models\WorkLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /* =========================================================
           STATISTIK — semua dari database, tanpa placeholder
           ========================================================= */

        $user = auth()->user();
        $isDepartmentAdmin = $user && $user->isDepartmentAdmin();

        // Draft gabungan dari seluruh konten (berita + pengumuman + halaman)
        $totalDraftContent = News::where('is_published', false)->count()
            + Announcement::where('is_published', false)->count()
            + Page::where('status', Page::STATUS_DRAFT)->count();

        // Statistik global untuk Super Admin / Admin tingkat atas
        $stats = [
            'total_users'     => User::count(),
            'total_pages'     => Page::count(),
            'total_news'      => News::where('is_published', true)->count(),
            'pending_content' => $totalDraftContent,
        ];

        // Jika Admin Bidang, tambahkan statistik khusus bidang
        if ($isDepartmentAdmin) {
            $departmentCode = $user->bidangCode();
            $departmentName = $user->isDepartmentAdmin() && $departmentCode
                ? Department::byCode($departmentCode)?->name
                : ucfirst($departmentCode ?? 'Bidang');

            // Nama sub-bidang dari konstanta User::SUB_DEPARTMENTS
            $subDepartmentCode = $user->subBidangId();
            $subDepartmentName = null;
            if ($departmentCode && $subDepartmentCode) {
                $subDepartmentName = User::subDepartmentLabel($departmentCode, $subDepartmentCode) ?? $subDepartmentCode;
            }

            // Statistik per bidang - hanya berita yang dibuat oleh user di bidang ini
            $bidangNewsQuery = News::where('is_published', true)
                ->whereIn('author_user_id', 
                    User::where('department_id', $user->bidangId())->pluck('id')
                );
            $bidangAnnouncementQuery = Announcement::where('is_published', true)
                ->where('department_id', $user->bidangId());
            $bidangWorkLinkQuery = WorkLink::where('is_active', true)
                ->where('department', $departmentCode);

            $stats['department_name'] = $departmentName;
            $stats['sub_department_name'] = $subDepartmentName;
            $stats['total_news_bidang'] = $bidangNewsQuery->count();
            $stats['total_announcements_bidang'] = $bidangAnnouncementQuery->count();
            $stats['total_work_links_bidang'] = $bidangWorkLinkQuery->count();
            $stats['is_department_admin'] = true;
        } else {
            $stats['is_department_admin'] = false;
        }

        /* =========================================================
           AKTIVITAS TERBARU — dari file log aktivitas (JSONL)
           ========================================================= */

        $activities = collect(ActivityLogger::readEntries(limit: 6))
            ->map(function (array $log) {
                // Pecah deskripsi "membuat berita \"Judul\"" menjadi aksi + objek
                $description = $log['description'];
                $action = $description;
                $object = '';

                if (preg_match('/^(.*?)\s*"([^"]+)"\s*$/', $description, $m)) {
                    $action = trim($m[1]);
                    $object = $m[2];
                }

                return [
                    'user'   => $log['actor_name'] ?? 'Sistem',
                    'action' => $action,
                    'object' => $object !== '' ? $object : $log['module_label'],
                    'time'   => $log['timestamp']->locale('id')->diffForHumans(),
                    'icon'   => 'fas ' . $log['action_icon'],
                    'color'  => $log['action_color'],
                ];
            })
            ->toArray();

        /* =========================================================
           KONTEN TERBARU — gabungan berita + pengumuman + halaman
           ========================================================= */

        $news = News::query()
            ->selectRaw("'Berita' as content_type, title, is_published as published, created_at")
            ->get();

        $announcements = Announcement::query()
            ->selectRaw("'Pengumuman' as content_type, title, is_published as published, created_at")
            ->get();

        $pages = Page::query()
            ->selectRaw("'Halaman' as content_type, title, status = ? as published, created_at", [Page::STATUS_PUBLISHED])
            ->get();

        $latest_content = $news->concat($announcements)->concat($pages)
            ->sortByDesc('created_at')
            ->take(5)
            ->map(fn ($item) => [
                'title'  => $item->title,
                'type'   => $item->content_type,
                'status' => $item->published ? 'Published' : 'Draft',
                'date'   => $item->created_at->locale('id')->translatedFormat('d M Y'),
            ])
            ->values()
            ->toArray();

        /* =========================================================
           NOTIFIKASI — dibangkitkan dari kondisi data saat ini
           ========================================================= */

        $notifications = $this->buildNotifications($totalDraftContent);

        /* =========================================================
           STATUS SISTEM — cek nyata: koneksi DB & ruang disk
           ========================================================= */

        $system_status = $this->buildSystemStatus();
        $storage = $this->storageSummary();

        return view('admin.dashboard', compact(
            'stats', 'activities', 'latest_content', 'notifications', 'system_status', 'storage'
        ));
    }

    /**
     * =====================================================================
     * GLOBAL SEARCH — Pencarian lintas modul dari Dashboard.
     * =====================================================================
     * GET /admin/search?q=...  (route: admin.global-search)
     *
     * Dicari sekaligus di:
     *  - User        : nama & email
     *  - News        : judul & isi
     *  - Announcement: judul & isi
     *  - Page        : judul
     *  - Menu        : label
     *  - Tamu        : nama, instansi, NIK
     *
     * Setiap baris hasil membawa URL langsung ke halaman kelola modulnya.
     * Hak akses tetap dihormati: modul tanpa permission view-nya
     * dihapuskan dari hasil (Gate::allows), mirip AdminSearchController.
     * Setiap kategori dibatasi LIMIT 8 baris + hanya kolom kecil yang
     * dipilih (tanpa fulltext / kolom panjang yang tidak perlu).
     */
    public function globalSearch(Request $request)
    {
        $request->validate(['q' => 'required|string|min:2|max:100']);

        $q      = trim($request->query('q'));
        $like   = '%' . $q . '%';
        $groups = [];

        /* -----------------------------------------------------------
           Pengguna — name / email
           ----------------------------------------------------------- */
        if (Gate::allows('users.view')) {
            $items = User::query()
                ->where(function ($w) use ($like) {
                    $w->where('name', 'like', $like)
                      ->orWhere('email', 'like', $like);
                })
                ->orderBy('name')
                ->limit(8)
                ->get(['id', 'name', 'email']);

            $groups['Pengguna'] = $items->map(fn (User $u) => [
                'title'   => $u->name,
                'meta'    => $u->email,
                'icon'    => 'fas fa-user',
                'color'   => '#dbeafe',
                'url'     => route('admin.users.show', $u),
                'cta'     => 'Lihat Pengguna',
            ])->all();
        }

        /* -----------------------------------------------------------
           Berita — judul; kolom `content` panjang hanya LIKE bila
           query tidak memuat karakter wildcard SQL ('%', '_', '\\').
           ----------------------------------------------------------- */
        if (Gate::allows('news.view')) {
            $items = News::query()
                ->where(function ($w) use ($like, $q) {
                    $w->where('title', 'like', $like);
                    if (! preg_match('/[\\%_]/u', $q)) {
                        $w->orWhere('content', 'like', $like);
                    }
                })
                ->latest()
                ->limit(8)
                ->get(['id', 'title', 'is_published']);

            $groups['Berita'] = $items->map(fn (News $n) => [
                'title'   => $n->title,
                'meta'    => $n->is_published ? 'Terbit' : 'Draft',
                'icon'    => 'fas fa-newspaper',
                'color'   => '#005B9C',
                'url'     => route('admin.news.edit', $n),
                'cta'     => 'Kelola Berita',
            ])->all();
        }

        /* -----------------------------------------------------------
           Pengumuman — judul + isi (dengan pengaman wildcart sama).
           ----------------------------------------------------------- */
        if (Gate::allows('announcements.view')) {
            $items = Announcement::query()
                ->where(function ($w) use ($like, $q) {
                    $w->where('title', 'like', $like);
                    if (! preg_match('/[\\%_]/u', $q)) {
                        $w->orWhere('content', 'like', $like);
                    }
                })
                ->latest('created_at')
                ->limit(8)
                ->get(['id', 'title', 'is_published']);

            $groups['Pengumuman'] = $items->map(fn (Announcement $a) => [
                'title'   => $a->title,
                'meta'    => $a->is_published ? 'Terbit' : 'Draft',
                'icon'    => 'fas fa-bullhorn',
                'color'   => '#166534',
                'url'     => route('admin.announcements.edit', $a),
                'cta'     => 'Kelola Pengumuman',
            ])->all();
        }

        /* -----------------------------------------------------------
           Halaman — judul.
           ----------------------------------------------------------- */
        if (Gate::allows('pages.view')) {
            $items = Page::query()
                ->where('title', 'like', $like)
                ->latest('updated_at')
                ->limit(8)
                ->get(['id', 'title', 'status']);

            $groups['Halaman'] = $items->map(fn (Page $p) => [
                'title'   => $p->title,
                'meta'    => $p->status === Page::STATUS_PUBLISHED ? 'Terbit' : 'Draft',
                'icon'    => 'fas fa-file-lines',
                'color'   => '#7c3aed',
                'url'     => route('admin.pages.edit', $p),
                'cta'     => 'Kelola Halaman',
            ])->all();
        }

        /* -----------------------------------------------------------
           Menu — label.
           ----------------------------------------------------------- */
        if (Gate::allows('menus.view')) {
            $items = Menu::query()
                ->where('label', 'like', $like)
                ->orderBy('sort_order')
                ->limit(8)
                ->get(['id', 'label', 'is_active']);

            $groups['Menu'] = $items->map(fn (Menu $m) => [
                'title'   => $m->label,
                'meta'    => $m->is_active ? 'Aktif' : 'Nonaktif',
                'icon'    => 'fas fa-bars',
                'color'   => '#7c3aed',
                'url'     => route('admin.menus.edit', $m),
                'cta'     => 'Kelola Menu',
            ])->all();
        }

        /* -----------------------------------------------------------
           Tamu (Guest Book) — nama, instansi, NIK.
           ----------------------------------------------------------- */
        if (Gate::allows('tamu.view')) {
            $items = Tamu::query()
                ->where(function ($w) use ($like) {
                    $w->where('nama', 'like', $like)
                      ->orWhere('instansi', 'like', $like)
                      ->orWhere('nik', 'like', $like);
                })
                ->orderByDesc('created_at')
                ->limit(8)
                // Kolom dipilih hanya yang dipakai (nama/instansi/tanggal).
                // TANPA status_verifikasi — kolom itu baru ditambahkan di
                // migration 2026_10_05 dan bisa belum ada di DB lokal,
                // yang memicu SQLSTATE[42S22] (Unknown column).
                ->get(['id', 'nama', 'instansi', 'tanggal_kunjungan']);

            $groups['Tamu'] = $items->map(function (Tamu $t) use ($q) {
                // Kalau yang cocok NIK, tampilkan NIK sebagai meta;
                // selain itu instansi (atau tanggal kunjungan).
                $hitInstansi = $t->instansi && str_contains(strtolower($t->instansi), strtolower($q));
                $hitNama     = $t->nama && str_contains(strtolower($t->nama), strtolower($q));

                return [
                    'title'   => $t->nama,
                    'meta'    => ($hitInstansi || ! $hitNama) && $t->instansi ? $t->instansi : ($t->tanggal_kunjungan?->translatedFormat('d M Y') ?? '-'),
                    'icon'    => 'fas fa-address-book',
                    'color'   => '#fef3c7',
                    // Modul tamu tidak punya halaman detail per baris —
                    // arahkan ke index dengan query pencarian terisi.
                    'url'     => route('admin.tamu.index', ['q' => $t->nama]),
                    'cta'     => 'Kelola Tamu',
                ];
            })->all();
        }

        return view('admin.search', [
            'q'      => $q,
            'groups' => $groups,
            'total'  => array_sum(array_map('count', $groups)),
        ]);
    }

    /**
     * Notifikasi dinamis berdasarkan kondisi data terkini.
     *
     * @return array<int, array{message: string, type: string, time: string, icon: string}>
     */
    private function buildNotifications(int $totalDraftContent): array
    {
        $notifications = [];

        if ($totalDraftContent > 0) {
            $notifications[] = [
                'message' => $totalDraftContent . ' konten masih draft',
                'type'    => 'warning',
                'time'    => 'sekarang',
                'icon'    => 'fas fa-clock',
            ];
        }

        $latestUser = User::query()->latest('created_at')->first();
        if ($latestUser && $latestUser->created_at->gt(now()->subDay())) {
            $notifications[] = [
                'message' => 'Pengguna baru terdaftar: ' . $latestUser->name,
                'type'    => 'info',
                'time'    => $latestUser->created_at->locale('id')->diffForHumans(),
                'icon'    => 'fas fa-user-plus',
            ];
        }

        if ($notifications === []) {
            $notifications[] = [
                'message' => 'Semua sistem berjalan normal, tidak ada tugas tertunda.',
                'type'    => 'success',
                'time'    => 'sekarang',
                'icon'    => 'fas fa-check-circle',
            ];
        }

        return $notifications;
    }

    /**
     * Status sistem dari pemeriksaan nyata: koneksi database
     * dan persentase pemakaian disk tempat storage aplikasi.
     *
     * @return array<int, array{name: string, status: string, icon: string, color: string}>
     */
    private function buildSystemStatus(): array
    {
        $okColor    = '#22c55e';
        $warnColor  = '#f59e0b';
        $errorColor = '#ef4444';

        // Database: koneksi + query sederhana
        try {
            DB::select('select 1');
            $dbStatus = ['status' => 'Normal', 'color' => $okColor];
        } catch (\Throwable) {
            $dbStatus = ['status' => 'Error', 'color' => $errorColor];
        }

        // Application: aplikasi merender halaman ini berarti berjalan
        $appStatus = ['status' => 'Normal', 'color' => $okColor];

        // Storage: persentase pemakaian disk (Warning bila >= 80%)
        $storagePercent = $this->diskUsagePercent();
        if ($storagePercent === null) {
            $storageStatus = ['status' => 'Normal', 'color' => $okColor];
        } else {
            $storageStatus = $storagePercent >= 80
                ? ['status' => 'Warning', 'color' => $warnColor]
                : ['status' => 'Normal', 'color' => $okColor];
        }

        return [
            ['name' => 'Database',    'status' => $dbStatus['status'],     'icon' => 'fas fa-database',   'color' => $dbStatus['color']],
            ['name' => 'Application', 'status' => $appStatus['status'],    'icon' => 'fas fa-server',     'color' => $appStatus['color']],
            ['name' => 'Storage',     'status' => $storageStatus['status'],'icon' => 'fas fa-hard-drive', 'color' => $storageStatus['color']],
        ];
    }

    /**
     * Persentase pemakaian disk tempat penyimpanan aplikasi,
     * atau null bila tidak dapat dihitung (mis. driver terbatas).
     */
    private function diskUsagePercent(): ?float
    {
        $path = storage_path();

        $total = @disk_total_space($path);
        $free  = @disk_free_space($path);

        if ($total === false || $free === false || $total <= 0) {
            return null;
        }

        $used = $total - $free;

        return round(($used / $total) * 100, 1);
    }

    /**
     * Ringkasan storage untuk progress bar dashboard:
     * persen + kapasitas dalam format ramah (GB).
     */
    private function storageSummary(): ?array
    {
        $path = storage_path();

        $totalBytes = @disk_total_space($path);
        $freeBytes  = @disk_free_space($path);

        if ($totalBytes === false || $freeBytes === false || $totalBytes <= 0) {
            return null;
        }

        $usedBytes = $totalBytes - $freeBytes;

        return [
            'percent' => round(($usedBytes / $totalBytes) * 100, 1),
            'used'    => $this->formatBytes($usedBytes),
            'free'    => $this->formatBytes($freeBytes),
            'total'   => $this->formatBytes($totalBytes),
        ];
    }

    /**
     * Format jumlah byte menjadi string ramah manusia (GB/MB).
     */
    private function formatBytes(float|int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i = 0;

        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 1) . ' ' . $units[$i];
    }
}
