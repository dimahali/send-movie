@extends('frontend.layouts.app')
@php
    $app_name = config('app.name');
    $title = "Messages for $recipient->title";
    $description = "Read all messages sent for $recipient->title from around the world";
    $social_image = asset('images/logo.png');
    $route = route('recipient.show', $recipient->slug);
@endphp
@section('title', $title)

@section('content')

    <main class="relative min-h-screen">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mt-8">

                <div class="mx-auto max-w-2xl text-center">
                    <h1 class="h1" id="recipient">
                        {{$recipient->title}}
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Here are the messages and movies received for {{$recipient->title}} :)
                    </p>
                </div>

            </div>

            <section class="scroll-mt-[var(--navbar-height)] py-8">

                <div class="mx-auto text-center max-w-3xl px-6 lg:px-8">

                    <div
                        class="mb-6 inline-flex leading-none p-2 rounded-md text-lime-700 bg-lime-50 border border-lime-200">
                        Click the message to read full version!
                    </div>

                    <div class="mx-auto flow-root lg:mx-0 lg:max-w-none">

                        <div class="-mt-8 sm:-mx-4">

                            @foreach($movie_messages as $message)
                                <div class="pt-8 sm:inline-block sm:w-full sm:px-4">

                                    <a href="{{route('message.show', $message->slug)}}"
                                       class="block rounded-2xl leading-loose tracking-wide bg-amber-50 hover:bg-amber-100 border border-amber-200 p-4 sm:p-6 text-base"
                                    >
                                        <div
                                            class="text-center mb-4">
                                            <div
                                                class="inline-flex text-sm text-center mb-4 rounded-md bg-indigo-50 border border-indigo-200 px-2 py-0.5">
                                                {{$message->movieReaction->text}} {{$message->movieReaction->emojis}}
                                            </div>

                                            <blockquote class="text-lg text-gray-700 text-center">
                                                {{$message->short_message}}
                                            </blockquote>

                                            <div class="mt-2 text-sm italic">
                                                Sent {{$message->created_at->diffForHumans()}}
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-center justify-center gap-2">
                                            <h2 class="text-base font-bold text-rose-700 line-clamp-1">
                                                {{$message->movie->title}}
                                            </h2>
                                            <p id="movie-status">{{$message->movie->status}}</p>
                                            <p id="movie-release-date">{{$message->movie->release_date_formated}}</p>
                                        </div>
                                    </a>

                                </div>
                            @endforeach


                        </div>

                        <div class="mt-8 flex items-center justify-center gap-4">
                            {{$movie_messages->links()}}
                        </div>
                    </div>

                </div>

            </section>
        </div>

    </main>
@stop

@section('seo')
@stop
