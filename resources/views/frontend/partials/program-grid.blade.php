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
                    <div class="w-full h-full bg-gradient-to-br from-primary/10 to-primary/5 flex items-center justify-center">
                        <span class="material-symbols-outlined text-6xl text-primary/30">school</span>
                    </div>
                @endif

                {{-- Container Badge (Status & Kategori) --}}
                <div class="absolute top-3 left-3 right-3 flex flex-wrap gap-2 pointer-events-none">
                    {{-- Status Badge --}}
                    <span
                        class="{{ $material->status === 'ongoing' ? 'bg-yellow-500' : 'bg-green-500' }} text-white text-[9px] font-bold py-1.5 px-3 rounded-lg uppercase tracking-normal shadow-lg flex items-center gap-1.5">
                        @if ($material->status === 'ongoing')
                            <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                        @else
                            <span class="material-symbols-outlined text-xs">check_circle</span>
                        @endif
                        {{ $material->status === 'ongoing' ? __('messages.program.ongoing') : __('messages.program.completed') }}
                    </span>

                    {{-- Loop Banyak Kategori --}}
                    @foreach ($material->categories as $category)
                        <span
                            class="bg-primary text-white text-[9px] font-bold py-1.5 px-3 rounded-lg uppercase tracking-normal shadow-lg flex items-center gap-2 whitespace-nowrap">
                            @if ($category->icon)
                                <img src="{{ asset('storage/' . $category->icon) }}"
                                    class="w-3.5 h-3.5 object-contain brightness-0 invert" alt="{{ $category->name }}">
                            @else
                                <span class="material-symbols-outlined text-[14px]">category</span>
                            @endif
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>
            </a>

            <div class="p-8 flex flex-col flex-grow">
                {{-- TAMBAHAN: Metadata (Tanggal, Penulis, Views) --}}
                <div class="flex items-center space-x-3 text-[10px] text-gray-400 font-bold uppercase tracking-normal mb-3">
                    <time>{{ $material->published_at ? $material->published_at->translatedFormat('d F Y') : '-' }}</time>
                    <span class="w-1 h-1 bg-gray-200 rounded-full"></span>
                    <span class="flex items-center">
                        <span class="material-symbols-outlined text-[14px] mr-1.5 text-primary/30">person</span>
                        ADMIN
                    </span>
                    <span class="w-1 h-1 bg-gray-200 rounded-full"></span>
                    <span class="flex items-center">
                        <span class="material-symbols-outlined text-[14px] mr-1 text-primary/30">visibility</span>
                        <span class="ml-1">{{ number_format($material->view_count) }}</span>
                    </span>
                </div>

                <h2
                    class="font-tegas text-xl font-black text-primary mb-4 uppercase tracking-normal group-hover:text-dark transition-colors leading-tight">
                    <a href="{{ $materialUrl }}">{{ $material->title }}</a>
                </h2>

                <p class="text-gray-600 font-body text-sm mb-6 line-clamp-2 italic opacity-80">
                    {{ $material->excerpt }}
                </p>

                {{-- MINI PENTAGON STATS --}}
                <div
                    class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between text-[8px] font-tegas font-bold uppercase tracking-normal text-gray-400">
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
        <div class="col-span-full text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
            <span class="material-symbols-outlined text-5xl text-gray-300">search_off</span>
            <p class="text-gray-400 font-tegas uppercase tracking-widest mt-4">Belum ada program yang ditemukan</p>
        </div>
    @endforelse
</div>