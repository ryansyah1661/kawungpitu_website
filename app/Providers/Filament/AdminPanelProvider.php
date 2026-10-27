<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\CustomLogin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
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
            
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label('Edit Profile')
                    ->icon('heroicon-o-user-circle')
                    ->url(fn () => \App\Filament\Pages\Profile::getUrl()),
            ])
            ->passwordReset()
            ->defaultAvatarProvider(\App\Filament\AvatarProviders\CustomAvatarProvider::class)
            ->brandName('Kawungpitu Institute')
            ->brandLogo(asset('images/logo-kawung-ori.png'))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('images/logo-kawung.png'))
            ->renderHook(
                'panels::head.end',
                fn(): string => Blade::render('
                    <style>
                        /* 1. Pastikan parent container tidak memblokir sticky (hilangkan overflow hidden) */
                        .fi-fo-rich-editor,
                        .fi-input-wrp,
                        .fi-fo-field-wrp,
                        .fi-section-content {
                            overflow: visible !important;
                        }
                        
                        /* Sticky Toolbar RichEditor Trix agar menempel saat scroll */
                        .fi-fo-rich-editor-toolbar {
                            position: sticky !important;
                            top: 4.25rem !important; /* Di bawah navbar atas admin */
                            z-index: 30 !important;
                            background-color: #ffffff !important;
                            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08) !important;
                            border-bottom: 2px solid #f3f4f6 !important;
                        }

                        /* 2. Pembeda Visual Sub Judul (h2) dan Anak Judul (h3) di Trix Editor Admin */
                        trix-editor h1 {
                            font-size: 1.5rem !important;
                            font-weight: 800 !important;
                            color: #111827 !important;
                            margin-top: 1.5rem !important;
                            margin-bottom: 0.75rem !important;
                            border-bottom: 2px solid #e5e7eb !important;
                            padding-bottom: 0.35rem !important;
                        }
                        trix-editor h2, 
                        trix-editor [data-trix-attribute="heading"] {
                            font-size: 1.35rem !important;
                            font-weight: 800 !important;
                            color: #70080B !important; /* Warna maroon khas Kawungpitu */
                            margin-top: 1.5rem !important;
                            margin-bottom: 0.65rem !important;
                            border-left: 4px solid #70080B !important;
                            padding-left: 0.75rem !important;
                        }
                        trix-editor h3, 
                        trix-editor [data-trix-attribute="subHeading"] {
                            font-size: 1.15rem !important;
                            font-weight: 700 !important;
                            color: #374151 !important; /* Slate gelap */
                            margin-top: 1.25rem !important;
                            margin-bottom: 0.5rem !important;
                            padding-left: 0.5rem !important;
                        }

                        /* Floating Bubble Menu ketika teks diblok */
                        #floating-trix-bubble {
                            display: none;
                            position: absolute;
                            z-index: 9999;
                            background: #1f2937;
                            padding: 4px 8px;
                            border-radius: 8px;
                            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
                            gap: 4px;
                            align-items: center;
                        }
                        #floating-trix-bubble button {
                            color: #f9fafb;
                            background: transparent;
                            border: none;
                            padding: 4px 8px;
                            border-radius: 4px;
                            font-size: 13px;
                            font-weight: 600;
                            cursor: pointer;
                            transition: background-color 0.15s;
                        }
                        #floating-trix-bubble button:hover {
                            background: #374151;
                            color: #ffffff;
                        }
                        #floating-trix-bubble .divider {
                            width: 1px;
                            height: 16px;
                            background: #4b5563;
                            margin: 0 2px;
                        }
                    </style>
                ')
            )
            ->renderHook(
                'panels::body.end',
                fn(): string => Blade::render('
                    {{-- Floating Bubble Toolbar saat teks diseleksi / diblok --}}
                    <div id="floating-trix-bubble">
                        <button type="button" onmousedown="event.preventDefault(); applyTrixFormat(\'bold\');" title="Bold"><b>B</b></button>
                        <button type="button" onmousedown="event.preventDefault(); applyTrixFormat(\'italic\');" title="Italic"><i>I</i></button>
                        <button type="button" onmousedown="event.preventDefault(); applyTrixFormat(\'underline\');" title="Underline"><u>U</u></button>
                        <button type="button" onmousedown="event.preventDefault(); applyTrixFormat(\'strike\');" title="Strikethrough"><s>S</s></button>
                        <div class="divider"></div>
                        <button type="button" onmousedown="event.preventDefault(); applyTrixFormat(\'heading\');" title="Sub Judul">H2</button>
                        <button type="button" onmousedown="event.preventDefault(); applyTrixFormat(\'subHeading\');" title="Anak Judul">H3</button>
                        <button type="button" onmousedown="event.preventDefault(); applyTrixFormat(\'quote\');" title="Kutipan">“ ”</button>
                    </div>

                    <script>
                        function applyTrixFormat(attribute) {
                            const activeEditor = document.activeElement && document.activeElement.tagName === "TRIX-EDITOR" 
                                ? document.activeElement 
                                : document.querySelector("trix-editor");
                            if (!activeEditor || !activeEditor.editor) return;

                            if (attribute === "heading") {
                                const isH2 = activeEditor.editor.attributeIsActive("heading");
                                if (isH2) {
                                    activeEditor.editor.deactivateAttribute("heading");
                                } else {
                                    activeEditor.editor.deactivateAttribute("subHeading");
                                    activeEditor.editor.activateAttribute("heading");
                                }
                            } else if (attribute === "subHeading") {
                                const isH3 = activeEditor.editor.attributeIsActive("subHeading");
                                if (isH3) {
                                    activeEditor.editor.deactivateAttribute("subHeading");
                                } else {
                                    activeEditor.editor.deactivateAttribute("heading");
                                    activeEditor.editor.activateAttribute("subHeading");
                                }
                            } else {
                                const isActive = activeEditor.editor.attributeIsActive(attribute);
                                if (isActive) {
                                    activeEditor.editor.deactivateAttribute(attribute);
                                } else {
                                    activeEditor.editor.activateAttribute(attribute);
                                }
                            }
                        }

                        document.addEventListener("DOMContentLoaded", function() {
                            const bubble = document.getElementById("floating-trix-bubble");
                            if (!bubble) return;

                            function updateBubblePosition() {
                                const selection = window.getSelection();
                                if (!selection || selection.isCollapsed || !selection.rangeCount) {
                                    bubble.style.display = "none";
                                    return;
                                }

                                const anchor = selection.anchorNode;
                                const trix = anchor ? (anchor.nodeType === 1 ? anchor.closest("trix-editor") : anchor.parentElement?.closest("trix-editor")) : null;
                                
                                if (!trix) {
                                    bubble.style.display = "none";
                                    return;
                                }

                                const range = selection.getRangeAt(0);
                                const rect = range.getBoundingClientRect();

                                if (rect.width === 0 || rect.height === 0) {
                                    bubble.style.display = "none";
                                    return;
                                }

                                bubble.style.display = "flex";
                                const bubbleWidth = bubble.offsetWidth || 240;
                                const bubbleHeight = bubble.offsetHeight || 38;

                                let top = rect.top + window.scrollY - bubbleHeight - 8;
                                let left = rect.left + window.scrollX + (rect.width / 2) - (bubbleWidth / 2);

                                if (left < 10) left = 10;
                                if (top < window.scrollY + 60) {
                                    // Jika terlalu dekat ke atas, taruh di bawah teks yang diseleksi
                                    top = rect.bottom + window.scrollY + 8;
                                }

                                bubble.style.top = top + "px";
                                bubble.style.left = left + "px";
                            }

                            document.addEventListener("selectionchange", function() {
                                setTimeout(updateBubblePosition, 10);
                            });

                            document.addEventListener("mousedown", function(e) {
                                if (!bubble.contains(e.target)) {
                                    const sel = window.getSelection();
                                    if (sel && sel.isCollapsed) {
                                        bubble.style.display = "none";
                                    }
                                }
                            });
                        });
                    </script>
                ')
            )
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
                \App\Http\Middleware\UpdateLastSeenAt::class,
            ])
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