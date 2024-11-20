<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\SocialLoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::controller(SocialLoginController::class)->group(function () {
        Route::get('auth/{provider}', 'redirect')->name('auth.redirect');

        Route::get('auth/{provider}/callback', 'authenticate')->name('auth.callback');
    });
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
