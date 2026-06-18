<?php
namespace App\Filament\Resources;
use App\Filament\Resources\JourneyCategoryResource\Pages;
use App\Models\JourneyCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JourneyCategoryResource extends Resource
{
    protected static ?string $model = JourneyCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-hashtag';
    protected static ?string $navigationGroup = 'Journey';
    protected static ?string $navigationLabel = 'Categories';
    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
            Forms\Components\Textarea::make('description')->rows(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('posts_count')->counts('posts')->label('Posts'),
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