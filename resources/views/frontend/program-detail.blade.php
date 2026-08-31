@extends('frontend.layouts.app')
@section('title', $program->title)
@section('og_title', $program->title)
@section('og_description', Str::limit(strip_tags($program->body), 150))
@section('og_image', $program->featured_image ? asset('storage/' . $program->featured_image) : asset('images/logo-kawung-ori.png'))

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <article class="bg-cream pt-36 pb-24">
        <div class="max-w-7xl mx-auto px-8 md:px-12 grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            {{-- KIRI: KONTEN UTAMA --}}
            <div class="lg:col-span-2">
                {{-- Breadcrumb: Poles lebih halus & hapus judul program --}}
                <nav class="mb-8 flex items-center space-x-3 text-[10px] uppercase tracking-normal font-tegas text-gray-400">
                    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
                        class="hover:text-primary transition-colors">{{ __('messages.navbar.home') }}</a>
                    <span class="text-gray-300">/</span>
                    <a href="{{ route('program.index', ['locale' => app()->getLocale()]) }}"
                        class="hover:text-primary transition-colors">{{ __('messages.navbar.program') }}</a>
                </nav>

                {{-- Category + Metadata --}}
                <div class="flex flex-wrap gap-2 mb-8 uppercase tracking-normal">
                    @foreach ($program->categories as $category)
                        <span class="bg-primary text-white text-[10px] font-tegas font-black px-4 py-2 rounded-lg shadow-lg flex items-center gap-2 whitespace-nowrap">
                            @if ($category->icon)
                                <img src="{{ asset('storage/' . $category->icon) }}" class="w-3.5 h-3.5 object-contain brightness-0 invert" alt="{{ $category->name }}">
                            @else
                                <span class="material-symbols-outlined text-[14px]">category</span>
                            @endif
                            {{ $category->name }}
                        </span>
                    @endforeach

                    {{-- Status Badge --}}
                    <span class="{{ $program->status === 'ongoing' ? 'bg-yellow-500' : 'bg-green-500' }} text-white text-[10px] font-bold py-2 px-4 rounded-lg shadow-lg flex items-center gap-1.5">
                        @if ($program->status === 'ongoing')
                            <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                        @endif
                        {{ $program->status === 'ongoing' ? __('messages.program.ongoing') : __('messages.program.completed') }}
                    </span>
                </div>

                {{-- FIX RESPONSIVE: Judul Detail Program diturunkan jadi text-2xl di mobile --}}
                <h1 class="font-tegas text-2xl sm:text-3xl md:text-5xl font-black text-dark uppercase tracking-normal leading-tight mb-10">
                    {{ $program->title }}
                </h1>

                {{-- Featured Media --}}
                @if ($program->featured_image)
                    <div class="aspect-video rounded-3xl overflow-hidden mb-12 shadow-2xl shadow-primary/5">
                        <img src="{{ asset('storage/' . $program->featured_image) }}" alt="{{ $program->title }}"
                            class="w-full h-full object-cover">
                    </div>
                @endif

                @if ($program->video_url)
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

                {{-- Isi detail program rata kanan-kiri --}}
                <div class="prose prose-lg max-w-none text-justify prose-headings:font-tegas prose-headings:uppercase prose-headings:tracking-tight mb-16">
                    {!! $program->body !!}
                </div>

                {{-- PENTAGON ASET (DIKECILKAN) --}}
                <div class="mt-12 bg-white p-6 md:p-8 rounded-3xl shadow-xl shadow-primary/5 border border-gray-100 animate-fade-in">
                    <div class="text-center mb-6">
                        <h3 class="font-tegas text-xl font-black text-primary uppercase tracking-tight mb-1">
                            Pentagon Aset
                        </h3>
                        <p class="text-gray-400 text-[10px] font-body italic">
                            Visualisasi dampak program (Skala 0-100%)
                        </p>
                    </div>

                    {{-- Ukuran kontainer Chart dikecilkan ke max-w-sm dan h-[200px] --}}
                    <div class="max-w-sm mx-auto relative h-[200px]">
                        <canvas id="pentagonChart"></canvas>
                    </div>

                    {{-- Bukti Teks Per Pilar (Grid Dikecilkan) --}}
                    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-gray-50 pt-8">
                        @php
                            $assets = [
                                ['key' => 'human_capital', 'label' => 'Modal Manusia', 'icon' => 'person'],
                                ['key' => 'social_capital', 'label' => 'Modal Sosial', 'icon' => 'groups'],
                                ['key' => 'natural_capital', 'label' => 'Modal Alam', 'icon' => 'eco'],
                                ['key' => 'physical_capital', 'label' => 'Modal Fisik', 'icon' => 'factory'],
                                ['key' => 'financial_capital', 'label' => 'Modal Finansial', 'icon' => 'payments'],
                            ];
                        @endphp

                        @foreach ($assets as $asset)
                            @php
                                $val = $program->{$asset['key']} ?? 0;
                                $statusLabel = $val >= 70 ? 'Tinggi' : ($val >= 35 ? 'Sedang' : 'Rendah');
                            @endphp
                            <div class="flex gap-3 @if ($loop->last) md:col-span-2 md:max-w-xs md:mx-auto @endif">
                                {{-- Icon Dikecilkan ke w-9 h-9 --}}
                                <div class="w-9 h-9 bg-primary/5 rounded-lg flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-primary text-lg">{{ $asset['icon'] }}</span>
                                </div>
                                <div>
                                    <h4 class="font-tegas font-bold text-dark uppercase text-[10px] tracking-widest mb-0.5">
                                        {{ $asset['label'] }}
                                        (<span class="asset-counter" data-target="{{ $val }}">0</span>%)
                                        <span class="text-primary italic">[{{ $statusLabel }}]</span>
                                    </h4>
                                    <p class="text-gray-500 text-[11px] leading-snug italic">
                                        {{ $program->{$asset['key'] . '_note'} ?? 'Catatan modal ini.' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- PDF Section --}}
                @if ($program->pdf_file)
                    <div class="mt-12 p-6 bg-white rounded-2xl border-2 border-primary/10 flex items-center justify-between shadow-lg">
                        <div class="flex items-center space-x-4">
                            <span class="material-symbols-outlined text-3xl text-red-500">picture_as_pdf</span>
                            <div>
                                <h4 class="font-tegas font-bold text-dark uppercase text-xs">
                                    {{ __('messages.program.download_title') }}</h4>
                                <p class="text-gray-400 text-[10px]">{{ __('messages.program.download_subtitle') }}</p>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $program->pdf_file) }}" target="_blank"
                            class="bg-primary text-white px-5 py-2.5 rounded-xl font-tegas font-bold uppercase text-[10px] tracking-widest hover:bg-dark transition-all">
                            {{ __('messages.program.download_btn') }}
                        </a>
                    </div>
                @endif
            </div>

            {{-- KANAN: SIDEBAR --}}
            <aside class="lg:col-span-1">
                <div class="bg-white p-6 lg:p-8 rounded-3xl shadow-xl shadow-primary/5 border border-gray-100 flex flex-col gap-8">
                    
                    {{-- Author Box --}}
                    <div>
                        <h3 class="font-tegas text-sm font-black text-dark uppercase tracking-widest mb-5 border-b border-gray-100 pb-3">
                            Penulis Program
                        </h3>
                        <div class="flex items-center gap-4 mb-5">
                            @if ($program->user && $program->user->profile_photo)
                                <img src="{{ asset('storage/' . $program->user->profile_photo) }}" alt="{{ $program->author_name }}" class="w-12 h-12 rounded-full object-cover shadow-sm">
                            @else
                                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center shadow-sm">
                                    <span class="material-symbols-outlined text-2xl">person</span>
                                </div>
                            @endif
                            <div>
                                <h4 class="font-tegas text-base font-black text-dark uppercase leading-tight">{{ $program->author_name ?? 'Tim Kawungpitu' }}</h4>
                            </div>
                        </div>
                        
                        <div class="space-y-3 text-[10px] text-gray-500 font-bold uppercase tracking-wider">
                            <div class="flex items-center justify-between">
                                <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[14px] text-primary/60">calendar_today</span> Dipublikasikan</span>
                                <span class="text-dark">{{ $program->published_at ? $program->published_at->translatedFormat('d M Y') : '-' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[14px] text-primary/60">visibility</span> Total Tayangan</span>
                                <span class="text-dark">{{ number_format($program->view_count) }} Kali</span>
                            </div>
                        </div>
                    </div>

                    {{-- Related Programs --}}
                    @if (isset($relatedPrograms) && $relatedPrograms->isNotEmpty())
                        <div>
                            <h3 class="font-tegas text-sm font-black text-dark uppercase tracking-widest mb-5 border-b border-gray-100 pb-3">
                                Program Lainnya
                            </h3>
                            <div class="space-y-5">
                                @foreach ($relatedPrograms as $related)
                                    @php
                                        $relatedUrl = $related->slug ? route('program.show', ['locale' => app()->getLocale(), 'slug' => $related->slug]) : '#';
                                    @endphp
                                    <article class="group flex gap-3">
                                        <a href="{{ $relatedUrl }}" class="shrink-0 w-20 h-16 rounded-xl overflow-hidden shadow-sm">
                                            @if ($related->featured_image)
                                                <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                                            @else
                                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                    <span class="material-symbols-outlined text-gray-400">campaign</span>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartElement = document.getElementById('pentagonChart');
            const targetData = [
                {{ $program->human_capital ?? 0 }},
                {{ $program->social_capital ?? 0 }},
                {{ $program->natural_capital ?? 0 }},
                {{ $program->physical_capital ?? 0 }},
                {{ $program->financial_capital ?? 0 }}
            ];

            let chartRendered = false;

            const animateValue = (obj, start, end, duration) => {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    obj.innerHTML = Math.floor(progress * (end - start) + start);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            };

            const initChart = () => {
                new Chart(chartElement, {
                    type: 'radar',
                    data: {
                        labels: ['Manusia', 'Sosial', 'Alam', 'Fisik', 'Finansial'],
                        datasets: [{
                            label: 'Skor Aset (%)',
                            data: targetData,
                            fill: true,
                            backgroundColor: 'rgba(128, 0, 0, 0.12)',
                            borderColor: '#800000',
                            pointBackgroundColor: '#800000',
                            borderWidth: 2,
                            pointRadius: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 3000,
                            easing: 'easeOutQuart'
                        },
                        scales: {
                            r: {
                                suggestedMin: 0,
                                suggestedMax: 100,
                                ticks: {
                                    stepSize: 25,
                                    display: false
                                },
                                pointLabels: {
                                    font: {
                                        family: 'Montserrat',
                                        size: 10,
                                        weight: 'bold'
                                    },
                                    color: '#800000'
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

                document.querySelectorAll('.asset-counter').forEach((counter) => {
                    const target = parseInt(counter.getAttribute('data-target'));
                    animateValue(counter, 0, target, 3000);
                });
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !chartRendered) {
                        initChart();
                        chartRendered = true;
                    }
                });
            }, {
                threshold: 0.2
            });

            observer.observe(chartElement);
        });
    </script>
@endsection
