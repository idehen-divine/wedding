<?php

namespace App\Filament\Resources\Rsvps\Tables;

use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class RsvpsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->searchable()
                    ->placeholder('Not provided')
                    ->formatStateUsing(fn(string $state = null): string => $state ?: 'Not provided'),

                TextColumn::make('guests')
                    ->label('# Guests')
                    ->sortable(),

                BadgeColumn::make('attendance')
                    ->colors([
                        'success' => 'yes',
                        'danger' => 'no',
                    ])
                    ->icons([
                        'heroicon-o-check' => 'yes',
                        'heroicon-o-x-mark' => 'no',
                    ]),

                TextColumn::make('created_at')
                    ->label('RSVP Date')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('attendance')
                    ->options([
                        'yes' => 'Attending',
                        'no' => 'Not Attending',
                    ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
