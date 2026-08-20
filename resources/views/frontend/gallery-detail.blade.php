@extends('frontend.layouts.app')
@section('title', $album->title)

@section('content')
    <header class="bg-cream pt-36 pb-16 px-8 md:px-12">
        <div class="max-w-7xl mx-auto">
            {{-- Breadcrumb --}}
            <nav class="mb-8 flex items-center space-x-3 text-[10px] uppercase tracking-normal font-tegas text-gray-400">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="hover:text-primary transition-colors">
                    {{ __('messages.navbar.home') }}
                </a>
                <span class="text-gray-300">/</span>
                <a href="{{ route('galeri.index', ['locale' => app()->getLocale()]) }}"
                    class="hover:text-primary transition-colors">
                    {{ __('messages.navbar.gallery') }}
                </a>
            </nav>

            {{-- FIX RESPONSIVE: Judul Detail Album Foto diturunkan jadi text-2xl di mobile --}}
            <h1 class="font-tegas text-2xl sm:text-3xl md:text-5xl font-black text-dark uppercase tracking-tighter mb-4">
                {{ $album->title }}
            </h1>
            @if ($album->description)
                <p class="text-lg text-primary/70 italic max-w-2xl">{{ $album->description }}</p>
            @endif
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-8 md:px-12 pb-24">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($album->photos as $index => $photo)
                <div class="group relative aspect-square rounded-2xl overflow-hidden shadow-lg cursor-pointer"
                    onclick="openLightbox({{ $index }})">
                    <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->caption }}"
                        class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-dark/0 group-hover:bg-dark/40 transition-all duration-300 flex flex-col justify-between">
                        
                        <div class="flex justify-end p-4">
                            <div class="bg-black/50 text-white text-xs px-2 py-1 rounded-full flex items-center gap-1 backdrop-blur-sm">
                                <span class="material-symbols-outlined text-[14px]">visibility</span>
                                <span id="thumb-views-{{ $photo->id }}">{{ $photo->views ?? 0 }}</span>
                            </div>
                        </div>

                        @if ($photo->caption)
                            <div class="p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                <p class="text-white text-sm font-body">{{ $photo->caption }}</p>
                            </div>
                        @else
                            <div class="p-4"></div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if ($album->photos->isEmpty())
            <div class="text-center py-20">
                <span class="material-symbols-outlined text-6xl text-gray-300">photo_camera</span>
                <p class="text-gray-400 font-tegas uppercase tracking-wider mt-4">
                    {{ __('messages.gallery.empty_photos') }}
                </p>
            </div>
        @endif
    </main>

    {{-- Lightbox --}}
    <div id="lightbox" class="fixed inset-0 z-50 bg-dark/95 hidden items-center justify-center" onclick="closeLightbox()">
        <button class="absolute top-6 right-6 text-white/80 hover:text-white" onclick="closeLightbox()">
            <span class="material-symbols-outlined text-4xl">close</span>
        </button>

        <button class="absolute left-4 md:left-10 text-white/50 hover:text-white transition-colors" onclick="prevPhoto(event)">
            <span class="material-symbols-outlined text-5xl">chevron_left</span>
        </button>

        <div class="max-w-5xl max-h-[90vh] px-8 flex flex-col items-center" onclick="event.stopPropagation()">
            <div class="relative inline-block">
                <img id="lightbox-img" src="" alt=""
                    class="max-w-full max-h-[80vh] object-contain mx-auto rounded-lg shadow-2xl">
                <div class="absolute top-4 right-4 bg-black/60 text-white text-sm px-3 py-1.5 rounded-full flex items-center gap-1 backdrop-blur-sm">
                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                    <span id="lightbox-views">0</span>
                </div>
            </div>
            <p id="lightbox-caption" class="text-white/80 text-center mt-4 font-body italic"></p>
        </div>

        <button class="absolute right-4 md:right-10 text-white/50 hover:text-white transition-colors" onclick="nextPhoto(event)">
            <span class="material-symbols-outlined text-5xl">chevron_right</span>
        </button>
    </div>
@endsection

@push('scripts')
@php
    $mappedPhotos = $album->photos->map(function($photo) {
        return [
            'id' => $photo->id,
            'src' => asset('storage/' . $photo->image_path),
            'caption' => $photo->caption,
            'views' => $photo->views ?? 0
        ];
    });
@endphp
    <script>
        const photos = @json($mappedPhotos);

        let currentIndex = 0;
        const locale = '{{ app()->getLocale() }}';

        function openLightbox(index) {
            currentIndex = index;
            updateLightboxContent();

            const lb = document.getElementById('lightbox');
            lb.classList.remove('hidden');
            lb.classList.add('flex');
            document.body.style.overflow = 'hidden';

            incrementView(photos[currentIndex].id);
        }

        function updateLightboxContent() {
            if (photos.length === 0) return;
            const photo = photos[currentIndex];
            document.getElementById('lightbox-img').src = photo.src;
            document.getElementById('lightbox-caption').textContent = photo.caption || '';
            document.getElementById('lightbox-views').textContent = photo.views;
        }

        function closeLightbox() {
            const lb = document.getElementById('lightbox');
            lb.classList.add('hidden');
            lb.classList.remove('flex');
            document.body.style.overflow = '';
        }

        function nextPhoto(e) {
            if(e) e.stopPropagation();
            if (photos.length === 0) return;
            if (currentIndex < photos.length - 1) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateLightboxContent();
            incrementView(photos[currentIndex].id);
        }

        function prevPhoto(e) {
            if(e) e.stopPropagation();
            if (photos.length === 0) return;
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = photos.length - 1;
            }
            updateLightboxContent();
            incrementView(photos[currentIndex].id);
        }

        async function incrementView(id) {
            try {
                const response = await fetch(`/${locale}/gallery/photo/${id}/view`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                const data = await response.json();
                if (data.success) {
                    photos[currentIndex].views = data.views;
                    document.getElementById('lightbox-views').textContent = data.views;
                    document.getElementById(`thumb-views-${id}`).textContent = data.views;
                }
            } catch (error) {
                console.error('Error incrementing view:', error);
            }
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight' && !document.getElementById('lightbox').classList.contains('hidden')) nextPhoto();
            if (e.key === 'ArrowLeft' && !document.getElementById('lightbox').classList.contains('hidden')) prevPhoto();
        });
    </script>
@endpush
