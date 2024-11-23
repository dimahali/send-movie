<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function movies()
    {
        $query = request('search_term');

        $movies = Movie::query()
            ->where('title', 'like', '%' . $query . '%')
            ->take(20)
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
            ->take(20)
            ->get(['id', 'title']);

        return response()->json($recipients);
    }
}
