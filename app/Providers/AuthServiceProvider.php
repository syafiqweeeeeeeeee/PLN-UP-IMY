<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        //
    ];

    protected bool $gatesRegistered = false;

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


        if (! $this->gatesRegistered) {
            static $bootStarted = false;
            if ($bootStarted) {
                return;
            }

            if (! app('db')->connection()->getTablePrefix()) {
                return;
            }
            $bootStarted = true;

            if (!app()->make('cache')->store()->get('permission.gates.registered', false)) {
                foreach (Permission::whereNotNull('name')->pluck('name') as $permission) {
                    $this->registerPermissionGate($permission);
                }
                // Registrasi ulang gate custom (non-permission) agar
                // tidak hilang jika cache permission gates disetel ulang.
                Gate::define('users.edit:self', function ($user, $targetUser = null) {
                    // A. Super Admin SELALU diizinkan mengedit siapapun.
                    if ($user->role === 'Super Admin' || ($user->role_id ?? null) === 1) {
                        return true;
                    }

                    // B. Ambil target user dari parameter Gate atau dari Route URL.
                    $target = $targetUser ?? request()->route('user');

                    // Route parameter bisa berupa objek User yang sudah di-bind
                    // (Laravel route model binding) atau string/integer ID.
                    if ($target instanceof \App\Models\User) {
                        return (int) $user->id === (int) $target->id;
                    }

                    if (is_numeric($target)) {
                        return (int) $user->id === (int) $target;
                    }

                    return false;
                });
                app()->make('cache')->store()->put('permission.gates.registered', true, 60);
            }
            $this->gatesRegistered = true;
        }
    }

    protected function registerPermissionGate(string $permission): void
    {
        $this->app->make('validator')->extend("permission:{$permission}", function ($attribute, $value, $parameters, $validator) use ($permission) {
            $user = $validator->getData();
            return $user instanceof \App\Models\User && $user->hasPermission($permission);
        });
    }
}
