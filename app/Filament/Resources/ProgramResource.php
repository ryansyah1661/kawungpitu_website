<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Set;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProgramResource extends Resource
{
    use Translatable;

    protected static ?string $model = Program::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Pembelajaran';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Program';
    protected static ?string $modelLabel = 'Program';
    protected static ?string $pluralModelLabel = 'Program';

    // 🔐 HAK AKSES MENU: Admin & Kontributor bisa lihat menu ini
    public static function canViewAny(): bool
    {
        return in_array(auth()->user()->role, ['admin', 'contributor']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make('Konten Materi')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul Materi')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255)
                                    ->helperText('Slug otomatis terisi dari judul.'),

                                TextInput::make('author_name')
                                    ->label('Nama Penulis')
                                    ->placeholder('Contoh: Tim Kawungpitu')
                                    ->required(),

                                Hidden::make('user_id')
                                    ->default(auth()->id()),

                                Textarea::make('excerpt')
                                    ->label('Ringkasan')
                                    ->rows(3)
                                    ->maxLength(500),

                                RichEditor::make('body')
                                    ->label('Isi Materi')
                                    ->required()
                                    ->columnSpanFull()
                                    ->fileAttachmentsDirectory('programs/attachments'),
                            ]),

                        Section::make('Statistik & Bukti Pentagon Aset')
                            ->description('Input skor (0-100) dan berikan narasi bukti untuk tiap pilar ketangguhan.')
                            ->schema([
                                // Modal Manusia
                                Group::make([
                                    TextInput::make('human_capital')
                                        ->label('Skor Modal Manusia')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->default(0)
                                        ->suffix('%')
                                        ->helperText('Input skor antara 0-100 berdasarkan penilaian Anda'),
                                    Textarea::make('human_capital_note')
                                        ->label('Bukti Teks (Manusia)')
                                        ->placeholder('Contoh: Warga telah mengikuti pelatihan sertifikasi...')
                                        ->rows(2),
                                ])->columns(1),

                                // Modal Sosial
                                Group::make([
                                    TextInput::make('social_capital')
                                        ->label('Skor Modal Sosial')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->default(0)
                                        ->suffix('%')
                                        ->helperText('Input skor antara 0-100 berdasarkan penilaian Anda'),
                                    Textarea::make('social_capital_note')
                                        ->label('Bukti Teks (Sosial)')
                                        ->placeholder('Contoh: Memperkuat gotong royong...')
                                        ->rows(2),
                                ])->columns(1),

                                // Modal Alam
                                Group::make([
                                    TextInput::make('natural_capital')
                                        ->label('Skor Modal Alam')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->default(0)
                                        ->suffix('%')
                                        ->helperText('Input skor antara 0-100 berdasarkan penilaian Anda'),
                                    Textarea::make('natural_capital_note')
                                        ->label('Bukti Teks (Alam)')
                                        ->placeholder('Contoh: Konservasi wilayah pesisir...')
                                        ->rows(2),
                                ])->columns(1),

                                // Modal Fisik
                                Group::make([
                                    TextInput::make('physical_capital')
                                        ->label('Skor Modal Fisik')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->default(0)
                                        ->suffix('%')
                                        ->helperText('Input skor antara 0-100 berdasarkan penilaian Anda'),
                                    Textarea::make('physical_capital_note')
                                        ->label('Bukti Teks (Fisik)')
                                        ->placeholder('Contoh: Pembangunan gudang alat...')
                                        ->rows(2),
                                ])->columns(1),

                                // Modal Finansial
                                Group::make([
                                    TextInput::make('financial_capital')
                                        ->label('Skor Modal Finansial')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->default(0)
                                        ->suffix('%')
                                        ->helperText('Input skor antara 0-100 berdasarkan penilaian Anda'),
                                    Textarea::make('financial_capital_note')
                                        ->label('Bukti Teks (Finansial)')
                                        ->placeholder('Contoh: Peningkatan pendapatan...')
                                        ->rows(2),
                                ])->columns(1),
                            ])->columns(2),

                        Section::make('Media')
                            ->schema([
                                TextInput::make('video_url')
                                    ->label('URL Video YouTube')
                                    ->url()
                                    ->placeholder('https://www.youtube.com/watch?v=...')
                                    ->helperText('URL lengkap video YouTube'),

                                FileUpload::make('pdf_file')
                                    ->label('File PDF')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->directory('programs/pdf')
                                    ->visibility('public')
                                    ->maxSize(10240)
                                    ->helperText('Maks. 10MB'),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Pengaturan')
                            ->schema([
                                Select::make('categories')
                                    ->label('Kategori')
                                    ->multiple()
                                    ->relationship(
                                        name: 'categories',
                                        titleAttribute: 'name',
                                        modifyQueryUsing: fn($query) => $query->where('type', 'program')
                                    )
                                    ->getOptionLabelFromRecordUsing(fn($record) => $record->getTranslation('name', app()->getLocale()))
                                    ->required()
                                    ->preload()
                                    ->searchable(),

                                Select::make('status')
                                    ->label('Status Program')
                                    ->options([
                                        'ongoing' => 'Sedang Berjalan',
                                        'completed' => 'Selesai',
                                    ])
                                    ->default('ongoing')
                                    ->required(),

                                // Status Persetujuan (3 Opsi)
                                Select::make('approval_status')
                                    ->label('Status Persetujuan Admin')
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

                                // Catatan Penolakan (Sudah difix tanpa koma nyasar)
                                Textarea::make('rejection_note')
                                    ->label('Catatan Penolakan / Evaluasi')
                                    ->rows(3)
                                    ->placeholder('Belum ada catatan evaluasi.')
                                    ->helperText('Catatan dari admin jika materi program ini perlu direvisi.')
                                    ->visible(fn ($get) => $get('approval_status') === 'rejected')
                                    ->disabled(fn () => auth()->user()->role !== 'admin')
                                    ->dehydrated(),

                                Toggle::make('is_published')
                                    ->label('Dipublikasikan')
                                    ->default(false)
                                    ->live()
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        if ($state) {
                                            $set('published_at', now()->format('Y-m-d H:i:s'));
                                        } else {
                                            $set('published_at', null);
                                        }
                                    }),

                                DateTimePicker::make('published_at')
                                    ->label('Tanggal Publish')
                                    ->displayFormat('d/m/Y H:i'),
                            ]),

                        Section::make('Gambar')
                            ->schema([
                                FileUpload::make('featured_image')
                                    ->label('Gambar Utama')
                                    ->image()
                                    ->directory('programs')
                                    ->visibility('public'),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Gambar')
                    ->width(80)
                    ->height(45),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Kategori')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(function (string $state, $livewire): string {
                        $locale = $livewire->activeLocale ?? app()->getLocale();
                        return match ($state) {
                            'ongoing' => __('messages.program.ongoing', [], $locale),
                            'completed' => __('messages.program.completed', [], $locale),
                            default => $state,
                        };
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'ongoing' => 'warning',
                        'completed' => 'success',
                        default => 'gray',
                    }),

                // Badge Status Persetujuan di Tabel (Kuning, Hijau, Merah)
                Tables\Columns\TextColumn::make('approval_status')
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
                    ->label('Publish')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categories')
                    ->label('Kategori')
                    ->multiple()
                    ->relationship('categories', 'name', fn($query) => $query->where('type', 'program'))
                    ->preload(),
                
                Tables\Filters\SelectFilter::make('approval_status')
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
                    ->hidden(fn ($record) => $record->approval_status === 'approved')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update([
                            'approval_status' => 'approved',
                            'rejection_note' => null,
                        ]);
                    }),

                // Tombol Tolak khusus Admin + Alasan Penolakan
                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn () => auth()->user()->role === 'admin')
                    ->hidden(fn ($record) => $record->approval_status === 'rejected')
                    ->form([
                        Forms\Components\Textarea::make('rejection_note')
                            ->label('Alasan Penolakan / Catatan Evaluasi')
                            ->required()
                            ->placeholder('Tulis alasan kenapa program ini belum layak di-approve...'),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'approval_status' => 'rejected',
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}