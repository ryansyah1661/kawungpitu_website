@extends('frontend.layouts.app')

@section('content')
    <header class="bg-cream pt-40 pb-24 px-8 md:px-12 border-b border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto relative">
            <div class="relative z-10">
                <h1
                    class="font-tegas text-5xl md:text-7xl font-black mb-10 uppercase tracking-tighter animate-fade-in-left w-fit text-left">
                    <span class="bg-white text-dark px-6 pr-20 py-2 block mb-2 w-full shadow-xl shadow-primary/5">
                        {{ __('messages.faq.header_1') }}
                    </span>
                    <span class="bg-primary text-white px-6 pr-20 py-2 block w-full shadow-xl shadow-primary/10">
                        {{ __('messages.faq.header_2') }}
                    </span>
                </h1>

                <div class="flex items-start space-x-6 animate-fade-in-left" style="animation-delay: 0.3s;">
                    <div class="w-1.5 h-20 bg-primary/20 rounded-full hidden md:block"></div>
                    <p class="text-lg md:text-xl text-primary font-medium max-w-2xl leading-relaxed italic opacity-90">
                        {{ __('messages.faq.description') }}
                    </p>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-8 md:px-12 py-24 relative z-10">
        <div class="space-y-6">
            @forelse ($faqs as $index => $faq)
                <div class="group bg-white border-4 border-gray-100 rounded-[32px] overflow-hidden shadow-sm hover:shadow-md hover:border-primary/20 transition-all duration-300 animate-fade-up"
                    style="animation-delay: {{ 0.2 + $index * 0.1 }}s;">

                    <details class="group">
                        <summary
                            class="flex justify-between items-center p-6 md:p-8 cursor-pointer list-none group-open:bg-primary transition-all duration-500">
                            <span
                                class="font-tegas font-bold text-primary tracking-tight group-open:text-white transition-colors">
                                {{ $faq->question }}
                            </span>
                            <span
                                class="material-symbols-outlined text-primary group-open:text-white group-open:rotate-180 transition-all duration-500">
                                expand_more
                            </span>
                        </summary>

                        <div class="p-6 md:p-8 bg-white border-t-2 border-gray-50">
                            <div class="text-gray-600 font-body leading-relaxed prose max-w-none">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </details>
                </div>
            @empty
                <div class="text-center py-20">
                    <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">help_outline</span>
                    <p class="text-gray-400 font-tegas uppercase tracking-wider">{{ __('messages.faq.empty') }}</p>
                </div>
            @endforelse
        </div>

        {{-- Section CTA Kontak --}}
        <div class="mt-20 p-10 bg-cream rounded-[40px] border-4 border-dashed border-primary/10 text-center animate-fade-up"
            style="animation-delay: 0.8s;">
            <h3 class="font-tegas text-2xl font-black text-primary uppercase mb-4">{{ __('messages.faq.cta_title') }}</h3>
            <p class="text-gray-500 font-body mb-8 italic">{{ __('messages.faq.cta_desc') }}</p>
            <a href="{{ route('kontak', ['locale' => app()->getLocale()]) }}"
                class="inline-block bg-primary text-white px-10 py-4 rounded-2xl font-tegas font-black uppercase tracking-widest hover:bg-[#320002] transition-all shadow-lg shadow-primary/20 hover:scale-105">
                {{ __('messages.faq.cta_btn') }}
            </a>
        </div>
    </main>
@endsection
