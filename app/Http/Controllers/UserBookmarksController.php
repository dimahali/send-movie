<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;

class UserBookmarksController extends Controller
{

    public function __invoke()
    {
        $bookmarks = Bookmark::where('user_id', auth()->id())
            ->get();

        return view('frontend.games.bookmarks', compact('bookmarks'));
    }
}
