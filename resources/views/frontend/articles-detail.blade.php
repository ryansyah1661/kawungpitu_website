@extends('frontend.layouts.app')
@section('title', $artikel->title)

@section('content')
    <article class="bg-cream pt-36 pb-24">
        <div class="max-w-4xl mx-auto px-8 md:px-12">
            {{-- Breadcrumb --}}
            <nav class="mb-8 flex items-center space-x-3 text-[10px] uppercase tracking-normal font-tegas text-gray-400">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
                    class="hover:text-primary transition-colors">{{ __('messages.navbar.home') }}</a>
                <span class="text-gray-300">/</span>
                <a href="{{ route('artikel.index', ['locale' => app()->getLocale()]) }}"
                    class="hover:text-primary transition-colors">{{ __('messages.navbar.article') }}</a>
            </nav>

            {{-- Metadata --}}
            <div class="flex flex-wrap items-center gap-y-4 gap-x-6 mb-8">
                <div class="flex flex-wrap gap-2">
                    @foreach ($artikel->categories as $category)
                        <span
                            class="bg-primary text-white text-[10px] font-tegas font-black px-4 py-2 rounded-lg uppercase tracking-normal shadow-lg">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>

                <div class="flex items-center space-x-4 uppercase tracking-normal"> {{-- Dipaksa Uppercase & Rapat --}}
                    <time class="text-xs text-gray-400 font-bold">
                        {{ $artikel->published_at->translatedFormat('d F Y') }}
                    </time>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <span class="flex items-center text-xs text-gray-400 font-bold">
                        <span class="material-symbols-outlined text-[14px] mr-1.5 text-primary/40">person</span>
                        {{ $artikel->author_name ?? 'ADMIN' }}
                    </span>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <span class="flex items-center text-xs text-gray-400 font-bold">
                        <span class="material-symbols-outlined text-[14px] mr-1 text-primary/40">visibility</span>
                        <span class="ml-1">{{ number_format($artikel->view_count) }} VIEWS</span>
                    </span>
                </div>

                {{-- Judul Artikel --}}
                <h1
                    class="font-tegas text-4xl md:text-5xl font-black text-dark uppercase tracking-normal leading-tight mb-10">
                    {{ $artikel->title }}
                </h1>

                {{-- Featured Image --}}
                @if ($artikel->featured_image)
                    <div class="aspect-video rounded-3xl overflow-hidden mb-16 shadow-2xl shadow-primary/5">
                        <img src="{{ asset('storage/' . $artikel->featured_image) }}" alt="{{ $artikel->title }}"
                            class="w-full h-full object-cover">
                    </div>
                @endif

                <div
                    class="prose prose-lg max-w-none prose-headings:font-tegas prose-headings:uppercase prose-headings:tracking-normal font-body text-gray-700 leading-relaxed">
                    {!! $artikel->body !!}
                </div>
            </div>
    </article>

    {{-- Related Articles --}}
    @if ($relatedArticles->isNotEmpty())
        <section class="py-20 bg-white border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-8 md:px-12">
                <h2 class="font-tegas text-3xl font-black text-dark uppercase tracking-tighter mb-12">
                    {{ __('messages.articles.related_title') }}
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @foreach ($relatedArticles as $related)
                        @php
                            // Keamanan: Cek slug sebelum generate route
                            $relatedUrl = $related->slug
                                ? route('artikel.show', ['locale' => app()->getLocale(), 'slug' => $related->slug])
                                : '#';
                        @endphp
                        <article class="group flex flex-col h-full">
                            <a href="{{ $relatedUrl }}"
                                class="relative overflow-hidden rounded-none aspect-[4/3] mb-6 block border border-gray-100">
                                @if ($related->featured_image)
                                    <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}"
                                        class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-5xl text-gray-400">article</span>
                                    </div>
                                @endif
                            </a>
                            <time class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-2 block">
                                {{ $related->published_at->translatedFormat('d M Y') }}
                            </time>
                            <h3
                                class="font-tegas text-lg font-black text-dark group-hover:text-primary transition-colors leading-tight uppercase">
                                <a href="{{ $relatedUrl }}">{{ $related->title }}</a>
                            </h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection