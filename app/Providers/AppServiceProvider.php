<?php

namespace App\Providers;

use App\Http\View\Composers\TopbarComposer;
use App\Services\MenuBuilderService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View paginasi kustom di resources/views/vendor/pagination
        // (markup Bootstrap — layout app & admin memuat Bootstrap 5).
        Paginator::defaultView('pagination::bootstrap-5');
        Paginator::defaultSimpleView('pagination::simple-bootstrap-5');

        // Navbar publik dirender dinamis dari Menu Builder.
        // Menu ber-target halaman CMS disaring sesuai visibilitas per role;
        // fallback ke struktur default bila DB belum di-seed.
        View::composer('layouts.navbar', function ($view) {
            $menuTree = Schema::hasTable('menus')
                ? app(MenuBuilderService::class)->treeFor(auth()->user())
                : [];

            $view->with('menuTree', $menuTree);
        });

        // Topbar admin: data user asli + notifikasi dinamis dari database.
        View::composer('layouts.admin', TopbarComposer::class);
    }
}
