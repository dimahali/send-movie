<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class GameRatingController extends Controller
{

    public function __invoke( $game_slug )
    {

        $cookie_name = "rated_game_" . $game_slug;

        if ( $this->hasUserRated($cookie_name) ) {

            return response()->json([
                'error'   => true,
                'message' => 'Already Rated'
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

        $validator = Validator::make(request()->all(), [
            'rating' => Rule::in([ 1, 2, 3, 4, 5 ]),
        ]);

        if ( $validator->fails() ) {

            return response()->json([
                'error'   => true,
                'message' => 'Rating Value is Incorrect'
            ], 422);

        }

        $validated = $validator->validated();

        switch ( $validated['rating'] ) {

            case 1:
                $game->increment('ratings_one');
                break;

            case 2:
                $game->increment('ratings_two');
                break;

            case 3:
                $game->increment('ratings_three');
                break;

            case 4:
                $game->increment('ratings_four');
                break;

            case 5:
                $game->increment('ratings_five');
                break;

        }

        setcookie($cookie_name, 'rated', strtotime('+1 day'), '/'); // Expires in 1 day

        return response()->json([
            'error'   => false,
            'message' => "You rated " . $validated['rating']
        ]);

    }

    private function hasUserRated( $cookie_name )
    {

        if ( isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] === 'rated' ) {
            return true; // User has rated today
        }

        return false;

    }

}
