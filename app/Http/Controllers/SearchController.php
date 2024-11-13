<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\RecipientSearch;
use App\QueryFilters\GameFilters;

class SearchController extends Controller
{

    public function __invoke( GameFilters $filters )
    {

        $games = Movie::published()
                       ->filterBy($filters)
                       ->latest('published_at')
                       ->paginate(30);

        $this->storeSearch();

        return view('frontend.games.search', compact('games'));

    }

    private function storeSearch()
    {

        if ( request()->filled('game_title') ) {

            $search_term = request('game_title');

            $existing_entry = RecipientSearch::forTerm($search_term)
                                         ->whereDate('created_at', today())
                                         ->first();

            if ( !$existing_entry ) {

                $new_search = new RecipientSearch();

                $new_search->search_term = $search_term;

                $new_search->save();

            } else {

                $existing_entry->increment('no_of_searches');

            }

        }

    }

}
