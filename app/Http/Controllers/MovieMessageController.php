<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMoveMessageRequest;
use App\Models\MessageRecipient;
use App\Models\Movie;
use App\Models\MovieMessage;
use App\Models\MovieReaction;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

class MovieMessageController extends Controller
{
    public function create()
    {
        $reactions = MovieReaction::all()->pluck('title', 'id');
        $total_movies = Cache::remember('movies_count', 60 * 24, function () {
            return Movie::count();
        });
        return view('frontend.messages.create', compact('reactions', 'total_movies'));
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

        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return back()->withErrors(['recipient' => 'An error occurred while storing the message. Please try again.']);
        }

        $movie = Movie::find($model->movie_id);

        defer(function () use ($movie) {
            $this->updateMovieVideos($movie);
        })->always();

        return back()->with([
            'message' => 'Message submitted successfully!',
            'message_url' => route('message.show', $model->slug)
        ]);
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

    protected function updateMovieVideos(Movie $movie)
    {
        if (isset($movie->videos_fetched_at) && $movie->videos_fetched_at < today()->subWeek()){
            Log::info("Already tried downloading videos for $movie->title");
            return true;
        }
        if ($movie->videos && is_array($movie->videos) && count($movie->videos) > 0) {
            Log::info("Videos already exist for $movie->title");
            return true;
        }

        $api_url = config('services.tmdb.base_url') . "/movie/$movie->tmdb_id/videos?language=en-US";
        $api_token = config('services.tmdb.api_token');

        $response = Http::withToken($api_token)
            ->accept('application/json')
            ->get($api_url);

        if ($response->successful()) {
            $videos = collect($response->json('results'));

            $youtube_videos = $videos->filter(fn($video) => isset($video['key']))
                ->map(fn($video) => [
                    'source' => strtolower($video['site']),
                    'name' => $video['name'] ?? 'Video',
                    'key' => $video['key'],
                    'type' => $video['type'] ?? 'Trailer'
                ])->values();

            if (count($youtube_videos) > 0) {
                $movie->update(['videos' => $youtube_videos, 'videos_fetched_at' => today()->toDateString()]);
                Log::info("Video sources downloaded for $movie->title");
            }else{
                $movie->update(['videos_fetched_at' => today()->toDateString()]);
            }
        } else {
            $movie->update(['videos_fetched_at' => today()->toDateString()]);
            Log::error("Failed to fetch video sources for Movie $movie->title: " . $response->body());
        }

        return true;
    }
}
