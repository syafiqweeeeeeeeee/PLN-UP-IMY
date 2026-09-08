<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang-kami/sejarah', [HomeController::class, 'sejarah'])->name('sejarah');
Route::get('/tentang-kami/visi-misi', [HomeController::class, 'visiMisi'])->name('visi-misi');
