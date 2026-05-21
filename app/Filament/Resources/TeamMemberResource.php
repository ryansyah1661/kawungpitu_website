<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;

class TeamMemberResource extends Resource
{
    use Translatable;

    protected static ?string $model = TeamMember::class;
    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationLabel = 'Tim & Advisor';
    protected static ?string $modelLabel = 'Tim & Advisor';
    protected static ?string $pluralModelLabel = 'Anggota Tim';
    protected static ?string $navigationGroup = 'Profil Lembaga';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Lengkap')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('role')
                        ->label('Jabatan')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('type')
                        ->label('Tipe Anggota')
                        ->options([
                            'advisor' => 'Dewan Penasehat',
                            'structure' => 'Eksekutif',
                        ])
                        ->required()
                        ->native(false)
                        ->live(),

                    Forms\Components\Textarea::make('description')
                        ->label('Keterangan Singkat')
                        ->rows(4)
                        ->maxLength(500)
                        ->hidden(fn(Forms\Get $get) => $get('type') !== 'advisor'),
                        ])->columnSpan(2),

                Forms\Components\Section::make('Media & Pengaturan')->schema([
                    Forms\Components\FileUpload::make('photo')
                        ->label('Foto Profil')
                        ->image()
                        ->directory('team-photos')
                        ->nullable()
                        ->helperText('Kosongkan jika ingin menggunakan foto profil default.'),

                    Forms\Components\Radio::make('gender')
                        ->label('Jenis Kelamin')
                        ->options([
                            'male' => 'Laki-laki',
                            'female' => 'Perempuan',
                        ])
                        ->required() // Sebaiknya wajib isi biar logika foto default jalan
                        ->inline() // Tampilkan ke samping, nggak ke bawah
                        ->columnSpanFull(), // Penuhi satu baris


                    Forms\Components\TextInput::make('sort_order')
                        ->label('Nomor Urut')
                        ->numeric()
                        ->default(0)
                        ->helperText('Bisa diatur manual atau drag-and-drop di tabel daftar.'),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            // FITUR BARU: Sekarang kamu bisa tarik-ulur (drag-drop) urutan di tabel
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc')
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    // Menangani tampilan jika foto kosong di admin
                    ->defaultImageUrl(asset('images/default-profile.svg')),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('role')
                    ->label('Jabatan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge() // Menggunakan badge modern Filament 3
                    ->color(fn(string $state): string => match ($state) {
                        'advisor' => 'warning',
                        'structure' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'advisor' => 'Advisor',
                        'structure' => 'Eksekutif',
                    }),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit' => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
