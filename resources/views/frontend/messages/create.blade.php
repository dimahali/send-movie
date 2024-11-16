@extends('frontend.layouts.app')
@php
    $app_name = config('app.name');
    $title = "Send Message";
    $description = "Send a new Movie Message to Someone.";
    $social_image = asset('images/logo.png');
    $route = route('get.message.now');
@endphp
@section('title', $title)

@section('content')

    <main class="relative min-h-screen">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mt-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h1 class="h1" id="recipient">
                        Send a Message
                    </h1>
                </div>
            </div>

            <div class="mx-auto my-8 max-w-xl">
                <div class="mt-6 text-base text-rose-700 bg-rose-50 border border-rose-200 p-4 rounded-md">
                    Please note that you are publishing the message anonymously you cannot delete/edit the message after
                    publishing.
                </div>

                @if(session('message_url'))
                    <div class="my-4 p-4 bg-gray-100 rounded">
                        <label class="block text-gray-700 font-medium leading-none mb-1">Message URL:</label>
                        <div class="flex items-center space-x-2">
                            <input id="message_url"
                                   type="text"
                                   value="{{ session('message_url') }}"
                                   readonly
                                   class="p-2 rounded bg-gray-50 text-gray-800 border border-gray-300 w-full">
                            <button onclick="copyToClipboard()"
                                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Copy
                            </button>
                        </div>
                    </div>
                @endif

                @if(session('message'))
                    <div class="my-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="mt-4 bg-gray-50 rounded p-6 border border-gray-200">
                    <form action="{{route('post.message.now')}}"
                          method="POST"
                          class="flex flex-col gap-y-5"
                    >
                        @csrf
                        <div x-data="recipientDropdown()">
                            <label for="recipient" class="form-label">
                                Recipient
                            </label>

                            <div class="mt-2 relative">
                                <input type="text"
                                       id="recipient"
                                       name="recipient"
                                       x-model="query"
                                       @input="fetchSuggestionsDebounced"
                                       @focus="showDropdown"
                                       @blur="hideDropdown"
                                       class="form-input"
                                       placeholder="Start Typing..."
                                       required
                                       minlength="3"
                                       maxlength="60"
                                >

                                <ul x-show="isOpen && filteredSuggestions.length > 0"
                                    @click.outside="hideDropdown"
                                    class="combo-items-container">
                                    <template x-for="item in filteredSuggestions" :key="item.id">
                                        <li @click="selectSuggestion(item.title)"
                                            class="cursor-pointer px-4 py-2 hover:bg-indigo-100">
                                            <span x-text="item.title"></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>

                        <div x-data="movieComboBox()">
                            <label for="combobox" class="form-label">
                                Choose Movie
                            </label>
                            <div class="mt-2 relative">
                                <div class="relative">
                                    <input id="combobox"
                                           type="text"
                                           x-model="query"
                                           @input.debounce.300ms="fetchMovies"
                                           placeholder="Search movie..."
                                           class="form-input"
                                           role="combobox"
                                           aria-controls="options"
                                           aria-expanded="false"
                                           required
                                    >
                                    <button type="button"
                                            class="absolute inset-y-0 right-0 top-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                        <svg class="h-5 w-5 text-gray-400"
                                             viewBox="0 0 20 20"
                                             fill="currentColor"
                                             aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M10.53 3.47a.75.75 0 0 0-1.06 0L6.22 6.72a.75.75 0 0 0 1.06 1.06L10 5.06l2.72 2.72a.75.75 0 1 0 1.06-1.06l-3.25-3.25Zm-4.31 9.81 3.25 3.25a.75.75 0 0 0 1.06 0l3.25-3.25a.75.75 0 1 0-1.06-1.06L10 14.94l-2.72-2.72a.75.75 0 0 0-1.06 1.06Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>
                                <ul class="combo-items-container"
                                    x-show="movies.length > 0"
                                    id="options"
                                    role="listbox"
                                >
                                    <template x-for="(movie, index) in movies" :key="movie.id">
                                        <li @click="selectMovie(movie)"
                                            @mouseenter="selectedIndex = index"
                                            @mouseleave="selectedIndex = null"
                                            class="relative hover:bg-gray-100 cursor-pointer select-none px-6 py-2"
                                            role="option"
                                            :aria-selected="selectedMovie.id === movie.id"
                                        >
                                            <div x-text="movie.title"
                                                 :class="{'font-semibold': selectedMovie.id === movie.id}"
                                                 class="block truncate text-amber-900">
                                            </div>
                                            <div x-text="'Release Year: ' + movie.release_date"
                                                 class="block truncate text-sm text-gray-700">
                                            </div>
                                            <div x-show="selectedMovie.id === movie.id"
                                                 class="absolute inset-y-0 left-0 flex items-center pl-0.5 text-lime-700">
                                                <svg class="size-5"
                                                     viewBox="0 0 20 20"
                                                     fill="currentColor"
                                                     aria-hidden="true"
                                                >
                                                    <path fill-rule="evenodd"
                                                          d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                                <input type="hidden" name="movie_id" :value="selectedMovie.id">
                                <p class="leading-tight text-right text-xs text-gray-600">
                                    {{formatNumbers($total_movies)}} Movies
                                </p>
                                @error('movie_id')
                                <p class="mt-1 ml-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div x-data="{ message: '{{old('message')}}', max_characters: 999 }">
                            <label for="message" class="form-label">
                                Message
                            </label>
                            <div class="mt-2">
                             <textarea id="message"
                                       name="message"
                                       x-model="message"
                                       @input="message = message.slice(0, max_characters)"
                                       rows="3"
                                       minlength="3"
                                       maxlength="999"
                                       class="form-input"
                                       placeholder="Type your message here..."
                                       required
                             >{{ old('message') }}</textarea>
                                @error('message')
                                <p class="ml-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="leading-tight text-right text-xs text-gray-600">
                                    Characters Remaining <span x-text="max_characters - message.length"></span>
                                </p>
                            </div>
                        </div>

                        <div>
                            <label class="sr-only">This movie is a</label>
                            <div>
                                <select id="movie_reaction_id"
                                        size="4"
                                        name="movie_reaction_id"
                                        class="form-input shrink"
                                        required
                                >
                                    @foreach($reactions as $id => $title)
                                        <option class="py-1"
                                                value="{{$id}}" @selected(old('movie_reaction_id') == $id)>{{$title}}</option>
                                    @endforeach
                                </select>
                                @error('movie_reaction_id')
                                <p class="ml-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit"
                                    class="text-base rounded-md bg-lime-600 px-3 py-2 text-white shadow-sm hover:bg-lime-500">
                                Submit Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

