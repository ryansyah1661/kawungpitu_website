<?php

namespace App\Http\Controllers;

use App\Models\Album;

class GaleriController extends Controller
{
    /**
     * Halaman index galeri.
     * Menampilkan daftar album dengan cover dan jumlah foto.
     */
    public function index(string $locale)
    {
        $albums = Album::withCount('photos')
            ->published()
            ->orderBy('sort_order')
            ->get();

        return view('frontend.gallery', compact('albums'));
    }

    /**
     * Halaman detail album.
     * Menampilkan semua foto dalam album (masonry grid + lightbox).
     */
    public function show(string $locale, Album $album)
    {
        if (!$album->is_published) {
            abort(404);
        }

        $album->load(['photos' => function ($query) {
            $query->orderBy('sort_order');
        }]);

        return view('frontend.gallery-detail', compact('album'));
    }
}
