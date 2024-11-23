<?php

namespace App\Filament\Resources\GameSearchResource\Pages;

use App\Filament\Resources\GameSearchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGameSearch extends EditRecord
{
    protected static string $resource = GameSearchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
