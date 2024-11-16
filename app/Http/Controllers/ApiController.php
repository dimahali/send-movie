<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMoveMessageRequest;
use App\Models\MessageRecipient;
use App\Models\Movie;
use App\Models\MovieMessage;
use App\Models\MovieReaction;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Response;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function movies()
    {
        $query = request('search_term');

        $movies = Movie::query()
            ->where('title', 'like', '%' . $query . '%')
            ->latest('release_date')
            ->take(15)
            ->get(['id', 'title', 'release_date']);

        return response()->json($movies);
    }

    public function topics()
    {
        $search = request('search_term', '');

        if (strlen($search) < 3) {
            return response()->json();
        }

        $recipients = DB::table('message_recipients')
            ->where('title', 'like', "%{$search}%")
            ->take(15)
            ->get(['id', 'title']);

        return response()->json($recipients);
    }
}
