<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class CommentResource extends Resource
{

    protected static ?string $model = Comment::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Manage Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Comment::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn($query) => $query->with('commentable'))
            ->defaultPaginationPageOption(25)
            ->columns([

                TextColumn::make('commentator.name')
                    ->wrap(),

                TextColumn::make('parent_title')
                    ->label('Commented On')
                    ->wrap(),

                TextColumn::make('original_text')
                    ->wrap(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Approved' => 'success',
                    }),

                TextColumn::make('created_at')
                    ->since()
                    ->sortable(),

            ])
            ->filters([
            ])
            ->actions([
                Action::make('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->iconButton()
                    ->size('lg')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn(Comment $record) => $record->approve())
                    ->hidden(fn(Comment $record) => $record->isApproved()),
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->size('lg')
                    ->color('warning'),
                Tables\Actions\DeleteAction::make()
                    ->iconButton()
                    ->size('lg')
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('Approve')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->action(fn(Collection $records) => $records->each->approve())
                    ->deselectRecordsAfterCompletion()
            ])
            ->selectCurrentPageOnly();
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
