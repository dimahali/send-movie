<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('recipient_searches', function (Blueprint $table) {
            $table->id();

            $table->string('search_term');
            $table->unsignedBigInteger('no_of_searches')->default(1);

            $table->timestamps();

            $table->unique(['search_term', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipient_searches');
    }
};
