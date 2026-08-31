<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Halaman index Program.
     */
    public function index(string $locale, Request $request)
    {
        // Pastikan eager loading pake 'categories' (jamak)
        $query = Program::with('categories')->published();

        // Filter berdasarkan kategori (Many-to-Many)
        if ($request->filled('kategori')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $currentLocale = app()->getLocale();
                // Menggunakan JSON selector untuk slug translatable
                $q->where("slug->{$currentLocale}", $request->kategori);
            });
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search berdasarkan judul (Translatable)
        if ($request->filled('search')) {
            $search = $request->search;
            $currentLocale = app()->getLocale();
            $query->where("title->{$currentLocale}", 'like', "%{$search}%");
        }

        // Jika sort_order tidak ada di DB, ganti ke 'published_at' atau 'created_at'
        $materials = $query->orderBy('published_at', 'desc')->paginate(9);

        // Total murni semua program untuk statistik sidebar
        $totalMaterialsCount = Program::published()->count();

        // Response untuk AJAX (Filter/Pagination tanpa reload)
        if ($request->ajax()) {
            return view('frontend.partials.program-grid', compact('materials'))->render();
        }

        // Ambil kategori khusus tipe program
        $categories = Category::where('type', 'program')->orderBy('name')->get();

        // Program paling banyak dilihat
        $popularPrograms = Program::published()->orderBy('view_count', 'desc')->take(5)->get();

        // SAKTI: Kita gandakan variabelnya ke $programs biar aman dibaca oleh file program.blade.php kamu Qi!
        $programs = $materials;

        // Tambahkan 'programs' ke dalam compact()
        return view('frontend.program', compact('programs', 'materials', 'categories', 'popularPrograms', 'totalMaterialsCount'));
    }

    /**
     * Halaman detail program.
     */
    public function show(string $locale, $slug)
    {
        // Cari program berdasarkan slug
        $program = Program::where('slug', $slug)->firstOrFail();

        if (!$program->is_published) {
            abort(404);
        }

        // Update view count & load relasi categories
        $program->incrementViewCount();
        $program->load('categories');

        // Navigasi: Program Sebelumnya
        $previousMaterial = Program::published()
            ->where('published_at', '>', $program->published_at)
            ->orderBy('published_at', 'asc')
            ->first();

        // Navigasi: Program Selanjutnya
        $nextMaterial = Program::published()
            ->where('published_at', '<', $program->published_at)
            ->orderBy('published_at', 'desc')
            ->first();

        // Program Terkait
        $relatedPrograms = Program::published()
            ->where('id', '!=', $program->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // Pastikan nama view ini sesuai dengan file blade kamu
        return view('frontend.program-detail', compact('program', 'previousMaterial', 'nextMaterial', 'relatedPrograms'));
    }
}
