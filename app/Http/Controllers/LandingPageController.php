<?php

namespace App\Http\Controllers;

use App\Models\Article;

class LandingPageController extends Controller
{
    /**
     * Halaman Beranda.
     * Menampilkan hero, siapa kami, program, artikel terbaru, dan CTA.
     */
    public function index(string $locale)
    {
        $latestArticles = Article::with('categories')
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('frontend.home', compact('latestArticles'));
    }
}
