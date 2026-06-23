<?php
namespace App\Filament\Resources;
use App\Filament\Resources\JourneyPostResource\Pages;
use App\Models\JourneyPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class JourneyPostResource extends Resource
{
    protected static ?string $model = JourneyPost::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Artikel (Journey)';
    protected static ?string $navigationLabel = 'Daftar Artikel';
    protected static ?string $pluralLabel = 'Artikel';
    protected static ?string $modelLabel = 'Artikel';
    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('journey_category_id')
                ->relationship('category', 'name')
                ->label('Kategori')
                ->required(),
            Forms\Components\FileUpload::make('featured_image')
                ->label('Gambar Utama')
                ->disk('public')
                ->directory('journey')
                ->image()
                ->optimize('webp')
                ->maxImageWidth(1600),
            Forms\Components\Tabs::make('Journey Post Translations')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Bahasa Indonesia')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Judul')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                    if (($get('slug') ?? '') !== Str::slug($old)) {
                                        return;
                                    }
                                    $set('slug', Str::slug($state));
                                }),
                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->helperText('Otomatis dibuat berdasarkan judul. Boleh dibiarkan atau diubah jika perlu.'),
                            Forms\Components\RichEditor::make('content')
                                ->label('Konten Artikel')
                                ->required(),
                            Forms\Components\Section::make('SEO Metadata')
                                ->schema([
                                    Forms\Components\TextInput::make('seo_title')->label('SEO Title'),
                                    Forms\Components\Textarea::make('seo_description')->label('SEO Description')->rows(2),
                                    Forms\Components\TextInput::make('seo_keywords')->label('SEO Keywords'),
                                ])
                                ->collapsible(),
                        ]),
                    Forms\Components\Tabs\Tab::make('English')
                        ->schema([
                            Forms\Components\Group::make()
                                ->relationship('translationEn')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->label('Title')
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                            if (($get('slug') ?? '') !== Str::slug($old)) {
                                                return;
                                            }
                                            $set('slug', Str::slug($state));
                                        }),
                                    Forms\Components\TextInput::make('slug')
                                        ->helperText('Automatically generated from title. Can be changed if needed.'),
                                    Forms\Components\RichEditor::make('content')
                                        ->label('Post Content'),
                                    Forms\Components\Section::make('SEO Metadata')
                                        ->schema([
                                            Forms\Components\TextInput::make('seo_title')->label('SEO Title'),
                                            Forms\Components\Textarea::make('seo_description')->label('SEO Description')->rows(2),
                                            Forms\Components\TextInput::make('seo_keywords')->label('SEO Keywords'),
                                        ])
                                        ->collapsible(),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
            Forms\Components\DateTimePicker::make('published_at')
                ->label('Tanggal Publikasi')
                ->default(now()),
            Forms\Components\Select::make('status')
                ->label('Status')
                ->options(['draft' => 'Draft', 'published' => 'Dipublikasikan'])
                ->default('published')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')->label('Gambar')->circular(),
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori')->sortable(),
                Tables\Columns\TextColumn::make('status')->label('Status')->badge()
                    ->color(fn (string $state) => $state === 'published' ? 'success' : 'warning'),
                Tables\Columns\TextColumn::make('published_at')->label('Tanggal Rilis')->dateTime()->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJourneyPosts::route('/'),
            'create' => Pages\CreateJourneyPost::route('/create'),
            'edit' => Pages\EditJourneyPost::route('/{record}/edit'),
        ];
    }
}