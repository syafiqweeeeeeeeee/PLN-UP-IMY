<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $module = $request->query('module');
        $action = $request->query('action');
        $search = trim((string) $request->query('q', ''));

        $logs = ActivityLog::query()
            ->with('user')
            ->filter(
                $module !== '' ? $module : null,
                $action !== '' ? $action : null,
                $search !== '' ? $search : null
            )
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.activity-logs.index', [
            'logs'    => $logs,
            'modules' => ActivityLog::moduleLabels(),
            'actions' => ActivityLog::actionLabels(),
            'filters' => [
                'module' => $module,
                'action' => $action,
                'q'      => $search,
            ],
        ]);
    }

    public function destroy(ActivityLog $activity_log)
    {
        $activity_log->delete();

        return back()->with('success', 'Log aktivitas berhasil dihapus.');
    }

    public function clear()
    {
        $count = ActivityLog::count();
        ActivityLog::query()->delete();

        // Aksi pembersihan sendiri ikut dicatat — jadi selalu ada jejak audit.
        ActivityLog::record('log', 'clear', "membersihkan seluruh log aktivitas ({$count} entri dihapus)");

        return redirect()->route('admin.activity-logs.index')
            ->with('success', "Berhasil membersihkan {$count} log aktivitas.");
    }
}
