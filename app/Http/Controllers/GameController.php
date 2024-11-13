<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\GameChapter;
use App\Models\RecipientSearch;
use App\Models\Tag;
use App\QueryFilters\GameFilters;
use Illuminate\Support\Facades\Cache;
use Vinkla\Hashids\Facades\Hashids;

class GameController extends Controller
{
    public function latest(GameFilters $filters)
    {

        $games = Movie::published()
            ->filterBy($filters)
            ->latest('published_at')
            ->paginate(50);

        $filter_form_data = $this->getFilterData();

        $this->storeSearch();

        return view('frontend.games.index', compact('games', 'filter_form_data'));

    }

    public function topRated(GameFilters $filters)
    {
        $games = Movie::published()
            ->filterBy($filters)
            ->where('average_rating', '>', '0')
            ->orderBy('average_rating', 'desc')
            ->paginate(30);

        $filter_form_data = $this->getFilterData();

        $this->storeSearch();

        return view('frontend.games.top_rated', compact('games', 'filter_form_data'));

    }

    public function popular(GameFilters $filters)
    {
        $games = Movie::published()
            ->with('genre')
            ->filterBy($filters)
            ->where('total_views', '>', '0')
            ->orderBy('total_views', 'desc')
            ->paginate(30);

        $filter_form_data = $this->getFilterData();

        $this->storeSearch();

        return view('frontend.games.popular', compact('games', 'filter_form_data'));

    }

    public function show($game_generated_slug)
    {
        $bookmark = null;
        $id = HashIds::decode(last(explode('-', $game_generated_slug)));

        $game = Movie::published()
            ->where('id', $id)
            ->firstOrFail();

        if ($game->generated_slug !== $game_generated_slug) {
            return to_route('game.show', $game->generated_slug, 301);
        }

        $left_games = Movie::published()
            ->where('id', '!=', $game->id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        $right_games = Movie::published()
            ->whereNotIn('id', [...$left_games->pluck('id'), $game->id])
            ->inRandomOrder()
            ->take(5)
            ->get();

        if (auth()->check()) {
            $bookmark = Bookmark::query()
                ->where('game_id', $game->id)
                ->where('user_id', auth()->id())
                ->first();
        }

        return view('frontend.games.show', compact('game', 'bookmark', 'right_games', 'left_games'));
    }

    private function getFilterData()
    {

        return Cache::remember('games:filter:data', 300, function () {

            return [

                'categories' => Genre::orderBy('name')
                    ->pluck('name', 'id'),
                'tags' => Tag::orderBy('name')
                    ->pluck('name', 'id'),

            ];

        });

    }

    private function storeSearch()
    {

        if (request()->filled('game_name')) {

            $search_term = request('game_name');

            $existing_entry = RecipientSearch::forTerm($search_term)
                ->whereDate('created_at', today())
                ->first();

            if (!$existing_entry) {

                $new_search = new RecipientSearch();

                $new_search->search_term = $search_term;

                $new_search->save();

            } else {

                $existing_entry->increment('no_of_searches');

            }

        }

    }

}
