@extends('frontend.layouts.app')

@section('content')
    {{-- SECTION HERO --}}
    <section class="relative w-full h-[600px] flex items-center bg-dark overflow-hidden pt-24">
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=2000"
                alt="{{ __('messages.about.header.img_alt') }}"
                class="w-full h-full object-cover opacity-60 animate-slow-zoom">
            <div class="absolute inset-0 bg-gradient-to-r from-dark/90 via-dark/70 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 md:px-12 w-full">
            <div class="max-w-3xl mt-12 md:mt-0">
                <h1
                    class="font-tegas text-5xl md:text-7xl font-black mb-10 uppercase tracking-tighter animate-fade-in-left w-fit text-left">
                    <span class="bg-white text-dark px-6 pr-12 py-2 block mb-2 w-full">
                        {{ __('messages.about.header.title_1') }}
                    </span>
                    <span class="bg-primary text-white px-6 pr-12 py-2 block w-full">
                        {{ __('messages.about.header.title_2') }}
                    </span>
                </h1>

                <p class="text-xl text-white/80 max-w-2xl font-light animate-fade-in-left leading-relaxed mb-10"
                    style="animation-delay: 0.3s;">
                    {{ __('messages.about.header.subtitle') }}
                </p>

                <div class="flex flex-wrap gap-4 animate-fade-in-left" style="animation-delay: 0.5s;">
                    <a href="#visi-misi"
                        class="bg-white text-primary px-8 py-3 font-tegas font-black uppercase tracking-widest hover:bg-primary hover:text-white transition-all duration-300 border-2 border-white">
                        {{ __('messages.about.header.btn_vision') }}
                    </a>
                    <a href="#pilar"
                        class="bg-primary text-white px-8 py-3 font-tegas font-black uppercase tracking-widest hover:bg-white hover:text-primary transition-all duration-300 border-2 border-primary">
                        {{ __('messages.about.header.btn_pillars') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION INTRO --}}
    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-6 animate-fade-in-left">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-px bg-primary"></div>
                        <span
                            class="text-primary font-bold uppercase tracking-widest text-sm">{{ __('messages.about.intro.badge') }}</span>
                    </div>
                    <h2 class="font-tegas text-4xl font-black text-dark uppercase tracking-tight leading-tight">
                        {!! __('messages.about.intro.title') !!}
                    </h2>
                    <p class="text-lg text-primary font-light leading-relaxed">
                        {{ __('messages.about.intro.p1') }}
                    </p>
                    <p class="text-lg text-primary font-light leading-relaxed">
                        {{ __('messages.about.intro.p2') }}
                    </p>
                </div>
                <div class="relative group">
                    <div class="absolute -top-6 -left-6 w-full h-full bg-primary/10 rounded-2xl"></div>
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&q=80&w=1000"
                        alt="{{ __('messages.about.intro.img_alt') }}"
                        class="relative z-10 rounded-2xl shadow-2xl object-cover h-[500px] w-full group-hover:scale-[1.02] transition-transform duration-500">
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION VISI MISI NILAI --}}
    <section id="visi-misi" class="py-24 bg-white border-t border-gray-100 scroll-mt-32">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">

                {{-- Visi --}}
                <div
                    class="group p-10 bg-[#F2E7DF] text-dark rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/50 hover:-translate-y-2 transition-all duration-500 flex flex-col">
                    <div>
                        <div
                            class="w-16 h-16 bg-primary/5 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500 text-primary">
                            <span class="material-symbols-outlined text-4xl">visibility</span>
                        </div>
                        <h2 class="font-tegas text-4xl font-black text-primary mb-6 uppercase tracking-tighter">
                            {{ __('messages.about.vmn.vision_title') }}
                        </h2>
                        <p class="font-body text-xl leading-relaxed font-bold text-primary">
                            "{{ __('messages.about.vmn.vision_text') }}"
                        </p>
                    </div>
                    <div class="mt-auto pt-8">
                        <div class="h-1 w-10 bg-primary/20 group-hover:w-full transition-all duration-700"></div>
                    </div>
                </div>

                {{-- Misi --}}
                <div
                    class="group p-10 bg-[#F2E7DF] text-dark rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/50 hover:-translate-y-2 transition-all duration-500 flex flex-col">
                    <div
                        class="w-16 h-16 bg-primary/5 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500 text-primary">
                        <span class="material-symbols-outlined text-4xl">flag</span>
                    </div>
                    <h2 class="font-tegas text-3xl font-black text-primary mb-8 uppercase tracking-tighter">
                        {{ __('messages.about.vmn.mission_title') }}</h2>
                    <ul class="space-y-6">
                        @foreach (__('messages.about.vmn.mission_list') as $no => $teks)
                            <li class="flex gap-4">
                                <span
                                    class="font-tegas font-black text-primary text-2xl leading-none">{{ $no }}</span>
                                <p class="text-primary leading-tight font-bold">{{ $teks }}</p>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-auto pt-8">
                        <div class="h-1 w-10 bg-primary/20 group-hover:w-full transition-all duration-700"></div>
                    </div>
                </div>

                {{-- Nilai --}}
                <div
                    class="group p-10 bg-[#F2E7DF] text-dark rounded-3xl border border-primary/5 shadow-xl shadow-primary/5 hover:-translate-y-2 transition-all duration-500 flex flex-col">
                    <div
                        class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500 text-primary">
                        <span class="material-symbols-outlined text-4xl">diamond</span>
                    </div>
                    <h2 class="font-tegas text-3xl font-black text-primary mb-8 uppercase tracking-tighter">
                        {{ __('messages.about.vmn.values_title') }}</h2>

                    <div class="grid grid-cols-1 gap-y-3">
                        <div class="flex flex-wrap gap-3">
                            @foreach (__('messages.about.vmn.values_list') as $n)
                                <span
                                    class="bg-primary/10 border border-primary/20 px-4 py-2 rounded-xl text-sm font-bold text-primary flex items-center gap-2 hover:bg-primary hover:text-white transition-all duration-300 group/pill">
                                    <span
                                        class="w-1.5 h-1.5 bg-primary rounded-full group-hover/pill:bg-white transition-colors"></span>
                                    {{ $n }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <p class="mt-auto pt-8 text-[10px] text-primary/40 uppercase tracking-widest font-bold">
                        {{ __('messages.about.vmn.values_footer') }}
                    </p>
                    <div class="mt-2">
                        <div class="h-1 w-10 bg-primary/20 group-hover:w-full transition-all duration-700"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- SECTION PILAR --}}
    <section id="pilar" class="py-24 bg-white border-t border-gray-100 scroll-mt-32">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="text-center mb-20 space-y-4">
                <h2 class="font-tegas text-4xl font-black text-primary uppercase tracking-tighter">
                    {{ __('messages.about.pillars.title') }}</h2>
                <div class="h-1.5 w-24 bg-primary mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                {{-- Pilar 1 --}}
                <div
                    class="group bg-[#F2E7DF] p-10 rounded-3xl shadow-xl shadow-gray-200/50 border border-primary/5 hover:-translate-y-2 transition-all duration-500 flex flex-col h-full">
                    <div
                        class="w-20 h-20 bg-primary/10 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500 text-primary border border-primary/10">
                        <span class="material-symbols-outlined text-5xl">eco</span>
                    </div>
                    <h3 class="font-tegas text-2xl font-black uppercase text-primary mb-4 tracking-tighter leading-tight">
                        {!! __('messages.about.pillars.p1_title') !!}
                    </h3>
                    <p class="text-primary font-bold leading-relaxed opacity-90">
                        {{ __('messages.about.pillars.p1_desc') }}
                    </p>
                    <div class="mt-auto pt-8">
                        <div class="h-1 w-10 bg-primary/20 group-hover:w-full transition-all duration-700"></div>
                    </div>
                </div>

                {{-- Pilar 2 --}}
                <div
                    class="group bg-[#F2E7DF] p-10 rounded-3xl shadow-xl shadow-gray-200/50 border border-primary/5 hover:-translate-y-2 transition-all duration-500 flex flex-col h-full">
                    <div
                        class="w-20 h-20 bg-primary/10 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500 text-primary border border-primary/10">
                        <span class="material-symbols-outlined text-5xl">groups</span>
                    </div>
                    <h3 class="font-tegas text-2xl font-black uppercase text-primary mb-4 tracking-tighter leading-tight">
                        {!! __('messages.about.pillars.p2_title') !!}
                    </h3>
                    <p class="text-primary font-bold leading-relaxed opacity-90">
                        {{ __('messages.about.pillars.p2_desc') }}
                    </p>
                    <div class="mt-auto pt-8">
                        <div class="h-1 w-10 bg-primary/20 group-hover:w-full transition-all duration-700"></div>
                    </div>
                </div>

                {{-- Pilar 3 --}}
                <div
                    class="group bg-[#F2E7DF] p-10 rounded-3xl shadow-xl shadow-gray-200/50 border border-primary/5 hover:-translate-y-2 transition-all duration-500 flex flex-col h-full">
                    <div
                        class="w-20 h-20 bg-primary/10 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500 text-primary border border-primary/10">
                        <span class="material-symbols-outlined text-5xl">trending_up</span>
                    </div>
                    <h3 class="font-tegas text-2xl font-black uppercase text-primary mb-4 tracking-tighter leading-tight">
                        {!! __('messages.about.pillars.p3_title') !!}
                    </h3>
                    <p class="text-primary font-bold leading-relaxed opacity-90">
                        {{ __('messages.about.pillars.p3_desc') }}
                    </p>
                    <div class="mt-auto pt-8">
                        <div class="h-1 w-10 bg-primary/20 group-hover:w-full transition-all duration-700"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION TIM --}}
    <section class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="text-center mb-20">
            <h2 class="font-tegas text-4xl font-black text-primary mb-4 uppercase">{{ __('messages.about.team.title') }}
            </h2>
            <div class="h-1 w-20 bg-primary mx-auto"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <div class="group text-center">
                <div class="relative overflow-hidden rounded-2xl bg-cream aspect-[3/4] mb-6 shadow-xl shadow-primary/5">
                    <img alt="{{ __('messages.about.team.img_alt_founder') }}"
                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-110"
                        src="{{ asset('images/noel.jpg') }}" />
                </div>
                <h3 class="font-tegas text-xl font-bold text-dark">Noel Gallagher</h3>
                <p class="font-body text-sm text-primary font-bold mt-1 uppercase tracking-widest">
                    {{ __('messages.about.team.role_founder') }}</p>
            </div>
        </div>
    </section>
@endsection
