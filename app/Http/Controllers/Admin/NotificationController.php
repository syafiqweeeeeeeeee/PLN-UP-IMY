<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * NotificationController — endpoint lonceng notifikasi topbar.
 *
 * poll():  JSON ringkas untuk polling berkala (dot + badge + item),
 *          dipanggil JS layout admin tiap 30 detik.
 * seen():  tandai seluruh tamu sudah dilihat (dipanggil saat admin
 *          membuka dropdown notifikasi) → dot hilang.
 */
class NotificationController extends Controller
{
    public function __construct(protected NotificationService $notifications)
    {
    }

    public function poll(Request $request): JsonResponse
    {
        $data = $this->notifications->build();

        return response()->json([
            'unread_count'   => $data['unread_count'],
            'items'          => collect($data['items'])->map(fn (array $item) => [
                'text'   => $item['text'],
                'url'    => $item['url'],
                'icon'   => $item['icon'],
                'tone'   => $item['tone'],
                'time'   => $item['time'],
                'unread' => $item['unread'],
            ])->values(),
            'latest_tamu_id' => $data['latest_tamu_id'],
            'seen_tamu_id'   => $data['seen_tamu_id'],
        ]);
    }

    public function seen(Request $request): JsonResponse
    {
        $this->notifications->markTamuSeen();

        return response()->json(['ok' => true, 'unread_count' => 0]);
    }
}
