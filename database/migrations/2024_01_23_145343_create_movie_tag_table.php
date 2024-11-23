<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('movie_tag', function ( Blueprint $table ) {
            $table->id();

            $table->foreignId('movie_id')
                  ->constrained('movies')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->foreignId('tag_id')
                  ->constrained('tags')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->timestamps();

            $table->unique([ 'movie_id', 'tag_id' ]);

        });

    }
    public function down(): void
    {
        Schema::dropIfExists('movie_tag');
    }
};
