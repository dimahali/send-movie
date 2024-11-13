@extends('frontend.layouts.app')

@php
    $app_name = config('app.name');
    $title = "Express Your Feelings Through Movies";
    $description = "Send your favorite movies to loved ones and express your feelings";
    $social_image = asset('images/logo.png');
    $route = route('home');
@endphp

@section('title', $title)

@section('content')
    <main class="min-h-[90vh]">
        <section id="intro" class="scroll-mt-[var(--navbar-height)] relative overflow-hidden bg-gray-50">

            <div class="hidden sm:absolute sm:inset-y-0 sm:block sm:h-full sm:w-full" aria-hidden="true">
                <div class="relative mx-auto h-full max-w-7xl">
                    <svg class="absolute right-full translate-x-1/4 translate-y-1/4 transform lg:translate-x-1/2"
                         width="404" height="784" fill="none" viewBox="0 0 404 784">
                        <defs>
                            <pattern id="4522f7d5-8e8c-43ee-89bd-ad34cbfb07fa" x="0" y="0" width="20" height="20"
                                     patternUnits="userSpaceOnUse">
                                <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"/>
                            </pattern>
                        </defs>
                        <rect width="404" height="784" fill="url(#4522f7d5-8e8c-43ee-89bd-ad34cbfb07fa)"/>
                    </svg>
                    <svg
                        class="absolute left-full -translate-x-1/4 -translate-y-3/4 transform md:-translate-y-1/2 lg:-translate-x-1/2"
                        width="404" height="784" fill="none" viewBox="0 0 404 784">
                        <defs>
                            <pattern id="5d0dd344-b041-4d26-bec4-8d33ea57ec9b" x="0" y="0" width="20" height="20"
                                     patternUnits="userSpaceOnUse">
                                <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"/>
                            </pattern>
                        </defs>
                        <rect width="404" height="784" fill="url(#5d0dd344-b041-4d26-bec4-8d33ea57ec9b)"/>
                    </svg>
                </div>
            </div>

            <div class="relative py-16">

                <div class="mx-auto max-w-3xl px-6 sm:px-8">

                    <div class="text-center">

                        <h1 class="h1">
                            <span class="block xl:inline">A bunch of the untold words,</span>
                            <span class="block text-gray-700 xl:inline">sent through the MOVIE</span>
                        </h1>

                        <p class="mx-auto mt-3 max-w-md text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">
                            Express your untold message. Send your favorite movies to loved ones and express your
                            feelings.
                        </p>

                        <div class="mx-auto mt-5 sm:flex sm:justify-center md:mt-8">
                            <div class="rounded-md shadow">
                                <a href="#"
                                   class="flex w-full items-center justify-center rounded-md border border-transparent bg-rose-600 px-8 py-3 text-base font-medium text-white hover:bg-rose-700 md:px-10 md:py-4 md:text-lg">
                                    Send a Message
                                </a>
                            </div>
                            <div class="mt-3 rounded-md shadow sm:ml-3 sm:mt-0">
                                <a href="#"
                                   class="flex w-full items-center justify-center rounded-md border border-transparent bg-white px-8 py-3 text-base font-medium text-rose-600 hover:bg-gray-50 md:px-10 md:py-4 md:text-lg">
                                    Browse
                                </a>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="bg-white py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h2 class="text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">We are
                        growing together</h2>
                    <p class="mt-6 text-base/7 text-gray-600">We are getting more and more support</p>
                </div>
                <div
                    class="mx-auto mt-16 flex max-w-2xl flex-col gap-8 lg:mx-0 lg:mt-20 lg:max-w-none lg:flex-row lg:items-end">
                    <div
                        class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-gray-50 p-8 sm:w-3/4 sm:max-w-md sm:flex-row-reverse sm:items-end lg:w-72 lg:max-w-none lg:flex-none lg:flex-col lg:items-start">
                        <p class="flex-none text-3xl font-bold tracking-tight text-gray-900">{{formatNumbers($total_messages)}}</p>
                        <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                            <p class="text-lg font-semibold tracking-tight text-gray-900">Messages Sent</p>
                            <p class="mt-2 text-base/7 text-gray-600">You are loving it</p>
                        </div>
                    </div>
                    <div
                        class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-gray-900 p-8 sm:flex-row-reverse sm:items-end lg:w-full lg:max-w-sm lg:flex-auto lg:flex-col lg:items-start lg:gap-y-44">
                        <p class="flex-none text-3xl font-bold tracking-tight text-white">{{formatNumbers($total_movies)}}</p>
                        <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                            <p class="text-lg font-semibold tracking-tight text-white">Movies added</p>
                            <p class="mt-2 text-base/7 text-gray-400">We are adding more movies everyday</p>
                        </div>
                    </div>
                    <div
                        class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-indigo-600 p-8 sm:w-11/12 sm:max-w-xl sm:flex-row-reverse sm:items-end lg:w-full lg:max-w-none lg:flex-auto lg:flex-col lg:items-start lg:gap-y-28">
                        <p class="flex-none text-3xl font-bold tracking-tight text-white">{{formatNumbers(130248)}}</p>
                        <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                            <p class="text-lg font-semibold tracking-tight text-white">Daily Visitors</p>
                            <p class="mt-2 text-base/7 text-indigo-200">We are getting noticed</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="scroll-mt-[var(--navbar-height)] py-16 bg-gray-50">

            <div class="mx-auto text-center max-w-3xl px-6 lg:px-8">

                <div
                    class="mb-6 inline-flex leading-none p-2 rounded-md text-lime-700 bg-lime-50 border border-lime-200">
                    Click the message to read full version!
                </div>

                <div class="mx-auto flow-root lg:mx-0 lg:max-w-none">
                    <div class="-mt-8 sm:-mx-4 sm:columns-2 sm:text-[0]">

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
                </div>

            </div>

        </section>

    </main>
@stop

@section('seo')
    <meta name="description"
          content="{{$description}}"/>

    <meta name="robots" content="index,follow">
    <meta property="og:url" content="{{$route}}">
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{$app_name}} | {{$title}}"/>
    <meta property="og:url" content="{{$route}}"/>
    <meta property="og:image" content="{{$social_image}}"/>
    <meta property="og:image:alt" content="{{$app_name}}">
    <meta property="og:description"
          content="{{$description}}"/>
    <meta property="og:locale" content="en_US"/>

    <meta name="twitter:image:alt"
          content="{{$app_name}}">

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="{{$app_name}} | {{$title}}"/>

    <meta name="twitter:description"
          content="{{$description}}"/>

    <meta name="twitter:url" content="{{$route}}">

    <meta name="twitter:creator" content="{{$app_name}}"/>
    <meta name="twitter:image" content="{{$social_image}}"/>

    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebSite",
          "name": "{{$app_name}}",
          "url": "{{config('app.url')}}",
          "sameAs": [],
          "abstract": "{{$description}}",
          "copyrightYear": {{date('Y')}},
          "about": [],
          "mentions": [],
          "isAccessibleForFree": true,
          "image": "{{$social_image}}"
        }
    </script>
@stop
