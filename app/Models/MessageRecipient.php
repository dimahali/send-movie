<?php

namespace App\Models;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MessageRecipient extends Model
{
    public function movieMessages(): HasMany
    {
        return $this->hasMany(MovieMessage::class);
    }
}
