<?php

namespace App\Filament\Resources\CommentResource\Pages;

use Filament\Resources\Components\Tab;
use App\Filament\Resources\CommentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;

    public function getTabs(): array
    {
        return [
            'all'    => Tab::make('All'),
            'Pending' => Tab::make('Pending')
                           ->modifyQueryUsing(function ( $query ) {
                               return $query->whereNull('approved_at');
                           }),
            'Approved' => Tab::make('Approved')
                            ->modifyQueryUsing(function ( $query ) {
                                return $query->whereNotNull('approved_at');
                            })
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
