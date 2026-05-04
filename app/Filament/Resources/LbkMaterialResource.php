<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LbkMaterialResource\Pages;
use App\Models\LbkMaterial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LbkMaterialResource extends Resource
{
    use Translatable;

    protected static ?string $model = LbkMaterial::class;
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
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Konten Materi')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Materi')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255)
                                    ->helperText('Ketik manual slug untuk URL program ini.'),

                                Forms\Components\TextInput::make('author_name')
                                    ->label('Nama Penulis')
                                    ->placeholder('Contoh: Tim Kawungpitu')
                                    ->required(),

                                Forms\Components\Hidden::make('user_id')
                                    ->default(auth()->id()),

                                Forms\Components\Textarea::make('excerpt')
                                    ->label('Ringkasan')
                                    ->rows(3)
                                    ->maxLength(500),

                                Forms\Components\RichEditor::make('body')
                                    ->label('Isi Materi')
                                    ->required()
                                    ->columnSpanFull()
                                    ->fileAttachmentsDirectory('lbk/attachments'),
                            ]),

                        Forms\Components\Section::make('Media')
                            ->schema([
                                Forms\Components\TextInput::make('video_url')
                                    ->label('URL Video YouTube')
                                    ->url()
                                    ->placeholder('https://www.youtube.com/watch?v=...')
                                    ->helperText('URL lengkap video YouTube'),

                                Forms\Components\FileUpload::make('pdf_file')
                                    ->label('File PDF')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->directory('lbk/pdf')
                                    ->visibility('public')
                                    ->maxSize(10240)
                                    ->helperText('Maks. 10MB'),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Pengaturan')
                            ->schema([
                                Forms\Components\Select::make('category_id')
                                    ->label('Kategori')
                                    ->relationship('category', 'name', fn($query) => $query->where('type', 'lbk'))
                                    ->getOptionLabelFromRecordUsing(fn($record) => $record->name)
                                    ->required()
                                    ->preload()
                                    ->searchable(),

                                Forms\Components\Select::make('status')
                                    ->label('Status Program')
                                    ->options([
                                        'ongoing' => 'Sedang Berjalan',
                                        'completed' => 'Selesai',
                                    ])
                                    ->default('ongoing')
                                    ->required(),

                                Forms\Components\Toggle::make('is_published')
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
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Tanggal Publish')
                                    ->displayFormat('d/m/Y H:i'),

                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Urutan')
                                    ->numeric()
                                    ->default(0),
                            ]),

                        Forms\Components\Section::make('Gambar')
                            ->schema([
                                Forms\Components\FileUpload::make('featured_image')
                                    ->label('Gambar Utama')
                                    ->image()
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('16:9')
                                    ->imageResizeTargetWidth('1200')
                                    ->imageResizeTargetHeight('675')
                                    ->directory('lbk')
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
                    ->falseColor('gray')
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('pdf_file')
                    ->label('PDF')
                    ->boolean()
                    ->getStateUsing(fn($record) => !empty($record->pdf_file))
                    ->trueIcon('heroicon-o-document-arrow-down')
                    ->falseIcon('heroicon-o-minus-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'ongoing' => 'Berjalan',
                        'completed' => 'Selesai',
                        default => $state,
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'ongoing' => 'success',
                        'completed' => 'info',
                        default => 'gray',
                    }),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publish')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urut')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name', fn($query) => $query->where('type', 'lbk'))
                    ->preload(),

                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Status Publish'),
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
            ->defaultSort('sort_order');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLbkMaterials::route('/'),
            'create' => Pages\CreateLbkMaterial::route('/create'),
            'edit' => Pages\EditLbkMaterial::route('/{record}/edit'),
        ];
    }
}
