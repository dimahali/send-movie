<?php

namespace App\Filament\Resources\LanguageResource\Pages;

use Str;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\LanguageResource;

class CreateLanguage extends CreateRecord
{

    protected static string $resource = LanguageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate( array $data ): array
    {

        $data['code'] = Str::slug($data['code']);

        return $data;

    }

}
