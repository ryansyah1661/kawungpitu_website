@extends('frontend.layouts.app')

@section('content')
    {{-- SECTION HERO --}}
    <section class="relative min-h-[90vh] flex items-center pt-32 pb-16 overflow-hidden bg-dark">
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img src="{{ asset('images/rempah.jpg') }}" alt="Rempah"
                class="animate-hero-1 absolute inset-0 object-cover object-center w-full h-full filter brightness-[0.6]">
            <img src="{{ asset('images/lahan.jpg') }}" alt="Lahan"
                class="animate-hero-2 absolute inset-0 object-cover object-center w-full h-full filter brightness-[0.6]">
            <div class="absolute inset-0 bg-gradient-to-r from-dark/90 via-dark/60 to-transparent z-10"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 md:px-12 w-full">
            <div class="max-w-3xl mt-6 md:mt-0">
                <h1
                    class="font-tegas text-3xl sm:text-4xl md:text-6xl lg:text-7xl font-black mb-8 uppercase tracking-tighter animate-fade-in-left w-fit">
                    <span
                        class="bg-white text-dark pl-6 pr-12 py-2 block mb-2 w-full shadow-xl">{{ __('messages.hero.title_1') }}</span>
                    <span
                        class="bg-primary text-white pl-6 pr-12 py-2 block mb-2 w-full shadow-xl">{{ __('messages.hero.title_2') }}</span>
                    <span
                        class="bg-white text-dark pl-6 pr-12 py-2 block w-full shadow-xl">{{ __('messages.hero.title_3') }}</span>
                </h1>
                <p class="text-lg md:text-xl text-white/80 font-light mb-12 max-w-2xl leading-relaxed">
                    {!! __('messages.hero.description') !!}
                </p>
                <div class="flex flex-col sm:flex-row gap-6">
                    <a href="{{ route('program.index', ['locale' => app()->getLocale()]) }}"
                        class="inline-flex justify-center items-center bg-primary text-white px-8 py-4 rounded hover:bg-primary-hover transition-all duration-300 font-medium text-lg shadow-xl shadow-primary/30 group">
                        {{ __('messages.buttons.explore') }}
                        <span
                            class="material-symbols-outlined ml-2 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                    <a href="{{ route('kontak', ['locale' => app()->getLocale()]) }}"
                        class="inline-flex justify-center items-center bg-white/10 backdrop-blur-md text-white border border-white/30 px-8 py-4 rounded hover:bg-white/20 transition-all duration-300 font-medium text-lg">
                        {{ __('messages.buttons.call_us') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION COMMITMENT --}}
    <section class="py-24 bg-white font-sans">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

                {{-- Sisi Kiri --}}
                <div class="lg:col-span-7 space-y-8">
                    <h2
                        class="font-montserrat font-black text-[2rem] md:text-[2.6rem] leading-[1.15] uppercase tracking-tighter">
                        <span class="block text-[#1a1a1a] md:whitespace-nowrap">
                            {{ __('messages.commitment.title_1') }}
                        </span>
                        <span class="block text-primary md:whitespace-nowrap">
                            {{ __('messages.commitment.title_2') }}
                        </span>
                        <span class="block text-[#1a1a1a]">
                            {{ __('messages.commitment.title_3') }}
                        </span>
                    </h2>

                    <div class="space-y-5 max-w-2xl">
                        <p class="text-gray-700 text-lg leading-relaxed">
                            {!! __('messages.commitment.description_1') !!}
                        </p>
                        <p class="text-gray-700 text-lg leading-relaxed">
                            {!! __('messages.commitment.description_2') !!}
                        </p>
                    </div>

                    <div class="pt-4 flex flex-col sm:flex-row sm:items-center gap-6 md:gap-8">
                        <a href="{{ route('tentang', ['locale' => app()->getLocale()]) }}"
                            class="inline-flex items-center text-primary font-tegas font-bold text-xs uppercase tracking-widest group/link shrink-0">
                            <span class="hover-underline">{{ __('messages.commitment.learn_more') }}</span>
                            <span
                                class="material-symbols-outlined ml-1 text-[18px] group-hover/link:translate-x-1 transition-transform duration-300">
                                chevron_right
                            </span>
                        </a>
                    </div>
                </div>

                {{-- Sisi Kanan: Quote Card --}}
                <div
                    class="lg:col-span-5 bg-[#FFF5F3] rounded-[3rem] p-10 md:p-14 relative shadow-sm flex flex-col justify-center">
                    <blockquote
                        class="text-xl md:text-2xl font-montserrat italic font-bold text-primary text-left leading-snug mb-8">
                        "{!! __('messages.commitment.quote') !!}"
                    </blockquote>
                    <footer
                        class="font-montserrat font-black text-xs uppercase tracking-[0.2em] text-primary/70 flex items-center">
                        <div class="w-8 h-px bg-primary/30 mr-3"></div>
                        {{ __('messages.commitment.tagline') }}
                    </footer>
                </div>

            </div>
        </div>
    </section>

    {{-- SECTION PILAR KERJA --}}
    <section class="pt-12 pb-24 bg-primary border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            {{-- Header Section --}}
            <div class="text-center mb-12">
                <h2
                    class="font-tegas text-3xl sm:text-4xl md:text-5xl font-black text-white uppercase tracking-tighter mb-2">
                    {{ __('messages.strategy.title') }}
                </h2>
                <div class="max-w-3xl mx-auto mb-12">
                    <p
                        class="text-lg md:text-xl font-light leading-relaxed text-justify text-white/90 hyphens-auto tracking-tight">
                        {!! __('messages.strategy.subtitle') !!}
                    </p>
                </div>
            </div>

            {{-- Grid Pilar Kerja --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
                @php
                    $strategi = [
                        [
                            'icon' => 'fa-solid fa-user-tie',
                            'title' => __('messages.strategy.items.organizing.title'),
                            'desc' => __('messages.strategy.items.organizing.desc'),
                            'back_icon' => 'groups',
                            'back_desc' => __('messages.strategy_back.organizing'),
                        ],
                        [
                            'icon' => 'handshake',
                            'title' => __('messages.strategy.items.development.title'),
                            'desc' => __('messages.strategy.items.development.desc'),
                            'back_icon' => 'volunteer_activism',
                            'back_desc' => __('messages.strategy_back.development'),
                        ],
                        [
                            'icon' => 'nature',
                            'title' => __('messages.strategy.items.capacity.title'),
                            'desc' => __('messages.strategy.items.capacity.desc'),
                            'back_icon' => 'psychology',
                            'back_desc' => __('messages.strategy_back.capacity'),
                        ],
                        [
                            'icon' => 'fa-solid fa-chart-line',
                            'title' => __('messages.strategy.items.research.title'),
                            'desc' => __('messages.strategy.items.research.desc'),
                            'back_icon' => 'find_in_page',
                            'back_desc' => __('messages.strategy_back.research'),
                        ],
                        [
                            'icon' => 'fa-solid fa-bridge',
                            'title' => __('messages.strategy.items.advocacy.title'),
                            'desc' => __('messages.strategy.items.advocacy.desc'),
                            'back_icon' => 'record_voice_over',
                            'back_desc' => __('messages.strategy_back.advocacy'),
                        ],
                        [
                            'icon' => 'cycle',
                            'title' => __('messages.strategy.items.modelling.title'),
                            'desc' => __('messages.strategy.items.modelling.desc'),
                            'bg_custom' => '#d5a132',
                            'back_icon' => 'layers',
                            'back_desc' => __('messages.strategy_back.modelling'),
                        ],
                    ];
                @endphp

                @foreach ($strategi as $s)
                    {{-- FIX MOBILE TAP: Menggunakan Alpine x-data biar di HP sekali tap ringan langsung muter sempurna tanpa ganjal sistem iOS --}}
                    <div x-data="{ flipped: false }" @click="flipped = !flipped" @click.away="flipped = false"
                        class="group h-[360px] [perspective:1000px] ios-pilar-wrapper cursor-pointer select-none">
                        <div class="relative h-full w-full transition-all duration-700 [transform-style:preserve-3d] ios-pilar-card"
                            :class="flipped ? 'is-flipped' : ''">

                            {{-- SISI DEPAN --}}
                            <div
                                class="absolute inset-0 bg-[#F2E7DF] p-10 rounded-3xl shadow-xl flex flex-col items-center border border-primary/5 [backface-visibility:hidden] ios-pilar-face">
                                <div
                                    class="w-20 h-20 bg-primary/10 rounded-2xl flex items-center justify-center mb-8 text-primary border border-primary/10">
                                    @if (str_starts_with($s['icon'], 'fa-'))
                                        <i class="{{ $s['icon'] }} text-3xl"></i>
                                    @else
                                        <span class="material-symbols-outlined text-4xl">{{ $s['icon'] }}</span>
                                    @endif
                                </div>
                                <h3
                                    class="font-tegas text-xl font-black text-primary uppercase mb-1 tracking-tighter leading-tight text-center">
                                    {!! $s['title'] !!}
                                </h3>
                                <p class="text-primary px-4 leading-relaxed opacity-90 text-sm text-left w-full">
                                    {!! $s['desc'] !!}
                                </p>
                            </div>

                            {{-- SISI BELAKANG --}}
                            <div
                                class="absolute inset-0 h-full w-full rounded-3xl bg-[#d5a132] p-10 text-primary [transform:rotateY(180deg)] [backface-visibility:hidden] ios-pilar-face flex flex-col items-center justify-center border border-white/10 shadow-2xl">
                                <p class="text-primary/90 font-light leading-relaxed text-sm text-left w-full px-2">
                                    {!! $s['back_desc'] !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- SECTION STRATEGI INTEGRATIF --}}
    <section class="py-24 bg-[#FDF2EA] relative overflow-hidden">
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(#800000 1px, transparent 1px); background-size: 20px 20px;"></div>

        <div class="container mx-auto px-6 md:px-12 relative z-10">
            <div class="text-center mb-16">
                <h2
                    class="font-tegas text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-primary uppercase tracking-tighter mb-6">
                    {{ __('messages.home_interactive.strategy_title') }}
                </h2>
                <div class="max-w-3xl mx-auto space-y-2">
                    <p
                        class="text-lg md:text-xl font-light leading-relaxed text-primary/80 tracking-tight text-center md:text-justify hyphens-auto">
                        {{ __('messages.home_interactive.strategy_subtitle') }}
                    </p>
                    <p
                        class="text-lg md:text-xl font-light leading-relaxed text-primary/80 tracking-tight text-center md:text-justify hyphens-auto">
                        {{ __('messages.home_interactive.strategy_desc') }}
                    </p>
                </div>
            </div>

            @php
                $integratif = [
                    [
                        'title' => 'Social-Enterprise Hub',
                        'icon' => 'trending_up',
                        'desc' => __('messages.home_interactive.cards.social_hub'),
                        'values' => [80, 75, 40, 50, 90],
                    ],
                    [
                        'title' => 'Community Research',
                        'icon' => 'search',
                        'desc' => __('messages.home_interactive.cards.research'),
                        'values' => [90, 60, 85, 30, 45],
                    ],
                    [
                        'title' => 'Climate Resilience',
                        'icon' => 'filter_drama',
                        'desc' => __('messages.home_interactive.cards.climate'),
                        'values' => [50, 55, 95, 80, 40],
                    ],
                    [
                        'title' => 'Policy Advocacy',
                        'icon' => 'gavel',
                        'desc' => __('messages.home_interactive.cards.policy'),
                        'values' => [85, 90, 30, 40, 60],
                    ],
                ];

                if (!function_exists('getPointsStatic')) {
                    function getPointsStatic($values)
                    {
                        $points = [];
                        $center = 50;
                        $scale = 0.4;
                        for ($i = 0; $i < 5; $i++) {
                            $angle = deg2rad($i * 72 - 90);
                            $r = $values[$i] * $scale;
                            $x = $center + $r * cos($angle);
                            $y = $center + $r * sin($angle);
                            $points[] = "$x,$y";
                        }
                        return implode(' ', $points);
                    }
                }
            @endphp

            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-stretch">
                @foreach ($integratif as $item)
                    <div
                        class="integrative-card bg-white p-8 md:p-10 rounded-[40px] shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col justify-start border border-primary/5 group">

                        <div class="flex justify-between items-center mb-6">
                            <div
                                class="w-14 h-14 bg-[#FDF2EA] rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-500 shrink-0">
                                <span class="material-symbols-outlined text-2xl">{{ $item['icon'] }}</span>
                            </div>

                            <div class="w-24 h-24 relative shrink-0">
                                <svg viewBox="0 0 100 100" class="w-full h-full overflow-visible">
                                    <polygon points="{{ getPointsStatic([50, 50, 50, 50, 50]) }}" fill="none"
                                        stroke="#800000" stroke-width="0.5" stroke-dasharray="2" opacity="0.2" />
                                    <polygon points="{{ getPointsStatic([100, 100, 100, 100, 100]) }}" fill="none"
                                        stroke="#800000" stroke-width="0.5" opacity="0.1" />

                                    @for ($i = 0; $i < 5; $i++)
                                        @php $angle = deg2rad($i * 72 - 90); @endphp
                                        <line x1="50" y1="50" x2="{{ 50 + 40 * cos($angle) }}"
                                            y2="{{ 50 + 40 * sin($angle) }}" stroke="#800000" stroke-width="0.2"
                                            opacity="0.2" />
                                    @endfor

                                    <polygon points="50,50 50,50 50,50 50,50 50,50"
                                        data-values="{{ json_encode($item['values']) }}"
                                        class="radar-polygon fill-primary/30 stroke-primary stroke-[1.5]" />

                                    <text x="50" y="5" text-anchor="middle" font-size="8"
                                        class="fill-primary font-bold">H</text>
                                    <text x="95" y="40" text-anchor="middle" font-size="8"
                                        class="fill-primary font-bold">S</text>
                                    <text x="80" y="95" text-anchor="middle" font-size="8"
                                        class="fill-primary font-bold">N</text>
                                    <text x="20" y="95" text-anchor="middle" font-size="8"
                                        class="fill-primary font-bold">P</text>
                                    <text x="5" y="40" text-anchor="middle" font-size="8"
                                        class="fill-primary font-bold">F</text>
                                </svg>
                            </div>
                        </div>

                        <div class="flex-grow flex flex-col justify-start">
                            <h3
                                class="font-tegas text-xl md:text-2xl font-black text-primary uppercase mb-4 tracking-tight leading-tight">
                                {{ $item['title'] }}
                            </h3>
                            <div
                                class="text-slate-600 leading-relaxed text-xs md:text-sm font-medium text-left w-full space-y-1 prose-strong:text-primary prose-strong:font-bold">
                                {!! $item['desc'] !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Script Animasi --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const center = 50;
            const scaleFactor = 0.4;
            const duration = 2000;

            function calculateAnimatedPoints(targetValues, progress) {
                return targetValues.map((val, i) => {
                    const angle = (i * 72 - 90) * (Math.PI / 180);
                    const currentR = (val * scaleFactor) * progress;
                    const x = center + currentR * Math.cos(angle);
                    const y = center + currentR * Math.sin(angle);
                    return `${x.toFixed(2)},${y.toFixed(2)}`;
                }).join(' ');
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const polygon = entry.target.querySelector('.radar-polygon');
                        if (!polygon || polygon.dataset.animated === "true") return;

                        const values = JSON.parse(polygon.getAttribute('data-values'));
                        let startTimestamp = null;
                        const animate = (timestamp) => {
                            if (!startTimestamp) startTimestamp = timestamp;
                            const elapsed = timestamp - startTimestamp;
                            const progress = Math.min(elapsed / duration, 1);
                            const easedProgress = 1 - Math.pow(1 - progress, 4);
                            polygon.setAttribute('points', calculateAnimatedPoints(values,
                                easedProgress));
                            if (progress < 1) requestAnimationFrame(animate);
                            else polygon.dataset.animated = "true";
                        };
                        requestAnimationFrame(animate);
                    }
                });
            }, {
                threshold: 0.2
            });

            document.querySelectorAll('.integrative-card').forEach(card => observer.observe(card));
        });
    </script>

    <style>
        @keyframes pulse-slow {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.7;
            }

            50% {
                transform: scale(1.05);
                opacity: 1;
            }
        }

        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
        }

        /* 🔥 FIX FOR iOS SAFARI (WEBKIT 3D ENGINE ECOSYSTEM) */
        .ios-pilar-wrapper {
            -webkit-perspective: 1000px !important;
            perspective: 1000px !important;
            -webkit-transform-style: preserve-3d !important;
            transform-style: preserve-3d !important;
        }

        .ios-pilar-card {
            -webkit-transform-style: preserve-3d !important;
            transform-style: preserve-3d !important;
        }

        .ios-pilar-face {
            -webkit-backface-visibility: hidden !important;
            backface-visibility: hidden !important;
        }

        /* 1. KONDISI LAPTOP (Desktop Hover): Efek putar hanya aktif via hover jika resolusi layar lebar */
        @media (min-width: 1024px) {
            .group:hover .ios-pilar-card {
                transform: rotateY(180deg) !important;
                -webkit-transform: rotateY(180deg) !important;
            }
        }

        /* 2. KONDISI MOBILE (HP Tap): Dipaksa berputar lancar menggunakan bantuan class Alpine.js */
        .ios-pilar-card.is-flipped {
            transform: rotateY(180deg) !important;
            -webkit-transform: rotateY(180deg) !important;
        }
    </style>

    {{-- SECTION ARTICLES --}}
    <section class="py-24 md:py-32 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="text-center mb-16">
                <h2
                    class="font-tegas text-3xl sm:text-4xl md:text-5xl font-black text-dark uppercase tracking-normal mb-4">
                    {{ __('messages.articles.title') }}
                </h2>
                <div class="w-24 h-1.5 bg-primary/20 mx-auto rounded-full mt-6"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-12">
                @forelse ($latestArticles as $article)
                    @php
                        $articleUrl = $article->slug
                            ? route('artikel.show', ['locale' => app()->getLocale(), 'slug' => $article->slug])
                            : '#';
                    @endphp
                    <article
                        class="bg-white flex flex-col rounded-3xl overflow-hidden shadow-xl shadow-primary/5 hover:-translate-y-2 transition-all duration-500 group border border-gray-100 h-full">
                        <a href="{{ $articleUrl }}" class="relative h-56 overflow-hidden block">
                            @if ($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}"
                                    alt="{{ $article->title }}"
                                    class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-primary/10 to-primary/5 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-6xl text-primary/30">article</span>
                                </div>
                            @endif

                            <div class="absolute top-4 left-4 flex flex-wrap gap-2 pointer-events-none">
                                @foreach ($article->categories as $category)
                                    <span
                                        class="bg-primary text-white text-[9px] font-bold py-1.5 px-3 rounded-lg uppercase tracking-normal shadow-lg">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                        </a>

                        <div class="p-8 flex flex-col flex-grow">
                            <div
                                class="flex items-center space-x-3 text-[10px] text-gray-400 font-bold uppercase tracking-normal mb-3">
                                <time>{{ $article->published_at ? $article->published_at->translatedFormat('d F Y') : '-' }}</time>
                                <span class="w-1 h-1 bg-gray-200 rounded-full"></span>
                                <span class="flex items-center">
                                    <span
                                        class="material-symbols-outlined text-[14px] mr-1.5 text-primary/30">person</span>
                                    {{ $article->author_name ?? 'Tim Kawungpitu Institute' }}
                                </span>
                            </div>

                            <h3
                                class="font-tegas text-xl font-black text-primary mb-4 uppercase tracking-normal group-hover:text-dark transition-colors leading-tight line-clamp-2">
                                <a href="{{ $articleUrl }}">{{ $article->title }}</a>
                            </h3>

                            <p class="text-gray-600 font-body text-sm mb-6 line-clamp-3 italic opacity-80 leading-relaxed">
                                {{ $article->excerpt }}
                            </p>

                            <a href="{{ $articleUrl }}"
                                class="mt-auto inline-flex items-center text-primary font-bold font-tegas text-[10px] uppercase tracking-widest group/link">
                                <span class="hover-underline">{{ __('messages.articles.read_more') }}</span>
                                <span
                                    class="material-symbols-outlined ml-2 text-[18px] group-hover/link:translate-x-1 transition-transform duration-300">
                                    arrow_right_alt
                                </span>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
                        <span class="material-symbols-outlined text-5xl text-gray-300">search_off</span>
                        <p class="text-gray-400 font-tegas uppercase tracking-widest mt-4">
                            {{ __('messages.articles.empty') }}</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-28 flex justify-center">
                <a href="{{ route('artikel.index', ['locale' => app()->getLocale()]) }}"
                    class="inline-flex items-center space-x-2 text-dark hover:text-primary font-tegas font-bold uppercase text-xs tracking-widest border border-gray-200 px-10 py-4 rounded-xl hover:border-primary shadow-sm hover:shadow-xl transition-all duration-300">
                    <span>{{ __('messages.articles.view_all') }}</span>
                    <span class="material-symbols-outlined text-sm">arrow_outward</span>
                </a>
            </div>
        </div>
    </section>

    {{-- SECTION CTA --}}
    <section class="py-24 bg-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-5"
            style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 40px 40px;">
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <h2
                class="font-tegas text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white mb-8 tracking-tight uppercase">
                {{ __('messages.cta.title') }}
            </h2>
            <p class="text-xl text-white/80 font-light mb-12 max-w-2xl mx-auto leading-relaxed">
                {{ __('messages.cta.description') }}
            </p>
            <a href="{{ route('kontak', ['locale' => app()->getLocale()]) }}"
                class="inline-flex justify-center items-center bg-cream text-primary px-10 py-5 rounded-xl font-black font-tegas uppercase tracking-widest hover:bg-white hover:scale-105 transition-all duration-300 text-lg shadow-2xl">
                {{ __('messages.cta.button') }}
            </a>
        </div>
    </section>
@endsection
