<?php

namespace App\Filament\Resources\TagResource\Pages;

use Str;
use App\Filament\Resources\TagResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTag extends CreateRecord
{
    protected static string $resource = TagResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    protected function mutateFormDataBeforeCreate( array $data ): array
    {
        $data['slug'] = Str::slug($data['slug']);

        return $data;
    }
}
