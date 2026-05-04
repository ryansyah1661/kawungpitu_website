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

        // Filter by search (Lebih dinamis mengikuti bahasa yang sedang aktif)
        if ($request->filled('search')) {
            $search = $request->search;
            $currentLocale = app()->getLocale();

            $query->where(function ($q) use ($search, $currentLocale) {
                // Mencari hanya di bahasa yang sedang dibuka user agar hasil lebih akurat
                $q->where("title->{$currentLocale}", 'like', "%{$search}%")
                    ->orWhere("body->{$currentLocale}", 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->whereHas('category', function ($q) use ($request) {
                $currentLocale = app()->getLocale();
                $q->where("slug->{$currentLocale}", $request->kategori);
            });
        }

        $articles = $query->latest('published_at')->paginate(6);
        $categories = Category::articleType()->orderBy('sort_order')->get();
        $popularArticles = Article::published()->orderBy('view_count', 'desc')->take(5)->get();

        return view('frontend.articles', compact('articles', 'categories', 'popularArticles'));
    }

    public function byKategori(string $locale, $kategoriSlug)
    {
        // Cari kategori berdasarkan slug translatable
        $currentLocale = app()->getLocale();
        $kategori = Category::where("slug->{$currentLocale}", $kategoriSlug)->firstOrFail();

        $articles = Article::with('category')
            ->where('category_id', $kategori->id)
            ->published()
            ->latest('published_at')
            ->paginate(6);

        $categories = Category::articleType()->orderBy('sort_order')->get();
        $popularArticles = Article::published()->orderBy('view_count', 'desc')->take(5)->get();
        $currentCategory = $kategori;

        return view('frontend.articles', compact('articles', 'categories', 'popularArticles', 'currentCategory'));
    }

    public function show(string $locale, $slug)
    {
        // Slug adalah kolom varchar biasa (bukan translatable)
        $artikel = Article::where('slug', $slug)->firstOrFail();

        // Hanya tampilkan jika sudah dipublish
        if (!$artikel->is_published) {
            abort(404);
        }

        // Increment view count
        $artikel->incrementViewCount();

        // Load relasi
        $artikel->load('category');

        // Artikel terkait
        $relatedArticles = Article::with('category')
            ->where('category_id', $artikel->category_id)
            ->where('id', '!=', $artikel->id)
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('frontend.articles-detail', compact('artikel', 'relatedArticles'));
    }
}
