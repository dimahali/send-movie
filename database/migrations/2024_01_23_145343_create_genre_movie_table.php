<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('genre_movie', function ( Blueprint $table ) {
            $table->id();

            $table->foreignId('movie_id')
                  ->constrained('movies')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->foreignId('genre_id')
                  ->constrained('genres')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->timestamps();

            $table->unique([ 'movie_id', 'genre_id' ]);

        });

    }
    public function down(): void
    {
        Schema::dropIfExists('genre_movie');
    }
};
