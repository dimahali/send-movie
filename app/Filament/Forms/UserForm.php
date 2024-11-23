<?php

namespace App\Filament\Forms;

use App\Enums\UserType;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class UserForm
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
                                ->maxLength(60),

                            TextInput::make('email')
                                ->prefix('@')
                                ->email()
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(100),

                            TextInput::make('password')
                                ->password()
                                ->required()
                                ->revealable()
                                ->minLength(12)
                                ->maxLength(255)

                        ])
                        ->columns()
                ])
                ->columnSpan(['lg' => 2]),

            Group::make()
                ->schema([

                    Section::make('Settings')
                        ->schema([

                            FileUpload::make('avatar_url')
                                ->image()
                                ->imageEditor()
                                ->maxSize(512)
                                ->directory('users')
                                ->fetchFileInformation(false)
                                ->getUploadedFileNameForStorageUsing(

                                    function (Get $get, TemporaryUploadedFile $file): string {

                                        return str()->slug($get('name')) . '-avatar-' . time() . '.' . $file->getClientOriginalExtension();

                                    },

                                ),

                            Select::make('user_type')
                                ->searchable()
                                ->native(false)
                                ->preload()
                                ->required()
                                ->enum(UserType::class)
                                ->options(UserType::class)
                        ])

                ])
                ->columnSpan(['lg' => 1]),
        ];
    }
}
