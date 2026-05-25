@extends('frontend.layouts.app')
@section('title', $artikel->title)

@section('content')
    {{-- UI/UX FIX: Style untuk merapatkan, mengecilkan, memiringkan caption, smooth scroll, & pewarnaan link --}}
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* 1. Mengunci gambar agar tidak bisa di-klik membuka halaman baru */
        .prose figure a,
        .prose img {
            pointer-events: none !important;
            cursor: default !important;
        }

        /* 2. Merapatkan jarak vertikal antara gambar dengan caption-nya */
        .prose figure img {
            margin-bottom: 0.35rem !important;
        }

        /* 3. Mengecilkan font caption, membuatnya miring, dan memberi warna soft slate */
        .prose figcaption {
            margin-top: 0px !important;
            padding-top: 0px !important;
            line-height: 1.5 !important;
            font-size: 0.85em !important;
            font-style: italic !important;
            color: #64748b !important;
        }

        /* 4. Menebalkan dan mewarnai angka referensi [1] di dalam paragraf teks atas */
        .prose a[href^="#ref"] {
            font-weight: 800 !important;
            color: #800000 !important;
            /* Warna maroon utama Kawungpitu */
            font-size: 1.05em !important;
            transition: all 0.30s ease;
        }

        .prose a[href^="#ref"]:hover {
            color: #1a1a1a !important;
            /* Berubah gelap saat di-hover pembaca */
        }

        /* 5. Otomatis membuat semua gambar rata tengah, melengkung estetik, & soft shadow */
        .prose img {
            display: block;
            margin-left: auto !important;
            margin-right: auto !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        /* 6. Memastikan elemen pembungkus (figure) rata tengah agar teks caption ikut di tengah */
        .prose figure {
            margin-left: auto !important;
            margin-right: auto !important;
            text-align: center !important;
        }

        /* Target padding jarak agar saat loncat skrol, teks referensi tidak terhalang navbar header */
        :target {
            scroll-margin-top: 140px;
        }
    </style>

    <article class="bg-cream pt-36 pb-24">
        <div class="max-w-4xl mx-auto px-8 md:px-12">
            {{-- Breadcrumb --}}
            <nav class="mb-8 flex items-center space-x-3 text-[10px] uppercase tracking-normal font-tegas text-gray-400">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
                    class="hover:text-primary transition-colors">{{ __('messages.navbar.home') }}</a>
                <span class="text-gray-300">/</span>
                <a href="{{ route('artikel.index', ['locale' => app()->getLocale()]) }}"
                    class="hover:text-primary transition-colors">{{ __('messages.navbar.article') }}</a>
            </nav>

            {{-- Metadata --}}
            <div class="flex flex-wrap items-center gap-y-4 gap-x-6 mb-6">
                <div class="flex flex-wrap gap-2">
                    @foreach ($artikel->categories as $category)
                        <span
                            class="bg-primary text-white text-[10px] font-tegas font-black px-4 py-2 rounded-lg uppercase tracking-normal shadow-lg">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>

                <div class="flex items-center space-x-4 uppercase tracking-normal">
                    <time class="text-xs text-gray-400 font-bold">
                        {{ $artikel->published_at ? $artikel->published_at->translatedFormat('d F Y') : '-' }}
                    </time>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <span class="flex items-center text-xs text-gray-400 font-bold">
                        <span class="material-symbols-outlined text-[14px] mr-1.5 text-primary/40">person</span>
                        {{ $artikel->author_name ?? 'Tim Kawungpitu Institute' }}
                    </span>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <span class="flex items-center text-xs text-gray-400 font-bold">
                        <span class="material-symbols-outlined text-[14px] mr-1 text-primary/40">visibility</span>
                        <span class="ml-1">{{ number_format($artikel->view_count) }} VIEWS</span>
                    </span>
                </div>
            </div>

            {{-- FIX RESPONSIVE: Judul Detail Artikel diturunkan jadi text-2xl di mobile --}}
            <h1
                class="font-tegas text-2xl sm:text-3xl md:text-5xl font-black text-dark uppercase tracking-normal leading-tight mb-12">
                {{ $artikel->title }}
            </h1>

            {{-- Isi Konten Artikel --}}
            <div
                class="prose prose-lg max-w-none text-justify prose-figcaption:text-center prose-figcaption:italic prose-a:no-underline hover:prose-a:text-primary mb-16">
                {!! $artikel->body !!}
            </div>
        </div>
    </article>

    {{-- Related Articles --}}
    @if ($relatedArticles->isNotEmpty())
        <section class="py-20 bg-white border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-8 md:px-12">
                <h2 class="font-tegas text-3xl font-black text-dark uppercase tracking-tighter mb-12">
                    {{ __('messages.articles.related_title') }}
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @foreach ($relatedArticles as $related)
                        @php
                            $relatedUrl = $related->slug
                                ? route('artikel.show', ['locale' => app()->getLocale(), 'slug' => $related->slug])
                                : '#';
                        @endphp
                        <article class="group flex flex-col h-full">
                            <a href="{{ $relatedUrl }}"
                                class="relative overflow-hidden rounded-none aspect-[4/3] mb-6 block border border-gray-100">
                                @if ($related->featured_image)
                                    <img src="{{ asset('storage/' . $related->featured_image) }}"
                                        alt="{{ $related->title }}"
                                        class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-5xl text-gray-400">article</span>
                                    </div>
                                @endif
                            </a>
                            <time class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-2 block">
                                {{ $related->published_at ? $related->published_at->translatedFormat('d M Y') : '-' }}
                            </time>
                            <h3
                                class="font-tegas text-lg font-black text-dark group-hover:text-primary transition-colors leading-tight uppercase">
                                <a href="{{ $relatedUrl }}">{{ $related->title }}</a>
                            </h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- AUTOMATION JAVASCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Deteksi tautan palsu Filament 'https://refX' dan ubah ke internal anchor '#refX'
            document.querySelectorAll('.prose a').forEach(link => {
                const href = link.getAttribute('href');
                if (href && href.startsWith('https://ref')) {
                    const refId = href.replace('https://', '');
                    link.setAttribute('href', '#' + refId);
                }
            });

            // 2. Otomatis pasang target magnet, tebalkan daftar pustaka, & buat garis pembatas atas kata "Referensi"
            document.querySelectorAll('.prose p, .prose li, .prose h2, .prose h3, .prose h4, .prose h5').forEach(
                el => {
                    const text = el.textContent.trim();

                    // PERBAIKAN MUTAL: mt-4 disamakan dengan pt-4 agar garis berada tepat di tengah-tengah ruang kosong secara simetris
                    if (text === 'Referensi') {
                        el.classList.add('border-t-2', 'border-gray-400', 'pt-4', 'mt-4', 'text-primary',
                            'font-black', 'tracking-wide', 'text-xl');
                    }

                    // Cek jika teks diawali format kurung siku angka seperti [1], [2], [3]
                    const match = text.match(/^\[(\d+)\]/);
                    if (match) {
                        el.id = 'ref' + match[1];
                        // Menyamakan ukuran angka bawah menjadi text-[1.05em] & font-black agar identik dengan teks atas
                        const originalHTML = el.innerHTML;
                        el.innerHTML = originalHTML.replace(/^\[(\d+)\]/,
                            `<strong class="text-primary font-black text-[1.05em] mr-1.5">[${match[1]}]</strong>`
                        );
                    }
                });
        });
    </script>
@endsection
