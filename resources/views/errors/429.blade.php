@extends('errors::minimal')

@section('title', __('Too Many Requests'))

@section('code', '429')

@section('message')
    <div>
        {{__('You are browsing too fast...')}}
    </div>
    @auth
        <div class="text-center mt-6">
            <a href="{{ route('home') }}"
               class="text-lg border border-lime-200 px-3 py-1.5 bg-lime-50 text-lime-700 rounded-md">
                Go to Home
            </a>
        </div>
    @endauth
    @guest
        <div class="text-center mt-6">
            <a href="{{ route('login', ['go' => url()->current()]) }}"
               class="text-lg border border-red-200 px-3 py-1.5 bg-red-50 text-red-700 rounded-md">
                Read More
            </a>
        </div>
    @endguest
@stop
