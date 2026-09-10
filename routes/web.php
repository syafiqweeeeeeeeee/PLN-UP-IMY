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

