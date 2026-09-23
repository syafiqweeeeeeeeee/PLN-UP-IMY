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

Route::get('/layanan/daftar', function () {
    return view('layanan.daftar_layanan');
})->name('layanan.daftar');

Route::get('/layanan/faq', function () {
    return view('layanan.faq');
})->name('layanan.faq');


$layananData = [
    'pasang-baru' => [
        'judul'     => 'Pasang Baru',
        'deskripsi' => 'Layanan permohonan penyambungan baru listrik untuk rumah tangga, industri, dan komersial.',
        'subjudul'  => 'Penyambungan Baru Listrik',
        'icon'      => 'fa-bolt',
        'icon_bg'   => 'linear-gradient(135deg, #e74c3c, #f87171)',
        'konten'    => '<h3><i class="fas fa-info-circle"></i> Tentang Layanan</h3>
            <p>Layanan Pasang Baru adalah layanan permohonan penyambungan instalasi listrik baru yang ditujukan untuk pelanggan baru yang belum terhubung dengan jaringan kelistrikan PLN. Layanan ini mencakup proses pendaftaran, survei, pemasangan jaringan, hingga energisasi.</p>

            <div class="info-box">
                <h4><i class="fas fa-check-circle"></i> Syarat & Ketentuan</h4>
                <ul>
                    <li>Fotokopi KTP pemohon</li>
                    <li>Fotokopi bukti kepemilikan tanah / surat sewa / perjanjian pemakaian</li>
                    <li>Surat pernyataan tidak sedang dalam sengketa</li>
                    <li>Foto instalasi / denah lokasi</li>
                </ul>
            </div>

            <h3><i class="fas fa-list-ol"></i> Alur Proses</h3>
            <ul class="step-list">
                <li>Pengajuan permohonan secara online atau langsung ke kantor UP PLTU Indramayu</li>
                <li>Penerimaan dan pencatatan berkas oleh petugas PPID</li>
                <li>Verifikasi dan survei lokasi oleh tim teknis</li>
                <li>Penetapan tarif dan biaya penyambungan</li>
                <li>Pelaksanaan pemasangan jaringan dan meteran</li>
                <li>Energisasi dan penyerahan surat perintah energi</li>
            </ul>

            <h3><i class="fas fa-clock"></i> Estimasi Waktu</h3>
            <p>Proses penyambungan baru membutuhkan estimasi waktu <strong>3 – 14 hari kerja</strong> tergantung pada kapasitas daya dan kondisi teknis lokasi pelanggan.</p>'
    ],
    'sambung-sementara' => [
        'judul'     => 'Sambung Sementara',
        'deskripsi' => 'Layanan permohonan penyambungan listrik sementara untuk kebutuhan acara, proyek konstruksi, atau penggunaan jangka pendek.',
        'subjudul'  => 'Penyambungan Listrik Sementara',
        'icon'      => 'fa-plug',
        'icon_bg'   => 'linear-gradient(135deg, #2980b9, #60a5fa)',
        'konten'    => '<h3><i class="fas fa-info-circle"></i> Tentang Layanan</h3>
            <p>Layanan Sambung Sementara memberikan kemudahan kepada masyarakat yang membutuhkan pasokan listrik dalam jangka waktu terbatas. Cocok untuk penyelenggaraan event, pameran, proyek konstruksi, dan kebutuhan sementara lainnya.</p>

            <div class="info-box">
                <h4><i class="fas fa-check-circle"></i> Syarat & Ketentuan</h4>
                <ul>
                    <li>Fotokopi KTP pemohon</li>
                    <li>Surat permohonan resmi</li>
                    <li>Surat izin dari pemilik lahan (jika lokasi bukan milik sendiri)</li>
                    <li>Estimasi durasi penggunaan</li>
                </ul>
            </div>

            <h3><i class="fas fa-list-ol"></i> Alur Proses</h3>
            <ul class="step-list">
                <li>Pengajuan permohonan sambungan sementara</li>
                <li>Verifikasi berkas dan survei lokasi</li>
                <li>Penetapan biaya sewa dan tarif kWh</li>
                <li>Pemasangan instalasi sementara</li>
                <li>Energisasi untuk durasi yang disepakati</li>
                <li>Dem energisasi dan pencabutan instalasi</li>
            </ul>

            <h3><i class="fas fa-clock"></i> Estimasi Waktu</h3>
            <p>Proses pemasangan sambungan sementara membutuhkan estimasi waktu <strong>2 – 7 hari kerja</strong> tergantung pada kapasitas daya dan kondisi lokasi.</p>'
    ],
    'ubah-daya' => [
        'judul'     => 'Ubah Daya',
        'deskripsi' => 'Layanan permohonan perubahan daya listrik untuk menyesuaikan kapasitas sesuai kebutuhan pelanggan.',
        'subjudul'  => 'Perubahan Daya Listrik',
        'icon'      => 'fa-exchange-alt',
        'icon_bg'   => 'linear-gradient(135deg, #d4a017, #fbbf24)',
        'konten'    => '<h3><i class="fas fa-info-circle"></i> Tentang Layanan</h3>
            <p>Layanan Ubah Daya memungkinkan pelanggan untuk menyesuaikan kapasitas daya listrik sesuai kebutuhan, baik untuk menambah daya (upgrade) maupun mengurangi daya (downgrade). Proses ini dilakukan secara resmi melalui mekanisme PPID.</p>

            <div class="info-box">
                <h4><i class="fas fa-check-circle"></i> Syarat & Ketentuan</h4>
                <ul>
                    <li>Fotokopi KTP pemegang akun</li>
                    <li>Nomor pelanggan / ID pelanggan</li>
                    <li>Surat permohonan perubahan daya</li>
                    <li>Bukti pembayaran biaya perubahan daya</li>
                </ul>
            </div>

            <h3><i class="fas fa-list-ol"></i> Alur Proses</h3>
            <ul class="step-list">
                <li>Pengajuan permohonan perubahan daya</li>
                <li>Verifikasi data pelanggan dan tagihan</li>
                <li>Penetapan biaya perubahan daya</li>
                <li>Pelaksanaan penggantian meteran / MCB</li>
                <li>Pencatatan dan energisasi dengan daya baru</li>
            </ul>

            <h3><i class="fas fa-clock"></i> Estimasi Waktu</h3>
            <p>Proses perubahan daya membutuhkan estimasi waktu <strong>1 – 5 hari kerja</strong> tergantung pada jenis perubahan dan ketersediaan komponen teknis.</p>'
    ],
    'simulasi-pasang-baru' => [
        'judul'     => 'Simulasi Pasang Baru',
        'deskripsi' => 'Simulasi biaya permohonan penyambungan baru listrik untuk estimasi anggaran.',
        'subjudul'  => 'Kalkulator Biaya Penyambungan Baru',
        'icon'      => 'fa-calculator',
        'icon_bg'   => 'linear-gradient(135deg, #e8836b, #fca5a5)',
        'konten'    => '<h3><i class="fas fa-info-circle"></i> Tentang Simulasi</h3>
            <p>Simulasi Pasang Baru membantu Anda memperkirakan biaya yang diperlukan untuk penyambungan listrik baru sebelum mengajukan permohonan resmi. Perhitungan didasarkan pada kapasitas daya yang diinginkan dan tarif berlaku.</p>

            <div class="info-box">
                <h4><i class="fas fa-calculator"></i> Komponen Biaya</h4>
                <ul>
                    <li>Biaya penyambungan (dibedakan berdasarkan golongan daya)</li>
                    <li>Biaya material (kabel, meteran, MCB)</li>
                    <li>Biaya survei lokasi</li>
                    <li>Biaya administrasi</li>
                </ul>
            </div>

            <h3><i class="fas fa-exclamation-triangle"></i> Catatan Penting</h3>
            <p>Hasil simulasi bersifat <strong>estimasi</strong> dan dapat berubah sewaktu-waktu sesuai dengan kebijakan tarif PLN yang berlaku. Untuk perhitungan pasti, silakan mengajukan permohonan resmi melalui layanan Pasang Baru.</p>'
    ],
    'simulasi-sambung-sementara' => [
        'judul'     => 'Simulasi Sambung Sementara',
        'deskripsi' => 'Simulasi biaya permohonan penyambungan listrik sementara.',
        'subjudul'  => 'Kalkulator Biaya Sambung Sementara',
        'icon'      => 'fa-calculator',
        'icon_bg'   => 'linear-gradient(135deg, #6ba3d6, #93c5fd)',
        'konten'    => '<h3><i class="fas fa-info-circle"></i> Tentang Simulasi</h3>
            <p>Simulasi Sambung Sementara membantu Anda memperkirakan biaya yang diperlukan untuk penyambungan listrik sementara, termasuk biaya sewa instalasi dan tarif energi selama masa penggunaan.</p>

            <div class="info-box">
                <h4><i class="fas fa-calculator"></i> Komponen Biaya</h4>
                <ul>
                    <li>Biaya sewa instalasi sementara</li>
                    <li>Biaya material dan pemasangan</li>
                    <li>Biaya energi (tarif kWh selama durasi)</li>
                    <li>Biaya dem energisasi</li>
                </ul>
            </div>

            <h3><i class="fas fa-exclamation-triangle"></i> Catatan Penting</h3>
            <p>Hasil simulasi bersifat <strong>estimasi</strong> dan dapat berubah sesuai durasi penggunaan dan kapasitas daya. Untuk perhitungan pasti, silakan mengajukan permohonan resmi melalui layanan Sambung Sementara.</p>'
    ],
    'simulasi-ubah-daya' => [
        'judul'     => 'Simulasi Ubah Daya',
        'deskripsi' => 'Simulasi biaya permohonan perubahan daya listrik.',
        'subjudul'  => 'Kalkulator Biaya Perubahan Daya',
        'icon'      => 'fa-calculator',
        'icon_bg'   => 'linear-gradient(135deg, #d4b84a, #fde68a)',
        'konten'    => '<h3><i class="fas fa-info-circle"></i> Tentang Simulasi</h3>
            <p>Simulasi Ubah Daya membantu Anda memperkirakan biaya yang diperlukan untuk menambah atau mengurangi daya listrik sesuai kebutuhan Anda.</p>

            <div class="info-box">
                <h4><i class="fas fa-calculator"></i> Komponen Biaya</h4>
                <ul>
                    <li>Biaya perubahan daya (upgrade / downgrade)</li>
                    <li>Biaya penggantian meteran / MCB</li>
                    <li>Biaya material pendukung</li>
                    <li>Biaya administrasi</li>
                </ul>
            </div>

            <h3><i class="fas fa-exclamation-triangle"></i> Catatan Penting</h3>
            <p>Hasil simulasi bersifat <strong>estimasi</strong> dan dapat berubah sesuai dengan jenis perubahan daya dan tarif PLN yang berlaku. Untuk perhitungan pasti, silakan mengajukan permohonan resmi melalui layanan Ubah Daya.</p>'
    ],
];

Route::get('/layanan/{slug}', function ($slug) use ($layananData) {
    if (!isset($layananData[$slug])) {
        abort(404);
    }
    return view('layanan.detail_layanan', ['layanan' => $layananData[$slug]]);
})->name('layanan.detail');

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

