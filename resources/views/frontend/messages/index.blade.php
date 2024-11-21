@extends('frontend.layouts.app')
@php
    $app_name = config('app.name');
    $title = "Messages for $recipient->title";
    $description = "Read all messages sent for $recipient->title from around the world";
    $social_image = asset('cover.png');
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
                    <p class="mt-6 text-lg leading-8 text-stone-600 dark:text-stone-300">
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
                                @include('frontend.partials._message_tile', ['message' => $message])
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
