<?php

namespace App\Filament\Resources\WeddingWishes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class WeddingWishesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('wish')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    }),

                ToggleColumn::make('approved')
                    ->label('Approved')
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-clock')
                    ->onColor('success')
                    ->offColor('warning')
                    ->tooltip(fn(bool $state): string => $state ? 'Click to mark as pending' : 'Click to approve'),

                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('approved')
                    ->options([
                        true => 'Approved',
                        false => 'Pending',
                    ]),
            ])
            ->recordActions([
                DeleteAction::make()
                    // ->label('Delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Delete Wedding Wish')
                    ->modalDescription('Are you sure you want to delete this wedding wish? This action cannot be undone.')
                    ->modalSubmitActionLabel('Yes, Delete'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('approve')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(function (Collection $records) {
                            $records->each(function ($record) {
                                $record->update(['approved' => true]);
                            });
                        })
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('unapprove')
                        ->label('Mark as Pending')
                        ->icon('heroicon-o-clock')
                        ->color('warning')
                        ->action(function (Collection $records) {
                            $records->each(function ($record) {
                                $record->update(['approved' => false]);
                            });
                        })
                        ->deselectRecordsAfterCompletion(),

                    DeleteBulkAction::make()
                        ->label('Delete Selected')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Delete Wedding Wishes')
                        ->modalDescription('Are you sure you want to delete the selected wedding wishes? This action cannot be undone.')
                        ->modalSubmitActionLabel('Yes, Delete'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
