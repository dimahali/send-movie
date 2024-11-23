<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

class MovieMessage extends Model
{
    protected $casts = [
        'show_sender' => 'boolean'
    ];
    protected $appends = [
        'message_date',
        'short_message',
        'slug'
    ];

    public function getMessageDateAttribute()
    {
        return $this->created_at->format('jS \o\f F, Y');
    }

    public function getSlugAttribute(): string
    {
        return HashIds::encode($this->id);
    }

    public function getShortMessageAttribute()
    {
        return Str::limit($this->message, 87);
    }
    public function getMessageDisplayAttribute()
    {
        return nl2br(e($this->message));
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
