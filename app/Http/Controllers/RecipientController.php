<?php

namespace App\Http\Controllers;

use App\Models\MessageRecipient;
use App\Models\MovieMessage;
use Vinkla\Hashids\Facades\Hashids;

class RecipientController extends Controller
{
    public function show($slug)
    {
        $id = HashIds::decode($slug);

        if (!$id) {
            abort(404);
        }

        $recipient = MessageRecipient::where('id', $id[0])->firstOrFail();

        $movie_messages = MovieMessage::query()
            ->where('message_recipient_id', $recipient->id)
            ->with(['movie', 'user', 'movieReaction'])
            ->latest()
            ->simplePaginate(30);

        return view('frontend.messages.index', compact('recipient', 'movie_messages'));
    }
}
