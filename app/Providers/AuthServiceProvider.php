<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        //
    ];

    protected bool $gatesRegistered = false;

    public function boot(): void
    {
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
