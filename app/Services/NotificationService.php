<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * NotificationService — sumber tunggal notifikasi topbar admin.
 *
 * Item notifikasi dibangun dari kondisi data terkini:
 * - Tamu baru (belum dilihat admin mana pun): dibandingkan dengan
 *   id terakhir yang sudah dilihat (session "tamu_last_seen_id",
 *   berbagi antar user admin — front office cukup satu watchlist).
 * - Konten masih draft (berita + pengumuman + halaman).
 *
 * unread_count kini nyata: tamu yang belum dilihat. Dot merah pada
 * lonceng tampil persis saat ada tamu masuk yang belum dibuka.
 */
class NotificationService
{
    /** Key session penanda id tamu terakhir yang sudah dilihat. */
    public const SEEN_KEY = 'tamu_last_seen_id';

    /**
     * Susun daftar notifikasi + jumlah belum dibaca.
     *
     * @return array{items: array<int, array{text: string, url: string, icon: string, tone: string, time: string, unread: bool}>, unread_count: int, latest_tamu_id: int|null, seen_tamu_id: int}
     */
    public function build(): array
    {
        $items = [];

        $latestTamu = DB::table('tamus')->orderByDesc('id')->first();
        $latestTamuId = $latestTamu?->id;
        $seenTamuId = (int) session(self::SEEN_KEY, 0);

        $newTamuCount = 0;
        if ($latestTamuId !== null) {
            $newTamuCount = max(0, (int) DB::table('tamus')->where('id', '>', $seenTamuId)->count());

            if ($newTamuCount > 0) {
                $items[] = [
                    'text'   => $newTamuCount . ' tamu baru mendaftar',
                    'url'    => route('admin.tamu.index'),
                    'icon'   => 'fas fa-id-card',
                    'tone'   => 'blue',
                    'time'   => 'sekarang',
                    // Tamu = satu-satunya sumber unread; draft bersifat pasif.
                    'unread' => true,
                ];
            }
        }

        // Draft gabungan berita + pengumuman + halaman (pasif, tidak dihitung unread)
        $draftNews          = DB::table('news')->where('is_published', false)->count();
        $draftAnnouncements = DB::table('announcements')->where('is_published', false)->count();
        $draftPages         = DB::table('pages')->where('status', 'draft')->count();
        $totalDraft         = $draftNews + $draftAnnouncements + $draftPages;

        if ($totalDraft > 0) {
            $items[] = [
                'text'   => $totalDraft . ' konten masih draft',
                'url'    => route('admin.news.index'),
                'icon'   => 'fas fa-clock',
                'tone'   => 'amber',
                'time'   => 'sekarang',
                'unread' => false,
            ];
        }

        return [
            'items'          => $items,
            'unread_count'   => $newTamuCount,
            'latest_tamu_id' => $latestTamuId !== null ? (int) $latestTamuId : null,
            'seen_tamu_id'   => $seenTamuId,
        ];
    }

    /**
     * Tandai seluruh tamu sudah dilihat (dipanggil saat admin membuka
     * dropdown notifikasi): simpan id tamu terkini ke session.
     */
    public function markTamuSeen(): void
    {
        $latestId = DB::table('tamus')->max('id');

        session([self::SEEN_KEY => (int) $latestId]);
    }
}
