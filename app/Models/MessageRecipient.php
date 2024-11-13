<?php

namespace App\Models;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Vinkla\Hashids\Facades\Hashids;

class MessageRecipient extends Model
{
    protected $appends = ['slug'];

    public function getSlugAttribute()
    {
        return HashIds::encode($this->id);
    }

    public function movieMessages(): HasMany
    {
        return $this->hasMany(MovieMessage::class);
    }
}
