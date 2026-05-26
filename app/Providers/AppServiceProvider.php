<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Filament\Facades\Filament;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 🚀 BYPASS MARKDOWN: Alihkan link reset password ke template Pure HTML/CSS kustom
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {

            // 🔥 Menggunakan generator URL resmi Panel Admin Filament v3 (Anti Eror Route)
            $viewUrl = Filament::getPanel('admin')->getResetPasswordUrl($token, $notifiable);

            $mail = new MailMessage();

            return $mail
                ->subject('Atur Ulang Kata Sandi - Kawungpitu Institute')
                ->view('emails.reset-password', [
                    'url' => $viewUrl,
                    'name' => $notifiable->name ?? 'Admin',
                ]);
        });
    }
}
