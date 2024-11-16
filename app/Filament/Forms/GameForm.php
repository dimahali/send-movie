<?php

namespace App\Filament\Forms;

use App\Models\Genre;
use App\Models\Language;
use App\Models\MessageRecipient;
use App\Models\Tag;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class GameForm
{
    public static function get(): array
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

                                    if (($get('slug') ?? '') !== str()->slug($old)) {
                                        return;
                                    }

                                    $set('slug', str()->slug($state));

                                }),

                            TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(60),

                            Textarea::make('meta_description')
                                ->hint('Max Characters: 160')
                                ->required()
                                ->maxLength(160)
                                ->columnSpanFull(),

                            RichEditor::make('description')
                                ->required()
                                ->columnSpanFull(),

                            RichEditor::make('game_play')
                                ->nullable()
                                ->columnSpanFull(),

                            RichEditor::make('instructions')
                                ->nullable()
                                ->columnSpanFull(),

                            TextInput::make('primary_game_url')
                                ->required()
                                ->url()
                                ->maxLength(2083)
                                ->suffixIcon('heroicon-m-globe-alt')
                                ->columnSpanFull(),

                            Repeater::make('secondary_game_urls')
                                ->label('Secondary URLs in case main does not work')
                                ->nullable()
                                ->schema([
                                    TextInput::make('url')
                                        ->nullable()
                                        ->url()
                                        ->suffixIcon('heroicon-m-globe-alt')
                                        ->columnSpanFull()
                                        ->helperText('URL to Embed Movie')
                                        ->distinct(),
                                ])
                                ->maxItems(3)
                                ->addActionLabel('+ New URL')
                                ->columnSpanFull()
                                ->defaultItems(0),

                            Repeater::make('about_entities')
                                ->label('Page Main Entities (ABOUT)')
                                ->nullable()
                                ->schema([

                                    TextInput::make('name')
                                        ->requiredWith('url')
                                        ->nullable()
                                        ->maxLength(60)
                                        ->columnSpanFull()
                                        ->distinct(),

                                    TextInput::make('url')
                                        ->requiredWith('name')
                                        ->nullable()
                                        ->url()
                                        ->suffixIcon('heroicon-m-globe-alt')
                                        ->columnSpanFull()
                                        ->helperText('Wikipedia, Wikidata or Google Knowledge Graph...')
                                        ->distinct(),

                                ])
                                ->maxItems(3)
                                ->addActionLabel('+ New Item')
                                ->columnSpanFull()
                                ->defaultItems(0),


                            Repeater::make('mentioned_entities')
                                ->label('Page Secondary Entities (MENTIONS)')
                                ->schema([

                                    TextInput::make('name')
                                        ->requiredWith('url')
                                        ->nullable()
                                        ->maxLength(60)
                                        ->columnSpanFull()
                                        ->distinct(),

                                    TextInput::make('url')
                                        ->requiredWith('name')
                                        ->nullable()
                                        ->url()
                                        ->suffixIcon('heroicon-m-globe-alt')
                                        ->columnSpanFull()
                                        ->helperText('Wikipedia, Wikidata or Google Knowledge Graph...')
                                        ->distinct(),

                                ])
                                ->maxItems(3)
                                ->addActionLabel('+ New Item')
                                ->columnSpanFull()
                                ->defaultItems(0),
                        ])
                        ->columns()

                ])
                ->columnSpan(['lg' => 2]),

            Group::make()
                ->schema([

                    Section::make('Settings')
                        ->schema([

                            DateTimePicker::make('published_at')
                                ->default(now())
                                ->native(),

                            Select::make('language_id')
                                ->relationship('language', 'name')
                                ->exists('languages', 'id')
                                ->searchable()
                                ->native(false)
                                ->editOptionForm(Language::getForm())
                                ->createOptionForm(Language::getForm())
                                ->preload()
                                ->required(),

                            Select::make('publisher_id')
                                ->relationship('publisher', 'name')
                                ->exists('publishers', 'id')
                                ->searchable()
                                ->native(false)
                                ->editOptionForm(MessageRecipient::getForm())
                                ->createOptionForm(MessageRecipient::getForm())
                                ->preload()
                                ->required(),

                            FileUpload::make('cover_image')
                                ->image()
                                ->imageEditor()
                                ->maxSize(512)
                                ->directory('games')
                                ->fetchFileInformation(false)
                                ->getUploadedFileNameForStorageUsing(

                                    function (Get $get, TemporaryUploadedFile $file): string {

                                        return str()->slug($get('name')) . '-poster-' . time() . '.' . $file->getClientOriginalExtension();

                                    },

                                ),

                            Select::make('genre_id')
                                ->relationship('genre', 'name')
                                ->exists('genres', 'id')
                                ->searchable()
                                ->native(false)
                                ->editOptionForm(Genre::getForm())
                                ->createOptionForm(Genre::getForm())
                                ->required()
                                ->preload(),

                            Select::make('tags')
                                ->multiple()
                                ->relationship('tags', 'name')
                                ->preload()
                                ->createOptionForm(Tag::getForm())
                                ->maxItems(3),

                            Checkbox::make('is_mobile_supported')
                                ->label('Can play on Mobile?')
                                ->nullable()
                                ->columnSpanFull()
                        ])
                ])
                ->columnSpan(['lg' => 1]),
        ];
    }
}
