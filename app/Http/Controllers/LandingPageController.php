<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Faq;

class LandingPageController extends Controller
{
    /**
     * Halaman Beranda.
     * Menampilkan hero, siapa kami, program, artikel terbaru, dan CTA.
     */
    public function index(string $locale)
    {
        $latestArticles = Article::with('category')
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $faqs = Faq::orderBy('sort_order')->take(3)->get();

        return view('frontend.home', compact('latestArticles', 'faqs'));
    }
}
