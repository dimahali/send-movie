<?php

namespace App\Models;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Str;

class Genre extends Model
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
                                ->maxLength(60),

                            RichEditor::make('description')
                                ->columnSpanFull(),

                        ])
                        ->columns()

                ])
                ->columnSpan(['lg' => 2]),

            Group::make()
                ->schema([

                    Section::make('Settings')
                        ->schema([

                            Select::make('parent_id')
                                ->relationship('parent', 'name'),

                            FileUpload::make('featured_image')
                                ->image()
                                ->imageEditor()
                                ->maxSize(512)
                                ->directory('genres')
                                ->fetchFileInformation(false)
                                ->getUploadedFileNameForStorageUsing(

                                    function (Get $get, TemporaryUploadedFile $file): string {

                                        return str()->slug($get('name')) . '-cover-' . time() . '.' . $file->getClientOriginalExtension();

                                    },

                                ),

                        ])

                ])
                ->columnSpan(['lg' => 1]),

        ];

    }

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class);
    }
}
