<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('movie_messages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('message_recipient_id')->constrained('message_recipients');
            $table->foreignId('movie_id')->constrained('movies');
            $table->foreignId('movie_reaction_id')->nullable()->constrained('movie_reactions');

            $table->string('recipient_title', 100)->index();
            $table->string('message', 999);

            $table->boolean('show_sender')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movie_messages');
    }
};
