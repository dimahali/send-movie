<?php

namespace App\Models;

use App\Models\Traits\Publishable;
use Cerbero\QueryFilters\FiltersRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;
use Spatie\Comments\Models\Concerns\HasComments;
use Vinkla\Hashids\Facades\Hashids;

class MovieMessage extends Model
{
    public function getGeneratedSlugAttribute()
    {
        return HashIds::encode($this->id);
    }

    public function scopeOfRecipient(Builder $query, $recipient_id): Builder
    {
        return $query->where('message_recipient_id', $recipient_id);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messageRecipient(): BelongsTo
    {
        return $this->belongsTo(MessageRecipient::class);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function movieReaction(): BelongsTo
    {
        return $this->belongsTo(MovieReaction::class);
    }
}