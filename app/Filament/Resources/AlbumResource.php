<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlbumResource\Pages;
use App\Filament\Resources\AlbumResource\RelationManagers;
use App\Models\Album;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AlbumResource extends Resource
{
    use Translatable;

    protected static ?string $model = Album::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Galeri';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Album';
    protected static ?string $modelLabel = 'Album';
    protected static ?string $pluralModelLabel = 'Album';

    // 🔐 HAK AKSES MENU: Admin & Kontributor bisa lihat menu ini
    public static function canViewAny(): bool
    {
        return in_array(auth()->user()->role, ['admin', 'contributor']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Album')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Album')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('Slug otomatis terisi dari judul album.'),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->maxLength(500),

                        Forms\Components\FileUpload::make('cover_image')
                            ->label('Gambar Cover')
                            ->image()
                            ->directory('albums/covers')
                            ->visibility('public'),
                    ])->columns(2),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        // Input status (3 pilihan). Hanya admin yang bisa ubah lewat form
                        Forms\Components\Select::make('status')
                            ->label('Status Persetujuan')
                            ->options([
                                'pending' => 'Pending (Menunggu)',
                                'approved' => 'Approved (Disetujui)',
                                'rejected' => 'Rejected (Ditolak)',
                            ])
                            ->default('pending')
                            ->required()
                            ->disabled(fn () => auth()->user()->role !== 'admin')
                            ->live()
                            ->dehydrated(),

                        // Catatan penolakan album. Muncul otomatis kalau statusnya 'rejected'
                        Forms\Components\Textarea::make('rejection_note')
                            ->label('Catatan Penolakan / Evaluasi')
                            ->rows(3)
                            ->placeholder('Belum ada catatan evaluasi.')
                            ->helperText('Catatan dari admin jika album foto ini butuh revisi.')
                            ->visible(fn ($get) => $get('status') === 'rejected')
                            ->disabled(fn () => auth()->user()->role !== 'admin')
                            ->dehydrated(),

                        Forms\Components\Toggle::make('is_published')
                            ->label('Dipublikasikan')
                            ->default(false)
                            ->visible(fn () => auth()->user()->role === 'admin')
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Cover')
                    ->width(80)
                    ->height(45),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('photos_count')
                    ->label('Jumlah Foto')
                    ->counts('photos')
                    ->sortable()
                    ->alignCenter(),

                // Menampilkan Badge Status Persetujuan di Tabel (Kuning, Hijau, Merah)
                Tables\Columns\TextColumn::make('status')
                    ->label('Persetujuan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Status')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Status Publish'),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status Persetujuan')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
            ])
            ->actions([
                // Tombol Approve khusus Admin
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn () => auth()->user()->role === 'admin')
                    ->hidden(fn ($record) => $record->status === 'approved')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'approved',
                            'rejection_note' => null,
                        ]);
                    }),

                // Tombol Tolak khusus Admin + Alasan Penolakan
                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn () => auth()->user()->role === 'admin')
                    ->hidden(fn ($record) => $record->status === 'approved')
                    ->form([
                        Forms\Components\Textarea::make('rejection_note')
                            ->label('Alasan Penolakan / Catatan Evaluasi')
                            ->required()
                            ->placeholder('Tulis alasan penolakan album foto agar kontributor mengetahuinya...'),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'rejection_note' => $data['rejection_note'],
                        ]);
                    }),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PhotosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlbums::route('/'),
            'create' => Pages\CreateAlbum::route('/create'),
            'edit' => Pages\EditAlbum::route('/{record}/edit'),
        ];
    }
}