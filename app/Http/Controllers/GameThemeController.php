<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

class GameThemeController extends Controller
{

    public function index()
    {
        $themes = Cache::flexible('tags:with:latest:games:data', [300, 500], function () {
            return Tag::withWhereHas('games', function ($query) {
                    $query->published()
                        ->latest('published_at')
                        ->limit(5);
                })->get();
        });

        return view('frontend.themes.index', compact('themes'));
    }

    public function show($genre_slug)
    {
        $theme = Tag::whereSlug($genre_slug)
            ->firstOrFail();

        $games = Movie::published()
            ->whereHas('tags', function ($query) use ($theme) {
                $query->where('tag_id', $theme->id);
            })
            ->latest('published_at')
            ->paginate(50);

        $themes = Cache::flexible('all:tags', [300, 500], function () {
            return Tag::query()
                ->whereHas('games', function ($query) {
                    $query->published()
                        ->latest('published_at');
                })
                ->withCount('games')
                ->having('games_count', '>=', 1)
                ->get();
        });

        return view('frontend.themes.show', compact('theme', 'games', 'themes'));
    }
}
