<header
    x-data="{ open: false }"
    @keydown.window.escape="open = false"
    class="sticky top-0 border bg-white border-gray-200 dark:bg-gray-900 inset-x-0 z-50"
>

    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8"
         aria-label="Main Navigation for Desktop">

        <div class="flex lg:flex-1">
            <a href="/" class="-m-1.5 p-1.5">
                {{config('app.name')}}
            </a>
        </div>

        <div class="flex items-center align-center lg:hidden">

            <button
                type="button"
                x-bind:class="dark_mode ? 'bg-rose-600' : 'bg-gray-200'"
                x-on:click="dark_mode = !dark_mode"
                class="relative inline-flex h-6 w-11 mr-4 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-rose-600 focus:ring-offset-2"
                role="switch"
                aria-checked="false"
            >
                <span class="sr-only">Dark mode toggle</span>

                <span
                    x-bind:class="dark_mode ? 'trangray-x-5 bg-gray-700' : 'trangray-x-0 bg-white'"
                    class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full shadow ring-0 transition duration-200 ease-in-out"
                >
                                    <span
                                        x-bind:class="
                                            dark_mode
                                                ? 'opacity-0 ease-out duration-100'
                                                : 'opacity-100 ease-in duration-200'
                                        "
                                        class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                                        aria-hidden="true"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 text-gray-400"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                                            />
                                        </svg>
                                    </span>

                                    <span
                                        x-bind:class="
                                            dark_mode
                                                ? 'opacity-100 ease-in duration-200'
                                                : 'opacity-0 ease-out duration-100'
                                        "
                                        class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                                        aria-hidden="true"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 text-white"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </span>
                                </span>
            </button>

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

            <a
                href="{{route('get.random.message')}}"
                class="desktop-nav-link"
            >
                Random
            </a>

            <a
                href="#"
                class="desktop-nav-link"
            >
                Browse
            </a>

        </div>

        <div class="hidden place-items-center items-center lg:flex lg:flex-1 lg:justify-end">

            <button
                type="button"
                x-bind:class="dark_mode ? 'bg-rose-500' : 'bg-gray-200'"
                x-on:click="dark_mode = !dark_mode"
                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2"
                role="switch"
                aria-checked="false"
            >
                <span class="sr-only">Dark mode toggle</span>

                <span
                    x-bind:class="dark_mode ? 'trangray-x-5 bg-gray-700' : 'trangray-x-0 bg-white'"
                    class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full shadow ring-0 transition duration-200 ease-in-out"
                >
                    <span
                        x-bind:class="
                            dark_mode
                                ? 'opacity-0 ease-out duration-100'
                                : 'opacity-100 ease-in duration-200'
                        "
                        class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                        aria-hidden="true"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-3 w-3 text-gray-400"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                    </span>

                    <span
                        x-bind:class="
                            dark_mode
                                ? 'opacity-100 ease-in duration-200'
                                : 'opacity-0 ease-out duration-100'
                        "
                        class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                        aria-hidden="true"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-3 w-3 text-white"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </span>
                </span>
            </button>

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
                <a href="#" class="-m-1.5 p-1.5">
                    {{config('app.name')}}
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

                        <a
                            href="{{route('get.random.message')}}"
                            class="mobile-nav-link"
                        >
                            Random
                        </a>

                        <a
                            href="#"
                            class="mobile-nav-link"
                        >
                            Browse
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </nav>

</header>
