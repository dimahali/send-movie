<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Language;
use App\Models\Movie;
use App\Models\MovieReaction;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use League\Csv\Reader;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $languages = [
            [
                'name' => 'English',
                'code' => 'en'
            ],
            [
                'name' => 'French',
                'code' => 'fr'
            ],
            [
                'name' => 'Spanish',
                'code' => 'es'
            ],
            [
                'name' => 'Italian',
                'code' => 'it'
            ],
            [
                'name' => 'German',
                'code' => 'de'
            ],
            [
                'name' => 'Hindi',
                'code' => 'hi'
            ],
            [
                'name' => 'Portuguese',
                'code' => 'pt'
            ],
        ];

        foreach ($languages as $language) {
            $new_language = new Language();

            $new_language->name = $language['name'];
            $new_language->code = $language['code'];

            $new_language->save();
        }

        $reactions = [
            [
                'text' => 'A real nail-biter!',
                'emojis' => '🎥😳🔪'
            ],
            [
                'text' => 'So much suspense!',
                'emojis' => '🎬🤫🕵️‍♂️'
            ],
            [
                'text' => 'Only if you dare!',
                'emojis' => '🍿🩸😰'
            ],
            [
                'text' => 'Prepare to be scared!',
                'emojis' => '🎥😨💀'
            ],
            [
                'text' => 'This one’s terrifying!',
                'emojis' => '🎬👻😱'
            ],
            [
                'text' => 'Guaranteed laughs!',
                'emojis' => '🍿😹🎉'
            ],
            [
                'text' => 'Laugh out loud!',
                'emojis' => '🎥😆🍿'
            ],
            [
                'text' => 'It’s hilarious!',
                'emojis' => '🎬😂🤣'
            ],
            [
                'text' => 'A perfect romantic watch!',
                'emojis' => '🍿🌹❤️'
            ],
            [
                'text' => 'Heartfelt and emotional!',
                'emojis' => '🎥💘😭'
            ],
            [
                'text' => 'You will love this movie!',
                'emojis' => '🎬🍿🤩'
            ],
            [
                'text' => 'You HAVE to watch this!',
                'emojis' => '🎬✨👏'
            ],
            [
                'text' => 'It’s amazing!',
                'emojis' => '🎥🔥💯'
            ],
            [
                'text' => 'Such a lovely movie!',
                'emojis' => '🎬💖🥰'
            ],
            [
                'text' => 'Wholesome and magical!',
                'emojis' => '🍿🌈✨'
            ],
            [
                'text' => 'Family-friendly fun!',
                'emojis' => '🎥😊👨‍👩‍👧‍👦'
            ],
            [
                'text' => 'Perfect for all ages!',
                'emojis' => '🎬🧸❤️'
            ],
            [
                'text' => 'Very touching story!',
                'emojis' => '🍿😌💖'
            ],
            [
                'text' => 'So moving and deep!',
                'emojis' => '🎥😭🍂'
            ],
            [
                'text' => 'It’s a tearjerker!',
                'emojis' => '🎬😢💔'
            ],
            [
                'text' => 'Full of adventure!',
                'emojis' => '🍿😎🏃‍♂'
            ],
            [
                'text' => 'Non-stop excitement!',
                'emojis' => '🎥💪🚗💨'
            ],
            [
                'text' => 'Packed with action!',
                'emojis' => '🎬🔥💥'
            ],
            [
                'text' => 'Edge-of-your-seat thriller!',
                'emojis' => '🍿🤯😮'
            ],
        ];

        foreach ($reactions as $reaction) {
            $new_reaction = new MovieReaction();

            $new_reaction->text = $reaction['text'];
            $new_reaction->emojis = $reaction['emojis'];

            $new_reaction->save();
        }

        try {
            $user = User::firstOrCreate([
                'email' => 'dimah.ali92@gmail.com'
            ], [
                'name' => 'Hamid Ali',
                'password' => bcrypt('n0passw0rd'),
                'email_verified_at' => now(),
                'user_type' => UserType::ADMIN
            ]);

            $file_path = storage_path('app/public/movies.csv');
            $reader = Reader::createFromPath($file_path);
            $reader->skipEmptyRecords();

            $counter = 0;
            $batchSize = 1000;
            $movies = [];

            $languages = Language::all();

            DB::beginTransaction();

            foreach ($reader->getIterator() as $record) {
                $language = $languages->where('code', trim($record[13]))
                    ->first();

                if (!$language) {
                    continue;
                }
                if (!(strtolower(trim($record[8])) === 'false')) {
                    continue;
                }
                if (strlen(trim($record[1])) < 3 || strlen(trim($record[1])) > 200) {
                    continue;
                }

                $movies[] = [
                    'user_id' => $user->id,
                    'tmdb_id' => trim($record[0]),
                    'imdb_id' => trim($record[12]),
                    'language_id' => $language->id,
                    'title' => Str::of(strtolower(trim($record[1])))->title(),
                    'status' => trim($record[4]),
                    'cover_image' => trim($record[17]),
                    'is_external_image' => true,
                    'is_adult_movie' => !(strtolower(trim($record[8])) === 'false'),
                    'release_date' => Carbon::parse(trim($record[5]))->toDateString(),
                    'genres' => trim($record[19]),
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                $counter++;

                if ($counter % $batchSize === 0) {
                    Movie::withoutEvents(function () use ($movies) {
                        Movie::insert($movies);
                    });
                    echo "Inserted $counter movies so far..." . PHP_EOL;
                    $movies = [];
                }
            }

            if (count($movies) > 0) {
                Movie::withoutEvents(function () use ($movies) {
                    Movie::insert($movies);
                });
                echo "Inserted all remaining movies. Total: $counter" . PHP_EOL;
            }

            DB::commit();

            echo "All records have been inserted successfully. Total: $counter" . PHP_EOL;
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            Log::error($e->getMessage());
        }
    }
}
