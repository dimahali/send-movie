<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('movie_reactions', function (Blueprint $table) {
            $table->id();

            $table->string('text', 100)->unique();
            $table->string('emojis', 100);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movie_reactions');
    }
};
