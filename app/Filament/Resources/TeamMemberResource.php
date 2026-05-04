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
    // Aktifkan fitur 2 bahasa (Spatie Translatable)
    use Translatable;

    protected static ?string $model = TeamMember::class;

    // Ikon untuk di sidebar
    protected static ?string $navigationIcon = 'heroicon-o-users';

    // Ganti nama menu di sidebar
    protected static ?string $navigationLabel = 'Tim & Advisor';
    protected static ?string $pluralModelLabel = 'Anggota Tim';

    // Mau ditaruh di grup mana? Misal kita buat grup 'Profil Lembaga'
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
                            'advisor' => 'Advisor',
                            'structure' => 'Struktur Lembaga',
                        ])
                        ->required()
                        ->native(false)
                        ->live(), // Penting biar deskripsi bisa disembunyikan dinamis

                    Forms\Components\Textarea::make('description')
                        ->label('Keterangan Singkat')
                        ->rows(4)
                        ->maxLength(500)
                        // Keterangan cuma wajib/muncul kalau tipenya 'advisor'
                        ->hidden(fn(Forms\Get $get) => $get('type') !== 'advisor'),
                ])->columnSpan(2),

                Forms\Components\Section::make('Media & Pengaturan')->schema([
                    Forms\Components\FileUpload::make('photo')
                        ->label('Foto Profil')
                        ->image()
                        ->directory('team-photos') // Nanti fotonya masuk ke folder storage/app/public/team-photos
                        ->required(),

                    // Forms\Components\TextInput::make('sort_order')
                    //     ->label('Urutan Tampil')
                    //     ->numeric()
                    //     ->default(0)
                    //     ->helperText('Angka lebih kecil tampil lebih dulu (0, 1, 2, dst)'),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular(), // Biar fotonya bulet di tabel

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('role')
                    ->label('Jabatan')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('type')
                    ->label('Tipe')
                    ->colors([
                        'primary' => 'advisor',
                        'success' => 'structure',
                    ])
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'advisor' => 'Advisor',
                        'structure' => 'Struktur',
                    }),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            // Biar datanya urut otomatis berdasarkan sort_order
            ->defaultSort('sort_order', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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
