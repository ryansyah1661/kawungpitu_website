<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumPhoto;
use Illuminate\Http\Request;

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

    public function show(string $locale, string $slug)
    {
        $album = Album::where('slug', '=', $slug)->firstOrFail();

        if (!$album->is_published) {
            abort(404);
        }

        $album->load(['photos' => function ($query) {
            $query->orderBy('sort_order');
        }]);

        return view('frontend.gallery-detail', compact('album'));
    }

    public function incrementView(string $locale, int $id)
    {
        $photo = AlbumPhoto::findOrFail($id);
        $photo->increment('views');

        return response()->json([
            'success' => true,
            'views' => $photo->views
        ]);
    }
}
