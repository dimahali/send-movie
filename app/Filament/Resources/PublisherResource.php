<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublisherResource\Pages\CreatePublisher;
use App\Filament\Resources\PublisherResource\Pages\EditPublisher;
use App\Filament\Resources\PublisherResource\Pages\ListPublishers;
use App\Models\MessageRecipient;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PublisherResource extends Resource
{
    protected static ?string $model = MessageRecipient::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Manage Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(MessageRecipient::getForm())
            ->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('email')
                    ->searchable(),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {

        return [
            'index' => ListPublishers::route('/'),
            'create' => CreatePublisher::route('/create'),
            'edit' => EditPublisher::route('/{record}/edit'),
        ];

    }

}
