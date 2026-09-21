<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

/**
 * Data header Portal Karyawan: nama karyawan yang login, role,
 * dan inisial avatar (maks 2 huruf) — pola sama dengan TopbarComposer.
 */
class KaryawanLayoutComposer
{
    public function compose(View $view): void
    {
        $user = auth()->user();

        $view->with('karyawanUser', [
            'name'     => $user?->name ?? 'Karyawan',
            'email'    => $user?->email ?? '',
            'role'     => $user?->role ?? 'Karyawan',
            'initials' => $this->initials($user?->name ?? '?'),
        ]);
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
