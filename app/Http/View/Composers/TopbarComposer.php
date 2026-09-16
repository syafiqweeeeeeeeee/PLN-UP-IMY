<?php

namespace App\Http\View\Composers;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Data topbar admin:
 * - $topbarUser: nama, email, role, inisial avatar, URL profil (user login asli).
 * - $topbarNotifs: notifikasi dinamis dari kondisi data (permohonan belum
 *   dibaca, konten draft). Red dot hanya tampil bila ada notifikasi belum
 *   dibaca — bukan lagi hardcode.
 */
class TopbarComposer
{
    public function compose(View $view): void
    {
        $user = auth()->user();

        $topbarUser = [
            'name'        => $user?->name ?? 'Pengguna',
            'email'       => $user?->email ?? '',
            'role'        => $user?->role ?? 'Tanpa Role',
            'initials'    => $this->initials($user?->name ?? '?'),
            'profile_url' => $user ? route('admin.users.show', $user) : '#',
        ];

        $view->with('topbarUser', $topbarUser);
        $view->with('topbarNotifs', $this->notifications());
    }

    /**
     * Inisial nama untuk avatar (maks 2 huruf).
     */
    private function initials(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name)) ?: [];

        if ($parts === []) {
            return '?';
        }

        $initials = strtoupper(mb_substr($parts[0], 0, 1));

        if (count($parts) > 1) {
            $initials .= strtoupper(mb_substr(end($parts), 0, 1));
        }

        return $initials;
    }

    /**
     * Notifikasi dinamis dari kondisi data terkini.
     *
     * @return array{items: array<int, array{text: string, url: string, icon: string, tone: string, time: string, unread: bool}>, unread_count: int}
     */
    private function notifications(): array
    {
        $items = [];

        $unreadPermohonan = ContactMessage::unreadCount();
        if ($unreadPermohonan > 0) {
            $latest = ContactMessage::query()->unread()->latest()->first();

            $items[] = [
                'text'   => $unreadPermohonan . ' permohonan belum dibaca',
                'url'    => route('admin.contact-messages.index'),
                'icon'   => 'fas fa-inbox',
                'tone'   => 'red',
                'time'   => $latest?->created_at?->locale('id')->diffForHumans() ?? 'sekarang',
                'unread' => true,
            ];
        }

        // Draft gabungan berita + pengumuman + halaman
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
            'items'        => $items,
            'unread_count' => $unreadPermohonan > 0 ? 1 : 0,
        ];
    }
}
