<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Logger aktivitas admin berbasis FILE (JSONL) — pengganti tabel
 * `activity_logs` di database.
 *
 * Aturan file:
 * - Satu file per hari: activity-YYYY-MM-DD.jsonl (JSON Lines, satu
 *   objek JSON per baris, newline-separated).
 * - Maksimal MAX_LINES (3000) baris per file. Jika penuh, lanjut ke
 *   chunk berikutnya pada hari yang sama: activity-YYYY-MM-DD-part2.jsonl
 *   (lalu -part3, dst.).
 *
 * Struktur satu baris log (JSON):
 * {
 *   "id":         "<uuid>",
 *   "timestamp":  "2026-09-21T12:34:56.000000Z",   (ISO 8601 UTC)
 *   "event_type": "create",                        (create/update/delete/...)
 *   "module":     "berita",                        (modul — untuk filter UI)
 *   "actor":      {"id":1,"name":"Budi","email":"b@x.id","role":"Administrator"},
 *   "context":    {"ip":"127.0.0.1","user_agent":"..."},
 *   "payload":    {"description":"membuat berita \"...\"","module_label":"Berita",
 *                  "subject_type":"...","subject_id":3, ...}
 * }
 *
 * Disk yang dipakai: disk "activity" (config/filesystems.php) yang root-nya
 * storage/logs — sehingga Storage::fake('activity') di test mengisolasi
 * seluruh log aktivitas dari storage development.
 */
class ActivityLogger
{
    /** Batas maksimal baris per file log harian. */
    public const MAX_LINES = 3000;

    /** Nama disk (config/filesystems.php) tempat file log disimpan. */
    public const DISK = 'activity';

    /* =========================================================
       PENCATATAN
       ========================================================= */

