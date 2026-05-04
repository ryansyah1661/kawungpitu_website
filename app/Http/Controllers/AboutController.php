<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index(string $locale)
    {
        // Mengambil data advisors dan struktur berdasarkan tipe
        $advisors = TeamMember::where('type', 'advisor')->orderBy('sort_order')->get();
        $structures = TeamMember::where('type', 'structure')->orderBy('sort_order')->get();

        // Mengirim data ke view frontend.about
        return view('frontend.about', compact('advisors', 'structures'));
    }
}
