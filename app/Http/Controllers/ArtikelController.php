<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(string $locale, Request $request)
    {
        $query = Article::with('category')->published();

        // Filter Search
        if ($request->filled('search')) {
            $search = $request->search;
            $currentLocale = app()->getLocale();
            $query->where(function ($q) use ($search, $currentLocale) {
                $q->where("title->{$currentLocale}", 'like', "%{$search}%")
                    ->orWhere("body->{$currentLocale}", 'like', "%{$search}%");
            });
        }

        // Filter Category via Query String
        if ($request->filled('kategori')) {
            $query->whereHas('category', function ($q) use ($request) {
                $currentLocale = app()->getLocale();
                $q->where("slug->{$currentLocale}", $request->kategori);
            });
        }

        $articles = $query->latest('published_at')->paginate(6);
        $totalArticlesCount = Article::published()->count(); // Total murni semua artikel

        if ($request->ajax()) {
            return view('frontend.partials.article-grid', compact('articles'))->render();
        }

        $categories = Category::articleType()->orderBy('sort_order')->get();
        $popularArticles = Article::published()->orderBy('view_count', 'desc')->take(5)->get();

        return view('frontend.articles', compact('articles', 'categories', 'popularArticles', 'totalArticlesCount'));
    }

    public function byKategori(string $locale, $kategoriSlug, Request $request)
    {
        $currentLocale = app()->getLocale();
        $kategori = Category::where("slug->{$currentLocale}", $kategoriSlug)->firstOrFail();

        // DEFINISIKAN DATA DULU
        $articles = Article::with('category')
            ->where('category_id', $kategori->id)
            ->published()
            ->latest('published_at')
            ->paginate(6);

        $totalArticlesCount = Article::published()->count();

        // BARU CEK AJAX
        if ($request->ajax()) {
            return view('frontend.partials.article-grid', compact('articles'))->render();
        }

        $categories = Category::articleType()->orderBy('sort_order')->get();
        $popularArticles = Article::published()->orderBy('view_count', 'desc')->take(5)->get();
        $currentCategory = $kategori;

        return view('frontend.articles', compact('articles', 'categories', 'popularArticles', 'currentCategory', 'totalArticlesCount'));
    }

    public function show(string $locale, $slug)
    {
        $artikel = Article::where('slug', $slug)->firstOrFail();
        if (!$artikel->is_published) {
            abort(404);
        }
        $artikel->incrementViewCount();
        $artikel->load('category');

        $relatedArticles = Article::with('category')
            ->where('category_id', $artikel->category_id)
            ->where('id', '!=', $artikel->id)
            ->published()
            ->latest('published_at')
            ->take(3)->get();

        return view('frontend.articles-detail', compact('artikel', 'relatedArticles'));
    }
}
