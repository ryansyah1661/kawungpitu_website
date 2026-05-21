@extends('frontend.layouts.app')
@section('title', __('messages.navbar.article'))

@section('content')
    {{-- SECTION HEADER: Dibuat minimalis 1 baris dengan tracking-widest --}}
    <header class="bg-cream pt-40 pb-24 px-8 md:px-12 border-b border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto relative">
            <div class="relative z-10">
                {{-- Ganti bagian <h1> di Header Artikel dengan ini Qi --}}
                <h1 class="font-tegas text-5xl md:text-7xl font-black mb-10 uppercase tracking-normal animate-fade-in-left w-fit text-left">
                    <span class="bg-primary text-white px-6 pr-16 py-2 block w-full shadow-xl shadow-primary/20">
                      ARTIKEL
                    </span>
                </h1>
                <div class="flex items-start space-x-6 animate-fade-in-left" style="animation-delay: 0.3s;">
                    <div class="w-1.5 h-20 bg-primary/20 rounded-full hidden md:block"></div>
                    <p class="text-lg md:text-xl text-primary font-medium max-w-2xl leading-relaxed italic opacity-90">
                        {{ __('messages.articles.description') }}
                    </p>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-8 md:px-12 py-16 -mt-12 relative z-10" x-data="{
            loading: false,
            activeId: {{ isset($currentCategory) ? $currentCategory->id : "'all'" }},
            fetchArticles(url, id) {
                this.loading = true;
                this.activeId = id;
                fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('article-container').innerHTML = html;
                        this.loading = false;
                        window.history.pushState({}, '', url);
                        window.scrollTo({ top: 400, behavior: 'smooth' });
                    });
            }
        }">

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 lg:gap-16">
            <aside class="lg:col-span-1 space-y-12">
                {{-- Search --}}
                <form action="{{ route('artikel.index', ['locale' => app()->getLocale()]) }}" method="GET">
                    <div class="relative bg-white rounded-2xl p-4 shadow-xl shadow-primary/5 border border-gray-100 group">
                        <div class="flex items-center">
                            <span class="material-symbols-outlined text-primary mr-3">search</span>
                            <input class="w-full bg-transparent border-none outline-none text-dark focus:ring-0 p-0 text-sm"
                                placeholder="{{ __('messages.articles.search_placeholder') }}" type="text" name="search"
                                value="{{ request('search') }}" />
                        </div>
                    </div>
                </form>

                {{-- Kategori Sidebar --}}
                <div>
                    <h3 class="font-tegas text-xl font-black text-primary mb-6 border-b-2 border-primary/10 pb-2 uppercase tracking-tight">
                        {{ __('messages.articles.category_title') }}
                    </h3>
                    <ul class="space-y-4 font-body">
                        {{-- Semua Artikel --}}
                        <li>
                            <a class="flex justify-between items-center group cursor-pointer"
                                @click.prevent="fetchArticles($el.href, 'all')"
                                href="{{ route('artikel.index', ['locale' => app()->getLocale()]) }}">
                                <span :class="activeId === 'all' ? 'font-bold text-primary' : 'font-medium text-gray-600 group-hover:text-primary'"
                                    class="transition-colors">
                                    {{ __('messages.articles.all_articles') }}
                                </span>
                                <span :class="activeId === 'all' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-500 group-hover:bg-primary/10 group-hover:text-primary'"
                                    class="text-xs py-1 px-2.5 rounded-lg font-bold transition-colors">
                                    {{ $totalArticlesCount }}
                                </span>
                            </a>
                        </li>
                        {{-- Loop Kategori --}}
                        @foreach ($categories as $cat)
                            <li>
                                <a class="flex justify-between items-center group hover:translate-x-1 transition-all cursor-pointer"
                                    @click.prevent="fetchArticles($el.href, {{ $cat->id }})"
                                    href="{{ route('artikel.kategori', ['locale' => app()->getLocale(), 'slug' => $cat->slug]) }}">
                                    <span :class="activeId === {{ $cat->id }} ? 'font-bold text-primary' : 'font-medium text-gray-600 group-hover:text-primary'"
                                        class="transition-colors">
                                        {{ $cat->name }}
                                    </span>
                                    <span :class="activeId === {{ $cat->id }} ? 'bg-primary text-white' : 'bg-gray-100 text-gray-500 group-hover:bg-primary/10 group-hover:text-primary'"
                                        class="text-xs py-1 px-2.5 rounded-lg font-bold transition-colors">
                                        {{ $cat->articles()->published()->count() }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Popular --}}
                <div class="pt-10">
                    <h3 class="font-tegas text-xl font-black text-primary mb-6 border-b-2 border-primary/10 pb-2 uppercase tracking-tight">
                        {{ __('messages.articles.popular_title') }}
                    </h3>
                    <div class="space-y-6">
                        @foreach ($popularArticles as $popular)
                            @php $popularUrl = route('artikel.show', ['locale' => app()->getLocale(), 'slug' => $popular->slug]); @endphp
                            <a href="{{ $popularUrl }}" class="flex items-center gap-4 group">
                                <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 border-2 border-gray-100 group-hover:border-primary/30 transition-all">
                                    @if ($popular->featured_image)
                                        <img src="{{ asset('storage/' . $popular->featured_image) }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-all duration-500">
                                    @else
                                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-2xl text-gray-400">article</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <h4 class="font-tegas text-xs font-bold text-dark group-hover:text-primary transition-colors leading-tight mb-1 uppercase line-clamp-2">
                                        {{ $popular->title }}
                                    </h4>
                                    <div class="flex items-center text-[10px] text-gray-400 font-body">
                                        <span class="material-symbols-outlined text-[12px] mr-1">visibility</span>
                                        {{ number_format($popular->view_count) }} {{ __('messages.articles.visited') }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>

            {{-- Container Utama Artikel --}}
            <div class="lg:col-span-3 relative">
                <div x-show="loading" x-transition.opacity
                    class="absolute inset-0 bg-cream/50 z-20 flex justify-center pt-20 backdrop-blur-[1px]">
                    <div class="w-10 h-10 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
                </div>

                <div id="article-container" :class="loading ? 'opacity-30' : 'opacity-100'"
                    class="transition-all duration-500">
                    @include('frontend.partials.article-grid')
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