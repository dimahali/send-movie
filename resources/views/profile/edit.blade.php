@extends('frontend.layouts.app')
@php
    $app_name = config('app.name');
    $title = "Edit Profile";
    $description = "Edit your profile and change details as you wish";
    $social_image = asset('images/cover.png');
    $route = route('profile.edit');
@endphp
@section('title', $title)

@section('content')
    <main class="min-h-[90vh] flex items-center justify-center my-4 sm:my-6 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-stone-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
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

