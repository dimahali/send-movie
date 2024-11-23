<div class="pt-8 sm:inline-block sm:w-full sm:px-4">
    <a href="{{route('message.show', $message->slug)}}"
       class="block rounded-2xl leading-loose tracking-wide bg-amber-50 dark:bg-amber-100 dark:hover:bg-amber-50 hover:bg-amber-100 border border-amber-200 p-4 sm:p-6 text-base"
    >
        <div class="text-sm text-amber-700 mb-4">
            For: {{$message->recipient_title}}
        </div>
        <div
                class="text-center mb-4">
            <div
                    class="inline-flex text-sm text-center mb-4 rounded-md bg-indigo-50 border border-indigo-200 px-2 py-0.5">
                {{$message->movieReaction->text}} {{$message->movieReaction->emojis}}
            </div>

            <blockquote class="text-lg text-stone-700 text-center">
                {{$message->short_message}}
            </blockquote>

            <div class="mt-2 text-sm italic">
                Sent {{$message->created_at->diffForHumans()}}
            </div>
        </div>
        <div class="flex flex-col items-center leading-normal justify-center gap-2">
            <h2 class="text-base font-bold text-rose-700 line-clamp-1">
                {{$message->movie->title}}
            </h2>
            <p id="movie-status">{{$message->movie->status}}</p>
            <p id="movie-release-date">{{$message->movie->release_date_formated}}</p>
        </div>
        @if($message->show_sender)
            <div class="text-sm text-amber-700 mt-4">
                From: {{$message->user->name}}
            </div>
        @endif
    </a>
</div>
