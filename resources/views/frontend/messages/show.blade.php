@extends('frontend.layouts.app')
@php
    $app_name = config('app.name');
    $title = $message->messageRecipient->title;
    $description = "Movie message for $title on $message->message_date";
    $social_image = asset('cover.png');
    $route = route('message.show', $message->slug);
@endphp
@section('title', $title)

@section('content')

    <main class="relative min-h-screen">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mt-8">

                <div class="mx-auto max-w-2xl text-center">
                    <h1 class="h1">
                        {{$message->messageRecipient->title}}
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        There's someone sending you a movie, they want you to watch this movie and they think you'll
                        like :)
                    </p>
                </div>

            </div>

            <div class="mx-auto text-center my-8 max-w-xl">

                <div class="inline-flex gap-4 bg-amber-50 border border-amber-100 rounded-md shadow p-4">
                    <div class="shrink-0">
                        <img src="{{$message->movie->icon_image}}"
                             class="max-w-28 max-h-42 rounded-md"
                             width="112px"
                             height="168px"
                             alt="{{$message->movie->title}}"
                        >
                    </div>
                    <div class="flex flex-col text-left justify-around">
                        <h2 class="text-xl font-bold text-rose-700">
                            {{$message->movie->title}}
                        </h2>
                        <p>{{$message->movie->genres}}</p>
                        <p>{{$message->movie->status}}</p>
                        <p>{{$message->movie->release_date_formated}}</p>
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
                    >
                        {{$message->movieReaction->text}} {{$message->movieReaction->emojis}}
                    </div>

                    <blockquote class="prose text-xl text-gray-700 text-center">
                        {!!$message->message_display !!}
                    </blockquote>

                    <div class="mt-4 text-sm italic">
                        Sent on {{$message->message_date}}
                    </div>
                </div>
                <div class="text-center my-12">
                    <a href="{{route('get.message.now')}}"
                       class="px-3 py-2 bg-green-700 hover:bg-green-600 text-white rounded-md"
                    >
                        Send Message
                    </a>
                </div>

            </div>

        </div>

    </main>

@stop

@section('seo')
@stop
