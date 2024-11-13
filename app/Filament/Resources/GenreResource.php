<?php

namespace App\Filament\Resources;

use App\Models\Genre;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\GenreResource\Pages\EditGenre;
use App\Filament\Resources\GenreResource\Pages\ListGenres;
use App\Filament\Resources\GenreResource\Pages\CreateGenre;

class GenreResource extends Resource
{
    protected static ?string $model = Genre::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Primary Settings';


    public static function form(Form $form): Form
    {
        return $form
            ->schema(Genre::getForm())
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image'),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('parent.name')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('slug')
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
            'index' => ListGenres::route('/'),
            'create' => CreateGenre::route('/create'),
            'edit' => EditGenre::route('/{record}/edit'),
        ];
    }

}
