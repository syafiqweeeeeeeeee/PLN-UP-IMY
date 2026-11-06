<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        //
    ];

    public function boot(): void
    {
        // Ability "activity_logs.view", "roles.view", dst. dicek lewat permission
        // user (pivot role_user -> role_permission). Jika user punya permission
        // dengan nama yang sama, ability tersebut diizinkan.
        // Return null berarti lanjut ke pengecekan gate/policy normal (default: ditolak).
        Gate::before(function ($user, string $ability) {
            if (! $user instanceof User) {
                return null;
            }

            return $user->hasPermission($ability) ? true : null;
        });

        // Gate CRUD Pengguna — edit & update.
        // Kebijakan yang disepakati:
        // - Super Admin / Admin utama = akses penuh (baca & edit semua).
        // - Admin Bidang = hanya boleh edit profil milik sendiri.
        // Gate ini memastikan Super Admin return true SEKARANG juga,
        // sebelum cek kepemilikan, supaya tidak ada 403/argument error.
        Gate::define('users.edit:self', function ($user, $targetUser = null) {
            $roleRaw = ($user && $user->role) ? trim((string) $user->role) : '';
            $roleName = strtolower($roleRaw);

            // A. Super Admin / Admin utama SELALU diizinkan.
            if ($roleName === 'super admin' || $roleName === 'admin' || ($user->role_id ?? null) == 1) {
                return true;
            }

            // B. Role lain hanya izinkan edit profil milik sendiri.
            $target = $targetUser ?? request()->route('user');

            if ($target instanceof \App\Models\User) {
                return (int) $user->id === (int) $target->id;
            }

            if (is_numeric($target)) {
                return (int) $user->id === (int) $target;
            }

            return false;
        });

        // CRUD Pengguna — hapus.
        // Hanya Super Admin / Admin utama yang boleh menghapus pengguna lain.
        Gate::define('users.delete', function ($user, $targetUser = null) {
            $roleRaw = ($user && $user->role) ? trim((string) $user->role) : '';
            $roleName = strtolower($roleRaw);

            return $roleName === 'super admin' || $roleName === 'admin' || ($user->role_id ?? null) == 1;
        });

    }

    /**
     * Bersihkan cache registrasi gate permission (PermissionRegistrar
     * versi sistem ini). Dipanggil RoleController setiap kali pivot
     * role_permission diperbarui, sehingga perubahan centang Hak Akses
     * langsung bereffek ke SEMUA akun yang memegang role tersebut tanpa
     * perlu menunggu cache lama (jalur pengecekan Gate::before →
     * User::hasPermission memang membaca relasi roles.permissions
     * real-time per request — flush ini menjaga registrasi gate ikut fresh).
     */
    public static function flushPermissionGateCache(): void
    {
        app('cache')->store()->forget('permission.gates.registered');

        // Snapshot RBAC per-request (User::permissionState) ikut dibersihkan
        // agar perubahan pivot (role permission / direct permission) tetap
        // berlaku real-time dalam request yang sama.
        \App\Models\User::flushPermissionStateCache();
    }

}
