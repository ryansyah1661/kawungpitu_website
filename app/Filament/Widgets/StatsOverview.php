<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Program;
use App\Models\Album;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
       return [
            // 1. Statistik Total Artikel (Ditambah query())
            Stat::make('Total Artikel', Article::query()->count())
                ->description('Artikel/Wawasan terbit')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),

            // 2. Statistik Total Program (Ditambah query())
            Stat::make('Total Program', Program::query()->count())
                ->description('Pilar kerja & kegiatan')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),

            // 3. Statistik Total Album Galeri (Ditambah query())
            Stat::make('Total Album Galeri', Album::query()->count())
                ->description('Dokumentasi lapangan')
                ->descriptionIcon('heroicon-m-photo')
                ->color('warning'),
        ];
    }
}