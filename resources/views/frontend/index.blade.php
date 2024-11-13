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
                    <svg class="absolute right-full translate-x-1/4 translate-y-1/4 transform lg:translate-x-1/2" width="404" height="784" fill="none" viewBox="0 0 404 784">
                        <defs>
                            <pattern id="4522f7d5-8e8c-43ee-89bd-ad34cbfb07fa" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                            </pattern>
                        </defs>
                        <rect width="404" height="784" fill="url(#4522f7d5-8e8c-43ee-89bd-ad34cbfb07fa)" />
                    </svg>
                    <svg class="absolute left-full -translate-x-1/4 -translate-y-3/4 transform md:-translate-y-1/2 lg:-translate-x-1/2" width="404" height="784" fill="none" viewBox="0 0 404 784">
                        <defs>
                            <pattern id="5d0dd344-b041-4d26-bec4-8d33ea57ec9b" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                            </pattern>
                        </defs>
                        <rect width="404" height="784" fill="url(#5d0dd344-b041-4d26-bec4-8d33ea57ec9b)" />
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
                            Express your untold message. Send your favorite movies to loved ones and express your feelings.
                        </p>

                        <div class="mx-auto mt-5 sm:flex sm:justify-center md:mt-8">
                            <div class="rounded-md shadow">
                                <a href="#" class="flex w-full items-center justify-center rounded-md border border-transparent bg-rose-600 px-8 py-3 text-base font-medium text-white hover:bg-rose-700 md:px-10 md:py-4 md:text-lg">
                                    Send a Message
                                </a>
                            </div>
                            <div class="mt-3 rounded-md shadow sm:ml-3 sm:mt-0">
                                <a href="#" class="flex w-full items-center justify-center rounded-md border border-transparent bg-white px-8 py-3 text-base font-medium text-rose-600 hover:bg-gray-50 md:px-10 md:py-4 md:text-lg">
                                    Browse
                                </a>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <div class="bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h2 class="text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">We approach work as a place to make the world better</h2>
                    <p class="mt-6 text-base/7 text-gray-600">Diam nunc lacus lacus aliquam turpis enim. Eget hac velit est euismod lacus. Est non placerat nam arcu. Cras purus nibh cursus sit eu in id. Integer vel nibh.</p>
                </div>
                <div class="mx-auto mt-16 flex max-w-2xl flex-col gap-8 lg:mx-0 lg:mt-20 lg:max-w-none lg:flex-row lg:items-end">
                    <div class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-gray-50 p-8 sm:w-3/4 sm:max-w-md sm:flex-row-reverse sm:items-end lg:w-72 lg:max-w-none lg:flex-none lg:flex-col lg:items-start">
                        <p class="flex-none text-3xl font-bold tracking-tight text-gray-900">250k</p>
                        <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                            <p class="text-lg font-semibold tracking-tight text-gray-900">Users on the platform</p>
                            <p class="mt-2 text-base/7 text-gray-600">Vel labore deleniti veniam consequuntur sunt nobis.</p>
                        </div>
                    </div>
                    <div class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-gray-900 p-8 sm:flex-row-reverse sm:items-end lg:w-full lg:max-w-sm lg:flex-auto lg:flex-col lg:items-start lg:gap-y-44">
                        <p class="flex-none text-3xl font-bold tracking-tight text-white">$8.9 billion</p>
                        <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                            <p class="text-lg font-semibold tracking-tight text-white">We’re proud that our customers have made over $8 billion in total revenue.</p>
                            <p class="mt-2 text-base/7 text-gray-400">Eu duis porta aliquam ornare. Elementum eget magna egestas.</p>
                        </div>
                    </div>
                    <div class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-indigo-600 p-8 sm:w-11/12 sm:max-w-xl sm:flex-row-reverse sm:items-end lg:w-full lg:max-w-none lg:flex-auto lg:flex-col lg:items-start lg:gap-y-28">
                        <p class="flex-none text-3xl font-bold tracking-tight text-white">401,093</p>
                        <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                            <p class="text-lg font-semibold tracking-tight text-white">Transactions this year</p>
                            <p class="mt-2 text-base/7 text-indigo-200">Eu duis porta aliquam ornare. Elementum eget magna egestas. Eu duis porta aliquam ornare.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">From the blog</h2>
                    <p class="mt-2 text-lg/8 text-gray-600">Learn how to grow your business with our expert advice.</p>
                </div>
                <div class="mx-auto mt-16 grid max-w-2xl auto-rows-fr grid-cols-1 gap-8 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80">
                        <img src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3603&q=80" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
                        <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                        <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>

                        <div class="flex flex-wrap items-center gap-y-1 overflow-hidden text-sm/6 text-gray-300">
                            <time datetime="2020-03-16" class="mr-8">Mar 16, 2020</time>
                            <div class="-ml-4 flex items-center gap-x-4">
                                <svg viewBox="0 0 2 2" class="-ml-0.5 h-0.5 w-0.5 flex-none fill-white/50">
                                    <circle cx="1" cy="1" r="1" />
                                </svg>
                                <div class="flex gap-x-2.5">
                                    <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-6 w-6 flex-none rounded-full bg-white/10">
                                    Michael Foster
                                </div>
                            </div>
                        </div>
                        <h3 class="mt-3 text-lg/6 font-semibold text-white">
                            <a href="#">
                                <span class="absolute inset-0"></span>
                                Boost your conversion rate
                            </a>
                        </h3>
                    </article>

                    <!-- More posts... -->
                </div>
            </div>
        </div>

        <div class="bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">From the blog</h2>
                    <p class="mt-2 text-lg/8 text-gray-600">Learn how to grow your business with our expert advice.</p>
                </div>
                <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    <article class="flex flex-col items-start justify-between">
                        <div class="relative w-full">
                            <img src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3603&q=80" alt="" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                        </div>
                        <div class="max-w-xl">
                            <div class="mt-8 flex items-center gap-x-4 text-xs">
                                <time datetime="2020-03-16" class="text-gray-500">Mar 16, 2020</time>
                                <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">Marketing</a>
                            </div>
                            <div class="group relative">
                                <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600">
                                    <a href="#">
                                        <span class="absolute inset-0"></span>
                                        Boost your conversion rate
                                    </a>
                                </h3>
                                <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600">Illo sint voluptas. Error voluptates culpa eligendi. Hic vel totam vitae illo. Non aliquid explicabo necessitatibus unde. Sed exercitationem placeat consectetur nulla deserunt vel. Iusto corrupti dicta.</p>
                            </div>
                            <div class="relative mt-8 flex items-center gap-x-4">
                                <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-10 w-10 rounded-full bg-gray-100">
                                <div class="text-sm/6">
                                    <p class="font-semibold text-gray-900">
                                        <a href="#">
                                            <span class="absolute inset-0"></span>
                                            Michael Foster
                                        </a>
                                    </p>
                                    <p class="text-gray-600">Co-Founder / CTO</p>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- More posts... -->
                </div>
            </div>
        </div>

        <section id="latest-jokes" class="scroll-mt-[var(--navbar-height)] relative py-16 bg-gray-50">

            <div class="mx-auto max-w-3xl px-6 lg:px-8">

                <div
                    class="mx-auto grid grid-cols-1 grid-rows-1 gap-8 text-sm leading-6 text-gray-900 sm:grid-cols-2 xl:max-w-5xl">

                        <div
                            class="p-6 sm:p-8 rounded-2xl bg-white text-base tracking-wide leading-loose shadow-lg ring-1 ring-gray-900/5 flex justify-between flex-col">

                            <blockquote class="text-gray-900">
                                This is the joke for viewing to the visitor
                            </blockquote>

                            <div class="mt-6 sm:mt-8 flex items-center gap-x-4">
                                <a
                                    href="#"
                                    class="inline-flex items-center gap-x-1.5 rounded-md branding-badge">
                                    <svg class="h-1.5 w-1.5 fill-rose-900" viewBox="0 0 6 6" aria-hidden="true">
                                        <circle cx="3" cy="3" r="3"/>
                                    </svg>
                                    General
                                </a>
                            </div>

                        </div>

                </div>

            </div>

        </section>

        <section id="popular-jokes" class="scroll-mt-[var(--navbar-height)] py-16">

            <div class="mx-auto max-w-3xl px-6 lg:px-8">

                <div class="mx-auto flow-root lg:mx-0 lg:max-w-none">

                    <div class="-mt-8 sm:-mx-4 sm:columns-2 sm:text-[0]">

                            <div class="pt-8 sm:inline-block sm:w-full sm:px-4">

                                <div class="rounded-2xl leading-loose tracking-wide bg-gray-50 p-8 text-base">
                                    <blockquote class="text-gray-900">
                                        This is the joke to be read
                                    </blockquote>
                                    <div class="mt-6 flex items-center gap-x-4">
                                        <a
                                            href="#"
                                            class="inline-flex items-center gap-x-1.5 branding-badge">
                                            <svg class="h-1.5 w-1.5 fill-rose-700" viewBox="0 0 6 6" aria-hidden="true">
                                                <circle cx="3" cy="3" r="3"/>
                                            </svg>
                                            General
                                        </a>
                                    </div>
                                </div>

                            </div>

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
