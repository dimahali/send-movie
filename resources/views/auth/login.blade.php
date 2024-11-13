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
                class="max-w-md mx-auto rounded-lg p-4 sm:p-6 border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700">
                <div class="text-center mb-4">
                    <a href="{{route('home')}}"
                       class="inline-block mx-auto"
                    >
                        <img src="{{url('images/logo_sm.webp')}}"
                             class="w-24"
                             alt="{{config('app.name')}} Logo">
                    </a>
                    <h1 class="sr-only">
                        Sign in
                    </h1>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')"/>

                <form method="POST"
                      action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="go" id="go" value="{{ request('go') }}">

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')"/>
                        <x-text-input id="email"
                                      class="mt-1 block w-full px-3 py-1.5 border"
                                      type="email" name="email"
                                      :value="old('email')"
                                      required
                                      autofocus
                                      autocomplete="username"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">

                        <x-input-label for="password" :value="__('Password')"/>

                        <x-text-input id="password"
                                      class="mt-1 block w-full px-3 py-1.5 border"
                                      type="password"
                                      name="password"
                                      required
                                      autocomplete="current-password"/>

                        <x-input-error :messages="$errors->get('password')" class="mt-2"/>

                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                   name="remember">
                            <span class="ms-2 text-sm text-slate-600 dark:text-slate-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between gap-x-4 mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-red-700 dark:text-slate-300 hover:text-red-900 dark:hover:text-slate-100"
                               href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif

                        <x-primary-button>
                            {{ __('Sign in') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="mt-4 text-sm text-right text-slate-700 dark:text-slate-300">
                    New User?
                    <a href="{{route('register', ['go' => request('go')])}}"
                       class="text-base text-red-700 dark:text-red-200 underline font-semibold">
                        Register Here
                    </a>
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
