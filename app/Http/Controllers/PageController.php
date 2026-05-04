<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Halaman Tentang Kami.
     * Menampilkan visi, misi, timeline sejarah, dan tim.
     */
    public function tentang(string $locale)
    {
        return view('frontend.about');
    }
}
