<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ArticleResource extends Resource
{
    use Translatable;

    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Artikel';
    protected static ?string $modelLabel = 'Artikel';
    protected static ?string $pluralModelLabel = 'Artikel';

    // 🔐 HAK AKSES MENU: Admin & Kontributor bisa lihat menu ini, tapi menu User dikunci khusus admin
    public static function canViewAny(): bool
    {
        return in_array(auth()->user()->role, ['admin', 'contributor']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Konten Artikel')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255)
                                    ->helperText('Slug otomatis terisi dari judul'),

                                Forms\Components\TextInput::make('author_name')
                                    ->label('Nama Penulis')
                                    ->required(),

                                Forms\Components\Hidden::make('user_id')
                                    ->default(auth()->id()),

                                Forms\Components\Textarea::make('excerpt')
                                    ->label('Ringkasan')
                                    ->rows(3)
                                    ->maxLength(500)
                                    ->helperText('Ringkasan singkat untuk tampilan card'),

                                Forms\Components\RichEditor::make('body')
                                    ->label('Isi Artikel')
                                    ->required()
                                    ->columnSpanFull()
                                    ->fileAttachmentsDirectory('articles/attachments'),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Pengaturan')
                            ->schema([
                                Forms\Components\Select::make('categories')
                                    ->label('Kategori')
                                    ->multiple()
                                    ->relationship(
                                        name: 'categories',
                                        titleAttribute: 'name',
                                        modifyQueryUsing: fn($query) => $query->where('type', 'article')
                                    )
                                    ->getOptionLabelFromRecordUsing(fn($record) => $record->getTranslation('name', app()->getLocale()))
                                    ->required()
                                    ->preload()
                                    ->searchable(),

                                // 🔥 FIX: Input status (3 pilihan). Hanya admin yang bisa ubah lewat form
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

                                // 🔥 FIX: Catatan penolakan. Muncul otomatis kalau statusnya 'rejected'
                                // Jadi kontributor bisa tahu alasan artikelnya ditolak pas buka halaman edit
                                Forms\Components\Textarea::make('rejection_note')
                                    ->label('Catatan Penolakan / Evaluasi')
                                    ->rows(3)
                                    ->placeholder('Belum ada catatan evaluasi.')
                                    ->helperText('Catatan dari admin jika artikel ini perlu diperbaiki.')
                                    ->visible(fn ($get) => $get('status') === 'rejected')
                                    ->disabled(fn () => auth()->user()->role !== 'admin')
                                    ->dehydrated(),

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
                            ]),

                        Forms\Components\Section::make('Gambar')
                            ->schema([
                                Forms\Components\FileUpload::make('featured_image')
                                    ->label('Gambar Utama')
                                    ->image()
                                    ->directory('articles')
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

                // 🔥 FIX: Menampilkan Badge Status Persetujuan di Tabel (Kuning, Hijau, Merah)
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
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tgl Publish')
                    ->dateTime('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('view_count')
                    ->label('Views')
                    ->sortable()
                    ->alignCenter(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categories')
                    ->label('Kategori')
                    ->multiple()
                    ->relationship('categories', 'name', fn($query) => $query->where('type', 'article'))
                    ->preload(),

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
                // 🔥 FIX: Tombol Approve khusus Admin (Sembunyi jika sudah di-approve)
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
                            'rejection_note' => null, // Hapus catatan penolakan lama jika akhirnya disetujui
                        ]);
                    }),

                // 🔥 FIX: TomBOL Tolak khusus Admin (Akan memunculkan pop-up modal untuk mengisi alasan ditolak)
                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn () => auth()->user()->role === 'admin')
                    ->hidden(fn ($record) => $record->status === 'rejected')
                    ->form([
                        Forms\Components\Textarea::make('rejection_note')
                            ->label('Alasan Penolakan / Catatan Evaluasi')
                            ->required()
                            ->placeholder('Tulis bagian kodingan/artikel yang salah agar kontributor bisa memperbaikinya...'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}