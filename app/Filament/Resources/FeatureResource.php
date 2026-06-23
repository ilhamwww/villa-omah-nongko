<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureResource\Pages;
use App\Models\Feature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('page_key')
                ->required()
                ->helperText('e.g. home, the-villa, gallery, journey')
                ->maxLength(255),
            Forms\Components\Select::make('icon')
                ->options(\App\Helpers\IconHelper::getHtmlOptions())
                ->allowHtml()
                ->live()
                ->required()
                ->searchable()
                ->helperText('Select the icon for this feature.'),
            Forms\Components\Tabs::make('Feature Translations')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Bahasa Indonesia')
                        ->schema([
                            Forms\Components\TextInput::make('title')->required()->maxLength(255),
                            Forms\Components\TextInput::make('subtitle')->maxLength(255),
                            Forms\Components\Textarea::make('description')->rows(3),
                        ]),
                    Forms\Components\Tabs\Tab::make('English')
                        ->schema([
                            Forms\Components\Group::make()
                                ->relationship('translationEn')
                                ->schema([
                                    Forms\Components\TextInput::make('title')->maxLength(255),
                                    Forms\Components\TextInput::make('subtitle')->maxLength(255),
                                    Forms\Components\Textarea::make('description')->rows(3),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title (Indonesian)')
                    ->getStateUsing(fn ($record) => $record->getRawOriginal('title'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('translationEn.title')
                    ->label('Title (English)')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('page_key')->badge()->sortable(),
                Tables\Columns\TextColumn::make('icon')
                    ->formatStateUsing(fn ($state) => new \Illuminate\Support\HtmlString(
                        $state 
                            ? '<div class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5 text-gray-500 inline" style="width:1.25rem;height:1.25rem;">' . \App\Helpers\IconHelper::getSvgPath($state) . '</svg><span>' . ucfirst($state) . '</span></div>'
                            : '-'
                    )),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->paginated(false)
            ->filters([
                Tables\Filters\SelectFilter::make('page_key')
                    ->options(fn () => Feature::distinct()->pluck('page_key', 'page_key')->toArray()),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->with('translationEn');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeature::route('/create'),
            'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
