<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameSearchResource\Pages;
use App\Models\RecipientSearch;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GameSearchResource extends Resource
{

    protected static ?string $model = RecipientSearch::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Manage Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->columns([

                TextColumn::make('search_term')
                    ->wrap(),
                TextColumn::make('no_of_searches')
                    ->wrap(),

            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListGameSearches::route('/'),
            'create' => Pages\CreateGameSearch::route('/create'),
            'edit' => Pages\EditGameSearch::route('/{record}/edit'),
        ];
    }
}
