@extends('frontend.layouts.app')

@section('title', '404')

@section('content')

    <main class="min-h-[75vh] my-6 sm:my-12">

        <div class="mx-auto max-w-7xl overflow-hidden px-6 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">

                <p class="text-2xl sm:text-6xl font-medium leading-8 text-red-700">404</p>

                <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-700 dark:text-slate-200 sm:text-4xl">
                    This page does not exist
                </h1>

                <p class="mt-4 text-base leading-7 text-slate-600 dark:text-slate-300 sm:mt-6 sm:text-lg sm:leading-8">
                    Sorry, we couldn’t find the page you’re looking for.
                </p>

            </div>

            @php

                $top_rated_games = App\Models\Movie::published()
                                     ->orderBy('average_rating', 'desc')
                                     ->take(6)
                                     ->get();
            @endphp


            <div class="mx-auto mt-12 flow-root max-w-lg sm:mt-16">

                @if($top_rated_games)

                    <h2 class="sr-only">Popular Games</h2>

                    <ul role="list"
                        class="-mt-6 divide-y divide-slate-900/5 border-b border-slate-900/5 dark:divide-slate-700 dark:border-slate-700">

                        @foreach($top_rated_games as $game)

                            <li class="relative flex gap-x-4 p-4 hover:bg-slate-50 dark:hover:bg-slate-900">
                                <div
                                        class="flex flex-none items-center justify-center rounded-lg shadow-sm ring-1 ring-slate-900/10 dark:ring-slate-700">
                                    <img src="{{$game->icon_image}}"
                                         width="60px"
                                         height="80px"
                                         class="w-[60px] rounded-lg text-xs"
                                         alt="{{$game->name}} Icon">
                                </div>
                                <div class="flex-auto">

                                    <h3 class="text-sm font-medium leading-6 text-slate-700 dark:text-slate-200">
                                        <a href="{{route('game.show', $game->slug)}}"
                                           aria-label="View {{$game->name}} Game Details"
                                        >
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            {{$game->name}}
                                        </a>
                                    </h3>

                                    <div class="text-red-700 dark:text-slate-400">
                                        {!! getRatingStars($game->average_rating) !!}
                                    </div>

                                    <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300 line-clamp-1">
                                        {{$game->meta_description}}
                                    </p>

                                </div>

                                <div class="flex-none self-center">

                                    <svg class="h-5 w-5 text-slate-600 dark:text-slate-300"
                                         viewBox="0 0 20 20"
                                         fill="currentColor"
                                         aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                              clip-rule="evenodd"/>
                                    </svg>

                                </div>

                            </li>

                        @endforeach

                    </ul>

                @endif

                <div class="mt-10 flex justify-center">

                    <a href="{{route('home')}}"
                       class="text-sm font-medium leading-6 text-red-700"
                       aria-label="Go to Home"
                    >
                        <span aria-hidden="true">&larr;</span>
                        Back to home
                    </a>

                </div>

            </div>

        </div>

    </main>

@stop
