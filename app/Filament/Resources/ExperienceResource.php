<?php
namespace App\Filament\Resources;
use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'Villa';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Experience Translations')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Bahasa Indonesia')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                            ->required()->live(onBlur: true)
                            ->maxLength(255)
                                ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                    $set('slug', Str::slug($state));
                                }),
                            Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(255),
                            Forms\Components\Textarea::make('description')->rows(4),
                            Forms\Components\TextInput::make('image_alt')->maxLength(255),
                        ]),
                    Forms\Components\Tabs\Tab::make('English')
                        ->schema([
                            Forms\Components\Group::make()
                                ->relationship('translationEn')
                                ->schema([
                                    Forms\Components\TextInput::make('title')->maxLength(255)->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                    $set('slug', Str::slug($state));
                                })->live(onBlur: true),
                                    Forms\Components\TextInput::make('slug')->maxLength(255),
                                    Forms\Components\Textarea::make('description')->rows(4),
                                    Forms\Components\TextInput::make('image_alt')->maxLength(255),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('image')
                ->imageEditor()
                ->disk('public')->directory('experiences')->image()->optimize('webp')->maxImageWidth(1600),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Select::make('icon')
                    ->options(\App\Helpers\IconHelper::getHtmlOptions())
                    ->allowHtml()
                    ->live()
                    ->required()
                    ->helperText('Select the icon for this experience.'),
                Forms\Components\Placeholder::make('icon_preview')
                    ->label('Icon Preview')
                    ->content(fn ($get) => new \Illuminate\Support\HtmlString(
                        $get('icon') 
                            ? '<div class="flex items-center justify-center p-3 border rounded-lg bg-gray-50 dark:bg-gray-800 w-16 h-16"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-8 h-8 text-primary-600">' . \App\Helpers\IconHelper::getSvgPath($get('icon')) . '</svg></div>' 
                            : '<div class="text-sm text-gray-500 italic mt-2">No icon selected</div>'
                    )),
            ]),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->disk('public')->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title (ID & EN)')
                    ->formatStateUsing(function ($record) {
                        $id = $record->getAttributes()['title'] ?? '-';
                        $en = $record->translationEn?->title ?? '-';
                        return new \Illuminate\Support\HtmlString(
                            "<div style=\"display: flex; flex-direction: column; gap: 0.25rem;\">
                                <span style=\"font-size: 0.875rem; font-weight: 500;\">{$id}</span>
                                <span style=\"font-size: 0.75rem; color: #6b7280;\">EN: {$en}</span>
                            </div>"
                        );
                    })
                    ->searchable(query: function ($query, $search) {
                        $query->where('title', 'like', "%{$search}%")
                            ->orWhereHas('translationEn', function ($q) use ($search) {
                                $q->where('title', 'like', "%{$search}%");
                            });
                    })
                    ->sortable(),
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
            ->paginated(true)
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
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
