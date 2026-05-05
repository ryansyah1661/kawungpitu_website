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

        // Filter by category
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

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $currentLocale = app()->getLocale();
            $query->where("title->{$currentLocale}", 'like', "%{$search}%");
        }

        // 1. DEFINISIKAN DATA DULU
        $materials = $query->orderBy('sort_order')->paginate(9);
        $totalMaterialsCount = LbkMaterial::published()->count(); // Total murni semua program

        // 2. CEK AJAX
        if ($request->ajax()) {
            return view('frontend.partials.lbk-grid', compact('materials'))->render();
        }

        $categories = Category::lbkType()->orderBy('sort_order')->get();
        $popularPrograms = LbkMaterial::published()->orderBy('view_count', 'desc')->take(5)->get();

        return view('frontend.learning-circles', compact('materials', 'categories', 'popularPrograms', 'totalMaterialsCount'));
    }

    /**
     * Halaman detail program.
     */
    public function show(string $locale, $slug)
    {
        $lbk = LbkMaterial::where('slug', $slug)->firstOrFail();

        if (!$lbk->is_published) {
            abort(404);
        }

        $lbk->incrementViewCount();
        $lbk->load('category');

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
