<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameBookmarkController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameGenreController;
use App\Http\Controllers\GameRatingController;
use App\Http\Controllers\GameThemeController;
use App\Http\Controllers\GameViewController;
use App\Http\Controllers\MovieMessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\RemoveGameBookmarkController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserBookmarksController;
use App\Models\MovieMessage;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class)->name('home');
Route::get('/search', SearchController::class)->name('search');

Route::get('/r/{recipient_slug}', [RecipientController::class, 'show'])->name('recipient.show');
Route::get('/m/{message_slug}', [MovieMessageController::class, 'show'])->name('message.show');

Route::get('/random-message', function () {

    $message = MovieMessage::inRandomOrder()
        ->with([
            'movie',
            'movieReaction',
            'messageRecipient'
        ])
        ->first();

    return view('frontend.random', compact('message'));

})->name('get.random.message');

Route::get('/message-of-the-day', function () {

    $message = Cache::remember("message:" . date('Y-m-d'), 60 * 60 * 24, function () {

        return MovieMessage::inRandomOrder()
            ->first();

    });

    return view('frontend.message_of_the_day', compact('message'));

})->name('get.message.of.the.day');

Route::post('/random-message', function () {

    $message = MovieMessage::inRandomOrder()
        ->with([
            'movie',
            'movieReaction',
            'messageRecipient'
        ])
        ->first();

    return Response::json($message);

})->name('post.random.message');
