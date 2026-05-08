@extends('frontend.layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="id" class="scroll-smooth">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil Kawungpitu Institute - 2026</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Lucide Icons -->
        <script src="https://unpkg.com/lucide@latest"></script>
        <!-- Montserrat & Inter Fonts -->
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&family=Inter:wght@300;400;500;600&display=swap"
            rel="stylesheet">
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                            montserrat: ['Montserrat', 'sans-serif'],
                        },
                        colors: {
                            brand: {
                                50: '#fdf3f2',
                                100: '#fbe4e1',
                                200: '#f8cdc7',
                                300: '#f2aba2',
                                400: '#e87d70',
                                500: '#da5243',
                                600: '#c53b2d',
                                700: '#8b261b', // Maroon Utama
                                800: '#75231a',
                                900: '#62211a',
                            }
                        }
                    }
                }
            }
        </script>
        <style>
            .pattern-bg {
                background-color: #fdf3f2;
                background-image: radial-gradient(#8b261b 0.5px, transparent 0.5px), radial-gradient(#8b261b 0.5px, #fdf3f2 0.5px);
                background-size: 24px 24px;
                background-position: 0 0, 12px 12px;
                opacity: 0.5;
            }

            .brand-logo-text {
                font-family: 'Montserrat', sans-serif;
                font-weight: 800;
                letter-spacing: -0.04em;
                text-transform: uppercase;
            }

            .radar-grid {
                stroke: #e5e7eb;
                stroke-width: 1;
                fill: none;
            }

            .radar-label {
                font-size: 8px;
                font-weight: 700;
                fill: #9ca3af;
                text-transform: uppercase;
                font-family: 'Montserrat', sans-serif;
            }

            .radar-area {
                fill: rgba(139, 38, 27, 0.25);
                stroke: #8b261b;
                stroke-width: 2;
            }

            .radar-point {
                fill: #8b261b;
            }

            #mobile-menu {
                transition: all 0.3s ease-in-out;
                max-height: 0;
                overflow: hidden;
            }

            #mobile-menu.open {
                max-height: 600px;
                padding-bottom: 1.5rem;
            }
        </style>
    </head>

    <body class="bg-gray-50 text-gray-800 font-sans">

        <!-- Navbar -->
        <nav class="bg-white/95 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-brand-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex-shrink-0">
                        <a href="#" class="group flex items-center gap-2">
                            <div
                                class="brand-logo-text text-2xl md:text-3xl text-brand-700 transition-colors group-hover:text-brand-900">
                                Kawung<span class="text-gray-400">pitu</span>
                            </div>
                            <div class="h-1.5 w-1.5 rounded-full bg-brand-500 mt-2"></div>
                        </a>
                    </div>

                    <div class="hidden lg:flex items-center space-x-1">
                        <a href="#tentang"
                            class="text-[10px] text-gray-600 hover:text-brand-700 hover:bg-brand-50 px-3 py-2 rounded-full font-bold transition-all uppercase tracking-wider">Tentang
                            Kami</a>
                        <a href="#pilar"
                            class="text-[10px] text-gray-600 hover:text-brand-700 hover:bg-brand-50 px-3 py-2 rounded-full font-bold transition-all uppercase tracking-wider">Pilar
                            Kerja</a>
                        <a href="#strategi"
                            class="text-[10px] text-gray-600 hover:text-brand-700 hover:bg-brand-50 px-3 py-2 rounded-full font-bold transition-all uppercase tracking-wider">Strategi</a>
                        <a href="#artikel"
                            class="text-[10px] text-gray-600 hover:text-brand-700 hover:bg-brand-50 px-3 py-2 rounded-full font-bold transition-all uppercase tracking-wider">Artikel</a>
                        <a href="#galeri"
                            class="text-[10px] text-gray-600 hover:text-brand-700 hover:bg-brand-50 px-3 py-2 rounded-full font-bold transition-all uppercase tracking-wider">Foto
                            & Video</a>
                        <div class="w-2"></div>
                        <a href="#"
                            class="bg-brand-700 text-white px-5 py-2 rounded-full text-[10px] font-black hover:bg-brand-800 transition-all shadow-md shadow-brand-200 uppercase tracking-widest">
                            Hubungi Kami
                        </a>
                    </div>

                    <div class="lg:hidden">
                        <button id="menu-btn" class="p-2 text-brand-700">
                            <i data-lucide="menu" class="w-7 h-7"></i>
                        </button>
                    </div>
                </div>

                <div id="mobile-menu" class="lg:hidden">
                    <div class="flex flex-col space-y-1 pb-4">
                        <a href="#tentang"
                            class="text-sm text-gray-700 hover:text-brand-700 hover:bg-brand-50 px-4 py-3 rounded-xl font-bold transition-colors uppercase tracking-wider">Tentang
                            Kami</a>
                        <a href="#pilar"
                            class="text-sm text-gray-700 hover:text-brand-700 hover:bg-brand-50 px-4 py-3 rounded-xl font-bold transition-colors uppercase tracking-wider">Pilar
                            Kerja</a>
                        <a href="#strategi"
                            class="text-sm text-gray-700 hover:text-brand-700 hover:bg-brand-50 px-4 py-3 rounded-xl font-bold transition-colors uppercase tracking-wider">Strategi</a>
                        <a href="#artikel"
                            class="text-sm text-gray-700 hover:text-brand-700 hover:bg-brand-50 px-4 py-3 rounded-xl font-bold transition-colors uppercase tracking-wider">Artikel</a>
                        <a href="#galeri"
                            class="text-sm text-gray-700 hover:text-brand-700 hover:bg-brand-50 px-4 py-3 rounded-xl font-bold transition-colors uppercase tracking-wider">Foto
                            & Video</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <header class="relative bg-brand-900 text-white py-32 md:py-48 overflow-hidden">
            <div class="absolute inset-0 opacity-40 mix-blend-multiply">
                <img src="https://images.unsplash.com/photo-1518173946687-a4c8a9b746f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                    alt="Lanskap Alam Indonesia" class="w-full h-full object-cover">
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div
                    class="inline-flex items-center gap-2 px-6 py-2 bg-white/10 backdrop-blur-lg rounded-full text-xs font-black tracking-[0.2em] mb-10 border border-white/20 text-brand-100 uppercase font-montserrat">
                    <i data-lucide="award" class="w-4 h-4 text-brand-300"></i> Membangun Ketangguhan Bangsa
                </div>
                <h1 class="text-5xl md:text-7xl font-montserrat font-black mb-8 tracking-tighter leading-tight uppercase">
                    Membangun <span class="text-brand-300 italic">Resiliensi</span> Komunitas</h1>
                <p class="text-xl md:text-2xl text-brand-50 max-w-4xl mx-auto mb-12 leading-relaxed opacity-90 font-light">
                    Mendorong ketangguhan komunitas lokal melalui pengelolaan aset strategis yang adil, mandiri, dan
                    berkelanjutan.
                </p>
            </div>
        </header>

        <!-- Section: Tentang Kami -->
        <section id="tentang" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                    <div class="lg:col-span-7">
                        <h2
                            class="text-3xl md:text-4xl font-montserrat font-black text-gray-900 mb-8 uppercase leading-tight">
                            Mewujudkan Ketangguhan, <br>
                            <span class="text-brand-700 italic">Menganyam Masa Depan</span> Berkelanjutan
                        </h2>
                        <div class="space-y-6 text-gray-700 text-lg leading-relaxed">
                            <p>
                                <strong>Kawungpitu Institute</strong> adalah lembaga penggerak kemandirian komunitas yang
                                berdedikasi untuk mentransformasi penghidupan masyarakat melalui pendekatan <em>Sustainable
                                    Livelihoods Framework</em> (SLF).
                            </p>
                            <p>
                                Kami hadir untuk menjembatani potensi lokal dengan strategi pembangunan yang inklusif dan
                                tangguh iklim, berfokus pada penguatan kapasitas masyarakat untuk mengelola sumber daya
                                mereka sendiri secara berdaulat.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-5 bg-brand-50 rounded-[3rem] p-10 md:p-14">
                        <div class="p-8 opacity-20"><i data-lucide="quote" class="w-16 h-16 text-brand-700"></i></div>
                        <blockquote class="text-xl font-montserrat italic font-medium text-brand-900 mb-8 leading-snug">
                            "Penghidupan berkelanjutan adalah kemampuan komunitas untuk bangkit dari guncangan tanpa
                            mengorbankan masa depan."
                        </blockquote>
                        <footer class="font-montserrat font-black text-xs uppercase tracking-[0.2em] text-brand-700">—
                            Prinsip Kawungpitu</footer>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pilar Kerja Section -->
        <section id="pilar" class="py-24 bg-gray-50 border-t border-brand-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-montserrat font-black text-gray-900 mb-6 uppercase tracking-tight">Pilar Kerja
                    </h2>
                    <div class="w-20 h-1.5 bg-brand-700 mx-auto rounded-full"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        class="bg-white rounded-[2rem] p-10 border border-brand-100 shadow-sm hover:shadow-xl transition-all">
                        <div class="w-14 h-14 bg-brand-700 text-white rounded-xl flex items-center justify-center mb-8"><i
                                data-lucide="user" class="w-7 h-7"></i></div>
                        <h3 class="text-xl font-montserrat font-black text-gray-900 mb-4 uppercase">Modal Manusia</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Fokus pada peningkatan keterampilan, pendidikan,
                            dan kesehatan individu dalam komunitas.</p>
                    </div>
                    <div
                        class="bg-white rounded-[2rem] p-10 border border-brand-100 shadow-sm hover:shadow-xl transition-all">
                        <div class="w-14 h-14 bg-brand-700 text-white rounded-xl flex items-center justify-center mb-8"><i
                                data-lucide="users" class="w-7 h-7"></i></div>
                        <h3 class="text-xl font-montserrat font-black text-gray-900 mb-4 uppercase">Modal Sosial</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Membangun kepercayaan, jaringan kerja sama, dan
                            penguatan lembaga lokal.</p>
                    </div>
                    <div
                        class="bg-white rounded-[2rem] p-10 border border-brand-100 shadow-sm hover:shadow-xl transition-all">
                        <div class="w-14 h-14 bg-brand-700 text-white rounded-xl flex items-center justify-center mb-8"><i
                                data-lucide="leaf" class="w-7 h-7"></i></div>
                        <h3 class="text-xl font-montserrat font-black text-gray-900 mb-4 uppercase">Modal Alam</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Melindungi dan mengelola sumber daya alam sebagai
                            basis penghidupan jangka panjang.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Strategi Integratif Section with Pentagonal Asset Diagrams -->
        <section id="strategi" class="py-24 pattern-bg border-t border-brand-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-montserrat font-black text-gray-900 mb-6 uppercase tracking-tight">Strategi
                        Integratif</h2>
                    <p class="text-brand-700 font-bold uppercase tracking-widest text-xs font-montserrat mb-8">Pemanfaatan
                        Pentagonal Aset dalam Tiap Inisiatif</p>
                    <div class="w-20 h-1.5 bg-brand-700 mx-auto rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    <!-- Strategi 1: Social Enterprise Hub -->
                    <div class="bg-white p-8 rounded-[3rem] shadow-xl border border-brand-100 flex flex-col gap-6">
                        <div class="flex justify-between items-start">
                            <div class="bg-brand-50 p-4 rounded-2xl">
                                <i data-lucide="trending-up" class="w-8 h-8 text-brand-700"></i>
                            </div>
                            <div class="w-24 h-24">
                                <!-- Radar Chart -->
                                <svg viewBox="0 0 100 100" class="w-full h-full">
                                    <polygon points="50,10 88,38 73,82 27,82 12,38" class="radar-grid" />
                                    <polygon points="50,30 80,45 65,75 35,70 20,40" class="radar-area" />
                                    <text x="50" y="8" text-anchor="middle" class="radar-label">H</text>
                                    <text x="92" y="40" text-anchor="start" class="radar-label">S</text>
                                    <text x="75" y="90" text-anchor="middle" class="radar-label">N</text>
                                    <text x="25" y="90" text-anchor="middle" class="radar-label">P</text>
                                    <text x="8" y="40" text-anchor="end" class="radar-label">F</text>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-montserrat font-black text-brand-800 uppercase mb-3">Social-Enterprise
                                Hub</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">Membangun ekosistem bisnis berbasis komunitas
                                yang menghubungkan produsen lokal ke pasar global dengan skema bagi hasil yang adil.</p>
                        </div>
                    </div>

                    <!-- Strategi 2: Community Research -->
                    <div class="bg-white p-8 rounded-[3rem] shadow-xl border border-brand-100 flex flex-col gap-6">
                        <div class="flex justify-between items-start">
                            <div class="bg-brand-50 p-4 rounded-2xl">
                                <i data-lucide="search" class="w-8 h-8 text-brand-700"></i>
                            </div>
                            <div class="w-24 h-24">
                                <svg viewBox="0 0 100 100" class="w-full h-full">
                                    <polygon points="50,10 88,38 73,82 27,82 12,38" class="radar-grid" />
                                    <polygon points="50,15 70,38 73,82 40,70 15,38" class="radar-area" />
                                    <text x="50" y="8" text-anchor="middle" class="radar-label">H</text>
                                    <text x="92" y="40" text-anchor="start" class="radar-label">S</text>
                                    <text x="75" y="90" text-anchor="middle" class="radar-label">N</text>
                                    <text x="25" y="90" text-anchor="middle" class="radar-label">P</text>
                                    <text x="8" y="40" text-anchor="end" class="radar-label">F</text>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-montserrat font-black text-brand-800 uppercase mb-3">Community Research
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed">Pendataan partisipatif untuk memetakan aset,
                                kerentanan, dan peluang di tingkat akar rumput sebagai dasar kebijakan lokal.</p>
                        </div>
                    </div>

                    <!-- Strategi 3: Climate Resilience -->
                    <div class="bg-white p-8 rounded-[3rem] shadow-xl border border-brand-100 flex flex-col gap-6">
                        <div class="flex justify-between items-start">
                            <div class="bg-brand-50 p-4 rounded-2xl">
                                <i data-lucide="cloud-lightning" class="w-8 h-8 text-brand-700"></i>
                            </div>
                            <div class="w-24 h-24">
                                <svg viewBox="0 0 100 100" class="w-full h-full">
                                    <polygon points="50,10 88,38 73,82 27,82 12,38" class="radar-grid" />
                                    <polygon points="50,25 60,38 85,82 45,82 30,38" class="radar-area" />
                                    <text x="50" y="8" text-anchor="middle" class="radar-label">H</text>
                                    <text x="92" y="40" text-anchor="start" class="radar-label">S</text>
                                    <text x="75" y="90" text-anchor="middle" class="radar-label">N</text>
                                    <text x="25" y="90" text-anchor="middle" class="radar-label">P</text>
                                    <text x="8" y="40" text-anchor="end" class="radar-label">F</text>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-montserrat font-black text-brand-800 uppercase mb-3">Climate Resilience
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed">Integrasi adaptasi perubahan iklim ke dalam
                                pengelolaan lahan dan infrastruktur desa untuk meminimalkan risiko bencana.</p>
                        </div>
                    </div>

                    <!-- Strategi 4: Digital Literacy -->
                    <div class="bg-white p-8 rounded-[3rem] shadow-xl border border-brand-100 flex flex-col gap-6">
                        <div class="flex justify-between items-start">
                            <div class="bg-brand-50 p-4 rounded-2xl">
                                <i data-lucide="cpu" class="w-8 h-8 text-brand-700"></i>
                            </div>
                            <div class="w-24 h-24">
                                <svg viewBox="0 0 100 100" class="w-full h-full">
                                    <polygon points="50,10 88,38 73,82 27,82 12,38" class="radar-grid" />
                                    <polygon points="50,15 80,38 60,70 30,65 15,38" class="radar-area" />
                                    <text x="50" y="8" text-anchor="middle" class="radar-label">H</text>
                                    <text x="92" y="40" text-anchor="start" class="radar-label">S</text>
                                    <text x="75" y="90" text-anchor="middle" class="radar-label">N</text>
                                    <text x="25" y="90" text-anchor="middle" class="radar-label">P</text>
                                    <text x="8" y="40" text-anchor="end" class="radar-label">F</text>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-montserrat font-black text-brand-800 uppercase mb-3">Digital Literacy
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed">Pemanfaatan teknologi tepat guna untuk
                                efisiensi rantai pasok dan transparansi data tata kelola sumber daya desa.</p>
                        </div>
                    </div>

                    <!-- Strategi 5: Institutional Strength -->
                    <div class="bg-white p-8 rounded-[3rem] shadow-xl border border-brand-100 flex flex-col gap-6">
                        <div class="flex justify-between items-start">
                            <div class="bg-brand-50 p-4 rounded-2xl">
                                <i data-lucide="landmark" class="w-8 h-8 text-brand-700"></i>
                            </div>
                            <div class="w-24 h-24">
                                <svg viewBox="0 0 100 100" class="w-full h-full">
                                    <polygon points="50,10 88,38 73,82 27,82 12,38" class="radar-grid" />
                                    <polygon points="50,40 85,38 70,75 35,82 25,45" class="radar-area" />
                                    <text x="50" y="8" text-anchor="middle" class="radar-label">H</text>
                                    <text x="92" y="40" text-anchor="start" class="radar-label">S</text>
                                    <text x="75" y="90" text-anchor="middle" class="radar-label">N</text>
                                    <text x="25" y="90" text-anchor="middle" class="radar-label">P</text>
                                    <text x="8" y="40" text-anchor="end" class="radar-label">F</text>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-montserrat font-black text-brand-800 uppercase mb-3">Institutional
                                Strength</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">Revitalisasi lembaga lokal (BUMDes, Koperasi)
                                melalui pendampingan manajerial dan legalitas hukum.</p>
                        </div>
                    </div>

                    <!-- Strategi 6: Future Talent -->
                    <div class="bg-white p-8 rounded-[3rem] shadow-xl border border-brand-100 flex flex-col gap-6">
                        <div class="flex justify-between items-start">
                            <div class="bg-brand-50 p-4 rounded-2xl">
                                <i data-lucide="graduation-cap" class="w-8 h-8 text-brand-700"></i>
                            </div>
                            <div class="w-24 h-24">
                                <svg viewBox="0 0 100 100" class="w-full h-full">
                                    <polygon points="50,10 88,38 73,82 27,82 12,38" class="radar-grid" />
                                    <polygon points="50,12 75,45 60,70 40,75 25,40" class="radar-area" />
                                    <text x="50" y="8" text-anchor="middle" class="radar-label">H</text>
                                    <text x="92" y="40" text-anchor="start" class="radar-label">S</text>
                                    <text x="75" y="90" text-anchor="middle" class="radar-label">N</text>
                                    <text x="25" y="90" text-anchor="middle" class="radar-label">P</text>
                                    <text x="8" y="40" text-anchor="end" class="radar-label">F</text>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-montserrat font-black text-brand-800 uppercase mb-3">Future Talent</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">Program kepemimpinan bagi kaum muda desa untuk
                                menjadi inovator dan penggerak ekonomi di wilayahnya.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Artikel Section -->
        <section id="artikel" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-3xl font-montserrat font-black text-gray-900 mb-4 uppercase">Artikel Terbaru</h2>
                        <div class="w-20 h-1.5 bg-brand-700 rounded-full"></div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="group cursor-pointer">
                        <div class="aspect-video bg-gray-100 rounded-3xl overflow-hidden mb-4">
                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb773b09?auto=format&fit=crop&w=800&q=80"
                                alt="Post"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <h4 class="font-montserrat font-black text-lg text-gray-900 uppercase">Resiliensi di Tengah
                            Perubahan Iklim</h4>
                    </div>
                    <div class="group cursor-pointer">
                        <div class="aspect-video bg-gray-100 rounded-3xl overflow-hidden mb-4">
                            <img src="https://images.unsplash.com/photo-1516216628859-9bccecab13ca?auto=format&fit=crop&w=800&q=80"
                                alt="Post"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <h4 class="font-montserrat font-black text-lg text-gray-900 uppercase">Pemetaan Partisipatif
                            Anambas</h4>
                    </div>
                    <div class="group cursor-pointer">
                        <div class="aspect-video bg-gray-100 rounded-3xl overflow-hidden mb-4">
                            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=800&q=80"
                                alt="Post"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <h4 class="font-montserrat font-black text-lg text-gray-900 uppercase">Literasi Ekologi untuk Desa
                        </h4>
                    </div>
                </div>
            </div>
        </section>

        <!-- Galeri Foto & Video Section -->
        <section id="galeri" class="py-24 bg-gray-50 border-t border-brand-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-montserrat font-black text-gray-900 mb-6 uppercase">Foto & Video</h2>
                <div class="w-20 h-1.5 bg-brand-700 mx-auto rounded-full mb-12"></div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="aspect-square bg-gray-200 rounded-[2rem] overflow-hidden group">
                        <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=600&q=80"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="aspect-square bg-gray-200 rounded-[2rem] overflow-hidden group">
                        <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=600&q=80"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="aspect-square bg-gray-200 rounded-[2rem] overflow-hidden group">
                        <img src="https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?auto=format&fit=crop&w=600&q=80"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="aspect-square bg-gray-200 rounded-[2rem] overflow-hidden group">
                        <img src="https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?auto=format&fit=crop&w=600&q=80"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-brand-900 text-white py-16 border-t-8 border-brand-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="brand-logo-text text-3xl mb-4">Kawung<span class="text-brand-400">pitu</span></div>
                <p class="text-brand-200 text-xs font-montserrat uppercase tracking-[0.4em]">©️ 2026 Kawungpitu Institute
                </p>
            </div>
        </footer>

        <script>
            lucide.createIcons();

            const menuBtn = document.getElementById('menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('open');
            });

            const mobileLinks = mobileMenu.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.remove('open');
                });
            });
        </script>
    </body>

    </html>
    {{-- <header class="bg-cream pt-40 pb-24 px-8 md:px-12 border-b border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto relative">
            <div class="relative z-10">
                <h1
                    class="font-tegas text-5xl md:text-7xl font-black mb-10 uppercase tracking-tighter animate-fade-in-left w-fit text-left">
                    <span class="bg-white text-dark px-6 pr-20 py-2 block mb-2 w-full shadow-xl shadow-primary/5">
                        {{ __('messages.gallery.header_1') }}
                    </span>
                    <span class="bg-primary text-white px-6 pr-20 py-2 block w-full shadow-xl shadow-primary/10">
                        {{ __('messages.gallery.header_2') }}
                    </span>
                </h1>
                <div class="flex items-start space-x-6 animate-fade-in-left" style="animation-delay: 0.3s;">
                    <div class="w-1.5 h-20 bg-primary/20 rounded-full hidden md:block"></div>
                    <p class="text-lg md:text-xl text-primary font-medium max-w-2xl leading-relaxed italic opacity-90">
                        {{ __('messages.gallery.description') }}
                    </p>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-8 md:px-12 py-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse ($albums as $album)
                @php
                    // Pengaman: Jika slug bahasa yang aktif kosong, jangan bikin route-nya error
                    $albumUrl = $album->slug
                        ? route('galeri.show', ['locale' => app()->getLocale(), 'slug' => $album->slug])
                        : '#';
                @endphp
                <a href="{{ $albumUrl }}" class="group block">
                    <div
                        class="relative aspect-[4/3] rounded-3xl overflow-hidden mb-6 shadow-xl shadow-primary/5 border border-gray-100">
                        @if ($album->cover_image)
                            <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->title }}"
                                class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <span class="material-symbols-outlined text-6xl text-gray-400">photo_library</span>
                            </div>
                        @endif
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-dark/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-xl shadow-lg">
                            <span class="font-tegas text-sm font-black text-primary">
                                {{ $album->photos_count }} {{ __('messages.gallery.photo_unit') }}
                            </span>
                        </div>
                    </div>
                    <h3
                        class="font-tegas text-xl font-black text-dark group-hover:text-primary transition-colors uppercase tracking-tight mb-2">
                        {{ $album->title }}
                    </h3>
                    @if ($album->description)
                        <p class="text-gray-500 font-body text-sm line-clamp-2 italic">{{ $album->description }}</p>
                    @endif
                </a>
            @empty
                <div class="col-span-3 text-center py-20">
                    <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">photo_library</span>
                    <p class="text-gray-400 font-tegas uppercase tracking-wider">
                        {{ __('messages.gallery.empty') }}
                    </p>
                </div>
            @endforelse
        </div>
    </main> --}}
@endsection
