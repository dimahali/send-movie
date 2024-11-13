<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieMessage;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function __invoke()
    {
        $movie_messages = MovieMessage::query()
            ->inRandomOrder()
            ->with(['movie', 'movieReaction', 'messageRecipient'])
            ->take(30)
            ->get();

        $total_movies = Movie::count();
        $total_messages = MovieMessage::count();

        return view('frontend.index', compact('movie_messages', 'total_movies', 'total_messages'));
    }
}
