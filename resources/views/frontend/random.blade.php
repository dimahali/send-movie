@extends('frontend.layouts.app')
@php
    $app_name = config('app.name');
    $title = "Random Message";
    $description = "Read random messages sent by people around the world";
    $social_image = asset('images/logo.png');
    $route = route('get.random.message');
@endphp
@section('title', $title)

@section('content')

    <main class="relative min-h-screen">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mt-8">

                <div class="mx-auto max-w-2xl text-center">
                    <h1 class="h1">
                        Hello <span class="text-gray-700" id="recipient">{{$message->recipient_title}}</span>
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        There's someone sending you a movie, they want you to watch this movie and they think you'll
                        like :)
                    </p>
                </div>

            </div>

            <div class="mx-auto my-8 max-w-xl">

                <div class="flex gap-4 bg-amber-50 border border-amber-100 rounded-md shadow p-4">
                    <div class="shrink-0">
                        <img src="{{$message->movie->icon_image}}"
                             class="h-full max-w-24 rounded-md"
                             alt="{{$message->movie->title}}"
                             id="movie-poster"
                        >
                    </div>
                    <div class="flex flex-col justify-around">
                        <h2 class="text-2xl font-bold text-rose-700"
                            id="movie-title"
                        >
                            {{$message->movie->title}}
                        </h2>
                        <p id="movie-genres">{{$message->movie->genres}}</p>
                        <p id="movie-status">{{$message->movie->status}}</p>
                        <p id="movie-release-date">{{$message->movie->release_date_formated}}</p>
                    </div>
                </div>

            </div>

            <div
                class="mx-auto max-w-2xl text-sm leading-6 text-gray-700">

                <p class="text-xl text-green-700 underline underline-offset-4 decoration-dashed text-center mb-6">
                    Also, here's a message from the sender
                </p>

                <div
                    class="text-center text-base">
                    <div
                        class="text-base inline-flex text-center mb-4 rounded-md bg-green-50 border border-green-200 px-3 py-1.5"
                        id="movie-reaction"
                    >
                        {{$message->movieReaction->text}} {{$message->movieReaction->emojis}}
                    </div>

                    <blockquote class="text-xl text-gray-700 text-center" id="movie-message">
                        {{$message->message}}
                    </blockquote>

                    <div id="message-date" class="mt-4 text-sm italic">
                        Sent on {{$message->message_date}}
                    </div>
                </div>
                <div class="fixed bottom-4 left-1/2 transform -translate-x-1/2">
                    <button onclick="fetchMovieMessage()"
                            class="text-lg inline-flex items-center justify-center gap-1 px-3 py-1.5 bg-rose-500 text-white rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                        </svg>
                    </button>
                </div>

            </div>

        </div>

    </main>

    <script>
        function fetchMovieMessage() {
            fetch("{{route('post.random.message')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('movie-poster').src = data.movie.icon_image;
                    document.getElementById('movie-title').innerText = data.movie.title;
                    document.getElementById('movie-genres').innerText = data.movie.genres;
                    document.getElementById('movie-status').innerText = data.movie.status;
                    document.getElementById('movie-message').innerText = data.message;
                    document.getElementById('recipient').innerText = data.recipient_title;
                    document.getElementById('movie-reaction').innerText = data.movie_reaction.text + ' ' + data.movie_reaction.emojis;
                    document.getElementById('message-date').innerText = "Sent on " + data.message_date;
                })
                .catch(error => {
                    console.error('Error fetching message:', error);
                });
        }
    </script>

@stop

@section('seo')
@stop
