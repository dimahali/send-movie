@extends('frontend.layouts.app')
@php
    $app_name = config('app.name');
    $title = "Forgot Password?";
    $description = "Request a password reset link to reset your account password.";
    $social_image = asset('images/cover.png');
    $route = route('password.request');
@endphp
@section('title', $title)

@section('content')
    <main class="min-h-[90vh] flex items-center justify-center px-6 lg:px-8">
        <div class="w-full mx-auto py-4 sm:py-6">

            <div
                class="max-w-md mx-auto rounded-lg p-4 sm:p-6 border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700">
                <div class="text-center mb-4">
                    <a href="{{route('home')}}"
                       class="inline-block mx-auto"
                    >
                        <img src="{{url('images/logo_sm.webp')}}"
                             class="w-24"
                             alt="{{config('app.name')}} Logo">
                    </a>
                    <h1 class="max-w-xl mx-auto font-bold text-center text-2xl leading-tight text-slate-700 dark:text-slate-100 text-balance">
                        Forgot password?
                    </h1>
                </div>

                <div class="mb-4 text-sm text-slate-600 dark:text-slate-300">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')"/>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')"/>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                      :value="old('email')" required autofocus/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@stop

@section('seo')
    <meta name="description"
          content="{{$description}}"/>

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
