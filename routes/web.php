<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang-kami/sejarah', [HomeController::class, 'sejarah'])->name('sejarah');
Route::get('/tentang-kami/visi-misi', [HomeController::class, 'visiMisi'])->name('visi-misi');
Route::get('/tentang-kami/profil-perusahaan', [HomeController::class, 'profilPerusahaan'])->name('profil-perusahaan');
Route::get('/tentang-kami/struktur-organisasi', function () {
    return view('tentang_kami.struktur_organisasi');
})->name('struktur-organisasi');
Route::get('/informasi/galeri', function () {
    return view('informasi.galeri');
})->name('galeri');

Route::get('/informasi/berita', function () {
    return view('informasi.berita');
})->name('berita');

Route::get('/informasi/pengumuman', function () {
    return view('informasi.pengumuman');
})->name('pengumuman');

Route::get('/layanan/daftar', function () {
    return view('layanan.daftar_layanan');
})->name('layanan.daftar');

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

// Admin Dashboard
// Login
Route::get('/admin/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/admin/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Admin Dashboard
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Pengguna
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

        // Role & Permission
        Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class)->except(['show']);
        Route::get('/roles/{role}/permissions', [\App\Http\Controllers\Admin\RoleController::class, 'permissions'])->name('roles.permissions');
        Route::put('/roles/{role}/permissions', [\App\Http\Controllers\Admin\RoleController::class, 'updatePermissions'])->name('roles.permissions.update');
        Route::put('/roles/{role}/toggle-status', [\App\Http\Controllers\Admin\RoleController::class, 'toggleStatus'])->name('roles.toggle-status');
    });
});

