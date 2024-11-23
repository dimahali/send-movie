<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieMessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RandomMessageController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class)->name('home');
Route::get('/search', SearchController::class)->name('search');

Route::get('/now', [MovieMessageController::class, 'create'])->name('get.message.now');
Route::post('/now', [MovieMessageController::class, 'store'])->name('post.message.now');

Route::get('/r/{recipient_slug}', [RecipientController::class, 'show'])->name('recipient.show');
Route::get('/m/{message_slug}', [MovieMessageController::class, 'show'])->name('message.show');

Route::get('/random-message', [RandomMessageController::class, 'index'])->name('get.random.message');

Route::middleware('auth')->group(function () {
    Route::get('/my-messages', function (){
        return '';
    })->name('user.messages');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::prefix('api')
    ->name('api.')
    ->group(function () {
        Route::post('/movies', [ApiController::class, 'movies'])->name('movies');
        Route::post('/topics', [ApiController::class, 'topics'])->name('topics');
    });

require __DIR__ . '/auth.php';
