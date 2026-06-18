<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentCheckSslWidget\FilamentCheckSslWidgetPlugin;
use Joaopaulolndev\FilamentWorldClock\FilamentWorldClockPlugin;
use Hardikkhorasiya09\ChangePassword\ChangePasswordPlugin;
use App\Filament\Pages\Dashboard;
use App\Filament\Pages\Auth\Login;
use Filament\Support\Enums\MaxWidth;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Schema;

class AdminPanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        $logo = '';
        $name = 'Admin Panel';

        try {
            if (Schema::hasTable('website_settings')) {
                $setting = WebsiteSetting::first();
                if ($setting) {
                    $logo = $setting->logo ?? '';
                    $name = $setting->name ?? 'Admin Panel';
                }
            }
        } catch (\Exception $e) {
            // Silently fail during migrations
        }

        return $panel
            ->default()
            ->id('admin')
            ->maxContentWidth(MaxWidth::Full)
            ->path('admin')
            ->brandLogo($logo ? asset('storage/' . $logo) : null)
            ->favicon($logo ? asset('storage/' . $logo) : null)
            ->login(Login::class)
            ->brandName($name)
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                // Pages\Dashboard::class,
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                ChangePasswordPlugin::make(),
                FilamentWorldClockPlugin::make()
                    ->timezones([
                        'Asia/Jakarta',
                        'Asia/Tokyo',
                        'Asia/Shanghai',
                        'Europe/Moscow',
                        'America/New_York',
                        'Europe/Berlin',
                    ]),
            ]);
    }

}