<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Vinkla\Hashids\Facades\Hashids;

class Movie extends Model
{
    protected $casts = [
        'release_date' => 'date'
    ];
    protected $appends = [
        'icon_image',
        'medium_image',
        'generated_slug',
        'release_date_formated'
    ];

    protected $guarded = [];

    public function getGeneratedSlugAttribute()
    {
        return str()->slug($this->name) . '-' . HashIds::encode($this->id);
    }

    public function getReleaseDateFormatedAttribute()
    {
        return $this->release_date->format('jS \o\f F, Y');
    }

    protected function iconImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->cover_image) {
                    return asset('posters/poster_vertical_small.webp');
                }

                if ($this->is_external_image) {
                    return "https://image.tmdb.org/t/p/w342$this->cover_image";
                }

                return asset('posters/poster_vertical_small.webp');
            }
        );
    }

    protected function mediumImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->cover_image) {
                    return asset('posters/poster_vertical_medium.webp');
                }

                if ($this->is_external_image) {
                    return "https://image.tmdb.org/t/p/w500$this->cover_image";
                }

                return asset('posters/poster_vertical_medium.webp');
            }
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
