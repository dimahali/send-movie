<header
    x-data="{ open: false }"
    @keydown.window.escape="open = false"
    class="sticky top-0 border-b bg-amber-50 border-amber-200 dark:border-stone-800 dark:bg-stone-900 inset-x-0 z-50"
>
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-2 lg:px-8"
         aria-label="Main Navigation for Desktop">
        <div class="flex items-center lg:flex-1">
            <a href="/" class="-m-1.5 p-1.5">
                <img src="{{asset('send_the_movie_logo_sm.webp')}}"
                     alt="{{config('app.name')}}"
                     class="w-10"
                >
            </a>
            <button
                class="inline-flex items-center text-lg text-rose-700 dark:text-stone-100"
                @click="open_search_modal = true"
                aria-label="Search for Message Receiver"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1"
                     stroke="currentColor"
                     class="size-9">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
            </button>
        </div>
        <div class="flex items-center align-center gap-x-2 lg:hidden">
            @guest
                <a href="{{route('login')}}"
                   class="bg-rose-500 text-sm font-bold text-white rounded-lg border border-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor"
                         class="size-9">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                </a>
            @endguest
            <button
                type="button"
                class="bg-lime-500 text-sm font-bold text-white rounded-lg border border-lime-600"
                @click="open = true"
            >
                <span class="sr-only">Open main menu</span>

                <svg
                    class="size-9"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                    ></path>
                </svg>
            </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-2">
            <button
                @click="open_search_modal = true"
                class="desktop-nav-link"
            >
                Browse
            </button>
            <a
                href="{{route('get.message.now')}}"
                class="desktop-nav-link"
            >
                Submit
            </a>
            <a
                href="{{route('get.random.message')}}"
                class="desktop-nav-link"
            >
                Random
            </a>
        </div>
        <div class="ml-4 hidden lg:flex lg:justify-end gap-1 items-center place-items-center">
            <button type="button"
                    x-bind:class="dark_mode ? 'bg-red-500' : 'bg-amber-300'"
                    x-on:click="dark_mode = !dark_mode"
                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out"
                    role="switch"
                    aria-checked="false"
            >

                <span class="sr-only">Dark mode toggle</span>

                <span x-bind:class="dark_mode ? 'translate-x-5 bg-stone-700' : 'translate-x-0 bg-white'"
                      class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full shadow ring-0 transition duration-200 ease-in-out"
                >

                    <span
                        x-bind:class="dark_mode ? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200'"
                        class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                        aria-hidden="true"
                    >

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-3 w-3 text-stone-300"
                             viewBox="0 0 20 20"
                             fill="currentColor"
                        >
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>

                    </span>

                    <span
                        x-bind:class="dark_mode ?  'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100'"
                        class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                        aria-hidden="true"
                    >

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-3 w-3 text-white"
                             viewBox="0 0 20 20"
                             fill="currentColor"
                        >
                            <path fill-rule="evenodd"
                                  d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                  clip-rule="evenodd"/>
                        </svg>

                    </span>

                </span>

            </button>
            @guest
                <a href="{{route('login')}}"
                   class="bg-rose-700 text-sm font-bold text-white p-1 rounded-lg border border-rose-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                </a>
            @endguest
            @auth
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center p-1 border border-transparent text-sm leading-tight font-bold rounded-md text-white dark:text-stone-300 bg-rose-700 dark:bg-stone-800 hover:bg-rose-600 dark:hover:text-stone-300 focus:outline-none transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                     stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>

                                <div>
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('user.messages')">
                                {{ __('My Messages') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth
        </div>
    </nav>

    <nav
        x-description="Mobile menu, show/hide based on menu open state."
        class="lg:hidden"
        x-ref="dialog"
        x-show="open"
        aria-modal="true"
        style="display: none"
    >
        <div
            x-description="Background backdrop, show/hide based on slide-over state."
            class="fixed inset-0 z-50"
        ></div>
        <div
            class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 dark:bg-stone-900 sm:max-w-sm sm:ring-1 sm:ring-stone-900/10"
            @click.away="open = false"
        >
            <div class="flex items-center justify-between">
                <a href="/" class="-m-1.5 p-1.5">
                    <img src="{{asset('send_the_movie_logo_sm.webp')}}"
                         alt="{{config('app.name')}}"
                         class="w-10"
                    >
                </a>

                <button
                    type="button"
                    class="-m-2.5 rounded-md p-2.5 text-stone-700 dark:text-stone-300"
                    @click="open = false"
                >
                    <span class="sr-only">Close menu</span>

                    <svg
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-stone-500/10">
                    <div class="space-y-2 py-6">
                        <button
                            @click="open_search_modal = true;open=false"
                            class="mobile-nav-link"
                        >
                            Browse
                        </button>
                        <a
                            href="{{route('get.message.now')}}"
                            class="mobile-nav-link"
                        >
                            Submit
                        </a>
                        <a
                            href="{{route('get.random.message')}}"
                            class="mobile-nav-link"
                        >
                            Random
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