    /**
     * Catat satu aktivitas ke file JSONL hari ini.
     *
     * Logging tidak boleh menggagalkan alur utama (mis. login), jadi
     * semua kegagalan ditelan + direport, mengikuti perilaku lama
     * ActivityLog::record().
     *
     * @param  array<string, mixed>  $payload  Detail aktivitas. Kunci yang
     *                                         dikenali: description, subject,
     *                                         sisanya diteruskan apa adanya.
     */
    public static function log(string $eventType, ?User $actor = null, array $payload = []): void
    {
        try {
            $actor ??= auth()->user();

            $subject = $payload['subject'] ?? null;
            unset($payload['subject']);

            $entry = [
                'id'         => (string) Str::uuid(),
                'timestamp'  => Carbon::now('UTC')->toISOString(),
                'event_type' => $eventType,
                'module'     => $payload['module'] ?? 'sistem',
                'actor'      => [
                    'id'    => $actor?->id,
                    'name'  => $actor?->name ?? 'Sistem',
                    'email' => $actor?->email,
                    'role'  => $actor?->role,
                ],
                'context'    => [
                    'ip'         => request()?->ip(),
                    'user_agent' => Str::limit((string) request()?->userAgent(), 500, ''),
                ],
                'payload'    => $payload + [
                    'module_label' => static::moduleLabel($payload['module'] ?? 'sistem'),
                ],
            ];

            if ($subject instanceof \Illuminate\Database\Eloquent\Model) {
                $entry['payload']['subject_type'] = $subject::class;
                $entry['payload']['subject_id'] = $subject->getKey();
            }

            static::appendLine(
                static::filePathFor(Carbon::now()),
                json_encode($entry, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
            );
        } catch (\Throwable $e) {
            report($e);
        }
    }

    /**
     * Tulis satu baris JSONL ke file, dengan enforcement batas
     * MAX_LINES baris per file: jika file sudah penuh, lanjut ke
     * chunk berikutnya (activity-...-partN.jsonl).
     */
    /** Cache penghitung baris per path (per proses PHP) — menghindari
     * pembacaan ulang seluruh file pada setiap append (O(n²)).
     *
     * @var array<string, int>
     */
    protected static array $lineCounts = [];

    /** Tulis satu baris JSONL ke file, dengan enforcement batas
     * MAX_LINES baris per file: jika file sudah penuh, lanjut ke
     * chunk berikutnya (activity-...-partN.jsonl).
     */
    protected static function appendLine(string $basePath, string $json): void
    {
        $disk = static::disk();

        // Cari chunk terakhir yang masih di bawah batas. Jumlah baris
        // di-cache setelah pembacaan pertama, lalu di-increment lokal.
        $path = $basePath;
        $part = 1;
        while (true) {
            if (! array_key_exists($path, static::$lineCounts)) {
                static::$lineCounts[$path] = $disk->exists($path)
                    ? static::countLines($disk->get($path))
                    : 0;
            }

            if (static::$lineCounts[$path] < static::MAX_LINES) {
                break;
            }

            $part++;
            $path = static::chunkPath($basePath, $part);
        }

        $disk->append($path, $json);
        static::$lineCounts[$path]++;
    }

    /**
     * Kosongkan cache penghitung baris — WAJIB dipanggil di awal
     * test (setelah Storage::fake) dan aman dipanggil kapan pun
     * file log diubah di luar ActivityLogger.
     */
    public static function flushLineCache(): void
    {
        static::$lineCounts = [];
    }

    /**
     * Tulis satu entri ARRAY (sudah berbentuk struktur log) ke file
     * dengan enforcement batas MAX_LINES. Public: dipakai command
     * migrasi DB→file yang perlu timestamp kustom per baris.
     *
     * @param  array<string, mixed>  $entry
     */
    public static function appendEntry(string $basePath, array $entry): void
    {
        static::appendLine($basePath, json_encode($entry, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }

    /* =========================================================
       PEMBACAAN & KELOMPOKKAN
       ========================================================= */

    /**
     * Baca log dari file harian, urut terbaru → terlama, dan
     * kelompokkan per tanggal untuk header UI harian.
     *
     * @param  int         $daysLimit  Rentang hari yang discan (mis. 7).
     * @param  string|null $search     Filter nama/email actor (contains, case-insensitive).
     * @param  string|null $eventType  Filter event_type persis (mis. "delete").
     * @param  int|null    $limit      Batas jumlah entri (null = semua).
     * @return array{
     *   groups: array<int, array{key: string, label: string, entries: array<int, array<string, mixed>>}>,
     *   total: int
     * }
     */
    public static function getGroupedLogs(int $daysLimit = 7, ?string $search = null, ?string $eventType = null, ?int $limit = null): array
    {
        $entries = static::readEntries(now()->subDays(max($daysLimit, 1) - 1)->startOfDay(), $search, $eventType, $limit);

        $groups = [];
        foreach ($entries as $entry) {
            $key = Carbon::parse($entry['timestamp'])->format('Y-m-d');

            $groups[$key] ??= [
                'key'     => $key,
                'label'   => static::dayHeader(Carbon::parse($entry['timestamp'])),
                'entries' => [],
            ];
            $groups[$key]['entries'][] = $entry;
        }

        return ['groups' => array_values($groups), 'total' => count($entries)];
    }

    /**
     * Baca entri log (tanpa grouping) — dipakai dashboard & pencarian.
     * Urutan: terbaru → terlama (file terbaru dulu, baris dibalik).
     *
     * @return array<int, array<string, mixed>>
     */
    public static function readEntries(?Carbon $since = null, ?string $search = null, ?string $eventType = null, ?int $limit = null): array
    {
        $disk = static::disk();

        // Nama file mengandung tanggal → urut nama = urut kronologis.
        // rsort: terbaru dulu.
        $files = collect($disk->files('/'))
            ->filter(fn (string $f) => static::isActivityFile($f))
            ->filter(function (string $f) use ($since) {
                if ($since === null) {
                    return true;
                }

                return Carbon::parse(static::fileDate($f))->startOfDay()->gte($since->startOfDay());
            })
            ->sort()
            ->reverse()
            ->values();

        $entries = [];
        foreach ($files as $file) {
            $lines = preg_split('/\r\n|\r|\n/', trim((string) $disk->get($file))) ?: [];
            $lines = array_values(array_filter($lines, fn (string $l) => trim($l) !== ''));

            // Baris paling baru ada di bawah file → reverse.
            foreach (array_reverse($lines) as $line) {
                $entry = json_decode($line, true);

                if (! is_array($entry) || ! isset($entry['timestamp'])) {
                    continue; // baris korup — lewati
                }

                if ($eventType !== null && ($entry['event_type'] ?? null) !== $eventType) {
                    continue;
                }

                if ($search !== null && $search !== '') {
                    $actorName = mb_strtolower((string) ($entry['actor']['name'] ?? ''));
                    $actorEmail = mb_strtolower((string) ($entry['actor']['email'] ?? ''));
                    $needle = mb_strtolower($search);

                    if (! str_contains($actorName, $needle) && ! str_contains($actorEmail, $needle)) {
                        continue;
                    }
                }

                $entries[] = static::hydrate($entry, $file);

                if ($limit !== null && count($entries) >= $limit) {
                    return $entries;
                }
            }
        }

        return $entries;
    }

    /**
     * Normalisasi entri mentah dari file ke bentuk siap-render Blade:
     * label aksi/modul, warna & ikon (mewarisi palet lama), dan
     * Carbon timestamp.
     *
     * @param  array<string, mixed>  $entry
     * @return array<string, mixed>
     */
    protected static function hydrate(array $entry, string $file): array
    {
        $eventType = (string) ($entry['event_type'] ?? '');
        $module = (string) ($entry['module'] ?? '');

        return [
            'id'          => $entry['id'] ?? (string) Str::uuid(),
            'file'        => $file,
            'event_type'  => $eventType,
            'module'      => $module,
            'timestamp'   => Carbon::parse($entry['timestamp']),
            'actor'       => $entry['actor'] ?? [],
            'actor_name'  => $entry['actor']['name'] ?? 'Sistem',
            'actor_role'  => $entry['actor']['role'] ?? '',
            'actor_email' => $entry['actor']['email'] ?? '',
            'ip'          => $entry['context']['ip'] ?? '',
            'user_agent'  => $entry['context']['user_agent'] ?? '',
            'payload'     => $entry['payload'] ?? [],
            'description' => $entry['payload']['description'] ?? '',
            'module_label' => static::moduleLabel($module),
            'action_label' => static::actionLabel($eventType),
            'action_color' => static::actionColors()[$eventType]['color'] ?? '#64748b',
            'action_icon'  => static::actionColors()[$eventType]['icon'] ?? 'fa-circle-info',
        ];
    }

    /**
     * Header grup harian untuk UI, gaya:
     * "Today - Monday, September 21, 2026" / "Yesterday - ..." /
     * "Monday, September 14, 2026".
     */
    public static function dayHeader(Carbon $date): string
    {
        $english = $date->copy()->locale('en')->translatedFormat('l, F j, Y');

        if ($date->isToday()) {
            return 'Today - ' . $english;
        }

        if ($date->isYesterday()) {
            return 'Yesterday - ' . $english;
        }

        return $english;
    }

    /* =========================================================
       PENGHAPUSAN
       ========================================================= */

    /**
     * Hapus satu entri log berdasarkan id (UUID), mencari di semua
     * file log. Mengembalikan true jika baris ditemukan & dihapus.
     */
    public static function deleteEntry(string $id): bool
    {
        $disk = static::disk();

        foreach (static::activityFiles() as $file) {
            $lines = preg_split('/\r\n|\r|\n/', trim((string) $disk->get($file))) ?: [];
            $lines = array_values(array_filter($lines, fn (string $l) => trim($l) !== ''));

            $kept = [];
            $deleted = false;
            foreach ($lines as $line) {
                $entry = json_decode($line, true);

                if (! $deleted && is_array($entry) && ($entry['id'] ?? null) === $id) {
                    $deleted = true;
                    continue;
                }

                $kept[] = $line;
            }

            if ($deleted) {
                $disk->put($file, $kept === [] ? '' : implode(PHP_EOL, $kept) . PHP_EOL);

                return true;
            }
        }

        return false;
    }

    /**
     * Hapus SEMUA file log aktivitas, lalu catat aksi pembersihan itu
     * sendiri (jejak audit selalu tersisa).
     */
    public static function clearAll(): int
    {
        $disk = static::disk();

        $count = count(static::readEntries());
        foreach (static::activityFiles() as $file) {
            $disk->delete($file);
        }

        static::log('clear', null, [
            'module'      => 'log',
            'description' => "membersihkan seluruh log aktivitas ({$count} entri dihapus)",
        ]);

        return $count;
    }

    /* =========================================================
       HELPERS PATH & FILE
       ========================================================= */

    /** Instance disk "activity". */
    protected static function disk(): \Illuminate\Contracts\Filesystem\Filesystem
    {
        return Storage::disk(static::DISK);
    }

    /** Path log untuk tanggal tertentu: activity-YYYY-MM-DD.jsonl */
    public static function filePathFor(Carbon $date): string
    {
        return 'activity-' . $date->format('Y-m-d') . '.jsonl';
    }

    /** Path chunk ke-N untuk tanggal tertentu: activity-YYYY-MM-DD-partN.jsonl */
    protected static function chunkPath(string $basePath, int $part): string
    {
        return str_replace('.jsonl', "-part{$part}.jsonl", $basePath);
    }

    /** Nama file = file log aktivitas? (activity-*.jsonl, bukan laravel.log) */
    protected static function isActivityFile(string $filename): bool
    {
        return (bool) preg_match('/^activity-\d{4}-\d{2}-\d{2}(-part\d+)?\.jsonl$/', basename($filename));
    }

    /** Ekstrak tanggal Y-m-d dari nama file log aktivitas. */
    protected static function fileDate(string $filename): string
    {
        preg_match('/^activity-(\d{4}-\d{2}-\d{2})/', basename($filename), $m);

        return $m[1] ?? '1970-01-01';
    }

    /**
     * Semua file log aktivitas, urut nama (kronologis) menaik.
     *
     * @return array<int, string>
     */
    protected static function activityFiles(): array
    {
        return collect(static::disk()->files('/'))
            ->filter(fn (string $f) => static::isActivityFile($f))
            ->sort()
            ->values()
            ->all();
    }

    /** Hitung jumlah baris (non-kosong) dalam konten file. */
    protected static function countLines(string $content): int
    {
        $content = trim($content);

        return $content === '' ? 0 : substr_count($content, "\n") + 1;
    }

    /* =========================================================
       LABEL (mewarisi palet UI dari model lama)
       ========================================================= */

    public static function actionLabels(): array
    {
        return [
            'create'    => 'Tambah',
            'update'    => 'Ubah',
            'delete'    => 'Hapus',
            'publish'   => 'Publikasi',
            'checkout'  => 'Check-Out Tamu',
            'unpublish' => 'Tarik Publikasi',
            'login'     => 'Login',
            'logout'    => 'Logout',
            'clear'     => 'Bersihkan Log',
        ];
    }

    public static function actionLabel(string $eventType): string
    {
        return static::actionLabels()[$eventType] ?? ucfirst($eventType);
    }

    /** @return array<string, array{color: string, icon: string}> */
    protected static function actionColors(): array
    {
        return [
            'create'    => ['color' => '#16a34a', 'icon' => 'fa-plus'],
            'update'    => ['color' => '#d97706', 'icon' => 'fa-pen'],
            'delete'    => ['color' => '#dc2626', 'icon' => 'fa-trash'],
            'publish'   => ['color' => '#0284c7', 'icon' => 'fa-eye'],
            'checkout'  => ['color' => '#16a34a', 'icon' => 'fa-right-from-bracket'],
            'unpublish' => ['color' => '#64748b', 'icon' => 'fa-eye-slash'],
            'login'     => ['color' => '#7c3aed', 'icon' => 'fa-right-to-bracket'],
            'logout'    => ['color' => '#475569', 'icon' => 'fa-right-from-bracket'],
            'clear'     => ['color' => '#b91c1c', 'icon' => 'fa-broom'],
        ];
    }

    public static function moduleLabels(): array
    {
        return [
            'berita'      => 'Berita',
            'pengumuman'  => 'Pengumuman',
            'galeri'      => 'Galeri',
            'tamu'        => 'Data Tamu',
            'pengguna'    => 'Pengguna',
            'permohonan'  => 'Permohonan',
            'halaman'     => 'Halaman',
            'menu'        => 'Menu',
            'role'        => 'Role & Hak Akses',
            'autentikasi' => 'Autentikasi',
            'log'         => 'Log Aktivitas',
            'sistem'      => 'Sistem',
        ];
    }

    public static function moduleLabel(string $module): string
    {
        return static::moduleLabels()[$module] ?? ucfirst($module);
    }
}
