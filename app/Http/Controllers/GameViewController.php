<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class GameViewController extends Controller
{

    public function __invoke( $game_slug )
    {

        $cookie_name = "viewed_game_" . $game_slug;

        if ( $this->userHasAlreadyViewedGame($cookie_name) ) {

            return response()->json([
                'error'   => true,
                'message' => 'View already added'
            ], 422);

        }

        $game = Movie::published()
                      ->whereSlug($game_slug)
                      ->first();

        if ( !$game ) {

            return response()->json([
                'error'   => true,
                'message' => 'Movie Not Found'
            ], 404);

        }

        $game->increment('total_views');

        setcookie($cookie_name, 'viewed', strtotime('+1 day'), '/'); // Expires in 1 day

        return response()->json([
            'error'   => false,
            'message' => "View updated"
        ]);

    }

    private function userHasAlreadyViewedGame( $cookie_name )
    {

        if ( isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] === 'viewed' ) {
            return true; // User has viewed game today
        }

        return false;

    }

}
