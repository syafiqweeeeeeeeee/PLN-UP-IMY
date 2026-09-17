<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Announcement;
use App\Models\ContactMessage;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\News;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

/**
 * Endpoint pencarian topbar admin (Ctrl+K / ikon kaca pembesar).
 *
 * Mencari di SEMUA modul admin — konten (berita, pengumuman, halaman,
 * galeri) maupun manajemen (pengguna, menu, role, permohonan, log
 * aktivitas). Hasil JSON dikelompokkan per tipe konten.
 *
 * Aturan hak akses: modul hanya dicari jika user punya permission
 * view-nya (Gate::allows) — user tidak bisa "menemukan" data yang
 * sebenarnya tidak boleh ia lihat.
 *
 * Khusus Log Aktivitas, query juga bisa berupa EKSPRESI WAKTU
 * (mis. "hari ini", "kemarin", "17 sep", "sep 2026", "01:53",
 * "3 jam terakhir", atau gabungan "login hari ini") — difilter
 * lewat range `created_at` yang terindeks, tetap ringan di DB.
 *
 * Pengaman beban database (ringan di DB):
 * - LIKE di kolom terindeks/judul saja, TANPA full-text pada konten panjang.
 * - Setiap modul dibatasi LIMIT 5 baris, hanya kolom kecil yang diambil
 *   (tidak pernah SELECT * — kolom `content`, `pesan`, dsb. tidak disentuh).
 * - Modul tanpa permission LANGSUNG dilewati (nol query).
 * - Dropdown UI sudah debounce 250ms per ketikan, jadi request tidak
 *   meledak per karakter.
 */
class AdminSearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'q' => 'required|string|min:2|max:100',
        ]);

        $q = $validated['q'];

        /* =========================================================
           KONTEN — hanya jika punya permission view modulnya
           ========================================================= */

        $news = Gate::allows('news.view')
            ? News::query()
                ->where('title', 'like', "%{$q}%")
                ->latest()
                ->limit(5)
                ->get(['id', 'title', 'is_published'])
            : collect();

        $announcements = Gate::allows('announcements.view')
            ? Announcement::query()
                ->where('title', 'like', "%{$q}%")
                ->latest('created_at')
                ->limit(5)
                ->get(['id', 'title', 'is_published'])
            : collect();

        $pages = Gate::allows('pages.view')
            ? Page::query()
                ->where('title', 'like', "%{$q}%")
                ->latest('updated_at')
                ->limit(5)
                ->get(['id', 'title', 'status'])
            : collect();

        $galleries = Gate::allows('galleries.view')
            ? Gallery::query()
                ->where('judul', 'like', "%{$q}%")
                ->latest('created_at')
                ->limit(5)
                ->get(['id', 'judul', 'status'])
            : collect();

        /* =========================================================
           MANAJEMEN — pengguna, menu, role, permohonan, log
           ========================================================= */

        $users = Gate::allows('users.view')
            ? User::query()
                ->where(function ($w) use ($q) {
                    $w->where('name', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%");
                })
                ->orderBy('name')
                ->limit(5)
                ->get(['id', 'name', 'email'])
            : collect();

        $menus = Gate::allows('menus.view')
            ? Menu::query()
                ->where('label', 'like', "%{$q}%")
                ->orderBy('sort_order')
                ->limit(5)
                ->get(['id', 'label', 'is_active'])
            : collect();

        $roles = Gate::allows('roles.view')
            ? Role::query()
                ->where('name', 'like', "%{$q}%")
                ->orderBy('name')
                ->limit(5)
                ->get(['id', 'name', 'status'])
            : collect();

        $messages = Gate::allows('contact_messages.view')
            ? ContactMessage::query()
                ->where(function ($w) use ($q) {
                    $w->where('subjek', 'like', "%{$q}%")
                      ->orWhere('nama', 'like', "%{$q}%");
                })
                ->latest()
                ->limit(5)
                ->get(['id', 'subjek', 'nama', 'status'])
            : collect();

        // Log aktivitas: tabel paling cepat tumbuh — pencarian teks
        // dibatasi 30 hari terakhir; pencarian berbasis waktu memakai
        // range created_at yang terindeks (lihat parseTimeQuery()).
        $logs = Gate::allows('activity_logs.view')
            ? $this->searchLogs($q)
            : collect();

        /* =========================================================
           SUSUN HASIL — grup kosong tetap dikirim (diharapkan UI)
           ========================================================= */

        return response()->json([
            [
                'label' => 'Berita',
                'icon'  => 'fa-newspaper',
                'items' => $news->map(fn (News $n) => [
                    'title' => $n->title,
                    'url'   => route('admin.news.edit', $n),
                    'meta'  => $n->is_published ? 'Terbit' : 'Draft',
                ])->all(),
            ],
            [
                'label' => 'Pengumuman',
                'icon'  => 'fa-bullhorn',
                'items' => $announcements->map(fn (Announcement $a) => [
                    'title' => $a->title,
                    'url'   => route('admin.announcements.edit', $a),
                    'meta'  => $a->is_published ? 'Terbit' : 'Draft',
                ])->all(),
            ],
            [
                'label' => 'Halaman',
                'icon'  => 'fa-file-lines',
                'items' => $pages->map(fn (Page $p) => [
                    'title' => $p->title,
                    'url'   => route('admin.pages.edit', $p),
                    'meta'  => $p->status === Page::STATUS_PUBLISHED ? 'Terbit' : 'Draft',
                ])->all(),
            ],
            [
                'label' => 'Galeri',
                'icon'  => 'fa-images',
                'items' => $galleries->map(fn (Gallery $g) => [
                    'title' => $g->judul,
                    'url'   => route('admin.galeri.edit', $g->id),
                    'meta'  => $g->status === 'publikasi' ? 'Publikasi' : 'Draft',
                ])->all(),
            ],
            [
                'label' => 'Pengguna',
                'icon'  => 'fa-users',
                'items' => $users->map(fn (User $u) => [
                    'title' => $u->name,
                    'url'   => route('admin.users.show', $u),
                    'meta'  => $u->email,
                ])->all(),
            ],
            [
                'label' => 'Menu',
                'icon'  => 'fa-bars',
                'items' => $menus->map(fn (Menu $m) => [
                    'title' => $m->label,
                    'url'   => route('admin.menus.edit', $m),
                    'meta'  => $m->is_active ? 'Aktif' : 'Nonaktif',
                ])->all(),
            ],
            [
                'label' => 'Role',
                'icon'  => 'fa-user-tag',
                'items' => $roles->map(fn (Role $r) => [
                    'title' => $r->name,
                    'url'   => route('admin.roles.edit', $r),
                    'meta'  => $r->status ? 'Aktif' : 'Nonaktif',
                ])->all(),
            ],
            [
                'label' => 'Permohonan',
                'icon'  => 'fa-paper-plane',
                'items' => $messages->map(fn (ContactMessage $c) => [
                    'title' => $c->subjek,
                    'url'   => route('admin.contact-messages.show', $c),
                    'meta'  => $c->nama,
                ])->all(),
            ],
            [
                'label' => 'Log Aktivitas',
                'icon'  => 'fa-clipboard-list',
                'items' => $logs->map(fn (ActivityLog $l) => [
                    'title' => $l->description,
                    'url'   => route('admin.activity-logs.index'),
                    'meta'  => $l->created_at->locale('id')->translatedFormat('d M Y H:i'),
                ])->all(),
            ],
        ]);
    }

    /* =========================================================
       PENCARIAN LOG AKTIVITAS — teks & waktu
       ========================================================= */

    private const MONTHS = [
        'januari' => 1, 'jan' => 1,
        'februari' => 2, 'feb' => 2,
        'maret' => 3, 'mar' => 3, 'march' => 3,
        'april' => 4, 'apr' => 4,
        'mei' => 5, 'may' => 5,
        'juni' => 6, 'jun' => 6,
        'juli' => 7, 'jul' => 7,
        'agustus' => 8, 'agu' => 8, 'agt' => 8, 'august' => 8, 'aug' => 8,
        'september' => 9, 'sept' => 9, 'sep' => 9,
        'oktober' => 10, 'okt' => 10, 'oct' => 10,
        'november' => 11, 'nov' => 11,
        'desember' => 12, 'des' => 12, 'dec' => 12,
    ];

    private const MONTH_RE = 'januari|februari|maret|march|april|agustus|september|oktober|november|desember|august|agt|agu|sept|okt|des|jan|feb|mar|apr|mei|may|jun|jul|aug|sep|oct|nov|dec';

    /**
     * Cari log aktivitas: teks biasa ATAU ekspresi waktu.
     *
     * - Teks biasa  : LIKE description + dibatasi 30 hari terakhir.
     * - Ekspresi    : range created_at (terindeks) — mis. "hari ini",
     *   "kemarin", "17 sep 2026", "sep 2026", "01:53", "3 jam terakhir",
     *   atau kombinasi teks + waktu ("login hari ini").
     */
    private function searchLogs(string $q): Collection
    {
        $time = $this->parseTimeQuery($q);
        $query = ActivityLog::query();

        if ($time === null) {
            $query->where('description', 'like', "%{$q}%")
                  ->where('created_at', '>=', now()->subDays(30));
        } else {
            $query->whereBetween('created_at', [$time['start'], $time['end']]);

            if ($time['time_equal'] !== null) {
                $query->whereTime('created_at', $time['time_equal']);
            }
            if ($time['time_from'] !== null) {
                $query->whereTime('created_at', '>=', $time['time_from'])
                      ->whereTime('created_at', '<=', $time['time_to']);
            }
            if ($time['text'] !== '') {
                $query->where('description', 'like', "%{$time['text']}%");
            }
        }

        return $query->latest()->limit(5)->get(['id', 'description', 'created_at']);
    }

    /**
     * Interpretasikan query sebagai ekspresi waktu Indonesia.
     * Mengembalikan null jika query BUKAN ekspresi waktu (→ LIKE teks).
     *
     * Struktur hasil: ['start', 'end', 'text', 'time_equal',
     * 'time_from', 'time_to'] — `text` = sisa kata non-waktu (boleh
     * kosong), `time_*` = filter jam menit (opsional, dipakai
     * whereTime di atas range 7 hari).
     */
    private function parseTimeQuery(string $q): ?array
    {
        $s = preg_replace('/\s+/u', ' ', trim(mb_strtolower($q)));
        $now = Carbon::now();
        $hit = null;

        /* ---- 1) Tanggal numerik lengkap: 17/09/2026, 17-09-2026, 17.09.26 ---- */
        if (preg_match('/\b(\d{1,2})[\/\-.](\d{1,2})[\/\-.](\d{2,4})\b/u', $s, $m, PREG_OFFSET_CAPTURE)) {
            $day = (int) $m[1][0];
            $mon = (int) $m[2][0];
            $yr = (int) $m[3][0];
            if ($yr < 100) {
                $yr += 2000;
            }
            if (checkdate($mon, $day, $yr)) {
                $start = Carbon::create($yr, $mon, $day, 0, 0, 0);
                $hit = ['start' => $start, 'end' => $start->copy()->endOfDay(), 'off' => $m[0][1], 'len' => strlen($m[0][0])];
            }
        }

        /* ---- 2) Hari + nama bulan: "17 sep", "17 september 2026" ---- */
        if ($hit === null && preg_match('/\b(\d{1,2})\s+(' . self::MONTH_RE . ')\w*(\s+(\d{4}))?\b/u', $s, $m, PREG_OFFSET_CAPTURE)) {
            $day = (int) $m[1][0];
            $mon = self::MONTHS[$m[2][0]] ?? 0;
            $yr = ($m[4][0] ?? '') !== '' ? (int) $m[4][0] : (int) $now->year;
            if ($mon > 0 && checkdate($mon, $day, $yr)) {
                $start = Carbon::create($yr, $mon, $day, 0, 0, 0);
                $hit = ['start' => $start, 'end' => $start->copy()->endOfDay(), 'off' => $m[0][1], 'len' => strlen($m[0][0])];
            }
        }

        /* ---- 3) Nama bulan (+ tahun): "sep 2026", "september" ---- */
        if ($hit === null && preg_match('/\b(' . self::MONTH_RE . ')\w*(\s+(\d{4}))?\b/u', $s, $m, PREG_OFFSET_CAPTURE)) {
            $mon = self::MONTHS[$m[1][0]] ?? 0;
            $yr = ($m[3][0] ?? '') !== '' ? (int) $m[3][0] : (int) $now->year;
            if ($mon > 0) {
                $start = Carbon::create($yr, $mon, 1, 0, 0, 0);
                $hit = ['start' => $start, 'end' => $start->copy()->endOfMonth(), 'off' => $m[0][1], 'len' => strlen($m[0][0])];
            }
        }

        /* ---- 4) "N hari terakhir" ---- */
        if ($hit === null && preg_match('/\b(\d{1,3})\s*hari\s*terakhir\b/u', $s, $m, PREG_OFFSET_CAPTURE)) {
            $hit = ['start' => $now->copy()->subDays((int) $m[1][0]), 'end' => $now->copy(), 'off' => $m[0][1], 'len' => strlen($m[0][0])];
        }

        /* ---- 5) "N jam terakhir" / "N menit terakhir" ---- */
        if ($hit === null && preg_match('/\b(\d{1,3})\s*(jam|menit)\s*terakhir\b/u', $s, $m, PREG_OFFSET_CAPTURE)) {
            $start = $m[2][0] === 'jam'
                ? $now->copy()->subHours((int) $m[1][0])
                : $now->copy()->subMinutes((int) $m[1][0]);
            $hit = ['start' => $start, 'end' => $now->copy(), 'off' => $m[0][1], 'len' => strlen($m[0][0])];
        }

        /* ---- 6) Frasa relatif: hari ini, kemarin, minggu/bulan/tahun ini & lalu ---- */
        if ($hit === null) {
            $phrases = [
                'kemarin'     => [$now->copy()->subDay()->startOfDay(), $now->copy()->subDay()->endOfDay()],
                'hari ini'    => [$now->copy()->startOfDay(), $now->copy()],
                'minggu ini'  => [$now->copy()->startOfWeek(), $now->copy()],
                'pekan ini'   => [$now->copy()->startOfWeek(), $now->copy()],
                'bulan ini'   => [$now->copy()->startOfMonth(), $now->copy()],
                'tahun ini'   => [$now->copy()->startOfYear(), $now->copy()],
                'minggu lalu' => [$now->copy()->subWeek()->startOfWeek(), $now->copy()->subWeek()->endOfWeek()],
                'pekan lalu'  => [$now->copy()->subWeek()->startOfWeek(), $now->copy()->subWeek()->endOfWeek()],
                'bulan lalu'  => [$now->copy()->subMonthNoOverflow()->startOfMonth(), $now->copy()->subMonthNoOverflow()->endOfMonth()],
            ];
            foreach ($phrases as $phrase => [$start, $end]) {
                $off = strpos($s, $phrase);
                if ($off !== false) {
                    $hit = ['start' => $start, 'end' => $end, 'off' => $off, 'len' => strlen($phrase)];
                    break;
                }
            }
        }

        /* ---- 7) "pukul 14" / "jam 9" → jam tsb dalam 7 hari terakhir ---- */
        if ($hit === null && preg_match('/\b(?:pukul|jam)\s*(\d{1,2})\b/u', $s, $m, PREG_OFFSET_CAPTURE)) {
            $h = (int) $m[1][0];
            if ($h <= 23) {
                $hit = [
                    'start' => $now->copy()->subDays(7), 'end' => $now->copy(),
                    'off' => $m[0][1], 'len' => strlen($m[0][0]),
                    'time_from' => sprintf('%02d:00:00', $h),
                    'time_to' => sprintf('%02d:59:59', $h),
                ];
            }
        }

        /* ---- 8) Jam:menit persis: "01:53" → menit tsb dalam 7 hari terakhir ---- */
        if ($hit === null && preg_match('/\b(\d{1,2}):(\d{2})\b/u', $s, $m, PREG_OFFSET_CAPTURE)) {
            $h = (int) $m[1][0];
            $mi = (int) $m[2][0];
            if ($h <= 23 && $mi <= 59) {
                $hit = [
                    'start' => $now->copy()->subDays(7), 'end' => $now->copy(),
                    'off' => $m[0][1], 'len' => strlen($m[0][0]),
                    'time_equal' => sprintf('%02d:%02d:00', $h, $mi),
                ];
            }
        }

        if ($hit === null) {
            return null;
        }

        // Pengaman: span > ±1 tahun ditolak (fallback ke pencarian teks).
        if ($hit['start']->diffInDays($hit['end']) > 400) {
            return null;
        }

        /* ---- Sisa kata non-waktu → LIKE tambahan (mis. "login hari ini") ---- */
        $rest = trim(substr($s, 0, $hit['off']) . ' ' . substr($s, $hit['off'] + $hit['len']));
        $rest = preg_replace('/\b(?:pada|tanggal|di|waktu|sekitar|jam|pukul)\b/u', ' ', $rest);
        $rest = preg_replace('/\s+/u', ' ', trim((string) $rest));
        if (mb_strlen($rest) < 2) {
            $rest = '';
        }

        return [
            'start' => $hit['start'],
            'end' => $hit['end'],
            'text' => $rest,
            'time_equal' => $hit['time_equal'] ?? null,
            'time_from' => $hit['time_from'] ?? null,
            'time_to' => $hit['time_to'] ?? null,
        ];
    }
}
