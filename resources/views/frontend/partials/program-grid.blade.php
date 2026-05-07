<div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 animate-fade-in">
    @forelse ($materials as $material)
        @php
            $materialUrl = $material->slug
                ? route('program.show', ['locale' => app()->getLocale(), 'slug' => $material->slug])
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

                <div class="absolute top-3 left-3 right-3 flex flex-wrap gap-2 pointer-events-none">
                    <span
                        class="{{ $material->status === 'ongoing' ? 'bg-yellow-500' : 'bg-green-500' }} text-white text-[9px] font-bold py-1.5 px-3 rounded-lg uppercase tracking-widest shadow-lg flex items-center gap-1.5">
                        {{ $material->status === 'ongoing' ? __('messages.program.ongoing') : __('messages.program.completed') }}
                    </span>
                    <span
                        class="bg-primary text-white text-[9px] font-bold py-1.5 px-3 rounded-lg uppercase tracking-widest shadow-lg flex items-center gap-2">
                        {{ $material->category->name ?? 'Program' }}
                    </span>
                </div>
            </a>

            <div class="p-8 flex flex-col flex-grow">
                <h2
                    class="font-tegas text-xl font-black text-primary mb-4 uppercase group-hover:text-dark transition-colors">
                    <a href="{{ $materialUrl }}">{{ $material->title }}</a>
                </h2>

                <p class="text-gray-600 font-body text-sm mb-6 line-clamp-2 italic opacity-80">
                    {{ $material->excerpt }}
                </p>

                {{-- MINI PENTAGON STATS --}}
                <div
                    class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between text-[8px] font-tegas font-bold uppercase tracking-wider text-gray-400">
                    <div class="flex flex-col items-center gap-1">
                        <span class="text-primary">{{ $material->human_capital }}%</span>
                        <span>Manusia</span>
                    </div>
                    <div class="w-px h-6 bg-gray-100"></div>
                    <div class="flex flex-col items-center gap-1">
                        <span class="text-primary">{{ $material->social_capital }}%</span>
                        <span>Sosial</span>
                    </div>
                    <div class="w-px h-6 bg-gray-100"></div>
                    <div class="flex flex-col items-center gap-1">
                        <span class="text-primary">{{ $material->natural_capital }}%</span>
                        <span>Alam</span>
                    </div>
                    <div class="w-px h-6 bg-gray-100"></div>
                    <div class="flex flex-col items-center gap-1">
                        <span class="text-primary">{{ $material->physical_capital }}%</span>
                        <span>Fisik</span>
                    </div>
                    <div class="w-px h-6 bg-gray-100"></div>
                    <div class="flex flex-col items-center gap-1">
                        <span class="text-primary">{{ $material->financial_capital }}%</span>
                        <span>Finansial</span>
                    </div>
                </div>

                <a href="{{ $materialUrl }}"
                    class="mt-6 inline-flex items-center text-primary font-bold font-tegas text-[10px] uppercase tracking-widest group/link">
                    <span>{{ __('messages.program.see_program') }}</span>
                    <span
                        class="material-symbols-outlined ml-2 text-[18px] group-hover/link:translate-x-2 transition-transform">arrow_right_alt</span>
                </a>
            </div>
        </article>
    @empty
        {{-- Empty state --}}
    @endforelse
</div>
