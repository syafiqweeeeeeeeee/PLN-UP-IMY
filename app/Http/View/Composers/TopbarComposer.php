<?php

namespace App\Http\View\Composers;

use App\Services\NotificationService;
use Illuminate\View\View;

/**
 * Data topbar admin:
 * - $topbarUser: nama, email, role, inisial avatar, URL profil (user login asli).
 * - $topbarNotifs: notifikasi dinamis dari NotificationService
 *   (tamu baru = belum dibaca, konten draft). Red dot hanya tampil
 *   bila ada notifikasi belum dibaca — bukan lagi hardcode.
 */
class TopbarComposer
{
    public function __construct(protected NotificationService $notifications)
    {
    }

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
        $view->with('topbarNotifs', $this->notifications->build());
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
}
