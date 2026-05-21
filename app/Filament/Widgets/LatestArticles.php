<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Filament\Resources\ArticleResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestArticles extends BaseWidget
{
    protected static ?int $sort = 2;
    /**
     * 1. Mengatur lebar widget agar memenuhi halaman bawah (Full Width)
     * Posisinya otomatis akan berada di bawah 3 kartu statistik kemarin Qi.
     */
    protected int | string | array $columnSpan = 'full';

    /**
     * 2. Mengatur judul tabel yang muncul di dasbor
     */
    protected static ?string $heading = 'Artikel Terbaru';

    /**
     * 3. Merakit isi query data dan kolom tabel
     */
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Article::query()->latest()->limit(5)
            )
            ->columns([
                // 1. Kolom Judul (Kita perkecil ukurannya biar estetik)
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Artikel')
                    ->size('sm')
                    ->weight('medium')
                    ->wrap(),

                // 2. Kolom Views (Menambah kepadatan data biar gak kosong)
                Tables\Columns\TextColumn::make('views')
                    ->label('Dilihat')
                    ->icon('heroicon-m-eye')
                    ->iconColor('gray')
                    ->alignCenter(),

                // 3. Kolom Tanggal Rilis
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Rilis')
                    ->dateTime('d M Y')
                    ->badge()
                    ->color('gray'),
            ])
            ->actions([
                // PERBAIKAN: Mengubah tombol jadi Icon Button super clean & minimalis
                Tables\Actions\Action::make('edit')
                    ->label('Ubah')
                    ->icon('heroicon-m-pencil-square')
                    ->iconButton() // <--- Mengganti format tombol gemuk jadi ikon bulat clean
                    ->color('gray')
                    ->tooltip('Ubah Artikel')
                    ->url(fn(Article $record): string => ArticleResource::getUrl('edit', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
