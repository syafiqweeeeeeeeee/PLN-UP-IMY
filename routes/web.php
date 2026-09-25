<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageDisplayController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\NewsController;
use App\Models\Gallery;
use App\Models\News;

Route::get('/', [HomeController::class, 'index'])->name('home');

// ============================================================
// REGISTRASI TAMU (Guest Book) — publik, tanpa auth.
// Form KTP disimpan ke storage/app/public/ktp via TamuController.
// Catatan: didefinisikan SEBELUM wildcard /layanan/{slug} agar
// tidak tertangkap sebagai slug detail layanan.
// ============================================================
Route::get('/layanan/form-registrasi-tamu', [\App\Http\Controllers\TamuController::class, 'create'])->name('layanan.registrasi-tamu');
Route::post('/layanan/form-registrasi-tamu', [\App\Http\Controllers\TamuController::class, 'store'])->name('layanan.registrasi-tamu.store');

Route::get('/tentang-kami/sejarah', [HomeController::class, 'sejarah'])->name('sejarah');
Route::get('/tentang-kami/visi-misi', [HomeController::class, 'visiMisi'])->name('visi-misi');
Route::get('/tentang-kami/profil-perusahaan', [HomeController::class, 'profilPerusahaan'])->name('profil-perusahaan');
Route::get('/tentang-kami/struktur-organisasi', function () {
    return view('tentang_kami.struktur_organisasi');
})->name('struktur-organisasi');
Route::get('/informasi/galeri', function () {
    $galleries = Gallery::published()
        ->latest('tanggal_kegiatan')
        ->orderByDesc('id')
        ->paginate(9);

    $galleryData = $galleries->getCollection()
        ->map(fn ($g) => [
            'src'      => $g->image_url,
            'title'    => $g->judul,
            'date'     => $g->tanggal_kegiatan->translatedFormat('d F Y'),
            'desc'     => $g->deskripsi ?? '',
            'kategori' => strtolower($g->kategori),
        ])
        ->values();

    return view('informasi.galeri', compact('galleries', 'galleryData'));
})->name('galeri');

Route::get('/informasi/berita', function () {
    $news = News::where('is_published', true)
        ->latest('published_at')
        ->paginate(9);
    return view('informasi.berita', compact('news'));
})->name('berita');

Route::get('/informasi/berita/{slug}', function ($slug) {
    $news = News::where('slug', $slug)->where('is_published', true)->firstOrFail();
    $related = News::where('is_published', true)
        ->where('id', '!=', $news->id)
        ->where('category', $news->category)
        ->latest()
        ->take(3)
        ->get();
    return view('informasi.berita_detail', compact('news', 'related'));
})->name('berita.detail');

Route::get('/informasi/pengumuman', function () {
    $pengumuman = App\Models\Announcement::where('is_published', true)
        ->latest('published_at')
        ->paginate(8);

    return view('informasi.pengumuman', compact('pengumuman'));
})->name('pengumuman');

Route::get('/informasi/pengumuman/{slug}', function ($slug) {
    $pengumuman = App\Models\Announcement::where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();

    $related = App\Models\Announcement::where('is_published', true)
        ->where('id', '!=', $pengumuman->id)
        ->where('category', $pengumuman->category)
        ->latest('published_at')
        ->take(3)
        ->get();

    return view('informasi.pengumuman_detail', compact('pengumuman', 'related'));
})->name('pengumuman.detail');

Route::get('/informasi/layanan', function () {
    return view('informasi.layanan');
})->name('informasi.layanan');

// Halaman CMS dinamis (dua pintu: publik & internal).
// Visibilitas (draft / role terbatas) di-enforce server-side lewat middleware page.visible.
Route::get('/halaman', [PageDisplayController::class, 'index'])->name('pages.index');
Route::get('/halaman/{page:slug}', [PageDisplayController::class, 'show'])
    ->middleware('page.visible')
    ->name('pages.show');

Route::get('/layanan/faq', function () {
    return view('layanan.faq');
})->name('layanan.faq');

