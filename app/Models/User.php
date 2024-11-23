<?php

namespace App\Models;

use App\Enums\UserType;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Comments\Models\Concerns\InteractsWithComments;
use Spatie\Comments\Models\Concerns\Interfaces\CanComment;

class User extends Authenticatable implements FilamentUser, HasAvatar, CanComment
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use InteractsWithComments;

    protected $fillable = [
        'name',
        'email',
        'password',
        'auth_provider',
        'auth_provider_id',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'user_type' => UserType::class
    ];

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->user_type === UserType::ADMIN;
    }

    public function isAdmin()
    {
        return $this->user_type === UserType::ADMIN;
    }

    public function games(): HasMany
    {
        return $this->hasMany(Movie::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    public function reports(): MorphMany
    {
        return $this->morphMany(Report::class, 'blameable');
    }
}
