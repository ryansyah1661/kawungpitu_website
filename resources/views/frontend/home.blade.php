@extends('frontend.layouts.app')
@section('title', 'Beranda')

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
                    {!! __('messages.hero.description') !!}
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
    <section class="py-24 bg-white font-sans">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

                {{-- Sisi Kiri --}}
                <div class="lg:col-span-7 space-y-8">
                    <h2
                        class="font-montserrat font-black text-[2rem] md:text-[2.6rem] leading-[1.15] uppercase tracking-tighter">
                        <span class="block text-[#1a1a1a] whitespace-nowrap">
                            {{ __('messages.commitment.title_1') }}
                        </span>
                        <span class="block text-primary whitespace-nowrap">
                            {{ __('messages.commitment.title_2') }}
                        </span>
                        <span class="block text-[#1a1a1a]">
                            {{ __('messages.commitment.title_3') }}
                        </span>
                    </h2>

                    <div class="space-y-5 max-w-2xl">
                        <p class="text-gray-700 text-lg leading-relaxed">
                            {!! __('messages.commitment.description_1') !!}
                        </p>
                        <p class="text-gray-700 text-lg leading-relaxed">
                            {!! __('messages.commitment.description_2') !!}
                        </p>
                    </div>

                    <div class="pt-4">
                        <a href="{{ route('tentang', ['locale' => app()->getLocale()]) }}"
                            class="inline-flex items-center text-primary font-tegas font-bold text-xs uppercase tracking-widest group/link">

                            {{-- Teks dengan efek garis bawah kustom --}}
                            <span class="hover-underline">{{ __('messages.commitment.learn_more') }}</span>

                            {{-- Ikon panah yang bergeser halus saat di-hover --}}
                            <span
                                class="material-symbols-outlined ml-1 text-[18px] group-hover/link:translate-x-1 transition-transform duration-300">
                                chevron_right
                            </span>
                        </a>
                    </div>
                </div>

                {{-- Sisi Kanan: Quote Card --}}
                <div
                    class="lg:col-span-5 bg-[#FFF5F3] rounded-[3rem] p-10 md:p-14 relative shadow-sm flex flex-col justify-center">

                    <blockquote class="text-xl md:text-2xl font-montserrat italic font-bold text-primary leading-snug mb-8">
                        "{!! __('messages.commitment.quote') !!}"
                    </blockquote>

                    <footer
                        class="font-montserrat font-black text-xs uppercase tracking-[0.2em] text-primary/70 flex items-center">
                        <div class="w-8 h-px bg-primary/30 mr-3"></div>
                        Prinsip Kawungpitu
                    </footer>
                </div>

            </div>
        </div>
    </section>

    {{-- SECTION PILAR KERJA --}}
    <section class="pt-12 pb-24 bg-primary border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6 md:px-12">

            {{-- Header Section --}}
            <div class="text-center mb-12"> {{-- Jarak total header ke grid --}}

                {{-- Judul: Margin bawah 4 --}}
                <h2 class="font-tegas text-4xl md:text-5xl font-black text-white uppercase tracking-tighter mb-2">
                    {{ __('messages.strategy.title') }}
                </h2>

                {{-- Deskripsi: Kita beri mb-12 agar jarak ke card di bawahnya tegas dan rapi --}}
                <div class="max-w-3xl mx-auto mb-12">
                    <p
                        class="text-lg md:text-xl font-light leading-relaxed text-justify text-white/90 hyphens-auto tracking-tight">
                        {!! __('messages.strategy.subtitle') !!}
                    </p>
                </div>
            </div>

            {{-- Grid Pilar Kerja --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
                @php
                    $strategi = [
                        [
                            'icon' => 'hub',
                            'title' => __('messages.strategy.items.organizing.title'),
                            'desc' => __('messages.strategy.items.organizing.desc'),
                            'back_icon' => 'groups',
                            'back_desc' => '<strong class="font-black text-primary">Aksi Kami:</strong> pelatihan keterampilan teknis, literasi kesehatan, serta peningkatan kapasitas kepemimpinan bagi pemuda dan perempuan desa menggunakan pendekatan pendidikan kritis.<br><br><strong class="font-black text-primary">Tujuan:</strong> memastikan setiap individu memiliki pengetahuan dan kemampuan untuk berinovasi.'
                        ],
                        [
                            'icon' => 'handshake',
                            'title' => __('messages.strategy.items.development.title'),
                            'desc' => __('messages.strategy.items.development.desc'),
                            'back_icon' => 'volunteer_activism',
                            'back_desc' => '<strong class="font-black text-primary">Aksi Kami:</strong> pendampingan pembentukan lembaga ekonomi di desa, penguatan lembaga adat/desa, serta fasilitasi kolaborasi antar-komunitas dan kemitraan dengan pihak eksternal..<br><br><strong class="font-black text-primary">Tujuan:</strong> meningkatkan solidaritas dan posisi tawar komunitas dalam pengambilan keputusan.'
                        ],
                        [
                            'icon' => 'school',
                            'title' => __('messages.strategy.items.capacity.title'),
                            'desc' => __('messages.strategy.items.capacity.desc'),
                            'back_icon' => 'psychology',
                            'back_desc' => '<strong class="font-black text-primary">Aksi Kami:</strong> konservasi wilayah pesisir, pengelolaan hutan desa, serta praktik pertanian berkelanjutan yang menjaga kesuburan tanah dan sumber air.<br><br><strong class="font-black text-primary">Tujuan:</strong> menjamin ketersediaan dan akses sumber daya alam produktif lintas generasi.'
                        ],
                        [
                            'icon' => 'analytics',
                            'title' => __('messages.strategy.items.research.title'),
                            'desc' => __('messages.strategy.items.research.desc'),
                            'back_icon' => 'find_in_page',
                            'back_desc' => '<strong class="font-black text-primary">Aksi Kami:</strong> inisiasi sistem pengolahan sampah mandiri, akses air bersih, serta penyediaan alat produksi pertanian atau perikanan yang tepat guna.<br><br><strong class="font-black text-primary">Tujuan:</strong> mempermudah akses komunitas terhadap alat produk.'
                        ],
                        [
                            'icon' => 'campaign',
                            'title' => __('messages.strategy.items.advocacy.title'),
                            'desc' => __('messages.strategy.items.advocacy.desc'),
                            'back_icon' => 'record_voice_over',
                            'back_desc' => '<strong class="font-black text-primary">Aksi Kami:</strong> pengembangan unit usaha di desa, akses ke lembaga keuangan mikro, serta diversifikasi sumber pendapatan untuk mengurangi kerentanan ekonomi.<br><br><strong class="font-black text-primary">Tujuan:</strong> membangun kemandirian ekonomi untuk menunjang ketangguhan komunitas menghadapi guncangan pasar.'
                        ],
                        [
                            'icon' => 'architecture',
                            'title' => __('messages.strategy.items.modelling.title'),
                            'desc' => __('messages.strategy.items.modelling.desc'),
                            'bg_custom' => '#d5a132',
                            'back_icon' => 'layers',
                            'back_desc' => 'Selain memperkuat 5 aset di atas, Kawungpitu bekerja pada level kebijakan dan struktur untuk mengurangi dampak Vulnerability Context (Konteks Kerentanan) seperti perubahan iklim, bencana alam, dan fluktuasi ekonomi global.'
                        ],
                    ];
                @endphp

                @foreach ($strategi as $s)
                    {{-- Container Utama dengan Perspektif 3D --}}
                    <div class="group h-[360px] [perspective:1000px]">
                        {{-- Wrapper Kartu yang Berputar --}}
                        <div
                            class="relative h-full w-full transition-all duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">

                            {{-- SISI DEPAN --}}
                            <div
                                class="absolute inset-0 bg-[#F2E7DF] p-10 rounded-3xl shadow-xl flex flex-col items-center border border-primary/5 [backface-visibility:hidden]">
                                {{-- Icon Depan --}}
                                <div
                                    class="w-20 h-20 bg-primary/10 rounded-2xl flex items-center justify-center mb-8 text-primary border border-primary/10">
                                    <span class="material-symbols-outlined text-4xl">{{ $s['icon'] }}</span>
                                </div>

                                <h3
                                    class="font-tegas text-xl font-black text-primary uppercase mb-1 tracking-tighter leading-tight text-center">
                                    {!! $s['title'] !!}
                                </h3> {{-- Description: Sekarang Rata Kiri (text-left) dan Full Width --}}
                                <p class="text-primary text-justify px-4 leading-relaxed opacity-90 text-sm text-left w-full">
                                    {!! $s['desc'] !!}
                                </p>
                            </div>

                            {{-- SISI BELAKANG --}}
                            <div
                                class="absolute inset-0 h-full w-full rounded-3xl bg-[#d5a132] p-10 text-primary [transform:rotateY(180deg)] [backface-visibility:hidden] flex flex-col items-center justify-center border border-white/10 shadow-2xl">


                                {{-- Deskripsi Belakang --}}
                                {{-- Tanda kutip dihapus, pakai {!! !!}, dan ganti ke text-left --}}
                                <p
                                    class="text-primary/90 font-light leading-relaxed text-justify text-sm text-left w-full px-2">
                                    {!! $s['back_desc'] !!}
                                </p>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- SECTION STRATEGI INTEGRATIF (Layout Pilar Kerja + Background Awal) --}}
    <section class="py-24 bg-[#FDF2EA] relative overflow-hidden">
        {{-- Dot Pattern: Kembali ke warna maroon transparan --}}
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(#800000 1px, transparent 1px); background-size: 20px 20px;"></div>

        <div class="container mx-auto px-6 md:px-12 relative z-10">
            {{-- Header Section: Ukuran Font mengikuti Pilar Kerja, Warna mengikuti Background Terang --}}
            <div class="text-center mb-16">
                <h2 class="font-tegas text-5xl md:text-6xl font-black text-primary uppercase tracking-tighter mb-6">
                    Strategi Integratif
                </h2>
                <div class="max-w-3xl mx-auto space-y-2">
                    <p
                        class="text-lg md:text-xl font-light leading-relaxed text-primary/80 tracking-tight text-center md:text-justify hyphens-auto">
                        Pada kerangka DFID, lima pilar yang terdiri dari Manusia, Sosial, Alam, Fisik, dan Finansial saling
                        terhubung dalam Pentagonal Aset. Intervensi yang tepat dapat meningkatkan bukan hanya satu pilar,
                        namun dua hingga tiga pilar sekaligus.
                    </p>
                    <p
                        class="text-lg md:text-xl font-light leading-relaxed text-primary/80 tracking-tight text-center md:text-justify hyphens-auto">
                        Berikut adalah empat strategi integratif yang dapat mendorong peningkatan lima pilar tersebut secara
                        bersamaan, sehingga program Kawungpitu Institute menjadi lebih efisien dan berdampak luas:
                    </p>
                </div>
            </div>

            @php
                $integratif = [
                    [
                        'title' => 'Social-Enterprise Hub',
                        'icon' => 'trending_up',
                        'desc' => 'Membangun ekosistem bisnis berbasis komunitas yang menghubungkan produsen lokal ke pasar global.',
                        'values' => [80, 75, 40, 50, 90]
                    ],
                    [
                        'title' => 'Community Research',
                        'icon' => 'search',
                        'desc' => 'Pendataan partisipatif untuk memetakan aset, kerentanan, dan peluang di tingkat akar rumput.',
                        'values' => [90, 60, 85, 30, 45]
                    ],
                    [
                        'title' => 'Climate Resilience',
                        'icon' => 'filter_drama',
                        'desc' => 'Integrasi adaptasi perubahan iklim ke dalam pengelolaan lahan dan infrastruktur desa.',
                        'values' => [50, 55, 95, 80, 40]
                    ],
                    [
                        'title' => 'Policy Advocacy',
                        'icon' => 'gavel',
                        'desc' => 'Mendorong kebijakan publik yang inklusif untuk memperkuat posisi tawar komunitas desa.',
                        'values' => [85, 90, 30, 40, 60]
                    ],
                ];

                if (!function_exists('getPointsStatic')) {
                    function getPointsStatic($values)
                    {
                        $points = [];
                        $center = 50;
                        $scale = 0.4;
                        for ($i = 0; $i < 5; $i++) {
                            $angle = deg2rad($i * 72 - 90);
                            $r = $values[$i] * $scale;
                            $x = $center + $r * cos($angle);
                            $y = $center + $r * sin($angle);
                            $points[] = "$x,$y";
                        }
                        return implode(' ', $points);
                    }
                }
            @endphp

            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10">
                @foreach ($integratif as $item)
                    {{-- Card: Putih Bersih agar "Pop Out" di atas background krem --}}
                    <div
                        class="integrative-card bg-white p-10 rounded-[40px] shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full group border border-primary/5">

                        <div class="flex justify-between items-start mb-8">
                            <div
                                class="w-16 h-16 bg-[#FDF2EA] rounded-2xl flex items-center justify-center text-primary/40 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                                <span class="material-symbols-outlined text-3xl">{{ $item['icon'] }}</span>
                            </div>

                            {{-- Radar Chart SVG --}}
                            <div class="w-32 h-32 relative">
                                <svg viewBox="0 0 100 100" class="w-full h-full overflow-visible">
                                    <polygon points="{{ getPointsStatic([50, 50, 50, 50, 50]) }}" fill="none" stroke="#800000"
                                        stroke-width="0.5" stroke-dasharray="2" opacity="0.2" />
                                    <polygon points="{{ getPointsStatic([100, 100, 100, 100, 100]) }}" fill="none"
                                        stroke="#800000" stroke-width="0.5" opacity="0.1" />

                                    @for($i = 0; $i < 5; $i++)
                                        @php $angle = deg2rad($i * 72 - 90); @endphp
                                        <line x1="50" y1="50" x2="{{ 50 + 40 * cos($angle) }}" y2="{{ 50 + 40 * sin($angle) }}"
                                            stroke="#800000" stroke-width="0.2" opacity="0.2" />
                                    @endfor

                                    <polygon points="50,50 50,50 50,50 50,50 50,50"
                                        data-values="{{ json_encode($item['values']) }}"
                                        class="radar-polygon fill-primary/30 stroke-primary stroke-[1.5]" />

                                    <text x="50" y="5" text-anchor="middle" font-size="8"
                                        class="fill-primary font-bold">H</text>
                                    <text x="95" y="40" text-anchor="middle" font-size="8"
                                        class="fill-primary font-bold">S</text>
                                    <text x="80" y="95" text-anchor="middle" font-size="8"
                                        class="fill-primary font-bold">N</text>
                                    <text x="20" y="95" text-anchor="middle" font-size="8"
                                        class="fill-primary font-bold">P</text>
                                    <text x="5" y="40" text-anchor="middle" font-size="8"
                                        class="fill-primary font-bold">F</text>
                                </svg>
                            </div>
                        </div>

                        <div class="mt-auto">
                            <h3
                                class="font-tegas text-2xl md:text-3xl font-black text-primary uppercase mb-4 tracking-tight leading-none">
                                {{ $item['title'] }}
                            </h3>
                            <p class="text-primary/60 leading-relaxed text-sm md:text-base font-medium">
                                {{ $item['desc'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Script Animasi (Tetap Sama) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const center = 50;
            const scaleFactor = 0.4;
            const duration = 2000;

            function calculateAnimatedPoints(targetValues, progress) {
                return targetValues.map((val, i) => {
                    const angle = (i * 72 - 90) * (Math.PI / 180);
                    const currentR = (val * scaleFactor) * progress;
                    const x = center + currentR * Math.cos(angle);
                    const y = center + currentR * Math.sin(angle);
                    return `${x.toFixed(2)},${y.toFixed(2)}`;
                }).join(' ');
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const polygon = entry.target.querySelector('.radar-polygon');
                        if (polygon.dataset.animated === "true") return;

                        const values = JSON.parse(polygon.getAttribute('data-values'));
                        let startTimestamp = null;
                        const animate = (timestamp) => {
                            if (!startTimestamp) startTimestamp = timestamp;
                            const elapsed = timestamp - startTimestamp;
                            const progress = Math.min(elapsed / duration, 1);
                            const easedProgress = 1 - Math.pow(1 - progress, 4);
                            polygon.setAttribute('points', calculateAnimatedPoints(values, easedProgress));
                            if (progress < 1) requestAnimationFrame(animate);
                            else polygon.dataset.animated = "true";
                        };
                        requestAnimationFrame(animate);
                    }
                });
            }, { threshold: 0.2 });

            document.querySelectorAll('.integrative-card').forEach(card => observer.observe(card));
        });
    </script>

    <style>
        @keyframes pulse-slow {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.7;
            }

            50% {
                transform: scale(1.05);
                opacity: 1;
            }
        }

        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
        }
    </style>

    {{-- SECTION ARTICLES --}}
    <section class="py-24 md:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 md:px-12">

            {{-- 1. Header Section: Judul Tengah --}}
            <div class="text-center mb-16">
                <h2 class="font-tegas text-4xl md:text-5xl font-black text-dark uppercase tracking-normal mb-4">
                    {{ __('messages.articles.title') }}
                </h2>
                {{-- Garis dekorasi --}}
                <div class="w-24 h-1.5 bg-primary/20 mx-auto rounded-full mt-6"></div>
            </div>

            {{-- Grid Artikel --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-12">
                @forelse ($latestArticles as $article)
                    @php
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
                            <time class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-3 block">
                                {{ $article->published_at->translatedFormat('d F Y') }}
                            </time>
                            <h3
                                class="font-tegas text-2xl font-black text-dark group-hover:text-primary transition-colors duration-300 leading-tight uppercase mb-4">
                                <a href="{{ $articleUrl }}">{{ $article->title }}</a>
                            </h3>
                            <p class="text-gray-600 mb-8 line-clamp-3 font-body text-sm leading-relaxed italic font-light">
                                {{ $article->excerpt }}
                            </p>
                            <a href="{{ $articleUrl }}"
                                class="mt-auto inline-flex items-center text-primary font-bold font-tegas text-xs uppercase tracking-widest group/link">
                                <span class="hover-underline">BACA SELENGKAPNYA</span>
                                <span
                                    class="material-symbols-outlined ml-1 text-[18px] group-hover/link:translate-x-1 transition-transform duration-300">
                                    chevron_right
                                </span>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-400 italic">{{ __('messages.articles.empty') }}</p>
                    </div>
                @endforelse
            </div>

            {{-- 2. Button Section: mt-28 untuk jarak & justify-center untuk posisi TENAH --}}
            <div class="mt-28 flex justify-center">
                <a href="{{ route('artikel.index', ['locale' => app()->getLocale()]) }}"
                    class="inline-flex items-center space-x-2 text-dark hover:text-primary transition-colors font-tegas font-bold uppercase text-xs tracking-widest border border-gray-200 px-10 py-4 rounded-xl hover:border-primary shadow-sm hover:shadow-xl transition-all duration-300">
                    <span>{{ __('messages.articles.view_all') }}</span>
                    <span class="material-symbols-outlined text-sm">arrow_outward</span>
                </a>
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
                {{ __('messages.cta.title') }}
            </h2>
            <p class="text-xl text-white/80 font-light mb-12 max-w-2xl mx-auto leading-relaxed">
                {{ __('messages.cta.description') }}
            </p>
            <a href="{{ route('kontak', ['locale' => app()->getLocale()]) }}"
                class="inline-flex justify-center items-center bg-cream text-primary px-10 py-5 rounded-xl font-black font-tegas uppercase tracking-widest hover:bg-white hover:scale-105 transition-all duration-300 text-lg shadow-2xl">
                {{ __('messages.cta.button') }}
            </a>
        </div>
    </section>
@endsection