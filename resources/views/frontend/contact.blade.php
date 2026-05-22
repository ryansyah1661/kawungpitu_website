@extends('frontend.layouts.app')
@section('title', __('messages.navbar.contact'))

@section('content')
    <header class="bg-cream pt-40 pb-24 px-8 md:px-12 border-b border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto relative">
            <div class="relative z-10">
                {{-- FIX RESPONSIVE FONT SIZE --}}
                <h1
                    class="font-tegas text-3xl sm:text-4xl md:text-6xl lg:text-7xl font-black mb-10 uppercase tracking-tighter animate-fade-in-left w-fit text-left">
                    <span class="bg-white text-dark px-6 pr-20 py-2 block mb-2 w-full shadow-xl shadow-primary/5">
                        {{ __('messages.contact.header_1') }}
                    </span>
                    <span class="bg-primary text-white px-6 pr-20 py-2 block w-full shadow-xl shadow-primary/10">
                        {{ __('messages.contact.header_2') }}
                    </span>
                </h1>

                <div class="flex items-start space-x-6 animate-fade-in-left" style="animation-delay: 0.3s;">
                    <div class="w-1.5 h-20 bg-primary/20 rounded-full hidden md:block"></div>
                    <p class="text-lg md:text-xl text-primary font-medium max-w-2xl leading-relaxed italic opacity-90">
                        {{ __('messages.contact.description') }}
                    </p>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-8 md:px-12 py-24 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24">

            <div class="lg:col-span-7 animate-fade-up" style="animation-delay: 0.5s;">
                <div
                    class="bg-white p-10 lg:p-14 rounded-[40px] border-4 border-gray-100 shadow-xl shadow-primary/5 relative overflow-hidden">
                    <h2 class="font-tegas text-3xl font-black text-primary uppercase tracking-tight mb-10">
                        {{ __('messages.contact.form_title') }}
                    </h2>

                    @if (session('success'))
                        <div
                            class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-8 flex items-center space-x-3">
                            <span class="material-symbols-outlined text-green-500">check_circle</span>
                            <span class="font-body">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl mb-8">
                            <ul class="list-disc list-inside font-body text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kontak.store', ['locale' => app()->getLocale()]) }}" method="POST"
                        class="space-y-8 relative z-10 font-body">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-[10px] font-tegas font-bold text-primary uppercase tracking-widest ml-1">
                                    {{ __('messages.contact.label_name') }} *
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="w-full bg-gray-50 border-2 {{ $errors->has('name') ? 'border-red-300' : 'border-gray-100' }} focus:border-primary/30 focus:ring-0 rounded-2xl px-6 py-4 transition-all outline-none"
                                    placeholder="{{ __('messages.contact.placeholder_name') }}" required>
                            </div>
                            <div class="space-y-3">
                                <label class="text-[10px] font-tegas font-bold text-primary uppercase tracking-widest ml-1">
                                    {{ __('messages.contact.label_email') }} *
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="w-full bg-gray-50 border-2 {{ $errors->has('email') ? 'border-red-300' : 'border-gray-100' }} focus:border-primary/30 focus:ring-0 rounded-2xl px-6 py-4 transition-all outline-none"
                                    placeholder="{{ __('messages.contact.placeholder_email') }}" required>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-tegas font-bold text-primary uppercase tracking-widest ml-1">
                                {{ __('messages.contact.label_subject') }}
                            </label>
                            <input type="text" name="subject" value="{{ old('subject') }}"
                                class="w-full bg-gray-50 border-2 {{ $errors->has('subject') ? 'border-red-300' : 'border-gray-100' }} focus:border-primary/30 focus:ring-0 rounded-2xl px-6 py-4 transition-all outline-none"
                                placeholder="{{ __('messages.contact.placeholder_subject') }}" required>
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-tegas font-bold text-primary uppercase tracking-widest ml-1">
                                {{ __('messages.contact.label_message') }} *
                            </label>
                            <textarea rows="5" name="message"
                                class="w-full bg-gray-50 border-2 {{ $errors->has('message') ? 'border-red-300' : 'border-gray-100' }} focus:border-primary/30 focus:ring-0 rounded-3xl p-6 transition-all outline-none"
                                placeholder="{{ __('messages.contact.placeholder_message') }}" required>{{ old('message') }}</textarea>
                        </div>
                        <button type="submit"
                            class="group bg-primary text-white font-tegas font-black uppercase tracking-widest px-10 py-5 rounded-2xl hover:bg-[#320002] hover:scale-105 transition-all shadow-xl shadow-primary/20 flex items-center justify-center w-full md:w-auto">
                            {{ __('messages.contact.btn_send') }}
                            <span
                                class="material-symbols-outlined ml-3 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform">send</span>
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col gap-12 animate-fade-up" style="animation-delay: 0.7s;">
                <div class="space-y-12">
                    <div class="flex items-start space-x-6">
                        <div
                            class="w-14 h-14 bg-cream rounded-2xl flex items-center justify-center flex-shrink-0 text-primary shadow-sm border border-primary/5">
                            <span class="material-symbols-outlined text-3xl">location_on</span>
                        </div>
                        <div>
                            <h3 class="font-tegas text-xl font-black text-primary uppercase tracking-tight mb-2">
                                {{ __('messages.contact.office_address') }}
                            </h3>
                            <p class="text-gray-500 font-body leading-relaxed">Jl. Mawar Raya No.16, Lt 2, RT.08/RW.08,
                                Curugmekar, Kec. Bogor Bar., Kota Bogor, Jawa Barat 16113</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-6">
                        <div
                            class="w-14 h-14 bg-cream rounded-2xl flex items-center justify-center flex-shrink-0 text-primary shadow-sm border border-primary/5">
                            <span class="material-symbols-outlined text-3xl">mail</span>
                        </div>
                        <div>
                            <h3 class="font-tegas text-xl font-black text-primary uppercase tracking-tight mb-2">
                                {{ __('messages.contact.official_email') }}
                            </h3>
                            <a href="mailto:info@kawungpitu.com"
                                class="text-gray-500 font-body hover:text-primary transition-colors block">info@kawungpitu.com</a>
                        </div>
                    </div>

                    <div class="flex items-start space-x-6">
                        <div
                            class="w-14 h-14 bg-cream rounded-2xl flex items-center justify-center flex-shrink-0 text-primary shadow-sm border border-primary/5">
                            <span class="material-symbols-outlined text-3xl">share</span>
                        </div>
                        <div>
                            <h3 class="font-tegas text-xl font-black text-primary uppercase tracking-tight mb-4">
                                {{ __('messages.contact.social_media') }}
                            </h3>
                            <div class="flex space-x-4 text-primary">
                                <a href="https://id.linkedin.com/company/kawungpituinstitute" title="LinkedIn"
                                    class="w-10 h-10 bg-white border-2 border-gray-100 rounded-xl flex items-center justify-center hover:bg-primary hover:text-white transition-all shadow-sm">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                                <a href="https://www.instagram.com/kawungpitu_id/" title="Instagram"
                                    class="w-10 h-10 bg-white border-2 border-gray-100 rounded-xl flex items-center justify-center hover:bg-primary hover:text-white transition-all shadow-sm">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                                <a href="mailto:info@kawungpitu.com" title="Kirim Email"
                                    class="w-10 h-10 bg-white border-2 border-gray-100 rounded-xl flex items-center justify-center hover:bg-primary hover:text-white transition-all shadow-sm">
                                    <i class="fa-solid fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="http://maps.google.com/maps?q=Kawung+Pitu+Institute" target="_blank" rel="noopener noreferrer"
                    class="flex-grow rounded-[40px] overflow-hidden border-4 border-gray-100 shadow-xl shadow-primary/5 min-h-[300px] relative group cursor-pointer block">

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.535817290632!2d106.75629167448574!3d-6.580092493413348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5123d45595d%3A0xc38d8d73b061d4a0!2sJl.%20Mawar%20Raya%20No.16%2C%20Curugmekar%2C%20Kec.%20Bogor%20Bar.%2C%20Kota%20Bogor%2C%20Jawa%20Barat%2016113!5e0!3m2!1sid!2sid!4v1714280000000!5m2!1sid!2sid"
                        class="w-full h-full absolute inset-0 border-0 grayscale group-hover:grayscale-0 transition-all duration-700 pointer-events-none"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <div
                        class="absolute inset-0 bg-primary/10 group-hover:bg-transparent transition-all duration-500 flex items-center justify-center">
                        <div
                            class="bg-white px-8 py-3 rounded-full shadow-xl transform group-hover:scale-110 transition-transform duration-300 flex items-center space-x-3">
                            <span class="material-symbols-outlined text-primary text-xl">directions</span>
                            <span class="font-tegas font-black text-primary text-xs uppercase tracking-widest">
                                {{ __('messages.contact.get_directions') }}
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </main>
@endsection
