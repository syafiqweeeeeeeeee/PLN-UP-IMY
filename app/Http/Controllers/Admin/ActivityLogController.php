<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Halaman Log Aktivitas — membaca file JSONL harian
     * (activity-YYYY-MM-DD.jsonl) via ActivityLogger, dikelompokkan
     * per hari untuk header tanggal di UI.
     */
    public function index(Request $request)
    {
        $search    = trim((string) $request->query('q', ''));
        $eventType = trim((string) $request->query('event_type', ''));
        $module    = trim((string) $request->query('module', ''));
        $perPage   = (int) $request->query('per_page', 15);
        $page      = max(1, (int) $request->query('page', 1));

        // getGroupedLogs memfilter berdasarkan search (actor) &
        // event_type; filter module dilakukan manual (payload/module).
        $result = ActivityLogger::getGroupedLogs(
            daysLimit: 30,
            search: $search !== '' ? $search : null,
            eventType: $eventType !== '' ? $eventType : null
        );

        $groups = collect($result['groups']);
        if ($module !== '') {
            $groups = $groups
                ->map(function (array $group) use ($module) {
                    $group['entries'] = array_values(array_filter(
                        $group['entries'],
                        fn (array $e) => ($e['module'] ?? '') === $module
                    ));

                    return $group;
                })
                ->filter(fn (array $group) => $group['entries'] !== []);
        }

        // Pagination manual atas grup (bukan entri) — header hari tetap utuh.
        $totalGroups = $groups->count();
        $totalEntries = $result['total'];
        $pagedGroups = $groups->slice(($page - 1) * $perPage, $perPage)->values();

        $pageGroupCount = $pagedGroups->sum(fn (array $g) => count($g['entries']));

        return view('admin.activity-logs.index', [
            'groups'       => $pagedGroups,
            'total'        => $totalEntries,
            'shownCount'   => $pageGroupCount,
            'currentPage'  => $page,
            'lastPage'     => max(1, (int) ceil($totalGroups / $perPage)),
            'modules'      => ActivityLogger::moduleLabels(),
            'eventTypes'   => ActivityLogger::actionLabels(),
            'filters'      => [
                'q'          => $search,
                'event_type' => $eventType,
                'module'     => $module,
            ],
        ]);
    }

    /**
     * Hapus satu entri log (berdasarkan UUID) dari file JSONL-nya.
     */
    public function destroy(Request $request, string $uuid)
    {
        $deleted = ActivityLogger::deleteEntry($uuid);

        if (! $deleted) {
            return back()->with('error', 'Log tidak ditemukan atau sudah dihapus.');
        }

        return back()->with('success', 'Log aktivitas berhasil dihapus.');
    }

    /**
     * Hapus semua file log aktivitas. Aksi pembersihan sendiri tetap
     * dicatat sebagai entri baru (jejak audit selalu tersisa).
     */
    public function clear()
    {
        $count = ActivityLogger::clearAll();

        return redirect()->route('admin.activity-logs.index')
            ->with('success', "Berhasil membersihkan {$count} log aktivitas.");
    }
}
