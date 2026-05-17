<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class CustomLogin extends BaseLogin
{
    public function getHeading(): string | Htmlable
    {
        // Mengambil teks dari file messages.php dengan key 'login.heading'
        return __('messages.login.heading');
    }

    public function getTitle(): string
    {
        // Mengubah tulisan "Masuk" di tab atas menjadi "Admin"
        return 'Admin'; 
    }

    public function getSubheading(): string | Htmlable | null
    {
        // Mengambil teks dari file messages.php dengan key 'login.subheading'
        return null; // Atau return __('messages.login.subheading'); jika ingin menampilkan subheading
    }
}