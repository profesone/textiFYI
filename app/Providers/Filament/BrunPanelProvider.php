<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use App\Http\Middleware\CheckBlockedUser;
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

class BrunPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('brun')
            ->path('brun')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->brandLogo(asset('img/TextiFYI_web_sm.png'))
            ->navigationItems([
                NavigationItem::make('Agent Portal')
                    ->url('/')
                    ->icon('heroicon-o-beaker')
                    ->sort(1),
                NavigationItem::make('Dispatches')
                    ->url('/brun/dispatches')
                    ->icon('heroicon-o-arrows-pointing-out')
                    ->sort(2),
                NavigationItem::make('Textifyi Numbers')
                    ->url('/brun/textifyi-numbers')
                    ->icon('heroicon-o-phone-arrow-down-left')
                    ->sort(3),
                NavigationItem::make('Text Responses')
                    ->url('/brun/text-responses')
                    ->icon('heroicon-o-chat-bubble-oval-left-ellipsis')
                    ->sort(4),
                NavigationItem::make('Users')
                    ->url('/brun/users')
                    ->icon('heroicon-o-user-group')
                    ->sort(5),
            ])     
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                CheckBlockedUser::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
