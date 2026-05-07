<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(string $locale, Request $request)
    {
        // 1. Eager Load 'categories' (jamak)
        $query = Article::with('categories')->published();

        // Filter Search (Judul & Isi)
        if ($request->filled('search')) {
            $search = $request->search;
            $currentLocale = app()->getLocale();
            $query->where(function ($q) use ($search, $currentLocale) {
                $q->where("title->{$currentLocale}", 'like', "%{$search}%")
                    ->orWhere("body->{$currentLocale}", 'like', "%{$search}%");
            });
        }

        // Filter Category via Query String (Many-to-Many)
        if ($request->filled('kategori')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $currentLocale = app()->getLocale();
                $q->where("slug->{$currentLocale}", $request->kategori);
            });
        }

        $articles = $query->latest('published_at')->paginate(6);
        $totalArticlesCount = Article::published()->count();

        if ($request->ajax()) {
            return view('frontend.partials.article-grid', compact('articles'))->render();
        }

        // Ambil kategori khusus tipe artikel
        $categories = Category::where('type', 'article')->orderBy('sort_order')->get();
        $popularArticles = Article::published()->orderBy('view_count', 'desc')->take(5)->get();

        return view('frontend.articles', compact('articles', 'categories', 'popularArticles', 'totalArticlesCount'));
    }

    public function byKategori(string $locale, $kategoriSlug, Request $request)
    {
        $currentLocale = app()->getLocale();
        $kategori = Category::where("slug->{$currentLocale}", $kategoriSlug)->firstOrFail();

        // DEFINISIKAN DATA: Mencari artikel yang memiliki kategori ini di tabel pivot
        $articles = Article::with('categories')
            ->whereHas('categories', function ($q) use ($kategori) {
                $q->where('categories.id', $kategori->id);
            })
            ->published()
            ->latest('published_at')
            ->paginate(6);

        $totalArticlesCount = Article::published()->count();

        if ($request->ajax()) {
            return view('frontend.partials.article-grid', compact('articles'))->render();
        }

        $categories = Category::where('type', 'article')->orderBy('sort_order')->get();
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
        $artikel->load('categories');

        // LOGIKA ARTIKEL TERKAIT: 
        // Mencari artikel lain yang punya salah satu kategori yang sama dengan artikel ini
        $categoryIds = $artikel->categories->pluck('id')->toArray();

        $relatedArticles = Article::with('categories')
            ->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
            })
            ->where('id', '!=', $artikel->id) // Jangan tampilkan artikel itu sendiri
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('frontend.articles-detail', compact('artikel', 'relatedArticles'));
    }
}
