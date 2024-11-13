<?php

namespace App\Models;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Spatie\Comments\Models\Comment as BaseComment;

class Comment extends BaseComment
{
    protected $appends = ['status', 'parent_title'];

    public function getStatusAttribute()
    {

        if ($this->approved_at) {
            return "Approved";
        }

        return "Pending";

    }

    public function getParentTitleAttribute()
    {
        return $this->commentable->commentableName();

    }

    public function shouldBeAutomaticallyApproved(): bool
    {
        if (!$this->commentator || !$this->commentator->isAdmin()) {
            return false;
        }

        return true;
    }

    public static function getForm(): array
    {
        return [
            Group::make()
                ->schema([

                    Section::make()
                        ->schema([

                            Textarea::make('original_text')
                                ->columnSpanFull(),

                            DatetimePicker::make('approved_at')
                                ->columnSpanFull()
                                ->default(function () {
                                    return NULL;
                                })

                        ])
                        ->columns()

                ])
                ->columnSpan(['lg' => 1])
        ];
    }
}
