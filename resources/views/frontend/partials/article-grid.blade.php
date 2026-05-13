<div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 animate-fade-in">
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

                {{-- Container Badge Kategori --}}
                <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                    @foreach ($article->categories as $category)
                        <span
                            class="bg-primary text-white text-[10px] font-bold py-1.5 px-3 rounded-lg uppercase tracking-normal shadow-lg">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>
            </a>

            <div class="p-8 flex flex-grow flex-col">
                {{-- PERBAIKAN: Metadata (Tanggal, Penulis, Views) - Sama dengan Program --}}
                <div class="flex items-center space-x-3 text-[10px] text-gray-400 font-bold uppercase tracking-normal mb-4">
                    <time>{{ $article->published_at->translatedFormat('d F Y') }}</time>
                    <span class="w-1 h-1 bg-primary/30 rounded-full"></span>
                    <span class="flex items-center">
                        <span class="material-symbols-outlined text-[14px] mr-1.5 text-primary/30">person</span>
                        {{ $article->author_name ?? 'ADMIN' }}
                    </span>
                    <span class="w-1 h-1 bg-primary/30 rounded-full"></span>
                    <span class="flex items-center">
                        <span class="material-symbols-outlined text-[14px] mr-1 text-primary/30">visibility</span>
                        <span class="ml-1">{{ number_format($article->view_count) }}</span>
                    </span>
                </div>

                {{-- Judul: Uppercase & Tracking Normal --}}
                <h2
                    class="font-tegas text-xl font-black text-primary mb-4 leading-tight uppercase tracking-normal group-hover:text-dark transition-colors">
                    <a href="{{ $articleUrl }}">{{ $article->title }}</a>
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
        <div class="col-span-full text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
            <span class="material-symbols-outlined text-5xl text-gray-300">search_off</span>
            <p class="text-gray-400 font-tegas uppercase tracking-widest mt-4">{{ __('messages.articles.empty') }}</p>
        </div>
    @endforelse

    {{-- Pagination AJAX --}}
    @if ($articles->hasPages())
        <div class="lg:col-span-2 mt-20 flex justify-center custom-pagination"
            @click.prevent="if($event.target.tagName === 'A') fetchArticles($event.target.href, activeId)">
            {{ $articles->appends(request()->query())->links() }}
        </div>
    @endif
</div>