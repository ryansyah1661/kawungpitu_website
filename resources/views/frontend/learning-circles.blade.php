@extends('frontend.layouts.app')

@section('content')
    <header class="bg-cream pt-40 pb-24 px-8 md:px-12 border-b border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto relative">
            <div class="relative z-10">
                <h1
                    class="font-tegas text-5xl md:text-7xl font-black mb-10 uppercase tracking-tighter animate-fade-in-left w-fit text-left">
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

    <main class="max-w-7xl mx-auto px-8 md:px-12 py-16">
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
                        <li>
                            <a href="{{ route('lbk.index', ['locale' => app()->getLocale()]) }}"
                                class="flex justify-between items-center group hover:translate-x-1 transition-transform duration-300">
                                <span
                                    class="group-hover:text-primary transition-colors {{ !request('status') ? 'font-bold text-primary' : 'font-medium' }}">
                                    {{ __('messages.program.all') }}
                                </span>
                                <span
                                    class="bg-gray-100 text-gray-500 group-hover:bg-primary/10 group-hover:text-primary transition-colors text-xs py-1 px-2.5 rounded-lg font-bold">
                                    {{ $materials->total() }}
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('lbk.index', ['locale' => app()->getLocale(), 'status' => 'ongoing']) }}"
                                class="flex justify-between items-center group hover:translate-x-1 transition-transform duration-300">
                                <div class="flex items-center space-x-3">
                                    <span
                                        class="w-2 h-2 rounded-full bg-yellow-500 {{ request('status') == 'ongoing' ? 'ring-4 ring-yellow-100' : '' }}"></span>
                                    <span
                                        class="group-hover:text-primary transition-colors {{ request('status') == 'ongoing' ? 'font-bold text-primary' : 'font-medium' }}">
                                        {{ __('messages.program.ongoing') }}
                                    </span>
                                </div>
                                <span
                                    class="bg-gray-100 text-gray-500 group-hover:bg-yellow-50 group-hover:text-yellow-600 transition-colors text-xs py-1 px-2.5 rounded-lg font-bold">
                                    {{ \App\Models\LbkMaterial::where('status', 'ongoing')->count() }}
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('lbk.index', ['locale' => app()->getLocale(), 'status' => 'completed']) }}"
                                class="flex justify-between items-center group hover:translate-x-1 transition-transform duration-300">
                                <div class="flex items-center space-x-3">
                                    <span
                                        class="w-2 h-2 rounded-full bg-green-500 {{ request('status') == 'completed' ? 'ring-4 ring-green-100' : '' }}"></span>
                                    <span
                                        class="group-hover:text-primary transition-colors {{ request('status') == 'completed' ? 'font-bold text-primary' : 'font-medium' }}">
                                        {{ __('messages.program.completed') }}
                                    </span>
                                </div>
                                <span
                                    class="bg-gray-100 text-gray-500 group-hover:bg-green-50 group-hover:text-green-600 transition-colors text-xs py-1 px-2.5 rounded-lg font-bold">
                                    {{ \App\Models\LbkMaterial::where('status', 'completed')->count() }}
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
                                <a class="flex justify-between items-center group hover:translate-x-1 transition-transform duration-300"
                                    href="{{ route('lbk.index', ['locale' => app()->getLocale(), 'kategori' => $cat->slug]) }}">

                                    <div class="flex items-center space-x-4">
                                        @if ($cat->icon)
                                            <div
                                                class="p-2 rounded-xl transition-all duration-300 
                                                {{ request('kategori') == $cat->slug ? 'bg-primary shadow-lg shadow-primary/20' : 'bg-primary/5 group-hover:bg-primary' }}">

                                                <img src="{{ asset('storage/' . $cat->icon) }}"
                                                    class="w-6 h-6 object-contain transition-all duration-300 
                                                    {{ request('kategori') == $cat->slug
                                                        ? 'brightness-0 invert'
                                                        : 'opacity-70 grayscale group-hover:opacity-100 group-hover:grayscale-0 group-hover:brightness-0 group-hover:invert' }}"
                                                    alt="{{ $cat->name }}">
                                            </div>
                                        @else
                                            <span
                                                class="material-symbols-outlined text-lg text-primary/40 group-hover:text-primary transition-colors">
                                                category
                                            </span>
                                        @endif
                                        <span
                                            class="group-hover:text-primary transition-colors {{ request('kategori') == $cat->slug ? 'font-bold text-primary' : 'font-medium' }}">
                                            {{ $cat->name }}
                                        </span>
                                    </div>

                                    <span
                                        class="bg-gray-100 text-gray-500 group-hover:bg-primary/10 group-hover:text-primary transition-colors text-xs py-1 px-2.5 rounded-lg font-bold">
                                        {{ $cat->lbkMaterials()->published()->count() }}
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
                            @php
                                $popularUrl = $popular->slug
                                    ? route('lbk.show', ['locale' => app()->getLocale(), 'slug' => $popular->slug])
                                    : '#';
                            @endphp
                            <a href="{{ $popularUrl }}" class="flex items-center gap-4 group">
                                <div
                                    class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 border-2 border-gray-100 group-hover:border-primary/30 transition-all">
                                    @if ($popular->featured_image)
                                        <img src="{{ asset('storage/' . $popular->featured_image) }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-primary/10 to-primary/5 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-xl text-primary/40">school</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <h4
                                        class="font-tegas text-xs font-bold text-dark group-hover:text-primary transition-colors leading-tight mb-1 uppercase">
                                        {{ $popular->title }}
                                    </h4>
                                    <div class="flex items-center text-[10px] text-gray-400 font-body space-x-3">
                                        <span class="flex items-center">
                                            <span class="material-symbols-outlined text-[12px] mr-1">visibility</span>
                                            {{ number_format($popular->view_count) }}
                                        </span>
                                        <span class="flex items-center">
                                            <span
                                                class="w-1.5 h-1.5 rounded-full {{ $popular->status === 'ongoing' ? 'bg-yellow-500' : 'bg-green-500' }} mr-1"></span>
                                            {{ $popular->status === 'ongoing' ? __('messages.program.ongoing') : __('messages.program.completed') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>

            {{-- Main Content Area --}}
            <div class="lg:col-span-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                    @forelse ($materials as $material)
                        @php
                            $materialUrl = $material->slug
                                ? route('lbk.show', ['locale' => app()->getLocale(), 'slug' => $material->slug])
                                : '#';
                        @endphp
                        <article
                            class="bg-white flex flex-col rounded-3xl overflow-hidden shadow-xl shadow-primary/5 hover:-translate-y-2 transition-all duration-500 group border border-gray-100">
                            <a href="{{ $materialUrl }}" class="relative h-56 overflow-hidden block">
                                @if ($material->featured_image)
                                    <img src="{{ asset('storage/' . $material->featured_image) }}"
                                        alt="{{ $material->title }}"
                                        class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-primary/10 to-primary/5 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-6xl text-primary/30">school</span>
                                    </div>
                                @endif

                                {{-- Combined Badge Container (Status + Category) --}}
                                <div class="absolute top-3 left-3 right-3 flex flex-wrap gap-2 pointer-events-none">
                                    {{-- Status Badge --}}
                                    <span
                                        class="{{ $material->status === 'ongoing' ? 'bg-yellow-500' : 'bg-green-500' }} text-white text-[9px] md:text-[10px] font-bold py-1.5 px-3 rounded-lg uppercase tracking-widest shadow-lg flex items-center gap-1.5 whitespace-nowrap">
                                        @if ($material->status === 'ongoing')
                                            <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                                            {{ __('messages.program.ongoing') }}
                                        @else
                                            <span class="material-symbols-outlined text-xs">check_circle</span>
                                            {{ __('messages.program.completed') }}
                                        @endif
                                    </span>

                                    {{-- Category Badge --}}
                                    <span
                                        class="bg-primary text-white text-[9px] md:text-[10px] font-bold py-1.5 px-3 rounded-lg uppercase tracking-widest shadow-lg flex items-center gap-2 whitespace-nowrap">
                                        @if ($material->category && $material->category->icon)
                                            <img src="{{ asset('storage/' . $material->category->icon) }}"
                                                class="w-4 h-4 object-contain brightness-0 invert"
                                                alt="{{ $material->category->name }}">
                                        @else
                                            <span class="material-symbols-outlined text-[14px]">category</span>
                                        @endif
                                        {{ $material->category->name ?? 'Uncategorized' }}
                                    </span>
                                </div>
                            </a>

                            <div class="p-8 flex flex-col flex-grow">
                                <div
                                    class="flex items-center text-xs text-gray-400 mb-4 font-body font-bold uppercase tracking-widest space-x-3">
                                    @if ($material->published_at)
                                        <span>{{ $material->published_at->translatedFormat('d M Y') }}</span>
                                        <span class="w-1 h-1 bg-primary/30 rounded-full"></span>
                                    @endif
                                    <span>{{ number_format($material->view_count) }}
                                        {{ __('messages.program.views') }}</span>
                                </div>
                                <h2
                                    class="font-tegas text-xl font-black text-primary mb-4 leading-tight uppercase group-hover:text-dark transition-colors duration-300">
                                    <a href="{{ $materialUrl }}">{{ $material->title }}</a>
                                </h2>
                                <p
                                    class="text-gray-600 font-body text-sm mb-6 line-clamp-3 leading-relaxed font-light italic">
                                    {{ $material->excerpt }}
                                </p>
                                <a href="{{ $materialUrl }}"
                                    class="mt-auto inline-flex items-center text-primary font-bold font-tegas text-xs uppercase tracking-widest group/link">
                                    <span class="hover-underline">{{ __('messages.program.see_program') }}</span>
                                    <span
                                        class="material-symbols-outlined ml-2 text-[18px] group-hover/link:translate-x-2 transition-transform duration-300">arrow_right_alt</span>
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-2 text-center py-20">
                            <span class="material-symbols-outlined text-6xl text-gray-300">school</span>
                            <p class="text-gray-400 font-tegas uppercase tracking-wider mt-4">
                                {{ __('messages.program.empty') }}
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Centered Pagination --}}
            @if ($materials->hasPages())
                <div class="lg:col-span-4 mt-20 flex justify-center custom-pagination">
                    {{ $materials->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </main>
@endsection
