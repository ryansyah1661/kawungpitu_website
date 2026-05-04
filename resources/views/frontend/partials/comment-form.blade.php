<section class="mt-20 border-t border-gray-100 pt-16 mb-20"> <div class="max-w-3xl">
        <div class="flex items-center space-x-4 mb-10">
            <span class="material-symbols-outlined text-primary text-3xl">forum</span>
            <h3 class="font-tegas text-2xl font-black text-primary uppercase tracking-tight">Kirim Tanggapan</h3>
        </div>

        <form action="#" method="POST" class="space-y-8">
            <div class="space-y-3">
                <label class="text-xs font-tegas font-bold text-primary uppercase tracking-widest ml-1">Komentar *</label>
                <textarea rows="6" 
                    class="w-full bg-white border-2 border-gray-200 focus:border-primary/30 focus:ring-0 rounded-3xl p-6 font-body text-dark transition-all outline-none shadow-sm hover:border-gray-300" 
                    placeholder="Tuliskan pemikiran atau pertanyaan Anda di sini..."></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="text-xs font-tegas font-bold text-primary uppercase tracking-widest ml-1">Nama Lengkap *</label>
                    <input type="text" 
                        class="w-full bg-white border-2 border-gray-200 focus:border-primary/30 focus:ring-0 rounded-2xl px-6 py-4 font-body text-dark transition-all outline-none shadow-sm hover:border-gray-300" 
                        placeholder="Syauqi...">
                </div>
                <div class="space-y-3">
                    <label class="text-xs font-tegas font-bold text-primary uppercase tracking-widest ml-1">Alamat Email *</label>
                    <input type="email" 
                        class="w-full bg-white border-2 border-gray-200 focus:border-primary/30 focus:ring-0 rounded-2xl px-6 py-4 font-body text-dark transition-all outline-none shadow-sm hover:border-gray-300" 
                        placeholder="email@contoh.com">
                </div>
            </div>

            <div class="flex items-center space-x-3 py-2 ml-1">
                <input type="checkbox" class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary/20">
                <p class="text-sm text-gray-500 font-medium italic">Simpan nama dan email saya untuk komentar berikutnya.</p>
            </div>

            <div class="pt-4">
                <button type="submit" class="group bg-primary text-white font-tegas font-black uppercase tracking-widest px-10 py-5 rounded-2xl hover:bg-[#320002] hover:scale-105 transition-all shadow-xl shadow-primary/20 flex items-center">
                    Kirim Komentar
                    <span class="material-symbols-outlined ml-3 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform duration-300">send</span>
                </button>
            </div>
        </form>
    </div>
</section>