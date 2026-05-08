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
                <span
                    class="inline-block text-white/90 font-medium tracking-[0.2em] uppercase text-sm mb-6 pl-4 border-l-2 border-primary ml-1">
                    {{ __('messages.hero.badge') }}
                </span>
                <h1
                    class="font-tegas text-5xl md:text-6xl lg:text-7xl font-black mb-8 uppercase tracking-tighter animate-fade-in-left w-fit">
                    <span
                        class="bg-white text-dark pl-6 pr-12 py-2 block mb-2 w-full shadow-xl">{{ __('messages.hero.title_1') }}</span>
                    <span
                        class="bg-primary text-white pl-6 pr-12 py-2 block mb-2 w-full shadow-xl">{{ __('messages.hero.title_2') }}</span>
                    <span
                        class="bg-white text-dark pl-6 pr-12 py-2 block w-full shadow-xl">{{ __('messages.hero.title_3') }}</span>
                </h1>
                <p class="text-lg md:text-xl text-white/80 font-light mb-12 max-w-2xl leading-relaxed">
                    {{ __('messages.hero.description') }}
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
    <section class="py-24 md:py-32 bg-cream">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-center">
                <div class="relative order-2 lg:order-1">
                    <div
                        class="absolute -top-10 -left-10 w-72 h-72 bg-primary/5 rounded-full mix-blend-multiply filter blur-3xl">
                    </div>
                    <img src="https://images.unsplash.com/photo-1511497584788-876760111969?auto=format&fit=crop&q=80&w=1000"
                        alt="Community"
                        class="relative z-10 rounded-xl shadow-2xl object-cover h-[500px] w-full lg:w-[90%] lg:ml-auto">
                    <div
                        class="absolute bottom-10 -left-8 bg-white p-8 rounded-xl shadow-2xl z-20 hidden md:block border border-gray-100/50">
                        <div class="text-5xl font-tegas font-black text-primary mb-2">10k+</div>
                        <div class="text-sm font-bold text-dark uppercase tracking-widest">
                            {{ __('messages.commitment.benefit_label') }}</div>
                    </div>
                </div>

                <div class="space-y-8 order-1 lg:order-2">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-px bg-primary"></div>
                        <span
                            class="text-primary font-tegas font-bold uppercase tracking-[0.2em] text-sm">{{ __('messages.commitment.badge') }}</span>
                    </div>
                    <h2
                        class="font-tegas text-4xl md:text-5xl font-black text-primary leading-tight uppercase tracking-tighter">
                        {{ __('messages.commitment.title') }} <span
                            class="text-dark">{{ __('messages.commitment.title_dark') }}</span>
                    </h2>
                    <div class="space-y-6">
                        <p class="text-xl text-primary leading-relaxed italic opacity-95 font-medium">
                            "{!! __('messages.commitment.quote') !!}"
                        </p>
                        <p class="text-lg text-primary leading-relaxed font-light">
                            {{ __('messages.commitment.description') }}
                        </p>
                    </div>
                    <div class="pt-6">
                        <a href="{{ route('tentang', ['locale' => app()->getLocale()]) }}"
                            class="inline-flex items-center text-primary font-tegas font-bold hover-underline group text-lg uppercase tracking-wider">
                            {{ __('messages.commitment.learn_more') }}
                            <span
                                class="material-symbols-outlined ml-2 group-hover:translate-x-2 transition-transform duration-300">east</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION STRATEGY --}}
    <section class="py-24 bg-primary border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="text-center mb-20 space-y-4">
                <h2 class="font-tegas text-4xl md:text-5xl font-black text-white uppercase tracking-tighter">
                    {{ __('messages.strategy.title') }}
                </h2>
                <div class="h-1.5 w-24 bg-white/50 mx-auto rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
                @php
                    $strategi = [
                        [
                            'icon' => 'hub',
                            'title' => __('messages.strategy.items.organizing.title'),
                            'desc' => __('messages.strategy.items.organizing.desc'),
                        ],
                        [
                            'icon' => 'handshake',
                            'title' => __('messages.strategy.items.development.title'),
                            'desc' => __('messages.strategy.items.development.desc'),
                        ],
                        [
                            'icon' => 'school',
                            'title' => __('messages.strategy.items.capacity.title'),
                            'desc' => __('messages.strategy.items.capacity.desc'),
                        ],
                        [
                            'icon' => 'analytics',
                            'title' => __('messages.strategy.items.research.title'),
                            'desc' => __('messages.strategy.items.research.desc'),
                        ],
                        [
                            'icon' => 'campaign',
                            'title' => __('messages.strategy.items.advocacy.title'),
                            'desc' => __('messages.strategy.items.advocacy.desc'),
                        ],
                        [
                            'icon' => 'architecture',
                            'title' => __('messages.strategy.items.modelling.title'),
                            'desc' => __('messages.strategy.items.modelling.desc'),
                        ],
                    ];
                @endphp
                @foreach ($strategi as $s)
                    <div
                        class="group bg-[#F2E7DF] p-10 rounded-3xl shadow-xl hover:-translate-y-2 transition-all duration-500 flex flex-col items-center text-center h-full border border-primary/5">
                        <div
                            class="w-20 h-20 bg-primary/10 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500 text-primary border border-primary/10">
                            <span class="material-symbols-outlined text-4xl">{{ $s['icon'] }}</span>
                        </div>
                        <h3
                            class="font-tegas text-xl font-black text-primary uppercase mb-4 tracking-tighter leading-tight">
                            {{ $s['title'] }}</h3>
                        <p class="text-primary font-bold leading-relaxed opacity-90 text-sm">{{ $s['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- SECTION ARTICLES --}}
    <section class="py-24 md:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8 border-b border-gray/30 pb-8">
                <div class="max-w-2xl">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-px bg-primary"></div>
                        <span
                            class="text-primary font-bold tracking-[0.2em] uppercase text-sm">{{ __('messages.articles.badge') }}</span>
                    </div>
                    <h2 class="font-tegas text-4xl md:text-5xl font-black text-dark uppercase tracking-tighter">
                        {{ __('messages.articles.title') }}</h2>
                </div>
                <a href="{{ route('artikel.index', ['locale' => app()->getLocale()]) }}"
                    class="inline-flex items-center space-x-2 text-dark hover:text-primary transition-colors font-tegas font-bold uppercase text-xs tracking-widest border border-gray-200 px-6 py-3 rounded-xl hover:border-primary">
                    <span>{{ __('messages.articles.view_all') }}</span>
                    <span class="material-symbols-outlined text-sm">arrow_outward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-12">
                @forelse ($latestArticles as $article)
                    @php
                        // Keamanan: Cek apakah slug tersedia untuk bahasa ini
                        $articleUrl = $article->slug
                            ? route('artikel.show', ['locale' => app()->getLocale(), 'slug' => $article->slug])
                            : '#';
                    @endphp
                    <article class="group flex flex-col h-full">
                        <a href="{{ $articleUrl }}"
                            class="relative overflow-hidden rounded-none aspect-[4/3] mb-8 block border border-gray-100">
                            @if ($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                                    class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-6xl text-gray-400">article</span>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                                @foreach ($article->categories as $category)
                                    <span
                                        class="bg-primary text-white text-[10px] font-tegas font-black px-4 py-2 rounded-lg uppercase tracking-widest shadow-lg">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                        </a>
                        <div class="flex flex-col flex-grow px-2">
                            <time
                                class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-3 block">{{ $article->published_at->translatedFormat('d F Y') }}</time>
                            <h3
                                class="font-tegas text-2xl font-black text-dark group-hover:text-primary transition-colors duration-300 leading-tight uppercase mb-4">
                                <a href="{{ $articleUrl }}">{{ $article->title }}</a>
                            </h3>
                            <p class="text-gray-600 mb-8 line-clamp-3 font-body text-sm leading-relaxed italic font-light">
                                {{ $article->excerpt }}</p>
                            <a href="{{ $articleUrl }}"
                                class="mt-auto inline-flex items-center text-primary font-bold font-tegas text-xs uppercase tracking-widest group/link">
                                <span class="hover-underline">{{ __('messages.articles.read_more') }}</span>
                                <span
                                    class="material-symbols-outlined ml-1 text-[18px] group-hover/link:translate-x-1 transition-transform duration-300">chevron_right</span>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-400 italic">{{ __('messages.articles.empty') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- SECTION FAQ --}}
    <section class="pt-24 pb-32 bg-white overflow-hidden">
        <div class="max-w-4xl mx-auto px-8 md:px-12">
            <div class="text-center mb-16 animate-fade-up">
                <h2 class="font-tegas text-4xl md:text-5xl font-black text-primary uppercase tracking-tighter">
                    {{ __('messages.faq.title') }}</h2>
                <p class="mt-4 text-primary/60 font-body italic">{{ __('messages.faq.subtitle') }}</p>
            </div>

            <div class="space-y-6">
                @foreach ($faqs as $index => $faq)
                    <div
                        class="group bg-white border-2 border-gray-200 rounded-3xl overflow-hidden shadow-sm hover:border-primary/30 transition-all duration-300">
                        <details class="group">
                            <summary
                                class="flex justify-between items-center p-6 md:p-8 cursor-pointer list-none group-open:bg-primary transition-all duration-500">
                                <span
                                    class="font-tegas font-bold text-primary tracking-tight group-open:text-white">{{ $faq->question }}</span>
                                <span
                                    class="material-symbols-outlined text-primary group-open:text-white group-open:rotate-180 transition-all">expand_more</span>
                            </summary>
                            <div class="p-6 md:p-8 bg-white border-t border-gray-100">
                                <div class="text-gray-600 font-body leading-relaxed prose max-w-none">
                                    {!! $faq->answer !!}</div>
                            </div>
                        </details>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- SECTION CTA --}}
    <section class="py-24 bg-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-5"
            style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 40px 40px;">
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <h2 class="font-tegas text-4xl md:text-5xl lg:text-6xl font-black text-white mb-8 tracking-tight uppercase">
                {{ __('messages.cta.title') }}</h2>
            <p class="text-xl text-white/80 font-light mb-12 max-w-2xl mx-auto leading-relaxed">
                {{ __('messages.cta.description') }}</p>
            <a href="{{ route('kontak', ['locale' => app()->getLocale()]) }}"
                class="inline-flex justify-center items-center bg-cream text-primary px-10 py-5 rounded-xl font-black font-tegas uppercase tracking-widest hover:bg-white hover:scale-105 transition-all duration-300 text-lg shadow-2xl">
                {{ __('messages.cta.button') }}
            </a>
        </div>
    </section>
@endsection
