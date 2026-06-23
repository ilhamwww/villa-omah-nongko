<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;
    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationGroup = 'Villa';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Room Translations')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Bahasa Indonesia')
                        ->schema([
                            Forms\Components\TextInput::make('title')->required()->maxLength(255),
                            Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(255),
                            Forms\Components\TextInput::make('bed_type')->helperText('e.g. King Size / Twin Bed')->maxLength(255),
                            Forms\Components\Textarea::make('short_description')->rows(2)->maxLength(500),
                            Forms\Components\Textarea::make('description')->rows(4),
                            Forms\Components\TextInput::make('button_label')->helperText('e.g. Book this room')->maxLength(255),
                            Forms\Components\TextInput::make('button_url')->maxLength(255),
                            Forms\Components\TextInput::make('image_alt')->maxLength(255),
                        ]),
                    Forms\Components\Tabs\Tab::make('English')
                        ->schema([
                            Forms\Components\Group::make()
                                ->relationship('translationEn')
                                ->schema([
                                    Forms\Components\TextInput::make('title')->maxLength(255),
                                    Forms\Components\TextInput::make('slug')->maxLength(255),
                                    Forms\Components\TextInput::make('bed_type')->maxLength(255),
                                    Forms\Components\Textarea::make('short_description')->rows(2)->maxLength(500),
                                    Forms\Components\Textarea::make('description')->rows(4),
                                    Forms\Components\TextInput::make('button_label')->maxLength(255),
                                    Forms\Components\TextInput::make('button_url')->maxLength(255),
                                    Forms\Components\TextInput::make('image_alt')->maxLength(255),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('image')
                ->imageEditor()
                ->disk('public')->directory('rooms')->image()->optimize('webp')->maxImageWidth(1600),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            Forms\Components\Toggle::make('is_featured')->default(false),
            Forms\Components\Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->disk('public')->circular(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('bed_type'),
                Tables\Columns\IconColumn::make('is_featured')->boolean(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->paginated(false)
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
