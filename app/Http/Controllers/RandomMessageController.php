<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMoveMessageRequest;
use App\Models\MessageRecipient;
use App\Models\MovieMessage;
use App\Models\MovieReaction;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Response;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\DB;

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

    public function load()
    {
        $message = MovieMessage::inRandomOrder()
            ->with([
                'movie',
                'movieReaction',
                'messageRecipient'
            ])
            ->first();

        return response()->json($message);
    }
}
