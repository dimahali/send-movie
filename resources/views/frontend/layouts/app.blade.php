<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ dark_mode: false, openFilter: false, open_search_modal:false }"
      x-init="
              if (!('dark_mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                localStorage.setItem('dark_mode', JSON.stringify(true));
              }
              dark_mode = JSON.parse(localStorage.getItem('dark_mode'));
              $watch('dark_mode', value => localStorage.setItem('dark_mode', JSON.stringify(value)))
              "
      x-cloak
      x-bind:class="{'dark' : dark_mode === true}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-adsense-account" content="ca-pub-3489282767302861">
    <title>@yield('title') | {{config('app.name')}}</title>

    @yield('seo')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    @vite(['resources/css/app.css'])

    @yield('styles')

</head>

<body class="bg-white dark:bg-slate-800 text-sm sm:text-base">

@include('frontend.partials.header')

@yield('content')

<div @keydown.window.escape="open_search_modal = false"
     x-show="open_search_modal"
     class="relative z-10"
     x-ref="dialog"
>
    <div x-show="open_search_modal"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-description="Background backdrop, show/hide based on modal state."
         class="fixed inset-0 bg-slate-500 bg-opacity-75 transition-opacity">
    </div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">

        <div
            class="flex min-h-full justify-center p-4 text-center items-center sm:p-0">

            <div x-show="open_search_modal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-description="Modal panel, show/hide based on modal state."
                 class="relative transform overflow-hidden rounded-lg bg-white dark:bg-slate-700 p-6 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                 @click.away="open_search_modal = false">

                <form
                    method="GET"
                    action="{{route('search')}}"
                    role="search"
                >

                    <h3 class="text-base sm:text-xl font-bold text-red-700 dark:text-slate-200">
                        Cannot find a Game? Search Here...
                    </h3>

                    <input type="hidden" name="st" value="tnb">

                    <div class="mt-2">

                        <label for="game_title" class="sr-only">Search</label>

                        <input type="text"
                               name="game_title"
                               id="game_title"
                               placeholder="Game Name..."
                               minlength="3"
                               maxlength="60"
                               class="block w-full rounded-md border-0 p-3 text-slate-700 dark:text-slate-300 dark:bg-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-300 focus:ring-0 focus:ring-inset focus:ring-red-500 sm:text-sm"
                               aria-required="true"
                        >

                    </div>

                    <div class="mt-2 flex justify-end items-center">
                        <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-6 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-red-500 sm:w-auto">
                            Search
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@include('frontend.partials.footer')

@if(!Route::is('game.show') && !Route::is('game.chapter.show'))
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
@endif

@yield('scripts')
</body>

</html>
