<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Halaman FAQ.
     * Menampilkan daftar pertanyaan dan jawaban dalam format accordion.
     */
    public function index(string $locale)
    {
        $faqs = Faq::active()->get();

        return view('frontend.faq', compact('faqs'));
    }
}
