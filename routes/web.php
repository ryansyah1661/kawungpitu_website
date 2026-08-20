<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root ke /id (default locale)
Route::redirect('/', '/id');

// 🚀 PREFIX LOCALE (FRONTEND)
Route::prefix('{locale}')
    ->middleware('setlocale')
    ->where(['locale' => 'id|en']) 
    ->group(function () {

        // Beranda
        Route::get('/', [LandingPageController::class, 'index'])->name('home');

        // Tentang Kami
        Route::get('/about', [AboutController::class, 'index'])->name('tentang');

        // Artikel
        Route::get('/articles', [ArtikelController::class, 'index'])->name('artikel.index');
        Route::get('/articles/category/{slug}', [ArtikelController::class, 'byKategori'])->name('artikel.kategori');
        Route::get('/articles/{slug}', [ArtikelController::class, 'show'])->name('artikel.show');

        // Programs
        Route::get('/programs', [ProgramController::class, 'index'])->name('program.index');
        Route::get('/programs/{slug}', [ProgramController::class, 'show'])->name('program.show');

        // Galeri
        Route::get('/gallery', [GaleriController::class, 'index'])->name('galeri.index');
        Route::get('/gallery/{slug}', [GaleriController::class, 'show'])->name('galeri.show');
        Route::post('/gallery/photo/{id}/view', [GaleriController::class, 'incrementView'])->name('galeri.photo.view');

        // Kontak
        Route::get('/contact', [KontakController::class, 'index'])->name('kontak');
        Route::post('/contact', [KontakController::class, 'store'])->name('kontak.store');
    });

// 🚀 JARING PENGAMAN GLOBAL LOGIN
Route::get('/login', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('login');