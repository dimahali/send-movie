@extends('frontend.layouts.app')

@section('title', 'Joke of the Day')

@section('content')

    <main class="relative min-h-screen">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="px-6 lg:px-8 mt-16">

                <div class="mx-auto max-w-2xl text-center">

                    <h1 class="h1">
                        Joke of the Day
                    </h1>

                </div>

            </div>

            <div
                class="mx-auto mt-16 max-w-2xl text-sm leading-6 text-gray-900">

                <div
                    class="p-6 sm:p-8 rounded-2xl bg-white text-base tracking-wide leading-loose shadow-lg ring-1 ring-gray-900/5 flex justify-between flex-col">

                    <blockquote class="text-gray-900" id="joke">
                        {{$joke->joke}}
                    </blockquote>

                    <div class="mt-6 sm:mt-8 flex items-center gap-x-4">
                        <a
                            href="#"
                            id="categories"
                            class="inline-flex items-center gap-x-1.5 rounded-md branding-badge">
                            <svg class="h-1.5 w-1.5 fill-rose-900" viewBox="0 0 6 6" aria-hidden="true">
                                <circle cx="3" cy="3" r="3"/>
                            </svg>
                            @if($joke->categories->count())
                                {{$joke->categories->pluck('name')->implode(',')}}
                            @else
                                General
                            @endif
                        </a>
                    </div>

                </div>

            </div>

            <div class="px-6 lg:px-8 mt-16">

                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="h2">
                        How do we choose joke of the day?
                    </h2>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        We choose purely random joke for each day using advance algorithm...
                    </p>
                </div>

            </div>

        </div>

    </main>

@stop

@section('seo')
@stop
