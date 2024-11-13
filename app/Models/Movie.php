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
        'generated_slug'
    ];

    protected $guarded = [];

    public function getGeneratedSlugAttribute()
    {
        return str()->slug($this->name) . '-' . HashIds::encode($this->id);
    }

    protected function iconImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->cover_image) {
                    return null;
                }
                $iconPath = 'games/icons/' . pathinfo($this->cover_image, PATHINFO_FILENAME) . '.webp';
                return Storage::disk('public')->exists($iconPath)
                    ? asset("storage/$iconPath")
                    : asset("storage/$this->cover_image");
            }
        );
    }

    protected function mediumImage(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->cover_image) {
                    return null;
                }

                $mediumPath = 'games/medium/' . pathinfo($this->cover_image, PATHINFO_FILENAME) . '.webp';

                return Storage::disk('public')->exists($mediumPath)
                    ? asset("storage/$mediumPath")
                    : asset("storage/$this->cover_image");
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
