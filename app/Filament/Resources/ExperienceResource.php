<?php
namespace App\Filament\Resources;
use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'Villa';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required()->maxLength(255),
            Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(255),
            Forms\Components\Textarea::make('description')->rows(4),
            Forms\Components\FileUpload::make('image')
                ->imageEditor()
                ->disk('public')->directory('experiences')->image()->optimize('webp')->maxImageWidth(1600),
            Forms\Components\TextInput::make('image_alt')->maxLength(255),
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
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
