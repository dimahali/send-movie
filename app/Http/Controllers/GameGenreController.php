<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Facades\Cache;

class GameGenreController extends Controller
{

    public function index()
    {
        $categories = Cache::flexible('genres:with:latest:games:data', [300, 500], function () {

            return Genre::withWhereHas('games', function ($query) {

                $query->published()
                    ->latest('published_at')
                    ->limit(5);

            })->get();

        });

        return view('frontend.genres.index', compact('categories'));
    }

    public function show($genre_slug)
    {
        $genre = Genre::whereSlug($genre_slug)
            ->firstOrFail();

        $games = Movie::published()
            ->ofGenre($genre->id)
            ->latest('published_at')
            ->paginate(30);

        $categories = Cache::flexible('all:genres', [300, 500], function () {
            return Genre::query()
                ->whereHas('games', function ($query) {
                    $query->published()
                        ->latest('published_at');
                })
                ->withCount('games')
                ->get();
        });

        return view('frontend.genres.show', compact('genre', 'games', 'categories'));
    }
}
