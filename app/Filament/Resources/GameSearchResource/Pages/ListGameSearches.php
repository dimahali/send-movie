<?php

namespace App\Filament\Resources\GameSearchResource\Pages;

use App\Filament\Resources\GameSearchResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGameSearches extends ListRecords
{
    protected static string $resource = GameSearchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
