<header
    x-data="{ open: false }"
    @keydown.window.escape="open = false"
    class="sticky top-0 border-b bg-amber-50 border-amber-200 dark:bg-gray-900 inset-x-0 z-50"
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
                class="inline-flex items-center text-lg text-rose-700 dark:text-slate-100"
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

        <div class="flex items-center align-center lg:hidden">
            <button
                type="button"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 dark:text-gray-300"
                @click="open = true"
            >
                <span class="sr-only">Open main menu</span>

                <svg
                    class="h-7 w-7"
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
            class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 dark:bg-gray-900 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
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
                    class="-m-2.5 rounded-md p-2.5 text-gray-700 dark:text-gray-300"
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
                <div class="-my-6 divide-y divide-gray-500/10">
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
