<x-filament-panels::page>
    <div class="mx-auto w-full max-w-2xl">
        <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            
            <!-- Header Card -->
            <div class="border-b border-gray-100 dark:border-white/5 px-6 py-4">
                <h2 class="text-lg font-bold text-gray-950 dark:text-white">
                    Pengaturan Profil
                </h2>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Kelola informasi akun, kata sandi, dan foto profil Anda.
                </p>
            </div>

            <form wire:submit="save">
                <!-- Wrapper Form -->
                <div class="p-6">
                    {{ $this->form }}
                </div>

                <!-- Footer Aksi -->
                <div class="flex justify-end items-center gap-3 border-t border-gray-100 dark:border-white/5 bg-gray-50 dark:bg-gray-950/20 px-6 py-4">
                    <x-filament::button
                        tag="a"
                        :href="url()->previous()"
                        color="gray"
                        size="sm">
                        Batal
                    </x-filament::button>

                    <x-filament::button
                        type="submit"
                        color="primary"
                        size="sm">
                        Perbarui Profil
                    </x-filament::button>
                </div>
            </form>

        </div>
    </div>
</x-filament-panels::page>