// ============================================================
// PORTAL KARYAWAN (Employee Portal)
// ------------------------------------------------------------
// Area internal terpisah dari panel admin. Seluruh halaman
// view-only; konten dibatasi auth + middleware karyawan.access
// (menolak role selain Karyawan murni).
// ============================================================
Route::middleware(['auth', 'karyawan.access'])->prefix('karyawan')->name('karyawan.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Karyawan\PortalController::class, 'dashboard'])->name('dashboard');
    Route::get('/informasi', [\App\Http\Controllers\Karyawan\PortalController::class, 'informasi'])->name('informasi');
    Route::get('/informasi/{type}/{slug}', [\App\Http\Controllers\Karyawan\PortalController::class, 'informasiDetail'])
        ->where(['type' => 'berita|pengumuman'])
        ->name('informasi.detail');
    Route::get('/layanan', [\App\Http\Controllers\Karyawan\PortalController::class, 'layanan'])->name('layanan');
    Route::get('/layanan/{slug}', [\App\Http\Controllers\Karyawan\PortalController::class, 'layananDetail'])->name('layanan.detail');
    Route::get('/link', [\App\Http\Controllers\Karyawan\PortalController::class, 'link'])->name('link');

    // Profil — satu-satunya bagian yang bisa diubah karyawan
    Route::get('/profil', [\App\Http\Controllers\Karyawan\PortalController::class, 'profil'])->name('profil');
    Route::put('/profil', [\App\Http\Controllers\Karyawan\PortalController::class, 'updateProfil'])->name('profil.update');
});

// Admin Dashboard
// Register: tidak ada pendaftaran mandiri — arahkan ke halaman login admin
Route::get('/register', function () {
    return redirect()->route('login');
})->name('register');

