@extends('frontend.layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <article class="bg-cream pt-36 pb-24">
        <div class="max-w-4xl mx-auto px-8 md:px-12">
            {{-- Breadcrumb --}}
            <nav class="mb-10 flex items-center space-x-2 text-sm text-gray-400 font-body">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="hover:text-primary transition-colors">
                    {{ __('messages.navbar.home') }}
                </a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <a href="{{ route('program.index', ['locale' => app()->getLocale()]) }}"
                    class="hover:text-primary transition-colors">
                    {{ __('messages.navbar.program') }}
                </a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <span class="text-primary font-medium truncate max-w-[200px]">{{ $program->title }}</span>
            </nav>

            {{-- Category + Status + Date --}}
            <div class="flex flex-wrap items-center gap-3 mb-6">
                <span
                    class="bg-primary text-white text-[10px] font-tegas font-black px-4 py-2 rounded-lg uppercase tracking-widest shadow-lg flex items-center gap-2">
                    @if ($program->category && $program->category->icon)
                        <img src="{{ asset('storage/' . $program->category->icon) }}"
                            class="w-4 h-4 object-contain brightness-0 invert" alt="{{ $program->category->name }}">
                    @else
                        <span class="material-symbols-outlined text-[14px]">category</span>
                    @endif
                    {{ $program->category->name }}
                </span>

                <span
                    class="{{ $program->status === 'ongoing' ? 'bg-yellow-500' : 'bg-green-500' }} text-white text-[10px] font-bold py-2 px-4 rounded-lg uppercase tracking-widest shadow-lg flex items-center gap-1.5">
                    @if ($program->status === 'ongoing')
                        <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                        {{ __('messages.program.ongoing') }}
                    @else
                        <span class="material-symbols-outlined text-xs">check_circle</span>
                        {{ __('messages.program.completed') }}
                    @endif
                </span>

                @if ($program->published_at)
                    <time class="text-sm text-gray-400 font-bold uppercase tracking-widest">
                        {{ $program->published_at->translatedFormat('d F Y') }}
                    </time>
                @endif
            </div>

            <h1 class="font-tegas text-4xl md:text-5xl font-black text-dark uppercase tracking-tighter leading-tight mb-10">
                {{ $program->title }}
            </h1>

            {{-- Featured Image & Video --}}
            @if ($program->featured_image)
                <div class="aspect-video rounded-2xl overflow-hidden mb-12 shadow-2xl shadow-primary/10">
                    <img src="{{ asset('storage/' . $program->featured_image) }}" alt="{{ $program->title }}"
                        class="w-full h-full object-cover">
                </div>
            @endif

            @if ($program->video_url)
                {{-- Logic YouTube Embed --}}
                @php
                    preg_match(
                        '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
                        $program->video_url,
                        $match,
                    );
                    $videoId = $match[1] ?? null;
                @endphp
                @if ($videoId)
                    <div class="aspect-video rounded-2xl overflow-hidden mb-12 shadow-2xl shadow-primary/10">
                        <iframe src="https://www.youtube.com/embed/{{ $videoId }}" class="w-full h-full"
                            frameborder="0" allowfullscreen></iframe>
                    </div>
                @endif
            @endif

            <div
                class="prose prose-lg max-w-none prose-headings:font-tegas prose-headings:uppercase prose-headings:tracking-tight mb-16">
                {!! $program->body !!}
            </div>

            {{-- PENTAGON ASET (RADAR CHART) --}}
            <div class="mt-16 bg-white p-10 rounded-3xl shadow-xl shadow-primary/5 border border-gray-100 animate-fade-in">
                <div class="text-center mb-10">
                    <h3 class="font-tegas text-2xl font-black text-primary uppercase tracking-tight mb-2">Pentagon Aset
                        Ketangguhan</h3>
                    <p class="text-gray-400 text-sm font-body italic">Visualisasi dampak program terhadap 5 modal
                        ketangguhan komunitas</p>
                </div>

                <div class="max-w-md mx-auto relative h-[400px]">
                    <canvas id="pentagonChart"></canvas>
                </div>

                {{-- Bukti Teks Per Pilar --}}
                <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-10">
                    {{-- Modal Manusia --}}
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary text-xl">person</span>
                        </div>
                        <div>
                            <h4 class="font-tegas font-bold text-dark uppercase text-[11px] tracking-widest mb-1">Modal
                                Manusia ({{ $program->human_capital }}%)</h4>
                            <p class="text-gray-500 text-xs leading-relaxed italic">
                                {{ $program->human_capital_note ?? 'Fokus pada peningkatan kapasitas individu dan keterampilan teknis.' }}
                            </p>
                        </div>
                    </div>
                    {{-- Modal Sosial --}}
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary text-xl">groups</span>
                        </div>
                        <div>
                            <h4 class="font-tegas font-bold text-dark uppercase text-[11px] tracking-widest mb-1">Modal
                                Sosial ({{ $program->social_capital }}%)</h4>
                            <p class="text-gray-500 text-xs leading-relaxed italic">
                                {{ $program->social_capital_note ?? 'Penguatan jejaring dan aksi kolektif komunitas.' }}
                            </p>
                        </div>
                    </div>
                    {{-- Modal Alam --}}
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary text-xl">eco</span>
                        </div>
                        <div>
                            <h4 class="font-tegas font-bold text-dark uppercase text-[11px] tracking-widest mb-1">Modal Alam
                                ({{ $program->natural_capital }}%)</h4>
                            <p class="text-gray-500 text-xs leading-relaxed italic">
                                {{ $program->natural_capital_note ?? 'Perlindungan dan pengelolaan sumber daya alam berkelanjutan.' }}
                            </p>
                        </div>
                    </div>
                    {{-- Modal Fisik --}}
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary text-xl">factory</span>
                        </div>
                        <div>
                            <h4 class="font-tegas font-bold text-dark uppercase text-[11px] tracking-widest mb-1">Modal
                                Fisik ({{ $program->physical_capital }}%)</h4>
                            <p class="text-gray-500 text-xs leading-relaxed italic">
                                {{ $program->physical_capital_note ?? 'Penyediaan infrastruktur dan alat produksi tepat guna.' }}
                            </p>
                        </div>
                    </div>
                    {{-- Modal Finansial --}}
                    <div class="flex gap-4 md:col-span-2 md:max-w-md md:mx-auto">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary text-xl">payments</span>
                        </div>
                        <div>
                            <h4 class="font-tegas font-bold text-dark uppercase text-[11px] tracking-widest mb-1">Modal
                                Finansial ({{ $program->financial_capital }}%)</h4>
                            <p class="text-gray-500 text-xs leading-relaxed italic">
                                {{ $program->financial_capital_note ?? 'Akses terhadap sumber pendanaan dan aset ekonomi warga.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PDF Section --}}
            @if ($program->pdf_file)
                <div
                    class="mt-12 p-8 bg-white rounded-2xl border-2 border-primary/10 flex items-center justify-between shadow-lg">
                    <div class="flex items-center space-x-4">
                        <span class="material-symbols-outlined text-4xl text-red-500">picture_as_pdf</span>
                        <div>
                            <h4 class="font-tegas font-bold text-dark uppercase text-sm">
                                {{ __('messages.program.download_title') }}</h4>
                            <p class="text-gray-400 text-xs">{{ __('messages.program.download_subtitle') }}</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $program->pdf_file) }}" target="_blank"
                        class="bg-primary text-white px-6 py-3 rounded-xl font-tegas font-bold uppercase text-xs tracking-widest hover:bg-dark transition-all">
                        {{ __('messages.program.download_btn') }}
                    </a>
                </div>
            @endif
        </div>
    </article>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('pentagonChart');
            new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: ['Manusia', 'Sosial', 'Alam', 'Fisik', 'Finansial'],
                    datasets: [{
                        label: 'Skor Aset',
                        data: [
                            {{ $program->human_capital ?? 0 }},
                            {{ $program->social_capital ?? 0 }},
                            {{ $program->natural_capital ?? 0 }},
                            {{ $program->physical_capital ?? 0 }},
                            {{ $program->financial_capital ?? 0 }}
                        ],
                        fill: true,
                        backgroundColor: 'rgba(50, 0, 2, 0.15)',
                        borderColor: '#320002',
                        pointBackgroundColor: '#320002',
                        borderWidth: 3,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            suggestedMin: 0,
                            suggestedMax: 100,
                            ticks: {
                                display: false
                            },
                            pointLabels: {
                                font: {
                                    family: 'Montserrat',
                                    size: 12,
                                    weight: 'bold'
                                },
                                color: '#320002'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
@endsection
