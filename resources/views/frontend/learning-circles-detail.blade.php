@extends('frontend.layouts.app')

@section('content')
    <article class="bg-cream pt-36 pb-24">
        <div class="max-w-4xl mx-auto px-8 md:px-12">
            {{-- Breadcrumb --}}
            <nav class="mb-10 flex items-center space-x-2 text-sm text-gray-400 font-body">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="hover:text-primary transition-colors">
                    {{ __('messages.navbar.home') }}
                </a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <a href="{{ route('lbk.index', ['locale' => app()->getLocale()]) }}"
                    class="hover:text-primary transition-colors">
                    {{ __('messages.navbar.program') }}
                </a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <span class="text-primary font-medium truncate max-w-[200px]">{{ $lbk->title }}</span>
            </nav>

            {{-- Category + Date --}}
            <div class="flex flex-wrap items-center gap-3 mb-6">
                <span
                    class="bg-primary text-white text-[10px] font-tegas font-black px-4 py-2 rounded-lg uppercase tracking-widest shadow-lg">
                    {{ $lbk->category->name }}
                </span>
                <span
                    class="{{ $lbk->status === 'ongoing' ? 'bg-yellow-500' : 'bg-green-500' }} text-white text-[10px] font-bold py-2 px-4 rounded-lg uppercase tracking-widest shadow-lg flex items-center gap-1.5">
                    @if ($lbk->status === 'ongoing')
                        <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                        {{ __('messages.program.ongoing') }}
                    @else
                        <span class="material-symbols-outlined text-xs">check_circle</span>
                        {{ __('messages.program.completed') }}
                    @endif
                </span>
                @if ($lbk->published_at)
                    <time class="text-sm text-gray-400 font-bold uppercase tracking-widest">
                        {{ $lbk->published_at->translatedFormat('d F Y') }}
                    </time>
                @endif
                <span class="flex items-center text-sm text-gray-400">
                    <span class="material-symbols-outlined text-sm mr-1">visibility</span>
                    {{ number_format($lbk->view_count) }}
                </span>
            </div>

            {{-- Title --}}
            <h1 class="font-tegas text-4xl md:text-5xl font-black text-dark uppercase tracking-tighter leading-tight mb-10">
                {{ $lbk->title }}
            </h1>

            {{-- Featured Image --}}
            @if ($lbk->featured_image)
                <div class="aspect-video rounded-2xl overflow-hidden mb-12 shadow-2xl shadow-primary/10">
                    <img src="{{ asset('storage/' . $lbk->featured_image) }}" alt="{{ $lbk->title }}"
                        class="w-full h-full object-cover">
                </div>
            @endif

            {{-- Video --}}
            @if ($lbk->video_url)
                @php
                    preg_match(
                        '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
                        $lbk->video_url,
                        $match,
                    );
                    $videoId = $match[1] ?? null;
                @endphp
                @if ($videoId)
                    <div class="aspect-video rounded-2xl overflow-hidden mb-12 shadow-2xl shadow-primary/10">
                        <iframe src="https://www.youtube.com/embed/{{ $videoId }}" class="w-full h-full"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                @endif
            @endif

            {{-- Body --}}
            <div
                class="prose prose-lg max-w-none prose-headings:font-tegas prose-headings:uppercase prose-headings:tracking-tight prose-a:text-primary prose-strong:text-dark">
                {!! $lbk->body !!}
            </div>

            {{-- PDF Download --}}
            @if ($lbk->pdf_file)
                <div class="mt-12 p-8 bg-white rounded-2xl border-2 border-primary/10 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <span class="material-symbols-outlined text-4xl text-red-500">picture_as_pdf</span>
                        <div>
                            <h4 class="font-tegas font-bold text-dark uppercase text-sm">
                                {{ __('messages.program.download_title') }}</h4>
                            <p class="text-gray-400 text-xs">{{ __('messages.program.download_subtitle') }}</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $lbk->pdf_file) }}" target="_blank"
                        class="bg-primary text-white px-6 py-3 rounded-xl font-tegas font-bold uppercase text-xs tracking-widest hover:bg-[#320002] transition-all shadow-lg shadow-primary/20">
                        {{ __('messages.program.download_btn') }}
                    </a>
                </div>
            @endif
        </div>
    </article>

    {{-- Previous / Next Navigation --}}
    <div class="bg-white border-t border-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-8 md:px-12">
            <div class="grid grid-cols-2 gap-8">
                <div>
                    @if ($previousMaterial && $previousMaterial->slug)
                        <a href="{{ route('lbk.show', ['locale' => app()->getLocale(), 'slug' => $previousMaterial->slug]) }}"
                            class="group flex items-center space-x-3 text-left">
                            <span
                                class="material-symbols-outlined text-primary group-hover:-translate-x-1 transition-transform">arrow_back</span>
                            <div>
                                <span
                                    class="text-xs text-gray-400 font-tegas uppercase tracking-widest block mb-1">{{ __('messages.program.prev') }}</span>
                                <span
                                    class="font-tegas font-bold text-dark group-hover:text-primary transition-colors uppercase text-sm">{{ $previousMaterial->title }}</span>
                            </div>
                        </a>
                    @endif
                </div>
                <div class="text-right">
                    @if ($nextMaterial && $nextMaterial->slug)
                        <a href="{{ route('lbk.show', ['locale' => app()->getLocale(), 'slug' => $nextMaterial->slug]) }}"
                            class="group inline-flex items-center space-x-3">
                            <div>
                                <span
                                    class="text-xs text-gray-400 font-tegas uppercase tracking-widest block mb-1">{{ __('messages.program.next') }}</span>
                                <span
                                    class="font-tegas font-bold text-dark group-hover:text-primary transition-colors uppercase text-sm">{{ $nextMaterial->title }}</span>
                            </div>
                            <span
                                class="material-symbols-outlined text-primary group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
