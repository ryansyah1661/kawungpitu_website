<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Hash;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengguna')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        // Kolom Password Utama
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->label('Password')
                            ->maxLength(255)
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            // Password hanya di-update ke database jika kolom ini diisi Qi!
                            ->dehydrated(fn($state) => filled($state))
                            // Hanya wajib diisi saat membuat user baru (create context)
                            ->required(fn(string $context): bool => $context === 'create')
                            // Memastikan input harus sama dengan kolom password_confirmation
                            ->confirmed(),

                        // Kolom Konfirmasi Password Baru
                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            ->label('Konfirmasi Password')
                            ->maxLength(255)
                            // Mengikuti aturan kolom utama, hanya wajib diisi saat create
                            ->required(fn(string $context): bool => $context === 'create')
                            // Dikunci false agar data konfirmasi tidak ikut dikirim merusak database
                            ->dehydrated(false),

                        Forms\Components\Select::make('role')
                            ->label('Level Akses')
                            ->options([
                                'admin' => 'Admin Utama',
                                'contributor' => 'Kontributor',
                            ])
                            ->required()
                            ->default('contributor'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Menampilkan Nama
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pengguna')
                    ->searchable()
                    ->sortable(),

                // Menampilkan Email
                Tables\Columns\TextColumn::make('email')
                    ->label('Alamat Email')
                    ->searchable(),

                // Menampilkan Role dengan Badge biar berwarna
                Tables\Columns\TextColumn::make('role')
                    ->label('Level Akses')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'admin' => 'danger',        // Merah buat Admin
                        'contributor' => 'success', // Hijau buat Kontributor
                        default => 'gray',
                    })
                    ->sortable(),

                // Menampilkan kapan akun dibuat
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Daftar Sejak')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
