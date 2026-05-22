<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Program;
use App\Models\Album;
use App\Models\Pesan; // <--- Sesuaikan nama Model Pesan/Kontak kamu ya Qi jika beda
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            // 1. Total Artikel Aktif
            Stat::make('Total Artikel Aktif', Article::query()->count())
                ->description('Artikel/Wawasan terbit')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),

            // 2. Total Program Sedang Berjalan
            Stat::make('Program Sedang Berjalan', Program::query()->count()) // Kalau ada status tinggal tambahkan: ->where('status', 'ongoing')
                ->description('Pilar kerja & kegiatan aktif')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),

            // 3. Pesan Kontak Masuk Belum Dibaca
            // Catatan: Jika di DB nama modelnya 'Contact' atau 'Message', tinggal ganti 'Pesan' di atas ya Qi
            Stat::make('Pesan Masuk Belum Dibaca', class_exists(Pesan::class) ? Pesan::query()->count() : 0)
                ->description('Perlu respon cepat')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger'),

            // 4. Total Album Galeri (Tetap dipertahankan biar genap 4 kolom pas penuh)
            Stat::make('Total Album Galeri', Album::query()->count())
                ->description('Dokumentasi lapangan')
                ->descriptionIcon('heroicon-m-photo')
                ->color('warning'),
        ];
    }
}
