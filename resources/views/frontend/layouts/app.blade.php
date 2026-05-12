<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title') - Kawung Pitu Institute
    </title>

    <link rel="icon" type="image/png" href="{{ asset('kawung.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400&family=Montserrat:wght@700;900&display=swap"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#70080B',
                            hover: '#8A0A0E',
                            light: '#F8E9EA',
                        },
                        cream: {
                            DEFAULT: '#fdfbf7',
                            dark: '#F3EFE6',
                        },
                        dark: '#1a1a1a',
                    },
                    fontFamily: {
                        headline: ['"Playfair Display"', 'serif'],
                        body: ['"Inter"', 'sans-serif'],
                        tegas: ['"Montserrat"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        .hover-underline {
            position: relative;
            text-decoration: none;
        }

        .hover-underline::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #70080B;
            transition: width 0.3s ease-in-out;
        }

        .hover-underline:hover::after {
            width: 100%;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* --- PERBAIKAN FINAL: ANIMASI HERO TANPA JEDA ABU-ABU --- */
        .animate-hero-1,
        .animate-hero-2 {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform-origin: center;
        }

        .animate-hero-1 {
            animation: hero-fade-1 12s infinite ease-in-out;
            z-index: 1;
        }

        .animate-hero-2 {
            animation: hero-fade-2 12s infinite ease-in-out;
            opacity: 0;
            z-index: 2;
        }

        @keyframes hero-fade-1 {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            45% {
                opacity: 1;
                transform: scale(1.1);
            }

            /* Zoom In */
            55% {
                opacity: 0;
                transform: scale(1.1);
            }

            /* Mulai memudar */
            95% {
                opacity: 0;
                transform: scale(1);
            }

            /* Persiapan muncul lagi */
            100% {
                opacity: 1;
                transform: scale(1);
            }

            /* Muncul tepat sebelum loop */
        }

        @keyframes hero-fade-2 {
            0% {
                opacity: 0;
                transform: scale(1);
            }

            /* Sembunyi di awal */
            45% {
                opacity: 0;
                transform: scale(1);
            }

            /* Masih sembunyi */
            55% {
                opacity: 1;
                transform: scale(1);
            }

            /* Muncul saat Gbr 1 hilang */
            95% {
                opacity: 1;
                transform: scale(1.1);
            }

            /* Zoom In */
            100% {
                opacity: 0;
                transform: scale(1.1);
            }

            /* Memudar buat balik ke Gbr 1 */
        }

        .animate-fade-in-left {
            animation: fadeInLeft 0.8s ease-out forwards;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-cream text-dark font-body antialiased selection:bg-primary selection:text-white">

    <nav class="fixed w-full top-0 z-50 bg-cream/95 backdrop-blur-md border-b border-gray-100 transition-all duration-300"
        id="navbar">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-5 flex justify-between items-center transition-all duration-300"
            id="navbar-inner">

            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo-kawung-ori.png') }}" alt="Logo Kawungpitu Institute"
                    class="h-12 w-auto">
            </a>

            <div class="hidden lg:flex flex-1 justify-center items-center space-x-10">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
                    class="{{ request()->routeIs('home') ? 'text-primary font-semibold' : 'text-gray-dark hover:text-primary font-medium' }} text-sm tracking-wide transition-colors hover-underline">
                    {{ __('messages.navbar.home') }}
                </a>

                <a href="{{ route('tentang', ['locale' => app()->getLocale()]) }}"
                    class="{{ request()->routeIs('tentang') ? 'text-primary font-semibold' : 'text-gray-dark hover:text-primary font-medium' }} text-sm tracking-wide transition-colors hover-underline">
                    {{ __('messages.navbar.about') }}
                </a>

                <a href="{{ route('artikel.index', ['locale' => app()->getLocale()]) }}"
                    class="{{ request()->routeIs('artikel.*') ? 'text-primary font-semibold' : 'text-gray-dark hover:text-primary font-medium' }} text-sm tracking-wide transition-colors hover-underline">
                    {{ __('messages.navbar.article') }}
                </a>

                <a href="{{ route('program.index', ['locale' => app()->getLocale()]) }}"
                    class="{{ request()->routeIs('program.*') ? 'text-primary font-semibold' : 'text-gray-dark hover:text-primary font-medium' }} text-sm tracking-wide transition-colors hover-underline">
                    {{ __('messages.navbar.program') }}
                </a>

                <a href="{{ route('galeri.index', ['locale' => app()->getLocale()]) }}"
                    class="{{ request()->routeIs('galeri.*') ? 'text-primary font-semibold' : 'text-gray-dark hover:text-primary font-medium' }} text-sm tracking-wide transition-colors hover-underline">
                    {{ __('messages.navbar.gallery') }}
                </a>
            </div>

            @php
                $currentLocale = app()->getLocale();
                $otherLocale = $currentLocale === 'id' ? 'en' : 'id';
                $switchUrl = str_replace('/' . $currentLocale, '/' . $otherLocale, request()->getRequestUri());
            @endphp
            <div class="hidden lg:flex items-center space-x-8">
                <div class="flex items-center bg-gray-100 border border-gray-200 p-1 rounded-full shadow-sm">
                    <a href="{{ $currentLocale === 'id' ? '#' : $switchUrl }}"
                        class="flex items-center space-x-2 {{ $currentLocale === 'id' ? 'bg-primary text-white shadow-md' : 'text-gray-500 hover:text-primary' }} px-3 py-1.5 rounded-full group transition-all duration-300">
                        <img src="https://flagcdn.com/w40/id.png" alt="ID"
                            class="w-4 h-4 object-cover rounded-full {{ $currentLocale === 'id' ? 'border border-white/20' : 'grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100' }} transition-all">
                        <span class="text-[10px] font-tegas font-bold uppercase tracking-tighter">ID</span>
                    </a>
                    <a href="{{ $currentLocale === 'en' ? '#' : $switchUrl }}"
                        class="flex items-center space-x-2 {{ $currentLocale === 'en' ? 'bg-primary text-white shadow-md' : 'text-gray-500 hover:text-primary' }} px-3 py-1.5 rounded-full group transition-all duration-300">
                        <img src="https://flagcdn.com/w40/gb.png" alt="EN"
                            class="w-4 h-4 object-cover rounded-full {{ $currentLocale === 'en' ? 'border border-white/20' : 'grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100' }} transition-all">
                        <span class="text-[10px] font-tegas font-black uppercase tracking-tighter">EN</span>
                    </a>
                </div>

                <a href="{{ route('kontak', ['locale' => app()->getLocale()]) }}"
                    class="bg-primary text-white px-7 py-2.5 rounded-xl hover:bg-[#320002] transition-all font-tegas font-black uppercase tracking-widest text-xs shadow-lg shadow-primary/20 hover:scale-105">
                    {{ __('messages.navbar.contact') }}
                </a>
            </div>

            <button class="lg:hidden text-dark p-2 focus:outline-none">
                <span class="material-symbols-outlined text-3xl">menu</span>
            </button>
        </div>
    </nav>

    <main> @yield('content')</main>

    <footer class="bg-dark text-white pt-24 pb-12 border-t-[12px] border-primary">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            {{-- Grid Menu Utama --}}
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 mb-5 border-b border-gray-800 pb-10 items-start">

                {{-- KOLOM 1: LOGO & DESKRIPSI --}}
                <div class="lg:col-span-5 pr-0 lg:pr-16">
                    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="mb-8 block group">
                        <img src="{{ asset('images/logo-kawung-ori.png') }}" alt="Logo Kawungpitu"
                            class="h-16 w-auto brightness-0 invert group-hover:opacity-80 transition-opacity duration-300">
                    </a>

                    <p class="text-gray-400 font-body text-sm leading-relaxed mb-10 max-w-sm opacity-75">
                        {!! __('messages.footer.description') !!}
                    </p>

                    <div class="flex space-x-5">
                        <a href="#"
                            class="w-12 h-12 rounded-full border border-gray-800 flex items-center justify-center hover:bg-primary hover:border-primary transition-all duration-300 group">
                            <i class="fa-brands fa-linkedin-in text-lg text-gray-500 group-hover:text-white"></i>
                        </a>
                        <a href="#"
                            class="w-12 h-12 rounded-full border border-gray-800 flex items-center justify-center hover:bg-primary hover:border-primary transition-all duration-300 group">
                            <i class="fa-brands fa-instagram text-lg text-gray-500 group-hover:text-white"></i>
                        </a>
                        <a href="mailto:info@kawungpitu.org"
                            class="w-12 h-12 rounded-full border border-gray-800 flex items-center justify-center hover:bg-primary hover:border-primary transition-all duration-300 group">
                            <i class="fa-solid fa-envelope text-lg text-gray-500 group-hover:text-white"></i>
                        </a>
                    </div>
                </div>

                {{-- KOLOM 2: KELEMBAGAAN --}}
                <div class="lg:col-span-2">
                    <h4 class="font-bold mb-8 uppercase tracking-widest text-sm text-gray-200 font-tegas">
                        {{ __('messages.footer.company') }}
                    </h4>
                    <ul class="space-y-5 text-gray-400 font-light text-sm">
                        <li><a href="{{ route('tentang', ['locale' => app()->getLocale()]) }}"
                                class="hover:text-primary transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('galeri.index', ['locale' => app()->getLocale()]) }}"
                                class="hover:text-primary transition-colors">Galeri</a></li>
                        <li><a href="{{ route('kontak', ['locale' => app()->getLocale()]) }}"
                                class="hover:text-primary transition-colors">Kontak</a></li>
                    </ul>
                </div>

                {{-- KOLOM 3: PROGRAM --}}
                <div class="lg:col-span-2">
                    <h4 class="font-bold mb-8 uppercase tracking-widest text-sm text-gray-200 font-tegas">
                        {{ __('messages.footer.program_title') }}
                    </h4>
                    <ul class="space-y-5 text-gray-400 font-light text-sm">
                        <li><a href="{{ route('artikel.index', ['locale' => app()->getLocale()]) }}"
                                class="hover:text-primary transition-colors">Artikel</a></li>
                        <li><a href="{{ route('program.index', ['locale' => app()->getLocale()]) }}"
                                class="hover:text-primary transition-colors">Program Kami</a></li>
                    </ul>
                </div>

                {{-- KOLOM 4: HUBUNGI KAMI --}}
                <div class="lg:col-span-3">
                    <h4 class="font-bold mb-8 uppercase tracking-widest text-sm text-gray-200 font-tegas">
                        Hubungi Kami
                    </h4>
                    <ul class="space-y-6 text-gray-400 font-light text-sm">
                        <li class="flex items-start space-x-4">
                            <span class="material-symbols-outlined text-primary mt-1">location_on</span>
                            <span class="leading-relaxed">Jl. Mawar Raya No. 16, Kota Bogor, Jawa Barat 16113</span>
                        </li>
                        <li class="flex items-center space-x-4">
                            <span class="material-symbols-outlined text-primary">mail</span>
                            <a href="mailto:info@kawungpitu.org"
                                class="hover:text-white transition-colors">info@kawungpitu.org</a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- COPYRIGHT: Apple Style (No Uppercase, No Letter Spacing, Normal Font) --}}
            <div class="text-sm text-gray-500 font-body font-medium">
                Copyright © {{ date('Y') }} Kawungpitu Institute. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            const inner = document.getElementById('navbar-inner');
            if (window.scrollY > 20) {
                navbar.classList.add('shadow-lg');
                inner.classList.replace('py-5', 'py-3');
            } else {
                navbar.classList.remove('shadow-lg');
                inner.classList.replace('py-3', 'py-5');
            }
        });

        // Tambahkan ini di dalam tag script yang sudah ada
        const mobileMenuBtn = document.querySelector('button.lg:hidden');
        mobileMenuBtn.addEventListener('click', () => {
            // Logika buka tutup menu mobile (kamu bisa buatkan div khusus menu mobile nanti)
            console.log('Menu Mobile Diklik!');
        });
    </script>
    @stack('scripts')
</body>

</html>