<?php

namespace App\Filament\Resources;

use App\Filament\Forms\GameForm;
use App\Filament\Resources\GameResource\Pages\CreateGame;
use App\Filament\Resources\GameResource\Pages\EditGame;
use App\Filament\Resources\GameResource\Pages\ListGames;
use App\Models\Movie;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class GameResource extends Resource
{

    protected static ?string $model = Movie::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Manage Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(GameForm::get())
            ->columns(3);
    }

    public static function getRecordTitle(?Model $record): string|null|Htmlable
    {
        return $record->name;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->searchable()
                    ->description(fn(Movie $record): string => $record->slug)
                    ->wrap(),

                TextColumn::make('genre.name')
                    ->sortable()
                    ->wrap(),

                TextColumn::make('user.name')
                    ->label('Published By')
                    ->sortable()
                    ->wrap(),

                IconColumn::make('is_mobile_supported')
                    ->label('Mobile Supported?')
                    ->boolean(),

                TextColumn::make('published_at')
                    ->since()
                    ->sortable(),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make()->label('Edit Movie'),

                    Action::make('View Movie')
                        ->icon('heroicon-o-book-open')
                        ->url(fn(Movie $record): string => route('game.show', $record->slug))
                        ->openUrlInNewTab(),
                ])
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
            'index' => ListGames::route('/'),
            'create' => CreateGame::route('/create'),
            'edit' => EditGame::route('/{record}/edit'),
        ];

    }

}
