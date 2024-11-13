<?php

use App\Enums\UserType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name', 60)->index();
            $table->string('email', 100)->unique();

            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');

            $table->string('avatar_url', 2083)->nullable();

            $table->string('user_type', 6)
                ->default(UserType::GAMER);

            $table->string('auth_provider')->nullable()->index();
            $table->string('auth_provider_id')->nullable()->index();

            $table->rememberToken();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
