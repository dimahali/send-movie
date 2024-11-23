<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100)->unique();
            $table->string('slug', 100)->unique();

            $table->string('meta_description')->nullable();
            $table->longText('description')->nullable();

            $table->text('featured_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('genres');
    }
};
