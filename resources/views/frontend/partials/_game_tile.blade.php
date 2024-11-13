<div
    class="group w-full max-w-32 sm:max-w-52 flex flex-col gap-2 justify-start items-center relative p-4 rounded-lg shadow-sm border bg-lime-50 border-lime-200 hover:bg-lime-100 dark:bg-slate-700 dark:border-slate-600 dark:hover:bg-slate-600">
    @if($game->cover_image)
        <div>
            <img
                src="{{ $game->medium_image }}"
                alt="{{ $game->name }} Game Cover"
                width="160px"
                height="160px"
                class="w-full max-w-40 max-h-40 rounded-md text-xs"
                loading="lazy"
            >
        </div>
    @endif
    <div class="space-y-1">
        <h2 class="text-center text-base font-bold text-slate-700 dark:text-slate-200 leading-tight">
            <a href="{{route('game.show', $game->generated_slug)}}"
               class="line-clamp-1"
               aria-label="Play {{$game->name}} Game"
               title="Play {{$game->name}} Game"
            >
                <span aria-hidden="true" class="absolute inset-0"></span>
                {{$game->name}}
            </a>
        </h2>
        @if($game->total_ratings)
            <p class="text-center text-sm text-lime-700 dark:text-slate-300 line-clamp-1">
                Rated {{$game->average_rating}}
                by {{$game->total_ratings}} {{Str::of('gamer')->plural($game->total_ratings)}}
            </p>
        @else
            <p class="text-center text-sm text-lime-700 dark:text-slate-300">
                Not Rated Yet
            </p>
        @endif
    </div>
</div>