// Login
Route::get('/admin/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/admin/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Admin Dashboard
Route::middleware(['auth', 'admin.access'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Pengguna — gate per aksi. `show` sengaja terbuka (profil saya di topbar).
        Route::middleware('permission:users.view')->group(function () {
            Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        });
        Route::middleware('permission:users.create')->group(function () {
            Route::get('users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
            Route::post('users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
        });
        Route::get('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
        // Toggle status akun (Aktif ⇄ Nonaktif) — pengganti fitur Edit Pengguna.
        Route::middleware('permission:users.edit')->group(function () {
            Route::patch('users/{user}/toggle-status', [\App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');
        });
        Route::middleware('permission:users.delete')->group(function () {
            Route::delete('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
        });

        // Berita / News — gate per aksi
        // Catatan urutan: route statis (create) WAJIB didaftarkan sebelum
        // wildcard show (news/{news}), kalau tidak "create" tertangkap binding {news} → 404.
        Route::middleware('permission:news.view')->group(function () {
            Route::get('news', [NewsController::class, 'index'])->name('news.index');
        });
        Route::middleware('permission:news.create')->group(function () {
            Route::get('news/create', [NewsController::class, 'create'])->name('news.create');
            Route::post('news', [NewsController::class, 'store'])->name('news.store');
        });

        // Data Tamu (Guest Book) — gate per aksi
        Route::middleware('permission:tamu.view')->group(function () {
            Route::get('tamu', [\App\Http\Controllers\Admin\TamuController::class, 'index'])->name('tamu.index');
            Route::get('tamu/export', [\App\Http\Controllers\Admin\TamuController::class, 'export'])->name('tamu.export');

            // Dokumen privat tamu (KTP & surat) — disajikan dari disk private,
            // tidak bisa diakses via /storage. Wajib auth + tamu.view.
            Route::get('tamu/{tamu}/ktp', [\App\Http\Controllers\TamuDocumentController::class, 'ktp'])->name('tamu.ktp');
            Route::get('tamu/{tamu}/surat', [\App\Http\Controllers\TamuDocumentController::class, 'surat'])->name('tamu.surat');
        });
        Route::middleware('permission:tamu.create')->group(function () {
            Route::post('tamu', [\App\Http\Controllers\Admin\TamuController::class, 'store'])->name('tamu.store');
            Route::put('tamu/{tamu}', [\App\Http\Controllers\Admin\TamuController::class, 'update'])->name('tamu.update');
        });
        Route::middleware('permission:tamu.checkout')->group(function () {
            Route::patch('tamu/{tamu}/checkout', [\App\Http\Controllers\Admin\TamuController::class, 'checkout'])->name('tamu.checkout');
        });
        Route::middleware('permission:tamu.delete')->group(function () {
            Route::delete('tamu/{tamu}', [\App\Http\Controllers\Admin\TamuController::class, 'destroy'])->name('tamu.destroy');
        });
        Route::middleware('permission:news.view')->group(function () {
            Route::get('news/{news}', [NewsController::class, 'show'])->name('news.show');
        });
        Route::middleware('permission:news.edit')->group(function () {
            Route::get('news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
            Route::put('news/{news}', [NewsController::class, 'update'])->name('news.update');
        });
        Route::middleware('permission:news.publish')->group(function () {
            Route::post('/news/{news}/publish', [NewsController::class, 'togglePublish'])->name('news.publish');
        });
        Route::middleware('permission:news.delete')->group(function () {
            Route::delete('news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
        });

        // Galeri / Gallery — gate per aksi
        Route::middleware('permission:galleries.view')->group(function () {
            Route::get('galeri', [GalleryController::class, 'index'])->name('galeri.index');
        });
        Route::middleware('permission:galleries.create')->group(function () {
            Route::get('galeri/create', [GalleryController::class, 'create'])->name('galeri.create');
            Route::post('galeri', [GalleryController::class, 'store'])->name('galeri.store');
        });
        Route::middleware('permission:galleries.edit')->group(function () {
            Route::get('galeri/{galeri}/edit', [GalleryController::class, 'edit'])->name('galeri.edit');
            Route::put('galeri/{galeri}', [GalleryController::class, 'update'])->name('galeri.update');
            Route::patch('/galeri/{id}/toggle-status', [GalleryController::class, 'toggleStatus'])->name('galeri.toggle-status');
        });
        Route::middleware('permission:galleries.delete')->group(function () {
            Route::delete('galeri/{galeri}', [GalleryController::class, 'destroy'])->name('galeri.destroy');
        });

        // Pengumuman / Announcements — gate per aksi (urutan statis sebelum wildcard, lihat catatan Berita)
        Route::middleware('permission:announcements.view')->group(function () {
            Route::get('announcements', [\App\Http\Controllers\Admin\AnnouncementController::class, 'index'])->name('announcements.index');
        });
        Route::middleware('permission:announcements.create')->group(function () {
            Route::get('announcements/create', [\App\Http\Controllers\Admin\AnnouncementController::class, 'create'])->name('announcements.create');
            Route::post('announcements', [\App\Http\Controllers\Admin\AnnouncementController::class, 'store'])->name('announcements.store');
        });
        Route::middleware('permission:announcements.view')->group(function () {
            Route::get('announcements/{announcement}', [\App\Http\Controllers\Admin\AnnouncementController::class, 'show'])->name('announcements.show');
        });
        Route::middleware('permission:announcements.edit')->group(function () {
            Route::get('announcements/{announcement}/edit', [\App\Http\Controllers\Admin\AnnouncementController::class, 'edit'])->name('announcements.edit');
            Route::put('announcements/{announcement}', [\App\Http\Controllers\Admin\AnnouncementController::class, 'update'])->name('announcements.update');
        });
        Route::middleware('permission:announcements.publish')->group(function () {
            Route::post('/announcements/{announcement}/publish', [\App\Http\Controllers\Admin\AnnouncementController::class, 'togglePublish'])->name('announcements.publish');
        });
        Route::middleware('permission:announcements.delete')->group(function () {
            Route::delete('announcements/{announcement}', [\App\Http\Controllers\Admin\AnnouncementController::class, 'destroy'])->name('announcements.destroy');
        });

        // Log Aktivitas — hanya untuk yang punya permission activity_logs.view (role Administrator)
        Route::middleware('permission:activity_logs.view')->group(function () {
            Route::get('activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');
            Route::delete('activity-logs/{uuid}', [\App\Http\Controllers\Admin\ActivityLogController::class, 'destroy'])->name('activity-logs.destroy');
            Route::delete('activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'clear'])->name('activity-logs.clear');
        });

        // Pengaturan Panel (tema, preferensi tampilan)
        Route::get('/settings', function () {
            return view('admin.settings');
        })->name('settings');

        // Pencarian topbar (Ctrl+K / ikon kaca pembesar)
        Route::get('/search', \App\Http\Controllers\Admin\AdminSearchController::class)
            ->name('search');

        // Lonceng notifikasi topbar: poll JSON (dot & badge live) + tandai
        // tamu sudah dilihat saat dropdown dibuka.
        Route::get('/notifications/poll', [\App\Http\Controllers\Admin\NotificationController::class, 'poll'])->name('notifications.poll');
        Route::post('/notifications/seen', [\App\Http\Controllers\Admin\NotificationController::class, 'seen'])->name('notifications.seen');

        // Halaman CMS (Page Management) — permission per aksi
        Route::middleware('permission:pages.view')->group(function () {
            Route::get('pages', [\App\Http\Controllers\Admin\PageController::class, 'index'])->name('pages.index');
        });

        Route::middleware('permission:pages.create')->group(function () {
            Route::get('pages/create', [\App\Http\Controllers\Admin\PageController::class, 'create'])->name('pages.create');
            Route::post('pages', [\App\Http\Controllers\Admin\PageController::class, 'store'])->name('pages.store');
        });

        Route::middleware('permission:pages.edit')->group(function () {
            Route::get('pages/{page}/edit', [\App\Http\Controllers\Admin\PageController::class, 'edit'])->name('pages.edit');
            Route::put('pages/{page}', [\App\Http\Controllers\Admin\PageController::class, 'update'])->name('pages.update');
            Route::post('pages/{page}/publish', [\App\Http\Controllers\Admin\PageController::class, 'togglePublish'])->name('pages.publish');

            Route::post('pages/{page}/sections', [\App\Http\Controllers\Admin\PageSectionController::class, 'store'])->name('pages.sections.store');
            Route::put('pages/{page}/sections/{section}', [\App\Http\Controllers\Admin\PageSectionController::class, 'update'])->name('pages.sections.update');
            Route::post('pages/{page}/sections/{section}/move', [\App\Http\Controllers\Admin\PageSectionController::class, 'move'])->name('pages.sections.move');
        });

        Route::middleware('permission:pages.delete')->group(function () {
            Route::delete('pages/{page}', [\App\Http\Controllers\Admin\PageController::class, 'destroy'])->name('pages.destroy');
            Route::delete('pages/{page}/sections/{section}', [\App\Http\Controllers\Admin\PageSectionController::class, 'destroy'])->name('pages.sections.destroy');
        });

        // Menu Builder (Menu Management) — permission per aksi
        Route::middleware('permission:menus.view')->group(function () {
            Route::get('menus', [\App\Http\Controllers\Admin\MenuController::class, 'index'])->name('menus.index');
        });

        Route::middleware('permission:menus.create')->group(function () {
            Route::get('menus/create', [\App\Http\Controllers\Admin\MenuController::class, 'create'])->name('menus.create');
            Route::post('menus', [\App\Http\Controllers\Admin\MenuController::class, 'store'])->name('menus.store');
        });

        Route::middleware('permission:menus.edit')->group(function () {
            Route::get('menus/{menu}/edit', [\App\Http\Controllers\Admin\MenuController::class, 'edit'])->name('menus.edit');
            Route::put('menus/{menu}', [\App\Http\Controllers\Admin\MenuController::class, 'update'])->name('menus.update');
            Route::patch('menus/{menu}/toggle-status', [\App\Http\Controllers\Admin\MenuController::class, 'toggleStatus'])->name('menus.toggle-status');
            Route::patch('menus/{menu}/move', [\App\Http\Controllers\Admin\MenuController::class, 'move'])->name('menus.move');
        });

        Route::middleware('permission:menus.delete')->group(function () {
            Route::delete('menus/{menu}', [\App\Http\Controllers\Admin\MenuController::class, 'destroy'])->name('menus.destroy');
        });

        // Role & Permission — gate per aksi
        Route::middleware('permission:roles.view')->group(function () {
            Route::get('roles', [\App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles.index');
            Route::get('/roles/{role}/permissions', [\App\Http\Controllers\Admin\RoleController::class, 'permissions'])->name('roles.permissions');
        });
        Route::middleware('permission:roles.create')->group(function () {
            Route::get('roles/create', [\App\Http\Controllers\Admin\RoleController::class, 'create'])->name('roles.create');
            Route::post('roles', [\App\Http\Controllers\Admin\RoleController::class, 'store'])->name('roles.store');
        });
        Route::middleware('permission:roles.edit')->group(function () {
            Route::get('roles/{role}/edit', [\App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('roles.edit');
            Route::put('roles/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'update'])->name('roles.update');
            Route::put('/roles/{role}/toggle-status', [\App\Http\Controllers\Admin\RoleController::class, 'toggleStatus'])->name('roles.toggle-status');
        });
        Route::middleware('permission:roles.assign_permission')->group(function () {
            Route::put('/roles/{role}/permissions', [\App\Http\Controllers\Admin\RoleController::class, 'updatePermissions'])->name('roles.permissions.update');
        });
        Route::middleware('permission:roles.delete')->group(function () {
            Route::delete('roles/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('roles.destroy');
        });
    });
});

