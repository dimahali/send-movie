@extends('frontend.layouts.app')

@section('content')

    <main class="py-16">

        <div class="px-6 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">

                <h1 class="h1">
                    Unlimited Dad Jokes
                </h1>

                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Unlimited Dad Jokes brings non-stop laughter for you! Dive into an endless stream of dad jokes that
                    will keep you entertained for hours.
                </p>

                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Scroll through and enjoy a continuous supply of jokes that are great for sharing with friends and
                    family.
                </p>

            </div>

        </div>

        <div class="mx-auto max-w-xl px-6 lg:px-8 mt-16">

            <ul role="list" class="space-y-6">

                @foreach($jokes as $joke)

                    <li class="relative flex gap-x-4">

                        <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                            <div class="w-px bg-gray-200"></div>
                        </div>

                        <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white">
                            <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                        </div>

                        <div class="flex-auto rounded-md p-6 ring-1 ring-inset ring-gray-200">

                            <p class="text-base lowercase first-letter:uppercase leading-loose tracking-wide">
                                {!! $joke->joke !!}
                            </p>

                            <div class="flex justify-between gap-x-4 mt-6">
                                <time datetime="2023-01-23T15:56"
                                      class="flex-none py-0.5 text-xs leading-5 text-gray-500">
                                    {{$joke->created_at->diffForHumans()}}
                                </time>
                                <div class="py-0.5 text-xs leading-5 text-gray-500">
                                    <span class="branding-badge">General</span>
                                </div>
                            </div>

                        </div>

                    </li>

                @endforeach

            </ul>

            <div class="pagination-container mx-auto mt-16">
                {{$jokes->links()}}
            </div>

        </div>

    </main>

@stop

@section('seo')
@stop
