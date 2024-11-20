@extends('frontend.layouts.app')
@php
    $app_name = config('app.name');
    $title = "Random Message";
    $description = "Read random messages sent by people around the world";
    $social_image = asset('cover.png');
    $route = route('get.random.message');
@endphp
@section('title', $title)

@section('content')
    <main class="relative min-h-screen">

        <div class="mx-auto my-8 max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h1 class="h1" id="recipient">
                    {{$message->recipient_title}}
                </h1>
                <p class="mt-6 text-lg leading-8 text-stone-600 dark:text-stone-300">
                    Someone’s sending you a movie they know you’ll love— because it’s exactly your vibe.
                </p>
            </div>

            <div class="mx-auto my-8 max-w-xl">

                <div class="flex gap-4 bg-amber-50 dark:bg-amber-100 border border-amber-100 rounded-md shadow p-4">
                    <div class="shrink-0">
                        <img src="{{$message->movie->icon_image}}"
                             class="max-w-28 max-h-42 rounded-md"
                             width="112px"
                             height="168px"
                             alt="{{$message->movie->title}}"
                        >
                    </div>
                    <div class="flex flex-col justify-around">
                        <h2 class="text-xl font-bold text-rose-700">
                            {{$message->movie->title}}
                        </h2>
                        <p>{{$message->movie->genres}}</p>
                        <p>{{$message->movie->status}}</p>
                        <p>{{$message->movie->release_date_formated}}</p>
                    </div>
                </div>

            </div>

            @if($message->movie->videos)
                <div x-data="modalHandler()" class="mb-8">
                    <h2 class="h2 text-center mb-4">Videos for {{$message->movie->title}}</h2>
                    <div class="flex flex-col gap-2 text-center items-center justify-center">
                        @foreach($message->movie->videos as $video)
                            <button
                                class="branding-badge"
                                @click="openVideoModal('https://www.youtube.com/embed/{{$video['key']}}', '{{$video['name']}}')"
                            >
                                Watch {{$video['name']}}
                            </button>
                        @endforeach
                    </div>

                    <div
                        x-show="is_modal_open"
                        @click.self="closeVideoModal"
                        class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
                        <div class="rounded-lg overflow-hidden w-11/12 md:w-3/4 lg:w-1/2 aspect-video">
                            <div class="flex justify-between items-center px-4 py-2 bg-stone-800 text-white">
                                <div class="text-lg" x-text="video_title"></div>
                                <button
                                    @click="closeVideoModal"
                                    class="text-white hover:text-stone-400"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="size-8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                </button>
                            </div>
                            <iframe
                                :src="video_url"
                                class="w-full aspect-video rounded-br rounded-bl"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            @endif

            <div
                class="mx-auto max-w-2xl text-sm leading-6 text-stone-700 dark:text-stone-300">

                <p class="text-xl text-green-700 dark:text-green-300 underline underline-offset-4 decoration-dashed text-center mb-6">
                    Also, here's a message from the sender
                </p>

                <div
                    class="text-center text-base">
                    <div
                        class="text-base inline-flex text-center mb-4 rounded-md bg-green-50 dark:bg-stone-900 dark:border-stone-700 border border-green-200 px-3 py-1.5"
                    >
                        {{$message->movieReaction->text}} {{$message->movieReaction->emojis}}
                    </div>

                    <blockquote class="text-xl text-stone-700 dark:text-stone-300 text-center">
                        {{$message->message}}
                    </blockquote>

                    <div class="mt-4 text-sm italic">
                        Sent on {{$message->message_date}}
                    </div>
                </div>

                <div class="fixed bottom-4 left-1/2 transform -translate-x-1/2">
                    <a href="{{route('get.random.message')}}"
                       class="px-3 py-2 bg-green-700 hover:bg-green-600 text-white rounded-md">
                        Load More
                    </a>
                </div>
            </div>
        </div>

    </main>
@stop
@section('scripts')
    <script>
        function modalHandler() {
            return {
                is_modal_open: false,
                video_title: '',
                video_url: '',
                openVideoModal(url, title) {
                    this.video_url = url;
                    this.video_title = title;
                    this.is_modal_open = true;
                },
                closeVideoModal() {
                    this.is_modal_open = false;
                    this.video_title = '';
                    this.video_url = '';
                }
            };
        }
    </script>
@endsection
@section('seo')
    <link rel="canonical" href="{{$route}}"/>
    <meta name="description" content="{{$description}}"/>
    <meta property="og:url" content="{{$route}}">
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{$title}} | {{$app_name}}"/>
    <meta property="og:url" content="{{$route}}"/>
    <meta property="og:image" content="{{$social_image}}"/>
    <meta property="og:image:alt" content="{{$app_name}}">
    <meta property="og:description" content="{{$description}}"/>
    <meta property="og:locale" content="en_US"/>
    <meta name="twitter:image:alt" content="{{$title}} | {{$app_name}}">
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="{{$title}} | {{$app_name}}"/>
    <meta name="twitter:description" content="{{$description}}"/>
    <meta name="twitter:url" content="{{$route}}">
    <meta name="twitter:creator" content="{{$app_name}}"/>
    <meta name="twitter:image" content="{{$social_image}}"/>
@stop
