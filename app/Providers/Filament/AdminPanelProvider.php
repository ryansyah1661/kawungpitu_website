<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\CustomLogin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Illuminate\Support\Js;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('db')
            ->login(CustomLogin::class)
            ->passwordReset() // 🚀 AKSI SAKTI: Otomatis memunculkan fitur & link Lupa Kata Sandi di halaman login
            ->brandName('Kawungpitu Institute')
            ->brandLogo(asset('images/logo-kawung-ori.png'))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('images/logo-kawung.png'))
            ->renderHook(
                'panels::user-menu.before',
                fn(): string => Blade::render('
                    <div class="hidden sm:block text-right mr-3 font-bold text-sm text-gray-800">
                        {{ auth()->user()->name }}
                    </div>
                '),
            )
            ->colors([
                'primary' => Color::hex('#70080B'),
            ])
            ->darkMode(false)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                \App\Filament\Pages\CustomDashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            // 🚀 CLONE IDENTIK 100% MODAL NATIVE FILAMENT V3 (TOMBOL FIX KUNCI WARNA MERAH)
            ->renderHook(
                'panels::body.end',
                fn(): string => Blade::render('
                    <div x-data="{ isOpen: false, formToSubmit: null }"
                         @submit.window="
                            if ($event.target && $event.target.action && $event.target.action.includes(\'/logout\')) {
                                if (!formToSubmit) {
                                    $event.preventDefault();
                                    formToSubmit = $event.target;
                                    isOpen = true;
                                }
                            }
                         ">
                        
                        <div x-show="isOpen"
                             x-transition.opacity.duration.300ms
                             class="fixed inset-0 bg-gray-950/50 dark:bg-gray-950/75 z-40 min-h-full overflow-y-auto overflow-x-hidden transition flex items-center"
                             style="display: none;">
                            
                            <div class="fi-modal-close-overlay fixed inset-0 cursor-pointer" @click="isOpen = false"></div>

                            <div class="my-auto p-4 pointer-events-none relative w-full transition">
                                <div @click.away="isOpen = false"
                                     x-show="isOpen"
                                     x-transition:enter-start="scale-95"
                                     x-transition:enter-end="scale-100"
                                     class="fi-modal-window pointer-events-auto relative flex w-full cursor-default flex-col bg-white shadow-xl ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 mx-auto rounded-xl max-w-md">
                                    
                                    <div class="fi-modal-header flex px-6 pt-6 flex-col">
                                        
                                        <div class="absolute end-4 top-4">
                                            <button class="fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 disabled:pointer-events-none disabled:opacity-70 -m-1.5 h-9 w-9 fi-color-gray text-gray-400 hover:text-gray-500 focus-visible:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 fi-modal-close-btn" title="Tutup" type="button" tabindex="-1" @click="isOpen = false">
                                                <span class="sr-only">Tutup</span>
                                                <svg class="fi-icon-btn-icon h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="mb-5 flex items-center justify-center">
                                            <div class="rounded-full fi-color-custom bg-red-100 p-3" style="--c-100:var(--danger-100);--c-400:var(--danger-400);--c-500:var(--danger-500);--c-600:var(--danger-600);">
                                                <svg class="fi-modal-icon h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <h2 class="fi-modal-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                                                Keluar Aplikasi
                                            </h2>
                                            <p class="fi-modal-description text-sm text-gray-500 dark:text-gray-400 mt-2">
                                                Apakah Anda yakin ingin keluar dari Admin Panel Kawungpitu Institute?
                                            </p>
                                        </div>
                                    </div>

                                    <div class="fi-modal-footer w-full px-6 pb-6 mt-6">
                                        <div class="fi-modal-footer-actions gap-3 flex flex-col-reverse sm:grid sm:grid-cols-[repeat(auto-fit,minmax(0,1fr))]">
                                            <button @click="isOpen = false" type="button" class="fi-btn relative flex items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 disabled:pointer-events-none disabled:opacity-70 h-9 px-4 text-sm rounded-lg fi-btn-color-gray bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10 ring-1 ring-inset ring-gray-300 dark:ring-white/10 shadow-sm">
                                                Batal
                                            </button>
                                            <button @click="isOpen = false; if(formToSubmit) formToSubmit.submit();" type="button" 
                                                    class="relative flex items-center justify-center font-semibold outline-none h-9 px-4 text-sm rounded-lg shadow-sm cursor-pointer transition duration-75"
                                                    style="background-color: #dc2626 !important; color: #ffffff !important; border: 1px solid #dc2626 !important;"
                                                    onmouseover="this.style.backgroundColor=\'#b91c1c\'"
                                                    onmouseout="this.style.backgroundColor=\'#dc2626\'">
                                                Konfirmasi
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                ')
            )
            ->plugin(
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['id', 'en']),
            );
    }
}
