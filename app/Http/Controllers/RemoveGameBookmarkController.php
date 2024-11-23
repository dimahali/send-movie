<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Movie;

class RemoveGameBookmarkController extends Controller
{

    public function __invoke($game_slug)
    {
        $game = Movie::published()
            ->whereSlug($game_slug)
            ->firstOrFail();

        Bookmark::where('game_id', $game->id)
            ->where('user_id', auth()->id())
            ->forceDelete();

        return back();
    }
}
