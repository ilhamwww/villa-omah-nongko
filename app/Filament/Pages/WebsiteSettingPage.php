<?php

namespace App\Filament\Pages;

use App\Models\WebsiteSetting;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;

class WebsiteSettingPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Website Settings';
    protected static ?int $navigationSort = 99;
    protected static string $view = 'filament.pages.website-setting-page';

    public array $data = [];
    public ?WebsiteSetting $record = null;

    public function mount(): void
    {
        $this->record = WebsiteSetting::first() ?? WebsiteSetting::create([]);
        $this->form->fill($this->record->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Website Name'),
                                Forms\Components\TextInput::make('site_name')
                                    ->label('Site Name'),
                                Forms\Components\TextInput::make('tagline')
                                    ->label('Tagline'),
                                Forms\Components\TextInput::make('email')
                                    ->email(),
                                Forms\Components\TextInput::make('phone')
                                    ->label('Phone Number'),
                                Forms\Components\TextInput::make('whatsapp_number')
                                    ->label('WhatsApp Number')
                                    ->helperText('Include country code, e.g. 6281234567890'),
                                Forms\Components\Textarea::make('whatsapp_default_message')
                                    ->label('WhatsApp Default Message')
                                    ->rows(2),
                                Forms\Components\TextInput::make('location_name')
                                    ->label('Location Name'),
                                Forms\Components\Textarea::make('address')
                                    ->rows(2),
                                Forms\Components\TextInput::make('google_maps_url')
                                    ->label('Google Maps URL')
                                    ->url(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Branding')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\FileUpload::make('logo')
                                    ->disk('public')
                                    ->directory('branding')
                                    ->image()
                                    ->optimize('webp'),
                                Forms\Components\FileUpload::make('logo_light')
                                    ->label('Logo Light (for dark backgrounds)')
                                    ->disk('public')
                                    ->directory('branding')
                                    ->image()
                                    ->optimize('webp'),
                                Forms\Components\FileUpload::make('logo_dark')
                                    ->label('Logo Dark (for light backgrounds)')
                                    ->disk('public')
                                    ->directory('branding')
                                    ->image()
                                    ->optimize('webp'),
                                Forms\Components\FileUpload::make('favicon')
                                    ->disk('public')
                                    ->directory('branding')
                                    ->image(),
                                Forms\Components\FileUpload::make('default_hero_image')
                                    ->label('Default Hero Image')
                                    ->disk('public')
                                    ->directory('hero-images')
                                    ->image()
                                    ->optimize('webp'),
                                Forms\Components\FileUpload::make('footer_background_image')
                                    ->label('Footer Background Image')
                                    ->disk('public')
                                    ->directory('branding')
                                    ->image()
                                    ->optimize('webp'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Social Links')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Forms\Components\KeyValue::make('social_links')
                                    ->keyLabel('Platform')
                                    ->valueLabel('URL')
                                    ->addActionLabel('Add Social Link'),
                            ]),

                        Forms\Components\Tabs\Tab::make('SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                Forms\Components\TextInput::make('default_meta_title')
                                    ->label('Default Meta Title'),
                                Forms\Components\Textarea::make('default_meta_description')
                                    ->label('Default Meta Description')
                                    ->rows(2),
                                Forms\Components\TextInput::make('default_keywords')
                                    ->label('Default Keywords'),
                                Forms\Components\TextInput::make('default_og_title')
                                    ->label('Default OG Title'),
                                Forms\Components\Textarea::make('default_og_description')
                                    ->label('Default OG Description')
                                    ->rows(2),
                                Forms\Components\FileUpload::make('default_og_image')
                                    ->label('Default OG Image')
                                    ->disk('public')
                                    ->directory('seo')
                                    ->image()
                                    ->optimize('webp'),
                                Forms\Components\Toggle::make('robots_index_default')
                                    ->label('Allow Search Engines to Index (default)')
                                    ->default(true),
                                Forms\Components\TextInput::make('schema_type')
                                    ->label('Schema.org Type')
                                    ->default('LodgingBusiness'),
                                Forms\Components\TextInput::make('twitter_handle')
                                    ->label('Twitter Handle')
                                    ->prefix('@'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->record->update($data);

        Notification::make()
            ->title('Website settings saved successfully')
            ->success()
            ->send();
    }
}