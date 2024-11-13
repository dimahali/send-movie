<?php

namespace App\Http\Controllers;

use App\Models\MessageRecipient;
use App\Models\Movie;
use App\Models\MovieMessage;
use Vinkla\Hashids\Facades\Hashids;

class MovieMessageController extends Controller
{
    public function show($slug)
    {
        $id = HashIds::decode($slug);

        if (!$id) {
            abort(404);
        }

        $message = MovieMessage::query()
            ->where('id', $id[0])
            ->with(['movie', 'movieReaction', 'messageRecipient'])
            ->firstOrFail();

        return view('frontend.messages.show', compact('message'));
    }
}
