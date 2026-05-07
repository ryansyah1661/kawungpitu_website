<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Halaman index Program (Lingkar Belajar Kawung).
     */
    public function index(string $locale, Request $request)
    {
        $query = Program::with('category')->published();

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
        $totalMaterialsCount = Program::published()->count(); // Total murni semua program

        // 2. CEK AJAX
        if ($request->ajax()) {
            return view('frontend.partials.program-grid', compact('materials'))->render();
        }

        $categories = Category::programType()->orderBy('sort_order')->get();
        $popularPrograms = Program::published()->orderBy('view_count', 'desc')->take(5)->get();

        return view('frontend.program', compact('materials', 'categories', 'popularPrograms', 'totalMaterialsCount'));
    }

    /**
     * Halaman detail program.
     */
    public function show(string $locale, $slug)
    {
        $program = Program::where('slug', $slug)->firstOrFail();

        if (!$program->is_published) {
            abort(404);
        }

        $program->incrementViewCount();
        $program->load('category');

        $previousMaterial = Program::published()
            ->where('sort_order', '<', $program->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();

        $nextMaterial = Program::published()
            ->where('sort_order', '>', $program->sort_order)
            ->orderBy('sort_order', 'asc')
            ->first();

        return view('frontend.program-detail', compact('program', 'previousMaterial', 'nextMaterial'));
    }
}
