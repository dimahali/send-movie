<?php

namespace App\Providers\Filament;

use Blade;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Http\Middleware\Authenticate;
use Filament\Support\Facades\FilamentView;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class ManageContentPanelProvider extends PanelProvider
{
    public function panel( Panel $panel ): Panel
    {
        return $panel
            ->default()
            ->id('manage-content')
            ->path('manage-content')
            ->login()
            ->colors([
                'primary' => Color::Lime,
                'gray'    => Color::Slate
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
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
            ->brandLogo(asset('images/logo_sm.webp'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('images/logo_medium.webp'))
            ->plugin(
                BreezyCore::make()
                          ->myProfile(
                              hasAvatars: true,
                              slug: 'profile'
                          )
                          ->enableTwoFactorAuthentication(
                              force: app()->isProduction(),
                          )
            )
            ->unsavedChangesAlerts();
    }

    public function register(): void
    {

        parent::register();

        FilamentView::registerRenderHook('panels::body.end', fn(): string => Blade::render("@vite('resources/js/app.js')"));

    }

}