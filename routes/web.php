<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieMessageController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\SearchController;
use App\Models\Movie;
use App\Models\MovieMessage;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class)->name('home');
Route::get('/search', SearchController::class)->name('search');
Route::get('/now', [MovieMessageController::class, 'create'])->name('get.message.now');
Route::post('/now', [MovieMessageController::class, 'store'])->name('post.message.now');

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

Route::get('/message-of-the-day', function () {

    $message = Cache::remember("message:" . date('Y-m-d'), 60 * 60 * 24, function () {

        return MovieMessage::inRandomOrder()
            ->first();

    });

    return view('frontend.message_of_the_day', compact('message'));

})->name('get.message.of.the.day');

Route::get('/movies/search', function () {
    $query = request('q');

    $movies = Movie::query()
        ->where('title', 'like', '%' . $query . '%')
        ->take(10)
        ->get(['id', 'title', 'release_date']);

    return response()->json($movies);
})->name('movies.search');

Route::get('/api/message-recipients', function () {
    $search = request('s', '');

    if (strlen($search) < 2) {
        return response()->json([]); // Avoid querying for very short inputs
    }

    $recipients = DB::table('message_recipients')
        ->where('title', 'like', "%{$search}%")
        ->take(10) // Limit results for performance
        ->get(['id', 'title']);

    return response()->json($recipients);
});
