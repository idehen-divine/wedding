<?php

namespace App\Filament\Resources\WeddingWishes;

use App\Filament\Resources\WeddingWishes\Pages\ListWeddingWishes;
use App\Filament\Resources\WeddingWishes\Tables\WeddingWishesTable;
use App\Models\WeddingWish;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WeddingWishResource extends Resource
{
    protected static ?string $model = WeddingWish::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Guest Wedding Wishes';

    public static function table(Table $table): Table
    {
        return WeddingWishesTable::configure($table);
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
            'index' => ListWeddingWishes::route('/'),
        ];
    }
}
