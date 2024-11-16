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

            @if($message->movie->videos)
                <div x-data="modalHandler()" class="mb-8">
                    <h2 class="h2 text-center mb-4">Videos for {{$message->movie->title}}</h2>
                    <div class="flex flex-col gap-2 text-center items-center justify-center">
                        @foreach($message->movie->videos as $video)
                            @if(isset($video['source']) && $video['source'] === 'youtube')
                                <button
                                    class="branding-badge"
                                    @click="openVideoModal('https://www.youtube.com/embed/{{$video['key']}}', '{{$video['name']}}')"
                                >
                                    Watch {{$video['name']}}
                                </button>
                            @endif
                        @endforeach
                    </div>

                    <div
                        x-show="is_modal_open"
                        @click.self="closeVideoModal"
                        class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
                        <div class="rounded-lg overflow-hidden w-11/12 md:w-3/4 lg:w-1/2 aspect-video">
                            <div class="flex justify-between items-center px-4 py-2 bg-gray-800 text-white">
                                <div class="text-lg" x-text="video_title"></div>
                                <button
                                    @click="closeVideoModal"
                                    class="text-white hover:text-gray-400"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="size-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
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
                        Submit Message
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
