@extends('frontend.layouts.app')

@section('content')
    <header class="bg-cream pt-40 pb-24 px-8 md:px-12 border-b border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto relative">
            <div class="relative z-10">
                <h1
                    class="font-tegas text-5xl md:text-7xl font-black mb-10 uppercase tracking-tighter animate-fade-in-left w-fit text-left">
                    <span class="bg-white text-dark px-6 pr-20 py-2 block mb-2 w-full shadow-xl shadow-primary/5">
                        {{ __('messages.gallery.header_1') }}
                    </span>
                    <span class="bg-primary text-white px-6 pr-20 py-2 block w-full shadow-xl shadow-primary/10">
                        {{ __('messages.gallery.header_2') }}
                    </span>
                </h1>
                <div class="flex items-start space-x-6 animate-fade-in-left" style="animation-delay: 0.3s;">
                    <div class="w-1.5 h-20 bg-primary/20 rounded-full hidden md:block"></div>
                    <p class="text-lg md:text-xl text-primary font-medium max-w-2xl leading-relaxed italic opacity-90">
                        {{ __('messages.gallery.description') }}
                    </p>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-8 md:px-12 py-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse ($albums as $album)
                @php
                    // Pengaman: Jika slug bahasa yang aktif kosong, jangan bikin route-nya error
                    $albumUrl = $album->slug
                        ? route('galeri.show', ['locale' => app()->getLocale(), 'slug' => $album->slug])
                        : '#';
                @endphp
                <a href="{{ $albumUrl }}" class="group block">
                    <div
                        class="relative aspect-[4/3] rounded-3xl overflow-hidden mb-6 shadow-xl shadow-primary/5 border border-gray-100">
                        @if ($album->cover_image)
                            <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->title }}"
                                class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <span class="material-symbols-outlined text-6xl text-gray-400">photo_library</span>
                            </div>
                        @endif
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-dark/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-xl shadow-lg">
                            <span class="font-tegas text-sm font-black text-primary">
                                {{ $album->photos_count }} {{ __('messages.gallery.photo_unit') }}
                            </span>
                        </div>
                    </div>
                    <h3
                        class="font-tegas text-xl font-black text-dark group-hover:text-primary transition-colors uppercase tracking-tight mb-2">
                        {{ $album->title }}
                    </h3>
                    @if ($album->description)
                        <p class="text-gray-500 font-body text-sm line-clamp-2 italic">{{ $album->description }}</p>
                    @endif
                </a>
            @empty
                <div class="col-span-3 text-center py-20">
                    <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">photo_library</span>
                    <p class="text-gray-400 font-tegas uppercase tracking-wider">
                        {{ __('messages.gallery.empty') }}
                    </p>
                </div>
            @endforelse
        </div>
    </main>
@endsection
