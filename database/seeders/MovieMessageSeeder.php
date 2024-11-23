<?php

namespace Database\Seeders;

use App\Models\MessageRecipient;
use App\Models\Movie;
use App\Models\MovieMessage;
use App\Models\MovieReaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MovieMessageSeeder extends Seeder
{

    public function run(): void
    {
        $movie_reactions = MovieReaction::all();

        for ($i = 1; $i <= 10000; $i++) {
            $recipient = Str::of(strtolower(fake()->name))->title();

            $message_recipient = MessageRecipient::firstOrCreate(['title' => $recipient]);

            $new_message = new MovieMessage();

            $new_message->movie_id = rand(1, 600000);
            $new_message->movie_reaction_id =$movie_reactions->random()->id;
            $new_message->message_recipient_id = $message_recipient->id;

            $new_message->recipient_title = $message_recipient->title;

            $new_message->message = fake()->text(rand(150, 200));

            $new_message->save();
        }
    }
}
