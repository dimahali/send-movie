<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Movie;

class GameBookmarkController extends Controller
{

    public function __invoke($game_slug)
    {
        $game = Movie::published()
            ->whereSlug($game_slug)
            ->firstOrFail();

        Bookmark::firstOrCreate([
            'user_id' => auth()->id(),
            'game_id' => $game->id
        ]);

        return back();
    }
}
