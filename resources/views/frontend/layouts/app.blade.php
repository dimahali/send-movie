<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ dark_mode: false, open_search_modal:false }"
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
<body class="bg-white dark:bg-stone-800 text-sm sm:text-base">
@include('frontend.partials.header')
@yield('content')
@include('frontend.partials.footer')
<div x-data="{ search: '', results: [] }">
    <div x-show="open_search_modal"
         x-trap="open_search_modal"
         class="fixed inset-0 z-40 flex items-center justify-center bg-stone-900 bg-opacity-50">
        <div @click.away="open_search_modal = false; results=[];search=''"
             class="relative bg-transparent rounded-lg shadow-lg w-11/12 max-w-lg">
            <input type="text"
                   x-ref="searchInput"
                   x-model="search"
                   @input.debounce.500ms="fetchResults"
                   placeholder="Start Typing..."
                   class="w-full px-4 py-2 border border-stone-300 rounded-lg focus:outline-none focus:border-blue-500"/>

            <div x-show="results.length > 0" class="mt-2 bg-white border border-stone-200 rounded-lg shadow-md">
                <template x-for="result in results" :key="result.id">
                    <a :href="`/r/${result.slug}`" class="block px-4 py-2 text-stone-800 hover:bg-stone-100">
                        <span x-text="result.title"></span>
                    </a>
                </template>
            </div>

            <div x-show="results.length === 0 && search !== ''"
                 class="mt-2 p-2 text-center bg-white border border-stone-200 rounded-lg shadow-md">
                No results found
            </div>
        </div>
    </div>
</div>
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
<script>
    function fetchResults() {
        if (this.search.length <= 3) {
            return false;
        }

        fetch(`/search?query=${this.search}`)
            .then(response => response.json())
            .then(data => this.results = data)
            .catch();
    }
</script>
@yield('scripts')
</body>
</html>
