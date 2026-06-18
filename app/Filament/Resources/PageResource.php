<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Page')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Content')
                        ->schema([
                            Forms\Components\TextInput::make('title')->required()->maxLength(255),
                            Forms\Components\TextInput::make('page_key')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->helperText('Unique key: home, the-villa, gallery, journey'),
                            Forms\Components\Textarea::make('hero_description')->rows(3),
                            Forms\Components\FileUpload::make('hero_image')
                                ->imageEditor()
                                ->disk('public')->directory('pages')->image(),
                            Forms\Components\TextInput::make('hero_title'),
                            Forms\Components\Select::make('status')
                                ->options(['draft' => 'Draft', 'published' => 'Published'])
                                ->default('published'),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Extra Content')
                        ->schema([
                            Forms\Components\Fieldset::make('Section: Hidup Selaras (The Villa)')
                                ->schema([
                                    Forms\Components\TextInput::make('content_blocks.harmoni_title')
                                        ->label('Title')
                                        ->default('Hidup Selaras dengan Alam'),
                                    Forms\Components\Textarea::make('content_blocks.harmoni_description')
                                        ->label('Description')
                                        ->rows(3)
                                        ->default('Ruang tamu dan ruang makan terbuka mengundang keindahan alam masuk, sementara material alami dan detail kerajinan tangan menciptakan suasana hangat yang tak lekang oleh waktu.'),
                                    Forms\Components\Repeater::make('content_blocks.living_checklist')
                                        ->label('Checklist Items')
                                        ->simple(
                                            Forms\Components\TextInput::make('item')->required()
                                        )
                                        ->default([
                                            'Ruang tamu dan ruang makan konsep terbuka',
                                            'Dapur modern dengan peralatan lengkap',
                                            'Jendela besar dari lantai hingga langit-langit',
                                            'Material kayu jati alami & sentuhan arsitektur Jawa',
                                        ])
                                        ->columnSpanFull(),
                                ])
                                ->visible(fn (\Filament\Forms\Get $get) => $get('page_key') === 'the-villa'),
                        ])
                        ->visible(fn (\Filament\Forms\Get $get) => $get('page_key') === 'the-villa'),
                    Forms\Components\Tabs\Tab::make('SEO')
                        ->schema([
                            Forms\Components\TextInput::make('seo_title')
                                ->label('SEO Title')
                                ->helperText('Judul halaman untuk mesin pencari (Google). Disarankan antara 50 - 60 karakter agar tidak terpotong (Maksimal 70 karakter).')
                                ->maxLength(70),
                            Forms\Components\Textarea::make('seo_description')
                                ->label('SEO Description')
                                ->helperText('Deskripsi singkat halaman untuk hasil pencarian. Disarankan antara 120 - 150 karakter agar tampil optimal (Maksimal 160 karakter).')
                                ->rows(2)
                                ->maxLength(160),
                            Forms\Components\TextInput::make('seo_keywords')
                                ->label('SEO Keywords')
                                ->helperText('Kata kunci yang relevan untuk halaman ini, dipisahkan dengan koma (contoh: villa jogja, private villa yogyakarta, omah nongko).'),
                            Forms\Components\FileUpload::make('og_image')
                                ->label('OG Image')
                                ->helperText('Gambar yang akan muncul saat link halaman ini dibagikan di media sosial (WhatsApp, Facebook, Instagram, dll). Disarankan resolusi 1200x630 piksel.')
                                ->disk('public')
                                ->directory('seo')
                                ->image(),
                            Forms\Components\Toggle::make('robots_index')
                                ->label('Robots Index')
                                ->helperText('Izinkan mesin pencari (Google) untuk mengindeks halaman ini agar muncul di hasil pencarian.')
                                ->default(true),
                            Forms\Components\Toggle::make('robots_follow')
                                ->label('Robots Follow')
                                ->helperText('Izinkan crawler mesin pencari untuk mengikuti tautan/link yang ada di halaman ini.')
                                ->default(true),
                            Forms\Components\TextInput::make('canonical_url')
                                ->label('Canonical URL')
                                ->helperText('URL utama halaman ini (kosongkan jika ingin menggunakan URL default). Digunakan untuk menghindari masalah konten duplikat/SEO.')
                                ->url(),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('page_key')->badge()->sortable(),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->color(fn (string $state) => $state === 'published' ? 'success' : 'warning'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->filters([])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}