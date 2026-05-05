<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Mail\ContactNotification; // Import Mailable
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Import Mail Facade

class KontakController extends Controller
{
    public function index(string $locale)
    {
        return view('frontend.contact');
    }

    public function store(string $locale, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // 1. Simpan ke Database
        $contactMessage = Message::create($validated);

        try {
            Mail::to('info@kawungpitu.org')->send(new ContactNotification($contactMessage));
        } catch (\Exception $e) {
        }

        return redirect()
            ->back()
            ->with('success', __('Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.'));
    }
}
