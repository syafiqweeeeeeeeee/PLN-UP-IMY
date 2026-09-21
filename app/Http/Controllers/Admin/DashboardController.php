<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogger;
use App\Models\Announcement;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        // Draft gabungan dari seluruh konten (berita + pengumuman + halaman)
        $totalDraftContent = News::where('is_published', false)->count()
            + Announcement::where('is_published', false)->count()
            + Page::where('status', Page::STATUS_DRAFT)->count();

        $stats = [
            'total_users'     => User::count(),
            'total_pages'     => Page::count(),
            'total_news'      => News::where('is_published', true)->count(),
            'pending_content' => $totalDraftContent,
        ];

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
