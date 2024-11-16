<?php

namespace App\Http\Controllers;

use App\Models\MovieMessage;

class RandomMessageController extends Controller
{
    public function index()
    {
        $message = MovieMessage::inRandomOrder()
            ->with([
                'movie',
                'movieReaction',
                'messageRecipient'
            ])
            ->first();

        return view('frontend.random', compact('message'));
    }
}
