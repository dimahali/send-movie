<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LanguageResource\Pages\CreateLanguage;
use App\Filament\Resources\LanguageResource\Pages\EditLanguage;
use App\Filament\Resources\LanguageResource\Pages\ListLanguages;
use App\Models\Language;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LanguageResource extends Resource
{

    protected static ?string $model = Language::class;

    //    protected static ?string $navigationIcon = 'heroicon-o-language';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Primary Settings';

    public static function form( Form $form ): Form
    {
        return $form
            ->schema(Language::getForm())
            ->columns(4);
    }

    public static function table( Table $table ): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                          ->searchable(),

                TextColumn::make('code')
                          ->searchable()
                          ->alignCenter(),

                TextColumn::make('direction')
                          ->searchable()
                          ->alignCenter(),

                IconColumn::make('is_default')
                          ->label('Default Language')
                          ->boolean()
                          ->alignCenter(),

                TextColumn::make('updated_at')
                          ->dateTime()
                          ->sortable()
                          ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
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
            'index'  => ListLanguages::route('/'),
            'create' => CreateLanguage::route('/create'),
            'edit'   => EditLanguage::route('/{record}/edit'),
        ];
    }
}
