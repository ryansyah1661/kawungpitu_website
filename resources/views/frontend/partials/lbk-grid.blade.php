<div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 animate-fade-in">
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
                    <img src="{{ asset('storage/' . $material->featured_image) }}" alt="{{ $material->title }}"
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
                    <span>{{ number_format($material->view_count) }} {{ __('messages.program.views') }}</span>
                </div>
                <h2
                    class="font-tegas text-xl font-black text-primary mb-4 leading-tight uppercase group-hover:text-dark transition-colors duration-300">
                    <a href="{{ $materialUrl }}">{{ $material->title }}</a>
                </h2>
                <p class="text-gray-600 font-body text-sm mb-6 line-clamp-3 leading-relaxed font-light italic">
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

    {{-- Pagination AJAX --}}
    @if ($materials->hasPages())
        <div class="lg:col-span-2 mt-20 flex justify-center custom-pagination"
            @click.prevent="if($event.target.tagName === 'A') fetchMaterials($event.target.href, 'paginate', '')">
            {{ $materials->appends(request()->query())->links() }}
        </div>
    @endif
</div>
