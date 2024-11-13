<div class="filters-container mb-4 sm:mb-6 text-right"
     role="region"
     aria-label="Filter Games"
>

    <div class="flex gap-x-1 justify-center">
        @if($show_filter_reset)

            <a href="{{$route}}"
               class="rounded-md border border-red-200 bg-red-50 py-1 px-2 text-sm sm:text-base text-red-700 shadow-sm hover:bg-red-100"
               aria-label="Clear the filter"
            >
                Clear
            </a>

        @endif

        <button type="button"
                class="rounded-md border border-lime-200 bg-lime-50 py-1 px-2 text-sm sm:text-base text-lime-700 shadow-sm hover:bg-lime-100"
                @click="openFilter = true"
        >
            Filter Games
        </button>
    </div>

    <div @keydown.window.escape="openFilter = false"
         x-show="openFilter"
         class="relative z-10 min-h-full"
         x-ref="dialog"
         x-cloak
    >

        <div
            x-description="Background backdrop, show/hide based on slide-over state of the games filter."
            class="fixed inset-0">
        </div>

        <div class="fixed inset-0 overflow-hidden">

            <div class="absolute inset-0 overflow-hidden">

                <div
                    class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">

                    <div x-show="openFilter"
                         x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                         x-transition:enter-start="translate-x-full"
                         x-transition:enter-end="translate-x-0"
                         x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                         x-transition:leave-start="translate-x-0"
                         x-transition:leave-end="translate-x-full"
                         class="pointer-events-auto w-screen max-w-lg"
                         x-description="Slide-over panel, show/hide based on slide-over state."
                         @click.away="openFilter = false"
                    >
                        <form
                            class="flex h-full overflow-y-scroll sm:overflow-y-auto flex-col overflow overflow-hidden bg-white dark:bg-slate-950 shadow-xl text-left"
                            method="GET"
                            action="{{$route}}"
                        >

                            <div class="bg-slate-50 dark:bg-slate-900 px-4 py-5 sm:px-6">

                                <div class="flex items-start justify-between space-x-3">

                                    <div class="space-y-1 text-left">

                                        <div
                                            class="text-lg font-semibold leading-6 text-slate-700 dark:text-slate-200">
                                            Looking for a specific game?
                                        </div>

                                        <p class="text-sm text-slate-500 dark:text-slate-300">
                                            Use this filter to find your favorite game...
                                        </p>

                                    </div>

                                    <div class="flex h-7 items-center">

                                        <button type="button"
                                                class="relative text-slate-300 hover:text-slate-500"
                                                @click="openFilter = false">

                                            <span class="absolute -inset-2.5"></span>

                                            <span class="sr-only">Close panel</span>

                                            <svg class="h-6 w-6"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke-width="1.5"
                                                 stroke="currentColor"
                                                 aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>

                                        </button>

                                    </div>

                                </div>

                            </div>

                            <div
                                class="space-y-6 py-6 sm:space-y-0 sm:divide-y sm:divide-slate-200 sm:dark:divide-slate-800 sm:py-0">

                                <div
                                    class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">

                                    <div>
                                        <label for="game_name"
                                               class="block text-sm font-medium leading-6 text-slate-700 dark:text-slate-300 sm:mt-1.5">
                                            Game Name
                                        </label>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <input type="text"
                                               name="game_name"
                                               id="game_name"
                                               placeholder="Search Game Name"
                                               value="{{request('game_name')}}"
                                               minlength="3"
                                               maxlength="60"
                                               class="block w-full rounded-md border-0 py-3 px-3 text-slate-700 dark:text-slate-300 dark:bg-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-300 focus:ring-0 focus:ring-inset focus:ring-slate-300 sm:text-sm sm:leading-6">
                                    </div>

                                </div>

                                @if($filter_form_data['categories'])

                                    <div
                                        class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">

                                        <div>
                                            <label for="categories"
                                                   class="block text-sm font-medium leading-6 text-slate-700  dark:text-slate-300 sm:mt-1.5">
                                                Categories
                                            </label>
                                        </div>

                                        <div class="sm:col-span-2">

                                            <select multiple="multiple"
                                                    name="categories[]"
                                                    id="categories"
                                                    x-data="categories"
                                            >

                                                @forelse($filter_form_data['categories'] as $key => $level)
                                                    <option
                                                        value="{{$key}}" {{ (collect(request('categories'))->contains($key)) ? 'selected':'' }}>{{$level}}</option>
                                                @empty
                                                @endforelse

                                            </select>

                                        </div>

                                    </div>

                                @endif

                                @if($filter_form_data['tags'])

                                    <div
                                        class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">

                                        <div>
                                            <label for="tags"
                                                   class="block text-sm font-medium leading-6 text-slate-700  dark:text-slate-300 sm:mt-1.5">
                                                Tags
                                            </label>
                                        </div>

                                        <div class="sm:col-span-2">

                                            <select multiple="multiple"
                                                    name="tags[]"
                                                    id="tags"
                                                    x-data="tags"
                                            >

                                                @forelse($filter_form_data['tags'] as $key => $company)
                                                    <option
                                                        value="{{$key}}" {{ (collect(request('tags'))->contains($key)) ? 'selected':'' }}>{{$company}}</option>
                                                @empty
                                                @endforelse

                                            </select>

                                        </div>

                                    </div>

                                @endif

                            </div>

                            <div
                                class="flex-shrink-0 border-t border-slate-200 dark:border-slate-800 px-4 py-5 sm:px-6">

                                <div class="flex justify-end space-x-1">

                                    <button type="button"
                                            class="inline-flex justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                                            @click="openFilter = false">
                                        Cancel
                                    </button>

                                    <button type="submit"
                                            class="inline-flex justify-center rounded-md bg-lime-600 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-lime-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lime-600">
                                        Find Games
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
