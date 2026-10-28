<?php

namespace App\Providers;

use App\Http\View\Composers\KaryawanLayoutComposer;
use App\Http\View\Composers\TopbarComposer;
use App\Models\Announcement;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Page;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Observers\NameMarkerObserver;
use App\Services\MenuBuilderService;
use App\Services\PublicPageCache;
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
        // Kolom penanda nama (*_name) pada tabel pivot RBAC harus ikut
        // diperbarui saat nama di tabel sumber di-rename. Insert pivot
        // baru ditangani BelongsToManyNameMarkers; observer ini hanya
        // menangani rename (lihat komentar di NameMarkerObserver).
        Role::observe(NameMarkerObserver::class);
        Permission::observe(NameMarkerObserver::class);
        User::observe(NameMarkerObserver::class);
        Page::observe(NameMarkerObserver::class);

        // View paginasi kustom di resources/views/vendor/pagination
        // (markup Bootstrap — layout app & admin memuat Bootstrap 5).
        Paginator::defaultView('pagination::bootstrap-5');
        Paginator::defaultSimpleView('pagination::simple-bootstrap-5');

        // Cache halaman publik (PublicPageCache) — buang versi lama setiap
        // kali konten yang tampil di website publik disimpan/dihapus,
        // sehingga perubahan langsung terlihat tanpa menunggu TTL.
        foreach ([News::class, Announcement::class, Gallery::class, Page::class] as $publicContent) {
            $publicContent::saved(fn () => PublicPageCache::flush());
            $publicContent::deleted(fn () => PublicPageCache::flush());
        }

        // Navbar publik dirender dinamis dari Menu Builder.
        // Menu ber-target halaman CMS disaring sesuai visibilitas per role;
        // fallback ke struktur default bila DB belum di-seed.
        View::composer('layouts.navbar', function ($view) {
            // hasTable dimemoisasi + tree di-cache (TTL 5 menit, flush saat
            // menu diubah) — dulu: query informs + tree baru tiap request.
            $menuTree = MenuBuilderService::menusTableExists()
                ? app(MenuBuilderService::class)->treeFor(auth()->user())
                : [];

            $view->with('menuTree', $menuTree);
        });

        // Topbar admin: data user asli + notifikasi dinamis dari database.
        View::composer('layouts.admin', TopbarComposer::class);

        // Header portal karyawan: nama, role, dan inisial avatar user login.
        // Didaftarkan juga ke view karyawan.* agar data tersedia di
        // child view (mis. kartu avatar di halaman profil).
        View::composer(['layouts.karyawan', 'karyawan.*'], KaryawanLayoutComposer::class);
    }
}
