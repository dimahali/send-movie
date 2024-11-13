<?php

namespace App\QueryFilters;

use Cerbero\QueryFilters\QueryFilters;

/**
 * Filter records based on query parameters.
 *
 */
class GameFilters extends QueryFilters
{

    public function gameTitle( $game_title )
    {
        $this->query->where('name', 'like', "%{$game_title}%");
    }

    public function gameName( $game_name )
    {
        $this->query->where('name', 'like', "%{$game_name}%");
    }

    public function genres( $genres )
    {
        $this->query->whereIn('genre_id', $genres);
    }

    public function tags( $tags )
    {
        $this->query->whereHas('tags', function ( $q ) use ( $tags ) {

            $q->whereIn('tags.id', $tags);

        });
    }

}
