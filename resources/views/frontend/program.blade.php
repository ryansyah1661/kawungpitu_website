@extends('frontend.layouts.app')
@section('title', 'Program')

@section('content')
    <header class="bg-cream pt-40 pb-24 px-8 md:px-12 border-b border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto relative">
            <div class="relative z-10">
                <h1
                    class="font-tegas text-5xl md:text-7xl font-black mb-10 uppercase tracking-normal animate-fade-in-left w-fit text-left">
                    <span class="bg-white text-dark px-6 pr-20 py-2 block mb-2 w-full shadow-xl shadow-primary/5">
                        {{ __('messages.program.header_1') }}
                    </span>
                    <span class="bg-primary text-white px-6 pr-20 py-2 block w-full shadow-xl shadow-primary/10">
                        {{ __('messages.program.header_2') }}
                    </span>
                </h1>
                <div class="flex items-start space-x-6 animate-fade-in-left" style="animation-delay: 0.3s;">
                    <div class="w-1.5 h-20 bg-primary/20 rounded-full hidden md:block"></div>
                    <p class="text-lg md:text-xl text-primary font-medium max-w-2xl leading-relaxed italic opacity-90">
                        {{ __('messages.program.header_description') }}
                    </p>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-8 md:px-12 py-16" x-data="{
                loading: false,
                activeStatus: '{{ request('status', 'all') }}',
                activeCategory: '{{ request('kategori', 'all') }}',
                fetchMaterials(url, type, value) {
                    this.loading = true;

                    // Update tracker state
                    if (type === 'all') {
                        this.activeStatus = 'all';
                        this.activeCategory = 'all';
                    } else if (type === 'status') {
                        this.activeStatus = value;
                        this.activeCategory = 'all';
                    } else if (type === 'category') {
                        this.activeCategory = value;
                        this.activeStatus = 'all';
                    }

                    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(res => res.text())
                        .then(html => {
                            document.getElementById('program-container').innerHTML = html;
                            this.loading = false;
                            window.history.pushState({}, '', url);
                            window.scrollTo({ top: 400, behavior: 'smooth' });
                        });
                }
            }">

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 lg:gap-16">

            {{-- Sidebar --}}
            <aside class="lg:col-span-1 space-y-12">
                {{-- Status Filter --}}
                <div>
                    <h3
                        class="font-tegas text-xl font-black text-primary mb-6 border-b-2 border-primary/10 pb-2 uppercase tracking-tight">
                        {{ __('messages.program.status_title') }}
                    </h3>
                    <ul class="space-y-4 font-body text-gray-600">
                        {{-- Semua Program --}}
                        <li>
                            <a href="{{ route('program.index', ['locale' => app()->getLocale()]) }}"
                                @click.prevent="fetchMaterials($el.href, 'all', 'all')"
                                class="flex justify-between items-center group cursor-pointer hover:translate-x-1 transition-transform duration-300">
                                <span :class="(activeStatus === 'all' && activeCategory === 'all') ?
                                            'font-bold text-primary' : 'font-medium group-hover:text-primary'"
                                    class="transition-colors">
                                    {{ __('messages.program.all') }}
                                </span>
                                <span :class="(activeStatus === 'all' && activeCategory === 'all') ?
                                            'bg-primary text-white' :
                                            'bg-gray-100 text-gray-500 group-hover:bg-primary/10 group-hover:text-primary'"
                                    class="transition-colors text-xs py-1 px-2.5 rounded-lg font-bold">
                                    {{ $totalMaterialsCount }}
                                </span>
                            </a>
                        </li>

                        {{-- Sedang Berjalan --}}
                        <li>
                            <a href="{{ route('program.index', ['locale' => app()->getLocale(), 'status' => 'ongoing']) }}"
                                @click.prevent="fetchMaterials($el.href, 'status', 'ongoing')"
                                class="flex justify-between items-center group cursor-pointer hover:translate-x-1 transition-transform duration-300">
                                <div class="flex items-center space-x-3">
                                    <span class="w-2 h-2 rounded-full bg-yellow-500 transition-all"
                                        :class="activeStatus === 'ongoing' ? 'ring-4 ring-yellow-100' : ''"></span>
                                    <span :class="activeStatus === 'ongoing' ? 'font-bold text-primary' :
                                                    'font-medium group-hover:text-primary'" class="transition-colors">
                                        {{ __('messages.program.ongoing') }}
                                    </span>
                                </div>
                                <span
                                    :class="activeStatus === 'ongoing' ? 'bg-yellow-100 text-yellow-700' :
                                                'bg-gray-100 text-gray-500 group-hover:bg-yellow-50 group-hover:text-yellow-600'"
                                    class="transition-colors text-xs py-1 px-2.5 rounded-lg font-bold">
                                    {{ \App\Models\Program::where('status', 'ongoing')->count() }}
                                </span>
                            </a>
                        </li>

                        {{-- Selesai --}}
                        <li>
                            <a href="{{ route('program.index', ['locale' => app()->getLocale(), 'status' => 'completed']) }}"
                                @click.prevent="fetchMaterials($el.href, 'status', 'completed')"
                                class="flex justify-between items-center group cursor-pointer hover:translate-x-1 transition-transform duration-300">
                                <div class="flex items-center space-x-3">
                                    <span class="w-2 h-2 rounded-full bg-green-500 transition-all"
                                        :class="activeStatus === 'completed' ? 'ring-4 ring-green-100' : ''"></span>
                                    <span :class="activeStatus === 'completed' ? 'font-bold text-primary' :
                                                    'font-medium group-hover:text-primary'" class="transition-colors">
                                        {{ __('messages.program.completed') }}
                                    </span>
                                </div>
                                <span
                                    :class="activeStatus === 'completed' ? 'bg-green-100 text-green-700' :
                                                'bg-gray-100 text-gray-500 group-hover:bg-green-50 group-hover:text-green-600'"
                                    class="transition-colors text-xs py-1 px-2.5 rounded-lg font-bold">
                                    {{ \App\Models\Program::where('status', 'completed')->count() }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Kategori (Sidebar) --}}
                <div>
                    <h3
                        class="font-tegas text-xl font-black text-primary mb-6 border-b-2 border-primary/10 pb-2 uppercase tracking-tight">
                        {{ __('messages.program.category_title') }}
                    </h3>
                    <ul class="space-y-4 font-body text-gray-600">
                        @foreach ($categories as $cat)
                            <li>
                                <a href="{{ route('program.index', ['locale' => app()->getLocale(), 'kategori' => $cat->slug]) }}"
                                    @click.prevent="fetchMaterials($el.href, 'category', '{{ $cat->slug }}')"
                                    class="flex justify-between items-center group cursor-pointer hover:translate-x-1 transition-transform duration-300">

                                    <div class="flex items-center space-x-4">
                                        @if ($cat->icon)
                                            <div class="p-2 rounded-xl transition-all duration-300" :class="activeCategory === '{{ $cat->slug }}' ?
                                                                            'bg-primary shadow-lg shadow-primary/20' :
                                                                            'bg-primary/5 group-hover:bg-primary'">
                                                <img src="{{ asset('storage/' . $cat->icon) }}"
                                                    class="w-6 h-6 object-contain transition-all duration-300"
                                                    :class="activeCategory === '{{ $cat->slug }}' ? 'brightness-0 invert' :
                                                                                'opacity-70 grayscale group-hover:opacity-100 group-hover:grayscale-0 group-hover:brightness-0 group-hover:invert'"
                                                    alt="{{ $cat->name }}">
                                            </div>
                                        @else
                                            <span class="material-symbols-outlined text-lg transition-colors" :class="activeCategory === '{{ $cat->slug }}' ? 'text-primary' :
                                                                            'text-primary/40 group-hover:text-primary'">
                                                category
                                            </span>
                                        @endif

                                        <span class="transition-colors" :class="activeCategory === '{{ $cat->slug }}' ? 'font-bold text-primary' :
                                                                'font-medium group-hover:text-primary'">
                                            {{ $cat->name }}
                                        </span>
                                    </div>

                                    <span class="transition-colors text-xs py-1 px-2.5 rounded-lg font-bold"
                                        :class="activeCategory === '{{ $cat->slug }}' ? 'bg-primary text-white' :
                                                            'bg-gray-100 text-gray-500 group-hover:bg-primary/10 group-hover:text-primary'">
                                        {{ $cat->programs()->published()->count() }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Most Popular --}}
                <div class="pt-10">
                    <h3
                        class="font-tegas text-xl font-black text-primary mb-6 border-b-2 border-primary/10 pb-2 uppercase tracking-tight">
                        {{ __('messages.program.popular_title') }}
                    </h3>
                    <div class="space-y-6">
                        @foreach ($popularPrograms as $popular)
                            <a href="{{ route('program.show', ['locale' => app()->getLocale(), 'slug' => $popular->slug]) }}"
                                class="flex items-center gap-4 group">
                                <div
                                    class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 border-2 border-gray-100 group-hover:border-primary/30 transition-all">
                                    <img src="{{ asset('storage/' . $popular->featured_image) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="flex-grow">
                                    <h4
                                        class="font-tegas text-xs font-bold text-dark group-hover:text-primary transition-colors leading-tight mb-1 uppercase tracking-normal">
                                        {{ $popular->title }}
                                    </h4>
                                    <div class="flex items-center text-[10px] text-gray-400 font-body space-x-3">
                                        <span class="flex items-center">
                                            <span
                                                class="material-symbols-outlined text-[12px] mr-1 text-primary/40">visibility</span>
                                            {{ number_format($popular->view_count) }}
                                        </span>
                                        <span class="flex items-center uppercase font-bold">
                                            {{ $popular->published_at->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>

            {{-- Main Content Area --}}
            <div class="lg:col-span-3 relative">
                <div x-show="loading" x-transition.opacity
                    class="absolute inset-0 bg-cream/50 z-20 flex justify-center pt-20 backdrop-blur-[1px]">
                    <div class="w-10 h-10 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
                </div>

                <div id="program-container" :class="loading ? 'opacity-30' : 'opacity-100'"
                    class="transition-all duration-500">
                    @include('frontend.partials.program-grid')
                </div>
            </div>
        </div>
    </main>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>
@endsection