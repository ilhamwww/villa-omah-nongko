<?php
namespace App\Filament\Resources;
use App\Filament\Resources\JourneyCategoryResource\Pages;
use App\Models\JourneyCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class JourneyCategoryResource extends Resource
{
    protected static ?string $model = JourneyCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-hashtag';
    protected static ?string $navigationGroup = 'Artikel (Journey)';
    protected static ?string $navigationLabel = 'Kategori Artikel';
    protected static ?string $pluralLabel = 'Kategori Artikel';
    protected static ?string $modelLabel = 'Kategori Artikel';
    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Kategori')
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
                ->helperText('Otomatis dibuat berdasarkan nama kategori. Boleh dibiarkan atau diubah jika perlu.'),
            Forms\Components\Textarea::make('description')->label('Deskripsi')->rows(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama Kategori')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('posts_count')->counts('posts')->label('Jumlah Artikel'),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJourneyCategories::route('/'),
            'create' => Pages\CreateJourneyCategory::route('/create'),
            'edit' => Pages\EditJourneyCategory::route('/{record}/edit'),
        ];
    }
}