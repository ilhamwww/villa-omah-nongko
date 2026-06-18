<?php
namespace App\Filament\Resources;
use App\Filament\Resources\JourneyPostResource\Pages;
use App\Models\JourneyPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JourneyPostResource extends Resource
{
    protected static ?string $model = JourneyPost::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Journey';
    protected static ?string $navigationLabel = 'Posts';
    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('journey_category_id')
                ->relationship('category', 'name')
                ->required(),
            Forms\Components\FileUpload::make('featured_image')->disk('public')->directory('journey')->image(),
            Forms\Components\Textarea::make('excerpt')->rows(3),
            Forms\Components\RichEditor::make('content')->required(),
            Forms\Components\DateTimePicker::make('published_at')->default(now()),
            Forms\Components\Select::make('status')
                ->options(['draft' => 'Draft', 'published' => 'Published'])
                ->default('published')
                ->required(),
            Forms\Components\Section::make('SEO Metadata')
                ->schema([
                    Forms\Components\TextInput::make('seo_title'),
                    Forms\Components\Textarea::make('seo_description')->rows(2),
                    Forms\Components\TextInput::make('seo_keywords'),
                ])
                ->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')->circular(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name')->sortable(),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->color(fn (string $state) => $state === 'published' ? 'success' : 'warning'),
                Tables\Columns\TextColumn::make('published_at')->dateTime()->sortable(),
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