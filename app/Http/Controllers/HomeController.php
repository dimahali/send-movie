<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieMessage;

class HomeController extends Controller
{
    public function __invoke()
    {
        $movie_messages = MovieMessage::query()
            ->inRandomOrder()
            ->with(['movie', 'user', 'movieReaction', 'messageRecipient'])
            ->take(30)
            ->get();

        $total_movies = Movie::count();
        $total_messages = MovieMessage::count();

        return view('frontend.index', compact('movie_messages', 'total_movies', 'total_messages'));
    }
}
