<?php

namespace App\Filament\Resources\Rsvps;

use App\Filament\Resources\Rsvps\Pages\ListRsvps;
use App\Filament\Resources\Rsvps\Tables\RsvpsTable;
use App\Models\Rsvp;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RsvpResource extends Resource
{
    protected static ?string $model = Rsvp::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Guest RSVPs';

    public static function table(Table $table): Table
    {
        return RsvpsTable::configure($table);
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
            'index' => ListRsvps::route('/'),
        ];
    }
}
