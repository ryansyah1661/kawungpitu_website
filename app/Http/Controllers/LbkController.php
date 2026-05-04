<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LbkMaterial;
use Illuminate\Http\Request;

class LbkController extends Controller
{
    /**
     * Halaman index Program (Lingkar Belajar Kawung).
     */
    public function index(string $locale, Request $request)
    {
        $query = LbkMaterial::with('category')->published();

        // Filter by category (Mencari slug kategori di dalam JSON)
        if ($request->filled('kategori')) {
            $query->whereHas('category', function ($q) use ($request) {
                $currentLocale = app()->getLocale();
                $q->where("slug->{$currentLocale}", $request->kategori);
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search (Opsional, jika kamu mau nambahin fitur search di LBK juga)
        if ($request->filled('search')) {
            $search = $request->search;
            $currentLocale = app()->getLocale();
            $query->where("title->{$currentLocale}", 'like', "%{$search}%");
        }

        $materials = $query->orderBy('sort_order')->paginate(9);
        $categories = Category::lbkType()->orderBy('sort_order')->get();
        $popularPrograms = LbkMaterial::published()->orderBy('view_count', 'desc')->take(5)->get();

        return view('frontend.learning-circles', compact('materials', 'categories', 'popularPrograms'));
    }

    /**
     * Halaman detail program.
     */
    public function show(string $locale, $slug)
    {
        // Slug adalah kolom varchar biasa (bukan translatable)
        $lbk = LbkMaterial::where('slug', $slug)->firstOrFail();

        if (!$lbk->is_published) {
            abort(404);
        }

        // Increment view count
        $lbk->incrementViewCount();

        $lbk->load('category');

        // Navigasi materi sebelumnya & berikutnya (Tetap pakai sort_order)
        $previousMaterial = LbkMaterial::published()
            ->where('sort_order', '<', $lbk->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();

        $nextMaterial = LbkMaterial::published()
            ->where('sort_order', '>', $lbk->sort_order)
            ->orderBy('sort_order', 'asc')
            ->first();

        return view('frontend.learning-circles-detail', compact('lbk', 'previousMaterial', 'nextMaterial'));
    }
}
