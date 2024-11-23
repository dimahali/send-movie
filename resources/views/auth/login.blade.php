@extends('frontend.layouts.app')
@php
    $app_name = config('app.name');
    $title = "Sign in";
    $description = "Sign in to your account to save games";
    $social_image = asset('images/cover.png');
    $route = route('login');
@endphp
@section('title', $title)

@section('content')
    <main class="min-h-[90vh] flex items-center justify-center px-6 lg:px-8">
        <div class="w-full mx-auto py-4 sm:py-6">

            <div
                class="max-w-md mx-auto rounded-lg p-4 sm:p-6 border border-stone-200 dark:border-stone-600 bg-stone-50 dark:bg-stone-700">
                <div class="text-center mb-4">
                    <a href="{{route('home')}}"
                       class="inline-block mx-auto"
                    >
                        <img src="{{asset('logo.png')}}"
                             class="w-24"
                             alt="{{config('app.name')}} Logo">
                    </a>
                    <h1 class="sr-only">
                        Sign in
                    </h1>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')"/>
                <div class="flex flex-col gap-2 items-center justify-center">
                    @include("frontend.partials._social_auth")
                </div>
            </div>
        </div>
    </main>
@stop

@section('seo')
    <meta name="description"
          content="{{$description}}"/>

    <link rel="canonical" href="{{ url()->current() }}"/>

    <meta name="robots" content="index,follow">

    <meta property="og:url" content="{{$social_image}}">
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{$title}} | {{$app_name}}"/>
    <meta property="og:url" content="{{$route}}"/>
    <meta property="og:image" content="{{$social_image}}"/>
    <meta property="og:image:alt" content="Logo of {{$app_name}}">
    <meta property="og:description"
          content="{{$description}}"/>
    <meta property="og:locale" content="en_US"/>

    <meta name="twitter:image:alt"
          content="Logo of {{$app_name}}">

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="{{$title}} | {{$app_name}} | {{$app_name}}"/>

    <meta name="twitter:description"
          content="{{$description}}"/>

    <meta name="twitter:url" content="{{$route}}">

    <meta name="twitter:creator" content="{{$app_name}}"/>
    <meta name="twitter:image" content="{{$social_image}}"/>
@stop
