<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMoveMessageRequest;
use App\Models\MessageRecipient;
use App\Models\MovieMessage;
use App\Models\MovieReaction;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\DB;

class MovieMessageController extends Controller
{
    public function create()
    {
        $reactions = MovieReaction::all()->pluck('title', 'id');

        return view('frontend.messages.create', compact('reactions'));
    }

    public function store(StoreMoveMessageRequest $request)
    {
        $recipient_title = Str::of(strtolower(strip_tags($request->input('recipient'))))->title();
        $message = strip_tags($request->input('message'));

        DB::beginTransaction();

        try {
            $recipient = MessageRecipient::lockForUpdate()
                ->firstOrCreate(['title' => $recipient_title]);

            $model = new MovieMessage();

            $model->user_id = auth()->id() ? auth()->id() : NULL;
            $model->message_recipient_id = $recipient->id;
            $model->movie_id = $request->input('movie_id');
            $model->movie_reaction_id = $request->input('movie_reaction_id');

            $model->recipient_title = $recipient->title;
            $model->message = $message;

            $model->save();

            DB::commit();

            return back()->with([
                'message' => 'Message submitted successfully!',
                'message_url' => route('message.show', $model->slug)
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return back()->withErrors(['recipient' => 'An error occurred while storing the message. Please try again.']);
        }
    }

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
