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

            <h1 class="font-tegas text-4xl md:text-5xl font-black text-dark uppercase tracking-tighter mb-4">
                {{ $album->title }}
            </h1>
            @if ($album->description)
                <p class="text-lg text-primary/70 italic max-w-2xl">{{ $album->description }}</p>
            @endif
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-8 md:px-12 pb-24">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($album->photos as $photo)
                <div class="group relative aspect-square rounded-2xl overflow-hidden shadow-lg cursor-pointer"
                    onclick="openLightbox('{{ asset('storage/' . $photo->image_path) }}', '{{ $photo->caption }}')">
                    <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->caption }}"
                        class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-dark/0 group-hover:bg-dark/40 transition-all duration-300 flex items-end">
                        @if ($photo->caption)
                            <div class="p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                <p class="text-white text-sm font-body">{{ $photo->caption }}</p>
                            </div>
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
        <div class="max-w-5xl max-h-[90vh] px-8" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" alt=""
                class="max-w-full max-h-[80vh] object-contain mx-auto rounded-lg shadow-2xl">
            <p id="lightbox-caption" class="text-white/80 text-center mt-4 font-body italic"></p>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function openLightbox(src, caption) {
            const lb = document.getElementById('lightbox');
            document.getElementById('lightbox-img').src = src;
            document.getElementById('lightbox-caption').textContent = caption || '';
            lb.classList.remove('hidden');
            lb.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lb = document.getElementById('lightbox');
            lb.classList.add('hidden');
            lb.classList.remove('flex');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeLightbox();
        });
    </script>
@endpush
