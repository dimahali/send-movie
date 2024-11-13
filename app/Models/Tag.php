<?php

namespace App\Models;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Str;

class Tag extends Model
{
    public static function getForm(): array
    {
        return [

            Group::make()
                ->schema([

                    Section::make()
                        ->schema([

                            TextInput::make('name')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(60)
                                ->live(debounce: 600)
                                ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                    if (($get('slug') ?? '') !== Str::slug($old)) {
                                        return;
                                    }

                                    $set('slug', Str::slug($state));
                                }),

                            TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(60),

                        ])

                ])
                ->columnSpan(['lg' => 2]),

        ];
    }

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class);
    }
}
