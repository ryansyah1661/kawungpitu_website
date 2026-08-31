@extends('frontend.layouts.app')
@section('title', $artikel->title)
@section('og_title', $artikel->title)
@section('og_description', $artikel->excerpt ?? Str::limit(strip_tags($artikel->body), 150))
@section('og_image', $artikel->featured_image ? asset('storage/' . $artikel->featured_image) : asset('images/logo-kawung-ori.png'))


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
        <div class="max-w-7xl mx-auto px-8 md:px-12 grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            {{-- KIRI: KONTEN UTAMA --}}
            <div class="lg:col-span-2">
                {{-- Breadcrumb --}}
                <nav class="mb-8 flex items-center space-x-3 text-[10px] uppercase tracking-normal font-tegas text-gray-400">
                    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
                        class="hover:text-primary transition-colors">{{ __('messages.navbar.home') }}</a>
                    <span class="text-gray-300">/</span>
                    <a href="{{ route('artikel.index', ['locale' => app()->getLocale()]) }}"
                        class="hover:text-primary transition-colors">{{ __('messages.navbar.article') }}</a>
                </nav>

                {{-- Kategori --}}
                <div class="flex flex-wrap gap-2 mb-8">
                    @foreach ($artikel->categories as $category)
                        <span class="bg-primary text-white text-[10px] font-tegas font-black px-4 py-2 rounded-lg uppercase tracking-normal shadow-lg">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>

                {{-- FIX RESPONSIVE: Judul Detail Artikel diturunkan jadi text-2xl di mobile --}}
                <h1 class="font-tegas text-2xl sm:text-3xl md:text-5xl font-black text-dark uppercase tracking-normal leading-tight mb-12">
                    {{ $artikel->title }}
                </h1>

                {{-- Isi Konten Artikel --}}
                <div class="prose prose-lg max-w-none text-justify prose-figcaption:text-center prose-figcaption:italic prose-a:no-underline hover:prose-a:text-primary mb-16">
                    {!! $artikel->body !!}
                </div>
            </div>

            {{-- KANAN: SIDEBAR --}}
            <aside class="lg:col-span-1">
                <div class="bg-white p-6 lg:p-8 rounded-3xl shadow-xl shadow-primary/5 border border-gray-100 flex flex-col gap-8">
                    
                    {{-- Author Box --}}
                    <div>
                        <h3 class="font-tegas text-sm font-black text-dark uppercase tracking-widest mb-5 border-b border-gray-100 pb-3">
                            Penulis Artikel
                        </h3>
                        <div class="flex items-center gap-4 mb-5">
                            @if ($artikel->user && $artikel->user->profile_photo)
                                <img src="{{ asset('storage/' . $artikel->user->profile_photo) }}" alt="{{ $artikel->author_name }}" class="w-12 h-12 rounded-full object-cover shadow-sm">
                            @else
                                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center shadow-sm">
                                    <span class="material-symbols-outlined text-2xl">person</span>
                                </div>
                            @endif
                            <div>
                                <h4 class="font-tegas text-base font-black text-dark uppercase leading-tight">{{ $artikel->author_name ?? 'Tim Kawungpitu' }}</h4>
                            </div>
                        </div>
                        
                        <div class="space-y-3 text-[10px] text-gray-500 font-bold uppercase tracking-wider">
                            <div class="flex items-center justify-between">
                                <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[14px] text-primary/60">calendar_today</span> Dipublikasikan</span>
                                <span class="text-dark">{{ $artikel->published_at ? $artikel->published_at->translatedFormat('d M Y') : '-' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[14px] text-primary/60">visibility</span> Total Tayangan</span>
                                <span class="text-dark">{{ number_format($artikel->view_count) }} Kali</span>
                            </div>
                        </div>
                    </div>

                    {{-- Related Articles --}}
                    @if ($relatedArticles->isNotEmpty())
                        <div>
                            <h3 class="font-tegas text-sm font-black text-dark uppercase tracking-widest mb-5 border-b border-gray-100 pb-3">
                                {{ __('messages.articles.related_title') }}
                            </h3>
                            <div class="space-y-5">
                                @foreach ($relatedArticles as $related)
                                    @php
                                        $relatedUrl = $related->slug ? route('artikel.show', ['locale' => app()->getLocale(), 'slug' => $related->slug]) : '#';
                                    @endphp
                                    <article class="group flex gap-3">
                                        <a href="{{ $relatedUrl }}" class="shrink-0 w-20 h-16 rounded-xl overflow-hidden shadow-sm">
                                            @if ($related->featured_image)
                                                <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                                            @else
                                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                    <span class="material-symbols-outlined text-gray-400">article</span>
                                                </div>
                                            @endif
                                        </a>
                                        <div class="flex flex-col justify-center">
                                            <h4 class="font-tegas text-xs font-black text-dark group-hover:text-primary transition-colors leading-tight uppercase line-clamp-2 mb-1.5">
                                                <a href="{{ $relatedUrl }}">{{ $related->title }}</a>
                                            </h4>
                                            <time class="text-[9px] text-gray-400 font-bold uppercase tracking-widest block">
                                                {{ $related->published_at ? $related->published_at->translatedFormat('d M Y') : '-' }}
                                            </time>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </article>

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