@stop

@section('scripts')
    <script>
        function movieComboBox() {
            return {
                query: '',
                movies: [],
                selectedMovie: {},
                selectedIndex: null,

                fetchMovies() {
                    if (this.query.length < 3) {
                        this.movies = [];
                        return;
                    }

                    fetch("{{route('api.movies')}}", {
                        method: 'POST',
                        body: JSON.stringify({search_term: this.query}),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                        .then(response => response.json())
                        .then(data =>{
                            this.movies = data.map(movie => ({
                                id: movie.id,
                                title: movie.title,
                                release_date: movie.release_year || 'N/A',
                            }));
                        });
                },

                selectMovie(movie) {
                    this.selectedMovie = movie;
                    this.query = movie.title;
                    this.movies = [];
                }
            };
        }

        function recipientDropdown() {
            return {
                query: '',
                isOpen: false,
                filteredSuggestions: [],
                debounceTimer: null,

                async fetchSuggestions() {
                    if (this.query.trim().length < 3) {
                        this.filteredSuggestions = [];
                        return;
                    }

                    try {
                        fetch("{{route('api.topics')}}", {
                            method: 'POST',
                            body: JSON.stringify({search_term: this.query}),
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                this.filteredSuggestions = data;
                            });
                    } catch (error) {}
                },

                fetchSuggestionsDebounced() {
                    clearTimeout(this.debounceTimer);
                    this.debounceTimer = setTimeout(() => {
                        this.fetchSuggestions();
                    }, 300);
                },

                showDropdown() {
                    this.isOpen = true;
                },

                hideDropdown() {
                    setTimeout(() => {
                        this.isOpen = false;
                    }, 200);
                },

                selectSuggestion(title) {
                    this.query = title;
                    this.isOpen = false;
                }
            };
        }

        function copyToClipboard() {
            let copyText = document.getElementById("message_url");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("URL copied to clipboard!");
        }
    </script>
@endsection
@section('seo')
@stop
