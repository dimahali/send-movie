<?php

namespace App\Providers;

use App\Enums\UserType;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {

            Filament::registerNavigationGroups([

                NavigationGroup::make()
                    ->label('Primary Settings')
                    ->icon('heroicon-s-cog')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Manage Games')
                    ->icon('heroicon-s-book-open')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Account Settings')
                    ->icon('heroicon-s-users')
                    ->collapsed(),

            ]);

        });

        Model::unguard();

        Model::preventLazyLoading(!app()->isProduction());

        LogViewer::auth(function ($request) {
            return $request->user()
                && $request->user()->user_type === UserType::ADMIN;
        });
    }
}
