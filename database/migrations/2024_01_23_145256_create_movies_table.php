<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained('users');

            $table->foreignId('language_id')->nullable()->constrained('languages');

            $table->string('title', 200)->index();
            $table->string('status', 60)->index();

            $table->string('genres', 200)->nullable();

            $table->string('meta_description')->nullable();

            $table->longText('description')->nullable();

            $table->text('cover_image')->nullable();

            $table->boolean('is_external_image')->default(false);
            $table->boolean('is_adult_movie')->default(false);

            $table->date('release_date')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
