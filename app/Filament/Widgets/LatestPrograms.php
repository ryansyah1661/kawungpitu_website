<?php

namespace App\Filament\Widgets;

use App\Models\Program;
use App\Filament\Resources\ProgramResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPrograms extends BaseWidget
{
    protected static ?int $sort = 3;

    // PERBAIKAN UI: Kita hapus 'full' agar ukurannya membagi dua (50% layar)
    protected int | string | array $columnSpan = 1;

    protected static ?string $heading = 'Program Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Program::query()->latest()->limit(5)
            )
            ->headerActions([
                // PERBAIKAN UI: Menambah shortcut link langsung di bar judul tabel
                Tables\Actions\Action::make('view_all')
                    ->label('Lihat Semua')
                    ->url(ProgramResource::getUrl('index'))
                    ->button()
                    ->size('xs')
                    ->color('gray'),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Nama Program')
                    ->size('sm')
                    ->weight('medium')
                    ->wrap(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'ongoing' => 'primary',
                        'completed' => 'success',
                        default => 'gray',
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->icon('heroicon-m-pencil-square')
                    ->iconButton()
                    ->color('gray')
                    ->tooltip('Ubah Program')
                    ->url(fn(Program $record): string => ProgramResource::getUrl('edit', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
