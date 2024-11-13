<?php

namespace App\Http\Controllers;

use App\Models\MessageRecipient;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->input('query');

        $results = MessageRecipient::where('title', 'like', '%' . $query . '%')
            ->limit(10)
            ->get()
            ->select(['id', 'slug', 'title']);

        return response()->json($results);
    }
}
