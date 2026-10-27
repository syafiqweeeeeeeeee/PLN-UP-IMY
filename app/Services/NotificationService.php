<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * NotificationService — sumber tunggal notifikasi topbar admin.
 *
 * Item notifikasi dibangun dari kondisi data terkini:
 * - Tamu baru (belum dilihat admin yang sedang login): dibandingkan dengan
 *   id tamu terakhir yang sudah dilihat AKUN TERSEBUT — kolom
 *   users.last_seen_tamu_id (per-akun, permanen lintas sesi & perangkat).
 * - Konten masih draft (berita + pengumuman + halaman).
 *
 * unread_count kini nyata: tamu yang belum dilihat akun ini. Dot merah pada
 * lonceng tampil persis saat ada tamu masuk yang belum dibuka.
 */
class NotificationService
{
    /**
     * Penanda id tamu terakhir yang sudah dilihat user — kolom DB per-akun
     * (users.last_seen_tamu_id), menggantikan session "tamu_last_seen_id".
     */
    public const SEEN_COLUMN = 'last_seen_tamu_id';

    /**
     * Ambil id tamu terakhir yang sudah dilihat user yang sedang login.
     * Belum login / tidak ditemukan → 0 (semua tamu dianggap belum dibaca).
     */
    private function seenTamuId(): int
    {
        $user = auth()->user();

        if ($user === null || ! $user instanceof \App\Models\User) {
            return 0;
        }

        return (int) ($user->{self::SEEN_COLUMN} ?? 0);
    }

    /**
     * Susun daftar notifikasi + jumlah belum dibaca.
     *
     * @return array{items: array<int, array{text: string, url: string, icon: string, tone: string, time: string, unread: bool}>, unread_count: int, latest_tamu_id: int|null, seen_tamu_id: int}
     */
    public function build(): array
    {
        $items = [];

        // BAGIAN GLOBAL (sama untuk semua admin) — snapshot di-cache TTL 10 detik.
        // Dulu: setiap render halaman admin (plus poll tiap 30 detik per akun)
        // menjalankan 6 query baru di sini.
        // PENTING: id tamu terakhir TIDAK di-cache saat tabel masih kosong
        // (Cache::remember dengan 0 akan menyembunyikan tamu baru hingga
        // TTL kadaluarsa) — hanya nilai > 0 yang disimpan.
        $latestTamuId = (int) (Cache::get('admin.notifs.latest-tamu-id') ?? (int) DB::table('tamus')->max('id'));
        if ($latestTamuId > 0) {
            Cache::put('admin.notifs.latest-tamu-id', $latestTamuId, now()->addSeconds(10));
        }

        $draftNews          = (int) Cache::remember('admin.notifs.draft-news', now()->addSeconds(10), fn () =>
            (int) DB::table('news')->where('is_published', false)->count()
        );
        $draftAnnouncements = (int) Cache::remember('admin.notifs.draft-announcements', now()->addSeconds(10), fn () =>
            (int) DB::table('announcements')->where('is_published', false)->count()
        );
        $draftPages         = (int) Cache::remember('admin.notifs.draft-pages', now()->addSeconds(10), fn () =>
            (int) DB::table('pages')->where('status', 'draft')->count()
        );

        $seenTamuId = $this->seenTamuId();

        $newTamuCount = 0;
        if ($latestTamuId > 0) {
            // PER USER — key menyertakan id akun + seen terkini; kadaluarsa
            // 10 detik (poll UI sendiri berjalan tiap 30 detik).
            $newTamuCount = (int) Cache::remember(
                "admin.notifs.count.u{$this->userId()}.seen{$seenTamuId}",
                now()->addSeconds(10),
                fn () => max(0, DB::table('tamus')->where('id', '>', $seenTamuId)->count())
            );

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
        $totalDraft = $draftNews + $draftAnnouncements + $draftPages;

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
            'latest_tamu_id' => $latestTamuId > 0 ? $latestTamuId : null,
            'seen_tamu_id'   => $seenTamuId,
        ];
    }

    /** Id akun login (0 bila tamu) — untuk key cache per user. */
    private function userId(): int
    {
        return (int) (auth()->id() ?? 0);
    }

    /**
     * Tandai seluruh tamu sudah dilihat (dipanggil saat admin menutup
     * dropdown notifikasi): simpan id tamu terkini ke kolom DB akun yang
     * sedang login — permanen untuk akun tersebut, lintas sesi/perangkat.
     */
    public function markTamuSeen(): void
    {
        $user = auth()->user();

        if ($user === null || ! $user instanceof \App\Models\User) {
            return;
        }

        $latestId = (int) DB::table('tamus')->max('id');

        $user->forceFill([self::SEEN_COLUMN => $latestId])->save();

        // Cache hitung unread akun ini tidak valid setelah seen — key
        // menyertakan nilai seen terkini, jadi cache lama dibiarkan kadaluarsa
        // sendiri dan key baru akan dihitung ulang pada poll berikutnya.
    }
}
