<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LbkController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root ke /id (default locale)
Route::redirect('/', '/id');

// Route group dengan locale prefix + middleware
Route::group(['prefix' => '{locale}', 'middleware' => 'setlocale'], function () {

    // Beranda
    Route::get('/', [LandingPageController::class, 'index'])->name('home');

    // Tentang Kami (URI diubah ke /about agar universal)
    Route::get('/about', [AboutController::class, 'index'])->name('tentang');

    // Artikel (URI menggunakan /articles agar universal)
    Route::get('/articles', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('/articles/category/{slug}', [ArtikelController::class, 'byKategori'])->name('artikel.kategori');
    Route::get('/articles/{slug}', [ArtikelController::class, 'show'])->name('artikel.show');

    // Programs / LBK (Sudah sesuai permintaanmu ke /program)
    Route::get('/programs', [LbkController::class, 'index'])->name('lbk.index');
    Route::get('/programs/{slug}', [LbkController::class, 'show'])->name('lbk.show');

    // Galeri (URI menggunakan /gallery agar universal)
    Route::get('/gallery', [GaleriController::class, 'index'])->name('galeri.index');
    Route::get('/gallery/{slug}', [GaleriController::class, 'show'])->name('galeri.show');

    // FAQ
    Route::get('/faq', [FaqController::class, 'index'])->name('faq');

    // Kontak (URI menggunakan /contact agar universal)
    Route::get('/contact', [KontakController::class, 'index'])->name('kontak');
    Route::post('/contact', [KontakController::class, 'store'])->name('kontak.store');
});
