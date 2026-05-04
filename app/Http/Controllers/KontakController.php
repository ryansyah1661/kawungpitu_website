<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Halaman kontak.
     * Menampilkan form kontak dan informasi alamat.
     */
    public function index(string $locale)
    {
        return view('frontend.contact');
    }

    /**
     * Proses submit form kontak.
     * Simpan pesan ke database dan redirect dengan notifikasi sukses.
     */
    public function store(string $locale, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Message::create($validated);

        return redirect()
            ->back()
            ->with('success', __('Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.'));
    }
}
