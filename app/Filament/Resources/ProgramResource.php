<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Slider;
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
use Illuminate\Database\Eloquent\Builder;

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
                                    ->maxLength(255),

                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255)
                                    ->helperText('Ketik manual slug untuk URL program ini.'),

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

                        Section::make('Statistik Pentagon Aset')
                            ->description('Input skor 1-100 untuk membangun ketangguhan menyeluruh komunitas')
                            ->schema([
                                Slider::make('human_capital')
                                    ->label('Modal Manusia')
                                    ->helperText('Pelatihan teknis, pendidikan kritis, literasi kesehatan')
                                    ->min(0)->max(100)->default(0),

                                Slider::make('social_capital')
                                    ->label('Modal Sosial')
                                    ->helperText('Pendampingan koperasi, penguatan lembaga adat, kolaborasi')
                                    ->min(0)->max(100)->default(0),

                                Slider::make('natural_capital')
                                    ->label('Modal Alam')
                                    ->helperText('Konservasi pesisir Anambas, hutan desa, pertanian berkelanjutan')
                                    ->min(0)->max(100)->default(0),

                                Slider::make('physical_capital')
                                    ->label('Modal Fisik')
                                    ->helperText('Pengolahan sampah, air bersih, alat produksi tepat guna')
                                    ->min(0)->max(100)->default(0),

                                Slider::make('financial_capital')
                                    ->label('Modal Finansial')
                                    ->helperText('Unit usaha desa, keuangan mikro, diversifikasi pendapatan')
                                    ->min(0)->max(100)->default(0),
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
                                Select::make('category_id')
                                    ->label('Kategori')
                                    ->relationship('category', 'name', fn($query) => $query->where('type', 'program'))
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

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->sortable(),

                Tables\Columns\IconColumn::make('video_url')
                    ->label('Video')
                    ->boolean()
                    ->getStateUsing(fn($record) => !empty($record->video_url))
                    ->trueIcon('heroicon-o-play-circle')
                    ->falseIcon('heroicon-o-minus-circle')
                    ->trueColor('info')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'ongoing' => 'warning',
                        'completed' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publish')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name', fn($query) => $query->where('type', 'program'))
                    ->preload(),
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
