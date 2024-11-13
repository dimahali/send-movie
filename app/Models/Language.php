<?php

namespace App\Models;

use App\Enums\LanguageDirection;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    protected $casts = [
        'direction' => LanguageDirection::class
    ];

    public static function getForm(): array
    {

        return [

            Group::make()
                 ->schema([

                     Section::make()
                            ->schema([

                                TextInput::make('name')
                                         ->required()
                                         ->maxLength(60),

                                TextInput::make('code')
                                         ->required()
                                         ->maxLength(6),

                                Select::make('direction')
                                      ->required()
                                      ->native(false)
                                      ->enum(LanguageDirection::class)
                                      ->options(LanguageDirection::class)
                                      ->default(LanguageDirection::LTR),

                            ])

                 ])
                 ->columnSpan([ 'lg' => 2 ]),

        ];

    }

    public function games(): HasMany
    {
        return $this->hasMany(Movie::class);
    }
}
