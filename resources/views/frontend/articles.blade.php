@extends('frontend.layouts.app')

@section('content')
    <header class="bg-cream pt-40 pb-24 px-8 md:px-12 border-b border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto relative">
            <div class="relative z-10">
                <h1
                    class="font-tegas text-5xl md:text-7xl font-black mb-10 uppercase tracking-tighter animate-fade-in-left w-fit text-left">
                    <span class="bg-white text-dark px-6 pr-20 py-2 block mb-2 w-full shadow-xl shadow-primary/5">
                        {{ __('messages.articles.header_1') }}
                    </span>
                    <span class="bg-primary text-white px-6 pr-20 py-2 block w-full shadow-xl shadow-primary/10">
                        {{ __('messages.articles.header_2') }}
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

    <main class="max-w-7xl mx-auto px-8 md:px-12 py-16 -mt-12 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 lg:gap-16">

            <aside class="lg:col-span-1 space-y-12">
                {{-- Search --}}
                <form action="{{ route('artikel.index', ['locale' => app()->getLocale()]) }}" method="GET">
                    <div class="relative bg-white rounded-2xl p-4 shadow-xl shadow-primary/5 border border-gray-100 group">
                        <div class="flex items-center">
                            <span class="material-symbols-outlined text-primary mr-3">search</span>
                            <input
                                class="w-full bg-transparent border-none outline-none text-dark placeholder:text-gray-400 focus:ring-0 p-0 font-body text-sm"
                                placeholder="{{ __('messages.articles.search_placeholder') }}" type="text" name="search"
                                value="{{ request('search') }}" />
                        </div>
                    </div>
                </form>

                {{-- Kategori --}}
                <div>
                    <h3
                        class="font-tegas text-xl font-black text-primary mb-6 border-b-2 border-primary/10 pb-2 uppercase tracking-tight">
                        {{ __('messages.articles.category_title') }}</h3>
                    <ul class="space-y-4 font-body text-gray-600">
                        <li>
                            <a class="flex justify-between items-center group"
                                href="{{ route('artikel.index', ['locale' => app()->getLocale()]) }}">
                                <span
                                    class="group-hover:text-primary transition-colors {{ !isset($currentCategory) ? 'font-bold text-primary' : 'font-medium' }}">
                                    {{ __('messages.articles.all_articles') }}
                                </span>
                                <span
                                    class="bg-primary text-white text-xs py-1 px-2.5 rounded-lg font-bold">{{ $articles->total() }}</span>
                            </a>
                        </li>
                        @foreach ($categories as $cat)
                            <li>
                                <a class="flex justify-between items-center group hover:translate-x-1 transition-transform duration-300"
                                    href="{{ $cat->slug ? route('artikel.kategori', ['locale' => app()->getLocale(), 'slug' => $cat->slug]) : '#' }}">
                                    <span
                                        class="group-hover:text-primary transition-colors {{ isset($currentCategory) && $currentCategory->id === $cat->id ? 'font-bold text-primary' : 'font-medium' }}">{{ $cat->name }}</span>
                                    <span
                                        class="bg-gray-100 text-gray-500 group-hover:bg-primary/10 group-hover:text-primary transition-colors text-xs py-1 px-2.5 rounded-lg font-bold">{{ $cat->articles()->published()->count() }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Popular --}}
                <div class="pt-10">
                    <h3
                        class="font-tegas text-xl font-black text-primary mb-6 border-b-2 border-primary/10 pb-2 uppercase tracking-tight">
                        {{ __('messages.articles.popular_title') }}
                    </h3>

                    <div class="space-y-6">
                        @foreach ($popularArticles as $popular)
                            @php
                                $popularUrl = $popular->slug
                                    ? route('artikel.show', ['locale' => app()->getLocale(), 'slug' => $popular->slug])
                                    : '#';
                            @endphp
                            <a href="{{ $popularUrl }}" class="flex items-center gap-4 group">
                                <div
                                    class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 border-2 border-gray-100 group-hover:border-primary/30 transition-all">
                                    @if ($popular->featured_image)
                                        <img src="{{ asset('storage/' . $popular->featured_image) }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-2xl text-gray-400">article</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-grow">
                                    <h4
                                        class="font-tegas text-xs font-bold text-dark group-hover:text-primary transition-colors leading-tight mb-1 uppercase">
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

            <div class="lg:col-span-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                    @forelse ($articles as $article)
                        @php
                            $articleUrl = $article->slug
                                ? route('artikel.show', ['locale' => app()->getLocale(), 'slug' => $article->slug])
                                : '#';
                        @endphp
                        <article
                            class="bg-white flex flex-col rounded-3xl overflow-hidden shadow-xl shadow-primary/5 hover:-translate-y-2 transition-all duration-500 group border border-gray-100">
                            <a href="{{ $articleUrl }}" class="relative h-64 overflow-hidden block group">
                                @if ($article->featured_image)
                                    <img alt="{{ $article->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                        src="{{ asset('storage/' . $article->featured_image) }}" />
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-6xl text-gray-400">article</span>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="bg-primary text-white text-[10px] font-bold py-1.5 px-3 rounded-lg uppercase tracking-widest shadow-lg">{{ $article->category->name }}</span>
                                </div>
                            </a>

                            <div class="p-8 flex flex-grow flex-col">
                                <div class="flex items-center text-xs text-gray-400 mb-4 font-body font-bold space-x-3">
                                    <span>{{ $article->published_at->translatedFormat('d M Y') }}</span>
                                    <span class="w-1 h-1 bg-primary/30 rounded-full"></span>
                                    <span class="text-gray-400"> {{ $article->author_name ?? 'Admin' }}</span>
                                    <span class="w-1 h-1 bg-primary/30 rounded-full"></span>
                                    <span>{{ number_format($article->view_count) }} views</span>
                                </div>
                                <h2
                                    class="font-tegas text-xl font-black text-primary mb-4 leading-tight uppercase group-hover:text-dark transition-colors">
                                    <a href="{{ $articleUrl }}">
                                        {{ $article->title }}
                                    </a>
                                </h2>
                                <p class="text-gray-600 font-body text-sm mb-8 line-clamp-3 leading-relaxed font-light">
                                    {{ $article->excerpt }}
                                </p>
                                <a class="inline-flex items-center text-primary font-bold font-tegas text-xs uppercase tracking-widest group mt-auto"
                                    href="{{ $articleUrl }}">
                                    <span class="hover-underline">{{ __('messages.articles.read_more') }}</span>
                                    <span
                                        class="material-symbols-outlined ml-2 text-[18px] group-hover:translate-x-2 transition-transform duration-300">arrow_right_alt</span>
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-2 text-center py-20">
                            <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">article</span>
                            <p class="text-gray-400 font-tegas uppercase tracking-wider">
                                {{ __('messages.articles.empty') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Centered Pagination --}}
            @if ($articles->hasPages())
                <div class="lg:col-span-4 mt-20 flex justify-center custom-pagination">
                    {{ $articles->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </main>
@endsection
